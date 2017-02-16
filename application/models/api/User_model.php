<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FormBuilder_model
 *
 * An easy form generator for the CodeIgniter framework
 * 
 * @package   FormPro
 * @version   0.8
 * @author    Rajeshkannan Chandrasekar
 * @copyright Copyright (c) 2011, Ollie Rattue
 * @license   http://www.opensource.org/licenses/mit-license.php
 * @link      http://github.com/ollierattue/FormIgniter
 * @link	  http://formigniter.org
 */

class User_model extends CI_Model 
{	
	
	public function login($username,$password){

		
		$this->db->select('u.*,o.org_name')
			  ->from('users as u')
			  ->join('organization o','o.id = u.org_id')
			  ->where('u.email = "'.$username.'" and u.password = "'.md5($password).'" and u.block = 0');
							   
		$result = $this->db->get();
			
		if($result->num_rows()){			

			$data = $result->result_array();
			
			$data['msg'] = 'success';
			
			return $data;
		}
							   
		else{
			
			$data['msg']  = 'Fail';	
			
			return $data;
			
		}
							   
	}

	public function checkpassword_reset($password){

		$this->db->select('f.*')

			->from('user_forgot_reset_pwd as f')

			->where('f.reset = "'.base64_encode($password).'"');

		$check = $this->db->get();

		if($check->num_rows()){
			
		     $datas = $check->result_array();

		     if($datas[0]['active']){
			
				 $data['msg'] = '1'; // link active set

				 $data['email'] = $datas[0]['email'];

				 return $data; 
			    
                      }
			else{ 
				/* Mailed link is not activated */

				$data['msg'] = '2'; // Link not activated

				return $data;

			}
		
		}

		$data['msg'] = 0;

		return $data;

	}

	public function reset_pwd($email,$password){
	
		$this->db->set('password' , md5($password));
		$this->db->set('lastResetTime',gmdate('Y-m-d H:i:s',time()));
		$this->db->where('email',$email);
		$this->db->update('users');
		/* Once Password is Resetted delete the records from user forgot reset table */
		$this->db->where('email = "'.$email.'"');
		$this->db->delete('user_forgot_reset_pwd');
		/* Get User details with the resetted password. */
		$this->db->select('u.*,o.org_name')
			->from('users as u')
			  ->join('organization o','o.id = u.org_id')
			->where('email = "'.$email.'" and password = "'.md5($password).'"');
		$result = $this->db->get();
		if($result->num_rows()){			
			$data = $result->result_array();
			$data['msg'] = 'success';
			return $data;
		}
		else{
			$data['msg']  = 0;	
			return $data;
		}		
	}

	/* Insert record into appapi table 

		Parameters are token id and user id

	*/
	
	public function app_api($token,$id,$action = 'insert'){

		$data = array('token' => $token,'created_time' => date('Y-m-d H:i:s'),'modified_time' => date('Y-m-d H:i:s'));

		if($action == 'update'){

			$this->db->where('user_id',$id);

			return $this->db->update('appapi',$data);

		}
		else{
		
			$data['user_id'] = $id;
		
			return $this->db->insert('appapi',$data);

		}
		
	}

	public function user_app_check($id){

		$this->db->select("a.*")

				->from('appapi as a')

				->where('a.user_id = "'.$id.'"');
	 
		$result = $this->db->get();

		if($result->num_rows()){

			$res = $result->result_array();

			$currentdatetime = date("Y-m-d H:i:s");

			$to_time = strtotime($currentdatetime);

			$mod_time = strtotime($res[0]['modified_time']);

			$timeout = $this->config->item('user_timeout');
			//echo $timeout;exit;
	
			$diff_time = round(abs($to_time - $mod_time) / 60,0);

			if($diff_time >= $timeout){

				$token = md5(time().' '.$id);

				if($this->app_api($token,$id,'update')){

					return $token;

				}
				else{

					return false;

				}
			}
			else{
                   return $res[0]['token'];

			}

		}

		return false;

	}

