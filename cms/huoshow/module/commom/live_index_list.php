<?php
/**
 * *
 *	首页各排行榜数据
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/LiveList.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
$smarty = smarty_init();
$dblink = new DataBase("");
$act= $_GET['act'];

if ($act == 'charm_index') {
	//魅力指数排行榜
	$day_data_all = LiveList::Charm_Score_List('daynum',7);
	$day_data = $day_data_all["score_data"];
	$week_data_all = LiveList::Charm_Score_List('weeknum',7);
	$week_data = $week_data_all["score_data"];
	$month_data_all = LiveList::Charm_Score_List('monthnum',7);
	$month_data = $month_data_all["score_data"];
	
	$smarty->assign("day_data",$day_data);
	$smarty->assign("week_data",$week_data);
	$smarty->assign("month_data",$month_data);
	$smarty->display("commom/commom_charm_score.html");
} elseif ($act == 'charm_value'){
	//魅力值排行榜
	$day_data_all = LiveList::Charm_Value_List('daynum',7);
	$day_data = $day_data_all["charm_data"];
	$week_data_all = LiveList::Charm_Value_List('weeknum',7);
	$week_data = $week_data_all["charm_data"];
	$month_data_all = LiveList::Charm_Value_List('monthnum',7);
	$month_data = $month_data_all["charm_data"];
	
	$smarty->assign("day_data",$day_data);
	$smarty->assign("week_data",$week_data);
	$smarty->assign("month_data",$month_data);
	$smarty->display("commom/commom_charm_value.html");
} elseif ($act == 'charm_vote'){
	//魅力之星排行榜
	$day_data_all = LiveList::Charm_Vote_List('daynum',7);
	$day_data = $day_data_all["vote_data"];
	$week_data_all = LiveList::Charm_Vote_List('weeknum',7);
	$week_data = $week_data_all["vote_data"];
	$month_data_all = LiveList::Charm_Vote_List('monthnum',7);
	$month_data = $month_data_all["vote_data"];
	
	$smarty->assign("day_data",$day_data);
	$smarty->assign("week_data",$week_data);
	$smarty->assign("month_data",$month_data);
	$smarty->display("commom/commom_charm_vote.html");
} elseif ($act == 'user_charm_rank'){
	//个人用户得到魅力值，魅力之星，魅力指数，及排名,给JS调用
	$roomid = $_GET['roomid'];
	$user_rank = LiveList::cGetUserCharmRanking($roomid);
	echo json_encode($user_rank[0]);
} elseif ($act == 'user_huocoin'){
	//用户火币查询,给JS调用
	$user = UserApi::getLoginUserSessionInfo();
	$user_huocoin = MutiliveRoom::getUserHuoMoney($user['uid']);
	echo empty($user_huocoin[0]['huocoin']) ? 0:$user_huocoin[0]['huocoin'];
}