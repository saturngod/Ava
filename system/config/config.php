<?php
Class AvaConfig
{
	//for baseurl, current runing link
	const base_url="http://localhost/avadoc";
	
	const htaccess = true;
	
	
	//Database Setup
	const db_host="localhost";
	const db_name="";
	const db_user="";
	const db_password="";
	
	//autoloading library
	// database class is db
	public static $autoload=array("db");

	const DEBUG=true;

	const google_analystic="UA-2358448-26";
	const session_timeout=60; //seconds
	
	
	
}

?>