<?php
Class AwConfig
{
	//for baseurl, current runing link
	const base_url="http://localhost/nifty";
	const public_url= "http://localhost/nifty/system/public";

    const title="Nifty Framework";
    
    //for autoloading jquery class
	const jquery=true;
	
	//Database setup
	const db_host="localhost";
	const db_name="";
	const db_user="";
	const db_password="";
	
	//Facebook API Setup
	const fbappid="";
	const fbapisecret="";
	const fbcookie=true;
	
	const session_timeout=60; //seconds
	
	//Auto Load Class
	public static $autoload=array("db","session");
	
	const htaccess=true; //htaccess for apache. If you are using IIS , change to false
	
	//recaptcha plugin
	const recaptcha_publickey = "";
	const recaptcha_privatekey = "";
	
	//gmail sending
	const gmail_username="";
	const gmail_password="";
	
}

?>