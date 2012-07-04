<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>U-Mall</title>
	
<?php include "includes/header_include_assets.php"; ?>   
    
	<style type="text/css">
	  .eror_txt{
			text-align:center;}
		.troll{
			background:url(<?php echo $msg_img; ?>);
			width:200px;
			height:200px;
			margin:0px auto 20px auto}
    </style>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>
 
 <?php include "includes/header.php"; ?>
 
	<br><br><br>
    
    <div class="container">
			<h1 class="content-header"><?php echo $msg_title; ?></h1>
      <div class="troll"></div>
    	<p class="eror_txt"><?php echo $msg_content; ?></p>
    
    </div> <!-- /container -->
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
