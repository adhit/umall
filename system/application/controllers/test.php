<?php

class Test extends Controller {

	function Test()
	{
		parent::Controller();	
	}
	
	function index($sapi)
	{
		echo site_url();
	}
}

?>
