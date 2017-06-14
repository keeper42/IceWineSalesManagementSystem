<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('account_model', 'account');
		$this->load->model('product_model', 'product');
	}

	public function index() {
		$data['products'] = $this->product->getProduct();

		$this->load->view('home', $data);
	}

	public function login() {
		$this->account->login('/');
	}

	public function logout() {
		$this->account->logout('/');
	}
}