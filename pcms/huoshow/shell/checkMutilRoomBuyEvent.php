<?php
/**
 * 对已经购买多人直播间但由于之前直播间还没有到期而进入日志表的
 * 记录进行扫描，如果时间到，则进行相关的购买动作
 * 包括修改多人直播间的类型、
 *
 * @author badroom
 * @package defaultPackage
 */


$root_path = realpath(dirname(__FILE__)."/../..");
$_SERVER['DOCUMENT_ROOT'] = $root_path;
require_once($root_path."/huoshow/FrameWork/DataBase.php");
require_once($root_path."/huoshow/FrameWork/MutilLiveRoom.class.php");

date_default_timezone_set("Asia/Shanghai");
$time = time();
$dblink = new DataBase("");
//查找所有到期的事件
//$sql = "SELECT id,uid,username,mutillive_room_level,start_time,end_time,root_type FROM pre_mutilive_next_pass_event WHERE start_time <= $time";
$sql = "SELECT a.*,b.roomid FROM pre_mutilive_next_pass_event a LEFT JOIN pre_multilive_room b ON b.uid=a.uid WHERE start_time <= $time";
$dbarr = $dblink->getRow($sql);
for($i=0;$i<count($dbarr);$i++)
{
	MutiliveRoom::changeRoomInfoFromEvent($dbarr[$i]["roomid"]);
}
$dblink->dbclose();
echo "OK";die();
?>