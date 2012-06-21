    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap-alert.js"></script>
    <script src="./assets/js/bootstrap-button.js"></script>
    <script src="./assets/js/script.js"></script>
    <script type="text/javascript">
	var viewbidding=$('.view-bidding');
	var btable=$('.bidding-table')
	viewbidding.click(function(){
		$this=$(this);
		if($this.hasClass('hid')){
			$this.children('span').html('Hide bidding table '); 
			$this.removeClass('hid');
			btable.fadeIn();
		}
		else{
			$(this).children('span').html('Show bidding table ');
			$this.addClass('hid'); 
			btable.fadeOut();
		}
	})
    </script>
    <script type="text/javascript">
		// COPY PRODUCT *MALES
		var a = $('.thumbnails');
		var b = a.html();
		
		for (i=1; i<8; i++){a.append(b);};	
    </script>
