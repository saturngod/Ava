<?php
/**
 * Loader
 * 
 * Core Loader Class
 *
 * @author saturngod
 * @package Nifty
 * @version 1.0
 */
class Loader {

	/**
	 * Loader
	 * 
	 * Loader Constructor
	 *
	 * @author saturngod
	 * @package Loader
	 * @category core
	 * @tag value
	 */
	public function Loader()
	{
		$this->load=$this;
        $this->output=new output();
		$this->jq=new jquery();
		$this->segment=new segment();
		//Auto Load

		foreach(AWConfig::$autoload as $library)
		{
			if(strtolower($library)=="facebook")
			{
				$this->fb=new Facebook(array(
				  'appId'  => AWConfig::fbappi,
				  'secret' => AWConfig::fbapisecret,
				  'cookie' => AWConfig::fbcookie,
				));
			}
			else
			{
				$this->{$library}=new $library();
			}
		}

	}

	private function notfound_err($type)
	{
		die("<div style='background-color:#FF9BA2;border:1px solid #FF4745;width:90%;margin:0px auto;padding:8px;color:#555'>$type not found</div>");
		
	}
	
	public function model($modelname,$name='')
	{	
		//Model name require Model
		$modelclassname=$modelname."Model";
		
		//Check File exist or not
		if(!is_file(SITE_PATH."/application/Model/".$modelname.".php"))
		{
			$this->notfound_err("Model");
			exit();
		}
		else
		{
			if($name=='')
			{
				$this->{$modelname}= new $modelclassname();
			}
			else
			{
				$this->{$name}=new $modelclassname();
			}
		}
		
	}
	
	public function view($view,$data_array='')
	{
		//extract for $data['variable']=value to variable=value
		if(is_array($data_array))	extract($data_array);
		
		//Check File exist or not
		if(!is_file(SITE_PATH."/application/View/".$view.".php"))
		{
			$this->notfound_err("View");
		}
		else
		{
			require SITE_PATH."/application/View/".$view.".php";
		}
	}
	
	public function js($javascript)
	{
		if(!is_file(SITE_PATH."/public/".$javascript.".js"))
		{
			$this->notfound_err("Javascript");
		}
		else
		{
			echo "<script src='".AWConfig::public_url."/".$javascript.".js'></script>";
		}
		
	}
	
	public function css($cssfile)
	{
		if(!is_file(SITE_PATH."/public/".$cssfile.".css"))
		{
			$this->notfound_err("css file");
		}
		else
		{
			echo "<link rel='stylesheet' href='".AWConfig::public_url."/".$cssfile.".css' type='text/css' />";
		}
	}
	
	public function redirect($string)
	{
		echo "<script>window.location='".$string."'</script>";
	}
	
	public function database()
	{
		if(!is_file(SITE_PATH.'/library/class/db.php'))
		{
			$this->notfound_err("Database");
		}
		else
		{
			require SITE_PATH.'/library/class/db.php';
			$this->db=new db();
		}
	}
	
	public function library($library)
	{
		$this->$library=new $library();
	}
	
	public function helper($helper)
	{
		require SITE_PATH."/library/helper/".$helper.".php";
	}
	
	public function plugin($name)
	{
		if(!is_file(SITE_PATH.'/library/class/Facebook.php'))
		{
			$this->notfound_err("Plugin::".$name);
		}
		else
		{
			require SITE_PATH.'/plugin/'.$name.'/aw_plugin.php';
		}
		
	}
	
	/**
	 * facebook
	 * 
	 * facebook PHP SDK
	 *
	 * @author saturngod
	 * @package Loader
	 * @category library
	 */
	public function facebook()
	{
		if(!is_file(SITE_PATH.'/library/class/facebook.php'))
		{
			$this->notfound_err("Facebook");
		}
		else
		{
			require SITE_PATH.'/library/class/facebook.php';
			$this->fb=new Facebook(array(
			  'appId'  => AWConfig::fbappid,
			  'secret' => AWConfig::fbapisecret,
			  'cookie' => AWConfig::fbcookie,
			));
		}
	}
	
	private function session()
	{
		$this->session=new session();
	}
	
	
	

}


function __autoload($class)
{
	$modelname=substr($class,0,-5);
	$type=substr($class,-5);
	if($type=="Model")
	{
			require SITE_PATH."/application/Model/".$modelname.".php";	
	}
	else
	{
		require SITE_PATH."/library/class/".$class.".php";
	}
}

?>