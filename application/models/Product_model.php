<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'product';
		$this->table1 = 'product_order_details';
	}

}

/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */