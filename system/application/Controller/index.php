<?php
class IndexController extends Ava_Controller {
    
	function index()
	{
		$data['title']="Ava Framework Documentation";
        $this->load->view('header',$data);
		$this->load->view('home');
        $this->load->view('footer');
	}
}
?>