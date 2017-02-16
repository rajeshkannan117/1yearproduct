<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is Department controller of Formpro
 *
 * @package		CodeIgniter
 * @category	controller
 * @author		RajeshKannan.C
 * @link		http://innoppl.com/
 *
 */
include APPPATH . 'controllers/OAuth.php';
include APPPATH . 'controllers/common.php';

class Department extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('comman_model');
        $this->load->model('department_model');
        $this->load->model('webservice_model');
        $this->load->model('login_model');
        $this->load->helper('date');
        $user_id = $this->session->userdata('user_id');
        //Check the user is logged in properly
         if($this->session->userdata('logged_in') != true)
          {
          $this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);
          redirect(base_url().'login/', 'refresh');
          } 
        $this->roles = $this->login_model->assign_roles($user_id);
        $method = $this->router->fetch_method();
        switch ($method) {
            case 'add':
                if (!in_array('create', $this->roles['department'])) {
                    die('unauthorised access');
                }
                break;
            case 'edit':
                if ((!in_array('update', $this->roles['department'])) && (!in_array('create', $this->roles['department']))) {
                    die('unauthorised accesss');
                }
                break;
            case 'delete':
                if (!in_array('delete', $this->roles['department'])) {
                    die('unauthorised access');
                }
                break;
            case 'index':
                if (!in_array('read', $this->roles['department'])) {
                    die('unauthorised access');
                }
            default:
                break;
        }
    }

    public function index() {
        $data['menu'] = $this->roles;
        if ($this->session->userdata('user_id') == 1) {
            $list_user_id = 1;
        } else {
            $list_user_id = $this->session->userdata('user_id');
        }


        $data['roles'] = $this->roles['department'];

        $data['menu'] = $this->roles;
        

        $org_id = $this->session->userdata('org_id');
        
        $org_info = $this->comman_model->getorg_info($org_id);
        
        if($org_info->org_dept_not_in=='')
        {
            $dept_not_in = "''";
        }else{
            $dept_not_in = $org_info->org_dept_not_in;
        }
        
        if($org_id!=1)
        {	//echo $org_id;
            $org_domain = $this->comman_model->getDomainlist_org($org_id);
            //print_r($org_domain);
            $orgdomain_arr = array();
            
            foreach ($org_domain as $key => $value) {
                $orgdomain_arr[] = $value['domain_id'];
            }
            $orgdomain_in = implode(',', $orgdomain_arr);
        }else{
            $orgdomain_in = "''";
        }


	$system_default = $org_info->system_default;

        $result['department'] = $this->department_model->department_list($org_id,$dept_not_in,$orgdomain_in,$system_default);
        $data['result'] = $result;

	$data['org_id'] = $org_id;
        $data['siteTitle'] = 'Department list ' . SITE_NAME;
        $this->load->view('header', $data);
        $this->load->view('department/list', $data);
        $this->load->view('footer', $data);
    }

    public function dept_list() {
        $org_id = $this->input->post('org_id');
        //echo $org_id; exit;
        $departments = $this->department_model->dept_list($org_id);
        $html = '<select id="multiselectdept" required multiple="multiple" data-placeholder="Select Departments..." name="depts[]">';
        if (isset($departments) && count($departments) > 1) {
            foreach ($departments as $key => $value) {
                $html.='<option value="' . $value['dept_id'] . '">' . $value['dept_name'] . '</option>';
            }
        }
        $html.='</select>';
        echo $html;
        exit;
    }

    public function add() {
        $data['ErrorMessages'] = '';
        $data['menu'] = $this->login_model->assign_roles($this->session->userdata('user_id'));
        $data['siteTitle'] = 'Add Department - ' . SITE_NAME;

        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $dept_name = trim($this->input->post('dept_name'));
            $dept_desc = $this->input->post('dept_desc');
            $dept_domain = $this->input->post('domain');
            $org_id = $this->session->userdata('org_id');
            
            if(isset($_POST['depart_default']) && $_POST['depart_default']=='yes')
            {
                $default = 1;
            }
            else
            {
                $default = 0;
            }


            $postvalue = array("data" => array('default'=>$default,'org_id' => $org_id,'dept_name' => $dept_name, 'dept_desc' => $dept_desc,  'created_by' => $this->session->userdata('user_id')));

            $result = $this->department_model->department_add($postvalue, $dept_domain);

            redirect(base_url() . 'department/', 'refresh');
        }
        
        
        $list_user_id = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');
        
        if($org_id==1)
        {
            $data['domain'] = $this->comman_model->getDomainlist($list_user_id);
        }
        else
        {	
            $data['domain'] = $this->comman_model->getDomainlist_org($org_id);
        }
        
        
        $data['org_id'] = $this->session->userdata('org_id');
        //$data['domain'] = $this->comman_model->getDomainlist($list_user_id);
        $data['org_id'] = $this->session->userdata('org_id');
        $data['org_default'] = '';
        $data['dept_id'] = '';
        $data['dept_name'] = '';
        $data['dept_desc'] = '';
        $data['dept_domain'] = array();
        $data['dept_domain_all'] = '';
