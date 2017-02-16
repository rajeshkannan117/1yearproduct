<?php 
require_once('V2.php');
//error_reporting(0);
class V3 extends V2{
	/*public function __construct(){
		parent::__construct();
		$this->load->model('api/userv2_model');
		$this->load->model('api/formv2_model');
		$this->load->helper(array('form', 'url'));
	}*/

    /**
     * Changed on 25th september in favour of alerts change
     * Changed by Vignesh.M
     * Requested by Sathish Kannan.
     *
     */
	public function get_user_location_post(){
		$post_request= file_get_contents('php://input');
		$request=json_decode($post_request,true);
		$user_id = $request['user_id'];
		$org_id  = $request['organization_id'];
        $device_token = $request['device_token'];
		$data = $this->user_model->user_check($request['token'],$user_id);
		if($data['msg'] == 'success'){
            //new function for getting location and managers is being called
			$users = $this->userv2_model->get_location_and_managers($user_id,$org_id);
			$profile = $this->user_model->user_profile($user_id);
            if($device_token != ''){
                $this->store_device_token($device_token,$user_id);
            }
			$this->response(array("msg"=>'success','location'=>$users,'profile'=>$profile), 200);

		}else{
			$msg = array("msg" => $data['msg']);
			$this->response($msg,202);
		}
	}

    public function user_token_post(){
        $post_request= file_get_contents('php://input');
        $request=json_decode($post_request,true);
        $user_id = $request['user_id'];
        $org_id  = $request['organization_id'];
        $device_token = $request['device_token'];
        $data = $this->user_model->user_check($request['token'],$user_id);
        if($data['msg'] == 'success'){
            //new function for getting location and managers is being called
            if($device_token != ''){
                $this->store_device_token($device_token,$user_id);
            }
            $this->response(array("msg"=>'success'), 200);

        }else{
            $msg = array("msg" => $data['msg']);
            $this->response($msg,202);
        }
    }
    public function org_form_list_get(){
        $token = $this->get('token');
        $user_id = $this->get('user_id');
        $org_id = $this->get('organization_id');
        $data = $this->user_model->user_check($token,$user_id);
        if($data['msg'] == 'success'){
            $form_list = $this->formv2_model->org_form_list($org_id,$user_id);
            foreach($form_list as $key=>$value){
                $form[$value['form_id']] = $value;
            }
            //print_r($form);
            /*  Get review form id */
            $review_form_user = $this->formv2_model->review_form_user($user_id,$org_id);
            foreach($review_form_user as $key=>$value){
                $form_id[] = $value['form_id'];
            }
            /* get all location forms */
            $location = $this->formv2_model->location_list($org_id);
            $form_details = array();
            foreach($location as $key=>$value){
                if(isset($form[$value['form_id']])){
                    if(in_array($value['form_id'],$form_id)){
                        $form[$value['form_id']]['can_review'] = '1';
                    }else{
                        $form[$value['form_id']]['can_review'] = '0';
                    }
                    $form[$value['form_id']]['location_id'] = (int)$value['location_id'];
                    $form_details[$value['location_id']][] = $form[$value['form_id']];
                }
            } 
            $profile = $this->user_model->user_profile($user_id);
            $this->response(array("msg"=>'success','forms'=>$form_details,'profile'=>$profile), 200);
        }else{
            $msg = array("msg" => 'Your session expired.Please Login');
            $this->response($msg,401);
        }
    }

    public function usercategories_post(){

        $post_request= file_get_contents('php://input');
        $request=json_decode($post_request,true);
        $data = $this->user_model->user_check($request['token'],$request['user_id']);
        $userid = $request['user_id'];
        $org_id = $request['organization_id'];
        $location_id = $request['location_id'];
        if($data['msg'] == 'success'){
            $review_form_id = array();
            $user_form_id = array();
            $form_list = array();
            $org_form = $this->formv2_model->org_form($org_id,$loc_id);
            /* Check user Categories */
            $categories = $this->userv2_model->user_categories($userid,$org_id);
            $review_form_user = $this->userv2_model->review_user_categories($userid,$org_id,$location_id);
            //print_r($review_form_user);exit;
            $categoriess = array();
            if($categories){
                foreach($categories as $key => $value){
                    $list['categoryDescription'] = $value['category_desc'];
                    $list['categoryId'] = $value['cat_id'];
                    $list['createdDate'] = $value['created_at'];
                    $list['name'] = $value['category_name'];
                    $list['updatedDate']  = $value['updated_at'];
                    $list['location_id'] = $location_id;
                    $list['isRoot'] = 1;
                    $list['parentCategoryId'] = 0;
                    $categoriess[] = $list;
                }
            }
            foreach($review_form_user as $key=>$value){
                $list['categoryDescription'] = $value['category_desc'];
                    $list['categoryId'] = $value['cat_id'];
                    $list['createdDate'] = $value['created_at'];
                    $list['name'] = $value['category_name'];
                    $list['updatedDate']  = $value['updated_at'];
                    $list['location_id'] = $location_id;
                    $list['isRoot'] = 1;
                    $list['parentCategoryId'] = 0;
                    $categoriess[] = $list;
            }
            if(count($categoriess) > 0){
                $msg = array('categories' => $categoriess);
                $this->response($msg,200);
            }
            else{
                $msg = array('msg' => 'You are not assigned with any forms');
                $this->response($msg,204);
            }
        }
        else{
            $msg = array("msg" => $data['msg']);
            $this->response($msg,202);
        }
    }

