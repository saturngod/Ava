<?php
class RestController extends Ava_RESTController {
	function index(){

        $this->get_route("/","home");
        $this->get_route("/test","testing");
        $this->post_route("/test","posttesting");
        $this->get_route("/name/:username","showusername");
        $this->get_route("/name/:username/detail/:id","userdetail");
        $this->run($this);

	}

    protected function home()
    {
        echo "HOME";
    }

    protected function testing()
    {
        echo "this is testing page";
    }

    protected function showusername($params)
    {
       $this->load->view("restview",$params);
    }

    protected function userdetail($params)
    {
        $this->load->view("restview",$params);
    }

    protected function posttesting()
    {
        echo "POST TESTING";
    }
}
?>