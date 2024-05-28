<?php
class newsmedia_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_newsmedia($data) {
		$this->load->database();
	    $this->db->insert('sm_na_newsmedia', $data);
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function view_newsmedia(){
		$sql ="select * from sm_na_newsmedia";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function edit_newsmedia($id,$datalist){
		
		$this->db->where('id', $id);
		$this->db->update('sm_na_newsmedia',$datalist);
			
	}
	
	function show_newsmedia_id($id){
		$this->db->select('*');
		$this->db->from('sm_na_newsmedia');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function delete_newsmedia($id){
	  $this->db->where('id', $id);
      $this->db->delete('sm_na_newsmedia'); 
	}
}
?>