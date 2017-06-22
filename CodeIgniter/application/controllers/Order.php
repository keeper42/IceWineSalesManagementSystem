<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('order_model', 'order');
		$this->load->model('account_model', 'account');
	}

	public function addAmount() {
		$this->account->login();

		echo $this->order->addAmount();
	}

	public function minusAmount() {
		$this->account->login();

		echo $this->order->minusAmount();
	}

	public function index() {
		$this->account->login();

		$orders = $this->order->getOrders($_SESSION['user']->id);
		$orderNum = count($orders);
		if ($orderNum < 1) {
			header("Location:/");
			exit;
		}
		$orderId = $orders[0];
		$data['order'] = $this->order->getOrderProduct($orderId);
		$data['user'] = $_SESSION['user'];

		$this->load->view('Order', $data);
	}

	public function createOrder() {
		$orderId = $this->order->createOrder();
		header("Location:/index.php/order");
	}

	public function order() {
		$this->account->login();
		$orders = $this->order->getOrders($_SESSION['user']->id);
		$orderNum = count($orders);
		if ($orderNum < 1) {
			header("Location:/");
			exit;
		}
		$data['order'] = $orders[0];
		$data['user'] = $_SESSION['user'];

		$this->load->view('Order', $data);
	}

	public function success() {
		$this->account->login();

		$user = $_SESSION['user'];
		$result = $this->order->getOrders($user->id);
		if (count($result) < 1) {
			header('Location:/');
			return ;
		}
		$orderId = $result[0];

		$this->order->confirmOrder($orderId);
		$this->load->view('success');
	}

	public function getOrdersNum() {
		echo json_encode($this->order->getOrdersNum());
	}

	public function getOrders(){
		echo json_encode($this->order->getOrders2(), JSON_UNESCAPED_UNICODE);
	}

	public function getOrderById() {
		echo json_encode($this->order->getOrderById($this->input->get('id')), JSON_UNESCAPED_UNICODE);
	}

	public function orderHandler() {
		echo $this->order->orderHandler();
	}

	public function updateOrder() {
		echo $this->order->updateOrder();
	}

	public function uploadOrders() {
		$json = $this->input->post();
		echo $json;
		// echo $this->order->uploadOrders();
	}

}