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
//include APPPATH . 'controllers/Workflow.php';
class Form extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('access');
        define_constants();
        $this->load->model('comman_model');
        $this->load->model('category_model');
        $this->load->model('location_model');
        $this->load->model('form_model');
        $this->load->library('breadcrumbs');
        $this->load->model('department_model');
        $this->load->model('category_model');
        $this->load->model('role_model');
        $this->load->language('menu');
        $this->load->language('form');
        $this->load->model('organization_model');
        $this->load->model('user_model');
        $this->load->library('PushNotifications');
        $this->load->helper('cryptojs-aes.php');
        $this->load->model('permission_model');
        $this->load->model('login_model');
        $this->load->library('Fields');
        $this->load->library('Review');
        $this->load->library('Filter');
        $this->load->library('uuid');
        $user_id = $this->session->userdata('user_id');
        $this->fieldmaster = $this->form_model->get_fieldmaster();
        //print_r($this->fieldmaster);exit;
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
        $this->breadcrumbs->add('Form', base_url().'form');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $user_id = $this->session->userdata('user_id');
        $forms = $this->form_model->form_list();
        $form_id = array();
        foreach($forms as $key=>$value){
            $form_id[]=$value->form_id;
        }
        $form_users = array();
        $form_locations = array();
        if(count($form_id) > 0){
            $form_user = $this->form_model->list_form_users($form_id);
            foreach($form_user as $key=>$value){
                $form_users[$value['form_id']][$value['uuid']] = $value['name'];
            }
            $form_location = $this->form_model->form_location_list($form_id);
            foreach($form_location as $key=>$value){
                $form_locations[$value['form_id']][$value['uuid']] = $value['location'];   
            }
        }
        //print_r($form_locations);
        $data['roles'] = $this->roles['forms'];
        $data['menu'] = $this->roles;
        $data['user_id'] = $this->session->userdata('user_id');
        $data['list'] = $forms;
        $data['form_user'] = $form_users;
        $data['form_location'] = $form_locations;
        $this->load->view('header', $data);
        $this->load->view('form/list', $data);
        $this->load->view('footer');

    }
    public function add(){
        $org_id = $this->session->userdata('org_id');
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'New Form - '.SITE_NAME;
        $data['menu'] = $this->roles;                
        $this->breadcrumbs->add('Form', base_url().'form');
        $this->breadcrumbs->add('New Form ', base_url().'form/add');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $msg = '';
        if (($this->input->server('REQUEST_METHOD') == 'POST')){
            $form_name = trim($this->input->post('form_name'));
            $category = $this->input->post('form_category');
            $post_org_id = $this->input->post('org_id');
            //$location = $this->input->post('location');
            $config = array(array('field' => 'form_name','label' => 'Form Name','rules' => 'trim|required'),array('field' => 'formToken','label' => 'No Fields in the form','rules' => 'trim|required')
            );
            $form_data = json_encode(cryptoJsAesDecrypt('', $_POST["formToken"]));
            $assign = $this->input->post('assign');
            $workflow_msg = '';
            $assign_users =cryptoJsAesDecrypt('', $_POST["assign_users"]);
            $location = cryptoJsAesDecrypt('', $_POST["form_location"]);
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            //$response_email = '';
            if($this->form_validation->run() !== FALSE){
                $forms = array(
                    'form_name' => $form_name,
                    'default'   => '1',
                    'status'   => '0',
                    'uuid' => $this->uuid->v4(),
                    'assign_to' => $assign,
                    'org_id' => $post_org_id,
                    'created_by' => $user_id
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
                $uuid = $this->uuid->v4();
                $hierarchy_id = $this->form_model->form_hierarchy_insert($form_id,$uuid);
                if($assign_users != ''){
                    $this->form_model->form_users($assign_users,$form_id,$hierarchy_id);    
                    $data['status'] = '1';
                }else{
                    $data['status'] = '0';
                }
                if($location != ''){
                    $this->form_model->form_location($form_id,$location,$hierarchy_id);
                }else{
                    $data['status'] = '0';   
                }
                if($assign == 'workflow'){
                    $data['status'] = '0';
                    $workflow_msg = 'please create a workflow for form and then form will be published';   
                }else{
                $approve = array();
                $approve[] = $user_id;
                $this->form_model->form_hierarchy_position_insert($approve,$form_id,$hierarchy_id);
                }
                //print_r($data);
                $result=$this->form_model->form_add_step_2($data);

                $this->form_model->form_category($category,$form_id,$hierarchy_id);
                if($result){
                    if($post_org_id != 1 && $org_id == 1){
                        /* Get organization name from the organization table */
                    $org_details = $this->organization_model->organization_details($post_org_id);
                        $msg .='Form Successfully added to the '.$org_details[0]['org_name'].' Organization';
                    }
                    else{
                        $msg .='Form Successfully added';   
                    }
                    if($workflow_msg != ''){
                        $msg .= ' and '.$workflow_msg;
                    }
                    if($assign == 'workflow'){
                        $msgs = $this->check_workflow_has_user($location);
                        if($msgs != ''){
                            $msg .=' '.$msgs.' ';
                            $this->session->set_flashdata('ErrorMessage', $msg);    
                            redirect(base_url().'workflow');
                        }
                        $this->session->set_flashdata('SucMessage', $msg);
                        redirect(base_url().'workflow/edit/'.$uuid,'refresh');
                    }else{
                        if($assign_users != ''){
                        /* Set Push Notification */
                            $notification_data['details']['form_id'] = $form_id;
                            $notification_data['users'] = $assign_users;
                            $notification_data['details']['org_id'] = $org_id;
                            $notification_data['details']['title'] = $form_name.' form is assigned to you and waiting for your submission ';
                            $notification_data['type_name'] = 'Form Creation';
                            $notification_data['type'] = '1.1';
                            $notification_data['type_id'] = '1.1';
                            $notification_data['created_at'] = gmdate('Y-m-d H:i:s');
                            $notification_data['updated_at'] = gmdate('Y-m-d H:i:s');
                            $this->comman_model->general_notifications_insert($notification_data);
                            foreach($assign_users as $key=>$value){
                                $to_push_notifi = $this->user_model->user_device_token($value);
                                if(isset($to_push_notifi['android']) && count($to_push_notifi['android']) > 0){
                                /* Push Notification to android */
                                    foreach($to_push_notifi['android'] as $key=>$value){
                                        $push_android_msg[] = $this->pushnotifications->android($notification_data,$value);
                                    }
                                }
                                if(isset($to_push_notifi['ios']) && count($to_push_notifi['ios']) > 0){
                                    /* Push Notification to ios */
                                    foreach($to_push_notifi['ios'] as $key=>$value){
                                        $push_ios_msg[] = $this->pushnotifications->ios($notification_data,$value);
                                    }
                                }
                            }
                        }
                        $this->session->set_flashdata('SucMessage', $msg);
                        redirect(base_url().'form','refresh');
                    }
                }
            }
        }
        $categories = array();
        /* 
            Organization id is 1 means we have to show all organization 
            Because organization id 1 meanse super admin of formpro
        */
        
        if($org_id != 1 && $org_id != '')
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
            $organizations = '';
        }else{
            $orgdomain_in = "''";
            $dept_not_in = "''";
            $system_default = 0;
            $org_domain_ids = "''";
            $cat_not_in = "''";
            $organization = $this->organization_model->org_list();
            $data['organizations'] = $organization;
        }
        $list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
        foreach($list as $key=>$value){
            $category[$value['cat_id']] = $value['category_name'];
        }
        $data['categories'] = $category;
        $data['org_id'] = $org_id;
        $org_location = $this->location_model->location_list($org_id);
        $data['org_location'] = $org_location;
        $this->load->view('header', $data);
        $this->load->view('form/add', $data);
        $this->load->view('footer');
    }
    public function check_form_limit(){
        $org_id = $this->session->userdata['org_id'];
        if($org_id != 1){
            $org_details = $this->organization_model->organization_details($org_id);
            $sub_id = $org_details[0]['subscription_id'];
            /* Find total user in organization */
            $org_form_count = $this->form_model->organization_form_counts($org_id);
            $plan_form = $this->organization_model->check_plan_form($sub_id,$org_id);
            //echo $plan_form;exit;
            if($plan_form !== -1){
                if($plan_form > $org_form_count){
                    return 1;
                }else{
                    return 0;
                }
            }else{
                return 1;
            }
        }
        else{
            return 1;
        }
    }
    public function check_category(){
        $org_id = $this->session->userdata('org_id');
        if($org_id != 1 && $org_id != '')
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
            $organizations = '';
        }else{
            $orgdomain_in = "''";
            $dept_not_in = "''";
            $system_default = 0;
            $org_domain_ids = "''";
            $cat_not_in = "''";
        }
        $list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
        $list = count($list);
        $org_userss = $this->user_model->get_org_users($org_id);
        foreach($org_userss as $key=>$value){
            $org_users[] = $value['id']; 
        }
        $org_user_count = count($org_users);
        $form_limit = $this->check_form_limit();
        $msg = '';
        if($list == 0 && $org_user_count <= 1){
            $msg .= 'Category and users are must needed for the form creation';
        }else if($list == 0){
            $msg .= 'Category are must needed for the form creation';
        }else if($org_user_count <= 1){
            $msg .= 'User are must needed for the form creation';
        }else if($form_limit == 0){
            $msg .='Form creation is exceeded for your plan of subscription';
        }
        else{
            $msg .= false;
        }
        echo $msg;exit;
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
    public function assign_workflow(){
        $org_id = $this->session->userdata('org_id');
        $logged_user =  $this->session->userdata('user_id');
        $superadmin = $this->comman_model->get_superadmin_id($org_id);
        //$get_org_users= $this->user_model->get_org_users($org_id);
        $sel_location = array();
        $assign = $this->input->get('assign');
        if($assign != '' && $assign == 'workflow'){
            /* Location */
            $location = $this->input->get('location');
            if($location != ''){
                $sel_location = cryptoJsAesDecrypt('', $location);
            }
        }
        $data['org_id'] = $org_id;
        $data['sel_location'] = $sel_location;
        $org_location = $this->location_model->location_list($org_id);
        $data['org_location'] = $org_location;
        $this->load->view('form/assign_workflow',$data);
    }

    public function form_workflow($form_id){
        $data['menu'] = $this->roles;
        $data['siteTitle'] ='Form Work Flows';
        $forms =  $this->roles['forms'];
        $roles =  $this->roles;
        $org_id = $this->session->userdata('org_id');
        if(is_array($forms)){
            if(!in_array('update',$forms)){
                redirect(base_url().'error/');
            }else{
                $details = $this->form_model->form_details($form_id);
                $forms = $this->form_model->form_list();
                $data['forms'] = $forms;
                if((isset($_POST['form_flow']) && $_POST['form_flow'] === 'form_flow')){
                    $category = $this->input->post('categories');
                    $form_id = $this->input->post('form_id');
                    $org_id = $this->input->post('organization');
                    $users = $this->input->post('users');
                    $hierarchy_id = $this->input->post('hierarchy_id');
                    $config = array(array('field' => 'categories','label' => 'Category','rules' => 'trim|required'),
                        array('field' => 'organization','label' => 'Organization','rules' => 'trim|required'));
                     $this->form_validation->set_rules($config);
                    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                    $response_email = '';
                    if($this->form_validation->run() !== FALSE){
                        //print_r($_POST);exit;
                        if(empty($hierarchy_id)){
                            $hierarchy_id = $this->form_model->form_hierarchy_insert($form_id);
                            $this->form_model->form_category($category,$form_id,$hierarchy_id);
                            $this->form_model->form_users($users,$form_id,$hierarchy_id);
                            $this->form_model->update_form_org($form_id,$org_id);
                        }else{
                            $this->form_model->form_category($category,$form_id,$hierarchy_id);
                            //print_r($users);
                            $this->form_model->form_users($users,$form_id,$hierarchy_id);
                            $this->form_model->update_form_org($form_id,$org_id);
                            //exit;
                        }
                        $msg ='Work flow Successfully updated to this '.$details->form_name.' form';
                        $this->session->set_flashdata('SucMessage', $msg);
                        redirect(base_url().'form/', 'refresh');
                    }else{
                        $data['ErrorMessages'] = validation_errors();
                        //echo $org_id;exit;
                    }
                }
                //echo $org_id;
                if($org_id != 1 && $org_id != '')
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
                    $organizations = '';
                }else{
                    $orgdomain_in = "''";
                    $dept_not_in = "''";
                    $system_default = 0;
                    $org_domain_ids = "''";
                    $cat_not_in = "''";
                    $organization = $this->organization_model->org_list();
                    $data['organizations'] = $organization;
                }
                 /* Get Form Workflow */
                $hierarchy_id = $this->form_model->get_form_hierarchy($form_id);
                if($hierarchy_id){

                    $users = $this->form_model->user_forms($form_id,$hierarchy_id);
                    foreach($users as $key=>$value){
                        $formusers[] = $value['user_id']; 
                    }
                    $form_category = $this->form_model->get_form_category($form_id,$hierarchy_id);
                    foreach($form_category as $key=>$value){
                        $formcategory[] = $value['cat_id']; 
                    }
                    $data['hierarchy_id'] = $hierarchy_id;
                    $data['formcategory'] = $formcategory;
                    $data['form_org_id'] = $details->org_id;
                    $data['formusers'] = $formusers;

                }else{
                    $data['hierarchy_id'] = 0;
                    $data['formcategory'] = '';
                    $data['formusers'] = '';
                    $data['form_org_id'] = 0;
                }
                $data['form_id'] = $form_id;
                //$department = $this->department_model->department_list($org_id,$dept_not_in,$orgdomain_in,$system_default);
                /*foreach($department as $key=>$value){
                    $dept_id[]=$value['dept_id'];
                }
                $dept_users = $this->form_model->dept_users($dept_id);
                
                foreach($dept_users as $key=>$value){
                    $dept[$value['dept_id']][$value['user_id']] = $value['name'];
                }
                $data['dept'] = $dept;*/
                /* Get organization related category list parameters based upon organization id */
                $list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
                foreach($list as $key=>$value){
                    $category[$value['cat_id']] = $value['category_name'];
                }
                /* Get organization user based upon the organization id */
                $org_user = $this->organization_model->org_users($org_id);
                $data['org_users'] = $org_user;
                $data['categories'] = $category;
                //print_r($data);exit;
                $this->load->view('header', $data);
                $this->load->view('form/formflow', $data);
                $this->load->view('footer');
            }
        }else{
            redirect(base_url().'error/');
        }
        /*$data['roles'] = $roles;
        $org_id = $this->session->userdata('org_id');
        $data['org_id'] = $org_id;
        $data['user_id'] = $this->session->userdata('user_id');
        $forms = $this->form_model->form_list();
        $data['forms'] = $forms;
        $this->load->view('header', $data);
        $this->load->view('form/workflows', $data);
        $this->load->view('footer');*/
    }
    
    public function report_user(){
        $current_user_id = $this->input->post('id');
       // print_r($current_user_id);
        $org_id = $this->input->post('org_id');
        $level = $this->input->post('level');
        $hierarchy_id = $this->input->post('hierarchy');
        $form_id = $this->input->post('form');
        $level++;
        $current_user_id = array_filter($current_user_id);
        $role_id = $this->role_model->get_review_roles($org_id);
        $review_users = $this->user_model->review_role_user($role_id,$org_id);
        foreach($review_users as $key=>$value){
            $review_level_user[] = $value['id'];
        }
        $user = $this->user_model->get_user_details(end($current_user_id),$org_id);
        //$org_user = $this->organization_model->org_users($org_id);
        $form_location = $this->form_model->get_form_location_name($form_id,$hierarchy_id);
        foreach($form_location as $key=>$value){
            $formlocation[] = $value['location_id']; 
        }
        $loc_users = $this->comman_model->location_users_list(implode(",",$formlocation));
        $going_to_approve_user = array();
        $i = 0;
        foreach($loc_users as $key=>$value){
            /* Review Permission users */
            if(in_array($value['id'],$review_level_user) && !(in_array($value['id'],$current_user_id))) {

                $going_to_approve_user[$i]['id'] = $value['id'];
                $going_to_approve_user[$i]['name'] = $value['name'];
                $i++;
            }
        }
        echo json_encode($going_to_approve_user).'?^'.$user->name.'?^'.$user->id; exit;
    }
    public function edit($uuid = null){
        $form_id = $this->form_model->check_uuid_exists($uuid);
        if(empty($form_id)){
            redirect(base_url().'error');
        }
        $data['menu'] = $this->roles;
        $data['siteTitle'] ='Edit Form - '.SITE_NAME;
        $org_id = $this->session->userdata('org_id');
        $user_id =$this->session->userdata('user_id');
        $this->breadcrumbs->add('Form', base_url().'form');
        $this->breadcrumbs->add('Edit Form ', base_url().'form/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $details = $this->form_model->form_details($form_id);
        if(($this->input->server('REQUEST_METHOD') == 'POST')){
            $form_name = trim($this->input->post('form_name'));
            $form_desc = $this->input->post('form_desc');
            $created_by = $this->input->post('created_by');
            $category = $this->input->post('form_category');
            $post_org_id = $this->input->post('org_id');
            $form_data = json_encode(cryptoJsAesDecrypt('', $_POST["formToken"])); 
            $delete = json_encode(cryptoJsAesDecrypt('', $_POST["form_delete_token"])); 
            $users[] = $created_by;
            $status = $this->input->post('status');
            $assign_users =cryptoJsAesDecrypt('', $_POST["assign_users"]);
            $location = cryptoJsAesDecrypt('', $_POST["form_location"]);
            $assign = $this->input->post('assign');
            $workflow_msg = '';
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
                    'default' => $default,
                    'assign' =>$assign
                );
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
                    'form_name' => $form_name,
                    'assign' =>$assign
                );
                $delete_content = json_decode($delete);
                if(!empty($delete_content->fields) || !empty($delete_content->options)){
                    $this->delete_fields($delete_content->fields);
                    $this->delete_options($delete_content->options);
                }
                $hierarchy_id = $this->form_model->get_form_hierarchy($form_id);
                if($assign_users != ''){
                    if(!is_array($assign_users)){
                        $assign_users = explode(',',$assign_users);
                    }
                    $this->form_model->form_users($assign_users,$form_id,$hierarchy_id);    
                    $data['status'] = '1';
                }else{
                    $data['status'] = '0';
                }
                if($location != ''){
                    if(!is_array($location)){
                        $location = explode(',',$location);
                    }
                    $this->form_model->form_location($form_id,$location,$hierarchy_id);
                }else{
                    $data['status'] = '0';   
                }
                $list_users = $this->form_model->list_form_users($form_id);
                if(count($list_users) === 0){
                    $data['status'] = '0';
                }else{
                    $data['status'] = '1';
                }
                $result=$this->form_model->form_update_step_2($data);
                $this->form_model->form_category($category,$form_id,$hierarchy_id);
                if($assign == 'workflow'){
                    $data['status'] = '0';
                    $workflow_msg = 'please create a workflow for form and then form will be published';   
                }else{
                    $approve = array();
                    $approve[] = $user_id;
                    $this->form_model->form_hierarchy_position_insert($approve,$form_id,$hierarchy_id);
                }
                if($result){
                    if($post_org_id != 1 && $org_id == 1){
                        /* Get organization name from the organization table */
                    $org_details = $this->organization_model->organization_details($post_org_id);
                        $msg .='Form Successfully added to the '.$org_details[0]['org_name'].' Organization';
                    }
                    else{
                        $msg .='Form Successfully added';   
                    }
                    if($workflow_msg != ''){
                        $msg .= ' and '.$workflow_msg;
                    }
                    if($assign == 'workflow'){
                        $msgs = $this->check_workflow_has_user($location);
                        if($msgs != ''){
                            $msg .=' '.$msgs.' ';
                            $this->session->set_flashdata('ErrorMessage', $msg);    
                            redirect(base_url().'workflow');
                        }
                        $huuid = $this->form_model->get_form_hierarchy_uuid($form_id);
                        //echo $huuid;exit;
                        $this->session->set_flashdata('SucMessage', $msg);
                        redirect(base_url().'workflow/edit/'.$huuid,'refresh');
                    }else{
                        //print_r($assign_users);exit;
                        if($assign_users != ''){
                            /* Set Push Notification */
                            $notification_data['details']['form_id'] = $form_id;
                            $notification_data['users'] = $assign_users;
                            $notification_data['details']['org_id'] = $org_id;
                            $notification_data['details']['title'] = $form_name.' form is assigned to you and ready for your submission ';
                            $notification_data['type_name'] = 'Form Creation';
                            $notification_data['type'] = '1.1';
                            $notification_data['type_id'] = '1.1';
                            $notification_data['created_at'] = gmdate('Y-m-d H:i:s');
                            $notification_data['updated_at'] = gmdate('Y-m-d H:i:s');
                            $this->comman_model->general_notifications_insert($notification_data);
                            foreach($assign_users as $key=>$value){
                                $to_push_notifi = $this->user_model->user_device_token($value);
                                if(isset($to_push_notifi['android']) && count($to_push_notifi['android']) > 0){
                                /* Push Notification to android */
                                    foreach($to_push_notifi['android'] as $key=>$value){
                                        $push_android_msg[] = $this->pushnotifications->android($notification_data,$value);
                                    }
                                }
                                if(isset($to_push_notifi['ios']) && count($to_push_notifi['ios']) > 0){
                                    /* Push Notification to ios */
                                    foreach($to_push_notifi['ios'] as $key=>$value){
                                        $push_ios_msg[] = $this->pushnotifications->ios($notification_data,$value);
                                    }
                                }
                            }
                        }
                        $this->session->set_flashdata('SucMessage', $msg);
                        redirect(base_url().'form','refresh');
                    }
                }
            }
        }
        $org_id = $this->session->userdata('org_id');
        $categories = array();
        /* 
            Organization id is 1 means we have to show all organization 
            Because organization id 1 meanse super admin of formpro
        */
        
        if($org_id != 1 && $org_id != '')
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
            $organizations = '';
        }else{
            $orgdomain_in = "''";
            $dept_not_in = "''";
            $system_default = 0;
            $org_domain_ids = "''";
            $cat_not_in = "''";
            $organization = $this->organization_model->org_list();
            $data['organizations'] = $organization;
        }
        $list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
        foreach($list as $key=>$value){
            $category[$value['cat_id']] = $value['category_name'];
        }
        $form_category_name = $this->form_model->form_category_name_list($form_id);
        foreach($form_category_name as $key=>$value){
            $form_category = $value['cat_id'];
        }
        $form_location = array();
        $form_location_name = $this->form_model->form_location_list($form_id);
        foreach($form_location_name as $key=>$value){
            $form_location[] = $value['id'];
        }
        $form_users = array();
        $form_users_name = $this->form_model->form_users_list($form_id);
        foreach($form_users_name as $key=>$value){
            $form_users[] = $value['user_id'];
        }
        //print_r($form_users_name);exit;
        $data['categories'] = $category;
        $data['org_id'] = $org_id;
        $org_location = $this->location_model->location_list($org_id);
        $data['org_location'] = $org_location;
        $data['form_category'] = $form_category;
        $data['form_location'] = $form_location;
        $data['form_users'] = $form_users;
        $data['details'] = $details;
        $data['org_id'] = $org_id;
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
    
    /*
    Core function
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
            $notification_data['details']['form_id'] = $form_id;
                $notification_data['details']['submission_id'] = $submission_id;
                $notification_data['details']['org_id'] = $org_id;
                $notification_data['details']['location_id'] = $submitted_location_id;
            if($status == 1){
                // Approved to get next hierarchy user and send mail
                $details = $this->form_model->get_individual_form_hierarchy_list($form_id);
                foreach($details as $key=>$value){
                    $order[$value['sort_id']] = $value['user_id'];
                }
                $my_sort_order = $this->form_model->get_my_sort_order($user_id,$form_id);
                ++$my_sort_order;
                if(isset($order[$my_sort_order])){
                    /* Alert the next level user  
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
                    /* All User reviews finished and changed the submission status to approved 
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
                /* Change reassigned users status 
                $this->form_model->reassign_user_form_status($reassign_users,$submission_id,$form_id,$status);

            }
            $result['msg']='Form Revised Successfully';
            $this->session->set_flashdata('SucMessage', $result['msg']);
            redirect(base_url().'form/reviews','refresh');
        }
    }*/
    /* Westin function  */
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
            $org_id = $this->session->userdata('org_id');
            $review_description = $this->input->post('message','');
            if($review_description == ''){
                $review_description = '';
            }
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
            $submitted_location_id = $submission[0]['location_id'];
            /* Get Location name for the Sending Email */
                $location = $this->location_model->get_location_details($org_id,$submitted_location_id);
                $location_name = $location[0]['location_name'];
                $form_id = $submission[0]['form_id'];
            /* Get Form Name for Sending Email */
                $form_details = $this->form_model->form_details($form_id);
                $form_name =$form_details->form_name;
            /* Get Current Logged user details */
                $current_user = $this->user_model->get_user_details($user_id,$org_id);
                $from = $current_user->email;
                $from_name = $current_user->name;
            /* Updates json values with comments key based on its field comments */
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
            /* Updates json values with comments in form submission */
                $submission_details = json_encode($submission_details);
                $this->form_model->updates_submission_form_submission($submission_id,$submission_details);
                $submitted_user =$this->user_model->get_user_details($submitted_user_id,$submitted_org_id);
                $notification_data['details']['form_id'] = $form_id;
                $notification_data['details']['submission_id'] = $submission_id;
                $notification_data['details']['org_id'] = $org_id;
                $notification_data['details']['location_id'] = $submitted_location_id;
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
                    $next_user=$this->user_model->get_user_details($next_to_email,$submitted_org_id);
                    $subject = $this->lang->line('submission');
                    $send_to = $next_user->email;
                    $message['receiver_name'] = $next_user->name;
                    $message['message'] = $review_description;
                    $message['name'] = $next_user->name;
                    $message['form_name'] = $form_name;
                    $message['form_url'] = '';
                    $message['location_name']  = $location_name;
                    $message['datetime'] = date('Y-m-d H:i:s');
                    send_email($from,$from_name,$send_to,'submission.php',$subject,$message);
                    $notification_data['title'] = 'Your submission against '.$form_name.' is going to review by '.$next_user->name;
                    $notification_data['description'] =  $review_description;
                    $notification_data['type'] = '1.4';
                    $to_push_notifi = $this->user_model->user_device_token($next_to_email);
                }else{
                /* All User reviews finished and changed the submission status to approved */
                    $this->form_model->updates_status_form_submission($submission_id,$status);
                    $subject = $this->lang->line('approved');
                    $send_to = $submitted_user->email;
                    $message['receiver_name'] = $submitted_user->name;
                    $message['message'] = $review_description;
                    $message['name'] = $current_user->name;
                    $message['form_name'] = $form_name;
                    $message['location_name']  = $location_name;
                    $message['form_url'] = '';
                    $message['datetime'] = date('Y-m-d H:i:s');
                    send_email($from,$from_name,$send_to,'resolved.php',$subject,$message);
                    $notification_data['title'] = 'Your submission against '.$form_name.' is Fully approved';
                    $notification_data['description'] =  $review_description;
                    $notification_data['type'] = '1.2';
                /* Get Device token for the user */
                    $to_push_notifi = $this->user_model->user_device_token($submitted_user_id);
                }
                $this->form_model->approved_review_history($submission_id,$user_id,$status);
            }
            else if($status == 2){
                // Rejected 
                    $decline_desc = $this->input->post('decline_desc');
                    $data['message'] = $decline_desc;
                    $send_to = $submitted_user->email;
                    $subject = $this->lang->line('rejected');
                    $message['receiver_name'] = $submitted_user->name;
                    $message['message'] = $review_description;
                    $message['name'] = $current_user->name;
                    $message['form_name'] = $form_name;
                    $message['form_url'] = '';
                    $message['location_name']  = $location_name;
                    $message['datetime'] = date('Y-m-d H:i:s');
                    send_email($from,$from_name,$send_to,'rejected.php',$subject,$message);
                    $this->form_model->decline_form_submission($submission_id,$user_id,$status);
                /* Set Push Notification */
                    $notification_data['title'] = 'Your submission against '.$form_name.' is rejected';
                    $notification_data['description'] =  $review_description;
                    $notification_data['type'] = '1.1';
                /* Get Device token for the user */
                    $to_push_notifi = $this->user_model->user_device_token($submitted_user_id);

            }
            else if($status == 3){
                // Reassigned
                $users = $this->input->post('users');
                $reassign_users = explode(",",$users);
                $reassign_users = array_filter($reassign_users);
                /* Initially Reassigned the form to the submitted user */
                    $send_to = $submitted_user->email;
                    $subject = $this->lang->line('reassign');
                    $message['receiver_name'] = $submitted_user->name;
                    $message['message'] = $review_description;
                    $message['name'] = $current_user->name;
                    $message['form_url'] = '';
                    $message['form_name'] = $form_name;
                    $message['datetime'] = date('Y-m-d H:i:s');
                    $message['location_name']  = $location_name;
                    send_email($from,$from_name,$send_to,'reassign.php',$subject,$message);
                    if(count($reassign_users) > 0){
                        /* Reassign the submission to previously assigned user */
                        foreach($reassign_users as $key=>$value){
                            $user=$this->user_model->get_user_details($value,$submitted_org_id);
                            $message['receiver_name'] = $user->name;
                            send_email($from,$from_name,$user->email,'reassign_review.php',$subject,$message);
                        }
                    }
                /* Change reassigned users status */
                    $reassign_users[] = $submitted_user_id;
                    $reassign_users[] = $user_id;
                    $this->form_model->reassign_user_form_status($reassign_users,$submission_id,$form_id,$status);
                    $notification_data['title'] = 'Your submission against '.$form_name.' is reassigned to you';
                    $notification_data['description'] =  $review_description;
                    $notification_data['type'] = '1.3';
                /* Get Device token for the user */
                    $to_push_notifi = $this->user_model->user_device_token($submitted_user_id);

            }
            if(isset($to_push_notifi['android']) && count($to_push_notifi['android']) > 0){
            /* Push Notification to android */
                foreach($to_push_notifi['android'] as $key=>$value){
                    $push_android_msg[] = $this->pushnotifications->android($notification_data,$value);
                }
            }
            if(isset($to_push_notifi['ios']) && count($to_push_notifi['ios']) > 0){
                /* Push Notification to ios */
                foreach($to_push_notifi['ios'] as $key=>$value){
                    $push_ios_msg[] = $this->pushnotifications->ios($notification_data,$value);
                }
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
    /*
    Old report Function 
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
        

    }*/
    /* Muni Raj Changes in Report function */
    public function report($uuid){
        $form_id = $this->form_model->check_uuid_exists($uuid);
        if(empty($form_id)){
            redirect(base_url().'error');
        }
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'Form Submission' . SITE_NAME;
        $data['menu'] = $this->roles; 
        $this->breadcrumbs->add('Form', base_url().'form');
        $this->breadcrumbs->add('Reports ', base_url().'form/report');
        $data['breadcrumbs'] = $this->breadcrumbs->output();               
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $org_id = $this->session->userdata('org_id');
        if($form_id != ''){
        $data['form_id'] = $form_id;
        $this->form_model->check_view_exists($form_id);
        $details=$this->form_model->filter_search($filter = array(),$form_id);
        $user = $this->user_model->get_user_details($user_id,$org_id);
        $form = $this->form_model->form_details($form_id);
        $data['form_name'] = $form->form_name;
        $data['created_by'] = $user->name;
        $data['created_on'] = $form->created_at;
        $data['status'] = '1';
        if($data['status'] == '1'){
            $data['status_lang'] = 'Active';
        }else{
            $data['status_lang'] = 'Inactive';
        }
        $forms = $this->form_model->form_list();
        $data['forms']= $forms;
        $submission_list = array();
        $list = array();
        $submission_count = count($details);
        if($submission_count){
            foreach ($details as $key => $value) {
                $submission[] = $value['submission_id'];
            }
            $sub_list = array_unique($submission);
            //print_r($sub_list);exit;
            foreach($sub_list as $key=>$value){

                $lists = $this->form_model->form_submission_data($value);    
                foreach($lists as $k=>$v){
                    $list[$value][$v['question']] = $v['answer'];
                }
                $list[$value]['Submitted By'] = $lists[0]['submitted_by'];
                $list[$value]['Created On'] = $lists[0]['created_at'];
                $uuid = "'".$v["uuid"]."'";
                $list[$value]['Actions'] = '<a onclick="submission_preview('.$uuid.')" title="Submisssion Preview">
                                    <i class="md-icon material-icons"></i>
                                </a>';
            }
        }else{
           $list = array(); 
        }
        /*foreach($details as $key=>$value){
            $list[$value['id']]['submitted_by'] =  $value['submitted_by'];   
            $list[$value['id']]['created_at'] =  $value['created_at'];   
            $lists = $this->form_model->form_submission_data($value['id']);    
                foreach($lists as $k=>$v){
                    $list[$value['id']][$v['question']] = $v['answer'];
                }
        }*/
        $data['submission_list'] = $list;
        $content = json_decode($form->form_content);
        foreach($content->fields as $p=>$pages){ 
            foreach($pages as $r=>$rows){
                foreach($rows as $c=>$cols){
                    if(isset($cols->fieldtype)){
                        if($cols->fieldtype != 3 && $cols->fieldid != 17){
                            $key = $cols->fieldid.'_'.$cols->formfieldid.'_'.$cols->fieldtype;
                            $fields[$key] = $cols->title;
                            $required[$key][] = $cols->title;
                            $required[$key][] = $cols->required;
                            $columns[] = $cols->title;
                        }
                    }
                }
            }
        }
        $columns[]='Submitted By';
        $columns[]='Created On';
        $columns[]='Actions';
        if($list != ''){
                /* generate report file */
            $data['download_url'] = $this->excel_generate($columns,$list,$form_id);
        }
        if(!isset($fields)){
            $fields = array();
        }
        if(!isset($columns)){
            $columns = array();
        }
        if(!isset($required)){
            $required = array();
        }
        $data['fields'] = $fields;
        $data['columns'] = $columns;
        $data['required'] = $required;
        $data['filter'] = $this->filter->filter_general();
        //print_r($data['filter']);exit;
        $this->load->view('header',$data);
        $this->load->view('form/report', $data);
        $this->load->view('footer',$data);
      } 
        

    }
    /* Muniraj Reports Function */
    public function reports(){
        if(isset($_POST['filter'])){
            $data_report = $_POST;
            $filter = $_POST['filter'];
            $form_id = $_POST['org_forms'];
            $selected_column = $_POST['columns_selected'];
            if(isset($_POST['columns'])){
                $columns = $_POST['columns'];
            }
            else{
                $columns = array();
            }
            $order[$_POST['field']] = $_POST['order'];
            $index = 0;
            $res = $this->form_model->check_view_exists($form_id);
            if($res) {
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
                $submission_list = $this->form_model->filter_search($query,$form_id,$order);
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
                        }
                        $uuid = "'".$v["uuid"]."'";
                        $list[$value]['Submitted by'] = $lists[0]['submitted_by'];
                        $list[$value]['Created on'] = $lists[0]['created_at'];
                        $list[$value]['Actions'] = '<a onclick="submission_preview('.$uuid.')" title="Submisssion Preview">
                                    <i class="md-icon material-icons"></i>
                            </a>';
                    }
                }else{
                   $list = ''; 
                }
                $form_values = $this->form_model->get_key_values($form_id);
                foreach($form_values as $key=>$value){
                    $form_heading[] = $value['values'];
                }
                $form_heading[] = 'Submitted by';
                $form_heading[] = 'Created on';
                $form_heading[]='Actions';
                if($list != ''){                
                    $file_url = $this->excel_generate($form_heading,$list,$form_id);
                }
                $sel_column = json_decode($selected_column[0]);
                $sel_column[] = 'Submitted by';
                $sel_column[] = 'Created on';
                $sel_column[]='Actions';
                $data['columns'] = $sel_column;
                $data['download_url'] = $file_url;
                $data['submission_list'] =$list;
                $this->load->view('form/search_result',$data);
            }
        }
    }
    public function excel_generate($form_heading,$list,$form_id){
        $column_count = count($form_heading);
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getDefaultStyle()
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        foreach (range('A', 'F') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
        }
        $objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setSize(12);
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0);
        //for($i=0;$i<=$column_count;$i++) {
        foreach($form_heading as $key=>$value){
            if(isset($value)){
                $columnNo1 =1;
                $row = array(0=>'A',1=>'B',2=>'C',3=>'D',4=>'E',5=>'F',6=>'G',7=>'H',8=>'I',9=>'J',10=>'K',11=>'L',12=>'M',13=>'N',14=>'O',15=>'P',16=>'Q',17=>'R',18=>'S',19=>'T',20=>'U',21=>'V',22=>'W',23=>'X',24=>'Y',25=>'Z'); 
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($row[$key].$columnNo1,$value);
            }
        }
        $columnNo = 2;
        foreach ($list as $key => $value) {

            $objPHPExcel->getActiveSheet()->getStyle("A" . $columnNo . ":G" . $columnNo)->getFont()->setSize(11);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$columnNo)->getAlignment()->setWrapText(true);
            $objPHPExcel->setActiveSheetIndex(0);
                    
            for($i=0;$i<$column_count;$i++) {
                //if(isset($form_values[$i]['values'])){
                $row = array(0=>'A',1=>'B',2=>'C',3=>'D',4=>'E',5=>'F',6=>'G',7=>'H',8=>'I',9=>'J',10=>'K',11=>'L',12=>'M',13=>'N',14=>'O',15=>'P',16=>'Q',17=>'R',18=>'S',19=>'T',20=>'U',21=>'V',22=>'W',23=>'X',24=>'Y',25=>'Z');
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($row[$i] . $columnNo, $value[$form_heading[$i]]);
                //}
            }
            $columnNo++;
        }
        $objPHPExcel->getActiveSheet()->setTitle('Reports');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $form = $this->form_model->form_details($form_id);
        $file = $this->uuid->v4();
        $user_id =$this->session->userdata('user_id');
        $org_id =$this->session->userdata('org_id');
        $path = FORM_REPORT_PATH.$org_id.'/'.$form_id.'/'.$user_id;
        if(!is_dir($path)) //create the folder if it's not already exists
        {
            @mkdir($path,0777,TRUE);
            @chmod($path, 0777);
        }
        $files = glob($path.'/'.'*'); // get all file names
        foreach($files as $fileName){ // iterate files
          if(is_file($fileName))
            unlink($fileName); // delete file
        }
        $filename= $file.'.xls'; //save our workbook as this file name
        $filepath = $path.'/'.$filename;
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save($filepath);
        return $file_url = base_url().'uploads/report/'.$org_id.'/'.$form_id.'/'.$user_id.'/'.$filename;

    }
    public function download($file_name){
        ob_end_clean(); //don't remove this added by Muniraja on 05-jan-17
        $file_name = $this->uri->segment(3).'.xls';
        $file_url = base_url().'uploads/report/'.$file_name;
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"".$file_name."\""); 
        readfile($file_url);
        exit;
    }
    /** Function to get report in excel **/
    public function export() {
        if(isset($_POST['filter'])){
            ob_end_clean();
            $filter = $_POST['filter'];
            $form_id = $_POST['form_id'];
            if(isset($_POST['columns'])){
                $columns = $_POST['columns'];
            }
            else{
                $columns = array();
            }
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
                    }
                    $list[$value]['submitted_by'] = $lists[0]['submitted_by'];
                    $list[$value]['created_at'] = $lists[0]['created_at'];
                }
            }else{
               $list = ''; 
            }
            $form_values = $this->form_model->get_key_values($form_id);

            $this->load->library('excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getDefaultStyle()
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            foreach (range('A', 'F') as $columnID) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                        ->setAutoSize(true);
            }
            $objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setSize(12);
            // Add some data
            $objPHPExcel->setActiveSheetIndex(0);
            $columnNo1 =1;
            for($i=0;$i<5;$i++) {
            //foreach($form_values as $key=>$value){
                if(isset($form_values[$i]['values'])){
                    $row = array(0=>'A',1=>'B',2=>'C',3=>'D',4=>'E',5=>'F',6=>'G',7=>'H',8=>'I',9=>'J',10=>'K',11=>'L',12=>'M',13=>'N',14=>'O',15=>'P',16=>'Q',17=>'R',18=>'S',19=>'T',20=>'U',21=>'V',22=>'W',23=>'X',24=>'Y',25=>'Z'); 
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue($row[$key].$columnNo1,$form_values[$i]['values']);
                }
            }
            $columnNo = 2;
            print_r($list);exit;
            foreach ($list as $key => $value) {
                $objPHPExcel->getActiveSheet()->getStyle("A" . $columnNo . ":G" . $columnNo)->getFont()->setSize(11);
                $objPHPExcel->getActiveSheet()->getStyle('G'.$columnNo)->getAlignment()->setWrapText(true);
                $objPHPExcel->setActiveSheetIndex(0);
                   
                for($i=0;$i<5;$i++) {
                    if(isset($form_values[$i]['values'])){
                    $row = array(0=>'A',1=>'B',2=>'C',3=>'D',4=>'E',5=>'F',6=>'G',7=>'H',8=>'I',9=>'J',10=>'K',11=>'L',12=>'M',13=>'N',14=>'O',15=>'P',16=>'Q',17=>'R',18=>'S',19=>'T',20=>'U',21=>'V',22=>'W',23=>'X',24=>'Y',25=>'Z');
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($row[$i] . $columnNo, $value[''.$form_values[$i]['values'].'']);
                    }
                }
                $columnNo++;
            }
            $objPHPExcel->getActiveSheet()->setTitle('Reports');
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);

            $form = $this->form_model->form_details($form_id);
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$form->form_name.'.xls"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            //$objWriter->save('php://output');
            echo $objWriter->save('php://output');
            exit; 
            }
    }
    public function filter_add(){
        $form_id = $this->input->get('form_id');
        //echo $form_id;
        $filter_key = $this->input->get('filter');
        $form = $this->form_model->form_details($form_id);
        $content = json_decode($form->form_content);
        foreach($content->fields as $p=>$pages){ 
            foreach($pages as $r=>$rows){
                foreach($rows as $c=>$cols){
                    if(isset($cols->fieldtype)){
                        if($cols->fieldtype != 3 && $cols->fieldid != 17){
                            $key = $cols->fieldid.'_'.$cols->formfieldid.'_'.$cols->fieldtype;
                            $fields[$key] = $cols->title;
                        }
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
            $new .= '<div class="uk-width-3-10 condition padding-zero">';
            $conditions = $this->filter->filter_general();
                $new .= '<select id = "filter_condition" name="filter[filter]['.$filter_key.'][condition]" >';
                        foreach($conditions as $key=>$value){
                            $new .='<option value="'.$key.'">'.$value.'</option>';
                        }

            $new.='</select>
                    </div>
                    <div class="uk-width-2-10 data padding-zero">
                        <input type="text" name="filter[filter][0][data]" style="width:100px;height:15px;padding-left:15px !important;" id="filter_data" value="" />
                    </div>
                    <div class="uk-width-2-10 action">
                        <span class="addremove">
                            <a class="remove" href="#">
                                <img class="icon" title="" height="22px" width="22px" src="'.base_url().'assets/assets/images/minus.png" alt="">
                            </a>
                            <a class="add" href="#" style="display: inline;">
                                <img class="icon" height="22px" width="22px" title="" src="'.base_url().'assets/assets/images/add2.png" alt="">
                            </a>
                        </span>
                    </div>
                </div>';
       echo $new;die();
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
            $conditions = $this->filter->filter_general();
            $condition .= '<select id = "filter_condition" name="filter[filter]['.$filter_key.'][condition]" >';
            foreach($conditions as $key=>$value){
                $condition .='<option value="'.$key.'">'.$value.'</option>';
            } 
            $condition .='</select>';
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
                $data .= '<select id="filter" style="margin-left:25px !important;" name="filter[filter]['.$filter_key.'][data]" >';
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
            } else if($key_split[2] === '6'){
                $data .= '<input type="text" id="datepicker-12" name="filter[filter]['.$filter_key.'][data]" style="width:100px;height:15px;padding-left:15px !important;" value = ""/>';
            }
        }        
        echo $condition.'^%'.$data;exit;
    }

    public function customize_columns(){
        $form_id = $this->input->get('form_id');
        $sel = $this->input->get('sel_column');
        $selected = json_decode($sel);
        $form_values = $this->form_model->get_key_values($form_id);
        foreach($form_values as $key=>$value){
            $form_heading[] = $value['values'];
        }
        $form_heading[] = 'Submitted by';
        $form_heading[] = 'Created on';
        $data['columns'] = $form_heading;
        $data['selected'] = $selected;
        $this->load->view('form/filter',$data);
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
        $data['form_id'] = $formid;
        $data['siteTitle'] = "Form";
        $data['contents'] = $details;
        $data['roles'] = $this->roles['forms'];
        $data['menu'] = $this->roles;
        $data['user_id'] = $userid;
        //$this->load->view('header',$data);
        $this->load->view('form/submission_list', $data);
        //$this->load->view('footer');
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
       public function submission_preview(){
        $uuid = $this->input->get('id');
        $id =$this->form_model->check_submission_uuid_exists($uuid);
        if(empty($id)){
            redirect(base_url().'error');
        }
        $details = $this->form_model->form_submission_details($id);
        $data['roles'] = $this->roles['forms'];
        $data['menu'] = $this->roles;
        $data['contents'] = $details;
        $data['user_id'] = $this->session->userdata('user_id');        
        $this->load->view('form/submission_view', $data);
    }

    /* 
        Preview the submission details of form based on submission id 

    */



    /* 
        Preview the form which are previously created based on formid 

    */
    public function preview(){
        $uuid = $this->input->get('id');
        $form_id = $this->form_model->check_uuid_exists($uuid);
        if(empty($form_id)){
            //redirect(base_url().'error');
        }
        $details = $this->form_model->form_details($form_id);
        $userid = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');    
        $data['form_id'] = $form_id;
        $data['org_id'] = $org_id;
        $data['siteTitle'] = "Preview Form";
        $data['contents'] = $details->form_content;
        $data['formname'] = $details->form_name;
        $data['roles'] = $this->roles['forms'];
        $data['menu'] = $this->roles;
        $data['user_id'] = $userid;
        $this->load->view('form/preview', $data);
    }

    public function insertUpdateFormContent($content,$form_id)
    {
        //print_r($content);exit;
        $api_fields = array();
        $fields = json_decode($content);
        foreach($fields as $i=>$pages){
            foreach($pages as $p=>$rows){   
                foreach($rows as $r=>$cols){
                    foreach($cols as $key=>$value){
                        if($value != null && $value != ''){
                            if($value->type != 'submit' && $value->type != 'reset'){
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
                                 $value->formfieldid = (string)$formfieldid;
                                if($field_type == '1'){
                                    $value->formfieldid = (string)$formfieldid;
                                    //$value = $this->field_options($value, $formfieldid);
                                }
                                $value->fieldtype = (string)$field_type;
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
                                $value->fieldtype =  (string)$field_type;
                               /* if(isset($value->rules) && $value->rules == '-1'){
                                    $value->required = '0';
                                }else{
                                    $value->required = '1';
                                }*/
                                if(isset($value->required) && $value->required == '1'){
                                    $value->required = '1';
                                }else{
                                    $value->required = '0';
                                }
                            }
                       }
                    }
                }
            }
        }
        //print_r($fields);exit;
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
                            if(isset($value->required) && $value->required == '1'){
                                    $value->required = '1';
                            }else{
                                $value->required = '0';
                            }
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
}

