<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'event';
		$this->table2 = 'event_booked';
	}

}

/* End of file Event_model.php */
/* Location: ./application/models/Event_model.php */