//print_r($data);
	if ($org_id != 1 && $this->session->userdata('user_id') != 1) {
        $data['setdepartmentCustomjs'] = 'yes';
        }
        $data['siteTitle'] = 'Add Department';
        $this->load->view('header', $data);
        $this->load->view('department/add', $data);
        $this->load->view('footer');
    }

    public function edit($dept_id = null) {
        $data['ErrorMessages'] = '';
        $data['menu'] = $this->login_model->assign_roles($this->session->userdata('user_id'));
$org_id = $this->session->userdata('org_id');
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $dept_id = $this->input->post('dept_id');
            $dept_name = trim($this->input->post('dept_name'));
            $dept_desc = $this->input->post('dept_desc');
            
            
            if(isset($_POST['depart_default']) && $_POST['depart_default']=='yes')
            {
                $default = 1;
            }
            else
            {
                $default = 0;
            }
            
            $dept_domain = $this->input->post('domain');
            $dept_pre_domain = $this->input->post('previous_domain');

            $dept_pre_domain_arr = explode(',', $dept_pre_domain);

            $domain_add = array_diff($dept_domain, $dept_pre_domain_arr);

            $domain_del = array_diff($dept_pre_domain_arr, $dept_domain);
            $this->department_model->add_department_domain($domain_add, $dept_id);

            if (!empty($domain_del)) {
                $this->department_model->del_department_domain($domain_del, $dept_id);
            }
            $data = array('default'=>$default,'org_id' => $org_id,'dept_name' => $dept_name, 'dept_desc' => $dept_desc);
            $this->department_model->department_update($data, $dept_id);


            $postvalue = array("data" => array('dept_name' => $dept_name, 'dept_desc' => $dept_desc, 'default' => 1, 'created_by' => $this->session->userdata('user_id')));

            redirect(base_url() . 'department/', 'refresh');
        }

        if ($dept_id != '') {
            $dept_info = $this->department_model->getDeptInfo($dept_id);

            $dept_count = array();
//            print_r($dept_info);
            if (!empty($dept_info)) {
                foreach ($dept_info as $key => $di) {
                    $dept_count[] = $di['domain_selected'];
                }
            }

            $data['org_id'] = $this->session->userdata('org_id');
            $data['dept_id'] = $dept_info[0]['dept_id'];
            $data['dept_name'] = $dept_info[0]['dept_name'];
            $data['dept_desc'] = $dept_info[0]['dept_desc'];
            $data['org_default'] = $dept_info[0]['default'];
            $data['dept_domain'] = $dept_count;
            $data['dept_domain_all'] = implode(',', $dept_count);


            $list_user_id = $this->session->userdata('user_id');


            $data['domain'] = $this->comman_model->getDomainlist_org($this->session->userdata('org_id')); 
        }

        $data['siteTitle'] = 'Update Department - ' . SITE_NAME;	
	if ($org_id != 1 && $this->session->userdata('user_id') != 1) {
        $data['setdepartmentCustomjs'] = 'yes';
        }

        $this->load->view('header', $data);
        $this->load->view('department/add', $data);
        $this->load->view('footer');
    }

    public function delete($dept_id = null) {
        
        $dept_info = $this->comman_model->get_dept_info($dept_id);
        $user_id = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');
        if(($dept_info->created_by!=1) || ($dept_info->created_by==1 && $org_id==1))
        {
            $this->department_model->department_delete($dept_id);
        }
        else
        {
            $org_info = $this->comman_model->getorg_info($org_id);
            
            if($org_info->org_dept_not_in=='')
            {
                $dept_not_in = $dept_id;
            }
            else
            {
                $dept_not_in = $org_info->org_dept_not_in.','.$dept_id;
            }
            
            $this->department_model->department_org_notin($dept_not_in,$org_id);
        }
        
        $this->session->set_flashdata('SucMessage', 'Department Sucessfully deleted.');
        redirect(base_url() . 'department/', 'refresh');
    }

    public function department_delete_check() {
        if (isset($_POST['dept_id']) && $_POST['dept_id'] != '') {
            $dept_id = $_POST['dept_id'];
            echo $this->department_model->check_department_delete($dept_id);
        }
    }

    public function department_status_change()
    {
        if (isset($_POST['dept_id']) && $_POST['dept_id'] != '' && isset($_POST['status'])) {
            $dept_id = $_POST['dept_id'];
            $status = $_POST['status'];
            $data = array('status' => $status);
            $this->department_model->department_update($data, $dept_id);
            
            echo 1;
        }
    }
    
    public function check_department_default()
    {
        if (isset($_POST['org_id']) && $_POST['org_id'] != '') {
            $org_id = $_POST['org_id'];
            
            $res = $this->department_model->check_org_dept_default($org_id);
            
            if($res==0)
            {
                echo '0';
            }
            else
            {
                echo '1';
            }
        }
    }
    
    /* Validation Function */

    public function check_default_country() {
        $default_country = $this->webservice_model->getdefaultcountry('sad');
        $country_id = $default_country[0]['loc_id'];
        $countries = $this->input->post('countries');
        /* get country name */
        $default_country_name = $this->webservice_model->get_country_info($country_id);
        $msg = "Must Select default country (" . $default_country_name['country']['country_name'] . ") to set default department.";
        if ($country_id != $countries) {
            $this->form_validation->set_message('check_default_country', $msg);
            return false;
        }
        return true;
    }

    public function check_default_domain() {
        /* get default_country */
        $default_country = $this->webservice_model->getdefaultcountry('sad');
        $default_country_id = $default_country[0]['loc_id'];
        /* Post details */
        $country_id = $this->input->post('countries');
        $domains = $this->input->post('domain');
        /* check post country has  default domain */
        $domain = $this->webservice_model->getdefaultdomaincountry($country_id);
        $domain_id = $domain['default_domain'];
        /* get country name */
        $default_country_name = $this->webservice_model->get_country_info($default_country_id);
        /* Get domain name */
        $default_domain_name = $this->webservice_model->domain_name($domain_id);
        $msg = "Must Select default domain (" . $default_domain_name['domain_name'] . ") for this default country (" . $default_country_name['country']['country_name'] . ") to set default department.";
        if (!in_array($domain_id, $domains)) {
            $this->form_validation->set_message('check_default_domain', $msg);
            return false;
        }
        return true;
    }

    public function check_default_department() {

        $map_id = $this->input->post('mapid');

        $return = $this->department_model->check_default_department($map_id);

        echo json_encode($return);
    }

    public function set_default_department() {

        $change_id = $this->input->post('change_id');
        $default_id = $this->input->post('default_id');

        $return = $this->department_model->set_default_department($change_id, $default_id);

        $span[] = "<input type='button' class='default' name='default' value='Default' >";
        $span[] = "<input type='button' class='setdefault' name='setdefault' value='Set'>";

        echo json_encode($span);
    }

}
