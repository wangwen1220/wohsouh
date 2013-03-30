<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
$smarty = smarty_init();

$user = UserApi::getLoginUserSessionInfo();
$uid = $user['uid'];
$allow = test_switch($uid,pcms_test);

$smarty->assign("PCMS_URL",PCMS_URL);
$smarty->assign("allow",$allow);
$smarty->display("commom/commom_test_switch.html");
?>