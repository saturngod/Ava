<?php
Class AvaConfig
{
//for baseurl, current runing link
const base_url="http://localhost/Ava";

const htaccess = true;


//Database Setup
const db_host="localhost";
const db_name="app_drops";
const db_user="root";
const db_password="root";

//home page controller
const home_controller = 'home';

//autoloading library
// database class is db
public static $autoload=array("db","session");

const DEBUG=true; //show error or not; recommend true for development

const google_analystic="UA-2358448-26";
const session_timeout=60; //seconds
}
