<?php

class Customer_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		$this->load->database();
	}

	public function getCustomerNum() {
		return $this->db->count_all('customer');
	}

	public function getCustomer(){
		$query = $this->db->get('customer');
		return $query->result();
	}

	public function getCustomerById($id) {
		if(empty($id)) {
			return -1;
		}
		$query = $this->db->where('id', $id)->get('customer');
		return $query->row();
	}

	public function updateCustomer() {
		$id = $this->input->post('cid');
		$name = $this->input->post('name');
		$category = $this->input->post('category');

		if(empty($id)) {
			return -1;
		} 
		if(empty($name)) {
			return -1;
		}
		$query = $this->db->select('id')
				  ->from('customer')
				  ->where('id', $id)
				  ->where('name', $name);

		$where = 'id='.$id;
		$data = array('category'=>$category);
		$this->db->where('id', $id)
				 ->where('name', $name)
                 ->update('customer', $data);
		return $id;
	}

	public function addCustomer() {

	}

	public function dismissCustomer(){
		
	}
}