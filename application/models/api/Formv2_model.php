<?php
require_once('Form_model.php');
class Formv2_model extends Form_model{

	public function user_info_options($data)
	{
		$this->db->insert('user_form_info_options',$data);
	}
	public function user_info_text($data){
		$this->db->insert('user_form_info_text',$data);
        return $this->db->insert_id();	
	}
    public function user_info_text_update($data,$user_form_info_text_id){
        $this->db->where('user_form_info_text_id',$user_form_info_text_id);
        $this->db->update('user_form_info_text',$data);
    }
    public function user_info_file_update($data,$user_form_info_text_id){
        $this->db->where('user_form_info_text_id',$user_form_info_text_id);
        $this->db->update('user_form_info_text',$data);
    }
    public function get_form_review_history($form_id){
        $this->db->select('user_id,sort_id')
                 ->from('form_hierarchy_position fh')
                 ->where('fh.form_id ',$form_id)
                 ->order_by('fh.sort_id ASC');
        $res = $this->db->get()->result_array();
        $sort_position = array();
        foreach($res as $key=>$value){
            $sort_position[$value['sort_id']]=$value['user_id'];
        }
        return  $sort_position;       
    }
    public function form_submit($userid,$formid,$organization_id,$location_id,$uuid){
        $token = $this->generateFormToken(10);
        $this->db->set('user_id',$userid);
        $this->db->set('form_id',$formid);
        $this->db->set('org_id',$organization_id);
        $this->db->set('location_id',$location_id);
        $this->db->set('token',$token);
        $this->db->set('uuid',$uuid);
        $this->db->set('created_at',gmdate(date('Y-m-d H:i:s')));
        $this->db->set('updated_at',gmdate(date('Y-m-d H:i:s')));
        //$this->db->set('submission',$formvalues);
        $this->db->insert('form_submission');
        $submission_id = $this->db->insert_id();
        if($submission_id){
            $count = $this->get_user_form_submission_count($formid,$userid);
            //print_r($return); exit;
            $response['code'] = 200;
            $response['msg'] = 'Form Submitted successfully';
            $response['count']=$count;
            $response['submission_id'] = $submission_id;
        }
        else{
            $response['code'] = 404;
            $response['msg'] = 'Form Submitted successfully';   
        }
        return $response;
    }
    public function update_form_submission($formvalues,$submission_id,$status){
        $this->db->where('id',$submission_id);
        $this->db->update('form_submission',array('submission'=>$formvalues,'status'=>$status,'updated_at'=>gmdate(date('Y-m-d H:i:s')))); 
    }
    function generateFormToken ($length) {
        $possible = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRESTUVWXYZ_"; // allowed chars in the password
        if ($length == "" OR !is_numeric($length)){
            $length = 8; 
        }
        $i = 0; 
        $password = "";    
         while ($i < $length) { 
          $char = substr($possible, rand(0, strlen($possible)-1), 1);
                if(!strstr($password, $char)) { 
                   $password .= $char;
                   $i++;
                }
          }

            return $password;
    }
    public function get_reassign_to_users($submission_id){
        $this->db->select('reassigned_to,reassigned_by')->from('form_submission')->where('id',$submission_id);
        $res = $this->db->get();
        $reassign_to = $res->row()->reassigned_to;
        $reassign_by = $res->row()->reassigned_by;
        return $reassign_to.','.$reassign_by;
    }
    public function update_hierarchy_position($submission_id,$user_id){
        $this->db->where('user_id',$user_id);
        $this->db->where('submission_id',$submission_id);
        $this->db->update('form_review_history',array('status'=>'0'));
    }
	 public function alert_create($data) {
        $this->db->insert('alerts', $data);
        return $this->db->insert_id();
    }
    /* Check alert owner */
    public function alert_owner_check($alert_id,$user_id){
        $this->db->select('*')->from('alerts')->where('id = '.$alert_id.' and user_id = '.$user_id);
        return $this->db->get()->num_rows();
    }
    public function get_reported_user_alerts($alert_id){
        $this->db->select('reporting_to')->from('alert_reporting_mapping')->where('alert_id ='.$alert_id);
        $res = $this->db->get();
        return $res->result_array();
    }
    public function get_alert_owner($alert_id){
        $this->db->select('user_id')->from('alerts')->where('id = '.$alert_id);
        $res = $this->db->get();
        return $res->row()->user_id;
    }

