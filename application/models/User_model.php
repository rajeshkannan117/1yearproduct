<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * This is Version1 Model of Vanderlande Webservice
 *
 * @package	CodeIgniter
 * @category	User
 * @author	Rajesh
 * @link	http://innoppl.com/
 *
 */
class User_model extends CI_Model
{
	public function __construct()
	{
		date_default_timezone_set ("America/New_York");
		$this->load->database();
		$this->load->helper('date');
	}

    public function user_update($post) 
	{ 

		if(count($post['location']) > 0){
			foreach($post['location'] as $key=>$value){
				$res = $this->db->query('SELECT id from user_location where user_id = '.$post['user_id'].' and location_id = '.$value);
				if(!isset($res->row()->id)){
					$this->db->insert('user_location',array('user_id'=>$post['user_id'],'location_id'=>$value));
					$del[] = $this->db->insert_id();
				}else{
					$del[] = $res->row()->id;
				}
			}
			$loc_del = implode(',',$del);
			$this->db->where('id NOT IN ('.$loc_del.') and user_id = '.$post['user_id']);
			$this->db->delete('user_location');
		}
		if(count($post['department']) > 0){
			foreach($post['department'] as $key=>$value){	
				$res = $this->db->query('SELECT id from org_user_department where user_id = '.$post['user_id'].' and dept_id = '.$value);

				//$user_dept_id = ;
				if(!isset($res->row()->id)){
					$this->db->insert('org_user_department',array('user_id'=>$post['user_id'],'dept_id'=>$value,'role_id'=>$post['role']));
					$org_del_dept[] = $this->db->insert_id();
				}else{
					$org_del_dept[] = $res->row()->id;
				}
			}
			$org_dept_del = implode(',',$org_del_dept);
			$this->db->where('id NOT IN ('.$org_dept_del.') and user_id = '.$post['user_id']);
			$this->db->delete('org_user_department');
		}
		$phone = $post['phone'];//str_replace(array('(',')','-',''), array('','','',''), $post['phone']);
		$user_detail = array('firstname' => $post['firstname'],'lastname' => $post['lastname'], 'email' => $post['email'], 'phone' => trim($phone),'user_post'=>$post['user_post_id'],'user_role_id'=>$post['role']);
		$this->db->where('id', $post['user_id']); 
		$this->db->update('users', $user_detail); 
		//echo $this->db->last_query(); exit;
		return true; 
	}
	public function get_user_department($user_id){
		$this->db->select('oud.dept_id,de.dept_name')
				->from('org_user_department oud')
				->join('department de','de.dept_id = oud.dept_id','left')
				->where('user_id',$user_id)
				->where('de.status','1');
		$res = $this->db->get()->result_array();
		return $res;
	}
	public function get_device_token($user_id){
        $this->db->select('token')->from('device_token')->where('user_id',$user_id);
        $res= $this->db->get();

        return $res->result_array();
    }
     public function user_device_token($user_id){
     	$notification = array();
        $user_token = $this->user_model->get_device_token($user_id);
        foreach($user_token as $key=>$value){
            $Token = $value["token"];
            $TokenLength = strlen($Token);
            if($TokenLength>100){
                $deviceType = 'android';
                $notification['android'][]=$Token;
            }else{
                $deviceType = 'ios';
                $notification['ios'][]=$Token;
            }
        }

        return $notification;
    }
	public function get_org_users($org_id)
	{	
		$where = '';
		$this->db->distinct();
		$this->db->select('us.id,CONCAT_WS(" ",us.firstname,us.lastname) as name, o.org_name,o.id as org_id,us.activation');
		$this->db->from ('users us');
		$this->db->join('organization o','o.id = us.org_id');
	    $where = ' and us.org_id='.$org_id;
		$this->db->where('us.activation = 1 '.$where);
		$query = $this->db->get();
		if ($query->num_rows () > 0){
			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}
	}
	public function review_role_user($role_id,$org_id){
		$role_id[] = 1;
		$role =  implode(",",$role_id);
		$this->db->select('us.id,CONCAT_WS(" ",us.firstname,us.lastname) as name');
		$this->db->from ('users us');
		$this->db->join('organization o','o.id = us.org_id');
	    $where = ' and us.org_id='.$org_id.' and us.user_role_id in ('.$role.')';
		$this->db->where('us.activation = 1 '.$where);
		$query = $this->db->get();		
		if ($query->num_rows () > 0){
			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}
	}
	public function get_users($org_id)
	{	
		$where = '';
		$this->db->distinct();
		$this->db->select('us.id,us.uuid,ul.location_id, us.firstname,us.lastname, o.org_name,o.id as org_id,us.activation,us.created_by,us.email,us.phone,CONCAT_WS(" ",ol.location_name ,ol.address ,ol.city ,ol.state) as location,r.role_name');
		$this->db->join('organization o','o.id = us.org_id');
		$this->db->join('user_location ul','ul.user_id = us.id');
		$this->db->join('org_location ol','ol.id = ul.location_id');
		$this->db->join('roles r','r.role_id = us.user_role_id');
		$this->db->from ('users us');
	    //if($org_id == 1){
		  //$where = '';
	    //}else{
	    	$where = ' and us.org_id='.$org_id;
	    //}
		$this->db->where('us.activation = 1 '.$where);
		$this->db->where('r.status = "1"');
		$query = $this->db->get();
		if ($query->num_rows () > 0){
			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}
	}	
	public function organization_user_count($org_id){
		$this->db->select('count(*) as users')
				->from('users u');
		$this->db->where('u.org_id',$org_id);
		//$this->db->where('u.activation','1');		
		$count = $this->db->get()->row()->users;
		return $count;
	}
	public function organization_user_counts($org_id){
		$this->db->select('count(*) as users')
				->from('users u');
		if($org_id != 1){
			$this->db->where('u.org_id',$org_id);		
		}
		$this->db->where('u.activation','1');
		$count = $this->db->get()->row()->users;
		return $count;
	}
	public function user_post(){
		$res = $this->db->select('up.*')->from('users_post up')->get()->result_array();
		return $res;
	}
	public function get_users_location_details($loc_id){
		$loc = implode(',',$loc_id);
		$this->db->select('ol.id,CONCAT_WS(" ",ol.location_name ,ol.state) as location')
				->from('org_location ol')
				->where_in('ol.id',$loc);
		$res = $this->db->get();
		$location = array();
		foreach($res->result_array() as $key=>$value){
				$location[] = $value['location'];//$value['location'];			
		}
		return $location;
	}
	public function get_form_users($user,$org_id){
		$this->db->select('uf.user_id,f.uuid,f.form_id,f.form_name')
				 ->from('user_form uf')
				 ->join('form_details f','uf.form_id = f.form_id')
				 ->where_in('uf.user_id',$user)
				 ->where('f.status = "1"');
		$res = $this->db->get();
		return $res->result_array();
	}
	public function get_users_location($user_id,$org_id)
	{
		$this->db->select('ol.id,CONCAT_WS(" ",ol.location_name ,ol.state) as location')
				->from('org_location ol')
				->JOIN('user_location ul','ul.user_id = '.$user_id.' and ol.id = ul.location_id')
				->where('ol.org_id = '.$org_id);
		$res = $this->db->get();
		$location = array();
		foreach($res->result_array() as $key=>$value){
				$location[] = $value['id'];//$value['location'];			
		}
		return $location;
	}
	public function get_users_location_name($user_id,$org_id)
	{
		$this->db->select('ol.id,CONCAT_WS(" ",ol.location_name,ol.state) as location')
				->from('org_location ol')
				->JOIN('user_location ul','ul.user_id = '.$user_id.' and ol.id = ul.location_id')
				->where('ol.org_id = '.$org_id);
		$res = $this->db->get();
		$location = array();
		foreach($res->result_array() as $key=>$value){
				$location[] = $value['location'];//$value['location'];			
		}
		return $location;
	}
	public function insert_user_location($user_id,$location_id)
	{
		$this->db->insert('user_location',array('user_id' => $user_id,'location_id'=>$location_id));
	}
	public function get_organization_location($org_id)
	{
		$this->db->select('ol.id as location_id,ol.headbranch,CONCAT_WS(" ",ol.location_name,ol.state) as location')
				->from('org_location ol')
				->where('ol.org_id = '.$org_id.' and ol.status = 1');
		$res = $this->db->get();
		return $res->result_array();
	}
	public function get_user_location($user_id,$org_id)
	{

		$this->db->select('CONCAT_WS(" ",ol.location_name,ol.state) as location,ol.id as location_id,u.user_id,ol.uuid')
				->from('user_location u')
				->join('org_location ol','ol.id = u.location_id')
				->where_in('u.user_id',$user_id)
				->where('ol.status = "1"');
        $res = $this->db->get();
		$return = $res->result_array();
		return $return;
	}

