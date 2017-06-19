<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('account_model', 'account');
		$this->load->model('employee_model', 'employee');
		$this->load->helper('url');
	}

	public function index() {
		$this->account->login();

		if ($_SESSION['user']->authority < 666) {
			echo "Permission denied";
			exit();
		}
		$data['user'] = $_SESSION['user'];
		$this->load->view('employee', $data);
	}

	public function check() {
		$this->account->check();
	}

	public function logout() {
		$this->account->logout(site_url('employee'));
	}

	public function getEmployee() {
		echo json_encode($this->employee->getEmployee(), JSON_UNESCAPED_UNICODE);
	}

	public function getEmployeeNum() {
		echo $this->employee->getEmployeeNum();
	}

	public function getEmployeeById() {
		echo json_encode($this->employee->getEmployeeById($this->input->get('eid')), JSON_UNESCAPED_UNICODE);
	}

}