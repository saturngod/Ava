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
	
	
	if($class=='Loader')
	{
		$name="Ava_Loader";
	}
	
	
	if($class!='Loader')
	{

		if(file_exists(SITE_PATH.'/libraries/'.$class.'.php'))
		{
			require(SITE_PATH.'/libraries/'.$class.'.php');
			
			$name="Ava_".ucfirst($class);
		}
		else
		{
			die('There is no auto load class. <br/> Class name: '.$class);
		}
	}

	// Does the class exist?  If so, we're done...
	if (isset($objects[$name]))
	{
		return $objects[$name];
	}
	if($class="facebook")
	{
		$objects[$class] =& instantiate_class(new $name(array(
			  'appId'  => AvaConfig::fbappid,
			  'secret' => AvaConfig::fbapisecret,
			  'cookie' => AvaConfig::fbcookie,
			)));
	}
	else
	{
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
?>