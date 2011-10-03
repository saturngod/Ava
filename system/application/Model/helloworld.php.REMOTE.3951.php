<?php
class helloworldModel extends Ava_Model {


	function get_txt()
	{
		return "<p>Hello World</p>";
	}
	
	function form_db()
	{
		return $this->db->get('CHARACTER_SETS');
	}
}
?>