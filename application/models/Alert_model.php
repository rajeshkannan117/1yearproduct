<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * This is Alert Model for FORMPRO
 *
 * @package    CodeIgniter
 * @category    Country
 * @author    Vignesh.M
 * @link    http://innoppl.com/
 *
 */
class Alert_model extends CI_Model
{
    public function __construct()
    {
        date_default_timezone_set("America/New_York");
        $this->load->database();
        $this->load->helper('date');
    }

    public function getAlertList($org_id,$user_id,$superadmin)
    {
        $this->db->select("alerts.id, alerts.title, alerts.description, alerts.job_site_id, alerts.user_id, alerts.created_at, alerts.status, CONCAT(users.firstname, \" \", users.lastname) as name, CONCAT(org_location.location_name, \", \", org_location.city,\", \",org_location.state) as job_site")
        ->from('alerts')
        ->join('users', 'alerts.user_id = users.id', 'left')
        ->join('org_location', 'alerts.job_site_id = org_location.id', 'left')
        ->join('alert_reporting_mapping','alert_reporting_mapping.alert_id = alerts.id','left');
        if($user_id != $superadmin){
            $this->db->where('alert_reporting_mapping.reporting_to',$user_id)
                     ->or_where('alerts.user_id',$user_id);
        }
        $this->db->where('alerts.organization_id',$org_id);
        $res = $this->db->get();
        return $res->result_array();
    }
    public function getPendingAlertList($org_id)
    {
        $this->db->select("alerts.id, alerts.title, alerts.description, alerts.job_site_id, alerts.user_id, alerts.created_at, alerts.status, CONCAT(users.firstname, \" \", users.lastname) as name, CONCAT(org_location.location_name, \", \", org_location.city,\", \",org_location.state) as job_site")
        ->from('alerts')
        ->join('users', 'alerts.user_id = users.id', 'left')
        ->join('org_location', 'alerts.job_site_id = org_location.id', 'left')
        ->where('alerts.organization_id',$org_id)
        ->where('alerts.status = 1');
        $res = $this->db->get();
        return $res->result_array();
    }

    public function getAlertDetails($alertId) {
        $this->db->select("`alerts`.`id` as `alert_id`, alert_comments.id as comment_id, alert_images.id as image_id, map.id as report_id, `alerts`.`status`, `alerts`.`title`, `alerts`.`description`, `alerts`.`job_site_id`,`alerts`.`user_id` as alert_owner_user_id, `alerts`.`created_at` as `alert_created`, CONCAT(users.firstname, \" \", users.lastname) as name, `alert_comments`.`comment`, `alert_comments`.`user_id`, `alert_comments`.`created_at` AS `commentCreated`, `alert_images`.`image_name`, CONCAT_WS(\" \", `comment_users`.`firstname`, comment_users.lastname) as comment_name, `comment_users`.`id` As `comment_userid`,comment_users.imgname as profile ,CONCAT_WS(\" \", `report_users`.`firstname`, report_users.lastname) as report_name, `report_users`.`id` As `report_userid`, org_location.org_id, CONCAT(org_location.location_name, \", \", org_location.city,\", \",org_location.state) as job_site")
            ->from('alerts')
            ->join('users','users.id = alerts.user_id','left')
            ->join('alert_comments', 'alert_comments.alert_id = alerts.id','left')
            ->join('alert_images', 'alert_images.alert_id = alerts.id','left')
            ->join('alert_reporting_mapping map', 'map.alert_id = alerts.id','left')
            ->join('users comment_users', 'comment_users.id = alert_comments.user_id','left')
            ->join('users report_users', 'report_users.id = map.reporting_to','left')
            ->join('org_location', 'org_location.id = alerts.job_site_id','left')
            ->where('alerts.id', $alertId)
            ->order_by("alert_comments.created_at", "ASC");
        $res = $this->db->get();
        return $res->result_array();
    }

    public function insert_comment($comment)
    {
        return $this->db->insert('alert_comments', $comment);
    }
    public function alert_owner($alert_id){
        $this->db->select('user_id')
                 ->from('alerts')
                 ->where('id',$alert_id);
        $res = $this->db->get();
        return $res->row()->user_id;
    }
    public function get_user_details($user_id){
        $this->db->select('u.id,CONCAT_WS(" ",u.firstname,u.lastname) as name,u.email as email')
                ->from('users u')
                ->where('u.id = '.$user_id);
        $res = $this->db->get()->row();
        return $res;
    }
    public function get_reported_user_alerts($alert_id){
        $this->db->select('reporting_to')->from('alert_reporting_mapping')->where('alert_id ='.$alert_id);
        $res = $this->db->get();
        return $res->result_array();
    }
    public function get_alert_title($alert_id){
        $this->db->select('title')->from('alerts')->where('id = '.$alert_id);
        $res = $this->db->get();
        return $res->row()->title;

    }
    public function close_alert($alertId)
    {
        $this->db->set('status', '0');
        $this->db->where('id', $alertId);
        $this->db->update('alerts');
    }
    public function alert_resolve_status($alertId,$current_user_id){
        $this->db->insert('alert_details',array(
                                            'alert_id'=>$alertId,
                                            'resolved_by'=>$current_user_id,
                                            'created_at'=>gmdate(date("Y-m-d H:i:s")),
                                            'updated_at' => gmdate(date("Y-m-d H:i:s"))
                                        )
                        );

    }
}
