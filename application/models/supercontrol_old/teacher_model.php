<?php
class teacher_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_teacher($data) {
		$this->load->database();
	    $this->db->insert('sm_na_teacher', $data);
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function view_teacher(){
		$sql ="select * from sm_na_teacher";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function edit_teacher($id,$datalist){
		
		$this->db->where('id', $id);
		$this->db->update('sm_na_teacher',$datalist);
			
	}
	
	function show_teacher_id($id){
		$this->db->select('*');
		$this->db->from('sm_na_teacher');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function delete_teacher($id){
	  $this->db->where('id', $id);
      $this->db->delete('sm_na_teacher'); 
	}
}
?>