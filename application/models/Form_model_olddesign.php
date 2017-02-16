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
class Form_model extends CI_Model
{
	public function __construct()
	{
		date_default_timezone_set ("America/New_York");
		$this->load->database();
		$this->load->helper('date');
	}

	/* Form_list */
	public function form_list(){
        $org_id = $this->session->userdata('org_id');
    	$this->db->select('f.form_id,f.form_name,f.form_desc,f.status,f.created_by,f.default')
    			  ->from('form_details f');
        $this->db->where('f.org_id',$org_id);
        $query=$this->db->get();
		return $query->result();
	}

    /* User Form */
        public function get_fieldmaster(){
            $this->db->select('*')
                     ->from('fields_master')->where('status = 1');
            $rows = $this->db->get();
            //echo $this->db->last_query(); exit;
            $fields = array();
            foreach($rows->result_array() as $key=>$value){
                $fields[$value['fields_master_id']]['field_type'] = $value['fields_type'];
                $fields[$value['fields_master_id']]['api_type'] = $value['api_type'];
            }
            return $fields;                                                              
        }
      
    public function user_form(){
        $user_id = $this->session->userdata('user_id');
        $this->db->select('uf.form_id');
        $this->db->from('user_form uf');
        $this->db->where('uf.id ='.$user_id);
        $user_form = $this->db->get();
        $count = $user_form->num_rows();
        if($count){
            return $user_form->result_array();
        }else{
            return array();
        }
    }
    /* Delete Form fields */
    public function delete_fields($fieldid){
        $this->db->where('form_fields_id',$fieldid);
        $this->db->delete('form_fields');
    }
    /* Delete Form functions */
    public function delete_options($optionid){
        $this->db->where('form_option_id',$optionid);
        $this->db->delete('form_options');
    }

    /* Form category  */

    public function form_category($category,$form_id){
        //print_r($category); exit;
        /*foreach($category as $key=>$value){
            /* check formid is already assigned to organization */
            $this->db->select('id')->from('form_category')->where('cat_id = '.$category.' and form_id = '.$form_id);
            $res = $this->db->get();
            $count = $res->num_rows();
            if(!$count){
                $this->db->insert('form_category',array('cat_id'=>$category,'form_id'=>$form_id));
                $store[]= $this->db->insert_id();
            }
            else{
                $store[]= $res->row()->id;
            }
        //}
        //print_r($store); exit;
        if(is_array($store)){
         $sql ="DELETE from form_category where id NOT IN(".implode(',',$store).") and form_id = ".$form_id;
            $this->db->query($sql);
        }

    }

    /* Form department */

    public function form_dept($dept,$form_id){
        foreach($dept as $key=>$value){
            $this->db->insert('form_dept',array('dept_id'=>$value,'form_id'=>$form_id));
        }
    }
    /* Form users */

    public function form_users($users,$form_id){
        foreach($users as $key=>$value){
            $this->db->select('id')->from('user_form')->where('user_id = '.$value.' and form_id = '.$form_id);
            $res = $this->db->get();
            $count = $res->num_rows();
            if(!$count){
                $this->db->insert('user_form',array('user_id'=>$value,'form_id'=>$form_id,'important'=>'0'));
                $store[]= $this->db->insert_id();
            }
            else{
                $store[]= $res->row()->id;
            }
        }
        if(is_array($store)){
         $sql ="DELETE from user_form where id NOT IN(".implode(',',$store).") and form_id = ".$form_id;
            $this->db->query($sql);
        }
            //$this->db->insert('user_form',array('user_id'=>$value,'form_id'=>$form_id,'important'=>'0'));
    }
    
    public function form_delete($form_id){
        $this->db->where('form_id', $form_id);
        $this->db->delete('form_details');
        return true; 
        //$this->db->delete('*')->from('form_details')->where('form_id');

    }
    public function form_users_list($form_id){
        $this->db->select('')
                ->from('user_form')
                ->where('form_id',$form_id);
        $res = $this->db->get();
        return $res->result_array();
    }

    public  function form_org($org_id,$form_id){
        /* check formid is already assigned to organization */
        $this->db->select('of.*');
        $this->db->from('org_form of');
        $this->db->where('of.org_id = '.$org_id.' and of.form_id = '.$form_id);
        $return = $this->db->get();
        if(!$return->num_rows()){
            $this->db->insert('org_form',array('org_id'=>$org_id,'form_id'=>$form_id));
        }
    }
	/* Form Save */

