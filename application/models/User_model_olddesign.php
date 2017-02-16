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
 
        $this->db->where('user_id', $post['user_id']); 
		$this->db->delete('org_user_department'); 
 
		foreach($post['data']['department'] as $key=>$value){ 
 
			$dept_detail = array('dept_id' => $value,'user_id' => $post['user_id'],'role_id' => $post['data']['role_id']); 
			$this->db->insert("org_user_department", $dept_detail); 
			//$id = $this->db->insert_id(); 
		} 
		//'password' => AES_Encode($post['data']['usr_psw']), 
		$user_detail = array('firstname' => $post['data']['firstname'],'lastname' => $post['data']['lastname'], 'email' => $post['data']['usr_email'], 'phone' => $post['data']['usr_phone']); 
		 
		$this->db->where('id', $post['user_id']); 
		$this->db->update('users', $user_detail); 
		 
		return true; 
	} 
	public function get_users($org_id)
	{	
		$where = '';
		$this->db->distinct();
		$this->db->select('US.id, US.firstname,US.lastname, O.org_name, US.activation');
		$this->db->from ('users US');
		$this->db->join('organization O','O.id = US.org_id');
		/*if($org_id){
		  $this->db->join('tbl_org_users OU','US.id = OU.user_id');
		  $this->db->join('tbl_organization O','OU.org_id = '.$org_id);
	    }else{
	    	
	    }*/
	    if($org_id == 1){
		  $where = '';
	    }else{
	    	$where = ' and US.org_id='.$org_id;
	    }
	    
		$this->db->where('US.activation = 1 '.$where);
		$query = $this->db->get ();
		//print_r($this->db); exit;
		if ($query->num_rows () > 0) {
			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}
	}
	public function get_dept_users($org_id){
		$this->db->select('us.id')->from('tbl_users u');
		if($org_id){
		  $this->db->join('tbl_org_users OU','US.id = OU.user_id');
		  $this->db->join('tbl_organization O','OU.org_id = '.$org_id);
	    }
	}	

	public function get_organizations($data)
	{
		$this->db->select('OR.id, OR.org_name, OR.org_token,OR.status');
		$this->db->from ('organization OR');
		//$this->db->join('org_location ol','ol.org_id = OR.id');
		//$this->db->join('org_domain od','od.org_location_id = ol.id');
		//$this->db->join('domain d','od.domain_id = d.domain_id');
		//$this->db->join('org_users OU','OR.id = OU.org_id','left');
		//$this->db->join('users US','OU.user_id = US.id','left');
		$this->db->where('OR.status = 1');
		$query = $this->db->get ();

		if ($query->num_rows () > 0) {

			$result = $query->result_array();
			return $result;

		} else {
			return false;
		}
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
	    if ($query->num_rows() > 0){
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
				  		'updatedDate' => date("Y-m-d H:i:s"));
		

		$this->db->insert("users", $user_detail);

		$id = $this->db->insert_id();

		/*(if(!ISSET($data['loc_id'])){
			$data['loc_id']='0';
		}

		$org_user = array('org_id' => $data['org_id'], 'loc_id' => $data['loc_id'], 'user_id' => $id);
		$this->db->insert("org_users", $org_user);

		$map_id = $this->db->insert_id();*/

		foreach($data['department'] as $key=>$value){
			$org_user_map = array('dept_id' => $value, 'user_id' => $id, 'role_id' => $data['role_id']);
			$this->db->insert("org_user_department", $org_user_map);

		}
		return $id;
		
	}


	public function get_org_user_info($user_id)
	{
		$this->db->select('US.firstname, US.lastname, US.id, US.email, US.phone, O.id as org_id,O.org_name,l.country_name,d.domain_name,oud.dept_id,oud.role_id');
		$this->db->from ('users US');
		$this->db->join('organization O','US.org_id = O.id','left');
		$this->db->join('org_location OL','O.id = OL.org_id','left');
		$this->db->join('org_domain od','OL.id = od.org_location_id','left');
		$this->db->join('domain d','od.domain_id=d.domain_id','left');
		$this->db->join('location l','OL.country = l.loc_id','left');
		$this->db->join('org_user_department oud','US.id = oud.user_id ','left');		
		$this->db->where('US.id', $user_id);
		
		
		
		
		$query = $this->db->get ();
		
		if ($query->num_rows() > 0) {
			
			$result_user = $query->result_array();
			
			foreach($result_user as $key=>$value){
				
				$depts=$this->db->select('dept_name')
                  				->from('department')->where('dept_id',$value['dept_id']);
                  		$dept_name = $this->db->get()->row();
                  		//$dept_name = $deptts_name->dept_name;

                		$role_name=$this->db->select('role_name')
                  				->get_where('roles', array('role_id' => $value['role_id']))
                  				->row();
                  				//->role_name;
					
				$result_user[$key]['dept_name']=$dept_name;
				$result_user[$key]['role_name']=$role_name;
				
			}
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
                ->where('o.id', $org_id);
        $org_details = $this->db->get()->result_array();
        
        //print_r($this->db); exit;
        if (isset($org_details)) {
            return $org_details;
        } else {
            return false;
        }
    }

	public function user_delete($data)
	{

		$this->db->where('user_id', $data['user_id']);
		$this->db->delete('org_user_department');

		$this->db->where('id', $data['user_id']);
		$this->db->delete('users');

		
		return true;
	}


	
}

