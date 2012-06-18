<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <?php
    include "header_include_assets.php";
    ?>
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
		font-size:15px;}
    </style>
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
    <span class="result-queries"><span class="result-text">Searched queries for : &nbsp;</span><span class="label label-info hidden-phone"><a href="#">Accesories</a></span><span class="label label-info hidden-phone"><a href="#">Clothings</a></span><span class="label label-important hidden-phone"><a href="#">NBS</a></span><span class="label label-important hidden-phone"><a href="#">SCE</a></span></span>
    <table class="table table-bordered t-items">
        <tbody>
          <tr>
            <td><a href="item_fixed_buyerview.html"><img class="span3" src="assets/img/thumb1.jpg"></a></td>
            <td><h4><a href="item_fixed_buyerview.html">Espresso and Cappuccino Maker</a></h4>Enjoy delicious espresso made your way with De'Longhi's pump espresso and cappuccino maker. You can choose to brew ground espresso or E.S.E pods with the unique patented dual filter holder.</td>
            <td><span class="bid-latest">S$ 200.9 <abbr title="This is the highest bid made for this item ">(Fixed price)</abbr></span><br><span class="bid-stock">2 Items in stock</span><br><!--<span class="bid-addinfo">Bid starting at S$ 200<br>Has been bidded 10 times</span>--></td>
          </tr>
        </tbody>
      </table>
      
    <div class="pagination pull-right">
      <ul>
        <li><a href="#">Prev</a></li>
        <li class="active">
          <a href="#">1</a>
        </li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">Next</a></li>
      </ul>
    </div>
      
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
		// COPY PRODUCT *MALES
		var a = $('table').children('tbody');
		
		function genrand(x){
			return Math.ceil(Math.random()*x)};
			
		for (i=2; i<8; i++){
			a.append('<tr><td><a href="item_bidding_buyerview.html"><img class="span3" src="assets/img/thumb'+genrand(3)+'.jpg"></a></td><td><h4><a href="item_bidding_buyerview.html">Espresso and Cappuccino Maker</a></h4>Enjoy delicious espresso made your way with DeLonghis pump espresso and cappuccino maker. You can choose to brew ground espresso or E.S.E pods with the unique patented dual filter holder.</td><td><span class="bid-latest">S$ '+genrand(1000)+' <abbr title="This is the highest bid made for this item ">(Latest bid)</abbr></span><br><span class="bid-stock">'+genrand(10)+' Items in stock</span><br><span class="bid-addinfo">Bid starting at S$'+genrand(200)+'<br>Has been bidded '+genrand(10)+' times</span></td></tr>')};	 
    </script>
  </body>

</html>
