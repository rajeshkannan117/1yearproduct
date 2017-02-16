<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is login controller of vanderlande
 *
 * @package		CodeIgniter
 * @category	controller
 * @author		Amitha.K
 * @link		http://innoppl.com/
 *
 */
include APPPATH.'controllers/OAuth.php';
include APPPATH.'controllers/common.php';
class Myprofile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('comman_model');
		$this->load->model('myprofile_model');
		$this->load->model('login_model');
		$this->load->library('breadcrumbs');
		$this->load->language('menu');
		$this->load->helper('date');
		$this->load->model('department_model');
		$this->load->helper('access_helper');
		define_constants();
		//Check the user is logged in properly
		if($this->session->userdata('logged_in') != true)
		{
			redirect(base_url().'login/', 'refresh');
		}
	}

	/*public function index()
	{
		$data['ErrorMessages']='';

		//$postvalue = array('user_token'=>$this->session->userdata('user_token'), 'org_token'=>$this->session->userdata('org_token'));
		//$result=$this->myprofile_model->user_details($postvalue);
		//$data['result']=json_decode($result, TRUE);
		
		$this->load->view('header',$data);
		$this->load->view('myprofile/view', $data);
		$this->load->view('footer',$data);
	}*/


	
	public function edit()
	{
		
		$id = $this->session->userdata('user_id');
		$data['ErrorMessages']='';
		$data['siteTitle'] = 'My Profile - '.SITE_NAME;
		$this->breadcrumbs->add('MyProfle', base_url().'myprofile/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		$data['menu'] = $this->login_model->assign_roles($this->session->userdata('user_id'));
		//print_r($data);exit;
		$config = array(array('field' => 'firstname','label' => 'First Name','rules' => 'trim|required'),
		array('field' => 'lastname','label' => 'Last Name','rules' => 'trim|required'),
		array('field' => 'usr_email','label' => 'User Email','rules' => 'trim|required|valid_email'),
		array('field' => 'usr_phone','label' => 'User Phone','rules' => 'trim|required'));
		//print_r($_POST);exit;
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run() == FALSE){
			$data['ErrorMessages'] = validation_errors();
		}else{
			//print_r($_FILES);exit;
			if(isset($_FILES['image']['name']) && $_FILES['image']['name'] !='')
			{
				$fileExtension2 = explode(".", $_FILES['image']['name']);
				$fileExt = array_pop( $fileExtension2 );
				$filename = time().'-'.md5($_FILES['image']['name']).".".$fileExt;
				$path = IMAGE_PATH;
				//echo chmod($path, 0777);
				$config['upload_path'] = $path;
				$config['allowed_types'] = '*';
				$config['file_name'] = $filename;
				$this->session->userdata['profilepic'] = $filename;
				$image_path = $filename;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('image'))
				{
					$error = array('error' => $this->upload->display_errors());
					//print_r($error);exit;
				}
				else
				{
					$this->session->set_userdata(array('profilepic'=>$filename));
					$uploaddata = array('upload_data' => $this->upload->data());
					$filename = $uploaddata['upload_data']['file_name'];
					$this->_createThumbnail($filename,IMAGE_PATH,THUMB_IMAGE_PATH);
				}
			}
			elseif (isset($_POST['image']))
			{
				$filename=$_POST['image'];
			}
			else
			{
				$filename='';
			}
			
			$postvalue = array('user_id'=>$id, 'image'=>$filename, 'data'=>$this->input->post());
			$result=$this->myprofile_model->user_update($postvalue);
			$this->session->set_userdata('name',$_POST['firstname']);
			$this->session->set_flashdata('SucMessage', 'Your details updated Successfully');
			//$this->session->set_flashdata('SucMessage', $result['msg']);
			redirect(base_url().'dashboard', 'refresh');
		}
		
		if($id!='')
		{
			$result=$this->myprofile_model->user_details($id);
			$user = array();
			foreach($result['user'] as $key => $value){

				$user['firstname'] = $value['firstname'];
				$user['lastname'] = $value['lastname'];
				$user['domain_name'] = $value['domain_name'];
				$user['email'] = $value['email'];
				$user['phone'] = $value['phone'];
				$user['imgname'] = $value['imgname'];
				$user['country_name'] = $value['country_name'];
				$user['org_name'] = $value['org_name'];
				$user['id'] = $value['id'];
			}
			
			$data['user']=$user;

		}
		//print_r($data);exit;
		$this->load->view('header',$data);
		$this->load->view('myprofile/view', $data);
		$this->load->view('footer',$data);
	}
	
	public function delete($id = null)
	{
		$postvalue = array('org_id'=>$id, 'user_token'=>$this->session->userdata('user_token'), 'org_token'=>$this->session->userdata('org_token'));
		//$result=$this->comman_model->common_curl(SERVICE_URL.'organization_delete', $postvalue);
		$resultvalue = $this->organization_model->organization_delete($postvalue);
		//$result=json_decode($result, TRUE);
		if($resultvalue){
			$result['msg']='Organization Successfully Deleted';
		}
		$this->session->set_flashdata('SucMessage', $result['msg']);
		redirect(base_url().'organization/', 'refresh');
	}
	
	//User profile image thumbnail resizing
	public function _createThumbnail($filename,$imagepath,$thumb_path)
	{
		//echo substr($thumb_path,1).$filename;exit;
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $imagepath.$filename;
		$config['new_image']='/'.substr($thumb_path,1);
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['overwrite'] = true;
		$config['thumb_marker'] = '';
		$config['width']  = 50;
		$config['height'] = 50;
		$config['master_dim'] = 'auto';
	
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		if ( ! $this->image_lib->resize())
		{
        	echo $this->image_lib->display_errors();
		}
		//$this->image_lib->resize();
		$this->image_lib->clear();
		//echo $this->image_lib->display_errors();exit;
	}

	//User session logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."login", 'refresh');
	}

}
