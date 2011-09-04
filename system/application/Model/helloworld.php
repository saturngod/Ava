<?php
class helloworldModel extends Ava_Model {


	function helloworldModel()
	{
		parent::Model();
	}
	function get_txt()
	{
		return "Hello World";
	}
}
?>