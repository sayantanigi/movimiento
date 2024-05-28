<?php 
class Generalmodel extends CI_Model{
	function __construct() {
        parent::__construct();
   }   
	//=============== Select , Select by id , insert , update , delete ====================================================
	public function record_count($tablename,$primary_key,$wheredata) {
		if($wheredata!=''){
		$this->db->where(array($primary_key => $wheredata));
		}
		$result=$this->db->count_all_results($tablename);
		//$result= $this->db->from($tablename);
		return $result;
		/*$this->db->where($primary_key,$wheredata);
		$query = $this->db->get();
		foreach($query->result() as $r){
			return $r->rows;
		}*/
    }
	
	public function record_count_search($tablename,$primary_key,$likefield,$wheredata,$allias) {
		//echo ">>>".$primary_key;
		//echo "  =========.".$wheredata;
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
	
	//function getSearchDataWine1($table_name,$primary_key1,primary_key2,$wheredata1,$wheredata1,$limit,$start){
	function Get_multiple_where_data($table_name,$primary_key1,$primary_key2,$wheredata1,$wheredata2,$limit,$start,$allias){
		//================*********************=====================
		$this->db->select ('*'); 
		$this->db->from($table_name);
		$this->db->where($primary_key1,$wheredata1);
		$this->db->where($primary_key2,$wheredata2);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
		//================*********************=====================
	}	
	
	public function fetch_videos($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("video");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
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
	//=============== Select , Select by id , insert , update , delete ====================================================
	//=============== Select , Select by id By Limit =======================================================================
	
	public function insert_data($table_name,$data){
		$return = $this->db->insert($table_name, $data);
		if ((bool) $return === TRUE) {
			return $this->db->insert_id();
		}else {
			return $return;
		}       
	}
	public function show_data_id_limit($table_name,$id,$fieldname,$order,$limit,$action,$data){
		if($action=='get_limit'){
			if(($id !='') && ($fieldname!='')&& ($data=='')){
				$this->db->select ('*'); 
				$this->db->from($table_name);
				$this->db->where($fieldname,$id);
				$this->db->order_by($fieldname, $order);
				$this->db->limit($limit,0);
			}else{
				$this->db->select ('*'); 
				$this->db->from($table_name);
				$this->db->order_by($fieldname, $order);
				$this->db->limit($limit,0);
			}
			$query = $this->db->get();
			$result = $query->result();
			return $result;
		}
	}
	
	//=============== Select , Select by id By Limit =============================================
	 
	//================ Join of 2 tables ===========================================================
	
	public function dynamic_join($table_name,$id,$fieldname,$table_name2,$fieldname2,$fieldname3,$action,$data){
	 if($action=='join'){
		if(($id !='') && ($fieldname!='')&& ($data=='')) {
				$this->db->select ( '*' ); 
				$this->db->from($table_name);
				$this->db->join($table_name2, $table_name.".".$fieldname .'='. $table_name2.".".$fieldname2);
				$this->db->where($table_name.".".$fieldname3, $id);
			}else{
				$this->db->select ( '*' ); 
				$this->db->from($table_name);
				$this->db->join($table_name2, $table_name .".". $fieldname .'='. $table_name2 .".". $fieldname2);
			}
			$query = $this->db->get();
			$result = $query->result();
			return $result;
			}
		}
	//================ Join of 2 tables ======================================================================================
	//================ Join of 2 tables by limit======================================================================================	
	public function dynamic_join_limt($table_name,$id,$fieldname,$table_name2,$fieldname2,$fieldname3,$order,$limit,$action,$data){
	 if($action=='join'){
		if(($id !='') && ($fieldname!='')&& ($data=='')){
			$this->db->select ('*'); 
			$this->db->from($table_name);
			$this->db->join($table_name2, $table_name.".".$fieldname .'='. $table_name2.".".$fieldname2);
			$this->db->where($table_name.".".$fieldname3, $id);
			$this->db->order_by($table_name.".".$fieldname3, $order);
			$this->db->limit($limit,0);
			}else{
				$this->db->select ( '*' ); 
				$this->db->from($table_name);
				$this->db->join($table_name2, $table_name .".". $fieldname .'='. $table_name2 .".". $fieldname2);
				$this->db->order_by($table_name.".".$fieldname3, $order);
				$this->db->limit($limit,0);
			}
				$query = $this->db->get();
				$result = $query->result();
				return $result;
			}
		}	
	//================ Join of 2 tables by limit======================================================================================	
	
	 public function checkOldPass($current_password,$id){
		$this->db->select('*');
		$this->db->where('email', $id);
		$this->db->where('password', $current_password);
		$query = $this->db->get('member');
		$result = $query->result();
		return $result;
	}
	public function saveNewPass($new_password,$id){
		$data = array(
			   'password' => $new_password
			);
		$this->db->where('email', $id);
		$this->db->update('member', $data);
		return true;
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
	function get_user_by_id($id){
		$this->db->select('*');
		$this->db->from('sm_member');
		$this->db->where('member_id',$id);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		} 
	}
    public function delete_single($tbl,$id)
    {
         $this->db->where('member_id', $id);
         $delete = $this->db->delete($tbl); 
         return $delete;
        
    }
    
     public function eidt_details1($tbl,$data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($tbl,$data);
        return true;
        
    }
     
    public function delete_ins($tbl,$id)
    {
         $this->db->where('id', $id);
         $delete = $this->db->delete($tbl); 
         return $delete;
        
    }
    
    public function delete_single_book($tbl,$id)
    {
         $this->db->where('book_id', $id);
         $delete = $this->db->delete($tbl); 
         return $delete;
        
    }
    function delete_mul($ids)//Delete Multiple News
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('book_id', $did);
			$this->db->delete('sm_course_booking');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' deleted successfully
			</div>';
			$count = 0;		
		}
		 function delete_mul_an($ids)//Delete Multiple News
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('id', $did);
			$this->db->delete('sm_announsement');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' deleted successfully
			</div>';
			$count = 0;		
		}
	function show_blog_id($id){
		$this->db->select('*');
		$this->db->from('sm_course_booking');
		$this->db->where('book_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function insert_offer($data) {
		$this->load->database();
	    $this->db->insert('sm_discount', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	public function show_offer()
	{
		$sql ="select * from sm_discount";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	function delete_discount($id){
		$this->db->where('id', $id);
		//@unlink("blog/".$blog_image);
		$this->db->delete('sm_discount');	
		}
	function show_dicount_id($id){
		$this->db->select('*');
		$this->db->from('sm_discount');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function delete_mul_discount($ids)//Delete Multiple News
		{
			$ids=$ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('id', $did);
			//unlink("blog/".$blog_image);
			$this->db->delete('sm_discount');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Offers deleted successfully
			</div>';
			$count = 0;		
		}
	function offer_edit($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_discount',$data);
	}
	function updt_discount($stat,$id){
	 
		$sql ="update sm_discount set status='$stat' where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	 public function fetch_all($tbl)
    {
        $this->db->select('*');
        $query=$this->db->get($tbl);
        return $query->result();
       // return $num = $query->num_rows();
    }
    public function fetch_single($tbl, $id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query=$this->db->get($tbl);
        return $query->row();
        
    }
     public function fetch_member($tbl, $id)
    {
        $this->db->select('*');
        $this->db->where('member_id', $id);
        $query=$this->db->get($tbl);
        return $query->row();
        
    }
     public function fetch_all_join($query)
    {
        $query = $this->db->query($query);
		return $query->result();        
    }
     public function fetch_single_join($query)
    {
        $query = $this->db->query($query);
		return $query->row();        
    }
	
}

?>

