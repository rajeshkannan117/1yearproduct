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

class Form_model extends CI_Model 
{	

	/* Check form has accessible to the users */
	public function access($formid,$id){

		$this->db->select('f.id')

				 ->from('forms as f')

				 ->where('f.id = '.$form_id.' And f.created_by = '.$id);

		$result = $this->db->get();

		if($result->num_rows()){

			return true;

		}
		else{

			return false;
		}

	}
	public function formdata($form_id,$org_id,$id,$loc_id){
		$this->db->select('f.form_name,f.form_content as form_data,f.form_desc')
				  ->from('form_details f')
				  ->join('user_form uf','uf.form_id = f.form_id and uf.user_id = '.$id)
				  ->join('form_location fl','fl.form_id = f.form_id and fl.location_id = '.$loc_id)
				  ->where('f.form_id',$form_id)
				  ->where('f.org_id',$org_id);
		$res = $this->db->get();
		//echo $this->db->last_query(); exit;
		if($res->num_rows()){
			return $res->result_array();
		}
		else{
			return false;
		}
	}
	/*public function formlist($id,$org_id){
		//fs.submission
		$this->db->select('f.form_id,f.form_name,f.form_desc,uf.important,fc.cat_id,f.updated_at,c.category_name,uf.submission,f.form_api_content') 
			 ->from('form_details as f')
			 ->join('form_category fc','fc.form_id = f.form_id')
			 ->join('category c','c.cat_id = fc.cat_id')
			 ->join('user_form as uf','uf.form_id = f.form_id AND uf.user_id = '.$id)
			 ->where('f.org_id',$org_id)
			 ->where('f.status','1');
		$this->db->group_by('f.form_id');
		$result	= $this->db->get();
		//echo $this->db->last_query(); exit;
		if($result->num_rows()){
			return $result->result_array();
		}
		else{
			return false;
		}	
	}*/
	public function formlist($id,$org_id,$loc_id){
		//fs.submission
		$this->db->select('f.form_id,f.form_name,f.form_desc,uf.important,fc.cat_id,f.updated_at,c.category_name,uf.submission,f.form_content as form_data') 
			 ->from('form_details as f')
			 ->join('form_category fc','fc.form_id = f.form_id')
			 ->join('category c','c.cat_id = fc.cat_id')
			 ->join('user_form as uf','uf.form_id = f.form_id AND uf.user_id = '.$id)
			 ->join('form_location fl','fl.form_id = f.form_id AND fl.location_id = '.$loc_id)
			 ->where('f.org_id',$org_id);
			 //->where('f.status','1');
		$this->db->group_by('f.form_id');
		$result	= $this->db->get();
		//echo $this->db->last_query(); exit;
		if($result->num_rows()){
			return $result->result_array();
		}
		else{
			return false;
		}	
	}

	/* Check form status for the form */
	public function form_status($form_id,$user_id){
		$this->db->select('f.status')
		         ->from('form_details f')
		         ->join('user_form uf','uf.form_id = f.form_id and uf.user_id = '.$user_id)
		         ->where('f.form_id',$form_id)
		         ->where('f.status','1');
		$rows = $this->db->get();
		//echo $this->db->last_query(); exit;
		if($rows->num_rows() > 0){
			return 1;
		}else{
			return 0;
		}
	}

	/* Form Submit  */

