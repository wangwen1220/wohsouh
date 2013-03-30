<?php
/**
 * 个人微薄关注
 *
 * @author Administrator
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");

$smarty = smarty_init();
$dblink = new DataBase("");
$userinfo = UserApi::getLoginUserSessionInfo();
$uid = $userinfo['uid'];
$id = $_GET['id'];
//if (weibo::WeiboUidAllow($uid) == 1) {
	if (!empty($userinfo['uid'])) {
			$smarty->assign("getgroupallmsg",$getgroupallmsg);
			$smarty->assign("uid",$uid);
			$smarty->assign("id",$id);
			$smarty->display("weibo/weibo_user_follow_groupmsg.html");
		}else {
		g("请登录再进行操作","/");
	}
//}else {
	//g("微博功能暂未开放","http://".$SYSCONFIG["LiveSiteRoot"]);
//}
?>
