    <script src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/bootstrap-alert.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/bootstrap-button.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/bootstrap-modal.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/script.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/jquery-ui-1.8.21.custom.min.js"></script> <!-- DISINI GW UBAH -->

	<script type="text/javascript">
		//price range
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 1000,
			values: [ 0, 1000 ],
			slide: function( event, ui ) {
				var additionalspace = Math.floor((Math.log(ui.values[ 0 ]))) *3;
				$( "#amountmin" ).val( ui.values[ 0 ] ).css('width',12+additionalspace+'px');
				$( "#amountmax" ).val( ui.values[ 1 ] );
				if($("#amountmax").val()=="1000") $("#amountmax").val("~");
			}
		});
		<?php
			if(isset($in_data['plo'])) echo "$( \"#slider-range\" ).slider( \"values\", 0, ".$in_data['plo']." );";
			if(isset($in_data['phi'])) echo "$( \"#slider-range\" ).slider( \"values\", 1, ".$in_data['phi']." );";
		?>
		var additionalspace = Math.floor((Math.log($( "#slider-range" ).slider( "values", 0 )))) *2;
		if($( "#slider-range" ).slider( "values", 0 )==0) additionalspace=0;
		$("#amountmin").val( $( "#slider-range" ).slider( "values", 0 ) ).css('width',12+additionalspace+'px');;
		$("#amountmax").val( $( "#slider-range" ).slider( "values", 1 ) );
		if($("#amountmax").val()=="1000") $("#amountmax").val("~");
	</script>
