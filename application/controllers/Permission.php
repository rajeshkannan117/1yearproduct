<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
* This is permission controller of formpro
*
* @package		CodeIgniter
* @category	controller
* @author		Rajeshkannan.C
* @link		http://innoppl.com/
*
*/

//include APPPATH.'controllers/OAuth.php';
//include APPPATH.'controllers/common.php';
class Permission extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('comman_model');
        $this->load->model('permission_model');
        $this->load->helper('date');
        
        //Check the user is logged in properly
        if ($this->session->userdata('logged_in') == false) {
            $this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);
            redirect(base_url() . 'login/', 'refresh');
        }
    }
     // List Category //
    public function index()
    {
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'Permission - ' . SITE_NAME;
        
        $data['result'] = $this->permission_model->list_permission();
        $this->load->view('header', $data);
        $this->load->view('permission/list', $data);
        $this->load->view('footer');
        
    }
     // Add Category //
    public function add()
    {
        $data['ErrorMessages'] = '';
        
        $data['siteTitle'] = 'Add Permission - ' . SITE_NAME;
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

        $permission_name        = trim($this->input->post('permission_name'));
        $permission_desc       = trim($this->input->post('permission_desc'));          
	    $this->form_validation->set_rules('permission_name', 'Permission Name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                $data['ErrorMessages'] = validation_errors();
            } else {
                
                $permission   = array(
                    'permission_name' =>  $permission_name,
                    'permission_desc' => $permission_desc,
		            'status' =>'1',
                    'created_by'=>$this->session->userdata('user_id')
                );
                $permission_result = $this->permission_model->permission_add($permission);
                $this->session->set_flashdata('SucMessage', 'Details Added Successfully');
                redirect(base_url() . 'permission', 'refresh');
            }
        }
      
        $this->load->view('header', $data);
        $this->load->view('permission/add', $data);
        $this->load->view('footer');
    }
    // Update Category //
    public function edit($permission_id = null)
    {
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'Edit Permission - ' . SITE_NAME;

	 if (($this->input->server('REQUEST_METHOD') == 'POST')) 
	 {
        $permission_name        = trim($this->input->post('permission_name'));
        $permission_desc       = trim($this->input->post('permission_desc'));
        $status       = $this->input->post('status');
          
	    $this->form_validation->set_rules('permission_name', 'Permission Name', 'required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data['ErrorMessages'] = validation_errors();
        } else {
            
           $permission   = array(
                'permission_name' =>  $permission_name,
                'permission_desc' => $permission_desc,
	            'status' =>$status,
	            'permission_id' =>$permission_id,
                'created_by'=>$this->session->userdata('user_id')
            );
            $permission_result = $this->permission_model->permission_update($permission);
            $this->session->set_flashdata('SucMessage', 'Details Updated Successfully');
            redirect(base_url() . 'permission', 'refresh');
        }
    }

	    if($permission_id != ''){
		   
		   $result_permission =$this->permission_model->permission_info($permission_id);
		   $data['permission'] = $result_permission; 

	    }
	    $this->load->view('header', $data);
	    $this->load->view('permission/edit', $data);
	   	$this->load->view('footer');
   }
    

	//Delete Function 
	public function delete($permission_id = null)
	{
			
		$delete_permission =$this->permission_model->permission_delete($permission_id);
		$this->session->set_flashdata('SucMessage', 'Message deleted Successfully');
        redirect(base_url() . 'permission', 'refresh');
        	
	}

}