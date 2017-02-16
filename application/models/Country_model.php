<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * This is Country Model for FORMPRO
 *
 * @package	CodeIgniter
 * @category	Country
 * @author	Rajeshkannan.C
 * @link	http://innoppl.com/
 *
 */
class Country_model extends CI_Model
{
	public function __construct()
	{
		date_default_timezone_set ("America/New_York");
		$this->load->database();
		$this->load->helper('date');
	}

	public function country_add($posts){
		
		$post = $posts['data'];
		
		$country = array(
				'country_name'=>trim($post['country_name']),
				'default'=> '0',
				'status'=>'1',
				'created_at'=>date("Y-m-d H:i:s"),
				'updated_at'=>date("Y-m-d H:i:s"),
				'created_by'=>$post['created_by']
				);
		$this->db->insert('location',$country);
		$loc_id = $this->db->insert_id();
		//print_r($country); exit;
		return true;
	}

	public function check_default($table,$primary)
	{

		$this->db->select($primary)
				->from($table)
				->where('default','1');

		$res = $this->db->get();
		if($res->num_rows() > 0){
			return $res->row()->$primary;
	    }else{
	    	return 0;
	    }

	}

	public function country_domain($country_id){

		$this->db->select('do.domain_id,do.domain_name');
		$this->db->from('domain_country d');
		$this->db->join("domain as do",'do.domain_id = d.domain_id','left');	
		$this->db->where('d.country_id ='.$country_id);
		$result = $this->db->get();
		return $result->result_array();

	}

	public function getcountrylist(){

		$this->db->select('co.loc_id, co.country_name,co.created_by,co.created_at, co.updated_at, co.default,co.status');
		$this->db->from ('location co');
		//$this->db->where('co.status','1');
		$query = $this->db->get();
		if ($query->num_rows () > 0) {

			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}

	}
	public function getcountrylist_limit($startValue,$lengthValue){
		$this->db->select('co.loc_id, co.country_name,co.created_by,co.created_at, co.updated_at, co.default,co.status');
		$this->db->from ('location co');
		$this->db->limit($lengthValue,$startValue);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows () > 0) {
			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}		
	}
	public function org_domain_lists($country_id) {
		$sql="SELECT `d`.`domain_id`, `d`.`domain_name`
                FROM `domain_country` `dc`
                LEFT JOIN `domain` `d` ON `d`.`domain_id` = `dc`.`domain_id`
                WHERE `dc`.`country_id` IN ($country_id)";
        $org_domain = $this->db->query($sql)->result_array();
        return $org_domain;
    }

	public function getdefaultcountry(){

		$this->db->select('co.loc_id');
		$this->db->from ('location co');
		$this->db->where('co.status','1');
		$this->db->where('co.default','1');
		$query = $this->db->get();

		//print_r($this->db);
		if ($query->num_rows() > 0) {

			$result = $query->row()->loc_id;
			return $result;

		} else {
			return false;
		}

	}

	public function set_default_country($change_id,$default_id){

		$this->db->set('default','1');
		$this->db->where('loc_id', $change_id);
		$this->db->update('location');

		if(($default_id != null) || ($change_id == $default_id)){
			$this->db->set('default','0');
			$this->db->where('loc_id', $default_id);
			$this->db->update('location');
		}
			return true;

	}
	

	public function country_edit($post){

		//$country_detail = array('country_name' => $post['country_name'], 'default' => $post['default'], 'updated_at' => date("Y-m-d H:i:s"));
		if(isset($post['default'])){
			$this->db->set('default',$post['default']);
		}
		if(isset($post['status'])){
			$this->db->set('status',$post['status']);
		}
		$this->db->set('country_name',$post['country_name']);
		$this->db->set('updated_at' , date("Y-m-d H:i:s"));
		$this->db->where('loc_id', $post['loc_id']);
		$this->db->update('location');

		return true;

	}

	public function get_country_info($loc_id){

		$this->db->select('co.country_name,co.loc_id,co.default,co.status,co.created_by');
		$this->db->from ('location co');
		$this->db->where('co.loc_id', $loc_id);
		$query = $this->db->get();
		if ($query->num_rows () > 0) {
			$result_country = $query->result_array();
			return array('country'=>$result_country['0']);
		} else {
			return false;
		}
	}

	public function country_delete($data)
	{

		$this->db->where('loc_id', $data['loc_id']);
		$this->db->delete('location');
		/*$this->db->set('status','0');
		$this->db->where('loc_id', $data['loc_id']);
		$this->db->update('location');*/

	}
	public function defaultcountrydetails(){
		$this->db->select('co.loc_id,co.country_name');
		$this->db->from ('location co');
		$this->db->where('co.status','1');
		$this->db->where('co.default','1');
		$query = $this->db->get();
		//print_r($this->db);
		if ($query->num_rows () > 0) {

			$result = $query->row()->country_name;
			return $result;

		} else {
			return false;
		}
	}
        

        
}

