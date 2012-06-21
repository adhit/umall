<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <?php
    include "header_include_assets.php";
    ?>
    <style type="text/css">
	.content-header{
		text-align:center;
		padding:30px;}
	.darthvader{
		width: 244px;
		height:360px;
		background:url(./assets/img/darth.jpg);
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
  	<div class="overlay"></div>
    <div class="login-overlay"></div>
    
	<div class="panel p-left p-search">
        <h4>Advanced Search Panel</h4>
        <hr>
        <ul class="p-group">
        <li> <b>Price range</b> &nbsp; &nbsp; &nbsp;  S$ 0 - S$ 10000<br><div id="slider-range"></div></li><hr>
        <li> 
            <b>Tags relevance</b>
            <div class="btn-group btn-tags" data-toggle="buttons-radio">
              <button class="btn btn-primary active">None</button>
              <button class="btn btn-primary">Select all</button>
              <button class="btn btn-primary">Discard all</button>
            </div>
            <ul class="tags-group">
                <li><i class="trig"></i>Appliances</li>
                <li><i class="trig"></i>Arts</li>
                <li><i class="trig"></i>Beauty</li>
                <li><i class="trig"></i>Books</li>
                <li><i class="trig"></i>CD/DVD</li>
                <li><i class="trig"></i>Appliances</li>
                <li><i class="trig"></i>Arts</li>
                <li><i class="trig"></i>Beauty</li>
                <li><i class="trig"></i>Books</li>
                <li><i class="trig"></i>CD/DVD</li>
            </ul>
        </li>
        </ul>
    </div>
    
	<div class="panel p-right">
    	<div class="arrow"></div>
        <ul class="p-group">
        	<li class="signin" ><form> 
            <div class="input-append"><input type="text" class="input-medium input-email-panel" placeholder="Email"><span class="add-on">@ntu.edu.sg</span></div>
  			<input type="password" class="input-medium" placeholder="Password">
  			<label class="checkbox" ><input type="checkbox" >Remember me </label> <button type="submit" class="btn btn-primary btn-signin">&nbsp Sign in &nbsp</button> </form></li>
        </ul>
        <hr>
        <div class="signuptitle">
            <h3>New to U-mall?</h3>
            <h5>Sign up and start posting your stuff</h5>
        </div>
        <ul class="p-group">
        	<li class="signup"><form> 
            <div class="input-append"><input type="text" class="input-medium input-email-panel" placeholder="Email"><span class="add-on">@ntu.edu.sg</span></div>
  			<input type="text" class="input-medium" placeholder="Full Name">
            <input type="password" class="input-medium" placeholder="Password">
  			<button type="submit" class="btn btn-danger btn-large btn-signup">Sign up for U-mall</button> </form></button>
        </ul>
        <hr>
        <ul class="p-group p-hover">
            <a href=#><li><i class="icon-question-sign"></i>FAQ List<i class="icon-chevron-right pull-right"></i></li></a>
            <hr>
            <a href=#><li><i class="icon-envelope"></i>Contact us<i class="icon-chevron-right pull-right"></i></li></a>
        </ul>
    </div>	
    
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner ">
      	<div class="row">
        	<div class="span2 hidden-phone">
                <form class="form-search searchbar">
                      <div class="input-append">
                           <input class="input-small search-query"  placeholder="Search" id="appendedInput" size="16" type="text"><span class="add-on"><i class="icon-search"></i></span>
                      </div>
                </form>
            </div>
            <div class="span2">
              <a class="logo logo-mid hidden-phone" href="./index.html"></a>
              <a class="logo logo-left visible-phone" href="#"></a>
            </div>
            <div class="span3 login pull-right">
              <i class="icon-user"></i> Account & Help
            </div>
        </div>
      </div>
    </div>
	<br><br><br>
    
    <div class="container">
    <h1 class="content-header">Create an account <small> (or <a href="">sign in</a>)</small></h1>
    <div class="alert fade in alert-block alert-register">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
          </div>
   	<div class="row">
    	<div class="span4"><div class="darthvader"><div class="darth-baloon">Come to me my son ...</div></div></div>
        <div class="span6">
        <form class="form-horizontal">
          <div class="control-group">
            <label class="control-label" for="input01">Email Address</label>
            <div class="controls"><div class="input-append">
              <input type="text" class="input-xlarge input-email" id="input01"><span class="add-on add-on-input-email">@ntu.edu.sg</span></div>
              <p class="help-block">We don't share your email other web idiots. We'll only email if something's awesome or not great.</p>
            </div>
          </div>
          <hr>
		  <div class="control-group">
            <label class="control-label" for="input02">Full Name</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="input02">
              <p class="help-block">Yeah, looks like your mom choose a good one!</p>
            </div>
          </div>
          <hr>
		  <div class="control-group">
            <label class="control-label" for="input03">Phone Number</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="input03">
            </div>
          </div>
          <hr>
		  <div class="control-group">
            <label class="control-label" for="input04">Password</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="input04">
              <p class="help-block">Make it strong dude!</p>
            </div>
          </div>
          <hr>
		  <div class="control-group">
            <div class="controls">
              <label class="checkbox" ><input type="checkbox" >I agree with the terms and conditions </label>
            </div>
          </div>          
            <button type="submit" class="btn btn-primary btn-large btn-register">Awesome, Let's Finish and Login!</button>
      </form>
        </div>
    </div>
    </div> <!-- /container -->
    	<?php
    	include "footer.php";
    	?>
<div class="footerphone visible-phone"><hr>© NTU Student Union 2012</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php
    include "footer_include_assets.php";
    ?>
  </body>

</html>
