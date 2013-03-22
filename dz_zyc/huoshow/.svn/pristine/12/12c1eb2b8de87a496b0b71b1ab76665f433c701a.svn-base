<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
$userinfo = UserApi::getLoginUserSessionInfo();
$uid = $userinfo['uid'];
$smarty = smarty_init();
$dblink = new DataBase("");
if ($_GET['tab']=='nogroup') {
		header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
		<root><![CDATA[';
		include_once($_SERVER['DOCUMENT_ROOT']."/huoshow/module/home/home_weibo_nogroupfile.php");
		echo ']]></root>';
}

if ($_GET['tab']=='ingroup') {
	if (!empty($uid)) {
		$selectuid = $_POST['select'];
		$groupid = $_POST['groupid'];
		if (empty($selectuid)) {
			echo '{"status":"0", "value":"请选择用户"}';
						die();
		}else{
			for($i=0;$i<count($selectuid);$i++) {
				weibo::putUserToGroup($uid,$selectuid[$i],$groupid);
			}
			//g("分组成功","/home.php?mod=huoshow&do=weibo_userfollow&id=$groupid");
			echo '{"status":"1", "value":"用户分组成功"}';
						die();
		}
	}
}
?>