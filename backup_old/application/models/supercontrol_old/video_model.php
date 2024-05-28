<?php 
class Video_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_video($data) {
		$this->load->database();
	    $this->db->insert('sm_video', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_video(){
	$this->db->select('*');
	$this->db->from('sm_video');
	$query = $this->db->get();
	$result = $query->result();
	return $result;
		
	}
function show_video_id($id){
		$this->db->select('*');
		$this->db->from('sm_video');
		$this->db->where('video_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function update_video($id, $data){
		$this->db->where('video_id', $id);
		$this->db->update('sm_video',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_video set status=$stat where restaurant_id=$id ";
		$query = $this->db->query($sql);
	}
function show_videolist()
	{
		$sql ="select * from sm_video";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_video($id){
		$this->db->where('video_id', $id);
		$this->db->delete('sm_video');	
}
function delete_mul($ids){
	
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('restaurant_id', $did);
			unlink("video/".$video_image);
			$this->db->delete('sm_video');  
			$count = $count+1;
			}
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Restaurant deleted successfully
			</div>';
			$count = 0;		
		
}
		
//=====================For Restaurant Menu============================================


public function insert_category($data) {
		$this->load->database();
	    $this->db->insert('sm_video_category', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	function show_category(){
		$this->db->select('*');
		$this->db->from('sm_video_category');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function show_category_id($id){
		$this->db->select('*');
		$this->db->from('sm_video_category');
		$this->db->where('category_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	function update_category($id, $data){
		$this->db->where('category_id', $id);
		$this->db->update('sm_video_category',$data);
	}
	function delete_category($id){
		$this->db->where('category_id', $id);
		$this->db->delete('sm_video_category');	
	}
//====================For Restaurant Menu==============================================
	}
?>