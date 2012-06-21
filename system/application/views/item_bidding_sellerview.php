<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <?php
    include "header_include_assets.php";
    ?>
  </head>

  <body>
  <?php
  include "header.php";
  ?>
	<br><br><br>
    
    <div class="container">
    <?php
    include "categories.php";
    ?>
    <span class="result-queries"><span class="result-text">Related tags : &nbsp;</span><span class="label label-info hidden-phone"><a href="#">Accesories</a></span><span class="label label-info hidden-phone"><a href="#">Clothings</a></span><span class="label label-important hidden-phone"><a href="#">NBS</a></span><span class="label label-important hidden-phone"><a href="#">SCE</a></span></span>
    <table class="table table-bordered t-items">        
          <tr>
            <td class="thumb"><img class="span3" src="assets/img/thumb1.jpg"></td>
            <td class="desc">
            	<h4>Espresso and Cappuccino Maker</h4>Enjoy delicious espresso made your way with De'Longhi's pump espresso and cappuccino maker. You can choose to brew ground espresso or E.S.E pods with the unique patented dual filter holder. 
                <div class="action-group">
                	<form class="form-inline"><label>Quantity &nbsp;&nbsp;&nbsp;: <input type="text" class="input-xsmall input-quantity" value="1"></label>
                    <label>Price each: &nbsp;&nbsp;<div class="input-prepend"><span class="add-on">S$</span><input type="text" class="input-small2" placeholder="Bid price" value="201.9"></div></label><br>
                    <label class="checkbox" ><input type="checkbox" >Allow for <abbr title="Means that seller can accept partial quantity of your order, eg. in case of not enough stocks left">partial purchase</abbr> </label> <br> 
                    <button class="btn btn-primary btn-bid">Place Bid</button>
                    </form>
                </div>   
            </td>
            <td>
            	<span class="detailed-info">Detailed Information</span>
            	<table class="table table-condensed detailed-table">
					<tr><td class="detail-item">Time left:</td><td>20d 16h</td></tr>
                    <tr><td class="detail-item">Latest bid:</td><td>S$ 200.9 <abbr title="This is the highest bid for this item">(Latest Bid)</abbr></td></tr>
                    <tr><td class="detail-item">Starting bid:</td><td>S$ 160.2</td></tr>
                    <tr><td class="detail-item">Bids count:</td><td>14</td></tr>
                    <tr><td class="detail-item">Stock quantity:</td><td>2</td></tr>
                    <tr><td class="detail-item">Condition:</td><td>Used</td></tr>
                    <tr><td class="detail-item">Seller:</td><td><a href="">evanpy1</td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td colspan="2"><a class="view-bidding hid" href=#><span>Show bidding table </span><i class="icon-mini-triangle"></i></a></td></tr>
                </table>
                <table class="table-condensed bidding-table">
                    <tr><td>#</td><td>Qty</td><td>Bid Price</td><td>Status</td></tr>
                    <tr><td class="number">1</td><td>1</td><td>S$ 13421423</td><td class="approved">approved</td></tr>
                    <tr><td class="number">3</td><td>2</td><td>S$ 553</td><td class="approved">approved</td></tr>
                    <tr><td class="number">2</td><td>4</td><td>S$ 323</td><td class="pending">pending</td></tr>
                    <tr><td class="number">3</td><td>3</td><td>S$ 223</td><td class="approved">approved</td></tr>
                </table>
            </td>
          </tr>
          <tr>
          	<td colspan="2">
                <h3 class="content-header">Item log</h3>
                <ul class="itemlog">
                    <li>You approved <a href=#>evanpy1</a>'s bid at S$30 each for 2 items. <span class="timestamp">05.50 am</span></li><hr>
                    <li><a href=#>ahnjotoh1</a> bid 1 items at S$12341.3 each. <span class="timestamp">05.50 am</span></li><hr>
                    <li><a href=#>evanpy1</a> bid 2 items at S$30 each. <span class="timestamp">05.50 am</span></li><hr>
                    <li>You approved <a href=#>evanpy1</a>'s bid at S$30 each for 2 items. <span class="timestamp">05.50 am</span></li><hr>
                    <li><a href=#>ahnjotoh1</a> bid 1 items at S$12341.3 each. <span class="timestamp">05.50 am</span></li><hr>
                    <li><a href=#>evanpy1</a> bid 2 items at S$30 each. <span class="timestamp">05.50 am</span></li><hr>
                </ul>
            </td>
            <td class="owner">
            	<h3 class="owner-text">You are the seller of this item.</h3><br>
                <div class="btn btn-large btn-inverse"><i class="icon-ok icon-white"></i> Approve Bid</div> <div class="btn btn-large btn-inverse"><i class="icon-pencil icon-white"></i> Edit Item</div> 
            </td>
           </tr>
      </table>
    </div> <!-- /container -->
 <?php
 include "footer.php";
 ?>   	
<div class="footerphone visible-phone"><hr>© NTU Student Union 2012</div>
<?php
include "footer_include_assets.php";
?>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>

</html>
