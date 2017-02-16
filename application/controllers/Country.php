<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
* This is Country controller of Formpro
*
* @package		CodeIgniter
* @category	controller
* @author		RajeshKannan.C
* @link		http://innoppl.com/
*
*/

//include APPPATH.'controllers/OAuth.php';
//include APPPATH.'controllers/common.php';
class Country extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	
		$this->load->model('comman_model');
		$this->load->model('country_model');
		$this->load->language('menu');
        $this->load->language('country');
        $this->load->library('breadcrumbs');
		$this->load->model('login_model');
        $this->load->helper('access');
        define_constants();
        $user_id = $this->session->userdata('user_id');
        //Check the user is logged in properly
       if($this->session->userdata('logged_in') != true)
		{
			$this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);
			redirect(base_url().'login/', 'refresh');
		}

        $this->roles = $this->login_model->assign_roles($user_id);
		$method = $this->router->fetch_method();
        switch($method){
            case 'add':
                if(!in_array('create',$this->roles['country'])){
                  redirect(base_url().'error');  
                }
                break;
            case 'edit':
                if((!in_array('update',$this->roles['country'])) && (!in_array('create',$this->roles['country']))){
                     redirect(base_url().'error');
                }
                break;
            case 'delete':
                if(!in_array('delete',$this->roles['country'])){
                     redirect(base_url().'error');
                }
                break;
            case 'index':
                if(!in_array('read',$this->roles['country'])){
                     redirect(base_url().'error');
                }
            default:
                break;
        }
	}

	public function index()
	{
		$data['ErrorMessages']='';
		$postvalue = array("sdf"=>'asdfsdf');
		$country_result=$this->country_model->getcountrylist($postvalue);
		$data['roles'] = $this->roles['country'];
        $data['menu'] = $this->roles;
       	$data['user_id'] = $this->session->userdata('user_id');
        $this->breadcrumbs->add('Country', base_url().'country');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		$data['result']=$country_result;
        $data['siteTitle'] ='Country';
		$this->load->view('header',$data);
		$this->load->view('country/list', $data);
		$this->load->view('footer',$data); 
               
		
	}
	public function server(){
		$drawValue = $_GET['draw'];
		$postvalue = array("sdf"=>'asdfsdf');
		$drawValue = $_GET['draw'];
       	$startValue = $_GET['start'];
       	$lengthValue = $_GET['length'];
       	//echo $_GET['length'];
       	//$lengthValue = 10;
       	$searchV = $_GET['search'];
       	if($startValue != 0){
       		$startValue +=1;
       	}else{
       		$startValue = 0;
       	}       
		$country_result=$this->country_model->getcountrylist_limit($startValue,$lengthValue);
		$country_result_total=$this->country_model->getcountrylist($postvalue);
		$countryCount = count($country_result_total);
		$i=0;
		foreach($country_result as $key=>$value){
			$i+=1;
			$datas['i'] = $i;
			$datas['name']=$value['country_name'];

			if($value['status'] == "1"){ 
				$status = '<span class="uk-badge uk-badge-success" style="">Active</span>';
			}else if($value['status'] == "0"){ 
				$status = '<span class="uk-badge uk-badge-danger2" style="">Inactive</span>'; 
			}
			$datas['status'] = $status;
			$action = '';
			$edit = action_return($this->roles['country'],'country',$value['loc_id'],$user_id,$details['created_by']);    
                if(in_array('delete',$this->roles['country'])){ 
                    if($edit != 'N/A'){ $action .= $edit; }else{ $action .= ''; }              
            $action .='<a onclick="UIkit.modal.confirm('.$this->lang->line("warning").', function(){ 
                location.href='.base_url().'country/delete/'.$value['loc_id'].'
                })" >
                <i class="md-icon material-icons">&#xE872s</i>
            </a>';
                } else { 
                        if($edit === 'N/A'){ $action .= $edit; }else{ $action .= ''; } 
                   }
            $details[] = array($value['loc_id'],$datas['name'],$status,$action);

		}
		//print_r($details);exit;
		$countryData = array('draw'=>$drawValue,'recordsTotal'=>$countryCount,'recordsFiltered'=>$countryCount,'data'=>$details);

        $countryData = json_encode($countryData);
		echo $countryData;die;
	}
	public function add()
	{
			//echo 'asdas';
		$data['ErrorMessages']='';
		$data['menu'] = $this->roles;
		$data['siteTitle'] = 'Country - '.SITE_NAME;
		$this->breadcrumbs->add('Country', base_url().'country');
        $this->breadcrumbs->add('New Country ', base_url().'country/add');
        $data['breadcrumbs'] = $this->breadcrumbs->output();

		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{

			$country_name = trim($this->input->post('country_name'));
			
			/*if(isset($_POST['default'])){
				$default = $this->input->post('default');
			}
			else{*/
				$default = 0;
			//}
			
			$config = array(array('field' => 'country_name','label' => 'Country Name','rules' => 'trim|required'));
				
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run() == FALSE){
					$data['ErrorMessages'] = validation_errors();
			}else{
				$postvalue = array("data"=>array('country_name'=>$country_name,'created_by'=>$this->session->userdata('user_id')));

				$country_result=$this->country_model->country_add($postvalue);
				if($country_result == true){
					$result['msg'] = 'Country added successfully ';
				}
				$this->session->set_flashdata('SucMessage', $result['msg']);
				redirect(base_url().'country/', 'refresh');
			}

		}
		
		$data['default_option'] = $this->country_model->check_default('location','loc_id');
		//print_r($data); exit;
		$this->load->view('header',$data);
		$this->load->view('country/add', $data);
		$this->load->view('footer');
	}
	
	public function edit($loc_id = null)
	{   
		$data['ErrorMessages']='';
		$data['menu'] = $this->roles;
		$data['siteTitle'] ='Country Edit';
		$this->breadcrumbs->add('Country', base_url().'country');
        $this->breadcrumbs->add('Edit Country ', base_url().'country/edit');
		$config = array(array('field' => 'country_name','label' => 'Country Name','rules' => 'trim|required'));
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run() == FALSE){
			$data['ErrorMessages'] = validation_errors();
		}else{
			$country_name = $this->input->post('country_name');
                        $default = 0;
			if(isset($_POST['status'])){
				$status = $this->input->post('status');
			}
			else{
				$status = 0;
			}
			$postvalue = array('loc_id'=>$loc_id, 'country_name'=>$country_name,'status' => $status);
			$country_result=$this->country_model->country_edit($postvalue);
			if($country_result == true){
				$result['msg'] = 'Country updated successfully';
			}
			$this->session->set_flashdata('SucMessage', $result['msg']);
			redirect(base_url().'country/', 'refresh');
		}
                
		if($loc_id!='')
		{
                    $country_info = $this->country_model->get_country_info($loc_id);
                    $data['result']=$country_info;
		}
                if(!access_edit($this->roles['country'],'country',$this->session->userdata('user_id'),$country_info['country']['created_by'])){
                     redirect(base_url().'error');
                }
		$data['default'] = $this->country_model->check_default('location','loc_id');
		$this->load->view('header',$data);
		$this->load->view('country/edit', $data);
		$this->load->view('footer');
	}
	public function delete($loc_id = null)
	{
		$postvalue = array('loc_id'=>$loc_id);
		$country_result=$this->country_model->country_delete($postvalue);
		//if($country_result == true){
			$result['msg'] = 'Country deleted successfully';
		//}
		
		$this->session->set_flashdata('SucMessage', $result['msg']);
		redirect(base_url().'country/', 'refresh');
	}
	public function domain_lists(){

		$country_id = $this->input->post('country_id');
		
		$result_loc =$this->comman_model->get_domain_country($country_id);

		$data['domain'] = $result_loc;
		//print_r($data['loc']);exit;
		$hotl = '';
		if($country_id > 0)
		{
			if(!empty($data['domain'])){
				$hotl .= "<select id='multiselect_domain' class='domain_change' required multiple='multiple' data-placeholder='Select Domain...'' name='domain[]' >";
				foreach($data['domain'] as $key=>$domain){
						
					$hotl .="<option   value='".$domain['domain_id']."'> ".$domain['domain_name']." </option>";
				}

			$hotl .='</select>';
			}else{
				//$domains = $this->comman_model->common_curl(SERVICE_URL.'domain_list',$datas = array());
				//$data['domain']=json_decode($domains, TRUE);
				//foreach($data['domain']['domain'] as $domain){			
				//	$hotl .="<option   value='".$domain['domain_id']."'> ".$domain['domain_name']." </option>";
				$hotl.= "<a href='".base_url()."domain/add/".$country_id."'>Country has no Domain Please add a domain for the country</a>";
				}
		}

			
		echo $hotl;//.'#'.$user;

	}

        
        public function get_org_country_domain()
        {
            $country_id = $this->input->post('country_id');
            $org_domain = $this->country_model->org_domain_lists($country_id);
            foreach($org_domain as $key=>$value){
            	$domain[$value['domain_id']] = $value['domain_name'];
            }
            $data['org_domain'] = $domain;
            $this->load->view('country/org_domain',$data);
        }

	public function edit_domain_lists(){

		$country_id = $this->input->post('country_id');
		
		$result_loc =$this->comman_model->get_domain_country($country_id);

		$data['domain'] = $result_loc;
		//print_r($data['loc']);exit;
		$hotl = '';
		if($country_id > 0)
		{
			if(!empty($data['domain'])){
				$hotl .= "<select data-md-selectize id='' required class='domain_change' data-placeholder='Select Domain...'' name='domain'>";
				foreach($data['domain'] as $key=>$domain){
						
					$hotl .="<option   value='".$domain['domain_id']."'> ".$domain['domain_name']." </option>";
				}

			$hotl .='</select>';
			}else{
				$hotl.= "<a href='".base_url()."domain/add/".$country_id."'>Country has no Domain Please add a domain for the country</a>";
				}
		}
			
		echo $hotl;//.'#'.$user;

	}










