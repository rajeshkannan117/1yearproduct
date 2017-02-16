<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is Domain controller of Formpro
 *
 * @package		CodeIgniter
 * @category	controller
 * @author		RajeshKannan.C
 * @link		http://innoppl.com/
 *
 */
include APPPATH.'controllers/OAuth.php';
include APPPATH.'controllers/common.php';
class Domain extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('comman_model');
		$this->load->model('webservice_model');
		$this->load->language('menu');
        $this->load->language('domain');
		$this->load->model('domain_model');
		$this->load->model('country_model');
		$this->load->helper('date');
        $this->load->helper('access');
        //$this->load->helper('access');
        define_constants();
		$this->load->model('login_model');
		$this->load->library('breadcrumbs');
		$this->load->library('uuid');
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
                if(!in_array('create',$this->roles['domain'])){
                    redirect(base_url().'error');
                }
                break;
            case 'edit':
                if((!in_array('update',$this->roles['domain'])) && (!in_array('create',$this->roles['domain']))){
                     redirect(base_url().'error');
                }
                break;
            case 'delete':
                if(!in_array('delete',$this->roles['domain'])){
                     redirect(base_url().'error');
                }
                break;
            case 'index':
                if(!in_array('read',$this->roles['domain'])){
                    redirect(base_url().'error');
                }
            default:
                break;
        }
	}

	public function index()
	{
		$data['ErrorMessages']='';
		$data['roles'] = $this->roles['domain'];
        $data['menu'] = $this->roles;
        $data['siteTitle'] ='Industry';
        $data['user_id'] = $this->session->userdata('user_id');
		$postvalue = array('');
		$this->breadcrumbs->add('Industry', base_url().'domain');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		$data['details'] = $this->domain_model->domain_list();
		$data['default_country'] = $this->country_model->defaultcountrydetails();
		$this->load->view('header',$data);
		$this->load->view('domain/list', $data);
		$this->load->view('footer',$data);
		
	}

	public function add($country_id = null)
	{
			//echo 'asdas';
		$data['ErrorMessages']='';
		$data['siteTitle'] = 'Add Industry - '.SITE_NAME;
		$this->breadcrumbs->add('Industry', base_url().'domain');
        $this->breadcrumbs->add('New Industry ', base_url().'domain/add');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{

			$domain_name = trim($this->input->post('domain_name'));
			$domain_desc = $this->input->post('domain_desc');
			$countries = $this->input->post('countries');
			if(isset($_POST['default'])){
				$default = $this->input->post('default');
			}
			else{
				$default = 0;
			}
			if(isset($_POST['status'])){
				$status = $this->input->post('status');
			}
			else{
				$status = 0;
			}
			//print_r($_POST); exit;
			if(isset($_POST['action'])){
				if($_POST['action'] == 1){
					$action = 1;
					$change_default = explode(",",$this->input->post('change_default'));
				}else if($_POST['action'] == 0){
					$action = 0;
					$change_default = explode(",",$this->input->post('change_default'));
				}
				else{
					$action = -1;
					$change_default = array();
				}
		    }
			$config = array(array('field' => 'domain_name','label' => 'Domain Name','rules' => 'trim|required'));
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run() == FALSE){
					$data['ErrorMessages'] = validation_errors();
			}else{
				$postvalue = array("data"=>array('domain_name'=>$domain_name,'domain_desc'=>$domain_desc,'default'=>$default,'countries'=>$countries,'created_by'=>$this->session->userdata('user_id'),'action'=>$action,'change_default'=>$change_default,'uuid'=>$this->uuid->v4()));
				//print_r($postvalue); exit;
				$result=$this->domain_model->domain_add($postvalue);
				$this->session->set_flashdata('SucMessage', $result['msg']);
				redirect(base_url().'domain/', 'refresh');
			}

		}
		$countries = $this->country_model->getcountrylist();
		if($country_id > 0){
			$def = $country_id;
		}
		else{
			$def= $this->country_model->getdefaultcountry();
	    }
		$data['countries']=$countries;
		$data['default'] = $def;
                $data['menu'] = $this->roles;
		$data['default_option'] = 0; //$this->comman_model->check_default('domain_country_mapping','default','');
		$this->load->view('header',$data);
		$this->load->view('domain/add', $data);
		$this->load->view('footer');
	}

	public function edit($uuid = null)
	{
		$domain_id = $this->domain_model->check_domain_exists($uuid);
		if(empty($domain_id)){
			redirect(base_url().'error','refresh');
		}
		$data['ErrorMessages']='';
		$data['siteTitle'] = 'Edit Industry - '.SITE_NAME;
		$this->breadcrumbs->add('Industry', base_url().'domain');
        $this->breadcrumbs->add('Edit Industry ', base_url().'domain/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			//print_r($_POST);exit;
			$domain_name = trim($this->input->post('domain_name'));
			$domain_desc = $this->input->post('domain_desc');
			$countries = $this->input->post('countries');

			/* Have to validate default set for domain selected country have already default */
			$domain_id = $this->input->post('domain_id');
			$map_id = $this->input->post('map_id');
			if(isset($_POST['default'])){
				$default = $this->input->post('default');
			}
			else{
				$default = 0;
			}
			if(isset($_POST['status'])){
				$status = $this->input->post('status');
			}
			else{
				$status = 0;
			}
			$config = array(array('field' => 'domain_name','label' => 'Domain Name','rules' => 'trim|required'));
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run() == FALSE){
					$data['ErrorMessages'] = validation_errors();
			}else{
                                $postvalue = array("data"=>array('domain_name'=>$domain_name,'domain_desc'=>$domain_desc,'default'=>$default,'created_by'=>$this->session->userdata('user_id'),'domain_id'=>$domain_id,'map_id'=>$map_id));
                                $result=$this->domain_model->domain_update($postvalue,$countries);
                                $this->session->set_flashdata('SucMessage', $result['msg']);
                                redirect(base_url().'domain/', 'refresh');
			}
		}

		if($domain_id != '')
		{
			$domain_info = $this->domain_model->get_domain_info($domain_id);
			$domain = array();
			foreach($domain_info['domain'] as $key=>$value){
				$domain['domain_id'] = $value['domain_id'];
				$domain['domain_name'] = $value['domain_name'];
				$domain['domain_desc'] = $value['domain_desc'];
				$domain['status'] = $value['status'];
				$domain['default'] = $value['default'];
                                $domain['created_by'] = $value['created_by'];
				$domain['country'][] = $value['country_id'];
				
			}
			/* check country has one default domain or not */
			$check_default = $this->domain_model->check_default_domain_country($domain_info['domain'][0]['country_id']);
			if($check_default){
				$show_default = ($domain_id === $check_default)?1:0;
			}
			else{
				$show_default = 1;
			}
			$countries = $this->country_model->getcountrylist();
			$data['domain']=$domain;			
			$data['show_default'] = $show_default;
			$data['countries']=$countries;
		}
                if(!access_edit($this->roles['domain'],'domain',$this->session->userdata('user_id'),$domain['created_by'])){
                     redirect(base_url().'error');
                }
                $data['menu'] = $this->roles;
		$this->load->view('header',$data);
		$this->load->view('domain/edit', $data);
		$this->load->view('footer');
	}

      public function domain_delete_check() {
        if (isset($_POST['domain_id']) && $_POST['domain_id'] != '') {
            $domain_id = $_POST['domain_id'];
            echo $this->domain_model->check_domain_delete($domain_id);
        }
      }
	public function delete($domain_id = null)
	{
		$postvalue = array('domain_id'=>$domain_id);
		$result=$this->domain_model->domain_delete($postvalue);
		//$result=json_decode($result, TRUE);
		$result['msg'] = "Industry deleted successfully";
		$this->session->set_flashdata('SucMessage', $result['msg']);
		redirect(base_url().'domain/', 'refresh');
	}

	public function check_domain_unique()
        {
                if (isset($_POST['domain_name']) && $_POST['domain_name'] != '') {
                
                $domain_name = $_POST['domain_name'];
                
                $result = $this->domain_model->check_domain_unique($domain_name);

                if(!empty($result) && strtolower($result->domain_name) ==  strtolower($domain_name))
                {
                    echo '<span style="color:red;">This name is already registered,Please <a href="'.base_url().'domain/edit/'.$result->uuid.'" style="color:blue;">Click here</a> to edit it.</span>';
                }
                else
                {
                    echo 'no';
                }
                
                
            }
        }

	/* Validation Function */
	/*public function check_default_country(){
		$default_country = $this->webservice_model->getdefaultcountry('sad');
		$country_id = $default_country[0]['loc_id'];
		$countries = $this->input->post('countries');
		/* get country name 
		$default_country_name = $this->webservice_model->get_country_info($country_id);
		$msg = "Must Select default country (".$default_country_name['country']['country_name'].") for default domain.";
		if(!in_array($country_id, $countries)){
			$this->form_validation->set_message('check_default_country',$msg);
			return false;
		}
		return true;
	}*/

