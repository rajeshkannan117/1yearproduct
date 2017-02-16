<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * This is Domain Model of form pro
 *
 * @package	CodeIgniter
 * @category	Domain
 * @author	Rajeshkannan
 * @link	http://innoppl.com/
 *
 */
class Domain_model extends CI_Model
{
	public function __construct()
	{
		date_default_timezone_set ("America/New_York");
		$this->load->database();
		$this->load->helper('date');
	}
	/*public function domain_add($posts){
		$post = $posts['data'];
		$domain = array(
				'domain_name'=>trim($post['domain_name']),
				'domain_desc'=>trim($post['domain_desc']),
				'default'=> $post['default'],
				'status'=>'1',
				'created_at'=>date("Y-m-d H:i:s"),
				'updated_at'=>date("Y-m-d H:i:s"),
				'created_by'=>$post['created_by']
				);
		$this->db->insert('domain',$domain);
		$domain_id = $this->db->insert_id();
		foreach($post['countries'] as $key=>$value){

			$mapping = array('domain_id'=>$domain_id,'country_id'=>$value);

			$this->db->insert('domain_country_mapping',$mapping);	

		}

	}*/
	public function domain_add($posts){
		$post = $posts['data'];
		$domain = array(
				'domain_name'=>trim($post['domain_name']),
				'domain_desc'=>trim($post['domain_desc']),
				'status'=>'1',
				'created_at'=>date("Y-m-d H:i:s"),
				'updated_at'=>date("Y-m-d H:i:s"),
				'created_by'=>$post['created_by'],
				'uuid' => $post['uuid']
				);
		//print_r($post); exit;
		$this->db->insert('domain',$domain);
		$domain_id = $this->db->insert_id();
		foreach($post['countries'] as $key=>$value){
			
			if($post['default']){
				if($post['action'] == 1){
					/* Force Change default */
					if(in_array($value,$post['change_default'])){
						/* Before set default 0 */
						$this->db->set('default','0');
						$this->db->where('country_id',$value);
						$this->db->where('default','1');
						$this->db->update('domain_country_mapping');
				    }
				    /* set default = 1 for all  */
				    $this->set_default($domain_id,$value,$post['default']);  
				}else if($post['action'] == 0){
					/* Exclude some countries from set as default */
					$this->set_default($domain_id,$value,$post['default'],$post['change_default'],$post['action']);
				}else if($post['action'] == -1) {
					$this->set_default($domain_id,$value,$post['default']);
				}
			}else{
				$this->set_default($domain_id,$value,$post['default']);
			}	
		}
		return array('msg'=>'success');
	}

	public function set_default($domain_id,$country_id,$default,$change_default=array(),$action = -1){
		$defaults = array(
				'domain_id'=>$domain_id,
				'country_id'=>$country_id,
				);
		if(count($change_default) > 0){
			if($action){
				$defaults['default'] = $default;
				$this->db->insert('domain_country',$defaults);
		    }
		    else if($action == 0){
		    	if(!in_array($country_id,$change_default)){
					/* insert new record into the table */
					$defaults['default'] = $default;
					$this->db->insert('domain_country',$defaults);
				}
				if(in_array($country_id,$change_default)){
					$defaults['default'] = 0;
					$this->db->insert('domain_country',$defaults);
				}
		   }
		}else{
			$defaults['default'] = $default;
			$this->db->insert('domain_country',$defaults);
		}
	}

