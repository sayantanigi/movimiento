<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intervenants_model extends Master_Model {
	public function __construct() {
		parent::__construct();
		$this->table = 'intervenants';
	}
}