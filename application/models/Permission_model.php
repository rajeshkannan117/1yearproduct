<?php
/**
 *
 * This is Permission model of Formpro
 * @package	    CodeIgniter
 * @category	Model
 * @author	    Rajeshkannan.C
 * @link	    http://innoppl.com/
 *
 */
class Permission_model extends CI_Model {

	public function __construct()
	{
		date_default_timezone_set('America/New_York');
		$this->load->database();
	}

	public function permission_add($details){

		 $permission   = array(
                    'permission_name' =>  $details['permission_name'],
                    'permission_desc' => $details['permission_desc'],
		            'status' =>$details['status'],
		            'created_at'=>date("Y-m-d H:i:s"),
					'updated_at'=>date("Y-m-d H:i:s"),
					'created_by'=>$details['created_by']
                );
		$this->db->insert('tbl_permission',$permission);
		$permission_id = $this->db->insert_id();
		return true;
	}

	public function permission_update($details){

		 $permission   = array(
                    'permission_name' =>  $details['permission_name'],
                    'permission_desc' => $details['permission_desc'],
		            'status' =>$details['status'],
					'updated_at'=>date("Y-m-d H:i:s")
            );
		$this->db->where('permission_id', $details['permission_id']);
		$this->db->update('tbl_permission',$permission);

		return true;

	}

	public function permission_delete($permission_id){

		$this->db->set('status','0');
		$this->db->where('permission_id', $permission_id);
		$this->db->update('tbl_permission');

	}

	public function permission_info($permission_id){

		$this->db->select('permission_name,permission_desc,status,permission_id')
				->from('tbl_permission')
				->where('permission_id',$permission_id);
		$result= $this->db->get();
		return $result->row();

	}
	public function list_permission($status = 0){

		$this->db->select('permission_name,permission_desc,status,permission_id')
				->from('tbl_permission');
		if($status){
			$this->db->where('status','1');
		}
		$result= $this->db->get();
		return $result->result_array();
		
	}
	
}