    public function insert_alert_images($data)
    {
        return $this->db->insert_batch('alert_images', $data);
    }

    public function insert_comment($comment)
    {
        return $this->db->insert('alert_comments', $comment);
    }

    public function insert_alert_mapping($data)
    {
        return $this->db->insert_batch('alert_reporting_mapping', $data);
    }

    public function get_alerts($userId)
    {
        $this->db->select("alerts.id as alert_id, alerts.status, alerts.title, alerts.description, alerts.job_site_id, alerts.created_at, CONCAT_WS(\" \", users.firstname, users.lastname) as name, users.id, (SELECT COUNT(alert_images.id) FROM alert_images WHERE alert_images.alert_id = alerts.id) as attachment")
        ->from('alerts')
        ->join('alert_reporting_mapping','alerts.id = alert_reporting_mapping.alert_id','left')
        ->join('users','users.id = alert_reporting_mapping.reporting_to','left')
        ->where('alerts.user_id', $userId);
        $res = $this->db->get();

        $created_by = $res->result_array();
        foreach($created_by as $key=>$value){
            $alert_created_by[$value['id']][]= $value;
        }
        $this->db->select("alerts.id as alert_id, alerts.status, alerts.title, alerts.description, alerts.job_site_id, alerts.created_at, CONCAT_WS(\" \", users.firstname, users.lastname) as name, users.id, (SELECT COUNT(alert_images.id) FROM alert_images WHERE alert_images.alert_id = alerts.id) as attachment")
        ->from('alerts')
        ->join('alert_reporting_mapping','alerts.id = alert_reporting_mapping.alert_id','left')
        ->join('users','users.id = alert_reporting_mapping.reporting_to','left')
        ->where('alert_reporting_mapping.reporting_to', $userId);
        $res1 = $this->db->get();
        $reported_by = $res1->result_array();
        foreach($reported_by as $key=>$value){
            $alert_created_by[$value['id']][]= $value;
        }
        return $alert_created_by;
    }
    public function get_form_hierarchy_submission($user_id,$form_id){
        $this->db->select('fh.user_id')
                ->from('user_form uf')
                ->join('form_hierarchy_position fh','fh.form_hierarchy_id = uf.form_hierarchy_id')
                ->where('uf.user_id',$user_id)
                ->where('uf.form_id',$form_id)
                ->order_by('fh.sort_id','asc');
        $res = $this->db->get();
        return $res->result_array();
    }
    public function store_hierarchy_position($sort_id,$user_id,$form_id,$submission_id,$status){
        $array['form_id'] = $form_id;
        $array['user_id'] = $user_id;
        $array['submission_id'] = $submission_id;
        $array['createddate'] = gmdate(date('Y-m-d H:i:s'));
        $array['status'] = $status;
        foreach($sort_id as $key=>$value){
            $array['user_id'] = $value;
            $this->db->insert('form_review_history',$array);
        }
    }
    public function get_alert_details($alertId)
    {
         $this->db->select("`alerts`.`id` as `alert_id`, alert_comments.id as comment_id, alert_images.id as image_id, map.id as report_id, `alerts`.`status`, `alerts`.`title`, `alerts`.`description`, `alerts`.`job_site_id`,`alerts`.`user_id` as alert_owner_user_id, `alerts`.`created_at` as `alert_created`, `alert_comments`.`comment`, `alert_comments`.`user_id`, `alert_comments`.`created_at` AS `commentCreated`, `alert_images`.`image_name`, CONCAT_WS(\" \", `comment_users`.`firstname`, comment_users.lastname) as comment_name, `comment_users`.`id` As `comment_userid`, CONCAT_WS(\" \", `report_users`.`firstname`, report_users.lastname) as report_name, `report_users`.`id` As `report_userid`")
            ->from('alerts')
            ->join('alert_comments', 'alert_comments.alert_id = alerts.id','left')
            ->join('alert_images', 'alert_images.alert_id = alerts.id','left')
            ->join('alert_reporting_mapping map', 'map.alert_id = alerts.id','left')
            ->join('users comment_users', 'comment_users.id = alert_comments.user_id','left')
            ->join('users report_users', 'report_users.id = map.reporting_to','left')
            ->where('alerts.id', $alertId)
            ->order_by("alert_comments.created_at", “ASC”);
        $res = $this->db->get();
        return $res->result_array();
    }
    public function get_alert_title($alert_id){
        $this->db->select('title')->from('alerts')->where('id = '.$alert_id);
        $res = $this->db->get();
        return $res->row()->title;

    }
    public function close_alert($alertId)
    {
        $this->db->set('status', '0');
        $this->db->where('id', $alertId);
        $this->db->update('alerts');
    }
    public function alert_resolve_status($alertId,$current_user_id){
        $this->db->insert('alert_details',array(
                                            'alert_id'=>$alertId,
                                            'resolved_by'=>$current_user_id,
                                            'created_at'=>gmdate(date("Y-m-d H:i:s")),
                                            'updated_at' => gmdate(date("Y-m-d H:i:s"))
                                        )
                        );
        
    }
    public function form_submission_list($user_id,$form_id,$location_id){
        $this->db->select("`form_submission`.`id` as `submission_id`,`form_submission`.`submission` as `submission`,`form_submission`.`created_at` as `createddate`,`form_submission`.`status`,`form_submission`.`reassigned_by`,`form_details`.`form_desc`,`form_details`.`form_id`,`form_details`.`form_name`,`form_submission`.`user_id`,CONCAT_WS(\" \", users.firstname, users.lastname) as name")
             ->from('form_submission')
             ->join('form_details','form_details.form_id = form_submission.form_id','left')
             ->join('users','users.id = form_submission.user_id','left')
             ->where('form_submission.user_id = '.$user_id.' and form_submission.form_id = '.$form_id.' and form_submission.location_id = '.$location_id)
             ->order_by('form_submission.created_at','ASC');
        $res = $this->db->get();
        return $res->result_array();
    }
    public function form_submission_data($user_id,$form_id,$location_id,$submission_id){
        $this->db->select("`form_submission`.`id` as `submission_id`,`form_submission`.`submission` as `submission`,`form_submission`.`created_at` as `createddate`,`form_submission`.`status`,`form_submission`.`reassigned_by`,`form_details`.`form_desc`,`form_details`.`form_id`,`form_details`.`form_name`,`form_submission`.`user_id`,CONCAT_WS(\" \", users.firstname, users.lastname) as name")
             ->from('form_submission')
             ->join('form_details','form_details.form_id = form_submission.form_id','left')
             ->join('users','users.id = form_submission.user_id','left')
             ->where('form_submission.user_id = '.$user_id.' and form_submission.form_id = '.$form_id.' and form_submission.location_id = '.$location_id.' and form_submission.id ='.$submission_id)
             ->order_by('form_submission.created_at','ASC');

        $res = $this->db->get();
        return $res->row();
    }
    public function form_submission_review_data($user_id,$form_id,$location_id,$submission_id){
        $this->db->select("`form_submission`.`id` as `submission_id`,`form_submission`.`submission` as `submission`,`form_submission`.`created_at` as `createddate`,`form_submission`.`status`,`form_submission`.`reassigned_by`,`form_details`.`form_desc`,`form_details`.`form_id`,`form_details`.`form_name`,`form_submission`.`user_id`,CONCAT_WS(\" \", users.firstname, users.lastname) as name")
             ->from('form_submission')
             ->join('form_details','form_details.form_id = form_submission.form_id','left')
             ->join('users','users.id = form_submission.user_id','left')
             ->where('form_submission.form_id = '.$form_id.' and form_submission.location_id = '.$location_id.' and form_submission.id ='.$submission_id)
             ->order_by('form_submission.created_at','ASC');

        $res = $this->db->get();
        return $res->row();
    }
    public function check_form_workflow($form_id){
        $this->db->select('assign_to')->from('form_details')->where('form_id',$form_id);
        $res = $this->db->get()->row('assign_to');
        return $res;
    }
    public function get_form_hierarchy_list($user_id){
        $this->db->select('fh.sort_id,fh.form_id,fh.user_id')
                ->from('form_hierarchy_position fh')
                ->join('form_details fd','fd.form_id = fh.form_id')
                ->where('fh.user_id = '.$user_id);
        $res = $this->db->get();
        return $res->result_array();
    }
    public function get_form_review_list($user_id,$form_id){
        $this->db->select('fh.sort_id,fh.form_id,fh.user_id')
                ->from('form_hierarchy_position fh')
                ->where('fh.user_id = '.$user_id.' and fh.form_id = '.$form_id);
        $res = $this->db->get();
        return $res->result_array();   
    }
    public function get_previous_user_hierarchy($value){
        if($value['sort_id'] != 0){
            $sort =  $value['sort_id']-1;    
            $form_id = $value['form_id'];
            $this->db->select('fh.user_id,fh.form_id')
                     ->from('form_hierarchy_position fh')
                     ->where('fh.sort_id ='.$sort.' and fh.form_id = '.$form_id);
            //s$user_id =  $this->db->get()->row()->user_id;
            $res = $this->db->get();
            $user_id = $res->row()->user_id;
            $form_id = $res->row()->form_id;
            //$user[$res->row()->form_id] = $res->row()->user_id;
        }
        return $user_id.'#'.$form_id;
    }
    public function get_previous_hierarchy_submission_data($prev_user_id)
    {
        $prev_user = implode(',',$prev_user_id);
        $sql = "SELECT form_review_history_id,status,submission_id,user_id from form_review_history where user_id IN (".$prev_user.")";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function intital_sort_hierarchy_submission_data($sort_zero_id)
    {
        $initial_user = implode(',',$sort_zero_id);
        $sql = "SELECT form_review_history_id,status,submission_id,user_id from form_review_history where user_id IN (".$initial_user.")";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function form_review_waiting_approval_lists($submission_id,$user_id){
        $submission = implode(',',$submission_id);
        //as submission_status,fh.status
        $sql = 'SELECT fh.form_review_history_id,CONCAT_WS(" ",u.firstname,u.lastname) as name,fs.id as submission_id,fs.created_at as createddate,fd.form_name,fd.form_id,fh.status,fh.user_id 
                   FROM form_submission as fs 
                   JOIN users as u ON u.id = fs.user_id
                   JOIN form_details as fd ON fd.form_id = fs.form_id
                   JOIN form_review_history as fh ON fh.submission_id = fs.id
                   WHERE fs.id IN('.$submission.') AND fh.user_id ='.$user_id.'
                   ORDER BY createddate DESC';
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function general_notifications_insert($notification){
        $insert = array();

        if(is_array($notification['users']) && count($notification['users']) > 0){
            $form_id = 0;
            $submission_id = 0;
            $alert_id = 0;
            if(isset($notification['details']['form_id'])){
                $form_id = $notification['details']['form_id'];
            }
            if(isset($notification['details']['submission_id'])){
                $submission_id = $notification['details']['submission_id'];
            }
            if(isset($notification['details']['alert_id'])){
                $alert_id = $notification['details']['alert_id'];
            }
            foreach($notification['users'] as $key=>$value){
                if($value != 0){
                    $array = array(
                            'notify_to' => $value,
                            'type' => $notification['type_name'],
                            'type_id' => $notification['type_id'],
                            'org_id' => $notification['details']['org_id'],
                            'message' => json_encode($notification['details']),
                            'status' => '1',
                            'submission_id' => $submission_id,
                            'form_id' => $form_id,
                            'alert_id' => $alert_id,
                            'created_at' => $notification['created_at'],
                            'updated_at' => $notification['updated_at']
                        );   
                    $insert[] = $array;
                }
            }
            $this->db->insert_batch('notification', $insert);
            return true;
        }
    }

    public function save_review_comments($store){
        $this->db->insert('comments',$store);
        $comment_id = $this->db->insert_id();
        return $comment_id;
    
        /* Update status id in form_review_history table */
         $actions = array(
            //approved - // 
            '1'=>'1',
            // rejected - 
            '2' => '2',
            // reassinged
            '3' => '3'
        );
        $this->db->where('submission_id',$store['submission_id']);
        $this->db->where('user_id',$store['created_by']);
        $this->db->update('form_review_history',array('status'=>$status));
    }

    public function update_comment_id_user_form_info_text($comment_id,$submission_id,$user_form_info_text_id)
    {
        /* Update comment id in user_form_info_text table */
        $this->db->where('submission_id',$submission_id);    
        $this->db->where('user_form_info_text_id',$user_form_info_text_id);
        $this->db->update('user_form_info_text',array('comment_id'=>$comment_id));
    }

    public function form_details($form_id){

        $this->db->select('f.form_id,f.form_name,f.form_desc,f.form_content,f.status,f.default,f.created_by,f.assign_to,f.response_to,f.org_id')
                //->join('form_location fl','fl.form_id = f.form_id')
                ->from('form_details f')
                ->where('f.form_id = '.$form_id);
        $details = $this->db->get()->row();
        return $details;

    }

    public function form_submission_details($id){

        $this->db->select('f.id,f.form_id,f.user_id,f.created_at,f.submission,f.org_id')
                ->from('form_submission f')
                ->where('f.id = '.$id);
        $details = $this->db->get();
        //echo $this->db->last_query();exit;
        return $details->result_array();

    }

    public function updates_submission_form_submission($submission_id,$submission){
        /* Update submission data in form_submission table */
        $this->db->where('id',$submission_id);
        $this->db->update('form_submission',array('submission'=>$submission,'updated_at'=>gmdate(date('Y-m-d H:i:s'))));
    }

    public function get_individual_form_hierarchy_list($form_id){
        $this->db->select('fh.sort_id,fh.form_id,fh.user_id')
                ->from('form_hierarchy_position fh')
                ->join('form_details fd','fd.form_id = fh.form_id')
                ->where('fh.form_id = '.$form_id);
        $res = $this->db->get();
        return $res->result_array();
    }
    public function get_my_sort_order($user_id,$form_id){
        $sql = "SELECT fp.sort_id from form_hierarchy_position as fp where fp.form_id = ".$form_id.' and fp.user_id = '.$user_id;
        $res = $this->db->query($sql);
        return $res->row()->sort_id;
    }
    //public function get_next_hierarchy_user_id($form_id,$submission_id,$user_id)
    public function updates_status_form_submission($submission_id,$status){
        /* Update submission_status in form_submission table */
        $this->db->where('id',$submission_id);
        $this->db->update('form_submission',array('status'=>$status));   
    }
    public function approved_review_history($submission_id,$approved_by,$status){
        /* Update status id in form_review_history table */
        $this->db->where('submission_id',$submission_id);
        $this->db->where('user_id',$approved_by);
        $this->db->update('form_review_history',array('status'=>$status));    
    }
    public function decline_form_submission($submission_id,$declined_by,$status,$reject_pre_users = array()){
        /* Set rejected submission for all hierarchy users */
        /*$this->db->where('submission_id',$submission_id);
        $this->db->update('form_review_history',array('status'=>$status));*/
        /* Set form submission as declined status */
        if(count($reject_pre_users) > 0){
            $this->db->set('status',$status);
            $this->db->where_in('user_id',$users);
            $this->db->where('submission_id',$submission_id);
            $this->db->update('form_review_history');
        }

        $this->db->where('id',$submission_id);
        $this->db->update('form_submission',array('status'=>$status,'declined_by'=>$declined_by));
    }
    public function previous_approved_users($submission_id,$user_id){
        $sql = 'SELECT fh.user_id,u.email, CONCAT_WS( " ", u.firstname, u.lastname ) AS name
                FROM `form_review_history` AS fh
                JOIN users AS u ON u.id = fh.user_id
                WHERE fh.submission_id ='.$submission_id.' AND fh.user_id !='.$user_id.
                ' AND fh.status = 1';
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function set_inactive_after_reviewer($submission_id,$hide_all = array()){
        if(count($hide_all) > 0){
            $this->db->set('status','-1');
            $this->db->where_in('user_id',$hide_all);
            $this->db->where_in('submission_id',$submission_id);
            $this->db->update('form_review_history');
        }
    }
    public function get_all_hierarchy_users($submission_id){
        $sql = 'SELECT fh.user_id,u.email, CONCAT_WS( " ", u.firstname, u.lastname ) AS name
                FROM `form_review_history` AS fh
                JOIN users AS u ON u.id = fh.user_id
                WHERE fh.submission_id ='.$submission_id;
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function reassign_user_form_status($reassign_users,$submission_id,$form_id,$status,$current_user){
      
        foreach ($reassign_users as $key => $value) {
            $this->db->where('user_id',$value);
            $this->db->where('submission_id',$submission_id);
            $this->db->where('form_id',$form_id);
            //if($value == $current_user){
            //    $this->db->update('form_review_history',array('status'=>'0'));
            //}else{
                $this->db->update('form_review_history',array('status'=>'3'));
            //}
            //echo $this->db->last_query();
        }
        $this->db->where('id',$submission_id);
        $this->db->update('form_submission',array('status'=>$status,'reassigned_by'=>$current_user,'reassigned_to'=>implode(',',$reassign_users)));
    }
    public function org_form_list($org_id,$user_id){
        
        $this->db->select('f.form_id,f.form_name,f.form_desc,fc.cat_id,f.updated_at,c.category_name,f.form_content as form_data,uf.submission,uf.important') 
             ->from('form_details as f')
             ->join('form_category fc','fc.form_id = f.form_id')
             ->join('category c','c.cat_id = fc.cat_id')
             ->join('user_form uf','uf.form_id = f.form_id')
             ->where('f.org_id',$org_id)
             ->where('f.status','1')
             ->where('uf.user_id',$user_id);
        //$this->db->group_by('f.form_id');
        $result = $this->db->get();
        
        if($result->num_rows()){
            return $result->result_array();
        }
        else{
            return false;
        }  
    }
    public function org_form($org_id,$location_id){
        $this->db->select('f.form_id,f.form_name,f.form_desc,fc.cat_id,f.updated_at,c.category_name,f.form_content as form_data') 
             ->from('form_details as f')
             ->join('form_category fc','fc.form_id = f.form_id')
             ->join('category c','c.cat_id = fc.cat_id')
             ->join('form_location fl','fl.form_id = f.form_id')
             ->where('f.org_id',$org_id)
             ->where('f.status','1')
             ->where('fl.location_id',$location_id);
        //$this->db->group_by('f.form_id');
        $result = $this->db->get();
        if($result->num_rows()){
            return $result->result_array();
        }
        else{
            return false;
        }
    }
    public function review_form_user($user_id,$org_id){
        $this->db->select('fh.form_id')
                 ->from('form_hierarchy_position fh')
                 ->join('users u','u.id = fh.user_id')
                 ->where('u.org_id',$org_id)
                 ->where('u.activation','1')
                 ->where('fh.user_id',$user_id);
        $res = $this->db->get()->result_array();
        return $res;
    }
    public function user_form($user_id,$org_id){
        $this->db->select('uf.form_id,uf.submission,uf.important')
                 ->from('user_form uf')
                 ->join('users u','u.id = uf.user_id')
                 ->where('u.org_id',$org_id)
                 ->where('u.activation','1')
                 ->where('uf.user_id',$user_id);
        $res = $this->db->get()->result_array();
        return $res;   
    }
    public function location_list($org_id){
      $this->db->select('ol.id')
                ->from('org_location ol')
                ->where('ol.org_id',$org_id)
                ->where('ol.status','1');
      $list = $this->db->get()->result_array();
      $location =array();
        foreach($list as $key=>$value){
            $location[] = $value['id'];
        }
        $this->db->select('fl.form_id,fl.location_id')
                 ->from('form_location fl')
                 ->where_in('fl.location_id',$location);
        $form_location = $this->db->get()->result_array();
        return $form_location;
    }
    public function update_userformsubmissioncount($formid,$userid){
        $this->db->select('a.submission')
            ->from('user_form as a')
            ->where('a.form_id ='.$formid.' AND a.user_id ='.$userid);
        $result = $this->db->get();
        if($result->num_rows()){
            $submission = $result->row()->submission;
            $count = ++$submission;
            $this->db->set('submission',$count);
            $this->db->where('form_id = '.$formid.' AND user_id = '.$userid);
            $this->db->update('user_form');
        }else{
            $submission = 1;
            $count = 1;
            $this->db->insert('user_form',array('form_id'=>$formid,'user_id'=>$userid,'submission'=>$submission));
        }
        return $count;
    }
    public function get_user_form_submission_count($form_id,$user_id){
        $this->db->select('a.submission')
            ->from('user_form as a')
            ->where('a.form_id ='.$form_id.' AND a.user_id ='.$user_id);
        $result = $this->db->get()->row()->submission;
        return $submission;
    }   
}