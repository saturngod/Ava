<?php
/**
 * router
 * 
 * router class for separate controller and action
 *
 * @author saturngod
 */
class router {
	
	// for controller and action
	private $controller;
	private $action;
	function router()
	{
	
		/*
		** Seprate controller and action
		** /index.php/controller/action
		*/
		if(!stristr($_SERVER['REQUEST_URI'], "/index.php/") === FALSE) { 
		$index=preg_split("/index.php/",$_SERVER['REQUEST_URI']);
		$route=substr($index[1],1);
		}
		
		if (empty($route))
		{
		    $route = 'index';
		}
		else
		{
		    $parts = explode('/', $route);
		    $controller = $parts[0];
		    if(isset( $parts[1]))
		    {
		        $action = $parts[1];
		    }
		
		}
		
		if (empty($controller))
		{
			include_once ABS_PATH."/system/config/config.php";
		    $controller = $config['start_page'];
		}
		
		/*** Get action ***/
		if (empty($action))
		{
		    $action = 'index';
		}
		$this->controller=$controller;
		$this->action=$action;
		
	}
	
	function get_controller()
	{
		return $this->controller;
	}
	
	function get_action()
	{
		return $this->action;
	}
}
?>