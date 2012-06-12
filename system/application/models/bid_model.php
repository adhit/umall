<?php
class Bid_model extends Model {

    function Bid_model()
    {
        parent::Model();
    }
	
	function get_all_bids($userID, $limit, $offset) {
		$this->db->select('um_bid.itemID, name, um_bid.userID, bidID, um_bid.price, qty, approved_qty, partial, approved, um_bid.timeCreated, um_bid.timeEdited');
		$this->db->from('um_bid');
		$this->db->join('um_item', 'um_bid.itemID = um_item.itemID');
		//$this->db->limit(, 3);
		$this->db->where('um_bid.userID', $userID);
		$this->db->order_by("timeCreated", "desc");
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$bidID = $row->bidID;
			$bids[$bidID]["itemID"] = $row->itemID;
			$bids[$bidID]["name"] = $row->name;
			$bids[$bidID]["userID"] = $row->userID;
			$bids[$bidID]["price"] = $row->price;
			$bids[$bidID]["qty"] = $row->qty;
			$bids[$bidID]["approved_qty"] = $row->approved_qty;
			$bids[$bidID]["partial"] = $row->partial;
			$bids[$bidID]["approved"] = $row->approved;
			$bids[$bidID]["timeCreated"] = $row->timeCreated;
			$bids[$bidID]["timeEdited"] = $row->timeEdited;
		}
		return $bids;
	}
}
?>
