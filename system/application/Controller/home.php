<?php

class Home extends Ava_Controller {
	
	/**
	 * Place to start writing the code 
	 */
	function index()
	{
		/*
		SELECT * FROM `checkin`
        GROUP BY `user_id`
        HAVING (rate) > 1
        */
        $this->db->select("AVG(rate)");
        $this->db->group_by("club_id");
        $this->db->having("AVG(rate) > 2");
		$result=$this->db->get("checkin");

		echo "<pre> SQL:";
		print_r($this->db->sql);
		echo "</pre>";

		echo "<pre>Result:";
		print_r($this->db->count());
		echo "</pre>";
    }
}

