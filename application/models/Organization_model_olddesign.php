<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * This is Department Model of Formpro
 *
 * @package	CodeIgniter
 * @category	Department
 * @author	Rajeshkannan Chandrasekar
 * @link	http://innoppl.com/
 *
 */
class Organization_model extends CI_Model {

    public function __construct() {
        date_default_timezone_set("America/New_York");
        $this->load->database();
        $this->load->helper('date');
    }

    /*

      Function : department_add
      Params : department form data
      Returns : none
      Description: Function save department post data into department table
      and update the country and domain into department mapping table

     */

    public function department_add($posts) {
        $post = $posts['data'];
        //print_r($post); exit;
        $department = array('dept_name' => trim($post['dept_name']),
            'dept_desc' => trim($post['dept_desc']),
            'default' => $post['default'],
            'status' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'created_by' => $post['created_by']
        );
        $this->db->insert('department', $department);
        $dept_id = $this->db->insert_id();

        foreach ($post['domain'] as $key => $value) {
            //echo $this->domain_country($value,$post['countries']); exit;
            if (!$this->domain_country($value, $post['countries'])) {
                $this->db->insert('domain_country_mapping', array('domain_id' => $value, 'country_id' => $post['countries']));
                $domain_map_id = $this->db->insert_id();
            } else {
                $domain_map_id = $this->domain_country($value, $post['countries']);
                //echo $domain_map_id; exit;
            }
            $this->db->insert('department_mapping', array('dept_id' => $dept_id, 'domain_map_id' => $domain_map_id));
        }
    }

    /*

      Function : Add organization
      Params : -
      Returns :
      Description: Function adds an organization
     */

    public function get_organisation($user_id) {
        $this->db->select('*,group_concat(d.domain_name)');
        $this->db->from('organization o');
        $this->db->join('org_location orl', 'orl.org_id=o.id', 'left');
        $this->db->join('org_domain ord', 'ord.org_location_id=orl.id', 'left');
        $this->db->join('domain d', 'd.domain_id=ord.domain_id', 'left');
        $this->db->where('o.`status`=1 and o.id!=1');
        $this->db->group_by("o.id");
        $result = $this->db->get();
        return $result->result_array();
    }

