<?php
class Controller extends Ava_Base {

	function Controller()
	{	
		parent::Ava_Base();
		$this->_initialize();

	}
	
	function _initialize()
	{

		//initalize Loader
		$auto_load=array("io","segment");
		
		foreach($auto_load as $library)
		{
			$this->$library=& load_class($library);
		}
		$this->load =& load_class('Loader');
		$this->load->_auto_load();
	}
}
?>