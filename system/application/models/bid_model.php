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
		$this->db->limit($limit, $offset);
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
	
	function get($data) {
		$this->db->from('um_bid')->where($data);
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function get_custom($query) {
		$this->db->from('um_bid');
		if($query) $this->db->where($query);
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function insert($data) {
		$this->db->insert('um_bid',$data);
	}
	
	function update($old,$new) {
		$this->db->where($old);
		$this->db->update('um_bid', $new);
	}
	
	function getone($data) {
		$q = $this->get($data);
		//print_r($q);
		if(!$q) return false; 
		else return $q[0];
	}
	
	function get_bid_join_user($data) {
		$this->db->from('um_bid')->join('um_user','um_bid.userID = um_user.userID')->where($data);
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function getone_bid_join_user($data) {
		$q = $this->get_bid_join_user($data);
		//print_r($q);
		if(!$q) return false; 
		else return $q[0];
	}
	
	function get_bid_join_item($data) {
		$this->db->from('um_bid')->join('um_item','um_bid.itemID = um_item.itemID')->where($data);
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function getone_bid_join_item($data) {
		$q = $this->get_bid_join_item($data);
		//print_r($q);
		if(!$q) return false; 
		else return $q[0];
	}
	
	function accept($bid,$item) {
		$timestamp=time();
		$datetime=date("Y-m-d H:m:s",$timestamp);
		$newbid=$bid;
		$newbid['approved']='yes';
		$newbid['approved_qty']=$bid['qty'];
		$newbid['timeEdited']=$datetime;
		$this->db->where($bid);
		$this->db->update('um_bid', $newbid);
	}
}
?>
