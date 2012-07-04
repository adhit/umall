 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/css/global.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/css/jquery-ui-1.8.21.custom.css" rel="stylesheet" /> <!-- DISINI GW UBAH -->
    <?php if(isset($isProduct)&&$isProduct) { ?>
		<link href="<?php echo base_url(); ?>/assets/css/product.css" rel="stylesheet">
	<?php } ?>
    <?php if(isset($isListing)&&$isListing) { ?>
		<link href="<?php echo base_url(); ?>/assets/css/listing.css" rel="stylesheet">
	<?php } ?>
	
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>/assets/ico/apple-touch-icon-57-precomposed.png">
