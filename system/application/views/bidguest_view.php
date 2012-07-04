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

			<table class="table table-bordered t-items">
				<tr>
					<td class="thumb"><img class="span3" src="<?php echo base_url()."/pictures/".$item['image']; ?>"></td>
					<td class="desc">
						<h4><?php echo character_limiter($item['name'],40); ?></h4><?php echo character_limiter($item['description'],360); ?>
						<div class="action-group">
							<div class="form-inline">
								<label class="help-block">You're not logged in</label><br>
								<label> <abbr title="You can propose lower or higher price than what the seller ask. Later, seller will decide to accept or reject your offer.">Price</abbr> : &nbsp;&nbsp;<div class="input-prepend"><span class="add-on">S$</span><input name="price" disabled="disabled" type="text" class="input-small2" placeholder="Bid price" value="<?php echo $item['price']; ?>" id="inpPrice"></div></label>
								<?php
									echo "<button disabled=\"disabled\" title=\"Please signin to do this\" class=\"btn btn-large btn-primary btn-bid\">Place an offer</button>";
								?>
								<script>
									function bidPriceCopy() {
										var x=document.getElementById("bidPrice");
										var y=document.getElementById("inpPrice");
										x.innerHTML=y.value;
									}
								</script>
							</div>
						</div>   
					</td>
					<td>
						<span class="detailed-info">Detailed Information</span>
						<table class="table table-condensed detailed-table">
							<tr><td class="detail-item">Time left:</td><td><?php if($status=="expired") echo "<font class=\"pending\">Expired</font>"; else echo timespan_shorten(timespan($now,human_to_unix($item['expiryDate']))); ?></td></tr>
							<tr><td class="detail-item">Asking price:</td><td>S$ <?php echo $item['price']; ?></td></tr>
							<tr><td class="detail-item">Highest pending:</td><td>S$ <?php echo $item['highest']; ?></td></tr>
							<tr><td class="detail-item">Total offers:</td><td><?php echo $item['num_bids']; ?></td></tr>
							<tr><td class="detail-item">Accepted offers:</td><td><?php echo $item['acc_bids']; ?></td></tr>
							<tr><td class="detail-item">Posted:</td><td><?php echo timespan_shorten(timespan(human_to_unix($item['timeCreated']),$now)); ?> ago</td></tr>
							<tr><td class="detail-item">Seller:</td><td><?php echo $seller['username']; ?></td></tr>
							<tr><td class="detail-item">Item status:</td><td>
							<?php
								if($status=="disabled") echo "<span class=\"person\" rel=\"tooltip\" data-original-title=\"Hidden item won't be shown in search results\">hidden</span>";
								else if($status=="expired") echo "<span class=\"pending person\" rel=\"tooltip\" data-original-title=\"Click edit item button to change the expiry date\">expired</span>";
								else echo "<span class=\"approved\">active</span>";
							?></td></tr>
							<tr><td>&nbsp;</td></tr>
							<tr><td colspan="2"><a class="view-bidding hid" href=#><span>Show history </span><i class="icon-mini-triangle"></i></a></td></tr>
						</table>
						<table class="table-condensed bidding-table">
							<tr><td>#</td><td>Bid Price</td><td>Status</td></tr>
							<?php
								$i=0;
								if(isset($bids)&&$bids) {
									foreach($bids as $val) {
										$i++;
										if(isset($my_bid)&&$my_bid&&$my_bid['bidID']==$val['bidID']) echo "<tr class=\"unread\">";
										else echo "<tr>";
										echo "<td>".$i."</td><td>".$val['price']."</td>";
										if($val['approved']=="yes") echo "<td class=\"approved\"><abbr title=\"Seller agreed upon the price and ready to make a deal at the given price.\">Accepted</abbr>";
										else if($val['approved']=="no") echo "<td><abbr title=\"Seller has not made a decision to accept/reject offer.\">Pending</abbr>";
										else echo "<td class=\"pending\"><abbr title=\"Seller wants a deal at higher price.\">Rejected</abbr>";
										echo "</td></tr>";
									}
								}
							?>
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
