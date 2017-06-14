<?php

class Order_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		$this->load->database();
	}

	public function createOrder() {
		$userid = $_SESSION['user']->id;
		$sids = $this->input->get('sid');
		if (is_null($sids)) {
			return "";
		}
		$sids = explode('|', $sids);
		// 创建order记录
		$data = array('user' => $userid);
		$this->db->insert('order', $data);
		$orderid = $this->db->insert_id();
		foreach ($sids as $sid) {
			$shopping = $this->db->select('*')->where('id', $sid)->get('shopping')->row();
			// 创建orderlist
			$data = array('product' => $shopping->product, 'amount' => $shopping->amount);
			$this->db->insert('orderlist', $data);
			$orderlistId = $this->db->insert_id();

			// 创建ordermap
			$data = array('order' => $orderid, 'orderlist' => $orderlistId);
			$this->db->insert('ordermap', $data);

			// 删除该购物车记录
			$this->db->delete('shopping', array('id' => $sid));
		}

		return $orderid;
	}

	public function confirmOrder($orderId) {
		$data = array('confirm'=>1);
		$where = 'id='.$orderId;
		return $this->db->update('order', $data, $where);
	}

	public function getOrders($userId) {
		$result = array();
		$query = $this->db->select('id')
									->where('user', $userId)
									->where('confirm', '0')
									->get('order');
		foreach ($query->result() as $orderid) {
			$result[] = $orderid->id;
		}
		return $result;
	}

	public function getOrderProduct($orderId) {
		$products = array();
		$query = $this->db->select('orderlist')
									->where('order', $orderId)
									->get('ordermap');
		foreach ($query->result() as $orderlist) {
			$query = $this->db->select('*')
										->where('id', $orderlist->orderlist)
										->get('orderlist');
			$order = $query->row();
			$product = $this->db->select('*')
											->where('id', $order->product)
											->get('product');
			$products[] = array('product' => $product->row(), 'order' => $order);
		}
		return $products;
	}

	public function addAmount() {
		$oid = $this->input->post('oid');
		$pid = $this->input->post('pid');
		echo $oid;
		echo $pid;
		$orderlists = $this->db->select('*')->where('order', $oid)->get('ordermap')->result();
		$find = false;
		foreach ($orderlists as $orderlist) {
			$product =  $this->db->select('*')->where('id', $orderlist->orderlist)->get('orderlist')->row();
			if ($product->product == $pid) {
				$find = $product;
				break;
			}
		}
		if ($find == false) {
			return "未找到订单！";
		}
		// 判断商品库存是否足够
		$product = $this->db->select('*')->where('id', $pid)->get('product')->row();
		if ($product->instock < 1) {
			return "商品库存不足!";
		}
		// 更新商品库存
		$data = array('instock' => $product->instock - 1);
		$where = 'id='.$product->id;
		$this->db->update('product', $data, $where);
		// 修改orderlist 的 amount
		$data = array('amount' => $find->amount + 1);
		$where = 'id='.$find->id;
		$this->db->update('orderlist', $data, $where);
		return 0;
	}

	public function minusAmount() {
		$oid = $this->input->post('oid');
		$pid = $this->input->post('pid');
		echo $oid;
		echo $pid;
		$orderlists = $this->db->select('*')->where('order', $oid)->get('ordermap')->result();
		$find = false;
		foreach ($orderlists as $orderlist) {
			$product =  $this->db->select('*')->where('id', $orderlist->orderlist)->get('orderlist')->row();
			if ($product->product == $pid) {
				$find = $product;
				break;
			}
		}
		if ($find == false) {
			return "未找到订单！";
		}
		// 判断订单商品数量
		if ($find->amount < 2) {
			return "订单数量错误！";
		}
		// 更新商品库存
		$product = $this->db->select('*')->where('id', $pid)->get('product')->row();
		$data = array('instock' => $product->instock + 1);
		$where = 'id='.$product->id;
		$this->db->update('product', $data, $where);
		// 修改orderlist 的 amount
		$data = array('amount' => $find->amount - 1);
		$where = 'id='.$find->id;
		$this->db->update('orderlist', $data, $where);
		return 0;
	}
}