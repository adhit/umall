<html>
	<head>
		<title>UMall</title>
	</head>
	<body>		
			<table>
				<tr>
					<th>Item Name</th>
					<th>Sell Price</th>
					<th>Quantity Left</th>
					<th>Posted Time</th>
				</tr>
				<?php 
					$link = ""; // link to see the item;
					foreach($items as $item){
				?>	
					<tr>
						<td><a href="<?php echo $link.$item['itemID'];?>"><?php echo $item['name'];?></a></td>
						<td><?php echo $item['price'];?></td>
						<td><?php echo $item['quantity'];?></td>
						<td><?php echo $item['timeCreated'];?></td>
					</tr>
				<?php
				} // end of foreach
				?>
			</table>
	</body>
</html>