<?php
/**
 * Model class
 * this class also base on CodeIgniter 1.7
 * @package Ava
 * @since version 1.0
 * @author saturngod , ExpressionEngine Dev Team
 * @category Library
 */
class Ava_Model {
	
	var $_parent_name = '';

    /**
     * constructor
     * @return void
     */
	function __construct()
	{
		// If the magic __get() or __set() methods are used in a Model references can't be used.
		$this->_assign_libraries( (method_exists($this, '__get') OR method_exists($this, '__set')) ? FALSE : TRUE );
		
		// We don't want to assign the model object to itself when using the
		// assign_libraries function below so we'll grab the name of the model parent
		$this->_parent_name = ucfirst(get_class($this));
		
		
	}

    /**
     * copy all of the controller object to model
     * @param bool $use_reference
     * @return void
     */
	function _assign_libraries($use_reference = TRUE)
	{
			$Ava =& get_instance();				
			foreach (array_keys(get_object_vars($Ava)) as $key)
			{
				if ( ! isset($this->$key) AND $key != $this->_parent_name)
				{			
					// In some cases using references can cause
					// problems so we'll conditionally use them
					if ($use_reference == TRUE)
					{
						$this->$key = NULL; // Needed to prevent reference errors with some configurations
						$this->$key =& $Ava->$key;
					}
					else
					{
						$this->$key = $Ava->$key;
					}
				}
			}		
	}
}
?>