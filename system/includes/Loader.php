<?php
/**
 * Ava_Loader
 * Loader class
 * @package Ava
 * @since version 1.0
 * @author saturngod
 */
class Ava_Loader {

	var $_ava_models			= array();
	var $_ava_loaded_libraries	= array();

    /**
     * constructor
     * @return void
     */
	function Ava_Loader()
	{
		
	}

    /**
     * load model with custom model or not
     * @param string $modelname
     * @param string $name
     * @return void
     */
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
			//check alery exist or not
			if(!in_array($name,$this->_ava_models))
			{
				if($name=="")
				{
					$name=$modelname;
				}
				require(SITE_PATH."/application/Model/".$modelname.".php");
				$modelclassname = ucfirst($modelclassname);
				$Ava->$name=new $modelclassname();
				$Ava->$name->_assign_libraries();
				$this->_ava_models[] = $name;
			}
		}
	}

    /**
     * load view
     * @param  $view
     * @param string $data_array
     * @return void
     */
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

    /**
     * load library class. After loaded, you can call $this->$library
     * @param string $library
     * @return bool
     */
	function library($library = null)
	{
		if ($library == null)
		{
			return FALSE;
		}

		if (is_array($library))
		{
			foreach ($library as $class)
			{
				$this->_load_class($class);
			}
		}
		else
		{
			$this->_load_class($library);
		}
		
		$this->_assign_to_models();
	}

    /**
     * load auto class
     * @return void
     */
	function _auto_load()
	{
		foreach(AvaConfig::$autoload as $library)
		{
			$this->_load_class($library);
		}
	}

    /**
     * load class
     * @param  $library
     * @return
     */
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

    /**
     * assign all the class models
     * @return
     */
	function _assign_to_models()
	{
		if (count($this->_ava_models) == 0)
		{
			return;
		}
		
		$Ava =& get_instance();
		foreach ($this->_ava_models as $model)
		{			
			if($model!="")
			{
				$Ava->$model->_assign_libraries();
			}
		}
		
	}

    /**
     * helper is just function
     * @param  $helper
     * @return void
     */
	public function helper($helper)
	{
		if(!file_exists(SITE_PATH."/helper/".$helper.".php")) {
			$this->notfound_err("HELPER::". $helper);
		}
		else {
			require SITE_PATH."/helper/".$helper.".php";
		}
	}

    /**
     * add script src from js folder
     * @param  $javascript
     * @return void
     */
	public function js($javascript)
	{
		echo "<script src='".AvaConfig::public_url."/js/".$javascript.".js'></script>";
	}

    /**
     * add css file path
     * @param  $cssfile
     * @return void
     */
	public function css($cssfile)
	{
		echo "<link rel='stylesheet' href='".AvaConfig::public_url."/".$cssfile.".css' type='text/css' />";
	}

    /**
     * plugin is other extra class
     * @param  $name
     * @return void
     */
	public function plugin($name)
	{
		if(!file_exists(SITE_PATH.'/plugin/'.$name.'.php'))
		{
			$this->notfound_err("Plugin::".$name);
		}
		else
		{
			require SITE_PATH.'/plugin/'.$name.'.php';
		}
		
	}

    /**
     * 404 ERROR
     * @param  $type
     * @return void
     */
	private function notfound_err($type)
	{
        header("Status: 404 Not Found");
		die("<div style='background-color:#FF9BA2;border:1px solid #FF4745;width:90%;margin:0px auto;padding:8px;color:#555'>$type not found</div>");
		
	}
}
?>