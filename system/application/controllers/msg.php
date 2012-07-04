<?php

class Msg extends Controller {

	function Msg() {
		parent::Controller();	
	}
	
	function index() {
		//Opening Begin-------
		$data=array();
		//Setting user data
		if($this->session->userdata("user")) {
			$user=$this->session->userdata("user");
			$data['user']=$user;
		}
		$this->load->model('Item_model');
		$data['tags']=$this->Item_model->get_all_tags();
		//Opening End-------
		
		//Default
		$data['msg_title']="Sorry, an error has occured";
		$data['msg_content']="We are working on getting this fixed as soon as we can.<br>
								Click <a href=\"".site_url()."/home\">here</a> to go back to home.";
		$data['msg_img']=base_url()."/assets/img/error.png";
		
		//Set msg
		if($this->session->flashdata('msg_title')) {
			$data['msg_title']=$this->session->flashdata('msg_title');
			$this->session->set_flashdata('msg_title',$this->session->flashdata('msg_title'));
		}
		if($this->session->flashdata('msg_content')) {
			$data['msg_content']=$this->session->flashdata('msg_content');
			$this->session->set_flashdata('msg_content',$this->session->flashdata('msg_content'));
		}
		if($this->session->flashdata('msg_img')) {
			$data['msg_img']=$this->session->flashdata('msg_img');
			$this->session->set_flashdata('msg_img',$this->session->flashdata('msg_img'));
		}
		
		$this->load->view('msg_view',$data);
	}
}

?>