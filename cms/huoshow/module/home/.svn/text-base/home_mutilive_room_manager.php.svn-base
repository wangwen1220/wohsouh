<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");
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
	//$manager_info = UserApi::getLoginUserSessionInfo();
	//$uid = $manager_info['uid'];
	$uid = $user['uid'];
	$userinfo = UserApi::getUserInfo($uid);
	$roomid = $_G['gp_room_id'];
	$userimages = getLiveHead($uid,'middle');
	//判断是否有过多音频记录
	$ismutillive = MutiliveRoom::getIsMutilLiveRoom($homeowner_uid);
	$sql = "select id,roomid,uid,username,type,percent from pre_mutilive_room_manager where roomid=".$roomid;
	$manager= $dblink->getRow($sql);
	$count = count($manager);
	for($i=0;$i<$count;$i++){
		$show_percent[$i] = $manager[$i]['percent']*100;

	}
	
	if ($_G['gp_delete']=='manager'){
		$uid=$_G['gp_uid'];
		$sql = "DELETE FROM pre_mutilive_room_manager where uid=$uid and roomid=".$manager[0]['roomid'];
		$dblink->query($sql);
		
		//通知消息服务器走取消管理员流程
		MutilLiveRoomSocketApi::setOrCancelRoomManager($roomid, $uid, 0);
		header("Location:home.php?mod=huoshow&do=mutilive_room_manager&room_id=".$roomid);
	}
	if ($_G['gp_add']=='percent'){
		$uid=$_G['gp_uid'];
		$roomid=$_G['gp_room_id'];
		header("Location:home.php?mod=huoshow&do=percent&uid=$uid&room_id=".$roomid);
	}
}

$dblink->dbclose();
$smarty->assign("show_percent",$show_percent);
$smarty->assign("uid",$uid);
$smarty->assign("ismutillive",$ismutillive);	
$smarty->assign("roomid",$roomid);	
$smarty->assign("userimages",$userimages);		
$smarty->assign("manager",$manager);
$smarty->assign("userinfo",$userinfo);
$smarty->display("home/mutilive_room_manager.html");
?>