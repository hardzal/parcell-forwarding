<?php

class Item_model extends CI_Model
{
	public function getItem($id)
	{
		return $this->db->get_where('items', ['id' => $id])->row_array();
	}

	public function getItems()
	{
		return $this->db->get('items')->result_array();
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

	public function updateItem()
	{ }

	public function deleteItem()
	{ }

	public function searchItems()
	{ }

	public function getItemCategories()
	{
		return $this->db->get('item_categories')->result_array();
	}
}
