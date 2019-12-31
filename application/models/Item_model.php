<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item_model extends CI_Model
{
	public function getItem($id)
	{
		return $this->db->get_where('items', ['id' => $id])->row_array();
	}

	public function getItems($limit, $offset, $keyword = null)
	{
		$this->db->select('items.id AS item_id, items.name AS item_name, item_categories.id AS category_id, item_categories.name AS category_name, items.price AS price, items.stock AS stock');
		$this->db->from('items');
		$this->db->join('item_categories', 'items.category_id = item_categories.id');
		$this->db->offset($offset);
		$this->db->limit($limit);
		if ($keyword) {
			$this->db->like('items.name', $keyword);
			$this->db->or_like('item_categories.name', $keyword);
		}
		return $this->db->get()->result_array();
	}

	public function getDetailItems($id = null)
	{
		$this->db->select('items.*, item_categories.name as category_name');
		$this->db->from('items');
		$this->db->join('item_categories', 'items.category_id = item_categories.id');

		if ($id != null) {
			$this->db->where('items.id', $id);
			return $this->db->get()->row_array();
		}

		return $this->db->get()->result_array();
	}

	public function getTotalItems()
	{
		return $this->db->get('items')->num_rows();
	}

	public function getUserItems($user_id)
	{
		return $this->db
			->select('user_items.*, items.name as item_name, items.price as cost_price, items.category_id, items.weight, item_categories.name as category_name')
			->from('user_items')
			->join('items', 'user_items.item_id = items.id')
			->join('item_categories', 'items.category_id = item_categories.id')
			->where('user_id', $user_id)
			->get()
			->result_array();
	}

	public function getUserItem($id)
	{
		return $this->db
			->select('user_items.*, items.name as item_name, items.price as cost_price, items.category_id, items.weight, item_categories.name as category_name')
			->from('user_items')
			->join('items', 'user_items.item_id = items.id')
			->join('item_categories', 'items.category_id = item_categories.id')
			->where('user_items.id', $id)
			->get()
			->row_array();
	}

	public function insertItem($data)
	{
		$this->db->insert('items', $data);
		return $this->db->affected_rows();
	}

	public function getItemByName($name)
	{
		return $this->db->get_where('items', ['name' => $name])->row_array();
	}

	public function updateItem($id, $data)
	{
		$this->db->update('items', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function deleteItem($id)
	{
		$this->db->delete('items', ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function getItemCategories()
	{
		return $this->db->get('item_categories')->result_array();
	}

	public function getItemCategory($id)
	{
		return $this->db->get_where('item_categories', ['id' => $id])->row_array();
	}

	public function insertUserItem($data)
	{
		$this->db->insert('user_items', $data);
		return $this->db->affected_rows();
	}
}
