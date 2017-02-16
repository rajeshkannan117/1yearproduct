<?php
require_once('User_model.php');
class Userv2_model extends User_model{

	public function get_user_location($user_id,$org_id)
	{

		$this->db->select('CONCAT_WS(" ",ol.location_name,ol.city,ol.state) as location_name,ol.id as location_id')
				 ->from('org_location ol')
				 ->join('user_location u','u.location_id = ol.id and u.user_id = '.$user_id)
				 ->where('ol.org_id = '.$org_id);
		$res = $this->db->get();
		$return = $res->result_array();
		return $return;
	}
}

 ?>