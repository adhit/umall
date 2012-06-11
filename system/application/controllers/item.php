<?php

class Item extends Controller {
	function Item() {
		parent::Controller();	
	}
	
	function index() {
		redirect(site_url()."/item/listing");
	}
	
	function listing() {
		$param=$this->uri->uri_to_assoc(3);
		if(!$param) $param=array();
		//else print_r($param);
		$this->load->model("Item_model");
		$temp=$this->Item_model->get_listing($param);
		$temp=$this->_sort_listing($temp,$param);
		//print_r($temp);
		$data["in_data"]=$param;
		$page=1; $each=5;
		if(isset($param['each'])) $each=$param['each'];
		if(isset($param['page'])) $page=$param['page'];
		$page=min($page,ceil(1.00*count($temp)/(1.00*$each)));
		$data["in_data"]["page"]=$page; $data["in_data"]["each"]=$each;
		$data["in_data"]["maxpage"]=intval(ceil(1.00*count($temp)/(1.00*$each)));
		$data["items"]=array_slice($temp,($page-1)*$each,$each);
		$this->load->view("listing_view",$data);
	}
	
	function _sort_listing($list,$param) {
		foreach($list as &$a) $a['score']=0;
		if(!isset($param['sort'])||$param['sort']=="match") {
			if(isset($param['q'])) $qs=explode(" ",$param['q']);
			else $qs=array();
			foreach($list as &$a) {
				//echo 'a: '; echo strtolower($a['name']." ".$a['description']); echo '<br/>';
				foreach($qs as $q) {
					//echo '    q,match: '.$q.' '.substr_count(strtolower($a['name']." ".$a['description']),strtolower($q)).'<br/>';
					$a['score']-=substr_count(strtolower($a['name']." ".$a['description']),strtolower($q));
				}
			}
		}
		else if($param['sort']=="pasc") {
			foreach($list as &$a) $a['score']=$a['price'];
		}
		else if($param['sort']=="pdesc") {
			foreach($list as &$a) $a['score']=-1.00*($a['price']);
		}
		else if($param['sort']=="oldtonew") {
			foreach($list as &$a) $a['score']=strtotime($a['timeCreated']);
		}
		else if($param['sort']=="newtoold") {
			foreach($list as &$a) $a['score']=-1*strtotime($a['timeCreated']);
		}
		usort($list,function($a,$b) {
			if($a['score']<$b['score']) return -1;
			else if($a['score']>$b['score']) return 1;
			else return 0;
		});
		return $list;
	}
}

?>