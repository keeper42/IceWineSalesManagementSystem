<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('shopping_model', 'shopping');
		$this->load->model('account_model', 'account');
	}

	public function index() {
		$this->account->login();

		$data['user'] = $_SESSION['user'];
		$data['shopNum'] = $this->shopping->getShoppingNum();
		$data['shoppings'] = $this->shopping->getShopping($_SESSION['user']->id);
		$this->load->view('shopping', $data);
	}

	public function addToShopping() {
		$this->account->login();
		$result = $this->shopping->addToShopping();
		if ($this->input->post('ajax') == true) {
			echo $result;
			return ;
		}
		header("Location:".site_url('shopping'));
	}

	public function deleteFromShopping() {
		$this->account->login();

		echo $this->shopping->deleteShopping($this->input->post('sid'));
	}

	public function addAmount() {
		$this->account->login();

		echo $this->shopping->addAmount();
	}

	public function minusAmount() {
		$this->account->login();
		
		echo $this->shopping->minusAmount();
	}

}