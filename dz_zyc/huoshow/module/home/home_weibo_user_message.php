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
	if($user===false){
		die("没有权限，请登陆");
	}else {
		$msg_type = empty($_GET['msg']) ? '1':$_GET['msg'];
		if ($msg_type == 1){//提到我的
			$usermsg = Weibo::getReferUserMsg($home_uid);
		}elseif ($msg_type == 2){//我的私信
			$user_mail_arr = Weibo::getPrivateMail($home_uid);
			$user_mail = $user_mail_arr["arr"];
		}else{//我的通知
			$sql = "SELECT * FROM pre_home_notification WHERE uid=$home_uid LIMIT 20";
			$user_noti = $dblink->getRow($sql);
		}
	}
	
	
	$smarty->assign("space_url",DX_URL);
	$smarty->assign("home_uid",$home_uid);
	$smarty->assign("msg_type",$msg_type);
	$smarty->assign("usermsg",$usermsg);
	$smarty->assign("user_mail",$user_mail);
	$smarty->assign("user_noti",$user_noti);
	$smarty->display("home/home_weibo_user_messages.html");
//}else {
	//g("微博功能暂未开放","http://".$SYSCONFIG["LiveSiteRoot"]);
//}
?>