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
		session_cache_expire( 20 );
	}

	public function start($session_name = null)
   {
     
      if($session_name!=null) {
       session_id($session_name);
     }
    @session_start(); //Start it here
       
   }
	/**
	 * check session time out or not
	 *
	 * @return void
	 * @author saturngod
	 */
	public function check_session_timeout()
	{
		if(isset($_SESSION['start']) ) {
			$session_life = time() - $_SESSION['start'];
			if($session_life > AvaConfig::session_timeout){
				session_destroy();
				return true;
			}
		}
		return false;
	}
	
	/**
	 * get the session by name
	 *
	 * @param string $session 
	 * @return void
	 * @author saturngod
	 */
	public function get($session)
	{
		if($this->check_session_timeout())
		{
			return false;
		}
		
		if(isset($_SESSION[$session]))
		{
			$_SESSION['start'] = time();
			return $_SESSION[$session];
		}
		else
		{
			return "";
		}
	}

    /**
     * set session by array
     * @param  array $data
     * @return void
     */
	public function set($data)
	{
		if($this->check_session_timeout())
		{
			return false;
		}
		
		foreach($data as $name=>$value)
		{
			$_SESSION[$name]=$value;
		}
		$_SESSION['start'] = time();
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
