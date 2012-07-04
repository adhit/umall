<?php

class User extends Controller {

	function User() {
		parent::Controller();	
	}
	
	function editpass() {
		if($this->session->userdata("user")){
			$user = $this->session->userdata("user");
			$data["user"] = $this->session->userdata("user");
		}
		else {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Profile Editing");
			$this->session->set_flashdata('msg_content',"You are not logged in. Please sign in to edit your account<br/>Click <a href=\"".site_url()."/home\">here</a> to go to home.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		//Setting tags
		$this->load->model('User_model');
		$this->load->model('Item_model');
		$data['tags']=$this->Item_model->get_all_tags();
		
		$userID=$user['userID'];
		
		//Checking if first time
		if(!$this->input->post('filled')) {
			$this->load->view('editpass_view',$data);
			return;
		}
		
		$old=$this->input->post('old');
		$new=$this->input->post('new');
		$valid=true;
		
		//Check if password match
		$temp=$this->User_model->getone(array('userID'=>$userID,'pass'=>md5('SapiDanTemp'.$old)));
		if(!$temp) {
			$data["msg"]["global_error"]="Old password is incorrect";
			$data["msg"]["old_error"]="Old password is incorrect";
			$valid=false;
		}
		//Check if new password is valid
		if($valid&&!$new||strlen($new)<6) {
			$data["msg"]["global_error"]="New password must be at least 6 characters long";
			$data["msg"]["new_error"]="New password must be at least 6 characters long";
			$valid=false;
		}
		if($valid) {
			//post
			$timestamp=time();
			$datetime=date("Y-m-d H:m:s",$timestamp);
			$insert_data=array(
							'timeEdited' => $datetime,
							'pass' => md5('SapiDanTemp'.$new) );
			$this->load->model('User_model');
			$this->User_model->update(array('userID'=>$userID),$insert_data);
			$user=$this->User_model->getone(array('userID'=>$userID));
			$data['user']=$user;
			$this->session->unset_userdata("user");
			$this->session->set_userdata('user',$user);
			$this->session->set_flashdata('msg',array('global_success'=>"You have successfully edited your password"));
			redirect(site_url()."/user/profile/".$user['userID']."/1");
		}
		else $this->load->view('editpass_view',$data);
	}
	
	function editname() {
	
		if($this->session->userdata("user")){
			$user = $this->session->userdata("user");
			$data["user"] = $this->session->userdata("user");
		}
		else {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Profile Editing");
			$this->session->set_flashdata('msg_content',"You are not logged in. Please sign in to edit your account<br/>Click <a href=\"".site_url()."/home\">here</a> to go to home.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		//Setting tags
		$this->load->model('User_model');
		$this->load->model('Item_model');
		$data['tags']=$this->Item_model->get_all_tags();
		
		$userID=$user['userID'];
		
		//Checking if first time
		if(!$this->input->post('filled')) {
			$this->load->view('editname_view',$data);
			return;
		}
		
		$phone=$this->input->post('phone');
		$valid=true;
		//check phone
		if(!$phone||strlen($phone)==0) {
			$data["msg"]["global_error"]="Name field cannot be empty";
			$valid=false;
		}
		
		if($valid) {
			//post
			$timestamp=time();
			$datetime=date("Y-m-d H:m:s",$timestamp);
			$insert_data=array(
							'timeEdited' => $datetime,
							'name' => $phone );
			$this->load->model('User_model');
			$this->User_model->update(array('userID'=>$userID),$insert_data);
			$user=$this->User_model->getone(array('userID'=>$userID));
			$data['user']=$user;
			$this->session->unset_userdata("user");
			$this->session->set_userdata('user',$user);
			$this->session->set_flashdata('msg',array('global_success'=>"You have successfully edited your name"));
			redirect(site_url()."/user/profile/".$user['userID']."/1");
		}
		else if(!$valid) $this->load->view('editname_view',$data);
	}
	
	function editphone() {
		if($this->session->userdata("user")){
			$user = $this->session->userdata("user");
			$data["user"] = $this->session->userdata("user");
		}
		else {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Profile Editing");
			$this->session->set_flashdata('msg_content',"You are not logged in. Please sign in to edit your account<br/>Click <a href=\"".site_url()."/home\">here</a> to go to home.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		//Setting tags
		$this->load->model('User_model');
		$this->load->model('Item_model');
		$data['tags']=$this->Item_model->get_all_tags();
		
		$userID=$user['userID'];
		
		//Checking if first time
		if(!$this->input->post('filled')) {
			$this->load->view('editphone_view',$data);
			return;
		}
		
		$phone=$this->input->post('phone');
		$valid=true;
		//check phone
		if(!$phone||strlen($phone)==0) {
			$data["msg"]["global_error"]="Phone field cannot be empty";
			$valid=false;
		}
		if(strlen($phone)>16||$this->_check_phone($phone)==false) {
			$data["msg"]["global_error"]="Invalid phone number";
			$valid=false;
		}
		
		if($valid) {
			//post
			$timestamp=time();
			$datetime=date("Y-m-d H:m:s",$timestamp);
			$insert_data=array(
							'timeEdited' => $datetime,
							'contactNumber' => $phone );
			$this->load->model('User_model');
			$this->User_model->update(array('userID'=>$userID),$insert_data);
			$user=$this->User_model->getone(array('userID'=>$userID));
			$data['user']=$user;
			$this->session->unset_userdata("user");
			$this->session->set_userdata('user',$user);
			$this->session->set_flashdata('msg',array('global_success'=>"You have successfully edited your phone number"));
			redirect(site_url()."/user/profile/".$user['userID']."/1");
		}
		else if(!$valid) $this->load->view('editphone_view',$data);
	}
	
	function _check_phone($phone) {
		if(preg_match("/.*[^(0-9\+\-\t\ )]/",
			$phone)){
			return false;
		}
		return true;
	}
	
	function profile($userID=0,$page=1){
		
		$data=array();
		$data['now']=time();
		if($this->session->userdata("user")){
			$data["user"] = $this->session->userdata("user");
		}
		if($this->session->flashdata("msg")) $data['msg']=$this->session->flashdata("msg");
		
		$this->load->model('User_model');
		$this->load->model('Item_model');
		
		if(!isset($userID)) {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Profile Viewing");
			$this->session->set_flashdata('msg_content',"The data is invalid.<br/>Click <a href=\"".site_url()."/home\">here</a> to go to home.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$the_user=$this->User_model->getone(array('userID'=>$userID,'enabled'=>'yes'));
		if(!$the_user) {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Profile Viewing");
			$this->session->set_flashdata('msg_content',"The user doesn't exist.<br/>Click <a href=\"".site_url()."/home\">here</a> to go to home.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		$data['the_user']=$the_user;
		
		//Setting tags
		$data['tags']=$this->Item_model->get_all_tags();
		
		$temp=$this->Item_model->get_items_posted($userID);
		$each=10; if(!isset($page)) $page=1;
		if($temp) {
			$page=min($page,ceil(1.00*count($temp)/(1.00*$each)));
			$data["in_data"]["page"]=$page; 
			$data["in_data"]["each"]=$each;
			$data["in_data"]["maxpage"]=intval(ceil(1.00*count($temp)/(1.00*$each)));
			$data["items"]=array_slice($temp,($page-1)*$each,$each);
		}
		else {
			$data["in_data"]["page"]=1; 
			$data["in_data"]["each"]=$each; 
			$data["in_data"]["maxpage"]=1;
		}
		
		//Setting crnt
		$data['crnt']="/user/profile/".$userID."/".$page;
		
		$this->load->view("profile_view",$data);
		
	}
	
	// function change_profile(){
		// /*
			// DESC
			// controller to change user profile with input
			
			// SESSION GET
			// user<array>: containing user record data
			
			// INPUT POST
				// contact_number, show contact number, password and repeat password to be updated
			
			// OUTPUT SESSION:
			// update_message: containing success or error messages
			
			// nb: for time being no validation for contact number.
		// */
		// $contact_number = $this->input->post("contact_number");
		// $show = $this->input->post("show");
		// $password = $this->input->post("password");
		// $repeat_password = $this->input->post("repeat_password");
		
		// echo $contact_number;
		// if(!isset($show) || $show != "yes") $show = "no";
		// if(!isset($password) || $password == ""){
			// $this->load->model("User_model");
			// $user = $this->session->userdata("user");
			// $this->User_model->update_contact($user, $contact_number, $show);
			// $this->session->set_userdata("update_message", "You have successfully updated your profile");
		// }
		// else if($password == $repeat_password){
			// if(strlen($password) < 6){
				// $this->session->set_userdata("update_message", "Password too short");
			// }
			// else{
				// $this->load->model("User_model");
				// $user = $this->session->userdata("user");
				// $email = $user["email"];
				// //update_profile = function with parameter user array, md5 password, contact number, and show
				// //suggestion : how to md5 maybe better placed in model rather than in controller
				// $this->User_model->update_profile($user , md5("SapiDanTemp".$password), $contact_number, $show);
				// $this->session->set_userdata("update_message", "You have successfully updated your profile");
			// }
		// }
		// else{
			// $this->session->set_userdata("update_message", "Password not match");
		// }
		// redirect(site_url()."/user/profile");
	// }
	
	function bids($page=1) {
		/*
			controller to display all the items an user has posted (limited to 20 items, if more than that, need paging)
			SESSION GET
			user<array>: containing user record data
			
			POST
			offset (for starting entry for paging or directly goes to which page)  possibly set in the URI later
		*/
		// if($this->session->userdata("user")){
			// $user = $this->session->userdata("user");
			// if($this->input->post("offset")){
				// $offset = $this->input->post("offset");
			// } //possibly to be moved in URI
			// else{$offset = 0;}
			
			// $userID = $user["userID"];
			// $this->load->model("Item_model");
			// $data["items"] = $this->Item_model->get_all_items($userID, 20, $offset);
			// $this->load->view("sell_history_view", $data);
		// }
		// else{
			// redirect(site_url()."/home");	
		// }
		
		
		$data=array();
		$data['now']=time();
		$data['isListing']=true;
		if($this->session->userdata("user")){
			$user=$this->session->userdata("user");
			$data["user"] = $this->session->userdata("user");
		}
		else {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Bids Tracking");
			$this->session->set_flashdata('msg_content',"You are not logged in. Please sign in to see all your bids<br/>Click <a href=\"".site_url()."/home\">here</a> to go to home.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		//msg
		if($this->session->flashdata("msg")) $data['msg']=$this->session->flashdata("msg");
		
		$this->load->model('User_model');
		$this->load->model('Item_model');
		
		$userID=$user['userID'];
		$data['user']=$user;
		
		//Setting tags
		$data['tags']=$this->Item_model->get_all_tags();
		
		$temp=$this->Item_model->get_items_bid($userID);
		$each=10; if(!isset($page)) $page=1;
		if($temp) {
			$page=min($page,ceil(1.00*count($temp)/(1.00*$each)));
			$data["in_data"]["page"]=$page; 
			$data["in_data"]["each"]=$each;
			$data["in_data"]["maxpage"]=intval(ceil(1.00*count($temp)/(1.00*$each)));
			$data["items"]=array_slice($temp,($page-1)*$each,$each);
		}
		else {
			$data["in_data"]["page"]=1; 
			$data["in_data"]["each"]=$each; 
			$data["in_data"]["maxpage"]=1;
		}
		
		//Setting crnt
		$data['crnt']="/user/items/".$page;
		
		$this->load->view("bids_view",$data);
		
	}
	
	function items($page=1) {
		/*
			controller to display all the items an user has posted (limited to 20 items, if more than that, need paging)
			SESSION GET
			user<array>: containing user record data
			
			POST
			offset (for starting entry for paging or directly goes to which page)  possibly set in the URI later
		*/
		// if($this->session->userdata("user")){
			// $user = $this->session->userdata("user");
			// if($this->input->post("offset")){
				// $offset = $this->input->post("offset");
			// } //possibly to be moved in URI
			// else{$offset = 0;}
			
			// $userID = $user["userID"];
			// $this->load->model("Item_model");
			// $data["items"] = $this->Item_model->get_all_items($userID, 20, $offset);
			// $this->load->view("sell_history_view", $data);
		// }
		// else{
			// redirect(site_url()."/home");	
		// }
		
		
		$data=array();
		$data['now']=time();
		$data['isListing']=true;
		if($this->session->userdata("user")){
			$user=$this->session->userdata("user");
			$data["user"] = $this->session->userdata("user");
		}
		else {
			$this->session->set_flashdata('msg_title',"Sorry, an error has occurred in Bids Tracking");
			$this->session->set_flashdata('msg_content',"You are not logged in. Please sign in to see all your bids<br/>Click <a href=\"".site_url()."/home\">here</a> to go to home.");
			$this->session->set_flashdata('msg_img',base_url()."/assets/img/error.png");
			redirect(site_url()."/msg");
		}
		//msg
		if($this->session->flashdata("msg")) $data['msg']=$this->session->flashdata("msg");
		if($this->session->flashdata("theItem")) $data['theItem']=$this->session->flashdata("theItem");
		
		$this->load->model('User_model');
		$this->load->model('Item_model');
		
		$userID=$user['userID'];
		$data['user']=$user;
		
		//Setting tags
		$data['tags']=$this->Item_model->get_all_tags();
		
		$temp=$this->Item_model->get_items_posted($userID);
		$each=10; if(!isset($page)) $page=1;
		if($temp) {
			$page=min($page,ceil(1.00*count($temp)/(1.00*$each)));
			$data["in_data"]["page"]=$page; 
			$data["in_data"]["each"]=$each;
			$data["in_data"]["maxpage"]=intval(ceil(1.00*count($temp)/(1.00*$each)));
			$data["items"]=array_slice($temp,($page-1)*$each,$each);
		}
		else {
			$data["in_data"]["page"]=1; 
			$data["in_data"]["each"]=$each; 
			$data["in_data"]["maxpage"]=1;
		}
		
		//Setting crnt
		$data['crnt']="/user/items/".$page."#theItem";
		$this->session->set_flashdata('prev',$data['crnt']);
		
		$this->load->view("items_view",$data);
		
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */
