<?php
class Individual_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_individual($data) {
		$this->load->database();
	    $this->db->insert('sm_na_individual', $data);
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function view_individual(){
		$sql ="select * from sm_na_individual";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function edit_individual($id,$data){
		
		$this->db->where('id', $id);
		$this->db->update('sm_na_individual',$data);
			
	}
	
	function show_individual_id($id){
		$this->db->select('*');
		$this->db->from('sm_na_individual');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function delete_individual($id){
	  $this->db->where('id', $id);
      $this->db->delete('sm_na_individual'); 
	}
}
?>