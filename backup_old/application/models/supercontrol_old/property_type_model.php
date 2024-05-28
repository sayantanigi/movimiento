<?php 
class Property_type_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_property_type($data) {
		$this->load->database();
	    $this->db->insert('sm_property_type', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_property_type()
	{
		$sql ="select * from sm_property_type ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_property_type_id($id){
		$this->db->select('*');
		$this->db->from('sm_property_type');
		$this->db->where('property_type_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function property_type_view($id){
		$this->db->select('*');
		$this->db->from('sm_property_type');
		$this->db->where('property_type_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function property_type_edit($id, $data){
	
		$this->db->where('property_type_id', $id);
		$this->db->update('sm_property_type',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_property_type set property_type_status=$stat where property_type_id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_property_typelist()
	{
		$sql ="select * from sm_property_type";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_property_type($id,$property_type_image){
		$this->db->where('property_type_id', $id);
		unlink("property_type/".$property_type_image);
		$this->db->delete('sm_property_type');	
		}
function delete_mul($ids)//Delete Multiple Property_type
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('property_type_id', $did);
			unlink("property_type/".$property_type_image);
			$this->db->delete('sm_property_type');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>