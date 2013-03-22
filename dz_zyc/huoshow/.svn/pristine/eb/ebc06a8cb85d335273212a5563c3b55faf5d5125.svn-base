<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
$dblink = new DataBase("");
$user = UserApi::getLoginUserSessionInfo();
if($user===false){
	die("没有权限，请登陆");
}else {
	//header("Content-type: application/xml; charset=uft-8");
	$tab = $_G["gp_tab"];
	if ($tab == "ajax_checking_name") {
		$name = $_G['gp_name'];
		$roomid = $_G['gp_roomid'];
		$check_name = $dblink->getRow("SELECT * FROM pre_multilive_room WHERE room_name = '$name' AND roomid !='$roomid'");
		if(count($check_name)!=0){
			echo '名称已存在！！！';
		}else {
			echo '';
		}
		exit();
	}	
}
	
?>