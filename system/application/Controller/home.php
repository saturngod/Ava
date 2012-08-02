<?php

class homeController extends Ava_Controller {
	
	/**
	 * Place to start writing the code 
	 */
	function index()
	{
		$this->load->view('home');
        $this->load->library('cache');
        $testing="This is my world. LOL!!";
        $this->cache->store("testing",$testing,4000);
        $this->cache->clear();
    }
}

