<?php
/**
 * session
 * 
 * session class
 *
 * @author saturngod
 * @category session
 */
class Ava_session
{
	/**
     * session constructor
     */
	public function __construct()
	{
		@session_start();
	}

    /**
     * get session
     * @param  string $session
     * @return string
     */
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

    /**
     * set session
     * @param  array $data
     * @return void
     */
	public function set($data)
	{
		foreach($data as $name=>$value)
		{
			$_SESSION[$name]=$value;
		}
	}

    /**
     * destory session
     * @return void
     */
	public function destory()
	{
		session_destroy();
	}

    /**
     * remove session with name
     * @param  $name
     * @return void
     */
	public function _unset($name)
	{
		session_unset($name);
	}
}
?>