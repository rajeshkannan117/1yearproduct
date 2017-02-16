<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * This is Version1 Model of Vanderlande Webservice
 *
 * @package	CodeIgniter
 * @category	User
 * @author	Saravanan
 * @link	http://innoppl.com/
 *
 */
class Webservice_model extends CI_Model
{
	public function __construct()
	{
		date_default_timezone_set ("America/New_York");
		$this->load->database();
		$this->load->helper('date');
	}

	public function check_login($data)
	{
		
		$this->db->select('us.id as user_id,us.name as name,us.imgname as profilepic,us.email,us.static_role,os.	org_id');
		$this->db->from('users as us');
		$this->db->join('org_users as os','us.id = os.user_id','left');
		$this->db->where('email',trim($data['email']));
		$this->db->where('password',trim(md5($data['password'])));
		$query = $this->db->get ();
		
			
		if ($query->num_rows () > 0) {

			$row = $query->result_array();
			$user_id = $row[0]['user_id'];

			
			$static_role = $row[0]['static_role'];
			if($static_role != 0)
			{
				$org_id = 0;
			}
			else
			{
				$org_id = $row[0]['org_id'];
			}
			$user_details=array('user_id'=> $row[0]['user_id'],
    					    'name'=>$row[0]['name'], 
    					    'email'=>$row[0]['email'],
					    'org_id' => $org_id,
    					    'profilepic'=>$row[0]['profilepic'],
					    'static_role' => $row[0]['static_role'],
    					    'logged_in'=>true);

			//print_r($user_details); exit;
			if($static_role != 0)
			{
				$menu = array();
				
				if($static_role == '1')
				{
					$result = array('country','domain','department','category','roles','organizations','forms','users');
					//$menu = array();
					foreach($result as $k=>$v)
					{
						$menu[$v][]= 'create';
						$menu[$v][]= 'read';
						$menu[$v][]= 'update';
						$menu[$v][]= 'delete';
					}
					//print_r($menu); exit;
				}
				if($static_role == '2')
				{
					$result = array('country','domain','department','category','roles');
					foreach($result as $k=>$v)
					{
						$menu[$v][]= 'create';
						$menu[$v][]= 'read';
						$menu[$v][]= 'update';
						$menu[$v][]= 'delete';
					}
				}
				if($static_role == '3')
				{
					$result = array('organizations','users');
					foreach($result as $k=>$v)
					{
						$menu[$v][]= 'create';
						$menu[$v][]= 'read';
						$menu[$v][]= 'update';
						$menu[$v][]= 'delete';
					}
				}
				if($static_role == '4')
				{
					$result = array('organizations');
					foreach($result as $k=>$v)
					{
						$menu[$v][]= 'create';
						$menu[$v][]= 'read';
						$menu[$v][]= 'update';
						$menu[$v][]= 'delete';
					}
			    }
			}
			else
			{
				$result = $this->check_roles($user_id);
				//print_r($result); exit;
				$menu = array();

				foreach($result as $k=>$v)
				{

					if($v['create'] == 1 || $v['update'] == 1  || $v['read'] == 1  || $v['delete'] == 1 )
					{
						if($v['create'] == 1)
						{
							$menu[$v['type']][]= 'create';
						}
						if($v['read'] == 1)
						{
							$menu[$v['type']][] = 'read';
						}
						if($v['update'] == 1)
						{
							$menu[$v['type']][] = 'update';
						}
						if($v['delete'] == 1)
						{
							$menu[$v['type']][] ='delete';
						}
					
					}
				
				}
			}
			//echo '<pre>';
			//print_r($menu);exit;
			$user_details['menu'] = $menu;
			$this->db->set('lastvisitDate',gmdate(date("Y-m-d H:i:s")));
			$this->db->where('id = '.$row[0]['user_id']);
			$this->db->update('users');
			return $user_details;

		} else {

			return false;
		}
	}
	public function check_roles($user_id)
	{

		$this->db->select('p.*');
		$this->db->from ('org_users ou');
		$this->db->join('org_user_department oud','oud.user_map_id = ou.id');
		$this->db->join('permissions p','p.role_id = oud.role_id');	
		$this->db->where('ou.user_id',$user_id);
		//echo $user_id;
		
		$query1 = $this->db->get();
		//print_r($this->db); exit;
		if ($query1->num_rows () > 0) {

		$result = $query1->result_array();
		
		} else {
			$result = array();
		}
		return $result;

	}
	/* Check user is from management or not */
	public function check_manager($user_id){

		$this->db->select('mu.name')
				->from('management_user as mu')
				->join('management_user_mapping as m','m.manage_id = mu.id AND m.user_id = '.$user_id);

		$res = $this->db->get();

		if($res->num_rows() > 0){
			$result['type']= 'manager';
			$result['name']= $res->row()->name;
			return $result;

		}else{

			/* Check from organization user */
		}
	}

	/* Country Models */

	public function getcountrylist($data){

		$this->db->select('co.loc_id, co.country_name, co.created_at, co.updated_at, co.default,co.status');
		$this->db->from ('location co');
		$this->db->where('co.status','1');
		$query = $this->db->get();

		if ($query->num_rows () > 0) {

			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}

	}

	public function getdefaultcountry($data){

		$this->db->select('co.loc_id');
		$this->db->from ('location co');
		$this->db->where('co.status','1');
		$this->db->where('co.default','1');
		$query = $this->db->get();
		//print_r($this->db);
		if ($query->num_rows () > 0) {

			$result = $query->result_array();
			return $result;

		} else {
			return false;
		}

	}
	public function country_add($posts){
		
		$post = $posts['data'];
		
		$country = array(
				'country_name'=>trim($post['country_name']),
				'default'=> $post['default'],
				'status'=>'1',
				'created_at'=>date("Y-m-d H:i:s"),
				'updated_at'=>date("Y-m-d H:i:s"),
				'created_by'=>$post['created_by']
				);
		$this->db->insert('location',$country);
		$loc_id = $this->db->insert_id();
		//print_r($country); exit;
		return true;
	}

