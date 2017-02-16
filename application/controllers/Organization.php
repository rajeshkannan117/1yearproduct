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
class Organization extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('comman_model');
		$this->load->model('category_model');
		$this->load->language('menu');
		$this->load->library('breadcrumbs');
		$this->load->language('organization');
		$this->load->model('webservice_model');
		$this->load->model('organization_model');
		$this->load->model('department_model');
		$this->load->model('country_model');
		$this->load->model('form_model');
		$this->load->model('login_model');
		$this->load->helper('cryptojs-aes.php');
		$this->load->library('uuid');
		$this->load->helper('access');
        define_constants();
		$this->load->helper('date');
        $this->user_id = $this->session->userdata('user_id');
        $user_id = $this->session->userdata('user_id');
        $this->fieldmaster = $this->form_model->get_fieldmaster();
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
        if($this->user_id == 1)
        {                
           $data['result'] = $this->organization_model->get_organisation($this->user_id);
        }else{
            $data['result'] = array();
        }
        $this->breadcrumbs->add('Organization', base_url().'organization');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		$data['roles'] = $this->roles['organization'];
        $data['menu'] = $this->roles;
        $data['siteTitle'] = $this->lang->line('organizations');
        $data['user_id'] = $this->user_id;
		$this->load->view('header',$data);
		$this->load->view('organization/list', $data);
		$this->load->view('footer',$data);
	}


	public function add()
	{
		$data['ErrorMessages']='';

		$data['siteTitle'] = 'Organization - '.SITE_NAME;
		$this->breadcrumbs->add('Organization', base_url().'organization');
        $this->breadcrumbs->add('New Organization ', base_url().'organization/add');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
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
			$default = $this->input->post('default');
			$domain = $this->input->post('domain');
			$plan = $this->input->post('org_plans');
			$new_plan = json_encode(cryptoJsAesDecrypt('', $_POST['new_plan']));

			//echo $new_plan;exit;
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
				//print_r($_POST);exit;
				$data['ErrorMessages'] = validation_errors();

			}else{
				if(isset($_FILES['org_logo']['name']) && $_FILES['org_logo']['name']!='')
				{ 
					$fileExtension2 = explode(".", $_FILES['org_logo']['name']);
					$fileExt = array_pop( $fileExtension2 );
					$filename = time().'-'.md5($_FILES['org_logo']['name']).".".$fileExt;
					$config['upload_path'] = LOGOS_IMAGE_PATH;
					$config['allowed_types'] = 'jpg|png|jpeg';
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

				$postvalue = array("orgAuthToken"=>$OAuthSignatureOrg, "userAuthToken"=>$OAuthSignatureUser, "org_logo"=>$filename, "data"=>$_POST,'org_uuid'=>$this->uuid->v4(),'location_uuid'=>$this->uuid->v4(),'user_uuid'=>$this->uuid->v4());
				//echo $new_plan;
				if($new_plan != '' && $new_plan != 'null'){
					$new_plan = $this->organization_model->subscription_insert($new_plan);
					$postvalue['data']['org_plans'] = $new_plan;
					$plan = $new_plan;
				}
				//exit;
				$return=$this->organization_model->organization_add($postvalue);
				$new_org_id = $return['org_id'];
				$superadmin_id = $return['admin_id'];
				$job_site_id = $return['loc_id'];				
				if($default == 1){

					$org_dept_not_in[] = 0;
        			$org_cat_not_in[] = 0;
        			/* get meta department */
			        $department = $this->organization_model->meta_data_department($domain);
			        if(count($department) > 0){
				        foreach($department as $key=>$value){
		              		$depts[] = $value['dept_id'];
		              		$org_dept_not_in[] = $value['dept_id'];
		              		$duplicate_dept['data'] = array(
			                      'dept_name'=>$value['dept_name'],
			                      'dept_desc'=>$value['dept_desc'],
			                      'uuid' => $this->uuid->v4(),
			                      'created_by'=>$superadmin_id,
			                      'org_id'=>$new_org_id,
			                      'default'=>0
	                  		);
		              		//print_r($duplicate_dept);exit;
		              		$domains = array();
		              		$domains[] = $domain;
	               			$dept_id = $this->department_model->department_add($duplicate_dept,$domains);
	               			$users = array();
	               			$users[] = $superadmin_id;
	               			$this->department_model->user_department($users,$dept_id);
	               			$new_depts[] = $dept_id;
	               			$new_depts_insert[$value['dept_id']] = $dept_id;
	          			}
	          			/* get meta category */
	          			$category_dept = $this->organization_model->meta_data_category($depts);
	          			
	          			if(count($category_dept) > 0){
	          				foreach($category_dept as $key=>$value){
	          					$meta_data[$value['cat_id']][] = $new_depts_insert[$value['dept_id']];
	          					$cat_dept[$value['cat_id']]['cat_id'] = $value['cat_id'];
	          					$cat_dept[$value['cat_id']]['category_name'] = $value['category_name'];
	          					$cat_dept[$value['cat_id']]['category_desc'] = $value['category_desc'];
	          				}
		          			foreach($cat_dept as $key=>$value){
		              			$categorys[] = $value['cat_id'];
		              			$org_cat_not_in[] = $value['cat_id'];
		              			$postvalue = array(
		              							"data" => 
		              								array(
		              									'org_id'=>$new_org_id,
		              									'category_name' => $value['category_name'], 
		              									'category_desc' => $value['category_desc'], 
		              									'default' => '0', 
		              									'status' => 1, 
		              									'created_by' => $superadmin_id,
		              									'uuid'=>$this->uuid->v4()
		              								)
		              							);
		              			//print_r($postvalue);exit;
		              			$cat_id = $this->category_model->category_add($postvalue,$meta_data[$value['cat_id']]);
		              			$old_category_id[$value['cat_id']]=$cat_id;
		          			}
	          			/* get meta forms */
	          			$form_category = $this->organization_model->meta_data_forms($categorys);
	          				if(count($form_category) > 0){
		          			foreach($form_category as $key=>$value){
		          				$forms = array(
				                    'form_name' => $value['form_name'],
				                    'default'   => '1',
				                    'status'   => '0',
				                    'uuid' => $this->uuid->v4(),
				                    'org_id' => $new_org_id,
				                    'created_by' => $superadmin_id
		                		);
		                		$form_data = $value['form_content'];
		                		$form_id = $this->form_model->form_add_step_1($forms);
				                /* 
				                    Save form data into  form fields table.
				                    Before that check into form_field_table whether form id is present in the table or not
				                */
		                		$form_field_data_details=$this->form_model->form_field_data_details($form_id);
				                if(empty($form_field_data_details))
				                {
				                    /*
				                        Insert all individual form field into tbl_form_fields_data table 
				                    */
				                    $form_content = $this->insertFormContent($form_data,$form_id);
				                }
				                $data = array(
		                    		'form_id' => $form_id,
		                    		'form_content' => json_encode($form_content)
		                		);
		                		$result=$this->form_model->form_add_step_2($data);
		                		$uuid = $this->uuid->v4();
		                		$hierarchy_id = $this->form_model->form_hierarchy_insert($form_id,$uuid);
		                		$location = array();
		                		$location[] = $job_site_id;
		                		$this->form_model->form_location($form_id,$location,$hierarchy_id);
		                		$this->form_model->form_category($old_category_id[$value['cat_id']],$form_id,$hierarchy_id);
		          			}
		          			}
		          		}
	          		}

				}else{
					$org_dept_not_in = array();        
					$department = $this->organization_model->meta_data_department($domain);
					if(count($department) > 0){
				        foreach($department as $key=>$value){
				        	$depts[] = $value['dept_id'];
		              		$org_dept_not_in[] = $value['dept_id'];
		              	}
		            }
			        $org_cat_not_in = array();
			        $category_dept = $this->organization_model->meta_data_category($depts);
			        if(count($category_dept)){
	          			foreach($category_dept as $key=>$value){
	              			$categorys[] = $value['cat_id'];
	              			$org_cat_not_in[] = $value['cat_id'];
	              		}
	              	}
				}
				$this->organization_model->organization_meta_data($org_dept_not_in,$org_cat_not_in,$new_org_id);
				if($new_org_id!=''){
					/* Set default subscription plans */
					$this->organization_model->org_subscription_plan($new_org_id,$plan);
					$result['msg'] = 'Details Successfully Added';
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

	 public function insertFormContent($fieldss,$form_id)
    {
        $fields = json_decode($fieldss);
        $api_fields = array();
        foreach($fields as $i=>$pages){
            foreach($pages as $p=>$rows){
                foreach($rows as $r=>$cols){
                    foreach($cols as $key=>$value){
                       if($value != '' || $value != null){
                            if($value->type != 'submit' && $value->type != 'reset'){
                            $field_type = $this->fieldmaster[$value->fieldid]['field_type'];
                            $value->api_type = $this->fieldmaster[$value->fieldid]['api_type'];
                           // print_r($value); exit;
                            $fielddata['form_id'] = $form_id;
                            $fielddata['page'] = $p;
                            $fielddata['row'] = $r;
                            $fielddata['col'] = $key;
                            $fielddata['field_id'] = $value->fieldid;
                            $fielddata['question'] = $value->title;
                            $this->db->insert('form_fields',$fielddata);
                            $fieldid = $this->db->insert_id();
                            $value->formfieldid = (string)$fieldid;
                            if($field_type == '1'){
                               $value = $this->field_options($value,$fieldid);
                            }
                            $value->fieldtype =  (string)$field_type;
                            $api_cols[] = $value;
                        }
                     }
                    }
                    $api_rows[$r] = $api_cols;
                }
                $api_pages[$p] = $api_rows;
            }
            $api_fields[$i] = $api_pages;
        }
        return $fields;
    }
    public function field_options($value,$fieldid){
        foreach($value->choices as $k=>$v){
            $insert_options = array();
            $insert_options['form_fields_id'] = $value->formfieldid;
            $insert_options['option_name'] = $v->title;
            $insert_options['option_value'] = $v->title;
            $this->db->insert('form_options',$insert_options);
            $v->id = (string)$this->db->insert_id();
        }
        return $value;
    }

	public function edit($uuid = null)
	{
		$data['ErrorMessages']='';
		//print_r($_POST);exit;
		$this->breadcrumbs->add('Organization', base_url().'organization');
        $this->breadcrumbs->add('Edit Organization ', base_url().'organization/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		$id = $this->organization_model->check_organization_exists($uuid);
		if(empty($id)){
			redirect(base_url().'error/', 'refresh');
		}
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
				$config['allowed_types'] = 'jpg|png|jpeg';
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
			$result=$this->organization_model->organization_update($postvalue);
			
			
			//print_r($result); die;
			$this->session->set_flashdata('SucMessage', $result['msg']);
			redirect(base_url().'organization/', 'refresh');
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
				$org['system_default'] = $value['system_default'];
				$org['org_plan'] = $value['subscription_id'];
			}
			if($org['org_dept_not_in'] == ""){
				$org['org_dept_not_in'] = "''";
			}
			if($org['domain_id'] == ""){
				$org['domain_id'] = "''";
			}

			$data['result']=$org;
			$countries = $this->country_model->getcountrylist();
			if($org['org_plan'] != 1){
				$plans = $this->organization_model->get_org_plans($org['org_plan'],$id);
				$data['plan_users'] = $plans->plans->users;
				$data['plan_jobsites'] = $plans->plans->jobsites;
				$data['plan_forms'] = $plans->plans->forms;
			}
			$domain = $this->country_model->country_domain($org['country']);
			$department = $this->department_model->department_list($id,$org['org_dept_not_in'],$org['domain_id'],$org['system_default']);
			
			$data['countries']=$countries;
			$data['domain']=$domain;
			$data['department'] = $department;
			
		}
		$data['siteTitle'] = 'Edit Organization';
        $data['menu'] = $this->roles;       
        //print_r($data);exit;
		$this->load->view('header',$data);
		$this->load->view('organization/edit', $data);
		$this->load->view('footer');
	}
	
	public function delete($uuid = null)
	{
		$resultvalue = $this->organization_model->organization_delete($uuid);
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
		$config['width']  = 500;
		$config['height'] = 300;
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
	public function plans(){
		$plans = $this->input->post('plans');
		$preview = $this->input->post('preview');
		if($plans != ''){
			$plans_details = json_encode(cryptoJsAesDecrypt('',$plans));
			$plans_details = json_decode($plans_details);
			foreach($plans_details as $key=>$value){
				foreach(json_decode($value) as $k=>$v){
					$data[$k] = $v;
				}
			}
		}else{
			$data['users'] = ' - ';
			$data['jobsites'] = ' - ';
			$data['forms'] = ' - ';
		}
		$data['preview'] = $preview;
		$this->load->view('organization/plans',$data);
	}
	public function logo(){
		$file = $this->input->post('file');
		print_r($_FILES);exit;
		$test = getimagesize($_FILES["file"]["name"]);
		$width = $test[0];
		$height = $test[1];
		echo $width.''.$height;
		die;
	}

}