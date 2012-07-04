<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>U-Mall</title>
<?php include "includes/header_include_assets.php"; ?>   
    <style type="text/css">
    </style>
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
	
	<span class="result-queries"><span class="result-text">Search Result: </span>
	<select name="sort" onchange="pindah(this.value)">
		<option value="match" <?php if(!isset($in_data['sort'])||$in_data['sort']=="match") echo "selected"; ?>>Most related</option>
		<option value="newtoold" <?php if(isset($in_data['sort'])&&$in_data['sort']=="newtoold") echo "selected"; ?>>Most recent</option>
        <option value="pop" <?php if(isset($in_data['sort'])&&$in_data['sort']=="pop") echo "selected"; ?>>Most popular</option>
		<option value="pasc" <?php if(isset($in_data['sort'])&&$in_data['sort']=="pasc") echo "selected"; ?>>Cheapest price</option>
	</select>
	</span>
	
	<script>
	function pindah(sort) {
		var url="<?php echo site_url(); ?>";
		url+="/item/listing";
		<?php 
			foreach($in_data as $key=>$val) {
				if($key=="sort") continue;
				if($key=="maxpage") continue;
				if($key=="each") continue;
		?>
				url+="<?php echo "/".$key."/".$val; ?>";
		<?php
			}
		?>
		url+="/sort/"+sort;
		window.location.href=url;
	}
	</script>
	
	<!-- &nbsp;</span><span class="label label-info hidden-phone"><a href="#">Accesories</a></span><span class="label label-info hidden-phone"><a href="#">Clothings</a></span><span class="label label-important hidden-phone"><a href="#">NBS</a></span><span class="label label-important hidden-phone"><a href="#">SCE</a></span></span>
	-->
	<?php if(isset($items)&&$items) { ?>
    <table class="table table-bordered t-items">
        <tbody>
		<?php foreach($items as $val) { ?>
          <tr>
            <td><a href="<?php echo site_url()."/item/view/".$val['itemID']; ?>"><img src="<?php echo base_url()."/pictures/".$val['image']; ?>"></a></td>
            <td><h4><a href="<?php echo site_url()."/item/view/".$val['itemID']; ?>"><?php echo character_limiter($val['name'],48); ?></a></h4><?php echo character_limiter($val['description'],360); ?></td>
            <?php if($val['type']=='fixed') { ?>
				<td>
					<span class="bid-latest">S$ <?php echo $val['price']; ?> <abbr title="You can purchase this item immediately at the price">(Fixed price)</abbr></span><br/>
					<span class="bid-expiry">Time left: <?php echo timespan_shorten(timespan($now,human_to_unix($val['expiryDate']))); ?></span><br/>
					<span class="bid-addinfo"><span class="space"></span><?php echo $val['num_bids']; ?> users want this item<br></span>
				</td>
			<?php } else if($val['num_bids']==0){ ?>
				<td>
					<span class="bid-latest">S$ &#8212 <abbr title="Currently no offer placed for this item">(No offer yet)</abbr></span><br/>
					<span class="bid-expiry"><span title="Negotiable price asked by the seller.">Ask price: <span class="color-warning">S$ <?php echo $val['price']; ?></span></span><br>
					Time left: <?php echo timespan_shorten(timespan($now,human_to_unix($val['expiryDate']))); ?></span><br/>
				</td>
			<?php } else if($val['pen_bids']==0) { ?>
				<td>
					<span class="bid-latest">S$ &#8212 <abbr title="Currently there is no pending offer for this item">(No pending offer)</abbr></span><br/>
					<span class="bid-expiry"><span title="Negotiable price asked by the seller.">Ask price: <span class="color-warning">S$ <?php echo $val['price']; ?></span></span><br>
					Time left: <?php echo timespan_shorten(timespan($now,human_to_unix($val['expiryDate']))); ?></span><br/>
					<span class="bid-addinfo"><span class="space"></span><?php echo $val['num_bids']; ?> bids has been placed<br><?php echo $val['acc_bids']; ?> bids has been accepted </span>
				</td>
			<?php } else { ?>
				<td>
					<span class="bid-latest">S$ <?php echo $val['highest']; ?> <abbr title="Highest price offered by potential buyer">(Highest offer)</abbr></span><br/>
					<span class="bid-expiry"><span title="Negotiable price asked by the seller.">Ask price: <span class="color-warning">S$ <?php echo $val['price']; ?></span></span><br>
					Time left: <?php echo timespan_shorten(timespan($now,human_to_unix($val['expiryDate']))); ?></span><br/>
					<span class="bid-addinfo"><span class="space"></span><?php echo $val['num_bids']; ?> bids has been placed<br><?php echo $val['acc_bids']; ?> bids has been accepted </span>
				</td>
			<?php } ?>
          </tr>
		<?php } ?>
        </tbody>
      </table>
	<?php } else { ?>
	
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Oops, no result found.
    </div>
	
	<?php } ?>
    <div class="pagination pull-right">
      <ul>
	  
	<?php
		$page=$in_data['page']; $maxpage=$in_data['maxpage'];
		$link=site_url()."/item/listing";
		foreach($in_data as $key=>$val) {
			if($key=="page") continue;
			if($key=="each") continue;
			if($key=="maxpage") continue;
			$link=$link."/".$key."/".$val;
		}
		if($page>1) {
			echo "<li><a href=\"".$link."/page/1\">First</a></li>";
			echo "<li><a href=\"".$link."/page/".($page-1)."\">Prev</a></li>";
		}
		if($page>1+2) echo "<li><a href=\"#\" class=\"disabled\">...</a></li>";
		for($i=$page-2;$i<$page;$i++) {
			if($i<1) continue;
			echo "<li><a href=\"".$link."/page/".($i)."\">".$i."</a></li>";
		}
		echo "<li class=\"active\"><a href=\"#\">".$i."</a></li>";
		for($i=$page+1;$i<=$page+2;$i++) {
			if($i>$maxpage) break;
			echo "<li><a href=\"".$link."/page/".($i)."\">".$i."</a></li>";
		}
		if($page+2<$maxpage) echo "<li class=\"disabled\"><a href=\"#\">...</a></li>";
		if($page<$maxpage) {
			echo "<li><a href=\"".$link."/page/".($page+1)."\">Next</a></li>";
			echo "<li><a href=\"".$link."/page/".$maxpage."\">Last</a></li>";
		}
	?>
	
      </ul>
    </div>
      
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
