<?php 
require_once('Version1.php');
//error_reporting(0);
class V2 extends Version1{
	public function __construct(){
		parent::__construct();
		$this->load->model('api/userv2_model');
		$this->load->model('api/formv2_model');
		$this->load->helper(array('form', 'url'));
	}

	public function get_user_location_post(){
		$post_request= file_get_contents('php://input');
		$request=json_decode($post_request,true);
		$user_id = $request['user_id'];
		$org_id  = $request['organization_id'];
		$data = $this->user_model->user_check($request['token'],$user_id);
		if($data['msg'] == 'success'){
			$users = $this->userv2_model->get_user_location($user_id,$org_id);
			$profile = $this->user_model->user_profile($user_id);
			$this->response(array("msg"=>'success','location'=>$users,'profile'=>$profile), 200);

		}else{
			$msg = array("msg" => $data['msg']);
			$this->response($msg,202);
		}
	}
	/*public function formsubmit_post(){	
		$token = $this->post('token');
		$user_id = $this->post('user_id');
		$form_id = $this->post('form_id');
		$org_id = $this->post('organization_id');
		$api_formid = $this->post('api_formid');
		$location_id = $this->post('location_id');
		$data = $this->user_model->user_check($token,$user_id);
		$form_values = $this->post('json_values');

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
				//print_r($data); exit;
				$json_values = json_decode($form_values); 
				foreach($json_values as $key=>$value){
					foreach($value->fields as $p=>$pages){
						foreach($pages as $c=>$cols){
							foreach($cols as $i=>$single){
								if($single->fieldtype === '3'){
									//print_r($single); exit;
									$type = $single->fieldid.'_'.$single->formfieldid.'_'.$single->fieldtype;
									$single->value = $datas[$type]['file_name'];
									$insert = array();
									$insert['user_id'] = $user_id;
									$insert['form_id'] = $form_id;
									$insert['form_field_id'] = $single->formfieldid;
									$insert['answer'] = $single->value;
									$this->formv2_model->user_info_text($insert);
								}
							}
						}
					}
				}
				$form_values = json_encode($json_values);
			}
			$response = $this->form_model->form_submit($user_id,$form_id,$org_id,$location_id,$form_values);
			$submission_id = $response['submission_id'];
			//exit;
			foreach($this->post() as $key=> $value){
				$key_split = explode('_',$key);
				/*
					$key_split[0] - fieldid
					$key_split[1] - form_field_id
					$key_split[2] - fieldtype
				
					$insert = array();
					$insert['user_id'] = $user_id;
					$insert['form_id'] = $form_id;
					$insert['submission_id'] = $submission_id;
					
				if(count($key_split) === 3){
					/* Check field type 
					if($key_split[2] === '1'){
						/* If it is options type  store it into the user_form_info_options 
						$insert['form_field_id'] = $key_split[1];
						$insert['form_option_id'] = $value;
						/* Save options field into user info options table 
						$this->formv2_model->user_info_options($insert);
					}else if($key_split[2] === '2'){
						/* If it is text/email type  store it into the user_form_info_text
						$insert['form_field_id'] = $key_split[1];
						$insert['answer'] = $value;
						/* Save options field into user info text table 
						$this->formv2_model->user_info_text($insert);
					}
				}
			}
			$profile = $this->user_model->user_profile($user_id);
			$return['submission_id'] = (string)$submission_id;
			$return['count'] = (string)$response['count'];
			$return['api_formid'] = $api_formid;
			$return['form_id'] = $form_id;
			$msg = array("msg" => 'Form submitted successfully','data'=>$return,'profile'=>$profile);
			$this->response($msg,200);
		}
		else{
			//print_r($data); exit;
			$msg = array("msg" => 'Your session expired.Please Login');
			$this->response($msg,401);
		}
	}*/

}
?>