<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
//模板初始化
$smarty = smarty_init();
$user = UserApi::getLoginUserSessionInfo();
$homeowner_uid = $user['uid'];
$allow = MutiliveRoom::getUidAllow($homeowner_uid);
if($user===false){
	die("没有权限，请登陆");
}elseif ($allow == 0){
	g('此功能暂未开放','home.php');
}else {
	//房主UID
	$room_id = $_G['gp_roomid'];
	//获得房主信息
	$userinfo = UserApi::getUserInfo($room_id);
	//得到DZ头像
	$userimages = getLiveHead($room_id,'middle');
	//判断是否有过多音频记录
	$ismutillive = MutiliveRoom::getIsMutilLiveRoom($room_id);
	
}
$smarty->assign("room_id",$room_id);
$smarty->assign("userimages",$userimages);
$smarty->assign("ismutillive",$ismutillive);
$smarty->assign("userinfo",$userinfo);
$smarty->display("home/apply_room_free_success.html");
?>