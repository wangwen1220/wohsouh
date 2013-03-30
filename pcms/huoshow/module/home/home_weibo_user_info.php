<?php
/**
 * 个人空间微薄主页信息统计
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
$home_uid = $user['uid'];
if($user===false){
	die("没有权限，请登陆");
}else {
	$user_info = Weibo::getUserStatInfo($home_uid);
	$user_total = ($user_info[0]['transmit_count'] + $user_info[0]['dymic_count']);
}

$smarty->assign("user_info",$user_info);
$smarty->assign("user_total",$user_total);
$smarty->display("home/home_weibo_user_info.html");
?>