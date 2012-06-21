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
                    <button class="btn btn-primary btn-buynow">Buy now</button><br>
                    <span class="tot-price">Total price : <span class="price">S$202.9</span></span>
                    </form>
                </div>   
            </td>
            <td>
            	<span class="detailed-info">Detailed Information</span>
            	<table class="table table-condensed detailed-table">
                	<tr><td class="detail-item">Time left:</td><td>20d 16h</td></tr>
                    <tr><td class="detail-item">Price:</td><td>S$ 200.9 <abbr title="Fixed priced item can be bought right away">(Fixed price)</abbr></td></tr>
                    <tr><td class="detail-item">Stock quantity:</td><td>2</td></tr>
                    <tr><td class="detail-item">Condition:</td><td>New</td></tr>
                    <tr><td class="detail-item">Seller:</td><td><a href="">ahnjotoh1</td></tr>
                </table>
            </td>
          </tr>
        
      </table>
    </div> <!-- /container -->
    	
    <?php
    include "footer.php";
    ?>
<div class="footerphone visible-phone"><hr>© NTU Student Union 2012</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php
    include "footer_include_assets.php";
    ?>
    <script type="text/javascript">
		
    </script>
  </body>

</html>
