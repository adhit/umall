<html>
	<head>
		<title>UMall</title>
	</head>
	<body>
		<?php
		if($status=='no_item') {
		?>
			Item is not found in database. You can find an item <a href="<?php echo site_url(); ?>/item/listing">here</a>
		<?php
		} else {
			echo 'item: ';
			print_r($item);
			echo '<br/><br/>tags: ';
			print_r($tags);
			echo '<br/><br/>';
			echo "<h1>Bidding Area</h1>";
			echo "<h2>".$role."</h2>";
			if($role=='guest') echo 'Please sign in to view bids';
			else if($role=='bidder') { //role bidder
				if($my_bid) {
					echo "My bid: ".$my_bid['qty']." @".$my_bid['price']." ";
					if($my_bid['partial']=='yes') echo "partial; ";
					else echo "non-partial; ";
					echo 'status: ';
					if($my_bid['approved']=='yes') echo $my_bid['approved_qty']." accepted";
					echo "<br>Change your bid: ";
				}
				else echo "No bid yet.<br>Bid now: ";
				if($status=="expired") echo "The item has been expired. You can't change your bid or make a new bid";
				else {
		?>
			<form action="<?php echo site_url(); ?>/item/bid" method="post">
				<input type="hidden" name="itemID" value="<?php echo $itemID; ?>" >
				<input type="hidden" name="prev" value="<?php echo $crnt; ?>" >
				
				<input type="text" name="qty" <?php if(isset($in_data['form']['qty'])) echo "value=\"".$in_data['form']['qty']."\""; ?>> @ 
				$<input type="text" name="price" <?php if(isset($in_data['form']['price'])) echo "value=\"".$in_data['form']['price']."\""; ?>>
				<select name="partial">
					<option value="yes" selected>Partial</option>
					<option value="no" <?php if(isset($in_data['form']['qty'])) echo $in_data['form']['qty']; ?>>Non-Partial</option>
				</select>
				<input type="submit" name="bid" value="Bid!"><br/>
				<?php
					if(isset($in_data['msg']['bid_success'])) echo "Bid Success: ".$in_data['msg']['bid_success']."<br/>";
					if(isset($in_data['msg']['bid_error'])) echo "Bid Error: ".$in_data['msg']['bid_error']."<br/>";
					if(isset($in_data['msg']['qty_error'])) echo "Quantity Error: ".$in_data['msg']['qty_error']."<br/>";
					if(isset($in_data['msg']['price_error'])) echo "Price Error: ".$in_data['msg']['price_error']."<br/>";
				?>
			</form>
		<?php
				}
				if($bids) {
					echo "<table><tr><th>No</th><th>Qty</th><th>Price</th><th>Partial</th><th>Status</th></tr>";
					$i=0;
					foreach($bids as $bid) {
						$i++;
						echo "<tr>";
						echo "<td>".$i."</td>";
						echo "<td>".$bid['qty']."</td>";
						echo "<td>".$bid['price']."</td>";
						echo "<td>".$bid['partial']."</td>";
						if($bid['approved']=="yes") echo "<td>Accepted (".$bid['approved_qty'].")</td>";
						else echo "<td><Pending</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				else echo "No bids yet";
			} else { //role seller
				if($bids) {
					if(isset($in_data['msg']['accept_success'])) echo 'Success: '.$in_data['msg']['accept_success']."<br/>";
					if(isset($in_data['msg']['accept_error'])) echo 'Error: '.$in_data['msg']['accept_error']."<br/>";
					echo "<table><tr><th>No</th><th>Qty</th><th>Price</th><th>Partial</th><th>Accept</th><th>Name</th><th>Email</th><th>Phone</th></tr>";
					$i=0;
					foreach($bids as $bid) {
						$i++;
						echo "<tr>";
						echo "<td>".$i."</td>";
						echo "<td>".$bid['qty']."</td>";
						echo "<td>".$bid['price']."</td>";
						echo "<td>".$bid['partial']."</td>";
						if($bid['approved']=="yes") {
							echo "<td>Accepted (".$bid['approved_qty'].")</td>";
							echo "<td>".$bid['name']."</td>";
							echo "<td>".$bid['email']."</td>";
							if($bid['show']=='yes') echo "<td>".$bid['contactNumber']."</td>";
							else echo "<td>not shown</td>";
						}
						else {
							echo "<td><a href=\"".site_url()."/item/accept/".$bid['bidID']."\">Accept</a></td>";
							echo "<td>?</td>";
							echo "<td>?</td>";
							echo "<td>?</td>";
						}
						echo "</tr>";
					}
					echo "</table>";
				}
				else echo "No bids yet";
		?>
		<?php
			}
		}
		?>
	</body>
</html>
