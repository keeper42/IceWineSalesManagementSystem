<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('product_model', 'product');
		$this->load->model('account_model', 'account');
		$this->load->model('shopping_model', 'shopping');
	}

	public function login($pid) {
		$this->account->login('/index.php/product/index/'.$pid);
	}

	public function logout($pid) {
		$this->account->logout('/index.php/product/index/'.$pid);
	}

	public function index($pid = False) {
		if (isset($_SESSION['user'])) {
			$data['user'] = $_SESSION['user'];
			if ($data['user']->authority == 666) {
				unset($data['user']);
				unset($_SESSION['user']);
			}
		}
		if ($pid == False) {
			return ;
		}
		$sn = $this->shopping->getShoppingNum();
		if ($sn > 0) {
			$data['shopNum'] = $this->shopping->getShoppingNum();
		}
		$data['product'] = $this->product->getProductById($pid);
		$this->load->view('product', $data);
	}

	public function getProductById() {
		echo json_encode($this->product->getProductById($this->input->get('pid')), JSON_UNESCAPED_UNICODE);
	}

	public function getProduct() {
		echo json_encode($this->product->getProduct(), JSON_UNESCAPED_UNICODE);
	}

	public function productNum() {
		echo $this->product->productNum();
	}

	public function addProduct() {
		echo $this->product->addProduct();
	}
}
