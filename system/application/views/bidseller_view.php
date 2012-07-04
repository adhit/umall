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


<!-- Confirmation Modals Begin -->
	<div class="modal hide" id="deleteconfirmation">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Confirmation</h3>
      </div>
      <div class="modal-body">
        <p>Are sure you want to delete this item?</p>
      </div>
      <div class="modal-footer">
      <a href="<?php echo site_url()."/item/delete/".$item['itemID']; ?>" class="btn btn-danger">Yes, please delete it</a>
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
      </div>
    </div>
    <div class="modal hide" id="approveconfirmation">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Confirmation</h3>
      </div>
      <div class="modal-body">
        <p>
        	Item title: <b><?php echo $item['name']; ?></b><br>
        	Buyer: &nbsp;&nbsp;&nbsp;<b><span id="modalBidder">user0001</span></b> <br/>
        	Price: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><span id="modalPrice">S$ 200</span></b> 
        </p>
        <p>Are sure you want to accept the bid for this item? </p><br>
        <p class="help-block color-gray">Note: Please contact the buyer upon your acceptance to arrange the transaction</p>
      </div>
      <div class="modal-footer">
		<a id="modalSubmit" href="#" class="btn btn-primary">Yeah, sure</a>
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
      </div>
    </div>
    <div class="modal hide" id="rejectconfirmation">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Confirmation</h3>
      </div>
      <div class="modal-body">
        <p>
        	Item title: <b><?php echo $item['name']; ?></b><br>
        	Buyer: &nbsp;&nbsp;&nbsp;<b><span id="modalBidderReject">user0001</span></b> <br/>
        	Price: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><span id="modalPriceReject">S$ 200</span></b> 
        </p>
        <p>Are sure you want to reject the offer for this item? </p>
      </div>
      <div class="modal-footer">
      <a id="modalSubmitReject" href="#" class="btn btn-primary btn-danger">Yes, reject it</a>
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
      </div>
    </div>
