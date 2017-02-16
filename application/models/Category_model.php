<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * This is Category Model for FORMPRO
 *
 * @package	CodeIgniter
 * @category	Category
 * @author	Rajeshkannan.C
 * @link	http://innoppl.com/
 *
 */
class Category_model extends CI_Model {

    public function __construct() {
        date_default_timezone_set("America/New_York");
        $this->load->database();
        $this->load->helper('date');
    }

    /* Category Models */

    /*public function category_list($parent = 0, $spacing = '', $user_tree_array = '') {
      if (!is_array($user_tree_array))
        $user_tree_array = array();
        $this->db->select('c.cat_id,c.category_name,c.parent,c.status');
        $this->db->from('category c');
        $this->db->where('1 AND c.parent = ' . $parent);
        //$this->db->group_by('c.cat_id');
        $this->db->order_by('c.cat_id', 'ASC');

        $query = $this->db->get();
        //print_r($this->db); exit;

        if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
              $user_tree_array[] = array("cat_id" => $row->cat_id, "parent" => $row->parent, "category_name" => $spacing . $row->category_name, "status" => $row->status);

              $user_tree_array = $this->category_list($row->cat_id, $spacing . '--', $user_tree_array);
          }
        }
        return $user_tree_array;
    }*/

    public function category_lists($org_id,$cat_not_in,$org_domain_ids="''",$system_default=0) {
        
        if($org_id!=1)
        {
            $whereCnd  = "((c.`org_id`= '$org_id') or (c.org_id='1' and c.status='1')) and (c.cat_id NOT IN ($cat_not_in)) and dom.domain_id IN ($org_domain_ids) and c.status = 1";
        }
        else
        {
            $whereCnd  = "c.`org_id`= '$org_id' and c.status = 1";
        }
        
        
        $sql = "SELECT c.*,group_concat(DISTINCT d.dept_name) as dept_name ,group_concat(DISTINCT dom.domain_name) as domain_name ,group_concat(DISTINCT l.country_name) country_name

                        FROM `category` as c 

                        left join category_department as cd ON cd.cat_id=c.cat_id

                        left join department as d ON d.dept_id = cd.dept_id

                        left join department_domain as dd2 ON dd2.dept_id = d.dept_id

                        left join domain as dom ON dom.domain_id=dd2.domain_id

                        left join domain_country as dc ON dc.domain_id=dom.domain_id

                        left join location as l ON l.loc_id=dc.country_id

                        WHERE $whereCnd group by c.cat_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function check_category_exists($uuid){
      $this->db->select('cat_id')->from('category')->where('uuid',$uuid);
      $cat_id = $this->db->get()->row('cat_id');
      if($cat_id){
        return $cat_id;
      }
      else{
        return false;
      }
    }

    /*

      Function category_add

      params: category form data

      Returns true or false

     */

    public function category_add($data, $department) {
        $data['data']['created_at'] = gmdate(date("Y-m-d H:i:s"));
        $data['data']['updated_at'] = gmdate(date("Y-m-d H:i:s"));
        $this->db->insert('category', $data['data']);
        $category_id = $this->db->insert_id();
        //echo $this->db->last_query();
        $cat_id[]= $category_id;
        $this->add_category_depart($department, $category_id);
        return $category_id;
    }

    public function category_update($data, $cate_id) {
        $this->db->where('cat_id', $cate_id);
        $this->db->update('category', $data);
    }

    public function add_category_depart($department, $category_id) {
        foreach ($department as $key => $value) {
            $this->db->insert('category_department', array('cat_id' => $category_id, 'dept_id' => $value));
//                echo $this->db->last_query();
        }
    }

    public function del_category_depart($domain_del, $dept_id) {
        foreach ($domain_del as $key => $value) {
            $this->db->where('dept_id', $value);
            $this->db->where('cat_id', $dept_id);
            $this->db->delete('category_department');
            //echo $this->db->last_query();
        }
        //echo $this->db->last_query();
    }

    public function get_category_domain($category_id) {
        $this->db->select('group_concat(DISTINCT dd.domain_id) as domian_cate');
        $this->db->from('category_department cd');
        $this->db->join("department_domain as dd", 'dd.dept_id=cd.dept_id', 'left');
        $this->db->where('cd.cat_id', $category_id);
        $result = $this->db->get(); //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_category_info($category_id) {
        $this->db->select('');
        $this->db->from('category');
        $this->db->where('cat_id', $category_id);
        $query = $this->db->get();
        $ret = $query->row();
        return $ret;
    }

    public function get_cate_depart($category_id) {
        $this->db->select('group_concat(`dept_id`) as dept');
        $this->db->from('category_department');
        $this->db->where('cat_id', $category_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    
    public function department_def_list($org_id,$dept_not_in)
    {
        $sql="SELECT * FROM `department` WHERE (`org_id`=$org_id or (`org_id`=1 and `default`=1)) and `dept_id` NOT IN ('$dept_not_in')";
        
        $query = $this->db->query($sql);
//echo $this->db->last_query();
        return $query->result_array();
        
    }
    
    public function get_cate_dept_domain($domain_dept_de)
    {
        $sql="SELECT group_concat(DISTINCT `domain_id`) as domain_ids FROM `department_domain` WHERE `dept_id` IN ($domain_dept_de)";
        
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        $ret = $query->row('domain_ids');
        
        return $ret;
    }
    
    public function category_form_list($cat_id,$org_id){
        $this->db->select('fd.uuid,fd.form_name,fc.cat_id')
                 ->from('form_category fc')
                 ->join('form_details fd','fd.form_id = fc.form_id','left')
                 ->where_in('fc.cat_id',$cat_id)
                 ->where('fd.status = "1"');
        if($org_id != 1){
          $this->db->where('fd.org_id',$org_id);
        }         
        $res = $this->db->get();
        return $res->result_array();
    }
    public function category_department_list($cat_id,$org_id){
        $this->db->select('d.uuid,d.dept_name,cd.cat_id')
                 ->from('category_department cd')
                 ->join('department d','d.dept_id = cd.dept_id','left')
                 ->where_in('cd.cat_id',$cat_id)
                 ->where('d.status = "1"');
        if($org_id != 1){
          $this->db->where('d.org_id',$org_id);
        }         
        $res = $this->db->get();
        return $res->result_array();
    }

    /*
      Function category_delete

      Params: category_id

      Returns true

     */

    public function category_delete($cat_id) {
      /*$this->db->where('cat_id', $cat_id);
      $this->db->delete('category');*/
      $this->db->set('status','0');
      $this->db->where('cat_id',$cat_id);
      $this->db->update('category');
      return true;
    }

    public function category_org_notin($cat_not_in,$org_id)
    {
        $data = array('org_cat_not_in'=>$cat_not_in);
        $this->db->where('id',$org_id);
        $this->db->update('organization',$data);
        return true;
    }
    
    public function check_category_form($uuid) {
        $cat_id = $this->check_category_exists($uuid);
        $org_id = $this->session->userdata('org_id');
        $this->db->select('count(*) as totalCnt');
        $this->db->from('form_category fc');
        $this->db->join('form_details fd','fd.form_id = fc.form_id');
        $this->db->where('fd.org_id',$org_id);
        $this->db->where('fc.cat_id =' . $cat_id);
        $query = $this->db->get(); // your ActiveRecord query that will return a col called 'sum'
        return $query->row('totalCnt');
    }

}
