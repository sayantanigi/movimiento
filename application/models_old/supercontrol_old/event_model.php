<?php 
 class Event_model extends CI_Model{


	//*********===============Event Section===============********//
	public function insert_event($data) {
		$this->load->database();
	    $this->db->insert('sm_event', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	//================Insert Type================
	//================Show Type==================
	function show_event(){
		$sql ="select * from sm_event order by event_id desc";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	//================Show Type==================
	//================Delete Member==============
	function delete_event($id){
	  $this->db->where('event_id',$id);
	  $this->db->delete('sm_event'); 
	}
	//================Delete member==============
	//=============Show Member By Id=============
	function show_event_id($id){
		$this->db->select('*');
		$this->db->from('sm_event');
		$this->db->where('event_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	//*********===============Event Section===============********//
	//=============Member Edit===================
	function event_edit($id, $datalist){
		$this->db->where('event_id', $id);
		$this->db->update('sm_event',$datalist);
	}
	//=============Member Edit===================
}
?>