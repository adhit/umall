<?php

class Home extends Controller {

	function Home() {
		parent::Controller();	
	}
	
	function index() {		
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
		redirect(site_url()."/home");
	}
	
	function signout() {
		$this->session->unset_userdata("user");
		redirect(site_url()."/home");		
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */