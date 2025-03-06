<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription_model extends Master_Model {
	public function __construct() {
		parent::__construct();
		$this->table = 'subscription';
		$this->table2 = 'user_subscriptions';
	}
}
/* End of file Event_model.php */
/* Location: ./application/models/Event_model.php */