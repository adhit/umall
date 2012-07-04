<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>U-Mall</title>
<?php include "includes/header_include_assets.php"; ?>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
  
<?php include "includes/header.php"; ?>
    <link href="<?php echo base_url(); ?>/assets/css/product.css" rel="stylesheet">
  
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
	//print_r($msg);
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
	
	<span class="result-queries"><span class="result-text">Related tags : &nbsp;</span>
	<?php
	if(!isset($the_tags)||!$the_tags) echo "no tags";
	else {
		foreach($the_tags as $val) if($val['special']=='no') echo "<span class=\"label label-info hidden-phone\"><a href=\"".site_url()."/item/listing/tag/".$val['tagID']."\">".ucfirst($val['tagname'])."</a></span> ";
		foreach($the_tags as $val) if($val['special']=='yes') echo "<span class=\"label label-important hidden-phone\"><a href=\"".site_url()."/item/listing/tag/".$val['tagID']."\">".ucfirst($val['tagname'])."</a></span> ";
	}
	?>
	</span>
	
		<table class="table table-bordered t-items">
		
		  <tr>
			<td class="thumb"><img class="span3" src="<?php echo base_url()."/pictures/".$item['image']; ?>"></td>
			<td class="desc">
				<h4><?php echo character_limiter($item['name'],48); ?></h4><?php echo character_limiter($item['description'],360); ?>
				<div class="action-group">
					<form class="form-inline">
					
					<?php
					if($type='fixed') {
						if($role=='guest') {
							if($status=='expired') {
							}
							else {
							}
						}
						else if($role=='seller') {
							if($status=='expired') {
							}
							else {
							}
						}
						else if($role=='guest') {
							if($status=='expired') {
							}
							else {
							}
						}
					}
					else if($type='bid') {
						if($role=='guest') {
							if($status=='expired') {
							}
							else {
							}
						}
						else if($role=='seller') {
							if($status=='expired') {
							}
							else {
							}
						}
						else if($role=='guest') {
							if($status=='expired') {
							}
							else {
							}
						}
					}
					?>
					
					<button class="btn btn-primary btn-buynow disabled" disabled>Buy now</button><br>
					<span class="tot-price">Click the button to share your contact with the seller</span></span>
					</form>
				</div>   
			</td>
			<td>
				<span class="detailed-info">Detailed Information</span>
				<?php
				if($type=="fixed") {
				?>
				
					<table class="table table-condensed detailed-table">
						<tr><td class="detail-item" rowspan=2>Posted:</td><td><?php echo timespan_shorten(timespan(human_to_unix($item['timeCreated']),$now))." ago"; ?></td></tr>
						<tr><td>(<?php echo $item['timeCreated']." SGT"; ?>)</td></tr>
						<tr><td class="detail-item" rowspan=2>Time left:</td><td><?php echo timespan_shorten(timespan($now,human_to_unix($item['expiryDate']))); ?></td></tr>
						<tr><td>(<?php echo $item['expiryDate']." SGT"; ?>)</td></tr>
						<tr><td class="detail-item">Price:</td><td>S$ <?php echo $item['price']; ?> <abbr title="Fixed priced item can be bought right away">(Fixed price)</abbr></td></tr>
						<tr><td class="detail-item">Seller:</td><td><?php echo $seller['username']; ?></td></tr>
						<tr><td class="detail-item">Full name:</td><td><?php echo $seller['name']; ?></td></tr>
						<tr><td class="detail-item">Email:</td><td><?php echo $seller['email']; ?></td></tr>
						<tr><td class="detail-item">Phone:</td><td><?php if($seller['show']=='yes') echo $seller['contactNumber']; else echo "not shown"; ?></td></tr>
						<tr><td>&nbsp;</td></tr>
						<?php if($role=='seller') echo "<tr><td colspan=\"2\"><a class=\"view-bidding hid\" href=#><span>Show interested users</span><i class=\"icon-mini-triangle\"></i></a></td></tr>"; ?>
					</table>
					
					<?php if($role=='seller') { ?>
					
						<table class="table-condensed fixed-table">
							<?php if(isset($bids)&&$bids) { ?>
								<tr><td>Username</td><td>Full name</td></tr>
							<?php 
								foreach($bids as $val) {
									echo "<tr><td>".$val['username']."</td><td>".$val['name']."</td></tr>";
								}
							?>
							<?php } else { ?>
								<tr><td>No potential buyers yet</td></tr>
							<?php } ?>
						</table>
					
					<?php } ?>
				
				<?php }
				else if($type=="bid") {
				?>
				
				<?php }
				?>
			</td>
		  </tr>
		
		</table>
	
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
