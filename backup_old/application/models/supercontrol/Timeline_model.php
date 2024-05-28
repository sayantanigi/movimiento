<?php 
class Timeline_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_timeline($data) {
		$this->load->database();
	    $this->db->insert('sm_timeline', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function show_timeline()
	{
		$sql ="select * from sm_timeline ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	
	function show_timeline_id($id){
		$this->db->select('*');
		$this->db->from('sm_timeline');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function timeline_edit($id, $data){
	
		$this->db->where('id', $id);
		
		$this->db->update('sm_timeline',$data);
	}
	
	function updt($stat,$id){
	
		$sql ="update sm_timeline set status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	function show_timelinelist()
	{
		$sql ="select * from sm_timeline";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	
	function delete_timeline($id,$timeline_img){
		$this->db->where('id', $id);
		$this->db->delete('sm_timeline');	
		}
}
?>
