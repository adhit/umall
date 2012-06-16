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
	
	function getone($data) {
		$q = $this->get($data);
		//print_r($q);
		if(!$q) return false; 
		else return $q[0];
	}
	
	function get_listing($data) {
		$query="";
		$first=true;
		if(isset($data['plo'])) {
			if(!$first) $query.=" AND ";
			$first=false;
			$query.="price >=".$this->db->escape($data['plo']);
		}
		if(isset($data['phi'])) {
			if(!$first) $query.=" AND ";
			$first=false;
			$query.="price <=".$this->db->escape($data['phi']);
		}
		if(isset($data['tag'])) {
			if(!$first) $query.=" AND ";
			$first=false;
			$query.="(EXISTS(SELECT * FROM um_item_tag AS b WHERE um_item.itemID=b.itemID AND (";
			$tags=explode(" ",$data['tag']);
			$subfirst=true;
			foreach($tags as $tag) {
				$num=intval($tag);
				if(!$subfirst) $query.=" OR ";
				$subfirst=false;
				$query.="tagID=".$this->db->escape($num);
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
				$query.="(name LIKE '%".$this->db->escape_like_str($q)."%')OR(description LIKE '%".$this->db->escape_like_str($q)."%')";
			}
			$query.=")";
		}
		if($first) $query=false;
		return $this->get_custom($query);
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
	}
}
?>