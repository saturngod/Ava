<?php
class restController extends Ava_Controller {

	/**
	 * Index Page
	 *
	 * @return void
	 * @author saturngod
	 */
	function index(){
                
                $get["/"]="home";
                $get["/test"]="testing";
                $get["/name/:username"]= "showusername";
                $get["/name/:username/id/:id"]="userdetail";
                
                $get['/admin/:username']="checklogin,showadmin";

                $fun[0]="checklogin";
                $fun[1]="showadmin";
                $get['/witharray/:username']=$fun;

                $this->get_route($get);
                
                $this->get_route("/callback",function(){
                    echo "This is callback";
                });
                
                $this->get_route("/callback/:id",function($param){
                    echo $param['id'];
                });

                $this->post_route("/name/:username","post_user");

                $this->put_route("/name/:username","put_user");

                $this->delete_route("/name/:username","delete_user");

		$this->load->model("rest");
                $this->run($this->rest);

	}

}