	function save_form($array)
    {

    	$session = $this->session->userdata('logged_in');

    	if($array['formId'] == 0){

    		$this->db->set('createdtime', gmdate(date('Y-m-d h:i:s'),time())); 

    		$this->db->set('modifiedtime', gmdate(date('Y-m-d h:i:s'),time())); 

    		$this->db->set('name', $array['formName']); 

    		$this->db->set('description',$array['formDesc']);

    		$this->db->set('contents', $array['formDatas']);

    		$this->db->set('created_by', $session['userid']);

    		$this->db->set('modified_by', $session['userid']);

    		$this->db->set('status',1);

    		$this->db->insert('forms');	

    		$form_id =  $this->db->insert_id();

    		if($array['categories']){

			$this->rebuild_forms_categories($array['categories'],$array['formId']);
		}

		//$this->rebuild_users_category($array['users'],$array['categories']);

		$this->rebuild_user_form($array['users'],$form_id );

    	}
    	else{
		
   			/*$this->db->set('name', $array['formName']);

    		$this->db->set('modifiedtime', gmdate(date('Y-m-d h:i:s'),time()));

    		$this->db->set('modified_by', $session['userid']);

    		$this->db->set('contents', $array['formDatas']);

    		$this->db->set('description',$array['formDesc']);

    		$this->db->where('id',$array['formId']);
			
		$this->db->update('forms');*/

		/* Genereate Field id and store data into form_fields_data */

		$desc = $this->formfields_values($array['formId'],$array['formDatas']);

		print_r($desc); exit;
			
		if($array['categories']){

			$this->rebuild_forms_categories($array['categories'],$array['formId']);
		}
			//$this->rebuild_users_category($array['users'],$array['categories']);

			$this->rebuild_user_form($array['users'],$array['formId']);

			
    	}
		if ($this->db->affected_rows() != '1')
		{
	       
	        	return FALSE;

		}
		else{

			return TRUE;

		}
		
    }

    /* 
        Add form data
    */

    public function formdata_add($posts,$json){
        
        $input = array('radio','select','checkbox');
        $this->db->insert('form_submission',$json);
        foreach($posts as $post){
            if(in_array($post['type'],$input)){
                $form = array(
                        'form_field_id'=>$post['form_field_id'],
                        'user_id'=> $post['user_id'],
                        'form_id'=>$post['form_id'],
                        'form_option_id'=>$post['option_id']
                        );
                $this->db->insert('user_form_info_options',$form);
            }else{
                $form = array(
                        'form_field_id'=>$post['form_field_id'],
                        'user_id'=> $post['user_id'],
                        'form_id'=>$post['form_id'],
                        'answer'=>$post['answer']
                        );
                $this->db->insert('user_form_info_text',$form);
            }
        }
        //$loc_id = $this->db->insert_id();
        //print_r($country); exit;
        return $post['form_id'];
    }

    /* First Step to Save the form */

    public function form_add_step_1($form){

        $form['created_at'] = gmdate(date('Y-m-d h:i:s'),time());
		$form['updated_at'] = gmdate(date('Y-m-d h:i:s'),time());
        $form['status'] = '0';
		$this->db->insert('form_details',$form);
		$form_id = $this->db->insert_id();
		return $form_id;
    }

    /* Second Step to update the form content with form id */
    public function form_add_step_2($update){

            $form = array();
            $form['updated_at'] = gmdate(date('Y-m-d h:i:s'),time());
            $form['status'] = '1';
            $form['form_content'] = $update['form_content'];
            $form['form_api_content'] = $update['form_api_content'];
            $this->db->where('form_id = '.$update['form_id']);
            $this->db->update('form_details',$form);
            if($this->db->affected_rows()){
                    return true;
            }
            else{
                    return false;
            }
    }

    public function form_update_step_1($form){
    	$update = array();
		$update['updated_at'] = gmdate(date('Y-m-d h:i:s'),time());
		$update['default'] =  $form['default'];
		$update['status'] =  '1';
		$update['form_name'] = $form['form_name'];
		$update['form_desc'] = $form['form_desc'];
		$update['form_code'] = $form['form_code'];
		$update['columns'] = $form['columns'];
		$this->db->where('form_id',$form['form_id']);
		$this->db->update('form_details',$update);
		if($this->db->affected_rows()){
            return true;
        }
        else{
            return false;
        }
		//return true;
    }
    public function form_update_step_2($update){

    	$form = array();
    	//$form['created_at'] = gmdate(date('Y-m-d h:i:s'),time());
		$form['updated_at'] = gmdate(date('Y-m-d h:i:s'),time());
		$form['form_content'] = $update['form_content'];
        $form['status'] = '1';
		$this->db->where('form_id = '.$update['form_id']);
		$this->db->update('form_details',$form);
		if($this->db->affected_rows()){
			return true;
		}
		else{
			return false;
		}
    }
    public function form_code_validation($form_code,$form_id){

    	$this->db->select('form_id')
    			->from('form_details')->where('form_code = "'.$form_code.'"');
    	$res = $this->db->get();
    	if($res->num_rows() > 1){
    		//echo $res->num_rows();exit;
    		return false;
    	}else if($res->num_rows() == 1 && $res->row()->form_id == $form_id){

    		return true;

    	}else{
    		return true;
    	}

    }
    public function statusform($formid,$status = '1'){

    	$this->db->set('status',$status);
    	$this->db->where('form_id',$formid);
    	$this->db->update('form_details');
    	return true;
    }
    public function form_columns($form_id){

    	$this->db->select('columns')
    			 ->from('form_details')
    			 ->where('form_id = '.$form_id);
    	$columns = $this->db->get()->row()->columns;

    	return $columns;

    }

