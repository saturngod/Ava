Nifty is a very sample framework for education purpose. It also opensource and using MIT license. If you want to make your own framework, you can learn basic structure from nifty framework. It's using MVC strcuture and OOP. Written by PHP 5.3. There is a just design for MVC. No extra library , no database class. Very very sample MVC design.

*Checking URL ::*

http://localhost/nifty/
http://localhost/nifty/index.php
http://localhost/nifty/index.php/index/sample

**Config File ::** 
/system/config/config.php

**Controller ::**
/system/app/controller

**Model ::**
/system/app/model

**View ::**
/system/app/view


**Configure**

$config['start_page'] is a start controller file. no need to add .php. Just need to add file name.

**Creating Controller**

You need to extends controller class and call parent::Controller(). You can check example from system/app/controller/index.php

**Creating Model**

You need to extends model class and call parent::Model(). You can check example from system/app/controller/index.php

*example::*

$this->load->model('modelname');
$this->modelname->model_function();

**View**

View is a sample php file. If you want to parse data with array. It will extract variable when arrive view.

*example::*

***index controller***

$data['mydata']='sample';

$this->load->view('view',$data);

***view.php (/system/app/view/view.php)***

echo $mydata;