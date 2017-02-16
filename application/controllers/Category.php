<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is Category controller of Formpro
 *
 * @package             CodeIgniter
 * @category            controller
 * @author              Rajeshkannan.C
 * @link                http://innoppl.com/
 *
 */
include APPPATH . 'controllers/OAuth.php';
include APPPATH . 'controllers/common.php';

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('comman_model');
        $this->load->model('category_model');
        $this->load->language('menu');
        $this->load->language('category');
        $this->load->library('breadcrumbs');
        $this->load->model('department_model');
        $this->load->model('webservice_model');
        $this->load->helper('access');
        define_constants();
        $this->load->model('login_model'); 
        $this->load->library('uuid');
        $user_id = $this->session->userdata('user_id');
        //Check the user is logged in properly
        if ($this->session->userdata('logged_in') == false) {
            $this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);
            redirect(base_url() . 'login/', 'refresh');
        }
        $this->roles = $this->login_model->assign_roles($user_id);
        $this->load->helper('date');
        $method = $this->router->fetch_method();
        switch ($method) {
            case 'add':
                if(!in_array('create',$this->roles['category'])){
                 redirect(base_url().'error');
                }
                break;
            case 'edit':
                if((!in_array('update',$this->roles['category'])) && (!in_array('create',$this->roles['category']))){
                     redirect(base_url().'error');
                }
                break;
            case 'delete':
                if(!in_array('delete',$this->roles['category'])){
                     redirect(base_url().'error');
                }
                break;
            case 'index':
                if(!in_array('read',$this->roles['category'])){
                     redirect(base_url().'error');
                }
            default:
                break;
        }
        $this->load->helper('date');

        
    }

    // List Category //
    public function index() {
        $data['ErrorMessages'] = '';
        $data['siteTitle'] = $this->lang->line('category').' - '. SITE_NAME;
        $data['roles'] = $this->roles['category'];
        $data['menu'] = $this->roles;
        $this->breadcrumbs->add('Category', base_url().'category');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $data['user_id'] = $this->session->userdata('user_id');
        $list_user_id = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');
        $form_category = array();
        $cat_form = array();
        $cat_dept = array();
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
        $data['result'] = $list;
        //print_r($list);exit;
        /* Form Category */
        $cat_id = array();
        foreach($list as $key=>$value){
            $cat_id[] = $value['cat_id'];
        }
        if(count($cat_id) > 0){
            $cat_form = $this->category_model->category_form_list($cat_id,$org_id);
            foreach($cat_form as $key=>$value){
                $form_category[$value['cat_id']][$value['uuid']] = $value['form_name'];
            }
            $cat_department = $this->category_model->category_department_list($cat_id,$org_id);
            foreach($cat_department as $key=>$value){
                $category_department[$value['cat_id']][$value['uuid']] = $value['dept_name'];
            }
        }
        //print_r($category_department);

        $data['form_category'] = $form_category;
        $data['org_id'] = $org_id;
        $data['cat_form'] = $cat_form;
        $this->load->view('header', $data);
        $this->load->view('category/list', $data);
        $this->load->view('footer');
    }

    // Add Category //
    public function add() { 
        $data['ErrorMessages'] = '';

        $org_id = $this->session->userdata('org_id');
        $this->breadcrumbs->add('Category', base_url().'category');
        $this->breadcrumbs->add('New Category ', base_url().'category/add');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $list_user_id = $this->session->userdata('user_id');

         $data['siteTitle'] = $this->lang->line('category_add').' - '. SITE_NAME;
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {



            $cat_name = trim($this->input->post('cat_name'));
            $cat_desc = trim($this->input->post('cat_desc'));
            $department = $this->input->post('department');
            $org_id = $this->input->post('org_id');
            
            $postvalue = array("data" => array('org_id'=>$org_id,'category_name' => $cat_name, 'category_desc' => $cat_desc, 'default' => 1, 'status' => 1, 'created_by' => $this->session->userdata('user_id'),'uuid'=>$this->uuid->v4()));

            $this->category_model->category_add($postvalue, $department);

            $this->session->set_flashdata('SucMessage', 'Category added Successfully');
            redirect(base_url() . 'category', 'refresh');
        }

        $org_id = $this->session->userdata('org_id');

        if ($org_id != 1) { 
            $org_info = $this->comman_model->getorg_info($org_id);

            if ($org_info->org_dept_not_in == '') {
                $dept_not_in = "''";
            } else {
                $dept_not_in = $org_info->org_dept_not_in;
            }

$org_domain = $this->comman_model->getDomainlist_org($org_id);
            
            $orgdomain_arr = array();
            
            foreach ($org_domain as $key => $value) {
                $orgdomain_arr[] = $value['domain_id'];
            }
            
            if(empty($orgdomain_arr))
            {
                $orgdomain_in = "''";
            }else{
                $orgdomain_in = implode(',', $orgdomain_arr);
            }
            
            $system_default = $org_info->system_default;
            
            $data['department'] = $this->department_model->department_list($org_id,$dept_not_in,$orgdomain_in,$system_default);

            $data['cat_depart'] = array();

            foreach ($data['department'] as $key => $value) {
                $data['cat_depart'][] = $value['dept_id'];
            }

//            $domain_dept_de = implode(',', $data['cat_depart']);
//
//            if ($domain_dept_de == '') {
//                $domain_dept_de = "''";
//            } else {
//                $domain_dept_de = $domain_dept_de;
//            }
//
//            $category_domain = $this->category_model->get_cate_dept_domain($domain_dept_de);
//
//            $data['category_domain'] = explode(',', $category_domain);
//
//            if ($category_domain == '') {
//                $cate_arr_db = "''";
//            } else {
//                $cate_arr_db = $category_domain;
//            }
        }
        else
        {
            $data['department'] = array();
            $data['cat_depart'] = array();
            $data['category_domain'] = array();
	    $cate_arr_db = "''";
        }

        /* Domain List */
        if ($org_id == 1) {
            $data['domain'] = $this->comman_model->getDomainlist($list_user_id);
        } else {
            $data['domain'] = $this->comman_model->getDomainlist_org($org_id);
        }
        $data['cat_name'] = '';
        $data['cat_desc'] = '';


        $data['cat_id'] = '';

           
           $data['cat_depart_pre'] = '';
        $data['menu'] = $this->roles;
        $data['org_id'] = $org_id;
        $data['cat_depart_pre'] = '';


//print_r($data);
        $this->load->view('header', $data);
        $this->load->view('category/add', $data);
        $this->load->view('footer');
    }

    // Update Category //

    public function edit($uuid = null) {
        $category_id = $this->category_model->check_category_exists($uuid);
        if(empty($category_id)){
            redirect(base_url().'error','refresh');
        }
        $this->breadcrumbs->add('Category', base_url().'category');
        $this->breadcrumbs->add('Edit Category ', base_url().'category/edit/'.$uuid);
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $data['ErrorMessages'] = '';
        $data['siteTitle'] = $this->lang->line('category_edit').' - '. SITE_NAME;
        $data['menu'] = $this->roles;
        $org_id = $this->session->userdata('org_id');

        $list_user_id = $this->session->userdata('user_id');

        if (($this->input->server('REQUEST_METHOD') == 'POST')) {


            $cat_name = trim($this->input->post('cat_name'));
            $cat_desc = trim($this->input->post('cat_desc'));
            $department = $this->input->post('department');
            $cate_id = $this->input->post('cate_id');
            $org_id = $this->input->post('org_id');
            $pre_department = $this->input->post('depart_previopus');

            $pre_department_arr = explode(',', $pre_department);

            $depart_add = array_diff($department, $pre_department_arr);

            $depart_del = array_diff($pre_department_arr, $department);

            $this->category_model->add_category_depart($depart_add, $cate_id);

            if (!empty($depart_del)) {
                $this->category_model->del_category_depart($depart_del, $cate_id);
            }

            $postvalue = array("data" => array('category_name' => $cat_name, 'category_desc' => $cat_desc, 'default' => 1, 'status' => 1));

            $this->category_model->category_update($postvalue['data'], $cate_id);            

                $this->session->set_flashdata('SucMessage', 'Edited Successfully');
                redirect(base_url() . 'category/', 'refresh');
        }
         if ($category_id != '') {


            $info = $this->category_model->get_category_info($category_id);
           
            $data['cat_id'] = $info->cat_id;
            $data['cat_name'] = $info->category_name;
            $data['cat_desc'] = $info->category_desc;
            $org_id = $this->session->userdata('org_id');
	    $data['org_id'] = $org_id;


	    $data['domain'] = $this->comman_model->getDomainlist($org_id);
            $data['category_domain_ar'] = $this->category_model->get_category_domain($category_id);
            $data['category_domain'] = explode(',', $data['category_domain_ar'][0]['domian_cate']);

	    $org_info = $this->comman_model->getorg_info($org_id);
            
            if($org_info->org_dept_not_in=='')
            {
                $dept_not_in = "''";
            }else{
                $dept_not_in = $org_info->org_dept_not_in;
            }
            
            $system_default = $org_info->system_default;

            $data['department'] = $this->department_model->department_list($org_id, "''", "''", $system_default);


	
        if ($org_id != 1) {

            $data['domain'] = $this->comman_model->getDomainlist_org($org_id);
                //print_r($data['domain']);
                foreach ($data['domain'] as $key => $value) {
                    $data['category_domain'][] = $value['domain_id'];
                }		

            $org_info = $this->comman_model->getorg_info($org_id);

            if ($org_info->org_dept_not_in == '') {
                $dept_not_in = "''";
            } else {
                $dept_not_in = $org_info->org_dept_not_in;
            }

             $org_domain = $this->comman_model->getDomainlist_org($org_id);
            
            $orgdomain_arr = array();
            
            foreach ($org_domain as $key => $value) {
                $orgdomain_arr[] = $value['domain_id'];
            }
            
            if(empty($orgdomain_arr))
            {
                $orgdomain_in = "''";
            }else{
                $orgdomain_in = implode(',', $orgdomain_arr);
            }
            
            
            
            $data['department'] = $this->department_model->department_list($org_id,$dept_not_in,$orgdomain_in);
            

            
            
        }


$data['cat_depart'] = $this->category_model->get_cate_depart($category_id);
            $data['cat_depart_pre'] = $data['cat_depart'][0]['dept'];
            $data['cat_depart'] = explode(',', $data['cat_depart'][0]['dept']);

        if (!access_edit($this->roles['category'], 'category', $this->session->userdata('user_id'), $info->created_by)) {
            redirect(base_url() . 'error');
        }



//        print_r($data);
	
        $this->load->view('header', $data);
        $this->load->view('category/add', $data);
        $this->load->view('footer');
    }
    }

    //Delete Function 
    public function delete($uuid = null) {
        $category_id = $this->category_model->check_category_exists($uuid);
        $cat_info = $this->comman_model->get_cat_info($category_id);
        
        $user_id = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');
        if(($cat_info->created_by !=1) || ($cat_info->created_by==1 && $org_id==1))
        {
            $this->category_model->category_delete($category_id);
        }
        else
        {            
            $org_info = $this->comman_model->getorg_info($org_id);
            
            if($org_info->org_cat_not_in=='')
            {
                $cat_not_in = $category_id;
            }
            else
            {
                $cat_not_in = $org_info->org_cat_not_in.','.$category_id;
            }
            
            $this->category_model->category_org_notin($cat_not_in,$org_id);
        }
        $this->session->set_flashdata('SucMessage', 'Category Sucessfully deleted.');
        redirect(base_url() . 'category/', 'refresh');
        
    }

    public function category_delete_check() {

        if (isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != '') {
            $cat_id = $_REQUEST['cat_id'];
            echo $this->category_model->check_category_form($cat_id);
        }
    }

    public function department_lists() {

        $country_id = $this->input->post('country_id');
        $domain_ids = $this->input->post('domain_id');

        $result_loc = $this->comman_model->get_dept_domain($country_id, $domain_ids);

        $data['domain'] = $result_loc;
        //print_r($data['loc']);exit;
        $hotl = '';
        if ($country_id > 0) {
            if (!empty($data['domain'])) {

                $hotl .= "<select data-md-selectize id='' required data-placeholder='Select Department...'' name='department[]'> ";
                foreach ($data['domain'] as $key => $domain) {

                    $hotl .="<option   value='" . $domain['dept_id'] . "'> " . $domain['dept_name'] . " </option>";
                }

                $hotl .='</select>';
            } else {

                $hotl.= "<a href='" . base_url() . "department/add/" . $country_id . "'>Domain has no Departments Please add a department for the domain</a>";
            }
        }

        echo $hotl;
    }

    public function check_default_department() {
        $selected_department = $this->input->post('department');
        $default_department = $this->department_model->getdefaultdepartment();
        $msg = "Must Select default department (" . $default_department[0]->dept_name . ") for default category.";
        if (!in_array($default_department[0]->dept_id, $selected_department)) {
            $this->form_validation->set_message('check_default_department', $msg);
            return false;
        }
        return true;
    }

    public function check_default_category() {

        $map_id = $this->input->post('mapid');

        $return = $this->category_model->check_default_category($map_id);

        echo json_encode($return);
    }

    public function set_default_category() {

        $change_id = $this->input->post('change_id');
        $default_id = $this->input->post('default_id');

        $return = $this->category_model->set_default_category($change_id, $default_id);

        $span[] = "<input type='button' class='default' name='default' value='Default' >";
        $span[] = "<input type='button' class='setdefault' name='setdefault' value='Set'>";

        echo json_encode($span);
    }

    /* List of all domain name along with country mapping list */

    public function domain_country_map_list() {
        $domain_country_map = array();
        $domain_country = $this->comman_model->domain_country_mapping_list();
        foreach ($domain_country as $key => $value) {
            $domain_country_map[$value['id']] = $value['domain_name'];
        }
        return $domain_country_map;
    }

    /* List out departments based on the domain */

    public function domain_department_list() {

        $domain_id = $_POST['domain_id'];

        if (!empty($domain_id)) {
            $domain_id = implode(',', $domain_id);
        } else {
            $domain_id = "''";
        }

        if ($_POST['depart_id'] && !empty($_POST['depart_id'])) {
            $depart_id = $_POST['depart_id'];
        } else {
            $depart_id = array();
        }
        $multi_select = '<select required id="multiselect_department" multiple="multiple" data-placeholder="Select Department..." class="department" name="department[]">';
//        foreach($domain_id as $key=>$value){
        $department = $this->comman_model->domain_department_list($domain_id);
        //print_r($department);
        foreach ($department as $k => $v) {

            if (in_array($v['dept_id'], $depart_id)) {
                $select_id = "selected='selected'";
            } else {
                $select_id = '';
            }

            $multi_select .= '<option value="' . $v['dept_id'] . '" ' . $select_id . '>' . $v['dept_name'] . '</option>';
        }
//        }
        $multi_select .='</select>';
        echo $multi_select;
        exit;
    }

}
