<html>
	<head>
		<title>UMall</title>
	</head>
	<body>		
		<div style="width:1024px; margin-left:auto; margin-right:auto; border: 1px solid black">
			<h1>User</h1>
			<form action="<?php echo site_url(); ?>/user/change_profile" method="post">
				Phone Number <input type="text" name="contact_number" value="<?php echo $user["contactNumber"]?>"><br/>
				Show <input type="checkbox" name="show" value="yes" <?php if($user["show"] == "yes") echo 'checked="yes"'?>><br/>
				Pass:  <input type="password" name="password"><br/>
				Pass2:  <input type="password" name="repeat_password"><br/>
				<input type="submit" name="submit" value="Submit">
				<?php
					if(isset($update_message)) echo $update_message."<br/>";
				?>
			</form>
		</div>
	</body>
</html>