	public function user_check($token,$id)
	{
		//$static_role = '1','2','3','4';

	   $this->db->select('u.*')
		    ->from('users as u')
		    ->where('id = '.$id);
		    //->where('static_role NOT IN ("1","2","3","4")');
	   $result = $this->db->get();
	   if($result->num_rows())
	   {

	
		$this->db->select("a.*")
			 ->from('appapi as a')
                         ->where('a.token = "'.$token.'"');
	 

		$result = $this->db->get();

		if($result->num_rows())
		{

			$currentdatetime = date("Y-m-d H:i:s");

			$to_time = strtotime($currentdatetime);

			foreach($result->result_array() as $v){

				$from_time = strtotime($v['modified_time']);
				$timeout = $this->config->item('user_timeout'); 
				//echo $timeout; exit;
				$diff_time = round(abs($to_time - $from_time) / 60,0);
				/*if($diff_time >= $timeout){
					$this->db->delete('appapi',array('id' => $v['id'],'token' => $v['token'])); 		
					$data['msg'] = 'failure';

					return $data;

				}

				$this->db ->where('id = '.$v["id"])
						->update('appapi',array('modified_time' => $currentdatetime));	 */
				$data['msg'] = 'success';
				
				return $data;
			}
		}else{

			$data['msg'] = 'failure';

			return $data;

		}
	     }
	     else
	     {

			$data['msg'] = 'Invalid';

			return $data;

	     }
	  

	}

	/* Updates user Data */

	public function update_profile($userid,$imgname){

		$this->db->set('imgname',$imgname);

		$this->db->set('updatedDate',gmdate(date('Y-m-d h:i:s'),time()));

		$this->db->where('id = '.$userid);

		$this->db->update('users');
		
		if($this->db->affected_rows()){
			
			return 1;
		}

		else{

			return 0;

		}

	}

	/* Function For returns user Roles */

	public function user_roles($id){

	 	$this->db->select('u.*,')

	 			 ->from('usergroups as u')

	 			 ->join('user_usergroup_map as ua','ua.user_id = '.$id.' AND ua.group_id = u.id');

	 	$result = $this->db->get();

	 	foreach($result->result_array() as $v){

	 		$data['id']= $v['id'];

	 		$data['title'] =$v['title'];

	 	}

	 	return $data;

	}

	/* Check form has accessible to the users */
	public function access($formid,$id){

		$this->db->select('f.id')

				 ->from('forms as f')

				 ->where('f.id = '.$formid.' And f.created_by = '.$id);

		$result = $this->db->get();

		if($result->num_rows()){

			return true;

		}
		else{

			return false;
		}

	}

	/* User Data */

