<html>
	<head>
		<title>UMall</title>
	</head>
	<body>		
			<table>
				<tr>
					<th>Item Name</th>
					<th>Bid Price</th>
					<th>Bid Quantity</th>
					<th>Approved Quantity</th>
					<th>Bid Time</th>
				</tr>
				<?php 
					$link = ""; // link to see the item;
					foreach($bids as $bid){
				?>	
					<tr>
						<td><a href="<?php echo $link.$bid['itemID'];?>"><?php echo $bid['name'];?></a></td>
						<td><?php echo $bid['price'];?></td>
						<td><?php echo $bid['qty'];?></td>
						<td><?php echo $bid['approved_qty'];?></td>
						<td><?php echo $bid['timeCreated'];?></td>
					</tr>
				<?php
				} // end of foreach
				?>
			</table>
	</body>
</html>