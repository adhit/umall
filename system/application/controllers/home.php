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
		
		//Opening Begin-------
		$data=array();
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
		$data['crnt']="/home";
		//Setting tags
		$this->load->model('Item_model');
		$data['tags']=$this->Item_model->get_all_tags();
		//Opening End-------
		
		//Get popular
		$data['popular']=$this->Item_model->get_top4_mostbid();
		$data['newest']=$this->Item_model->get_top4_newest();
		$data['barely']=$this->Item_model->get_top4_barely();
		
		$data['now']=time();
		
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
			user<array>: containing user record data
		*/
		
		$data=array();
		$email=$this->input->post('email');
		$pass=$this->input->post('pass');
		$valid=true;
		if(!$email||!$pass) {
			$data["msg"]["global_error"]="Please fill in valid email and password";
			$valid=false;
		}
		else {
			$this->load->model("User_model");
			$temp=$this->User_model->signin($email."@ntu.edu.sg",md5("SapiDanTemp".$pass));
			if($temp) {
				$this->session->set_userdata("user",$temp);
				$data["msg"]["global_success"]="Welcome to UMall, ".$temp['name']." :)";
			}
			else {
				$temp=$this->User_model->getone(array('email'=>$email."@ntu.edu.sg",'enabled !='=>'pending'));
				if(!$temp) $data["msg"]["global_error"]="No match found. Please try again";
				else if($temp['enabled']=='no') $data["msg"]["global_error"]="The user is currently banned. Please contact administrator.";
				else if($temp['pass']!=md5("SapiDanTemp".$pass)) $data["msg"]["global_error"]="Password mismatch. Please try again";
				$valid=false;
			}
		}
		if($valid) {
			$this->session->set_flashdata("msg",$data["msg"]);
			$redir="/home";
			if($this->input->post('prev')) $redir=$this->input->post('prev');
			redirect(site_url().$redir);
		}
		else {
			$this->load->view('signin_view',$data);
		}
	}
	
	function signout() {
		$this->session->unset_userdata("user");
		$data['msg']['global_info']='You have been signed out successfully';
		$this->session->set_flashdata("msg",$data["msg"]);
		redirect(site_url()."/home");
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
