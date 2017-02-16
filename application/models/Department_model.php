<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * This is Department Model of Formpro
 *
 * @package	CodeIgniter
 * @category	Department
 * @author	Rajeshkannan Chandrasekar
 * @link	http://innoppl.com/
 *
 */
class Department_model extends CI_Model {

    public function __construct() {
        date_default_timezone_set("America/New_York");
        $this->load->database();
        $this->load->helper('date');
    }

    /*

      Function : department_add
      Params : department form data
      Returns : none
      Description: Function save department post data into department table
      and update the country and domain into department mapping table

     */

    public function department_add($posts, $domains) {
        $post = $posts['data'];//print_r($post);
        $department = array(
            'dept_name' => trim($post['dept_name']),
            'dept_desc' => trim($post['dept_desc']),
            'default' => $post['default'],
            'status' => '1',
            'created_at' => gmdate(date("Y-m-d H:i:s")),
            'updated_at' => gmdate(date("Y-m-d H:i:s")),
            'created_by' => $post['created_by'],
            'org_id' => $post['org_id'],
            'uuid' =>$post['uuid']
        );
        $this->db->insert('department', $department);
        $dept_id = $this->db->insert_id();
        //echo $this->db->last_query();
        $org_id = $this->session->userdata('org_id');

        $this->add_department_domain($domains,$dept_id);
        return $dept_id;
    }

    public function add_department_domain($domains,$dept_id)
    {
        foreach ($domains as $key => $value) {
            
            $this->db->insert('department_domain', array('dept_id' => $dept_id, 'domain_id' => $value));
           // echo $this->db->last_query();
        }
    }
    public function check_department_origin($dept_id){
        $this->db->select('d.org_id')
                ->from('department d')
                ->where('dept_id',$dept_id);
        $res = $this->db->get()->row();
        return $res->org_id;
    }
    
    public function del_department_domain($domain_del,$dept_id)
    {
        $this->db->where_in('domain_id', $domain_del);
        $this->db->where_in('dept_id', $dept_id);
        $this->db->delete('department_domain');
    }
    
    public function department_update($data,$dept_id)
    {
        
        $this->db->where('dept_id',$dept_id);
        $this->db->update('department',$data);
        return true;
    }
    
    public function check_department_delete($dept_id)
    {
        $org_id =$this->session->userdata('org_id');
        $this->db->select('count(*) as totalCnt');
        $this->db->from('category_department as cd');
        $this->db->join('department d','d.dept_id = cd.dept_id');
        $this->db->where('d.uuid ="' . $dept_id.'"');
        $this->db->where('d.org_id',$org_id);
        $query = $this->db->get();
        // your ActiveRecord query that will return a col called 'sum'
        return $query->row('totalCnt');
    }
    
    
    public function check_org_dept_default($org_id)
    {
        $whereCnd = "`org_id`='$org_id' and `default`='1'";
        $this->db->select('count(*) as totalCnt');
        $this->db->from('department');
        $this->db->where($whereCnd);
        $query = $this->db->get();
        return $query->row('totalCnt');
    }
    
    
    public function department_delete($dept_id) {

        /*$this->db->where('dept_id', $dept_id);
        $this->db->delete('department');*/
        $this->db->set('status','0');
        $this->db->where('dept_id', $dept_id);
        $this->db->update('department');
        
    }
    
    
    public function department_org_notin($dept_not_in,$org_id)
    {
        $data = array('org_dept_not_in'=>$dept_not_in);
        $this->db->where('id',$org_id);
        $this->db->update('organization',$data);
        return true;
    }
    
    public function check_department_exists($uuid){
        $this->db->select('dept_id')->from('department')->where('uuid',$uuid);
        $dept_id = $this->db->get()->row('dept_id');
        if($dept_id){
            return $dept_id;
        }
        else{
            return false;
        }
    }

    /* Country Models */

