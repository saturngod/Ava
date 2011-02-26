<?php
Class AvaConfig
{
	//for baseurl, current runing link
	const base_url="http://localhost/avalight";
	const public_url= "http://localhost/avalight/system/public";
	const public_path= "/public";
	
	const htaccess = true;
	
	
	//Database Setup
	const db_host="localhost";
	const db_name="ornagai-test";
	const db_user="root";
	const db_password="root";
	
	//autoloading library
	// database class is db
	public static $autoload=array("jquery","db");
	
	
}

?>