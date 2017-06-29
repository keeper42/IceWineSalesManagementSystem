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

		$username = $this->db->select('*')->where('id', $userid)->get('user')->row()->name;
		$address = $this->db->select('*')->where('name', $username)->get('customer')->row()->address;
		$phone = $this->db->select('*')->where('name', $username)->get('customer')->row()->phone;

		// 创建order记录
		// $data = array('user'=>$userid);

		$data = array('user' => $userid, 'address' => $address, 'phone' => $phone);
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

	public function getOrdersNum() {
		return $this->db->count_all('order');
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

	public function getOrders2() {
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

	public function getOrderById($id) {
		if (empty($id)) {
			return -1;
		}
		$query = $this->db->where('id', $id)->get('order');
		return $query->row();
	}

	public function orderHandler() {
		// 处理订单
	}

	public function uploadOrders() {
		// 录入订单
		$json = $this->input->post();
		
		// $json = stripslashes($json);
		$data = json_decode($json);
		// $data = json_decode(trim(file_get_contents('php://input')), true);
		return $data;
	}

	public function updateOrder() {
		// 获取数据 检查数据合法性
		$id = $this->input->post('oid');
		$state = $this->input->post('state');
		if(empty($id) || empty($state)) {
			echo "null";
			return -1;
		}
		$state = urldecode($state);
		if($state == "未发货" || $state === "未发货") {
			$state = 0;
		} else if ($state == "已发货" || $state === "已发货"){
			$state = 1;
		} else {
			// return -1;
		}

		// 有id的话执行更新操作
		$orderNum = $this->db->count_all('order');
		if (!is_numeric($id) || $id < 0 || $id > $orderNum) {
			echo "id error";
			return -1;
		} else {
			$where = 'id='.$id;
			$data = array('id'=>$id, 'state'=>$state);
			$this->db->update('order', $data, $where);
		}
		return $id;
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