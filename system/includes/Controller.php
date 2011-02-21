<?php
Abstract class Controller extends Loader {

public $load;

//For Constructor
function Controller()
{
	$this->load= new Loader();
}

abstract function index();

}
?>