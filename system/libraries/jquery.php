<?php
/**
 * Nifty
 * @package Ava
 * @author saturngod
 * @since version 1.0
 */
//-------------------------------

/**
 * jQuery Class
 * @category javascript
 * @author saturngod
 */
class Ava_Jquery 
{
	public $no_conflit= false;
	
	//use latest jquery script
	public function get_latest()
	{
		echo " <script src='http://code.jquery.com/jquery-latest.js'></script>";
	}
	
	//use local jquery script
	public function get_script()
	{
		if(file_exists(SITE_PATH.'/'.AvaConfig::public_path."/js/jquery.js"))
		{
			echo "<script src='".AvaConfig::public_url."/js/jquery.js"."'></script>";
		}
		else
		{
			die('There is no jquery file in public folder');
		}

	}
	
	public function start_jq()
	{
		if($this->no_conflit)
		{
			echo "jQuery(document).ready(function() {
			";
		}
		else
		{
			echo "$(document).ready(function() {
			";
		}
	}
	
	public function end_jq()
	{
		echo "});";
	}
}
?>