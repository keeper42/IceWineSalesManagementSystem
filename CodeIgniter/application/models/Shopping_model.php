<?php

class Shopping_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		$this->load->database();
	}

	public function addToShopping() {
		$userid = $_SESSION['user']->id;
		$amount = $this->input->post('number');
		$pid = $this->input->post('pid');
		if ($amount == 0) {
			return ;
		}
		$product = $this->db->select('instock')->where('id', $pid)->get('product')->row();
		if (is_null($product)) {
			return '商品不存在';
		}
		$stock = $product->instock;
		if ($stock < $amount) {
			return '库存不足！';
		}
		// 更新商品库存
		$data = array('instock' => $stock - $amount);
		$where = array('id' => $pid);
		$this->db->update('product', $data, $where);

		$count = $this->db->select('*')->where('user', $userid)->where('product', $pid)->get('shopping')->row();
		if (is_null($count)) {
			// 添加到购物车
			$data = array('user' => $userid, 'amount' => $amount, 'product' => $pid);
			$this->db->insert('shopping', $data);
		} else {
			// 修改购物车数量
			$data = array('amount' => $amount + $count->amount);
			$where = 'id='.$count->id;
			$this->db->update('shopping', $data, $where);
		}
		return $this->db->select('count(*) as count')->where('user', $userid)->get('shopping')->row()->count;
	}

	public function getShoppingNum() {
		if (!isset($_SESSION['user'])) {
			return 0;
		}
		$userid = $_SESSION['user']->id;
		return $this->db->select('count(*) as count')->where('user', $userid)->get('shopping')->row()->count;
	}

	public function addAmount() {
		$sid = $this->input->post('sid');
		$shopping = $this->db->select('*')->where('id', $sid)->get('shopping')->row();
		if (is_null($shopping)) {
			return "购物车商品不存在！";
		}
		$product = $this->db->select('*')->where('id', $shopping->product)->get('product')->row();
		// 更新product库存;
		if (!$product) {
			return "商品不存在！";
		}
		$stock = $product->instock;
		if ($stock < 1) {
			return "商品库存不足！";
		}
		$data = array('instock' => $stock - 1);
		$where = 'id='.$product->id;
		$this->db->update('product', $data, $where);
		// 更新购物车信息
		$data = array('amount' => $shopping->amount + 1);
		$where = 'id='.$shopping->id;
		$this->db->update('shopping', $data, $where);
		return 0;
	}

	public function minusAmount() {
		$sid = $this->input->post('sid');
		$shopping = $this->db->select('*')->where('id', $sid)->get('shopping')->row();
		if (is_null($shopping)) {
			return "购物车商品不存在！";
		}
		if ($shopping->amount < 2) {
			return "数量错误！";
		}
		$product = $this->db->select('*')->where('id', $shopping->product)->get('product')->row();
		// 更新product库存;
		if (!$product) {
			return "商品不存在！";
		}
		$stock = $product->instock;
		$data = array('instock' => $stock + 1);
		$where = 'id='.$product->id;
		$this->db->update('product', $data, $where);
		// 更新购物车信息
		$data = array('amount' => $shopping->amount - 1);
		$where = 'id='.$shopping->id;
		$this->db->update('shopping', $data, $where);
		return 0;
	}

	public function deleteShopping($id) {
		$shopping = $this->db->select('*')->where('id', $id)->get('shopping')->row();
		if (is_null($shopping)) {
			return "未找到要删除的商品";
		}

		$product = $this->db->select('*')->where('id', $shopping->product)->get('product')->row();

		// 恢复库存
		$data = array('instock' => $product->instock + $shopping->amount);
		$where = array('id' => $product->id);
		$this->db->update('product', $data, $where);
		// 删除购物车
		if ($this->db->delete('shopping', array('id' => $id))) {
			return 0;
		} else {
			return "删除失败！";
		}
	}

	public function getShopping($userId) {
		$result = array();
		$query = $this->db->select('*')
									->where('user', $userId)
									->get('shopping');
		foreach ($query->result() as $product) {
			$query = $this->db->select('*')
										->where('id', $product->product)
										->get('product');
			$result[] = array('shopping' => $product, 'product' => $query->row());
		}
		return $result;
	}
}