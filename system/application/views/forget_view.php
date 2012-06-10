<html>
	<head>
		<title>UMall</title>
	</head>
	<body>		
		<div style="width:1024px; margin-left:auto; margin-right:auto; border: 1px solid black">
			<h1>Reset password</h1>
			<?php
			if(isset($in_data["msg"]["register_error"])) echo "Error: ".$in_data["msg"]["register_error"]."<br/>"; 
			?>
			<form action="<?php echo site_url(); ?>/register/forget" method="post">
			Email:<input type="text" name="email"
				<?php if($this->input->post('email')) echo "value=\"".$this->input->post('email')."\"" ?> >@ntu.edu.sg 
				<?php if(isset($in_data["msg"]["email_error"])) echo $in_data["msg"]["email_error"]; ?><br/>
			<input type="hidden" name="filled" value="true">
			<input type="submit" name="signin" value="Reset Pass">
		</div>
	</body>
</html>