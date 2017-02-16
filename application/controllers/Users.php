<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is login controller of vanderlande
 *
 * @package		CodeIgniter
 * @category	controller
 * @author		Rajeshkannan.C
 * @link		http://innoppl.com/
 *
 */
include APPPATH.'controllers/OAuth.php';
include APPPATH.'controllers/common.php';
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('comman_model');
		$this->load->model('organization_model');
		$this->load->helper('cryptojs-aes.php');
		$this->load->language('menu');
		$this->load->language('user');
		$this->load->language('department');
		$this->load->model('user_model');
		$this->load->library('breadcrumbs');
		$this->load->model('role_model');
		$this->load->model('department_model');
		$this->load->model('location_model');
		$this->load->model('login_model');
		$this->load->helper('date');
		$this->load->library('email');
		$this->load->library('uuid');
        $user_id = $this->session->userdata('user_id');
        //Check the user is logged in properly
		if($this->session->userdata('logged_in') != true)
		{
			redirect(base_url().'login/', 'refresh');
		}
		$this->load->helper('access');
        define_constants();
        $this->roles = $this->login_model->assign_roles($user_id);
        $method = $this->router->fetch_method();
        switch($method){
            case 'add':
                if(!in_array('create',$this->roles['users'])){
                  redirect(base_url().'error');
                }
                break;
            case 'edit':
                if((!in_array('update',$this->roles['users'])) && (!in_array('create',$this->roles['users']))){
                     redirect(base_url().'error');
                }
                break;
            case 'delete':
                if(!in_array('delete',$this->roles['users'])){
                     redirect(base_url().'error');
                }
                break;
            case 'index':
                if(!in_array('read',$this->roles['users'])){
                     redirect(base_url().'error');
                }
            default:
                break;
        }
				
	}

	public function index()
	{
		$data['ErrorMessages']='';
		$data['roles'] = $this->roles['users'];
        $data['menu'] = $this->roles;
        $data['users'] = $this->roles['users'];
        $data['user_id'] = $this->session->userdata('user_id');
        $this->breadcrumbs->add('Users', base_url().'user');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $data['org_id'] = $this->session->userdata('org_id');
        $org_id = $this->session->userdata('org_id');
        $data['siteTitle'] = $this->lang->line('users').' - ' . SITE_NAME;
		$result=$this->user_model->get_users($org_id);
		$list = array();
		$form_users = array();
		if(!empty($result)){
			foreach($result as $key=>$value){
				$list[$value['id']]['id']=$value['id'];
				$list[$value['id']]['uuid'] = $value['uuid'];
				$list[$value['id']]['first_name']=$value['firstname'];
				$list[$value['id']]['last_name']=$value['lastname'];
				$list[$value['id']]['role_name']=$value['role_name'];
				$list[$value['id']]['email']=$value['email'];
				$list[$value['id']]['phone']=$value['phone'];
				$list[$value['id']]['org_id']=$value['org_id'];
				$list[$value['id']]['org_name']=$value['org_name'];
				$list[$value['id']]['activation']=$value['activation'];
				$list[$value['id']]['user_location'][] = $value['location'];
				$list[$value['id']]['created_by'] = $value['created_by'];
				$user[$value['id']]=$value['id'];
			}
			$user_form = $this->user_model->get_form_users($user,$org_id);
			foreach($user_form as $key=>$value){
				$form_users[$value['user_id']][$value['uuid']]=$value['form_name'];
			}

		}else{
			$list = '';
		}
		$locations = $this->user_model->get_user_location($user,$org_id);
		foreach($locations as $key=>$value){
			$location[$value['user_id']][$value['uuid']] = $value['location']; 
		}		
		$data['form_users'] = $form_users;
		$data['location'] = $location;		
		$data['result']=$list;		
		$this->load->view('header',$data);
		$this->load->view('users/list', $data);
		$this->load->view('footer',$data);

	}

	public function user_lists(){
		$org_id = $this->input->post('org_id');
		$users = $this->user_model->get_users($org_id);
		$html = '<select id="multiselectuser" required multiple="multiple" data-placeholder="Select Users..." name="users[]">';
		foreach($users as $key=>$value){
			$html.='<option value="'.$value['id'].'">'.$value['name'].'</option>';
		}
		$html.='</select>';
		echo $html; exit;
	}

	public function department_and_role(){
		$org_id = $this->session->userdata['org_id'];
		$org_details = $this->organization_model->organization_details($org_id);
		foreach($org_details as $key=>$value){
			$id = $value['id'];
			$org_dept_not_in = $value['org_dept_not_in'];
			$domain_id[] = $value['domain_id'];
			$system_default = $value['system_default'];
		}
		$domain = implode(',',$domain_id);
		if($org_dept_not_in == ""){
			$org_dept_not_in = "''";
		}
		if($domain == ""){
			$domain = "''";
		}
		if($system_default == ""){
			$system_default = "''";
		}	
		$dept_list = $this->department_model->department_list($org_id,$org_dept_not_in,$domain,$system_default);
		if(is_array($dept_list)){
			$return['dept'] = count($dept_list);
		}else{
			$return['dept'] = 0;
		}
		$role = $this->role_model->role_list($org_id);
		$return['role'] = count($role);
		$user_limit = $this->check_user_limit();
		//print_r($return);exit;
		if($return['dept'] == 0 && $return['role'] == 0){
			echo 'Atleast needed one Role and Department for user creation';
		}
		else if($return['dept'] == 0){
			echo 'Atleast needed one Department for user creation';	
		}
		else if($return['role'] == 0){
			echo 'Atleast needed one Role for user creation';
		}else if($user_limit == 0){
			echo 'User creation is exceeded for your plan of subscription';
		}
		else{
			echo false;
		}
		exit;
	}
	public function check_user_limit(){
		$org_id = $this->session->userdata['org_id'];
		if($org_id != 1){
			$org_details = $this->organization_model->organization_details($org_id);
			$sub_id = $org_details[0]['subscription_id'];
			/* Find total user in organization */
			$org_user_count = $this->user_model->organization_user_counts($org_id);
			$plan_user = $this->organization_model->check_plan_user($sub_id,$org_id);
			if($plan_user > $org_user_count){
				return 1;
			}else{
				return 0;
			}
		}
		else{
			return 1;
		}
	}
	public function assign_users(){
		$org_id = $this->session->userdata('org_id');
		$logged_user = 	$this->session->userdata('user_id');
		$superadmin = $this->comman_model->get_superadmin_id($org_id);
		//$get_org_users= $this->user_model->get_org_users($org_id);
		$loc_users = array();
		$sel_location = array();
        $sel_user = array();
        $assign = $this->input->get('assign');
        if($assign != '' && $assign == 'user'){
			/* Location */
			$location = $this->input->get('location');
			if($location != ''){
	            $sel_location = cryptoJsAesDecrypt('', $location);
	           	$sel_location = array_filter($sel_location);
	            $loc_id = implode(',',$sel_location);
	            $location_users = $this->comman_model->location_users_list($loc_id);
	            foreach($location_users as $k=>$v){
	            	if($v['id'] != $logged_user && $v['id'] != $superadmin){
	                	$loc_users[$v['id']] = $v['name'];
	            	}
	            }
	        }else{
	        	//print_r($_GET);exit;
	        }
	        $users = $this->input->get('users');
	        if($users != ''){
	            $sel_users = cryptoJsAesDecrypt('', $users);
	            if(is_string($sel_users)){
	            	$sel_user = explode(",",$sel_users);
	            }else{
	            	$sel_user = $sel_users;
	            }
	        }
	    }
        $data['sel_location'] = $sel_location;
        $data['org_users'] = $loc_users;
        $data['sel_user'] = $sel_user;
		$org_location = $this->location_model->location_list($org_id);
		$data['org_location'] = $org_location;
		$this->load->view('users/assign_users',$data);
	}
	public function location_users(){
		$org_id = $this->session->userdata('org_id');
		$logged_user = 	$this->session->userdata('user_id');
		$superadmin = $this->comman_model->get_superadmin_id($org_id);
		$loc_id = $_POST['loc_id'];
        if (!empty($loc_id)) {
            $loc_id = implode(',', $loc_id);
        } else {
            $loc_id = "''";
        }
        if ($_POST['user'] && !empty($_POST['user'])) {
            $users = $_POST['user'];
        } else {
            $users = array();
        }
        $multi_select = '<select id="assign_users" name="assign_users" class="chosen_select" multiple data-placeholder="Select Users">';
        $loc_users = $this->comman_model->location_users_list($loc_id);
        $location_users = array();
        foreach($loc_users as $k=>$v){
        	if($v['id'] != $logged_user && $v['id'] != $superadmin){
        		$location_users[$v['id']] = $v['name'];
        	}
        }
        foreach ($location_users as $k => $v) {
            if(in_array($k, $users)) {
                $select_id = "selected='selected'";
            } else {
                $select_id = '';
            }
            $multi_select .= '<option value="' . $k . '" ' . $select_id . '>' .$v. '</option>';
        }
        $multi_select .='</select>';
        echo $multi_select;
        exit;
	}
	public function add()
	{

		$data['ErrorMessages']='';
		$data['menu'] = $this->login_model->assign_roles($this->session->userdata('user_id'));
		$data['siteTitle'] = $this->lang->line('new_user').' - '.SITE_NAME;
		$org_id = $this->session->userdata['org_id'];
		$this->breadcrumbs->add('Users', base_url().'user');
        $this->breadcrumbs->add('New User ', base_url().'user/add');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			$org = trim($this->input->post('org_id'));
			$department = ($this->input->post('department'));
			$role_id = ($this->input->post('role_id'));
			$usr_firstname = $this->input->post('usr_firstname');
			$usr_email = $this->input->post('usr_email');
			$usr_phone = $this->input->post('usr_phone');
			$usr_lastname = $this->input->post('usr_lastname');
			$location_id = $this->input->post('location_id');
			$name = $usr_firstname." ".$usr_lastname;
            $usr_psw = md5('12345');
			$config = array(//array('field' => 'org_id','label' => 'Organization Name','rules' => 'trim|required'),
			//array('field' => 'loc_id','label' => 'Location Name','rules' => 'trim|required'),
			//array('field' => 'department','label' => 'Select Department','rules' => 'trim|required'),
			array('field' => 'role_id','label' => 'Select Role','rules' => 'trim|required'),
			array('field' => 'usr_firstname','label' => 'First Name','rules' => 'trim|required'),
			array('field' => 'usr_email','label' => 'User Email','rules' => 'trim|required|valid_email|callback_email_check'),
			array('field' => 'usr_phone','label' => 'User Phone','rules' => 'trim|required'),
			array('field' => 'usr_lastname','label' => 'Last Name','rules' => 'trim|required'));
			array('field' => 'location_id','label' => 'Choose organization location','rules' => 'trim|required');

			if($org_id == 1){
			$config[]=array_push($config,array('field' => 'org_id','label' => 'Organization Name','rules' => 'trim|required'));
			}
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run() == FALSE){
				$data['ErrorMessages'] = validation_errors();
				//print_r($data); exit;
			}else{
				$OAuthSignatureMethod= new OAuthSignatureMethod_HMAC_SHA1();
				$OAuthSignatureUser = $OAuthSignatureMethod->build_signature($usr_email,null,date('Y-m-d H:i:s'));
				if($org_id==1){
				$uservalue = array("authToken"=>$OAuthSignatureUser, 'org_id'=>$org,'password'=>$usr_psw, 'department'=>$department,'role_id'=>$role_id, 'firstname'=>$usr_firstname,'lastname'=>$usr_lastname, 'email'=>$usr_email, 'phone'=>$usr_phone,'uuid'=>$this->uuid->v4());
				}else{
				$uservalue = array("authToken"=>$OAuthSignatureUser, 'password'=>$usr_psw, 'org_id'=>$org_id, 'department'=>$department,'role_id'=>$role_id, 'firstname'=>$usr_firstname,'lastname'=>$usr_lastname, 'email'=>$usr_email, 'phone'=>$usr_phone,'uuid'=>$this->uuid->v4());
				}
				$user_result= $this->user_model->org_user_assign_role($uservalue);
				$this->insert_user_location($user_result,$location_id);
				if($user_result!=''){
					$result['msg']='Successfully Added';
				}
				//Email
				$type = array (
	            'mailtype' => 'html',
	            'charset'  => 'utf-8',
	            'priority' => '1'
		        );
		        $email = $usr_email;
		        $data = array(
	                'name'=> $name,  // Users Name
	                'email'=>$usr_email,
	                'password' => '12345',
		            'link' =>base_url()
		        );
		        $this->email->initialize($type);
		        $this->email->set_newline("\r\n");
		        $this->email->from('no-reply@formpro.com', 'Admin');
		        $this->email->to($email);  // replace it with receiver mail id
		        $this->email->subject('Form Pro Registration'); // replace it with relevant subject
		        $body = $this->load->view('emails/user_creation.php',$data,TRUE);
		        $this->email->message($body);
		        if($this->email->send())
		        {
		            //return $id.'#'.$org_user_id;    
		        }
		        else
		        {
		           //return $id.'#'.$org_user_id;
		        }
				$this->session->set_flashdata('SucMessage', $result['msg']);
				redirect(base_url().'users/', 'refresh');
			}
		}
		if($org_id ==1){
			$data['org'] =$this->user_model->get_organizations($datas = array());
			$data['user_posts'] = $this->user_model->user_post();
		}else{
			$org_details = $this->organization_model->organization_details($org_id);
			$data['user_posts'] = $this->user_model->user_post();
			foreach($org_details as $key=>$value){
				$id = $value['id'];
				$org_dept_not_in = $value['org_dept_not_in'];
				$domain_id[] = $value['domain_id'];
				$system_default = $value['system_default'];
			}
			$domain = implode(',',$domain_id);
			if($org_dept_not_in == ""){
				$org_dept_not_in = "''";
			}
			if($domain == ""){
				$domain = "''";
			}
			if($system_default == ""){
				$system_default = "''";
			}	
			$data['dept'] =$this->department_model->department_list($org_id,$org_dept_not_in,$domain,$system_default);
				//print_r($data);exit;
		}
		$data['location'] = $this->user_model->get_organization_location($org_id);
		$data['org_id'] = $org_id;
		$data['role'] =$this->user_model->get_roles($org_id);
		$this->load->view('header',$data);
		$this->load->view('users/add', $data);
		$this->load->view('footer');
	}
	public function insert_user_location($user_id,$location_id = array()){
		foreach($location_id as $key=>$value){
			$this->user_model->insert_user_location($user_id,$value);
		}
	}
	public function get_organization_location(){
		$org_id = $this->input->post('org_id');
		$users = $this->user_model->get_organization_location($org_id);
		$html = '<select id="multiselect_location" required multiple="multiple" data-placeholder="Select Users..." name="location_id[]"class="location_id">';
		foreach($users as $key=>$value){
			$html.='<option value="'.$value['id'].'">'.$value['location'].'</option>';
		}
		$html.='</select>';
		echo $html; exit;
	}

	public function email_check($key) {
  		$email = $this->user_model->mail_exists($key);
  		if($email == 1){
  			$this->form_validation->set_message('email_check', 'Email already exists');
  			return false;
  		}
  		else{
  			return true;
  		}
	}
	public function email_validate(){
		$email = $this->input->post('email');
		$validate = $this->user_model->mail_exists($email);
		if($validate == 1){
			echo 1;
			exit;
		}else{
			echo 0;
			exit;
		}
	}
	public function validate(){
		$email = $this->post('email');
		$validate = $this->user_model->login_email_check($email);
		if($validate == 1){
			echo 0;
		}else{
			echo 1;
		}
		die;
	}

	public function edit($uuid = null)
	{
		$id = $this->user_model->check_user_exists($uuid);
		if(empty($id)){
			redirect(base_url().'error');
		}
		$data['ErrorMessages']='';
		$this->breadcrumbs->add('Users', base_url().'users');
        $this->breadcrumbs->add('Edit User ', base_url().'users/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		$org_id = $this->session->userdata('org_id');
		$data['menu'] = $this->login_model->assign_roles($this->session->userdata('user_id'));
		$config = array(
			array('field' => 'location_id[]','label' => 'Location Name','rules' => 'trim|required'),
			array('field' => 'firstname','label' => 'First Name','rules' => 'trim|required'),
			array('field' => 'lastname','label' => 'Last Name','rules' => 'trim|required'),
			array('field' => 'usr_phone','label' => 'User Phone','rules' => 'trim|required'),
			array('field' => 'department[]','label' => 'Select Department','rules' => 'trim|required'),
			array('field' => 'role_id','label' => 'Select Role','rules' => 'trim|required')
			
			);

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run() == FALSE){
			//print_r(validation_errors());exit;
			$data['ErrorMessages'] = validation_errors();

		}else{
			//print_r($_POST);exit;
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$department = $this->input->post('department');
			$role = $this->input->post('role_id');
			$user_post_id = $this->input->post('user_post_id');
			$location = $this->input->post('location_id');
			$email = $this->input->post('usr_email');
			$phone = $this->input->post('usr_phone');
			$user_id = $this->input->post('user_id');
			$data = array(
					"user_id" => $user_id,
					"user_post_id" =>$user_post_id,
					"department" =>$department,
					"location" => $location,
					"firstname" => $firstname,
					"lastname" => $lastname,
					"role" => $role,
					"email" => $email,
					"phone" => $phone
				);
		
			$user_result=$this->user_model->user_update($data);
			if($user_result!=''){
				$result['msg']='Successfully updated';
			}
			$this->session->set_flashdata('SucMessage', $result['msg']);
			redirect(base_url().'users', 'refresh');
		}
		
		if($id!='')
		{
			$user_id = $id;
			$user_info = $this->user_model->get_org_user_info($id);

			$user = array();

			foreach($user_info as $key=>$value){
				$user['firstname']=$value['firstname'];
				$user['lastname']=$value['lastname'];
				$user['id']=$value['id'];
				$user['email']=$value['email'];
				$user['phone']=$value['phone'];
				$user['org_id']=$value['org_id'];
				$user['role_id']=$value['role_id'];
				$user['user_post']=$value['user_post'];
				$user['domain_name']=$value['domain_name'];
				$user['country_name']=$value['country_name'];
				$user['org_name']=$value['org_name'];
				//$user['dept'][]= $value['dept_id'];
				$user_org_id = $value['org_id'];
			}
			$user_dept = $this->user_model->get_user_department($user_id);
			if(count($user_dept) > 0){
				foreach($user_dept as $key=>$value){
					$user['dept'][]=$value['dept_id'];
				}
			}else{
				$user['dept'] = array();
			}
			$data['user']=$user;

			$result_role =$this->user_model->get_roles($user['org_id']);
			$data['role'] = $result_role;
			$data['user_id'] = $user_id;
			$org_details = $this->user_model->organization_details($user_org_id);
			foreach($org_details as $key=>$value){
				$id = $value['id'];
				$org_dept_not_in = $value['org_dept_not_in'];
				$domain_id[] = $value['domain_id'];
				$system_default = $value['system_default'];
			}
            if($domain_id == ""){
                $domain = "''";
            }else{
			   $domain = implode(',',$domain_id);
            }
			if($org_dept_not_in == ""){
				$org_dept_not_in = "''";
			}
			if($system_default == ""){
				$system_default = "''";
			}
			//echo $id;
			$data['user_location'] = $this->user_model->get_users_location($user_id,$user['org_id']);
			$data['organization_location'] = $this->user_model->get_organization_location($user['org_id']);
			//print_r($data);exit;
			$data['dept'] =$this->department_model->department_list($user_org_id,$org_dept_not_in,$domain,$system_default);
		}
		$data['siteTitle'] = $this->lang->line('edit_user').' - '.SITE_NAME;
		//print_r($data); exit;
		$this->load->view('header',$data);
		$this->load->view('users/edit', $data);
		$this->load->view('footer');
	}
	
	
	public function delete($uuid = null)
	{	
		$id = $this->user_model->check_user_exists($uuid);
		if(empty($id)){
			redirect(base_url().'error');
		}
		$resultval = $this->user_model->user_delete($id);
		if($resultval!=''){
			$result['msg']='Successfully Deleted';
		}
		$this->session->set_flashdata('SucMessage', $result['msg']);
		redirect(base_url().'users/', 'refresh');
	}
	
	public function ajaxLocation()
	{
		if(isset($_POST['org_id']))
		{
			$org_id=$_POST['org_id'];
			$org_location=$this->comman_model->common_curl(SERVICE_URL.'org_location_list', $org_id);
			
			$org_location_list = json_decode($org_location, TRUE);
			if(count($org_location_list)>0)
			{
				$i=0;
				$change_loc='<option value="">Choose..</option>';
				foreach ($org_location_list as $key => $value) {
					$change_loc.='<option value = '.$value['id'].'>'.$value['location_name'] . '</option>';
				}
				echo $change_loc;
			}
			else
			{
				echo '<option value="">Choose..</option>';
			}
		}
	}




	public function org_details()
	{
		$org_id = $_REQUEST['org_id'];
        $org_info = $this->comman_model->getorg_info($org_id);
        if($org_info->org_dept_not_in=='')
        {
            $dept_not_in = "''";
        }else{
            $dept_not_in = $org_info->org_dept_not_in;
        }
        if($org_id!=1)
        {
            $org_domain = $this->comman_model->getDomainlist_org($org_id);
            $orgdomain_arr = array();
            foreach ($org_domain as $key => $value) {
                $orgdomain_arr[] = $value['domain_id'];
            }
            $orgdomain_in = implode(',', $orgdomain_arr);
        }else{
            $orgdomain_in = "''";
        }
        $system_default = $org_info->system_default;
		$result_loc =$this->comman_model->get_org_country($org_id);
		$result_dom =$this->comman_model->get_org_domain($org_id);
		//print_r($result_dom);exit;		
		$result_dept =	$this->department_model->department_list($org_id,$dept_not_in,$orgdomain_in,$system_default);
		//$result_users =$this->user_model->get_roles($org_id);
		//$data['domain'] = $result_loc;
		$data[]= '<input type="text" class="md-input" name="location" value="'.$result_loc[0]['country_name'].'" disabled/>';

		$data[]= '<input type="text" class="md-input" name="domain" value="'.$result_dom[0]['domain_name'].'" disabled/>';


		$hotl = '';
               // print_r($result_dept); exit;
		if($result_dept['0']['dept_id'] > 0)
		{
			if(!empty($result_dept)){
				$hotl .= "<select id='multiselect_department' class='department_change' required multiple='multiple' data-placeholder='Select Department...'' name='department[]' >
			  ";
				foreach($result_dept as $key=>$domain){
						
					$hotl .="<option value='".$domain['dept_id']."'> ".$domain['dept_name']." </option>";
				}

			$hotl .='</select>';
			}
		}

		$data[]=$hotl;
		/* Get user location */
		$html = ' ';
			$users = $this->user_model->get_organization_location($org_id);
		$html = "<select id='multiselect_location' required multiple='multiple' data-placeholder='Select Users...' name='location_id[]' class='location_id location_chosen'>";

		foreach($users as $key=>$value){
			$sel = ($value['headbranch'])?" selected ":" ";
			$html.="<option value='".$value['location_id']."'".$sel.">".$value['location']."</option>";
		}
		$html.="</select>";
		//echo $html; exit;
		$data['org_location'] = $html;
		/* Users */

		$org_user = ' ';
			$org_users = $this->user_model->get_org_users($org_id);
		$org_user .= "<select id='multiselect_users' required multiple='multiple' data-placeholder='Select Users...' name='users[]'>";

		foreach($org_users as $key=>$value){
			$org_user .="<option value='".$value['id']."'>".$value['name']."</option>";
		}
		$org_user .="</select>";
		//echo $html; exit;
		$data['org_user'] = $org_user;
		$data['org_country'] = $result_loc[0]['country_name'];
		/* Get Organization roles */
		$org_roles = $this->role_model->role_list($org_id);
		$roles = '';
		if(count($org_roles) > 0){
			$roles .='<select id="val_select" name="role_id" class="chosen_select org_change" required >';
			foreach($org_roles as $key=>$value){
				$roles .="<option value='".$value['role_id']."'>".$value['role_name']."</option>";
			}
			$roles .="</select>";
		}
		else{
			$roles .='Selected Organization has no roles Please login as organization super admin and create some roles';
		}
		$data['org_roles'] = $roles;
		/*$user = '';
		if($result_users[0]['id'] > 0)
		{
			if(!empty($result_users)){
				$user .= "<select id='val_select' name='role_id' class='org_change' required data-md-selectize>";
				foreach($result_users as $key=>$role){
						
					$user .="<option value='".$role['role_id']."'> ".$role['role_name']." </option>";
				}

			$user .='</select>';
			}
		}

		$data[]=$user;*/
//print_r($data);
		echo json_encode($data);
	}
	public function user_preview(){
		$uuid = $this->input->get('id');
		$id = $this->user_model->check_user_exists($uuid);
		if(empty($id)){
			redirect(base_url().'error');
		}
		$user_info = $this->user_model->get_org_user_info($id);
		$user = array();
		foreach($user_info as $key=>$value){
			$user['firstname']=$value['firstname'];
			$user['lastname']=$value['lastname'];
			$user['id']=$value['id'];
			$user['email']=$value['email'];
			$user['phone']=$value['phone'];
			$user['org_id']=$value['org_id'];
			$user['role_id']=$value['role_id'];
			$user['user_post']=$value['user_post'];
			$user['domain_name']=$value['domain_name'];
			$user['country_name']=$value['country_name'];
			$user['org_name']=$value['org_name'];
			$user['role_name'] = $value['role_name'];
			$user_org_id = $value['org_id'];
		}
		$user_dept = $this->user_model->get_user_department($id);
			if(count($user_dept) > 0){
				foreach($user_dept as $key=>$value){
					$user['dept_name'][]=$value['dept_name'];
				}
			}else{
				$user['dept_name'] = array();
			}
		$location = $this->user_model->get_users_location_name($user['id'],$user['org_id']);
		$user['location'] = implode(",",$location);
		$user['dept_name'] = implode(",",$user['dept_name']);
		$data['user']=$user;
		$result_role =$this->user_model->get_roles($user['org_id']);
		$data['role'] = $result_role;
		$org_details = $this->user_model->organization_details($user_org_id);
		$this->load->view('users/preview',$data);
	}	
}

