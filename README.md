Ava Framework is an open source web application framework. It will help you develop your application faster. Ava light version will helps you develop your own framework. It's still in development version. It will release soon. You can download from github. You can read documentation from Ava Doc.

## Require

 1. PHP 5.3
 2. PHP PDO


## ChangeLog

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