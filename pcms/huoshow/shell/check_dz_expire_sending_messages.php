<?php

/**
 * 房间套餐到期发送消息给用户
 *
 * @author Administrator
 * @package defaultPackage
 */

$root_path = realpath(dirname(__FILE__)."/../..");
$_SERVER['DOCUMENT_ROOT'] = $root_path;
require_once($root_path."/huoshow/FrameWork/DataBase.php");
require_once($root_path."/huoshow/FrameWork/MutilLiveRoom.class.php");
date_default_timezone_set("Asia/Shanghai");

$dblink = new DataBase("");
$time = time();
//查找所有多功能房间套餐和是否有提醒
$sql = "SELECT a.roomid,a.room_name,a.uid,a.username,a.dateline,a.expire_time,(SELECT newprompt FROM pre_common_member b WHERE a.uid=b.uid ) AS newprompt FROM pre_multilive_room a WHERE a.available=1 AND a.ismsg=0";
$roomArr = $dblink->getRow($sql);
for ($i=0;$i<count($roomArr);$i++){
	//得到期时间并减7就是最后一周
	$roomArr[$i]["day"] = strtotime('-7 day', $roomArr[$i]["expire_time"]);
	if ($time >= $roomArr[$i]["day"]){
		//插入发送内容
		$sql = "INSERT INTO pre_home_notification (`uid`,`type`,`new`,`authorid`,`author`,`note`,`dateline`,`from_id`,`from_num`) 
VALUES ('".$roomArr[$i]["uid"]."','livemessage','1','".$roomArr[$i]["uid"]."','".$roomArr[$i]["username"]."','<a href=".'/home.php?mod=huoshow&do=apply_room&room_id='.$roomArr[$i]["uid"].">您的多功能房间即将到期，为了正常使用请续费或者完成本月任务。</a>','".$roomArr[$i]["day"]."','0','1')";
		$dblink->query($sql);
		//更新是否已发送过消息
		$dblink->query("UPDATE pre_multilive_room SET `ismsg` = '1' WHERE uid=".$roomArr[$i]["uid"]);
		$newp = $roomArr[$i]["newprompt"] + 1;
		//更新提醒数值
		$dblink->query("UPDATE pre_common_member SET `newprompt` = '$newp' WHERE uid=".$roomArr[$i]["uid"]);
	}
}
//$isRoomExpired = '';
$dblink->dbclose();
?>