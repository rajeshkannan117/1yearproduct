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
                    'organiser_id' => $role['organiser_id'],
                    'created_by' =>$role['created_by'],
                    'uuid' =>$role['uuid']
		);
		$this->db->insert('roles',$roles);
		$role_id = $this->db->insert_id();
		/*foreach($role['domain'] as $key=>$value){
			if(!$this->domain_country($value,$role['country'])){
				$this->db->insert('domain_country_mapping',array('domain_id'=>$value,'country_id'=>$role['country']));
				$domain_map_id = $this->db->insert_id();
			}else{
				$domain_map_id = $this->domain_country($value,$role['country']);
			}
			$this->db->insert('roles_mapping',array('role_id'=>$role_id,'domain_map_id'=>$domain_map_id));			

		}*/
		/* insert Country permission records */
		if($role['countries']){
                        //print_r($role['countries']); exit;
			foreach($role['countries'] as $key=>$value){
                if($value == 'create'){
                    //$array['update'] = '1';
                    $array['read'] = '1';
                    $array['create'] = '1';
                }else if($value == 'update'){
                    $array['update'] = '1';
                    $array['read'] = '1';
                }else if($value == 'read'){
                    $array['read'] = '1';
                }else if($value == 'delete'){
                    $array['read'] = '1';
                    $array['delete'] = '1';
                }
                else{
                    $array[$value] = '1';
                }
			}
			$array['role_id'] = $role_id;
			$array['roles_category_type_id'] = '1';
			$this->db->insert('roles_permissions',$array);
		}

		/* Insert Domain Permission Records */
		if($role['domains']){
			foreach($role['domains'] as $key=>$value){
                if($value == 'create'){
                    //$domains['update'] = '1';
                    $domains['read'] = '1';
                    $domains['create'] = '1';
                }else if($value == 'update'){
                    $domains['update'] = '1';
                    $domains['read'] = '1';
                }else if($value == 'read'){
                    $domains['read'] = '1';
                }else if($value == 'delete'){
                    $domains['read'] = '1';
                    $domains['delete'] = '1';
                }
                else{
                    $domains[$value] = '1';
                }
			}
			$domains['role_id'] = $role_id;
			$domains['roles_category_type_id'] = '2';
			$this->db->insert('roles_permissions',$domains);
		}
		/* insert Department permission records */
		if($role['department']){
			foreach($role['department'] as $key=>$value){
			    if($value == 'create'){
                    //$department['update'] = '1';
                    $department['read'] = '1';
                    $department['create'] = '1';
                }else if($value == 'update'){
                    $department['update'] = '1';
                    $department['read'] = '1';
                }else if($value == 'read'){
                    $department['read'] = '1';
                }else if($value == 'delete'){
                    $department['read'] = '1';
                    $department['delete'] = '1';
                }
                else{
                    $department[$value] = '1';
                }
			}
			$department['role_id'] = $role_id;
			$department['roles_category_type_id'] = '3';
			$this->db->insert('roles_permissions',$department);
		}
		/* Insert Category Permission Records */
		if($role['category']){
			foreach($role['category'] as $key=>$value){
			    if($value == 'create'){
                   // $category['update'] = '1';
                    $category['read'] = '1';
                    $category['create'] = '1';
                }else if($value == 'update'){
                    $category['update'] = '1';
                    $category['read'] = '1';
                }else if($value == 'read'){
                    $category['read'] = '1';
                }else if($value == 'delete'){
                    $category['read'] = '1';
                    $category['delete'] = '1';
                }
                else{
                    $category[$value] = '1';
                }
			}
			$category['role_id'] = $role_id;
			$category['roles_category_type_id'] = '4';
			$this->db->insert('roles_permissions',$category);
		}
		/* insert Roles permission records */
		if($role['roles']){
			foreach($role['roles'] as $key=>$value){
                if($value == 'create'){
                    //$roles['update'] = '1';
                    $roless['read'] = '1';
                    $roless['create'] = '1';
                }else if($value == 'update'){
                    $roless['update'] = '1';
                    $roless['read'] = '1';
                }else if($value == 'read'){
                    $roless['read'] = '1';
                }else if($value == 'delete'){
                    $roless['read'] = '1';
                    $roless['delete'] = '1';
                }
                else{
                    $roless[$value] = '1';
                }
			}
			$roless['role_id'] = $role_id;
			$roless['roles_category_type_id'] = '7';
			$this->db->insert('roles_permissions',$roless);
		}
		/* Insert Users Permission Records */
		if($role['users']){
			foreach($role['users'] as $key=>$value){
                if($value == 'create'){
                   // $users['update'] = '1';
                    $users['read'] = '1';
                    $users['create'] = '1';
                }else if($value == 'update'){
                    $users['update'] = '1';
                    $users['read'] = '1';
                }else if($value == 'read'){
                    $users['read'] = '1';
                }else if($value == 'delete'){
                    $users['read'] = '1';
                    $users['delete'] = '1';
                }
                else{
                    $users[$value] = '1';
                }
			}
			$users['role_id'] = $role_id;
			$users['roles_category_type_id'] = '5';
			$this->db->insert('roles_permissions',$users);
		}
		/* Insert Form Permission Records */
		if($role['forms']){
			foreach($role['forms'] as $key=>$value){
                if($value == 'create'){
                    //$form['update'] = '1';
                    $form['read'] = '1';
                    $form['create'] = '1';
                }else if($value == 'update'){
                    $form['update'] = '1';
                    $form['read'] = '1';
                }else if($value == 'read'){
                    $form['read'] = '1';
                }else if($value == 'delete'){
                    $form['read'] = '1';
                    $form['delete'] = '1';
                }
                else{
                    $form[$value] = '1';
                }
			}
			$form['role_id'] = $role_id;
			$form['roles_category_type_id'] = '6';
			$this->db->insert('roles_permissions',$form);
		}
        /* Insert review Permission Records */
        if($role['review']){
            $review['create'] = '1';
            $review['read'] = '1';
            $review['update'] = '1';
            $review['delete'] = '1';
            $review['role_id'] = $role_id;
            $review['roles_category_type_id'] = '12';
            $this->db->insert('roles_permissions',$review);
        }
		/* Insert Organization Permission Records */
		if($role['organization']){
			foreach($role['organization'] as $key=>$value){
                if($value == 'create'){
                    //$organization['update'] = '1';
                    $organization['read'] = '1';
                    $organization['create'] = '1';
                }else if($value == 'update'){
                    $organization['update'] = '1';
                    $organization['read'] = '1';
                }else if($value == 'read'){
                    $organization['read'] = '1';
                }else if($value == 'delete'){
                    $organization['read'] = '1';
                    $organization['delete'] = '1';
                }
                else{
                    $organization[$value] = '1';
                }
			}
			$organization['role_id'] = $role_id;
			$organization['roles_category_type_id'] = '8';
			$this->db->insert('roles_permissions',$organization);
		}
        /* Insert Location Permission Records */
        if($role['location']){
            foreach($role['location'] as $key=>$value){
                if($value == 'create'){
                    //$organization['update'] = '1';
                    $location['read'] = '1';
                    $location['create'] = '1';
                }else if($value == 'update'){
                    $location['update'] = '1';
                    $location['read'] = '1';
                }else if($value == 'read'){
                    $location['read'] = '1';
                }else if($value == 'delete'){
                    $location['read'] = '1';
                    $location['delete'] = '1';
                }
                else{
                    $location[$value] = '1';
                }
            }
            $location['role_id'] = $role_id;
            $location['roles_category_type_id'] = '10';
            $this->db->insert('roles_permissions',$location);
        }
		return true;

	}
	public function role_update($role){

		$perms = array('create','read','delete','update');

		$role_update = array(
                    'role_name' => $role['role_name'],
                    'role_desc' => $role['role_desc'],
		    'default' =>$role['default'],
		    'status' =>$role['status'],
                    'updated_at'=> gmdate(date("Y-m-d H:i:s")),
                    'organiser_id' => $role['organiser_id']
		);

		$this->db->where('role_id',$role['role_id']);
		$this->db->update('roles',$role_update);
               
		/* Update country Permission */
		if($role['countries']){
			foreach($role['countries'] as $key=>$value){
				if($value == 'create'){
                                    //$countries['update'] = '1';
                                    $countries['read'] = '1';
                                    $countries['create'] = '1';
                                }else if($value == 'update'){
                                    $countries['update'] = '1';
                                    $countries['read'] = '1';
                                }else if($value == 'read'){
                                    $countries['read'] = '1';
                                }else if($value == 'delete'){
                                    $countries['read'] = '1';
                                    $countries['delete'] = '1';
                                }
                                else{
                                    $countries[$value] = '1';
                                }
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $countries)){
					$countries[$value] = '0';
				}
			}
		}
		else{
			foreach($perms as $key=>$value){
				$countries[$value] = '0';
			}
		}
               $this->insert_or_update_permissions_table($role['role_id'],'1',$countries);
		/* Update Domain Permission */
		if($role['domains']){
			foreach($role['domains'] as $key=>$value){
                            if($value == 'create'){
                                //$domains['update'] = '1';
                                $domains['read'] = '1';
                                $domains['create'] = '1';
                            }else if($value == 'update'){
                                $domains['update'] = '1';
                                $domains['read'] = '1';
                            }else if($value == 'read'){
                                $domains['read'] = '1';
                            }else if($value == 'delete'){
                                $domains['read'] = '1';
                                $domains['delete'] = '1';
                            }
                            else{
                                $domains[$value] = '1';
                            }
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $domains)){
					$domains[$value] = '0';
				}
			}
		}else{
			foreach($perms as $key=>$value){
				$domains[$value] = '0';
			}
                 
		}
                $this->insert_or_update_permissions_table($role['role_id'],'2',$domains);
		/* Update department Permission */
		if($role['department']){
			foreach($role['department'] as $key=>$value){
                            if($value == 'create'){
                                //$department['update'] = '1';
                                $department['read'] = '1';
                                $department['create'] = '1';
                            }else if($value == 'update'){
                                $department['update'] = '1';
                                $department['read'] = '1';
                            }else if($value == 'read'){
                                $department['read'] = '1';
                            }else if($value == 'delete'){
                                $department['read'] = '1';
                                $department['delete'] = '1';
                            }
                            else{
                                $department[$value] = '1';
                            }
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $department)){
					$department[$value] = '0';
				}
			}
                        
		}else{
			foreach($perms as $key=>$value){
				$department[$value] = '0';
			}
			
		}
                $this->insert_or_update_permissions_table($role['role_id'],'3',$department);
		/* Update category Permission */
		if($role['category']){
			foreach($role['category'] as $key=>$value){
                            if($value == 'create'){
                                //$category['update'] = '1';
                                $category['read'] = '1';
                                $category['create'] = '1';
                            }else if($value == 'update'){
                                $category['update'] = '1';
                                $category['read'] = '1';
                            }else if($value == 'read'){
                                $category['read'] = '1';
                            }else if($value == 'delete'){
                                $category['read'] = '1';
                                $category['delete'] = '1';
                            }
                            else{
                                $category[$value] = '1';
                            }
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $category)){
					$category[$value] = '0';
				}
			}
		}else{
                    foreach($perms as $key=>$value){
                            $category[$value] = '0';
                    }
		}
                $this->insert_or_update_permissions_table($role['role_id'],'4',$category);
		/* Update role Permission */
		if($role['roles']){
			foreach($role['roles'] as $key=>$value){
                            if($value == 'create'){
                               // $roles['update'] = '1';
                                $roles['read'] = '1';
                                $roles['create'] = '1';
                            }else if($value == 'update'){
                                $roles['update'] = '1';
                                $roles['read'] = '1';
                            }else if($value == 'read'){
                                $roles['read'] = '1';
                            }else if($value == 'delete'){
                                $roles['read'] = '1';
                                $roles['delete'] = '1';
                            }
                            else{
                                $roles[$value] = '1';
                            }
			}
			foreach($perms as $key=>$value){
                            if(!array_key_exists($value, $roles)){
                                    $roles[$value] = '0';
                            }
			}
		}else{
			foreach($perms as $key=>$value){
				$roles[$value] = '0';
			}
                    }
                $this->insert_or_update_permissions_table($role['role_id'],'7',$roles);    
		/* Update user Permission */
		if($role['users']){
			foreach($role['users'] as $key=>$value){
                            if($value == 'create'){
                                //$users['update'] = '1';
                                $users['read'] = '1';
                                $users['create'] = '1';
                            }else if($value == 'update'){
                                $users['update'] = '1';
                                $users['read'] = '1';
                            }else if($value == 'read'){
                                $users['read'] = '1';
                            }else if($value == 'delete'){
                                $users['read'] = '1';
                                $users['delete'] = '1';
                            }
                            else{
                                $users[$value] = '1';
                            }
			}
			foreach($perms as $key=>$value){
                            if(!array_key_exists($value, $users)){
                                    $users[$value] = '0';
                            }
			}
			
		}else{
			foreach($perms as $key=>$value){
				$users[$value] = '0';
			}
		}
                $this->insert_or_update_permissions_table($role['role_id'],'5',$users);
		/* Update Form Permission */
		if($role['forms']){
			foreach($role['forms'] as $key=>$value){
                            if($value == 'create'){
                               // $form['update'] = '1';
                                $form['read'] = '1';
                                $form['create'] = '1';
                            }else if($value == 'update'){
                                $form['update'] = '1';
                                $form['read'] = '1';
                            }else if($value == 'read'){
                                $form['read'] = '1';
                            }else if($value == 'delete'){
                                $form['read'] = '1';
                                $form['delete'] = '1';
                            }
                            else{
                                $form[$value] = '1';
                            }
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $form)){
					$form[$value] = '0';
				}
			}
		}else{
			foreach($perms as $key=>$value){
				$form[$value] = '0';
			}
		}
                $this->insert_or_update_permissions_table($role['role_id'],'6',$form);

        /* Location Permission */
        if($role['location']){
            foreach($role['location'] as $key=>$value){
                if($value == 'create'){
                   // $form['update'] = '1';
                    $location['read'] = '1';
                    $location['create'] = '1';
                }else if($value == 'update'){
                    $location['update'] = '1';
                    $location['read'] = '1';
                }else if($value == 'read'){
                    $location['read'] = '1';
                }else if($value == 'delete'){
                    $location['read'] = '1';
                    $location['delete'] = '1';
                }
                else{
                    $location[$value] = '1';
                }
            }
            foreach($perms as $key=>$value){
                if(!array_key_exists($value, $location)){
                    $location[$value] = '0';
                }
            }
        }else{
            foreach($perms as $key=>$value){
                $location[$value] = '0';
            }
        }
        $this->insert_or_update_permissions_table($role['role_id'],'10',$location);
        /* Update Review Permission */
        if($role['review']){
            $review['create'] = '1';
            $review['read'] = '1';
            $review['update'] = '1';
            $review['delete'] = '1';
        }else{
            $review['create'] = '0';
            $review['read'] = '0';
            $review['update'] = '0';
            $review['delete'] = '0';
        }
        $this->insert_or_update_permissions_table($role['role_id'],'12',$review);
		/* Update Organization Permission */
		if($role['organization']){
			foreach($role['organization'] as $key=>$value){
                            if($value == 'create'){
                                //$organization['update'] = '1';
                                $organization['read'] = '1';
                                $organization['create'] = '1';
                            }else if($value == 'update'){
                                $organization['update'] = '1';
                                $organization['read'] = '1';
                            }else if($value == 'read'){
                                $organization['read'] = '1';
                            }else if($value == 'delete'){
                                $organization['read'] = '1';
                                $organization['delete'] = '1';
                            }
                            else{
                                $organization[$value] = '1';
                            }
			}
			foreach($perms as $key=>$value){
				if(!array_key_exists($value, $organization)){
					$organization[$value] = '0';
				}
			}
		}else{
			foreach($perms as $key=>$value){
				$organization[$value] = '0';
			}
		}
                $this->insert_or_update_permissions_table($role['role_id'],'8',$organization);
		
		return true;

	}
	public function role_delete($role_id){
		/* Delete Roles Permission table*/
		//$this->db->where('role_id', $role_id);
		//$this->db->delete('roles_permissions');
                /* Update user roles to 0 */
          //      $this->db->where('user_role_id',$role_id);
            //    $this->db->set('user_role_id','0');
             //   $this->db->update('users');
                /* Delete From Roles table */
                $this->db->where('role_id',$role_id);
                $this->db->delete('roles');
                return true;
	}
	public function role_info($role_id){
                $org_id = $this->session->userdata('org_id');
		$this->db->select('r.role_id,r.uuid,r.role_name,r.role_desc,r.default,r.organiser_id,r.status,r.created_by')
				->from('roles r')
				->where('r.role_id = '.$role_id)
                                //->where('r.role_id <> 1')
                                ->where('r.organiser_id = '.$org_id);
		$res = $this->db->get();
		$row = $res->row();
                /* Country Permission */
                if($row->organiser_id == 1){
                    /* Only form pro Super admin can have permission to show country and domain */
                    $row->country = $this->role_country_permission($role_id,$org_id);
                    $row->domain = $this->role_domain_permission($role_id,$org_id);
                }
                /* Department */
		$row->department = $this->role_department_permission($role_id,$org_id);
                /* Category Permission */
		$row->category = $this->role_category_permission($role_id,$org_id);
                /* User */
		$row->user = $this->role_user_permission($role_id,$org_id);
                /* Role */
		$row->role = $this->role_role_permission($role_id,$org_id);
                /* Forms */
		$row->forms = $this->role_form_permission($role_id,$org_id);
                /* Reviews */
        $row->review = $this->role_review_permission($role_id,$org_id);
                /* Organizations */
		$row->organizations = $this->role_organization_permission($role_id,$org_id);

        $row->location = $this->role_location_permission($role_id,$org_id);
		return $row;

	}
	public function role_country_permission($role_id,$org_id){

		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('roles_permissions p')
                                ->join('roles_category_type rc','rc.roles_category_type_id = p.roles_category_type_id')
                                ->join('roles r','r.organiser_id = '.$org_id)
				->where('rc.name ="country" AND p.role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();		
	}
	public function role_domain_permission($role_id,$org_id){
		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('roles_permissions p')
                                ->join('roles_category_type rc','rc.roles_category_type_id = p.roles_category_type_id')
                                ->join('roles r','r.organiser_id = '.$org_id)
				->where('rc.name ="domain" AND p.role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();
	}
    public function role_location_permission($role_id,$org_id){
        $this->db->select('p.create,p.read,p.update,p.delete')
                ->from('roles_permissions p')
                ->join('roles r','r.role_id = p.role_id')
                ->join('roles_category_type rc','rc.roles_category_type_id = p.roles_category_type_id')
                ->where('rc.roles_category_type_id = 10 AND p.role_id ='.$role_id.' AND r.organiser_id = '.$org_id);
        $res = $this->db->get();
        return $res->row_array();
    }
	public function role_department_permission($role_id,$org_id){

		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('roles_permissions p')
                ->join('roles_category_type rc','rc.roles_category_type_id = p.roles_category_type_id')
                ->join('roles r','r.organiser_id = '.$org_id)
				->where('rc.name ="department" AND p.role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();		
	}
	public function role_category_permission($role_id,$org_id){
		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('roles_permissions p')
                ->join('roles_category_type rc','rc.roles_category_type_id = p.roles_category_type_id')
                ->join('roles r','r.organiser_id = '.$org_id)
				->where('rc.name ="category" AND p.role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();
	}
	public function role_role_permission($role_id,$org_id){

		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('roles_permissions p')
                ->join('roles_category_type rc','rc.roles_category_type_id = p.roles_category_type_id')
                ->join('roles r','r.organiser_id = '.$org_id)
				->where('rc.name ="roles" AND p.role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();		
	}
	public function role_user_permission($role_id,$org_id){
		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('roles_permissions p')
                ->join('roles_category_type rc','rc.roles_category_type_id = p.roles_category_type_id')
                ->join('roles r','r.organiser_id = '.$org_id)
				->where('rc.name ="users" AND p.role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();
	}
	public function role_form_permission($role_id,$org_id){

		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('roles_permissions p')
                ->join('roles_category_type rc','rc.roles_category_type_id = p.roles_category_type_id')
                ->join('roles r','r.organiser_id = '.$org_id)
				->where('rc.name ="forms" AND p.role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();		
	}
    public function role_review_permission($role_id,$org_id){

        $this->db->select('p.create,p.read,p.update,p.delete')
                ->from('roles_permissions p')
                ->join('roles_category_type rc','rc.roles_category_type_id = p.roles_category_type_id')
                ->join('roles r','r.organiser_id = '.$org_id)
                ->where('rc.name ="Reviews" AND p.role_id ="'.$role_id.'"');
        $res = $this->db->get();
        return $res->row_array();       
    }
	public function role_organization_permission($role_id,$org_id){
		$this->db->select('p.create,p.read,p.update,p.delete')
				->from('roles_permissions p')
                ->join('roles_category_type rc','rc.roles_category_type_id = p.roles_category_type_id')
                ->join('roles r','r.organiser_id = '.$org_id)
				->where('rc.name ="organization" AND p.role_id ="'.$role_id.'"');
		$res = $this->db->get();
		return $res->row_array();
	}
	public function role_list($org_id = ''){
        
        if($org_id == ''){
            $org_id =$this->session->userdata('org_id');
        }
        if($org_id != 1){
            $this->db->where('r.organiser_id',$org_id);
        }    
        
		$this->db->select('r.role_id,r.uuid,r.role_name,r.role_desc,r.default,r.status,r.created_by,r.organiser_id,o.org_name')
			     ->from('roles r')
                 ->join('organization o','o.id = r.organiser_id')
                 ->where('r.role_id != 1');
		$res = $this->db->get();
        //echo $this->db->last_query();exit;
		return $res->result_array(); 
	}
        
        public function insert_or_update_permissions_table($role_id,$category_type,$array=array()){
             $this->db->select('')->from('roles_permissions')->where('role_id',$role_id)->where('roles_category_type_id',$category_type);
                $cols = $this->db->get();
                if($cols->num_rows()){
                    $this->db->where('role_id',$role_id);
                    $this->db->where('roles_category_type_id',$category_type);
                    $this->db->update('roles_permissions',$array);
                }
                else{
                    $array['roles_category_type_id'] = $category_type;
                    $array['role_id'] = $role_id;
                    $this->db->insert('roles_permissions',$array);
                }
            
        }
	
	public function get_role_permission($role_id){

		$this->db->select('permission_id')
				  ->from('roles_permissions')
				  ->where('role_id',$role_id);

		$result = $this->db->get();
		$selected_permission = array();
		foreach($result->result_array() as $key=>$value){

			$selected_permission[] = $value['permission_id'];

		}
		return $selected_permission;

	}
    public function check_role_exists($uuid){
        $this->db->select('role_id')->from('roles')->where('uuid',$uuid);
        $role_id = $this->db->get()->row('role_id'); 
        if($role_id){
            return $role_id;
        }
        else{
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
        //echo $this->db->last_query();exit;
        foreach($roles as $key=>$value){
            $role_id[] = $value['role_id'];
        }
        return $role_id;
    }
    public function role_users_list($role_id){
        $this->db->select('u.uuid,u.id,CONCAT_WS(" ",u.firstname,u.lastname) as name,u.user_role_id')
                 ->from('users u')
                 ->where_in('u.user_role_id',$role_id)
                 ->where('u.activation = 1');
        $list = $this->db->get()->result_array();
        $role_user = array();
        foreach($list as $key=>$value){
            $role_user[$value['user_role_id']][$value['uuid']] = $value['name']; 
        }
        return $role_user;
    }
}
