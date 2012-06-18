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
	.timestamp{
		font-size:9px;
		color:#ccc;}
	.notification{
		list-style:none;
		border-radius:4px;
		overflow:hidden;}
	.notification hr{
		margin:0px 0px;
		border-bottom:#333;
		}
	.notification li{
		padding:10px;}
	.notification li.unread{
		background:#e7f6fd;
		border-radius:0px;}
	.notification li:hover{
		background: #f7fbfd;
		}
	.btn-clearnotif{
		margin-bottom:20px;
		margin-top:-62px;}
    </style>
  </head>

  <body>
  <?php
  include "header.php";
  ?>
	<br><br><br>
    
    <div class="container">
    <h1 class="content-header">Notifications</h1>
    <div class="row">
    <div class="btn span2 btn-small offset2 btn-danger btn-clearnotif">Clear new notification</div></div>
   	<div class="row">
        <ul class="span8 offset2 notification">
        	<li class="unread">An anonymous bidded your <a href=#>Espresso and Cappuccino Maker</a> item for S$ 30. <span class="timestamp">08.36 am</span></li><hr>
        	<li><a href=#>Evan purnama</a> accepted your bid on <a href=#>Espresso and Cappuccino Maker</a> item for S$ 30. Your contact information is now revealed to the particular person. <span class="timestamp">08.22 am</span></li><hr>
        	<li>Your <a href=#>Espresso and Cappuccino Maker</a> item is now expired after 14 days inactivity. <a href=#>Click here</a> to repost the item. <span class="timestamp">10.36 am</span></li><hr>
        	<li>You've just successfully posted <a href=#>Espresso and Cappuccino Maker</a>. <span class="timestamp">05.50 am</span></li><hr>
        </ul>
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
   	    <script type="text/javascript">
		// COPY PRODUCT *MALES
		var a = $('.notification');
		var b = a.children('li');
		
		for (i=1; i<30; i++){a.append('<li>'+b.eq(i%4).html()+'</li><hr>');};	
		
		$('.btn-clearnotif').click(function () {$(this).addClass('disabled');b.removeClass('unread')});
    </script>
  </body>

</html>
