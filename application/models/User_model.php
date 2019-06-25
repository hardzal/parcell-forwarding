<?php

class User_model extends CI_Model
{
	public function getDataUsers()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('user_details', 'users.id = user_details.user_id');

		return $this->db->get()->result_array();
	}

	public function getDataUser($email)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('user_details', 'users.id = user_details.user_id');
		$this->db->where('email', $email);

		return $this->db->get()->row_array();
	}

	public function getUserDetail($id)
	{
		return $this->db->get_where('user_details', ['user_id' => $id])->row_array();
	}

	public function updateUser($user, $user_id)
	{
		$this->db->update('user_details', $user, ['user_id' => $user_id]);
		return $this->db->affected_rows();
	}

	public function deleteUser()
	{ }

	public function searchUser()
	{ }

	public function updatePasswordUser($password, $email)
	{
		$this->db->update('users', ['password' => $password], ['email' => $email]);
		return $this->db->affected_rows();
	}
}
