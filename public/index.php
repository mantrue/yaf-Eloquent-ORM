<?php
define("APP_PATH", dirname(dirname(__FILE__)));
$app = new Yaf\Application(APP_PATH . "/conf/application.ini"); 
$app->bootstrap()->run();