<!-- Confirmation Modals End -->

			<table class="table table-bordered t-items">
				<tr>
					<td class="thumb"><img class="span3" src="<?php echo base_url()."/pictures/".$item['image']; ?>"></td>
					<td class="desc">
						<h4><?php echo character_limiter($item['name'],40); ?></h4><?php echo character_limiter($item['description'],360); ?>
						<div class="action-group">
							<div class="form-inline">
								<label class="help-block">You are the seller of this item</label><br>
								<label> <abbr title="Offering higher bid price improves your chance to be accepted">Bid Price</abbr> : &nbsp;&nbsp;<div class="input-prepend"><span class="add-on">S$</span><input name="price" disabled="disabled" type="text" class="input-small2" placeholder="Bid price" value="<?php echo $item['price']; ?>" id="inpPrice"></div></label>
								<?php
									echo "<button disabled=\"disabled\" title=\"You're the seller of this item, so you can't place an offer.\" class=\"btn btn-large btn-primary btn-bid\">Place an offer</button>";
								?>
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
							<tr><td class="detail-item">Seller:</td><td><a href="<?php echo site_url()."/user/profile/".$seller['userID']; ?>" class="person" rel="tooltip" data-original-title="Name: <?php echo $seller['name']; ?> <br> Phone: <?php echo $seller['contactNumber']; ?> <br> Email: <?php echo $seller['email']; ?>"><?php echo $seller['username']; ?></a> (You)</td></tr>
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
				<tr>
					<td colspan=2 id="focus"><h3 style="text-align:center;">Pending bids that needs approval</h3> <br>
						<table class="table-condensed bidding-table-sellerview">
							<tr><td>Date</td><td>Name</td><td>Bid Price</td><td>Current status</td><td>Actions</td></tr>
							<?php
								$d_str = "%d/%m/%y";
								if(!isset($focus)||!$focus) $focus=array();
								if(isset($bids)&&$bids) {
									foreach($bids as $val) {
										if(in_array($val['bidID'],$focus)) echo "<tr class=\"unread\">";
										else echo "<tr>";
										echo "<td class=\"number\">".mdate($d_str, human_to_unix($val['timeLatest']))."</td>";
										echo "<td><a id=\"bidder".$val['bidID']."\" href=\"#\" class=\"person\" rel=\"tooltip\" data-original-title=\"Name: ".$val['name']." <br> Phone: ".$val['contactNumber']." <br> Email: ".$val['email']."\">".$val['username']."</a></td>";
										echo "<td id=\"price".$val['bidID']."\">S$ ".$val['price']."</td>";
										if($val['approved']=="yes") echo "<td class=\"approved\">accepted</td><td>-</td>";
										else if($val['approved']=="no") {
											echo "<td>pending</td><td>";
											echo "<a data-toggle=\"modal\" href=\"#approveconfirmation\" class=\"btn btn-small\" onclick=\"injectInfo('".$val['bidID']."');\"><i class=\"icon-ok\"></i> Accept</a> ";
											echo "<a data-toggle=\"modal\" href=\"#rejectconfirmation\" class=\"btn btn-small btn-danger\" onclick=\"injectInfoReject('".$val['bidID']."');\"><i class=\"icon-remove\"></i> Reject</a>";
											echo "</td>";
										}
										else {
											echo "<td class=\"pending\">rejected</td><td>";
											echo "<a data-toggle=\"modal\" href=\"#approveconfirmation\" class=\"btn btn-small\" onclick=\"injectInfo('".$val['bidID']."');\"><i class=\"icon-ok\"></i> Accept</a>";
											echo "<a data-toggle=\"modal\" class=\"btn btn-small btn-danger disabled\"><i class=\"icon-remove\"></i> Reject</a>";
											echo "</td>";
										}
										echo "</tr>";
									}
								}
							?>
						</table>
						<script>
							function injectInfo(bidID) {
								var x=document.getElementById("modalBidder");
								var y=document.getElementById("bidder"+bidID);
								x.innerHTML=y.innerHTML;
								var x=document.getElementById("modalPrice");
								var y=document.getElementById("price"+bidID);
								x.innerHTML=y.innerHTML;
								var z=document.getElementById("modalSubmit");
								z.href="<?php echo site_url(); ?>/item/accept/"+bidID;
							}
							function injectInfoReject(bidID) {
								var x=document.getElementById("modalBidderReject");
								var y=document.getElementById("bidder"+bidID);
								x.innerHTML=y.innerHTML;
								var x=document.getElementById("modalPriceReject");
								var y=document.getElementById("price"+bidID);
								x.innerHTML=y.innerHTML;
								var z=document.getElementById("modalSubmitReject");
								z.href="<?php echo site_url(); ?>/item/reject/"+bidID;
							}
						</script>
					</td>
					<td class="owner">
						<h3 class="owner-text">You are the seller of this item and you may:</h3><br>
						<a href="<?php echo site_url()."/item/edit/".$item['itemID']; ?>" class="btn btn-large"><i class="icon-pencil"></i> Edit item</a> 
						<?php if($item['enabled']=="yes") { ?>
							<a href="<?php echo site_url()."/item/toggle_hide/".$item['itemID']; ?>" class="btn btn-large" title="Your hidden item won't be listed to public. This action is reversible."><i class="icon-eye-close"></i> Hide item from public </a>
						<?php } else if($item['enabled']=="no") { ?>
							<a href="<?php echo site_url()."/item/toggle_hide/".$item['itemID']; ?>" class="btn btn-large active" title="Your hidden item won't be listed to public. This action is reversible."><i class="icon-eye-open"></i> Unhide item from public</a>
						<?php } ?>
						<a data-toggle="modal" href="#deleteconfirmation" class="btn btn-large btn-danger"><i class="icon-trash icon-white"></i> Delete item permanently</a>
					</td>
				</tr>
			</table>
		</form>
	</div> <!-- /container -->
	
<?php //include "includes/footer.php"; ?>


<div class="footerphone visible-phone"><hr>� NTU Student Union 2012</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php
    include "includes/footer_include_assets.php";
    ?>
  </body>

</html>
