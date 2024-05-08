<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Faq_model extends Master_Model {
	public function __construct() {
		parent::__construct();
		$this->table = 'faqs';
	}
}

/* End of file Faq_model.php */
/* Location: ./application/models/Faq_model.php */