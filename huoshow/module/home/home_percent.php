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
	$percent = $_G['gp_percent'];
	$roomid = $_G['gp_room_id'];
	$uid = $_G['gp_uid'];

	//检查是否设置过提点数
	$sql = "SELECT percent FROM pre_mutilive_room_manager WHERE roomid=$roomid AND uid=$uid";
	$check_onepercent = $dblink->getRow($sql);
	//查询设置的提点数
	$show_percent = $check_onepercent[0]['percent']*100;
	$sql = "SELECT SUM(percent) AS count_percent FROM pre_mutilive_room_manager WHERE roomid=".$roomid;
	$count_percent = $dblink->getRow($sql);
	$sum = 100;
	//检查剩下可设置的提点数
	//没有设置过点数,剩余可设置点数
	$check_percent = $sum - ($count_percent[0]['count_percent']*100);
	//已经设置过点数
	$double_percent = ($check_onepercent[0]['percent']*100) + $check_percent;
	if(!empty($_POST)){
		//$percent = (int)$percent;
		if (!is_numeric($percent) || ($percent < 0 || $percent>100)) {
			echo "<script>alert('请输入0-100范围内整数数字！');</script>";
		}elseif(($check_onepercent[0]['percent'] == 0 && $percent > $check_percent)||($check_onepercent[0]['percent'] != 0 &&$percent > $double_percent)){
			echo "<script>alert('您设置的比例总和应小于等于100，请重新设置！');</script>";
		}else{
		$percent = (int)$percent/100;
		$sql = "UPDATE pre_mutilive_room_manager SET `percent` = '$percent' WHERE roomid=$roomid AND uid=$uid";
		$dblink->query($sql);
		g('设置提点成功','home.php?mod=huoshow&do=mutilive_room_manager&room_id='.$roomid);
		}
	}
	
}
$dblink->dbclose();
$smarty->assign("show_percent",$show_percent);
$smarty->display("home/percent.html");