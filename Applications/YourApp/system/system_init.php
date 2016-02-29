<?php
@session_start();
$root_path = dirname(dirname(__FILE__));
define('APP_ROOT',$root_path);

require_once APP_ROOT.'/public/db.php';
$DB = new DB();   //init database helper

require_once APP_ROOT.'/public/common.php';

require_once APP_ROOT.'/system/router.php';
$router = new Router();
?>