<?php

class Model_staff extends CI_Model {


	public function get_all_staff() {
		$query = $this->db->query('SELECT id, name, email from user_staff');
		return $query;
	}

	public function get_all_disasters() {
		$query = $this->db->query('SELECT * from disasters');
		return $query;
	}

	public function get_all_resource_category() {
		$query = $this->db->query('SELECT * from resource_category');
		return $query;
	}
	
	public function get_all_resource($res_cat_id) {
		$query = $this->db->query('SELECT * from resource_category ');
		return $query;
	}

	public function get_name($email) {

		$sql = "SELECT name FROM user_staff WHERE email = ?";
		$name = 'abcd';
		$query = $this->db->query($sql, array($email)); 
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $name = $row->name;
		   }
		} 
		return $name;
	}

	public function can_log_in($tableName) {
	
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', md5($this->input->post('password')));
		
		$query = $this->db->get($tableName);

		if($query->num_rows() == 1){
			return true;
		} else {
			return false;
		}
	}
	
	public function add_temp_user($key) {
		$data = array (
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'key' => $key
		);
		
		$query = $this->db->insert('temp_users', $data);
		if($query) {
			return true;
		} else {
			return false;
		}
		
	}

	public function add_staff($pass) {
		$data = array (
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => md5($pass)
		);
		
		$query = $this->db->insert('user_staff', $data);
		if($query) {
			return true;
		} else {
			return false;
		}
		
	}
	
	public function is_valid_key($key) {
		$this->db->where('key', $key);
		$query = $this->db->get('temp_users');
		
		if($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	public function add_user($key) {
		$this->db->where('key', $key);
		$temp_user = $this->db->get('temp_users');

		if($temp_user) {
			$row = $temp_user->row();

			$data = array (
				'email' => $row->email,
				'password' => $row->password
			);

			$did_add_user = $this->db->insert('users', $data);
		}

		if($did_add_user) {
			$this->db->where('key', $key);
			$this->db->delete('temp_users');
			return $data['email'];
		} else {
			return false;
		}
	}
}