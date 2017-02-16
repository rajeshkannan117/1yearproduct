<?php
require_once('User_model.php');
class Userv2_model extends User_model{

	public function get_user_location($user_id,$org_id)
	{

		$this->db->select('CONCAT_WS(" ",ol.location_name) as location_name,ol.id as location_id')
				 ->from('org_location ol')
				 ->join('user_location u','u.location_id = ol.id and u.user_id = '.$user_id)
				 ->where('ol.org_id = '.$org_id);
        $res = $this->db->get();
		$return = $res->result_array();
		return $return;
	}

     public function get_location_and_managers($user_id,$org_id)
    {
        $this->db->select('CONCAT_WS(" ",ol.location_name) as location_name,ol.id as location_id')
            ->from('org_location ol')
            ->join('user_location u','u.location_id = ol.id')
            ->where('ol.org_id = '.$org_id)
            ->where('u.user_id = '.$user_id);
        $res = $this->db->get();
        $return = $res->result_array();
        //getting location id as array for querying with in
        $locationId = [];
        foreach($return as $item) {
            $locationId[] = $item["location_id"];
        }
        $role = array();
        $role_id = $this->get_review_roles($org_id);
        $managers = $this->review_role_user($role_id,$org_id);
        //print_r($managers);
        //getting all managers
       /* $this->db->select('users.id, CONCAT_WS(" ", users.firstname, users.lastname) as name, users.email, user_location.location_id')
                ->from('user_location')
                ->join('users', 'user_location.user_id = users.id', 'left')
                ->join('users_post', 'users_post.users_post = users.user_post', 'left')
                ->where_in('user_location.location_id', $locationId)*/
            /**
             * Change the role id to suite the manager level or any other role
             */
                /*->where('users_post.users_post = 4 OR users_post.users_post = 3');*/
        /*$managers = $this->db->get()->result_array();*/
        //to add manager to actual output data
        foreach ($return as $key=>$item) {
            $return[$key]['reporting'] = $managers;//$managerHolder[$item['location_id']];
        }
        return $return;
    }
    public function user_categories($userid,$org_id){
        $this->db->select('a.*')
                ->from('users u')
                ->join('user_form uf','uf.user_id = u.id')
                ->join('form_category f','f.form_id = uf.form_id')
                ->join('form_location fl','fl.form_id = uf.form_id')
                ->join('category a','a.cat_id = f.cat_id')
                ->where('u.id = '.$userid.' and u.org_id = '.$org_id);
        $this->db->group_by('a.cat_id');
        $query = $this->db->get();
//echo $this->db->last_query(); exit;
        if($query->num_rows() > 0){

            return $query->result_array();
                    
        }
        else{

            return 0;

        }

    }
     public function review_user_categories($userid,$org_id){
        $this->db->select('a.*')
                ->from('users u')
                ->join('form_hierarchy_position fh','fh.user_id = u.id')
                ->join('form_category f','f.form_id = fh.form_id')
                ->join('form_location fl','fl.form_id = fh.form_id')
                ->join('category a','a.cat_id = f.cat_id')
                ->where('u.id = '.$userid.' and u.org_id = '.$org_id);
        $this->db->group_by('a.cat_id');
        $query = $this->db->get();
//echo $this->db->last_query(); exit;
        if($query->num_rows() > 0){

            return $query->result_array();
                    
        }
        else{

            return 0;

        }

    }
    public function review_role_user($role_id,$org_id){
        $role_id[] = 1;
        $role =  implode(",",$role_id);
        $this->db->select('us.id,CONCAT_WS(" ",us.firstname,us.lastname) as name,us.email');
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
    public function get_review_roles($org_id){
        $this->db->select('r.role_id')
                 ->from('roles_permissions rp')
                 ->join('roles r','r.role_id = rp.role_id')
                 ->where('rp.roles_category_type_id = 12 and rp.create = "1"')
                 ->where('r.organiser_id = '.$org_id);
        $roles = $this->db->get()->result_array();
        foreach($roles as $key=>$value){
            $role_id[] = $value['role_id'];
        }
        return $role_id;
    }
    public function get_reporting_authorities($org_id,$loc_id){
        $this->db->select('r.role_id,u.id, CONCAT_WS(" ", u.firstname, u.lastname) as name, u.email')
                 ->from('roles r')
                 ->join('roles_permissions rp','rp.role_id = r.role_id')
                 ->join('users u','u.user_role_id = r.role_id')
                 ->where('rp.roles_category_type_id = 12 and rp.create = "1" and r.organiser_id = '.$org_id.' and u.user_org_loc_id = '.$loc_id);
        $review_roles = $this->db->get()->result_array();
        return $review_roles;
    }
    /*public function get_reporting_authorities($org_id){

        $this->db->select('users.id, CONCAT_WS(" ", users.firstname, users.lastname) as name, users.email, user_location.location_id')
                ->from('user_location')
                ->join('users', 'user_location.user_id = users.id', 'left')
                ->join('users_post', 'users_post.users_post = users.user_post', 'left')
                ->where_in('user_location.location_id', $locationId)
                ->where('users_post.users_post = 4 OR users_post.users_post = 3');
        $managers = $this->db->get()->result_array();
        return $managers;
    }*/
    
    public function get_user_details($user_id,$org_id){
        $this->db->select('u.id,CONCAT_WS(" ",u.firstname,u.lastname) as name,u.email as email')
                ->from('users u')
                ->where('u.id = '.$user_id.' and u.org_id = '.$org_id);
        $res = $this->db->get()->row();
        return $res;
    }
    public function get_device_token($user_id){
        $this->db->select('token')->from('device_token')->where('user_id',$user_id);
        $res= $this->db->get();
        return $res->result_array();
    }
     public function get_alert_user_details($user_id){
        $this->db->select('u.id,CONCAT_WS(" ",u.firstname,u.lastname) as name,u.email as email')
                ->from('users u')
                ->where('u.id = '.$user_id);
        $res = $this->db->get()->row();
        return $res;
    }
	public function get_location_details($org_id,$loc_id){
    $this->db->select('l.location_id,l.location_name,l.address,l.city,l.zip_code,l.state,lo.country_name as location,o.org_name,lo.loc_id');
    $this->db->from('org_location l')
              ->join('location lo','lo.loc_id = l.country')
              ->join('organization o','o.id = l.org_id')
              ->where('l.org_id = '.$org_id.' and l.id = '.$loc_id);
      $list = $this->db->get()->result_array();
      return $list;
  }
  public function check_device_token($token){
        $this->db->select('*')->from('device_token')->where('token',$token);
        $res = $this->db->get();
        return $res->num_rows();
    }
    public function update_device_token($token,$user_id){
        $this->db->set('user_id',$user_id);
        $this->db->set('updated_date',gmdate(date('Y-m-d H:i:s')));
        $this->db->where('token',$token);
        return $this->db->update('device_token');
        //echo $this->db->last_query();exit;
    }
    public function store_device_token($token,$user_id){
        $data['token'] = $token;
        $data['user_id'] = $user_id;
        $data['created_date'] = gmdate(date('Y-m-d H:i:s'));
        $data['updated_date'] = gmdate(date('Y-m-d H:i:s'));
        $this->db->insert('device_token',$data);
        return $this->db->insert_id();
    }
}

 ?>