	public function country_edit($post){

		//$country_detail = array('country_name' => $post['country_name'], 'default' => $post['default'], 'updated_at' => date("Y-m-d H:i:s"));
		if(isset($post['default'])){
			$this->db->set('default',$post['default']);
		}
		if(isset($post['status'])){
			$this->db->set('status',$post['status']);
		}
		$this->db->set('country_name',$post['country_name']);
		$this->db->set('updated_at' , date("Y-m-d H:i:s"));
		$this->db->where('loc_id', $post['loc_id']);
		$this->db->update('location');

		return true;

	}

	public function get_country_info($loc_id){

		$this->db->select('co.country_name,co.loc_id,co.default,co.status');
		$this->db->from ('location co');
		$this->db->where('co.loc_id', $loc_id);
		$query = $this->db->get();
		if ($query->num_rows () > 0) {
			$result_country = $query->result_array();
			return array('country'=>$result_country['0']);
		} else {
			return false;
		}
	}

	public function country_delete($data)
	{

		$this->db->set('status','0');
		$this->db->where('loc_id', $data['loc_id']);
		$this->db->update('location');

	}

	/* Domain Models */

	public function domain_add($posts){
		$post = $posts['data'];
		$domain = array(
				'domain_name'=>trim($post['domain_name']),
				'domain_desc'=>trim($post['domain_desc']),
				'default'=> $post['default'],
				'status'=>'1',
				'created_at'=>date("Y-m-d H:i:s"),
				'updated_at'=>date("Y-m-d H:i:s"),
				'created_by'=>$post['created_by']
				);
		$this->db->insert('domain',$domain);
		$domain_id = $this->db->insert_id();
		foreach($post['countries'] as $key=>$value){

			$mapping = array('domain_id'=>$domain_id,'country_id'=>$value);

			$this->db->insert('domain_country_mapping',$mapping);	

		}

	}

	public function domain_list($post){

		$this->db->select('do.domain_id,do.domain_name,do.domain_desc,do.status,do.default');
		$this->db->from ('domain do');
		//$this->db->join('domain_country_mapping do_ma','do_ma.domain_id = do.domain_id','left');
		//$this->db->join('location co','co.loc_id = do_ma.country_id','left');
		$this->db->where('do.status', '1');
		$query = $this->db->get();
		//print_r($this->db);
		if ($query->num_rows () > 0) {
			$result_country = $query->result_array();
			return $result_country;
		} else {
			return false;
		}
		print_r($result_country);exit;

	}
	public function get_domain_info($domain_id){
		$this->db->select('do.domain_id,do.domain_name,do.status,co.country_name,do.domain_desc,do_ma.country_id,do.status,do.default');
		$this->db->from ('domain do');
		$this->db->join('domain_country_mapping do_ma','do_ma.domain_id = '.$domain_id,'left');
		$this->db->join('location co','co.loc_id = do_ma.country_id','left');
		$this->db->where('do.status', '1');
		$this->db->where('do.domain_id',$domain_id);

		$query = $this->db->get();
		if ($query->num_rows () > 0) {
			$result_domain = $query->result_array();
			return array('domain'=>$result_domain);
		} else {
			return false;
		}
	}  

	public function domain_name($domain_id){
		$this->db->select('do.domain_name');
		$this->db->from ('domain do');
		$this->db->where('do.domain_id',$domain_id);
		$query = $this->db->get();
		if ($query->num_rows () > 0) {
			$result_domain = $query->row()->domain_name;
			return array('domain_name'=>$result_domain);
		} else {
			return false;
		}	
	}

