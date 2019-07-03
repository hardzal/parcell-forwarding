<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

	public function getUserDetail($user_id)
	{
		return $this->db->get_where('user_details', ['user_id' => $user_id])->row_array();
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

	public function updateUserItems($data, $where)
	{
		$this->db->update('user_items', $data, $where);
		return $this->db->affected_rows();
	}

	public function getUserItems($user_id)
	{
		$query = "SELECT items.id AS id_item, 
						items.name AS item_name, 
						user_items.id AS user_item_id, 
						user_items.cost, 
						user_items.item_code,
						user_items.total 
			FROM user_items
		JOIN items 
			ON user_items.item_id = items.id
		 WHERE user_items.user_id = $user_id";

		return $this->db->query($query)->result_array();
	}

	public function getUserTransactions($user_id)
	{ }

	public function getUserTransaction($user_item_id)
	{
		$this->db->select('*');
		$this->db->from('user_transactions');
		$this->db->where('user_item_id', $user_item_id);

		return $this->db->get()->row_array();
	}

	public function getUserAuctions($auction_id)
	{
		$this->db->select('*');
		$this->db->from('user_auctions');
		$this->db->join('users', 'users.id = user_auctions.user_id');
		$this->db->join('user_details', 'user_details.user_id = users.id');
		$this->db->where('auction_id', $auction_id);

		return $this->db->get()->result_array();
	}

	public function insertUserAuction($data)
	{
		$this->db->insert('user_auctions', $data);
		return $this->db->affected_rows();
	}
}
