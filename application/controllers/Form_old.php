<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is Form management controller of Formpro
 *
 * @package        CodeIgniter
 * @category            controller
 * @author       Rajeshkannan.C
 * @link                http://innoppl.com/
 *
 */
include APPPATH . 'controllers/OAuth.php';
include APPPATH . 'controllers/common.php';
class Form extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('comman_model');
		$this->load->model('form_model');
		$this->load->model('department_model');
		$this->load->model('category_model');
		$this->load->model('organization_model');
                $this->load->helper('access');
		$this->load->model('permission_model');
                $this->load->model('login_model');
		$this->load->library('Fields');
                $user_id = $this->session->userdata('user_id');
                $this->roles = $this->login_model->assign_roles($user_id);
                $method = $this->router->fetch_method();
                switch($method){
                    case 'add':
                        if(!in_array('create',$this->roles['forms'])){
                          redirect(base_url().'error');  
                        }
                        break;
                    case 'create':
                        if(!in_array('create',$this->roles['forms'])){
                          redirect(base_url().'error');  
                        }
                        break;
                    case 'edit_detail':
                        if((!in_array('update',$this->roles['forms'])) && (!in_array('create',$this->roles['forms']))){
                             redirect(base_url().'error');
                        }
                        break;
                    case 'edit_form':
                        if((!in_array('update',$this->roles['forms'])) && (!in_array('create',$this->roles['forms']))){
                             redirect(base_url().'error');
                        }
                        break;
                    case 'delete':
                        if(!in_array('delete',$this->roles['forms'])){
                             redirect(base_url().'error');
                        }
                        break;
                    case 'index':
                        if(!in_array('read',$this->roles['forms'])){
                            redirect(base_url().'error');
                        }
                    default:
                        break;
                }
		$this->load->helper('date');

		//Check the user is logged in properly
		if ($this->session->userdata('logged_in') == false) {
			$this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);
			redirect(base_url() . 'login/', 'refresh');
		}
		
	}
	public function index()
	{
		$data['ErrorMessages'] = '';
		$data['siteTitle']     = 'Forms ' . SITE_NAME;
		//$data['list'] = $this->form_model->form_list();
		$user_id = $this->session->userdata('user_id');
		$forms = $this->form_model->form_list();
               // print_r($forms);
		$user_form = $this->form_model->user_form();
		/*foreach($forms as $key=>$value){
			/*if($value->created_by != $user_id || in_array($value->form_id,$user_form)){
				unset($forms[$key]);
			}else{
				if($value->created_by === $user_id){
					$forms[$key]->action = 'all';
				}else{
					$forms[$key]->action = 'view';
				}
			}*/
		//}
                $data['roles'] = $this->roles['forms'];
                $data['menu'] = $this->roles;
                $data['user_id'] = $this->session->userdata('user_id');
		$data['list'] = $forms;
		$this->load->view('header', $data);
		$this->load->view('form/list', $data);
		$this->load->view('footer');

	}
	/* 
		This Function handles two post method based on step
		
		Step 1.This function save the form details as form name form code and description 
		Step 2.Save form with form content based on formid  

	*/
	public function add($form_id = null)
	{ 
		$data['ErrorMessages']='';
		///echo $this->input->server('REQUEST_METHOD');
		$data['siteTitle'] = 'New Form Details '.SITE_NAME;
                $data['menu'] = $this->roles;
                $data['user_id'] = $this->session->userdata('user_id');
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			/* First Step Form Save */
			if(isset($_POST) && $_POST['step'] == 1)
			{
				$form_name = trim($this->input->post('form_name'));
				$form_desc = $this->input->post('form_desc');
				$org_id = $this->input->post('org_id');
				$form_code = $this->input->post('form_code');
				$columns = $this->input->post('form_column');
				$type = $this->input->post('form_type');
				$category = $this->input->post('categories');
                                $assign_to = 'users';
				//$assign_to = $this->input->post('assign_to');
				//if($assign_to === 'user'){
				$users = $this->input->post('users');
				//}
				/*else if($assign_to === 'dept'){
					$dept = $this->input->post('depts');
					if($org_id){
						foreach($dept as $key=>$value){
							$users[]=$this->department_model->get_dept_users($org_id,$value);
						}
					 //print_r($users); exit;
					}	
				}*/
				$response_email = $this->input->post('response_email');
				if(isset($_POST['default'])){
					$default = $this->input->post('default');
				}
				else{
					$default = 0;
				}
				$config = array(array('field' => 'form_name','label' => 'Form Name','rules' => 'trim|required'),
                    array('field' => 'form_code','label' => 'Form Code','rules' =>'required|min_length[5]|max_length[12]|is_unique[form_details.form_code]'),
					array('field' => 'form_column','label' => 'Columns','rules' => 'trim|required'));
					
				$this->form_validation->set_rules($config);
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				if($this->form_validation->run() == FALSE){
					$categories = array();
		        	if($org_id == 1){
		        		/* If organization id is present then get related category  */
		        		$organization = $this->organization_model->org_list();
		        		$data['organizations'] = $organization;
		        	}
		        	$this->load->model('category_model');
		        	if($org_id!=1)
		       		{
				 		$org_info = $this->comman_model->getorg_domain_info($org_id);
					        if($org_info->org_cat_not_in==''){
					            $cat_not_in = "''";
					        }else{
					            $cat_not_in = $org_info->org_cat_not_in;
					        }
						$system_default = $org_info->system_default;
					    $org_domain_ids = $org_info->domain_ids;
					    if($org_domain_ids=='')
					    {
					        $org_domain_ids = "''";
					    }
				    }  else {
				        $cat_not_in = "''";
				        $org_domain_ids = "''";
				        $system_default = 0;
				    }
		    		$list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
						
						/*$org_category = $this->organization_model->org_details($org_id); */
						foreach($list as $key=>$value){
							$categories[$value['cat_id']] =$value['category_name'];
						}
						$org_user = $this->organization_model->org_users($org_id);
                        $data['users'] = $org_user;
						$data['categories'] = $categories;
						$data['ErrorMessages'] = validation_errors();
						$this->load->view('header',$data);
						$this->load->view('form/add_step_1', $data);
						$this->load->view('footer');
					}else{

					$forms = array(
							'form_name' => $form_name,
							'form_desc' => $form_desc,
							'form_code' => $form_code,
							'columns'  => $columns,
							'form_type' => $type,
							'response_to' => $response_email,
							'assign_to' => $assign_to,
							'default'	=> $default,
							'status'   => '0',
							'created_by'=>$this->session->userdata('user_id'),
                                                        'org_id' => $org_id
						);
					$form_id = $this->form_model->form_add_step_1($forms);
					$this->form_model->form_category($category,$form_id);
					/*if($assign_to === 'dept'){
						$this->form_model->form_dept($dept,$form_id);
				    }*/
				    $users[] = $this->session->userdata('user_id');
					$this->form_model->form_users($users,$form_id);
					if($form_id > 0){
						$data['columns'] = $columns;
						$data['form_id'] = $form_id;
						redirect(base_url().'form/create/'.$form_id);
					}
				}
			}
			if(isset($_POST) && $_POST['step'] == 2)
			{
				$data = array
		      	(
		        	'form_id' => $this->input->post('form_id'),
		        	'form_content' => $this->input->post('form_content')
		      	);
				$result=$this->form_model->form_add_step_2($data);
				echo $result;
				exit;
			}
		}else if($form_id > 0) {
			$this->load->model('category_model');
			/*$category_details =  $this->category_model->category_list();
			foreach($category_details as $key=>$value){
				/* It avoids the No-Parent  in the field list 
				if($value['id'] != 1){
					$categories[$value['id']] =$value['category_name'];
				}
			}*/
			$org_id = $this->session->userdata('org_id');
			if($org_id!=1)
       		{
		 		$org_info = $this->comman_model->getorg_domain_info($org_id);
	        
			        if($org_info->org_cat_not_in==''){
			            $cat_not_in = "''";
			        }else{
			            $cat_not_in = $org_info->org_cat_not_in;
			        }
	        
				$system_default = $org_info->system_default;
	        
			    $org_domain_ids = $org_info->domain_ids;
			    
			    if($org_domain_ids=='')
			    {
			        $org_domain_ids = "''";
			    }
		    }  else {
		        $cat_not_in = "''";
		        $org_domain_ids = "''";
		        $system_default = 0;
		    }
		    $list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
		    //print_r($list); exit;
			$data['categories'] = $list;

		/* Set the already selected category values */
		/* Get Related User Details */
			$this->load->model('user_model');
			$users_list = $this->user_model->list_user();
			$data['user'] = $users_list;
			$data['form_id'] = $form_id;
			$this->load->view('header',$data);
			$this->load->view('form/add_step_1', $data);
			$this->load->view('footer');
		}else{
			$categories = array();
           		$org_id = $this->session->userdata('org_id');
           		$this->load->model('category_model');
                        if($org_id == 1){
                                /* If organization id is not present then set category as empty */
                            $this->load->model('organization_model');

                            $organization = $this->organization_model->org_list($org_id);
                            $data['organizations'] = $organization;
                            $data['categories'] = '';
                        }else{
                            /* If organization id is present then get related category  */
                            if($org_id!=1)
					        {
						 		$org_info = $this->comman_model->getorg_domain_info($org_id);
					        
							        if($org_info->org_cat_not_in==''){
							            $cat_not_in = "''";
							        }else{
							            $cat_not_in = $org_info->org_cat_not_in;
							        }
					        
								$system_default = $org_info->system_default;
					        
							    $org_domain_ids = $org_info->domain_ids;
							    
							    if($org_domain_ids=='')
							    {
							        $org_domain_ids = "''";
							    }
							    }  else {
							        $cat_not_in = "''";
							        $org_domain_ids = "''";
							        $system_default = 0;
							    }
		   					 $list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
                            //print_r($list); exit;
		   					 foreach($list as $key=>$value){
		   					 	$categories[$value['cat_id']] = $value['category_name'];
		   					 }
                            //$org_category = $this->organization_model->org_category($org_id);
                            //print_r($org_category); exit;
                            $org_user = $this->organization_model->org_users($org_id);
                            $data['users'] = $org_user;
                            /*foreach($org_category as $key=>$value){
                                $categories[$value['cat_id']] = $value['category_name'];
                            }*/
                            //print_r($categories); exit;
                            $data['categories'] = $categories;
			}
			$this->load->view('header',$data);
			$this->load->view('form/add_step_1', $data);
			$this->load->view('footer');

		}

	}
        
        public function org_category(){
            $org_id = $this->input->post('org_id');
            $org_category = $this->organization_model->org_category($org_id);
            $select =' <label>Select Categories <span class="errors" style="color:crimson;">*</span></label><select id="multiselect" required multiple="multiple" data-placeholder="Select Categories..." name="categories[]">';
            foreach($org_category as $key=>$value){
               $select.="<option value =".$value["cat_id"].'>'.$value["category_name"].'</option>'; 
            }
            $select.= '</select>';
            echo $select;
            
        }
        public function org_users()
        {
            $org_id = $this->input->post('org_id');
            $org_users = $this->organization_model->org_users($org_id);
            $select =' <label>Select Users <span class="errors" style="color:crimson;">*</span></label><select id="multiselect_users" required multiple="multiple" data-placeholder="Select Users..." name="users[]">';
            foreach($org_users as $key=>$value){
               $select.="<option value =".$value["id"].'>'.$value["firstname"].'</option>'; 
            }
            $select.= '</select>';
            echo $select;
        }

	/* 
		Edit Form Details
	*/

	public function edit_detail($form_id){
                $data['menu'] = $this->roles;
                $data['siteTitle'] ='Edit Form Details';
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			/* First Step Form Save */
			if(isset($_POST) && $_POST['step'] == 1)
			{
				//print_r($_POST); exit;
				$form_name = trim($this->input->post('form_name'));
				$form_desc = $this->input->post('form_desc');
				$form_code = $this->input->post('form_code');
				$users = $this->input->post('users');
				$form_id = $this->input->post('form_id');
				$category = $this->input->post('categories');
				if(isset($_POST['default'])){
					$default = $this->input->post('default');
				}
				else{
					$default = 0;
				}
				$status = $this->input->post('status');
				$columns = $this->input->post('form_column');
				$config = array(array('field' => 'form_name','label' => 'Form Name','rules' => 'trim|required'),array('field' => 'form_code','label' => 'Form Code','rules' =>'required|min_length[5]|max_length[12]|callback_form_code_validation['.$form_code.','.$form_id.']'));
					
				$this->form_validation->set_rules($config);
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				if($this->form_validation->run() == FALSE){
				}else{
						$forms = array(
							'form_name' => $form_name,
							'form_desc' => $form_desc,
							'form_code' => $form_code,
							'columns'  => $columns,
							'form_id' =>$form_id,
							'status' =>$status,
							'default' => $default
						);
					
					$res = $this->form_model->form_update_step_1($forms);
					$this->form_model->form_category($category,$form_id);
					$this->form_model->form_users($users,$form_id);
					redirect(base_url().'form/edit_form/'.$form_id);
				}
			}

		}
		$details = $this->form_model->form_details($form_id);
		$org_id = $this->session->userdata('org_id');
			//$org_category = $this->organization_model->org_category($org_id);
		 if($org_id!=1)
        {
	 		$org_info = $this->comman_model->getorg_domain_info($org_id);
        
		        if($org_info->org_cat_not_in==''){
		            $cat_not_in = "''";
		        }else{
		            $cat_not_in = $org_info->org_cat_not_in;
		        }
        
			$system_default = $org_info->system_default;
        
		    $org_domain_ids = $org_info->domain_ids;
		    
		    if($org_domain_ids=='')
		    {
		        $org_domain_ids = "''";
		    }
		}  else {
		        $cat_not_in = "''";
		        $org_domain_ids = "''";
		        $system_default = 0;
		}
		$list = $this->category_model->category_lists($org_id,$cat_not_in,$org_domain_ids,$system_default);
		//$categories = array();
		/*foreach($list as $key=>$value){
		   		$categories[$value['cat_id']] = $value['category_name'];
		}*/
		$data['categories']= $list;
		$form_categories = array();
		$form_category = $this->form_model->form_category_list($form_id,$org_id);
        foreach($form_category as $key=>$value){
            $form_categories[]=$value['cat_id'];
        }
        //print_r($form_categories); exit;
		$data['sel_categories'] = $form_categories;
		$columns = $this->form_model->form_columns($form_id);
		$org_user = $this->organization_model->org_users($org_id);
        $data['users'] = $org_user;
       // print_r($org_user); exit;
        $sel_users = $this->form_model->form_users_list($form_id);
       // print_r($sel_users); exit;
        //$form_users = array();
        foreach($sel_users as $key=>$value){
            $form_users[]=$value['user_id'];
        } 
        $data['form_users']=$form_users;
        $data['user_id'] = $this->session->userdata('user_id');
		/* Check Default option is Selected for any roles */
		//$data['default_option'] = $this->comman_model->check_default('form_details','form_id');
		$data['form_id'] = $form_id;
		$data['details'] = $details;
		$data['columns'] = $columns;
		$this->load->view('header',$data);
		$this->load->view('form/edit_step_1', $data);
		$this->load->view('footer');

	}

	/*
		Form Code Custom Validation 

	 */
	public function form_code_validation($form_code,$form_id){
		$res = $this->form_model->form_code_validation($form_code,$form_id);
		if(!$res){
			 $this->form_validation->set_message('form_code_validation', 'Form Code must be unique');
			 return $res;
		}
		return $res;
	}
	/* 
		Edit the created Form
	*/

	public function edit_form($form_id){

		$details = $this->form_model->form_details($form_id);
		$columns = $this->form_model->form_columns($form_id);
		$data['form_id'] = $form_id;
		$data['content'] = json_decode($details->form_content);
       //print_r($data['content']); exit;
		//$content = json_decode($data['content']);
		//print_r($content); exit;
       //echo $data['content']->fields; exit;
		$data['columns'] = $columns;
                $data['menu'] = $this->roles;
                $data['siteTitle']='Edit Forms';
		$this->load->view('header',$data);
		$this->load->view('form/edit_step_2', $data);
		$this->load->view('footer');

	}
	/* 
		Preview the form which are previously created based on formid 

	*/
	public function preview($form_id){

		$details = $this->form_model->form_details($form_id);
		$data['form_id'] = $form_id;
		$data['siteTitle'] = "Preview Form";
		$data['contents'] = $details->form_content;
		$data['formname'] = $details->form_name;
		$data['formcode'] = $details->form_code;
		$data['roles'] = $this->roles['forms'];
        $data['menu'] = $this->roles;
        $data['user_id'] = $this->session->userdata('user_id');
		$this->load->view('header',$data);
		$this->load->view('form/preview', $data);
		$this->load->view('footer');
	}

	/* 
		Generate Columns for the Form creation 
	*/
	public function create($form_id = null){

		$data['form_id'] = $form_id;
		$columns = $this->form_model->form_columns($form_id);
		$data['columns'] = $columns;
		$data['siteTitle'] = 'Form creation';
                $data['menu'] = $this->roles;
		$this->load->view('header',$data);
		$this->load->view('form/add_step_2', $data);
		$this->load->view('footer');

	}

	/*
		Save Form it simply change the status from 0 to 1
	
	*/
	public function array_non_empty_items($input) 
	{
		
		    // If it is an element, then just return it
		    if (!is_array($input)) {
		    	//echo 's';
		      return $input;
		    }

		    $non_empty_items = array();

		    foreach ($input as $key => $value) 
		    {
		    	
		      // Ignore empty cells
		        if($value || (!is_array($value) && ($value == '0' || $value != ''))) {
		        // Use recursion to evaluate cells
		      
		        $non_empty_items[$key] =$this->array_non_empty_items($value);
		         
		      }
		    }
    		// Finally return the array without empty items
    		return $non_empty_items;
  	}
	public function saveform()
	{
		$formid = $this->input->post('form_id');
		$details = $this->form_model->form_details($formid);
		
		$json_value_arr = json_decode($details->form_content,true);
		$var_all = (array) $json_value_arr;
		$content = $this->array_non_empty_items($var_all);
	
		$form_field_data_details=$this->form_model->form_field_data_details($formid);
		
		if(empty($form_field_data_details))
		{

			// Insert all indivual form field into tbl_form_fields_data table //
			$new_form_content = $this->insertFormContent($content,$formid);
		}
		else
		{
			// Update and Insert all indivual form field into tbl_form_fields_data table //
			$form_field_data_all=$this->form_model->form_field_data_details_all($formid);
			$new_form_content = $this->insertUpdateFormContent($content,$form_field_data_all,$formid);

		}
		
		
		$json_form_content = json_encode($new_form_content);
		$last_data = array('form_id' => $formid,
		        	       'form_content' => $json_form_content);
		$result=$this->form_model->form_add_step_2($last_data);
		$form = $this->form_model->statusform($formid);
		redirect(base_url().'form');

	}
	public function insertUpdateFormContent($content,$form_field_data_all,$formid)
	{
		

		$new_form_content = array();

		foreach($content as $key=>$page)
		{
				foreach($page as $r=>$row)
				{
					foreach($row as $c=>$col)
					{
							
						foreach ($col as $n=>$last) 
						{ 
								
						$data['formid'] = $formid;
						$data['page'] = $key;
						$data['row'] = $c;
						$data['column'] = $n;
						$data['fieldid'] = $last['fieldid'];
						if(isset($last['name']))
						{
						$data['name'] = $last['name'];
						}
						else
						{
							$data['name'] = '';
						}

						$this->db->where('id = '.$last['datafieldId']);
						$this->db->update('form_fields_data',$data);

						$form_data_details_id = $last['datafieldId'];


						if($last['datafieldId'] == 0)
						{
							$data['formid'] = $formid;
							$data['page'] = $key;
							$data['row'] = $c;
							$data['column'] = $n;
							$data['fieldid'] = $last['fieldid'];
							if(isset($last['name']))
							{
							$data['name'] = $last['name'];
							}
							else
							{
								$data['name'] = '';
							}
							$this->db->insert('form_fields_data',$data);
							$form_data_details_id = $this->db->insert_id();
							

						}
						$content[$key][$r][$c][$n]['fieldid'] = '"'.$form_data_details_id.'"';
						$content[$key][$r][$c][$n]['datafieldId'] = '"'.$form_data_details_id.'"';
						$content[$key][$r][$c][$n]['api_type'] = $this->fields->generate_apiformat($last['type']);
								


							 }
						

					  }
			    }

	    }
		
		return $content;


	}
	public function insertFormContent($content,$formid)
	{
		$new_form_content = array();
		foreach($content as $key=>$page)
		{
			foreach($page as $r=>$row)
			{
				foreach($row as $c=>$col)
				{
					
					
					foreach ($col as $n=>$last) 
					{ 
						
						$data['formid'] = $formid;
						$data['page'] = $key;
						$data['row'] = $c;
						$data['column'] = $n;
						$data['fieldid'] = $last['fieldid'];
						if(isset($last['name'])){

						$data['name'] = $last['name'];
						}else
						{
							$data['name'] = '';

						}
						$form_field_data_details=$this->form_model->form_field_data_details($formid);

						
						$this->db->insert('form_fields_data',$data);
						$form_data_details_id = $this->db->insert_id();

						$content[$key][$r][$c][$n]['fieldid'] = '"'.$last['fieldid'].'"';
						$content[$key][$r][$c][$n]['datafieldId'] ='"'.$form_data_details_id.'"';
						$content[$key][$r][$c][$n]['api_type'] = $this->fields->generate_apiformat($last['type']);


					}
				

				}
			}

		}
		return $content;
	}
	public function field_type($type,$rules){

		$default_rules = array(
			'text'=>array("-1"=>"","req"=>"element-single-line-text-any","alpha"=>"element-alpha","alpha_num"	=>"element-single-line-alpha-num","num"=>"element-number","email"=>"element-email	"),
			'select'=>array("req"=>"element-single-select"),
			'radio'=>array("req"=>"element-either-or-choice"),
			"checkbox"=>array("req"=>"element-multi-choice"),
			'password'=>array("req"=>"element-password","alpha"=>"element-password-text","	alpha_num"	=>"element-password-alpha-num","num"=>"element-password-number"),
			'textarea' => array("req"=>"element-multi-line-text")
			);

		switch($type){

			case 'text':
				//$res = 
				break;
			case '';
				break;
			case '';
				break;

		}

	}
	public function forms_new(){

		if(!$this->session->userdata('logged_in')){
	
			$this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);

			redirect('login');
		}
		else{

			$this->isLoggedin = 1;
		}

		$this->page = 'forms_new';

		$params = array('page'=>$this->page,'generate'=>$this->generate);

		$data = $this->generateview($params);

		/* Get the category details */

		$this->load->model('category_model');

		$category_details =  $this->category_model->fetchCategoryTree();

		foreach($category_details as $key=>$value){

			/* It avoids the No-Parent  in the field list */
			
			if($value['id'] != 1){

				$categories[$value['id']] =$value['category_name'];

			}

		}

		$data['categories'] = $categories;

		/* Set the already selected category values */

		/* Get Related User Details */

		$this->load->model('user_model');

		$users_list = $this->user_model->list_user();

		$data['user'] = $users_list;

		$data['isLoggedin'] = $this->isLoggedin;

		$this->load->view('home',$data);

	}

}
