<?php 
class Consignment_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_consignment($data) {
		$this->load->database();
	    $this->db->insert('sm_consignment', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_consignment()
	{
		$sql ="select * from sm_consignment ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_consignment_id($id){
		$this->db->select('*');
		$this->db->from('sm_consignment');
		$this->db->where('con_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

function country(){
		$this->db->select('*');
		$this->db->from('sm_countries');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function consignment_view_cntry($country1){
		$this->db->select('*');
		$this->db->from('sm_countries');
		$this->db->where('id', $country1);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function consignment_view_cntry1($country2){
		$this->db->select('*');
		$this->db->from('sm_countries');
		$this->db->where('id', $country2);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}	


function consignment_view($id){
		$this->db->select('*');
		$this->db->from('sm_consignment');
		$this->db->where('con_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function consignment_edit($id, $data){
	
		$this->db->where('con_id', $id);
		$this->db->update('sm_consignment',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_consignment set consignment_status=$stat where con_id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_consignmentlist()
	{
		$sql ="select * from sm_consignment";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_consignment($id,$consignment_image){
		$this->db->where('con_id', $id);
		unlink("consignment/".$consignment_image);
		$this->db->delete('sm_consignment');	
		}
function delete_mul($ids)//Delete Multiple Consignment
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('con_id', $did);
			unlink("consignment/".$consignment_image);
			$this->db->delete('sm_consignment');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>