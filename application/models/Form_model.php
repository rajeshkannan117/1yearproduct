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
        $this->load->library('filter');
		$this->load->helper('date');
	}
    /* Form Work Flow */
    public function form_hierarchy_insert($form_id,$uuid){
        $res = $this->form_details($form_id);
        $this->db->insert('form_hierarchy',
                    array('form_hierarchy_name' => $res->form_name.' Work Flow',
                          'form_id'=>$form_id,
                          'uuid'=>$uuid
                          )
                );
        return $this->db->insert_id();
    }
    public function get_form_hierarchy($form_id){
        $this->db->select('fh.form_hierarchy_id')->from('form_hierarchy fh')->where('fh.form_id',$form_id);
        $res = $this->db->get();
        if(isset($res->row()->form_hierarchy_id)){
            return $res->row()->form_hierarchy_id;
        }
        return 0;

    }
     public function get_form_hierarchy_uuid($form_id){
        $this->db->select('fh.uuid')->from('form_hierarchy fh')->where('fh.form_id',$form_id);
        $res = $this->db->get();
        if(isset($res->row()->uuid)){
            return $res->row()->uuid;
        }
        return 0;

    }
    public function organization_form_counts($org_id){
        $this->db->select('count(*) as forms')
                ->from('form_details fd');
        if($org_id != 1){
            $this->db->where('fd.org_id',$org_id);       
        }
        $this->db->where('fd.status','1');
        $count = $this->db->get()->row()->forms;
        return $count;
    }
    public function form_hierarchy_position_insert($approve = array(),$form_id,$hierarchy_id){
        foreach($approve as $key=>$value){
            $this->db->select('form_hierarchy_position_id as id')->from('form_hierarchy_position')->where('user_id = '.$value.' and form_id = '.$form_id.' and form_hierarchy_id = '.$hierarchy_id.' and sort_id = '.$key);
            $res = $this->db->get();
            $count = $res->num_rows();
            if(!$count){
                $this->db->insert('form_hierarchy_position',array('user_id'=>$value,'form_id'=>$form_id,'form_hierarchy_id'=>$hierarchy_id,'sort_id'=>$key));
                $store[] = $this->db->insert_id();
            }else{
                $store[] = $res->row()->id;
            }
        }
        if(is_array($store)){
         $sql ="DELETE from form_hierarchy_position where form_hierarchy_position_id NOT IN(".implode(',',$store).") and form_id = ".$form_id.' and form_hierarchy_id ='.$hierarchy_id;
            $this->db->query($sql);
        }
    }
    public function form_change_status($form_id){
        $this->db->set('status','1');
        $this->db->where('form_id ='.$form_id);
        $this->db->update('form_details');
    }
    public function get_form_hierarchy_position($hierarchy_id,$form_id)
    {
        $sql ='SELECT fp.user_id,fp.sort_id,CONCAT_WS(" ",u.firstname,u.lastname) as name from form_hierarchy_position as fp JOIN users as u ON u.id = fp.user_id  where form_hierarchy_id = '.$hierarchy_id.' and form_id = '.$form_id.' order by sort_id ASC';
        $res = $this->db->query($sql);
        return $res->result_array();
    }
	/* Form_list */
	public function form_list(){
        $org_id = $this->session->userdata('org_id');
    	$this->db->select('f.form_id,f.uuid,f.form_name,f.form_desc,f.status,f.created_by,f.default,f.due_date')
    			  ->from('form_details f');
        $this->db->where('f.org_id',$org_id);
        $query=$this->db->get();
        //echo $this->db->last_query();
		return $query->result();
	}
    /* Form Location List */
    public function form_location_list($form_id){
        $this->db->select('ol.id,ol.uuid,CONCAT_WS(" ",ol.location_name ,ol.state) as location,fl.form_id')
                 ->from('form_location fl')
                 ->join('org_location ol','ol.id = fl.location_id')
                 ->where_in('fl.form_id',$form_id)
                 ->where('ol.status = 1');
        $res = $this->db->get();
        return $res->result_array();
    }
    public function form_category_name_list($form_id){
        $this->db->select('c.cat_id,c.category_name,fc.form_id')
                 ->from('form_category fc')
                 ->join('category c','c.cat_id = fc.cat_id')
                 ->where_in('fc.form_id',$form_id)
                 ->where('c.status = 1');
        $res = $this->db->get();
        return $res->result_array();   
    }
    public function check_form_status($form_id){
        $this->db->select('f.*')
                ->from('form_details f')
                ->where('f.status','1')
                ->where('f.form_id',$form_id);
        $res = $this->db->get();
        return $res->num_rows();
    }
    /* Form Users List */
    public function list_form_users($form_id){
        $this->db->select('u.id,uf.form_id,u.uuid,CONCAT_WS(" ",u.firstname,u.lastname) as name,uf.form_id')
                 ->from('user_form uf')
                 ->join('users u','u.id = uf.user_id')
                 ->where_in('uf.form_id',$form_id)
                 ->where('u.activation = 1');
        $res = $this->db->get();
        return $res->result_array();
    }

    /* Form hierarchy list */
    public function form_hierarchy_list(){
        $org_id = $this->session->userdata('org_id');
        $this->db->select('f.form_id,fh.uuid,f.form_name,f.form_desc,f.status,f.created_by,f.default,f.due_date')
                  ->from('form_details f')
                  ->join('form_hierarchy fh','fh.form_id = f.form_id');
        $this->db->where('f.org_id = '.$org_id.' and f.assign_to = "workflow"');
        $query=$this->db->get();
        return $query->result();
    }
    public function check_uuid_exists($uuid){
        $this->db->select('form_id')->from('form_details f')->where('uuid',$uuid);
        $id = $this->db->get()->row('form_id');
        if($id){
            return $id;
        }
        else{
            return false;
        }
    }
    public function check_submission_uuid_exists($uuid){
        $this->db->select('id')->from('form_submission fs')->where('uuid',$uuid);
        $id = $this->db->get()->row('id');
        if($id){
            return $id;
        }
        else{
            return false;
        }
    }
    public function check_hierarchy_id_uuid_exists($uuid){
        $this->db->select('form_hierarchy_id,form_id')->from('form_hierarchy')->where('uuid',$uuid);
        $details = $this->db->get()->row();
        $id = $details->form_hierarchy_id;
        $form_id = $details->form_id;
        if($id){
            $arr['form_id'] = $form_id;
            $arr['id'] = $id;
            return $arr;
        }
        else{
            return false;
        }
    }

    /* Form count */
    public function form_count($org_id){
        $this->db->select('count(*) as forms')
                ->from('form_details f')
                ->where('f.org_id',$org_id);
        $query = $this->db->get();
        return $query->row()->forms;
    }
    public function form_submission($org_id){
        $this->db->select('count(*) as forms')
                ->from('form_submission f')
                ->where('f.org_id',$org_id);
        $query = $this->db->get();
        return $query->row()->forms;   
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

    public function form_update_step_2($update){

        $form = array();
        //$form['created_at'] = gmdate(date('Y-m-d h:i:s'),time());
        $form['updated_at'] = gmdate(date('Y-m-d h:i:s'),time());
        $form['form_content'] = $update['form_content'];
        $form['status'] = $update['status'];
        $form['form_name'] = $update['form_name'];
        $form['assign_to'] = $update['assign'];
        $this->db->where('form_id = '.$update['form_id']);
        $this->db->update('form_details',$form);
        if($this->db->affected_rows()){
            return true;
        }
        else{
            return false;
        }
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
    /* Get All Comments for the submitted fields */
    public function get_comments($submission_id){
        $this->db->select('comments.comment_id,user_form_info_text.form_field_id,comments.comments,comments.created_by,comments.user_form_info_text_id,CONCAT_WS(" ",users.firstname,users.lastname) as name')
            ->from('comments comments')
            ->join('user_form_info_text user_form_info_text','comments.submission_id = user_form_info_text.submission_id and user_form_info_text.user_form_info_text_id = comments.user_form_info_text_id','left')
            ->join('users users','users.id = comments.created_by','left')
            ->where('comments.submission_id = '.$submission_id);
        $res = $this->db->get();
        return $res->result_array();
    }
    /* Get Individual field submission id from user_form_info_text table */
    public function user_submission_data($submission_id){
        $this->db->select('user_form_info_text.user_form_info_text_id,user_form_info_text.form_field_id')
                 ->from('user_form_info_text user_form_info_text')
                 ->where('user_form_info_text.submission_id',$submission_id);
        $res = $this->db->get();
        return $res->result_array();
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
    public function updates_submission_form_submission($submission_id,$submission){
        /* Update submission data in form_submission table */
        $this->db->where('id',$submission_id);
        $this->db->update('form_submission',array('submission'=>$submission));
    }
    public function updates_status_form_submission($submission_id,$status){
        /* Update submission_status in form_submission table */
        $this->db->where('id',$submission_id);
        $this->db->update('form_submission',array('status'=>$status));   
    }
    
    
    public function user_forms($form_id,$hierarchy_id){
        $this->db->select('uf.user_id');
        $this->db->from('user_form uf');
        $this->db->where('uf.form_id ='.$form_id.' and uf.form_hierarchy_id = '.$hierarchy_id);
        $user_form = $this->db->get();
        return $user_form->result_array();
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
   /* public function generateOrCondition($array, $count, $formfieldid) {
        $str = "";
        if($formfieldid != ''){
            //$str .= "(uf.form_field_id  = ".$formfieldid." AND ";
            foreach ($array as $key => $value) {
                if($key == 0) {
                    $str.= "(";
                }
            //$str.="uf.answer ".$this->filter->query_filter($value["condition"])."'".$value['data']."'";
                $str.="(uf.form_field_id  = ".$formfieldid;
                //if($value['data'] != ''){
                $cond = $this->filter->query_filter($value["condition"]);
                    $str.=" AND "; 
                    $str.=" LOWER(uf.answer) ".$cond."'".strtolower($value['data'])."'";
                //}
                if($key != $count-1) {
                    $str .= ")";
                    $str .= " OR ";
                } else {
                    $str .= "))";
                }
            }
        }
        return $str;
    }
    public function generateAndCondition($fieldid, $value, $loopOver, $index) {
        $where = '';
        if($fieldid != ''){
            $where .= "(";
            $where .= "uf.form_field_id = ".$fieldid;
            $cond = $this->filter->query_filter($value["condition"]);
            $where .= " AND ";
            $where.="LOWER(uf.answer) ".$cond."'".strtolower($value["data"])."' ";      
            /*if($index != $loopOver - 1){
                $where .= ' OR ';
            } else {
                $where.= ")";
            //}
        }
        return $where;
    }
    public function filter_search($filter,$formid){
         
        $query = "SELECT
                    uf.submission_id as submission_id,
                    b.form_fields_id as question_id,
                    CONCAT_WS(' ',u.firstname,u.lastname) as submitted_by,
                    uf.form_field_id,
                    b.question as Question,
                    uf.answer as value,
                    s.created_at as createdDate
                  FROM user_form_info_text uf 
                  JOIN form_fields b ON uf.form_field_id = b.form_fields_id 
                  JOIN form_submission s ON uf.submission_id = s.id
                  JOIN users u ON u.id =  s.user_id
                  ";
        $where = "";
        //$wheres = "";
        $loopOver = count($filter);
        $index = 0;
        //print_r($filter);exit;
        foreach($filter as $key=>$value){
            if($key != ''){
                $field = explode("_",$key);
                $fieldid = $field[1];
                $count = count($value);
                if($count > 1) {
                    $where .= $this->generateOrCondition($value, $count, $fieldid);
                } else {
                    $where .= $this->generateAndCondition($fieldid, $value[0], $loopOver, $index);
                }
                if($index != $loopOver - 1){
                    $where .= ' OR ';
                }
                $index++;
            }
        }
        if($where !== ''){
            $wheres = ' WHERE '.$where.' GROUP BY submission_id ORDER BY createdDate DESC';
        }else{
            $wheres = ' WHERE uf.form_id = '.$formid.' GROUP BY submission_id ORDER BY createdDate DESC';
        }
        //echo $query.$wheres;exit;
        $res = $this->db->query($query.$wheres);
        return $res->result_array();
    }*/
    /*  MuniRaj Changes  */
    public function generateOrCondition($array, $count, $formfieldid) {
        $str = "";
        if($formfieldid != ''){
            //$str .= "(uf.form_field_id  = ".$formfieldid." AND ";
            foreach ($array as $key => $value) {
                if($key == 0) {
                    $str.= "(";
                }
            //$str.="uf.answer ".$this->filter->query_filter($value["condition"])."'".$value['data']."'";
                //$str.="(uf.form_field_id  = ".$formfieldid;
                $str.="(";
                //if($value['data'] != ''){
                $cond = $this->filter->query_filter($value["condition"]);
                    //$str.=" AND "; 
                    if($value["condition"] == 'like') {
                        $fie = 'uf.value_'.$formfieldid;  
                        $str.=" ".$fie.' '.$cond."'%".strtolower($value["data"])."%' ";
                    }else if($value["condition"] == 'not-like') {
                        $fie = 'uf.value_'.$formfieldid;  
                        $str.=" ".$fie.' '.$cond."'%".strtolower($value["data"])."%' ";
                    } else {
                        $fie = 'uf.value_'.$formfieldid;
                    $str.="  ".$fie.$cond."'".strtolower($value['data'])."'";     
                    }
            
                    
                //}
                if($key != $count-1) {
                    $str .= ")";
                    
                    $str .= " AND ";
                    
                } else {
                    $str .= "))";
                }
            }
        }
        return $str;
    }
    public function generateAndCondition($fieldid, $value, $loopOver, $index) {
        $where = '';
        if($fieldid != ''){
            $where .= "(";
            //$where .= "uf.form_field_id = ".$fieldid;
            $cond = $this->filter->query_filter($value["condition"]);
            //$where .= " AND ";
            if($value["condition"] == 'like') {
                $fie = 'uf.value_'.$fieldid;    
                $where.=" ".$fie.' '.$cond ."'%".strtolower($value["data"])."%' ";     
            } else if($value["condition"] == 'not-like') {
                $fie = 'uf.value_'.$fieldid; 
                $where.=" ".$fie.$cond."'%".strtolower($value["data"])."%' ";      
            }else{
                $fie = 'uf.value_'.$fieldid; 
                $where.=" ".$fie.$cond."'".strtolower($value["data"])."' ";
            }
            /*if($index != $loopOver - 1){
                $where .= ' OR ';
            } else {*/
                $where.= ")";
            //}
        }
        return $where;
    }
    public function get_key_values($form_id){
         $this->db->select('question as values');
        $this->db->from('form_fields');
        $this->db->where('form_id ='.$form_id);
        $this->db->where('field_id <> 11 AND field_id <> 16');
        $user_form = $this->db->get();
        return $user_form->result_array();
    }
    public function filter_search($filter,$formid,$order_by){
        
        
         //uf.answer as value,
        $query = "SELECT
                    uf.submission_id as submission_id,
                    b.form_fields_id as question_id,
                    CONCAT_WS(' ',u.firstname,u.lastname) as submitted_by,
                    uf.form_field_id,
                    b.question as Question,
                    
                    s.created_at as createdDate
                  FROM view_".$formid." uf 
                  JOIN form_fields b ON uf.form_field_id = b.form_fields_id 
                  JOIN form_submission s ON uf.submission_id = s.id
                  JOIN users u ON u.id =  s.user_id
                  ";
        $where = "";
        //$wheres = "";
        $loopOver = count($filter);
        $index = 0;
        //print_r($filter);exit;
        foreach($filter as $key=>$value){
            if($key != ''){
                $field = explode("_",$key);
                $fieldid = $field[1];
                $count = count($value);
                if($count > 1) {
                    $where .= $this->generateOrCondition($value, $count, $fieldid);
                } else {
                    $where .= $this->generateAndCondition($fieldid, $value[0], $loopOver, $index);
                }
                if($index != $loopOver - 1){
                    //$where .= ' OR ';
                    $where .= ' AND ';
                }
                $index++;
            }
        }
        if($where !== ''){
            $wheres = ' WHERE '.$where.' and s.status = 1 GROUP BY uf.submission_id';
        }else{
            $wheres = ' WHERE uf.form_id = '.$formid.' and s.status = 1 GROUP BY submission_id';
        }
        foreach($order_by as $key=>$value){
            $sort = ' ORDER BY s.'.$key.' '.$value;
        }
        $res = $this->db->query($query.$wheres.$sort);        
        //echo $query.$wheres;exit;
        return $res->result_array();
    }
     /*** Function for check whether view exists or not in database if not create automatically ****/
    public function check_view_exists($form_id){
        $database = $this->db->database;
        $re = $this->db->query("SHOW FULL TABLES IN ".$database." WHERE TABLE_TYPE LIKE '%VIEW%'");
        $red = $re->result_array();
        foreach($red as $k=>$v) {
            $view_tab[$k] = $v['Tables_in_'.$database];
        }  
        if(!in_array('view_'.$form_id,$view_tab)) {
            $this->db->select('form_fields_id as id')
                    ->from('form_fields')
                    ->where('form_id = '.$form_id);
            $details = $this->db->get();
            $res= $details->result_array();
            foreach($res as $k=>$v) {
                $new[$k] = $v['id'];
            }   
            $j = '';
            for($i=0;$i<count($new);$i++) {
                $j .='MAX(IF(form_field_id = "'.$new[$i].'", answer, NULL)) AS value_'.$new[$i].' , ';
            }
            $this->db->query('create view view_'.$form_id.' AS SELECT submission_id,form_field_id,user_id,'.$j.' form_id 
                FROM user_form_info_text where form_id ='.$form_id.' GROUP BY submission_id');
            return true;    
        } else {
            return true;
        }
    }
    public function form_submission_data($submission_id){
        $query = 'Select uf.user_form_info_text_id,uf.submission_id,uf.form_field_id,CONCAT_WS(" ",u.firstname,u.lastname) as submitted_by,uf.answer,fs.created_at,ff.question,fs.uuid
            FROM user_form_info_text as uf
            JOIN users as u ON u.id =  uf.user_id
            JOIN form_fields ff ON ff.form_fields_id = uf.form_field_id
            JOIN form_submission as fs ON fs.id = uf.submission_id
            WHERE uf.submission_id = '.$submission_id.
           ' ORDER BY uf.form_field_id ASC'
            ;
            //echo $query;exit;
        $res = $this->db->query($query);
        return $res->result_array();
    }   

    /* Get form options */
    public function form_options($formfieldid)
    {
        $this->db->select('form_option_id,option_name')->from('form_options')->where('form_fields_id',$formfieldid);
        $res = $this->db->get()->result_array();
        return $res;        
    }

    /* Form category  */

    public function form_category($category,$form_id,$hierarchy_id){
        $this->db->select('id')->from('form_category')->where('cat_id = '.$category.' and form_id = '.$form_id);
        $res = $this->db->get();
        //echo $this->db->last_query();exit;
        $count = $res->num_rows();
            if(!$count){
                $this->db->insert('form_category',array('cat_id'=>$category,'form_id'=>$form_id,'form_hierarchy_id'=>$hierarchy_id));
                $store[]= $this->db->insert_id();
            }
            else{
                $store[]= $res->row()->id;
            }
        if(is_array($store)){
         $sql ="DELETE from form_category where id NOT IN(".implode(',',$store).") and form_id = ".$form_id;
            $this->db->query($sql);
        }
    }
    /* Form Location */
    public function form_location($form_id,$location,$hierarchy_id){
        $location = array_filter($location);
        foreach($location as $key=>$value){
            $this->db->select('id')->from('form_location')->where('form_id = '.$form_id.' and location_id = '.$value.' and form_hierarchy_id ='.$hierarchy_id);
            $res = $this->db->get();
            $count = $res->num_rows();
            if(!$count){
                    $this->db->insert('form_location',array('form_id'=>$form_id,'location_id'=>$value,'form_hierarchy_id'=>$hierarchy_id));
                $store[] = $this->db->insert_id();
            }
            else{
                $store[] = $res->row()->id;
            }
        }
        if(is_array($store)){
             $sql ="DELETE from form_location where id NOT IN(".implode(',',$store).") and form_id = ".$form_id.' and form_hierarchy_id = '.$hierarchy_id;
            $this->db->query($sql);
        }
    }
    /* Get Form Location */
    public function get_form_location($form_id,$hierarchy_id){
        $sql = 'SELECT location_id from form_location where form_id = '.$form_id.' and form_hierarchy_id = '.$hierarchy_id;
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function get_form_location_name($form_id,$hierarchy_id){
        $sql = 'SELECT fl.location_id, CONCAT_WS(" ",ol.location_name ,ol.state) as location 
                from form_location fl
                JOIN org_location as ol ON ol.id = fl.location_id
                where fl.form_id = '.$form_id.' and fl.form_hierarchy_id = '.$hierarchy_id.' and ol.status = 1';
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    /* Form Category */
    public function get_form_category($form_id,$hierarchy_id){
        $sql = 'SELECT cat_id from form_category where form_id = '.$form_id.' and form_hierarchy_id = '.$hierarchy_id;
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    /* Form Category Name */
     public function get_form_category_name($form_id,$hierarchy_id){
        $sql = 'SELECT fc.cat_id,c.category_name from form_category as fc
                JOIN category as c ON c.cat_id = fc.cat_id
                where fc.form_id = '.$form_id.' and fc.form_hierarchy_id = '.$hierarchy_id.' and c.status = 1';
        $res = $this->db->query($sql);
        return $res->row();
    }
    /* Form department */

    public function form_dept($dept,$form_id){
        foreach($dept as $key=>$value){
            $this->db->insert('form_dept',array('dept_id'=>$value,'form_id'=>$form_id));
        }
    }
    /* Form users */

    public function form_users($users,$form_id,$hierarchy_id){
        //print_r($users);exit;
        foreach($users as $key=>$value){
            if($value != 0){
                $this->db->select('id')->from('user_form')->where('user_id = '.$value.' and form_id = '.$form_id.' and form_hierarchy_id = '.$hierarchy_id);
                $res = $this->db->get();
                $count = $res->num_rows();
                if(!$count){
                    $this->db->insert('user_form',array('user_id'=>$value,'form_id'=>$form_id,'form_hierarchy_id'=>$hierarchy_id,'important'=>'0'));
                    $store[]= $this->db->insert_id();
                }
                else{
                    $store[]= $res->row()->id;
                }
           }
        }
        if(is_array($store)){
         $sql ="DELETE from user_form where id NOT IN(".implode(',',$store).") and form_id = ".$form_id;
            $this->db->query($sql);
        }
    }
    
    public function form_delete($form_id){
        $this->db->where('form_id', $form_id);
        $this->db->delete('form_details');
        return true; 

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

    	/*$this->db->select('columns')
    			 ->from('form_details')
    			 ->where('form_id = '.$form_id);
    	$columns = $this->db->get()->row()->columns;
        */
        $columns = 0;
    	return $columns;

    }
    public function update_form_org($form_id,$org_id){
        $this->db->set('org_id',$org_id);
        $this->db->where('form_id',$form_id);
        $this->db->update('form_details');
        return true;
    }

    public function form_details($form_id){

    	$this->db->select('f.form_id,f.form_name,f.form_desc,f.form_content,f.status,f.default,f.created_by,f.assign_to,f.response_to,f.org_id')
                //->join('form_location fl','fl.form_id = f.form_id')
    			->from('form_details f')
    			->where('f.form_id = '.$form_id);
    	$details = $this->db->get()->row();
    	return $details;

    }
     /* First Step to Save the form */

    public function form_add_step_1($form){
        //$user_id = $this->session->userdata('user_id');
        $form['created_at'] = gmdate(date('Y-m-d h:i:s'),time());
        $form['updated_at'] = gmdate(date('Y-m-d h:i:s'),time());
        $form['status'] = '0';
        //$form['created_by'] = $user_id;
        $this->db->insert('form_details',$form);
        //echo $this->db->last_query(); exit;
        $form_id = $this->db->insert_id();
        return $form_id;
    }

    /* Second Step to update the form content with form id */
    public function form_add_step_2($update){

            $form = array();
            $form['updated_at'] = gmdate(date('Y-m-d h:i:s'),time());
            $form['status'] = $update['status'];
            $form['form_content'] = $update['form_content'];
            //$form['form_api_content'] = '';
            $this->db->where('form_id = '.$update['form_id']);
            $this->db->update('form_details',$form);
            if($this->db->affected_rows()){
                    return true;
            }
            else{
                    return false;
            }
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
    public function form_submission_list_owner_report($formid){
        $this->db->select('fs.id,fs.form_id,fd.form_name,fs.submission,fs.token,fs.created_at,fd.response_to,concat(u.firstname," " ,u.lastname) as submitted_by')
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
     public function form_submission_list_user_report($userid,$formid){
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

        $this->db->select('f.id,f.form_id,f.user_id,f.created_at,f.submission,f.org_id')
                ->from('form_submission f')
                ->where('f.id = '.$id);
        $details = $this->db->get();
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

    }
    public function form_field_data_details_all($form_id){

    	$this->db->select('*')
    			->from('form_fields')
    			->where('form_id = '.$form_id);
    	$details = $this->db->get();
		return $details->result();
    	//return $details;

    }
    public function form_review_list($user_id){
        //
        //->join('form_submission fs','fs.id = fh.submission_id','left')
                 //->join('users u','u.id = fs.user_id','left')
        $this->db->select('fh.status as review_status,fh.createddate,fh.submission_id,fh.form_review_history_id')        
                 ->from('form_review_history fh')
                 ->join('form_details fd','fd.form_id = fh.form_id')
                 ->where('fh.user_id',$user_id);
        $details = $this->db->get();
        //echo $this->db->last_query();exit;
        return $details->result_array();

    }
    public function get_form_hierarchy_list($user_id){
       /* $sql = 'SELECT if(fh.sort_id = 0,NULL,fh.sort_id) as sort_id,fh.form_id FROM form_hierarchy_position fh LEFT JOIN form_details fd ON fd.form_id = fh.form_id where fh.user_id = '.$user_id;
        $res = $this->db->query($sql);
        return $res->result_array();*/
        $this->db->select('fh.sort_id,fh.form_id,fh.user_id')
                ->from('form_hierarchy_position fh')
                ->join('form_details fd','fd.form_id = fh.form_id')
                ->where('fh.user_id = '.$user_id);
        $res = $this->db->get();
        return $res->result_array();

    }
    public function get_individual_form_hierarchy_list($form_id){
        $this->db->select('fh.sort_id,fh.form_id,fh.user_id')
                ->from('form_hierarchy_position fh')
                ->join('form_details fd','fd.form_id = fh.form_id')
                ->where('fh.form_id = '.$form_id);
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
        }else{
            //$user[$form_id] = $value['user_id'];
            $user_id = $value['user_id'];
            $form_id = $value['form_id'];
        }
        return $user_id.'#'.$form_id;
    }
    public function get_hierarchy_submission_data($user_id)
    {
        $user = implode(',',$user_id);
        /*$sql = "SELECT form_review_history_id,IF(`status` = '1',
        submission_id, NULL) as submission_id from form_review_history where user_id IN (".$user.")"; */
        $sql = "SELECT form_review_history_id,status,submission_id,user_id from form_review_history where user_id IN (".$user.")";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function get_previous_hierarchy_submission_data($prev_user_id)
    {
        $prev_user = implode(',',$prev_user_id);
        /*$sql = "SELECT form_review_history_id,IF(`status` = '1',
        submission_id, NULL) as submission_id ,status,user_id from form_review_history where user_id IN (".$prev_user.")";*/
        $sql = "SELECT form_review_history_id,status,submission_id,user_id from form_review_history where user_id IN (".$prev_user.")";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function get_my_sort_order($user_id,$form_id){
        $sql = "SELECT fp.sort_id from form_hierarchy_position as fp where fp.form_id = ".$form_id.' and fp.user_id = '.$user_id;
        $res = $this->db->query($sql);
        return $res->row()->sort_id;
    }
    public function intital_sort_hierarchy_submission_data($sort_zero_id)
    {
        $initial_user = implode(',',$sort_zero_id);
        /*$sql = "SELECT form_review_history_id,IF(`status` = '0',
        submission_id, NULL) as submission_id ,status,user_id from form_review_history where user_id IN (".$initial_user.")";*/
        $sql = "SELECT form_review_history_id,status,submission_id,user_id from form_review_history where user_id IN (".$initial_user.")";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function get_current_hierarchy_submission_data($current_user_id){
        $sql = "SELECT form_review_history_id,submission_id,status,user_id from form_review_history where user_id =".$current_user_id;
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function form_review_waiting_approval_lists($submission_id,$user_id){
        $submission = implode(',',$submission_id);
        //as submission_status,fh.status
        $sql = 'SELECT fh.form_review_history_id,CONCAT_WS(" ",u.firstname,u.lastname) as name,fs.id,fs.created_at as createddate,fd.form_name,fh.status,fh.user_id 
                   FROM form_submission as fs 
                   JOIN users as u ON u.id = fs.user_id
                   JOIN form_details as fd ON fd.form_id = fs.form_id
                   JOIN form_review_history as fh ON fh.submission_id = fs.id
                   WHERE fs.id IN('.$submission.') AND fh.user_id ='.$user_id.'
                   ORDER BY createddate DESC';
                //echo $sql;exit;
        $res = $this->db->query($sql);
        //GROUP BY fs.id 
        // GROUP BY fh.form_review_history_id
        return $res->result_array();
    }
    public function form_review_submission_id($user_id){
        $sql = 'SELECT submission_id from form_review_history where user_id = '.$user_id;
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function form_review_approval_lists($user_id){
        $this->db->select('CONCAT_WS(" ",u.firstname,u.lastname) as name,fd.form_id,fd.form_name,fs.*,fh.status as review_status,fh.createddate,fh.submission_id,fh.form_review_history_id')        
                 ->from('form_review_history fh')
                 ->join('form_submission fs','fs.id = fh.submission_id','left')
                 ->join('users u','u.id = fs.user_id','left')
                 ->join('form_details fd','fd.form_id = fh.form_id')
                 ->where('fh.user_id',$user_id);
        $details = $this->db->get();
        return $details->result_array();
    }
    public function form_review_submission_status($submission_id){
        $submission = implode(',',$submission_id);
        $sql = 'SELECT user_id,status,submission_id from form_review_history where submission_id IN('.$submission.') ORDER BY form_review_history_id ASC';
        $res = $this->db->query($sql);
        return $res->result_array();

    }
    public function form_review_status($user_id,$submission_id,$form_id){
        $this->db->select('fh.status')
                 ->from('form_review_history fh')
                 ->where('fh.form_id = '.$form_id.' and fh.submission_id ='.$submission_id.' and fh.user_id = '.$user_id);
        return $this->db->get()->row()->status;
    }
    public function approved_review_history($submission_id,$approved_by,$status){
        /* Update status id in form_review_history table */
        $this->db->where('submission_id',$submission_id);
        $this->db->where('user_id',$approved_by);
        $this->db->update('form_review_history',array('status'=>$status));    
    }
    public function reassign_user_form_status($reassign_users,$submission_id,$form_id,$status){
        $current_user = $this->session->userdata('user_id');
        foreach ($reassign_users as $key => $value) {
            $this->db->where('user_id',$value);
            $this->db->where('submission_id',$submission_id);
            $this->db->where('form_id',$form_id);
            if($value != $current_user){
                $this->db->update('form_review_history',array('status'=>'0'));
            }else{
                $this->db->update('form_review_history',array('status'=>'3'));
            }
        }
        $this->db->where('id',$submission_id);
        $this->db->update('form_submission',array('status'=>$status,'reassigned_by'=>$current_user,'reassigned_to'=>implode(',',$reassign_users)));
    }
    public function decline_form_submission($submission_id,$declined_by,$status){
        /* Set rejected submission for all hierarchy users */
        $this->db->where('submission_id',$submission_id);
        $this->db->update('form_review_history',array('status'=>$status));
        /* Set form submission as declined status */
        $this->db->where('id',$submission_id);
        $this->db->update('form_submission',array('status'=>$status,'declined_by'=>$declined_by));
    }

    public function previous_approved_users($submission_id,$user_id){
        $sql = 'SELECT fh.user_id, CONCAT_WS( " ", u.firstname, u.lastname ) AS name
                FROM `form_review_history` AS fh
                JOIN users AS u ON u.id = fh.user_id
                WHERE fh.submission_id ='.$submission_id.' AND fh.user_id !='.$user_id.
                ' AND fh.status = 1
                LIMIT 0 , 30';
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function dept_users($dept_id = array()){
        $sql = 'SELECT org_user_department.user_id,org_user_department.dept_id, CONCAT_WS( " ", users.firstname, users.lastname ) AS name
                FROM `org_user_department`
                JOIN users ON users.id = org_user_department.user_id
                WHERE org_user_department.dept_id IN ('.implode(",",$dept_id).')';
        $res = $this->db->query($sql);
        return $res->result_array();
    }
}
