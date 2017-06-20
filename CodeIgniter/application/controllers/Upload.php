<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$file = $_FILES['uploadImgFile'];
		if (!is_uploaded_file($file['tmp_name'])) {
			return ;
		}
		$uploadDir = '/root/images/upload/';
		$uploadFileName = md5_file($file['tmp_name']);
		if (!$uploadFileName) {
			echo 'error|'.$file['error'];
			return ;
		}
		if (move_uploaded_file($file['tmp_name'], dirname(dirname(dirname(dirname(__file__)))).$uploadDir.$uploadFileName)) {
			echo "/images/upload/".$uploadFileName;
		} else {
			echo "error|服务器端错误";
		}
	}
}