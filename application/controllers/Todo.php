<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
/**
 *
 * This is Todo management controller of Formpro
 *
 * @package      CodeIgniter
 * @category     controller
 * @author       Rajeshkannan.C
 * @link         http://innoppl.com/
 *
 */
include APPPATH . 'controllers/OAuth.php';
include APPPATH . 'controllers/common.php';
class Todo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('access');
        define_constants();
        $this->load->model('comman_model');
        $this->load->model('category_model');
        $this->load->model('form_model');
        $this->load->model('review_model');
        $this->load->model('department_model');
        $this->load->model('category_model');
        $this->load->model('location_model');
        $this->load->language('menu');
        $this->load->language('form');
        $this->load->model('organization_model');
        $this->load->library('PushNotifications');
        $this->load->library('breadcrumbs');
        $this->load->model('user_model');
        
        $this->load->helper('cryptojs-aes.php');
        $this->load->model('permission_model');
        $this->load->model('login_model');
        $this->load->library('Fields');
        $this->load->library('Review');
        $this->load->library('Filter');
        $this->load->library('uuid');
        $this->load->helper('email_send');
        $user_id = $this->session->userdata('user_id');
        $this->fieldmaster = $this->form_model->get_fieldmaster();
        //Check the user is logged in properly
        if ($this->session->userdata('logged_in') == false) {
           $this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);
           redirect(base_url() . 'login/', 'refresh');
        }
        $this->roles = $this->login_model->assign_roles($user_id);
        $method = $this->router->fetch_method();
        switch($method){
            case 'review':
                if(!in_array('create',$this->roles['Reviews'])){
                  redirect(base_url().'error');  
                }
            break;
            case 'create':
                if(!in_array('create',$this->roles['forms'])){
                  redirect(base_url().'error');  
                }
                break;
            case 'edit_detail':
                if((!in_array('update',$this->roles['forms'])) && (!in_array('create',$this->roles['forms']))){
                     redirect(base_url().'error');
                }
                break;
            case 'edit_form':
                if((!in_array('update',$this->roles['forms'])) && (!in_array('create',$this->roles['forms']))){
                     redirect(base_url().'error');
                }
                break;
            case 'delete':
                if(!in_array('delete',$this->roles['forms'])){
                     redirect(base_url().'error');
                }
                break;
            case 'index':
                if(!in_array('read',$this->roles['Reviews'])){
                    redirect(base_url().'error');
                }
            default:

                break;
        }
        $this->load->helper('date');    
    }
    public function index()
    {        
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'Forms ' . SITE_NAME;
        $data['menu'] = $this->roles;
        $data['roles'] = $this->roles['Reviews'];
        $user_id = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');
        $this->breadcrumbs->add('Todo', base_url().'todo');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $details = $this->review_model->get_form_hierarchy_list($user_id);
        if(isset($details)){
            foreach($details as $key=>$value){
                if($value['sort_id'] != 0){
                    $ids = $this->review_model->get_previous_user_hierarchy($value);
                    $id = explode('#',$ids);
                    /* 
                        id[0] as user_id 
                        id[1] as form_id
                    */
                    if($id[0]){
                       $previous_hierarchy_user_id[] = $id[0]; 
                       $previous_hierarchy_form_id[] = $id[1];
                    }
                }else{
                    //$sort_zero_id[$value['form_id']] = $value['user_id'];
                    $sort_zero_id[] = $value['user_id'];
                    $sort_form_id[] = $value['form_id'];
                }
            }
            if(isset($previous_hierarchy_user_id)){
                $previous_hierarchy_user_id = array_unique($previous_hierarchy_user_id);
                $previous_hierarchy_form_id = array_unique($previous_hierarchy_form_id);
                //print_r($previous_hierarchy_form_id);
                $previous_hierarchy_submission_result = $this->review_model->get_previous_hierarchy_submission_data($previous_hierarchy_user_id);  
                //print_r($previous_hierarchy_submission_result);  
                if(isset($previous_hierarchy_submission_result)){
                    foreach($previous_hierarchy_submission_result as $key=>$value){
                       /* if(isset($value['submission_id'])){
                            $submission_id[] = $value['submission_id'];
                        }else{
                            $submission_id[] = '';
                        }*/
                        if(isset($value['submission_id'])){
                            $previous_hierarchy_ids[$value['submission_id']][$value['user_id']] =  $value['status'];
                        }
                    }
                }
            }
            if(isset($sort_zero_id)){
                $sort_zero_id = array_unique($sort_zero_id);
                $intital_sort_hierarchy_submission_result = $this->review_model->intital_sort_hierarchy_submission_data($sort_zero_id);
                
                if(isset($intital_sort_hierarchy_submission_result)){
                    foreach($intital_sort_hierarchy_submission_result as $key=>$value){
                        /*if(isset($value['submission_id'])){
                            $submission_id[] = $value['submission_id'];
                        }else{
                            $submission_id[] = '';
                        }*/
                        //if(isset($previous_hierarchy_form_id)){
                            if(isset($value['submission_id'])){
                                //if(!in_array($value['form_id'],$previous_hierarchy_form_id)){
                                    $submission_id[] = $value['submission_id'];
                                //}
                                //$previous_hierarchy_ids[$value['submission_id']][$value['user_id']] =  $value['status'];
                            }
                        //}
                    }
                }
            }
            $my_review_submission = $this->review_model->form_review_submission_id($user_id);            
            if(is_array($my_review_submission) && count($my_review_submission) > 0){
                foreach($my_review_submission as $key=>$value){
                    $my_review_submission_id[] = $value['submission_id'];
                }
                if(isset($my_review_submission_id)){
                    $review_submission_status = $this->review_model->form_review_submission_status($my_review_submission_id);
                    foreach($review_submission_status as $key=>$value){
                        if($value['status'] != '0' && $value['user_id'] == $user_id){
                            $submission_id[] = $value['submission_id'];
                        }
                        //$review_submission_user_status[$value['submission_id']][$value['user_id']] = $value['status'];
                    }
                }
            }
            //echo 'Previous Hierarchy Ids';
            //print_r($previous_hierarchy_ids);
            if(isset($previous_hierarchy_ids)){
                foreach($previous_hierarchy_ids as $key=>$value){
                    $keys = array_keys($value);
                    $last_key = end($keys);
                    $last_value = end($value);
                    if($last_value === '1'){
                        $submission_id[] = $key; 
                    }else{
                        //$submission_id[] = '';
                    }                    
                }
            }
            //echo 'Submission';
            //print_r($submission_id);
            if(isset($submission_id)){
                if(is_array($submission_id) && count($submission_id) > 0){
                    $submission_id = array_filter($submission_id);
                    $list = $this->review_model->form_review_waiting_approval_lists($submission_id,$user_id);
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
        $data['details'] = $list;
        $this->load->view('header',$data);
        $this->load->view('todo/review_list', $data);
        $this->load->view('footer');
    }
    public function review($uuid){
        $submission_id = $this->review_model->check_uuid_exists($uuid);
        if(empty($submission_id)){
            redirect(base_url().'error');
        }
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'Form Review' . SITE_NAME;
        $data['menu'] = $this->roles;
        $data['roles'] = $this->roles['Reviews'];
        //$this->breadcrumbcomponent->add('Home', base_url());
        //$this->breadcrumbcomponent->add('Tutorials', base_url().'tutorials');       
        $this->breadcrumbs->add('Todo', base_url().'todo');           
        $this->breadcrumbs->add('Review', base_url().'review'); 
        //$this->breadcrumbs->unshift('Review', '/');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $user_id = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');
        $userid = $this->session->userdata('user_id');
        $details = $this->form_model->form_submission_details($submission_id);
        $contents = $details[0]['submission'];
        $form_id = $details[0]['form_id'];
        $form_details = $this->form_model->form_details($form_id);

        /* Get Comments for the fileds */
        $result_comments = $this->form_model->get_comments($submission_id);
        foreach($result_comments as $key=>$value){
            if(!isset($comments[$value['form_field_id']])) {
                    $comments[$value['form_field_id']] = array();
                    $index = 0;
                }
            $comments[$value['form_field_id']][$index]['comment_id'] = $value['comment_id']; 
            $comments[$value['form_field_id']][$index]['comments'] = $value['comments']; 
            $comments[$value['form_field_id']][$index]['created_by'] = $value['name'];
            $index++;
        }
        if(isset($comments)){
            $data['comments'] = $comments; 
        }else{
            $data['comments'] = '';
        }
        /*Get User form info text */
        $submission = $this->form_model->user_submission_data($submission_id);
        foreach($submission as $key=>$value){
            $submission_data[$value['form_field_id']] = $value['user_form_info_text_id'];
        }
        /* Get Review submission status */
        $status = $this->review_model->form_review_status($user_id,$submission_id,$form_id);
        $user = $this->user_model->get_user_details($user_id,$org_id);
        $data['status'] = $status;
        $data['name'] = $user->name;
        $data['submission_data'] = $submission_data;
        $data['submission_id'] = $submission_id;
        $data['contents'] = $contents;
        $data['formname'] = $form_details->form_name;
        $data['user_id'] = $userid;
        $this->load->view('header',$data);
        $this->load->view('todo/review', $data);
        $this->load->view('footer');
    }
    public function review_submission()
    {
        $actions = array(
            'Accepted'=>'1',
            'Rejected' => '2',
            'Reassigned' => '3'
            );
        if(isset($_POST['action'])){
            $submission_id = $this->input->post('submission_id');
            $comments = $this->input->post('comments');
            $action = $this->input->post('action');
            $user_id = $this->session->userdata('user_id');
            $org_id = $this->session->userdata('org_id');
            $review_description = $this->input->post('message','');
            if($review_description == ''){
                $review_description = '';
            }
            $status = $actions[$action];
            foreach($comments as $key=>$value){ 
                if($value != ''){
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
                    $comment_id = $this->review_model->save_review_comments($store);
                    $this->review_model->update_comment_id_user_form_info_text($comment_id,$submission_id,$user_form_info_text_id);
                    $comments_fields[$formfieldid] = $value;
                }
            }
            $submission = $this->review_model->form_submission_details($submission_id);
            $submission_details = json_decode($submission[0]['submission']);
            $submitted_user_id = $submission[0]['user_id'];
            $submitted_org_id = $submission[0]['org_id'];
            $submitted_location_id = $submission[0]['location_id'];
            /* Get Location name for the Sending Email */
                $location = $this->location_model->get_location_details($org_id,$submitted_location_id);
                $location_name = $location[0]['location_name'];
                $form_id = $submission[0]['form_id'];
            /* Get Form Name for Sending Email */
                $form_details = $this->form_model->form_details($form_id);
                $form_name =$form_details->form_name;
            /* Get Current Logged user details */
                $current_user = $this->user_model->get_user_details($user_id,$org_id);
                $from = $current_user->email;
                $from_name = $current_user->name;
            /* Updates json values with comments key based on its field comments */
                foreach($submission_details->fields as $p=>$page){
                    foreach($page as $r=>$row){
                        foreach($row as $c=>$column){
                            if(isset($comments_fields[$column->formfieldid])){
                                $column->comments = $comments_fields[$column->formfieldid];
                                $column->isenabled = '1';
                            }else{
                                $column->comments = '';
                                $column->isenabled = '0';
                            }
                        }
                    }
                }
            /* Updates json values with comments in form submission */
                $submission_details = json_encode($submission_details);
                $this->form_model->updates_submission_form_submission($submission_id,$submission_details);
                $submitted_user =$this->user_model->get_user_details($submitted_user_id,$submitted_org_id);
                $notification_data['details']['form_id'] = $form_id;
                $notification_data['details']['submission_id'] = $submission_id;
                $notification_data['details']['org_id'] = $org_id;
            if($status == 1){
                // Approved to get next hierarchy user and send mail
                $details = $this->review_model->get_individual_form_hierarchy_list($form_id);
                foreach($details as $key=>$value){
                    $order[$value['sort_id']] = $value['user_id'];
                }
                $my_sort_order = $this->review_model->get_my_sort_order($user_id,$form_id);
                ++$my_sort_order;
                if(isset($order[$my_sort_order])){
                /* Alert the next level user  */
                    $next_to_email = $order[$my_sort_order];
                    $next_user=$this->user_model->get_user_details($next_to_email,$submitted_org_id);
                    /*$subject = $this->lang->line('submission');
                    $send_to = $next_user->email;
                    $message['receiver_name'] = $next_user->name;
                    $message['message'] = $review_description;
                    $message['name'] = $next_user->name;
                    $message['form_name'] = $form_name;
                    $message['form_url'] = '';
                    $message['location_name']  = $location_name;
                    $message['datetime'] = date('Y-m-d H:i:s');
                    send_email($from,$from_name,$send_to,'submission.php',$subject,$message);*/
                    $notification_data['title'] = 'Your submission against '.$form_name.' is going to review by '.$next_user->name;
                    $notification_data['description'] =  $review_description;
                    $notification_data['type'] = '1.4';
                    $to_push_notifi = $this->user_model->user_device_token($next_to_email);
                }else{
                /* All User reviews finished and changed the submission status to approved */
                    $this->form_model->updates_status_form_submission($submission_id,$status);
                    $subject = $this->lang->line('approved');
                    $send_to = $submitted_user->email;
                    /*$message['receiver_name'] = $submitted_user->name;
                    $message['message'] = $review_description;
                    $message['name'] = $current_user->name;
                    $message['form_name'] = $form_name;
                    $message['location_name']  = $location_name;
                    $message['form_url'] = '';
                    $message['datetime'] = date('Y-m-d H:i:s');
                    send_email($from,$from_name,$send_to,'resolved.php',$subject,$message);*/
                    $notification_data['title'] = 'Your submission against '.$form_name.' is Fully approved';
                    $notification_data['description'] =  $review_description;
                    $notification_data['type'] = '1.2';
                /* Get Device token for the user */
                    $to_push_notifi = $this->user_model->user_device_token($submitted_user_id);
                }
                $this->review_model->approved_review_history($submission_id,$user_id,$status);
            }
            else if($status == 2){
                // Rejected 
                    $decline_desc = $this->input->post('decline_desc');
                    $data['message'] = $decline_desc;
                    $send_to = $submitted_user->email;
                    $subject = $this->lang->line('rejected');
                    /*$message['receiver_name'] = $submitted_user->name;
                    $message['message'] = $review_description;
                    $message['name'] = $current_user->name;
                    $message['form_name'] = $form_name;
                    $message['form_url'] = '';
                    $message['location_name']  = $location_name;
                    $message['datetime'] = date('Y-m-d H:i:s');
                    send_email($from,$from_name,$send_to,'rejected.php',$subject,$message);*/
                    $this->review_model->decline_form_submission($submission_id,$user_id,$status);
                /* Set Push Notification */
                    $notification_data['title'] = 'Your submission against '.$form_name.' is rejected';
                    $notification_data['description'] =  $review_description;
                    $notification_data['type'] = '1.1';
                /* Get Device token for the user */
                    $to_push_notifi = $this->user_model->user_device_token($submitted_user_id);

            }
            else if($status == 3){
                // Reassigned
                $users = $this->input->post('users');
                $reassign_users = explode(",",$users);
                $reassign_users = array_filter($reassign_users);
                /* Initially Reassigned the form to the submitted user */
                    $send_to = $submitted_user->email;
                    $subject = $this->lang->line('reassign');
                   /* $message['receiver_name'] = $submitted_user->name;
                    $message['message'] = $review_description;
                    $message['name'] = $current_user->name;
                    $message['form_url'] = '';
                    $message['form_name'] = $form_name;
                    $message['datetime'] = date('Y-m-d H:i:s');
                    $message['location_name']  = $location_name;
                    send_email($from,$from_name,$send_to,'reassign.php',$subject,$message);*/
                    if(count($reassign_users) > 0){
                        /* Reassign the submission to previously assigned user */
                        foreach($reassign_users as $key=>$value){
                            $user=$this->user_model->get_user_details($value,$submitted_org_id);
                            $message['receiver_name'] = $user->name;
                           /* send_email($from,$from_name,$user->email,'reassign_review.php',$subject,$message);*/
                        }
                    }
                /* Change reassigned users status */
                    $reassign_users[] = $submitted_user_id;
                    $reassign_users[] = $user_id;
                    $this->review_model->reassign_user_form_status($reassign_users,$submission_id,$form_id,$status);
                    $notification_data['title'] = 'Your submission against '.$form_name.' is reassigned to you';
                    $notification_data['description'] =  $review_description;
                    $notification_data['type'] = '1.3';
                /* Get Device token for the user */
                    $to_push_notifi = $this->user_model->user_device_token($submitted_user_id);

            }
            if(isset($to_push_notifi['android']) && count($to_push_notifi['android']) > 0){
            /* Push Notification to android  */
                foreach($to_push_notifi['android'] as $key=>$value){
                    $push_android_msg[] = $this->pushnotifications->android($notification_data,$value);
                }
            }
            if(isset($to_push_notifi['ios']) && count($to_push_notifi['ios']) > 0){
                /* Push Notification to ios */
                foreach($to_push_notifi['ios'] as $key=>$value){
                    $push_ios_msg[] = $this->pushnotifications->ios($notification_data,$value);
                }
            }
            $this->comman_model->general_notifications_insert($notification_data);
            $result['msg']='Form Revised Successfully';
            $this->session->set_flashdata('SucMessage', $result['msg']);
            redirect(base_url().'todo','refresh');
        }
    }
    public function non_review(){
        $data['ErrorMessages'] = '';
        $data['siteTitle']     = 'Forms ' . SITE_NAME;
        $data['menu'] = $this->roles;
        $data['roles'] = $this->roles['Reviews'];
        $user_id = $this->session->userdata('user_id');
        $org_id = $this->session->userdata('org_id');
        $this->breadcrumbs->add('Todo', base_url().'todo');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $details = $this->review_model->get_form_hierarchy_list($user_id);
    }
}