<?php

class User extends CI_Model
{
	public function createUser($params){
		
	}

	public function getById($id){
		$query = $this->db->query("SELECT ... FROM users WHERE id=$id");
		$data = array();
		foreach($query->result() as $row){
			$row->data1;
			//...
		}
		return $data;
	}
}
?>