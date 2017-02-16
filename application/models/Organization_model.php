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
        $this->db->select('o.*,group_concat(d.domain_name) as domain_name,o.id as org_id');
        $this->db->from('organization o');
        $this->db->join('org_location orl', 'orl.org_id=o.id', 'left');
        $this->db->join('org_domain ord', 'ord.org_location_id=orl.id', 'left');
        $this->db->join('domain d', 'd.domain_id=ord.domain_id', 'left');
        $this->db->where('o.`status`=1 and o.id!=1');
        $this->db->group_by("o.id");
        $result = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $result->result_array();
    }

    public function organization_add($post) {
      $this->load->library('uuid');
      $mylib= new Uuid();
        $domain_id = $post['data']['domain'];
        $org_detail = array('system_default' => $post['data']['default'], 'org_name' => $post['data']['org_name'], 'org_logo' => $post['org_logo'], 'org_token' => $post['orgAuthToken'],
            'status' => "1", 'modified_on' => gmdate(date("Y-m-d H:i:s")),'uuid'=>$post['org_uuid'],'subscription_id' => $post['data']['org_plans']);

        $this->db->insert("organization", $org_detail);
        $id = $this->db->insert_id();

        foreach ($post['data']['location_name'] as $key => $count) {
            $location_id = strtoupper(substr($post['data']['city'][$key],0,2)).'00'.$key;
            $locationvalue = array('location_id'=>$location_id,'location_name' => $post['data']['location_name'][$key], 'org_id' => $id, 'address' => $post['data']['address'][$key], 'city' => $post['data']['city'][$key],
                'state' => $post['data']['state'][$key], 'country' => $post['data']['countries'],
                'zip_code' => $post['data']['zip'][$key], 'status' => "1", 'modified_on' => date("Y-m-d H:i:s"),'headbranch'=>'1','uuid'=>$post['location_uuid']);
            $org_location[]=$locationvalue;
            //$country = $post['data']['countries'][$key];
        }
        $this->db->insert_batch("org_location", $org_location);
        $loc_id = $this->db->insert_id();

        $user_details = array('system_default' => $post['data']['default'], 'org_id' => $id, 'user_org_loc_id' => $loc_id, 'user_role_id' => '1', 'user_name' => $post['data']['usr_name'],'last_name' => $post['data']['usr_lname'], 'user_token' => $post['userAuthToken'],
            'email' => $post['data']['usr_email'], 'phone' => $post['data']['usr_phone'], 'org_id' => $id,'uuid'=>$post['user_uuid']);

        $superadmin_id = $this->user_add($user_details);


        $domain_detail = array('org_location_id' => $loc_id, 'domain_id' => $post['data']['domain']);

        $this->db->insert("org_domain", $domain_detail);

        $domain_mapid = $this->db->insert_id();

        $default = $post['data']['default'];
        $this->db->insert('user_location',array('user_id'=>$superadmin_id,'location_id'=>$loc_id));

    if($default==1){
        /*$org_dept_not_in[] = 0;
        $org_cat_not_in[] = 0;
         $this->db->select('dd.dept_id,d.dept_name,d.dept_desc')
                 ->from('department_domain dd')
                 ->join('department d','d.dept_id = dd.dept_id')
                 ->where('dd.domain_id ',$post['data']['domain'])
                 ->where('d.org_id = 1');
          $department = $this->db->get();
          
          $depts == array();
          foreach($department->result_array() as $key=>$value){
              $depts[] = $value['dept_id'];
              $duplicate_dept = array(
                      'dept_name'=>$value['dept_name'],
                      'dept_desc'=>$value['dept_desc'],
                      'uuid' => $mylib->v4(),
                      'created_by'=>$superadmin_id,
                      'org_id'=>$id,
                      'default'=>0,
                      'status'=>1,
                      'created_at'=>gmdate(date("Y-m-d H:i:s")),
                      'updated_at'=>gmdate(date("Y-m-d H:i:s"))
                  );
               $org_dept[]=$duplicate_dept;
          }
          $dept_count = count($org_dept);
          $this->db->insert_batch('department',$org_dept);
          $first_dept_id = $this->db->insert_id();
          $last_dept_id =$first_dept_id + ($dept_count-1);
          for($i= $first_dept_id;$i<=$last_dept_id;$i++){
              $default_dept = array(
                      'dept_id'=>$i,
                      'user_id'=>$superadmin_id,
                      'role_id'=>'1'
                  );
              $org_user_dept[]=$default_dept;
              $dept_domains = array(
                  'dept_id'=>$i,
                  'domain_id'=>$domain_id,
                  'default'=>0
                );
              $dept_domain[]= $dept_domains;
              $new_dept_id[] = $i;
          }
          $this->db->insert_batch('org_user_department',$org_user_dept);
          $this->db->insert_batch('department_domain',$dept_domain);*/
          /*if($department->num_rows > 0){
            foreach($department->result_array() as $key=>$value){
                  $default_dept = array(
                      'dept_id'=>$value['dept_id'],
                      'user_id'=>$superadmin_id,
                      'role_id'=>'1'
                  );
                  $org_user_dept[]=$default_dept;
            }
            $this->db->insert_batch('org_user_department',$org_user_dept);
          }*/
          /*$this->db->select('cd.cat_id,c.category_name,c.category_desc')
                  ->from('category_department cd')
                  ->join('category c','c.cat_id = cd.cat_id')
                  ->where_in('cd.dept_id',$depts)
                  ->where('c.org_id',1);
          $category_dept = $this->db->get();
          //print_r($category_dept->result_array());
          foreach($category_dept->result_array() as $key=>$value){
              $categorys[] = $value['cat_id'];
              $duplicate_cat = array(
                      'category_name'=>$value['category_name'],
                      'category_desc'=>$value['category_desc'],
                      'uuid' => $mylib->v4(),
                      'created_by'=>$superadmin_id,
                      'org_id'=>$id,
                      'default'=>'0',
                      'status'=>1,
                      'created_at'=>gmdate(date("Y-m-d H:i:s")),
                      'updated_at'=>gmdate(date("Y-m-d H:i:s"))
                  );
               $org_cat[]=$duplicate_cat;
          }
          $this->db->insert_batch('category',$org_cat);
          $cat_count = count($org_cat);
          $first_cat_id = $this->db->insert_id();
          $last_cat_id =$first_cat_id + ($cat_count-1);
          for($i= $first_cat_id;$i<=$last_cat_id;$i++){
              $default_cat = array(
                      'cat_id'=>$i,
                      'dept_id'=>$superadmin_id,
                      'role_id'=>'1'
                  );
              $org_user_dept[]=$default_dept;
              $dept_domains = array(
                  'dept_id'=>$i,
                  'domain_id'=>$domain_id,
                  'default'=>0
                );
              $dept_domain[]= $dept_domains;
              $new_dept_id[] = $i;
          }*/
          //exit;
	   }else{
         /* $org_dept_not_in = array();        
  			  $this->db->select('dd.dept_id')
                 ->from('department_domain dd')
                 ->join('department d','d.dept_id = dd.dept_id')
                 ->where('dd.domain_id ',$post['data']['domain'])
                 ->where('d.org_id = 1');
  			  $department = $this->db->get();
          foreach($department->result_array() as $key=>$value){
              $org_dept_not_in[] = $value['dept_id'];
          }
          $org_cat_not_in = array();
          if(count($org_dept_not_in)){
            /* Get Category 
            $this->db->select('c.cat_id')
                     ->from('category c')
                     ->join('category_department cc','cc.cat_id = c.cat_id')
                     ->where('cc.dept_id IN('.implode(',',$org_dept_not_in).')')
                     ->where('c.org_id = 1');
            $category = $this->db->get();
            foreach($category->result_array() as $key=>$value){
              $org_cat_not_in[] = $value['cat_id'];
            }
          }*/
			}
        
        $return = array('org_id'=>$id,'admin_id'=>$superadmin_id,'loc_id'=>$loc_id);
      return $return;
  }
  public function check_org_default($org_id){
    $this->db->select('system_default')
             ->from('organization')
             ->where('id',$org_id);
    $res = $this->db->get()->row();
    return $res->system_default;

  }
  public function meta_data_department($domain){
      $this->db->select('dd.dept_id,d.dept_name,d.dept_desc')
               ->from('department_domain dd')
               ->join('department d','d.dept_id = dd.dept_id')
               ->where('dd.domain_id ',$domain)
               ->where('d.org_id = 1');
      $department = $this->db->get();
      return $department->result_array();
  }
   public function meta_data_category($depts){
      $this->db->select('cd.cat_id,c.category_name,c.category_desc,cd.dept_id')
                  ->from('category_department cd')
                  ->join('category c','c.cat_id = cd.cat_id')
                  ->where_in('cd.dept_id',$depts)
                  ->where('c.org_id',1);
                  //->group_by('cd.cat_id');
          $category_dept = $this->db->get();
      return $category_dept->result_array();
  }
  public function meta_data_forms($cat_id){
    $this->db->select('fd.form_id,fd.form_name,fd.form_desc,fd.form_content,fd.status,fc.cat_id')
             ->from('form_category fc')
             ->join('form_details fd','fd.form_id = fc.form_id')
             ->where_in('fc.cat_id',$cat_id)
             ->where('fd.created_by',1);
    $form_category = $this->db->get();
    return $form_category->result_array();
  }
  public function organization_meta_data($org_dept_not_in,$org_cat_not_in,$org_id){
    $org_detail = array('org_dept_not_in'=>implode(',',$org_dept_not_in),'org_cat_not_in'=>implode(',',$org_cat_not_in));
        $this->db->where('id', $org_id);
        $this->db->update('organization', $org_detail);
  }
  public function org_subscription_plan($org_id,$sub_id){
      $this->db->select('status')
            ->from('organization_subscription_plan')
            ->where('organization_id',$org_id);
      $res = $this->db->get()->row('status');
      if($res == 1){
          $this->db->set('status','1');
          $this->db->where('organization_id',$org_id);
          $this->db->update('organization_subscription_plan');
      }else{
        $from_date  = gmdate(date("Y-m-d"));
        $overall_time = strtotime($from_date);
        $to = strtotime("+3 months", $overall_time);
        $to_date = date('Y-m-d',$to);
        $insert = array();
        $insert['subscription_id'] = $sub_id;
        $insert['organization_id'] = $org_id;
        $insert['from_date']= $from_date;
        $insert['to_date'] = $to_date;
        $insert['status'] = '1';
        $this->db->insert('organization_subscription_plan',$insert);
        $org_sub_plan_id = $this->db->insert_id();
        return true;
      }
  }
  public function check_organization_exists($uuid){
    $this->db->select('id')->from('organization')->where('uuid',$uuid);
    $org_id = $this->db->get()->row('id');
    if($org_id){
        return $org_id;
    }else{
      return false;
    }
  }
  public function check_plan_user($sub_id,$org_id){
      $this->db->select('spd.plans')
               ->from('subscription_plan_details spd')
               ->join('organization_subscription_plan osp','osp.subscription_id = '.$sub_id)
               ->where('osp.organization_id',$org_id)
               ->where('spd.subscription_id',$sub_id)
               ->where('osp.status = 1');
      $user = $this->db->get()->row('plans');
      $users = json_decode($user);
      if($sub_id != 1){
        $res = json_decode($users->plans);
      }else{
        $res = $users->plans;        
      }

      return $res->users;
  }
  public function check_plan_form($sub_id,$org_id){
      $this->db->select('spd.plans')
               ->from('subscription_plan_details spd')
               ->join('organization_subscription_plan osp','osp.subscription_id = '.$sub_id)
               ->where('osp.organization_id',$org_id)
               ->where('spd.subscription_id',$sub_id)
               ->where('osp.status = 1');
      $form = $this->db->get()->row('plans');
      $forms = json_decode($form);
      if($sub_id != 1){
        $res = json_decode($forms->plans);
      }else{
        $res = $forms->plans;        
      }
      return $res->forms;
  }
  public function check_plan_location($sub_id,$org_id){
      $this->db->select('spd.plans')
               ->from('subscription_plan_details spd')
               ->join('organization_subscription_plan osp','osp.subscription_id = '.$sub_id)
               ->where('osp.organization_id',$org_id)
               ->where('spd.subscription_id',$sub_id)
               ->where('osp.status = 1');
      $jobsite = $this->db->get()->row('plans');
      $jobsites = json_decode($jobsite);
      if($sub_id != 1){
        $res = json_decode($jobsites->plans);
      }else{
        $res = $jobsites->plans;        
      }
      return $res->jobsites;
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
            'uuid' => $data['uuid'],
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

  public function get_org_plans($org_plan_id,$org_id){

    $this->db->select('spd.plans')
               ->from('subscription_plan_details spd')
               ->join('organization_subscription_plan osp','osp.subscription_id = '.$org_plan_id)
               ->where('osp.organization_id',$org_plan_id)
               ->where('spd.subscription_id',$sub_id)
               ->where('osp.status = 1');
      $user = $this->db->get()->row('plans');
      $plans = json_decode($user);
      return $plans;
  }
    public function organization_delete($uuid) {
      $this->db->set('status','0');
      $this->db->where('uuid', $uuid);
      $this->db->update('organization');
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

public function subscription_insert($details){
    $this->db->insert('subscription',array('subscription_name'=>'Name 1','duration'=>'3 Months'));
    $sub_id = $this->db->insert_id();
    $this->db->insert('subscription_plan_details',array('subscription_id'=>$sub_id,'plans'=>$details));
    $plan_id = $this->db->insert_id();
    return $plan_id;
}

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
        $this->db->select('*')
                 ->from('users')
                 ->where('org_id',$org_id);
                 $this->db->where('activation','1');
        $orga_users = $this->db->get();
        return $orga_users->result_array();
    }
	public function org_list($org_id = ''){
		$this->db->select('o.id,o.uuid,o.org_name');//,d.domain_name'
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

