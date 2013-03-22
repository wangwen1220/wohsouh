<?php
if (defined('E_DEPRECATED'))
{
	error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING & ~E_DEPRECATED);
}
else
{
	error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING);
}
set_time_limit(0);
header('Content-Type:text/html;charset=utf-8');
define('RUN_CMSTOP', true);
if(is_file('../cmstop/data/install.lock'))
{
	echo '程序已经安装，如果要重新安装请删除data/install.lock文件<br/><br/><a href="../admin/">登录后台</a>';
	exit;
}
define('DS', '/');
define('INSTALL_DIR', str_replace('\\', '/', dirname(__FILE__)) . DS);
define('ROOT_PATH', str_replace('\\', '/', dirname(INSTALL_DIR)) . DS);
define('WWW_PATH', ROOT_PATH);
define('CMSTOP_PATH', ROOT_PATH .'cmstop/');
define('CACHE_PATH', CMSTOP_PATH .'data/cache/');

include CMSTOP_PATH.'framework/framework.php';
include_once CMSTOP_PATH.'apps/system/lib/common.php';
include 'controller.php';
include 'model.php';

$action = $_GET['action'] ? $_GET['action'] : 'start';

$c = new controller_install($action);

$c->$action();