<?php

/**
 * 发布微薄框
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
if($user===false){
	die("没有权限，请登陆");
}else {

}
//$roomid = $_GET['roomid'];

$smarty->display("weibo/weibo_user_send_dynamic.html");
?>