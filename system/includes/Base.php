<?php
/**
 * Ava_Base
 * base class for overall . This class is base on CodeIgniter
 * @package Ava
 * @since version 1.0
 * @author ExpressionEngine Dev Team , saturngod
 */
class Ava_Base {
private static $instance;

	public function Ava_Base()
	{
		self::$instance =& $this;
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
}

/**
 * global class
 * @return Ava_Base
 */
function &get_instance()
{
	return Ava_Base::get_instance();
}

?>