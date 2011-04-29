<?php
Class AvaConfig
{
	//for baseurl, current runing link
	const base_url="http://localhost/avalight";
	
	const htaccess = true;
	
	
	//Database Setup
	const db_host="localhost";
	const db_name="ornagai";
	const db_user="root";
	const db_password="root";
	
	//autoloading library
	// database class is db
	public static $autoload=array("db");

	
}

?>