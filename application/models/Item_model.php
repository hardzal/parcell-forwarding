<?php

class Item_model extends CI_Model
{
	public function getItems()
	{ }

	public function getItem()
	{ }

	public function insertItem()
	{ }

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
