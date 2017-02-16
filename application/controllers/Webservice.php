<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WebCall
 *
 * This is an Webservice for vanderlande
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Saravanan M
 * @link		http://innoppl.com/
 */

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';
include APPPATH.'/controllers/common.php';

class Webservice extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('webservice_model');
		$this->form_validation->set_error_delimiters('', '');
		
		$segment = $this->uri->segment(2);
		
		if($segment != 'login' && $segment != 'logout' && $segment != 'organization_add' && $segment != 'get_organization_info' && $segment != 'location_add' && $segment != 'user_add' && $segment != 'get_user_info' && $segment != 'user_update' && $segment != 'organization_update' && $segment != 'org_location_list'){
				
			
		/*	$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);

			if(!isset($refined_data['user_token']))
			{
				$this->response(array('msg' => 'Request must contain user_token'), 400);
			}
			
			if(empty($refined_data['user_token']))
			{
				$this->response(array('msg' => 'User_token should not be empty'), 202);
			}
			
			if(!isset($refined_data['org_token']))
			{
				$this->response(array('msg' => 'Request must contain org_token'), 400);
			}
			
			if(empty($refined_data['org_token']))
			{
				$this->response(array('msg' => 'org_token should not be empty'), 202);
			}

			$org_token = $refined_data['org_token'];
			$organisation_token = $this->webservice_model->getDetailsWithOrganisationToken($org_token);

			if(empty($organisation_token))
			{
				$this->response(array('msg' => ORG_TOKEN_INVALID), 401);
			}

			$user_token = $refined_data['user_token'];
			$user_datails = $this->webservice_model->getDetailsWithUserToken($org_token, $user_token);
			if(empty($user_datails))
			{
				$this->response(array('msg' => USER_TOKEN_INVALID), 401);
			}*/
		}
		
	}
	
	function login_post()
	{
		$post_raw_data = $_POST;
		$refined_data = json_decode($post_raw_data['data'],true);
		
		if(isset($_POST))
		{
			$_POST['email']		   =	trim($refined_data['email']);
			$_POST['password']		=	trim($refined_data['password']);
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[80]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[15]');
			if($this->form_validation->run() == FALSE)
			{
				$this->response(array('msg' => validation_errors()), 202);
			}else
			{
				$result = $this->webservice_model->check_login($refined_data);
				$this->response(array('user_details'=>$result),200);
				
			}
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}

	function organization_add_post()
	{ 
		if(isset($_POST))
		{ 
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result=$this->webservice_model->organization_add($refined_data);
			$this->response(array('msg' => 'Successfully Added', 'org_id'=>$result),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function location_add_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->location_add($refined_data);
			$this->response(array('msg' => 'Successfully Added'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function user_add_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->user_add($refined_data);
			$this->response(array('msg' => 'Successfully Added'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	function getcountrylist_post(){

		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->getcountrylist($refined_data);
			$this->response(array('country'=>$result),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}

	}
	function getdefaultcountry_post(){

		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->getdefaultcountry($refined_data);
			$this->response(array('country'=>$result),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}

	}
	function country_add_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result=$this->webservice_model->country_add($refined_data);
			$this->response(array('msg' => 'Country Successfully Updated'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}

	function country_edit_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result=$this->webservice_model->country_edit($refined_data);
			$this->response(array('msg' => 'Country Successfully Updated'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}

	function get_country_info_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_country_info($refined_data);
	
			$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}

	function country_delete_post(){
		
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result=$this->webservice_model->country_delete($refined_data);
			$this->response(array('msg' => 'Country Successfully Deleted'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}

	function domain_add_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->domain_add($refined_data);
			$this->response(array('msg' => 'Successfully Added'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	function domain_list_post(){

		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->domain_list($refined_data);
			$this->response(array('domain'=>$result),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}

	}
	function domain_update_post(){

		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$default_array = $this->webservice_model->get_domain_info($refined_data['data']['domain_id']);
			$def = array();
			
			foreach($default_array['domain'] as $key=>$value){
			
				$def[]= $value['country_id'];

			}
			$result = $this->webservice_model->domain_update($refined_data,$def);
			$this->response(array('msg'=>'Domain Updated Successfully','domain'=>$result),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}

	}

	function domain_delete_post(){

		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result=$this->webservice_model->domain_delete($refined_data);
			$this->response(array('msg' => 'Domain Successfully Deleted'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}

	}

	function get_domain_info_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_domain_info($refined_data);
	
			$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}

	function department_add_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			//print_R($post_raw_data); exit;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->department_add($refined_data);
			$this->response(array('msg' => 'Department Successfully Added'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}

	function department_list_post(){

		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->department_list($refined_data);
			$this->response(array('department'=>$result),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}

	}

	function department_update_post(){

		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			
			/* returns  country id for the department */
			if(isset($refined_data['data']['countries']) && isset($refined_data['data']['domain'])){
			$country = $this->webservice_model->department_country($refined_data['data']['dept_id']);
				/* returns domain_id for the department */
			$domain = $this->webservice_model->department_domain($refined_data['data']['dept_id']);
		   }
		   else{
		   	$country = '';
		   	$domain = '';
		   }
			/* Update the Department Post */
			$result = $this->webservice_model->department_update($refined_data,$country,$domain);
			$this->response(array('msg'=>'Department Successfully Updated','department'=>$result),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}

	}

	function department_delete_post(){

		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result=$this->webservice_model->department_delete($refined_data);
			$this->response(array('msg' => 'Department Successfully Deleted'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}

	}

	function get_department_info_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_department_info($refined_data);
			$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}

	/* Categories List */

	function get_categories_get()
	{
	
		$result = $this->webservice_model->category_list();
			
		$this->response($result,200);
	
	}
	
	function get_categories_info_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_categories_info($refined_data);
			$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function category_add_post()
	{
	
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->category_add($refined_data);
			$this->response(array('msg' => 'Category has been Added successfully.'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function category_update_post()
	{
	
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->category_update($refined_data);
			$this->response(array('msg' => 'Category has been Update successfully.'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	/*function get_categories_info_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_categories_add();
			
		$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	
	}*/
	
	function category_delete_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->category_delete($refined_data);
			$this->response(array('msg' => 'Category has been deleted successfully.'),200);
				
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function organization_update_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result=$this->webservice_model->organization_update($refined_data);
			$this->response(array('msg' => 'Organization Successfully Updated'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function organization_delete_post(){
		
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result=$this->webservice_model->organization_delete($refined_data);
			$this->response(array('msg' => 'Organization Successfully Deleted'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	
	
	function get_organizations_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_organizations($refined_data);
			$this->response(array('org'=>$result),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function get_organization_info_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_organization_info($refined_data);
	
			$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function org_location_list_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->org_location_list($refined_data);
			$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function get_users_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_users($refined_data);
			$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function get_user_info_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_user_info($refined_data);
	
			$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function user_update_post(){
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->user_update($refined_data);
		
			$this->response(array('msg' => 'User has been updated successfully.'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function user_delete_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->user_delete($refined_data);
			$this->response(array('msg' => 'User has been deleted successfully.'),200);
		
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	
	// Roles Module Start //
	
	function role_add_post()
	{
		//echo "fdfdsf"; die;
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->role_add($refined_data);
			$this->response(array('msg' => 'Role has been Added successfully.'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	function role_update_post()
	{
	
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->role_update($refined_data);
			$this->response(array('msg' => 'Role has been Updated successfully.'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	function get_roles_get()
	{
	
		$result = $this->webservice_model->get_roles();
			
		$this->response(array('role'=>$result),200);
	
	}
	function get_role_info_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_role_info($refined_data);
	
			$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	function get_locations_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_locations($refined_data);
				
			$this->response($result,200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	function loc_list_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->loc_list($refined_data);
				
			$this->response($result,200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function org_user_list_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->org_user_list($refined_data);
				
			$this->response($result,200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	function role_user_list_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->role_user_list($refined_data);
				
			$this->response($result,200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	function role_delete_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->role_delete($refined_data);
			$this->response(array('msg' => 'User has been deleted successfully.'),200);
				
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	// Roles Module Stop //
	
	
	// Category Start //
	/*function get_categories_get()
	{
	
		$result = $this->webservice_model->get_categories();
			
		$this->response($result,200);
	
	}
	
	function get_categories_info_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->get_categories_info($refined_data);
	
			$this->response($result, 200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function category_add_post()
	{
	
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->category_add($refined_data);
			$this->response(array('msg' => 'Category has been Added successfully.'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function category_update_post()
	{
	
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->category_update($refined_data);
			$this->response(array('msg' => 'Category has been Update successfully.'),200);
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	
	function get_categories_add_get()
	{
	
		$result = $this->webservice_model->get_categories_add();
			
		$this->response($result,200);
	
	}
	
	function category_delete_post()
	{
		if(isset($_POST))
		{
			$post_raw_data = $_POST;
			$refined_data = json_decode($post_raw_data['data'], true);
			$result = $this->webservice_model->category_delete($refined_data);
			$this->response(array('msg' => 'Category has been deleted successfully.'),200);
				
		}
		else
		{
			$this->response(array('msg' => 'Invalid Request'),400);
		}
	}
	// Category Stop // */
}
