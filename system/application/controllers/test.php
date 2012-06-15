<?php

class Test extends Controller {

	function Test()
	{
		parent::Controller();	
	}
	
	function index()
	{
		echo base_url()."<br/>".site_url();
	}
}

?>