	/*public function domain_list(){

		$this->db->select('do.domain_id,do.domain_name,do.domain_desc,do.status,do.default');
		$this->db->from ('domain do');
		//$this->db->join('domain_country_mapping do_ma','do_ma.domain_id = do.domain_id','left');
		//$this->db->join('location co','co.loc_id = do_ma.country_id','left');
		//$this->db->where('do.status', '1');
		$query = $this->db->get();
		//print_r($this->db);
		if ($query->num_rows () > 0) {
			$result_country = $query->result_array();
			return $result_country;
		} else {
			return false;
		}

	}*/
	public function domain_list(){



		$this->db->select('do.uuid,do.domain_id,do.domain_name,do.created_by,do.domain_desc,do.status,do.default,group_concat(DISTINCT(select country_name from location where loc_id = dc.country_id)) as country_name');
        $this->db->from('domain do');
        $this->db->join('domain_country dc','dc.domain_id = do.domain_id');
        $this->db->where('do.status ','1');
        $this->db->group_by('do.domain_id');
        $query = $this->db->get();
        if ($query->num_rows () > 0) {
        	$result = $query->result_array();
        	return $result;
        }else{
        	return false;
        }






		/*$this->db->select('do.domain_id,do.domain_name,do.domain_desc,do.status,do.default');
		$this->db->from ('domain do');
		$this->db->where('do.status', '1');
		$query = $this->db->get();

		if ($query->num_rows () > 0) {
			$result_country['domain'] = $query->result_array();
			foreach($result_country['domain'] as $key=>$value){
				$details=$value['domain_id'];
				$this->db->select('co.loc_id,co.country_name');
				$this->db->from ('location co');
				$this->db->join('domain_country do_ma','do_ma.country_id = co.loc_id');
				$this->db->where('do_ma.domain_id', $details);
				$country_query = $this->db->get();
				$result_country['country'][] = $country_query->result_array();
			}
			
			return $result_country;
		} else {
			return false;
		}*/

	}
	public function check_domain_exists($uuid){
		$this->db->select('domain_id')->from('domain')->where('uuid',$uuid);
		$domain_id = $this->db->get()->row('domain_id');
		if($domain_id){
			return $domain_id;
		}else{
			return false;
		}
	}
	public function check_default_domain($map_id){

		$this->db->select('country_id');
		$this->db->from ('domain_country_mapping');
		$this->db->where('id',$map_id);
		$query = $this->db->get();
		$result_country = $query->row()->country_id;

		$this->db->select('id');
		$this->db->from ('domain_country_mapping ');
		$this->db->where('default = 1 and country_id = '.$result_country);
		$domainquery = $this->db->get();
		$result_domain = $domainquery->row()->id;

			return $result_domain;
		
	}


	public function set_default_domain($change_id,$default_id){

		$this->db->set('default','1');
		$this->db->where('id', $change_id);
		$this->db->update('domain_country_mapping');

		if(($default_id != null) || ($change_id == $default_id)){
			$this->db->set('default','0');
			$this->db->where('id', $default_id);
			$this->db->update('domain_country_mapping');
		}
			return true;
		

	}


	/*public function get_domain_info($domain_id){
		$this->db->select('do.domain_id,do.domain_name,do.status,co.country_name,do.domain_desc,do_ma.country_id,do.status,do.default');
		$this->db->from ('domain do');
		$this->db->join('domain_country_mapping do_ma','do_ma.domain_id = '.$domain_id,'left');
		$this->db->join('location co','co.loc_id = do_ma.country_id','left');
		$this->db->where('do.status', '1');
		$this->db->where('do.domain_id',$domain_id);

		$query = $this->db->get();
		if ($query->num_rows () > 0) {
			$result_domain = $query->result_array();
			return array('domain'=>$result_domain);
		} else {
			return false;
		}
	}  */
	public function get_domain_info($domain_id){

		$this->db->select('d.domain_id,d.domain_name,d.domain_desc,d.created_by,d.status,cm.country_id,cm.default,cm.id');
		$this->db->from('domain d');
		$this->db->join('domain_country cm','cm.domain_id = d.domain_id');
		$this->db->where('d.domain_id',$domain_id);

		$query = $this->db->get();
		if ($query->num_rows () > 0) {
			$result_domain = $query->result_array();
			return array('domain'=>$result_domain);
		} else {
			return false;
		}
	}  

        public function check_domain_delete($domain_id)
    {
        $this->db->select('count(*) as orgCnt');
        $this->db->from('org_domain');
        $this->db->where('domain_id =' . $domain_id);
        $orgquery = $this->db->get(); // your ActiveRecord query that will return a col called 'sum'
        $orgCnt = $orgquery->row('orgCnt');
        
        $this->db->select('count(*) as deptCnt');
        $this->db->from('department_domain');
        $this->db->where('domain_id =' . $domain_id);
        $deptquery = $this->db->get(); // your ActiveRecord query that will return a col called 'sum'
        $deptCnt = $deptquery->row('deptCnt');
        if($orgCnt>0 || $deptCnt>0){
            return 1;
        }else{
            return 0;
        }

    }
	public function domain_name($domain_id){
		$this->db->select('do.domain_name');
		$this->db->from ('domain do');
		$this->db->where('do.domain_id',$domain_id);
		$query = $this->db->get();
		if ($query->num_rows () > 0) {
			$result_domain = $query->row()->domain_name;
			return array('domain_name'=>$result_domain);
		} else {
			return false;
		}	
	}

