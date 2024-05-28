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
		//echo $this->db->last_query(); exit;
		return $result;
	
	}
	
	public function getAllDataOrder($table_name,$primary_key,$wheredata,$orderdata,$limit,$start){
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
		//$this->db->order_by($orderdata,"");
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
		if($primary_key1!='' && $wheredata1 !=''){
			$this->db->where($primary_key1,$wheredata1);
		}
		if($primary_key2!='' && $wheredata2 !=''){
			$this->db->where($primary_key2,$wheredata2);
		}
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
			if(($id =='' || $fieldname=='') && $data==''){
				$this->db->select ('*'); 
				$this->db->from($table_name);
			}else{
				$this->db->select ('*'); 
				$this->db->from($table_name);
				$this->db->where($fieldname,$id);
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
	
	//=============== Select , Select by id By Limit =======================================================================
	 
	//================ Join of 2 tables ======================================================================================
	
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
	
	function course_view($id1,$id2){
		$this->db->select('*');
		$this->db->from('sm_category');
		$this->db->where('id', $id2);
		$query = $this->db->get();
		$result = $query->result();
		// /echo $this->db->last_query(); exit;
		return $result;
	}
	
	function delete_mul($ids)//Delete Multiple Faq
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('course_id', $did);
			$this->db->delete('course');  
			$count = $count+1;
			}
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
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
    public function add_details($tbl,$data)
    {
        $query=$this->db->insert($tbl,$data);
        return $query;
        
    }
    public function delete_single($tbl,$id)
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
    public function delete_single_member($tbl,$id)
    {
         $this->db->where('member_id', $id);
         $delete = $this->db->delete($tbl); 
         return $delete;
        
    }
     public function fetch_member($tbl, $id)
    {
        $this->db->select('*');
        $this->db->where('member_id', $id);
        $query=$this->db->get($tbl);
        return $query->row();
        
    }
    public function fetch_single($tbl, $id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query=$this->db->get($tbl);
        return $query->row();
        
    }
     public function fetch_single_course($tbl, $id)
    {
        $this->db->select('*');
        $this->db->where('course_id', $id);
        $query=$this->db->get($tbl);
        return $query->row();
        
    }  
     public function fetch_all($tbl)
    {
        $this->db->select('*');
        $query=$this->db->get($tbl);
        return $query->result();
       // return $num = $query->num_rows();
    }
    /*public function getCategories() {
        $query = $this->db->get_where('sm_countrys');
        return $query->result();
    }
    public function getCites() {
        $query = $this->db->get_where('sm_city');
        return $query->result();
    }*/
    
    public function getlevel() {
        $query = $this->db->get_where('sm_levels');
        return $query->result();
    }
    
    public function getMode() {
        $query = $this->db->get_where('sm_mode');
        return $query->result();
    }
    
    /*public function getCities() {
        $this->db->select('*');
        $this->db->from('sm_city');
        $this->db->where('country_id', @$this->_CountryID);
        $query = $this->db->get();
        //echo $query; die;
        return $query->result_array();   
    }
    public function getlocations() {
        $query = $this->db->get_where('sm_location');
        return $query->result();
    }*/
}

?>

