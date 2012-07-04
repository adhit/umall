<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>U-Mall</title>
<?php include "includes/header_include_assets.php"; ?>   

    <style type="text/css">
	.btn-post{
		padding: 10px 201px;}
  .control-label{
		font-weight:bold;
		font-size:17px;
		margin-top:5px;}
	input[type="text"].input-xlarge{
		height:30px;
		}
	.select-type{
		height:42px; 
		padding:6px 6px 6px 2px; 
		border-radius:4px;
		width:150px;}
	.select-expiry{
		height:42px; 
		padding:6px 6px 6px 2px; 
		border-radius:4px;
		width:95px;}
	.input-price{
		width:105px;}
	.input-prepend .add-on-input-price{
		height:20px;
		padding:9px;}
	.alert-register{
		margin-top:-20px;}
	.displayimg{
		width:100px;
		height:100px;
		background:#ccc;}
	.tagsbox{
		background:#f9f9f9;
		margin-top:-30px;
		padding:20px 10px 20px 20px;
		border-radius:10px;
		line-height:24px;
		height:490px;}
	.tagslabel{
		padding-bottom:8px;
		text-align:;
		}
	.tagsbox .span1{
		width:40%;}
    </style>
  
  </head>

  <body>
  	
<?php include "includes/header.php"; ?>
    
	<br><br><br>
    
    <div class="container">
	<form action="<?php echo site_url(); ?>/item/post" method="post" enctype="multipart/form-data">
	<input type="hidden" name="filled" value="yes">
	<?php
	if(isset($msg['global_error'])) { ?>
    <div class="alert alert-error alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $msg['global_error']; ?>
    </div>
	<?php } ?>
    <h1 class="content-header">Post an item </h1>
   	<div class="row">
    	<div class="form-horizontal">
        <div class="span6 offset2">
            <div class="control-group<?php if(isset($msg['name_error'])) echo " error"; ?>">
              <label class="control-label" for="input01">Item Title</label>
              <div class="controls">
                <input type="text" name="name" class="input-large input-xlarge" id="input01" placeholder="Put your item name here ..."
				<?php if($this->input->post('name')) echo "value=\"".$this->input->post('name')."\""; ?>>
				<?php if(isset($msg['name_error'])) echo "<p class=\"help-block\">".$msg['name_error']."</p>"; ?>
              </div>
        </div>
        <hr>
        <div class="control-group">
              <label class="control-label" for="input02">Description</label>
              <div class="controls">
                <textarea id="input02" class="input-xlarge" name="description" rows=4 placeholder=" ... and your item description here"><?php if($this->input->post('name')) echo $this->input->post('description'); ?></textarea>
			  </div>
        </div>
        <hr>
        <div class="control-group">
              <label class="control-label" for="input03">Price format 
				<a href="#" rel="tooltip" id="tes" data-original-title="Fixed price means that potential buyer can buy your item right away. &lt;br&gt;&lt;br&gt;Negotible means that potential buyer can offer you higher or lower price. Later, you may accept or reject their offer.&lt;br&gt;&lt;br&gt;Expiry date determines how long your item will be displayed for public."><i class="icon-question-sign"></i></a>
			  </label>
              <div class="controls">
                <select class="input-xlarge select-type" name="type" id="input03">
                  <option value="fixed" selected>Fixed Price</option>
                  <option value="bid" <?php if($this->input->post('type')&&$this->input->post('type')=='bid') echo "selected";?>>Negotiable</option>
                </select>
                &nbsp;for  &nbsp;
                <select class="input-xlarge select-expiry" name="exp" id="input03">
					<option value="180" <?php if($this->input->post('exp')=="180") echo "selected";?>>6 months</option>
					<option value="90" <?php if($this->input->post('exp')=="90") echo "selected";?>>3 months</option>
					<option value="30" <?php if($this->input->post('exp')=="30") echo "selected";?>>1 month</option>
					<option value="14" <?php if($this->input->post('exp')=="14") echo "selected";?>>2 weeks</option>
					<option value="7" <?php if($this->input->post('exp')=="7") echo "selected";?>>1 week</option>
                </select>
              </div>
        </div>
        <hr>
        <div class="control-group<?php if(isset($msg['price_error'])) echo " error"; ?>">
              <label class="control-label" for="input04">Price</label>
              <div class="controls">
                <div class="input-prepend"><span class="add-on add-on-input-price">S$</span><input type="text" class="input-xlarge input-price" id="input04" name="price"
				<?php if($this->input->post('price')) echo "value=\"".$this->input->post('price')."\""; ?>></div>
				<?php if(isset($msg['price_error'])) echo "<p class=\"help-block\">".$msg['price_error']."</p>"; ?>
			  </div>
        </div>
        <hr>
        <div class="control-group<?php if(isset($msg['image_error'])) echo " error"; ?>">
          <label class="control-label" for="input05">Display Image</label>
          <div class="controls">
            <input type="file" name="image"> <p class="help-block">
			<?php if(isset($msg['image_error'])) echo "<p class=\"help-block\">".$msg['image_error']."</p>"; else { ?>
			Choose a nice 200x200 pixel picture that looks great... <?php } ?>
			</p>
          </div>
        </div>  
        <hr>  

        <button type="submit" class="btn btn-primary btn-large btn-post">Post it!</button>
        </div>
      </div>
      <div class="span3 tagsbox">
        <div class="control-group">
          <label class="control-label tagslabel" for="input06">Related tags&nbsp; <i class="icon-tags" style="margin-top:2px;"></i></label>
          <div class="controls">
          	<div class="row">
			<?php
			
				$temp_count=0;
				foreach($tags as $val) if($val['special']=='no') $temp_count++;
				echo "<div class=\"span1\">";
				$temp=0;
				foreach($tags as $val) {
					if($val['special']=='yes') continue;
					if($temp%2==0) {
						echo "<input type=\"checkbox\" name=\"tags[]\" value=\"".$val['tagID']."\"";
						if($this->input->post('tags')&&in_array($val['tagID'],$this->input->post('tags'))) echo "checked";
						echo "> ".ucfirst($val['tagname'])." <br>";
					}
					$temp++;
				}
				echo "</div>";
				echo "<div class=\"span1\">";
				$temp=0;
				foreach($tags as $val) {
					if($val['special']=='yes') continue;
					if($temp%2==1) {
						echo "<input type=\"checkbox\" name=\"tags[]\" value=\"".$val['tagID']."\"";
						if($this->input->post('tags')&&in_array($val['tagID'],$this->input->post('tags'))) echo "checked";
						echo "> ".ucfirst($val['tagname'])." <br>";
					}
					$temp++;
				}
				echo "</div>";
				
			?>
            </div>
          </div>
        </div>
      </div>
    </div>
	</form>
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
