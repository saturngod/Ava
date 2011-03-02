<?php
class ApiController extends RESTController {
	
    function ApiController()
    {
        parent::RESTController();
    }
    
	function index()
	{

	}
    function word_get()
    {
        $respond=array();
        $respond['q']=$this->get('q');
        $this->response($respond,200);
        
    }
}
?>