	public function user_data($id)
	{

		$this->db->select('a.*')
			 ->from('users as a')
			 ->where('a.id = '.$id);

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			
			$user_query = $query->result_array();
			$this->db->select('O.id as org_id,O.org_name,O.org_logo,D.domain_name as org_domain_name,u.id')
				->from('organization as O')
                                ->join('org_location ol','ol.org_id = O.id')
				->join('users u','u.user_org_loc_id = ol.id')
				->join('org_domain as ODM','ODM.org_location_id = ol.id')
				->join('domain as D','D.domain_id = ODM.domain_id')
				->where('u.id = '.$id);

			$query1 = $this->db->get();
			$org_query = $query1->result_array();

			$orgs = array();
			foreach($org_query as $key=>$value)
			{

				$orgs[$key]['org_id'] = $value['org_id'];


				$orgs[$key]['org_name'] = $value['org_name'];

				$orgs[$key]['org_logo'] = $value['org_logo'];
				$orgs[$key]['org_domain_name'] = $value['org_domain_name'];
				

				$this->db->select('D.dept_id,D.dept_name')
				->from('organization as O')
				->join('org_domain_map as ODM','ODM.org_id = O.id')
				->join('org_department_map as ODE','ODM.id = ODE.domain_map_id')
				->join('department as D','D.dept_id = ODE.dept_id')
				->where('ODM.org_id = '.$value['org_id']);

				$query2 = $this->db->get();
				$org_dept_query = $query2->result_array();
				$orgs[$key]['org_department'] = $org_dept_query;


				$this->db->select('F.form_id,F.form_name')
				->from('form_details as F')
				->join('user_form as UF','UF.form_id = F.form_id')
				->where('UF.user_id = '.$value['user_id']);

				$query3 = $this->db->get();
				$org_user_query = $query3->result_array();
				$orgs[$key]['user_form'] = $org_user_query;
				foreach($org_user_query as $key1=>$value1)
				{
				
					$this->db->select('C.cat_id,C.category_name,C.parent,C.created_at,C.updated_at,C.	category_desc')
					->from('category as C')
					->join('form_category as FC','FC.cat_id = C.cat_id')
					->where('FC.form_id = '.$value1['form_id']);

					$query4 = $this->db->get();
					$org_form_cat_query = $query4->result_array();

					foreach($org_form_cat_query as $key2 => $value2)
					{

					$list['cat_id'] = $value2['cat_id'];
					$list['category_name'] = $value2['category_name'];
					$list['category_desc'] = $value2['category_desc'];
					if($value2['parent'] == 1){
						$list['isRoot'] = 1;
						$list['parentCategoryId'] = 0;
					}
					else{
						$list['isRoot'] = 0;
						$list['parentCategoryId'] = $value2['parent'];
					}
					$list['createdDate'] = $value2['created_at'];
					$list['updatedDate']  = $value2['updated_at'];
					}
					$orgs[$key]['user_form'][$key1]['form_category'] =$list;	

				}
				
				

				

				
			}

			//$orgs['org_department'] = $org_dept_query;

			$all_values['user_query'] =  $user_query;
			$all_values['org_query'] =  $orgs;
			//echo '<pre>';
			//print_r($all_values);exit;
			return $all_values;

		}
		else
		{

			return 0;

		}

	}

	public function user_image($user_id,$org_id){
		$this->db->select('u.imgname,u.firstname')
				->from('users u')
				->join('organization o','o.id = u.org_id')
				->where('u.id', $user_id)
				->where('o.id',$org_id);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			return $res->row();
		}
		else{
			return false;
		}
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

	/* Forgot Password */

	public function verify_email($email){
	
		$this->db->select('a.firstname')

		      ->from('users as a')

		      ->where('a.email ="'.$email.'"');

		$query = $this->db->get();

		if($query->num_rows() > 0){

			$result = $query->result_array();

			$this->db->set('password',md5(time()));

			$this->db->where('email ="'.$email.'"');

			$this->db->update('users');

			return $result[0]['firstname'];
					
		}
		else{

			return 0;

		}

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

		//return  $id;

	}
	public function user_profile($user_id){
		$this->db->select('CONCAT_WS(" ",u.firstname,u.lastname) as name,u.user_role_id as role_id,u.imgname as profile,o.org_name as organization_name,u.email')
			->join('organization o','o.id = u.org_id')
			->from('users u')
			->where('u.id = '.$user_id);
		$res = $this->db->get()->result_array();
		//echo $this->db->last_query();
			// ->join('organization o','o.id = u.user_org_loc_id')
		$role_id = $res[0]['role_id'];
		/*
			permission info
			6  - forms
			11 - reports
			12 - reviews
		*/
/*
		$this->db->select('rp.create,rp.read,rp.update,rp.delete')
				 ->from('roles_permissions')
				 ->where('rp.role_id = '.$role_id.' and rp.roles_category_type = 6');
		$forms = $this->db->get();*/

		$this->db->select('rp.create,rp.read,rp.update,rp.delete')
				 ->from('roles_permissions rp')
				 ->where('rp.role_id = '.$role_id.' and rp.roles_category_type_id = 11');
		$reports = $this->db->get()->row();
		if($reports->read === '1'){
			$reports_permission = '1';
		}else{
			$reports_permission = '0';
		}

		$this->db->select('rp.create,rp.read,rp.update,rp.delete')
				 ->from('roles_permissions rp')
				 ->where('rp.role_id = '.$role_id.' and rp.roles_category_type_id = 12');
		$reviews = $this->db->get()->row();
		if($reviews->read === '1'){
			$reviews_permission = '1';
		}else{
			$reviews_permission = '0';
		}
		$profile = new StdClass();
		foreach($res as $key=>$value){
			$profile->name =$value['name'];
			$profile->profile =$value['profile'];
			$profile->organization_name =$value['organization_name'];
			$profile->reports_permission = $reports_permission;
			$profile->reviews_permission = $reviews_permission;
		}
		return $profile;
	}
	
}
