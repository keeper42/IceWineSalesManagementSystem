<?php

class Employee_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		$this->load->database();
	}

	public function getEmployeeNum() {
		return $this->db->count_all('employee');
	}

	public function getEmployee(){
		$query = $this->db->get('employee');
		return $query->result();
	}

	public function getEmployeeById($id) {
		// if (empty($id) && $id != 0) {
		// 	return -1;
		// }
		if(empty($id)) {
			return -1;
		}
		$query = $this->db->where('id', $id)->get('employee');
		return $query->row();
	}

	public function addEmployee() {
		// $id = $this->input->post('pid');
		$name = $this->input->post('name');
		$sex = $this->input->post('sex');
		$position = $this->input->post('position');
		$wage = $this->input->post('wage');
		$entry_time = $this->input->post('entry_time');
		$contract_time = $this->input->post('contract_time');
		
		// if(empty($id) || empty($name) || empty($sex) || empty($position) || empty($wage) || empty($entry_time) || empty($contract_time) || !is_numeric($id)){ // 还应判断entry_time是否为日期
		// 	echo "null";
		// 	return -1;
		// }
		if(empty($name) || empty($sex) || empty($position) || empty($wage) || empty($entry_time) || empty($contract_time)){ 
			echo "null";
			return -1;
		}

		// $query = $this->db->select('id')
		// 					->where('name', $name)
		// 					->get('employee');

		$employeeNum = $this->db->count_all('employee');
		$pid = $this->input->post('pid');

		if(empty($pid)) {
			$data = array('id'=>$employeeNum + 1, 'name'=>$name, 'sex'=>$sex, 'position'=>$position, 'wage'=>$wage, 'entry_time'=>$entry_time, 'contract_time'=>$contract_time);
			$this->db->insert('employee', $data);
			$pid = $this->db->insert_id();
		} else {
			if($pid < 0) {
				return -1;
			}
			$where = 'id='.$pid;
			$data = array('name'=>$name, 'sex'=>$sex, 'position'=>$position, 'wage'=>$wage, 'entry_time'=>$entry_time, 'contract_time'=>$contract_time);
			$this->db->update('employee', $data, $where);
		}
		return $pid;
	}

	public function dismissEmployee(){
		$id = $this->input->post('pid');
		$name = $this->input->post('name');
		
		if(empty($id)) {
			return -1;
		} 
		if(empty($name)) {
			return -1;
		}

		// 在数据表中匹配 id 与 name 
		$query = $this->db->select('id')
						  ->from('employee')
						  ->where('id', $id)
						  ->where('name', $name);
		if($query) {
			$this->db->where('id', $id)
					 ->where('name', $name)
					 ->delete('employee');
		} else {
			if($id < 0){
				return -1;
			}
		}
		return $id;
	}
}