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
	.thumbnail > div.sapi {
		border-radius:3px;
		box-shadow: 0 0 2px #333;
		width:200px; height:200px;
		display:table-cell;
		vertical-align:middle;
		}
	.thumbnails{
		margin-bottom:-30px;}
    </style>
  
  </head>

  <body>
  	
<?php include "includes/header.php"; ?>

    <!--<div class="banner-overlay hidden-phone hidden-tablet"></div>-->
    
	<br><br><br>
    
    <div class="container">
	
	<?php
    include "includes/categories.php";
    ?>
	
	<?php
	if(isset($msg['global_info'])) { ?>
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $msg['global_info']; ?>
    </div>
	<?php } ?>
	<?php
	if(isset($msg['global_success'])) { ?>
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $msg['global_success']; ?>
    </div>
	<?php } ?>
	<?php
	if(isset($msg['global_error'])) { ?>
    <div class="alert alert-error alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $msg['global_error']; ?>
    </div>
	<?php } ?>
	
	<!--<img class="banner" src="<?php echo base_url(); ?>/assets/img/banner4.jpg">-->
    <div class="banner"></div>
    
    <div class="t-head">
    <h1>Browse and bid your college mate collections</h1>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when  typesetting. <a href="#"> Learn more about the bidding system</a></p>
    </div>
    
    <div class="s-shade"></div>
    
    <!-- <span class="label label-inverse">Recent items ></span> -->
	<?php if(isset($popular)&&$popular) { ?>
	<h1>Popular Item</h1>Many users bought or bid these item. You may want to do so!<br><br>
    <ul class="thumbnails">
	<?php
	if(isset($popular)&&$popular) foreach($popular as $val) { ?>
      <li class="span3">
        <a href="<?php echo site_url()."/item/view/".$val['itemID']; ?>" class="thumbnail">
			<div class="sapi">
				<div class="item-overlay"></div>
				<img style="max-width:200px; max-height:200px; vertical-align:middle;" src="<?php echo base_url()."/pictures/".$val['image']; ?>" alt="">
			</div>
        </a>
        <p class="item-title"><?php echo character_limiter($val['name'],24); ?></p>
        <p class="item-price">
			<?php
			if($val['type']=='bid') echo $val['score']." accepted bids (total ".$val['score1']." bids)";
			else echo $val['score']." potential buyers";
			?>
		</p>
      </li>
	<?php } } ?>
	</ul>
	
	<?php if(isset($newest)&&$newest) { ?>
	<h1>Newest Item</h1>These items are most recently posted. Check them out!<br><br>
    <ul class="thumbnails">
	<?php
	if(isset($newest)&&$newest) foreach($newest as $val) { ?>
      <li class="span3">
        <a href="<?php echo site_url()."/item/view/".$val['itemID']; ?>" class="thumbnail">
			<div class="sapi">
				<div class="item-overlay"></div>
				<img style="max-width:200px; max-height:200px; width:200px; vertical-align:middle;" src="<?php echo base_url()."/pictures/".$val['image']; ?>" alt="">
			</div>
		</a>
        <p class="item-title"><?php echo character_limiter($val['name'],24); ?></p>
        <p class="item-price">
			<?php
			echo "Posted ".timespan_shorten(timespan(human_to_unix($val['timeCreated']), $now))." ago";
			?>
		</p>
      </li>
	<?php } } ?>
	</ul>
	
	<?php if(isset($barely)&&$barely) { ?>
	<h1>Just Barely</h1>No time to waste! Buy or bid now while you still can!<br><br>
    <ul class="thumbnails">
	<?php
	if(isset($barely)&&$barely) foreach($barely as $val) { ?>
      <li class="span3">
        <a href="<?php echo site_url()."/item/view/".$val['itemID']; ?>" class="thumbnail">
			<div class="sapi">
				<div class="item-overlay"></div>
				<img style="max-width:200px; max-height:200px; width:200px; vertical-align:middle;" src="<?php echo base_url()."/pictures/".$val['image']; ?>" alt="">
			</div>
		</a>
        <p class="item-title"><?php echo character_limiter($val['name'],24); ?></p>
        <p class="item-price">
			<?php
			echo "Expired in ".timespan_shorten(timespan($now,human_to_unix($val['expiryDate'])));
			?>
		</p>
      </li>
	<?php } } ?>
	</ul>
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
