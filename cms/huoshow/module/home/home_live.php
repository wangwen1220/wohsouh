<?php

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");

//模板初始化
$smarty = smarty_init();
$user = UserApi::getLoginUserSessionInfo();
$homeowner_uid = $user['uid'];
$allow = MutiliveRoom::getUidAllow($homeowner_uid);
$dblink = new DataBase("");
if($user===false){
	die("没有权限，请登陆");
}elseif ($allow == 0){
	g('此功能暂未开放','home.php');
}else {
	//房主UID
	//$homeowner_uid = $user['uid'];
	//print_r($homeowner_uid);	
	//获得房主信息
	$userinfo = UserApi::getUserInfo($homeowner_uid);
	$user_huo = floor($userinfo[0]["total"]);
	//获得房主单音频直播总时长
	$totaltime = UserApi::getUserLiveTime($homeowner_uid);
	//得到房主房间是否到期
	$room_expire = MutiliveRoom::getRoomExpired($userinfo[0]["roomid"]);
	//做时间转换
	$start_time = date('Y-m-d',$userinfo[0]['dateline']);
	//房间有效期
	$expire_times = date('Y-m-d',$userinfo[0]['expire_time']);
	//得到DZ头像
	$userimages = getLiveHead($homeowner_uid,'middle');
	//得到单音频的封面
	$usercover = getLiveHead($homeowner_uid,'middle','','cover');
	//得到多音频封面
	$livecover = getLiveCover($homeowner_uid,'middle','livecover');
	//判断是否有过多音频记录
	$ismutillive = MutiliveRoom::getIsMutilLiveRoom($homeowner_uid);
	$userinfo = UserApi::getUserInfo($homeowner_uid);
	$userimages = getLiveHead($homeowner_uid,'middle');
	//获取直播房间地址
	$live = DX_HUOSHOW_SHOW_URL;
	$liveroom = DX_HUOSHOW_SHOW_URL.$homeowner_uid;
	//参与多人直播间管理
	$sql = "select a.*,(select c.room_type_name from pre_mutilive_room_type c where a.room_class_id=c.id) as room_type_name from pre_multilive_room a where a.roomid in (select b.roomid from pre_mutilive_room_manager b where b.uid=$homeowner_uid)";
	$mutilive= $dblink->getRow($sql);
	if ($_G['gp_delete']=='manager'){
			$roomid = $_G['gp_roomid'];
			$sql = "DELETE FROM pre_mutilive_room_manager where uid=$homeowner_uid and roomid=".$roomid;
			$dblink->query($sql);
			MutilLiveRoomSocketApi::setOrCancelRoomManager($roomid, $homeowner_uid, 0);
			header("Location:home.php?mod=huoshow&do=live");
	}
	$count = count($mutilive);
	for($i=0;$i<$count;$i++){
		//参与房间管理封面
		$livecovers[$i] = getLiveCover($mutilive[$i]['roomid'],'middle','livecover');
		$start_times[$i] = date('Y-m-d',$mutilive[$i]['dateline']);
//		$sql = "select sum(b.pointticket_price) as pointticket_price from pre_mutilive_room_manager a,pre_multilive_gift_log b where (a.uid=$homeowner_uid and a.roomid=b.roomid) and b.roomid=".$mutilive[$i]['roomid'];
		$sql ="SELECT SUM(ticket_price) AS price FROM pre_mutilive_ticket_log WHERE roomid='".$mutilive[$i]['roomid']."' AND uid=$homeowner_uid";
		$price = $dblink->getRow($sql);
		for ($j=0;$j<count($price);$j++){
			$pointticket_price[$i]["price"] = floor($price[$j]["price"]);
		}
	}
	
	//判断是从多功能直播间来，还是普通直播间,没带参则默认为普通，否则为多功能
	$duo = $_G['gp_dou'];
	if(!$duo){
		$duo = 0;
	}else{
		$duo = 1;
	}
		
}

$dblink->dbclose();
$smarty->assign("duo",$duo);
$smarty->assign("live",$live);
$smarty->assign("homeowner_uid",$homeowner_uid);
$smarty->assign("expire_times",$expire_times);
$smarty->assign("expire_time",$expire_time);
$smarty->assign("room_expire",$room_expire);
$smarty->assign("liveroom",$liveroom);
$smarty->assign("pointticket_price",$pointticket_price);	
$smarty->assign("userimages",$userimages);	
$smarty->assign("livecover",$livecover);
$smarty->assign("roomid",$roomid);
$smarty->assign("start_time",$start_time);
$smarty->assign("userinfo",$userinfo);
$smarty->assign("mutilive",$mutilive);
$smarty->assign("ismutillive",$ismutillive);
$smarty->assign("usercover",$usercover);
$smarty->assign("livecovers",$livecovers);
$smarty->assign("userimages",$userimages);
$smarty->assign("totaltime",$totaltime);
$smarty->assign("start_times",$start_times);
$smarty->assign("userinfo",$userinfo);
$smarty->assign("user_huo",$user_huo);
$smarty->display("home/room_live.html");
?>