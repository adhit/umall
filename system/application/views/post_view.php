<html>
	<head>
		<title>UMall</title>
	</head>
	<body>		
		<div style="width:1024px; margin-left:auto; margin-right:auto; border: 1px solid black">
			<h1>Post Item</h1>
			<?php
			if(isset($in_data["msg"]["post_error"])) echo "Error: ".$in_data["msg"]["post_error"]."<br/>"; 
			if(isset($in_data["msg"]["post_success"])) echo "Congratz: ".$in_data["msg"]["post_success"]."<br/>"; 
			?>
			<form action="<?php echo site_url(); ?>/item/post" method="post" enctype="multipart/form-data">
			Name:<input type="text" name="name"
				<?php if($this->input->post('name')) echo "value=\"".$this->input->post('name')."\"" ?> >
				<?php if(isset($in_data["msg"]["name_error"])) echo $in_data["msg"]["name_error"]; ?><br/>
			
			Quantity:<input type="text" name="quantity"
				<?php if($this->input->post('quantity')) echo "value=\"".$this->input->post('quantity')."\"" ?> >
				<?php if(isset($in_data["msg"]["quantity_error"])) echo $in_data["msg"]["quantity_error"]; ?><br/>
			
			Price:<input type="text" name="price"
				<?php if($this->input->post('price')) echo "value=\"".$this->input->post('price')."\"" ?> >
				<?php if(isset($in_data["msg"]["price_error"])) echo $in_data["msg"]["price_error"]; ?><br/>
			
			Expiry Date:
			<select name="exp">
				<option value="7" selected>1 week</option>
				<option value="14" <?php if($this->input->post('exp')=="14") echo "selected";?>>2 weeks</option>
				<option value="30" <?php if($this->input->post('exp')=="30") echo "selected";?>>1 month</option>
				<option value="90" <?php if($this->input->post('exp')=="90") echo "selected";?>>3 months</option>
				<option value="180" <?php if($this->input->post('exp')=="180") echo "selected";?>>6 months</option>
			</select><br/>
				
			Description:<textarea name="description" cols="40" rows="5"><?php if($this->input->post('description')) echo $this->input->post('description'); ?></textarea>
				<?php if(isset($in_data["msg"]["description_error"])) echo $in_data["msg"]["description_error"]; ?><br/>
				

			<select name="type">
				<option value="bid" selected>Auction</option>
				<option value="fixed" <?php if($this->input->post('type')=="fixed") echo "selected";
				?>>Fixed price</option>
			</select><br/>
			
			Image: <input type="file" name="image"> or 
			<input type="checkbox" name="default" value="yes" <?php if($this->input->post('default')) echo "checked"; ?>> use no image <br/>
			<?php if(isset($in_data["msg"]["image_error"])) echo $in_data["msg"]["image_error"]; ?><br/>
			
			Category Tags:
			<?php
				foreach($initial_tags as $key=>$val) {
					if($val['special']=='yes') continue;
					echo "<input type=\"checkbox\" name=\"tags[]\" value=\"".$val['tagID']."\" ";
					if($this->input->post('tags')&&in_array($val['tagID'],$this->input->post('tags'))) echo "checked";
					echo "/> ".$val['tagname'];
				}
				echo "<br/>";
			?>
			
			<input type="checkbox" name="agree" value="yes"> I have read and agree with all the terms and conditions<br/>
			<?php if(isset($in_data["msg"]["agree_error"])) echo $in_data["msg"]["agree_error"]; ?><br/>
			
			<input type="hidden" name="filled" value="true">
			<input type="submit" name="post" value="Post Item">
		</div>
	</body>
</html>