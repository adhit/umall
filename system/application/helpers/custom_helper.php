<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('timespan_shorten'))
{
    function timespan_shorten($var = '')
    {
		if($var=="") return $var;
		$var=str_replace(" Hours"," Hrs",$var);
		$var=str_replace(" Minutes"," Mins",$var);
		$var=str_replace(" Hour"," Hr",$var);
		$var=str_replace(" Minute"," Min",$var);
		$var=str_replace(",","",$var);
		$arr=explode(" ",$var);
		if(in_array($arr[1],array("Years","Months","Weeks","Year","Month","Week"))) return $arr[0]." ".$arr[1];
		else if(count($arr)>2) return $arr[0].$arr[1]." ".$arr[2].$arr[3];
		else return $arr[0].$arr[1];
	
		//1 Year, 10 Months, 2 Weeks, 5 Days, 10 Hours, 16 Minutes
		//mixed str_replace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )
		// $var=str_replace(" Years","y",$var);
		// $var=str_replace(" Months","m",$var);
		// $var=str_replace(" Weeks","w",$var);
		// $var=str_replace(" Days","d",$var);
		// $var=str_replace(" Hours","h",$var);
		// $var=str_replace(" Minutes","min",$var);
		// $var=str_replace(" Year","y",$var);
		// $var=str_replace(" Month","m",$var);
		// $var=str_replace(" Week","w",$var);
		// $var=str_replace(" Day","d",$var);
		// $var=str_replace(" Hour","h",$var);
		// $var=str_replace(" Minute","min",$var);
		// return $var;
    }   
}

?>