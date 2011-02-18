<?php
// Add All Require Class
include SITE_PATH.'/config/config.php';
include SITE_PATH.'/includes/router.php';
include SITE_PATH.'/includes/Loader.php';
include SITE_PATH.'/includes/Controller.php';
include SITE_PATH.'/includes/RESTController.php';
include SITE_PATH.'/includes/Model.php';
include SITE_PATH.'/library/class/segment.php';
include SITE_PATH.'/library/class/output.php';

//Load Custom Class

if(AWConfig::jquery)
{
	include SITE_PATH.'/library/class/jquery.php';
}

//Auto Load
foreach(AWConfig::$autoload as $library)
{
	include SITE_PATH.'/library/class/'.$library.'.php';
}

//Start Router for separate controller & action. http://example.com/controller/action
$router = new router(SITE_PATH);
$router->load();

if(!is_file($router->file))
{
	echo "<div style='background-color:#FF9BA2;border:1px solid #FF4745;width:90%;margin:0px auto;padding:8px;color:#555'>Controller not found</div>";
	exit();
}

//include Controller File
include $router->file;
$class=$router->controller."Controller";

/*** check if the action is callable ***/
if (is_callable(array($class, $router->action)) == false)
{
	$action = 'index';
}
else
{
	$action = $router->action;
}

//Calll Controller Class
$controller = new $class() ;

//Call Controller Action
$controller->$action();
?>