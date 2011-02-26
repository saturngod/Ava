<?php
class ApiController extends RESTController {
	
    function ApiController()
    {
        parent::RESTController();
    }
    
	function index()
	{

	}
    function word()
    {

        $respond=array();
        $respond['q']=$this->get('q');
        $this->response($respond,200);
        
    }
}
?>