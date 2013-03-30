<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/RoomServerCommunicate/MutilRoomCommunicate.php");

//连接方式，1为同步，2为异步
$link_type = $_POST["cmdlink"];
$cmd_body = $_POST["cmdbody"];
$cmd_type = $_POST["cmdtype"];

if(empty($link_type))
	$link_type = 2;
if($link_type==2)
{
	//对缓存进行设置
	ini_set('zlib.output_compression',0);
	ini_set('output_buffering','off');
	ini_set('implicit_flush',1);
	ob_end_clean();
	set_time_limit(0);
	ob_implicit_flush(1);
	//保证消息服务器断开连接后脚本不退出，继续执行。
	ignore_user_abort(1);
	
	//先输出一段文本，表示收到信息
	//消息服务器看到这段文本，会直接断开连接
	header("Content-Length",32);
	echo "ok";
	echo str_repeat(' ',1024*64);
}
/*
usleep(1000);
echo "second";
echo str_repeat(' ',1024*64);
*/

$dblink = new DataBase("");
//$cmd_body = '{"param2":"1","act":"2","param1":"160","dstuid":"107297"}';
//$_POST["src_uid"] = "107284";
//$_POST["roomid"] = "28154";
//$cmd_type="send_gift";

$cmd_body = str_replace('\\','',$cmd_body);
//$_POST = '{"roomid":"28154","uid":"107284","mic_starttime":"1325320859","mic_num":"2"}';
//$cmd_type="top_michael";
$process = new MutilRoomCommunicate($cmd_type,$cmd_body,$_POST);
?>