    public function organization_add($post) {

        $org_detail = array('system_default' => $post['data']['default'], 'org_name' => $post['data']['org_name'], 'org_logo' => $post['org_logo'], 'org_token' => $post['orgAuthToken'],
            'status' => "1", 'modified_on' => date("Y-m-d H:i:s"));

        $this->db->insert("organization", $org_detail);
        $id = $this->db->insert_id();


        foreach ($post['data']['location_name'] as $key => $count) {
            $locationvalue = array('location_name' => $post['data']['location_name'][$key], 'org_id' => $id, 'address' => $post['data']['address'][$key], 'city' => $post['data']['city'][$key],
                'state' => $post['data']['state'][$key], 'country' => $post['data']['countries'],
                'zip_code' => $post['data']['zip'][$key], 'status' => "1", 'modified_on' => date("Y-m-d H:i:s"));

            $this->db->insert("org_location", $locationvalue);
            $loc_id = $this->db->insert_id();
            $country = $post['data']['countries'][$key];
        }

        $user_details = array('system_default' => $post['data']['default'], 'org_id' => $id, 'user_org_loc_id' => $loc_id, 'user_role_id' => '2', 'user_name' => $post['data']['usr_name'],'last_name' => $post['data']['usr_lname'], 'user_token' => $post['userAuthToken'],
            'email' => $post['data']['usr_email'], 'phone' => $post['data']['usr_phone'], 'org_id' => $id);

        $superadmin_id = $this->user_add($user_details);


        $domain_detail = array('org_location_id' => $loc_id, 'domain_id' => $post['data']['domain']);

        $this->db->insert("org_domain", $domain_detail);

        $domain_mapid = $this->db->insert_id();

        $default = $post['data']['default'];
//		if($default==1){
//
//			$this->db->select('id')
//				->from('domain_country_mapping')
//				->where('country_id',$country)
//				->where('domain_id',$post['data']['domain']);
//			$domainmap = $this->db->get();
//			$domain_map_id = $domainmap->row('id');
//
//			$this->db->select('dept_id')
//				->from('department_mapping')
//				->where('domain_map_id ',$domain_map_id)
//				->where('default' ,'1');
//
//			$deptresult = $this->db->get();
//			$dept_id = $deptresult->row('dept_id');
//			//$dept_id = $deptresult->result_array();
//			
//			
//				$department_detail = array('dept_id' => $dept_id,  'domain_map_id' => $domain_mapid);
//				$this->db->insert("org_department_map", $department_detail);
//				$department_mapid = $this->db->insert_id();
//
//			/*$this->db->select('cat_id')
//				->from('category')
//				->where('default','1');
//
//			$catresult = $this->db->get();
//			$cat_id = $catresult->row('cat_id');
//			
//			
//				$category_detail = array('cat_id' => $cat_id,  'department_map_id' => $department_mapid);
//				$this->db->insert("org_category_map", $category_detail);*/
//			
//
//
//		}else{
//			$this->db->select('id')
//				->from('domain_country_mapping')
//				->where('country_id',$country)
//				->where('domain_id',$post['data']['domain']);
//			$domainmap = $this->db->get();
//			$domain_map_id = $domainmap->row('id');
//			$this->db->select('id,dept_id')->from('department_mapping')->where('domain_map_id ',$domain_map_id);
//			$department = $this->db->get();
//			foreach($department->result_array() as $key=>$value){
//				$this->db->select('dept_name','dept_desc')
//						 ->from('department')
//						 ->where('dept_id ='.$value['dept_id']);
//				$dept_details = $this->db->get()->row_array();
//				$dept_details['created_by'] = $superadmin_id;
//				$dept_details['status'] = 1;
//				$this->db->insert('department',$dept_details);
//				$org_dept_id = $this->db->insert_id();
//				$this->db->insert('org_department_map',array('dept_id'=>$org_dept_id,'domain_map_id'=>$domain_mapid));
//				$org_dept_map_id[] = $this->db->insert_id();
//
//			}	
//			/*$this->db->select('c.category_name')->from('category_mapping cm')->join('category c','c.cat_id = cm.cat_id')->where('dept_map_id = '.$value['id']);
//			$cat_id = $this->db->get()->row('category_name');
//			$this->*/
//
//		}


        return $id;
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
        if(isset($post['data']['countries'][$key]) && isset($post['data']['domain'][$key])){
          $locationvalue = array('location_name'=>$post['data']['location_name'][$key], 'address'=>$post['data']['address'][$key], 'city'=>$post['data']['city'][$key],
              'state'=>$post['data']['state'][$key], 'country'=>$post['data']['countries'][$key], 
              'zip_code'=>$post['data']['zip'][$key], 'status' => "1");

          $this->db->where('id', $post['data']['loc_id'][$key]);
          $this->db->update('org_location', $locationvalue);

          $this->db->where('org_location_id', $post['data']['loc_id'][$key]);
          $this->db->update('org_domain', array('domain_id' => $post['data']['domain']));
        }
        else{
          $locationvalue = array('location_name'=>$post['data']['location_name'][$key], 'address'=>$post['data']['address'][$key], 'city'=>$post['data']['city'][$key],
              'state'=>$post['data']['state'][$key], 
              'zip_code'=>$post['data']['zip'][$key], 'status' => "1");

          $this->db->where('id', $post['data']['loc_id'][$key]);
          $this->db->update('org_location', $locationvalue);

        }
        
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
    

    return true;
  }




