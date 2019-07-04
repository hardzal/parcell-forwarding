<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auction_model extends CI_Model
{
	public function getAuctions($limit, $offset = 0, $keyword = null)
	{
		$query = "SELECT item_auctions.id, 
				items.name AS item_name, 
				item_auctions.price, 
				item_auctions.status, 
				item_auctions.deleted_at AS deadline
			FROM item_auctions
			LEFT JOIN items ON item_auctions.item_id = items.id
			WHERE items.name LIKE '%$keyword%' 
			ORDER BY item_auctions.status DESC
			LIMIT $offset, $limit";

		return $this->db->query($query)->result_array();
	}

	public function getAuction($item_auction_id)
	{
		$query = "SELECT item_auctions.id,  
				item_auctions.item_id,
				items.name AS item_name, 
				item_auctions.price,
				item_auctions.stock,
				item_auctions.status, 
				item_auctions.deleted_at AS deadline
			FROM item_auctions
				LEFT JOIN items ON item_auctions.item_id = items.id
			WHERE item_auctions.id = " . $item_auction_id;

		return $this->db->query($query)->row_array();
	}

	public function insertAuction($data)
	{ }

	public function updateAuction($data, $where)
	{
		$this->db->update('item_auctions', $data, $where);
		return $this->db->affected_rows();
	}

	public function deleteAuction($auction_id)
	{
		$this->db->delete('item_auctions', ['id' => $auction_id]);
		return $this->db->affected_rows();
	}

	public function getUserAuctions($user_id)
	{
		$query = "SELECT user_auctions.id,
					user_auctions.auction_id,
					items.name, 
					user_auctions.price,
					user_auctions.status,
					item_auctions.deleted_at AS deadline
				FROM user_auctions
					JOIN item_auctions ON user_auctions.auction_id = item_auctions.id
					JOIN items ON item_auctions.item_id = items.id
				WHERE user_auctions.user_id = $user_id";

		return $this->db->query($query)->result_array();
	}
}
