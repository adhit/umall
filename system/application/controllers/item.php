<?php

class Item extends Controller {
	function Item() {
		parent::Controller();	
	}
	
	function index() {
		redirect(site_url()."/item/listing");
	}
	
	function search() {
		$url=site_url()."/item/listing";
		//plo and phi
		$BIG=3000;
		$plo=0; $phi=$BIG;
		if($this->input->post('plo')) $plo=$this->input->post('plo');
		if($this->input->post('phi')) $phi=$this->input->post('phi');
		if(strval(intval($plo))!=strval($plo)) $plo=0;
		if(strval(intval($phi))!=strval($phi)) $phi=$BIG;
		if($plo<0) $plo=0;
		if($phi>$BIG) $phi=$BIG;
		if($plo>$phi) { $temp=$plo; $plo=$phi; $phi=$temp; }
		if($plo>0) $url.="/plo/".$plo;
		if($phi<$BIG) $url.="/phi/".$phi;
		//tag
		if($this->input->post('tag')) {
			$tag=$this->input->post('tag');
			$first=true;
			$tag_str="";
			foreach($tag as $val) {
				if(!$first) $tag_str.="_";
				$tag_str.=$val;
				$first=false;
			}
			if($tag_str!="") $url.="/tag/".$tag_str;
		}
		//q
		if($this->input->post('q')) $url.="/q/".$this->input->post('q');
		//sort
		if($this->input->post('sort')) $url.="/sort/".$this->input->post('sort');
		redirect($url);
	}
	
	function listing() {
		/*
			INPUT URI
			plo/7				minimum price
			phi/20				maximum price
			tag/2 4 7			tagIDs
			q/pro legend	search terms
			page/3				page to show
			each/5				num of items per page
			sort/criterion		sorting criterion, can be match, pasc, pdesc, oldtonew, newtoold, pop
			
			OUTPUT
			in_data: all the uri parameters plus page&each (if not already in url), and maxpage
			items: 'each' number of item records for that particular page
		*/
	
		//Opening Begin-------
		$data=array();
		$data['isListing']=true;
		$data['now']=time();
		//Checking logged status
		//Setting user data
		if($this->session->userdata("user")) {
			$user=$this->session->userdata("user");
			$data['user']=$user;
		}
		//Setting message data
		$msg=array();
		if($this->session->flashdata('msg')) {
			$data['msg']=$this->session->flashdata('msg');
			//print_r($data);
			$msg=$data['msg'];
		}
		//Setting tags
		$this->load->model('Item_model');
		$data['tags']=$this->Item_model->get_all_tags();
		//Opening End-------
		
		$param=$this->uri->uri_to_assoc(3);
		if(!$param) $param=array();
		
		$data['crnt']="/item/listing";
		foreach($param as $key=>$val) {
			$data['crnt'].="/".$key."/".$val;
		}
		
		$this->load->model("Item_model");
		$temp=$this->Item_model->get_listing($param);
		if(!isset($param['sort'])) $param['sort']="match";
		if(!(in_array($param['sort'],array("match","newtoold","pop","pasc")))) $param['sort']="match";
		if($param['sort']=="match"&&(!isset($param['q'])||$param['q']=="")) $param['sort']="newtoold";
		if($temp) $temp=$this->_sort_listing($temp,$param);
		if(!isset($param['sort'])&&isset($param['q'])) $param['sort']="match";
		else if(!isset($param['sort'])) $param['sort']="newtoold";
		$data["in_data"]=$param;
		$page=1; $each=10;
		if(isset($param['each'])) $each=$param['each'];
		if(isset($param['page'])) $page=$param['page'];
		if($temp) $page=min($page,ceil(1.00*count($temp)/(1.00*$each)));
		if($temp) {
			$data["in_data"]["page"]=$page; $data["in_data"]["each"]=$each;
			$data["in_data"]["maxpage"]=intval(ceil(1.00*count($temp)/(1.00*$each)));
		}
		else {
			$data["in_data"]["page"]=1; $data["in_data"]["each"]=$each; $data["in_data"]["maxpage"]=1;
		}
		if($temp) $data["items"]=array_slice($temp,($page-1)*$each,$each);
		$url="/item/listing";
		foreach($data["in_data"] as $key=>$val) {
			if($key=="maxpage") continue;
			if($key=="each") continue;
			$url.="/".$key."/".$val;
		}
		$data["crnt"]=$url;
		$this->load->view("listing_view",$data);
	}
	
