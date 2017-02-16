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
class Organization extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('comman_model');
		$this->load->model('category_model');
		$this->load->model('webservice_model');
		$this->load->model('organization_model');
		$this->load->model('department_model');
		$this->load->model('country_model');
		$this->load->model('login_model');
		$this->load->helper('date');
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
                if(!in_array('create',$this->roles['organization'])){
                 die('unauthorised access');   
                }
                break;
            case 'edit':
                if((!in_array('update',$this->roles['organization'])) && (!in_array('create',$this->roles['organization']))){
                    die('unauthorised accesss');
                }
                break;
            case 'delete':
                if(!in_array('delete',$this->roles['organization'])){
                    die('unauthorised access');
                }
                break;
            case 'index':
                if(!in_array('read',$this->roles['organization'])){
                    die('unauthorised access');
                }
            default:
                break;
        }
		
	}

	public function index()
	{
		$data['ErrorMessages']='';

                if($this->session->userdata('user_id')==1)
                {                
                    $data['result'] = $this->organization_model->get_organisation($this->session->userdata('user_id'));
                }else{
                    $data['result'] = array();
                }
		
		$data['roles'] = $this->roles['organization'];
        $data['menu'] = $this->roles;
        $data['siteTitle'] = 'Organization List';
        $data['user_id'] = $this->session->userdata('user_id');
		$this->load->view('header',$data);
		$this->load->view('organization/list', $data);
		$this->load->view('footer',$data);
	}


	public function add()
	{
		$data['ErrorMessages']='';

		$data['siteTitle'] = 'Organization - '.SITE_NAME;
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			$org_name = trim($this->input->post('org_name'));
			$location_name = $this->input->post('location_name');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$countries = $this->input->post('countries');
			$zip = $this->input->post('zip');
			$usr_name = $this->input->post('usr_name');
			$usr_email = $this->input->post('usr_email');
			$usr_phone = $this->input->post('usr_phone');
			//$usr_psw = $this->input->post('usr_psw');
			$default = $this->input->post('default');
			$domain = $this->input->post('domain');
			
			//array('field' => 'usr_psw','label' => 'Password','rules' => 'trim|required'),
			$config = array(array('field' => 'org_name','label' => 'Organization Name','rules' => 'trim|required'),
			array('field' => 'location_name[]','label' => 'Location Name','rules' => 'trim|required'),
			array('field' => 'address[]','label' => 'Address','rules' => 'trim|required'),
			array('field' => 'city[]','label' => 'City','rules' => 'trim|required'),
			array('field' => 'state[]','label' => 'State','rules' => 'trim|required'),
			array('field' => 'countries','label' => 'Select Countries','rules' => 'trim|required'),
			array('field' => 'zip[]','label' => 'Zip code','rules' => 'trim|required'),
			array('field' => 'usr_name','label' => 'User Name','rules' => 'trim|required'),
			array('field' => 'usr_email','label' => 'User Email','rules' => 'trim|required|valid_email'),
			array('field' => 'usr_phone','label' => 'User Phone','rules' => 'trim|required'),
			
			array('field' => 'domain','label' => 'Select Domain','rules' => 'trim|required'));

				
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run() == FALSE){
				$data['ErrorMessages'] = validation_errors();
			}else{
				if(isset($_FILES['org_logo']['name']) && $_FILES['org_logo']['name']!='')
				{ 
					$fileExtension2 = explode(".", $_FILES['org_logo']['name']);
					$fileExt = array_pop( $fileExtension2 );
					$filename = time().'-'.md5($_FILES['org_logo']['name']).".".$fileExt;
					$config['upload_path'] = LOGOS_IMAGE_PATH;
					$config['allowed_types'] = 'jpg|png|jpeg|gif';
					$config['file_name'] = $filename;

					$image_path = $filename;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('org_logo'))
					{
						$error = array('error' => $this->upload->display_errors());
					}
					else
					{
						$uploaddata = array('upload_data' => $this->upload->data());
						$filename = $uploaddata['upload_data']['file_name'];
						$this->_createThumbnail($filename,LOGOS_IMAGE_PATH,LOGOS_THUMB_IMAGE_PATH);
					}
				}
				elseif (isset($_POST['org_logo']))
				{
					$filename=$_POST['org_logo'];
				}
				else
				{
					$filename='';
				}

				$OAuthSignatureMethod= new OAuthSignatureMethod_HMAC_SHA1();
				$OAuthSignatureOrg = $OAuthSignatureMethod->build_signature($org_name,null,date('Y-m-d H:i:s'));
				$OAuthSignatureUser = $OAuthSignatureMethod->build_signature($usr_email,null,date('Y-m-d H:i:s'));
				$postvalue = array("orgAuthToken"=>$OAuthSignatureOrg, "userAuthToken"=>$OAuthSignatureUser, "org_logo"=>$filename, "data"=>$_POST);
				$resultvalue=$this->organization_model->organization_add($postvalue);
				//print_r($result);exit;
				if($resultvalue!=''){
					$result['msg'] = 'Successfully Added';
				}
                                
                                
                                
				$this->session->set_flashdata('SucMessage', $result['msg']);
				redirect(base_url().'organization/', 'refresh');
			}
		}

		$data['countries'] = $this->comman_model->getcountrylist();

		foreach($data['countries'] as $key=>$value){
                    if($value['default']==1){
			$def[]= $value['loc_id'];
                    }
		}
		
		                
        $data['domains_list'] = $this->comman_model->org_domain_lists(implode(',', $def));

		//print_r($category); exit;

		$data['default'] = $def;
//		$data['default_option'] = $this->comman_model->check_default('department','dept_id');
//                $data['domains_list'] = $domains_list;
                
