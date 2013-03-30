<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
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
	$roomid = $_G['gp_roomid'];
	//获得房主信息
	$userinfo = UserApi::getUserInfo($roomid);
	//得到DZ头像
	$userimages = getLiveHead($roomid,'middle');
	//判断是否有过多音频记录
	$ismutillive = MutiliveRoom::getIsMutilLiveRoom($roomid);
	$UserHuoMoney = MutiliveRoom::getUserHuoMoney($roomid);
	$UserCharm = MutiliveRoom::getUserCharm($roomid);
	//用户魅力值
	$user_charm = empty($UserCharm[0]['charm'])?0:$UserCharm[0]['charm'];
	//用户财富值
	$user_rich = empty($UserHuoMoney[0]['consume'])?0:$UserHuoMoney[0]['consume'];
	//用户申请等级
	$level = $_G['gp_level'];
	//第一次申请需要的魅力指数
	$sql = "SELECT free_first_charm,free_first_rich FROM pre_mutilive_room_type WHERE level=".$level;
	$free_first = $dblink ->getRow($sql);
	$free_first_charm = $free_first[0]['free_first_charm'];
	$free_first_rich = $free_first[0]['free_first_rich'];
	//用户魅力值差额
	if($free_first_charm >= $user_charm){
	$reduce_charm = $free_first_charm - $user_charm;
	}
	//用户财富值差额
	if($free_first_rich>=$user_rich){
	$reduce_rich = $free_first_rich - $user_rich;
	}
	//用户直播房间链接
	$liveroom = DX_HUOSHOW_SHOW_URL.$roomid;
	$live= DX_HUOSHOW_SHOW_URL;
}
$smarty->assign("live",$live);
$smarty->assign("roomid",$roomid);
$smarty->assign("free_first_rich",$free_first_rich);
$smarty->assign("free_first_charm",$free_first_charm);
$smarty->assign("userimages",$userimages);
$smarty->assign("liveroom",$liveroom);
$smarty->assign("reduce_rich",$reduce_rich);
$smarty->assign("reduce_charm",$reduce_charm);
$smarty->assign("user_charm",$user_charm);
$smarty->assign("user_rich",$user_rich);
$smarty->assign("free_first",$free_first);
$smarty->assign("ismutillive",$ismutillive);
$smarty->assign("userinfo",$userinfo);
$smarty->display("home/apply_room_free_failure.html");
?>