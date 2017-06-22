<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FinanceManage extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('account_model', 'account');
		$this->load->model('finance_model', 'finance');
		$this->load->helper('url');
	}

	public function index() {
		$this->account->login();

		if ($_SESSION['user']->authority < 777) {
			echo "Permission denied";
			exit();
		}
		$data['user'] = $_SESSION['user'];
		$this->load->view('financeManage', $data);
	}

	public function check() {
		$this->account->check();
	}

	public function getFinanceNum() {
		echo $this->finance->getFinanceNum();
	}

	public function getFinanceById() {
		// $fid = $this->input->get('fid'));
		// echo json_encode($this->finance->getFinanceById($fid), JSON_UNESCAPED_UNICODE);
	}

	public function getFinance() {
		echo json_encode($this->finance->getFinance(), JSON_UNESCAPED_UNICODE);
	}

	public function logout() {
		$this->account->logout(site_url('financeManage'));
	}

}