    public function form_details($form_id){

    	$this->db->select('f.form_id,f.form_name,f.form_code,f.form_desc,f.form_content,f.status,f.default,f.created_by,f.form_type,f.assign_to,f.response_to')
    			->from('form_details f')
    			->where('f.form_id = '.$form_id);
    	$details = $this->db->get()->row();

    	return $details;

    }

    public function form_submission_list($form_id){

        $this->db->select('f.id,f.form_id,f.created_at,u.firstname,u.lastname,fd.form_name')
                ->from('form_submission f')
                ->join('form_details fd','f.form_id = fd.form_id')
                ->join('users u','f.user_id = u.id')
                ->where('f.form_id = '.$form_id);
        $details = $this->db->get();
        return $details->result_array();

    }
    /* Check user has owned form */
    public function check_owned_form($user_id,$form_id){
        $this->db->select('fd.*')
                  ->from('form_details fd')
                  ->where('fd.form_id',$form_id)
                  ->where('fd.created_by',$user_id);
        $result = $this->db->get();
        //echo $this->db->last_query();exit;
        if($result->num_rows()){
            return 1;
        }
        else{
            return 0;
        }
    }
    /* form submission list */
    public function form_submission_list_owner($formid){
        $this->db->select('fs.id,fs.form_id,fd.form_id,fd.form_name,fs.submission,fs.token,fs.created_at,fd.response_to,concat(u.firstname," " ,u.lastname) as submitted_by')
                ->from('form_submission fs')
                ->join('form_details fd','fd.form_id = fs.form_id')
                ->join('users u','u.id = fs.user_id')
                ->where('fs.form_id',$formid)
                ->order_by('fs.created_at','DESC');
        $forms = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $forms->result_array();
    }

    /* form submission list */
    public function form_submission_list_user($userid,$formid){
        $this->db->select('fs.id,fs.form_id,fd.form_id,fd.form_name,fs.submission,fs.token,fs.created_at,fd.response_to,concat(u.firstname," " ,u.lastname) as submitted_by')
                ->from('form_submission fs')
                ->join('form_details fd','fd.form_id = fs.form_id')
                ->join('users u','u.id = fs.user_id')
                ->where('fs.user_id',$userid)
                ->where('fs.form_id',$formid)
                ->order_by('fs.created_at','DESC');
        $forms = $this->db->get();
        return $forms->result_array();
    }

    public function form_submission_details($id){

        $this->db->select('f.id,f.form_id,f.created_at,f.submission')
                ->from('form_submission f')
                ->where('f.id = '.$id);
        $details = $this->db->get();
        //echo $this->db->last_query();exit;
        return $details->result_array();

    }

    public function form_category_list($form_id,$org_id){
        $this->db->select('fc.cat_id')
                ->from('form_details f')
                ->join('form_category fc','fc.form_id = f.form_id')
                ->where('f.form_id = '.$form_id.' and f.org_id = '.$org_id);
        $res = $this->db->get();
        return $res->result_array();

    }

    public function organization_category_list($org_id){
        $this->db->select('ocm.cat_id,c.category_name');
        $this->db->from('organization o');
        $this->db->join('org_domain_map od','od.org_id = o.id');
        $this->db->join('org_department_map odm','odm.domain_map_id = od.id');
        $this->db->join('org_category_map ocm','ocm.department_map_id = odm.id');
        $this->db->join('category c','c.cat_id = ocm.cat_id');
        $this->db->where('o.id',$org_id);
        $details = $this->db->get();
        return $details->result_array();
    }
    public function form_field_data_details($form_id){

    	$this->db->select('*')
    			->from('form_fields')
    			->where('form_id = '.$form_id)
    			->group_by('form_id');
    	$details = $this->db->get();
		return $details->result();
    	//return $details;

    }
    public function form_field_data_details_all($form_id){

    	$this->db->select('*')
    			->from('form_fields')
    			->where('form_id = '.$form_id);
    	$details = $this->db->get();
		return $details->result();
    	//return $details;

    }
}
