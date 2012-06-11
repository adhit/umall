<?php

class Register extends Controller {

	function Register()
	{
		parent::Controller();	
	}
	
	function _random_string($len) {
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$randstring = '';
		for ($i = 0; $i < $len; $i++) {
			$randstring .= $characters[rand(0, strlen($characters)-1)];
		}
		return $randstring;
    }
	
	function forget() {
		/*
			DESC
			Takes an email, reset the password of a record with that email, and send the info by email
		
			INPUT POST
			email: email string
			
			OUTPUT
			in_data
				msg<array>: containing success or error messages
		*/
		if(!$this->input->post('filled')) {
			$this->load->view('forget_view');
			return;
		}
		$this->load->model('User_model');
		$email=$this->input->post('email');
		$valid=true;
		//check email
		if(!$email||strlen($email)==0||$this->_check_email($email."@ntu.edu.sg")==false) {
			$msg["email_error"]="Invalid email, please fill in a valid email";
			$valid=false;
		}
		else if($this->User_model->find_disabled($email."@ntu.edu.sg")) {
			$msg["email_error"]="This email is disabled. Please contact administrator.";
			$valid=false;
		}
		else if($this->User_model->find_nonpending($email."@ntu.edu.sg")==false) {
			$msg["email_error"]="This email is not registered. Click <a href=\"".site_url()."/register"."\">here</a> to register";
			$valid=false;
		}
		else {
			$pass=$this->_random_string(8);
			$user=$this->User_model->getone(array('email'=>$email."@ntu.edu.sg",'enabled'=>"yes"));
			$this->User_model->set_pass($user,md5("SapiDanTemp".$pass));
			$this->_send_pass($user,$pass);
		}
		if($valid) {
			$data['msg']="Your new password has been sent to your email. Your new password is: ".$pass;
			$this->load->view('register_msg_view',$data);
		}
		else {
			$data["in_data"]["msg"]=$msg;
			$this->load->view('forget_view',$data);
		}
	}
	
	function index()
	{
		/*
			DESC
			Takes register form. It checks email for syntax and existing non-pending email; password length and retyped password;
			username can't be empty, phone number can only contain numbers, +, and -; if agree checkbox is checked
			If successful, an email is sent along with the activation link to the specified email
			
			INPUT POST
			email: email for registering
			pass,pass0: password and check password
			username: fullname
			phone: phone number
			show: whether to show email+phone or email only for contact display
			agree: agree with term or condition
			
			OUTPUT
			in_data
				msg<array>: success or error messages
		*/
		
		if(!$this->input->post('filled')) {
			$this->load->view('register_view');
			return;
		}
		
		$email=$this->input->post('email');
		$pass=$this->input->post('pass');
		$pass0=$this->input->post('pass0');
		$username=$this->input->post('username');
		$phone=$this->input->post('phone');
		$show=$this->input->post('show');
		$agree=$this->input->post('agree');
		$msg=array();
		$valid=true;
		//form validations
		$this->load->model("User_model");
		//check email
		if(!$email||strlen($email)==0||$this->_check_email($email."@ntu.edu.sg")==false) {
			$msg["email_error"]="Invalid email, please fill in a valid email";
			$valid=false;
		}
		if(!isset($msg["email_error"])&&$this->User_model->find_nonpending($email."@ntu.edu.sg")) {
			$msg["email_error"]="Email already existed, do you <a href=\"".site_url()."/register/forget"."\">forget your password</a>?";
			$valid=false;
		}
		//check pass
		if(!$pass||strlen($pass)<6) {
			$msg["pass_error"]="Password must be at least 6 characters long";
			$valid=false;
		}
		if(!isset($msg["pass_error"])&&$pass!=$pass0) {
			$msg["pass_error"]="Retyped password doesn't match";
			$valid=false;
		}
		//check fullname
		if(!$username||strlen($username)==0) {
			$msg["username_error"]="Fullname field cannot be empty";
			$valid=false;
		}
		//check phone
		if(!$phone||strlen($phone)==0) {
			$msg["phone_error"]="Phone field cannot be empty";
			$valid=false;
		}
		if(strlen($phone)>16||$this->_check_phone($phone)==false) {
			$msg["phone_error"]="Invalid phone number";
			$valid=false;
		}
		//chec terms read
		if(!$agree) {
			$msg["agree_error"]="Please read and agree with the terms and conditions before continuing";
			$valid=false;
		}
		
		$data=array();
		if($valid) {
			//post
			$timestamp=time();
			$datetime=date("Y-m-d H:m:s",$timestamp);
			$insert_data=array(
							'username' => $email,
							'pass' => md5('SapiDanTemp'.$pass),
							'name' => $username,
							'timeCreated' => $datetime,
							'timeEdited' => $datetime,
							'email' => $email."@ntu.edu.sg",
							'enabled' => 'pending',
							'contactNumber' => $phone,
							'type' => 'student',
							'show' => $show );
			$this->load->model("User_model");
			$this->User_model->register($insert_data);
			print_r($insert_data);
			$temp=$this->User_model->getone($insert_data);
			if($temp) {
				//email
				$temp["pass"]=$pass;
				if($this->_send_conf($temp)) {
					//view
					$data["email"]=$email."@ntu.edu.sg";
					$temp["pass"]=md5('SapiDanTemp'.$pass);
					$data["userID"]=$temp;
					$data["msg"]="
						<h1>Registration Success</h1>
						<h3>Your account has been registered. 
						Please check ".$email."@ntu.edu.sg inbox and spam for confirmation email.</h3>";
					$this->load->view('register_msg_view',$data);
				}
				else {
					$temp["pass"]=md5('SapiDanTemp'.$pass);
					$this->User_model->delete($temp);
					$msg["register_error"]="Email function error. Please try again";
					$valid=false;
				}
			}
			else {
				$msg["register_error"]="Database error. Please try again";
				$valid=false;
			}
		}
		if(!$valid) {
			$data["in_data"]["msg"]=$msg;
			$this->load->view('register_view',$data);
		}
	}
	
