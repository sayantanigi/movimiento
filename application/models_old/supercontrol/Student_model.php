<?php
class Student_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_student($data) {
		$this->load->database();
	    $this->db->insert('sm_na_student', $data);
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function view_student(){
		$sql ="select * from sm_na_student";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function edit_student($id,$data){
		$this->db->where('id', $id);
		$this->db->update('sm_na_student',$data);
	}
	
	function show_student_id($id){
		$this->db->select('*');
		$this->db->from('sm_na_student');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function delete_student($id){
	  $this->db->where('id', $id);
      $this->db->delete('sm_na_individual'); 
	}
}
?>