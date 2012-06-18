<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
<?php include "header_include_assets.php"; ?>   
    <style type="text/css">
	  /*BANNER */
	  .banner{
		  margin:50px auto 50px -60px;
		  border-radius:10px;
		  width:1059px;
		  background: url(assets/img/banner4.jpg) no-repeat;
		  height:267px;
	  }
	
	/* Grid PRODUCT THUMBNAIL */
	.s-shade{
		width:940px;
		height:10px;
		background:url(assets/img/s-shade.jpg);
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
		background: url(assets/img/glossy.png);
		width:198px;
		height:198px;
		position:absolute;}
	.thumbnail > img {
		border-radius:3px;
		box-shadow: 0 0 2px #333;
		}
	.thumbnails{
		margin-bottom:-30px;}
    </style>
  
  </head>

  <body>
  	
<?php include "header.php"; ?>
    
    
    <!--<div class="banner-overlay hidden-phone hidden-tablet"></div>-->
    
	<br><br><br>
    
    <div class="container">
    <?php
    include "categories.php";
    ?>
	<!--<img class="banner" src="assets/img/banner4.jpg">-->
    <div class="banner"></div>
    
    <div class="t-head">
    <h1>Browse and bid your college mate collections</h1>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when  typesetting. <a href="#"> Learn more about the bidding system</a></p>
    </div>
    
    <div class="s-shade"></div>
    
    <!-- <span class="label label-inverse">Recent items ></span> -->
    <br>
    <ul class="thumbnails">
      <li class="span3">
        <a href="#" class="thumbnail">
          <div class="item-overlay"></div>
          <img src="./assets/img/thumb1.jpg" alt="">
        </a>
        <p class="item-title">Espresso and Cappuccino Maker</p>
        <p class="item-price">Latest Bid: $59</p>
       
      </li>
	</ul>
    </div> <!-- /container -->
    	

<?php include "footer.php"; ?>


<div class="footerphone visible-phone"><hr>© NTU Student Union 2012</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php
    include "footer_include_assets.php";
    ?>
  </body>

</html>
