<?php 
 class Team_model extends CI_Model{


	//*********===============team Section===============********//
	public function insert_team($data) {
		$this->load->database();
	    $this->db->insert('sm_team', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	//================Insert Type================
	//================Show Type==================
	function show_team(){
		$sql ="select * from sm_team order by mem_id desc";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	//================Show Type==================
	//================Delete Member==============
	function delete_team($id){
	  $this->db->where('mem_id',$id);
	  $this->db->delete('sm_team'); 
	}
	//================Delete member==============
	//=============Show Member By Id=============
	function show_team_id($id){
		$this->db->select('*');
		$this->db->from('sm_team');
		$this->db->where('mem_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	//*********===============team Section===============********//
	//=============Member Edit===================
	function team_edit($id, $datalist){
		$this->db->where('mem_id', $id);
		$this->db->update('sm_team',$datalist);
	}
	//=============Member Edit===================
}
?>