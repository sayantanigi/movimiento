<?php 
class Agent_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_agent($data) {
		$this->load->database();
	    $this->db->insert('sm_agent', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_agent()
	{
		$sql ="select * from sm_agent ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_agent_id($id){
		$this->db->select('*');
		$this->db->from('sm_agent');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function agent_view($id){
		$this->db->select('*');
		$this->db->from('sm_agent');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function agent_edit($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_agent',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_agent set agent_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_agentlist()
	{
		$sql ="select * from sm_agent";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_agent($id,$agent_image){
		$this->db->where('id', $id);
		unlink("agent/".$agent_image);
		$this->db->delete('sm_agent');	
		}
function delete_mul($ids)//Delete Multiple Agent
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('id', $did);
			unlink("agent/".$agent_image);
			$this->db->delete('sm_agent');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>