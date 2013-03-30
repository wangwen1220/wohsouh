<?php

/**
 * 微薄评论
 *
 * @author Administrator
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
$huoshow = HuoshowSys::instance();
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");

$smarty = smarty_init();
$dblink = new DataBase("");
$user = UserApi::getLoginUserSessionInfo();
if($user===false){
	die('没有权限，请<a href="/member.php?mod=logging&action=login" style="color: #D60921;">登录</a>');
}else {
	$msg_id = $_G['gp_msg_id'];

	$getFullMsgReply = Weibo::getFullMsgReply($msg_id);
	dieErr($getFullMsgReply);
}


$smarty->assign("space_url",DX_URL);
$smarty->assign("msg_id",$msg_id);
$smarty->assign("getFullMsgReply",$getFullMsgReply);
$smarty->display("weibo/weibo_user_comments.html");
?>