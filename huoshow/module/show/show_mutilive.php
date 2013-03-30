<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");

$smarty = smarty_init();
$dblink = new DataBase("");
$user = UserApi::getLoginUserSessionInfo();
$uid = $user['uid'];
$allow = MutiliveRoom::getUidAllow($uid);
$roomid = $_G['gp_roomid'];//获取房间roomid
if(empty($roomid) || !is_numeric($roomid) || $roomid<1)return getR(false,"roomid格式错误");
$userinfo = UserApi::getUserInfo($roomid);
//查询用户房间是否被关闭
$sql = "select system_close from pre_multilive_room where roomid=$roomid";
$is_room_colse = $dblink->getRow($sql);
//得到用户类型
$UserType = MutiliveRoom::getUserType($uid,$roomid);
if ($allow == 1) {
	$r_user_uid = $roomid;
	//用户在房间是否被踢,result为1，表示被踢
	$data = array(
		'rid' => "$roomid",
		'uid' => "$uid",
	);
	$isKicking = MutilLiveRoomSocketApi::sendIsKicking($data);
	if ($isKicking['result'] == '1'){
		g('您已经被踢出此房间，请休息 '.$isKicking['time'].'秒或者进入其他房间','/show.php');
	}
	if ($_COOKIE['kicked'] and $_COOKIE['kicked']==$roomid){
		g('您已经被踢出此房间，请休息300秒或者进入其他房间','/show.php');
	}
	
	$type = $_G['gp_type'];//获取用户类型
	//动态信息
	$mutilroom_dynamic_path = $_SERVER['DOCUMENT_ROOT']."/huoshow/module/show/show_mutilive_dynamic.php";
	//微薄个人动态页
	//$web_user_send_dynamic_path= $_SERVER['DOCUMENT_ROOT']."/huoshow/module/weibo/weibo_user_dynamic.php";
	
	$expire_time  = MutiliveRoom::getRoomExpired($roomid);
	$isactivated = MutiliveRoom::RoomIsActivated($roomid);//1为房间激活
	//得到房主管理员列表
	$roomlist = MutiliveRoom::getRoomAdminList($roomid);
	//判断是否是游客，普通用户,如果是主播,管理员，房间没激活插入记录
	if ($user!=false) {
		MutiliveRoom::MutilRoomJoin($uid,$roomid);
	}
	//公告内容
	$sql = "select roominfo,roominfourl from pre_multilive_setting_away_config where uid='$roomid'";
	$setNotice=$dblink->getRow($sql);
	//判断房间有没有系统管理员关闭，关闭则不用进入房间
	if ($is_room_colse[0]['system_close'] == 0) {
		//判断房间是否到期
		if ($expire_time == 0) {
			//判断进入人员是否超过房间限制
			$data1 = array(
				'roomid' => "$roomid"
			);
			$restrict = MutilLiveRoomSocketApi::sendRoomLiveNews($data1);
			if ($UserType!=2 and $UserType!=1 and $UserType!=3 and $userinfo[0]['people_limit']!= '-1'){
				if ($restrict['usercount'] >= $userinfo[0]['people_limit']){
					g('房间人数已满，请进入其他房间','/show.php');
				}	
			}
			
			$start_time = date('Y-m-d',$userinfo[0]['dateline']);
			//得到多音频封面
			$livecover = getLiveCover($roomid,'middle','livecover');
			//粉丝排行榜
			$fanslist = MutiliveRoom::getMutilRoomSendMaxGiftList($roomid,7);
			//麦霸排行榜
			$micking = MutiliveRoom::getMutilRoomMicKingList($roomid,7);
		}else {
			//暂时处理为房间ID与UID相同，提示续费
			if ($roomid == $uid){
				g("房间已到期,请购买或续费您的房间","home.php?mod=huoshow&do=apply_room");	
			}else {
				g("该房间已到期或未开通！","/");
			}
			
		}	
	}else {
		g("房间已被关闭，有问题请联系客服！","/");	
	}
	
	$dblink->dbclose();
	$smarty->assign("r_user_uid",$r_user_uid);
	$smarty->assign("livecover",$livecover);
	$smarty->assign("start_time",$start_time);
	$smarty->assign("fanslist",$fanslist);
	$smarty->assign("micking",$micking);
	$smarty->assign("dynamic",$dynamic);
	$smarty->assign("userinfo",$userinfo);
	$smarty->assign("roomlist",$roomlist);
	$smarty->assign("uid",$uid);
	$smarty->assign("roomid",$roomid);
	$smarty->assign("UserType",$UserType);
	$smarty->assign("setNotice",$setNotice);
	$smarty->assign("mutilroom_dynamic_path",$mutilroom_dynamic_path);
//	$smarty->assign("web_user_send_dynamic_path",$web_user_send_dynamic_path);
	$smarty->display("show/show_mutilive_room.html");
}else {
	g("多功能房间暂未开放","/");
}
?>
