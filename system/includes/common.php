<?php
/**
 * @author saturngod
 * @since version 1.0
 * @package Ava
 * @param  string $class
 * @return class
 */
function &load_class($class)
{
	static $objects = array();
 
    $name="Ava_".ucfirst($class);
    
    // Does the class exist?  If so, we're done...
	if (isset($objects[$name]))
	{
		return $objects[$name];
	}
    
	if($class!='Loader' && $class!="router")
	{

        //load from user libraries
		if(file_exists(SITE_PATH.'/user/libraries/'.$class.'.php'))
		{
			require(SITE_PATH.'/user/libraries/'.$class.'.php');
		}
		else if(file_exists(SITE_PATH.'/libraries/'.$class.'.php'))
		{
			require(SITE_PATH.'/libraries/'.$class.'.php');
			

		}
		else
		{
			die('There is no auto load class. <br/> Class name: '.$class);
		}
	}
   
    if($class=="router"){
        $objects[$class] =& instantiate_class(new $name(SITE_PATH));
        $objects[$class]->load();
    }
    else{

        $objects[$class] =& instantiate_class(new $name());
    }

	return $objects[$class];
}

/**
 * @param  $class_object
 * @return $class_object
 */
function &instantiate_class(&$class_object)
{
	return $class_object;
}