    public function user_add($data) {
        $user_detail = array('org_id' => $data['org_id'],
            'user_org_loc_id' => $data['user_org_loc_id'],
            'user_role_id' => $data['user_role_id'],
            'firstname' => $data['user_name'],
            'lastname' => $data['last_name'],
            'password' => md5('12345'),
            'user_token' => $data['user_token'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'activation' => "1",
            'updatedDate' => gmdate("Y-m-d H:i:s"));

        $this->db->insert("users", $user_detail);
        $id = $this->db->insert_id();

        $this->load->library('email');
        $type = array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => '1'
        );
        $email = $data['email'];
        $data = array(
            'name' => $data['user_name'], // Users Name
            'email' => $data['email'],
            'password' => '12345',
            'link' => base_url()
        );
        $this->email->initialize($type);
        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@formpro.com', 'Admin');
        $this->email->to($email);  // replace it with receiver mail id
        $this->email->subject('Welcome to Formpro'); // replace it with relevant subject
        $body = $this->load->view('emails/organization_creation.php', $data, TRUE);
        $this->email->message($body);
        $this->email->send();




//		if(!ISSET($data['loc_id'])){
//			$data['loc_id']='0';
//		}
//		$org_user = array('org_id' => $data['org_id'], 'loc_id' => $data['loc_id'], 'user_id' => $id);
//		$this->db->insert("org_users", $org_user);
        /* $this->load->library('email');
          $type = array (
          'mailtype' => 'html',
          'charset'  => 'utf-8',
          'priority' => '1'
          );
          $data = array(
          'name'=> $data['user_name'],  // Users Name
          'password' => 'Admin@123',
          'link' =>base_url();
          );
          $this->email->initialize($type);
          $this->email->set_newline("\r\n");
          $this->email->from('no-reply@formpro.com', 'Admin');
          $this->email->to($useremail);  // replace it with receiver mail id
          $this->email->subject('Forgot Password'); // replace it with relevant subject
          $body = $this->load->view('emails/organization_creation.php',$data,TRUE);
          $this->email->message($body);
          if($this->email->send())
          {
          return $id;
          }
          else
          {
          return 0;
          } */
        return $id;
    }

    public function get_organization_info($org_id)
  {
    $this->db->select('US.firstname,US.lastname, US.id as user_id, US.email, US.phone, OR.*,d.domain_id,d.domain_name,l.country_name,ol.*');
    $this->db->from ('organization OR');
    $this->db->join('users US','OR.id = US.org_id','left');
    $this->db->join('org_location ol','OR.id = ol.org_id','left');
    $this->db->join('org_domain od','ol.id = od.org_location_id','left');
    $this->db->join('domain d','od.domain_id = d.domain_id','left');
    $this->db->join('location l','ol.country = l.loc_id','left');
    $this->db->where('OR.status','1');
    $this->db->where('OR.id', $org_id);
    $query = $this->db->get ();

    if ($query->num_rows () > 0) {
      $result_org = $query->result_array();
      //$result_location = $set_query->result_array();
      //print_r($result_location); exit;
      //$result_domain = $domainquery->result_array();
      return $result_org;
    } else {
      return false;
    }
  }


    public function organization_delete($data) {

        $this->db->select('org_id, user_id');
        $this->db->from('org_users');
        $this->db->where('org_id', $data['org_id']);
        $query = $this->db->get();
        $query_set = $query->result_array();

        if ($query->num_rows() > 0) {
            foreach ($query_set as $users) {
                $this->db->where('id', $users['user_id']);
                $this->db->delete('users');
            }
        }



        $this->db->select('id');
        $this->db->from('org_domain_map');
        $this->db->where('org_id', $data['org_id']);
        $domainquery = $this->db->get();
        $domainquery_set = $domainquery->result_array();

        if ($domainquery->num_rows() > 0) {
            foreach ($domainquery_set as $domain) {

                $this->db->select('id');
                $this->db->from('org_department_map');
                $this->db->where('domain_map_id', $domain['id']);
                $deptquery = $this->db->get();
                $deptquery_set = $deptquery->result_array();

                foreach ($deptquery_set as $dept) {
                    $this->db->where('department_map_id', $dept['id']);
                    $this->db->delete('org_category_map');
                }
                $this->db->where('domain_map_id', $domain['id']);
                $this->db->delete('org_department_map');
            }
            $this->db->where('org_id', $data['org_id']);
            $this->db->delete('org_domain_map');
        }


        $this->db->where('org_id', $data['org_id']);
        $this->db->delete('org_users');

        $this->db->where('org_id', $data['org_id']);
        $this->db->delete('org_location');

        $this->db->where('id', $data['org_id']);
        $this->db->delete('organization');

        //$imgurl = PROJECT_PATH."uploads/users/".$image;
        //$imgurl_thumb = PROJECT_PATH."uploads/users/thumb/".$image;

        /* if(file_exists($imgurl)!='' && $image!=''){
          unlink($imgurl);
          unlink($imgurl_thumb);
          } */

        //$new_id = '';
        //$user_device = $query_set['0']['device_id'];
        //$this->update_device($new_id, $user_device);
        return true;
    }

