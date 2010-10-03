<?php
class indexController extends Controller {
	function indexController() {
		//constroctor for loader
		parent::Controller();
	}
	
	function index() {
		echo "HELLO";
	}
	
	function sample() {
		$this->load->model("print");
		$this->print->show();
		
		$data['title']='hello';
		$data['sample']='this is sample text';
		$data['base']=$this->load->config('base');
		
		$this->load->view("view",$data);
	}
}
?>