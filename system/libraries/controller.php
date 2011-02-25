<?php
class Controller extends Ava_Base {

	function Controller()
	{	
		parent::Ava_Base();
		$this->_initialize();

	}
	
	function _initialize()
	{
		$this->load =& load_class('Loader');
	}
}
?>