    /*

      Function : department_list
      Params : -
      Returns : department list as array
      Description: Function returns list of department details as array

     */

    public function department_list() {

        $this->db->select('de.dept_id,de.dept_name,de.dept_desc,de.status,de.default');
        $this->db->from('department de');
        //$this->db->join('department_country_mapping dc_ma','dc_ma.dept_id = de.dept_id','left');
        //$this->db->join('location co','co.loc_id = do_ma.country_id','left');
        $this->db->where('de.status', '1');
        $query = $this->db->get();
        //print_r($this->db);
        if ($query->num_rows() > 0) {
            $result_dept = $query->result_array();
            return $result_dept;
        } else {
            return false;
        }
    }

    /*

      Function : get_department_info
      Params : department id
      Returns : single department details array
      Description: Function pass dept id as params and returns details for
      the department

     */

    public function get_department_info($dept_id) {
        $this->db->select('de.dept_id,de.dept_name,de.dept_desc,de.default,de.status,do_cm.country_id,do_cm.domain_id');
        $this->db->from('department de');
        $this->db->join('department_mapping de_cm', 'de_cm.dept_id = de.dept_id', 'left');
        $this->db->join('domain_country_mapping do_cm', 'do_cm.id = de_cm.domain_map_id ', 'left');
        $this->db->where('de.status', '1');
        $this->db->where('de.dept_id', $dept_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            $result_department = $query->result_array();
            /* get Country Domain */
            $department = array('department' => $result_department);

            /* Returns Domain for the country */

            $department['domain'] = $this->country_domain($result_department[0]['country_id']);

            /* Returns domain_id for the department */

            foreach ($result_department as $key => $value) {
                $sel[] = $value['domain_id'];
            }
            $department['selected_domain'] = $sel;

            return $department;
        } else {
            return false;
        }
    }

    /*

      Function : country_domain
      Params : country id
      Returns : domain details as array
      Description: Function returns the domain info based on the country id

     */

