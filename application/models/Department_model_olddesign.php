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
        $department = array('dept_name' => trim($post['dept_name']),
            'dept_desc' => trim($post['dept_desc']),
            'default' => $post['default'],
            'status' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'created_by' => $post['created_by'],
            'default' => $post['default'],
            'org_id' => $post['org_id']
        );
        $this->db->insert('department', $department);
        $dept_id = $this->db->insert_id();
        //echo $this->db->last_query();
        $org_id = $this->session->userdata('org_id');

        $this->add_department_domain($domains,$dept_id);
    }

    public function add_department_domain($domains,$dept_id)
    {
        foreach ($domains as $key => $value) {
            
            $this->db->insert('department_domain', array('dept_id' => $dept_id, 'domain_id' => $value));
           // echo $this->db->last_query();
        }
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
        $this->db->select('count(*) as totalCnt');
        $this->db->from('category_department');
        $this->db->where('dept_id =' . $dept_id);
        $query = $this->db->get(); // your ActiveRecord query that will return a col called 'sum'
        return $query->row('totalCnt');
    }
    
    
    public function check_org_dept_default($org_id)
    {
        $whereCnd = "`org_id`='$org_id' and `default`='1'";
        $this->db->select('count(*) as totalCnt');
        $this->db->from('department');
        $this->db->where($whereCnd);
        $query = $this->db->get(); // your ActiveRecord query that will return a col called 'sum'
        return $query->row('totalCnt');
    }
    
    
    public function department_delete($dept_id) {

        $this->db->where('dept_id', $dept_id);
        $this->db->delete('department');
        return true;
    }
    
    
    public function department_org_notin($dept_not_in,$org_id)
    {
        $data = array('org_dept_not_in'=>$dept_not_in);
        $this->db->where('id',$org_id);
        $this->db->update('organization',$data);
        return true;
    }
    /*

      Function : department_list
      Params : -
      Returns : department list as array
      Description: Function returns list of department details as array

     */

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

            
            $whereCnd  = "((d.`org_id`= '$org_id') or (d.org_id='1' and d.status='1'$systemCnd)) and (d.dept_id NOT IN ($dept_not_in) and dom.domain_id IN ($orgdomain_in))";
           
        }
        else
        {
            $whereCnd  = "d.`org_id`= '$org_id'";
        }
        
        $this->db->select('d.*,group_concat(DISTINCT dom.domain_name) as domains,group_concat(DISTINCT l.country_name) as countrys', FALSE);
        $this->db->from('`department` as d');
        $this->db->join('department_domain dd', 'dd.dept_id=d.dept_id','left');
        $this->db->join('domain_country dc', 'dc.domain_id=dd.domain_id','left');
        $this->db->join('domain dom', 'dom.domain_id=dc.domain_id','left');
        $this->db->join('location l', 'l.loc_id=dc.country_id','left');
        $this->db->where($whereCnd);
        $this->db->group_by('d.`dept_id`');
        $query = $this->db->get();
       // echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            $result_dept = $query->result_array();
            return $result_dept;
        } else {
            return false;
        }
    }

    public function dept_list($org_id = 0) {

        $this->db->select('de.dept_id,de.dept_name');
        $this->db->from('tbl_department de');
        if ($org_id) {
            $this->db->join('tbl_org_department_map dc_ma', 'dc_ma.dept_id = de.dept_id');
            $this->db->join('tbl_org_domain_map dm_ma', 'dm_ma.id = dc_ma.domain_map_id and dm_ma.org_id = ' . $org_id);
        }
        $this->db->where('de.status', '1');
        $query = $this->db->get();
        //print_r($this->db);exit;
        if ($query->num_rows() > 0) {
            $result_dept = $query->result_array();
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

     */

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

     */

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

     */

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

    public function get_org_department($org_id) {

        $this->db->select('d.dept_id,d.dept_name')
                ->from('tbl_department d')
                ->join('tbl_org_department_map odm', 'd.dept_id = odm.dept_id')
                ->join('tbl_org_domain_map tdm', 'odm.domain_map_id = tdm.id')
                ->where('tdm.org_id = ' . $org_id);
        $res = $this->db->get();

        /* $dept = array();
          foreach($res->result_array() as $key=>$value){
          $dept[] = $value['dept_id'];
          } */
        return $res->result_array();
    }

    /*

      Function : department_update
      Params : department form data,current department country and domains
      Returns : true
      Description: Function used to update department details based on department id
      and update department mapping table

     */

//    public function department_update($posts, $countries, $domain) {
//
//        $post = $posts['data'];
//        if (isset($post['default'])) {
//            $this->db->set('default', $post['default']);
//        }
//        if (isset($post['status'])) {
//            $this->db->set('status', $post['status']);
//        }
//
//        /* Update Department Table */
//
//        $this->db->set('dept_name', $post['dept_name']);
//        $this->db->set('dept_desc', $post['dept_desc']);
//        $this->db->set('updated_at', date("Y-m-d H:i:s"));
//        $this->db->where('dept_id', $post['dept_id']);
//        $this->db->update('tbl_department');
//
//        $this->db->query("delete from tbl_department_mapping where dept_id = " . $post['dept_id']);
//        foreach ($post['domain'] as $key => $value) {
//            /* Check domain Already have country */
//            if (!$this->domain_country($value, $post['countries'])) {
//                $this->db->insert('tbl_domain_country_mapping', array('domain_id' => $value, 'country_id' => $post['countries']));
//                $domain_map_id = $this->db->insert_id();
//            } else {
//                $domain_map_id = $this->domain_country($value, $post['countries']);
//            }
//            $this->db->insert('tbl_department_mapping', array('dept_id' => $post['dept_id'], 'domain_map_id' => $domain_map_id));
//        }
//
//        return true;
//    }

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

     */


    public function getdefaultdepartment() {
        $query = "Select dept_id,dept_name from tbl_department where status = '1' and `default` = '1' ";
        $res = $this->db->query($query)->result();
        if ($res)
            return $res;
        else
            return 0;
    }

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
