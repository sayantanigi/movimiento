<?php 
class userst_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_users($data) {
		$this->load->database();
	    $this->db->insert('sm_user_registration', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_users()
	{
		$sql ="select * from sm_user_registration";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_users_id($id){
		$this->db->select('*');
		$this->db->from('sm_user_registration');
		$this->db->where('uid', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function show_countries()
	{
		$sql ="select * from sm_countries ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}	
	
function user_registrations_view($id){
		$this->db->select('*');
		$this->db->from('sm_user_registration');
		$this->db->where('uid', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function users_view_join($id){
		$this->db->select('sm_user_registration.*,sm_countries.nicename');
		$this->db->from('sm_user_registration');
		$this->db->join('sm_countries', 'sm_countries.id = sm_user_registration.country', 'INNER'); 
		$this->db->where('user_registration.uid', $id);
		$this->db->limit('1,0');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}	
	
function users_edit($id, $datalist){
	
		$this->db->where('uid', $id);
		$this->db->update('sm_user_registration',$datalist);
	}
function addidentityproof($id,$datalist){
		$this->db->where('uid', $id);
		$this->db->update('sm_user_registration',$datalist);

	}
function show_idproof($id){
		$this->db->select('*');
		$this->db->from('sm_user_registration');
		$this->db->where('uid', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}	
function updt($stat,$id){
	 
		$sql ="update sm_user_registration set user_status=$stat where uid=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_user_registrationslist()
	{
		$sql ="select * from sm_user_registration";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_users($id,$imagename){
		$this->db->where('uid', $id);
		@unlink("uploads/propic/".$imagename);
		$this->db->delete('sm_user_registration');	
		}
function delete_mul($ids)//Delete Multiple user_registrations
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('uid', $did);
			unlink("uploads/propic/".$users_image);
			$this->db->delete('sm_user_registration');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>