<?php
class HelloworldModel extends Ava_Model {


	function get_txt()
	{
		echo "<p>Hello World</p>";
	}
	
	function form_db()
	{
		return $this->db->get('CHARACTER_SETS');
	}
}
?>