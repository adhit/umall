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
}
?>