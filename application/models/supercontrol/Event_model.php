<?php
class Event_model extends CI_Model{
	public function insert_event($data) {
		$this->load->database();
		$this->db->insert('event', $data);
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	function show_event() {
		$sql = "select * from event order by id desc";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : NULL;
	}
	function delete_event($id) {
		$this->db->where('id', $id);
		$this->db->delete('event');
	}
	function show_event_id($id) {
		$this->db->select('*');
		$this->db->from('event');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function event_edit($id, $datalist) {
		$this->db->where('id', $id);
		$this->db->update('event', $datalist);
	}
	//=============Member Edit===================
}
?>