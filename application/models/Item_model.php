<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item_model extends CI_Model
{
	public function getItem($id)
	{
		return $this->db->get_where('items', ['id' => $id])->row_array();
	}

	public function getItems()
	{
		$this->db->select('items.id AS item_id, items.name AS item_name, item_categories.id AS category_id, item_categories.name AS category_name, items.price AS price, items.stock AS stock');
		$this->db->from('items');
		$this->db->join('item_categories', 'items.category_id = item_categories.id');
		return $this->db->get()->result_array();
	}

	public function getUserItems($id)
	{
		return $this->db->get_where('user_items', ['id' => $id])->row_array();
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

	public function searchItems()
	{ }

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
