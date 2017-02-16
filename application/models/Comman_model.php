<?php

/**
 *
 * This is user model of vanderlande
 *
 * @package	    CodeIgniter
 * @category	Model
 * @author	    Gnanasekaran
 * @link	    http://innoppl.com/
 *
 */
class Comman_model extends CI_Model {

    public function __construct() {
        date_default_timezone_set('America/New_York');
        $this->load->database();
    }

    public function addUpdateUsers($data) {
        echo "<pre>";
        print_r($data);
        die;
        $sp_data = $this->db->query("exec addupdateuserdetails @email='$email',@password='$password'");
        $result = $sp_data->result();
    }

    public function user_list() {
        $sp_data = $this->db->query("exec uspUserRetreive");
        $result = $sp_data->result_array();
        if (count($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

//Using in formpro edited version

    public function get_org_country($org_id) {


        $this->db->select('l.loc_id,l.country_name')
                ->from('location l')
                ->join("org_location ol", "l.loc_id=ol.country", "left")
                ->join("organization o", "ol.org_id=o.id", "left")
                ->where("o.id = " . $org_id);

        $result = $this->db->get();//echo $this->db->last_query(); die;
        //print_r($result->result_array());exit;
        return $result->result_array();
    }

//Using in formpro edited version
    public function get_org_domain($org_id) {
        $this->db->select('d.domain_name')
                ->from('domain d')
                ->join("org_domain dm", "d.domain_id=dm.domain_id", "left")
                ->join("org_location ol", "ol.id=dm.org_location_id", "left")
                ->join("organization o", "ol.org_id=o.id", "left")
                ->where("o.id = " . $org_id);
        $result = $this->db->get();
        return $result->result_array();
    }

//Using in formpro edited version
    public function get_org_dept($org_id) {

        //echo $org_id;exit;
        $this->db->select('d.dept_name,d.dept_id')
                ->from('department d')
                //->join("org_department dm", "d.dept_id=dm.dept_id", "left")
                //->join("org_domain od", "dm.domain_map_id= od.id", "left")
                ->where("d.org_id = " . $org_id);

        $result = $this->db->get();
        //print_r($result->result_array());exit;
        return $result->result_array();
    }

//Using in formpro edited version
    public function get_org_users($org_id) {


        $this->db->select('u.id,u.firstname')
                ->from('users u')
                //->join("org_users ou", "u.id=ou.user_id", "left")
                ->where("u.org_id= " . $org_id);

        $result = $this->db->get();
        //print_r($result->result_array());exit;
        return $result->result_array();
    }

    // Set Notification

    public function check_notification($type,$form_id,$assign_users){
        $assign = implode(',',$assign_users);
        $this->db->select('*')->from('notification')
                ->where('type_id = '.$type.' and form_id = '.$form_id.' and notify_to IN ('.$assign.')');
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function general_notifications_insert($notification){
        $insert = array();

        if(is_array($notification['users']) && count($notification['users']) > 0){
            $form_id = 0;
            $submission_id = 0;
            $alert_id = 0;
            if(isset($notification['details']['form_id'])){
                $form_id = $notification['details']['form_id'];
            }
            if(isset($notification['details']['submission_id'])){
                $submission_id = $notification['details']['submission_id'];
            }
            if(isset($notification['details']['alert_id'])){
                $alert_id = $notification['details']['alert_id'];
            }
            foreach($notification['users'] as $key=>$value){
                if($value != 0){
                    $array = array(
                            'notify_to' => $value,
                            'type' => $notification['type'],
                            'type_id' => $notification['type_id'],
                            'org_id' => $notification['details']['org_id'],
                            'message' => json_encode($notification['details']),
                            'status' => '1',
                            'submission_id' => $submission_id,
                            'form_id' => $form_id,
                            'alert_id' => $alert_id,
                            'created_at' => $notification['created_at'],
                            'updated_at' => $notification['updated_at']
                        );   
                    $insert[] = $array;
                }
            }
            $this->db->insert_batch('notification', $insert);
            return true;
        }
    }

    /* General Function  */
    /* returns true or false based on the default set or not in any table

      params : table name,table id

     */

    public function common_curl($url, $fields) {
        $refined_data['data'] = json_encode($fields);
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        //echo $url; 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $refined_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt( $ch, CURLOPT_HTTPHEADER, false); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        //echo $response; exit;
        curl_close($ch);
        return $response;
    }

    public function common_list_curl($url) {
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        //execute post
        $result = curl_exec($ch);
        //echo $result; exit;
        //close connection
        curl_close($ch);
        return $result;
    }

    public function domain_country_mapping_list() {
        $this->db->select('');
        $this->db->from('domain_country dc');
        $this->db->join('domain d', 'd.domain_id = dc.domain_id');
        $this->db->where('d.status', '1');
        $this->db->group_by("dc.domain_id");
        $result = $this->db->get();
        return $result->result_array();
    }

    /* Returns list of department_map_id from the department mapping table for the domain */

    public function domain_department_list($domain_id) {
        // foreach($domain as $key=>$domain_id){
        $org_id = $this->session->userdata('org_id');

        $sql = "SELECT *  FROM `department_domain` as dd LEFT JOIN department as d ON d.dept_id=dd.dept_id WHERE dd.`domain_id` IN ($domain_id) and d.org_id = $org_id  group by dd.dept_id";
        $query = $this->db->query($sql);
//echo $this->db->last_query();
        return $query->result_array();
    }
    public function get_superadmin_id($org_id){
        $this->db->select('u.id')->from('users u')->where('u.org_id = '.$org_id.' and u.user_role_id = 1');
        $res = $this->db->get()->row('id');
        return $res;
    }
    public function location_users_list($loc_id){
        $sql = "SELECT u.id,CONCAT_WS(' ',u.firstname,u.lastname) as name FROM `user_location` as ul LEFT JOIN users as u ON u.id=ul.user_id WHERE ul.`location_id` IN ($loc_id) and u.activation = 1 group by u.id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function department_users_list($dept_id){
        $sql = "SELECT u.id,CONCAT_WS(' ',u.firstname,u.lastname) as name FROM `org_user_department` as ud LEFT JOIN users as u ON u.id=ud.user_id WHERE ud.`dept_id` IN ($dept_id) and u.activation = 1";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();   
        return $query->result_array();

    }

    public function department_list($org_id,$dept_not_in){

        if($org_id != 1)
        {
            if($dept_not_in != '')   
            $whereCnd  = "(d.`org_id`= '$org_id' or d.org_id='1') and (d.dept_id NOT IN ($dept_not_in))";
            else
                $whereCnd  = "(d.`org_id`= '$org_id' or d.org_id='1')";
        }
        else
        {
            if($dept_not_in != '')
            $whereCnd  = "d.`org_id`= '$org_id' and d.dept_id NOT IN ($dept_not_in)";
            else
                $whereCnd  = "d.`org_id`= '$org_id' and d.dept_id";
        }
        
        $this->db->select('d.*,group_concat(DISTINCT dom.domain_name) as domains,group_concat(DISTINCT l.country_name) as countrys', FALSE);
        $this->db->from('`department` as d');
        $this->db->join('department_domain dd', 'dd.dept_id=d.dept_id','left');
        $this->db->join('domain_country dc', 'dc.domain_id=dd.domain_id','left');
        $this->db->join('domain dom', 'dom.domain_id=dc.domain_id','left');
        $this->db->join('location l', 'l.loc_id=dc.country_id','left');
        $this->db->where($whereCnd);
        $this->db->group_by('d.`dept_id`');
        $query = $this->db->get();
      // echo $this->db->last_query(); die;
        if ($query->num_rows() > 0) {
            $result_dept = $query->result_array();
            return $result_dept;
        } else {
            return false;
        }
    }


    public function getDomainlist($user_id,$cate_arr_db="''") {

        if ($user_id == 1) {
            $whereCond = "d.created_by = '$user_id' and d.status = '1'";
        } else {
            $whereCond = "(d.created_by = '$user_id') or (d.created_by = '1' and d.default='1') or dc.domain_id IN ($cate_arr_db)";
        }


        $this->db->select('*')
                ->from('domain_country dc')
                ->join('domain d','d.domain_id = dc.domain_id')
                ->where($whereCond)
                ->group_by('dc.domain_id');



        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function getDomainlist_org($org_id)
    {
        $sql="SELECT d.* FROM `org_location` as ol 

            left join org_domain as od ON od.org_location_id=ol.id 

            left join domain as d ON d.domain_id=od.domain_id

            where ol.`org_id`='$org_id' group by d.domain_id";
        
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function get_default_domain() {
        $this->db->select()
                ->from('domain')
                ->where('created_by', 1)
                ->where('default', '1');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getorg_info($org_id) {
        $this->db->select()
                ->from('organization')
                ->where('id', $org_id);
        $query = $this->db->get();
        return $query->row();
    }


    public function getorg_domain_info($org_id) {
        $this->db->select('*,group_concat(od.domain_id) as domain_ids')
                ->from('organization o')
                ->join('org_location ol', 'ol.org_id=o.id')
                ->join('org_domain od', 'od.org_location_id=ol.id')
                ->where('o.id', $org_id)
                ->group_by('o.id');
        $query = $this->db->get();//echo $this->db->last_query(); die;
        return $query->row();
        
    }

    public function get_dept_info($dept_id) {
        $this->db->select()
                ->from('department')
                ->where('dept_id', $dept_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_cat_info($category_id) {
        $this->db->select()
                ->from('category')
                ->where('cat_id', $category_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getcountrylist() {

        $this->db->select('co.loc_id, co.country_name, co.created_at, co.updated_at, co.default,co.status');
        $this->db->from('location co');
        $this->db->where('co.status', '1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }
    }

    public function getdefaultcountry($data) {

        $this->db->select('co.loc_id');
        $this->db->from('location co');
        $this->db->where('co.status', '1');
        $this->db->where('co.default', '1');
        $query = $this->db->get();
        //print_r($this->db);
        if ($query->num_rows() > 0) {

            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }
    }

    public function org_domain_lists($country_id) {

       

        $result_loc = $this->get_domain_country($country_id);

        $data['domain'] = $result_loc;
        //print_r($data['loc']);exit;
        $hotl = '';
        if ($country_id > 0) {
            if (!empty($data['domain'])) {
                $hotl .= "<select id='' class='domain_change chosen_select' required data-placeholder='Select Domain...'' name='domain'  >";
                foreach ($data['domain'] as $key => $domain) {

                    $hotl .="<option   value='" . $domain['domain_id'] . "'> " . $domain['domain_name'] . " </option>";
                }

                $hotl .='</select>';
            } else {
                //$domains = $this->comman_model->common_curl(SERVICE_URL.'domain_list',$datas = array());
                //$data['domain']=json_decode($domains, TRUE);
                //foreach($data['domain']['domain'] as $domain){			
                //	$hotl .="<option   value='".$domain['domain_id']."'> ".$domain['domain_name']." </option>";
                $hotl.= "<a href='" . base_url() . "domain/add/" . $country_id . "'>Country has no Domain Please add a domain for the country</a>";
            }
        }

        return $hotl; //.'#'.$user;
    }

    public function get_domain_country($country_id) {

        $sql="SELECT `d`.`domain_id`, `d`.`domain_name`
                    FROM `domain_country` `dc`
                    LEFT JOIN `domain` `d` ON `d`.`domain_id` = `dc`.`domain_id`
                    WHERE `dc`.`country_id` IN ($country_id)";

         $query = $this->db->query($sql);
//echo $this->db->last_query();
        return $query->result_array();
    }


}

?>
