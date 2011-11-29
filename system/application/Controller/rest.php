<?php
class RestController extends Ava_RESTController {
	function index(){

        $this->get_route("/","home");
        $this->get_route("/test","testing");
        $this->get_route("/name/:username","showusername");
        $this->get_route("/name/:username/id/:id","userdetail");

        $this->post_route("/name/:username","post_user");

        $this->put_route("/name/:username","put_user");

        $this->delete_route("/name/:username","delete_user");


        $this->run($this);

	}

    protected function home()
    {
        $this->respond(200,array("message"=>"HOME"));
    }

    protected function testing()
    {
        $this->respond(200,array("message"=>"Page"));
    }

    protected function showusername($params)
    {
       $this->load->view("restview",$params);
    }

    protected function userdetail($params)
    {
        $this->load->view("restview",$params);
    }

    protected function post_user($params)
    {
        if(isset($this->post->message))
        {
            $this->respond(200,array("method"=>$this->method,"message"=>$this->post->message,"params"=>$params));
        }
        else {
            $this->respond(200,array("method"=>$this->method,"params"=>$params));   
        }
    }

    protected function delete_user($params)
    {
        if(isset($this->delete->message))
        {
            $this->respond(200,array("method"=>$this->method,"message"=>$this->delete->message,"params"=>$params));
        }
        else {
            $this->respond(200,array("method"=>$this->method,"params"=>$params));   
        }
    }

    protected function put_user($params)
    {
        if(isset($this->put->message))
        {
            $this->respond(200,array("method"=>$this->method,"message"=>$this->put->message,"params"=>$params));
        }
        else {
            $this->respond(200,array("method"=>$this->method,"params"=>$params));   
        }
    }
}
?>