<?php
/**
 * Ava_Loader
 * Loader class
 * @package Ava
 * @since version 1.0
 * @author saturngod
 */
class Ava_Loader {

    var $_ava_models            = array();
    var $_ava_loaded_libraries  = array();

    /**
     * constructor
     * @return void
     */
    function Ava_Loader()
    {
        
    }

    /**
     * load model with custom model or not
     * @param string $modelname
     * @param string $name
     * @return void
     */
    public function model($modelname,$name='')
    {
        $Ava =& get_instance();
        $modelname = lcfirst($modelname);

        $file_path=$modelname;
        $models=explode("/",$modelname);
        $modelclassname=$models[count($models)-1];

        
        //Check File exist or not
        if(!file_exists(SITE_PATH."/application/Model/".$file_path.".php"))
        {
            $this->notfound_err("MODEL:: ".$modelclassname." ");
        }
        else
        {
            if($name=="")
            {
                $name=$modelclassname;
            }

            //check alery exist or not
            if(!in_array($name,$this->_ava_models))
            {
                
                require_once(SITE_PATH."/application/Model/".$file_path.".php");
                $modelclassname = lcfirst($modelclassname)."Model";
                $Ava->$name=new $modelclassname();
                $this->_ava_models[] = $name;
            }
        }
    }

    /**
     * load view
     * @param  $view
     * @param string $data_array
     * @return void
     */
    public function view($view,$data_array='')
    {
        if(!file_exists(SITE_PATH."/application/View/".$view.".php"))
        {
            $this->notfound_err("VIEW:: ".$view." ");
        }
        else
        {
            $_ava_Ava =& get_instance();
            foreach (get_object_vars($_ava_Ava) as $_ava_key => $_ava_var)
            {
                if ( ! isset($this->$_ava_key))
                {
                    $this->$_ava_key =& $_ava_Ava->$_ava_key;
                }
            }
            
            if(is_array($data_array))
            {
                extract($data_array);
            }
            include(SITE_PATH."/application/View/".$view.".php");
        }
            
    }

    /**
     * load library class. After loaded, you can call $this->$library
     * @param string $library
     * @return bool
     */
    function library($library = null)
    {
        if ($library == null)
        {
            return FALSE;
        }

        if (is_array($library))
        {
            foreach ($library as $class)
            {
                $this->_load_class($class);
            }
        }
        else
        {
            $this->_load_class($library);
        }
        
    }

    /**
     * load auto class
     * @return void
     */
    function _auto_load()
    {
        foreach(AvaConfig::$autoload as $library)
        {
            $this->_load_class($library);
        }
    }

    /**
     * load class
     * @param  $library
     * @return
     */
    function _load_class($library)
    {
        //check duplicate
        if (in_array($library, $this->_ava_loaded_libraries))
        {       
            return;
        }

        $_ava_Ava =& get_instance();
        $_ava_Ava->$library=& load_class($library);
        $this->_ava_loaded_libraries[]=$library;
        
        
    }

    /**
     * helper is just function
     * @param  $helper
     * @return void
     */
    public function helper($helper)
    {
        if(file_exists(SITE_PATH."/user/helper/".$helper.".php")) {
            require SITE_PATH."/user/helper/".$helper.".php";
        }
        else if(file_exists(SITE_PATH."/helper/".$helper.".php")) {
            require SITE_PATH."/helper/".$helper.".php";
        }
        else {
            $this->notfound_err("HELPER:: ". $helper);
        }
    }

    /**
     * add script src from js folder
     * @param  $javascript
     * @return void
     */
    public function js($javascript)
    {
        if(is_array($javascript))
        {
            foreach($javascript as $js)
            {
                echo "<script src='".AvaConfig::base_url."/".$js.".js'></script>";
            }
            
        }
        else
        {
            echo "<script src='".AvaConfig::base_url."/".$javascript.".js'></script>";
        }
    }

    /**
     * add css file path
     * @param  $cssfile
     * @return void
     */
    public function css($cssfile)
    {
        if(is_array($cssfile))
        {
            foreach($cssfile as $css)
            {
                echo "<link rel='stylesheet' href='".AvaConfig::base_url."/".$css.".css' type='text/css' />";
            }
        }
        else
        {
            echo "<link rel='stylesheet' href='".AvaConfig::base_url."/".$cssfile.".css' type='text/css' />";
        }
    }

    /**
     * plugin is other extra class
     * @param  $name
     * @return void
     */
    public function plugin($name)
    {
        if(file_exists(SITE_PATH."/user/plugin/".$name.".php")) {
            require_once SITE_PATH."/user/plugin/".$name.".php";
        }
        else if(file_exists(SITE_PATH."/plugin/".$name.".php")) {
            require_once SITE_PATH."/plugin/".$name.".php";
        }
        else {
            $this->notfound_err("PLUGIN:: ". $name);
        }
        
    }

    /**
     * 404 ERROR
     * @param  $type
     * @return void
     */
    function notfound_err($type)
    {
        header("Status: 404 Not Found");
        die("<div style='background-color:#FFBABA;border:1px solid #FF4745;width:90%;margin:0px auto;padding:8px;color:#D8000C'>$type not found</div>");
        
    }
}