//Department list based on country and domain in organization add


	public function department_lists(){

		$country_id = $this->input->post('country_id');
		$domain_ids = $this->input->post('domain_ids');
		
		$result_loc =$this->comman_model->get_dept_domain($country_id,$domain_ids);

		$data['domain'] = $result_loc;
		//print_r($data['loc']);exit;
		$hotl = '';
		if($country_id > 0)
		{
			if(!empty($data['domain'])){

				$hotl .= "<select id='multiselect_department' onchange='departmentchange();' required multiple='multiple' data-placeholder='Select Department...'' name='department[]'> ";
				foreach($data['domain'] as $key=>$domain){
						
					$hotl .="<option   value='".$domain['dept_id']."'> ".$domain['dept_name']." </option>";
				}

			$hotl .='</select>';
			}else{
				
				$hotl.= "<a href='".base_url()."department/add/".$country_id."'>Country has no Domain Please add a domain for the country</a>";
				}
		}
			
		echo $hotl;

	}


	//Category list based on department
	public function category_lists(){

		$department_id = $this->input->post('department_id');
		
		$result_loc =$this->comman_model->get_category_dept($department_id);

		$data['domain'] = $result_loc;
		//print_r($data['domain']);exit;
		$hotl = '';
		if($department_id > 0)
		{
			if(!empty($data['domain'])){

				$hotl .= "<select id='multiselect_category' required multiple='multiple' data-placeholder='Select Category...' name='category[]'> ";
				foreach($data['domain'] as $key=>$domain){
						
					$hotl .="<option   value='".$domain['cat_id']."'> ".$domain['category_name']." </option>";
				}

			$hotl .='</select>';
			}else{
				
				//$hotl.= "<a href='".base_url()."category/add/".$department_id."'>Department has no Category Please add a category for the department</a>";
				}
		}
			
		echo $hotl;

	}

	public function check_default_country(){
		
		$return = $this->country_model->getdefaultcountry();
		
			echo $return;
		
	}

	public function set_default_country(){
		
		$change_id = $this->input->post('change_id');
		$default_id = $this->input->post('default_id');
		
		$return = $this->country_model->set_default_country($change_id,$default_id);

		$span[] = "<input type='button' class='default' name='default' value='Default' >";
		$span[] = "<input type='button' class='setdefault' name='setdefault' value='Set'>";

		
			echo json_encode($span);
		
	}


}
?>
