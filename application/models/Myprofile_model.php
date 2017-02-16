<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * This is My Profile Model of Formpro
 *
 * @package	CodeIgniter
 * @category	My Profile
 * @author	Amitha.K
 * @link	http://innoppl.com/
 *
 */
class Myprofile_model extends CI_Model
{
	public function __construct()
	{
		date_default_timezone_set ("America/New_York");
		$this->load->database();
		$this->load->helper('date');
	}
	
	/*

		Function : user_details
		Params : user id
		Returns : user details
		Description: Function retrieves user data from tbl_user and tbl_org_user

	*/

	public function user_details($user_id){

		
		$this->db->select('US.firstname, US.lastname, US.id, US.email, US.phone, US.imgname, O.id as org_id,O.org_name,l.country_name,d.domain_name,oud.dept_id,oud.role_id');
		$this->db->from ('users US');
		$this->db->join('organization O','US.org_id = O.id','left');
		$this->db->join('org_location OL','O.id = OL.org_id','left');
		$this->db->join('org_domain od','OL.id = od.org_location_id','left');
		$this->db->join('domain d','od.domain_id=d.domain_id','left');
		$this->db->join('location l','OL.country = l.loc_id','left');
		$this->db->join('org_user_department oud','US.id = oud.user_id ','left');		
		$this->db->where('US.id', $user_id);
		$this->db->group_by('US.id');
		$query = $this->db->get();
				
		if ($query->num_rows () > 0) {

			$result_user = $query->result_array();
			
			$user = array('user'=>$result_user);

			/*if($role==0){

				$this->db->select('o.org_name,dm.domain_name,l.country_name');
				$this->db->from ('tbl_org_users ous');
				$this->db->join('tbl_organization o','ous.org_id = o.id','left');
				$this->db->join('tbl_org_location ol','ol.org_id = o.id','left');
				$this->db->join('tbl_location l','l.loc_id = ol.country');
				$this->db->join('tbl_org_domain_map odm','ous.org_id = odm.org_id','left');
				//$this->db->join('tbl_org_department_map ode','odm.id = ode.domain_map_id ','left');
				$this->db->join('tbl_domain dm','odm.domain_id = dm.domain_id ','left');
				//$this->db->join('tbl_department de','ode.dept_id = de.dept_id ','left');
				$this->db->where('ous.user_id',$user_id);
				$orgquery = $this->db->get();
				//print_r($this->db); exit;
				$result_org = $orgquery->result_array();
			
				$user['org']=$result_org;
				
			}
			else{
				$user['org']=0;
			}*/

			return $user;
		}
	}


	public function user_update($post)
	{

		$user_detail = array('firstname' => $post['data']['firstname'],'lastname' => $post['data']['lastname'], 'email' => $post['data']['usr_email'], 'phone' => $post['data']['usr_phone'], 'imgname' => $post['image']);

		$this->db->where('id', $post['data']['user_id']);
		$this->db->update('users', $user_detail);

		return true;
	}
}
?>