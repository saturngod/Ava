<?php
class HelperController extends Ava_Controller {
    
    function index() {
        
        $data['title']="Helper";
        $this->load->view('header',$data);
		$this->load->view('helper');
        $this->load->view('footer');
        
    }
}

?>