<?php
/**
 * Model class
 * this class also base on CodeIgniter 1.7
 * @package Ava
 * @since version 1.0
 * @author saturngod , ExpressionEngine Dev Team
 * @category Library
 */
class Ava_Model {
	
	var $_parent_name = '';

    /**
     * constructor
     * @return void
     */
	function __construct()
	{
		
	}

    function __get($key)
	{
		$Ava =& get_instance();
		return $Ava->$key;
	}
}
?>