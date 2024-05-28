<?php 
class General_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }   
	//=============== Select , Select by id , insert , update , delete ====================================================
	public function record_count($tablename,$primary_key,$wheredata) {
		if($wheredata!=''){
		$this->db->where(array($primary_key => $wheredata));
		}
		$result=$this->db->count_all_results($tablename);
		return $result;
    }
	
	public function record_count_search($tablename,$primary_key,$likefield,$wheredata,$allias) {
		if($primary_key==''){
			$this->db->like($likefield, $allias, 'after');
			$result=$this->db->count_all_results($tablename);
			return $result;
		}else{
			$this->db->where(array($primary_key => $wheredata));
			$this->db->like($likefield, $allias, 'after');
			$result=$this->db->count_all_results($tablename);
			return $result;
		}
    }
	
	
	public function record_count_searchnew($tablename,$primary_key1,$primary_key2,$likefield,$wheredata1,$wheredata2,$allias) {
		$this->db->where(array($primary_key1 => $wheredata1));
		$this->db->where(array($primary_key2 => $wheredata2));
		if($likefield!=''){
			$this->db->like($likefield, $allias, 'after');
		}
		$result=$this->db->count_all_results($tablename);
		return $result;
	}
	
	public function getAllData($table_name,$primary_key,$wheredata,$limit,$start){
		if(@$limit!='' || @$start!=''){
			$this->db->limit($limit, $start);
		}
		$this->db->select ('*'); 
		$this->db->from($table_name);
		if($primary_key=='' && $wheredata==''){
			$where='1=1';
		}else{
			$this->db->where($primary_key,$wheredata);
		}
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	
	
	public function getAllDataByGroup($table_name,$primary_key,$wheredata,$group_data,$limit,$start){
		if(@$limit!='' || @$start!=''){
			$this->db->limit($limit, $start);
		}
		$this->db->select ('*'); 
		$this->db->from($table_name);
		if($primary_key=='' && $wheredata==''){
			$where='1=1';
		}else{
			$this->db->where($primary_key,$wheredata);
		}
		$this->db->group_by($group_data);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getAllDatadist($table_name,$primary_key,$wheredata,$limit,$start){
		if(@$limit!='' || @$start!=''){
			$this->db->limit($limit, $start);
		}
		$this->db->distinct();
		$this->db->select ($primary_key); 
		$this->db->from($table_name);
		
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	
	}
	
	
	function getSearchData($table_name,$primary_key,$likefield,$wheredata,$limit,$start,$allias){
		//================*********************=====================
		if(@$limit!='' || @$start!=''){
			$this->db->limit($limit, $start);
		}
		$this->db->select ('*'); 
		$this->db->from($table_name);
		if($primary_key=='' && $wheredata==''){
			$where='1=1';
		}else if($primary_key=='' || $wheredata==''){
			$where='1=1';
		}else{
			$this->db->where($primary_key,$wheredata);
		}
		$this->db->like($likefield, $allias, 'after');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
		//================*********************=====================
	}	
	
	function getSearchDataMultipleWhere($table_name,$primary_key1,$wheredata1,$primary_key2,$wheredata2,$primary_key3,$wheredata3,$limit,$start,$allias){
		//================*********************=====================
		$this->db->select ('*'); 
		$this->db->from($table_name);
		$this->db->where($primary_key1,$wheredata1);
		$this->db->where($primary_key2,$wheredata2);
		$this->db->where($primary_key3,$wheredata3);
		$this->db->group_by('from_id');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
		//================*********************=====================
	}	
	
	 public function get_sub_banner($id){
		$this->db->select('*');
		$this->db->from('sm_category');
		$this->db->where('parent_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function show_location($pid){
		$this->db->select('*');
		$this->db->from('sm_course_location');
		$this->db->where('location_id', $pid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	//================ Join of 2 tables by limit======================================================================================	
	
	function insertData($table_name,$datalist){
		//====================================
		$this->db->insert($table_name, $datalist); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
    }
	
	public function insert($data = array()){
		$insert = $this->db->insert_batch('filesimg',$data);
		return $insert?true:false;
	}
	
	 //send verification email to user's email id
    function sendEmail($to_email){
        $from_email = 'team@mydomain.com'; //change this to yours
        $subject = 'Verify Your Email Address';
        $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://www.mydomain.com/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';
        
        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.mydomain.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = '********'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        
        //send mail
        $this->email->from($from_email, 'Mydomain');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }
	
	function get_user($email,$password,$user_type){
		$this -> db -> select('*');
		$this -> db -> from('sm_member');
		$this -> db -> where('email', $email);
		$this -> db -> where('password',$password);
		$this -> db -> where('user_type',$user_type);
		$this -> db -> where('status','1');
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		return $query->result();
	}
	
	
	function get_user_by_id($id){
		$this->db->select('*');
		$this->db->from('sm_member');
		$this->db->where('email',$id);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		} 
	}
	
	
	function edit_profile($uid,$datalist){
		$this->db->where('email', $uid);
		$this->db->update('sm_member',$datalist);
	}
	
	function get_user_details($email){
		$this->db->select('*');
		$this->db->from('sm_profile');
		$this->db->where('email',$email);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		} 
	}
    
    //activate user account
    function verifyUser($key){
        $data = array('status' => '1');
        $this->db->where('member_id', $key);
        return $this->db->update('sm_member', $data);
    }
	
	function update_data($table_name,$primary_key,$wheredata,$data){
		$this->db->where($primary_key, $wheredata);
        return $this->db->update($table_name, $data);
	}
	
	function message_list($table_name,$to_id,$from_id,$post_id){
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where('((`from_id`='.$to_id.' and `to_id`='.$from_id.') || (`from_id`='.$from_id.' and `to_id`='.$to_id.')) and `post_id`='.$post_id.'');
		//$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		//SELECT * FROM `message` WHERE (`from_id`=14 and `to_id`=8) || (`from_id`=8 and `to_id`=14)
	}
	
	
	function GetCirtificate($table_name,$primary_key,$wheredata,$primary_key2,$wheredata2,$limit,$start){
		if(@$limit!='' || @$start!=''){
			$this->db->limit($limit, $start);
		}
		$this->db->select ('*'); 
		$this->db->from($table_name);
		
		$this->db->where($primary_key,$wheredata);
		$this->db->where($primary_key2,$wheredata2);
		
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function get_member_id($uid){
		$this->db->select('*');
		$this->db->from('sm_member');
		$this->db->where('email', $uid);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
    }
	
	public function chat_user($uid){
		$this->db->select('*');
		$this->db->from('sm_chat');
		$this->db->where('user_id', $uid);
		$this->db->where('admin_id', '0');
		$this->db->order_by('send_date','desc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
    }
	
	public function chat_admin($uid){
		$this->db->select('*');
		$this->db->from('sm_chat');
		$this->db->where('admin_id', $uid);
		$this->db->where('user_id', '0');
		$this->db->order_by('send_date','desc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
    }
	
	public function chat_all($uid){
		$this->db->select('*');
		$this->db->from('sm_chat');
		$this->db->where('user_id', $uid);
		$this->db->OR_where('admin_id', $uid);
		$this->db->order_by('chat_id','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
    }
	
	public function do_action($table_name,$id,$fieldname,$action,$data,$limit){
		
		if($action=='get'){
			if(($id !='') && ($fieldname!='')&& ($data=='')&& ($limit=='')){
				$this->db->select ('*'); 
				$this->db->from($table_name);
				$this->db->where($fieldname,$id);
				$this->db->where('gallery_status',1);
				$this->db->order_by('id', 'desc');
				$this->db->limit($limit);
			}else{
				$this->db->select ('*'); 
				$this->db->from($table_name);
				$this->db->order_by('id', 'desc');
				$this->db->limit($limit);
			}
			$query = $this->db->get();
			$result = $query->result();
			return $result;
		}
		if($action=='insert'){
		$return = $this->db->insert($table_name, $data);
		if ((bool) $return === TRUE) {
			return $this->db->insert_id();
		}else {
			return $return;
		}       
	}
	if($action=='update'){
		$this->db->where($fieldname, $id);
		$return=$this->db->update($table_name, $data);
		return $return;
	}
	if($action=='delete'){
		$this->db->where($fieldname, $id);
		$this->db->delete($table_name);
	}
	
	}
	public function show_data_id($table_name,$id,$fieldname,$action,$data){
		if($action=='get'){
			if(($id !='') && ($fieldname!='')&& ($data=='')){
				$this->db->select ('*'); 
				$this->db->from($table_name);
				$this->db->where($fieldname,$id);
			}else{
				$this->db->select ('*'); 
				$this->db->from($table_name);
			}
			$query = $this->db->get();
			$result = $query->result();
			return $result;
		}
	if($action=='insert'){
		$return = $this->db->insert($table_name, $data);
		if ((bool) $return === TRUE) {
			return $this->db->insert_id();
		}else {
			return $return;
		}       
	}
	if($action=='update'){
		$this->db->where($fieldname, $id);
		$return=$this->db->update($table_name, $data);
		return $return;
	}
	if($action=='delete'){
		$this->db->where($fieldname, $id);
		$this->db->delete($table_name);
	}
}

public function get_search_member($id,$name){
	$query = $this->db->query("SELECT * FROM (`member`) WHERE `business_id` = ".$id." AND (first_name LIKE '%".$name."%' OR `last_name` LIKE '%".$name."%')");
		$result = $query->result();
		return $result;
	}
}

?>

