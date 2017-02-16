<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is Role management controller of Dynamic forms
 *
 * @package        CodeIgniter
 * @category            controller
 * @author        Vimala
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
		$this->load->helper('date');

		//Check the user is logged in properly
		if ($this->session->userdata('logged_in') == false) {
			redirect(base_url() . 'login/', 'refresh');
		}
		
	}

	public function index()
	{
		$data['ErrorMessages'] = '';
		$data['siteTitle']     = 'Role - ' . SITE_NAME;



		$result         = $this->comman_model->common_list_curl(SERVICE_URL . 'get_roles');
		$data['result'] = json_decode($result, TRUE);
		$this->load->view('header', $data);
		$this->load->view('role/list', $data);
		$this->load->view('footer');

	}

	public function add()
	{
		$data['ErrorMessages'] = '';

		$data['siteTitle'] = 'Role - ' . SITE_NAME;
		if (($this->input->server('REQUEST_METHOD') == 'POST')) {

			//print_r($_POST);exit;
			$role        = trim($this->input->post('role'));
			$org_id        = trim($this->input->post('org_id'));
			$loc_id        = trim($this->input->post('loc_id'));
			$usersId        = $this->input->post('usersId');
			$form_add = $this->input->post('form_add');
			$form_update = $this->input->post('form_update');
			$form_view = $this->input->post('form_view');
			$form_delete = $this->input->post('form_delete');

			$this->form_validation->set_rules('org_id', 'Organization', 'required');
			$this->form_validation->set_rules('loc_id', 'Location', 'required');
			$this->form_validation->set_rules('role', 'Role Name', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() == FALSE) {
				$data['ErrorMessages'] = validation_errors();
			} else {

				$uservalue   = array(
                    'role' => $role,
                    "form_add" => $form_add,
		    'form_update' =>$form_update,
		    'form_view' =>$form_view,
		    'form_delete' =>$form_delete,
                    'org_id' => $org_id,
		    'loc_id' => $loc_id,
		    'usersId' => $usersId 
				);
				$user_result = $this->comman_model->common_curl(SERVICE_URL . 'role_add', $uservalue);
				$result      = json_decode($user_result, TRUE);
				$this->session->set_flashdata('SucMessage', $result['msg']);
				redirect(base_url() . 'role', 'refresh');
			}
		}


		$postvalue = array('user_token'=>$this->session->userdata('user_token'), 'org_token'=>$this->session->userdata('org_token'));
		$result_org =$this->comman_model->common_curl(SERVICE_URL.'get_organizations', $postvalue);

		$data['org'] = json_decode($result_org, TRUE);

		$result_loc =$this->comman_model->common_curl(SERVICE_URL.'get_locations', $postvalue);

		$data['loc'] = json_decode($result_loc, TRUE);



		$this->load->view('header', $data);
		$this->load->view('role/add', $data);
		$this->load->view('footer');
	}

	public function edit($roleId = null)
	{
		$data['ErrorMessages'] = '';
		$data['siteTitle']     = 'Role - ' . SITE_NAME;

	 if (($this->input->server('REQUEST_METHOD') == 'POST'))
	 {
	 	$role = trim($this->input->post('role'));
	 	$form_add = $this->input->post('form_add');
	 	$form_update = $this->input->post('form_update');
	 	$form_view = $this->input->post('form_view');
	 	$form_delete = $this->input->post('form_delete');
	 	$roleId = $this->input->post('roleId');
	 	$org_id = trim($this->input->post('org_id'));
	 	$loc_id = trim($this->input->post('loc_id'));
	 	$usersId = $this->input->post('usersId');

	 	$this->form_validation->set_rules('org_id', 'Organization', 'required');
	 	$this->form_validation->set_rules('loc_id', 'Location', 'required');
	 	$this->form_validation->set_rules('role', 'Role Name', 'trim|required');
	 	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	 	if ($this->form_validation->run() == FALSE) {
	 		$data['ErrorMessages'] = validation_errors();
	 	} else {

	 		$uservalue   = array(
            'role' => $role,
            'form_add' => $form_add,
		    'form_update' =>$form_update,
		    'form_view' =>$form_view,
		    'form_delete' =>$form_delete,
		    'roleId' => $roleId,
		    'org_id' => $org_id,
		    'loc_id' => $loc_id,
		    'usersId' => $usersId 
	 		);
	 		$user_result = $this->comman_model->common_curl(SERVICE_URL . 'role_update', $uservalue);
	 		$result      = json_decode($user_result, TRUE);
	 		$this->session->set_flashdata('SucMessage', $result['msg']);
	 		redirect(base_url() . 'role', 'refresh');
	 	}
	 }

	 $postvalue = array('user_token'=>$this->session->userdata('user_token'), 'org_token'=>$this->session->userdata('org_token'));
	 $result_org =$this->comman_model->common_curl(SERVICE_URL.'get_organizations', $postvalue);
	 $data['org'] = json_decode($result_org, TRUE);

	 if ($roleId != '') {
	 	$role_info      = $this->comman_model->common_curl(SERVICE_URL . 'get_role_info', $roleId);
	 	$data['result'] = json_decode($role_info, TRUE);

	 	$postvalue1 = array('org_id'=>$data['result']['0']['org_id']);

	 	$result_loc =$this->comman_model->common_curl(SERVICE_URL.'loc_list', $postvalue1);
	 	$data['loc'] = json_decode($result_loc, TRUE);

	 	$result_user =$this->comman_model->common_curl(SERVICE_URL.'org_user_list', $postvalue1);
	 	$data['user_arr'] = json_decode($result_user, TRUE);

	 	$result_role_user =$this->comman_model->common_curl(SERVICE_URL.'role_user_list', array('role_id'=>$roleId));
	 	$data['role_user_arr'] = json_decode($result_role_user, TRUE);
	 }
	 $this->load->view('header', $data);
	 $this->load->view('role/edit', $data);
		$this->load->view('footer');
	}
	 
	// fillter Location list based on Organization //
	function loc_list()
	{
		$org_id = $this->input->post('org_id');
		$postvalue = array('org_id'=>$org_id);


		$result_loc =$this->comman_model->common_curl(SERVICE_URL.'loc_list', $postvalue);

		$data['loc'] = json_decode($result_loc, TRUE);
		//print_r($data['loc']);exit;
		$hotl = "<select id='val_select' name='loc_id' required data-md-selectize >
			  <option value=''> Select </option>";
		if($org_id)
		{
			if(!empty($data['loc'])){
				foreach($data['loc'] as $user){
						
					$hotl .="<option   value='".$user['id']."'> ".$user['location_name']." </option>";
				}

			}else
			$hotl .="<option   value='1'> No Records </option>";
		}
		$hotl .='</select>';

		$result_user =$this->comman_model->common_curl(SERVICE_URL.'org_user_list', $postvalue);

		$user_arr = json_decode($result_user, TRUE);
			

		if($org_id)
		{
			if(!empty($user_arr)){
				$user = '<ul class="md-list md-list-addon" ><h4>User Lists</h4>';
				foreach($user_arr as $users){
						
					$user   .="<li><div class='md-list-addon-element'><input type='checkbox' data-md-icheck name='usersId[]' value='".$users['user_id']."' /></div><div class='md-list-content' style='padding-top:9px;' >".$users['user_name']."</div></li>";
				}
				$user .= "</ul>";
			}else
			$user = "";

				
		}

			
		echo $hotl.'#'.$user;
			
	}

	//Delete Function
	public function delete()
	{
		$id = $this->input->get('id');
			
		$postvalue = array('role_id'=>$id, 'user_token'=>$this->session->userdata('user_token'), 'org_token'=>$this->session->userdata('org_token'));
		$delete_role =$this->comman_model->common_curl(SERVICE_URL.'role_delete', $postvalue);

		$result = json_decode($delete_role, TRUE);
		$this->session->set_flashdata('SucMessage', $result['msg']);
		redirect(base_url() . 'role', 'refresh');
	}

}

