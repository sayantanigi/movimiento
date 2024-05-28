<?php 
class Location_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_location($data) {
		$this->load->database();
	    $this->db->insert('sm_location', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}

public function insert_start_date($data) {
		$this->load->database();
	    $this->db->insert('sm_course_start_date', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_start_date($id)
	{
		$this->db->select('*');
		$this->db->from('sm_course_start_date');
		$this->db->where('loc_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}	
function delete_start_date($id){
		$this->db->where('start_date_id', $id);
		$this->db->delete('sm_course_start_date');	
		}
function show_start_date_id($id)
	{
		$this->db->select('*');
		$this->db->from('sm_course_start_date');
		$this->db->where('start_date_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function start_date_edit($id, $data){
		$this->db->where('start_date_id', $id);
		$this->db->update('sm_course_start_date',$data);
	}	

public function insert_end_date($data) {
		$this->load->database();
	    $this->db->insert('sm_course_end_date', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_end_date($id)
	{
		$this->db->select('*');
		$this->db->from('sm_course_end_date');
		$this->db->where('start_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}	
function delete_end_date($id){
		$this->db->where('end_date_id', $id);
		$this->db->delete('sm_course_end_date');	
		}
function show_end_date_id($id)
	{
		$this->db->select('*');
		$this->db->from('sm_course_end_date');
		$this->db->where('end_date_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function end_date_edit($id, $data){
		$this->db->where('end_date_id', $id);
		$this->db->update('sm_course_end_date',$data);
	}			

			
function show_location()
	{
		$user = $this->session->userdata('userid');
		$this->db->select('*');
		$this->db->from('sm_location');
		$this->db->where('userid', $user);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function show_location_id($id){
		$this->db->select('*');
		$this->db->from('sm_location');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function location_edit($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_location',$data);
	}
function updt($id){
	 
		$sql ="update sm_location  where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_locationlist()
	{
		$sql ="select * from sm_location";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_location($id){
		$this->db->where('id', $id);
		$this->db->delete('sm_location');	
		}
function delete_mul($ids)//Delete Multiple Location
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('id', $did);
			$this->db->delete('sm_location');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item Deleted Successfully
			</div>';
			$count = 0;		
		}
	}
?>