	public function form_submit($userid,$formid,$organization_id,$location_id){
		$token = $this->generateFormToken(10);
		$this->db->set('user_id',$userid);
		$this->db->set('form_id',$formid);
		$this->db->set('org_id',$organization_id);
		$this->db->set('location_id',$location_id);
		$this->db->set('token',$token);
		$this->db->set('created_at',gmdate(date('Y-m-d H:i:s')));
		$this->db->set('updated_at',gmdate(date('Y-m-d H:i:s')));
		//$this->db->set('submission',$formvalues);
		$this->db->insert('form_submission');
		$submission_id = $this->db->insert_id();
		if($submission_id){
			$count = $this->update_formsubmission($formid,$userid);
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

	/* Check user has owned form */
	public function check_owned_form($user_id,$form_id){
		$this->db->select('fd.*')
				  ->from('form_details fd')
				  ->where('fd.form_id',$form_id)
				  ->where('fd.created_by',$user_id);
		$result = $this->db->get();
		if($result->num_rows()){
			return 1;
		}
		else{
			return 0;
		}
	}

	/* form submission list */
	public function form_submission_list_owner($org_id,$formid){
		$this->db->select('fs.id,fs.form_id,fs.submission,fs.token,fs.created_at,fd.response_to,concat(u.firstname," " ,u.lastname) as submitted_by')
				->from('form_submission fs')
				->join('form_details fd','fd.form_id = fs.form_id')
				->join('users u','u.id = fs.user_id')
				->where('fs.form_id',$formid)
				->where('fs.org_id',$org_id)
				->order_by('fs.created_at','DESC');
		$forms = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $forms->result_array();
	}

	/* form submission list */
	public function form_submission_list_user($userid,$org_id,$formid){
		$this->db->select('fs.id,fs.form_id,fs.submission,fs.token,fs.created_at,fd.response_to,concat(u.firstname," " ,u.lastname) as submitted_by')
				->from('form_submission fs')
				->join('form_details fd','fd.form_id = fs.form_id')
				->join('users u','u.id = fs.user_id')
				->where('fs.user_id',$userid)
				->where('fs.form_id',$formid)
				->where('fs.org_id',$org_id)
				->order_by('fs.created_at','DESC');
		$forms = $this->db->get();
		//echo $this->db->last_query(); exit;
		//$list = $forms->result_array();
		//foreach()
		return $forms->result_array();
	}

	public function form_submit_data($submission_id,$formid){
		$this->db->select('id,submission')
				->from('form_submission fs')
				->where('fs.id',$submission_id)
				->where('fs.form_id',$formid);
		$data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->row()->submission;	
		}
		return 0;
	}

	/* Set Form as Important or Favourites */

	public function set_important($formid,$userid,$important){

		$this->db->set('important',$important);

		$this->db->where('form_id = '.$formid.' and user_id = '.$userid);

		$this->db->update('user_form');

		//if($this->db->affected_rows()){
			
			return true;		

		//}

	}

	/*public function submit_form($fields =array(),$formid,$userid){
		$storedid = array();
		if(!is_array($fields) && count($fields <= 0)){
		        $return['msg'] = array("msg" => 'Submission Error');
			$return['code'] = 204;
			return $return;
		}
		foreach($fields as $page=>$page_values){
		    foreach($page_values as $row=>$row_values){
				foreach($row_values as $col=>$col_values){
				    if(is_array($col_values)){
						$storedid[]=$this->form_field_values($col_values,$formid);				
				    }
				}			
		    }
		}
		$response = $this->update_formsubmission($formid,$userid);
		if($response['code'] == 200){
			$token = $this->generateFormToken(10);
			/* Store Form Submitted Details 
			$this->formsubmission_details($token,$formid);
			$this->update_formfieldvalues_with_token($token,$formid,$storedid);
			return $response;
		}else{
			return $response;
		}
	  } */

        /* Get Values from the Field and 

		Filter with those types Store it into Table

	  */

	public function form_field_values($col_values = array(),$formid){
		$this->db->set('name', $col_values['name']);
		$this->db->set('fieldid', $col_values['datafieldId']);
		$this->db->set('formid', $formid);
		$value = $this->check_fields_values($col_values);
		$this->db->set('value', $value);
		$this->db->insert('form_fields_values'); 
		return $this->db->insert_id();
	}

	/* Store Form Submitted Details */

	public function formsubmission_details($token,$formid,$userid){
		
		$this->db->set('token',$token);

		$this->db->set('created_date',gmdate(date('Y-m-d h:i:s'),time()));

		$this->db->set('modified_date',gmdate(date('Y-m-d h:i:s'),time()));

		$this->db->set('formid',$formid);
		$this->db->set('submitted_by',$userid);

		$this->db->insert('tbl_form_submission_details');

	}

	/* Updates Form field Values with token */

	public function update_formfieldvalues_with_token($token,$formid,$storedid = array()){

		foreach($storedid as $key=>$value){
				
			$this->db->set('token',$token);

			$this->db->where('id = '.$value.' AND formid = '.$formid);

			$this->db->update('tbl_form_fields_values');

			
			
		}	

	}
	
		/* Updates Form Submission table records */

	public function update_formsubmission($formid,$userid){

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

	/* Genereate Submitted Form Token */

	function generateFormToken ($length) {

	    $possible = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRESTUVWXYZ_"; // allowed chars in the password
	    if ($length == "" OR !is_numeric($length)){

	      $length = 8; 

	     }

	     $i = 0; 

	     $password = "";    

	     while ($i < $length) { 

	      $char = substr($possible, rand(0, strlen($possible)-1), 1);

		      if (!strstr($password, $char)) { 

			       $password .= $char;

			       $i++;

		       }
	      }

     		return $password;
	}

	public function submitted_details($formid,$userid){

		$CI =& get_instance();

	        $CI->load->model('api/user_model');

		$roles = $CI->user_model->user_roles($userid);

		$where = array();
		
		//$where[]  =  'f.created_by = '.$userid;
		
		$this->db->distinct();

		$this->db->select('f.id,f.name,f.description,fs.submission') 

			 ->from('forms as f')
		
			 ->join('user_form as uf','uf.form_id = f.id AND uf.user_id = '.$userid)

			 ->join('form_submission as fs','fs.form_id = f.id');

		$where = 'f.id = '.$formid;

		//$wheres = implode('AND',$where);

		$this->db->where($where);

		$result	= $this->db->get();

		if($result->num_rows()){

			return $result->result_object();

		}
		else{

			return false;
		}	

		

	}
	
}
