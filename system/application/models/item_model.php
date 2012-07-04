<?php
class Item_model extends Model {

    function Item_model()
    {
        parent::Model();
    }
	
	function get($data) {
		$this->db->from('um_item')->where($data);
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function get_custom($query) {
		$this->db->from('um_item');
		if($query) $this->db->where($query);
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function insert($item) {
		$this->db->insert('um_item',$item);
	}
	
	function update($old,$new) {
		$this->db->where($old);
		$this->db->update('um_item', $new);
	}
	
	function getone($data) {
		$q = $this->get($data);
		//print_r($q);
		if(!$q) return false; 
		else return $q[0];
	}
	
	function get_items_posted($userID) {
		$full_q="SELECT a.*,SUM(CASE WHEN b.approved='yes' THEN 1 ELSE 0 END) AS acc_bids,SUM(CASE WHEN b.approved='no' THEN 1 ELSE 0 END) AS pen_bids,SUM(CASE WHEN b.approved='rejected' THEN 1 ELSE 0 END) AS rej_bids,SUM(CASE WHEN b.bidID IS NULL THEN 0 ELSE 1 END) AS num_bids, MAX(CASE WHEN b.approved='no' THEN b.price ELSE 0 END) AS highest ";
		$full_q.="FROM um_item AS a LEFT JOIN um_bid as b ON (a.itemID=b.itemID) WHERE a.enabled!='deleted' AND a.userID = ".$this->db->escape($userID);
		$full_q.=" GROUP BY a.itemID ORDER BY a.timeCreated DESC";
		
		$result=$this->db->query($full_q);
		if($result->num_rows()==0) return false;
		return $result->result_array();
	}
	function get_items_bid($userID) {
		$full_q="SELECT e.*,f.username AS username,f.name AS fullname,f.email AS email,f.contactNumber AS phone from";
		$full_q.="(SELECT c.*,d.bidID,d.price AS bidPrice,d.approved,d.timeEdited AS timeLatest FROM ";
		$full_q.="(SELECT a.*,SUM(CASE WHEN b.approved='yes' THEN 1 ELSE 0 END) AS acc_bids,SUM(CASE WHEN b.approved='no' THEN 1 ELSE 0 END) AS pen_bids,SUM(CASE WHEN b.approved='rejected' THEN 1 ELSE 0 END) AS rej_bids,SUM(CASE WHEN b.bidID IS NULL THEN 0 ELSE 1 END) AS num_bids, MAX(CASE WHEN b.approved='no' THEN b.price ELSE 0 END) AS highest ";
		$full_q.="FROM um_item AS a LEFT JOIN um_bid AS b ON (a.itemID=b.itemID) WHERE a.enabled!='deleted' GROUP BY a.itemID ORDER BY a.timeCreated DESC) ";
		$full_q.="AS c LEFT JOIN um_bid AS d ON(c.itemID=d.itemID) WHERE d.userID = ".$this->db->escape($userID).") ";
		$full_q.="AS e LEFT JOIN um_user AS f ON(e.userID=f.userID) ORDER BY timeLatest DESC";
		
		$result=$this->db->query($full_q);
		if($result->num_rows()==0) return false;
		return $result->result_array();
	}
	
	function get_listing($data) {
		$full_q="SELECT a.*,SUM(CASE WHEN b.approved='yes' THEN 1 ELSE 0 END) AS acc_bids,SUM(CASE WHEN b.approved='no' THEN 1 ELSE 0 END) AS pen_bids,SUM(CASE WHEN b.approved='rejected' THEN 1 ELSE 0 END) AS rej_bids,SUM(CASE WHEN b.bidID IS NULL THEN 0 ELSE 1 END) AS num_bids, MAX(CASE WHEN b.approved='no' THEN b.price ELSE 0 END) AS highest ";
		$full_q.="FROM um_item AS a LEFT JOIN um_bid as b ON (a.itemID=b.itemID) WHERE a.enabled='yes' AND a.expiryDate>DATE_ADD(NOW(),INTERVAL 1 MINUTE) AND EXISTS(SELECT * FROM um_user AS z WHERE z.userID=a.userID AND z.enabled='yes')";
		$query="";
		$first=false;
		if(isset($data['plo'])) {
			if(!$first) $query.=" AND ";
			$first=false;
			$query.="a.price >=".$this->db->escape($data['plo']);
		}
		if(isset($data['phi'])) {
			if(!$first) $query.=" AND ";
			$first=false;
			$query.="a.price <=".$this->db->escape($data['phi']);
		}
		if(isset($data['tag'])) {
			if(!$first) $query.=" AND ";
			$first=false;
			$query.="(EXISTS(SELECT * FROM um_item_tag AS c WHERE a.itemID=c.itemID AND (";
			$tags=explode(" ",$data['tag']);
			$subfirst=true;
			foreach($tags as $tag) {
				$num=intval($tag);
				if(!$subfirst) $query.=" OR ";
				$subfirst=false;
				$query.="c.tagID=".$this->db->escape($num);
			}
			$query.=")))";
		}
		if(isset($data['q'])) {
			if(!$first) $query.=" AND ";
			$first=false;
			$query.="(";
			$qs=explode(" ",$data['q']);
			$subfirst=true;
			foreach($qs as $q) {
				if(!$subfirst) $query.=" OR ";	
				$subfirst=false;
				$query.="(a.name LIKE '%".$this->db->escape_like_str($q)."%')OR(a.description LIKE '%".$this->db->escape_like_str($q)."%')";
			}
			$query.=")";
		}
		if(!$first) $full_q.=$query;
		$full_q.=" GROUP BY a.itemID";
		//echo $full_q;
		$result=$this->db->query($full_q);
		if($result->num_rows()==0) return false;
		return $result->result_array();
	}
	
	function get_all_items($userID, $limit, $offset) {
		$this->db->order_by("timeCreated", "desc");
		$query = $this->db->get_where('um_item', array('userID' => $userID), $limit, $offset);
		foreach ($query->result() as $row)
		{
			$itemID = $row->itemID;
			$items[$itemID]["itemID"] = $row->itemID;
			$items[$itemID]["name"] = $row->name;
			$items[$itemID]["price"] = $row->price;
			$items[$itemID]["quantity"] = $row->quantity;
			$items[$itemID]["timeCreated"] = $row->timeCreated;
			$items[$itemID]["timeEdited"] = $row->timeEdited;
		}
		return $items;
	}
	
	function get_all_tags() {
		$this->db->from('um_tag');
		$this->db->order_by('tagname','asc');
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function insert_item_tag($data) {
		$this->db->insert('um_item_tag',$data);
	}
	
	function post_item($item,$tags) {
		$this->db->trans_start();
		$this->insert($item);
		$temp=$this->getone($item);
		if($temp) {
			foreach($tags as $tagID) $this->insert_item_tag(array('itemID'=>$temp['itemID'],'tagID'=>$tagID));
		}
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE) return false;
		if($temp) return $temp;
		else return false;
	}
	
	function edit_item($old,$item,$tags) {
		$this->db->trans_start();
		$this->db->where($old);
		$this->db->update('um_item', $item);
		$temp=$this->getone($old);
		if($temp) {
			$this->db->delete('um_item_tag', array('itemID' => $temp['itemID'])); 
			foreach($tags as $tagID) $this->insert_item_tag(array('itemID'=>$temp['itemID'],'tagID'=>$tagID));
		}
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE) return false;
		if($temp) return $temp;
		else return false;
	}
	
	function get_tags($data) {
		$this->db->from('um_tag')->join('um_item_tag','um_tag.tagID = um_item_tag.tagID')->where($data);
		$this->db->order_by('tagname','asc');
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function get_tags_where($data) {
		$this->db->from('um_item_tag');
		$this->db->where($data);
		//$this->db->order_by('tagname','asc');
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function get_top4_mostbid() {
		$q="SELECT a.*,SUM(CASE WHEN b.approved='yes' THEN 1 ELSE 0 END) as score,SUM(1) as score1 FROM um_item AS a LEFT JOIN um_bid AS b ON (a.itemID=b.itemID) WHERE a.enabled='yes' AND a.expiryDate>DATE_ADD(NOW(),INTERVAL 1 MINUTE) AND EXISTS(SELECT * FROM um_user AS z WHERE z.userID=a.userID AND z.enabled='yes') GROUP BY a.itemID ORDER BY score DESC, score1 DESC LIMIT 0,4";
		$result=$this->db->query($q);
		if($result->num_rows()==0) return false;
		else return $result->result_array();
	}
	
	function get_top4_newest() {
		$q="SELECT a.*,a.timeCreated as score FROM um_item AS a WHERE a.enabled='yes' AND a.expiryDate>DATE_ADD(NOW(),INTERVAL 1 MINUTE) AND EXISTS(SELECT * FROM um_user AS z WHERE z.userID=a.userID AND z.enabled='yes') GROUP BY a.itemID ORDER BY score DESC LIMIT 0,4";
		$result=$this->db->query($q);
		if($result->num_rows()==0) return false;
		else return $result->result_array();
	}
	
	function get_top4_barely() {
		$q="SELECT a.*,a.expiryDate as score FROM um_item AS a WHERE a.enabled='yes' AND a.expiryDate>DATE_ADD(NOW(),INTERVAL 1 MINUTE) AND EXISTS(SELECT * FROM um_user AS z WHERE z.userID=a.userID AND z.enabled='yes') GROUP BY a.itemID ORDER BY score ASC LIMIT 0,4";
		$result=$this->db->query($q);
		if($result->num_rows()==0) return false;
		else return $result->result_array();
	}
	
	function is_user_disabled($item) {
		$this->db->from('um_user');
		if(!$item) return false;
		$this->db->where(array("userID"=>$item['userID'],"enabled"=>"yes"));
		$result=$this->db->get();
		if($result->num_rows()==0) return true;
		else return false;
	}
}
?>