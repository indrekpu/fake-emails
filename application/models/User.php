<?php

class User extends CI_Model
{
	public function createUser($fullName, $email, $birthday, $gender, $password){
		$fullName = $this->db->escape($fullName);
		$email = $this->db->escape($email);
		$birthday = $this->db->escape($birthday);
		$gender = $this->db->escape($gender);
		$password = $this->db->escape($password);

		//$hashed = md5($password);
		$queryResult = $this->db->simple_query("INSERT INTO user(full_name, email, password) VALUES($fullName, $email, $password)");
		
		return $queryResult;
	}

	public function loginUser($email, $password){
		$email = $this->db->escape($email);
		$password = $this->db->escape($password);
		
		$query = $this->db->query("SELECT full_name, email FROM user WHERE email=$email AND password=$password");
		$result = $query->row();
		if($result->email != null){
			$this->session->set_userdata('email', $result->email);
			$this->session->set_userdata('name', $result->full_name);
			return true;
		}
		return false;
	}

	public function doesUserExist($email){
		$query = $this->db->query("SELECT full_name, email FROM user WHERE email='$email'");
		$result = $query->row();
		if($result->email != null){
			return true;
		}
		return false;
	}

}
?>