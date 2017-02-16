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
class Review_model extends CI_Model
{
	public function __construct()
	{
		date_default_timezone_set ("America/New_York");
		$this->load->database();
        $this->load->library('filter');
		$this->load->helper('date');
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
    public function get_previous_hierarchy_submission_data($prev_user_id)
    {
        $prev_user = implode(',',$prev_user_id);
        /*$sql = "SELECT form_review_history_id,IF(`status` = '1',
        submission_id, NULL) as submission_id ,status,user_id from form_review_history where user_id IN (".$prev_user.")";*/
        $sql = "SELECT form_review_history_id,status,submission_id,user_id from form_review_history where user_id IN (".$prev_user.")";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function intital_sort_hierarchy_submission_data($sort_zero_id)
    {
        $initial_user = implode(',',$sort_zero_id);
        /*$sql = "SELECT form_review_history_id,IF(`status` = '0',
        submission_id, NULL) as submission_id ,status,user_id from form_review_history where user_id IN (".$initial_user.")";*/
        $sql = "SELECT form_review_history_id,form_id,status,submission_id,user_id from form_review_history where user_id IN (".$initial_user.")";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function form_review_submission_id($user_id){
        $sql = 'SELECT submission_id from form_review_history where user_id = '.$user_id;
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    public function form_review_submission_status($submission_id){
        $submission = implode(',',$submission_id);
        $sql = 'SELECT user_id,status,submission_id from form_review_history where submission_id IN('.$submission.') ORDER BY form_review_history_id ASC';
        $res = $this->db->query($sql);
        return $res->result_array();

    }
    public function form_review_waiting_approval_lists($submission_id,$user_id){
        $submission = implode(',',$submission_id);
        //as submission_status,fh.status
        $sql = 'SELECT fh.form_review_history_id,CONCAT_WS(" ",u.firstname,u.lastname) as name,fs.id,fs.uuid,fs.created_at as createddate,fd.form_name,fh.status,fh.user_id 
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
    public function form_review_status($user_id,$submission_id,$form_id){
        $this->db->select('fh.status')
                 ->from('form_review_history fh')
                 ->where('fh.form_id = '.$form_id.' and fh.submission_id ='.$submission_id.' and fh.user_id = '.$user_id);
        return $this->db->get()->row()->status;
    }

    /* Comments */
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
    public function form_submission_details($id){

        $this->db->select('f.id,f.form_id,f.user_id,f.created_at,f.submission,f.org_id,f.location_id')
                ->from('form_submission f')
                ->where('f.id = '.$id);
        $details = $this->db->get();
        //echo $this->db->last_query();exit;
        return $details->result_array();
    }

    /* Reassign , Approved , Reject */

    /* Approve */

    public function approved_review_history($submission_id,$approved_by,$status){
        /* Update status id in form_review_history table */
        $this->db->where('submission_id',$submission_id);
        $this->db->where('user_id',$approved_by);
        $this->db->update('form_review_history',array('status'=>$status));    
    }
    /* Reject */

    public function decline_form_submission($submission_id,$declined_by,$status){
        /* Set rejected submission for all hierarchy users */
        $this->db->where('submission_id',$submission_id);
        $this->db->update('form_review_history',array('status'=>$status));
        /* Set form submission as declined status */
        $this->db->where('id',$submission_id);
        $this->db->update('form_submission',array('status'=>$status,'declined_by'=>$declined_by));
    }
    /* Reassign */
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
    public function check_uuid_exists($uuid){
		$this->db->select('id')->from('form_submission')->where('uuid',$uuid);
		$id = $this->db->get()->row('id');
		if($id){
			return $id;
		}
		else{
			return false;
		}
	}
}