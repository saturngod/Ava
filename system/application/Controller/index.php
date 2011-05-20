<?php
class IndexController extends Controller {
	
    function IndexController()
    {
        parent::Controller();
    }
    
	function index()
	{
		$data['title']="Ava Framework Documentation";
        $this->load->view('header',$data);
		$this->load->view('home');
        $this->load->view('footer');
	}
}
?>