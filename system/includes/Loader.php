<?php
class Ava_Loader {

	var $_ava_models			= array();
	var $_ava_loaded_libraries	= array();
	
	function Ava_Loader()
	{
		
	}
	public function model($modelname,$name='')
	{
		$Ava =& get_instance();
		$modelname = strtolower($modelname);
		$modelclassname=$modelname."Model";
		
		//Check File exist or not
		if(!file_exists(SITE_PATH."/application/Model/".$modelname.".php"))
		{
			$this->notfound_err("Model");
		}
		else
		{
			require(SITE_PATH."/application/Model/".$modelname.".php");
			$modelclassname = ucfirst($modelclassname);
			$Ava->$modelname=new $modelclassname();
			$Ava->$modelname->_assign_libraries();
			$this->_ava_models[] = $name;
		}
	}
	
	public function view($view,$data_array='')
	{
		if(!file_exists(SITE_PATH."/application/View/".$view.".php"))
		{
			$this->notfound_err("View");
		}
		else
		{
			$_ava_Ava =& get_instance();
			foreach (get_object_vars($_ava_Ava) as $_ava_key => $_ava_var)
			{
				if ( ! isset($this->$_ava_key))
				{
					$this->$_ava_key =& $_ava_Ava->$_ava_key;
				}
			}
			
			if(is_array($data_array))
			{
				extract($data_array);
			}
			require(SITE_PATH."/application/View/".$view.".php");
		}
			
	}
	
	function library($library = '')
	{
		if ($library == '')
		{
			return FALSE;
		}

		if (is_array($library))
		{
			foreach ($library as $class)
			{
				$this->_load_class($class, $params, $object_name);
			}
		}
		else
		{
			$this->_load_class($library);
		}
		
		$this->_assign_to_models();
	}
	
	function _auto_load()
	{
		foreach(AvaConfig::$autoload as $library)
		{
			$this->_load_class($library);
		}
	}
	
	function _load_class($library)
	{
		//check duplicate
		if (in_array($library, $this->_ava_loaded_libraries))
		{		
			return;
		}
		
		$_ava_Ava =& get_instance();
		$_ava_Ava->$library=& load_class($library);
		$this->_ava_loaded_libraries[]=$library;
		
		
	}
	
	function _assign_to_models()
	{
		if (count($this->_ava_models) == 0)
		{
			return;
		}

		$Ava =& get_instance();
		foreach ($this->_ava_models as $model)
		{			
			$CI->$model->_assign_libraries();
		}
		
	} 
	
	private function notfound_err($type)
	{
		die("<div style='background-color:#FF9BA2;border:1px solid #FF4745;width:90%;margin:0px auto;padding:8px;color:#555'>$type not found</div>");
		
	}
}
?>