<?php
class rest_model extends Ava_Model {

    function home()
    {
        $this->io->write(200,array("message"=>"hello world"));
    }

    function testing()
    {
        $this->io->write(200,array("message"=>"Page"));
    }

    function showusername($params)
    {
       $this->load->view("restview",$params);
    }

    function userdetail($params)
    {
        $this->load->view("restview",$params);
    }

    function post_user($params)
    {
        //io->post(array_name,xss_clean); default xss_clean is false
        if($this->io->post('message',true)!="")
        {
            $this->io->write(200,array("method"=>$this->method,"message"=>$this->io->post('message',true),"params"=>$params));
        }
        else {
            $this->io->write(200,array("method"=>$this->method,"params"=>$params));   
        }
    }

    function delete_user($params)
    {
        if($this->io->delete('message',true)!="")
        {
            $this->io->write(200,array("method"=>$this->method,"message"=>$this->io->delete('message',true),"params"=>$params));
        }
        else {
            $this->io->write(200,array("method"=>$this->method,"params"=>$params));   
        }
    }

    function put_user($params)
    {
        if($this->io->put('message',true)!="")
        {
            $this->io->write(200,array("method"=>$this->io->method,"message"=>$this->io->put('message'),"params"=>$params));
        }
        else {
            $this->io->write(200,array("method"=>$this->io->method,"params"=>$params));   
        }
    }

}
