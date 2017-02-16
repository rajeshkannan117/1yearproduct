<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * This is Login Model for FORMPRO
 *
 * @package	CodeIgniter
 * @category	Login
 * @author	Amitha.K
 * @link	http://innoppl.com/
 *
 */
class Login_model extends CI_Model
{
	public function __construct()
	{
		date_default_timezone_set ("America/New_York");
		$this->load->database();
		$this->load->helper('date');
	}
	

	public function check_login($data)
	{
		
		$this->db->select('us.id as user_id,us.firstname as name,us.imgname as profilepic,us.email,us.static_role,us.org_id,o.org_name');
		$this->db->from('users as us');
		$this->db->join('organization as o','us.org_id = o.id');
		$this->db->where('email',trim($data['email']));
		$this->db->where('password',trim(md5($data['password'])));
		$query = $this->db->get ();
		
			
		if ($query->num_rows () > 0) {

			$row = $query->result_array();
			$user_id = $row[0]['user_id'];

			
			$static_role = $row[0]['static_role'];
			if($static_role === 1)
			{
				$org_id = $row[0]['org_id'];
			}
			else
			{
				$org_id = $row[0]['org_id'];
			}
			$user_details=array('user_id'=> $row[0]['user_id'],
    					    'name'=>$row[0]['name'], 
    					    'email'=>$row[0]['email'],
					    'org_id' => $org_id,
					    'org_name' => $row[0]['org_name'],
    					    'profilepic'=>$row[0]['profilepic'],
					    'static_role' => $row[0]['static_role'],
    					    'logged_in'=>true);
			//print_r($user_details); exit;
			//$menu = $this->assign_roles($user_id);
			//echo '<pre>';
			//print_r($menu);exit;
			//$user_details['menu'] = $menu;
			
			$this->db->set('lastvisitDate',gmdate(date("Y-m-d H:i:s")));
			$this->db->where('id = '.$row[0]['user_id']);
			$this->db->update('users');
			return $user_details;

		} else {

			return false;
		}
	}
	public function assign_roles($user_id){
		
				$result = $this->check_roles($user_id);
				
				$menu = array();

				foreach($result as $k=>$v)
				{

					if($v['create'] == 1 || $v['update'] == 1  || $v['read'] == 1  || $v['delete'] == 1 )
					{
						if($v['create'] == 1)
						{
							$menu[$v['name']][]= 'create';
						}
						if($v['read'] == 1)
						{
							$menu[$v['name']][] = 'read';
						}
						if($v['update'] == 1)
						{
							$menu[$v['name']][] = 'update';
						}
						if($v['delete'] == 1)
						{
							$menu[$v['name']][] ='delete';
						}
                                                
					}
                                        
				
				}
			return $menu;
	}

	public function check_roles($user_id)
	{
		
		$this->db->select('rp.*,rct.name');
		$this->db->from ('users us');
		$this->db->join('roles_permissions as rp','us.user_role_id = rp.role_id');
		$this->db->join('roles_category_type rct','rp.roles_category_type_id = rct.roles_category_type_id');	
		$this->db->where('us.id',$user_id);
		
		
		$query1 = $this->db->get();
		//print_r($this->db); exit;
		if ($query1->num_rows () > 0) {

		$result = $query1->result_array();
		
		} else {
			$result = array();
		}
		return $result;

	}

}
