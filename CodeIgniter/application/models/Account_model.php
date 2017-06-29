<?php

class Account_model extends CI_Model {
	public function __construct() {
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
	}

	public function check() {
		$redirect_url = isset($_SESSION['redirect_url'])?$_SESSION['redirect_url']:'/';

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if (empty($username) || empty($password)) {
			echo "";
			exit();
		}

		$this->load->database();
		$this->db->select('*');
		$this->db->where('name', $username);
		$query = $this->db->get('user');
		$user = $query->row();
		if ($user && $user->password == substr(hash('sha256', $password), -50) && $user->authority == 0){
			$_SESSION['user'] = $user;
			// header("Location:".$redirect_url);
			header("Location:http://172.29.45.4/index.php/home");
			// header("Location:http://172.27.108.34/index.php/home");
			// header("Location:http://".site_url('home'));
		} else if ($user && $user->password == substr(hash('sha256', $password), -50) && $user->authority == 666){
			$_SESSION['user'] = $user;
			header("Location:http://172.29.45.4/index.php/employee");
			// header("Location:http://172.27.108.34/index.php/employee");
			// header("Location:http://".site_url('employee'));
		} else if ($user && $user->password == substr(hash('sha256', $password), -50) && $user->authority == 777){
			$_SESSION['user'] = $user;
			header("Location:http://172.29.45.4/index.php/manager");
			// header("Location:http://172.27.108.34/index.php/manager");
			// header("Location:http://".site_url('manager'));
		} else {
			$_SESSION['error'] = "用户名或密码错误";
			header("Location:http://172.29.45.4/index.php/account");
			// header("Location:http://172.27.108.34/index.php/account");
			// header("Location:http://".site_url('account'));
		}

	}

	// The user logs in, does not log in to jump to the login page, jumps to $redirect_url after login.
	public function login($redirect_url = False) {
		// if ($redirect_url === False) {
		// 	$redirect_url = current_url();
		// }
		if (!$this->session->user) {
			$_SESSION['redirect_url'] = $redirect_url;
			// header("Location:http://".site_url('account'));
			header("Location:http://172.29.45.4/index.php/account");
			// header("Location:http://172.27.108.34/index.php/account");	
			exit();
		}
	}

	public function logout($redirect_url = False) {
			if ($redirect_url === False) {
				$redirect_url = current_url();
			}
			if (isset($_SESSION['user'])) {
				unset($_SESSION['user']);
			}
			header("Location:".$redirect_url);
	}
}