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
	$user_id = $_G["gp_userid"];
	$friendslist = UserApi::getUserFriendsList($user_id);
	$userinfo = UserApi::getUserInfo($user_id);
	$count = count($friendslist);
	for($i=0;$i<$count;$i++)
	{
		$friendslist[$i]['smallimg'] = getLiveHead($friendslist[$i]['uid'],'small');
	}
	if (!empty($_POST)){
		$subject = $_G['gp_subject'];
		$flistid = $_G['gp_friendslist'];
		$msgfrom= $userinfo[0]['username'];
		$time = getCurrentTimeZone();
		$count = count($flistid);
		for ($i=0;$i<$count;$i++){
			//插入记录到消息表
			$sql = "INSERT INTO pre_ucenter_pms (`msgfrom`,`msgfromid`,`msgtoid`,`folder`,`new`,`subject`,`dateline`,`message`,`fromappid`) VALUES ('$msgfrom','$user_id','$flistid[$i]','inbox','1','$subject','$time','$subject',1)";
			$dblink->query($sql);
			//插入记录到提醒表
			$sql = "INSERT INTO pre_home_notification (`uid`,`type`,`new`,`authorid`,`author`,`note`,`dateline`,`from_id`,`from_num`) VALUES ('$flistid[$i]','livemessage','1','$user_id','$msgfrom','$subject','$time','0','1')";
			$dblink->query($sql);
			//查找有没有提醒记录
			$sql = "SELECT newpm FROM pre_common_member WHERE uid=".$flistid[$i];
			$newpm = $dblink->getRow($sql);
			//如果newpm为0，就执行更新语句，更改为1，否则在原有的基础上加1
			if ($newpm[$i]['newpm'] ==0) {
				$sql = "UPDATE pre_common_member SET `newpm` = '1' WHERE uid=".$flistid[$i];
				$dblink->query($sql);
			} else {
				$newpm = $newpm[$i]['newpm']+1;
				$sql = "UPDATE pre_common_member SET `newpm` = '$newpm' WHERE uid=".$flistid[$i];
				$dblink->query($sql);
			}
		}
		g('发送信息成功','home.php?mod=huoshow&do=live');
	}
	
}
$dblink->dbclose();
$smarty->assign("friendslist",$friendslist);
$smarty->display("home/friendslist.html");
?>