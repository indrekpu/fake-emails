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
		$queryResultUser = $this->db->simple_query("INSERT INTO user(full_name, email) VALUES($fullName, '$email')");

		
		$id = $this->getUserId($email);
		$queryResultActivation = $this->db->simple_query("INSERT INTO activation(activation_key, user_id, activated) VALUES('$verificationCode', $id, 0)");
		$queryResultPassword = $this->db->simple_query("INSERT INTO passwords(user_id, password) VALUES($id, '$hashed')");

		return $queryResultUser AND $queryResultPassword AND $queryResultActivation;
	}

	public function loginUser($email, $password){
		$email = $this->db->escape($email);
		$password = $this->db->escape_str($password);
		
		$userQuery = $this->db->query("SELECT id, full_name, email FROM user_view WHERE email=$email");
		$userResult = $userQuery->row();

		if(!isset($userResult)){
			return false;
		}

		$passwordQuery = $this->db->query("SELECT password FROM passwords_view WHERE user_id=$userResult->id");
		$passwordResult = $passwordQuery->row();

		if(!isset($passwordResult)){
			return false;
		}

		if(password_verify($password, $passwordResult->password)){
			$this->session->set_userdata('email', $userResult->email);
			$this->session->set_userdata('name', $userResult->full_name);
			$this->session->set_userdata('id', $userResult->id);
			
			return true;
		}
		return false;
	}

	public function addFileToUser($email, $fileName){
		$fileName = $this->db->escape($fileName); //Never trust user input!
		$userId = $this->getUserId($email);
		return $this->db->simple_query("INSERT INTO files(file_name, owner_id) VALUES($fileName, $userId)");
	}

	public function getUserId($email){
		$email = $this->db->escape($email);
		$queryId = $this->db->query("SELECT id FROM user_view WHERE email=$email");
		$idResult = $queryId->row_array();
		return $idResult['id'];
	}

	public function getUserVerificationCode($email){
		$id = $this->getUserId($email);
		$query = $this->db->query("SELECT activation_key FROM activation_view WHERE user_id=$id");
		$result = $query->row();
		return $result->activation_key;
	}

	public function getUserFiles($id){
		$query = $this->db->query("SELECT id, file_name FROM files_view WHERE owner_id=$id");
		$result = $query->result_array();
		return $result;
	}

	//Useless query, project criteria. Used at MyAccount.php.
	public function getUserInfo($id){
		$query = $this->db->query("SELECT full_name, email, birthday, gender, activated, activation_key FROM user INNER JOIN activation ON user.id=activation.user_id WHERE user.id=$id");
		return $query->row_array();
	}

	public function activateUser($verificationCode){
		$verificationCode = $this->db->escape($verificationCode);
		$query = $this->db->query("SELECT activation_key FROM activation_view WHERE activation_key=$verificationCode");//Checking if user with this activation code exitsts.
		$result = $query->row();
		if(isset($result->activation_key)){
			$updateResult = $this->db->simple_query("UPDATE activation SET activated=1 WHERE activation_key=$verificationCode");
			return $updateResult;
		} 
		return false; //User already activated or doesn't exist.
	}

	public function doesUserExist($email){
		$query = $this->db->query("SELECT full_name, email FROM user_view WHERE email='$email'");
		$result = $query->row();
		if($result != null){
			return true;
		}
		return false;
	}

	//TODO refactor to file_handler file.
	public function isUsersFile($userId, $fileId){
		$userId = $this->db->escape_str($userId);
		$fileId = $this->db->escape_str($fileId);
		$query = $this->db->query("SELECT file_name FROM files_view WHERE id=$fileId AND owner_id=$userId");
		$result = $query->row();
		if($result != null){
			return true;
		}
		return false;
	}

	public function getFileName($fileId){
		$fileId = $this->db->escape_str($fileId);
		$query = $this->db->query("SELECT file_name FROM files_view WHERE id=$fileId");
		$result = $query->row();
		return $result->file_name;
	}

	public function removeFileFromDb($fileId){
		$fileId = $this->db->escape_str($fileId);
		$result = $this->db->simple_query("DELETE FROM files WHERE id=$fileId");
		return $result;
	}

}
?>