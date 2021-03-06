﻿<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>U-Mall</title>
<?php include "includes/header_include_assets.php"; ?>
    <style type="text/css">
	.btn-repost{
		padding: 10px 180px;}
    .control-label{
		font-weight:bold;
		font-size:17px;
		margin-top:5px;}
	input[type="text"].input-xlarge{
		height:30px;}
	.select-type{
		height:42px; 
		padding:6px 6px 6px 2px; 
		border-radius:4px;
		width:150px;}
	.input-price{
		width:105px;}
	.input-prepend .add-on-input-price{
		height:20px;
		padding:9px;}
    </style>

  </head>

  <body>
  	
<?php include "includes/header.php"; ?>
    
    
    <!--<div class="banner-overlay hidden-phone hidden-tablet"></div>-->
    
	<br><br><br>
    
    <div class="container">

    <h1 class="content-header">Forget Password</h1>

	<?php
	if(isset($msg['global_error'])) { ?>
    <div class="alert alert-error alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $msg['global_error']; ?>
    </div>
	<?php } ?>
	
   	<div class="row">
    	<form class="form-horizontal" action="<?php echo site_url()."/register/forget"; ?>" method="post">
		<input type="hidden" name="filled" value="yes">
        <div class="span6 offset3">
            <div class="control-group<?php if(isset($msg['email_error'])) echo " error"; ?>">
              <label class="control-label" for="input01">Email</label>
              <div class="controls">
					<div class="input-append">
						<input type="text" name="email" class="span2" id="appendedInput" value="<?php if($this->input->post('email')) echo $this->input->post('email'); ?>"><span class="add-on">@ntu.edu.sg</span>
					</div>
			  </div>
        		</div>
        		<hr>
         <button type="submit" class="btn btn-primary btn-large btn-repost">Reset Password!</button>
        </div>
      </form>
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
