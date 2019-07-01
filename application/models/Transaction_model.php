<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_model extends CI_Model
{
	public function getItemTransactions()
	{
		$query = "SELECT user_items.id,  
					users.email AS email,
					items.name AS item_name, 
					item_categories.name AS category_name,
					user_items.cost AS cost,
					user_items.status AS status
				FROM user_items 
					JOIN users 
						ON user_items.user_id = users.id
					JOIN user_details
						ON users.id = user_details.user_id
					JOIN items
						ON user_items.item_id = items.id
					JOIN item_categories
						ON items.category_id = item_categories.id
				ORDER BY user_items.created_at DESC";

		return $this->db->query($query)->result_array();
	}

	public function getTransaction($id)
	{
		$query = "";

		return $this->db->query($query)->result_array();
	}

	public function insertTransaction($data)
	{
		$this->db->insert('user_transactions', $data);
		return $this->db->affected_rows();
	}

	public function updateTransaction($id, $data)
	{ }

	public function deleteTransaction($user_item_id)
	{
		$this->db->delete('user_transactions', ['user_item_id' => $user_item_id]);
		return $this->db->affected_rows();
	}

	public function searchTransaction($keyword)
	{ }
}
