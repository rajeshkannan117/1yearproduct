<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is Category controller of Formpro
 *
 * @package             CodeIgniter
 * @category            controller
 * @author              Rajeshkannan.C
 * @link                http://innoppl.com/
 *
 */
include APPPATH . 'controllers/OAuth.php';
include APPPATH . 'controllers/common.php';

class Location extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('comman_model');
        $this->load->model('webservice_model');
        $this->load->library('breadcrumbs');
        $this->load->model('location_model');
        $this->load->model('organization_model');
        $this->load->model('user_model');
        $this->load->language('menu');
        $this->load->language('job_sites');
        $this->load->model('country_model');
        $this->load->helper('access');
        $this->load->library('uuid');
         $this->load->model('login_model'); 
        $user_id = $this->session->userdata('user_id');
          //Check the user is logged in properly
        if ($this->session->userdata('logged_in') == false) {
            $this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);
            redirect(base_url() . 'login/', 'refresh');
        }
        $this->roles = $this->login_model->assign_roles($user_id);
        $this->load->helper('date');
        //print_r($this->roles); exit;
        $method = $this->router->fetch_method();
        if(is_array($this->roles['location'])){
            switch ($method) {
                case 'add':
                    if(!in_array('create',$this->roles['location'])){
                     redirect(base_url().'error');
                    }
                    break;
                case 'edit':
                    if((!in_array('update',$this->roles['location'])) && (!in_array('create',$this->roles['location']))){
                         redirect(base_url().'error');
                    }
                    break;
                case 'delete':
                    if(!in_array('delete',$this->roles['location'])){
                         redirect(base_url().'error');
                    }
                    break;
                case 'index':
                    if(!in_array('read',$this->roles['location'])){
                         redirect(base_url().'error');
                    }
                default:
                    break;
            }
        }else{
            $data['msg']= 'Unauthorised access';
            redirect(base_url().'error/','refresh');
        }
    }

    // List Category //
    public function index() {
        $data['ErrorMessages'] = '';
        $data['siteTitle'] = $this->lang->line('location').' - '. SITE_NAME;
        $data['menu'] = $this->roles;
        $data['location'] = $this->roles['location'];
        $list_user_id = $this->session->userdata('user_id');
        $this->breadcrumbs->add('Jobsites', base_url().'location');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $data['user_id'] = $list_user_id;
        $org_id = $this->session->userdata('org_id');
        $list = $this->location_model->location_list($org_id);
        $data['result'] = $list;
        $data['org_id'] = $org_id;
        $this->load->view('header', $data);
        $this->load->view('location/list', $data);
        $this->load->view('footer');
    }

    public function add(){
        $data['ErrorMessages'] = '';
        $data['siteTitle'] = $this->lang->line('location_add').' - '. SITE_NAME;
        $this->breadcrumbs->add('Jobsites', base_url().'location');
        $this->breadcrumbs->add('New Jobsites ', base_url().'location/add');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $data['menu'] = $this->roles;
        $data['location'] = $this->roles['location'];
        $list_user_id = $this->session->userdata('user_id');
        $data['user_id'] = $list_user_id;
        $org_id = $this->session->userdata('org_id');
        $countries = $this->country_model->getcountrylist();
        $def= $this->country_model->getdefaultcountry();
        $data['countries']=$countries;
        $data['default'] = $def;
        $data['org_id'] = $org_id;
        if (($this->input->server('REQUEST_METHOD') == 'POST'))
        {
            $location_name = trim($this->input->post('location_name'));
            $location_id = $this->input->post('location_id');
            $address = $this->input->post('address');
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $zip_code = $this->input->post('zip_code');
            $countries = $this->input->post('countries');
            $post_org_id = $this->input->post('org_id');
            $users = $this->input->post('users');
            if(isset($post_org_id)){
                $org_id = $post_org_id;     
            }
            $data = array(
                    'location_name' =>$location_name,
                    'location_id' => $location_id,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'zip_code' => $zip_code,
                    'country' => $countries,
                    'org_id' => $org_id,
                    'status' => '1',
                    'uuid' => $this->uuid->v4()
                );
            
           
            $location_id = $this->location_model->location_insert($data);
            if($location_id){
                if(is_array($users)){
                    $this->location_model->insert_user_location($users,$location_id);
                }
                $msg='Location Successfully added';   
                $this->session->set_flashdata('SucMessage', $msg);
                redirect(base_url().'location/', 'refresh');
            }
        }
        $org_country = $this->comman_model->get_org_country($org_id);
        
        if($org_id == 1){
            $data['org'] =$this->user_model->get_organizations($datas = array());
            $data['org_country'] ='';
        }else{
            $data['org_country'] = $org_country[0]['loc_id'];
        }
        $org_user = $this->organization_model->org_users($org_id);
        $data['users'] = $org_user;
        $this->load->view('header', $data);
        $this->load->view('location/add', $data);
        $this->load->view('footer');
    }
    public function edit($uuid = null){
        $loc_id = $this->location_model->check_location_exists($uuid); 
        if(empty($loc_id)){
            redirect(base_url().'error','refresh');
        }
        $data['ErrorMessages'] = '';
        $this->breadcrumbs->add('Jobsites', base_url().'location');
        $this->breadcrumbs->add('Edit Jobsites ', base_url().'location/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $data['siteTitle'] = $this->lang->line('location_edit').' - '. SITE_NAME;
        $data['menu'] = $this->roles;
        $data['location'] = $this->roles['location'];
        $list_user_id = $this->session->userdata('user_id');
        $data['user_id'] = $list_user_id;
        $org_id = $this->session->userdata('org_id');
        $countries = $this->country_model->getcountrylist();
        $def= $this->country_model->getdefaultcountry();
        $data['countries']=$countries;
        $data['default'] = $def;
        $data['org_id'] = $org_id;
        
        if(($this->input->server('REQUEST_METHOD') == 'POST'))
        {
            $location_name = trim($this->input->post('location_name'));
            $location_id = $this->input->post('location_id');
            $address = $this->input->post('address');
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $zip_code = $this->input->post('zip_code');
            $post_countries = $this->input->post('countries');
            $post_org_id = $this->input->post('org_id');
            $data = array(
                    'location_name' =>$location_name,
                    'location_id' => $location_id,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'zip_code' => $zip_code,
                    'country' => $post_countries,
                    'status' => '1',
                    'modified_on' =>  gmdate("Y-m-d H:i:s")
                );
            $users = $this->input->post('users');
            if(isset($post_org_id)){
                $data['org_id'] = $post_org_id;     
            }else{
                $data['org_id'] = $org_id;
            }
            $org_country = $this->comman_model->get_org_country($org_id);
            //$data['country'] = $org_country[0]['loc_id'];
            /* Check home branch */
            $branch = $this->location_model->check_location_branch($loc_id);
            if($branch->org_id != $data['org_id'] && $branch->headbranch == 1){
                $msg="Home Branch Location can't be changed";   
                $this->session->set_flashdata('SucMessage', $msg);
                redirect(base_url().'location/edit/'.$loc_id, 'refresh');    
            }
            $this->location_model->location_update($data,$loc_id);
            if($users){
                $this->location_model->location_user_update($users,$loc_id);
            }else{
                $location_user = $this->location_model->get_location_users($loc_id);
                $this->location_model->location_user_delete($location_user,$loc_id);
            }
            $msg='Location Details Successfully Updated';   
            $this->session->set_flashdata('SucMessage', $msg);
            redirect(base_url().'location/', 'refresh');
        }
        if($org_id == 1){
            $data['org'] =$this->user_model->get_organizations($datas = array());
        }
        /* Get organization user based upon the organization id */
        $org_user = $this->organization_model->org_users($org_id);
        /* Location details */
        $details = $this->location_model->get_location_details($org_id,$loc_id);
        $location_user = $this->location_model->get_location_users($loc_id);
        foreach($details as $key=>$value){
            $location['location_name'] = $value['location_name'];
            $location['location_id'] = $value['location_id'];
            $location['address'] = $value['address'];
            $location['city'] = $value['city'];
            $location['state'] = $value['state'];
            $location['zip_code'] = $value['zip_code'];
            $location['country_id'] = $value['loc_id'];
        }
        $data['location'] = $location;
        $data['location_user'] = $location_user;
        $data['users'] = $org_user;
        $this->load->view('header', $data);
        $this->load->view('location/edit', $data);
        $this->load->view('footer');
    }
    public function delete($uuid = null){
        $loc_id = $this->location_model->check_location_exists($uuid); 
        if(empty($loc_id)){
            redirect(base_url().'error','refresh');
        }
        $return = $this->location_model->location_delete($loc_id);
        if($return){
            $msg='Location Details Successfully Deleted';   
            $this->session->set_flashdata('SucMessage', $msg);
            redirect(base_url().'location', 'refresh');
        }
    }

    public function location_preview(){
        $uuid = $this->input->get('id');
        $loc_id = $this->location_model->check_location_exists($uuid); 
        if(empty($loc_id)){
            redirect(base_url().'error','refresh');
        }
        $org_id = $this->session->userdata('org_id');
        /* Get organization user based upon the organization id */
        $org_user = $this->organization_model->org_users($org_id);
        $countries = $this->country_model->getcountrylist();
        /* Location details */
        $details = $this->location_model->get_location_details($org_id,$loc_id);
        $location_user = $this->location_model->get_location_users($loc_id);
        foreach($details as $key=>$value){
            $location['location_name'] = $value['location_name'];
            $location['location_id'] = $value['location_id'];
            $location['address'] = $value['address'];
            $location['city'] = $value['city'];
            $location['state'] = $value['state'];
            $location['zip_code'] = $value['zip_code'];
            $location['country_id'] = $value['loc_id'];
        }
        foreach($countries as $key=>$value){
            if($value['loc_id'] == $location['country_id']){
                $country_name = $value['country_name'];
            }
        }
        $data['country_name'] = $country_name;
        $data['location'] = $location;
        $data['location_user'] = $location_user;
        $data['users'] = $org_user;
        $this->load->view('location/preview', $data);
    }

    public function check_location_branch(){
        $uuid = $this->input->get('uuid');
        $loc_id = $this->location_model->check_location_exists($uuid); 
        if(empty($loc_id)){
           echo 2;exit;
        }
        $branch = $this->location_model->check_location_branch($loc_id);
        if($branch->headbranch == 1){
            echo 0;exit;
        }else{
            echo 1;exit;
        }
    }

    public function check_subscribed_location(){
        $org_id = $this->session->userdata['org_id'];
        $org_details = $this->organization_model->organization_details($org_id);
        $sub_id = $org_details[0]['subscription_id'];
        /* Find total user in organization */
        $org_jobsite_count = $this->location_model->location_list_count($org_id);
        $plan_user = $this->organization_model->check_plan_location($sub_id,$org_id);
        if($plan_user > $org_jobsite_count){
            echo false;
        }else{
            echo 'Jobsites is exceeded for your subscription plan ';
        }
        exit;
    }
   
}