    public function country_domain($country_id) {

        $this->db->select('d.domain_id,do.domain_name');
        $this->db->from('domain_country_mapping d');
        $this->db->join("domain as do", 'do.domain_id = d.domain_id', 'left');
        $this->db->where('d.country_id =' . $country_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*

      Function : department_country
      Params : department id
      Returns : single country id
      Description: Function used to returns countryid which mapping department and domain
      country table based on department id

     */

    public function department_country($dept_id) {

        $this->db->distinct()
                ->select('do_cm.country_id')
                ->from('department_mapping d')
                ->join('domain_country_mapping do_cm', 'do_cm.id = d.domain_map_id')
                ->where('d.dept_id = ' . $dept_id);
        $res = $this->db->get();
        return $res->row()->country_id;
    }

    /*

      Function : department_domain
      Params : department id
      Returns : domain id for the department as array
      Description: Function used to returns domain id which mapping department and domain
      country table based on department id

     */


    /*

      Function : department_update
      Params : department form data,current department country and domains
      Returns : true
      Description: Function used to update department details based on department id
      and update department mapping table

     */

    public function department_update($posts, $countries, $domain) {

        $post = $posts['data'];
        if (isset($post['default'])) {
            $this->db->set('default', $post['default']);
        }
        if (isset($post['status'])) {
            $this->db->set('status', $post['status']);
        }

        /* Update Department Table */

        $this->db->set('dept_name', $post['dept_name']);
        $this->db->set('dept_desc', $post['dept_desc']);
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        $this->db->where('dept_id', $post['dept_id']);
        $this->db->update('department');

        $this->db->query("delete from department_mapping where dept_id = " . $post['dept_id']);
        foreach ($post['domain'] as $key => $value) {
            /* Check domain Already have country */
            if (!$this->domain_country($value, $post['countries'])) {
                $this->db->insert('domain_country_mapping', array('domain_id' => $value, 'country_id' => $post['countries']));
                $domain_map_id = $this->db->insert_id();
            } else {
                $domain_map_id = $this->domain_country($value, $post['countries']);
            }
            $this->db->insert('department_mapping', array('dept_id' => $post['dept_id'], 'domain_map_id' => $domain_map_id));
        }

        return true;
    }

    /*

      Function : domain_country
      Params : domain_id,country_id
      Returns : domain country mapping id
      Description: Function used to return domain country mapping table id based on domain id 			and country id

     */

    public function domain_country($domain_id, $country_id) {

        $do_cu = $this->db->query('Select id from domain_country_mapping where domain_id =' . $domain_id . ' and country_id=' . $country_id);
        if ($do_cu->num_rows() > 0) {
            return $do_cu->row()->id;
        } else {
            return false;
        }
    }

    /*

      Function : department_delete
      Params 	 : dept_id
      Returns  : none
      Description: Function used to change status from 0 to 1 to delete department record

     */



    public function getdefaultdepartment() {
        $query = "Select dept_id,dept_name from department where status = '1' and `default` = '1' ";
        $res = $this->db->query($query)->result();
        if ($res)
            return $res;
        else
            return 0;
    }

         public function org_category($org_id){
            $this->db->select('')
                 ->from('category')
                  ->where('org_id',$org_id);
            $org_category = $this->db->get();
            return $org_category->result_array();
            
        }

    public function org_details($org_id) {
        /* Select Department */
        $this->db->select('c.cat_id,c.category_name')
                ->from('organization org')
                ->join('org_domain_map odm', 'odm.org_id = org.id')
                ->join('org_department_map odpm', 'odpm.domain_map_id = odm.id')
                ->join('org_category_map ocm', 'ocm.department_map_id = odpm.id')
                ->join('category c', 'c.cat_id = ocm.cat_id')
                ->where('org_id', $org_id);
        $category = $this->db->get()->result_array();
        //print_r($this->db); exit;
        if (isset($category)) {
            return $category;
        } else {
            return false;
        }
    }

public function organization_details($org_id) {
        /* Select Department */
        $this->db->select('o.*,od.domain_id')
                ->from('organization o')
                ->join('org_location ol', 'o.id = ol.org_id')
                ->join('org_domain od', 'ol.id = od.org_location_id')
                ->where('o.id', $org_id);
        $org_details = $this->db->get()->result_array();
        
        //print_r($this->db); exit;
        if (isset($org_details)) {
            return $org_details;
        } else {
            return false;
        }
    }

//	public function org_list($org_id){
//		$this->db->select('o.id,o.org_name');//,d.domain_name'
//		$this->db->from('organization o');
//		//$this->db->join('org_domain_map od','od.org_id = o.id');
//		//$this->db->join('domain_map d','od.domain_id = d.domain_id');
//                //$this->db->where('o.id',$org_id);
//		$this->db->where('o.status','1');
//		$org = $this->db->get()->result_array();
//		//print_r($org); exit;
//		if(isset($org)){
//			return $org;
//		}else{
//			return false;
//		}
//	}






	/*

		Function : department_update
		Params : department form data,current department country and domains
		Returns : true
		Description: Function used to update department details based on department id
					 and update department mapping table

	*/



	/*

		Function : domain_country
		Params : domain_id,country_id
		Returns : domain country mapping id
		Description: Function used to return domain country mapping table id based on domain id 			and country id 

	*/


	/*

		Function : department_delete
		Params 	 : dept_id
		Returns  : none
		Description: Function used to change status from 0 to 1 to delete department record

	*/



        public function org_users($org_id){
            $this->db->select('')
                 ->from('users')
                  ->where('org_id',$org_id);
            $org_users = $this->db->get();
            return $org_users->result_array();
            
        }


	public function org_list($org_id){
		$this->db->select('o.id,o.org_name');//,d.domain_name'
		$this->db->from('organization o');
		//$this->db->join('org_domain_map od','od.org_id = o.id');
		//$this->db->join('domain_map d','od.domain_id = d.domain_id');
                //$this->db->where('o.id',$org_id);
		$this->db->where('o.status','1');
		$org = $this->db->get()->result_array();
		//print_r($org); exit;
		if(isset($org)){
			return $org;
		}else{
			return false;
		}
	}



}

?>