	function _check_email($email) {
		if(preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is",
			$email)){
			return true;
		}
		return false;
	}
	
	function _check_phone($phone) {
		if(preg_match("/.*[^(0-9\+\-\t\ )]/",
			$phone)){
			return false;
		}
		return true;
		
	}
	
	function _send_conf($user) {
		/*
			|--------------------------------------------------------------------------
			| Email config
			|--------------------------------------------------------------------------
		*/
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host']="ssl://smtp.googlemail.com";
		$config['smtp_user']="ntusu.mie@googlemail.com";
		$config['smtp_pass']="amiciziaeterna";
		$config['smtp_port']=465;
		$config['mailtype']="html";
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		
		$this->email->clear();
		$this->email->to($user['email']);
		$this->email->from('ntusu.mie@googlemail.com');
		$this->email->subject('[UMall] Here is your info '.$user['name']);
		$msg="Thank you for registering a UMall account. Here's the details of your account:<br/>";
		$msg=$msg."<ul><li>Email: ".$user['email']."</li>";
		$msg=$msg."<li>Pass: ".$user['pass']."</li>";
		$msg=$msg."<li>Fullname: ".$user['name']."</li>";
		$msg=$msg."<li>Phone: ".$user['contactNumber']."</li>";
		$msg=$msg."<li>Contact display preference: ";
		if($user['show']=="yes") $msg=$msg."Email+phone";
		else $msg=$msg."Email only";
		$msg=$msg."</li></ul>";
		$msg=$msg."Click here to activate your account: <a href=\"".site_url()."/register/activate/".md5($user['userID'].';'.$user['email'].';'.$user['name'].';'.$user['contactNumber'])."\">".site_url()."/register/activate/".md5($user['userID'].';'.$user['email'].';'.$user['name'].';'.$user['contactNumber'])."</a>";
		//echo $msg;
		$this->email->message($msg);
		if($this->email->send()) return true;
		return false;
	}
	
	function _send_pass($user,$pass) {
		/*
			|--------------------------------------------------------------------------
			| Email config
			|--------------------------------------------------------------------------
		*/
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host']="ssl://smtp.googlemail.com";
		$config['smtp_user']="ntusu.mie@googlemail.com";
		$config['smtp_pass']="amiciziaeterna";
		$config['smtp_port']=465;
		$config['mailtype']="html";
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		
		$this->email->clear();
		$this->email->to($user['email']);
		$this->email->from('ntusu.mie@googlemail.com');
		$this->email->subject('[UMall] Here is your new password, '.$user['name']);
		$msg="Here's the new password: ".$pass."<br/>";
		$msg=$msg."Sign in <a href=\"".site_url()."/home\">here</a> to use UMall";
		//echo $msg;
		$this->email->message($msg);
		if($this->email->send()) return true;
		return false;
	}
	
	function activate($code) {
		/*
			DESC
			Takes activation code, finding matching record, and activate it. There's 3 possibilities:
			1. No record found or invalid activation code, then gives error message 
			2. There's another record with same email which is not pending, then gives error message
			3. There're no or several records with same email, but all are pending. Proceed with activating this one record
		
			INPUT URI
			code/70e96f478a33aa6c11b842d80b283e17	code made of md5(concat(userID,';',email,';',name,';',contactNumber))
			
			OUTPUT
			msg: string, success or error message. This is for testing simplicity only, structure might be changed later
		*/
		
		if(!$code) $code="";
		//$code="70e96f478a33aa6c11b842d80b283e17";
		$this->load->model("User_model");
		$temp=$this->User_model->getone_custom("md5(concat(userID,';',email,';',name,';',contactNumber))='".$code."'");
		if(!$temp) {
			$data['msg']="Invalid activation code";
		}
		else if($this->User_model->find_nonpending($temp['email'])) {
			$data['msg']="Another account with email=".$temp['email']." has been activated before. Do you <a href=\"".site_url()."/register/forget"."\">forget your password</a>?";
		}
		else {
			$this->User_model->activate($temp);
			$data['msg']="Thanks ".$temp['name'].", your account with email=".$temp['email']." has been activated. Signin at the <a href=\"".site_url()."/home\">homepage</a>";
		}
		$this->load->view('register_msg_view',$data);
	}
	
	function test($sapi) {
		echo $sapi;
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */