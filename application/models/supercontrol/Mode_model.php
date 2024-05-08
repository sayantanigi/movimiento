<?php
class Mode_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function insert_mode($data)
	{
		$this->load->database();
		$this->db->insert('sm_mode', $data);
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	function show_mode()
	{
		$sql = "select * from sm_mode ";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : NULL;
	}
	function show_mode_list()
	{
		$sql = "select * from sm_mode where mode_status='1'";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : NULL;
	}
	function show_mode_id($id)
	{
		$this->db->select('*');
		$this->db->from('sm_mode');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function mode_edit($id, $data)
	{

		$this->db->where('id', $id);
		$this->db->update('sm_mode', $data);
	}
	function updt($stat, $id)
	{

		$sql = "update sm_mode set mode_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	function show_modelist()
	{
		$sql = "select * from sm_mode";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : NULL;
	}
	function delete_mode($id, $mode_image)
	{
		$this->db->where('id', $id);
		@unlink("mode/" . $mode_image);
		$this->db->delete('sm_mode');
	}
	function delete_mul($ids) //Delete Multiple News
	{
		$ids = $ids;
		$count = 0;
		foreach ($ids as $id) {
			$did = intval($id) . '<br>';
			$this->db->where('id', $did);
			//unlink("mode/" . $mode_image);
			$this->db->delete('sm_mode');
			$count = $count + 1;
		}

		echo '<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
				' . $count . ' Item deleted successfully
				</div>';
		$count = 0;
	}
}
?>