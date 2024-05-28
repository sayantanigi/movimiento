<?php
class Conference_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	public function insert_conference($data) {
		$this->load->database();
		$this->db->insert('conference', $data);
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	function show_conference() {
		$sql = "select * from conference WHERE uploaded_by ='".$this->session->userdata('user_id')."'";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : NULL;
	}
	function show_conference_limit($limit, $start, $st = NULL) {
		$this->db->select('*');
		$this->db->from('conference');
		$this->db->where('status', '1');
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function show_conference_id($id) {
		$this->db->select('*');
		$this->db->from('conference');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function conference_edit($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('conference', $data);
	}
	function updt($stat, $id) {
		$sql = "update conference set status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	function show_conferencelist() {
		$sql = "select * from conference";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : NULL;
	}
	function delete_conference($id, $conference_image) {
		$this->db->where('id', $id);
		unlink("uploads/blog/" . $conference_image);
		$this->db->delete('conference');
	}
	function delete_mul($ids, $conference_image) {
		$ids = $ids;
		$count = 0;
		foreach ($ids as $id) {
			$did = intval($id) . '<br>';
			$this->db->where('id', $did);
			unlink("uploads/blog/" . $conference_image);
			$this->db->delete('conference');
			$count = $count + 1;
		}
		echo '<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			' . $count . ' Item deleted successfully
			</div>';
		$count = 0;
	}
}
?>