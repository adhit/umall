<?php

class User extends Controller {

	function User() {
		parent::Controller();	
	}
	
	function profile(){
		/*
			DESC
			controller to display user profile and allow user to change his/her profile
			if user is not logged in, redirect to home and show login form.
			
			SESSION GET
			update_message: containing success or error messages
			user<array>: containing user record data
		*/
		if($this->session->userdata("user")){
			$data["user"] = $this->session->userdata("user");
			$data["update_message"] = $this->session->userdata("update_message");
			$this->session->unset_userdata("update_message");
			$this->load->view("profile_view", $data);
		}
		else{
			redirect(site_url()."/home");	
		}
	}
	
	function change_profile(){
		/*
			DESC
			controller to change user profile with input
			
			SESSION GET
			user<array>: containing user record data
			
			INPUT POST
				contact_number, show contact number, password and repeat password to be updated
			
			OUTPUT SESSION:
			update_message: containing success or error messages
			
			nb: for time being no validation for contact number.
		*/
		$contact_number = $this->input->post("contact_number");
		$show = $this->input->post("show");
		$password = $this->input->post("password");
		$repeat_password = $this->input->post("repeat_password");
		
		echo $contact_number;
		if(!isset($show) || $show != "yes") $show = "no";
		if(!isset($password) || $password == ""){
			$this->load->model("User_model");
			$user = $this->session->userdata("user");
			$this->User_model->update_contact($user, $contact_number, $show);
			$this->session->set_userdata("update_message", "You have successfully updated your profile");
		}
		else if($password == $repeat_password){
			if(strlen($password) < 6){
				$this->session->set_userdata("update_message", "Password too short");
			}
			else{
				$this->load->model("User_model");
				$user = $this->session->userdata("user");
				$email = $user["email"];
				//update_profile = function with parameter user array, md5 password, contact number, and show
				//suggestion : how to md5 maybe better placed in model rather than in controller
				$this->User_model->update_profile($user , md5("SapiDanTemp".$password), $contact_number, $show);
				$this->session->set_userdata("update_message", "You have successfully updated your profile");
			}
		}
		else{
			$this->session->set_userdata("update_message", "Password not match");
		}
		redirect(site_url()."/user/profile");
	}
	
	function bids(){
		/*
			controller to display all the bids an user has made (limited to 20 bids)
			SESSION GET
			user<array>: containing user record data
			
			POST
			offset (for starting entry for paging) possibly set in the URI later
		*/
		if($this->session->userdata("user")){
			$user = $this->session->userdata("user");
			if($this->input->post("offset")){
				$offset = $this->input->post("offset");
			}
			else{$offset = 0;}
			
			$userID = $user["userID"];
			$this->load->model("Bid_model");
			$data["bids"] = $this->Bid_model->get_all_bids($userID, 20, $offset);
			$this->load->view("bids_history_view", $data);
		}
		else{
			redirect(site_url()."/home");	
		}
	}
	
	function item(){
		/*
			controller to display all the items an user has posted (limited to 20 items, if more than that, need paging)
			SESSION GET
			user<array>: containing user record data
			
			POST
			offset (for starting entry for paging or directly goes to which page)  possibly set in the URI later
		*/
		if($this->session->userdata("user")){
			$user = $this->session->userdata("user");
			if($this->input->post("offset")){
				$offset = $this->input->post("offset");
			} //possibly to be moved in URI
			else{$offset = 0;}
			
			$userID = $user["userID"];
			$this->load->model("Item_model");
			$data["items"] = $this->Item_model->get_all_items($userID, 20, $offset);
			$this->load->view("sell_history_view", $data);
		}
		else{
			redirect(site_url()."/home");	
		}
	}	
}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */