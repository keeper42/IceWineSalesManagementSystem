<?php

class Product_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		$this->load->database();
	}

	public function productNum() {
		return $this->db->count_all('product');
	}

	public function getProduct() {
		$page = $this->input->get('page');
		if (!is_null($page)) {
			if (!is_numeric($page) || $page < 0) {
				return -1;
			}
			$this->db->limit(10, $page * 10);
		}
		$query = $this->db->get('product');
		return $query->result();
	}

	public function getProductById($id) {
		if(empty($id) && $id != 0){
			return -1;
		}
		$query = $this->db->where('id', $id)->get('product');
		return $query->row();
	}

}