<?php
/**
 * session
 * 
 * session class
 *
 * @author saturngod
 * @category session
 */
class session
{
	
	public function __construct()
	{
		@session_start();
	}
	
	public function get($session)
	{
		if(isset($_SESSION[$session]))
		{
			return $_SESSION[$session];
		}
		else
		{
			return "";
		}
	}
	
	public function set($data)
	{
		foreach($data as $name=>$value)
		{
			$_SESSION[$name]=$value;
		}
	}
	
	public function destory()
	{
		session_destroy();
	}
	
	public function _unset($name)
	{
		session_unset($name);
	}
}
?>