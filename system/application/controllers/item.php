<?php

class Item extends Controller {
	function Item() {
		parent::Controller();	
	}
	
	function index() {
		redirect(site_url()."/item/listing");
	}
	
	function listing() {
		/*
			INPUT URI
			plo/7				minimum price
			phi/20				maximum price
			tag/2 4 7			tagIDs
			search/pro legend	search terms
			page/3				page to show
			each/5				num of items per page
			sort/criterion		sorting criterion, can be match, pasc, pdesc, oldtonew, newtoold
			
			OUTPUT
			in_data: all the uri parameters plus page&each (if not already in url), and maxpage
			items: 'each' number of item records for that particular page
		*/
	
		$param=$this->uri->uri_to_assoc(3);
		if(!$param) $param=array();
		$this->load->model("Item_model");
		$temp=$this->Item_model->get_listing($param);
		$temp=$this->_sort_listing($temp,$param);
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
				foreach($qs as $q) {
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
	
	function post() {
		//Opening Begin-------
		$data=array();
		//Checking logged status
		if(!$this->session->userdata("user")) {
			$this->session->set_flashdata('in_data',array('msg'=>array('home_error'=>"Please sign in to post item")));
			redirect(site_url()."/home");
		}
		//Setting user data
		if($this->session->userdata("user")) {
			$user=$this->session->userdata("user");
			$data['user']=$user;
		}
		//Setting message data
		$msg=array();
		$in_data=array();
		if($this->session->flashdata('in_data')) {
			$data['in_data']=$this->session->flashdata('in_data');
			$msg=$data['in_data']['msg'];
			$in_data=$data['in_data'];
		}
		//Loading tags
		$this->load->model("Item_model");
		$data['initial_tags']=$this->Item_model->get_all_tags();
		//Checking if first time
		if(!$this->input->post('filled')) {
			$this->load->view('post_view',$data);
			return;
		}
		//Opening End-------
		
		$timestamp=time();
		$name=$this->input->post('name');
		$quantity=$this->input->post('quantity');
		$price=$this->input->post('price');
		$exp=$this->input->post('exp');
		$expiryDate=date("Y-m-d H:m:s",$timestamp+intval($exp)*24*60*60);
		$description=$this->input->post('description');
		$agree=$this->input->post('agree');
		$type=$this->input->post('type');
		$default=$this->input->post('default');
		$image="default.png";
		$tags=$this->input->post('tags');
		$valid=true;
		
		//form validations
		//check name
		if(!$name||strlen($name)==0) {
			$msg["name_error"]="Item's name field cannot be empty";
			$valid=false;
		}
		//check quantity
		if(strval(intval($quantity))!=strval($quantity)) {
			$msg["quantity_error"]="Quantity must be a whole number";
			$valid=false;
		}
		//check price
		if(strval(intval($price))!=strval($price)) {
			$msg["price_error"]="Price must be multiple of $1";
			$valid=false;
		}
		//check terms read
		if(!$agree) {
			$msg["agree_error"]="Please read and agree with the terms and conditions before continuing";
			$valid=false;
		}
		//File uploading
		if(!$default) {
			$config['upload_path'] = FILE_URL;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '512';
			// $config['max_width']  = '1024';
			// $config['max_height']  = '768';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('image')) {
				//print_r($this->upload->data());
				$msg["image_error"]=$this->upload->display_errors();
				$valid=false;
			}
			else {
				$temp=$this->upload->data();
				$image=$temp['file_name'];
			}
		}
		
		if($valid) {
			$datetime=date("Y-m-d H:m:s",$timestamp);
			$insert_data=array(
							'userID' => $user['userID'],
							'name' => $name,
							'price' => $price,
							'description' => $description,
							'enabled' => 'yes',
							'quantity' => $quantity,
							'image' => $image,
							'type' => $type,
							'expiryDate' => $expiryDate,
							'timeCreated' => $datetime,
							'timeEdited' => $datetime );
			$temp=$this->Item_model->post_item($insert_data,$tags);
			if(!$temp) {
				$msg["post_error"]="Database error. Please try again";
				$valid=false;
			}
			else { //valid
				$msg["post_success"]="The item has been successfully posted, itemID=".$temp['itemID'];
				$this->session->set_flashdata('in_data',array('msg'=>$msg));
				redirect(site_url()."/item/post");
			}
		}
		if(!$valid) {
			$data["in_data"]["msg"]=$msg;
			$this->load->view('post_view',$data);
		}
	}

	/*
	function view($itemID) {
		//Opening Begin-------
		$data=array();
		//Checking logged status
		//Setting user data
		if($this->session->userdata("user")) {
			$user=$this->session->userdata("user");
			$data['user']=$user;
		}
		//Setting message data
		$msg=array();
		$in_data=array();
		if($this->session->flashdata('in_data')) {
			$data['in_data']=$this->session->flashdata('in_data');
			$msg=$data['in_data']['msg'];
			$in_data=$data['in_data'];
		}
		//Checking if first time
		if(!$this->input->post('filled')) {
			//$this->load->view('post_view',$data);
			return;
		}
		//Opening End-------
	
	}
	*/
}
?>