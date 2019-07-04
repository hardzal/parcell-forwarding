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
						user_items.total,
						user_items.deleted_at AS deadline
			FROM user_items
		JOIN items 
			ON user_items.item_id = items.id
		 WHERE user_items.user_id = $user_id
		 ORDER BY user_items.status ASC";

		return $this->db->query($query)->result_array();
	}

	public function getUserTransactions($user_id)
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
		 WHERE user_items.user_id = $user_id AND user_items.status = 1";

		return $this->db->query($query)->result_array();
	}

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
		$this->db->order_by('user_auctions.price', 'DESC');

		return $this->db->get()->result_array();
	}

	public function getUserAuction($auction_id)
	{
		$query = "SELECT item_auctions.item_id, 
				user_auctions.user_id, 
				user_auctions.price, 
				item_auctions.stock 
			FROM user_auctions 
				JOIN item_auctions ON user_auctions.auction_id = item_auctions.id 
				JOIN items ON items.id = item_auctions.item_id 
			WHERE user_auctions.auction_id = " . $auction_id . " AND user_auctions.status = 1";

		return $this->db->query($query)->row_array();
	}

	public function getTotalTransaction($user_id)
	{
		$query = "SELECT COUNT(*) AS total_transaction FROM user_items WHERE status = 1 AND user_id = $user_id";

		return $this->db->query($query)->row_array();
	}

	public function getTotalCost($user_id)
	{
		$query = "SELECT SUM(cost) AS total_cost FROM user_items WHERE status = 1 AND user_id = $user_id";

		return $this->db->query($query)->row_array();
	}

	public function getTotalUser()
	{
		$query = "SELECT COUNT(*) AS total_user FROM users WHERE role_id = 2";

		return $this->db->query($query)->row_array();
	}

	public function insertUserAuction($data)
	{
		$this->db->insert('user_auctions', $data);
		return $this->db->affected_rows();
	}
}
