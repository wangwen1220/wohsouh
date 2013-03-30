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
	$tab = $_G['gp_tab'];
	//房主UID
	//$homeowner_uid = $user['uid'];
	//获得房主信息
	$userinfo = UserApi::getUserInfo($homeowner_uid);
	//得到DZ头像
	$userimages = getLiveHead($homeowner_uid,'middle');
	//判断是否有过多音频记录
	$ismutillive = MutiliveRoom::getIsMutilLiveRoom($homeowner_uid);
	//是否申请房间
	$isrecords = MutiliveRoom::getPurchaseRecords($homeowner_uid);
	//获取事件表是否有记录
	$eventrecord = MutiliveRoom::getIsContinuousBuy($homeowner_uid);
	//是否可以再次免费续签房间
	$isfree = MutiliveRoom::getPreMonthPayHuoCoin($homeowner_uid,$userinfo[0]["expire_time"]);
	//得到房间类型
	$roomtype = MutiliveRoom::getRoomTypeName();
	if ($isrecords[0]["uid"]){
		$sql = "SELECT room_class_id FROM pre_multilive_room WHERE uid=".$isrecords[0]["uid"];
		$dbarr = $dblink->getRow($sql);
		for($i=0;$i<count($roomtype);$i++)
		{
			$roomtype[$i]["is_xufei"] = ($dbarr[0]["room_class_id"]==$roomtype[$i]["level"])?1:0;
		}	
	}
	
	//收费
	if (!empty($_POST)) {
		$uid =  $homeowner_uid;
		$username = $userinfo[0]['username'];
		$roomlevel = $_G['gp_level'];
		$timelevel = $_G['gp_type_name'];
		$extend = $_G['gp_extend'];
		$buy = MutiliveRoom::createMutiliveRoomPaySimple($uid,$roomlevel,$username,$timelevel);
		if (checkErr($buy)) {
			g($extend.'成功','/home.php?mod=huoshow&do=apply_room_free_success&roomid='.$uid);
		}else {
			g($extend.'失败，您的火币余额不足，请充值！','/home.php?mod=space&do=pay');
		}
		die();
	}
	
	//免费申请
	if ($tab == "free"){
		//用户UID
		$roomid= $_G['gp_roomid'];
		//用户申请等级
		$level = $_G['gp_level'];
		//用户名
		$name = $userinfo[0]['username'];
		//免费方式
		$free = MutiliveRoom::createMutiliveRoomFree($roomid,$level,$name);
//		print_r($free);
		if(checkErr($free)) {
			g('申请成功','/home.php?mod=huoshow&do=apply_room_free_success&roomid='.$roomid);
		}else {
			g('申请失败','/home.php?mod=huoshow&do=apply_room_free_failure&level='.$level.'&roomid='.$roomid);
		}
		die();
	}
}
$dblink->dbclose();
$smarty->assign("userimages",$userimages);
$smarty->assign("isfree",$isfree);
$smarty->assign("eventrecord",$eventrecord);
$smarty->assign("isrecords",$isrecords);
$smarty->assign("ismutillive",$ismutillive);
$smarty->assign("roomtype",$roomtype);
$smarty->assign("userinfo",$userinfo);
$smarty->assign("homeowner_uid",$homeowner_uid);
$smarty->display("home/apply_room.html");
?>