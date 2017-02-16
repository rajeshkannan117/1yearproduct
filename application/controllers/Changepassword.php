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
class Changepassword extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	
		$this->load->model('login_model');
		$this->load->language('login');
		$this->load->helper('email_send');
		//$this->load->library('recaptcha');
	
	}
	public function index(){
		$user_id = $this->session->userdata('user_id');
		$data['user_id'] = $user_id;
		if($this->input->server('REQUEST_METHOD') == 'POST')
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
		$data['change_password'] = '1';
		$this->load->view('resetpassword',$data);
	}
}