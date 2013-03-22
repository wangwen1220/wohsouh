<?php
require '../../../config/config_global.php';
define("UserName",$_config['db']['1']['dbuser']);
define("PassWord",$_config['db']['1']['dbpw']);
define("ServerName",$_config['db']['1']['dbhost']);
define("DBName",$_config['db']['1']['dbname']);
define("ERR","err.php");
date_default_timezone_set("PRC");
define("TIME",date("Y-m-d H:i:s"));
define("BIANHAO",date("YmdHis"));
define("IP",$_SERVER['REMOTE_ADDR']);
define("DX_URL",'http://192.168.2.93/');
?>