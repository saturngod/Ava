<?php
/**
 * @author saturngod
 * @since version 1.0
 * @package Ava
 */
//require files
include SITE_PATH.'/config/config.php';
include SITE_PATH.'/includes/Loader.php';
include SITE_PATH.'/includes/common.php';
include SITE_PATH.'/includes/Base.php';
include SITE_PATH.'/libraries/router.php';
include SITE_PATH.'/libraries/controller.php';
include SITE_PATH.'/libraries/RESTController.php';
include SITE_PATH.'/libraries/model.php';

//Error on off
if(defined("AvaConfig::DEBUG")) {
	if(AvaConfig::DEBUG)
	{
	    error_reporting(E_ALL);
		ini_set('display_errors', '1');
		ini_set('error_prepend_string', "\n<div style=\"background-color:#FF9BA2;border:1px solid #FF4745;width:90%;margin:0px auto;padding:8px;color:#222\">\n");
		ini_set('error_append_string', "</div>\n");
	}
	else {
		error_reporting(0);
	    ini_set('display_errors', '0');
	}
}
//debug is not exist , use default php.ini

//start router for controller/action
$router = & load_class("router");
$router->load();

if(!is_file($router->file))
{
	die("\n<div style='background-color:#FF9BA2;border:1px solid #FF4745;width:90%;margin:0px auto;padding:8px;color:#555'><b>".$router->controller."</b> Controller not found</div>\n");
}

//include Controller File
include $router->file;
$class=ucfirst($router->controller)."Controller";

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