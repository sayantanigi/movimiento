<?php 
class Press_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_press($data) {
		$this->load->database();
	    $this->db->insert('sm_press', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_press()
	{
		$sql ="select * from sm_press ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function show_press_list()
	{
		$sql ="select * from sm_press where press_status='1'";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_press_id($id){
		$this->db->select('*');
		$this->db->from('sm_press');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function press_edit($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_press',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_press set press_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_presslist()
	{
		$sql ="select * from sm_press";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_press($id,$press_image){
		$this->db->where('id', $id);
		@unlink("press/".$press_image);
		$this->db->delete('sm_press');	
		}
function delete_mul($ids)//Delete Multiple News
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('id', $did);
			unlink("press/".$press_image);
			$this->db->delete('sm_press');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>