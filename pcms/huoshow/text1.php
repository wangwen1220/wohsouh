<?php
//数据库操作类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/RoomServerCommunicate/CommunicateBase.php");
$dblink = new DataBase("");

MutiliveRoom::createMutiliveRoomSpecifiedUser(107330,1,'new030',2,28154);


die();
echo '<br><br>--------------------------------------------------<br><br>';

$zhStr = '您好，s中 国！';
$str = 'Hello,中国！';
// 计算中文字符串长度
// function utf8_strlen($string = null) {
// 	// 将字符串分解为单元
// 	preg_match_all("/./us", $string, $match);
// 	// 返回单元个数
// 	return count($match[0]);
// }
echo '--'.utf8_strlen($zhStr).'<BR>'; // 输出：6
echo '--'.utf8_strlen($str).'<BR>'; // 输出：9

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>测试</title>
<style>
.hover-box{
position:absolute;
display:none;
}
.hover-box-trigger:hover{
display:block;
width:500px; height:300px; background:#CCCCCC;
}
</style>
</head>
<body>
	<a href="javascript:;" class="hover-box-trigger">
	<span id="displaydiv" style="display:none;" class="hover-box">层要显示的内容</span>
	点击弹出层
	</a>
	
</body>
</html>