<?php
define('CURSCRIPT', 'apidb');
require '../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();
$uid = $_G['uid'];
$username = $_G['username'];
$roomer=$_GET['roomid'];
$status = trim($_GET['status']);
$time = time();
log_write('uid:'.$uid.' request: '.$_SERVER['REQUEST_URI']);
if ($uid==$roomer and !empty($uid)){
	$sql = "UPDATE ".DB::table('live_room')." SET stat = '$status' WHERE roomid='$roomer' ";	
	if(DB::query($sql)){
		//+memcache缓存 2011.06.30 zhangcj
		//房间状态过期
		$memcache = new cmemcache();
		$memcache->rm("live_roomstatus-$roomer");
		$memcache->close();
		//end
		echo 1;
	}else{
		echo 0;
	}
}else{
	echo 0;
}
function log_write($msg)
{
    if(($logs=fopen('logs/log_'.date('Y-m-d').'.log', 'a+')))
    {
		fwrite($logs, date('Y-m-d H:i:s')."\t".$msg."\r\n");
		fclose($logs);
	}
}