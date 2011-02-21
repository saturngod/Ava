<?php
Abstract class Model extends Loader{

	public $load;
	
	function Model()
	{
		$this->load = new Loader();
	}

}
?>