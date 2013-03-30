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
//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");

$smarty = smarty_init();
$dblink = new DataBase("");
$space_url = DX_URL;
$roomid = $_G['gp_roomid'];
$user = UserApi::getLoginUserSessionInfo();
// if($user===false){
// 	die("没有权限，请登陆");
// }else {
	$user['uid'] = empty($user['uid']) ? 0 : $user['uid'];
//if (weibo::WeiboUidAllow($user['uid']) == 1) {
	$renter_uid = UserApi::getRenterUid($roomid);
	$room_uid= $renter_uid[0]['uid'];
	$page_id = empty($_GET['page']) ? '1':$_GET['page'];
	if ($user['uid'] == $roomid) {
		$r_user_uid = $user['uid'];
		$user_info_arr = UserApi::getUserName($r_user_uid);
		//统计信息
		$info_count = Weibo::getUserStatInfo($user['uid']);
		$total = ($info_count[0]['transmit_count'] + $info_count[0]['dymic_count']);
		$my_fans_arr = Weibo::getUserSelfFollow($r_user_uid,$page_id,20);
	}else {
		$r_user_uid = $room_uid;
		$user_info_arr = UserApi::getUserName($r_user_uid);
		$sql = "select * from pre_weibo_follow where src_uid='".$user['uid']."' and dst_uid=$room_uid";
		$is_attention = $dblink->getRow($sql);
		if (count($is_attention)>0) {
			$is_att =1;
		}
		$info_count = Weibo::getUserStatInfo($room_uid);
		$total = ($info_count[0]['transmit_count'] + $info_count[0]['dymic_count']);
		$my_fans_arr = Weibo::getUserSelfFollow($r_user_uid,$page_id,20,$user['uid']);
	}
	$my_fans = $my_fans_arr["record_arr"];
	for ($i=0;$i<count($my_fans);$i++){
		$my_fans[$i]['total'] = ($my_fans[$i]['transmit_count'] + $my_fans[$i]['dymic_count']);
	}
	$page_split = new PagerSplit($my_fans_arr['record_count'],$page_id,20);
	$page_str = $page_split->GetPagerContent();
	$fans_count = $my_fans_arr['record_count'];
// }

$smarty->assign("fans_count",$fans_count);
$smarty->assign("page_str",$page_str);
$smarty->assign("user",$user);
$smarty->assign("space_url",$space_url);
$smarty->assign("room_uid",$room_uid);
$smarty->assign("my_fans",$my_fans);
$smarty->assign("r_user_uid",$r_user_uid);
$smarty->assign("user_info_arr",$user_info_arr);
$smarty->assign("is_att",$is_att);
$smarty->assign("info_count",$info_count);
$smarty->assign("total",$total);
$smarty->display("weibo/weibo_user_fans_list.html");
//}else {
	//g("微博功能暂未开放","http://".$SYSCONFIG["LiveSiteRoot"]);
//}
?>