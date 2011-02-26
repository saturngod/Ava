<?php

/**
	Ava Light Framework for simple usages
	No Database , No Library, No Plugin
	Very Light weight
	Just only use for MVC pattern
*/

 /*** error reporting on ***/
 error_reporting(E_ALL);

 /*** define the site path constant ***/
 $site_path = realpath(dirname(__FILE__));
 define ('SITE_PATH', $site_path."/system");
 
 
 /*** include the init.php file ***/
 include 'system/includes/init.php';

?>