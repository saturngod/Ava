<?php
include 'router.php';
include 'loader.php';
include 'controller.php';
include 'model.php';

//router
$router= new router();

$controller= $router->get_controller();
$action = $router->get_action();

//Add File for Controller And Action
include ABS_PATH."/system/app/controller/".$controller.".php";

//Add Controller name to Controller
$controller=$controller."Controller";
$controller= new $controller();
$controller->$action();
?>