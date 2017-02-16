<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is Role management controller of Formpro
 *
 * @package        CodeIgniter
 * @category            controller
 * @author       Rajeshkannan.C
 * @link                http://innoppl.com/
 *
 */
include APPPATH . 'controllers/OAuth.php';
include APPPATH . 'controllers/common.php';
class Role extends CI_Controller
{
        

	public function __construct()
	{
		parent::__construct();

		$this->load->model('comman_model');
		$this->load->model('role_model');
        $this->load->language('menu');
        $this->load->language('role');
		$this->load->model('permission_model');
        $this->load->library('breadcrumbs');
        $this->load->model('login_model');
        $this->load->helper('access');
        define_constants();
        $this->load->library('uuid');
        $user_id = $this->session->userdata('user_id');
        if ($this->session->userdata('logged_in') == false) {
            $this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);
            redirect(base_url() . 'login/', 'refresh');
        }
        $this->roles = $this->login_model->assign_roles($user_id);
        $this->load->helper('date');
        $method = $this->router->fetch_method();
        if(is_array($this->roles['roles'])){
            switch($method){
                case 'add':
                    if(!in_array('create',$this->roles['roles'])){
                     die('unauthorised access');   
                    }
                    break;
                case 'edit':
                    if((!in_array('update',$this->roles['roles'])) && (!in_array('create',$this->roles['roles']))){
                        die('unauthorised accesss');
                    }
                    break;
                case 'delete':
                    if(!in_array('delete',$this->roles['roles'])){
                        die('unauthorised access');
                    }
                    break;
                case 'index':
                    if(!in_array('read',$this->roles['roles'])){
                        die('unauthorised access');
                    }
                default:
                    break;
            }
        }else{
            $data['msg']= 'Unauthorised access';
            redirect(base_url().'error/','refresh');
        }
		
	}

	public function index()
	{
            $data['ErrorMessages'] = '';
            $data['siteTitle'] = $this->lang->line('roles').' - '. SITE_NAME;
            $org_id = $this->session->userdata('org_id');
            $this->breadcrumbs->add('Roles', base_url().'role');
            $data['breadcrumbs'] = $this->breadcrumbs->output();
            $result = $this->role_model->role_list();
            if($org_id != 1){
                $role_id = array();
                foreach($result as $key=>$value){
                    $role_id[] = $value['role_id'];
                }
                if(count($role_id) > 0){
                    $role_users = $this->role_model->role_users_list($role_id);
                    $data['role_users'] = $role_users;
                }
            }
            
            $data['roles'] = $this->roles['roles'];
            $data['result'] = $result;
            $data['menu'] = $this->roles;
            $data['org_id'] = $org_id;
            $data['user_id'] = $this->session->userdata('user_id');
            //print_r($data);exit;
            $this->load->view('header', $data);
            $this->load->view('role/list', $data);
            $this->load->view('footer');
	}

	public function add()
	{
		$data['ErrorMessages'] = '';
		$data['siteTitle'] = $this->lang->line('add_role').' - '. SITE_NAME;
        $this->breadcrumbs->add('Roles', base_url().'role');
        $this->breadcrumbs->add('New Role ', base_url().'role/add');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		if (($this->input->server('REQUEST_METHOD') == 'POST')) {

			
			$role_name        		 = trim($this->input->post('role_name'));
			$role_desc        		 = trim($this->input->post('role_desc'));
            $organiser_id            = $this->input->post('org_id');
			$country_permission  	 = $this->input->post('countries');
			$domain_permission   	 = $this->input->post('domains');
			$department_permission   = $this->input->post('department');
			$category_permission  	 = $this->input->post('category');
			$roles_permission        = $this->input->post('roles');
			$users_permission        = $this->input->post('users');
			$forms_permission  	     = $this->input->post('forms');
            $location_permission     = $this->input->post('location');
			$organization_permission = $this->input->post('organization');
            $review_permission       = $this->input->post('reviews');
			if(isset($_POST['default'])){
				$default = $this->input->post('default');
			} 
			else{
				$default = 0;
			}
			$this->form_validation->set_rules('role_name', 'Role Name', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() == FALSE) {
				$data['ErrorMessages'] = validation_errors();
			} else {
				$roles = array(
                        'role_name' => $role_name,
                        'role_desc' => $role_desc,
                        'organiser_id' => $organiser_id,
                        'countries' =>$country_permission,
                        'domains' => $domain_permission,
                        'department' =>$department_permission,
                        'category' =>$category_permission,
                        'roles' => $roles_permission,
                        'users' =>$users_permission,
                        'forms' =>$forms_permission,
                        'location'=>$location_permission,
                        'organization' => $organization_permission,
                        'default' =>$default,
                        'status' =>'1',
                        'uuid' => $this->uuid->v4(),
                        'review' => $review_permission,
                        'created_by' =>$this->session->userdata('user_id')
				);
				$role_result = $this->role_model->role_add($roles);
				$this->session->set_flashdata('SucMessage', "Roles added Successfully");
				redirect(base_url() . 'role', 'refresh');
			}
		}
            $data['menu'] = $this->roles;
    		$this->load->view('header', $data);
    		$this->load->view('role/add', $data);
    		$this->load->view('footer');
	}

	public function edit($uuid = null)
	{
        $role_id = $this->role_model->check_role_exists($uuid);
        if(empty($role_id)){
            redirect(base_url().'error','refresh');
        }
        $this->breadcrumbs->add('Roles', base_url().'role');
        $this->breadcrumbs->add('Edit Role ', base_url().'role/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		$data['ErrorMessages'] = '';
		$data['siteTitle'] = $this->lang->line('edit_role').' - '. SITE_NAME;
    	if (($this->input->server('REQUEST_METHOD') == 'POST'))
    	{
            $role_name               = trim($this->input->post('role_name'));
            $role_desc               = trim($this->input->post('role_desc'));
            $organiser_id            = $this->input->post('org_id');
            $country_permission  	 = $this->input->post('countries');
            $domain_permission   	 = $this->input->post('domains');
            $department_permission   = $this->input->post('department');
            $category_permission  	 = $this->input->post('category');
            $roles_permission        = $this->input->post('roles');
            $users_permission        = $this->input->post('users');
            $forms_permission  	     = $this->input->post('forms');
            $location_permission        = $this->input->post('location');
            $organization_permission = $this->input->post('organization');
            $review_permission       = $this->input->post('reviews');
            if(isset($_POST['default'])){
                $default = $this->input->post('default');
            }
            else{
                $default = 0;
            }
    		$status = $this->input->post('status');
    		$this->form_validation->set_rules('role_name', 'Role Name', 'trim|required');
    	 	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    	 	if ($this->form_validation->run() == FALSE) {
    	 		$data['ErrorMessages'] = validation_errors();
    	 	} else {

    	 		$roles_update   = array(
                        'role_id' => $role_id,
                        'organiser_id' => $organiser_id,
                        'role_name' => $role_name,
                        'role_desc' =>$role_desc,
                        'countries' =>$country_permission,
                        'domains' => $domain_permission,
                        'department' =>$department_permission,
                        'category' =>$category_permission,
                        'roles' => $roles_permission,
                        'users' =>$users_permission,
                        'forms' =>$forms_permission,
                        'location'=>$location_permission,
                        'organization' => $organization_permission,
                        'default' => $default,
                        'review' => $review_permission,
                        'status' => $status
    	 		);
    	 		
    	 		$roles_updates = $this->role_model->role_update($roles_update);
    	 		$this->session->set_flashdata('SucMessage', 'Roles Updated Successfully');
    	 		redirect(base_url() . 'role', 'refresh');
    	 	}
    	}
	    if ($role_id != '') {
            /* get Role Info */
            $result = $this->role_model->role_info($role_id);
            $data['result'] = $result;  
	    }
        $data['menu'] = $this->roles;
        if(!access_edit($this->roles['roles'],'role',$this->session->userdata('user_id'),$result->created_by)){
                redirect(base_url().'error');
        }
	   $this->load->view('header', $data);
	   $this->load->view('role/edit', $data);
	   $this->load->view('footer');
	}
	 
	//Delete Function
	public function delete($uuid = null)
	{
        $role_id = $this->role_model->check_role_exists($uuid);
        if(empty($role_id)){
            redirect(base_url().'error','refresh');
        }
        $delete_role = $this->role_model->role_delete($role_id);
        if($delete_role){
            $msg='Role Deleted Successfully';
        }
        $this->session->set_flashdata('SucMessage', $msg);
        redirect(base_url() . 'role', 'refresh');
	}

    /* Role Preview */
    public function role_preview(){
        $uuid = $this->input->get('id');
        $role_id = $this->role_model->check_role_exists($uuid);
        if(empty($role_id)){
            redirect(base_url().'error','refresh');
        }
        $result = $this->role_model->role_info($role_id);
        $data['result'] = $result; 
        $this->load->view('role/preview', $data);
    }

}

