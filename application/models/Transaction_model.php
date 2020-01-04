<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_model extends CI_Model
{
	public function getItemTransactions($limit, $offset, $keyword = 0)
	{
		$query = "SELECT user_transactions.*,
					user_items.id AS user_item_id,  
					users.email AS email,
					items.name AS item_name,
					user_items.item_code, 
					item_categories.name AS category_name,
					user_items.cost_total
				FROM user_items 
					JOIN users 
						ON user_items.user_id = users.id
					JOIN user_details
						ON users.id = user_details.user_id
					JOIN items
						ON user_items.item_id = items.id
					JOIN item_categories
						ON items.category_id = item_categories.id
					LEFT JOIN user_transactions
						ON user_items.id = user_transactions.user_item_id
				WHERE items.name LIKE '%$keyword%' OR user_items.item_code LIKE '%$keyword%'
				ORDER BY user_transactions.user_item_id IS NULL, 
					user_items.created_at DESC
				LIMIT $offset, $limit";

		return $this->db->query($query)->result_array();
	}

	public function getTransaction($user_item_id)
	{
		return $this->db->get_where('user_transactions', ['user_item_id' => $user_item_id])->row_array();
	}

	public function insertTransaction($data)
	{
		$this->db->insert('user_transactions', $data);
		return $this->db->affected_rows();
	}

	public function updateTransaction($where, $data)
	{
		$this->db->update('user_transactions', $data, $where);
		return $this->db->affected_rows();
	}

	public function deleteTransaction($user_item_id)
	{
		$this->db->delete('user_transactions', ['user_item_id' => $user_item_id]);
		return $this->db->affected_rows();
	}

	public function getTransactions($user_id = null)
	{
		$transactions = $this->db
			->select('user_transactions.*, user_items.item_code, user_items.total, user_items.cost_delivery, user_items.cost_tax, user_items.cost_total, , items.name as item_name, items.price as cost_price, items.category_id, items.weight, item_categories.name as category_name')
			->from('user_transactions')
			->join('user_items', 'user_transactions.user_item_id = user_items.id')
			->join('items', 'user_items.item_id = items.id')
			->join('item_categories', 'items.category_id = item_categories.id')
			->where('user_transactions.status', 1);

		if ($user_id != null) {
			$transactions = $transactions
				->where('user_items.user_id', $user_id);
		}

		return 	$transactions->get()->result_array();
	}

	public function getDetailTransaction($id)
	{
		return $this->db
			->select('user_transactions.*,user_items.item_code, user_items.total, user_items.cost_delivery, user_items.cost_tax, user_items.cost_total, , items.name as item_name, items.price as cost_price, user_items.address_to, items.category_id, items.weight, item_categories.name as category_name')
			->from('user_transactions')
			->join('user_items', 'user_transactions.user_item_id = user_items.id')
			->join('items', 'user_items.item_id = items.id')
			->join('item_categories', 'items.category_id = item_categories.id')
			->where('user_transactions.status', 1)
			->where('user_transactions.id', $id)
			->get()
			->row_array();
	}

	public function getTotalCost()
	{
		$query = "SELECT SUM(cost_total) AS total_cost FROM user_items WHERE status = 1";

		return $this->db->query($query)->row_array();
	}

	public function getTotalTransaction()
	{
		$query = "SELECT COUNT(*) AS total_transaction FROM user_items WHERE status = 1";

		return $this->db->query($query)->row_array();
	}
}
