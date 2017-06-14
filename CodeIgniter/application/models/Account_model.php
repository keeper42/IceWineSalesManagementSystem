<?php

class Account_model extends CI_Model {
	public function __construct() {
		parent::__construct();

		$this->load->library('session'); // 检查用户的 cookie 中是否存在有效的 session 数据
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
			header("Location:".$redirect_url);
		} else if ($user && $user->password == substr(hash('sha256', $password), -50) && $user->authority == 666){
			$_SESSION['user'] = $user;
			header("Location:".$redirect_url);
			// $employee_url = "localhost/index.php/employee.php";
			// header("Location:http://".$employee_url);
		} else if ($user && $user->password == substr(hash('sha256', $password), -50) && $user->authority == 777){
			$_SESSION['user'] = $user;
			header("Location:".$redirect_url);
			// $manager_url = "localhost/index.php/manager.php";
			// header("Location:http://".$manager_url);
		} else {
			$_SESSION['error'] = "用户名或密码错误";
			header("Location:http://".site_url('account'));
		}

	}

	/**
	 * 用户登录，未登录则跳转到登录页面，登录完成后跳转到$redirect_url。
	 * @param  String $redirect_url 登录后需要跳转到的网址.默认为调用该函数的地址
	 * @return [type]               [description]
	 */
	public function login($redirect_url = False) {
		if ($redirect_url === False) {
			$redirect_url = current_url();
		}
		if (!$this->session->user) {
			$_SESSION['redirect_url'] = $redirect_url;
			header("Location:http://".site_url('account'));
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