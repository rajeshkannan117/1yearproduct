<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * This is Alert management controller of Formpro
 *
 * @package        CodeIgniter
 * @category            controller
 * @author       Vignesh.M
 * @link                http://innoppl.com/
 *
 */
include APPPATH . 'controllers/OAuth.php';
include APPPATH . 'controllers/common.php';

class Alert extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('comman_model');
        $this->load->model('alert_model');
        $this->load->language('menu');
        $this->load->library('breadcrumbs');
        $this->load->language('alert');
        $this->load->model('permission_model');
        $this->load->model('login_model');
        $this->load->model('user_model');
        $this->load->model('user_model');
        $this->load->library('PushNotifications');
        $this->load->helper('access');
        $user_id = $this->session->userdata('user_id');
        //Check the user is logged in properly
        if ($this->session->userdata('logged_in') == false) {
            $this->session->set_flashdata('return', $_SERVER['REQUEST_URI']);
            redirect(base_url() . 'login/', 'refresh');
        }
        $this->roles = $this->login_model->assign_roles($user_id);
        $this->load->helper('date');
        $method = $this->router->fetch_method();
        if (is_array($this->roles['alerts'])) {
            switch ($method) {
                case 'add':
                    if (!in_array('create', $this->roles['alerts'])) {
                        die('unauthorised access');
                    }
                    break;
                case 'edit':
                    if ((!in_array('update', $this->roles['alerts'])) && (!in_array('create',
                            $this->roles['alerts']))
                    ) {
                        die('unauthorised accesss');
                    }
                    break;
                case 'delete':
                    if (!in_array('delete', $this->roles['alerts'])) {
                        die('unauthorised access');
                    }
                    break;
                case 'index':
                    if (!in_array('read', $this->roles['alerts'])) {
                        die('unauthorised access');
                    }
                default:
                    break;
            }
        } else {
            $data['msg'] = 'Unauthorised access';
            redirect(base_url() . 'error/', 'refresh');
        }
    }

    public function index($alertid = NULL)
    {
        $data['ErrorMessages'] = '';
        $data['siteTitle'] = $this->lang->line('alerts') . SITE_NAME;
        $data['menu'] = $this->roles;
        $this->breadcrumbs->add('Alert', base_url().'alert');
        $data['breadcrumbs'] = $this->breadcrumbs->output();
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $org_id = $this->session->userdata('org_id');
        $data['org_id'] = $org_id;
        if(isset($alertid)){
            $data['alertid'] = $alertid;
        }
        /* Get super admin id */
        $superadmin_id = $this->user_model->get_superadmin_id($org_id);
        foreach($superadmin_id as $key=>$value){
            $superadmin = $value['id'];
        }
        
        $this->load->view('header', $data);
        $data['alerts'] = $this->alert_model->getAlertList($org_id,$user_id,$superadmin);
        $this->load->view('alert/list', $data);
        $this->load->view('footer');
    }
    public function alert($alertid){
        $this->index($alertid);
    }

    public function view($alertId)
    {
        $data['user_id'] = $this->session->userdata('user_id');
        $result = $this->alert_model->getAlertDetails($alertId);
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
            $output['created_at'] = (new DateTime($item['alert_created']))->format('Y-m-d h:i a');
            $output['user_id'] = $item['user_id'];
            $output['alert_owner'] = $item['alert_owner_user_id'];
            $output['org_id'] = $item['org_id'];
            $output['job_site'] = $item['job_site'];
            $output['name'] = $item['name'];
            if ($item['comment_id']) {
                $output['comment'][$item['comment_id']]['comment'] = $item['comment'];
                $output['comment'][$item['comment_id']]['created_at'] = (new DateTime($item['commentCreated']))->format('Y-m-d h:i a');
                $output['comment'][$item['comment_id']]['name'] = $item['comment_name'];
                $output['comment'][$item['comment_id']]['user_id'] = $item['comment_userid'];
                $output['comment'][$item['comment_id']]['comment_id'] = $item['comment_id'];
                if($item['profile']){
                    $output['comment'][$item['comment_id']]['profile'] = base_url() . "uploads/user/" . $item['profile'];                    
                }else{
                    $output['comment'][$item['comment_id']]['profile'] = base_url() . "uploads/user/user.png";
                }
            }
            $output['reporting_to'][$item['report_id']]['id'] = $item['report_userid'];
            $output['reporting_to'][$item['report_id']]['name'] = $item['report_name'];
            if ($item['image_id']) {
                $output['images'][$item['image_id']] = base_url() . 'uploads/' . $item['org_id'] . '/' . $item["job_site_id"] . '/alert' . $alertId . '/' . $item['image_name'];
            }
            $output['reporting_authority'][]=$item['report_userid'];
        }
        $output['comment'] = array_values($output['comment']);
        $output['reporting_to'] = array_values($output['reporting_to']);
        $output['images'] = array_values($output['images']);
        $count = (count($output['images'])) ? 1 : 0;
        $output['have_attachements'] = (bool)$count;
        $data['alert'] = $output;
        $this->load->view('alert/details', $data);
    }

    public function create()
    {
        $post = $this->input->post();

        if($post['submit_message']) {
            $comment = array(
                "comment" => $post['submit_message'],
                "alert_id" => $post['alert_id'],
                "user_id" => $post['user_id'],
                "created_at" => gmdate('Y-m-d H:i:s')
            );
            $this->alert_model->insert_comment($comment);
            /* Get Device token for the user */
            $notification_data = array();
            $user = $this->alert_model->get_user_details($post['user_id']);
            $alert_title = $this->alert_model->get_alert_title($post['alert_id']);  
            $notification_data['details']['alert_id'] = $post['alert_id'];
            $notification_data['details']['user_id'] = $post['user_id'];
            $notification_data['title'] = $user->name.' added comments for the alert '.$alert_title.' ';
            $notification_data['description'] =  $post['submit_message'];
            $notification_data['type'] = '2.2';
            $to_push_notifi = array();
            /* find alert owner */
            $alert_owner = $this->alert_model->alert_owner($post['alert_id']);
            $reporting_to = array();
            if($alert_owner == $post['user_id']){
                /* if i'm an owner of the alert send notification to reporting authority */
                $this->alert_model->get_reported_user_alerts($post['alert_id']);
                foreach($push as $key=>$value){
                    $reporting_to[] = $value['reporting_to'];
                }
            }else{
                /* I'm not owner of the alert notify the owner of the alert */
                $reporting_to[] = $alert_owner;
            }
            foreach($reporting_to as $key=>$value){
                $to_push_notifi[] = $this->user_model->user_device_token($value);
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
           
        } else {

        }
        $profile_pic = $this->login_model->get_user_profile_pic($post['user_id']);
        $user_details = $this->alert_model->get_user_details($post['user_id']);
        if((!empty($profile_pic)) && file_exists(THUMB_IMAGE_PATH.$profile_pic)){
                $profile = $profile_pic;
            }else{
                $profile = 'user.png';
            }
        echo '
        <div class="chat_message_wrapper chat_message_right">
            <div class="chat_user_avatar">
                <img class="md-user-image" src="'.base_url().'uploads/user/thumb/'.$profile.'" alt="" />
            </div>
            <ul class="chat_message">
                <li>
                    <p>'.
                        $user_details->name.
                        '<br/>'.
                        $post['submit_message']
                        .'<span class="chat_message_time">'.$comment['created_at'].'</span>
                    </p>
                </li>
            </ul>
        </div>';
        exit;
    }

    public function close($alert_id)
    {
        $this->alert_model->close_alert($alert_id);
        $current_user_id = $this->session->userdata('user_id');
        /* Update alert details table */
        $this->alert_model->alert_resolve_status($alert_id,$current_user_id);
        $user = $this->alert_model->get_user_details($current_user_id);
        $this->session->set_flashdata('SucMessage', "Issue closed successfully");
        $alert_owner = $this->alert_model->alert_owner($alert_id);
        $alert_title = $this->alert_model->get_alert_title($alert_id);
        $reporting_to = array();
        $notification_data['details']['alert_id'] = $alert_id;
        $notification_data['details']['user_id'] = $current_user_id;
        $notification_data['title'] = $user->name.' resolved those alert '.$alert_title;
        $notification_data['description'] =  '';
        $notification_data['type'] = '2.3';
        $reporting_to[] = $alert_owner;
        foreach($reporting_to as $key=>$value){
                $to_push_notifi[] = $this->user_model->user_device_token($value);
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
        redirect(base_url().'alert/', 'refresh');
        
    }
}
