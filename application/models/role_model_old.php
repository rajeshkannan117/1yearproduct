<?php
/**
 *
 * This is Role model of Formpro
 * @package	    CodeIgniter
 * @category	Model
 * @author	    Rajeshkannan.C
 * @link	    http://innoppl.com/
 *
 */
class Role_model extends CI_Model {
	public function __construct()
	{
		date_default_timezone_set('America/New_York');
		$this->load->database();
	}
	public function role_add($role){
		
		$roles   = array(
                    'role_name' => $role['role_name'],
                    'role_desc' => $role['role_desc'],
		    		'default' =>$role['default'],
		    		'status' =>'1',
		    		'created_at'=>date("Y-m-d H:i:s"),
					'updated_at'=>date("Y-m-d H:i:s"),
		    		'created_by' =>$role['created_by']
				);
		$this->db->insert('tbl_roles',$roles);
		$role_id = $this->db->insert_id();
		/*foreach($role['domain'] as $key=>$value){
			if(!$this->domain_country($value,$role['country'])){
				$this->db->insert('tbl_domain_country_mapping',array('domain_id'=>$value,'country_id'=>$role['country']));
				$domain_map_id = $this->db->insert_id();
			}else{
				$domain_map_id = $this->domain_country($value,$role['country']);
			}
			$this->db->insert('tbl_roles_mapping',array('role_id'=>$role_id,'domain_map_id'=>$domain_map_id));			

		}*/
		/* insert Country permission records */
		
		foreach($role['countries'] as $key=>$value){
			$array[$value] = '1';
		}
		$array['role_id'] = $role_id;
		$array['type'] = 'countries';
		$this->db->insert('tbl_permissions',$array);

		/* Insert Domain Permission Records */
		foreach($role['domains'] as $key=>$value){
			$domains[$value] = '1';
		}
		$domains['role_id'] = $role_id;
		$domains['type'] = 'domains';
		$this->db->insert('tbl_permissions',$domains);
		/* insert Department permission records */
		foreach($role['department'] as $key=>$value){
			$department[$value] = '1';
		}
		$department['role_id'] = $role_id;
		$department['type'] = 'department';
		$this->db->insert('tbl_permissions',$department);
		/* Insert Category Permission Records */
		foreach($role['category'] as $key=>$value){
			$category[$value] = '1';
		}
		$category['role_id'] = $role_id;
		$category['type'] = 'category';
		$this->db->insert('tbl_permissions',$category);
		/* insert Roles permission records */
		foreach($role['roles'] as $key=>$value){
			$role_val[$value] = '1';
		}
		$role_val['role_id'] = $role_id;
		$role_val['type'] = 'roles';
		$this->db->insert('tbl_permissions',$role_val);
		/* Insert Users Permission Records */
		foreach($role['users'] as $key=>$value){
			$users[$value] = '1';
		}
		$users['role_id'] = $role_id;
		$users['type'] = 'users';
		$this->db->insert('tbl_permissions',$users);
		/* Insert Form Permission Records */
		foreach($role['forms'] as $key=>$value){
			$forms[$value] = '1';
		}
		$forms['role_id'] = $role_id;
		$forms['type'] = 'forms';
		$this->db->insert('tbl_permissions',$forms);
		/* Insert Organization Permission Records */
		foreach($role['organization'] as $key=>$value){
			$organization[$value] = '1';
		}
		$organization['role_id'] = $role_id;
		$organization['type'] = 'organizations';
		$this->db->insert('tbl_permissions',$organization);
		return true;

	}
	public function role_update($role){

		$perms = array('create','read','delete','update');

		$role_update = array(
                    'role_name' => $role['role_name'],
                    'role_desc' => $role['role_desc'],
		    		'default' =>$role['default'],
		    		'status' =>$role['status'],
					'updated_at'=>date("Y-m-d H:i:s")
				);

		$this->db->where('role_id',$role['role_id']);
		$this->db->update('tbl_roles',$role_update);
		/* Update country Permission */
		if($role['countries']){
			foreach($role['countries'] as $key=>$value){
				$countries[$value] = '1';
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $countries)){
					$countries[$value] = '0';
				}
			}
			$this->db->select('id');
    		$this->db->from('tbl_permissions');
    		$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','countries');
    		$country_id = $this->db->get()->row()->id;
    		if($country_id){
    			$this->db->where('role_id',$role['role_id']);
				$this->db->where('type','countries');
				$this->db->update('tbl_permissions',$countries);
    			
    		}
			$this->db->insert('tbl_permissions', $countries);
		}
		else{
			foreach($perms as $key=>$value){
				$countries[$value] = '0';
			}
			$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','countries');
			$this->db->update('tbl_permissions',$countries);
		}
		/* Update Domain Permission */
		if($role['domains']){
			foreach($role['domains'] as $key=>$value){
				$domains[$value] = '1';
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $domains)){
					$domains[$value] = '0';
				}
			}
			$this->db->select('id');
    		$this->db->from('tbl_permissions');
    		$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','domains');
    		$domain_id = $this->db->get()->row()->id;
    		if($domain_id){
    			$this->db->where('role_id',$role['role_id']);
				$this->db->where('type','domains');
				$this->db->update('tbl_permissions',$domains);
    			
    		}
			$this->db->insert('tbl_permissions', $domains);
		}else{
			foreach($perms as $key=>$value){
				$domains[$value] = '0';
			}
			$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','domains');
			$this->db->update('tbl_permissions',$domains);
		}
		/* Update department Permission */
		if($role['department']){
			foreach($role['department'] as $key=>$value){
				$department[$value] = '1';
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $department)){
					$department[$value] = '0';
				}
			}
			$this->db->select('id');
    		$this->db->from('tbl_permissions');
    		$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','department');
    		$department_id = $this->db->get()->row()->id;
    		if($department_id){
    			$this->db->where('role_id',$role['role_id']);
				$this->db->where('type','department');
				$this->db->update('tbl_permissions',$department);
    			
    		}
			$this->db->insert('tbl_permissions', $department);
		}else{
			foreach($perms as $key=>$value){
				$department[$value] = '0';
			}
			$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','department');
			$this->db->update('tbl_permissions',$department);
		}
		/* Update category Permission */
		if($role['category']){
			foreach($role['category'] as $key=>$value){
				$category[$value] = '1';
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $category)){
					$category[$value] = '0';
				}
			}
			$this->db->select('id');
    		$this->db->from('tbl_permissions');
    		$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','category');
    		$category_id = $this->db->get()->row()->id;
    		if($category_id){
    			$this->db->where('role_id',$role['role_id']);
				$this->db->where('type','category');
				$this->db->update('tbl_permissions',$category);
    			
    		}
			$this->db->insert('tbl_permissions', $department);
		}else{
			foreach($perms as $key=>$value){
				$category[$value] = '0';
			}
			$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','category');
			$this->db->update('tbl_permissions',$category);
		}
		/* Update role Permission */
		if($role['roles']){
			foreach($role['roles'] as $key=>$value){
				$roles[$value] = '1';
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $roles)){
					$roles[$value] = '0';
				}
			}
			$this->db->select('id');
    		$this->db->from('tbl_permissions');
    		$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','roles');
    		$roles_id = $this->db->get()->row()->id;
    		if($roles_id){
    			$this->db->where('role_id',$role['role_id']);
				$this->db->where('type','roles');
				$this->db->update('tbl_permissions',$roles);
    			
    		}
			$this->db->insert('tbl_permissions', $roles);
		}else{
			foreach($perms as $key=>$value){
				$roles[$value] = '0';
			}
			$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','roles');
			$this->db->update('tbl_permissions',$roles);
		}
		/* Update user Permission */
		if($role['users']){
			foreach($role['users'] as $key=>$value){
				$users[$value] = '1';
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $users)){
					$users[$value] = '0';
				}
			}
			$this->db->select('id');
    		$this->db->from('tbl_permissions');
    		$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','users');
    		$users_id = $this->db->get()->row()->id;
    		if($users_id){
    			$this->db->where('role_id',$role['role_id']);
				$this->db->where('type','users');
				$this->db->update('tbl_permissions',$users);
    			
    		}
			$this->db->insert('tbl_permissions', $users);
		}else{
			foreach($perms as $key=>$value){
				$users[$value] = '0';
			}
			$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','users');
			$this->db->update('tbl_permissions',$users);
		}
		/* Update Form Permission */
		if($role['forms']){
			foreach($role['forms'] as $key=>$value){
				$form[$value] = '1';
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $form)){
					$form[$value] = '0';
				}
			}
			$this->db->select('id');
    		$this->db->from('tbl_permissions');
    		$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','form');
    		$form_id = $this->db->get()->row()->id;
    		if($form_id){
    			$this->db->where('role_id',$role['role_id']);
				$this->db->where('type','form');
				$this->db->update('tbl_permissions',$form);
    			
    		}
			$this->db->insert('tbl_permissions', $form);
		}else{
			foreach($perms as $key=>$value){
				$form[$value] = '0';
			}
			$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','form');
			$this->db->update('tbl_permissions',$form);
		}
		/* Update Organization Permission */
		if($role['organization']){
			foreach($role['organization'] as $key=>$value){
				$organization[$value] = '1';
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $organization)){
					$organization[$value] = '0';
				}
			}
			$this->db->select('id');
    		$this->db->from('tbl_permissions');
    		$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','organization');
    		$organization_id = $this->db->get()->row()->id;
    		if($organization_id){
    			$this->db->where('role_id',$role['role_id']);
				$this->db->where('type','organization');
				$this->db->update('tbl_permissions',$organization);
    			
    		}
			$this->db->insert('tbl_permissions', $organization);
		}else{
			foreach($perms as $key=>$value){
				$organization[$value] = '0';
			}
			$this->db->where('role_id',$role['role_id']);
			$this->db->where('type','organization');
			$this->db->update('tbl_permissions',$organization);
		}
		/*$already_permission = $this->get_role_permission($role['role_id']);
		$not_to_delete_permission = array();
		foreach($role['permission'] as $key=>$value){

			if(in_array($value,$already_permission)){

				$not_to_delete_permission[] = $value;
			}
			else{
				$not_to_delete_permission[] = $value;
				$this->db->insert('tbl_roles_permission',array('role_id'=>$role['role_id'],'permission_id'=>$value));
			}
		}

		if(count($not_to_delete_permission) > 0){
			$not_to_delete = implode(',',$not_to_delete_permission);
			$this->db->query('DELETE FROM tbl_roles_permission WHERE role_id = '.$role['role_id'].' AND permission_id NOT IN('.$not_to_delete.')');
		} */

		/*$this->db->query('DELETE FROM tbl_roles_mapping WHERE role_id ='.$role['role_id']);
		foreach($role['domain'] as $key=>$value){
			//echo $this->domain_country($value,$post['countries']); exit;
			if(!$this->domain_country($value,$role['country'])){
				$this->db->insert('tbl_domain_country_mapping',array('domain_id'=>$value,'country_id'=>$role['country']));
				$domain_map_id = $this->db->insert_id();
			}else{
				$domain_map_id = $this->domain_country($value,$role['country']);
			}
			$this->db->insert('tbl_roles_mapping',array('role_id'=>$role['role_id'],'domain_map_id'=>$domain_map_id));			

		}*/
		return true;

	}
	public function role_delete($role_id){

		$this->db->set('status','0');
		$this->db->where('role_id',$role_id);
		$this->db->update('tbl_roles');
		
		$this->db->where('role_id', $role_id);
		$this->db->delete('tbl_permissions');

	}
	public function role_info($role_id){

		$this->db->select('r.role_id,r.role_name,r.role_desc,r.default,r.status,')
				->from('tbl_roles r')
				->where('r.role_id = '.$role_id);
		$res = $this->db->get();
		$row = $res->row();
		$row->country = $this->role_country_permission($role_id);
		$row->domain = $this->role_domain_permission($role_id);
		$row->department = $this->role_department_permission($role_id);
		$row->category = $this->role_category_permission($role_id);
		$row->user = $this->role_user_permission($role_id);
		$row->role = $this->role_role_permission($role_id);
		$row->forms = $this->role_form_permission($role_id);
		$row->organizations = $this->role_organization_permission($role_id);
		return $row;

	}
	public function role_country_permission($role_id){

		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('tbl_permissions p')
				->where('type="countries" AND role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();		
	}
	public function role_domain_permission($role_id){
		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('tbl_permissions p')
				->where('type="domains" AND role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();
	}
	public function role_department_permission($role_id){

		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('tbl_permissions p')
				->where('type="department" AND role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();		
	}
	public function role_category_permission($role_id){
		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('tbl_permissions p')
				->where('type="category" AND role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();
	}
	public function role_role_permission($role_id){

		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('tbl_permissions p')
				->where('type="roles" AND role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();		
	}
	public function role_user_permission($role_id){
		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('tbl_permissions p')
				->where('type="users" AND role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();
	}
	public function role_form_permission($role_id){

		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('tbl_permissions p')
				->where('type="forms" AND role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();		
	}
	public function role_organization_permission($role_id){
		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('tbl_permissions p')
				->where('type="organizations" AND role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();
	}
	public function role_list($status = 0){

		$this->db->select('role_id,role_name,role_desc,default,status')
				  ->from('tbl_roles');
		if($status){
			$this->db->where('status',$status);
		}
		$res = $this->db->get();
		return $res->result_array();
	}

	public function get_role_mapping_details($role_id){

		$result = $this->get_role_mapping($role_id);
		$role_mapping_domain = array();
		$role_mapping_country = array();
		foreach($result as $key=>$value){
			
			$this->db->select('domain_id,country_id')
					 ->from('tbl_domain_country_mapping')
					 ->where('id = '.$value['domain_map_id']);
			$ret = $this->db->get();
			$role_mapping_domain[] = $ret->row('domain_id');
			if(!in_array($ret->row('country_id'),$role_mapping_country)){
				$role_mapping_country[] = $ret->row('country_id');
			}
		}

		$role['domain'] = $role_mapping_domain;
		$role['country'] = $role_mapping_country;

		return $role;

	}

	public function get_role_mapping($role_id){

		$this->db->select('domain_map_id')
				->from('tbl_roles_mapping')
				->where('role_id ='.$role_id);

		$res= $this->db->get();
		return $res->result_array();

	}

	public function list_of_country_for_domain($country_id){

		$this->db->select('d.domain_id,do.domain_name');
		$this->db->from('tbl_domain_country_mapping d');
		$this->db->join("tbl_domain as do",'do.domain_id = d.domain_id','left');	
		$this->db->where('d.country_id ='.$country_id);
		$result = $this->db->get();
		return $result->result_array();

	}

	public function domain_country($domain_id,$country_id){

		$do_cu = $this->db->query('Select id from tbl_domain_country_mapping where domain_id ='.$domain_id.' and country_id='.$country_id);
		if($do_cu->num_rows() > 0){
			return $do_cu->row()->id;
		}		
		else{
			return false;
		}

	}

	public function get_role_permission($role_id){

		$this->db->select('permission_id')
				  ->from('tbl_roles_permission')
				  ->where('role_id',$role_id);

		$result = $this->db->get();
		$selected_permission = array();
		foreach($result->result_array() as $key=>$value){

			$selected_permission[] = $value['permission_id'];

		}
		return $selected_permission;

	}
}
