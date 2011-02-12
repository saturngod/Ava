<?php
Abstract class Controller extends Loader {

public $load;

//For Constructor
function Controller()
{
	self::Loader();
}

abstract function index();

}
?>