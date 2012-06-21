<?php

class Test extends Controller {

	function Test()
	{
		parent::Controller();	
	}
	
	function index()
	{
		echo base_url()."<br/>";
		echo site_url()."<br/>";
		echo FILE_URL."<br/>";
		echo APPPATH."<br/>";
		var_dump(is_dir(FILE_URL)); echo "<br/>";
		var_dump(is_dir(APPPATH)); echo "<br/>";
	}
}

?>