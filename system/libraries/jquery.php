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
 * @package Ava
 * @since version 1.0
 * @author saturngod
 * @category Library
 */
class Ava_Jquery 
{
	public $no_conflit= false;
	
	
    /**
     * use the latest jquery script
     * @return void
     */
	public function get_latest()
	{
		echo " <script src='http://code.jquery.com/jquery-latest.js'></script>";
	}
	
    /**
     * use the javascript from js folder
     * @return void
     */
	public function get_script()
	{
		
		echo "<script src='".AvaConfig::public_url."/js/jquery.js"."'></script>";		

	}

    /**
     * using jquery document start
     * @return void
     */
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

    /**
     * end jquery
     * @return void
     */
	public function end_jq()
	{
		echo "});";
	}
}
?>