	function _sort_listing($list,$param) {
		foreach($list as &$a) $a['score']=0;
		if($param['sort']=="match") {
			if(isset($param['q'])) $qs=explode(" ",$param['q']);
			else $qs=array();
			foreach($list as &$a) {
				foreach($qs as $q) {
					$a['score']-=substr_count(strtolower($a['name']." ".$a['description']),strtolower($q));
				}
			}
		}
		else if($param['sort']=="newtoold") {
			foreach($list as &$a) $a['score']=-1*strtotime($a['timeCreated']);
		}
		else if($param['sort']=="oldtonew") {
			foreach($list as &$a) $a['score']=strtotime($a['timeCreated']);
		}
		else if($param['sort']=="pasc") {
			foreach($list as &$a) $a['score']=$a['price'];
		}
		else if($param['sort']=="pdesc") {
			foreach($list as &$a) $a['score']=-1.00*($a['price']);
		}
		else if($param['sort']=="pop") {
			foreach($list as &$a) $a['score']=-1.00*($a['num_bids']);
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
			$this->session->set_flashdata('msg',array('global_error'=>"Please sign in to post item"));
			redirect(site_url()."/home");
		}
		//Setting user data
		if($this->session->userdata("user")) {
			$user=$this->session->userdata("user");
			$data['user']=$user;
		}
		//Setting message data
		$msg=array();
		//Loading tags
		$this->load->model("Item_model");
		$data['tags']=$this->Item_model->get_all_tags();
		//Checking if first time
		if(!$this->input->post('filled')) {
			$this->load->view('post_view',$data);
			return;
		}
		//Opening End-------
		
		$timestamp=time();
		$name=$this->input->post('name');
//		$quantity=$this->input->post('quantity');
		$price=$this->input->post('price');
		$exp=$this->input->post('exp');
		$expiryDate=date("Y-m-d H:m:s",$timestamp+intval($exp)*24*60*60);
		$description=$this->input->post('description');
		// $agree=$this->input->post('agree');
		$type=$this->input->post('type');
		// $default=$this->input->post('default');
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
		// if(strval(intval($quantity))!=strval($quantity)) {
			// $msg["quantity_error"]="Quantity must be a whole number";
			// $valid=false;
		// }
		//check price
		if(strval(intval($price))!=strval($price)) {
			$msg["price_error"]="Price must be multiple of $1";
			$valid=false;
		}
		//check terms read
		// if(!$agree) {
			// $msg["agree_error"]="Please read and agree with the terms and conditions before continuing";
			// $valid=false;
		// }
		//File uploading
		$config['upload_path'] = FILE_URL;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '512';
		// $config['max_width']  = '1024';
		// $config['max_height']  = '768';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			//print_r($this->upload->data());
			$upload_data=$this->upload->data();
			if($upload_data['is_image']) {
				$msg["image_error"]=$this->upload->display_errors();
				$valid=false;
			}
		}
		else {
			$temp=$this->upload->data();
			$image=$temp['file_name'];
		}
		
