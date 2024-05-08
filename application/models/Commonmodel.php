<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Commonmodel extends CI_Model
{

	function __construct()
	{
		parent::__construct();

	}

	public function fetch_all($tbl)
	{
		$this->db->select('*');
		$query = $this->db->get($tbl);
		return $query->result();

	}
	public function fetch_all_join($query)
	{
		$query = $this->db->query($query);
		return $query->result();

	}
	public function fetch_single_join($query)
	{
		$query = $this->db->query($query);
		return $query->row();
	}
	public function fetch_row($tbl, $where)
	{

		$this->db->select('*');
		$this->db->where($where);
		$query = $this->db->get($tbl);
		return $query->row();

	}
	public function fetch_all_rows($tbl, $where)
	{
		$this->db->select('*');
		$this->db->where($where);
		$query = $this->db->get($tbl);
		return $query->result();

	}

	public function get_row_array($tbl, $where)
	{
		$this->db->select('*');
		$this->db->where($where);
		$query = $this->db->get($tbl);
		return $query->row_array();

	}

	public function get_result_array($tbl, $where)
	{
		$this->db->select('*');
		$this->db->where($where);
		$query = $this->db->get($tbl);
		return $query->result_array();

	}
	public function fetch_all_result_array($query)
	{
		$query = $this->db->query($query);
		return $query->result_array();

	}
	public function fetch_all_rows_limit($tbl, $where, $limit)
	{
		$this->db->select('*');
		$this->db->where($where);
		$this->db->limit($limit);
		$query = $this->db->get($tbl);
		return $query->result();

	}
	public function delete_single_con($tbl, $where)
	{
		$this->db->where($where);
		$delete = $this->db->delete($tbl);
		return $delete;

	}
	public function edit_single_row($tbl, $data, $where)
	{
		$this->db->where($where);
		$this->db->update($tbl, $data);

		return true;

	}

	public function update_row($tbl, $data, $where)
	{
		$this->db->where($where);
		$this->db->update($tbl, $data);

		return true;

	}

	public function blog_count()
	{

		return $this->db->count_all("country");

	}
	public function add_details($tbl, $data)
	{
		$this->db->insert($tbl, $data);
		$lastid = $this->db->insert_id();

		return $lastid;
	}
	public function total_count($tbl, $where)
	{
		$this->db->select('*');
		$this->db->where($where);
		return $this->db->count_all_results($tbl);
	}

	public function insert($tbl, $data = array())
	{
		//insert data
		$insert = $this->db->insert($tbl, $data);

		if ($insert) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function getSessionDetail($user_id)
	{

		return $this->db->query("SELECT `agenda_id`, `user_id` from `event_agenda` where `user_id` REGEXP '[[:<:]]" . $user_id . "[[:>:]]' and `agenda_status` = '1' and `session_notification` = '0'")->result();
	}

	public function getSessionBroadcastDetail($eventIds)
	{

		return $this->db->query("select * from `broadcast_live` where `event_id` IN('$eventIds') and `status` = '1' and `session_notification` = '0'")->row();
	}

	public function getSubSessionDetail($user_id)
	{

		return $this->db->query("SELECT `session_id`, `user_id` from `event_sub_session` where `user_id` REGEXP '[[:<:]]" . $user_id . "[[:>:]]' and `session_status` = '1' and `session_notification` = '0'")->result();
	}

	/* 
	 * Insert file data into the database 
	 * @param array the data for inserting into the table 
	 */
	public function insertBatch($tbl, $data = array())
	{
		$insert = $this->db->insert_batch($tbl, $data);
		return $insert ? true : false;
	}

	public function getVacantRooms($agenda_id, $date, $start)
	{
		$getSql = "SELECT `room_id` FROM `event_agenda` WHERE `agenda_date` = '" . $date . "' AND `agenda_start_time` = '" . $start . "' AND `agenda_id` NOT IN($agenda_id) AND `room_id` IS NOT NULL";
		$queryAgenda = $this->db->query($getSql);
		$agenda = $queryAgenda->result();

		$roomArray = array();
		$condition = "";

		if (!empty($agenda)) {
			foreach ($agenda as $value) {

				if ($value->room_id != '') {
					$roomArray[] = $value->room_id;
				}
			}

			if (!empty($roomArray)) {
				$room_ids = implode("','", $roomArray);
				$condition = " AND `room_id` NOT IN('$room_ids')";
			}
		}

		$sql = "SELECT * FROM `rooms` WHERE `room_status` = '1' $condition";
		$query = $this->db->query($sql);
		return $query->result();

	}

	public function getAll_where($table, $key, $value)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($key, $value);
		$query = $this->db->get();
		return $query->result();
	}

	public function save_enquiry($message, $name, $phone, $email, $created)
	{
		$data = array(
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'message' => $message,
			'created' => $created
		);
		$this->db->insert('enquiries', $data);
		return $this->db->insert_id();
	}

	public function fetch_all_user()
	{
		$this->db->select('users.*,event_registration.event_id');
		$this->db->from('users');
		$this->db->join('event_registration', 'users.user_id=event_registration.user_id', 'left');
		$this->db->order_by("users.user_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}



	function ManageData($table_name = '', $condition = array(), $udata = array(), $is_insert = false)
	{

		if ($condition && count($condition)) {
			foreach ($condition as $k => $v)
				$this->db->where($k, $v);
		}
		if ($is_insert) {
			$this->db->insert($table_name, $udata);
			return $this->db->insert_id();
		} else {
			$this->db->update($table_name, $udata);
			return 1;

		}
	}

	function GetData($table_name = '', $condition = array())
	{

		if ($condition && count($condition)) {
			foreach ($condition as $k => $v)
				$this->db->where($k, $v);
		}
		return $this->db->get($table_name)->result_array();
	}

	function timeAgo($time_ago)
	{
		$time_ago = strtotime($time_ago) ? strtotime($time_ago) : $time_ago;
		$time = time() - $time_ago;

		switch ($time):
			// seconds
			case $time <= 60;
				return 'Just Now';
			// minutes
			case $time >= 60 && $time < 3600;
				return (round($time / 60) == 1) ? 'a minute' : round($time / 60) . ' minutes ago';
			// hours
			case $time >= 3600 && $time < 86400;
				return (round($time / 3600) == 1) ? 'a hour ago' : round($time / 3600) . ' hours ago';
			// days
			case $time >= 86400 && $time < 604800;
				return (round($time / 86400) == 1) ? 'a day ago' : round($time / 86400) . ' days ago';
			// weeks
			case $time >= 604800 && $time < 2600640;
				return (round($time / 604800) == 1) ? 'a week ago' : round($time / 604800) . ' weeks ago';
			// months
			case $time >= 2600640 && $time < 31207680;
				return (round($time / 2600640) == 1) ? 'a month ago' : round($time / 2600640) . ' months ago';
			// years
			case $time >= 31207680;
				return (round($time / 31207680) == 1) ? 'a year ago' : round($time / 31207680) . ' years ago';

		endswitch;
	}


}