	public function getdefaultdomaincountry($country_id){

		$this->db->select('d.domain_id')
				 ->from('domain_country_mapping d')
				 ->join('domain do_ma','do_ma.domain_id = d.domain_id AND do_ma.default = 1','LEFT')
				 ->where('d.country_id ='.$country_id);
		//print_r($this->db); exit;
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return array('default_domain'=>$query->row()->domain_id);
		}else{
			return false;
		}

	}

	public function domain_update($posts,$countries){
		$post = $posts['data'];
		if(isset($post['default'])){
			$this->db->set('default',$post['default']);
		}
		if(isset($post['status'])){
			$this->db->set('status',$post['status']);
		}
		$this->db->set('domain_name',$post['domain_name']);
		$this->db->set('domain_desc',$post['domain_desc']);
		$this->db->set('updated_at' , date("Y-m-d H:i:s"));
		$this->db->where('domain_id', $post['domain_id']);
		$this->db->update('domain');
		foreach($post['countries'] as $key=>$value){

			if(in_array($value,$countries)){

				$delete[] = $value;

			}
			else{
				$this->db->insert('domain_country_mapping',array('domain_id'=>$post['domain_id'],'country_id'=>$value));
			$delete[] = $value;

			}

		}

		if(count($delete) > 0){
			$delete_id = implode(",", $delete);
			//echo 'DELETE FROM domain_country_mapping where domain_id ='.$post["domain_id"].' AND `country_id` NOT IN ('.$delete_id.')'; exit;
			$this->db->query('DELETE FROM domain_country_mapping where domain_id ='.$post["domain_id"].' AND `country_id` NOT IN ('.$delete_id.')');

		} 

		return true;

	}

	public function domain_delete($data){

		$this->db->set('status','0');
		$this->db->where('domain_id', $data['domain_id']);
		$this->db->update('domain');

	}

	/* Department Model */

	public function department_add($posts){
		$post = $posts['data'];
		//print_r($post); exit;
		$department = array('dept_name'=>trim($post['dept_name']),
						'dept_desc'=>trim($post['dept_desc']),
						'default'=> $post['default'],
						'status'=>'1',
						'created_at'=>date("Y-m-d H:i:s"),
						'updated_at'=>date("Y-m-d H:i:s"),
						'created_by'=>$post['created_by']
					);
		
		
		foreach($post['domain'] as $key=>$value){

			$this->db->insert('department',$department);
			$dept_id = $this->db->insert_id();


			//echo $this->domain_country($value,$post['countries']); exit;
			if(!$this->domain_country($value,$post['countries'])){
				$this->db->insert('domain_country_mapping',array('domain_id'=>$value,'country_id'=>$post['countries']));
				$domain_map_id = $this->db->insert_id();
			}else{
				$domain_map_id = $this->domain_country($value,$post['countries']);
				//echo $domain_map_id; exit;
			}
			$this->db->insert('department_mapping',array('dept_id'=>$dept_id,'domain_map_id'=>$domain_map_id));			

		}


	}

	public function department_list($post){

		
		//print_r($_SESSION); exit;
		if($post['org_id']){	
			$this->db->select('de.dept_id,de.dept_name,de.dept_desc,de.status,de.created_by,d.domain_name,dc_ma.id,or_loc.country,loc.country_name');
		$this->db->from('organization or');
		$this->db->join('org_location or_loc','or_loc.org_id = or.id','left');
		$this->db->join('location loc','loc.loc_id = or_loc.country','left');
		$this->db->join('org_domain_map dc','dc.org_id = or.id','left');
		$this->db->join('org_department_map dc_ma','dc_ma.domain_map_id = dc.id','left');
		$this->db->join('department de','de.dept_id = dc_ma.dept_id','de.status = 1');
		$this->db->join('domain d','d.domain_id = dc.domain_id','left');
		$this->db->where('or.id',$post['org_id']);

		}
		else{
			$user_id = $post['user_id'];
			$this->db->distinct();
			$this->db->select('de.dept_id,de.dept_name,de.dept_desc,de.created_by,de.status,dc_ma.default,d.domain_name,dc_ma.id,dc.country_id,loc.country_name');
			$this->db->from ('department de');
			$this->db->join('department_mapping dc_ma','dc_ma.dept_id = de.dept_id','left');
			$this->db->join('domain_country_mapping dc','dc_ma.domain_map_id = dc.id','left');
			$this->db->join('domain d','d.domain_id = dc.domain_id','left');
			$this->db->join('location loc','loc.loc_id = dc.country_id','left');
			//$this->db->group_by('de.dept_id');
			$this->db->where('de.created_by = '.$user_id);

		}
		//$this->db->join('department_country_mapping dc_ma','dc_ma.dept_id = de.dept_id','left');
		//$this->db->join('location co','co.loc_id = do_ma.country_id','left');
		//$this->db->where('de.status', '1');
		$query = $this->db->get();
		//print_r($this->db); exit;
		if ($query->num_rows () > 0) {
			$result_dept = $query->result_array();
			//print_r($result_dept); exit;
			return $result_dept;
		} else {
			return false;
		}

	}



	/*

		Function : domain_department
		Params : domain id
		Returns : department details as array
		Description: Function returns the department info based on the domain id

	*/

	public function domain_department($domain_id){

		$this->db->select('d.dept_id,do.dept_name');
		$this->db->from('department_domain_mapping dd');
		$this->db->join("department as d",'d.domain_id = dd.domain_id','left');	
		$this->db->where('dd.domain_id ='.$domain_id);
		$result = $this->db->get();
		return $result->result_array();

	}

	



	public function get_department_info($dept_id){
		$this->db->select('de.dept_id,de.dept_name,de.dept_desc,de.default,de.status,do_cm.country_id,do_cm.domain_id');
		$this->db->from ('department de');
		$this->db->join('department_mapping de_cm','de_cm.dept_id = de.dept_id','left');
		$this->db->join('domain_country_mapping do_cm','do_cm.id = de_cm.domain_map_id ','left');
		$this->db->where('de.status', '1');
		$this->db->where('de.dept_id',$dept_id);
		$query = $this->db->get();		
		if ($query->num_rows () > 0) {
			$result_department = $query->result_array();
			/* get Country Domain */
			$department = array('department'=>$result_department);
			
			/* Returns Domain for the country */

			$department['domain']=$this->country_domain($result_department[0]['country_id']);
			/* Returns domain_id for the department */
			foreach($result_department as $key=>$value){
				$sel[] = $value['domain_id'];	
			}	
			$department['selected_domain'] = $sel;		
			//print_r($department); exit;
			return $department;

		} else {
			return false;
		}
	}
	public function country_domain($country_id){

		$this->db->select('d.domain_id,do.domain_name');
		$this->db->from('domain_country_mapping d');
		$this->db->join("domain as do",'do.domain_id = d.domain_id','left');	
		$this->db->where('d.country_id ='.$country_id);
		$result = $this->db->get();
		return $result->result_array();

	}


	/* Returns Country id for the corresponding Department*/
	public function department_country($dept_id){

		$this->db->distinct()
					->select('do_cm.country_id')
					->from('department_mapping d')
					->join('domain_country_mapping do_cm','do_cm.id = d.domain_map_id')
					->where('d.dept_id = '.$dept_id);
		$res = $this->db->get();
		return $res->row()->country_id;

	}
	/* Returns domain id for the corresponding Department*/

	public function department_domain($dept_id){

		$this->db->select('do_cm.domain_id')
					->from('department_mapping d')
					->join('domain_country_mapping do_cm','do_cm.id = d.domain_map_id')
					->where('d.dept_id = '.$dept_id);
		$res = $this->db->get();
		$domain = array();
		foreach($res->result_array() as $key=>$value){
			$domain[] = $value['domain_id'];
		 }
		 return $domain;
	}


	public function department_category($department_id){

		$this->db->select('c.cat_id,c.category_name')
					->from('category c')
					->join('category_mapping cm','cm.cat_id = c.cat_id')
					->where('cm.dept_id = '.$department_id);
		$res = $this->db->get();
		$category = array();
		foreach($res->result_array() as $key=>$value){
			$category[] = $value['cat_id'];
		 }
		 return $category;

	}

	public function department_update($posts){

		$post = $posts['data'];
		if(isset($post['default'])){
			$this->db->set('default',$post['default']);
		}
		if(isset($post['status'])){
			$this->db->set('status',$post['status']);
		}

		/* Update Department Table */

		$this->db->set('dept_name',$post['dept_name']);
		$this->db->set('dept_desc',$post['dept_desc']);
		$this->db->set('updated_at' , date("Y-m-d H:i:s"));
		$this->db->where('dept_id', $post['dept_id']);
		$this->db->update('department');

		/*$this->db->query("delete from department_mapping where dept_id = ".$post['dept_id']);
		foreach($post['domain'] as $key=>$value){
			/* Check domain Already have country */
			/*if(!$this->domain_country($value,$post['countries'])){
				$this->db->insert('domain_country_mapping',array('domain_id'=>$value,'country_id'=>$post['countries']));
				$domain_map_id = $this->db->insert_id();
			}else{
				$domain_map_id = $this->domain_country($value,$post['countries']);
			}
			$this->db->insert('department_mapping',array('dept_id'=>$post['dept_id'],'domain_map_id'=>$domain_map_id));

		}*/
		if(isset($post['domain']) && isset($post['countries'])){

		$domain_map_id = $this->domain_country($post['domain'],$post['countries']);

		$this->db->set('domain_map_id',$domain_map_id);
		$this->db->where('dept_id', $post['dept_id']);
		$this->db->update('department_mapping');
	}

		return true;

	}

	public function domain_country($domain_id,$country_id){

		$do_cu = $this->db->query('Select id from domain_country_mapping where domain_id ='.$domain_id.' and country_id='.$country_id);
		if($do_cu->num_rows() > 0){
			return $do_cu->row()->id;
		}		
		else{
			return false;
		}

	}


	public function department_delete($data){

		$this->db->set('status','0');
		$this->db->where('dept_id', $data['dept_id']);
		$this->db->update('department');

	}

	/* Category Models */

	public function category_list($parent = 0, $spacing = '', $user_tree_array = '') {

		 if (!is_array($user_tree_array))

		  $user_tree_array = array();

		  $sql = "SELECT `cat_id`, `category_name`, `parent`,`status` FROM `category` WHERE 1 AND `parent` = $parent ORDER BY cat_id ASC";

		  $query = $this->db->query($sql);

		  if ($query->num_rows() > 0) {

		    foreach($query->result() as $row) {

		      $user_tree_array[] = array("cat_id" => $row->cat_id,"parent"=>$row->parent,"category_name" => $spacing . $row->category_name,"status" => $row->status);

		      $user_tree_array = $this->category_list($row->cat_id, $spacing . '--', $user_tree_array);

		    }

		  }

		  return $user_tree_array;
	}

	public function get_categories_info($data)
	{
		$this->db->select('c.cat_id,c.status,c.default,c.parent,c.category_name,c.category_desc,ca.dept_id');
		$this->db->from ('category c');
		$this->db->join('category_mapping ca','ca.cat_id=c.cat_id','left');
		//$this->db->where('c.status','1');
		$this->db->where('c.cat_id', $data['data']['category_id']);
		$query = $this->db->get();
		if ($query->num_rows () > 0) {
			$result = $query->result_array();
			$cat_dept = array();
			foreach($result as $key=>$value){
				$cat_dept[] = $value['dept_id'];
			}
			$result['department'] = $cat_dept;
			//print_r($result); exit;
			return $result;
		} else {
			return false;
		}
	}
	public function category_add($data)
	{
	
		$cat_detail = array(
		  		'category_name' => $data['category_name'],
		  		'category_desc' => $data['category_desc'],
		  		'parent' => $data['parent'],
				'default'=> $data['default'],
				'status'=>'1',
				'created_at'=>date("Y-m-d H:i:s"),
				'updated_at'=>date("Y-m-d H:i:s"),
				'created_by'=>$data['created_by']);
		$this->db->insert("category", $cat_detail);
		$cat_id = $this->db->insert_id();
		//print_r($data['department']); exit;
		foreach($data['department'] as $key=>$value){

			$this->db->insert('category_mapping',array('cat_id'=>$cat_id,'dept_id'=>$value));

		}
	
		return true;
	}
	public function category_update($data)
	{		
	
		$cat_detail = array(
		  		'category_name' => $data['category_name'],
		  		'parent' => $data['parent'],
		  		'category_desc' =>$data['category_desc'],
		  		'default'=>$data['default'],
		  		'status' => $data['status']
		  		);
	
		$this->db->where('cat_id',$data['cat_id']);
		$this->db->update('category', $cat_detail);
		$dept = $this->category_department($data['cat_id']);
		foreach($data['department'] as $key=>$value){

			if(in_array($value,$dept)){
					$not_to_delete[] = $value;
			}else{
				$this->db->insert('category_mapping',array('cat_id'=>$data['cat_id'],'dept_id'=>$value));
				$not_to_delete[]= $value;
			}

		}

		if(count($not_to_delete) > 0){
			$not = implode(',',$not_to_delete);
			$this->db->query("Delete FROM category_mapping WHERE cat_id = ".$data['cat_id']." AND dept_id NOT IN (".$not.")");
			//print_r($this->db); exit;
		}
		return true;
	}

	/* Returns corresponding department for the category */

	public function category_department($cat_id){

		$this->db->select('ca_m.dept_id');
		$this->db->from('category_mapping ca_m');
		$this->db->where('cat_id',$cat_id);
		$res=$this->db->get();
		$dept = array();
		foreach($res->result_array() as $key=>$value){
			  $dept[] = $value['dept_id'];
		}
		return $dept;

	}

	public function get_categories_add()
	{
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('status','1');
		$this->db->where('parent_id','0');
		$query = $this->db->get ();
		if ($query->num_rows () > 0)
		{
	
			$result = $query->result_array();
			foreach($result as $Det)
			{
					
				 
				$query = $this->db->query("SELECT * FROM categories WHERE parent_id IN (".$Det['category_id'].",0) AND (category_id = ".$Det['category_id']." OR parent_id != 0)");
	
				$this->db->last_query();
				$num = $query->num_rows();
	
				if($num == 5)
				{
	
					$query_res = $this->db->query("SELECT * FROM categories WHERE parent_id = ".$Det['category_id']."");
	
					$dept1[]          = $query_res->result_array();
					 
				}
				else
				{
						
					$query_res = $this->db->query("SELECT * FROM categories WHERE parent_id IN (".$Det['category_id'].",0) AND (category_id = ".$Det['category_id']." OR parent_id != 0) ");
	
					$dept1[]          = $query_res->result_array();
	
				}
	
				$this->db->select('*');
				$this->db->from('categories');
				$this->db->where('status','1');
				$this->db->where('parent_id !=','0');
				$this->db->where('parent_id !=',$Det['category_id']);
				$query_arr = $this->db->get();
				$result_arr[] = $query_arr->result_array();
	
				 
			}
			$tot = array_merge($result_arr,$dept1);
	
			return $dept1;
	
		} else
		{
			return false;
		}
	}
	public function category_delete($data)
	{
		$this->db->set('status','0');
		$this->db->where('cat_id', $data['cat_id']);
		$this->db->update('category');
		// category id delete //
		/*$this->db->where('cat_id', $data['cat_id']);
		$this->db->delete('category');*/
		return true;
	}

	public function organization_add($post)
	{
		
		$org_detail = array('org_name' => $post['data']['org_name'],  'org_logo' => $post['org_logo'], 'org_token' => $post['orgAuthToken'],
	  		'status' => "1", 'modified_on' => date("Y-m-d H:i:s"));

		$this->db->insert("organization", $org_detail);
		$id = $this->db->insert_id();

		
		foreach($post['data']['location_name'] as $key=>$count){
			$locationvalue = array('location_name'=>$post['data']['location_name'][$key], 'org_id'=>$id, 'address'=>$post['data']['address'][$key], 'city'=>$post['data']['city'][$key],
							'state'=>$post['data']['state'][$key], 'country'=>$post['data']['countries'][$key], 
							'zip_code'=>$post['data']['zip'][$key], 'status' => "1", 'modified_on' => date("Y-m-d H:i:s"));
			
			$this->db->insert("org_location", $locationvalue);
			$loc_id = $this->db->insert_id();
			
		}

		$user_details = array('user_name' => $post['data']['usr_name'], 'password' => $post['data']['usr_psw'], 'user_token' => $post['userAuthToken'],
								'email' => $post['data']['usr_email'], 'phone' => $post['data']['usr_phone'], 'org_id'=>$id);
		
		$this->user_add($user_details);


		$domain_detail = array('org_id' => $id,  'domain_id' => $post['data']['domain']);

		$this->db->insert("org_domain_map", $domain_detail);

		$domain_mapid = $this->db->insert_id();

		$default = $post['data']['usr_phone'];
		if($default==1){

			$this->select('dept_id')
				->from('department')
				->where('default','1');

			$result = $this->db->get();
			//print_r($result);
			/*foreach ($result as $key => $value) {
				$department_detail = array('dept_id' => $value,  'domain_map_id' => $domain_mapid);
				$this->db->insert("org_department_map", $domain_detail);
				$department_mapid = $this->db->insert_id();
			}*/

			$this->select('cat_id')
				->from('category')
				->where('default','1');

			$catresult = $this->db->get();
			//print_r($catresult);
			/*foreach ($catresult as $ckey => $cvalue) {
				$category_detail = array('cat_id' => $cvalue,  'department_map_id' => $department_mapid);
				$this->db->insert("org_category_map", $category_detail);
			}*/


		}
		exit;
		//return $id;

	}

	public function user_add($data)
	{
		$user_detail = array('name' => $data['user_name'],
						'username' => $data['user_name'],
						'password' => md5($data['password']),
						'user_token' => $data['user_token'],
						'email' => $data['email'],
						'phone' => $data['phone'],
				  		'activation' => "1",
				  		'updatedDate' => date("Y-m-d H:i:s"));

		$this->db->insert("users", $user_detail);

		$id = $this->db->insert_id();

		if(!ISSET($data['loc_id'])){
			$data['loc_id']='0';
		}

		$org_user = array('org_id' => $data['org_id'], 'loc_id' => $data['loc_id'], 'user_id' => $id);
		$this->db->insert("org_users", $org_user);


		return $id;
	}


	public function org_user_assign_role($data)
	{
		
		
		$user_detail = array('name' => $data['user_name'],
						'username' => $data['user_name'],
						'password' => md5($data['password']),
						'user_token' => $data['authToken'],
						'email' => $data['email'],
						'phone' => $data['phone'],
				  		'activation' => "1",
				  		'updatedDate' => date("Y-m-d H:i:s"));
		

		$this->db->insert("users", $user_detail);

		$id = $this->db->insert_id();

		if(!ISSET($data['loc_id'])){
			$data['loc_id']='0';
		}

		$org_user = array('org_id' => $data['org_id'], 'loc_id' => $data['loc_id'], 'user_id' => $id);
		$this->db->insert("org_users", $org_user);

		$map_id = $this->db->insert_id();

		foreach($data['department'] as $key=>$value){
			$org_user_map = array('dept_id' => $value, 'user_map_id' => $map_id, 'role_id' => $data['role_id']);
			$this->db->insert("org_user_department", $org_user_map);

		}
		return $id;
		
	}


	public function get_organizations($data)
	{
		$this->db->select('OR.id, OR.org_name, OR.org_token,  OR.status,d.domain_name');
		$this->db->from ('organization OR');
		$this->db->join('org_domain_map od','od.org_id = OR.id');
		$this->db->join('domain d','od.domain_id = d.domain_id');
		//$this->db->join('org_users OU','OR.id = OU.org_id','left');
		//$this->db->join('users US','OU.user_id = US.id','left');
		$this->db->where('OR.status','1');
		$query = $this->db->get ();

		if ($query->num_rows () > 0) {

			$result = $query->result_array();
			return $result;

		} else {
			return false;
		}
	}

	public function get_organization_info($org_id)
	{
		$this->db->select('US.username, US.id as user_id, US.password, US.email, US.phone, OR.*');
		$this->db->from ('organization OR');
		$this->db->join('org_users OU','OU.org_id = OR.id','left');
		$this->db->join('users US','OU.user_id = US.id','left');
		$this->db->where('OR.status','1');
		$this->db->where('OR.id', $org_id);
		$query = $this->db->get ();

		$this->db->select('LOC.*');
		$this->db->from ('org_location LOC');
		$this->db->where('LOC.org_id', $org_id);
		$this->db->where('LOC.status','1');

		$set_query = $this->db->get ();


		$this->db->select('D.domain_id,D.domain_name');
		$this->db->from ('domain D');
		$this->db->join('org_domain_map OD','OD.domain_id = D.domain_id','left');
		$this->db->where('OD.org_id', $org_id);
		$domainquery = $this->db->get ();

		if ($query->num_rows () > 0) {
			$result_org = $query->result_array();
			$result_location = $set_query->result_array();
			//print_r($result_location); exit;
			$result_domain = $domainquery->result_array();
			return array('org'=>$result_org['0'], 'location'=>$result_location,'domain'=>$result_domain);
		} else {
			return false;
		}
	}

	public function organization_update($post)
	{
		$org_detail = array('org_name' => $post['data']['org_name'], 'org_logo' => $post['org_logo'], 'modified_on' => date("Y-m-d H:i:s"));

		$this->db->where('id', $post['org_id']);
		$this->db->update('organization', $org_detail);

		/*$user_detail = array('name' => $post['data']['usr_name'],'username' => $post['data']['usr_name'], 'password' => AES_Encode($post['data']['usr_psw']), 'email' => $post['data']['usr_email'], 'phone' => $post['data']['usr_phone']);

		$this->db->where('id', $post['data']['user_id']);
		$this->db->update('users', $user_detail);*/

		$this->db->where('org_id', $post['org_id']);
		$this->db->update('org_location', array('status' => '0'));
		
		foreach($post['data']['address'] as $key=>$loc){
			if(ISSET($post['data']['loc_id'][$key])){
				$locationvalue = array('location_name'=>$post['data']['location_name'][$key], 'address'=>$post['data']['address'][$key], 'city'=>$post['data']['city'][$key],
							'state'=>$post['data']['state'][$key], 'country'=>$post['data']['countries'][$key], 
							'zip_code'=>$post['data']['zip'][$key], 'status' => "1");
				$this->db->where('id', $post['data']['loc_id'][$key]);
				$this->db->update('org_location', $locationvalue);
			}
			else{
				$location_detail = array('location_name'=>$post['data']['location_name'][$key], 'org_id' =>  $post['org_id'],
						'address'=>$post['data']['address'][$key], 'city'=>$post['data']['city'][$key],
						'state'=>$post['data']['state'][$key], 'country'=>$post['data']['country'][$key], 'zip_code'=>$post['data']['zip'][$key],
						'status' => "1", 'modified_on' => date("Y-m-d H:i:s"));
				$this->db->insert("org_location", $location_detail);
				$id = $this->db->insert_id();
			}
		}
		$this->db->where('org_id', $post['org_id']);
		$this->db->update('org_domain_map', array('domain_id' => $post['data']['domain']));

		return true;
	}


	public function organization_delete($data)
	{
		echo "enter";exit;
		$this->db->select('org_id, user_id');
		$this->db->from('org_users');
		$this->db->where('org_id', $data['org_id']);
		$query = $this->db->get();
		$query_set = $query->result_array();

		if ($query->num_rows () > 0) {
			foreach($query_set as $users){
				$this->db->where('id', $users['user_id']);
				$this->db->delete('users');
			}
		}

		$this->db->where('org_id', $data['org_id']);
		$this->db->delete('org_users');

		$this->db->where('org_id', $data['org_id']);
		$this->db->delete('org_location');

		$this->db->where('org_id', $data['org_id']);
		$this->db->delete('org_domain_map');

		$this->db->where('org_id', $data['org_id']);
		$this->db->delete('org_department_map');

		$this->db->where('org_id', $data['org_id']);
		$this->db->delete('org_category_map');

		$this->db->where('id', $data['org_id']);
		$this->db->delete('organization');

		//$imgurl = PROJECT_PATH."uploads/users/".$image;
		//$imgurl_thumb = PROJECT_PATH."uploads/users/thumb/".$image;

		/*if(file_exists($imgurl)!='' && $image!=''){
			unlink($imgurl);
		unlink($imgurl_thumb);
		}*/

		//$new_id = '';
		//$user_device = $query_set['0']['device_id'];
		//$this->update_device($new_id, $user_device);
	}

	public function org_location_list($org_id)
	{
		$this->db->select("*");
		$this->db->from('org_location');
		$this->db->where('org_id', $org_id);
		$this->db->where('status', '1');
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() >0)
		{
			return $query->result_array();
		}else
		{
			return array();
		}
	}

	public function get_users($data)
	{	
		if($data['org_id']){
			$this->db->select('us.id, us.username, or.org_name,us.activation');
			$this->db->from('organization or');
			$this->db->join('org_users ou','or.id = ou.org_id');
			$this->db->join('users us','us.id = ou.user_id');	
			$this->db->where('or.id',$data['org_id']);
		}else{
			$this->db->select('US.id, US.username, O.org_name, US.activation');
			$this->db->from ('users US');
			$this->db->join('org_users OU','US.id = OU.user_id', 'left');
			$this->db->join('organization O','OU.org_id = O.id', 'inner');
			$this->db->where('US.activation','1');
		}
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}
	}

	public function get_user_info($user_id)
	{
		$this->db->select('US.username, US.id as user_id, US.password, US.email, US.phone, O.id as org_id, O.org_name, LOC.id as loc_id, LOC.location_name');
		$this->db->from ('users US');
		$this->db->join('org_users OU','OU.user_id = US.id','left');
		$this->db->join('organization O','OU.org_id = O.id','left');
		$this->db->join('org_location LOC','OU.loc_id = LOC.id','left');
		$this->db->where('LOC.status', '1');
		$this->db->where('US.activation','1');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get ();
		
		if ($query->num_rows() > 0) {
			
			$result_user = $query->result_array();
			print_r($result_user);	
			return $result_user['0'];
		} else {
			return false;
		}
	}



	public function get_org_user_info($user_id)
	{
		$this->db->select('US.username, US.id, US.password, US.email, US.phone, OU.org_id as org_id,OUD.dept_id,OUD.role_id,D.domain_name,L.country_name,O.org_name');
		$this->db->from ('users US');
		$this->db->join('org_users OU','OU.user_id = US.id','left');
		$this->db->join('org_domain_map DM','OU.org_id = DM.org_id','left');
		$this->db->join('domain D','DM.domain_id=D.domain_id','left');
		$this->db->join('org_location OL','OU.org_id = OL.org_id','left');
		$this->db->join('location L','OL.country = L.loc_id','left');
		$this->db->join('organization O','OU.org_id = O.id','left');
		$this->db->join('org_user_department OUD','OU.id=OUD.user_map_id','left');
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
	

	
	public function org_user_update($post)
	{

		
		$user_mapid=$this->db->select('id')
                  				->get_where('org_users', array('user_id' => $post['user_id']))
                  				->row()
                  				->id;

        $this->db->where('user_map_id', $user_mapid);
		$this->db->delete('org_user_department');

		foreach($post['data']['department'] as $key=>$value){

			$dept_detail = array('dept_id' => $value,'user_map_id' => $user_mapid,'role_id' => $post['data']['role_id']);
			$this->db->insert("org_user_department", $dept_detail);
			//$id = $this->db->insert_id();
		}
		//'password' => AES_Encode($post['data']['usr_psw']),
		$user_detail = array('name' => $post['data']['usr_name'],'username' => $post['data']['usr_name'], 'email' => $post['data']['usr_email'], 'phone' => $post['data']['usr_phone']);
		
		$this->db->where('id', $post['user_id']);
		$this->db->update('users', $user_detail);
		
		return true;
	}

	public function user_update($post)
	{
		$user_detail = array('name' => $post['data']['usr_name'],'user_name' => $post['data']['usr_name'], 'password' => AES_Encode($post['data']['usr_psw']), 'email' => $post['data']['usr_email'], 'phone' => $post['data']['usr_phone']);
		
		$this->db->where('id', $post['user_id']);
		$this->db->update('users', $user_detail);
		
		$user_org_loc = array('org_id' => $post['data']['org_id'], 'loc_id' => $post['data']['loc_id']);
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('org_users', $user_org_loc);
		return true;
	}
	
	public function user_delete($data)
	{
		// User id delete //
		$this->db->where('id', $data['user_id']);
		$this->db->delete('users');
	
		// role id delete //
		$this->db->where('user_id', $data['user_id']);
		$this->db->delete('org_users');
		return true;
	}

//  Delete organization users
	public function org_user_delete($data)
	{

		$this->db->select ( 'id' );
		$this->db->from ( 'org_users' );
		$this->db->where('user_id', $data['user_id']);
		$query = $this->db->get ();
		$row = $query->result_array ();
		
		foreach($row as $key=>$value){
			$this->db->where('user_map_id', $value['id']);
			$this->db->delete('org_user_department');
		}

		// User id delete //
		$this->db->where('id', $data['user_id']);
		$this->db->delete('users');
	
		// role id delete //
		$this->db->where('user_id', $data['user_id']);
		$this->db->delete('org_users');
		return true;
	}

	/* get details using org token */
	function getDetailsWithOrganisationToken($org_token) {
		$this->db->select ( '*' );
		$this->db->from ( 'organization' );
		$this->db->where ( 'org_token', $org_token);
		$this->db->where('status','1');
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$row = $query->result_array ();
			return $row;
		} else {
			return false;
		}
	}
	/* end of details using org token */

	/* get details using user token */
	function getDetailsWithUserToken($org_token, $user_token)
	{
		$this->db->select ( '*' );
		$this->db->from ( 'users US' );
		$this->db->where ( 'US.user_token', $user_token);
		$this->db->where ( 'US.activation','1');
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$row = $query->result_array ();
			return $row;
		} else {
			return false;
		}
	}





	//Vimala
	
	public function role_add($data)
	{
		if($data['form_add'] != '')
		$form_add = $data['form_add'];
		else
		$form_add = 0;

		if($data['form_update'] != '')
		$form_update = $data['form_update'];
		else
		$form_update = 0;

		if($data['form_view'] != '')
		$form_view = $data['form_view'];
		else
		$form_view = 0;

		if($data['form_delete'] != '')
		$form_delete = $data['form_delete'];
		else
		$form_delete = 0;

		$role_detail = array(
		  		'role_name' => $data['role'],
		  		'form_add' => $form_add,
				'form_update' =>$form_update,
				'form_view' =>$form_view,
				'form_delete' =>$form_delete,
				'status' =>'1',
				'org_id' =>$data['org_id'],
				'loc_id' =>$data['loc_id']);

		$this->db->insert("roles", $role_detail);
		$id = $this->db->insert_id();

		for($i=0;$i<count($data['usersId']);$i++)
		{
			$this->db->insert('user_role',array('role_id' => $id,
		'user_id' => $data['usersId'][$i]));
		}
		return $id;
	}
	
	// Roles //
	public function role_update($data)
	{
		if($data['form_add'] != '')
		$form_add = $data['form_add'];
		else
		$form_add = 0;

		if($data['form_update'] != '')
		$form_update = $data['form_update'];
		else
		$form_update = 0;

		if($data['form_view'] != '')
		$form_view = $data['form_view'];
		else
		$form_view = 0;

		if($data['form_delete'] != '')
		$form_delete = $data['form_delete'];
		else
		$form_delete = 0;
			
		$role_detail = array(
		'role_name' => $data['role'],
		'form_add' => $form_add,
		'form_update' =>$form_update,
				'form_view' =>$form_view,
				'form_delete' =>$form_delete,
				'org_id' =>$data['org_id'],
				'loc_id' =>$data['loc_id']);

		$this->db->where('id',$data['roleId']);
		$this->db->update('roles', $role_detail);


		$this->db->where('role_id', $data['roleId']);
		$delete_users = $this->db->delete('user_role');

		for($i=0;$i<count($data['usersId']);$i++)
		{
			$this->db->insert('user_role',array('role_id' => $data['roleId'],
	                                                 	    'user_id' => $data['usersId'][$i]));
		}
			
		return $data['roleId'];
	}
	public function get_roles()
	{
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->where('status','1');
		$query = $this->db->get ();
			
		if ($query->num_rows () > 0) {
				
			$result = $query->result_array();
			return $result;

		} else {
			return false;
		}
	}
	public function get_role_info($role_id)
	{
		$this->db->select('UR.user_id,  RO.*');
		$this->db->from ('roles RO');
		$this->db->join('user_role UR','UR.role_id = RO.id','left');
		$this->db->where('RO.status','1');
		$this->db->where('RO.id', $role_id);
		$this->db->group_by('RO.id');
		$query = $this->db->get ();

		if ($query->num_rows () > 0) {
			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}
	}
	public function get_locations($data)
	{
		$this->db->select('*');
		$this->db->from ('location');
		$this->db->where('status','1');
		$query = $this->db->get();

		if ($query->num_rows () > 0) {

			$result = $query->result_array();
			return $result;

		} else {
			return false;
		}
	}
	public function loc_list($data)
	{
		$this->db->select('*');
		$this->db->from ('location');
		$this->db->where('status','1');
		$this->db->where('org_id',$data['org_id']);
		$this->db->where('location_name !=','');
		$query = $this->db->get();

		if ($query->num_rows () > 0) {

			$result = $query->result_array();
			return $result;
				
		} else {
			return false;
		}
	}
	public function org_user_list($data)
	{
		$this->db->select('US.id as user_id,US.user_name');
		$this->db->from ('org_users OU');
		$this->db->join('users US','OU.user_id = US.id','left');
		$this->db->where('OU.org_id',$data['org_id']);
		$this->db->group_by('OU.user_id');
		$query = $this->db->get();
			
		if ($query->num_rows () > 0) {

			$result = $query->result_array();
			return $result;

		} else {
			return false;
		}
	}
	public function role_user_list($data)
	{
		$this->db->select('UR.user_id');
		$this->db->from ('user_role UR');
		$this->db->join('roles RO','UR.role_id = RO.id','left');
		$this->db->where('RO.id',$data['role_id']);
		$query = $this->db->get();

		if ($query->num_rows () > 0) {
				
			$result = $query->result_array();
			return $result;

		} else {
			return false;
		}
	}
	public function role_delete($data)
	{
		// User id delete //
		$this->db->where('role_id', $data['role_id']);
		$this->db->delete('user_role');

		// role id delete //
		$this->db->where('id', $data['role_id']);
		$this->db->delete('roles');
		return true;
	}
	// Roles Module Stop //
	
	
	// Category Start //
	/*public function get_categories()
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('status','1');
		$query = $this->db->get ();
	
		if ($query->num_rows () > 0) {
	
			$result = $query->result_array();
			return $result;
	
		} else {
			return false;
		}
	}
	public function get_categories_info($role_id)
	{
		$this->db->select('*');
		$this->db->from ('categories');
		$this->db->where('status','1');
		$this->db->where('category_id', $role_id);
		$query = $this->db->get ();
	
		if ($query->num_rows () > 0) {
			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}
	}
	public function category_add($data)
	
	{
		//print_r($data); exit;
		if($data['is_parent'] == 1)
		$parent_id = 0;
		if($data['is_parent'] == 0)
		$parent_id = $data['parent_id'];
	
	
		$cat_detail = array(
		  		'cat_name' => $data['cat_name'],
		  		'parent_id' => $parent_id,
				'status' =>'1');
	
		$this->db->insert("categories", $cat_detail);
		$id = $this->db->insert_id();
	
		return $id;
	}
	public function category_update($data)
	{
		//print_r($data); exit;
		if($data['is_parent'] == 1)
		$parent_id = 0;
		if($data['is_parent'] == 0)
		$parent_id = $data['parent_id'];
	
	
		$cat_detail = array(
		  		'cat_name' => $data['cat_name'],
		  		'parent_id' => $parent_id);
	
		$this->db->where('category_id',$data['category_id']);
		$this->db->update('categories', $cat_detail);
	
		return $data['category_id'];
	}
	public function get_categories_add()
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('status','1');
		$this->db->where('parent_id','0');
		$query = $this->db->get ();
		if ($query->num_rows () > 0)
		{
	
			$result = $query->result_array();
			foreach($result as $Det)
			{
					
				 
				$query = $this->db->query("SELECT * FROM categories WHERE parent_id IN (".$Det['category_id'].",0) AND (category_id = ".$Det['category_id']." OR parent_id != 0)");
	
				$this->db->last_query();
				$num = $query->num_rows();
	
				if($num == 5)
				{
	
					$query_res = $this->db->query("SELECT * FROM categories WHERE parent_id = ".$Det['category_id']."");
	
					$dept1[]          = $query_res->result_array();
					 
				}
				else
				{
						
					$query_res = $this->db->query("SELECT * FROM categories WHERE parent_id IN (".$Det['category_id'].",0) AND (category_id = ".$Det['category_id']." OR parent_id != 0) ");
	
					$dept1[]          = $query_res->result_array();
	
				}
	
				$this->db->select('*');
				$this->db->from('categories');
				$this->db->where('status','1');
				$this->db->where('parent_id !=','0');
				$this->db->where('parent_id !=',$Det['category_id']);
				$query_arr = $this->db->get();
				$result_arr[] = $query_arr->result_array();
	
				 
			}
			$tot = array_merge($result_arr,$dept1);
	
			return $dept1;
	
		} else
		{
			return false;
		}
	}
	public function category_delete($data)
	{
	
	
		// category id delete //
		$this->db->where('category_id', $data['cat_id']);
		$this->db->delete('categories');
		return true;
	}
	// Category Stop //*/

}
