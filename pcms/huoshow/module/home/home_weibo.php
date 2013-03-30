<?php
/**
 * 个人空间微薄主页
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
//if (weibo::WeiboUidAllow($home_uid) == 1) {
$r_user_uid = $user['uid'];
$lists = empty($_GET['list']) ? '1':$_GET['list'];

$msg_type = empty($_GET['msg']) ? '1':$_GET['msg'];
if($user===false){
	die("没有权限，请登陆");
}else {
	$user_info = Weibo::getUserStatInfo($home_uid);
	$user_total = ($user_info[0]['transmit_count'] + $user_info[0]['dymic_count']);
}

$smarty->assign("space_url",DX_URL);
$smarty->assign("r_user_uid",$r_user_uid);
$smarty->assign("home_uid",$home_uid);
$smarty->assign("user_info",$user_info);
$smarty->assign("user_total",$user_total);
$smarty->assign("lists",$lists);
$smarty->display("home/home_weibo.html");
//}else {
	//g("微博功能暂未开放","http://".$SYSCONFIG["LiveSiteRoot"]);
//}
?>