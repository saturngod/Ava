<?php
Class AvaConfig
{
	//for baseurl, current runing link
	const base_url="http://localhost/Avadoc";
	
	const htaccess = true;
	
	
	//Database Setup
	const db_host="localhost";
	const db_name="information_schema";
	const db_user="root";
	const db_password="root";
	
	//autoloading library
	// database class is db
	public static $autoload=array("db","session");
	
	const DEBUG=true; //show error or not; recommend true for development
	
	const google_analystic="UA-2358448-26";
	const session_timeout=60; //seconds

	
}

?>