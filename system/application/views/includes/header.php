<div class="overlay"></div>
    <div class="login-overlay"></div>
    
	<div class="panel p-left p-search">
        <h4>Advanced Search Panel</h4>
        <hr>
		
        <form action="<?php echo site_url(); ?>/item/search" method="post">
		<input type="hidden" id="sapi" name="q" <?php if(isset($in_data['q'])) echo "value=\"".$in_data['q']."\""; ?>>
        <ul class="p-group">
        <li> <b>Price range</b>  
          S$<input type="text" id="amountmin" name="plo">to S$<input type="text" id="amountmax" name="phi">
          <div id="slider-range"></div> 
          </li><hr>
<!--        <li> <b>Price range</b> <br/>
			From <span class="input-prepend input-append">
                <span class="add-on">$</span><input class="span1" id="appendedPrependedInput" size="16" type="text" name="plo"><span class="add-on">.00</span>
            </span> <br/>
			to <span class="input-prepend input-append">
                <span class="add-on">$</span><input class="span1" id="appendedPrependedInput" size="16" type="text" name="phi"><span class="add-on">.00</span>
            </span> 
		</li><hr> -->
        <li> 
            <b>Tags filter</b>
            <div class="btn-group btn-tags multipleselection">
              <button class="btn btn-small btn-primary" id="checkall" onclick="return false;">Check all</button>
              <button class="btn btn-small btn-primary" id="checknone" onclick="return false;">None</button>
            </div>
			
            <ul class="tags-group">
			<?php
			if(isset($in_data['tag'])) $checkedTags=explode("_",$in_data['tag']);
			if(isset($tags)&&$tags) {
				foreach($tags as $val) if($val['special']=='no') {
					echo "<li><input class=\"tag\" type=\"checkbox\" name=\"tag[]\" value=\"".$val['tagID']."\" ";
					if(isset($checkedTags)&&in_array($val['tagID'],$checkedTags)) echo "checked";
					echo "> ".$val['tagname']."</li>";
				}
			}
			?>
				<li>&nbsp;</li>
            </ul>
        </li>
        <div style="clear:both;"></div>
		<hr>
        <li>
          <b>Sort by</b> 
          <select class="sortby" name="sort">
			<option value="match" <?php if(!isset($in_data['sort'])||$in_data['sort']=="match") echo "selected"; ?>>Most related</option>
			<option value="newtoold" <?php if(isset($in_data['sort'])&&$in_data['sort']=="newtoold") echo "selected"; ?>>Most recent</option>
			<option value="pop" <?php if(isset($in_data['sort'])&&$in_data['sort']=="pop") echo "selected"; ?>>Most popular</option>
			<option value="pasc" <?php if(isset($in_data['sort'])&&$in_data['sort']=="pasc") echo "selected"; ?>>Cheapest price</option>
          </select>
          <br><br>
		  <button class="btn btn-large" style="padding:10px 70px;margin-left:"><i class="icon-search"></i> Search</button><div style="clear:both;"></div>
		</li>
			
        </ul>
		</form>
    </div>
			
			
			</div>
        </li>
        </ul>
    </div>
    
	<div class="panel p-right">
    	<div class="arrow"></div>
		<?php
		if(!isset($user)||!$user) {
		?>
		
        <ul class="p-group">
        	<li class="signin" ><form action="<?php echo site_url(); ?>/home/signin" method="post">
			<input type="hidden" name="prev" value="<?php if(isset($crnt)&&$crnt) echo $crnt; else echo "/home"; ?>" >
            <div class="input-append"><input type="text" name="email" class="input-medium input-email-panel" placeholder="Email"><span class="add-on">@ntu.edu.sg</span></div>
  			<input type="password" name="pass" class="input-medium" placeholder="Password">
  			<a href="<?php echo site_url()."/register/forget" ?>">Forget password</a> </label> <button type="submit" class="btn btn-primary btn-signin">&nbsp Sign in &nbsp</button> </form></li>
        </ul>
        <hr>
        <div class="signuptitle">
            <h3>New to U-mall?</h3>
            <h5>Sign up and start posting your stuff</h5>
        </div>
        <ul class="p-group">
        	<li class="signup"><form action="<?php echo site_url(); ?>/register" method="post"> 
			<div class="input-append"><input type="text" name="email" class="input-medium input-email-panel" placeholder="Email"><span class="add-on">@ntu.edu.sg</span></div>
  			<input type="text" name="username" class="input-medium" placeholder="Full Name">
  			<input type="password" name="pass" class="input-medium" placeholder="Password">
  			<button type="submit" class="btn btn-danger btn-large btn-signup" >Sign up for U-mall</button> </form></button>
        </ul>
        <hr>
        <ul class="p-group p-hover">
            <a href=#><li><i class="icon-question-sign"></i>FAQ List<i class="icon-chevron-right pull-right"></i></li></a>
            <hr>
            <a href=#><li><i class="icon-envelope"></i>Contact us<i class="icon-chevron-right pull-right"></i></li></a>
        </ul>
		
		<?php } else { ?>
		
        <ul class="p-group p-hover">
            <a href="./notification/index.html"><li><i class="icon-notif">8</i>Notification<i class="icon-chevron-right pull-right"></i></li></a>
            <hr>
            <a href="<?php echo site_url()."/user/profile/".$user['userID']."/1"; ?>"><li><i class="icon-wrench"></i>Profile Setting<i class="icon-chevron-right pull-right"></i></li></a>
            <hr>
            <a href="<?php echo site_url(); ?>/home/signout"><li><i class="icon-off"></i>Sign Out<i class="icon-chevron-right pull-right"></i></li></a>
        </ul>
        <hr>
        <ul class="p-group p-hover">
            <a href="<?php echo site_url()."/user/bids/1"; ?>"><li><i class="icon-eye-open"></i>Watchlist<i class="icon-chevron-right pull-right"></i></li></a>
            <hr>
            <a href="<?php echo site_url()."/item/post"; ?>"><li><i class="icon-money"></i>Sell an item<i class="icon-chevron-right pull-right"></i></li></a>
            <hr>
            <a href="<?php echo site_url()."/user/items/1"; ?>"><li><i class="icon-list"></i>Manage Displayed Items<i class="icon-chevron-right pull-right"></i></li></a>
        </ul>
		
		<?php } ?>
    </div>	
    
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner ">
      	<div class="row">
        	<div class="span2 hidden-phone">
                <form class="form-search searchbar" onsubmit="return false;">
                      <div class="input-append">
                           <input class="input-small search-query"  placeholder="Search" id="temp" size="16" type="text" onkeyup="autoganti()" <?php if(isset($in_data['q'])) echo "value=\"".$in_data['q']."\""; ?>><a href="#" ><span class="add-on"><i class="icon-search"></i></span></span>
                      </div>
                </form>
				
				<script>
					function autoganti() {
						var x=document.getElementById("sapi");
						var y=document.getElementById("temp");
						x.value=y.value;
					};
				</script>
            </div>
            <div class="span2">
              <a class="logo logo-mid hidden-phone" href="<?php echo site_url(); ?>"></a>
              <a class="logo logo-left visible-phone" href="#"></a>
            </div>
            <div class="span3 login pull-right">
              <i class="icon-user"></i> <?php if(!isset($user)||!$user) { ?>Account & Help<?php } else { echo "Hi, ".$user['username']; } ?>
            </div>
        </div>
      </div>
    </div>
