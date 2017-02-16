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
//include APPPATH.'controllers/OAuth.php';
//include APPPATH.'controllers/common.php';
class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	
		$this->load->model('comman_model');
		$this->load->model('login_model');
		$this->load->language('menu');
		$this->load->language('dashboard');
		$this->load->library('breadcrumbs');
		$this->load->language('alert');
		$this->load->model('location_model');
		$this->load->model('user_model');
		$this->load->model('form_model');
		$this->load->model('alert_model');
		$this->load->helper('access');
        define_constants();
        $user_id = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');
        $this->roles = $this->login_model->assign_roles($user_id);
		$this->load->helper('date');
		
		//Check the user is logged in properly
		if($this->session->userdata('logged_in') != true)
		{
			redirect(base_url().'login/', 'refresh');
		}
	}
	
	public function index()
	{
		$user_id = $this->session->userdata('user_id');
        $data['siteTitle'] = 'Dashboard - FormPro';
        $data['menu'] = $this->roles;
        $data['user_id'] = $user_id;
        $data['ErrorMessages']='';
        $this->breadcrumbs->add('Dashboard', base_url().'dashboard');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $org_id = $this->session->userdata('org_id');
        $data['users'] = $this->user_model->organization_user_counts($org_id);
        $users_post = $this->user_model->get_user_post($user_id);
		$data['form_list'] = $this->form_model->form_list($org_id);
        $data['forms'] = $this->form_model->form_count($org_id);
        $data['location'] = $this->location_model->location_list_count($org_id);
        $data['location_list'] = $this->location_model->location_details($org_id);
        $submission = $this->form_model->form_submission($org_id);
        $data['submission'] = $submission;
        $data["alerts"] = $this->alert_model->getPendingAlertList($org_id);
       // print_r($data);exit;
        $this->load->view('header',$data);
        $this->load->view('dashboard', $data);
        $this->load->view('footer', $data);
	}

	//User session logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."login", 'refresh');
	}
	
}
