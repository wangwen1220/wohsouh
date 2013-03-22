<?php
/**
 * 个人关注主页
 *
 * @author Administrator
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");

$smarty = smarty_init();
$dblink = new DataBase("");
$space_url = DX_URL;
$roomid = $_G['gp_roomid'];
$roomidimg = UserApi::getUserName($roomid);
$dst_uid = $_G['gp_dst_uid'];
$user = UserApi::getLoginUserSessionInfo();
$user['uid'] = empty($user['uid']) ? 0 : $user['uid'];
//if (weibo::WeiboUidAllow($user['uid']) == 1) {
$page = empty($_G["gp_page"])?1:$_G["gp_page"];
$count = count($dblink->getRow("select dst_uid from pre_weibo_follow where src_uid = '$roomid'"));//获取关注用户数量
	if (($user['uid'] != $roomid) || ($user['uid'] ==0)) {
	$user_follow = weibo::getUserAllFollow($roomid,0,$page);//获取关注用户列表
	
	for ($i=0;$i<count($user_follow);$i++) {
		$sql = "select * from pre_weibo_follow where src_uid='".$user['uid']."' and dst_uid=".$user_follow[$i]['uid'];
		$is_attention = $dblink->getRow($sql);
		//判断是否已经关注,1为已经关注
		if (count($is_attention)>0) {
			$user_follow[$i]['is_att'] =1;
		}else {
			$user_follow[$i]['is_att'] =0;
		}
	}
	//判断对房主进行关注
	$sql = "select * from pre_weibo_follow where src_uid='".$user['uid']."' and dst_uid=".$roomid;
	$roomis_attention = $dblink->getRow($sql);
	if ($roomis_attention >0) {
		$roomis_att = 1;
	}else{
		$roomis_att = 0;
	}
	//$count = count($user_follow);
	
	$room_username = UserApi::getUserName($roomid);
	$roomname = $room_username[0]['nickname'];
	//我的微薄数据相关信息(关注,我的粉丝,记录)
	$user_countinfo = weibo::getUserStatInfo($uid);
	$user_total = ($user_countinfo[0]['transmit_count'] + $user_countinfo[0]['dymic_count']);
	
	
	//分页
	
	$recordPerPage=20;
	$page_split = new PagerSplit($count,$page,$recordPerPage);
	$page_str = $page_split->GetPagerContent();
	$smarty->assign("page_str",$page_str);
	$smarty->assign("roomis_att",$roomis_att);
	$smarty->assign("roomidimg",$roomidimg);
	$smarty->assign("count",$count);
	$smarty->assign("user",$user);
	$smarty->assign("space_url",$space_url);
	$smarty->assign("is_att",$is_att);
	$smarty->assign("roomid",$roomid);
	$smarty->assign("user_countinfo",$user_countinfo);
	$smarty->assign("user_total",$user_total);
	$smarty->assign("roomname",$roomname);
	$smarty->assign("user_follow",$user_follow);
	$smarty->display("weibo/weibo_user_userfollow.html");
	} else {
		g("前往管理关注页面","/home.php?mod=huoshow&do=weibo_userfollow");
	}
//}else {
	//g("微博功能暂未开放","http://".$SYSCONFIG["LiveSiteRoot"]);
//}
?>