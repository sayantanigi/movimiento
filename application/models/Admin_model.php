<?php
class Admin_model extends CI_Model {
	var $user_role, $error;

	function __construct () {
		parent::__construct ();
	}

	public function authenticate ($u, $pw) {
		$this->db->select ('id, username, password, role');
		$this->db->where ('username', $u);
		$this->db->where ('password', $pw);
		$this->db->where ('status', 1);
		$this->db->limit (1);
		$Q = $this->db->get ('admin');
		if ($Q->num_rows () > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkpass($pass)
	{
		$res = $this->db->get_where('admin',array('password'=>md5($pass)));
		if($res->num_rows()>0){
			return true;
		}
		else{
			return false;
		}
	}
}
