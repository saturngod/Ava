<?php
Abstract class Controller extends loader {

	public $load;
	abstract function index();
		
	function Controller()
	{
		self::loader();
	}
}
?>