	public function get_organizations($data)
	{
		$this->db->select('OR.id, OR.org_name, OR.org_token,OR.status');
		$this->db->from ('organization OR');
		$this->db->where('OR.status = 1');
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {

			$result = $query->result_array();
			return $result;

		} else {
			return false;
		}
	}
	public function get_approve_level_users($user_id,$org_id){
		$id = implode(',',$user_id);
		$this->db->select('u.id,CONCAT_WS(" ",u.firstname,u.lastname) as name')
				->from('users u')
				->where('u.id NOT IN ('.$id.') and u.org_id = '.$org_id);
		$res = $this->db->get()->result_array();
		return $res;
	}
	public function get_user_details($user_id,$org_id){
		$this->db->select('u.id,CONCAT_WS(" ",u.firstname,u.lastname) as name,u.email as email')
				->from('users u')
				->where('u.id = '.$user_id.' and u.org_id = '.$org_id);
		$res = $this->db->get()->row();
		return $res;
	}
	public function get_list_user_details($user_id){
		$this->db->select('u.id,CONCAT_WS(" ",u.firstname,u.lastname) as name,u.email as email,u.imgname,r.role_name')
				->from('users u')
				->join('roles r','r.role_id = u.user_role_id')
				->where_in('u.id',$user_id)
				->where('u.activation','1');
		$res = $this->db->get()->result_array();
		return $res;
	}
	public function get_user_post($user_id){
		$this->db->select('users.user_post')->from('users')->where('users.id = '.$user_id);
		return $this->db->get()->row()->user_post;
	}
	public function get_roles($org_id)
	{
		//$org_id = $this->session->userdata('org_id');
                
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->where('status','1');
		$this->db->where('organiser_id',$org_id);
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
				
			$result = $query->result_array();
			return $result;

		} else {
			return false;
		}
	}


	public function mail_exists($key){
		$this->db->where('email',$key);
	    $query = $this->db->get('users');
	    if($query->num_rows() > 0){
	        return true;
	    }
	    else{
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
	
	public function org_user_assign_role($data)
	{
		
		$this->db->select('id');
		$this->db->from('org_location');
		$this->db->where('org_id',$data['org_id']);
		$loc_id = $this->db->get()->row()->id;
		$user_detail = array('firstname' => $data['firstname'],
						'lastname' => $data['lastname'],
                        'password' => $data['password'],
						'user_token' => $data['authToken'],
						'email' => $data['email'],
						'phone' => $data['phone'],
						'org_id' => $data['org_id'],
						'user_org_loc_id' => $loc_id,
						'user_role_id' => $data['role_id'],
				  		'activation' => "1",
				  		'updatedDate' => date("Y-m-d H:i:s"),
				  		'uuid' => $data['uuid'],
				  		'created_by' => $this->session->userdata('user_id')
					);
		$this->db->insert("users", $user_detail);
		$id = $this->db->insert_id();
		foreach($data['department'] as $key=>$value){
			$org_user_map = array('dept_id' => $value, 'user_id' => $id, 'role_id' => $data['role_id']);
			$this->db->insert("org_user_department", $org_user_map);

		}
		return $id;	
	}

	public function get_org_user_info($user_id)
	{
		$this->db->select('US.firstname, US.lastname, US.id, US.email, US.phone, O.id as org_id,O.org_name,l.country_name,d.domain_name,US.user_role_id as role_id,US.user_post,r.role_name');
		$this->db->from ('users US');
		$this->db->join('organization O','US.org_id = O.id','left');
		$this->db->join('org_location OL','O.id = OL.org_id','left');
		$this->db->join('org_domain od','OL.id = od.org_location_id','left');
		$this->db->join('domain d','od.domain_id=d.domain_id','left');
		$this->db->join('location l','OL.country = l.loc_id','left');
		//$this->db->join('org_user_department oud','US.id = oud.user_id ','left');
		//$this->db->join('department de','de.dept_id = oud.dept_id','left');	
		$this->db->join('roles r','r.role_id = US.user_role_id','left');	
		$this->db->where('US.id', $user_id);
		$this->db->where('US.activation','1');
		//$this->db->where('de.status = 1');
		$this->db->group_by('US.id');
		//$this->db->group_by('oud.dept_id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result_user = $query->result_array();
				/*$dept = array();
				foreach($result_user as $key=>$value){
					if(isset($value['dept_id'])){
						$dept[] = $value['dept_id'];
					}
				}*/
				/*$depts=$this->db->select('dept_name')
	                  			->from('department')->where('dept_id IN ('.implode(',',$dept).') and status = 1');
	            $dept_details = $this->db->get()->row();
	            //print_r($dept_details);
	            foreach($dept_details as $key=>$value){
					$result_user[0]['dept_name'][]=$value->dept_name;
				}*/
			//print_r($result_user);
			return $result_user;
		} else {
			return false;
		}
	}

    public function organization_details($org_id) {
        /* Select Department */
        $this->db->select('o.*,od.domain_id')
                ->from('organization o')
                ->join('org_location ol', 'o.id = ol.org_id','left')
                ->join('org_domain od', 'ol.id = od.org_location_id','left')
                ->where('o.id', $org_id)
				->group_by('o.id');
        $org_details = $this->db->get()->result_array();
        
        //print_r($this->db); exit;
        if (isset($org_details)) {
            return $org_details;
        } else {
            return false;
        }
    }

	public function user_delete($user_id)
	{
		$this->db->set('activation','0');
		$this->db->where('id', $user_id);
		$this->db->update('users');
		/*$this->db->where('id', $user_id);
		$this->db->delete('users');*/	
		return true;
	}
	public function check_user_exists($uuid){
		$this->db->select('id')->from('users')->where('uuid',$uuid);
		$id = $this->db->get()->row('id');
		if($id){
			return $id;
		}
		else{
			return false;
		}
	}
	public function get_superadmin_id($org_id){
		$this->db->select('id')
				 ->from('users u')
				 ->where('u.org_id',$org_id)
				 ->where('u.user_role_id','1')
				 ->where('u.activation','1');
		$res = $this->db->get()->result_array();
		return $res;
	}
}

