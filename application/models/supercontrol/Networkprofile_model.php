<?php
class Networkprofile_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_networkprofile($data) {
		$this->load->database();
	    $this->db->insert('sm_na_network_profile', $data);
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function view_networkprofile(){
		$sql ="select * from sm_na_network_profile";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function edit_networkprofile($id,$data){
		
		$this->db->where('id', $id);
		$this->db->update('sm_na_network_profile',$data);
			
	}
	
	function show_networkprofile_id($id){
		$this->db->select('*');
		$this->db->from('sm_na_network_profile');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function delete_networkprofile($id){
	  $this->db->where('id', $id);
      $this->db->delete('sm_na_network_profile'); 
	}
}
?>