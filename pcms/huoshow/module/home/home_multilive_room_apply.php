<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
//模板初始化
$smarty = smarty_init();
$dblink = new DataBase("");
$user = UserApi::getLoginUserSessionInfo();
$homeowner_uid = $user['uid'];
$allow = MutiliveRoom::getUidAllow($homeowner_uid);
if($user===false){
	die("没有权限，请登陆");
}elseif ($allow == 0){
	g('此功能暂未开放','home.php');
}else {
	//房主UID
	//$homeowner_uid = $user['uid'];
	//获得房主信息
	$userinfo = UserApi::getUserInfo($homeowner_uid);
	//根据房主ID获取120*120封面,存放目录
	$cover = getLiveCover($homeowner_uid,'middle','livecover');
	//得到DZ头像
	$userimages = getLiveHead($homeowner_uid,'middle');
	if (!empty($_POST)){
		$roomroomid = $_G['gp_room_id'];
		$room_name = $_G['gp_room_name'];
		$description = $_G['gp_description'];
		$sql = "UPDATE pre_multilive_room SET room_name='$room_name',description='$description' WHERE roomid= $roomroomid";
		//echo $sql;
		$dblink->query($sql);
		header("Location: home.php?mod=huoshow&do=friendslist&userid=$roomroomid");
	}
}

$dblink->dbclose();
$smarty->assign("ismutillive",$ismutillive);
$smarty->assign("homeowner_uid",$homeowner_uid);
$smarty->assign("userimages",$userimages);
$smarty->assign("cover",$cover);
$smarty->assign("userinfo",$userinfo);
$smarty->display("home/home_multilive_room_apply.html");
?>