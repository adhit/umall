<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>U-Mall</title>
<?php include "includes/header_include_assets.php"; ?>   
    <style type="text/css">
	  /*BANNER */
	  .banner{
		  margin:50px auto 50px -60px;
		  border-radius:10px;
		  width:1059px;
		  background: url(<?php echo base_url(); ?>assets/img/banner4.jpg) no-repeat;
		  height:267px;
	  }
	
	/* Grid PRODUCT THUMBNAIL */
	.s-shade{
		width:940px;
		height:10px;
		background:url(<?php echo base_url(); ?>assets/img/s-shade.jpg);
		margin-bottom:30px;}
		
	.t-head{
		margin-bottom:30px;
	}
	.t-head h1{
		line-height:50px;
		color:#000;
		text-align:left;
		text-shadow: 0px 0px 1px #000;
		}
	.t-head p{
		text-align:justify;
		line-height:25px;}
	
	.item-title{
		color:#000;
		font-weight:bold;
		}
	.item-price{
		color: #000;
		}
	.item-overlay{
		background: url(<?php echo base_url(); ?>assets/img/glossy.png);
		width:198px;
		height:198px;
		position:absolute;}
	.thumbnail > img {
		border-radius:3px;
		box-shadow: 0 0 2px #333;
		}
	.thumbnails{
		margin-bottom:-30px;}
		
		
	.darthvader{
		width: 244px;
		height:360px;
		background:url(../assets/img/darth.jpg);
		margin-left:10px;}
	.darth-baloon{
		font-size:25px;
		width:170px;
		line-height:23px;
		padding: 25px 0 0 63px;
		color:#ed1c24;
		font-weight:bold;
		text-shadow: -1px 0px 1px #666;}
	.btn-register{
		padding: 10px 101px;}
    .control-label{
		font-weight:bold;
		font-size:17px;
		margin-top:5px;}
	input[type="text"].input-xlarge{
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
    
	
    <h1 class="content-header">Create an account <small> (or <a href="">sign in</a>)</small></h1>
	
	<!--
    <div class="alert fade in alert-block alert-register">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
          </div>
	-->
	
	<?php
	if(isset($msg['global_error'])) { ?>
    <div class="alert alert-error alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $msg['global_error']; ?>
    </div>
	<?php } ?>
		  
   	<div class="row">
    	<div class="span4"><div class="darthvader"><div class="darth-baloon">Come to me my son ...</div></div></div>
        <div class="span6">
        <form class="form-horizontal" action="<?php echo site_url(); ?>/register" method="post">
			<input type="hidden" name="filled" value="true">
          <div class="control-group<?php if(isset($msg['email_error'])) echo " error"; ?>">
            <label class="control-label" for="input01">Email Address</label>
            <div class="controls"><div class="input-append">
              <input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="input-xlarge input-email" id="input01"><span class="add-on add-on-input-email">@ntu.edu.sg</span></div>
              <p class="help-block">
			  <?php if(isset($msg['email_error'])) echo $msg['email_error']; else { ?>
			  Your email will be shared to potential buyers and/or sellers in the site. A confirmation link will be sent to your email upon completion of registration.
			  <?php } ?>
			  </p>
            </div>
          </div>
          <hr>
		  <div class="control-group<?php if(isset($msg['username_error'])) echo " error"; ?>">
            <label class="control-label" for="input02">Full Name</label>
            <div class="controls">
              <input type="text" name="username" value="<?php echo $this->input->post('username'); ?>" class="input-xlarge" id="input02">
              <p class="help-block"><?php if(isset($msg['username_error'])) echo $msg['username_error']; else { ?>
			  Please enter your real name. Your full name may be changed by administrator if it is found different.
			  <?php } ?>
            </div>
          </div>
          <hr>
		  <div class="control-group<?php if(isset($msg['phone_error'])) echo " error"; ?>">
            <label class="control-label" for="input03">Phone Number</label>
            <div class="controls">
              <input type="text" name="phone" value="<?php echo $this->input->post('phone'); ?>" class="input-xlarge" id="input03"><br>
			  <input type="hidden" name="show" value="yes">
              <p class="help-block"><?php if(isset($msg['phone_error'])) echo $msg['phone_error']; else { ?>
			  Your phone number will be shared to potential buyers and/or sellers in the site.
			  <?php } ?>
            </div>
          </div>
          <hr>
		  <div class="control-group<?php if(isset($msg['pass_error'])) echo " error"; ?>">
            <label class="control-label" for="input04">Password</label>
            <div class="controls">
              <input type="password" name="pass" value="<?php //echo $this->input->post('pass'); ?>" class="input-xlarge" id="input04">
              <p class="help-block"><?php if(isset($msg['pass_error'])) echo $msg['pass_error']; ?></p>
            </div>
          </div>
          <hr>
		  <div class="control-group<?php if(isset($msg['agree_error'])) echo " error"; ?>">
            <div class="controls">
              <label class="checkbox" ><input type="checkbox" name="agree" >I agree with the terms and conditions </label>
			  <p class="help-block"><?php if(isset($msg['agree_error'])) echo $msg['agree_error']; else { ?>
			  Please read and agree with terms and conditions before continuing.
			  <?php } ?>
            </div>
          </div>          
            <button type="submit" class="btn btn-primary btn-large btn-register">Awesome, Let's Finish and Login!</button>
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
