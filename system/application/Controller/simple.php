<?php
class SimpleController extends Controller {
	
    function SimpleController()
    {
        parent::Controller();
    }
    
	function index()
	{
		echo "Test";
	}
	
	function test()
	{
		echo "HI";
	}
}
?>