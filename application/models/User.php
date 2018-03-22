<?php

class User extends CI_Model
{
	public function createUser($fullName, $email, $birthday, $gender, $password){
		$fullName = $this->db->escape($fullName);
		$email = $this->db->escape_str($email);
		$birthday = $this->db->escape($birthday);
		$gender = $this->db->escape($gender);
		$password = $this->db->escape_str($password);

		$verificationCode = md5(uniqid(rand(), true));

		$hashed = password_hash($password, PASSWORD_DEFAULT);
		$queryResultUser = $this->db->simple_query("INSERT INTO user(full_name, email, activation) VALUES($fullName, '$email', '$verificationCode')");
		
		$id = $this->getUserId($email);
		$queryResultPassword = $this->db->simple_query("INSERT INTO passwords(user_id, password) VALUES($id, '$hashed')");

		return $queryResultUser AND $queryResultPassword;
	}

	public function loginUser($email, $password){
		$email = $this->db->escape($email);
		$password = $this->db->escape_str($password);
		
		$userQuery = $this->db->query("SELECT id, full_name, email FROM user WHERE email=$email");
		$userResult = $userQuery->row();

		if(!isset($userResult)){
			return false;
		}

		$passwordQuery = $this->db->query("SELECT password FROM passwords WHERE user_id=$userResult->id");
		$passwordResult = $passwordQuery->row();

		if(!isset($passwordResult)){
			return false;
		}

		if(password_verify($password, $passwordResult->password)){
			$this->session->set_userdata('email', $userResult->email);
			$this->session->set_userdata('name', $userResult->full_name);
			return true;
		}
		return false;
	}

	public function getUserId($email){
		$email = $this->db->escape($email);
		$queryId = $this->db->query("SELECT id FROM user WHERE email=$email");
		$idResult = $queryId->row_array();
		return $idResult['id'];
	}

	public function getUserVerificationCode($email){
		$email = $this->db->escape($email);
		$query = $this->db->query("SELECT activation FROM user WHERE email=$email");
		$result = $query->row();
		return $result->activation;
	}

	public function activateUser($verificationCode){
		$verificationCode = $this->db->escape($verificationCode);
		$query = $this->db->query("SELECT email, activation FROM user WHERE activation=$verificationCode");//Checking if user with this activation code exitsts.
		$result = $query->row();
		if(isset($result->activation)){
			$updateResult = $this->db->simple_query("UPDATE user SET activation=NULL WHERE email='$result->email'");
			return $updateResult;
		} 
		return false; //User already activated or doesn't exist.
	}

	public function doesUserExist($email){
		$query = $this->db->query("SELECT full_name, email FROM user WHERE email='$email'");
		$result = $query->row();
		if($result != null){
			return true;
		}
		return false;
	}

}
?>