    public function formlist_post(){

        $post_request= file_get_contents('php://input');
        $request=json_decode($post_request,true);
        $data = $this->user_model->user_check($request['token'],$request['user_id']);
        //print_r($data); exit;
        $userid = $request['user_id'];
        $org_id = $request['organization_id'];
        $loc_id = $request['location_id'];
        if($data['msg'] == 'success'){

            /* Get List Of Form */
            $review_form_id = array();
            $user_form_id = array();
            $form_list = array();
            $org_form = $this->formv2_model->org_form($org_id,$loc_id);

            /*  Get review form id */
            $review_form_user = $this->formv2_model->review_form_user($userid,$org_id);
            foreach($review_form_user as $key=>$value){
                $review_form_id[] = $value['form_id'];
            }
            /* Get user forms */
            $user_form = $this->formv2_model->user_form($userid,$org_id);
            foreach($user_form as $key=>$value){
                $user_form_id[] = $value['form_id'];
                $datas[$value['form_id']]['submission'] = $value['submission'];
                $datas[$value['form_id']]['important'] = $value['important'];
            }$i= 0;
            foreach($org_form as $key=>$value){

                if(in_array($value['form_id'],$review_form_id) || in_array($value['form_id'],$user_form_id)){
                        $form_list[$i]['form_id']=$value['form_id'];
                        $form_list[$i]['form_name']=$value['form_name'];
                        $form_list[$i]['form_desc']=$value['form_desc'];
                        $form_list[$i]['cat_id']=$value['cat_id'];
                        $form_list[$i]['updated_at']=$value['updated_at'];
                        $form_list[$i]['category_name']=$value['category_name'];
                        $form_list[$i]['form_data']=$value['form_data'];
                        $form_list[$i]['location_id']=$loc_id;
                    if(in_array($value['form_id'],$review_form_id)){
                        $form_list[$i]['can_review'] = '1';
                        $form_list[$i]['submission'] = '0';
                        $form_list[$i]['important'] = '0';
                    }else if(in_array($value['form_id'],$user_form_id)){
                        $form_list[$i]['can_review'] = '0';
                        $form_list[$i]['submission'] = $datas[$value['form_id']]['submission'];
                        $form_list[$i]['important'] = $datas[$value['form_id']]['important'];
                    }
                    $i++;
                }
            }
            if(count($form_list) > 0){
                $msg = array('forms' => $form_list);
                $this->response($msg,200);
            }
            else{
                $msg = array('msg' => 'Forms Not Found');
                $this->response($msg,204);
            }
        }
        else{
            $msg = array("msg" => 'Your session expired.Please Login');
            $this->response($msg,401);
        }
    }
    public function changeprofile_post(){

        $token = $this->post('token');
        $user_id = $this->post('user_id');
        $org_id = $this->post('organization_id');
        
        $request=json_decode($post_request,true);
        $data = $this->user_model->user_check($token,$user_id);
        if($data['msg'] == 'success'){
          
            if(isset($_FILES)){
                $path = IMAGE_PATH/*$org_id.'/'.$location_id.'/'.$form_id.'/'.$user_id*/;
                if(!is_dir($path)) //create the folder if it's not already exists
                {
                    @mkdir($path,0777,TRUE);
                    chmod($path, 0777);
                    /*chmod(IMAGE_PATH.$org_id, 0777);
                    chmod(IMAGE_PATH.$org_id.'/'.$location_id, 0777);
                    chmod(IMAGE_PATH.$org_id.'/'.$location_id.'/'.$form_id, 0777);*/
                } 
                $config['upload_path']          = $path;
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $profile_image = time().$_FILES["image"]['name'];
                $config['file_name'] = $profile_image;
                $this->load->library('upload', $config);
                //print_r($_FILES['image']);exit;
                if(!$this->upload->do_upload(image)){
                    $error = array('error' => $this->upload->display_errors());
                    $msg = array('msg' => 'Some Error with ur images');
                    $this->response($msg,202);
                }else{
                    //$profile_image = $_FILES['image']['name'];
                    $this->_createThumbnail($profile_image,IMAGE_PATH,THUMB_IMAGE_PATH);
                    if($this->user_model->update_profile($user_id,$profile_image)){
                        $msg = array('msg'=>'Success','profileImage' => base_url().'uploads/user/'.$profile_image);
                        $this->response($msg,200);
                    }
                }
            }
        }
    }   
    public function _createThumbnail($filename,$imagepath,$thumb_path)
    {
        //echo substr($thumb_path,1).$filename;exit;
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $imagepath.$filename;
        $config['new_image']='/'.substr($thumb_path,1);
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['overwrite'] = true;
        $config['thumb_marker'] = '';
        $config['width']  = 50;
        $config['height'] = 50;
        $config['master_dim'] = 'auto';
    
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        if ( ! $this->image_lib->resize())
        {
            //echo $this->image_lib->display_errors();
        }
        //$this->image_lib->resize();
        $this->image_lib->clear();
        //echo $this->image_lib->display_errors();exit;
    }
	public function formsubmit_post(){
		$token = $this->post('token');
		$user_id = $this->post('user_id');
		$form_id = $this->post('form_id');
		$org_id = $this->post('organization_id');
		$api_formid = $this->post('api_formid');
		$location_id = $this->post('location_id');
		$data = $this->user_model->user_check($token,$user_id);
		$form_values = $this->post('json_values');
        $status = $this->post('submission_status');
        if($data['msg'] == 'success'){
			if(isset($_FILES)){
				$path = FORM_LIVE_PATH.$org_id.'/'.$location_id.'/'.$form_id.'/'.$user_id;
				if(!is_dir($path)) //create the folder if it's not already exists
    			{
     				@mkdir($path,0777,TRUE);
     				chmod($path, 0777);
     				chmod(FORM_LIVE_PATH.$org_id, 0777);
     				chmod(FORM_LIVE_PATH.$org_id.'/'.$location_id, 0777);
     				chmod(FORM_LIVE_PATH.$org_id.'/'.$location_id.'/'.$form_id, 0777);
    			} 
				$config['upload_path']          = $path;
                $config['allowed_types']        = '*';
                $this->load->library('upload', $config);
				foreach($_FILES as $key=>$value){
					if(! $this->upload->do_upload($key))
	                {
	                    $datas[] = array('error' => $this->upload->display_errors());
	                }else{
	                    $datas[$key] =$this->upload->data();
					}
				}
			}
            //print_r($datas);
            /* Initial it will save the submission id */
            $uuid = $this->uuid->v4();
            $response = $this->formv2_model->form_submit($user_id,$form_id,$org_id,$location_id,$uuid);
            $count = $this->formv2_model->get_user_form_submission_count($form_id,$user_id);
            $submission_id = $response['submission_id'];
			/* Loop the post variables and save those into the table */
			foreach($this->post() as $key=>$value){
			    $key_split = explode('_',$key);
		    /*		
                $key_split[0] - fieldid
				$key_split[1] - form_field_id
				$key_split[2] - fieldtypes
            */
				$insert = array();
				$insert['user_id'] = $user_id;
				$insert['form_id'] = $form_id;
				$insert['submission_id'] = $submission_id;
				/* Insert new submission */	
				if(count($key_split) === 3){
					$insert['form_field_id'] = $key_split[1];
                    if($value != ''){
				    	$insert['answer'] = $value;
					   /* Save options field into user info text table */
					   $user_info_text_field[$key_split[1]] = $this->formv2_model->user_info_text($insert);
                    }
				}
			}
            //$form_values = json_encode($form_values);
            /* Rearrange json values with files data */
            $json_values = json_decode($form_values);
            foreach($json_values->fields as $key=>$pages){
                foreach($pages as $c=>$cols){
                    foreach($cols as $i=>$single){
                        if($single->fieldtype === '3'){
                            $type = $single->fieldid.'_'.$single->formfieldid.'_'.$single->fieldtype;
                            $single->value = base_url().'uploads/'.$org_id.'/'.$location_id.'/'.$form_id.'/'.$user_id.'/'.$datas[$type]['file_name'];
                            $insert = array();
                            $insert['user_id'] = $user_id;
                            $insert['form_id'] = $form_id;
                            $insert['form_field_id'] = $single->formfieldid;
                             $insert['submission_id'] = $submission_id;
                            $insert['answer'] = $single->value;
                            $single->user_info_text_id = $this->formv2_model->user_info_text($insert);
                        }else{
                            $single->user_info_text_id = $user_info_text_field[$single->formfieldid];
                        }
                    }
                }
            }
            //echo $json_values;
            $form_values = json_encode($json_values);
            $notification_data = array();
            /* Check Form Has workflow or not  */
            $check_form_flow = $this->formv2_model->check_form_workflow($form_id);
            if($check_form_flow == 'workflow'){
                /* If Workflow set submission status is 0 and review status 0 */
                $status = '0';
                $notification_data['details']['title'] = 'Submission against '.$form_name.' is waiting for your review ';
                $notification_data['title'] = 'Submission against '.$form_name.' is waiting for your review ';
                $notification_data['type'] = '1.3';
                $notification_data['type_name'] = 'Form Submission waiting for review';
            
            }else{
                /* If Workflow not Set submission status and review status is 1  */
                $status = '1';
                $notification_data['details']['title'] = 'Submission against '.$form_name.' is created';
                $notification_data['title'] = 'Submission against '.$form_name.' is created';
                $notification_data['type'] = '1.2';
                $notification_data['type_name'] = 'Form Submission';
            }
            /* Update JSON Values with file name for file input field*/
            $this->formv2_model->update_form_submission($form_values,$submission_id,$status);

            /* Set New Submission Review History */
            /* Get Submission order */
            $sort = $this->formv2_model->get_form_hierarchy_submission($user_id,$form_id);
            foreach($sort as $key=>$value){
                $sort_user[] = $value['user_id'];
            }

            /* Set initial user */

            $notify_to = array();
            $notify_to[]= $sort_user[0];
            $reviewer = $sort_user[0];

            /* Store Hierarchy position */

            $this->formv2_model->store_hierarchy_position($sort_user,$user_id,$form_id,$submission_id,$status);

			$profile = $this->user_model->user_profile($user_id);  

            $user_details = $this->userv2_model->get_user_details($user_id,$org_id);
            $message = array(
                'name' => $user_details->name
            );            
            /* Send Acknowledgement mail for Submission */

            /*$subject = $this->lang->line('acknowledgement_subject');
            $send_to = $user_details->email;
            $acknowledgement_message['receiver_name'] = $user_details->name;
            $acknowledgement_message['name'] = $user_details->name;
            $acknowledgement_message['form_name'] = $form_name;
            $acknowledgement_message['location_name']  = $location_name;
            $acknowledgement_message['datetime'] = date('Y-m-d H:i:s');
            send_email('no-reply@formpro.com','Formpro Admin',$send_to,'acknowledgement.php',$subject,$acknowledgement_message);*/

            /* Alert the reviewer user for submission */

            /*$reviewer = $sort_user[0];
            $next_user=$this->userv2_model->get_user_details($reviewer,$org_id);
            $subject = $this->lang->line('submission');
            $send_to = $next_user->email;
            $review_message['receiver_name'] = $next_user->name;
            $review_message['name'] = $next_user->name;
            $review_message['form_name'] = $form_name;
            $review_message['location_name']  = $location_name;
            $review_message['datetime'] = date('Y-m-d H:i:s');
            if($check_form_flow == 'workflow'){                        
                send_email('no-reply@formpro.com','Formpro Admin',$send_to,'submission.php',$subject,$review_message);    
            }else{
                send_email('no-reply@formpro.com','Formpro Admin',$send_to,'resolved.php',$subject,$review_message);
            }*/

            /* Notification */

            /* Set Push Notification */

            $notification_data['details']['form_id'] = $form_id;
            $notification_data['details']['org_id'] = $org_id;
            $notification_data['details']['submission_id'] = $submission_id;
            $notification_data['details']['location_id'] = $location_id;
            $notification_data['users'] = $notify_to;
            $notification_data['status'] = '1';
            $notification_data['type_id'] = '1.3';
            $notification_data['created_at'] = gmdate('Y-m-d H:i:s');
            $notification_data['updated_at'] = gmdate('Y-m-d H:i:s');
            $notification_data['description'] =  $review_description;
            $this->formv2_model->general_notifications_insert($notification_data);
            
			$return['submission_id'] = (string)$submission_id;
			$return['count'] = (string)$count;
			$return['api_formid'] = $api_formid;
			$return['form_id'] = $form_id;
            /* Get Device token for the user */
            $to_push_notifi = $this->user_device_token($reviewer);
            /* Push Notification to android */
            foreach($to_push_notifi['android'] as $key=>$value){
                $this->pushnotifications->android($notification_data,$value);
            }
            /* Push Notification to ios  */
            foreach($to_push_notifi['ios'] as $key=>$value){
                $this->pushnotifications->ios($notification_data,$value);
            }
            /*send_email('no-reply@formpro.com','Formpro Admin',$user_details->email,'submission_status.php',$message);*/
            $msg = array("msg" => 'Form submitted successfully','data'=>$return,'profile'=>$profile);

            $this->response($msg,200);
		}
		else{
			$msg = array("msg" => 'Your session expired.Please Login');
			$this->response($msg,401);
		}
	}
    public function formresubmit_post(){
        $token = $this->post('token');
        $user_id = $this->post('user_id');
        $form_id = $this->post('form_id');
        $org_id = $this->post('organization_id');
        //$api_formid = $this->post('api_formid');
        $location_id = $this->post('location_id');
        $data = $this->user_model->user_check($token,$user_id);
        $form_values = $this->post('json_values');
        $status = $this->post('submission_status');
        $submission_id = $this->post('submission_id');
        if($data['msg'] == 'success'){
            if(isset($_FILES)){
                $path = FORM_LIVE_PATH.$org_id.'/'.$location_id.'/'.$form_id.'/'.$user_id;
                //print_r($_FILES);exit;
                if(!is_dir($path)) //create the folder if it's not already exists
                {
                    @mkdir($path,0777,TRUE);
                    chmod($path, 0777);
                    chmod(FORM_LIVE_PATH.$org_id, 0777);
                    chmod(FORM_LIVE_PATH.$org_id.'/'.$location_id, 0777);
                    chmod(FORM_LIVE_PATH.$org_id.'/'.$location_id.'/'.$form_id, 0777);
                } 
                $config['upload_path']          = $path;
                $config['allowed_types']        = '*';
                $this->load->library('upload', $config);
                foreach($_FILES as $key=>$value){
                    $key_split = explode('_',$key);
                    if(! $this->upload->do_upload($key))
                    {
                        $datas[] = array('error' => $this->upload->display_errors());
                    }else{
                        $datas[$key_split[3]] =$this->upload->data();
                    }
                }
            }
            foreach($this->post() as $key=>$value){
                 //$pattern = "/^[0-9]{1,}_[0-9]{1,}$/";
                $pattern = "/^\d+_\d+_\d+_\d+$/";
                $check = preg_match($pattern, $key);
                if($check){
                    $resubmitted[$key] = $value; 
                }
            }
            //print_r($resubmitted);
            $sort = $this->formv2_model->get_form_hierarchy_submission($user_id,$form_id);
            foreach($sort as $key=>$value){
                $sort_user[] = $value['user_id'];
            }

            /* Loop the post variables and save those into the table */
            foreach($resubmitted as $key=>$value){
                
            /*      
                $key_split[0] - fieldid
                $key_split[1] - form_field_id
                $key_split[2] - fieldtypes
                $key_split[3] - user form info text id
            */
                $key_split = explode('_',$key);
                $insert = array();
                $insert['user_id'] = $user_id;
                $insert['form_id'] = $form_id;
                $insert['submission_id'] = $submission_id;
                /* Update the old submission_values based on user_info_form_text_id */
                if(count($key_split) == 4){
                    /* Update resubmitted form values */
                    $insert['form_field_id'] = $key_split[1];
                    if($value != ''){
                        $insert['answer'] = $value;
                        $user_info_text_fied_id = $key_split[3];
                        /* Save options field into user info text table */
                    $this->formv2_model->user_info_text_update($insert,$user_info_text_fied_id);
                    }
                }
            }
            /* Update previous submission hierarchy */
            $reassign = $this->formv2_model->get_reassign_to_users($submission_id); 
            $reassigns = explode(',',$reassign);
            //print_r($reassigns); //0,86
            foreach($reassigns as $key=>$value){
                $this->formv2_model->update_hierarchy_position($submission_id,$value);
            }
            $first_reviewer_id = $reassigns[0];
            //echo $first_reviewer_id; //86
            $first_reviewer = $this->userv2_model->get_user_details($first_reviewer_id,$org_id);
            if(is_array($datas)){
                $json_values = json_decode($form_values);
                foreach($json_values->fields as $key=>$pages){
                    foreach($pages as $c=>$cols){
                        foreach($cols as $i=>$single){
                            if($single->fieldtype === '3'){
                                $type = $single->user_info_text_id;
                                if(isset($datas[$type]['file_name'])){
                                    $single->value = base_url().'uploads/'.$org_id.'/'.$location_id.'/'.$form_id.'/'.$user_id.'/'.$datas[$type]['file_name'];
                                }
                                $insert = array();
                                $insert['user_id'] = $user_id;
                                $insert['form_id'] = $form_id;
                                $insert['form_field_id'] = $single->formfieldid;
                                $insert['submission_id'] = $submission_id;
                                $insert['answer'] = $single->value;
                                $this->formv2_model->user_info_file_update($insert,$single->user_info_form_text_id);
                            }
                            $single->comments = '';
                        }
                    }
                }
                $form_values = json_encode($json_values);
            }
            $this->formv2_model->update_form_submission($form_values,$submission_id);
            $count = $this->formv2_model->get_user_form_submission_count($form_id,$user_id);
            $profile = $this->user_model->user_profile($user_id);
            $return['submission_id'] = (string)$submission_id;
            $return['count'] = (string)$count;
            $return['api_formid'] = $api_formid;
            $return['form_id'] = $form_id;
            /* GET USER DETAILS */
            $user_details = $this->userv2_model->get_user_details($user_id,$org_id);

            /* Send Acknowledgement mail for Submission */
            /*$subject = $this->lang->line('acknowledgement_subject');
            $send_to = $user_details->email;
            $acknowledgement_message['receiver_name'] = $user_details->name;
            $acknowledgement_message['name'] = $user_details->name;
            $acknowledgement_message['form_name'] = $form_name;
            $acknowledgement_message['location_name']  = $location_name;
            $acknowledgement_message['datetime'] = date('Y-m-d H:i:s');
            send_email('no-reply@westin.com','Westin Admin',$send_to,'acknowledgement.php',$subject,$acknowledgement_message);
*/
            /* Alert the user for review the submission */
            //print_r($sort_user); //87 88
            $reviewer = $sort_user[0];        
            //echo $reviewer; //88
            $next_user=$this->userv2_model->get_user_details($reviewer,$org_id);
           /* $subject = $this->lang->line('submission');
            $send_to = $next_user->email;
            $review_message['receiver_name'] = $next_user->name;
            $review_message['name'] = $next_user->name;
            $review_message['form_name'] = $form_name;
            $review_message['location_name']  = $location_name;
            $review_message['datetime'] = date('Y-m-d H:i:s');
            send_email('no-reply@westin.com','Westin Admin',$send_to,'submission.php',$subject,$review_message);*/

            /* Set Push Notification */
            $notification_data['details']['form_id'] = $form_id;
            $notification_data['details']['submission_id'] = $submission_id;
            $notification_data['details']['org_id'] = $org_id;
            $notification_data['details']['location_id'] = $location_id;
            $notification_data['title'] = 'Submission against '.$form_name.' is resubmitted and waiting for your review ';
            $notification_data['description'] =  $review_description;
            $notification_data['users'] = $reviewer;
            $notification_data['status'] = '1';
            $notification_data['type_id'] = '1.3';
            $notification_data['type'] = '1.3';
            $notification_data['type_name'] = 'Form Resubmitted';
            $notification_data['created_at'] = gmdate('Y-m-d H:i:s');
            $notification_data['updated_at'] = gmdate('Y-m-d H:i:s');
            $notification_data['description'] =  $review_description;
            
            /* Get Device token for the user */
            $to_push_notifi = $this->user_device_token($reviewer);
            /* Push Notification to android */
            foreach($to_push_notifi['android'] as $key=>$value){
                $this->pushnotifications->android($notification_data,$value);
            }
            /* Push Notification to ios */
            foreach($to_push_notifi['ios'] as $key=>$value){
                $this->pushnotifications->ios($notification_data,$value);
            }

            $msg = array("msg" => 'Form Resubmitted successfully','data'=>$return,'profile'=>$profile);
            $this->response($msg,200);
        }
        else{
            $msg = array("msg" => 'Your session expired.Please Login');
            $this->response($msg,401);
        }

    }
    public function send_email($from,$from_name,$send_to,$email_template,$subject,$message){
        $this->load->library('email');
        $type = array (
            'mailtype' => 'html',
            'charset'  => 'utf-8',
            'priority' => '1'
        );
        $data = array(
            'name'=> $message['name'],  // Users Name
            'message' => 'Your submission success'
        );
        $this->email->initialize($type);
        $this->email->set_newline("\r\n");
        $this->email->from($from, $from_name);
        $this->email->to($send_to);  // replace it with receiver mail id
        $this->email->subject($subject); // replace it with relevant subject 
        $body = $this->load->view('emails/'.$email_template,$data,TRUE);
        $this->email->message($body);
        if($this->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function create_alert_post()
    {
        define('FORM_LIVE_PATH',FCPATH.'uploads/');
        //print_r($_POST);exit;
        $token = $this->post('token');
        $user_id = $this->post('user_id');
        $org_id = $this->post('organization_id');
        $location_id = $this->post('location_id');
        $title = $this->post('issue_title');
        //$reporting_to = $this->post('reporting_to');
        //$data = $this->user_model->user_check($token,$user_id);
        $data['msg'] = 'success';
        //SETTING AUTH AS SUCCESS BECAUSE IT IS THROWING ERROR
        if($data['msg'] == 'success') {
            //inserting alert data
            $alertData = array(
                "title" => $this->post('issue_title'),
                "description" => $this->post('description'),
                "job_site_id" => $location_id,
                "user_id" => $user_id,
                "organization_id"=>$org_id,
                "created_at" => gmdate(date('Y-m-d H:i:s')),
                "updated_at" => gmdate(date('Y-m-d H:i:s')),
                "uuid" => $this->uuid->v4()
            );
            $reporting = $this->userv2_model->get_reporting_authorities($org_id,$location_id);
            foreach($reporting as $key=>$value){
                if($value['id'] != $user_id && $value['role_id'] != 1){
                    $reporting_to[]= $value['id'];
                }
            }
            if(count($reporting_to) == 0){
                $msg = array("msg" => 'No reporting authority in this location');
                $this->response($msg,422);
            } 

            //creating one alert and retriving it's id
            $alertId = $this->formv2_model->alert_create($alertData);
            //uploading images if there are any images
            if(isset($_FILES ) && count($_FILES) > 0){

                $insertImg = array();
                $path = FORM_DEV_PATH.$org_id.'/'.$location_id.'/alert'.$alertId;
                //echo $path;
                if(!is_dir($path)) //create the folder if it's not already exists
                {
                    if(!mkdir($path,0777,TRUE)){
                        die('Failed to create folders...');
                    }
                    chmod($path, 0777);
                    chmod(FORM_DEV_PATH.$org_id, 0777);
                    chmod(FORM_DEV_PATH.$org_id.'/'.$location_id, 0777);
                    chmod(FORM_DEV_PATH.$org_id.'/'.$location_id.'/alert'.$alertId, 0777);
                }                
                $config['upload_path']          = $path;
                $config['allowed_types']        = '*';
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                foreach($_FILES as $key=>$value){
                    if(! $this->upload->do_upload($key)) {
                        $error[] = array('error' => $this->upload->display_errors());
                    } else {
                        //creating data holder for inserting image data to db
                        $datas =$this->upload->data();
                        $imageDB = array(
                            "image_name" => $datas["file_name"],
                            "alert_id" => $alertId
                        );
                        $insertImg[] = $imageDB;
                    }
                }
                //inserting image data in databse
                $res = $this->formv2_model->insert_alert_images($insertImg);
            }
            //checking for comment presence
            if($this->post('comment') && $this->input->post('comment') != "") {
                $comment = array(
                    "comment" => $this->post('comment'),
                    "alert_id" => $alertId,
                    "user_id" => $user_id,
                    "created_at" => gmdate('Y-m-d H:i:s')
                );
                //creating comment
                $this->formv2_model->insert_comment($comment);
            }
            $mapData = array();
            //inserting multiple records for reporting user in the alert mapping
            $reporting_to = array_unique($reporting_to);
            foreach($reporting_to as $item) {
                $mapData[] = array(
                    "alert_id" => $alertId,
                    "reporting_to" => $item
                );
            }
            if(count($mapData) > 0) {
                $this->formv2_model->insert_alert_mapping($mapData);
            }
            /* Set Push Notification */
            $notification_data['details']['alert_id'] = $alertId;
            $notification_data['details']['location_id'] = $location_id;
            $notification_data['title'] = 'Alert raised against you as '.$title.'';
            $notification_data['details']['title'] = 'Alert raised against you as '.$title.'';
            $notification_data['description'] =  $this->post('description');
            $notification_data['type'] = '2.1';
            /* Get Device token for the user */
            $to_push_notifi = array();
            foreach($reporting_to as $key=>$value){
                $to_push_notifi[] = $this->user_device_token($value);
            }
            $to_push_notifi = array_filter($to_push_notifi);
            foreach($to_push_notifi as $keys=>$values){
                /* Push Notification to android */
                foreach($values['android'] as $key=>$value){
                    $this->pushnotifications->android($notification_data,$value);
                }
                /* Push Notification to ios */
                foreach($values['ios'] as $key=>$value){
                    $this->pushnotifications->ios($notification_data,$value);
                }
            }
            //exit;
            $result = array(
                "alert_id" => $alertId,
                "msg" => "alert created successfully"
            );
            $this->response($result, 200);

        } else {
            $msg = array("msg" => 'Your session expired.Please Login');
            $this->response($msg,401);
        }
    }

    public function add_comment_post()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $alert_id = $input['alert_id'];
        $user_id = $input['user_id'];
        $comments = $input['comment'];
        $comment = array(
            "comment" => $input['comment'],
            "alert_id" => $input['alert_id'],
            "user_id" => $input['user_id'],
            "created_at" => gmdate('Y-m-d H:i:s'),
        );
        $result = array();
        if($this->formv2_model->insert_comment($comment)) {
        /* Set Push Notification */
            $user = $this->userv2_model->get_alert_user_details($user_id);
            $alert_title = $this->formv2_model->get_alert_title($alert_id);          
            $notification_data['details']['alert_id'] = $alert_id;
            $notification_data['details']['user_id'] = $user_id;
            $notification_data['title'] = $user->name.' added comments for the alert '.$alert_title.' ';
            $notification_data['details']['title'] = $user->name.' added comments for the alert '.$alert_title.' ';
            $notification_data['description'] =  $comments;
            $notification_data['type'] = '2.2';
            //check alert owner
        $rows = $this->formv2_model->alert_owner_check($input['alert_id'],$input['user_id']);
        if($rows){
            /* If I am owner of the alert when i Comment send those comment to all reporting authority */
            /* get reported user for the alert */
            $push = $this->formv2_model->get_reported_user_alerts($input['alert_id']);
            foreach($push as $key=>$value){
                $reporting_to[] = $value['reporting_to'];
            }

        }else{
            /* If I am not owner of the alert when i Comment send those comment to all reporting authority except me and staff*/
            // push notification to alert owner
            $alert_owner = $this->formv2_model->get_alert_owner($alert_id,$user_id);
            $push = $this->formv2_model->get_reported_user_alerts($input['alert_id']);
            foreach ($push as $key => $value) {
                # code... Removes the current commented users and 
                if($value['reporting_to'] != $user_id){
                    $reporting_to[] = $value['reporting_to'];
                }
            }
            $reporting_to[]= $alert_owner;
        }                
        /* Get Device token for the user */
        $to_push_notifi = array();
        foreach($reporting_to as $key=>$value){
            $to_push_notifi[] = $this->user_device_token($value);
        }
        $to_push_notifi = array_filter($to_push_notifi);
        foreach($to_push_notifi as $keys=>$values){
            /* Push Notification to android */
            foreach($values['android'] as $key=>$value){
                $this->pushnotifications->android($notification_data,$value);
            }
            /* Push Notification to ios */
            foreach($values['ios'] as $key=>$value){
                $this->pushnotifications->ios($notification_data,$value);
            }            
        }
            $result['msg'] = "comment added successfully";
            $this->response($result, 200);
        } else {
            $result["msg"] = "Comment is not added, try later";
            $this->response($result, 400);
        }
        
    }
    public function alert_resolved_post()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $status = $input['status'];
        $post_comment = trim($input['comment']);
        $alert_id = $input['alert_id'];
        $user_id = $input['user_id'];
        if($status != 0 && $status != ''){
            if($post_comment != ''){
                $comment = array(
                    "comment" => $post_comment,
                    "alert_id" => $input['alert_id'],
                    "user_id" => $input['user_id'],
                    "created_at" => gmdate('Y-m-d H:i:s'),
                );
                $comment_insert = $this->formv2_model->insert_comment($comment);
            }
            $user = $this->userv2_model->get_alert_user_details($user_id);
            $alert_title = $this->formv2_model->get_alert_title($alert_id);          
            $notification_data['details']['alert_id'] = $alert_id;
            $notification_data['details']['user_id'] = $user_id;
            $notification_data['title'] = $user->name.' added comments for the alert '.$alert_title.' and resolved those alert ';
            $notification_data['details']['title'] = $user->name.' added comments for the alert '.$alert_title.' and resolved those alert ';
            $notification_data['description'] =  $post_comment;
            $notification_data['type'] = '2.2';
           /* If I am not owner of the alert when i Comment send those comment to all reporting authority except me and staff*/
            // push notification to alert owner
                /* get reported user for the alert */
            if($status == 1){
                $this->formv2_model->close_alert($alert_id);
                $this->formv2_model->alert_resolve_status($alert_id,$user_id);
                $notification_data['type'] = '2.3';
            }
            $alert_owner = $this->formv2_model->get_alert_owner($alert_id,$user_id);
            $push = $this->formv2_model->get_reported_user_alerts($input['alert_id']);
            foreach ($push as $key => $value) {
                # code... Removes the current commented users and 
                if($value['reporting_to'] != $user_id){
                    $reporting_to[] = $value['reporting_to'];
                }
            }
            $reporting_to[]= $alert_owner;
            /* Get Device token for the user */
            $to_push_notifi = array();
            foreach($reporting_to as $key=>$value){
                $to_push_notifi[] = $this->user_device_token($value);
            }
            $to_push_notifi = array_filter($to_push_notifi);
            foreach($to_push_notifi as $keys=>$values){
                /* Push Notification to android */
                foreach($values['android'] as $key=>$value){
                    $this->pushnotifications->android($notification_data,$value);
                }
                /* Push Notification to ios */
                foreach($values['ios'] as $key=>$value){
                    $this->pushnotifications->ios($notification_data,$value);
                }
            }
                $result['msg'] = "Alert resolved successfully";
                $this->response($result, 200);
        } else {
            $result["msg"] = "Please give correct status code for resolved";
            $this->response($result, 400);
        }
    }

