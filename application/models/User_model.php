<?php

class User_model extends CI_Model
{
	public function getUserDetail($id)
	{
		return $this->db->get_where('user_details', ['user_id' => $id])->row_array();
	}

	public function updateUser()
	{ }

	public function deleteUser()
	{ }

	public function searchUser()
	{ }
}
