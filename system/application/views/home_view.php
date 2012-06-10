<html>
	<head>
		<title>UMall</title>
	</head>
	<body>		
		<div style="width:1024px; margin-left:auto; margin-right:auto; border: 1px solid black">
			<h1>User</h1>
			<?php if(isset($user)) {
			if(isset($in_data["msg"]["signin_success"])) echo "Success: ".$in_data["msg"]["signin_success"]."<br/>";
			echo "user: "; print_r($user); ?>
			<form action="<?php echo site_url(); ?>/home/signout" method="post">
				<input type="submit" name="signout" value="Sign Out">
			</form>
			<?php } else { ?>
			<form action="<?php echo site_url(); ?>/home/signin" method="post">
				Email:<input type="text" name="email">@ntu.edu.sg<br/>
				Pass:  <input type="password" name="pass"><br/>
				<input type="submit" name="signin" value="Sign In">
				<?php
					if(isset($in_data["msg"]["signin_error"])) echo "Error: ".$in_data["msg"]["signin_error"]."<br/>";
				?>
			</form>
			<?php } ?>
		</div>
	</body>
</html>