<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('account_model', 'account');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index() {
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		$this->load->view('account');
	}

	public function check() {
		$this->account->check();
	}

	public function login() {
		$this->account->logout('/');
	}

	public function logout() {
		$this->account->logout('/');
	}
}