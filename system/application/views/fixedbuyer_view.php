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
	
		<form action="<?php echo site_url()."/item/bid"; ?>" method="post">
			<input type="hidden" name="itemID" value="<?php echo $item['itemID']; ?>">
			<input type="hidden" name="prev" value="<?php echo $crnt; ?>">
			<input type="hidden" name="price" value="<?php echo $item['price']; ?>">
		
			<div class="modal hide" id="placebid">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3>Placing a notice confirmation</h3>
				  </div>
				  <div class="modal-body">
					<p>
						Item title: <b><?php echo $item['name']; ?></b><br>
						I want to buy this item for S$ <?php echo $item['price']; ?></b> 
					</p>
					<p>Are sure you want to share your contact with the seller? </p>
				  </div>
				  <div class="modal-footer">
				  <input type="submit" value="Yeah, sure" class="btn btn-primary">
					<a href="#" class="btn" data-dismiss="modal">Cancel</a>
				</div>
			</div>
		
			<table class="table table-bordered t-items">
				<tr>
					<td class="thumb"><img class="span3" src="<?php echo base_url()."/pictures/".$item['image']; ?>"></td>
					<td class="desc">
						<h4><?php echo character_limiter($item['name'],40); ?></h4><?php echo character_limiter($item['description'],360); ?>
						<div class="action-group">
							<div class="form-inline">
								<?php
									if(isset($my_bid)&&$my_bid&&$my_bid['approved']=="yes") echo "<button class=\"btn btn-primary btn-buynow btn-large\" disabled=\"disabled\" title=\"You have left your contact information to this seller\">I want it, please contact me</button>";
									else if($status=="disabled") echo "<button class=\"btn btn-primary btn-buynow btn-large\" disabled=\"disabled\" title=\"This item offer has been hidden\">I want it, please contact me</button>";
									else if($status=="expired") echo "<button class=\"btn btn-primary btn-buynow btn-large\" disabled=\"disabled\" title=\"This item offer has expired\">I want it, please contact me</button>";
									else echo "<a data-toggle=\"modal\" href=\"#placebid\"><button class=\"btn btn-primary btn-buynow btn-large\" title=\"This item offer has expired\">I want it, please contact me</button></a>";
								?>
								<p class="help-block">By pressing this button, your contact information will be shared to the seller.</p> 
							</div>
						</div>   
					</td>
					<td>
						<span class="detailed-info">Detailed Information</span>
						<table class="table table-condensed detailed-table">
							<tr><td class="detail-item">Time left:</td><td><?php if($status=="expired") echo "<font class=\"pending\">Expired</font>"; else echo timespan_shorten(timespan($now,human_to_unix($item['expiryDate']))); ?></td></tr>
							<tr><td class="detail-item">Price:</td><td>S$ <?php echo $item['price']; ?></td></tr>
							<tr><td class="detail-item">Users interested:</td><td><?php echo $item['acc_bids']; ?></td></tr>
							<tr><td class="detail-item">Posted:</td><td><?php echo timespan_shorten(timespan(human_to_unix($item['timeCreated']),$now)); ?> ago</td></tr>
							<tr><td class="detail-item">Seller:</td><td><a href="<?php echo site_url()."/user/profile/".$seller['userID']; ?>" class="person" rel="tooltip" data-original-title="Name: <?php echo $seller['name']; ?> <br> Phone: <?php echo $seller['contactNumber']; ?> <br> Email: <?php echo $seller['email']; ?>"><?php echo $seller['username']; ?></a></td></tr>
							<tr><td class="detail-item">Item status:</td><td>
							<?php
								if($status=="disabled") echo "<span class=\"person\" rel=\"tooltip\" data-original-title=\"Hidden item won't be shown in search results\">hidden</span>";
								else if($status=="expired") echo "<span class=\"pending person\" rel=\"tooltip\" data-original-title=\"Click edit item button to change the expiry date\">expired</span>";
								else echo "<span class=\"approved\">active</span>";
							?></td></tr>
							<tr><td>&nbsp;</td></tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
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
