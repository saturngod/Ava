<?php
include SITE_PATH.'/config/config.php';
include SITE_PATH.'/includes/Loader.php';
include SITE_PATH.'/includes/common.php';
include SITE_PATH.'/includes/router.php';
include SITE_PATH.'/includes/Base.php';
include SITE_PATH.'/libraries/controller.php';
include SITE_PATH.'/libraries/RESTcontroller.php';
include SITE_PATH.'/libraries/model.php';



$router = new router(SITE_PATH);
$router->load();

if(!is_file($router->file))
{
	die("<div style='background-color:#FF9BA2;border:1px solid #FF4745;width:90%;margin:0px auto;padding:8px;color:#555'>Controller not found</div>");
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