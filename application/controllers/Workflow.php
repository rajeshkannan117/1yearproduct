<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
/**
 *
 * This is Form management controller of Formpro
 *
 * @package      CodeIgniter
 * @category     controller
 * @author       Rajeshkannan.C
 * @link         http://innoppl.com/
 *
 */
class Workflow extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('comman_model');
        $this->load->model('category_model');
        $this->load->model('form_model');
        $this->load->model('department_model');
        $this->load->model('category_model');
        $this->load->model('role_model');
        $this->load->language('menu');
        $this->load->library('breadcrumbs');
        $this->load->language('form');
        $this->load->model('organization_model');
        $this->load->model('user_model');
        $this->load->helper('access');
        $this->load->helper('cryptojs-aes.php');
        $this->load->model('permission_model');
        $this->load->model('login_model');
        $this->load->library('Fields');
        $this->load->library('Review');
        $this->load->library('Filter');
        $this->load->library('uuid');
        //$this->load->helper('access');
        define_constants();
        $user_id = $this->session->userdata('user_id');
        //$this->fieldmaster = $this->form_model->get_fieldmaster();
        //Check the user is logged in properly
        if ($this->session->userdata('logged_in') == false) {
           $this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);
           redirect(base_url() . 'login/', 'refresh');
        }
        $this->roles = $this->login_model->assign_roles($user_id);
        $method = $this->router->fetch_method();
        switch($method){
            case 'add':
                if(!in_array('create',$this->roles['forms'])){
                  //redirect(base_url().'error');  
                }
                break;
            case 'create':
                if(!in_array('create',$this->roles['forms'])){
                  //redirect(base_url().'error');  
                }
                break;
            case 'edit_detail':
                if((!in_array('update',$this->roles['forms'])) && (!in_array('create',$this->roles['forms']))){
                     //redirect(base_url().'error');
                }
                break;
            case 'edit_form':
                if((!in_array('update',$this->roles['forms'])) && (!in_array('create',$this->roles['forms']))){
                     //redirect(base_url().'error');
                }
                break;
            case 'delete':
                if(!in_array('delete',$this->roles['forms'])){
                     //redirect(base_url().'error');
                }
                break;
            case 'index':
                if(!in_array('read',$this->roles['forms'])){
                    //redirect(base_url().'error');
                }
            default:
                break;
        }
        $this->load->helper('date');    
    }
    public function assign_workflow(){
        $org_id = $this->session->userdata('org_id');
        $get_org_users= $this->user_model->get_org_users($org_id);
        $data['org_users'] = $get_org_users;
        /* Location List */
        $org_location = $this->location_model->location_list($org_id);
        $data['org_location'] = $org_location;
        $this->load->view('form/assign_workflow',$data);
    }

    public function index(){
        $data['menu'] = $this->roles;
        $data['siteTitle'] ='Workflows - Innoforms';
        $data['roles'] = $this->roles['workflow'];
        $this->breadcrumbs->add('Worflows', base_url().'worflow');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $org_id = $this->session->userdata('org_id');
        $data['org_id'] = $org_id;
        $data['user_id'] = $this->session->userdata('user_id');
        $form_list = $this->form_model->form_hierarchy_list();
        foreach($form_list as $key=>$value){
            $form_id[]=$value->form_id;
        }
        $form_users = array();
        if(count($form_id) > 0){
            $form_user = $this->form_model->list_form_users($form_id);
            foreach($form_user as $key=>$value){
                $form_users[$value['form_id']][$value['uuid']] = $value['name'];
            }
            $form_category = $this->form_model->form_category_name_list($form_id);
            foreach($form_category as $key=>$value){
                $form_categorys[$value['form_id']] = $value['category_name'];
            }
        }        
        $data['forms'] = $form_list;
        $data['form_category'] = $form_categorys;
        $data['form_user'] = $form_users;
        $this->load->view('header', $data);
        $this->load->view('form/workflows', $data);
        $this->load->view('footer');
    }
    public function check_workflow_has_user($loc_id){
        $org_id = $this->session->userdata('org_id');
        $loc_users = $this->comman_model->location_users_list(implode(",",$loc_id));
        $role_id = $this->role_model->get_review_roles($org_id);
        $review_users = $this->user_model->review_role_user($role_id,$org_id);
        foreach($review_users as $key=>$value){
            $review_level_user[] = $value['id'];
        }
        $authorised_to_report = array();
        $authorised_to_approve = array();
        foreach($loc_users as $key=>$value){
            /* Review Permission users */
            if(in_array($value['id'],$review_level_user)){
                $authorised_to_approve[$key]['id'] = $value['id'];
                $authorised_to_approve[$key]['name'] = $value['name'];
            }else{
            /* Non Reviewed user */
                $authorised_to_report[$key]['id'] = $value['id'];
                $authorised_to_report[$key]['name'] = $value['name'];
            }
        }
        $report = count($authorised_to_report);
        $approve = count($authorised_to_approve);
		//print_r($loc_users);exit;
        $msg = '';
        if($report == 0 && $approve == 0){
            $msg = 'No user have to assign and review the form';
        }else if($report ==0){
            $msg = 'No user to assign the form';
        }else if($approve == 0){
            $msg = 'No user to review the form';
        }else{
            $msg = '';
        }
        return $msg;
    }
    public function edit($uuid = null){
        $form_hierarchy = $this->form_model->check_hierarchy_id_uuid_exists($uuid);
        if(empty($form_hierarchy)){
            redirect(base_url().'error');
        }
        $this->breadcrumbs->add('Worflows', base_url().'worflow');
        $this->breadcrumbs->add('Edit Workflow ', base_url().'workflow/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $hierarchy_id = $form_hierarchy['id'];
        $form_id = $form_hierarchy['form_id'];

        $data['menu'] = $this->roles;
        $data['siteTitle'] ='Work Flow - Innoforms';
        $org_id = $this->session->userdata('org_id');
        $details = $this->form_model->form_details($form_id);
        $forms = $this->form_model->form_hierarchy_list();
        $data['forms'] = $forms;
        $logged_user =  $this->session->userdata('user_id');
        $superadmin = $this->comman_model->get_superadmin_id($org_id);
        /* Get Organization Location */
        $data['location'] = $this->user_model->get_organization_location($org_id);
        if ((isset($_POST['workflow']) && $_POST['workflow'] === 'workflow')){
            //$location = $this->input->post('location_id');
            //$category = $this->input->post('category');
            $report = $this->input->post('report');
            $form_id = $this->input->post('form_id');
            $org_id = $this->input->post('org_id');
            $hierarchy_id = $this->input->post('hierarchy_id');
            
            if(empty($hierarchy_id)){
                $hierarchy_id = $this->form_model->form_hierarchy_insert($form_id);
                /* Assign Form to Multiple User */
                foreach($report['report'] as $key=>$value){
                    if(is_array($value['users'])){
                        $value['users'][]=$details->created_by;
                        $this->form_model->form_users($value['users'],$form_id,$hierarchy_id);
                    }
                    if(isset($value['approve']) && $value['approve'] != ''){
                        $approve[] =$value['approve'];
                    }                
                }
                $this->form_model->form_hierarchy_position_insert($approve,$form_id,$hierarchy_id);

            }else if($hierarchy_id != ''){
                /* Assign Form to Multiple User */
                $assign_users = array();
                $as = 0;
                foreach($report['report'] as $key=>$value){
                    if(isset($value['users']) && is_array($value['users'])) {

                        //$value['users'][]=$details->created_by;
                        $assign_users = $value['users'];
                        $this->form_model->form_users($value['users'],$form_id,$hierarchy_id);
                        $as++;
                    }
                    if(isset($value['approve']) && $value['approve'] != ''){
                        $approve[] =$value['approve'];
                    }
                }
                $this->form_model->form_hierarchy_position_insert($approve,$form_id,$hierarchy_id);
                if(is_array($assign_users)){
                    /* Change form status */
                    $this->form_model->form_change_status($form_id);
                }
                if(is_array($assign_users)){
                    /*Check already notification on same type */
                    $res = $this->comman_model->check_notification('1.1',$form_id,$assign_users);
                    if(!$res){
                        /* Set Push Notification */
                        $notification_data['details']['form_id'] = $form_id;
                        $notification_data['users'] = $assign_users;
                        $notification_data['status'] = '1';
                        $notification_data['details']['org_id'] = $org_id;
                        $notification_data['details']['title'] = $details->form_name.' form is assigned to you and ready for your submission ';
                        $notification_data['type'] = 'Form Creation';
                        $notification_data['type_id'] = '1.1';
                        $notification_data['created_at'] = gmdate('Y-m-d H:i:s');
                        $notification_data['updated_at'] = gmdate('Y-m-d H:i:s');
                        $this->comman_model->general_notifications_insert($notification_data);
                    }
                }
            $msg ='Work flow Successfully updated to this '.$details->form_name.' form';
            $this->session->set_flashdata('SucMessage', $msg);
            redirect(base_url().'workflow', 'refresh');

            }
        }
        /* Get Form Workflow */
        if($hierarchy_id){
            $workflow = $this->form_model->get_form_hierarchy_position($hierarchy_id,$form_id);
            $users = $this->form_model->user_forms($form_id,$hierarchy_id);
            if(is_array($users) && count($users) > 0){
                foreach($users as $key=>$value){
                    $formusers[] = $value['user_id']; 
                }
            }else{
                $formusers = '';
            }
            $form_location = $this->form_model->get_form_location_name($form_id,$hierarchy_id);
            if(is_array($form_location) && count($form_location) > 0){
                foreach($form_location as $key=>$value){
                    $formlocation[] = $value['location_id']; 
                }
            }else{
               $msg ='No Location is associated with the '.$details->form_name.' form.Please check location is active or not';
                $this->session->set_flashdata('ErrorMessage', $msg);
                redirect(base_url().'workflow', 'refresh');  
            }
            $loc_users = $this->comman_model->location_users_list(implode(",",$formlocation));
            $formcategory = $this->form_model->get_form_category_name($form_id,$hierarchy_id);
            if($formcategory == ''){
                  $msg ='No category is associated with the '.$details->form_name.' form.Please check category is active or not';
                $this->session->set_flashdata('ErrorMessage', $msg);
                redirect(base_url().'workflow', 'refresh');  
            }
            $data['formcategory'] = $formcategory->category_name;
            $data['formlocation'] = $formlocation;
            $data['workflow'] = $workflow;
            $data['formusers'] = $formusers;
            $msg = $this->check_workflow_has_user($formlocation);
            if($msg != ''){
                $this->session->set_flashdata('ErrorMessage', $msg);
                redirect(base_url().'workflow', 'refresh');
            }
            $role_id = $this->role_model->get_review_roles($org_id);
            $review_users = $this->user_model->review_role_user($role_id,$org_id);
            foreach($review_users as $key=>$value){
                $review_level_user[] = $value['id'];
            } 
            /* Get organization user based upon the organization id */
            //$org_user = $this->organization_model->org_users($org_id);
            $authorised_to_report = array();
            $authorised_to_approve = array();
            //foreach($org_user as $key=>$value){
            foreach($loc_users as $key=>$value){
                /* Review Permission users */
                if(in_array($value['id'],$review_level_user)){
                    $authorised_to_approve[$key]['id'] = $value['id'];
                    $authorised_to_approve[$key]['name'] = $value['name'];
                }else{
                /* Non Reviewed user */
                    $authorised_to_report[$key]['id'] = $value['id'];
                    $authorised_to_report[$key]['name'] = $value['name'];
                }
            }
        }else{
            $hierarchy_id = 0;
            $data['formcategory'] = '';
            $data['formlocation'] = '';
            $data['workflow'] = '';
            $data['formusers'] = '';
        }
        $data['form_name'] = $details->form_name;
        $data['org_id'] = $org_id;
        $data['form_id'] = $form_id;
        $data['hierarchy_id'] = $hierarchy_id;
        $data['going_to_report_user'] = $authorised_to_report;
        $data['going_to_approve_user'] = $authorised_to_approve;
        $this->load->view('header', $data);
        $this->load->view('form/workflow', $data);
        $this->load->view('footer');
    }
    public function preview(){
        $uuid= $this->input->get('id');
        $form_hierarchy = $this->form_model->check_hierarchy_id_uuid_exists($uuid);
        if(empty($form_hierarchy)){
            redirect(base_url().'error');
        }
        $org_id = $this->session->userdata('org_id');
        $hierarchy_id = $form_hierarchy['id'];
        $form_id = $form_hierarchy['form_id'];
        /* check form has inactive */
        $status = $this->form_model->check_form_status($form_id);
        //echo $status;exit;
        if(!$status){
            echo 'Form is inactive Please set workflow then only the form will be active ';
            exit;   
        }
        if($hierarchy_id){
            $workflow = $this->form_model->get_form_hierarchy_position($hierarchy_id,$form_id);
            $users = $this->form_model->user_forms($form_id,$hierarchy_id);
            if(is_array($users) && count($users) > 0){
                foreach($users as $key=>$value){
                    $formusers[] = $value['user_id']; 
                }
            }else{
                $formusers = '';
            }
            $form_location = $this->form_model->get_form_location_name($form_id,$hierarchy_id);
            foreach($form_location as $key=>$value){
                $formlocation[] = $value['location']; 
            }
            $form_details = $this->form_model->form_details($form_id);
            //$loc_users = $this->comman_model->location_users_list(implode(",",$formlocation));
            $formcategory = $this->form_model->get_form_category_name($form_id,$hierarchy_id);
            $data['formcategory'] = $formcategory->category_name;
            $data['formlocation'] = $formlocation;
            
            $data['formusers'] = $formusers;
            $user_id = array();
            $workflows = $workflow;

            foreach($workflow as $key=>$value){
                $user_id[] = $value['user_id'];
            }
            /* User details */
            $details = $this->user_model->get_list_user_details($user_id);
            foreach($details as $key=>$value){
                $user_details[$value['id']]=$value;
            }
            foreach($workflow as $key=>$value){
                if((!empty($user_details[$value['user_id']]['imgname']) && file_exists(THUMB_IMAGE_PATH.$user_details[$value['user_id']]['imgname']))){
                    $workflows[$key]['profile'] = $user_details[$value['user_id']]['imgname'];
                }else{
                    $workflows[$key]['profile'] = 'user.png';
                }
                $workflows[$key]['rolename'] = $user_details[$value['user_id']]['role_name'];
            }
            
            $data['org_id'] = $org_id;
            $data['form_id'] = $form_id;
            $data['form_details'] = $form_details;
            $data['hierarchy_id'] = $hierarchy_id;
            $data['workflow'] = $workflows;
            $this->load->view('form/preview_workflow', $data);
        }
    }
}