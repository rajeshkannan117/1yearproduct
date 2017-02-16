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
		
		$this->db->select('us.id as user_id,us.firstname as name,us.imgname as profilepic,us.email,us.static_role,us.org_id,o.org_name,o.org_logo');
		$this->db->from('users as us');
		$this->db->join('organization as o','us.org_id = o.id');
		$this->db->where('email',trim($data['email']));
		$this->db->where('password',trim(md5($data['password'])));
		$this->db->where('o.status','1');
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
    					    'logged_in'=>true,
    					    'org_logo' => $row[0]['org_logo']
    					);
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
	public function login_email_check($email){
		$this->db->select('*')
				 ->from('users')
				 ->where('email',$email);
		$res = $this->db->get();
		if($res->num_rows() == 0){
			return true;
		}
		else{
			return false;
		}
	}
	public function assign_roles($user_id){
			$result = $this->check_roles($user_id);
			$menu = array();
			foreach($result as $k=>$v)
			{
				$name = trim($v['name']);
				if($v['create'] == 1 || $v['update'] == 1  || $v['read'] == 1  || $v['delete'] == 1 )
				{
					if($v['create'] == 1)
					{
						$menu[$name][]= 'create';
					}
					if($v['read'] == 1)
					{
						$menu[$name][] = 'read';
					}
					if($v['update'] == 1)
					{
						$menu[$name][] = 'update';
					}
					if($v['delete'] == 1)
					{
						$menu[$name][] ='delete';
					}
				}                
			}
			//$post_id = $this->check_user_post($user_id);
			//if( $post_id != 5 ){
				$menu['alerts'][] ='create';
				$menu['alerts'][] ='read';
				$menu['alerts'][] ='update';
				$menu['alerts'][] ='delete';
			// }
			if(is_array($menu['forms'])){
				if(in_array('create', $menu['forms'])){
					//$menu['workflows'][] = 'create';
					//$menu['review'][]='create';
				}
				if(in_array('update', $menu['forms'])){
					//$menu['workflows'][] = 'update';
					//$menu['review'][]='update';
				}
			}
			$profile_pic = $this->get_user_profile_pic($user_id);
			if((!empty($profile_pic)) && file_exists(THUMB_IMAGE_PATH.$profile_pic)){
				$menu['profile'] = $profile_pic;
			}else{
				$menu['profile'] = 'user.png';
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
	public function get_user_profile_pic($user_id){
		$this->db->select('us.imgname as profilepic');
		$this->db->from('users as us');
		$this->db->where('us.id',$user_id);
		$res = $this->db->get()->row();
		return $res->profilepic;
	}
	public function check_user_post($user_id){
		$this->db->select('user_post')->from('users')->where('id',$user_id);
		$res = $this->db->get()->row();
		if(!empty($res->user_post)){
			return $res->user_post;
		}else{
			return 0;
		}
	}
	public function get_user_details($email){
		$this->db->select('us.id,CONCAT_WS(" ",us.firstname,us.lastname) as name');
		$this->db->from('users as us');
		$this->db->where('us.email = "'.trim($email).'"');
		$res = $this->db->get()->row();
		return $res;
	}
	public function get_user_by_id($id){
		$this->db->select('us.id,CONCAT_WS(" ",us.firstname,us.lastname) as name,email');
		$this->db->from('users as us');
		$this->db->where('us.id = "'.trim($id).'"');
		$res = $this->db->get()->row();
		return $res;
	}
	public function email_check($email){
		$this->db->select('email')->from('users')->where('email',$email);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function forgot_pwd($useremail,$activation,$from='',$reset){
		$this->db->select('a.*')
			->from('user_forgot_reset_pwd as a')
		    ->where('a.activation = "'.$activation.'" and a.email = "'.$useremail.'"');
		$result = $this->db->get();
		if($result->num_rows()){
			$this->db->set('active', 0);
			$this->db->set('created_at',gmdate('Y-m-d H:i:s',time()));
			$this->db->set('updated_at',gmdate('Y-m-d H:i:s',time()));
			$this->db->set('reset', base64_encode($reset));
	    	$this->db->where('activation = "'.$activation.'"');
			$this->db->where('email = "'.$useremail.'"');
			$this->db->update('user_forgot_reset_pwd');
		}else{
			$data = array(
				'email' => $useremail,
				'activation' => $activation,
				'created_at' => gmdate('Y-m-d H:i:s',time()),
				'updated_at' => gmdate('Y-m-d H:i:s',time()),
				'active' => 0,
				'call_from' => $from,
				'reset' => base64_encode($reset) 
			);
			$this->db->insert('user_forgot_reset_pwd',$data);
			$id = $this->db->insert_id();
		}
	}
	public function checkpassword_reset($email){
		$this->db->select('f.*')
			->from('user_forgot_reset_pwd as f')
			//->where('f.reset = "'.base64_encode($password).'"')
			->where('f.email = "'.$email.'"');
		$check = $this->db->get();
		if($check->num_rows()){
		     $datas = $check->result_array();
		    if($datas[0]['active'] == 1){
				//$data['msg'] = '1'; // link active set
				//$data['email'] = $datas[0]['email'];
				return 1; 
                }
			else if($datas[0]['active'] == 0){ 
				/* Mailed link is not activated */
				return 2;
			}
			else{
				return 0;
			}
		}else{
			return 0;
		}
		
	}
	public function check_activation_link($link){
		$this->db->select('email,active')->from('user_forgot_reset_pwd')->where('activation = "'.$link.'"');
		$res = $this->db->get()->row();
		if(!empty($res)){
			return $res;
		}else{
			return false;
		}
	}
	public function update_password($id,$password){
		$this->db->set('password',md5($password));
		$this->db->where('id',$id);
		$this->db->update('users');
		$details = $this->get_user_by_id($id);
		$this->update_user_forgot_reset_pwd_table('2',$details->email);
	}
	public function update_user_forgot_reset_pwd_table($active,$email){
		$this->db->set('active',$active);
		$this->db->where('email',$email);
		$this->db->update('user_forgot_reset_pwd');
	}
}
