<?php
/**
 * 个人微薄主页
 *
 * @author Administrator
 * @package defaultPackage
 */

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");

$smarty = smarty_init();
$dblink = new DataBase("");
$user = UserApi::getLoginUserSessionInfo();
$roomid = $_GET['roomid'];
$renter_uid = UserApi::getRenterUid($roomid);
$room_uid= $renter_uid[0]['uid'];
if(empty($room_uid) || !is_numeric($room_uid) || $room_uid<1){
	die("room_uid格式错误");
}

//统计信息
$user_info = Weibo::getUserStatInfo($room_uid);
$user_total = ($user_info[0]['transmit_count'] + $user_info[0]['dymic_count']);

$smarty->assign("room_uid",$room_uid);
$smarty->assign("user_info",$user_info);
$smarty->assign("user_total",$user_total);
$smarty->display("weibo/weibo_user_info.html");
?>