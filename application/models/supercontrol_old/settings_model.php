<?php 
class Settings_model extends CI_Model{
	function __construct() {
        parent::__construct();
		$this->load->database();
		
   }
function show_settings()
	{
		$sql ="select * from  sm_settings ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_settings_id($id){
		
		$this->db->select('*');
		$this->db->from('sm_settings');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function settings_edit($id, $data){
         $this->db->where('id', $id);
		 $this->db->update('sm_settings',$data);
	}
function show_settingslist()
	{
		$sql ="select * from sm_settings where id=1";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
}
?>