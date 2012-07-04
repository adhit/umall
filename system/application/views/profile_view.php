<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>U-Mall</title>
<?php include "includes/header_include_assets.php"; ?>   
    <style type="text/css">
	.t-items{
		margin-top:30px;
		color:#000;}
	.t-items th{
		font-size:20px;
		font-weight:bold;
		text-align:center;}
	.t-items td{
		padding: 20px;}
	.t-items td:first-child{ /*thumbnail*/
		width: 100px;
		padding-right:0px;}
	.t-items td:nth-child(2){
		width:400px;
		border-left:none;
		text-align:left;}
	.t-items td:nth-child(2) h4 a{
		font-size:15px;
		line-height:30px;
		color:#000;
		cursor:pointer;
		}
	.t-items td:nth-child(3){
		width:150px;
		border-left:none;}
    
	.bid-latest{
		font-size:15px;
		font-weight:bold;
		line-height:30px;}
	.bid-latest abbr{
		font-size:12px;
		font-weight:normal;
		color:#666;}
	.bid-stock{
		line-height:px;}
	.bid-addinfo{
		color:#666;}
  .result-queries{
		margin-top:30px;
		display:block;
		font-size:15px;
		margin-bottom:-20px;}
	.well{
		padding:50px 30px;
		margin-top:40px;}
	.contactinfo{
		text-align:center;}
	.contactinfo .icon-pencil{
		margin-top:-20px;
		opacity:0;}
	.contactinfo #phonenumber{
		color:#000;}
	.contactinfo .icon-pencil1{
		background-position: 0 -72px;
		margin-top:-20px;
		opacity:0;}
	.contactinfo #fullname{
		color:#000;}
    </style>
  
  </head>

  <body>
  	
<?php include "includes/header.php"; ?>
    
    
    <!--<div class="banner-overlay hidden-phone hidden-tablet"></div>-->
    
	<br><br><br>
    
    <div class="container">

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
	
        <div class="well contactinfo">
		<!--
        	<i class="icon-pencil1 pull-left"></i>
        	<i class="icon-pencil pull-right"></i>
		-->
          <h2><a href="<?php if(isset($user)&&$user&&$user['userID']==$the_user['userID']) echo site_url()."/user/editname"; ?>"><span id="fullname"><?php echo $the_user['name']; ?></span></a> / 
            <a href="mailto:<?php echo $the_user['email']; ?>"><?php echo $the_user['email']; ?></a> /
            <a href="<?php if(isset($user)&&$user&&$user['userID']==$the_user['userID']) echo site_url()."/user/editphone"; ?>"><span id="phonenumber"><?php echo $the_user['contactNumber']; ?></span></a>
          </h2>
		  <?php
			if(isset($user)&&$user['userID']==$the_user['userID']) {
				echo "<br/><a href=\"".site_url()."/user/editpass\">(Change my password)</a>";
			}
		  ?>
        </div>
      
    <span class="result-queries"><span class="result-text">Items posted by this user:</span></span>  
	
    <?php if(isset($items)&&$items) { ?>
    <table class="table table-bordered t-items">
        <tbody>
		<?php foreach($items as $val) { ?>
          <tr>
            <td><a href="<?php echo site_url()."/item/view/".$val['itemID']; ?>"><img class="span3" src="<?php echo base_url()."/pictures/".$val['image']; ?>"></a></td>
            <td><h4><a href="<?php echo site_url()."/item/view/".$val['itemID']; ?>"><?php echo character_limiter($val['name'],48); ?></a></h4><?php echo character_limiter($val['description'],360); ?></td>
            <?php if($val['type']=='fixed') { ?>
				<td>
					<span class="bid-latest">S$ <?php echo $val['price']; ?> <abbr title="You can purchase this item immediately at the price">(Fixed price)</abbr></span><br/>
					<span class="bid-expiry">Time left: 
					<?php
						if(human_to_unix($val['expiryDate'])<$now) echo "<font color=\"red\">Expired</font>";
						else echo timespan_shorten(timespan($now,human_to_unix($val['expiryDate']))); 
					?></span><br/>
					<span class="bid-addinfo"><span class="space"></span><?php echo $val['num_bids']; ?> users want this item<br></span>
				</td>
			<?php } else if($val['num_bids']==0){ ?>
				<td>
					<span class="bid-latest">S$ &#8212 <abbr title="Currently no offer placed for this item">(No offer yet)</abbr></span><br/>
					<span class="bid-expiry"><span title="Negotiable price asked by the seller.">Ask price: <span class="color-warning">S$ <?php echo $val['price']; ?></span></span><br>
					Time left:
					<?php
						if(human_to_unix($val['expiryDate'])<$now) echo "<font color=\"red\">Expired</font>";
						else echo timespan_shorten(timespan($now,human_to_unix($val['expiryDate']))); 
					?></span><br/>
				</td>
			<?php } else if($val['pen_bids']==0) { ?>
				<td>
					<span class="bid-latest">S$ &#8212 <abbr title="Currently there is no pending offer for this item">(No pending offer)</abbr></span><br/>
					<span class="bid-expiry"><span title="Negotiable price asked by the seller.">Ask price: <span class="color-warning">S$ <?php echo $val['price']; ?></span></span><br>
					Time left: 
					<?php
						if(human_to_unix($val['expiryDate'])<$now) echo "<font color=\"red\">Expired</font>";
						else echo timespan_shorten(timespan($now,human_to_unix($val['expiryDate']))); 
					?></span><br/>
					<span class="bid-addinfo"><span class="space"></span><?php echo $val['num_bids']; ?> bids has been placed<br><?php echo $val['acc_bids']; ?> bids has been accepted </span>
				</td>
			<?php } else { ?>
				<td>
					<span class="bid-latest">S$ <?php echo $val['highest']; ?> <abbr title="Highest price offered by potential buyer">(Highest offer)</abbr></span><br/>
					<span class="bid-expiry"><span title="Negotiable price asked by the seller.">Ask price: <span class="color-warning">S$ <?php echo $val['price']; ?></span></span><br>
					Time left: 
					<?php
						if(human_to_unix($val['expiryDate'])<$now) echo "<font color=\"red\">Expired</font>";
						else echo timespan_shorten(timespan($now,human_to_unix($val['expiryDate']))); 
					?></span><br/>
					<span class="bid-addinfo"><span class="space"></span><?php echo $val['num_bids']; ?> bids has been placed<br><?php echo $val['acc_bids']; ?> bids has been accepted </span>
				</td>
			<?php } ?>
          </tr>
		<?php } ?>
        </tbody>
      </table>
	<?php } else { ?>
	<br/><br/>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        This user has not posted any item
    </div>
	
	<?php } ?>
    <div class="pagination pull-right">
      <ul>
	  
	<?php
		$page=$in_data['page']; $maxpage=$in_data['maxpage'];
		$link=site_url()."/user/profile/".$the_user['userID'];
		if($page>1) {
			echo "<li><a href=\"".$link."/1\">First</a></li>";
			echo "<li><a href=\"".$link."/".($page-1)."\">Prev</a></li>";
		}
		if($page>1+2) echo "<li><a href=\"#\" class=\"disabled\">...</a></li>";
		for($i=$page-2;$i<$page;$i++) {
			if($i<1) continue;
			echo "<li><a href=\"".$link."/".($i)."\">".$i."</a></li>";
		}
		echo "<li class=\"active\"><a href=\"#\">".$i."</a></li>";
		for($i=$page+1;$i<=$page+2;$i++) {
			if($i>$maxpage) break;
			echo "<li><a href=\"".$link."/".($i)."\">".$i."</a></li>";
		}
		if($page+2<$maxpage) echo "<li class=\"disabled\"><a href=\"#\">...</a></li>";
		if($page<$maxpage) {
			echo "<li><a href=\"".$link."/".($page+1)."\">Next</a></li>";
			echo "<li><a href=\"".$link."/".$maxpage."\">Last</a></li>";
		}
	?>
	
      </ul>
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
	
    <script type="text/javascript">
		// TO DISPLAY EDIT
		var pencil = $('.contactinfo .icon-pencil');		
		$('#phonenumber').hover(function(){pencil.css('opacity','1')},function(){pencil.css('opacity','0')})	
		// TO DISPLAY EDIT
		var pencil1 = $('.contactinfo .icon-pencil1');		
		$('#fullname').hover(function(){pencil1.css('opacity','1')},function(){pencil1.css('opacity','0')})	
				
	</script>
	
  </body>

</html>
