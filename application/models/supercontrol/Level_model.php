<?php 
class Level_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_mode($data) {
		$this->load->database();
	    $this->db->insert('sm_levels', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_mode()
	{
		$sql ="select * from sm_levels ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function show_mode_list()
	{
		$sql ="select * from sm_levels where level_status='1'";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_mode_id($id){
		$this->db->select('*');
		$this->db->from('sm_levels');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function mode_edit($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_levels',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_levels set level_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_modelist()
	{
		$sql ="select * from sm_levels";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_mode($id,$mode_image){
		$this->db->where('id', $id);
		@unlink("mode/".$mode_image);
		$this->db->delete('sm_mode');	
		}
function delete_mul($ids)//Delete Multiple News
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('id', $did);
			//unlink("mode/".$mode_image);
			$this->db->delete('sm_mode');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>