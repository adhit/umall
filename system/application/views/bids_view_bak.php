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
      
    <span class="result-queries"><span class="result-text">Items bid by this user:</span></span>  
	
    <?php if(isset($items)&&$items) { ?>
    <table class="table table-bordered t-items">
        <tbody>
		<?php foreach($items as $val) { ?>
          <tr>
            <td><a href="item_fixed_buyerview.html"><img class="span3" src="<?php echo base_url()."/pictures/".$val['image']; ?>"></a></td>
            <td><h4><a href="item_fixed_buyerview.html"><?php echo character_limiter($val['name'],48); ?></a></h4><?php echo character_limiter($val['description'],360); ?></td>
            <?php if($val['type']=='fixed') { ?>
				<td><span class="bid-latest">S$ <?php echo $val['price']; ?> <abbr title="You can only agree to this price to declare interest.">(Fixed price)</abbr></span><br/><br/>
				<span class="bid-addinfo">
				Expiring in <?php echo timespan_shorten(timespan($now,human_to_unix($val['expiryDate']))); ?><br/>
				Posted <?php echo timespan_shorten(timespan(human_to_unix($val['timeCreated']),$now)); ?> ago<br/>
				</span>
				</td>
			<?php } else { ?>
	            <td><span class="bid-latest">
					<?php if($val['num_bids']==0) echo "<abbr title=\"There is currently no bids made\">(No bids yet)</abbr>"; 
					else if($val['num_bids']==$val['acc_bids']) echo "<abbr title=\"All other bid(s) has been accepted\">(No pending bids)</abbr>";
					else { ?>
						S$ <?php echo $val['highest']; ?> <abbr title="This is the highest pending bid made for this item">(Highest bid)</abbr>
					<?php } ?>
					</span><br>
					<span class="bid-addinfo">Bid starting at S$ <?php echo $val['price']; ?><br>
					<?php
					if($val['num_bids']==0) echo "Now is your chance, bid now!";
					else if($val['num_bids']==$val['acc_bids']) echo "All ".$val['acc_bids']." bid(s) was accepted.<br/>Don't get left behind, bid now!";
					else echo "Has been bid ".$val['num_bids']." times.<br/>".$val['acc_bids']." accepted.";
					?><br/><br/>
					Expiring in <?php echo timespan_shorten(timespan($now,human_to_unix($val['expiryDate']))); ?><br/>
					Posted <?php echo timespan_shorten(timespan(human_to_unix($val['timeCreated']),$now)); ?> ago<br/>
					</span>
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
		$link=site_url()."/user/bids";
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
