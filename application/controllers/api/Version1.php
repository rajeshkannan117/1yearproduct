<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type=application/json, Content-Length, Accept-Encoding");
error_reporting(0);
 /**
 *
 * This is Version1 Controller of Universal Bizz App Webservice
 *
 * @package	CodeIgniter
 * @category	Version1
 * @author	Rajeshkannan Chandrasekar
 * @link	http://innoppl.com/
 */
require APPPATH.'/libraries/REST_Controller.php';
class Version1 extends REST_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('api/user_model');
		$this->load->model('api/form_model');
		$this->load->helper('api/common');
		$this->load->helper('email_send');
		$this->load->language('email_lang');
		$this->load->config('api');
		$this->load->library('form_validation');
		$this->load->helper('access');
        define_constants();
		$this->load->library('uuid');
		$this->load->library('PushNotifications');
		$this->load->library('session');
	}
	
	public function login_post()
	{
		
		$post_request= file_get_contents('php://input');		
		$request=json_decode($post_request,true);
		$mandatoryKeys = array('email'=>'Email','password'=>'Password');
		$nonMandatoryValueKeys = array('');
		$check_request= mandatoryArray($request,$mandatoryKeys,$nonMandatoryValueKeys);
		if(!empty($check_request))
		{
			$this->response(array("msg"=>$check_request["msg"]),$check_request["statusCode"]);
		}
		else
		{
			$_POST['email']		=	$request['email'];
			$_POST['password']		=	$request['password'];
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password','Password','required|min_length[3]');
			$pass = $_POST['password'];
			if(preg_match('/\s/',$pass)){
				$this->response(array('msg' => PASSWORD_NOT_ALLOWED_SPACE), 202);
			}
			if($this->form_validation->run() == FALSE)
			{
				$error = strip_tags(validation_errors());
				$this->response(array('msg' => str_replace("\n"," ",$error)), 202);
			}else
			{
				/* Here Check Mailed Password is Activated or not */
				$check = $this->user_model->checkpassword_reset($request['password']);
                               // echo base64_decode('NVhCZDNI'); exit;
				if($check['msg'] == 1){
					$this->response(array("msg"=>'Change password','isTemporarypassword'=>1,'email' => $check['email']), 200);
				}
				else if($check['msg'] == 2){
					//$this->response(array("msg"=>'Please activate your email link to reset password','isActivateLink'=>1), 202);
					$this->response(array("msg"=>'Change password','isTemporarypassword'=>1,'email' => $_POST['email']), 200);
				}
				else{
					/* Normal login */
					$result = $this->user_model->login($request['email'],$request['password']);
					//print_r($result); exit;
					if($result)
					{
	                    if($result['msg'] == 'success')
	                    {
	                        /* Check User is already Login */
	                        $return = $this->user_model->user_app_check($result[0]['id']);		
	                        if($return){
	                            $this->response(
	                            		array("msg"=>'success',
	                            			 'isTemporarypassword'=>0,
	                            			 'token' => $return,
	                            			 'id' => $result[0]['id'] ,
	                            			 'name' =>$result[0]['firstname'],
	                            			 'organization_id'=>$result[0]['org_id'],
	                            			 'profile'=>$result[0]['imgname'],
	                            			 'organization'=>$result[0]['org_name'],
	                            			 'email' => $result[0]['email']
	                            			 ), 
	                            		200);
	                        }
	                        else{
	                            $token = md5(time().' '.$result[0]['id']);
	                            $this->user_model->app_api($token,$result[0]['id']);
	                            $this->response(
	                            		array("msg"=>'success',
	                            			'isTemporarypassword'=>0,
	                            			'token' => $token,
	                            			'id' => $result[0]['id'] ,
	                            			'name' =>$result[0]['firstname'],
	                            			'email' => $result[0]['email'],
	                            			'organization_id'=>$result[0]['org_id'],
	                            			'profile'=>$result[0]['imgname'],
	                            			'organization'=>$result[0]['org_name']
	                            			), 
	                            		200);
	                        }
	                    }
	                    else
	                    {
	                        $this->response(array("msg" =>'Authorization problems'), 401);
	                    }
					}
					else 
					{
						$msg = array("msg" =>'Authorization problem');
						$this->response($msg, 401);
					}
			    }
			}
		}
	}
	/* Reset Password */
	public function resetpassword_post(){
	     $post_request= file_get_contents('php://input');
	     $request=json_decode($post_request,true);
	     $_POST['email']		=	$request['email'];
	     $_POST['password']		=	$request['password'];
	     $this->form_validation->set_rules('password','Password','required|min_length[3]');
	     if($this->form_validation->run() == FALSE)
		{
		    $this->response(array('msg' => str_replace('\n','',strip_tags(validation_errors()))), 202);
		}else{
		   $result = $this->user_model->reset_pwd($request['email'],$request['password']);
		   if($result)
			{
                if($result['msg']=='success')
                {
                        /* Check User is already Login */
                    $return = $this->user_model->user_app_check($result[0]['id']);
                    if($return){
                        $this->response(
                        		array("msg"=>'success',
                        			'isTemporarypassword'=>0,
                        			'token' => $return,
                        			'id' => $result[0]['id'] ,
                        			'name' =>$result[0]['firstname'],
                        			'organization_id'=>$result[0]['org_id'],
                        			'profile'=>$result[0]['imgname'],
                        			'email' => $result[0]['email'],
                        			'organization'=>$result[0]['org_name']
                        		), 200);
                    }
                    else{
                        $token = md5(time().' '.$result[0]['id']);
                        $this->user_model->app_api($token,$result[0]['id']);
                        $this->response(
                        	array(
                        			"msg"=>'success',
                        			'isTemporarypassword'=>0,
                        			'token' => $token,
                        			'id' => $result[0]['id'],
                        			'name' => $result[0]['firstname'],
                        			'organization_id'=> $result[0]['org_id'],
                        			'profile'=>$result[0]['imgname'],
                        			'email' => $result[0]['email'],
                        			'organization'=>$result[0]['org_name']
                        		), 200);
                    }
                }
                else
                {
                    $this->response(array("msg" =>'invalid'), 202);
                }
			}
			else 
			{
				$msg = array("msg" => 'invalid');
				$this->response($msg, 202);
			}
	    }
	}

	/* Forgot Password */

	public function forgotpwd_post(){
		$post_request= file_get_contents('php://input');
		$request=json_decode($post_request,true);
		$useremail = $request['email'];
		$name = $this->user_model->verify_email($useremail);
		if($name){		
    			//load email library
		    $this->load->library('email');
		  	$type = array (
				'mailtype' => 'html',
				'charset'  => 'utf-8',
				'priority' => '1'
		   	);

		   /* Genereate random password */
		   // Stores forgot password details to the table
		    $activation = md5(base64_encode($useremail));	
		    $password = $this->randomPassword();				
		    $this->user_model->forgot_pwd($useremail,$activation,'api',$password);
		    $data = array(
         		/*name'=> $verify,  // Users Name
				'password' => $password,
				//'link' => 'http://formpro.enterpriseapplicationdevelopers.com/api/version1/activation/',
				//'activation' => $activation  */
				'name'=> $name,  // Users Name
				'password' => $password,
				'activation'=>$activation,
				'link' => base_url().'login/activation'
          	);
		  	$this->email->initialize($type);
	        $this->email->set_newline("\r\n");
    		$this->email->from('no-reply@formpro.com', 'Admin');
	        $this->email->to($useremail);  // replace it with receiver mail id
	    	$this->email->subject('Forgot Password'); // replace it with relevant subject 
		 	$body = $this->load->view('emails/forgotpwd.php',$data,TRUE);
	    	$this->email->message($body);
			if($this->email->send())
			{
				$msg = array("msg" => 'Password is sent to your mail');
				$this->response($msg,200);
			}
			else
			{
			 	$msg = array("msg" => 'Error in Mail');
				$this->response($msg,202);
			}
		}
		else{
			$msg = array("msg" => 'This Email address is not registered');
			$this->response($msg,202);
		}
	}

	public function activation_get(){
		$post_request= file_get_contents('php://input');
		$request=json_decode($post_request,true);
		echo $this->get('activation'); exit;
	}

	public function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 6; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	public function userdata_post(){
		$post_request= file_get_contents('php://input');
		$request=json_decode($post_request,true);
		$mandatoryKeys = array('token'=>'User Token','id'=>'User Id');
		$nonMandatoryValueKeys = array('');
		$check_request= mandatoryArray($request,$mandatoryKeys,$nonMandatoryValueKeys);
		if(!empty($check_request))
		{
			$this->response(array("msg"=>$check_request["msg"]),$check_request["statusCode"]);
		}
		else
		{
			$data = $this->user_model->user_check($request['token'],$request['id']);
			$userid = $request['user_id'];
			if($data['msg'] == 'success'){
				$user_data = $this->user_model->user_data($userid);
				if($user_data['user_query']){
					foreach($user_data['user_query'] as $key=>$value)
					{
						$users['user_id'] = $value['id'];
						$users['name'] = $value['name'];
						$users['profile'] = $value['imgname'];
					}
					$users['organization'] =$user_data['org_query'];
					//$users['token'] = $request['token'];
					$msg = $users;
					$this->response($msg,200);
				}
				else{
					$msg = array('msg' => 'User details not found');
					$this->response($msg,404);
				}
			}
			else{
				$msg = array("msg" => $data['msg']);
				$this->response($msg,401);
			}
		}
	}

	public function changeprofile_post(){

		$post_request= file_get_contents('php://input');
		
		$request=json_decode($post_request,true);
		$data = $this->user_model->user_check($request['token'],$request['user_id']);
		if($data['msg'] == 'success'){
	 		$image = base64_decode($request['image']);
			//$user = $this->user_model->user_data($request['userid']);
			//$imgname = 
			$oldimgname = $this->user_model->user_image($request['user_id'],$request['organization_id']);
			//echo $user; exit;
			if($oldimgname){
				if(file_exists(IMAGE_PATH.$oldimgname->imgname))
					unlink(IMAGE_PATH.$oldimgname->imgname);
			}

	 		$profile_image=time().'-'.md5($oldimgname->firstname).'.jpeg';	 
	 		$file = IMAGE_PATH.$profile_image;
	 		$success = file_put_contents($file, $image);
	 		/*echo IMAGE_PATH;
	 		exit;*/
			if($success){
				if($this->user_model->update_profile($request['user_id'],$profile_image)){
			 		$msg = array('msg'=>'Success','profileImage' => $profile_image);
					$this->response($msg,200);
				}
				else{
					$msg = array('msg' => 'Some Error with ur images');
					$this->response($msg,202);
				}
			}
		}
		else{
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
			/* Check user Categories */
			$categories = $this->user_model->user_categories($userid,$org_id,$location_id);
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

	public function formdata_post(){

		$post_request= file_get_contents('php://input');
		$request=json_decode($post_request,true);
		$data = $this->user_model->user_check($request['token'],$request['user_id']);
		$formid = $request['form_id'];
		$userid = $request['user_id'];
		$org_id = $request['organization_id'];
		$location_id = $request['location_id'];
		if($data['msg'] == 'success'){
			
			$data = $this->form_model->formdata($formid,$org_id,$userid,$location_id);
			if($data){
				$list = array();
				//print_r($data); exit;
				foreach($data as $key=>$value){
					$cont = json_decode($value['form_data'],true);
					$list['title'] = $value['form_name'];
					$list['description'] = $value['form_desc'];
					$list['fields'] = $cont['fields'];
				}
				//print_r($list); exit;
				//exit;
				$msg = array('forms' => $list);
				//echo json_encode($msg); exit;
				$this->response($msg,200);
			}
			else{
				$msg = array('msg' => 'Forms Not Found');
				$this->response($msg,202);
			}
			//}
		}
		else{
			$msg = array("msg" => $data['msg']);
			$this->response($msg,401);
		}
	}

	public function formlist_post(){

		$post_request= file_get_contents('php://input');
		//print_r($post_request); exit;
		$request=json_decode($post_request,true);

		$data = $this->user_model->user_check($request['token'],$request['user_id']);
		//print_r($data); exit;
		$userid = $request['user_id'];
		$org_id = $request['organization_id'];
		$loc_id = $request['location_id'];
		if($data['msg'] == 'success'){
				/* Get List Of Form */
				$form_list_datas = $this->form_model->formlist($userid,$org_id,$loc_id);
				foreach($form_list_datas as $key=>$value){
					$form_list_datas[$key]['location_id'] = $loc_id;
				}
				if($form_list_datas){
					$msg = array('forms' => $form_list_datas);
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
	

	public function setfavourite_post(){

		$post_request= file_get_contents('php://input');
		
		$request=json_decode($post_request,true);

		$data = $this->user_model->user_check($request['token'],$request['user_id']);

		$userid = $request['user_id'];

		$formid = $request['form_id'];
		
		$favourite = $request['favourite'];

		if($data['msg'] == 'success'){
							
			$data_res = $this->form_model->set_important($formid,$userid,$favourite);


			if($data_res){

				$msg = array('msg' => 'Success');

				$this->response($msg,200);

			}else{

				$msg = array('msg' => 'Favourites Not set');

				$this->response($msg,202);

			}
					
		}
		else{

			$msg = array("msg" => 'Your session expired.Please Login');

			$this->response($msg,401);

		}

	}

	/*public function formsubmit_post(){
		//echo 'dsfs';exit;
		$post_request= file_get_contents('php://input');
		//echo $post_request;exit;
		$request=json_decode($post_request,true);
		//print_r($request);  exit;
		$formvalues =  base64_decode($request['forms']); 
		$data = $this->user_model->user_check($request['token'],$request['userid']);
		$formid = $request['formid'];
		$userid = $request['userid'];
		$org_id = $request['organization_id'];
		if($data['msg'] == 'success'){
			
			/* Check form status */
		/*	$status = $this->form_model->form_status($formid,$userid);
			if($status){

				$return = $this->form_model->form_submit($userid,$formid,$org_id,$formvalues);
				if(is_array($return)){
					$msg = $return['msg'];
					$code = $return['code'];
					$count = $return['count'];
					$this->response(array('msg'=>$msg,'count'=>$count),$code);
				}
			}
			else{
				$msg = array("msg" => 'Inactive form is not authorised to submit');
				$this->response($msg,401);
			}
		}
		else{
			$msg = array("msg" => 'Your session expired.Please Login');
			$this->response($msg,401);
		}
	}*/
	public function formsubmit_post(){
		$post_request= file_get_contents('php://input');
		//echo $post_request;exit;
		$request=json_decode($post_request,true);
		//print_r($request); exit;
		$forms = $request['forms'];
                
		$data = $this->user_model->user_check($request['token'],$request['user_id']);
		//$formid = $request['formid'];
		$userid = $request['user_id'];
		$org_id = $request['organization_id'];
		$location_id = $request['location_id'];
		if($data['msg'] == 'success'){
            //$forms = json_decode($forms,true);
            //$forms = $request['forms'];
            //print_r($forms); exit;
            $info = array();
            //$forms = json_decode(base64_decode($forms));
            foreach($forms as $key=>$value){
                /* Check form status */

                $status = $this->form_model->form_status($value['form_id'],$userid);
                if($status){
                    $content = json_decode(base64_decode($value['forms']));
                    foreach($content->fields as $p=>$values){
                    	foreach($values as $r=>$rows){
                    		foreach($rows as $c=>$cols){
                    			if($cols->api_type === 'element-signature'){
                    				$image = base64_decode($cols->value);
                    				$signature=time().'-'.md5($cols->title).'.jpeg';	 
	 								$file = IMAGE_PATH_SIGNATURE.$signature;
	 								$success = file_put_contents($file, $image);
	 								$cols->value = $signature;
                    			}
                    		}
                    	}
                    }
                    $store = json_encode($content); 
                    $return = $this->form_model->form_submit($userid,$value['form_id'],$org_id,$location_id,$store);
                    if(is_array($return)){
                        $msg = $return['msg'];
                        $code = $return['code'];
                        $count = $return['count'];
                        $info['count']= $count;
                        //$this->response(array('msg'=>$msg,'count'=>$count),$code);
                    }
                    $info['status'] = '1';
                    $info['form_id'] = $value['form_id'];
                    $info['api_formid'] = $value['api_formid'];
                    $info['submission_id'] = $return['submission_id'];
                }
                else{
                    //$msg = array("msg" => 'Inactive form is not authorised to submit');
                    $info['status'] = '0';
                    $info['form_id'] = $value['form_id'];
                    $info['api_formid'] = $value['api_formid'];
                    $info['submission_id'] = 0;
                    //$this->response($msg,401);
                }
                $rep['forms'][] = $info;
            }
            //print_r($rep); exit;
            $this->response(array('response'=>$rep),200);
		}
		else{
			$msg = array("msg" => 'Your session expired.Please Login');
			$this->response($msg,401);
		}
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
	/*public function submittedformcount_get(){
		
		//$post_request= file_get_contents('php://input');
		
		//$request=json_decode($post_request,true);

		$token = $this->get('token');

		$formid = $this->get('formid');
		$userid = $this->get('userid');
		$data = $this->user_model->user_check($token,$userid);
		if($data['msg'] == 'success'){
			$datas = $this->form_model->submitted_details($formid,$userid);
			if($datas){
					$msg = array('forms'=>$datas);
					$this->response($msg,200);
				}
				else{
					$msg = array('msg' => 'Form not found');
					$this->response($msg,204);
				}
		}else{
			$msg = array("msg" => 'Your session expired.Please Login');
			$this->response($msg,401);
		}	
	}*/
	/* Form submission list */
	public function form_submission_list_post(){
		$post_request = file_get_contents('php://input');
		$request = json_decode($post_request,true);
		$data = $this->user_model->user_check($request['token'],$request['user_id']);
		if($data['msg'] == 'success'){
			$userid = $request['user_id'];
			$org_id = $request['organization_id'];
			$formid = $request['form_id'];
			$location_id = $request['location_id'];
			/* check user has owned form */
			$owned_form = $this->form_model->check_owned_form($userid,$formid);
			if($owned_form){
				$data_list = $this->form_model->form_submission_list_owner($org_id,$formid);
				if($data_list){
					$data = array();
					foreach($data_list as $key=>$value){
						$submission = json_decode($value['submission']);
						$list = array();
						$list['id'] = $value['id'];
						$list['form_id'] = $value['form_id'];
						$list['created_at'] = $value['created_at'];
						$list['title'] = $submission->title;
						$list['description'] = $submission->description;
						$list['reporting_to'] = $value['response_to'];
						$list['submitted_by'] = $value['submitted_by'];
						$data[]=$list;
					}
					$msg = array('msg' => 'Success','submission'=>$data);
					$this->response($msg,200);
				}else{
					$msg = array('msg' => 'No Form submission');
					$this->response($msg,202);
				}
			}
			else{
				$data_list = $this->form_model->form_submission_list_user($userid,$org_id,$formid);
				if($data_list){
					$data = array();
					foreach($data_list as $key=>$value){
						$submission = json_decode($value['submission']);
						$list = array();
						$list['id'] = $value['id'];
						$list['form_id'] = $value['form_id'];
						$list['created_at'] = $value['created_at'];
						$list['title'] = $submission->title;
						$list['description'] = (isset($submission->description)?'':$submission->description);
						$list['reporting_to'] = $value['response_to'];
						$list['submitted_by'] = $value['submitted_by'];
						$data[]=$list;
					}
					$msg = array('msg' => 'Success','submission'=>$data);
					$this->response($msg,200);
				}else{
					$msg = array('msg' => 'No Form submission');
					$this->response($msg,202);
				}	
			}
		}
		else{
			$msg = array("msg" => 'Your session expired.Please Login');
			$this->response($msg,401);
		}

	}
	/* Form submission data */
	public function form_submission_data_post(){
		$post_request = file_get_contents('php://input');
		$request = json_decode($post_request,true);
		$data = $this->user_model->user_check($request['token'],$request['user_id']);
		if($data['msg'] == 'success'){
			$id = $request['submission_id'];
			$userid = $request['user_id'];
			$org_id = $request['organization_id'];
			$formid = $request['form_id'];
			$location_id = $request['location_id'];
			$data = $this->form_model->form_submit_data($id,$formid);
			if($data){
				$msg = array('msg' => 'Success','submission'=>$data);
				$this->response($msg,200);
			}
			else{
				$msg = array('msg' => 'No data for this submission id');
				$this->response($msg,204);
			}
		}
		else{
			$msg = array("msg" => 'Your session expired.Please Login');
			$this->response($msg,401);
		}
	}
}

?>

