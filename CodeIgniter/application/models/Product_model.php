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
		if (empty($id) && $id != 0) {
			return -1;
		}
		$query = $this->db->where('id', $id)->get('product');
		return $query->row();
	}

	public function addProduct() {
		// 获取数据 检查数据合法性
		$name = $this->input->post('name');
		$img = $this->input->post('img');
		$price = $this->input->post('price');
		$stock = $this->input->post('stock');
		$content = $this->input->post('content');
		if (empty($name) || empty($img) || (empty($price) && $price != 0) || (empty($stock) && $stock != 0) || empty($content) || !is_numeric($price) || !is_numeric($stock)) {
			echo "null";
			return -1;
		}
		// 插入数据
		$pid = $this->input->post('pid');
		$data = array('name'=>$name, 'img'=>$img, 'instock'=>$stock, 'description'=>$content, 'price'=>$price);
		// 有pid的话执行更新操作
		if (empty($pid)) {
			$this->db->insert('product', $data);
			$pid = $this->db->insert_id();
		} else {
			if ($pid < 0) {
				return -1;
			}
			$where = 'id='.$pid;
			$this->db->update('product', $data, $where);
		}
		return $pid;
	}
}