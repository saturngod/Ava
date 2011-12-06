<?php
/**
 * RESTController Class
 * @package Ava
 * @since version 1.0
 * @author saturngod
 * @category controller
 */
class Ava_Controller extends Ava_Base {

    /**
     * @access public
     * @var Loader $load
     */
    public $load;

    private $getRoute=array();
    private $postRoute=array();
    private $putRoute=array();
    private $deleteRoute=array();

    /**
     * constructor
     * @return void
     */
    function __construct()
    {   
        parent::Ava_Base();
        $this->_initialize();
    }


    /**
     * Initialize the autoload and class
     * @return void
     */
    function _initialize()
    {

        //initalize Loader
        $auto_load=array("io","segment","router");
        
        foreach($auto_load as $library)
        {
            $this->$library=& load_class($library);
        }
        //load loader class
        $this->load =& load_class('Loader');
        
        //call auto load from config file
        $this->load->_auto_load();
    }

    function respond($status=200,$message='',$content_type='application/json') {
        $this->io->write($status,$message,$content_type);
    }

    /**
     * remove / at the end
     *
     * @return string $str
     * @author saturngod
     **/
    private function remove_end_slash($str)
    {
        if(strlen($str) > 1) {
            if(substr($str,-1)=="/")
            {
            $str=substr($str,0,strlen($str)-1);
            }
        }
        return $str;
    }

    /**
     * for get routing
     *
     * @return void
     * @author saturngod
     **/
    function get_route($name,$function)
    {
        $name=$this->remove_end_slash($name);
        $this->getRoute[$name]=$function;
    }

    /**
     * for post routing
     *
     * @return void
     * @author saturngod
     **/
    function post_route($name,$function)
    {
        $name=$this->remove_end_slash($name);
        $this->postRoute[$name]=$function;
    }

    /**
     * for put routing
     *
     * @return void
     * @author saturngod
     **/
    function put_route($name,$function)
    {
        $name=$this->remove_end_slash($name);
        $this->putRoute[$name]=$function;
    }

    /**
     * for delete routing
     *
     * @return void
     * @author saturngod
     **/
    function delete_route($name,$function)
    {
        $name=$this->remove_end_slash($name);
        $this->deleteRoute[$name]=$function;
    }

    /**
     * for get param
     * @return array
     * @author saturngod
     **/
    function get_param($path,$url)
    {   
        $rule_items = explode('/',$path);
        $data_items = explode('/',$url);

        if($rule_items[count($rule_items)-1]=="")
        {
            array_pop($rule_items);
        }

        if (count($rule_items) == count($data_items)) {
            $result=array();

            foreach($rule_items as $rule_key => $rule_value) {
                if (preg_match('/^:[\w]{1,}$/',$rule_value)) {
                    $rule_value = substr($rule_value,1);
                    $result[$rule_value] = $data_items[$rule_key];
                }
                else {
                    if (strcmp($rule_value,$data_items[$rule_key]) != 0) {
                        return false;
                    }
                }
            }
            if(count($result) > 0) return $result;
            unset($result);
        }
        
        return false;
    }

    /**
     * run the app with routing system
     * @return void
     * @author saturngod
     **/
    function run($app) {
        //check routing
        $list=$this->segment->get_list();
        $path="";
        //remove first array because it's router
        for($route=1;$route<count($list);$route++)
        {
            $path.="/".$list[$route];
        }

        if(count($_GET)>1) {
            $path=strstr($path,"?",true);
        }
        
        $path=$this->remove_end_slash($path);

        //init for home
        if($path=="") $path="/";

        //init the route
        $route=array();

        //check method
        if($this->io->method=="get")
        {
            $route=$this->getRoute;
        }
        else if($this->io->method=="post")
        {
            $route=$this->postRoute;
        }
        else if($this->io->method=="put")
        {
            $route=$this->putRoute;
        }
        else if($this->io->method=="delete")
        {
            $route=$this->deleteRoute;
        }
        
        if(isset($route[$path]))
        {
                $function=$route[$path];

                if(is_callable(array($app,$function))) {
                    $app->{$function}();
                }
                else {
                    $this->load->notfound_err("FUNCTION :: ".$function." ");
                }
                
        }
        else {
             if (count($route)) {
                foreach($route as $rule_key => $function) {
                    
                    $params = $this->get_param($rule_key,$path);
                    if($params)
                    {
                        if(is_callable(array($app,$function))) {
                            $app->{$function}($params);
                            break;
                        }
                        else {
                            $this->load->notfound_err("FUNCTION :: ".$function." ");
                        }
                    }
                }
            }
        }
        
    }
}
