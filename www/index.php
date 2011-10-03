<?php

/**
 * Ava Framework
*/

 /*** error reporting on ***/
 error_reporting(E_ALL);

 /*** define the site path constant ***/
 $site_path = realpath(substr(dirname(__FILE__),0,-4));

 define ('SITE_PATH', $site_path."/system");
 
 
 /*** include the init.php file ***/
 include SITE_PATH.'/includes/init.php';

?>