		if($valid) {
			$datetime=date("Y-m-d H:m:s",$timestamp);
			$insert_data=array(
							'userID' => $user['userID'],
							'name' => $name,
							'price' => $price,
							'description' => $description,
							'enabled' => 'yes',
							'image' => $image,
							'type' => $type,
							'expiryDate' => $expiryDate,
							'timeCreated' => $datetime,
							'timeEdited' => $datetime );
			if($user['type']=='special') {
				if(!$tags) $tags=array();
				$tags[]=$user['tagID'];
			}
			$temp=$this->Item_model->post_item($insert_data,$tags);
			if(!$temp) {
				$msg["global_error"]="Database error. Please try again";
				$valid=false;
			}
			else { //valid
				$msg["global_success"]="Congratulation, you've just successfully posted an item";
				$this->session->set_flashdata('msg',$msg);
				redirect(site_url()."/item/view/".$temp['itemID']);
			}
		}
		if(!$valid) {
			$msg["global_error"]="Some fields contain error. Please check again.";
			$data["msg"]=$msg;
			$this->load->view('post_view',$data);
		}
	}

	function edit($itemID=0) {
		//Opening Begin-------
		$data=array();
		//Checking logged status
		if(!$this->session->userdata("user")) {
			$this->session->set_flashdata('msg',array('global_error'=>"Please sign in to edit item"));
			redirect(site_url()."/home");
		}
		//Setting user data
		if($this->session->userdata("user")) {
			$user=$this->session->userdata("user");
			$data['user']=$user;
		}
		//Setting message data
		$msg=array();
		//Loading tags
		$this->load->model("Item_model");
		$data['tags']=$this->Item_model->get_all_tags();
		//Opening End-------
		
		if($itemID==0) {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Item Editing");
			$this->session->set_flashdata('msg_content',"The data is invalid.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$item=$this->Item_model->getone(array('itemID'=>$itemID));
		if(!$item) {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Item Editing");
			$this->session->set_flashdata('msg_content',"The item doesn't exist<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		if($item['userID']!=$user['userID']) {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Item Editing");
			$this->session->set_flashdata('msg_content',"You are not authorized to edit other user's item<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		if($item['enabled']=='deleted') {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Item Editing");
			$this->session->set_flashdata('msg_content',"The item has been deleted or banned<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		if($item['enabled']=='no') {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Item Editing");
			$this->session->set_flashdata('msg_content',"The item doesn't exist<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		
		$data['item']=$item;
		$temp_tags=$this->Item_model->get_tags_where(array('itemID'=>$itemID));
		$data['init_tags']=array();
		foreach($temp_tags as $val) $data['init_tags'][]=$val['tagID'];
		
		$prev="/item/view/".$item['itemID'];
		if($this->input->post('prev')) $prev=$this->input->post('prev');
		else if($this->session->flashdata('prev')) $prev=$this->session->flashdata('prev');
		$data['prev']=$prev;
		
		//Checking if first time
		if(!$this->input->post('filled')) {
			$this->load->view('edit_view',$data);
			return;
		}
		
		$timestamp=time();
		$name=$this->input->post('name');
		$price=$this->input->post('price');
		$exp=$this->input->post('exp'); //exp can be 'same'
		$expiryDate="same";
		if($exp!='same') $expiryDate=date("Y-m-d H:m:s",$timestamp+intval($exp)*24*60*60);
		$description=$this->input->post('description');
		$type=$this->input->post('type');
		//echo "type: ".$type;
		$image="default.png";
		$tags=$this->input->post('tags');
		$valid=true;
		
		//form validations
		//check name
		if(!$name||strlen($name)==0) {
			$msg["name_error"]="Item's name field cannot be empty";
			$valid=false;
		}
		//check price
		if(strval(intval($price))!=strval($price)) {
			$msg["price_error"]="Price must be multiple of $1";
			$valid=false;
		}
		//File uploading
		$config['upload_path'] = FILE_URL;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '512';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			$upload_data=$this->upload->data();
			if($upload_data['is_image']) {
				$msg["image_error"]=$this->upload->display_errors();
				$valid=false;
			}
		}
		else {
			$temp=$this->upload->data();
			$image=$temp['file_name'];
		}
		
		if($valid) {
			$datetime=date("Y-m-d H:m:s",$timestamp);
			$insert_data=array(
							'name' => $name,
							'price' => $price,
							'description' => $description,
							'enabled' => 'yes',
							'type' => $type,
							'timeEdited' => $datetime );
			if($user['type']=='special') {
				if(!$tags) $tags=array();
				$tags[]=$user['tagID'];
			}
			if($image!="default.png") $insert_data['image']=$image;
			if($exp!='same') $insert_data['expiryDate']=$expiryDate;
			$temp=$this->Item_model->edit_item(array('itemID'=>$itemID),$insert_data,$tags);
			if(!$temp) {
				$msg["global_error"]="Database error. Please try again";
				$valid=false;
			}
			else { //valid
				$this->session->set_flashdata('theItem',$itemID);
				$msg["global_success"]="Congratulation, you've just successfully edited this item";
				$this->session->set_flashdata('msg',$msg);
				redirect(site_url().$prev);
			}
		}
		if(!$valid) {
			$msg["global_error"]="Some fields contain error. Please check again.";
			$data["msg"]=$msg;
			$this->load->view('edit_view',$data);
		}
	}
	
	function view($itemID=0) {
		/*
			INPUT URI
			itemID				the ID of the item
			
			INPUT FLASHDATA
			in_data
				form<array>: the value of inputs
				msg<array>: the error and success messages
			
			OUTPUT
			status: no_item, success, expired, disabled, seller_disabled. If no_item, show error message saying item not found and link to item/listing. If expired, disable bidder to put new or change his bid
			itemID: the ID of the item
			type: The type of the item, bid or fixed
			role: 	guest, seller or bidder. If guest, don't show the bid table and put message telling to login or register
					If seller and type is bid, show the seller's bidding table, with each row having 'accept' link, and [fullname,phone,email] that will only appear if the bid has been accepted. Also show a button to edit the item, linking to item/edit/itemID
					If bidder and type is bid, show the bidder's bidding table, and a UI to put in or change his bid
			item: a record of this particular item
			seller: a user record of this particular item
			tags: array of records of tag for this item
			bids: existing bids towards this item
			my_bid: current personal bid towards this item
			crnt: the current URI segments
		*/
		
		//Opening Begin-------
		$data=array();
		$data['isProduct']=true;
		//Checking logged status
		//Setting user data
		if($this->session->userdata("user")) {
			$user=$this->session->userdata("user");
			$data['user']=$user;
		}
		//Setting message data
		if($this->session->flashdata('msg')) {
			$data['msg']=$this->session->flashdata('msg');
		}
		if($this->session->flashdata('focus')) {
			$data['focus']=$this->session->flashdata('focus');
		}
		//Setting tags
		$this->load->model('Item_model');
		$data['tags']=$this->Item_model->get_all_tags();
		//Checking if first time
		//Opening End-------
		
		$data['now']=time();
		
		if($itemID==0) $data["status"]="no_item";
		else {
			$data['crnt']="/item/view/".$itemID;
			$this->load->model('Item_model');
			$this->load->model('Bid_model');
			$this->load->model('User_model');
			$item=$this->Item_model->getone(array('itemID'=>$itemID));
			if(!$item) $data["status"]="no_item";
			else if($item['enabled']=='deleted') $data["status"]="deleted";
			else if($this->Item_model->is_user_disabled($item)) $data["status"]="user_disabled";
			else {
				$seller=$this->User_model->getone(array("userID"=>$item['userID']));
				$tags=$this->Item_model->get_tags(array('itemID'=>$itemID));
				$bids=$this->Bid_model->get_bid_join_user(array('itemID'=>$itemID,'enabled'=>'yes'));
				if(isset($user)&&$user) $my_bid=$this->Bid_model->getone_bid_join_user(array('itemID'=>$itemID,'um_user.userID'=>$user['userID']));
				else $my_bid=false;
				if(!isset($user)||!$user) $data['role']='guest';
				else if($user['userID']==$item['userID']) $data['role']='seller';
				else $data['role']='buyer';
				
				if($bids&&$data['role']=="seller") usort($bids,function($a,$b) {
					if(human_to_unix($a['timeLatest'])<human_to_unix($b['timeLatest'])) return 1;
					else if(human_to_unix($a['timeLatest'])>human_to_unix($b['timeLatest'])) return -1;
					else return 0;
				});
				
				//get num_bids,acc_bids,highest
				$item['num_bids']=0;
				$item['acc_bids']=0;
				$item['highest']=0;
				if(isset($bids)&&$bids) {
					$item['num_bids']=count($bids);
					foreach($bids as $val) {
						if($val['approved']=="yes") $item['acc_bids']++;
						else if($val['approved']=="no"&&$val['price']>$item['highest']) $item['highest']=$val['price'];
					}
				}
				
				$data['itemID']=$itemID;
				$data['type']=$item['type'];
				$data['status']='success';
				if(strtotime($item['expiryDate'])<time()) $data['status']='expired';
				if($item['enabled']=='no') $data["status"]="disabled";
				$data['item']=$item;
				$data['the_tags']=$tags;
				$data['bids']=$bids;
				$data['my_bid']=$my_bid;
				$data['seller']=$seller;
			}
		}
		
		//echo "data: <br/>"; print_r($data);
		
		if($data['status']=="success"||$data['status']=="disabled"||$data['status']=="expired") $this->load->view($data['type'].$data['role']."_view",$data);
		else if($data['status']=="no_item") {
			$this->session->set_flashdata('msg_title',"Sorry, an Item View Error has occured");
			$this->session->set_flashdata('msg_content',"The item doesn't exist in the database.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		else if($data['status']=="deleted") {
			$this->session->set_flashdata('msg_title',"The item was put down");
			$this->session->set_flashdata('msg_content',"The item has been deleted either by the seller or an admin.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		else if($data['status']=="user_disabled") {
			$this->session->set_flashdata('msg_title',"The seller was deactivated");
			$this->session->set_flashdata('msg_content',"The seller of this item has been banned or deactivated.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		
		// echo 'item: ';
		// print_r($item);
		// echo '<br/><br/>tags: ';
		// print_r($tags);
		// echo '<br/><br/>bids: ';
		// print_r($bids);
		// echo '<br/><br/>my_bid: ';
		// print_r($my_bid);
	}
	
	function bid($itemID=0) {
		$data=array();
		//Opening Begin-------
		if($this->input->post('itemID')) $itemID=$this->input->post('itemID');
		if($itemID==0) {
			$this->session->set_flashdata('msg_title',"Sorry, a Bidding Error has occured");
			$this->session->set_flashdata('msg_content',"The data received is incomplete.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$this->load->model('Item_model');
		$item=$this->Item_model->getone(array('itemID'=>$itemID));
		if(!$item) {
			$this->session->set_flashdata('msg_title',"Sorry, a Bidding Error has occured");
			$this->session->set_flashdata('msg_content',"The item is not found.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$prev="";
		if($this->input->post('prev')) $prev=$this->input->post('prev');
		else $prev="/item/view/".$itemID;
		//Checking logged status
		if(!$this->session->userdata("user")) {
			$this->session->set_flashdata('msg',array("global_error"=>"You're not logged in. Please sign in to bid for an item."));
			redirect(site_url().$prev);
		}
		//Setting user data
		else {
			$user=$this->session->userdata("user");
		}
		if($item['userID']==$user['userID']) {
			$this->session->set_flashdata('msg',array("global_error"=>"You're the seller of this item, so you can't bid for it."));
			redirect(site_url().$prev);
		}
		//Opening End-------
		
		$price=$this->input->post('price');
		$userID=$user['userID'];
		$timestamp=time();
		$datetime=date("Y-m-d H:m:s",$timestamp);
		$valid=true;
		
		//Form validation
		//check quantity
		//check price
		if(strval(intval($price))!=strval($price)||$price<0) {
			$this->session->set_flashdata('msg',array("global_error"=>"Price must be multiple of $1."));
			$valid=false;
		}
		
		if($valid) {
			$this->load->model('Bid_model');
			$existing=$this->Bid_model->getone(array('userID'=>$userID,'itemID'=>$itemID));
			if(!$existing) {
				$insert_data=array('price'=>$price,'userID'=>$userID,'itemID'=>$itemID,'timeEdited'=>$datetime,'timeCreated'=>$datetime,'approved'=>"no");
				if($item['type']=="fixed") $insert_data['approved']="yes";
				$this->Bid_model->insert($insert_data);
				if($item['type']=="fixed") $this->session->set_flashdata('msg',array("global_success"=>"You have successfully noticed the seller that you're interested in this item."));
				else $this->session->set_flashdata('msg',array("global_success"=>"You have successfully posted a bid."));
			}
			else if($existing['approved']=='yes') {
				$valid=false;
				if($item['type']=="fixed") $this->session->set_flashdata('msg',array("global_error"=>"You have noticed the seller before."));
				else $this->session->set_flashdata('msg',array("global_error"=>"Your bid for this item has been accepted before."));
			}
			else {
				$insert_data=array('price'=>$price,'userID'=>$userID,'itemID'=>$itemID,'timeEdited'=>$datetime,'approved'=>"no");
				if($item['type']=="fixed") $insert_data['approved']="yes";
				if($item['type']=="bid") $this->Bid_model->update($existing,$insert_data);
				if($item['type']=="fixed") $this->session->set_flashdata('msg',array("global_error"=>"You have noticed the seller before."));
				else $this->session->set_flashdata('msg',array("global_success"=>"You have successfully changed your bid."));
			}
		}
		redirect(site_url().$prev);
	}
	
	function accept($bidID=0) {
		$data=array();
		//Opening Begin-------
		if($this->input->post('bidID')) $bidID=$this->input->post('bidID');
		if($bidID==0) {
			$this->session->set_flashdata('msg_title',"Sorry, a Bid Acceptance Error has occured");
			$this->session->set_flashdata('msg_content',"The data received is incomplete.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$this->load->model('Bid_model');
		$this->load->model('Item_model');
		$this->load->model('User_model');
		$bid=$this->Bid_model->getone(array('bidID'=>$bidID));;
		if(!$bid) {
			$this->session->set_flashdata('msg_title',"Sorry, a Bid Acceptance Error has occured");
			$this->session->set_flashdata('msg_content',"The bid record is not found.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$item=$this->Item_model->getone(array('itemID'=>$bid['itemID']));
		if(!$bid) {
			$this->session->set_flashdata('msg_title',"Sorry, a Bid Acceptance Error has occured");
			$this->session->set_flashdata('msg_content',"The item is not found.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$itemID=$item['itemID'];
		$prev="";
		if($this->input->post('prev')) $prev=$this->input->post('prev');
		else $prev="/item/view/".$itemID;
		//Checking logged status
		if(!$this->session->userdata("user")) {
			$this->session->set_flashdata('msg',array("global_error"=>"You're not logged in. Please sign in to accept a bid for an item."));
			redirect(site_url().$prev);
		}
		//Setting user data
		else {
			$user=$this->session->userdata("user");
		}
		if($item['userID']!=$user['userID']) {
			$this->session->set_flashdata('msg',array("global_error"=>"Only the seller of this item can accept a bid."));
			redirect(site_url().$prev);
		}
		//Opening End-------
		
		$seller=$this->User_model->getone(array('userID'=>$item['userID']));
		$bidder=$this->User_model->getone(array('userID'=>$bid['userID']));
		if(!$seller||!$bidder) {
			$this->session->set_flashdata('msg',array("global_error"=>"Seller or bidder information is not found. The user might have been deactivated."));
			redirect(site_url().$prev);
		}
		
		//if bidder is banned
		if($bidder['enabled']!='yes') {
			$this->session->set_flashdata('msg',array("global_error"=>"The bidder user account was not active."));
			redirect(site_url().$prev);
		}
		//if item is disabled
		if($item['enabled']!='yes') {
			$this->session->set_flashdata('msg',array("global_error"=>"The bidder user account was not active."));
			redirect(site_url().$prev);
		}
		//if bid already accepted
		if($bid['approved']=='yes') {
			$this->session->set_flashdata('msg',array("global_error"=>"The bid was accepted before."));
			redirect(site_url().$prev);
		}
		$this->Bid_model->accept($bid,$item);
		$this->session->set_flashdata('msg',array("global_success"=>"You have successfully accepted this bid. Please contact the buyer."));
		$this->session->set_flashdata('focus',array($bid['bidID']));
		redirect(site_url().$prev."#focus");
	}
	
	function reject($bidID=0) {
		$data=array();
		//Opening Begin-------
		if($this->input->post('bidID')) $bidID=$this->input->post('bidID');
		if($bidID==0) {
			$this->session->set_flashdata('msg_title',"Sorry, a Bid Rejection Error has occured");
			$this->session->set_flashdata('msg_content',"The data received is incomplete.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$this->load->model('Bid_model');
		$this->load->model('Item_model');
		$this->load->model('User_model');
		$bid=$this->Bid_model->getone(array('bidID'=>$bidID));;
		if(!$bid) {
			$this->session->set_flashdata('msg_title',"Sorry, a Bid  Rejection Error has occured");
			$this->session->set_flashdata('msg_content',"The bid record is not found.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$item=$this->Item_model->getone(array('itemID'=>$bid['itemID']));
		if(!$bid) {
			$this->session->set_flashdata('msg_title',"Sorry, a Bid Rejection Error has occured");
			$this->session->set_flashdata('msg_content',"The item is not found.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$itemID=$item['itemID'];
		$prev="";
		if($this->input->post('prev')) $prev=$this->input->post('prev');
		else $prev="/item/view/".$itemID;
		//Checking logged status
		if(!$this->session->userdata("user")) {
			$this->session->set_flashdata('msg',array("global_error"=>"You're not logged in. Please sign in to reject a bid for an item."));
			redirect(site_url().$prev);
		}
		//Setting user data
		else {
			$user=$this->session->userdata("user");
		}
		if($item['userID']!=$user['userID']) {
			$this->session->set_flashdata('msg',array("global_error"=>"Only the seller of this item can reject a bid."));
			redirect(site_url().$prev);
		}
		//Opening End-------
		
		$seller=$this->User_model->getone(array('userID'=>$item['userID']));
		$bidder=$this->User_model->getone(array('userID'=>$bid['userID']));
		if(!$seller||!$bidder) {
			$this->session->set_flashdata('msg',array("global_error"=>"Seller or bidder information is not found. The user might have been deactivated."));
			redirect(site_url().$prev);
		}
		
		//if bidder is banned
		if($bidder['enabled']!='yes') {
			$this->session->set_flashdata('msg',array("global_error"=>"The bidder user account was not active."));
			redirect(site_url().$prev);
		}
		//if item is disabled
		if($item['enabled']!='yes') {
			$this->session->set_flashdata('msg',array("global_error"=>"The bidder user account was not active."));
			redirect(site_url().$prev);
		}
		//if bid already accepted
		if($bid['approved']=='yes') {
			$this->session->set_flashdata('msg',array("global_error"=>"The bid was accepted before."));
			redirect(site_url().$prev);
		}
		if($bid['approved']=='rejected') {
			$this->session->set_flashdata('msg',array("global_error"=>"The bid was rejected before."));
			redirect(site_url().$prev);
		}
		$this->Bid_model->reject($bid,$item);
		$this->session->set_flashdata('msg',array("global_success"=>"You have successfully rejected this bid."));
		$this->session->set_flashdata('focus',array($bid['bidID']));
		redirect(site_url().$prev."#focus");
	}
	
	function toggle_hide($itemID=0) {
		$data=array();
		//Opening Begin-------
		if($this->input->post('itemID')) $itemID=$this->input->post('itemID');
		if($itemID==0) {
			$this->session->set_flashdata('msg_title',"Sorry, a Hidden-Toggle Error has occured");
			$this->session->set_flashdata('msg_content',"The data received is incomplete.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$this->load->model('Item_model');
		$item=$this->Item_model->getone(array('itemID'=>$itemID));
		if(!$item) {
			$this->session->set_flashdata('msg_title',"Sorry, a Hidden-Toggle Error has occured");
			$this->session->set_flashdata('msg_content',"The item is not found.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$prev="";
		if($this->input->post('prev')) $prev=$this->input->post('prev');
		else if($this->session->flashdata('prev')) $prev=$this->session->flashdata('prev');
		else $prev="/item/view/".$itemID;
		//Checking logged status
		if(!$this->session->userdata("user")) {
			$this->session->set_flashdata('msg',array("global_error"=>"You're not logged in. Please sign in to hide/unhide your item."));
			redirect(site_url().$prev);
		}
		//Setting user data
		else {
			$user=$this->session->userdata("user");
		}
		if($item['userID']!=$user['userID']) {
			$this->session->set_flashdata('msg',array("global_error"=>"Only the seller of this item can hide/unhide it."));
			redirect(site_url().$prev);
		}
		//Opening End-------
		
		$userID=$user['userID'];
		$timestamp=time();
		$datetime=date("Y-m-d H:m:s",$timestamp);
		
		$show="no";
		if($item['enabled']=="no") $show="yes";
		$this->Item_model->update(array('itemID'=>$item['itemID']),array('enabled'=>$show,'timeEdited'=>$datetime));
		if($show=="no") 
			$this->session->set_flashdata('msg',array("global_success"=>"This item is now hidden. Other users will not find this item as a search result"));
		else if($show=="yes") 
			$this->session->set_flashdata('msg',array("global_success"=>"This item is now unhidden. Other users may find this item as a search result"));
		
		$this->session->set_flashdata('theItem',$itemID);
		
		redirect(site_url().$prev);
	}
	
	
	function delete($itemID=0) {
		$data=array();
		//Opening Begin-------
		if($this->input->post('itemID')) $itemID=$this->input->post('itemID');
		if($itemID==0) {
			$this->session->set_flashdata('msg_title',"Sorry, a Item Deletion Error has occured");
			$this->session->set_flashdata('msg_content',"The data received is incomplete.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$this->load->model('Item_model');
		$item=$this->Item_model->getone(array('itemID'=>$itemID));
		if(!$item) {
			$this->session->set_flashdata('msg_title',"Sorry, a Item Deletion Error has occured");
			$this->session->set_flashdata('msg_content',"The item is not found.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$prev="";
		if($this->input->post('prev')) $prev=$this->input->post('prev');
		else if($this->session->flashdata('prev')) $prev=$this->session->flashdata('prev');
		else $prev="/item/view/".$itemID;
		//Checking logged status
		if(!$this->session->userdata("user")) {
			$this->session->set_flashdata('msg',array("global_error"=>"You're not logged in. Please sign in to delete your item."));
			redirect(site_url().$prev);
		}
		//Setting user data
		else {
			$user=$this->session->userdata("user");
		}
		if($item['userID']!=$user['userID']) {
			$this->session->set_flashdata('msg',array("global_error"=>"Only the seller of this item can delete it."));
			redirect(site_url().$prev);
		}
		//Opening End-------
		
		$userID=$user['userID'];
		$timestamp=time();
		$datetime=date("Y-m-d H:m:s",$timestamp);
		
		$show="deleted";
		$this->Item_model->update(array('itemID'=>$item['itemID']),array('enabled'=>$show,'timeEdited'=>$datetime));
		
		if($this->session->flashdata('prev')) {
			$this->session->set_flashdata('msg',array('global_success'=>"Item deletion is successful"));
			$prev=$this->session->flashdata('prev');
			redirect(site_url().$prev);
		}
		else {
			$this->session->set_flashdata('msg_title',"Item Deletion is Successful");
			$this->session->set_flashdata('msg_content',"Your item has been deleted.<br/>Click <a href=\"".site_url()."/item/listing\">here</a> to browse or search for items.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/success.png");
			redirect(site_url()."/msg");
		}
	}
}
?>