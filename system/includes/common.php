<?php
function &load_class($class)
{
	static $objects = array();
	
	
	if($class=='Loader')
	{
		$name="Ava_Loader";
	}
	// Does the class exist?  If so, we're done...
	if (isset($objects[$name]))
	{
		return $objects[$name];
	}

	$objects[$class] =& instantiate_class(new $name());
	return $objects[$class];
}

function &instantiate_class(&$class_object)
{
	return $class_object;
}
?>