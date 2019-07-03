<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auction_model extends CI_Model
{
	public function getAuctions()
	{
		$query = "SELECT item_auctions.id, 
				items.name AS item_name, 
				item_categories.name AS item_category, 
				item_auctions.price, 
				item_auctions.stock, 
				item_auctions.status, 
				item_auctions.deleted_at AS deadline
			FROM item_auctions
			LEFT JOIN items ON item_auctions.item_id = items.id
			LEFT JOIN item_categories ON items.category_id = item_categories.id
			";

		return $this->db->query($query)->result_array();
	}

	public function getAuction()
	{ }

	public function insertAuction()
	{ }

	public function updateAuction()
	{ }

	public function deleteAuction()
	{ }

	public function getUserAuctions($user_id)
	{
		$query = "SELECT user_auctions.id,
					items.name, 
					user_auctions.price,
					user_auctions.status
				FROM user_auctions
					JOIN item_auctions ON user_auctions.auction_id = item_auctions.id
					JOIN items ON item_auctions.item_id = items.id
				WHERE user_auctions.user_id = $user_id";

		return $this->db->query($query)->result_array();
	}
}
