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
		//Opening End-------
		
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

	function view($itemID) {
		/*
			INPUT URI
			itemID				the ID of the item
			
			INPUT FLASHDATA
			in_data
				form<array>: the value of inputs
				msg<array>: the error and success messages
			
			OUTPUT
			status: no_item, success, or expired. If no_item, show error message saying item not found and link to item/listing. If expired, disable bidder to put new or change his bid
			itemID: the ID of the item
			type: The type of the item, bid or fixed
			role: 	guest, seller or bidder. If guest, don't show the bid table and put message telling to login or register
					If seller and type is bid, show the seller's bidding table, with each row having 'accept' link, and [fullname,phone,email] that will only appear if the bid has been accepted. Also show a button to edit the item, linking to item/edit/itemID
					If bidder and type is bid, show the bidder's bidding table, and a UI to put in or change his bid
			item: a record of this particular item
			tags: array of records of tag for this item
			bids: existing bids towards this item
			my_bid: current personal bid towards this item
			crnt: the current URI segments
		*/
		
		//Opening Begin-------
		$data=array();
		//Checking logged status
		//Setting user data
		if($this->session->userdata("user")) {
			$user=$this->session->userdata("user");
			$data['user']=$user;
		}
		//Setting message data
		if($this->session->flashdata('in_data')) {
			$data['in_data']=$this->session->flashdata('in_data');
		}
		//Checking if first time
		//Opening End-------
		
		if(!$itemID) $data["status"]="no_item";
		else {
			$data['crnt']="/item/view/".$itemID;
			$this->load->model('Item_model');
			$this->load->model('Bid_model');
			$item=$this->Item_model->getone(array('itemID'=>$itemID));
			if(!$item) $data["status"]="no_item";
			else if($item['enabled']!='yes') $data["status"]="no_item";
			else {
				$tags=$this->Item_model->get_tags(array('itemID'=>$itemID));
				$bids=$this->Bid_model->get_bid_join_user(array('itemID'=>$itemID));
				if(isset($user)&&$user) $my_bid=$this->Bid_model->getone_bid_join_user(array('itemID'=>$itemID,'um_user.userID'=>$user['userID']));
				else $my_bid=false;
				if(!isset($user)||!$user) $data['role']='guest';
				else if($user['userID']==$item['userID']) $data['role']='seller';
				else $data['role']='bidder';
						
				if($bids) usort($bids,function($a,$b) {
					if($a['price']<$b['price']) return 1;
					else if($a['price']>$b['price']) return -1;
					else return 0;
				});
				
				$data['itemID']=$itemID;
				$data['type']=$item['type'];
				$data['status']='success';
				if(strtotime($item['expiryDate'])<time()) $data['status']='expired';
				$data['item']=$item;
				$data['tags']=$tags;
				$data['bids']=$bids;
				$data['my_bid']=$my_bid;
			}
		}
		
		$this->load->view('view_view',$data);
		
		// echo 'item: ';
		// print_r($item);
		// echo '<br/><br/>tags: ';
		// print_r($tags);
		// echo '<br/><br/>bids: ';
		// print_r($bids);
		// echo '<br/><br/>my_bid: ';
		// print_r($my_bid);
	}
	
	function bid() {
		//Opening Begin-------
		if(!$this->input->post('prev')) {
			redirect();
		}
		$in_data=array();
		//Checking logged status
		if(!$this->session->userdata("user")) {
			$in_data['msg']['bid_error']="Please sign in to bid";
			$in_data['form']=$_POST;
			$this->session->set_flashdata('in_data',$in_data);
			redirect(site_url().$in_data['form']['prev']);
		}
		//Setting user data
		if($this->session->userdata("user")) {
			$user=$this->session->userdata("user");
			$data['user']=$user;
		}
		//Opening End-------
		
		$qty=$this->input->post('qty');
		$price=$this->input->post('price');
		$partial=$this->input->post('partial');
		$itemID=$this->input->post('itemID');
		$userID=$user['userID'];
		$timestamp=time();
		$datetime=date("Y-m-d H:m:s",$timestamp);
		$valid=true;
		
		//Form validation
		//check quantity
		if(strval(intval($qty))!=strval($qty)) {
			$in_data['msg']["qty_error"]="Quantity must be a whole number";
			$valid=false;
		}
		//check price
		if(strval(intval($price))!=strval($price)) {
			$in_data['msg']["price_error"]="Price must be multiple of $1";
			$valid=false;
		}
		
		if($valid) {
			$this->load->model('Bid_model');
			$existing=$this->Bid_model->getone(array('userID'=>$userID,'itemID'=>$itemID));
			if(!$existing) {
				$insert_data=array('qty'=>$qty,'price'=>$price,'partial'=>$partial,'userID'=>$userID,'itemID'=>$itemID,'timeEdited'=>$datetime,'timeCreated'=>$datetime);
				$this->Bid_model->insert($insert_data);
				$in_data['msg']['bid_success']="Your bid has been posted";
			}
			else if($existing['approved']=='yes') {
				$valid=false;
				$in_data['msg']['bid_error']="Your bid has been accepted before, you can't change your bid";
			}
			else {
				$insert_data=array('qty'=>$qty,'price'=>$price,'partial'=>$partial,'userID'=>$userID,'itemID'=>$itemID,'timeEdited'=>$datetime);
				$this->Bid_model->update($existing,$insert_data);
				$in_data['msg']['bid_success']="Your bid has been changed";
			}
		}
		if(!$valid) $in_data['form']=$_POST;
		$this->session->set_flashdata('in_data',$in_data);
		//print_r($in_data);
		redirect(site_url().$this->input->post('prev'));
	}
	
	function accept($bidID) {
		//Opening Begin-------
		$in_data=array();
		if(!$bidID) {
			$in_data['error']="BidID not found.";
			$this->load->view('error_view',$in_data);
			return;
		}
		//Getting the bid
		$this->load->model('Bid_model');
		$this->load->model('Item_model');
		$this->load->model('User_model');
		$bid=$this->Bid_model->getone(array('bidID'=>$bidID));
		if(!$bid) {
			$in_data['error']="BidID not found.";
			$this->load->view('error_view',$in_data);
			return;
		}
		$item=$this->Item_model->getone(array('itemID'=>$bid['itemID']));
		if(!$item) {
			$in_data['error']="ItemID not found.";
			$this->load->view('error_view',$in_data);
			return;
		}
		$seller=$this->User_model->getone(array('userID'=>$item['userID']));
		$bidder=$this->User_model->getone(array('userID'=>$bid['userID']));
		if(!$seller||!$bidder) {
			$in_data['error']="Seller or bidder information is not found";
			$this->load->view('error_view',$in_data);
			return;
		}
		//Checking logged status
		if(!$this->session->userdata("user")) {
			$in_data['msg']['accept_error']="Please sign in to accept";
			$this->session->set_flashdata('in_data',$in_data);
			redirect(site_url(),site_url()."/item/view/".$item['itemID']);
		}
		//Setting user data
		if($this->session->userdata("user")) {
			$user=$this->session->userdata("user");
			$data['user']=$user;
		}
		//Opening End-------
		// echo "bid: "; print_r($bid); echo "<br/><br/>";
		// echo "item: "; print_r($item); echo "<br/><br/>";
		// echo "seller: "; print_r($seller); echo "<br/><br/>";
		// echo "bidder: "; print_r($bidder); echo "<br/><br/>";
		// echo "user: "; print_r($user); echo "<br/><br/>";
		//if the user is not the seller
		if($user['userID']!=$seller['userID']) {
			$in_data['msg']['accept_error']="Only seller can accept bids";
			$this->session->set_flashdata('in_data',$in_data);
			redirect(site_url(),site_url()."/item/view/".$item['itemID']);
		}
		//if bidder is banned
		if($bidder['enabled']!='yes') {
			$in_data['msg']['accept_error']="The bidder account is banned.";
			$this->session->set_flashdata('in_data',$in_data);
			redirect(site_url(),site_url()."/item/view/".$item['itemID']);
		}
		//if item is disabled
		if($item['enabled']!='yes') {
			$in_data['msg']['accept_error']="The item is removed.";
			$this->session->set_flashdata('in_data',$in_data);
			redirect(site_url(),site_url()."/item/view/".$item['itemID']);
		}
		//if bid already accepted
		if($bid['approved']=='yes') {
			$in_data['msg']['accept_error']="The bid has been accepted before";
			$this->session->set_flashdata('in_data',$in_data);
			redirect(site_url(),site_url()."/item/view/".$item['itemID']);			
		}
		$this->Bid_model->accept($bid,$item);
		$in_data['msg']['accept_success']="The bid has been accepted";
		$this->session->set_flashdata('in_data',$in_data);
		redirect(site_url()."/item/view/".$item['itemID']);	
	}
}
?>