/* Ajax Function Calls when default set for list of countries */
// Params country_id (multiple value)
	public function check_default_country(){
		//$default_country = $this->webservice_model->getdefaultcountry('sad');
		//$country_id = $default_country[0]['loc_id'];
		$country_id = $this->input->post('country_id');
		//$countries = $this->input->post('countries');
		/* get country name */
		//$default_country_name = $this->webservice_model->get_country_info($country_id);
		$return = $this->domain_model->check_default_country($country_id);
		if(count($return) > 0 ){
			$return['success']='false';
			echo json_encode($return);
		}
		else{
			$return['success']= 'true';
			echo json_encode($return);
		}
	}
/* Ajax Function Calls when domain edit page country Changes */
// Params country_id (single value)
	public function check_country_has_default(){
		$country_id = $this->input->post('country_id');
		$return = $this->domain_model->check_default_domain_country($country_id);
		if($return){
			echo 1;
		}
		else{
			echo 0;
		}

	}

	public function getdefault_domain_country(){
		
		$country_id = $this->input->post('country_id');
		
		
		$return = $this->domain_model->getdefault_domain_country($country_id);
		
			echo json_encode($return);
		
	}


	public function check_default_domain(){
		
		$map_id = $this->input->post('mapid');
		
		$return = $this->domain_model->check_default_domain($map_id);
		
			echo json_encode($return);
		
	}

	public function set_default_domain(){
		
		$change_id = $this->input->post('change_id');
		$default_id = $this->input->post('default_id');
		
		$return = $this->domain_model->set_default_domain($change_id,$default_id);

		$span[] = "<input type='button' class='default' name='default' value='Default' >";
		$span[] = "<input type='button' class='setdefault' name='setdefault' value='Set'>";
		
			echo json_encode($span);
		
	}



}
