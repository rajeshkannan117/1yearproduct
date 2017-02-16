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
include APPPATH . 'controllers/OAuth.php';
include APPPATH . 'controllers/common.php';
class Form extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('comman_model');
        $this->load->model('category_model');
		$this->load->model('form_model');
		$this->load->model('department_model');
		$this->load->model('category_model');
        $this->load->language('menu');
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
        $user_id = $this->session->userdata('user_id');
        $this->fieldmaster = $this->form_model->get_fieldmaster();
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
                  redirect(base_url().'error');  
                }
                break;
            case 'create':
                if(!in_array('create',$this->roles['forms'])){
                  redirect(base_url().'error');  
                }
                break;
            case 'edit_detail':
                if((!in_array('update',$this->roles['forms'])) && (!in_array('create',$this->roles['forms']))){
                     redirect(base_url().'error');
                }
                break;
            case 'edit_form':
                if((!in_array('update',$this->roles['forms'])) && (!in_array('create',$this->roles['forms']))){
                     redirect(base_url().'error');
                }
                break;
            case 'delete':
                if(!in_array('delete',$this->roles['forms'])){
                     redirect(base_url().'error');
                }
                break;
            case 'index':
                if(!in_array('read',$this->roles['forms'])){
                    redirect(base_url().'error');
                }
            default:
                break;
        }
		$this->load->helper('date');	
	}
	public function index()
	{
		$data['ErrorMessages'] = '';
		$data['siteTitle']     = 'Forms ' . SITE_NAME;
		//$data['list'] = $this->form_model->form_list();
		$user_id = $this->session->userdata('user_id');
		$forms = $this->form_model->form_list();
               // print_r($forms);
		$user_form = $this->form_model->user_form();
		/*foreach($forms as $key=>$value){
			/*if($value->created_by != $user_id || in_array($value->form_id,$user_form)){
				unset($forms[$key]);
			}else{
				if($value->created_by === $user_id){
					$forms[$key]->action = 'all';
				}else{
					$forms[$key]->action = 'view';
				}
			}*/
		//}
        $data['roles'] = $this->roles['forms'];
        $data['menu'] = $this->roles;
        $data['user_id'] = $this->session->userdata('user_id');
		$data['list'] = $forms;
		$this->load->view('header', $data);
		$this->load->view('form/list', $data);
		$this->load->view('footer');

	}
    public function add(){
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'Forms ' . SITE_NAME;
        $data['menu'] = $this->roles;                
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        if (($this->input->server('REQUEST_METHOD') == 'POST')){
            $form_name = trim($this->input->post('form_name'));
            $form_desc = $this->input->post('form_desc');
            $org_id = $this->input->post('org_id');
            $config = array(array('field' => 'form_name','label' => 'Form Name','rules' => 'trim|required'),
            );
            $form_data = json_encode(cryptoJsAesDecrypt('', $_POST["formToken"])); 
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $response_email = '';
            if($this->form_validation->run() !== FALSE){
                $forms = array(
                    'form_name' => $form_name,
                    'form_desc' => $form_desc,
                    'default'   => '1',
                    'status'   => '1',
                    'org_id' => $org_id
                );
                $form_id = $this->form_model->form_add_step_1($forms);
                /* 
                    Save form data into  form fields table 
                    Before that check into form_field_table whether form id is present in
                    the table or not
                */
                $form_field_data_details=$this->form_model->form_field_data_details($form_id);
                if(empty($form_field_data_details))
                {
                    /*
                        Insert all individual form field into tbl_form_fields_data table 
                    */
                    $form_content = $this->insertFormContent($form_data,$form_id);
                    //echo json_encode($form_content); exit;
                }
                else
                {
                    /*
                        Update and Insert all indivual form field into tbl_form_fields_data table 
                    */
                $form_field_data_all=$this->form_model->form_field_data_details_all($form_id);
                $form_content = $this->insertUpdateFormContent($form_data,$form_field_data_all,$form_id);
                }
                 $data = array(
                            'form_id' => $form_id,
                            'form_content' => json_encode($form_content),
                        );
                $delete = $this->input->post('delete_content');
                $delete_content = json_decode($delete);
                if(!empty($delete_content->fields) || !empty($delete_content->options)){
                    $this->delete_fields($delete_content->fields);
                    $this->delete_options($delete_content->options);
                }
                // $this->form_model->form_location($form_id,$location);
                 $result=$this->form_model->form_add_step_2($data);
                // if($assign_to === 'department'){
                //     $department = $this->input->post('department');
                //     foreach($department as $key=>$value){
                //     $list_user = $this->department_model->get_department_users($value,$org_id);
                //         foreach($list_user as $u=>$user){
                //             $users[] = $user['user_id'];
                //         }
                //     }
                //     $users[] = $user_id;
                //     //$this->form_model->form_dept($dept,$form_id);
                // }else if($assign_to === 'user'){
                //     $users = $this->input->post('user');
                // }

                // $users = array_unique($users);
                // //print_r($_POST); exit;
                // $this->form_model->form_users($users,$form_id);
                if($result){
                    if($org_id != 1){
                        /* Get organization name from the organization table */
                    $org_details = $this->organization_model->organization_details($org_id);
                        
                        $msg ='Form Successfully added to the '.$org_details[0]['org_name'].' Organization';
                    }
                    else{
                        $msg='Form Successfully added';   
                    }
                    $this->session->set_flashdata('SucMessage', $msg);
                    redirect(base_url().'form/', 'refresh');
                }
            }
        }
        $categories = array();
        $org_id = $this->session->userdata('org_id');
        /* 
            Organization id is 1 means we have to show all organization 
            Because organization id 1 meanse super admin of formpro
        */
        
        if($org_id == 1){
                /* If organization id is not present then set category as empty */
            $organization = $this->organization_model->org_list($org_id);
            $data['organizations'] = $organization;
            $cat_not_in = "''";
            $org_domain_ids = "''";
            $system_default = 0;
        }else{
            /* 
                Organization id other than 1 Get those organization related info
                department and category and users and location
             */
            if($org_id != 1)
            {
                $org_info = $this->comman_model->getorg_domain_info($org_id);
                if($org_info->org_cat_not_in ==''){
                    $cat_not_in = "''";
                }else{
                    $cat_not_in = $org_info->org_cat_not_in;
                }
                $system_default = $org_info->system_default;
                $org_domain_ids = $org_info->domain_ids;
                
            }
        }
        $data['org_id'] = $org_id;
        $this->load->view('header', $data);
        $this->load->view('form/add', $data);
        $this->load->view('footer');
    }
    public function workflows(){
        $data['menu'] = $this->roles;
        $data['siteTitle'] ='Work Flows';
        $data['roles'] = $this->roles['workflows'];
        $org_id = $this->session->userdata('org_id');
        $data['org_id'] = $org_id;
        $data['user_id'] = $this->session->userdata('user_id');
        $forms = $this->form_model->form_list();
        $data['forms'] = $forms;
        $this->load->view('header', $data);
        $this->load->view('form/workflows', $data);
        $this->load->view('footer');
    }
    public function workflow($form_id = null){
        $data['menu'] = $this->roles;
        $data['siteTitle'] ='Work Flow';
        $categories = array();
        $org_id = $this->session->userdata('org_id');
        $details = $this->form_model->form_details($form_id);
        $forms = $this->form_model->form_list();
        $data['forms'] = $forms;
        if ((isset($_POST['workflow']) && $_POST['workflow'] === 'workflow')){
            $location = $this->input->post('location_id');
            $category = $this->input->post('category');
            $report = $this->input->post('report');
            $form_id = $this->input->post('form_id');
            $org_id = $this->input->post('org_id');
            $hierarchy_id = $this->input->post('hierarchy_id');
            
            if(empty($hierarchy_id)){
                $hierarchy_id = $this->form_model->form_hierarchy_insert($form_id);
                /* Assign Form to Multiple Location */
                $this->form_model->form_location($form_id,$location,$hierarchy_id);
                /* Assign Form to category */
                $this->form_model->form_category($category,$form_id,$hierarchy_id);
                /* Assign Form to Multiple User */
                foreach($report['report'] as $key=>$value){
                    if(is_array($value['users'])) {
                        $value['users'][]=$details->created_by;
                        $this->form_model->form_users($value['users'],$form_id,$hierarchy_id);
                    }
                    if(isset($value['approve']) && $value['approve'] != ''){
                        $approve[] =$value['approve'];
                    }                
                }
                $this->form_model->form_hierarchy_position_insert($approve,$form_id,$hierarchy_id);

            }else if($hierarchy_id != ''){
                /* Assign Form to Multiple Location */
                $this->form_model->form_location($form_id,$location,$hierarchy_id);
                /* Assign Form to category */
                $this->form_model->form_category($category,$form_id,$hierarchy_id);
                /* Assign Form to Multiple User */
                foreach($report['report'] as $key=>$value){
                    if(is_array($value['users'])) {
                        $value['users'][]=$details->created_by;
                        $this->form_model->form_users($value['users'],$form_id,$hierarchy_id);
                    }
                    if(isset($value['approve']) && $value['approve'] != ''){
                        $approve[] =$value['approve'];
                    }
                }
                $this->form_model->form_hierarchy_position_insert($approve,$form_id,$hierarchy_id);
            }
            $msg ='Work flow Successfully updated to this '.$details->form_name.' form';
            $this->session->set_flashdata('SucMessage', $msg);
            redirect(base_url().'form/', 'refresh');
        }
        if($org_id != 1)
        {
            $org_info = $this->comman_model->getorg_domain_info($org_id);
            if($org_info->org_cat_not_in ==''){
                $cat_not_in = "''";
            }else{
                $cat_not_in = $org_info->org_cat_not_in;
            }
            $system_default = $org_info->system_default;
            $org_domain_ids = $org_info->domain_ids;
            $org_domain = $this->comman_model->getDomainlist_org($org_id);
            $orgdomain_arr = array();
            foreach ($org_domain as $key => $value) {
                $orgdomain_arr[] = $value['domain_id'];
            }
            $orgdomain_in = implode(',', $orgdomain_arr);
            if($org_domain_ids=='')
            {
                $org_domain_ids = "''";
            }
            $org_info = $this->comman_model->getorg_info($org_id);
            if($org_info->org_dept_not_in=='')
            {
                $dept_not_in = "''";
            }else{
                $dept_not_in = $org_info->org_dept_not_in;
            }
        }else{
            $orgdomain_in = "''";
        }
        /* Get Organization Location */
        $data['location'] = $this->user_model->get_organization_location($org_id);
        /* Get Organization Department */
        $data['department'] = $this->department_model->department_list($org_id,$dept_not_in,$orgdomain_in,$system_default);
        /* Get organization related category list parameters based upon organization id */
        $list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
        foreach($list as $key=>$value){
            $categories[$value['cat_id']] = $value['category_name'];
        }
        /* Get organization user based upon the organization id */
        $org_user = $this->organization_model->org_users($org_id);
        $authorised_to_report = array();
        $authorised_to_approve = array();
        foreach($org_user as $key=>$value){
            /*user_post 3 means authorized higher post user*/
            if($value['user_post'] === '3' || $value['user_post'] === '4'){
                $authorised_to_approve[$key]['id'] = $value['id'];
                $authorised_to_approve[$key]['name'] = $value['firstname'].' '.$value['lastname'];
            }
            /*user post 5 means staff users*/
            if($value['user_post'] === '5'){
                $authorised_to_report[$key]['id'] = $value['id'];
                $authorised_to_report[$key]['name'] = $value['firstname'].' '.$value['lastname'];
            }
        }
        /* Get Form Workflow */
        $hierarchy_id = $this->form_model->get_form_hierarchy($form_id);
        if($hierarchy_id){
           // echo $hierarchy_id;exit;
            $workflow = $this->form_model->get_form_hierarchy_position($hierarchy_id,$form_id);
            $users = $this->form_model->user_forms($form_id,$hierarchy_id);
            //print_r($users);
            foreach($users as $key=>$value){
                $formusers[] = $value['user_id']; 
            }
            $form_location = $this->form_model->get_form_location($form_id,$hierarchy_id);
            foreach($form_location as $key=>$value){
                $formlocation[] = $value['location_id']; 
            }
            $form_category = $this->form_model->get_form_category($form_id,$hierarchy_id);
            foreach($form_category as $key=>$value){
                $formcategory[] = $value['cat_id']; 
            }
            $data['formcategory'] = $formcategory;
            $data['formlocation'] = $formlocation;
            $data['workflow'] = $workflow;
            $data['formusers'] = $formusers;

        }else{
            $hierarchy_id = 0;
            $data['formcategory'] = '';
            $data['formlocation'] = '';
            $data['workflow'] = '';
            $data['formusers'] = '';
        }
        $data['org_id'] = $org_id;
        $data['form_id'] = $form_id;
        $data['hierarchy_id'] = $hierarchy_id;
        $data['going_to_report_user'] = $authorised_to_report;
        $data['going_to_approve_user'] = $authorised_to_approve;
        $data['categories'] = $categories;
        //print_r($data);exit;
        $this->load->view('header', $data);
        $this->load->view('form/workflow', $data);
        $this->load->view('footer');
    }
    public function report_user(){
        $current_user_id = $this->input->post('id');
       // print_r($current_user_id);
        $org_id = $this->input->post('org_id');
        $level = $this->input->post('level');
        $level++;
        $current_user_id = array_filter($current_user_id);
        //echo end($current_user_id);
        $user = $this->user_model->get_user_details(end($current_user_id),$org_id);
        $going_to_approve_user = $this->user_model->get_approve_level_users($current_user_id,$org_id);
        /*$report_user = '<div class="uk-grid" data-uk-grid-margin id="level_'.$level.'">
                        <div class="uk-width-medium-1-3">
                            <div id="user" style="">;';
        $report_user .= '<label for="val_select" >User going to <span class="req">*</span></label><br/>
                            <input type="text" disabled="" value="" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div id="approve" style="">
                                <label for="val_select" >Select Authority  <span class="req">*</span></label><br/>
                                    <select id="authority" name="authority[]" class="authority" required  placeholder="Select Authority...">';
                                        if(count($going_to_approve_user) < 1){
        $report_user .='                     <option value="2"> Will Approve </option>';
                                        }else{
        $report_user .='                     <option value="1"> Reporting_to </option>
                                             <option value="2"> Will Approve </option>';
                                        }
        $report_user .='            </select>
                            </div>
                        </div>';
                         if(count($going_to_approve_user) < 1){
        $report_user .= '<div>';
                        }else{
        $report_user .= '<div class="uk-width-medium-1-3">
                            <div id="authorized_user" style="">
                                <label for="val_select" >Authorized User  <span class="req">*</span></label><br/>
                                <select id="approve_user" name="approve_user[]" class="authorized_user" required  placeholder="Select Authorized User">
                                    <option value=""> </option>';
                                        foreach($going_to_approve_user as $key=>$value){
        $report_user .='                    <option value="'.$value['id'].'">
                                               '.$value['name'].'
                                            </option>';
                                        }
        $report_user .='        </select>
                            </div>
                        </div>
                        </div>';
                        }*/
        
        echo json_encode($going_to_approve_user).'?^'.$user->name.'?^'.$user->id; exit;
    }
    public function edit($form_id = null){
        $data['menu'] = $this->roles;
        $data['siteTitle'] ='Edit Form';
        $details = $this->form_model->form_details($form_id);
        if (($this->input->server('REQUEST_METHOD') == 'POST')){
            $form_name = trim($this->input->post('form_name'));
            $form_desc = $this->input->post('form_desc');
            //$users = $this->input->post('users');
            $created_by = $this->input->post('created_by');
            //$form_id = $this->input->post('form_id');
            //$category = $this->input->post('categories');
            /*if(isset($_POST['default'])){
                $default = $this->input->post('default');
            }
            else{
                $default = 0;
            }*/
            $form_data = json_encode(cryptoJsAesDecrypt('', $_POST["formToken"])); 
            $delete = json_encode(cryptoJsAesDecrypt('', $_POST["form_delete_token"])); 
            $users[] = $created_by;
            $status = $this->input->post('status');
            //$columns = $this->input->post('form_column');
            $config = array(array('field' => 'form_name','label' => 'Form Name','rules' => 'trim|required'));
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run() == FALSE){
            }else{
                $forms = array(
                    'form_name' => $form_name,
                    'form_desc' => $form_desc,
                    'form_id' =>$form_id,
                    'status' =>$status,
                    'default' => $default
                );
                $res = $this->form_model->form_update_step_1($forms);
                /*$this->form_model->form_category($category,$form_id);
                $this->form_model->form_users($users,$form_id);*/
                /* 
                    Save form data into  form fields table 
                    Before that check into form_field_table whether form id is present in
                    the table or not
                */
                $form_field_data_details=$this->form_model->form_field_data_details($form_id);
                if(empty($form_field_data_details))
                {
                    /*
                        Insert all individual form field into tbl_form_fields_data table 
                    */
                    $form_content = $this->insertFormContent($form_data,$form_id);
                    //echo json_encode($form_content); exit;
                }
                else
                {
                    /*
                        Update and Insert all indivual form field into tbl_form_fields_data table 
                    */
                     $form_content = $this->insertUpdateFormContent($form_data,$form_id);
                }
                $data = array(
                    'form_id' => $form_id,
                    'form_content' => json_encode($form_content),
                );
                $delete_content = json_decode($delete);
                if(!empty($delete_content->fields) || !empty($delete_content->options)){
                    $this->delete_fields($delete_content->fields);
                    $this->delete_options($delete_content->options);
                }
                $result=$this->form_model->form_update_step_2($data);
                if($result){
                    if($org_id != 1){
                        /* Get organization name from the organization table */
                    $org_details = $this->organization_model->organization_details($org_id);
                        $msg ='Form Successfully Edited to the '.$org_details[0]['org_name'].' Organization';
                    }
                    else{
                        $msg='Form Successfully added';   
                    }
                    $this->session->set_flashdata('SucMessage', $msg);
                    redirect(base_url().'form/', 'refresh');
                }
                redirect(base_url().'form/edit_form/'.$form_id);
            }
        }
        $org_id = $this->session->userdata('org_id');
        if($org_id != 1)
        {
            $org_info = $this->comman_model->getorg_domain_info($org_id);
        
                if($org_info->org_cat_not_in==''){
                    $cat_not_in = "''";
                }else{
                    $cat_not_in = $org_info->org_cat_not_in;
                }
        
            $system_default = $org_info->system_default;
        
            $org_domain_ids = $org_info->domain_ids;
            
            if($org_domain_ids=='')
            {
                $org_domain_ids = "''";
            }
        }  else {
                $organization = $this->organization_model->org_list($org_id);
                $data['organizations'] = $organization;
                $cat_not_in = "''";
                $org_domain_ids = "''";
                $system_default = 0;
        }
        $list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
        //$categories = array();
        /*foreach($list as $key=>$value){
                $categories[$value['cat_id']] = $value['category_name'];
        }*/
        $data['categories']= $list;
        $form_categories = array();
        $form_category = $this->form_model->form_category_list($form_id,$org_id);
        foreach($form_category as $key=>$value){
            $form_categories[]=$value['cat_id'];
        }
        //print_r($form_categories); exit;
        $data['sel_categories'] = $form_categories;
        $columns = $this->form_model->form_columns($form_id);
        $org_user = $this->organization_model->org_users($org_id);
        $data['users'] = $org_user;
       // print_r($org_user); exit;
        $sel_users = $this->form_model->form_users_list($form_id);
       // print_r($sel_users); exit;
        //$form_users = array();
        foreach($sel_users as $key=>$value){
            $form_users[]=$value['user_id'];
        } 
        //$data['form_users']=$form_users;
        $data['user_id'] = $this->session->userdata('user_id');
        /* Check Default option is Selected for any roles */
        //$data['default_option'] = $this->comman_model->check_default('form_details','form_id');
        //print_r($details); exit;
        $data['org_id'] = $org_id;
        $data['selected_org_id'] = $details->org_id;
        $data['form_id'] = $form_id;
        $data['details'] = $details;
        $data['columns'] = $columns;
        $this->load->view('header',$data);
        $this->load->view('form/edit', $data);
        $this->load->view('footer');

    }
    public function delete($form_id = null){
        $resultvalue = $this->form_model->form_delete($form_id);
        if($resultvalue){
            $result['msg']='Form Successfully Deleted';
        }
        $this->session->set_flashdata('SucMessage', $result['msg']);
        redirect(base_url().'form/', 'refresh');

    }
    public function reviews(){
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'Form Review' . SITE_NAME;
        $data['menu'] = $this->roles;
        $data['roles'] = $this->roles['review'];           
        $user_id = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');
        $details = $this->form_model->get_form_hierarchy_list($user_id);
        if(isset($details)){
            foreach($details as $key=>$value){
                if($value['sort_id'] != 0){
                    $ids = $this->form_model->get_previous_user_hierarchy($value);
                    $id = explode('#',$ids);
                   /* if(array_values($id))
                    {   
                        $previous_hierarchy_id[key($id)] = array_values($id);
                    }*/
                    /* 
                        id[0] as user_id 
                        id[1] as form_id
                    */
                    if($id[0]){
                       $previous_hierarchy_user_id[] = $id[0]; 
                       $previous_hierarchy_form_id[] = $id[1];
                    }
                }else{
                    //$sort_zero_id[$value['form_id']] = $value['user_id'];
                    $sort_zero_id[] = $value['user_id'];
                    $sort_form_id[] = $value['form_id'];
                }
            }
            if(isset($previous_hierarchy_user_id)){
                $previous_hierarchy_user_id = array_unique($previous_hierarchy_user_id);
                $previous_hierarchy_form_id = array_unique($previous_hierarchy_form_id);
                $previous_hierarchy_submission_result = $this->form_model->get_previous_hierarchy_submission_data($previous_hierarchy_user_id);    
                if(isset($previous_hierarchy_submission_result)){
                    foreach($previous_hierarchy_submission_result as $key=>$value){
                       /* if(isset($value['submission_id'])){
                            $submission_id[] = $value['submission_id'];
                        }else{
                            $submission_id[] = '';
                        }*/
                        if(isset($value['submission_id'])){
                            $previous_hierarchy_ids[$value['submission_id']][$value['user_id']] =  $value['status'];
                        }
                    }
                }
            }

            if(isset($sort_zero_id)){
                $sort_zero_id = array_unique($sort_zero_id);
                $intital_sort_hierarchy_submission_result = $this->form_model->intital_sort_hierarchy_submission_data($sort_zero_id);
                //print_r($intital_sort_hierarchy_submission_result);exit;
                if(isset($intital_sort_hierarchy_submission_result)){
                    foreach($intital_sort_hierarchy_submission_result as $key=>$value){
                        /*if(isset($value['submission_id'])){
                            $submission_id[] = $value['submission_id'];
                        }else{
                            $submission_id[] = '';
                        }*/
                        if(isset($value['submission_id'])){
                            $submission_id[] = $value['submission_id'];
                            //$previous_hierarchy_ids[$value['submission_id']][$value['user_id']] =  $value['status'];
                        }
                    }
                }
            }
            $my_review_submission = $this->form_model->form_review_submission_id($user_id);            
            if(is_array($my_review_submission) && count($my_review_submission) > 0){
                foreach($my_review_submission as $key=>$value){
                    $my_review_submission_id[] = $value['submission_id'];
                }
                if(isset($my_review_submission_id)){
                    $review_submission_status = $this->form_model->form_review_submission_status($my_review_submission_id);
                    foreach($review_submission_status as $key=>$value){
                        if($value['status'] != '0' && $value['user_id'] == $user_id){
                            $submission_id[] = $value['submission_id'];
                        }
                        //$review_submission_user_status[$value['submission_id']][$value['user_id']] = $value['status'];
                    }
                }
            }
            if(isset($previous_hierarchy_ids)){
                foreach($previous_hierarchy_ids as $key=>$value){
                    $keys = array_keys($value);
                    $last_key = end($keys);
                    $last_value = end($value);
                    //echo $last_value.'--'.$last_key;
                    if($last_value === '1'){
                        $submission_id[] = $key; 
                    }else{
                        $submission_id[] = '';
                    }
                    //$rearrange_previous_hierachy_submission_status[$key][$last_key] = $last_value;
                }
            }
            if(isset($submission_id)){
                if(is_array($submission_id) & count($submission_id) > 0){
                    $submission_id = array_filter($submission_id);
                    $list = $this->form_model->form_review_waiting_approval_lists($submission_id,$user_id);
                }else{
                    $list = '';
                }
            }
            else{
                $list = '';
            }

        }else{
            $list = '';
        }
        $data['details'] = $list;
        $this->load->view('header',$data);
        $this->load->view('form/review_list', $data);
        $this->load->view('footer');
    }
    public function review($submission_id){
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'Form Review' . SITE_NAME;
        $data['menu'] = $this->roles;
        $data['roles'] = $this->roles['review'];           
        $user_id = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');
        $userid = $this->session->userdata('user_id');
        $details = $this->form_model->form_submission_details($submission_id);
        $contents = $details[0]['submission'];
        $form_id = $details[0]['form_id'];
        $form_details = $this->form_model->form_details($form_id);

        /* Get Comments for the fileds */
        $result_comments = $this->form_model->get_comments($submission_id);
        foreach($result_comments as $key=>$value){
            if(!isset($comments[$value['form_field_id']])) {
                    $comments[$value['form_field_id']] = array();
                    $index = 0;
                }
            $comments[$value['form_field_id']][$index]['comment_id'] = $value['comment_id']; 
            $comments[$value['form_field_id']][$index]['comments'] = $value['comments']; 
            $comments[$value['form_field_id']][$index]['created_by'] = $value['name'];
            $index++;
        }
        if(isset($comments)){
            $data['comments'] = $comments; 
        }else{
            $data['comments'] = '';
        }
        /*Get User form info text */
        $submission = $this->form_model->user_submission_data($submission_id);
        foreach($submission as $key=>$value){
            $submission_data[$value['form_field_id']] = $value['user_form_info_text_id'];
        }
        /* Get Review submission status */
        $status = $this->form_model->form_review_status($user_id,$submission_id,$form_id);
        $user = $this->user_model->get_user_details($user_id,$org_id);
        $data['status'] = $status;
        $data['name'] = $user->name;
        $data['submission_data'] = $submission_data;
        $data['submission_id'] = $submission_id;
        $data['contents'] = $contents;
        $data['formname'] = $form_details->form_name;
        $data['user_id'] = $userid;
        $this->load->view('header',$data);
        $this->load->view('form/review', $data);
        $this->load->view('footer');
    }
    public function review_submission()
    {
        $actions = array(
            'Accepted'=>'1',
            'Rejected' => '2',
            'Reassigned' => '3'
            );
        if(isset($_POST['action'])){
            $submission_id = $this->input->post('submission_id');
            $comments = $this->input->post('comments');
            $action = $this->input->post('action');
            $user_id = $this->session->userdata('user_id');
            $status = $actions[$action];
            foreach($comments as $key=>$value){ 
                if($value != ''){
                    $fields = explode('_',$key);
                    $user_form_info_text_id = $fields[0];
                    $formfieldid = $fields[1];
                    $store = array(
                        'comments' => $value,
                        'submission_id' => $submission_id,
                        'user_form_info_text_id' => $user_form_info_text_id,
                        'created_by' => $user_id,
                        'created_date' => gmdate(date('Y-m-d h:i:s'),time())
                        );
                    $comment_id = $this->form_model->save_review_comments($store);
                    $this->form_model->update_comment_id_user_form_info_text($comment_id,$submission_id,$user_form_info_text_id);
                    $comments_fields[$formfieldid] = $value;
                }
            }
            $submission = $this->form_model->form_submission_details($submission_id);
            $submission_details = json_decode($submission[0]['submission']);
            $submitted_user_id = $submission[0]['user_id'];
            $submitted_org_id = $submission[0]['org_id'];
            $form_id = $submission[0]['form_id'];
            foreach($submission_details->fields as $p=>$page){
                foreach($page as $r=>$row){
                    foreach($row as $c=>$column){
                        if(isset($comments_fields[$column->formfieldid])){
                            $column->comments = $comments_fields[$column->formfieldid];
                            $column->isenabled = '1';
                        }else{
                            $column->comments = '';
                            $column->isenabled = '0';
                        }
                    }
                }
            }
            $submission_details = json_encode($submission_details);
            $this->load->library('email');
            $type = array (
                'mailtype' => 'html',
                'charset'  => 'utf-8',
                'priority' => '1'
               );
            $form = $this->form_model->form_details($form_id);
            $form_name = $form->form_name;
            $data['heading'] = $this->lang->line('form_rejection');
            $data['welcome'] = $this->lang->line('welcome');
            $data['form_name'] = $form_name;
            $this->email->initialize($type);
            $this->email->set_newline("\r\n");
            $this->email->from('no-reply@formpro.com', 'Admin');
            $this->form_model->updates_submission_form_submission($submission_id,$submission_details);
           
            if($status == 1){
                // Approved to get next hierarchy user and send mail
                $details = $this->form_model->get_individual_form_hierarchy_list($form_id);
                foreach($details as $key=>$value){
                    $order[$value['sort_id']] = $value['user_id'];
                }
                $my_sort_order = $this->form_model->get_my_sort_order($user_id,$form_id);
                ++$my_sort_order;
                if(isset($order[$my_sort_order])){
                    /* Alert the next level user  */
                    $next_to_email = $order[$my_sort_order];
                    $user=$this->user_model->get_user_details($next_to_email,$submitted_org_id);
                    $email = $user->email;
                    $name = $user->name;
                    $this->email->to($email);  // replace it with receiver mail id
                    $this->email->subject($this->lang->line('subject_rejected')); // replace it with relevant subject 
                    $body = $this->load->view('emails/rejected.php',$data,TRUE);
                    $this->email->message($body);
                    $this->email->send();
                }else{
                    /* All User reviews finished and changed the submission status to approved */
                    $this->form_model->updates_status_form_submission($submission_id,$status);
                    $user=$this->user_model->get_user_details($submitted_user_id,$submitted_org_id);
                    $email = $user->email;
                    $name = $user->name; 
                    $this->email->to($email);  // replace it with receiver mail id
                    $this->email->subject($this->lang->line('subject_rejected')); // replace it with relevant subject 
                    $body = $this->load->view('emails/rejected.php',$data,TRUE);
                    $this->email->message($body);
                    $this->email->send();
                }
                $this->form_model->approved_review_history($submission_id,$user_id,$status);
            }
            else if($status == 2){
                // Rejected 
                $decline_desc = $this->input->post('decline_desc');
                $data['message'] = $decline_desc;
                $user=$this->user_model->get_user_details($submitted_user_id,$submitted_org_id);
                $email = $user->email;
                $name = $user->name; 
                $this->email->to($email);  // replace it with receiver mail id
                $this->email->subject($this->lang->line('subject_rejected')); // replace it with relevant subject 
                $body = $this->load->view('emails/rejected.php',$data,TRUE);
                $this->email->message($body);
                $this->email->send();
                $this->form_model->decline_form_submission($submission_id,$user_id,$status);
            }
            else if($status == 3){
                // Reassigned
                $users = $this->input->post('users');
                $reassign_users = explode(",",$users);
                $reassign_users = array_filter($reassign_users);
                $reassign_users[] = $submitted_user_id;
                $reassign_users[] = $user_id;
                foreach ($reassign_users as $key => $value) {
                    $user=$this->user_model->get_user_details($value,$submitted_org_id);
                    $to_email[]=$user->email;
                }
                $name = ''; 
                $this->email->to($to_email);  // replace it with receiver mail id
                $this->email->subject($this->lang->line('subject_reassign')); 
                // replace it with relevant subject 
                $body = $this->load->view('emails/reassign.php',$data,TRUE);
                $this->email->message($body);
                $this->email->send();
                $reassign_description = $this->input->post('reassign_desc');
                /* Change reassigned users status */
                $this->form_model->reassign_user_form_status($reassign_users,$submission_id,$form_id,$status);

            }
            $result['msg']='Form Revised Successfully';
            $this->session->set_flashdata('SucMessage', $result['msg']);
            redirect(base_url().'form/reviews','refresh');
        }
    }
    public function reassign($submission_id){
        $user_id = $this->session->userdata('user_id');
        $user = $this->form_model->previous_approved_users($submission_id,$user_id);
        $count = count($user);
        $select = '';
        if($count > 0){        
            $select .='<label>Reassigned to <span class="errors" style="color:crimson;">*</span>
                </label>
                <select id="multiselect_user" required multiple="multiple" data-placeholder="Select Users..." name="users[]">';
            foreach($user as $key=>$value){
                $select.="<option value =".$value["user_id"].'>'.$value["name"].'</option>'; 
            }
            $select.= '</select>';
        }
        echo $select;exit;
    }
     /* Ajax form review  */
	 public function filter_view(){
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $org_id = $this->session->userdata('org_id');
        if(isset($_POST) && $_POST['form_id'] != ''){
            $form_id = $_POST['form_id'];
            $owned_form = $this->form_model->check_owned_form($user_id,$form_id);
            if($owned_form){
                $details = $this->form_model->form_submission_list_owner($form_id);
            }
            else{
                $details = $this->form_model->form_submission_list_user($user_id,$form_id);
            }
            $form = $this->form_model->form_details($form_id);
            $submission_list = $details;
            $contents = json_decode($form->form_content);
            $formname = $form->form_name;
            $preview = '<div class="md-card">
                    <div class="md-card-content large-padding">
                    <h2 class="heading_b uk-margin-bottom">'.$formname.'</h2>';
                        foreach($contents->fields as $p=>$pages){ 
                            foreach($pages as $r=>$rows){
                            $preview .= '<div class="uk-grid">';
                                $count = count($rows);
                                foreach($rows as $c=>$cols){
                                $preview .= '<div class="uk-width-1-'.$count.'">'.
                                        $this->review->generate($cols);
                                $preview .= '</div>';
                                }  
                                $preview .= '</div>';
                            }     
                        }
                    $preview .= '</div>
                </div>';
            $submission_table = '<table class="uk-table" id="dt_default">
                                    <thead>
                                        <tr>
                                            <th class="uk-width-1-10 uk-text-center">#</th>
                                            <th class="uk-width-1-10 uk-text-center">Submitted_by</th>
                                            <th class="uk-width-1-10 uk-text-center">Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>'; 
                                            $i='0'; 
                                        foreach($submission_list as $key=>$value){ 
                                                  $i += 1;
                    $submission_table .='<tr>
                                            <td class="uk-text-center">'.$i.'</td>
                                            <td><a href="'.$value["id"].'">'.$value['submitted_by'].'</a></td>
                                            <td>'.$value['created_at'].'</td>
                                        </tr>';
                                        } 
                    $submission_table .='</tbody>
                                </table>';
            echo $preview.'^%'.$submission_table; exit;
        }
        
    }
    public function report($form_id){
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'Form Review' . SITE_NAME;
        $data['menu'] = $this->roles;                
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $org_id = $this->session->userdata('org_id');
        if($form_id != ''){
        $data['form_id'] = $form_id;
        $owned_form = $this->form_model->check_owned_form($user_id,$form_id);
        if($owned_form){
            $details = $this->form_model->form_submission_list_owner_report($form_id);
        }
        else{
            $details = $this->form_model->form_submission_list_user_report($user_id,$form_id);
        }
        $form = $this->form_model->form_details($form_id);
        $forms = $this->form_model->form_list();
        $data['forms']= $forms;
        $submission_list = array();
        $list = array();
        foreach($details as $key=>$value){
            $list[$value['id']]['submitted_by'] =  $value['submitted_by'];   
            $list[$value['id']]['created_at'] =  $value['created_at'];   
            $lists = $this->form_model->form_submission_data($value['id']);    
                foreach($lists as $k=>$v){
                    $list[$value['id']][$v['question']] = $v['answer'];
                }
        }
        $data['submission_list'] = $list;
        $content = json_decode($form->form_content);
        foreach($content->fields as $p=>$pages){ 
            foreach($pages as $r=>$rows){
                foreach($rows as $c=>$cols){
                    if(isset($cols->fieldtype)){
                        $key = $cols->fieldid.'_'.$cols->formfieldid.'_'.$cols->fieldtype;
                        $fields[$key] = $cols->title;
                        $required[$key][] = $cols->title;
                        $required[$key][] = $cols->required;
                        $columns[] = $cols->title;
                    }
                }
            }
        }
        $data['fields'] = $fields;
        $data['columns'] = $columns;
        $data['required'] = $required;
        $data['filter'] = $this->filter->filter_general();
        //print_r($data);exit;
        $this->load->view('header',$data);
        $this->load->view('form/report', $data);
        $this->load->view('footer',$data);
      } 
        

    }
    public function reports(){
        if(isset($_POST['filter'])){
            $filter = $_POST['filter'];
            $form_id = $_POST['org_forms'];
            $columns = $_POST['columns'];
            $index = 0;
            foreach($filter['filter'] as $key=>$value){
                if(!isset($query[$value['column']])) {
                    $query[$value['column']] = array();
                    $index = 0;
                }
                $query[$value['column']][$index]['condition'] = $value['condition'];
                $query[$value['column']][$index]['data'] = $value['data'];
                $index++;
            }
            $data['filter'] = $query;
            $data['form_id'] = $form_id;
            $submission_list = $this->form_model->filter_search($query,$form_id);
            $submission_count = count($submission_list);
            if($submission_count){
                foreach ($submission_list as $key => $value) {
                    $submission[] = $value['submission_id'];
                }
                $sub_list = array_unique($submission);
                foreach($sub_list as $key=>$value){

                    $lists = $this->form_model->form_submission_data($value);    
                    foreach($lists as $k=>$v){
                        $list[$value][$v['question']] = $v['answer'];
                        $list[$value]['Submitted By'] = $v['submitted_by'];
                        $list[$value]['Created at'] =   $v['created_at'];
                    }
                    /*$list[$value]['submitted_by'] = $lists[0]['submitted_by'];
                    $list[$value]['created_at'] = $lists[0]['created_at'];*/
                }
            }else{
               $list = ''; 
            }
            $filter ='
            <table class="uk-table" id="dt_default">
                <thead>
                    <tr>';
                        foreach ($columns as $key => $value) {

                            $filter.='<th class="uk-width-1-10 uk-text-center">'.$value.'</th>';
                        }
        $filter .= '</tr>
                </thead>
                <tbody>';
                        //$i='0';
                if(is_array($list)){
                    foreach($list as $key=>$value){ 
                              //$i += 1;
 /*                       <td class="uk-text-center">'.$value['submitted_by'].'</td>
                            <td class="uk-text-center">'.$value['created_at'].'</td>
                            && $k !== 'submitted_by' && $k !== 'created_at'
 */
                        $filter.='<tr>
                            <td class="uk-text-center">'.$key.'</td>
                                                       ';
                        foreach($value as $k=>$v){
                            if(in_array($k, $columns)){
                                $filter .='<td class="uk-text-center">'.$v.'</td>';
                            }
                        }

                        $filter .= '</tr>';
                            /*<td class="uk-text-center">'
                                .$list[$value['question_id']][$value['submission_id']].
                            '</td>*/
                    } 
                }
                $filter.='</tbody>
            </table>';  
            echo $filter;exit;          
        }
    }
    public function filter_add(){
        $form_id = $this->input->get('form_id');
        $filter_key = $this->input->get('filter');
        $form = $this->form_model->form_details($form_id);
        $content = json_decode($form->form_content);
        foreach($content->fields as $p=>$pages){ 
            foreach($pages as $r=>$rows){
                foreach($rows as $c=>$cols){
                    if(isset($cols->fieldtype)){
                        $key = $cols->fieldid.'_'.$cols->formfieldid.'_'.$cols->fieldtype;
                        $fields[$key] = $cols->title;
                    }
                }
            }
        }
        $new = '';
        $new .= '<div class="uk-grid advanced_filter" data-filter ="'.$filter_key.'">
                    <div class="uk-width-3-10">
                        <select id="filter" name="filter[filter]['.$filter_key.'][column]" onchange="filter_change(this)">
                            <option value=""> </option>';
                            foreach($fields as $key=>$value){
                                $new.='<option value="'.$key.'">'.$value.'</option>';
                            }
                $new.='</select>
                    </div>';
            $new .= '<div class="uk-width-2-10 condition">';
            $conditions = $this->filter->filter_general();
                $new .= '<select id = "filter_condition" name="filter[filter]['.$filter_key.'][condition]" >';
                        foreach($conditions as $key=>$value){
                            $new .='<option value="'.$key.'">'.$value.'</option>';
                        }

            $new.='</select>
                    </div>
                    <div class="uk-width-3-10 data">
                        <input type="text" name="filter[filter][0][data]" style="width:100px;height:15px;padding-left:15px !important;" id="filter_data" value="" />
                    </div>
                    <div class="uk-width-2-10 action">
                        <span class="addremove">
                            <a class="remove" href="#">
                                <img class="icon" title="" height="14px" width="14px" src="'.base_url().'assets/assets/images/minus.png" alt="">
                            </a>
                            <a class="add" href="#" style="display: inline;">
                                <img class="icon" height="14px" width="14px" title="" src="'.base_url().'assets/assets/images/add2.png" alt="">
                            </a>
                        </span>
                    </div>
                </div>';
       echo $new;exit;
    }
    public function advanced_filter()
    {
        //print_r($_POST);exit;
        $fieldid = $_POST['fieldid'];
        $filter_key = $_POST['key'];
        $filter = $_POST['filter'];
        $count = $_POST['count'];
        $key_split = explode('_',$fieldid);
        $condition = '';
        $data = '';
        if($fieldid === ''){
            $conditions = $this->filter->filter_general();
            $data .= '<input type="text" name="filter[filter]['.$filter_key.'][data]" style="width:100px;height:15px;padding-left:15px !important;" value = ""/>';
         }else{
            if($key_split[0] === '4' || $key_split[0] === '5'){
                $conditions = $this->filter->filter_advanced();
            }else{
                $conditions = $this->filter->filter_general();
            }
            $condition .= '<select id = "filter_condition" name="filter[filter]['.$filter_key.'][condition]" >';
            foreach($conditions as $key=>$value){
                $condition .='<option value="'.$key.'">'.$value.'</option>';
            } 
            $condition .='</select>';
           /* if($count > 1){
                $index = 0;
                foreach($filter['filter'] as $key=>$values){
                    if(!isset($query[$values['column']])) {
                        $query[$values['column']] = array();
                        $index = 0;
                    }
                    if(isset($values['data'])){
                        $query[$values['column']][$index] = $values['data'];
                    }
                    $index++;
                }
               //print_r($query);exit;
            }*/
            if($key_split[2] === '1'){

                $options = $this->form_model->form_options($key_split[1]);
                $data .= '<select id="filter" name="filter[filter]['.$filter_key.'][data]" >';
                    foreach($options as $key=>$value){
                        /*if(isset($query)){
                            if(!(in_array($value['option_name'], $query[$fieldid]))){*/
                                //$data .='<option value = "'.$value['option_name'].'">'.$value['option_name'].'</option>';
                          /*  }
                        }else{*/
                            $data .='<option value = "'.$value['option_name'].'">'.$value['option_name'].'</option>';
                       // }
                    }
                $data .= '<select>';
            }else if($key_split[2] === '2'){
                $data .= '<input type="text" name="filter[filter]['.$filter_key.'][data]" style="width:100px;height:15px;padding-left:15px !important;" value = ""/>';
            }
        }        
        echo $condition.'^%'.$data;exit;
    }
        
        public function org_category(){
            $org_id = $this->input->post('org_id');
            $org_category = $this->organization_model->org_category($org_id);
            $select =' <label>Select Categories <span class="errors" style="color:crimson;">*</span></label><select data-md-selectize required data-placeholder="Select Categories..." name="categories">';
            foreach($org_category as $key=>$value){
               $select.="<option value =".$value["cat_id"].'>'.$value["category_name"].'</option>'; 
            }
            $select.= '</select>';
            echo $select;
            
        }
        public function org_users()
        {
            $org_id = $this->input->post('org_id');
            $org_users = $this->organization_model->org_users($org_id);
            $select =' <label>Select Users <span class="errors" style="color:crimson;">*</span></label><select id="multiselect_users" required multiple="multiple" data-placeholder="Select Users..." name="users[]">';
            foreach($org_users as $key=>$value){
               $select.="<option value =".$value["id"].'>'.$value["firstname"].'</option>'; 
            }
            $select.= '</select>';
            echo $select;
        }

	/* 
		Edit Form Details
	*/

	public function edit_detail($form_id)
    {
        $data['menu'] = $this->roles;
        $data['siteTitle'] ='Edit Form Details';
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			/* First Step Form Save */
			if(isset($_POST) && $_POST['step'] == 1)
			{
				//print_r($_POST); exit;
				$form_name = trim($this->input->post('form_name'));
				$form_desc = $this->input->post('form_desc');
				$form_code = $this->input->post('form_code');
				$users = $this->input->post('users');
                $created_by = $this->input->post('created_by');
				$form_id = $this->input->post('form_id');
				$category = $this->input->post('categories');
				if(isset($_POST['default'])){
					$default = $this->input->post('default');
				}
				else{
					$default = 0;
				}
                $users[] = $created_by;
				$status = $this->input->post('status');
				//$columns = $this->input->post('form_column');
				$config = array(array('field' => 'form_name','label' => 'Form Name','rules' => 'trim|required'),array('field' => 'form_code','label' => 'Form Code','rules' =>'required|min_length[5]|max_length[12]|callback_form_code_validation['.$form_code.','.$form_id.']'));
					
				$this->form_validation->set_rules($config);
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				if($this->form_validation->run() == FALSE){
				}else{
                        $forms = array(
                            'form_name' => $form_name,
                            'form_desc' => $form_desc,
                            'form_code' => $form_code,
                            'columns'  => '3',
                            'form_id' =>$form_id,
                            'status' =>$status,
                            'default' => $default
                        );
					$res = $this->form_model->form_update_step_1($forms);
					$this->form_model->form_category($category,$form_id);
					$this->form_model->form_users($users,$form_id);
					redirect(base_url().'form/edit_form/'.$form_id);
				}
			}

		}
		$details = $this->form_model->form_details($form_id);
		$org_id = $this->session->userdata('org_id');
			//$org_category = $this->organization_model->org_category($org_id);
		 if($org_id!=1)
        {
	 		$org_info = $this->comman_model->getorg_domain_info($org_id);
        
		        if($org_info->org_cat_not_in==''){
		            $cat_not_in = "''";
		        }else{
		            $cat_not_in = $org_info->org_cat_not_in;
		        }
        
			$system_default = $org_info->system_default;
        
		    $org_domain_ids = $org_info->domain_ids;
		    
		    if($org_domain_ids=='')
		    {
		        $org_domain_ids = "''";
		    }
		}  else {
		        $cat_not_in = "''";
		        $org_domain_ids = "''";
		        $system_default = 0;
		}
		$list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
		//$categories = array();
		/*foreach($list as $key=>$value){
		   		$categories[$value['cat_id']] = $value['category_name'];
		}*/
		$data['categories']= $list;
		$form_categories = array();
		$form_category = $this->form_model->form_category_list($form_id,$org_id);
        foreach($form_category as $key=>$value){
            $form_categories[]=$value['cat_id'];
        }
        //print_r($form_categories); exit;
		$data['sel_categories'] = $form_categories;
		$columns = $this->form_model->form_columns($form_id);
		$org_user = $this->organization_model->org_users($org_id);
        $data['users'] = $org_user;
       // print_r($org_user); exit;
        $sel_users = $this->form_model->form_users_list($form_id);
       // print_r($sel_users); exit;
        //$form_users = array();
        foreach($sel_users as $key=>$value){
            $form_users[]=$value['user_id'];
        } 
        $data['form_users']=$form_users;
        $data['user_id'] = $this->session->userdata('user_id');
		/* Check Default option is Selected for any roles */
		//$data['default_option'] = $this->comman_model->check_default('form_details','form_id');
		$data['form_id'] = $form_id;
		$data['details'] = $details;
		$data['columns'] = $columns;
		$this->load->view('header',$data);
		$this->load->view('form/edit_step_1', $data);
		$this->load->view('footer');

	}

	/*
		Form Code Custom Validation 

	 */
	public function form_code_validation($form_code,$form_id){
		$res = $this->form_model->form_code_validation($form_code,$form_id);
		if(!$res){
			 $this->form_validation->set_message('form_code_validation', 'Form Code must be unique');
			 return $res;
		}
		return $res;
	}
	/* 
		Edit the created Form
	*/

	public function edit_form($form_id){

		$details = $this->form_model->form_details($form_id);
		$columns = $this->form_model->form_columns($form_id);
		$data['form_id'] = $form_id;
		$data['content'] = json_decode($details->form_content);
       //print_r($data['content']); exit;
		//$content = json_decode($data['content']);
		//print_r($content); exit;
       //echo $data['content']->fields; exit;
		$data['columns'] = $columns;
                $data['menu'] = $this->roles;
                $data['siteTitle']='Edit Forms';
		$this->load->view('header',$data);
		$this->load->view('form/edit_step_2', $data);
		$this->load->view('footer');

	}

    /* 
        View the form based on formid 

    */
    public function view($form_id){

        $details = $this->form_model->form_details($form_id);

        $data['form_id'] = $form_id;
        $data['siteTitle'] = "Form";
        $data['contents'] = $details->form_content;
        //print_r($details);exit;
        $data['formname'] = $details->form_name;
        $data['formcode'] = $details->form_code;
        $data['roles'] = $this->roles['forms'];
        $data['menu'] = $this->roles;
        $data['user_id'] = $this->session->userdata('user_id');


        if (($this->input->server('REQUEST_METHOD') == 'POST'))
        {
            $option_id = 0;
            $post_values = $this->input->post();
            foreach($post_values as $postkey=>$postvalue){
                $answers[] = $postvalue;
            }
            //print_r($answers);echo "<br>";
            $postvalue = array();
            $form_values = (array)(json_decode($data['contents']));
            $j=0;
            foreach($form_values as $formkey=>$formvalue){
                $i=0;
                
                foreach($formvalue as $key=>$value){

                    foreach($value as $k=>$v){
                        
                        foreach ($v as $field=>$id) {
                            
                            if(isset($id->fieldid)){

                                if(isset($id->choices)){
                                    foreach($id->choices as $op){
                                        
                                        
                                        if($op->value === $answers[$j]){
                                            $op->checked = 1;
                                            $option_id = $op->id;
                                        }
                                    }
                                }
                                else{
                                    if(isset($answers[$j])){
                                        
                                        $id->value = $answers[$j];
                                    }
                                }
                                //Check if offset exists or not
                                if((!isset($answers[$j])) || !$answers[$j]){
                                    //echo "if".$j."<br>";
                                    $j++;
                                    continue;
                                }
                                //echo "else".$j."<br>";
                                $postvalue[] = array('form_field_id'=>$id->fieldid,'user_id'=>$this->session->userdata('user_id'),'form_id'=>$form_id,'answer'=>$answers[$j],'type'=>$id->type,'option_id'=>$option_id);
                               $j++;
                            }
                            
                        }
                        
                       $i++; 
                        
                    }
                    
                }
            }
            //print_r($postvalue);exit;
            $submissiontime = gmdate(date('Y-m-d h:i:s'),time());
            $form_values['description'] = $details->form_desc;
            $form_values['title'] = $details->form_name;
            $json_val = json_encode($form_values);



            $form_submission = array('user_id'=>$this->session->userdata('user_id'),'org_id'=>$this->session->userdata('org_id'),'created_at'=>$submissiontime,'updated_at'=>$submissiontime,'form_id'=>$form_id,'submission'=>$json_val,'token'=>'');
            
                $formdata_result=$this->form_model->formdata_add($postvalue,$form_submission);
                if($formdata_result == true){
                    $result['msg'] = 'Data added successfully ';
                }
                $this->session->set_flashdata('SucMessage', $result['msg']);
                redirect(base_url().'form/view/'.$form_id, 'refresh');
            

        }
        $this->load->view('header',$data);
        $this->load->view('form/view', $data);
        $this->load->view('footer');
    }



    /* 
        View the submissions of form based on formid 

    */
    public function submission_list($formid){
        $userid = $this->session->userdata('user_id');
        $owned_form = $this->form_model->check_owned_form($userid,$formid);
        if($owned_form){
            $details = $this->form_model->form_submission_list_owner($formid);
        }
        else{
            $details = $this->form_model->form_submission_list_user($userid,$formid);
        }
        //$details = $this->form_model->form_submission_list($form_id);
        $data['form_id'] = $formid;
        $data['siteTitle'] = "Form";
        $data['contents'] = $details;
        $data['roles'] = $this->roles['forms'];
        $data['menu'] = $this->roles;
        $data['user_id'] = $userid;
        $this->load->view('header',$data);
        $this->load->view('form/submission_list', $data);
        $this->load->view('footer');
    }


    /* 
        View the submission details of form based on formid 

    */
    public function submission_view($id){

        $details = $this->form_model->form_submission_details($id);
        $data['siteTitle'] = "Form";
        $data['contents'] = $details;
        $data['roles'] = $this->roles['forms'];
        $data['menu'] = $this->roles;
        $data['user_id'] = $this->session->userdata('user_id');
        $this->load->view('header',$data);
        $this->load->view('form/submission_view', $data);
        $this->load->view('footer');
    }



	/* 
		Preview the form which are previously created based on formid 

	*/
	public function preview($form_id){

		$details = $this->form_model->form_details($form_id);
        $userid = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');    
        $data['form_id'] = $form_id;
        $data['org_id'] = $org_id;
		$data['siteTitle'] = "Preview Form";
		$data['contents'] = $details->form_content;
		$data['formname'] = $details->form_name;
		$data['formcode'] = $details->form_code;
		$data['roles'] = $this->roles['forms'];
        $data['menu'] = $this->roles;
        $data['user_id'] = $userid;
        $categories = array();
        /* 
            Organization id is 1 means we have to show all organization 
            Because organization id 1 meanse super admin of formpro
        */
        
        if($org_id == 1){
                /* If organization id is not present then set category as empty */
            $organization = $this->organization_model->org_list($org_id);
            $data['organizations'] = $organization;
            $cat_not_in = "''";
            $org_domain_ids = "''";
            $system_default = 0;
        }else{
            /* 
                Organization id other than 1 Get those organization related info
                department and category and users and location
             */
            if($org_id != 1)
            {
                $org_info = $this->comman_model->getorg_domain_info($org_id);
                if($org_info->org_cat_not_in ==''){
                    $cat_not_in = "''";
                }else{
                    $cat_not_in = $org_info->org_cat_not_in;
                }
                $system_default = $org_info->system_default;
                $org_domain_ids = $org_info->domain_ids;
                if($org_domain_ids=='')
                {
                    $org_domain_ids = "''";
                }
            }
        }
        /* Get organization related category list parameters based upon organization id */
        $list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
        foreach($list as $key=>$value){
            $categories[$value['cat_id']] = $value['category_name'];
        }
        /* Get organization user based upon the organization id */
        $org_user = $this->organization_model->org_users($org_id);
        //print_r($org_user); exit;
        //$org_user = $this->organization_model->org_($org_id);
        /* Get location based on organization */
        $data['location'] = $this->user_model->get_organization_location($org_id);

        /* Get Department for the organization */
        $org_info = $this->comman_model->getorg_info($org_id);
        
        if($org_info->org_dept_not_in=='')
        {
            $dept_not_in = "''";
        }else{
            $dept_not_in = $org_info->org_dept_not_in;
        }
        
        if($org_id!=1)
        {   //echo $org_id;
            $org_domain = $this->comman_model->getDomainlist_org($org_id);
            //print_r($org_domain);
            $orgdomain_arr = array();
            
            foreach ($org_domain as $key => $value) {
                $orgdomain_arr[] = $value['domain_id'];
            }
            $orgdomain_in = implode(',', $orgdomain_arr);
        }else{
            $orgdomain_in = "''";
        }
        $system_default = $org_info->system_default;
        $data['department'] = $this->department_model->department_list($org_id,$dept_not_in,$orgdomain_in,$system_default);
        $data['org_id'] = $org_id;
        $data['users'] = $org_user;
        $data['categories'] = $categories;
		$this->load->view('header',$data);
		$this->load->view('form/preview', $data);
		$this->load->view('footer');
	}

	/* 
		Generate Columns for the Form creation 
	*/
	public function create($form_id = null){

		$data['form_id'] = $form_id;
		$columns = $this->form_model->form_columns($form_id);
                //$field_id = $this->form_model->field_id();
		$data['columns'] = $columns;
		$data['siteTitle'] = 'Form creation';
                $data['menu'] = $this->roles;
		$this->load->view('header',$data);
		$this->load->view('form/add_step_2', $data);
		$this->load->view('footer');

	}
	public function saveform()
	{
            $formid = $this->input->post('form_id');
            $details = $this->form_model->form_details($formid);
            redirect(base_url().'form');
	}
	public function insertUpdateFormContent($content,$form_id)
	{
        $api_fields = array();
        $fields = json_decode($content);
        foreach($fields as $i=>$pages){
            foreach($pages as $p=>$rows){   
                foreach($rows as $r=>$cols){
                    foreach($cols as $key=>$value){
                        if($value != null){
                            $data = array();
                            $data['form_id'] = $form_id;
                            $data['page'] = $p;
                            $data['row'] = $r;
                            $data['col'] = $key;
                            $data['question'] = $value->title;
                            if($value->formfieldid == 0)
                            {
                            $field_type = $this->fieldmaster[$value->fieldid]['field_type'];
                            $value->api_type = $this->fieldmaster[$value->fieldid]['api_type'];
                            $data['field_id'] = $value->fieldid;
                            $this->db->insert('form_fields',$data);
                            $formfieldid = $this->db->insert_id();
                                if($field_type == '1'){
                                    $value = $this->field_options($value, $formfieldid);
                                }
                            $value->formfieldid = $formfieldid;
                            $value->fieldtype = $field_type;
                            }
                            else{
                            $field_type = $this->fieldmaster[$value->fieldid]['field_type'];
                            $value->api_type = $this->fieldmaster[$value->fieldid]['api_type'];
                                $this->db->where('form_fields_id = '.$value->formfieldid);
                                $this->db->update('form_fields',$data);
                                if($field_type == '1'){
                                    $value = $this->field_options($value, $formfieldid);
                                }
                            }
                             if(isset($value->rules) && $value->rules == '-1'){
                                $value->required = '0';
                            }else{
                                $value->required = '1';
                            }
                       }
                    }
                }
            }
        }
        return $fields;
	}
        
	public function insertFormContent($fieldss,$form_id)
	{
            $fields = json_decode($fieldss);
            $api_fields = array();
            foreach($fields as $i=>$pages){
                foreach($pages as $p=>$rows){
                    foreach($rows as $r=>$cols){
                        foreach($cols as $key=>$value){
                           if($value != '' || $value != null){
                                if($value->type != 'submit' && $value->type != 'reset'){
                                $field_type = $this->fieldmaster[$value->fieldid]['field_type'];
                                $value->api_type = $this->fieldmaster[$value->fieldid]['api_type'];
                               // print_r($value); exit;
                                $fielddata['form_id'] = $form_id;
                                $fielddata['page'] = $p;
                                $fielddata['row'] = $r;
                                $fielddata['col'] = $key;
                                $fielddata['field_id'] = $value->fieldid;
                                $fielddata['question'] = $value->title;
                                $this->db->insert('form_fields',$fielddata);
                                $fieldid = $this->db->insert_id();
                                $value->formfieldid = (string)$fieldid;
                                if($field_type == '1'){
                                   $value = $this->field_options($value,$fieldid);
                                }
                                $value->fieldtype =  (string)$field_type;
                                /*if(isset($value->rules) && $value->rules == '-1'){
                                    $value->required = '0';
                                }else{
                                    $value->required = '1';
                                }*/
                                $api_cols[] = $value;
                            }
                         }
                        }
                        $api_rows[$r] = $api_cols;
                    }
                    $api_pages[$p] = $api_rows;
                }
                $api_fields[$i] = $api_pages;
            }
            //$return = array('fields'=>$fields);
            //,'api_type'=>$api_fields
            return $fields;
	}
        public function field_options($value,$fieldid){
            foreach($value->choices as $k=>$v){
                if($v->id == 0){
                    $insert_options = array();
                    $insert_options['form_fields_id'] = $value->formfieldid;
                    $insert_options['option_name'] = $v->title;
                    $insert_options['option_value'] = $v->title;
                    $this->db->insert('form_options',$insert_options);
                    $v->id = (string)$this->db->insert_id();
                }else{
                    $insert_options = array();
                    $insert_options['form_fields_id'] = $value->formfieldid;
                    $insert_options['option_name'] = $v->title;
                    $insert_options['option_value'] = $v->title;
                    $this->db->where('form_option_id',$v->id);
                    $this->db->update('form_options',$insert_options);
                }
            }
            return $value;
        }
        public function field_options_update($value,$fieldid){
           $this->db->select('fields_master_id,fields_type')->from('fields_master fm')->join('form_fields ff','ff.field_id = fm.fields_master_id')->where('ff.form_fields_id = '.$value->fieldid);
           $res = $this->db->get();
           $type = $res->row()->fields_type;
           $fieldmasterid =  $res->row()->fields_master_id;
           $value->api_type = $this->fieldmaster[$fieldmasterid]['api_type'];
           if( $type === '1'){
               /*$option['form_fields_id'] = $fieldid;
               if(isset($value->radio_label)){  
                    foreach($value->radio_label as $k=>$v){
                        $option['option_name'] = $v;
                        $option['option_value'] = $value->radio_value[$k];
                        $optionid = $value->optionid[$k];
                        if($optionid == 0){
                            $this->db->insert('form_options',$option);
                            $choiceid = $this->db->insert_id();
                        }
                        else{
                            $this->db->where('form_option_id',$optionid);
                            $this->db->update('form_options',$option);
                            $choiceid = $optionid;
                        }
                        $choices = array();
                        $choices['checked'] = '0';
                        $choices['id'] = $choiceid;
                        $choices['title'] = $v;
                        $choices['value'] = $value->radio_value[$k];
                        $value->choices[] = $choices;
                    }
                }
                if(isset($value->checkbox_label)){  
                    foreach($value->checkbox_label as $k=>$v){
                        $option['option_name'] = $v;
                        $option['option_value'] = $value->checkbox_value[$k];
                        $optionid = $value->optionid[$k];
                        if($optionid == 0){
                            $this->db->insert('form_options',$option);
                            $choiceid = $this->db->insert_id();
                        }
                        else{
                            $this->db->where('form_option_id',$optionid);
                            $this->db->update('form_options',$option);
                            $choiceid = $optionid;
                        }
                        $choices = array();
                        $choices['checked'] = '0';
                        $choices['id'] = $choiceid;
                        $choices['title'] = $v;
                        $choices['value'] = $value->checkbox_value[$k];
                        $value->choices[] = $choices;
                    }
                }
                   if(isset($value->options_label)){  
                    foreach($value->options_label as $k=>$v){
                        $option['option_name'] = $v;
                        $option['option_value'] = $value->options_value[$k];
                        $optionid = $value->optionid[$k];
                        if($optionid == 0){
                            $this->db->insert('form_options',$option);
                            $choiceid = $this->db->insert_id();
                        }
                        else{
                            $this->db->where('form_option_id',$optionid);
                            $this->db->update('form_options',$option);
                            $choiceid = $optionid;
                        }
                        $choices = array();
                        $choices['checked'] = '0';
                        $choices['id'] = $choiceid;
                        $choices['title'] = $v;
                        $choices['value'] = $value->options_value[$k];
                        $value->choices[] = $choices;
                    }
                }*/
           }
           return $value;
        }
        public function delete_fields($fields = ''){
            if($fields != ''){
                $field = explode(',',$fields);
                foreach($field as $key=>$f){
                    $this->form_model->delete_fields($f);
                }
            }
        }
        public function delete_options($options = ''){
            if($options != ''){
                $option = explode(',',$options);
                foreach($option as $key=>$opt){
                    if($opt != ''){
                        $this->form_model->delete_options($opt);
                    }
                }
            }
        }
	public function forms_new(){

		if(!$this->session->userdata('logged_in')){
	
			$this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);

			redirect('login');
		}
		else{

			$this->isLoggedin = 1;
		}

		$this->page = 'forms_new';

		$params = array('page'=>$this->page,'generate'=>$this->generate);

		$data = $this->generateview($params);

		/* Get the category details */

		$this->load->model('category_model');

		$category_details =  $this->category_model->fetchCategoryTree();

		foreach($category_details as $key=>$value){

			/* It avoids the No-Parent  in the field list */
			
			if($value['id'] != 1){

				$categories[$value['id']] =$value['category_name'];

			}

		}

		$data['categories'] = $categories;

		/* Set the already selected category values */

		/* Get Related User Details */

		$this->load->model('user_model');

		$users_list = $this->user_model->list_user();

		$data['user'] = $users_list;

		$data['isLoggedin'] = $this->isLoggedin;

		$this->load->view('home',$data);

	}

}

