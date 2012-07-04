<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>U-Mall</title>
<?php include "includes/header_include_assets.php"; ?>   
    <style type="text/css">
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
		
	<div class="modal hide" id="deleteconfirmation">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Confirmation</h3>
      </div>
      <div class="modal-body">
		<p>
			Item title: <b><span id="modalTitle">The Item Name</span></b>
		</p>
        <p>Are sure you want to delete this item?</p>
      </div>
      <div class="modal-footer">
		<form id="modalForm" style="display:inline;" method="post" action="<?php echo site_url()."/item/delete/"; ?>"><input type="hidden" name="prev" value="<?php echo $crnt; ?>">
		<button type="submit" class="btn btn-danger">Yes, please delete it</button>
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
		</form>
      </div>
    </div>
		
		<h1 class="content-header">Posted items</h1>
		
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

    <?php if(isset($items)&&$items) { ?>
    <table class="table table-bordered t-items">
        <tbody>
		<?php foreach($items as $val) { ?>
          <tr <?php if(isset($theItem)&&$theItem&&$theItem==$val['itemID']) echo "id=\"theItem\""; ?>>
            <td><a href="<?php echo site_url()."/item/view/".$val['itemID']; ?>"><img src="<?php echo base_url()."/pictures/".$val['image']; ?>"></a></td>
            <td>
				<h4><a href="<?php echo site_url()."/item/view/".$val['itemID']; ?>" id="title<?php echo $val['itemID']; ?>"><?php echo character_limiter($val['name'],48); ?></a></h4><br>
				<p class="help-block">
					<a href="item_fixed_sellerview.html#customertable"><!--new notifs--></a><br>
					<?php
						if($val['enabled']=='no') echo "This item is hidden. Click unhide to offer this item to public<br>";
						if(human_to_unix($val['expiryDate'])<$now) echo "This item is <font color=\"red\">expired</font>. Click edit item to prolong the offer.";
					?>
				</p>
				<form style="display:inline;" method="post" action="<?php echo site_url()."/item/edit/".$val['itemID']; ?>"><input type="hidden" name="prev" value="<?php echo $crnt; ?>"><button type="submit" class="btn"><i class="icon-pencil"></i> Edit</button></form>
				<form style="display:inline;" method="post" action="<?php echo site_url()."/item/toggle_hide/".$val['itemID']; ?>"><input type="hidden" name="prev" value="<?php echo $crnt; ?>">
					<?php if($val['enabled']=='no') { ?> <button type="submit" class="btn active"><i class="icon-eye-close"></i> Unhide</button>
					<?php } else if($val['enabled']=='yes') { ?> <button type="submit" class="btn"><i class="icon-eye-open"></i> Hide</button> <?php } ?>
				</form> 
				<a data-toggle="modal" href="#deleteconfirmation" class="btn btn-danger" <?php echo "onclick=\"injectInfo('".$val['itemID']."');\""; ?>><i class="icon-trash icon-white"></i> Remove</a>
			</td>
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
	
	<script>
		function injectInfo(itemID) {
			var x=document.getElementById("modalTitle");
			var y=document.getElementById("title"+itemID);
			x.innerHTML=y.innerHTML;
			var z=document.getElementById("modalForm");
			z.action="<?php echo site_url(); ?>/item/delete/"+itemID;
		}
	</script>
	
    <div class="pagination pull-right">
      <ul>
	  
	<?php
		$page=$in_data['page']; $maxpage=$in_data['maxpage'];
		$link=site_url()."/user/items";
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