    public function alert_list_get()
    {
        $userId = $this->get('user_id');
        if($userId) {
            $data = $this->formv2_model->get_alerts($userId);
            $result = array();
            foreach($data as $key=>$value) {
                foreach($value as $item){
                    if(!$result[$item['alert_id']]) {
                        $result[$item['alert_id']] = array(
                            "alert_id" => $item['alert_id'],
                            "title" => $item['title'],
                            "description" => $item['description'],
                            "job_site" => $item['job_site_id'],
                            "created_at" => $item['created_at'],
                            "have_attachements" => (bool)$item['attachment'],
                            "status" => $item["status"]
                        );
                    }
                    $tempHolder = array(
                        "name" =>$item['name'],
                        "id" => $item['id']
                    );
                    $result[$item['alert_id']]['reporting_to'][] = $tempHolder;
                }
            }
            $result = array_values($result);
            $response = array(
                "active" => array(),
                "inactive" => array(),
            );
            foreach($result as $item) {
                if($item['status'] === '1') {
                    $response['active'][] = $item;
                } else {
                    $response['inactive'][] = $item;
                }
            }
            $this->response($response,200);
        }
    }

    public function alert_details_get()
    {
        $alertId = $this->get('alert_id');
        $orgId = $this->get('org_id');
        if($alertId) {
            $result = $this->formv2_model->get_alert_details($alertId);
            $output = array(
                "comment" => array(),
                "reporting_to" => array(),
          "images" => array(),
            );
            foreach ($result as $key => $item) {
                $output['alert_id'] = $item['alert_id'];
                $output['status'] = $item['status'];
                $output['title'] = $item['title'];
                $output['description'] = $item['description'];
                $output['job_site'] = $item['job_site_id'];
                $output['created_at'] = $item['alert_created'];
                $output['user_id'] = (empty($item['user_id']))?'':$item['user_id'];
                $output['alert_owner'] = $item['alert_owner_user_id'];
                $output['comment'][$item['comment_id']]['comment'] = (empty($item['comment']))?'':$item['comment'];
                $output['comment'][$item['comment_id']]['created_at'] = (empty($item['commentCreated']))?'':$item['commentCreated'];
                $output['comment'][$item['comment_id']]['name'] = $item['comment_name'];
                $output['comment'][$item['comment_id']]['user_id'] = (empty($item['comment_userid']))?'':$item['comment_userid'];
                $output['reporting_to'][$item['report_id']]['id'] = $item['report_userid'];
                $output['reporting_to'][$item['report_id']]['name'] = $item['report_name'];
                if(empty($item['image_name'])){
                    $output['images'] = array();
                }else{
                    $output['images'][$item['image_id']] = base_url().'uploads/'.$orgId.'/'.$item["job_site_id"].'/alert'.$alertId.'/'.$item['image_name'];
                }
            }
            $output['comment'] = array_values($output['comment']);
            $output['reporting_to'] = array_values($output['reporting_to']);
            $output['images'] = array_values($output['images']);
            $count = (count($output['images']))?1:0;
            $output['have_attachements'] = (bool) $count;
            $this->response($output, 200);
        } else {
            $result = array("msg" => "alert id is required");
            $this->response($result, 400);
        }
    }
     /* Get Method for form submission_list */
    public function form_submission_list_get()
    {        
        $user_id = $this->get('user_id');
        $form_id = $this->get('form_id');
        $location_id = $this->get('location_id');
        $remove = array();

        if($form_id){
            /*check_form_workflow */
            $flow = $this->formv2_model->check_form_workflow($form_id);
            if($flow == 'user' || $flow == 'department'){
                $list = $this->formv2_model->form_submission_list($user_id,$form_id,$location_id);
            }else
            { 
                /* Check user has review permission */
                $check_details = $this->formv2_model->get_form_hierarchy_list($user_id);
                if(count($check_details) == 0){
                    $list = $this->formv2_model->form_submission_list($user_id,$form_id,$location_id);
                }else{
                $details = $this->formv2_model->get_form_hierarchy_list($user_id);
                    if(isset($details)){
                        foreach($details as $key=>$value){
                            if($value['sort_id'] != 0){
                                $ids = $this->formv2_model->get_previous_user_hierarchy($value);
                                $id = explode('#',$ids);
                                if($id[0]){
                                   $previous_hierarchy_user_id[$id[0]] = $id[0]; 
                                }
                            }else{
                                $sort_zero_id[$value['user_id']] = $value['user_id'];
                            }
                        }
                        if(isset($previous_hierarchy_user_id)){
                            $previous_hierarchy_user_id = array_unique($previous_hierarchy_user_id);
                            $previous_hierarchy_submission_result = $this->formv2_model->get_previous_hierarchy_submission_data($previous_hierarchy_user_id);

                            if(isset($previous_hierarchy_submission_result)){
                                foreach($previous_hierarchy_submission_result as $key=>$value){
                                    /*if(isset($value['submission_id'])){
                                        $previous_hierarchy_ids[$value['submission_id']][$value['user_id']] =  $value['status'];
                                    }*/
                                    if($value['status'] == 1 || $value['status'] == 3 || $value['status'] == 2){
                                        $submission_id[] = $value['submission_id'];
                                    }else{
                                        $remove[] = $value['submission_id'];
                                    }
                                }
                            }
                        }
                        if(isset($sort_zero_id)){
                            $sort_zero_id = array_unique($sort_zero_id);
                            $intital_sort_hierarchy_submission_result = $this->formv2_model->intital_sort_hierarchy_submission_data($sort_zero_id);
                            if(isset($intital_sort_hierarchy_submission_result)){
                                foreach($intital_sort_hierarchy_submission_result as $key=>$value){
                                    if($value['user_id'] == $user_id){
                                        $submission_id[] = $value['submission_id'];
                                    }
                                }
                            }
                        }
                        if(isset($submission_id)){
                            if(is_array($submission_id)){
                                $submission_id = array_filter($submission_id);
                                if(count($submission_id) > 0){
                                    $list = $this->formv2_model->form_review_waiting_approval_lists($submission_id,$user_id);
                                }else{
                                    $list ='';
                                }
                            }else{
                                $list = '';
                            }
                        }
                        else{
                            $list = '';
                        }
                    }else{
                        $list = '';
                    }
                }
            }
            $output = array();
            $output['approved'] = array();
            $output['rejected'] = array();
            $output['reassigned'] = array();
            $output['pending'] = array();
            foreach($list as $key=>$value){
                if($flow == 'user' || $flow == 'department'){
                    $reporting_to = 'N/A';
                }else{
                    $sort_position = $this->formv2_model->get_form_review_history($value['form_id']);
                    if(!in_array($user_id,$sort_position)){
                        $next_user=$this->userv2_model->get_alert_user_details($sort_position[0]);
                        $reporting_to = $next_user->name;
                    }else{
                        $sort_key = array_search($user_id, $sort_position);
                        $sort_key+=1;
                        if(isset($sort_position[$sort_key])){
                            $next_user=$this->userv2_model->get_alert_user_details($sort_position[$sort_key]);
                            $reporting_to = $next_user->name;
                        }else{
                            $reporting_to = 'N/A';
                        }

                    }
                }
                if($value['status'] === '1'){
                    $approved['id']= $value['submission_id'];
                    $approved['submission_status']= $value['status'];
                    $approved['created_at'] = $value['createddate'];
                    $approved['form_id'] = $value['form_id'];
                    $approved['title'] = $value['form_name'];
                    $approved['description'] = $value['form_desc'];
                    $approved['reporting_to'] = $reporting_to;
                    $approved['submitted_by'] = $value['name'];
                    $output['approved'][]=$approved;
                }else if($value['status'] === '2'){
                    $rejected['id']= $value['submission_id'];
                    $rejected['submission_status']= $value['status'];
                    $rejected['created_at'] = $value['createddate'];
                    $rejected['form_id'] = $value['form_id'];
                    $rejected['title'] = $value['form_name'];
                    $rejected['description'] = $value['form_desc'];
                    $rejected['reporting_to'] = $reporting_to;
                    $rejected['submitted_by'] = $value['name'];
                    $output['rejected'][]=$rejected;
                }
                else if($value['status'] === '3'){
                    $reassigned['id']= $value['submission_id'];                    
                    $reassigned['submission_status']= $value['status'];
                    $reassigned['created_at'] = $value['createddate'];
                    $reassigned['form_id'] = $value['form_id'];
                    $reassigned['title'] = $value['form_name'];
                    $reassigned['description'] = $value['form_desc'];
                    $reassigned['reporting_to'] = $reporting_to;
                    $reassigned['submitted_by'] = $value['name'];
                    $output['reassigned'][]= $reassigned;
                }else if($value['status'] === '0'){
                    $pending['id']= $value['submission_id'];                    
                    $pending['submission_status']= $value['status'];
                    $pending['created_at'] = $value['createddate'];
                    $pending['form_id'] = $value['form_id'];
                    $pending['title'] = $value['form_name'];
                    $pending['description'] = $value['form_desc'];
                    $pending['reporting_to'] = $reporting_to;
                    $pending['submitted_by'] = $value['name'];
                    $output['pending'][]= $pending;
                }
            }
            $this->response($output, 200);
        }else{
            $result = array("msg" => "Form id is required");
            $this->response($result, 400);
        }
    }
    public function form_submission_data_get(){
        $user_id = $this->get('user_id');
        $form_id = $this->get('form_id');
        $location_id = $this->get('location_id');
        $submission_id = $this->get('submission_id');
        if($submission_id){
            /* */
            $check_details = $this->formv2_model->get_form_review_list($user_id,$form_id);
            if(count($check_details) != 0){
                $data = $this->formv2_model->form_submission_review_data($user_id,$form_id,$location_id,$submission_id);            
            }
            else{
                $data = $this->formv2_model->form_submission_data($user_id,$form_id,$location_id,$submission_id);
            }
            $output = array();
            $output['submission'] = $data->submission;
            $this->response($output, 200);
        }else{
            $result = array("msg" => "Form id is required");
            $this->response($result, 400);
        }
    }
    public function form_submission_review_post(){
        
        $token = $this->post('token');
        $user_id = $this->post('user_id');
        $org_id = $this->post('organization_id');
        $location_id = $this->post('location_id');
        $submission_id = $this->post('submission_id');
        $submission_details = $this->post('json_values');
        $form_id = $this->post('form_id');
        $review_description = $this->input->post('message','');
        if($review_description == ''){
            $review_description = '';
        }
        $status = $this->input->post('submission_status');
        $data = $this->user_model->user_check($token,$user_id);
        if($data['msg'] == 'success') {
            foreach($this->input->post() as $key=>$value){
                //$pattern = "/^[0-9]{1,}_[0-9]{1,}$/";
                $pattern = "/^\d+_\d+$/";
                $check = preg_match($pattern, $key);
                //echo $check;
                if($check){
                    $commented_array[$key] = $value; 
                }
            }
            //print_r($commented_array);
            //echo $status;
            foreach($commented_array as $key=>$value){                 
                $fields = explode('_',$key);
                $user_form_info_text_id = $fields[0];
                $formfieldid = $fields[1];
                $store = array(
                    'comments' => $value,
                    'submission_id' => $submission_id,
                    'user_form_info_text_id' => $user_form_info_text_id,
                    'created_by' => $user_id,
                    'created_date' => gmdate(date('Y-m-d h:i:s'),time())
                    );
                $comment_id = $this->formv2_model->save_review_comments($store);
                $this->formv2_model->update_comment_id_user_form_info_text($comment_id,$submission_id,$user_form_info_text_id);
            }
                $submission = $this->formv2_model->form_submission_details($submission_id);
                $submitted_user_id = $submission[0]['user_id'];
                $submitted_org_id = $org_id;
                /* Get Location name for the Sending Email */
                $location = $this->userv2_model->get_location_details($org_id,$location_id);
                $location_name = $location[0]['location_name'];
                /* Get Form Name for Sending Email */
                $form = $this->formv2_model->form_details($form_id);
                $form_name = $form->form_name;

                $this->formv2_model->updates_submission_form_submission($submission_id,$submission_details);
                /* Get Current Logged user details */
                $current_user = $this->userv2_model->get_user_details($user_id,$org_id);
                $from = $current_user->email;
                $from_name = $current_user->name;
                $notification_data['details']['form_id'] = $form_id;
                $notification_data['details']['submission_id'] = $submission_id;
                $notification_data['details']['org_id'] = $org_id;
                $notification_data['details']['location_id'] = $location_id;
                if($status == 1){
                    // Approved to get next hierarchy user and send mail
                    $details = $this->formv2_model->get_individual_form_hierarchy_list($form_id);
                    foreach($details as $key=>$value){
                        $order[$value['sort_id']] = $value['user_id'];
                        $list_users[] = $value['user_id'];
                    }
                    $my_sort_order = $this->formv2_model->get_my_sort_order($user_id,$form_id);

                    ++$my_sort_order;
                    if(isset($order[$my_sort_order])){
                        /* Alert the next level user  */
                        $next_to_email = $order[$my_sort_order];
                        $next_user=$this->userv2_model->get_user_details($next_to_email,$submitted_org_id);
                        $subject = $this->lang->line('approved');
                        $send_to = $submitted_user->email;
                        $message['receiver_name'] = $next_user->name;
                        $message['message'] = $review_description;
                        $message['name'] = $next_user->name;
                        $message['form_name'] = $form_name;
                        $message['form_url'] = '';
                        $message['location_name']  = $location_name;
                        $message['datetime'] = date('Y-m-d H:i:s');
                        //send_email($from,$from_name,$send_to,'resolved.php',$subject,$message);
                        foreach($list_users as $key=>$value){
                            if($value != $user_id){
                                $this->formv2_model->approved_review_history($submission_id,$value,0);
                            }
                        }
                        /* Set Push Notification */
                        $notification_data['title'] = 'Submission against '.$form_name.' is waiting for your review';
                        $notification_data['details']['title'] = 'Submission against '.$form_name.' is waiting for your review';
                        $notification_data['description'] =  $review_description;
                        $notification_data['type'] = '1.3';
                        $to_push_notifi = $this->user_device_token($next_to_email);
                    }else{
                        /* All User reviews finished and changed the submission status to approved */
                        $this->formv2_model->updates_status_form_submission($submission_id,$status);
                        $submitted_user=$this->userv2_model->get_user_details($submitted_user_id,$submitted_org_id);
                        /*$subject = $this->lang->line('approved');
                        $send_to = $submitted_user->email;
                        $message['receiver_name'] = $submitted_user->name;
                        $message['message'] = $approved_message;
                        $message['form_url'] = '';
                        $message['name'] = $current_user->name;
                        $message['form_name'] = $form_name;
                        $message['location_name']  = $location_name;
                        $message['datetime'] = date('Y-m-d H:i:s');*/
                        //send_email($from,$from_name,$send_to,'resolved.php',$subject,$message);
                        /* Set Push Notification */
                        $notification_data['title'] = 'Your submission against '.$form_name.' is approved by'.$current_user->name;
                         $notification_data['details']['title'] = 'Your submission against '.$form_name.' is approved by'.$current_user->name;
                        $notification_data['description'] =  $review_description;
                        $notification_data['type'] = '1.2';
                        $this->formv2_model->update_userformsubmissioncount($form_id,$user_id);
                        /* Get Device token for the user */
                        $to_push_notifi = $this->user_device_token($submitted_user_id);
                    }
                    $this->formv2_model->approved_review_history($submission_id,$user_id,$status);
                }
                else if($status == 2){
                    // Rejected
                    $submitted_user =$this->userv2_model->get_user_details($submitted_user_id,$submitted_org_id);
                    $subject = $this->lang->line('rejected');
                    $send_to = $submitted_user->email;
                    $message['receiver_name'] = $submitted_user->name;
                    $message['message'] = $decline_desc;
                    $message['name'] = $current_user->name;
                    $message['form_url'] = '';
                    $message['form_name'] = $form_name;
                    $message['datetime'] = date('Y-m-d H:i:s');
                    $message['location_name']  = $location_name;
                    //send_email($from,$from_name,$send_to,'rejected.php',$subject,$message);
                    $previous_user = $this->formv2_model->previous_approved_users($submission_id,$user_id);
                    $pre_reject = array();
                    /* Find previous user for submission */
                    if(count($previous_user) > 0){
                        /* Reassign the submission to previously assigned user */
                        foreach($previous_user as $key=>$value){
                            $pre_reject[] = $value['user_id'];
                        }
                    }
                    $pre_reject[]=$user_id;
                    $get_all_users = $this->formv2_model->get_all_hierarchy_users($submission_id);
                    $hide_all = array();
                    foreach($get_all_users as $key=>$value){
                        if(!in_array($value['user_id'],$pre_reject)){
                            $hide_all[] = $value['user_id'];
                        }
                    }
                    
                    //}
                    /* Set Inactive  */
                    $this->formv2_model->set_inactive_after_reviewer($submission_id,$hide_all);
                    //print_r($reassign_users);
                    $this->formv2_model->decline_form_submission($submission_id,$user_id,$status,$pre_reject);
                    /* Set Push Notification */
                    $notification_data['title'] = 'Your submission against '.$form_name.' is rejected';
                    $notification_data['description'] =  $review_description;
                    $notification_data['type'] = '1.4';
                    /* Get Device token for the user */
                    $to_push_notifi = $this->user_device_token($submitted_user_id);
                    $notification_data['details']['title'] = 'Your submission against '.$form_name.' is rejected by '.$current_user->name;
                    $this->notify_previous_approved_users($pre_reject,$notification_data,$user_id);

                }
                else if($status == 3){
                    $submitted_user =$this->userv2_model->get_user_details($submitted_user_id,$submitted_org_id);
                    $previous_user = $this->formv2_model->previous_approved_users($submission_id,$user_id);
                    /* Initially Reassigned the form to the submitted user */
                   /* $subject = $this->lang->line('reassign');
                    $message['receiver_name'] = $submitted_user->name;
                    $message['message'] = $review_description;
                    $message['name'] = $current_user->name;
                    $message['form_url'] = '';
                    $message['form_name'] = $form_name;
                    $message['datetime'] = date('Y-m-d H:i:s');
                    $message['location_name']  = $location_name;*/
                    //send_email($from,$from_name,$send_to,'reassign.php',$subject,$message);
                    $reassign_users = array();
                    if(count($previous_user) > 0){
                        /* Reassign the submission to previously assigned user */
                        foreach($previous_user as $key=>$value){
                            $message['receiver_name'] = $value['name'];
                            //send_email($from,$from_name,$value['email'],'reassign.php',$subject,$message);
                            $reassign_users[] = $value['user_id'];
                        }
                    }
                    $reassign_users[]=$user_id;
                    //if(count($reassign_users) < 0){
                $get_all_users = $this->formv2_model->get_all_hierarchy_users($submission_id);
                    $hide_all = array();
                    foreach($get_all_users as $key=>$value){
                        if(!in_array($value['user_id'],$reassign_users)){
                            $hide_all[] = $value['user_id'];
                        }
                    }
                    /* Set Inactive  */
                    $this->formv2_model->set_inactive_after_reviewer($submission_id,$hide_all);
                    //print_r($reassign_users);
                    /* Change reassigned users status */
                    $this->formv2_model->reassign_user_form_status($reassign_users,$submission_id,$form_id,$status,$user_id);
                    $notification_data['title'] = 'Your submission against '.$form_name.' is reassigned by '.$current_user->name;
                    $notification_data['description'] =  $review_description;
                    $notification_data['type'] = '1.5';
                    /* Get Device token for the user */
                    $to_push_notifi = $this->user_device_token($submitted_user_id);
                    $notification_data['details']['title'] = 'Your submission against '.$form_name.' is reassigned by '.$current_user->name;
                    $this->notify_previous_approved_users($reassign_users,$notification_data,$user_id);
                    //print_r($to_push_notifi);
                }
                /* Set push notifications */
                if(count($to_push_notifi['android']) > 0){
                    /* Push Notification to android */
                    foreach($to_push_notifi['android'] as $key=>$value){
                        $this->pushnotifications->android($notification_data,$value);
                    }
                }
                if(count($to_push_notifi['ios']) > 0){
                    /* Push Notification to ios */
                    foreach($to_push_notifi['ios'] as $key=>$value){
                        $this->pushnotifications->ios($notification_data,$value);
                    }
                }
                
            $output = array(
                1 => "Approved Success",
                2 => "Rejected Success",
                3 => "Reassigned Success"
            );
            $result = array("msg" => $output[$status]);
            $this->response($result, 200);
        }
        else{
            $result = array("msg" => "Session expired");
            $this->response($result, 400);
        }
    }
    public function notify_previous_approved_users($reassign_users,$notification_data,$user_id){
        /* Get Device token for the user */
        foreach($reassign_users as $key=>$value){
            if($value != $user_id){
                $to_push_notifi_previous = $this->user_device_token($value);
                //print_r($to_push_notifi_previous);
                if(count($to_push_notifi_previous['android']) > 0){
                    /* Push Notification to android */
                    foreach($to_push_notifi_previous['android'] as $key=>$value){
                        $this->pushnotifications->android($notification_data,$value);
                    }
                }
                if(count($to_push_notifi_previous['ios']) > 0){
                    /* Push Notification to ios */
                    foreach($to_push_notifi_previous['ios'] as $key=>$value){
                        $this->pushnotifications->ios($notification_data,$value);
                    }
                }
            }
        }
    }
    public function store_device_token($token,$user_id){
        //Check device token have already user
        $already = $this->userv2_model->check_device_token($token);
        //echo $already;exit;
        if($already){
            $return = $this->userv2_model->update_device_token($token,$user_id);
        }else{
            $return = $this->userv2_model->store_device_token($token,$user_id);    
        }
    }
    public function user_device_token($user_id){
        $user_token = $this->userv2_model->get_device_token($user_id);
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

}
?>