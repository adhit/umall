<?php

class Home extends Controller {

	function Home() {
		parent::Controller();	
	}
	
	function index() {
		/*
			DESC
			If a user is set in the session, than show logged in view. Else show login form
		
			SESSION GET
			in_data
				msg<array>: containing success or error messages
			user<array>: containing user record data
			
			OUTPUT:
			in_data
				msg<array>: containing success or error messages
			site_url: string containing site's url. Actually useless, can just call site_url(), but I'm too lazy to delete it and change the view file
		*/
	
		$data=array();
		$in_data=$this->session->userdata("in_data");
		if($in_data) $data["in_data"]=$in_data;		
		$this->session->unset_userdata("in_data");
		if($this->session->userdata("user")) $data["user"]=$this->session->userdata("user");
		$data["site_url"]=site_url();
		//$this->load->view('welcome_message');
		$this->load->view('home_view',$data);
	}
	
	function signin() {
		/*
			DESC
			Takes email and password. If matched with an active account, it will be signed in and put into session.
			Else set error message. Either way, redirect to home/index
			
			INPUT POST
				email,pass: string for login
		
			SESSION SET
			in_data
				msg<array>: containing success or error messages
				prev: the last method responsible (this)
			user<array>: containing user record data
		*/
		
		$data=array();
		$data["prev"]="/home/signin";
		$email=$this->input->post('email');
		$pass=$this->input->post('pass');
		if(!$email||!$pass) {
			$data["msg"]["signin_error"]="Please fill in valid email and password";
		}
		else {
			$this->load->model("User_model");
			$temp=$this->User_model->signin($email."@ntu.edu.sg",md5("SapiDanTemp".$pass));
			if($temp) {
				$this->session->set_userdata("user",$temp);
				$data["msg"]["signin_success"]="Success";
			}
			else $data["msg"]["signin_error"]="No match found. Please try again";
		}
		$this->session->set_userdata("in_data",$data);
		redirect(site_url()."/home/");
	}
	
	function signout() {
		$this->session->unset_userdata("user");
		redirect(site_url()."/home");		
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
