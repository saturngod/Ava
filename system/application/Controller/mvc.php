<?php
class MvcController extends Ava_Controller {
	
    
	function index()
	{
		$data['title']="MVC";
        $this->load->view('header',$data);
		$this->load->view('mvc/index');
        $this->load->view('footer');
	}

    function controller()
    {
        $data['title']="Controller";
        $this->load->view('header',$data);
        $this->load->view('mvc/controller');
        $this->load->view('footer');

    }

    function model()
    {
        $data['title']="Model";
        $this->load->view('header',$data);
        $this->load->view('mvc/model');
        $this->load->view('footer');
    }

    function view()
    {
        $data['title']="View";
        $this->load->view('header',$data);
        $this->load->view('mvc/view');
        $this->load->view('footer');
    }
}
?>