	public function getdefaultdomaincountry($country_id){

		$this->db->select('d.domain_id')
				 ->from('domain_country_mapping d')
				 ->join('domain do_ma','do_ma.domain_id = d.domain_id AND do_ma.default = 1','LEFT')
				 ->where('d.country_id ='.$country_id);
		//print_r($this->db); exit;
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return array('default_domain'=>$query->row()->domain_id);
		}else{
			return false;
		}

	}

	public function getdefault_domain_country($country_id){

		$this->db->select('domain_id')
				 ->from('domain_country_mapping')
				 ->where('default = 1 AND country_id ='.$country_id);
		//print_r($this->db); exit;
		$query = $this->db->get();
		$domain_id = $query->row()->domain_id;
		
			return $domain_id;
		

	}

	public function domain_update($posts,$countries){
		$post = $posts['data'];
		if(isset($post['default'])){
			$this->db->set('default',$post['default']);
		}
		if(isset($post['status'])){
			$this->db->set('status',$post['status']);
		}
		$this->db->set('domain_name',$post['domain_name']);
		$this->db->set('domain_desc',$post['domain_desc']);
		$this->db->set('updated_at' , date("Y-m-d H:i:s"));
		$this->db->where('domain_id', $post['domain_id']);
		$this->db->update('domain');
		
		$this->db->select('country_id');
		$this->db->from('domain_country');
		$this->db->where('domain_id',$post['domain_id']);
		$query = $this->db->get();
		$result_country = $query->result_array();

		/*$this->db->set('country_id',$countries);
		$this->db->where('id', $post['domain_id']);
		$this->db->update('domain_country');*/
		//
		foreach($countries as $key=>$value){

			if(in_array($value,$result_country)){

				$delete[] = $value;

			}
			else{
				$this->db->insert('domain_country',array('domain_id'=>$post['domain_id'],'country_id'=>$value));
			$delete[] = $value;

			}

		}

		if(count($delete) > 0){
			$delete_id = implode(",", $delete);
			//echo 'DELETE FROM domain_country_mapping where domain_id ='.$post["domain_id"].' AND `country_id` NOT IN ('.$delete_id.')'; exit;
			$this->db->query('DELETE FROM domain_country where domain_id ='.$post["domain_id"].' AND `country_id` NOT IN ('.$delete_id.')');

		} 

		return true;

	}
	public function check_default_country($countries =array()){
		$return =array();
		foreach($countries as $key=>$value){
			$this->db->select('cm.id,cm.domain_id,d.domain_name,l.country_name')
				 ->from('domain_country_mapping cm')
				 ->join('domain d','d.domain_id = cm.domain_id')
				 ->join('location l','l.loc_id = cm.country_id')
				 ->where('cm.default = 1 and cm.country_id = '.$value);
			$res = $this->db->get();
			if($res->num_rows() > 0){
				$return['country_id'][]=$value;
				$return['country_name'][]=$res->row()->country_name;
			}
		}
		return $return;
	}

	public function check_default_domain_country($country_id){
		$this->db->select("cm.domain_id")
				->from("domain_country as cm")
				->where("cm.default = 1 AND cm.country_id = ".$country_id);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			return $res->row()->domain_id;
		}
		else{
			return false;
		}
	}

	public function domain_delete($data){

		$this->db->set('status','-1');
		$this->db->where('domain_id', $data['domain_id']);
		$this->db->update('domain');

	}

    public function check_domain_unique($domain_name) {
        $this->db->select('*')
                ->from('domain')
                ->where("LOWER(`domain_name`) = LOWER('".$domain_name."') and created_by=1");
        //print_r($this->db); exit;
        $query = $this->db->get();        

        $result = $query->row();

        return $result;
    }


}
