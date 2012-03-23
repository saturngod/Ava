<?php

/**
 * gravatar
 * 
 * gravatar plugin
 *
 * @since version 1.0
 * @author saturngod
 * @category Plugin
 * @package Ava
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

    /**
     * @param null $email
     * @param null $default
     */
	public function __construct($email=NULL, $default=NULL)
	{
		$this->email=$email;
		$this->properties['d']=$default;
	}

    /**
     * set email for avatar
     * @param  $email
     * @return void
     */
	public function setEmail($email)
	{
		$this->email=$email;
	}

    /**
     * rating for avatar
     * @param  $rate
     * @return void
     */
	public function setRating($rate)
	{
		if(in_array($rate, $this->GRAVATAR_RATING))
		{
			$this->properties['r'] = $rate;
			
		}
		else
		{
			$this->properties['r'] ="G";
		}
	}

    /**
     * set image size
     * @param  $size
     * @return void
     */
	public function setSize($size)
	{
		$this->properties['s']=(int)$size;
	}

    /**
     * set default
     * @param  $default
     * @return void
     */
    
     // http://en.gravatar.com/site/implement/images/
     // mm: (mystery-man) a simple, cartoon-style silhouetted outline of a person (does not vary by email hash)
     // identicon: a geometric pattern based on an email hash
     // monsterid: a generated 'monster' with different colors, faces, etc
     // wavatar: generated faces with differing features and backgrounds
     // retro: awesome generated, 8-bit arcade-style pixelated faces
     
	public function setDefault($default)
	{

		$this->properties['d']=$default;
	}

    /**
     * return URL
     * @return string
     */
	public function get()
	{
		$url=$this->GRAVATAR_PATH.MD5(strtolower($this->email));
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
