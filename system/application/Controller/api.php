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
        //var_dump($this->segment->get_list());
        $this->response(array('test'=>1,'test2'=>'testing'),200);
        
    }
}
?>