    public function getcountrylist() {

        $this->db->select('co.loc_id, co.country_name, co.created_at, co.updated_at, co.default,co.status');
        $this->db->from('location co');
        $this->db->where('co.status', '1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }
    }

    /*

      Function : department_list
      Params : -
      Returns : department list as array
      Description: Function returns list of department details as array

     */

    public function department_list($org_id,$dept_not_in="''",$orgdomain_in="''",$system_default=0) {

        if($system_default==0)
        {
            $systemCnd = "  and d.default=1";
        }
        else
        {
            $systemCnd = "";
        }

        if($org_id!=1)
        {           
            if($orgdomain_in != '' && $orgdomain_in != "''"){
                if(strpos($orgdomain_in,',') !==  FALSE){
                    $pos = 1;
                    $orgdomain_in = substr($orgdomain_in,$pos);
                }
            }
    $whereCnd  = "((d.`org_id`= '$org_id') or (d.org_id='1' and d.status='1' $systemCnd)) and (d.dept_id NOT IN ($dept_not_in) and dom.domain_id IN (".$orgdomain_in.")) and d.status = 1";
           
        }
        else
        {
            $whereCnd  = "d.`org_id`= '$org_id' and d.status = 1";
        }
        
        $this->db->select('d.*,group_concat(DISTINCT dom.domain_name) as domains,group_concat(DISTINCT l.country_name) as countrys', FALSE);
        $this->db->from('`department` as d');
        $this->db->join('department_domain dd', 'dd.dept_id=d.dept_id','left');
        $this->db->join('domain_country dc', 'dc.domain_id=dd.domain_id','left');
        $this->db->join('domain dom', 'dom.domain_id=dc.domain_id','left');
        $this->db->join('location l', 'l.loc_id=dc.country_id','left');
        $this->db->where($whereCnd);
        $this->db->group_by('d.dept_id');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $result_dept = $query->result_array();
            return $result_dept;
        } else {
            return false;
        }
    }

