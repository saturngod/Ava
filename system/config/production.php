<?php
Class AvaConfig
{
//for baseurl, current runing link
const base_url="http://localhost/avalight";

const htaccess = true;


//Database Setup
const db_host="localhost";
const db_name="information_schema";
const db_user="root";
const db_password="root";
const db_encode = "utf8";
const db_port = 3306;

//home page controller
const home_controller = 'index';

//autoloading library
// database class is db
public static $autoload=array("db","session");

const DEBUG=true; //show error or not; recommend true for development

const google_analystic="UA-2358448-26";
const session_timeout=60; //seconds
}
