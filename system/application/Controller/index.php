<?php
class IndexController extends Controller {
	
    function IndexController()
    {
        parent::Controller();
    }
    
	function index()
	{
		$data['base']=AwConfig::base_url;
		$data['public']=AwConfig::public_url;
		
		$this->load->model("helloworld");
		$data['txt']=$this->helloworld->get_txt();

		$this->load->view('home',$data);


	}
    function word()
    {
        var_dump($this->segment->get_list());
    }
}
?>