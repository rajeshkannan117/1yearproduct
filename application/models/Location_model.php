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
class Location_model extends CI_Model {

  public function __construct() {
      date_default_timezone_set("America/New_York");
      $this->load->database();
      $this->load->helper('date');
  }
  public function location_list($org_id){
      $this->db->select('ol.id,ol.location_id,ol.location_name,ol.address,ol.city,ol.state,l.country_name,ol.zip_code,ol.status,ol.uuid')
                ->from('org_location ol')
                ->join('location l','l.loc_id = ol.country')
                ->where('ol.org_id',$org_id)
                ->where('ol.status','1');
      $list = $this->db->get()->result_array();
      return $list;
  }

  public function location_insert($data){
        $this->db->insert('org_location',$data);
        $location_id = $this->db->insert_id();
        return $location_id;
  }
  public function location_list_count($org_id){
    $this->db->select('count(*) as location')
             ->from('org_location ol')
             ->where('org_id',$org_id)
             ->where('status','1');
    $total = $this->db->get()->row()->location;
    return $total;
  }
  public function location_details($org_id){
    $this->db->select('l.location_id,CONCAT_WS(" ,",l.location_name,l.state,lo.country_name) as location,o.org_name');
      $this->db->from('org_location l')
              ->join('location lo','lo.loc_id = l.country')
              ->join('organization o','o.id = l.org_id')
              ->where('l.org_id',$org_id);
              //->limit(0, 5);
      $list = $this->db->get()->result_array();
      return $list;
  }
  public function get_location_details($org_id,$loc_id){
    $this->db->select('l.location_id,l.location_name,l.address,l.city,l.zip_code,l.state,lo.country_name as location,o.org_name,lo.loc_id');
    $this->db->from('org_location l')
              ->join('location lo','lo.loc_id = l.country')
              ->join('organization o','o.id = l.org_id')
              ->where('l.org_id = '.$org_id.' and l.id = '.$loc_id);
              //->limit(0, 5);
      $list = $this->db->get()->result_array();
      return $list;
  }
  public function location_user_update($users,$location_id){
    if(count($users > 0)){
      foreach($users as $key=>$value){
        $res = $this->db->query('SELECT id from user_location where user_id = '.$value.' and location_id = '.$location_id);
        if(!isset($res->row()->id)){
          $this->db->insert('user_location',array('user_id'=>$value,'location_id'=>$location_id));
          $del[] = $this->db->insert_id();
        }else{
          $del[] = $res->row()->id;
        }
      }
      $loc_del = implode(',',$del);
      $this->db->where('id NOT IN ('.$loc_del.') and location_id = '.$location_id);
      $this->db->delete('user_location');
    }
  }
  public function location_user_delete($users, $location_id){
    if(count($users) > 0){
      $loc_del = implode(',',$users);
      $this->db->where('id NOT IN ('.$loc_del.') and location_id = '.$location_id);
      $this->db->delete('user_location');
    }
  }
  public function location_update($data,$loc_id){
    $this->db->where('id',$loc_id);
    $this->db->update('org_location',$data);
  }

  public function get_location_users($loc_id)
  {
    $this->db->select('user_id')->from('user_location')->where('location_id',$loc_id);
    $res = $this->db->get();
    $location_users = array();
    foreach($res->result_array() as $key=>$value){
        $location_users[] = $value['user_id'];//$value['location'];      
    }
    return $location_users;
  }

  public function insert_user_location($users,$location_id)
  {
    foreach($users as $key=>$value){
        $this->db->insert('user_location',array('user_id' => $value,'location_id'=>$location_id));  
    }
  }
  public function location_delete($loc_id){
      /*$this->db->where('id',$loc_id);
      $this->db->delete('org_location');
      return true;*/
    $this->db->set('status','0');
    $this->db->where('id',$loc_id);
    $this->db->update('org_location');
    return true;
  }
  public function check_location_branch($loc_id){
      $this->db->select('org_id,headbranch')->from('org_location')->where('id',$loc_id);
      $res = $this->db->get();
      return $res->row();

  }
  public function check_location_exists($uuid){
    $this->db->select('id')->from('org_location')->where('uuid',$uuid);
    $res = $this->db->get();
    $loc_id =  $res->row('id');
    if($loc_id){
        return $loc_id;
    }
    else{
        return false;
    }
  }
}
