<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APP_PATH.'/libraries/REST_Controller.php';

class Version1 extends REST_Controller{
		
	public function __construct()
	{
	
		parent::__construct();
		
		$this->load->model('formbuilder_model');
		
		$this->load->model('user_model');
		
		$this->load->library('form_validation');

	}
	
	public function user_Validate($id = 0){ 
	$db = JFactory::getDBO();
	$config =JFactory::getConfig();				
	
	if(!is_numeric ($id)){
		return 0;
	} 		
	return 1;		
	$query="SELECT al.id, DATE_FORMAT(al.created_date,'%Y-%m-%d') as cdate  FROM #__appapi_log al JOIN #__users u ON u.id= al.user_id WHERE al.user_id = $id";
	$db->setQuery($query);
	$result = $db->loadObject();	
	if ($result) {
	$date1=date_create($result->cdate);
	$date2=date_create(date('Y-m-d'));
	$diff=date_diff($date1,$date2);
	$daysdiff = $diff->format("%R%a");
		if($daysdiff <= $config->get('apikeylimit') )
		{
			return 1;
		}
		else {
			return 0;
		}
	}
	else {
		return 0;
	}
}		

	public function login()
	{
		
		
		$post_request= file_get_contents('php://input');
		
		$request=json_decode($post_request,true);

		$mandatoryKeys = array('username'=>'Username','password'=>'Password');
		
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
			$_POST['device_type']	=	$request['device_type'];
			$_POST['device_id']	=	$request['device_id'];
				
			$this->form_validation->set_rules('email','Email','required|min_length[1]|max_length[100]|valid_email');
			$this->form_validation->set_rules('password','Password','required|min_length[3]|max_length[15]');
				
			$pass = $_POST['password'];
			if(preg_match('/\s/',$pass)){
				$this->response(array('msg' => PASSWORD_NOT_ALLOWED_SPACE), 202);
			}
				
			if($this->form_validation->run() == FALSE)
			{
				$this->response(array('msg' => validation_errors()), 202);
			}else
			{
				$result = $this->webservice_model->user_check($request['password'],$request['email'],$request['device_id'],$request['device_type']);
				if($result)
				{
					if($result['msg']=='success')
					{
						$this->response(array("msg"=>LOGIN_SUCCESSFULLY,'data' =>$result['result'],'update_status' =>$result['update_status'],'brand_list'=>$result['brand_list'],'category_list'=>$result['category_list']), 200);
					}
					else
					{
						$this->response(array("msg" =>$result['result']), 202);
					}
				}
				else 
				{
					$msg = array("msg" => INVALID_USERNAME_PASSWORD);
					$this->response($msg, 202);
				}
			}
		}
	}
	
	}