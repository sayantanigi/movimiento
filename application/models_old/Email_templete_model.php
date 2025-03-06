<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_templete_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'email_templete';
	}

}

/* End of file Event_model.php */
/* Location: ./application/models/Event_model.php */