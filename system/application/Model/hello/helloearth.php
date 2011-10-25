<?php
class HelloearthModel extends Ava_Model {


	function get_txt()
	{
		echo "EARTH.";
		$this->load->model('helloworld');
		$this->helloworld->get_txt();
	}
	
}
?>