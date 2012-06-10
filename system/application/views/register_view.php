<html>
	<head>
		<title>UMall</title>
	</head>
	<body>		
		<div style="width:1024px; margin-left:auto; margin-right:auto; border: 1px solid black">
			<h1>Register</h1>
			<?php
			if(isset($in_data["msg"]["register_error"])) echo "Error: ".$in_data["msg"]["register_error"]."<br/>"; 
			?>
			<form action="<?php echo site_url(); ?>/register" method="post">
			Email:<input type="text" name="email"
				<?php if($this->input->post('email')) echo "value=\"".$this->input->post('email')."\"" ?> >@ntu.edu.sg 
				<?php if(isset($in_data["msg"]["email_error"])) echo $in_data["msg"]["email_error"]; ?><br/>
			Pass:  <input type="password" name="pass"> 
				<?php if(isset($in_data["msg"]["pass_error"])) echo $in_data["msg"]["pass_error"]; ?><br/>
			Retype Pass:  <input type="password" name="pass0"><br/>
			Fullname:<input type="text" name="username"
				<?php if($this->input->post('username')) echo "value=\"".$this->input->post('username')."\"" ?> > 
				<?php if(isset($in_data["msg"]["username_error"])) echo $in_data["msg"]["username_error"]; ?><br/>
			Sing Phone:<input type="text" name="phone"
				<?php if($this->input->post('phone')) echo "value=\"".$this->input->post('phone')."\"" ?> > 
				<?php if(isset($in_data["msg"]["phone_error"])) echo $in_data["msg"]["phone_error"]; ?><br/>
			Contact Display Preference: <input type="radio" name="show" value="yes" checked>Email+phone 
										<input type="radio" name="show" value="no" <?php if($this->input->post('show')=="no") echo "checked"; ?> >Email only <br/>
			<input type="checkbox" name="agree" value="yes"> I have read and agree with all the terms and conditions<br/>
			<?php if(isset($in_data["msg"]["agree_error"])) echo $in_data["msg"]["agree_error"]; ?><br/>
			<input type="hidden" name="filled" value="true">
			<input type="submit" name="signin" value="Sign In">
		</div>
	</body>
</html>