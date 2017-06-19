<?php

class Employee_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		$this->load->database();
	}

	public function getEmployeeNum() {
		return $this->db->count_all('employee');
	}

	public function getEmployee(){
		$query = $this->db->get('employee');
		return $query->result();
	}

	public function getEmployeeById($id) {
		if (empty($id) && $id != 0) {
			return -1;
		}
		$query = $this->db->where('Id', $id)->get('employee');
		return $query->row();
	}

}