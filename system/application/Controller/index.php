<?php
class IndexController extends Controller {
	
    function IndexController()
    {
        parent::Controller();
    }
    
	function index()
	{
		echo "HI";
	}
	
    function helloworld()
    {
        $this->load->model('helloworld');
        echo $this->helloworld->get_txt();
        
    }
    function myview()
    {
    	$data['base']='HI';
    	$data['public']=AWConfig::public_url;
    	$data['txt']='This is testing';
    	$this->load->view('home',$data);
    }
}
?>