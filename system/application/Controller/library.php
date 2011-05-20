<?php
class LibraryController extends Controller {
	
    function IndexController()
    {
        parent::Controller();
    }
    
	function index()
	{
		$data['title']="Library";
        $this->load->view('header',$data);
		$this->load->view('library/index');
        $this->load->view('footer');
	}

    function database()
    {
        $data['title']="Database";
        $this->load->view('header',$data);
		$this->load->view('library/database');
        $this->load->view('footer');
    }

    function segment()
    {
        $data['title']="Segment";
        $this->load->view('header',$data);
		$this->load->view('library/segment');
        $this->load->view('footer');
    }

    function session()
    {
        $data['title']="Session";
        $this->load->view('header',$data);
		$this->load->view('library/session');
        $this->load->view('footer');
    }

    function paging()
    {
        $data['title']="Session";
        $this->load->view('header',$data);
		$this->load->view('library/paging');
        $this->load->view('footer');
    }
}
?>