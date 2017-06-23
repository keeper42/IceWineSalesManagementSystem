<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerManage extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('account_model', 'account');
		$this->load->model('customer_model', 'customer');
		$this->load->helper('url');
	}

	public function index($id = False) {
		$this->account->login();

		if ($_SESSION['user']->authority < 666) {
			echo "Permission denied";
			exit();
		}

		$data['user'] = $_SESSION['user'];
		$this->load->view('customerManage', $data);
	}

	public function check() {
		$this->account->check();
	}

	public function getCustomer() {
		echo json_encode($this->customer->getCustomer(), JSON_UNESCAPED_UNICODE);
	}

	public function getCustomerNum() {
		echo $this->customer->getCustomerNum();
	}

	public function getCustomerById() {
		$cid = $this->input->get('cid');
		echo json_encode($this->customer->getCustomerById($cid), JSON_UNESCAPED_UNICODE);
	}

	public function addCustomer() {
		echo $this->customer->addCustomer();
	}

	public function updateCustomer() {
		echo $this->customer->updateCustomer();
	}

	public function logout() {
		$this->account->logout(site_url('customerManage'));
	}
}