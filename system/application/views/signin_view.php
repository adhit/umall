<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>U-Mall</title>
<?php include "includes/header_include_assets.php"; ?>
    <style type="text/css">
	.btn-login{
		padding: 10px 199px;}
  .control-label{
		font-weight:bold;
		font-size:17px;
		margin-top:5px;}
	input[type="text"].input-xlarge,input[type="password"].input-xlarge{
		height:30px;
		}
	.input-email{
		width:175px;}
	.input-append .add-on-input-email{
		height:20px;
		padding:9px;}
	.alert-register{
		margin-top:-20px;}
    </style>

  </head>

  <body>
  	
<?php include "includes/header.php"; ?>
    
    
    <!--<div class="banner-overlay hidden-phone hidden-tablet"></div>-->
    
	<br><br><br>
    
    <div class="container">

    <h1 class="content-header">Sign in <small> (or <a href="<?php echo site_url()."/register"; ?>">sign up</a>)</small></h1>

	<?php
	if(isset($msg['global_error'])) { ?>
    <div class="alert alert-error alert-block">
        <button type="button" class="close" data-dismiss="alert">Ã—</button>
        <?php echo $msg['global_error']; ?>
    </div>
	<?php } ?>
   	<div class="row">
        <div class="span6 offset3">
    	<form class="form-horizontal" action="<?php echo site_url()."/home/signin"; ?>" method="post">
			<input type="hidden" name="filled" value="yes">
			<input type="hidden" name="prev" value="<?php if(isset($crnt)&&$crnt)echo $crnt; else echo "/home"; ?>" >
			<div class="control-group">
				<label class="control-label" for="input01">Email Address</label>
				<div class="controls"><div class="input-append">
					<input name="email" type="text" class="input-xlarge input-email" id="input01" placeholder="Email"><span class="add-on add-on-input-email">@ntu.edu.sg</span></div>
				</div>
			</div>
			<hr>
			<div class="control-group">
				<label class="control-label" for="input04">Password</label>
				<div class="controls">
				  <input name="pass" type="password" class="input-xlarge" id="input02" placeholder="Password">
				  <a href="<?php echo site_url()."/register/forget"; ?>" class="forgotpass">forgot your password?</a>
				</div>
			</div>
			<hr>
            <button type="submit" class="btn btn-primary btn-large btn-login">Login</button>
		</form>
		</div>
    </div>
	  
	</div> <!-- Container -->
	
<?php //include "includes/footer.php"; ?>


<div class="footerphone visible-phone"><hr>© NTU Student Union 2012</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php
    include "includes/footer_include_assets.php";
    ?>
  </body>

</html>
