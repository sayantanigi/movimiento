<?php 
class Distance_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_data($data) {
		$this->load->database();
	    $this->db->insert('sm_distance_learning', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_data($id){
		$this->db->select('*');
		$this->db->from('sm_distance_learning');
		$this->db->where('course_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function show_course_by_id($id){
		$this->db->select('*');
		$this->db->from('sm_course');
		$this->db->where('course_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}	
function show_location_id($id){
		$this->db->select('*');
		$this->db->from('sm_distance_learning');
		$this->db->where('diatance_id', $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function edit_distance($id, $data){
	
		$this->db->where('diatance_id', $id);
		$this->db->update('sm_distance_learning',$data);
	}
function location_edit($id, $data){
	
		$this->db->where('diatance_id', $id);
		$this->db->update('sm_distance_learning',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_course_location set status=$stat where location_id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_locationlist()
	{
		$sql ="select * from sm_course_location";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_location($id,$location_image){
		$this->db->where('location_id', $id);
		$this->db->delete('sm_course_location');	
		}
function delete_mul($ids)//Delete Multiple Location
		{
			
			$this->db->where('diatance_id', $ids);
			$this->db->delete('sm_distance_learning');  
					echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			 Deleted Successfully
			</div>';
			}
	}
?>