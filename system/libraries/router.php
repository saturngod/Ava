<?php
/**
 * Router class for separate controller and action from URI
 * @author saturngod
 * @since version 1.0
 * @package Ava
 */
class Ava_router {

    /**
     * @access private
     * @var string $controller_path
     * @var array $args
     */

   	private $controller_path;

	private $args = array();

    /**
     * @access public
     * @var string $file
     * @var string $controller
     * @var string $action
     */
     
	public $file;

 	public $controller;

 	public $action;
 	
 	/** constructor
      * @param  string $site_path
      */
 	public function __construct($site_path)
 	{
 		$this->controller_path=$site_path."/application/Controller";
 	}
 	/**
      * loading the site
      * @return void
      */
 	public function load()
 	{
 		$this->getController();
 	}
 	
 	/**
      * split controller from URI
      * @return void
      */
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