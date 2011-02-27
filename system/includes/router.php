<?php
/**
 * Router class for separate controller and action from URI
 */
class router {
	
	private $controller_path;

	private $args = array();

	public $file;

 	public $controller;

 	public $action;
 	
 	
 	public function __construct($site_path)
 	{
 		$this->controller_path=$site_path."/application/Controller/";
 	}
 	/***
 	Loading the Site
 	***/
 	public function load()
 	{
 		$this->getController();
 	}
 	
 	
 	private function getController()
 	{
 		/*** get the route from the url ***/
 		if(AvaConfig::htaccess)
 		{
			$route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
		}
		else
		{
			$index=preg_split("/index.php/",$_SERVER['REQUEST_URI']);
			$route=substr($index[1],1);
		}

		if (empty($route))
		{
			$route = 'index';
		}
		else
		{
			/*** get the parts of the route ***/
			$parts = explode('/', $route);
			$this->controller = $parts[0];
			if(isset( $parts[1]))
			{
				$this->action = $parts[1];
			}

 		}
 		
 		if (empty($this->controller))
		{
			$this->controller = 'index';
		}

		/*** Get action ***/
		if (empty($this->action))
		{
			$this->action = 'index';
		}
		
		/*** set the file path ***/
		$this->file = $this->controller_path .'/'. $this->controller . '.php';
 	}

}
?>