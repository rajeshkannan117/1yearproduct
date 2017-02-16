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
class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	
		//$this->load->model('login_model');
		//$this->load->language('login');
		//$this->load->helper('email_send');
		
		//Check the user is logged in properly
		if($this->session->userdata('logged_in') == true)
		{
			redirect(base_url().'dashboard', 'refresh');
		}
	}
	function download(){
	    $this->load->helper('download');
	    $data = file_get_contents(APPPATH . 'innoforms-brochure.pdf'); // Read the file's contents
	    $name = 'innoforms-brochure.pdf';
	    force_download($name, $data);
	}
	public function index()
	{
    
   		$data['ErrorMessages']='';	
		$data['siteTitle'] = 'Login - '.SITE_NAME;
		$this->load->view('home', $data);
		
	}
	
}