    public function dept_list($org_id = 0) {
        $query = 'select de.dept_id,de.dept_name from department as de where de.status = "1" and  de.org_id = '.$org_id;
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            $result_dept = $res->result_array();
            return $result_dept;
        } else {
            return false;
        }
    }

    /*

      Function : get_department_info
      Params : department id
      Returns : single department details array
      Description: Function pass dept id as params and returns details for
      the department

     */

    public function get_department_info($dept_id, $org_id) {
        $this->db->select('de.dept_id,de.dept_name,de.dept_desc,de.default,de.status');
        $this->db->from('department de');
        //$this->db->join('tbl_department_mapping de_cm','de_cm.dept_id = de.dept_id','left');
        //$this->db->join('tbl_domain_country_mapping do_cm','do_cm.id = de_cm.domain_map_id ','left');
        //$this->db->where('de.status', '1');
        $this->db->where('de.dept_id', $dept_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            $result_department = $query->result_array();
            /* get Country Domain */
            //$department = array('department'=>$result_department);

            /* Returns Domain for the country */

            //$department['domain']=$this->country_domain($result_department[0]['country_id']);

            /* Returns domain_id for the department */

            /* foreach($result_department as $key=>$value){
              $sel[] = $value['domain_id'];
              }
              $department['selected_domain'] = $sel; */
            $dept['department'] = $result_department;

            return $dept;
        } else {
            return false;
        }
    }

    /*

      Function : country_domain
      Params : country id
      Returns : domain details as array
      Description: Function returns the domain info based on the country id

     

    public function country_domain($country_id) {

        $this->db->select('d.domain_id,do.domain_name');
        $this->db->from('tbl_domain_country_mapping d');
        $this->db->join("tbl_domain as do", 'do.domain_id = d.domain_id', 'left');
        $this->db->where('d.country_id =' . $country_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*

      Function : department_country
      Params : department id
      Returns : single country id
      Description: Function used to returns countryid which mapping department and domain
      country table based on department id

     

    public function department_country($dept_id) {

        $this->db->distinct()
                ->select('do_cm.country_id')
                ->from('tbl_department_mapping d')
                ->join('tbl_domain_country_mapping do_cm', 'do_cm.id = d.domain_map_id')
                ->where('d.dept_id = ' . $dept_id);
        $res = $this->db->get();
        return $res->row()->country_id;
    }

    /*

      Function : department_domain
      Params : department id
      Returns : domain id for the department as array
      Description: Function used to returns domain id which mapping department and domain
      country table based on department id

     

    public function department_domain($dept_id) {

        $this->db->select('do_cm.domain_id')
                ->from('tbl_department_mapping d')
                ->join('tbl_domain_country_mapping do_cm', 'do_cm.id = d.domain_map_id')
                ->where('d.dept_id = ' . $dept_id);
        $res = $this->db->get();
        $domain = array();
        foreach ($res->result_array() as $key => $value) {
            $domain[] = $value['domain_id'];
        }
        return $domain;
    }

    /*public function get_org_department($org_id) {

        $this->db->select('d.dept_id,d.dept_name')
                ->from('tbl_department d')
                ->join('tbl_org_department_map odm', 'd.dept_id = odm.dept_id')
                ->join('tbl_org_domain_map tdm', 'odm.domain_map_id = tdm.id')
                ->where('tdm.org_id = ' . $org_id);
        $res = $this->db->get();
        return $res->result_array();
    }*/
    public function get_org_department($org_id) {

        $this->db->select('d.dept_id')
                ->from('department d')
                ->where('d.org_id = ' . $org_id);
        $res = $this->db->get();
        return $res->result_array();
    }

    /*

      Function : domain_country
      Params : domain_id,country_id
      Returns : domain country mapping id
      Description: Function used to return domain country mapping table id based on domain id 			and country id

     */

    public function domain_country($domain_id, $country_id) {

        $do_cu = $this->db->query('Select id from domain_country where domain_id =' . $domain_id . ' and country_id=' . $country_id);
        if ($do_cu->num_rows() > 0) {
            return $do_cu->row()->id;
        } else {
            return false;
        }
    }

    /*

      Function : department_delete
      Params 	 : dept_id
      Returns  : none
      Description: Function used to change status from 0 to 1 to delete department record

    public function getdefaultdepartment() {
        $query = "Select dept_id,dept_name from tbl_department where status = '1' and `default` = '1' ";
        $res = $this->db->query($query)->result();
        if ($res)
            return $res;
        else
            return 0;
    }
 */
    public function check_default_department($map_id) {

        $this->db->select('domain_id');
        $this->db->from('department_domain');
        $this->db->where('id', $map_id);
        $query = $this->db->get();
        $result_domain = $query->row()->domain_id;

        $this->db->select('id');
        $this->db->from('department_domain');
        $this->db->where('default = 1 and domain_id = ' . $result_domain);
        $deptquery = $this->db->get();
        $result_dept = $deptquery->row()->id;

        return $result_dept;
    }

    public function set_default_department($change_id, $default_id) {

        $this->db->set('default', '1');
        $this->db->where('id', $change_id);
        $this->db->update('department_domain');

        if (($default_id != null) || ($change_id == $default_id)) {
            $this->db->set('default', '0');
            $this->db->where('id', $default_id);
            $this->db->update('department_domain');
        }
        return true;
    }
    public function update_user_department($users = array(),$dept_id){
        if(count($users) > 0){
            foreach($users as $key=>$value){   
                $res = $this->db->query('SELECT id from org_user_department where dept_id = '.$dept_id.' and user_id = '.$value);

                if(!isset($res->row()->id)){
                    $role_id = $this->user_roles($value);
                    $this->db->insert('org_user_department',array('user_id'=>$value,'dept_id'=>$dept_id,'role_id'=>$role_id));
                    $org_del_dept[] = $this->db->insert_id();
                }else{
                    $org_del_dept[] = $res->row()->id;
                }

            }
            $org_dept_del = implode(',',$org_del_dept);
            $this->db->where('id NOT IN ('.$org_dept_del.') and dept_id = '.$dept_id);
            $this->db->delete('org_user_department');
        }else{
            $this->db->where('dept_id = '.$dept_id);
            $this->db->delete('org_user_department');
        }
    }
    public function user_department($users,$dept_id){
        $datas = array();
        foreach($users as $key=>$value){
            $role_id = $this->user_roles($value);
            $data = array();
            $data['user_id'] = $value;
            $data['role_id'] = $role_id;
            $data['dept_id'] = $dept_id;
            $datas[] = $data;
        }
        $this->db->insert_batch('org_user_department',$datas);
    }

    public function user_roles($user_id){
        $this->db->select('user_role_id')
                 ->from('users u')
                 ->where('u.id = '.$user_id);
        $res = $this->db->get();
        return $res->row('user_role_id');
    }
    /* 
    public function get_dept_users($org_id, $dept_id) {
        $this->db->select('ou.user_id')
                ->from('tbl_org_users ou')
                ->join('tbl_org_user_department oud', 'ou.id = oud.user_map_id')
                ->where('ou.org_id ', $org_id);
        $user = $this->db->get()->row()->user_id;
        if (isset($user)) {
            return $user;
        } else {
            return false;
        }
    }
    */
    public function get_department_users($dept_id,$org_id) {
        $this->db->select('oud.user_id')
                ->from('org_user_department oud')
                ->where('oud.dept_id = '.$dept_id);
        $user = $this->db->get()->result_array();
        if (isset($user)) {
            return $user;
        } else {
            return false;
        }
    }

    public function get_department_users_list($dept_id,$org_id) {
        $this->db->select('u.id,u.uuid,oud.dept_id,CONCAT_WS(" ",u.firstname,u.lastname) as name')
                ->from('org_user_department oud')
                ->join('users u','u.id = oud.user_id')
                ->where_in('oud.dept_id',$dept_id)
                ->where('u.activation = 1');
                //if($org_id != 1){
                    $this->db->where('u.org_id = '.$org_id);
                //}
        $user = $this->db->get()->result_array();
        if (isset($user)) {
            return $user;
        } else {
            return false;
        }
    }

    public function getDeptInfo($dept_id) {
        $this->db->select('*,dd.domain_id as domain_selected')
                ->from('department d')
                ->join('department_domain dd', 'dd.dept_id=d.dept_id')
                ->join('domain_country dc', 'dc.domain_id=dd.domain_id')
                ->where('d.dept_id', $dept_id)
                ->group_by('dc.domain_id');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

}

?>
