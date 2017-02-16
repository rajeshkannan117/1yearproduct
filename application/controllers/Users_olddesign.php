<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is login controller of vanderlande
 *
 * @package		CodeIgniter
 * @category	controller
 * @author		Karthik.TM
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
		$this->load->model('user_model');
		$this->load->model('department_model');
		$this->load->model('login_model');
		$this->load->helper('date');
		$this->load->library('email');
        $user_id = $this->session->userdata('user_id');
        //Check the user is logged in properly
		if($this->session->userdata('logged_in') != true)
		{
			redirect(base_url().'login/', 'refresh');
		}
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
                $data['siteTitle'] = 'User List - ' . SITE_NAME;
		$postvalue = array('user_token'=>$this->session->userdata('user_token'), 'org_token'=>$this->session->userdata('org_token'));
		/*if($this->session->userdata('org_id')){
			$postvalue = array('org_id'=>$this->session->userdata('org_id'));
		}
		else{
			$postvalue = array('org_id'=>0);	
		}*/
		$result=$this->user_model->get_users($this->session->userdata('org_id'));
		$data['result']=$result;		
		
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

	public function add()
	{

		$data['ErrorMessages']='';
		$data['menu'] = $this->login_model->assign_roles($this->session->userdata('user_id'));
		$data['siteTitle'] = 'Users  '.SITE_NAME;
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			$org = trim($this->input->post('org_id'));
			//$location = trim($this->input->post('loc_id'));
			$department = ($this->input->post('department'));
			$role_id = ($this->input->post('role_id'));
			$usr_firstname = $this->input->post('usr_firstname');
			$usr_email = $this->input->post('usr_email');
			$usr_phone = $this->input->post('usr_phone');
			$usr_lastname = $this->input->post('usr_lastname');
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


			if($this->session->userdata('org_id') == 1){
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
				//$uservalue = array("authToken"=>$OAuthSignatureUser, 'org_id'=>$org, 'loc_id'=>$location, 'user_name'=>$usr_name, 'password'=>$usr_psw, 'email'=>$usr_email, 'phone'=>$usr_phone);
				//$user_result = $this->comman_model->common_curl(SERVICE_URL.'user_add', $uservalue);
				if($this->session->userdata['org_id']==1){
				$uservalue = array("authToken"=>$OAuthSignatureUser, 'org_id'=>$org,'password'=>$usr_psw, 'department'=>$department,'role_id'=>$role_id, 'firstname'=>$usr_firstname,'lastname'=>$usr_lastname, 'email'=>$usr_email, 'phone'=>$usr_phone);
				}else{
				$uservalue = array("authToken"=>$OAuthSignatureUser, 'password'=>$usr_psw, 'org_id'=>$this->session->userdata['org_id'], 'department'=>$department,'role_id'=>$role_id, 'firstname'=>$usr_firstname,'lastname'=>$usr_lastname, 'email'=>$usr_email, 'phone'=>$usr_phone);
				}
				
				$user_result= $this->user_model->org_user_assign_role($uservalue);
				
				//$result=json_decode($org, TRUE);
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
		        $this->email->subject('FORMPRO Registration'); // replace it with relevant subject
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
		
		//$postvalue = array('user_token'=>$this->session->userdata('user_token'), 'org_token'=>$this->session->userdata('org_token'));
		if($this->session->userdata['org_id']==1){
			$data['org'] =$this->user_model->get_organizations($datas = array());
		}else{
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
			
				
			$data['dept'] =$this->department_model->department_list($org_id,$org_dept_not_in,$domain,$system_default);
		}
		$data['role'] =$this->user_model->get_roles($this->session->userdata('org_id'));
		 
		
		//$result_loc =$this->comman_model->common_curl(SERVICE_URL.'get_locations', $postvalue);
		//$data['loc'] = json_decode($result_loc, TRUE);
		
		$this->load->view('header',$data);
		$this->load->view('users/add', $data);
		$this->load->view('footer');
	}

	public function email_check($key) {
		//echo "entered";exit;
  		$email = $this->user_model->mail_exists($key);
  		if($email == 1){
  			$this->form_validation->set_message('email_check', 'Email already exists');
  			return false;
  		}
  		else{
  			return true;
  		}
  		
  		
	}

	public function edit($id = null)
	{
		$data['ErrorMessages']='';
		$data['menu'] = $this->login_model->assign_roles($this->session->userdata('user_id'));
		/*$config = array(array('field' => 'org_id','label' => 'Organization Name','rules' => 'trim|required'),
			array('field' => 'loc_id','label' => 'Location Name','rules' => 'trim|required'),
			array('field' => 'usr_name','label' => 'User Name','rules' => 'trim|required'),
			array('field' => 'usr_email','label' => 'User Email','rules' => 'trim|required|valid_email'),
			array('field' => 'usr_phone','label' => 'User Phone','rules' => 'trim|required'),
			array('field' => 'usr_psw','label' => 'Password','rules' => 'trim|required'));*/


			$config = array(array('field' => 'department[]','label' => 'Select Department','rules' => 'trim|required'),
			array('field' => 'role_id','label' => 'Select Role','rules' => 'trim|required'),
			//array('field' => 'usr_name','label' => 'User Name','rules' => 'trim|required'),
			array('field' => 'usr_email','label' => 'User Email','rules' => 'trim|required|valid_email'),
			array('field' => 'usr_phone','label' => 'User Phone','rules' => 'trim|required')
			//array('field' => 'usr_psw','label' => 'Password','rules' => 'trim|required')
			);

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run() == FALSE){
			
			$data['ErrorMessages'] = validation_errors();

		}else{
			$postvalue = array('user_id'=>$id, 'data'=>$this->input->post());
			$user_result=$this->user_model->user_update($postvalue);
			//$result=json_decode($result, TRUE);
			if($user_result!=''){
				$result['msg']='Successfully updated';
			}
			$this->session->set_flashdata('SucMessage', $result['msg']);
			redirect(base_url().'users/', 'refresh');
		}
		
		if($id!='')
		{

			$user_info = $this->user_model->get_org_user_info($id);
			//$data['result']=json_decode($user_info, TRUE);
			$user = array();
			foreach($user_info as $key=>$value){
				$user['firstname']=$value['firstname'];
				$user['lastname']=$value['lastname'];
				$user['id']=$value['id'];
				$user['email']=$value['email'];
				$user['phone']=$value['phone'];
				$user['org_id']=$value['org_id'];
				$user['dept_id']=$value['dept_id'];
				$user['role_id']=$value['role_id'];
				$user['domain_name']=$value['domain_name'];
				$user['country_name']=$value['country_name'];
				$user['org_name']=$value['org_name'];
				$user['role_name']=$value['role_name'];
				$user['department'][]=$value['dept_id'];

			}
			$data['user']=$user;
			//print_r($user);exit;
			$result_role =$this->user_model->get_roles($this->session->userdata('org_id'));
			$data['role'] = $result_role;
			$org_id = $this->session->userdata['org_id'];
			$org_details = $this->user_model->organization_details($org_id);
                        
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
			
				
			$data['dept'] =$this->department_model->department_list($org_id,$org_dept_not_in,$domain,$system_default);

			//print_r($postvalue1);exit;
			//$result_loc =$this->comman_model->common_curl(SERVICE_URL.'loc_list', $postvalue1);
			//$data['loc'] = json_decode($result_loc, TRUE);
		}
		$data['siteTitle'] = 'Users - ' . SITE_NAME;
		//$postvalue = array('user_token'=>$this->session->userdata('user_token'), 'org_token'=>$this->session->userdata('org_token'));		
		//$result_org =$this->comman_model->common_curl(SERVICE_URL.'get_organizations', $postvalue);
		//$data['org'] = json_decode($result_org, TRUE);
		
		$this->load->view('header',$data);
		$this->load->view('users/edit', $data);
		$this->load->view('footer');
	}
	
	
	public function delete($id = null)
	{

		$postvalue = array('user_id'=>$id, 'user_token'=>$this->session->userdata('user_token'), 'org_token'=>$this->session->userdata('org_token'));
		$resultval=$this->user_model->user_delete($postvalue);
		
		$resultval=json_decode($resultval, TRUE);
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
		//$org_id = $this->input->post('org_id');
		$org_id = $_REQUEST['org_id'];
		

		
        //$org_id = $this->session->userdata('org_id');
        
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
		//print_r($result_dom);
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
	
}