//                print_r($data);
		$data['siteTitle'] = 'Add Organization';
        $data['menu'] = $this->roles;
		$this->load->view('header',$data);
		$this->load->view('organization/add', $data);
		$this->load->view('footer');
	}

	public function edit($id = null)
	{
		$data['ErrorMessages']='';

		$config = array(array('field' => 'org_name','label' => 'Organization Name','rules' => 'trim|required'),
		array('field' => 'loc_id[]','label' => 'Location','rules' => 'trim'),
		array('field' => 'location_name[]','label' => 'Location Name','rules' => 'trim|required'),
		array('field' => 'address[]','label' => 'Address','rules' => 'trim|required'),
		array('field' => 'city[]','label' => 'City','rules' => 'trim|required'),
		array('field' => 'state[]','label' => 'State','rules' => 'trim|required'),
		//array('field' => 'countries','label' => 'Select Countries','rules' => 'trim|required'),
		//array('field' => 'domain','label' => 'Select Domain','rules' => 'trim|required'),
		array('field' => 'zip[]','label' => 'Zip code','rules' => 'trim|required')
		/*,array('field' => 'usr_name','label' => 'User Name','rules' => 'trim|required'),
		array('field' => 'usr_email','label' => 'User Email','rules' => 'trim|required|valid_email'),
		array('field' => 'usr_phone','label' => 'User Phone','rules' => 'trim|required'),
		array('field' => 'usr_psw','label' => 'Password','rules' => 'trim|required')*/);

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run() == FALSE){
			$data['ErrorMessages'] = validation_errors();
		}else{
			
			if(isset($_FILES['org_logo']['name']) && $_FILES['org_logo']['name']!='')
			{
				$fileExtension2 = explode(".", $_FILES['org_logo']['name']);
				$fileExt = array_pop( $fileExtension2 );
				$filename = time().'-'.md5($_FILES['org_logo']['name']).".".$fileExt;
				$config['upload_path'] = LOGOS_IMAGE_PATH;
				$config['allowed_types'] = 'jpg|png|jpeg|gif';
				$config['file_name'] = $filename;
			
				$image_path = $filename;
			
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('org_logo'))
				{
					$error = array('error' => $this->upload->display_errors());
				}
				else
				{
					$uploaddata = array('upload_data' => $this->upload->data());
					$filename = $uploaddata['upload_data']['file_name'];
					$this->_createThumbnail($filename,LOGOS_IMAGE_PATH,LOGOS_THUMB_IMAGE_PATH);
				}
			}
			elseif (isset($_POST['org_logo']))
			{
				$filename=$_POST['org_logo'];
			}
			else
			{
				$filename='';
			}
			
			$postvalue = array('org_id'=>$id, 'org_logo'=>$filename, 'data'=>$this->input->post());
			//print_r($postvalue);exit;
			$result=$this->organization_model->organization_update($postvalue);
			
			
			//print_r($result); die;
			$this->session->set_flashdata('SucMessage', $result['msg']);
			//redirect(base_url().'organization/', 'refresh');
		}
		
		if($id!='')
		{
			$org_info = $this->organization_model->get_organization_info($id);
			$org = array();
			foreach($org_info as $key=>$value){
				$org['loc_id'] = $value['id'];
				$org['org_logo'] = $value['org_logo'];
				$org['org_name'] = $value['org_name'];
				$org['domain_id'] = $value['domain_id'];
				$org['country'] = $value['country'];
				$org['location_name'] = $value['location_name'];
				$org['address'] = $value['address'];
				$org['city'] = $value['city'];
				$org['state'] = $value['state'];
				$org['zip_code'] = $value['zip_code'];
				$org['domain_name'] = $value['domain_name'];
				$org['country_name'] = $value['country_name'];
				$org['org_dept_not_in'] = $value['org_dept_not_in'];
				$org['domain_id'] = $value['domain_id'];
				$org['system_default'] = $value['system_default'];
			}
			
			if($org['org_dept_not_in'] == ""){
				$org['org_dept_not_in'] = "''";
			}
			if($org['domain_id'] == ""){
				$org['domain_id'] = "''";
			}

			$data['result']=$org;
			$countries = $this->country_model->getcountrylist();
			
			$domain = $this->country_model->country_domain($org['country']);

			$department = $this->department_model->department_list($id,$org['org_dept_not_in'],$org['domain_id'],$org['system_default']);
			
			$data['countries']=$countries;
			$data['domain']=$domain;
			$data['department'] = $department;
			
		}
		$data['siteTitle'] = 'Edit Organization';
        $data['menu'] = $this->roles;       
		$this->load->view('header',$data);
		$this->load->view('organization/edit', $data);
		$this->load->view('footer');
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
		$config['image_library'] = 'gd2';
		$config['source_image'] = $imagepath.$filename;
		$config['new_image']=$thumb_path;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['overwrite'] = true;
		$config['thumb_marker'] = '';
		$config['width']  = 64;
		$config['height'] = 64;
		$config['master_dim'] = 'auto';
	
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
	}

	//User session logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."login", 'refresh');
	}

	public function org_details(){
		$org_id = $this->input->post('org_id');
		$category = $this->organization_model->org_details($org_id);
		$return ='<label>Select Categories <span class="errors" style="color:crimson;">*</span></label><select id="multiselect" required multiple="multiple" data-placeholder="Select Categories..." name="categories[]">';
		if($category){
            foreach($category as $key=>$value){
               $return .= '<option value="'.$value['cat_id'].'">'.$value['category_name'].'</option>';
        	}
        }
        $return .='</select>';

        echo $return; exit;
	}

}

