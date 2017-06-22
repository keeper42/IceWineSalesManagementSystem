<?php

class Finance_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		$this->load->database();
	}

	public function getfinanceNum() {
		return $this->db->count_all('finance');
	}

	public function getFinanceById($id) {
		// if(empty($id) || $id < 0) {
		// 	return -1;
		// }
		// $query = $this->db->where('id', $id)->get('finance');
		// return $query->row();
	}

	public function getFinance() {
		$page = $this->input->post('page');
		$pages = $this->input->post('pages');
		if ($page < 0) {
			$page = 0;
		} else if($page == $pages) {
			$page = $pages - 1;
		}
		$this->db->limit(10, ($page) * 10);
		$query = $this->db->get('order');
		return $query->result();	
	}

}