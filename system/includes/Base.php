<?php
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

function &get_instance()
{
	return Ava_Base::get_instance();
}

?>