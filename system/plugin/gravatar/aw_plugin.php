<?php

/**
 * gravatar
 * 
 * gravatar plugin
 *
 * @author saturngod
 * @package Nifty
 * @category plugin
 */
 
class gravatar
{
	private $GRAVATAR_PATH = "http://www.gravatar.com/avatar/";
	private $GRAVATAR_RATING = array("G", "PG", "R", "X"); 
	private $email;
	
	private $properties = array(
	        "d"        => NULL,
	        "s"            => 80,        // The default value
	        "r"        => NULL,
	);
	
	public function __construct($email=NULL, $default=NULL)
	{
		$this->email=$email;
		$this->properties['d']=$default;
	}
	
	public function setEmail($email)
	{
		$this->email=$email;
	}
	
	public function setRating($rate)
	{
		if(in_array($rate, $this->GRAVATAR_RATING))
		{
			$this->properties['r'] = $rating;
			
		}
		else
		{
			$this->properties['r'] ="G";
		}
	}
	
	public function setSize($size)
	{
		$this->properties['s']=(int)$size;
	}
	
	public function setDefault($default)
	{
		$this->properties['d']=$default;
	}
	
	public function get()
	{
		$url=$this->GRAVATAR_PATH.MD5($this->email);
		$first=true;
		foreach($this->properties as $key => $value) {
		          
		    if (isset($value)) 
		    {
		    	if($first)
		    	{
		    		$url.="?";
		    	}
		       $url .= $key."=".urlencode($value)."&";
		       $first = false;
		    }
		 }
		 $url=substr($url,0,-1);
		 return $url; 
	}
	
}
?>