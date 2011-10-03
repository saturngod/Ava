<?php
class helloworldModel extends Model {


	function helloworldModel()
	{
		parent::Model();
	}
	function get_txt()
	{
		return "Hello World";
	}
	
	function form_db()
	{
		return $this->db->get('user');
	}
}
?>