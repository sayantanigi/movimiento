<?php
class Education_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_education($data) {
		$this->load->database();
	    $this->db->insert('sm_na_eduinstitute', $data);
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function view_education(){
		$sql ="select * from sm_na_eduinstitute";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function edit_education($id,$data){
		
		$this->db->where('id', $id);
		$this->db->update('sm_na_eduinstitute',$data);
			
	}
	
	function show_education_id($id){
		$this->db->select('*');
		$this->db->from('sm_na_eduinstitute');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function delete_education($id){
	  $this->db->where('id', $id);
      $this->db->delete('sm_na_eduinstitute'); 
	}
}
?>