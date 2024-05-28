<?php 
class Faq_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_faq($data) {
		$this->load->database();
	    $this->db->insert('sm_faq', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_faq()
	{
		$sql ="select * from sm_faq ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_faq_id($id){
		$this->db->select('*');
		$this->db->from('sm_faq');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function faq_view($id){
		$this->db->select('*');
		$this->db->from('sm_faq');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function faq_edit($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_faq',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_faq set faq_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_faqlist()
	{
		$sql ="select * from sm_faq";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_faq($id,$faq_image){
		$this->db->where('id', $id);
		unlink("faq/".$faq_image);
		$this->db->delete('sm_faq');	
		}
function delete_mul($ids)//Delete Multiple Faq
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('id', $did);
			unlink("faq/".$faq_image);
			$this->db->delete('sm_faq');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>