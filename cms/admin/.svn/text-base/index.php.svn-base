<?php
define('CMSTOP_START_TIME', microtime(true));
define('RUN_CMSTOP', true);
define('IN_ADMIN', 1);
if(!is_file('../cmstop/data/install.lock'))
{
	echo '程序未安装<br/><br/>1.<a href="../install/">安装CMSTOP</a><br/><br/>
			2.如果程序已安装，请手工创建cmstop/data/install.lock文件再刷新此页面';
	exit;
}
require '../cmstop/cmstop.php';
$cmstop = new cmstop('admin');
$cmstop->execute();