<?php
/**
 * 个人微薄主页
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
//if (weibo::WeiboUidAllow($uid['uid']) == 1) {
	$roomid = $_G['gp_roomid'];
	$renter_uid = UserApi::getRenterUid($roomid);
	$room_uid= $renter_uid[0]['uid'];
	if(empty($room_uid) || !is_numeric($room_uid) || $room_uid<1){
		die("room_uid格式错误");
	}	
	$lists = empty($_G[gp_list]) ? '1':$_G[gp_list];
	if ($user['uid'] == $roomid) {
		$r_user_uid = $user['uid'];
		$user_info_arr = UserApi::getUserName($r_user_uid);
		//关注
		$follow = Weibo::getUserAllFollow($user['uid'],0,1,12);
		//统计信息
		$info_count = Weibo::getUserStatInfo($user['uid']);
		$total = ($info_count[0]['transmit_count'] + $info_count[0]['dymic_count']);
		//粉丝
	 	$fans_all = Weibo::getUserSelfFollow($user['uid'],1,12);
	 	$fans = $fans_all["record_arr"];
	}else {
		$lists = 2;
		$r_user_uid = $room_uid;
		$user_info_arr = UserApi::getUserName($r_user_uid);
		$follow = Weibo::getUserAllFollow($room_uid,0,1,12,1,'desc',$user['uid']);
		$info_count = Weibo::getUserStatInfo($room_uid);
		$total = ($info_count[0]['transmit_count'] + $info_count[0]['dymic_count']);
		$fans_all = Weibo::getUserSelfFollow($room_uid,1,12,$user['uid']);
		$fans = $fans_all["record_arr"];
		
		$sql = "select * from pre_weibo_follow where src_uid='".$user['uid']."' and dst_uid=$room_uid";
		$is_attention = $dblink->getRow($sql);
		if (count($is_attention)>0) {
			$is_att =1;
		}
	}
	$smarty->assign("space_url",DX_URL);
	$smarty->assign("is_att",$is_att);
	$smarty->assign("user_info_arr",$user_info_arr);
	$smarty->assign("r_user_uid",$r_user_uid);
	$smarty->assign("total",$total);
	$smarty->assign("user",$user);
	$smarty->assign("lists",$lists);
	$smarty->assign("room_uid",$room_uid);
	$smarty->assign("info_count",$info_count);
	$smarty->assign("fans",$fans);
	$smarty->assign("follow",$follow);
	$smarty->display("weibo/weibo_user.html");
//}else {
	//g("微博功能暂未开放","http://".$SYSCONFIG["LiveSiteRoot"]);
//}
?>