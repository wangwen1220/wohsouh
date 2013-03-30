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
$user_uid = $user['uid'];//登录UID
$r_user_uid = $_G['gp_roomid'];//房主UID

$smarty->assign("user_uid",$user_uid);
$smarty->assign("r_user_uid",$r_user_uid);
$smarty->display("weibo/weibo_user_single_dynamic.html");
?>