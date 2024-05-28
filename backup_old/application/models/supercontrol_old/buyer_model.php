<?php 
class Buyer_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_buyer($data) {
		$this->load->database();
	    $this->db->insert('sm_buyer', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_buyer()
	{
		$sql ="select * from sm_buyer ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_buyer_id($id){
		$this->db->select('*');
		$this->db->from('sm_buyer');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function buyer_view($id){
		$this->db->select('*');
		$this->db->from('sm_buyer');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function buyer_edit($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_buyer',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_buyer set buyer_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_buyerlist()
	{
		$sql ="select * from sm_buyer";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_buyer($id,$buyer_image){
		$this->db->where('id', $id);
		unlink("buyer/".$buyer_image);
		$this->db->delete('sm_buyer');	
		}
function delete_mul($ids)//Delete Multiple Buyer
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('id', $did);
			unlink("buyer/".$buyer_image);
			$this->db->delete('sm_buyer');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>