Ava Framework is an open source web application framework. It will help you develop your application faster. Ava light version will helps you develop your own framework. You can download from [Ava-light branch](https://github.com/saturngod/Ava/tree/ava-lite) . You can read documentation from [https://github.com/saturngod/Ava/wiki]( https://github.com/saturngod/Ava/wiki) .

## Require

 1. PHP 5.3
 2. PHP PDO


## ChangeLog

Version 1.1 May 21 2012 [saturngod at gmail dot com]

* support multi function in routing
	
		$get['/admin/:username']="checklogin,showadmin";

		$fun[0]="checklogin";
		$fun[1]="showadmin";
                
		$get['/witharray/:username']=$fun;


Version 1.0.5 May 14, 2012 [saturngod at gmail dot com]

* support array in routing

		$get["/"]="home";
		$get["/test"]="testing";
		$get["/name/:username"]= "showusername";
		$get["/name/:username/id/:id"]="userdetail";
                
		$this->get_route($get);



Version 1.0.4 Apr 18 , 2012 [saturngod at gmail dot com]

* support $this->io->get_puts() and $this->io->get_deletes();
* support db_port

Version 1.0.3 Jan 30 , 2012 [saturngod at gmail dot com]

* support Closure (callback) in routing
* add IS (NOT) NULL in db
* support bracket in db
* fixed same view can't load two time
* fixed same helper can't load two time

Version 1.0.2 Jan 30 , 2012 [saturngod at gmail dot com]

* change Load Model only need first character is lowercase (eg: support userRouting now)
* re-add Model in model class (e.g: userRouting.php , class name is userRoutingModel)
* re-add Controller in controller class (e.g.user.php , class name is userController)
* fixed same helper load more than one time
* fixed db class for missing $this->db->sql in insert and update
* support $this->io->request_body for JSON string or XML string in post , put , delete

Version 1.0.1 Jan 30 , 2012 [saturngod at gmail dot com]

* fixed same plugin load more than one time

Version 1.0 Jan 23 , 2012 [saturngod at gmail dot com]

* fixed db class for same field multi where
* add JOIN in db
* add $this->db->sql to get sql
* add $this-db->count for rows count

Version 0.7.2 Dec 6 [saturngod at gmail dot com]

* fixed GET in routing
* remove array_to_object in controller

Version 0.7.1 Dec 5 [saturngod at gmail dot com]

* remove outclass and merge with io
* fixed palace

Version 0.7 Dec 1+2 [saturngod at gmail dot com]

* change RestController to Controller.
* remove original controller
* change ClassNameController to ClassName in Controller
* change ClassNameModel to ClassName in Model
* update palace. Remove -r and --restcontroller
* fixed router
* support home_controller at config file
* add output class in $this object
* DEPRECATED in controller, $this->method, $this->get, $this->post, $this->put, $this->delete
* Support new , $this->io->method, $this->io->get('name',BOOL xss_clean), $this->io->post('name',BOOL xss_clean), $this->io->put('name',BOOL xss_clean), $this->io->delete('name',BOOL xss_clean), $this->io->header('name',BOOL xss_clean)



Version 0.6.5 Nov 29 [saturngod at gmail dot com]

* add Rest Routing System in rest controller. Check /system/application/Controller/rest.php
* support GET , POST , PUT , DELETE method for routing

Version 0.6.1 Oct 26 [saturngod at gmail dot com]

* change status code 404 in controller not found

Version 0.6 Oct 25 [saturngod at gmail dot com]

* fixed Loader for load module
* update model
* update the home screen

Version 0.5.6 Oct 19 2001 [saturngod at gmail dot com]

* change $this->db->where(field,data,equal) to $this->db(fiedl with condition,data)

Version 0.5.5.2 Oct 13 2001 [saturngod at gmail dot com]

* add session id in session library
* exit at respond in RESTController

Version 0.5.5.1 Oct 11 2001 [saturngod at gmail dot com]

* fixed Segment get_list()

Version 0.5.5 Oct 11 2001 [saturngod at gmail dot com]

* fixed Home Constant not exist in config
* fixed Debug Error Message For Terminal

Version 0.5.4 Oct 1 2001 [saturngod at gmail dot com]

* add get header in io class

Version 0.5.3 Oct 1 2001 [saturngod at gmail dot com]

* Change Config for Production and Development
* Add home_controller in config
* Fixed home directory with index.php

Version 0.5.1 Oct 1 2001 [saturngod at gmail dot com]

* Change $this->db->insert(data,table_name) to (table_name,data)
* Change $this->db->update(data,table_name) to (table_name,data)

Version 0.5 Sep 20 2011 [saturngod at gmail dot com]

* Add Database Error checking. $this->db->err
* Add sql injection fix. $this->db->query($sql,$arr);

## Installtion

The public folder is www folder. You need to make document root is www folder. If you don't have a permission to change document root, you can change htaccess file to the .htaccess for rewrite rule.

## Doc

You can read documentation on http://doc.avaframework.com. If you have a question , you can send mail to the saturngod at gmail dot com.