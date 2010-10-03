<?php
class loader {
	function loader() {
		$this->load=$this;
	}
	
	function model($model_name)
	{
		include ABS_PATH."/system/app/model/".$model_name.".php";
		$model=$model_name."Model";
		$model= new $model();
		$this->$model_name=$model;
	}
	
	function view($view_name,$data)
	{
		if(is_array($data))
		{
			extract($data);
		}
		
		include ABS_PATH."/system/app/view/".$view_name.".php";
		
	}
	
	function config($name)
	{
		include(ABS_PATH."/system/config/config.php");
		return $config[$name];
	}
}
?>