<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
* This is login controller of Formpro
*
* @package		CodeIgniter
* @category	controller
* @author		Rajeshkannan.C
* @link		http://innoppl.com/
*
*/

//include APPPATH.'controllers/OAuth.php';
//include APPPATH.'controllers/common.php';
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	
		$this->load->model('login_model');
		$this->load->language('login');
		$this->load->helper('email_send');
		//$this->load->library('recaptcha');
		
		//Check the user is logged in properly
		if($this->session->userdata('logged_in') == true)
		{
			redirect(base_url().'dashboard', 'refresh');
		}
	}
	
	public function index()
	{
    
    	$data['ErrorMessages']='';
		
		$data['siteTitle'] = 'Login - '.SITE_NAME;
		if (($this->input->server('REQUEST_METHOD') == 'POST') && isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']) )
		{
			//
			$user_email = trim($this->input->post('login_username'));
			$password = $this->input->post('login_password');
			$return = $this->input->post('return');
	        //your site secret key
	        $secret = '6LcikxEUAAAAAPYb3OAla53obAB5aSw2pxpK-fIN';
	        //get verify response data
	        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
	        $responseData = json_decode($verifyResponse);
		   /* if(!$responseData->success){
		    	$this->session->set_flashdata('ErrorMessages', 'Invalid Captcha');
				redirect(base_url().'login','refresh');
		    }*/
	        $config = array(array('field' => 'login_username','label' => 'User Name','rules' => 'trim|required'),
			array('field' => 'login_password','label' => 'Password','rules' => 'trim|required'));
			
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			  //$this->recaptcha->recaptcha_check_answer();

			if($this->form_validation->run() == FALSE){
				
				$data['ErrorMessages'] = validation_errors();
			}else{
				
				$loginValue = array('email'=>$user_email, 'password'=>$password); 
				/* Here Check Mailed Password is Activated or not */
				$check = $this->login_model->checkpassword_reset($user_email);
				/*$this->recaptcha->getIsValid();
				if(!$this->recaptcha->getIsValid()) {
					$this->session->set_flashdata('ErrorMessages', 'Incorrect captcha');
					redirect(base_url().'login','refresh');
				}*/
				if($check == 1 ){
					// Link is active and change the login screen page
					$this->session->set_flashdata('hiddenData', $user_email);
					redirect(base_url().'login/resetPassword','refresh');
				}else if($check == 2){
					//Links is not activated Please activate the link 
					$this->session->set_flashdata('ErrorMessages', 'Please activate link sent to your email address');
					redirect(base_url().'login','refresh');
				}else{
					$result['user_details']=$this->login_model->check_login($loginValue);		
					if(ISSET($result['user_details']) && $result['user_details'] != ''){
						if($return != ''){
								$decode = base64_decode($return);
								$redirect = str_replace('/formpro/', '', $decode);
								//print_r($result);exit;
								$this->session->set_userdata($result['user_details']);
								redirect(base_url().$redirect,'refresh');
						}else{
							//print_r($result);exit;
							$this->session->set_userdata($result['user_details']);
							redirect(base_url().'dashboard', 'refresh');
						}
					}
					else{
						$this->session->set_flashdata('ErrorMessages', 'Invalid Login Credential');
					}
				}
			}
		}else if(isset($_POST['g-recaptcha-response']) && empty($_POST['g-recaptcha-response'])){
			$this->session->set_flashdata('ErrorMessages', 'Invalid Captcha');
			//redirect(base_url().'login','refresh');
		}
		//$data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
		$this->load->view('login', $data);
		
	}
	public function password_check($password){
		$str = $password;
		$this->form_validation->set_message('password_check', 'Please follow the correct format');
	   if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
	   		
     		return TRUE;
   		}
   		return FALSE;
	}
	public function validate(){
		$email = $this->input->get('email');
		$validate = $this->login_model->login_email_check($email);
		if($validate == 1){
			echo 0;
		}else{
			echo 1;
		}
		die;
	}

	public function forgot_password(){
		$email = $this->input->post('email');
		$details = $this->login_model->get_user_details($email);
		$name = $details->name;
		$this->load->library('email');
	  	$type = array (
			'mailtype' => 'html',
			'charset'  => 'utf-8',
			'priority' => '1'
	   	);
	   /* Genereate random password */
	   // Stores forgot password details to the table
	    $activation = md5(base64_encode($email));	
	    $password = $this->randomPassword();				
	    $this->login_model->forgot_pwd($email,$activation,'web',$password);
	    $data = array(
     		'name'=> $name,  // Users Name
			'password' => $password,
			'activation'=>$activation,
			'link' => base_url().'login/activation'
      	);
	  	$this->email->initialize($type);
        $this->email->set_newline("\r\n");
		$this->email->from('no-reply@formpro.com', 'Innoforms Admin');
        $this->email->to($email);  // replace it with receiver mail id
    	$this->email->subject('Forgot Password'); // replace it with relevant subject 
	 	$body = $this->load->view('emails/forgotpwd.php',$data,TRUE);
    	$this->email->message($body);
		if($this->email->send())
		{

		}
		else
		{
		
		}
		$msg = 'Reset Password Link is sent to your email address';
		$this->session->set_flashdata('ErrorMessages', $msg);
		echo true;
	}
	public function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@_$^%';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 7; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}
	public function check_email(){
		$email = $this->input->post('email');
		$res = $this->login_model->email_check($email);
		if($res){
			echo '1';
		}
		else{
			echo '0';
		}
	}
	public function resetPassword(){
		if($this->session->flashdata('hiddenData')!=''){
			$email = $this->session->flashdata('hiddenData');
		}else{
			$email ='';
		}
		if($email || ($this->input->server('REQUEST_METHOD') == 'POST')){
			if($email){
				$details = $this->login_model->get_user_details($email);
				$data['user_id'] = $details->id;
			}
			if (($this->input->server('REQUEST_METHOD') == 'POST'))
			{
				$password = $this->input->post('password');
				$data = $this->input->post('data');
				$id = base64_decode($data);
				$config = array(array('field' => 'password','label' => 'Password','rules' => 'trim|required'),
				array('field' => 'password_repeat','label' => 'Confirm Password','rules' => 'trim|required'));
			
				$this->form_validation->set_rules($config);
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				if($this->form_validation->run() == FALSE){
					
					$data['ErrorMessages'] = validation_errors();
				}else{
					$this->login_model->update_password($id,$password);
					$msg = 'Password reset is success';
					$this->session->set_flashdata('ErrorMessages', $msg);
					redirect(base_url().'login','refresh');
				}
			}
			$this->load->view('resetpassword',$data);
		}else{
			redirect(base_url().'error');
		}
	}
	public function activation($link){
		$res = $this->login_model->check_activation_link($link);
		if(!empty($res->email)){
			if($res->active == 0 || $res->active == 1){
				$this->login_model->update_user_forgot_reset_pwd_table('1',$res->email);
				$this->session->set_flashdata('hiddenData', $res->email);
				redirect(base_url().'login/resetPassword','refresh');
			}else if($res->active == 2){
				$data['msg'] = 'Expired';
				$this->load->view('linkexpired',$data);
			}
		}else{
			//print_r($res);exit;
			redirect(base_url().'error');	
		}
	}
}
