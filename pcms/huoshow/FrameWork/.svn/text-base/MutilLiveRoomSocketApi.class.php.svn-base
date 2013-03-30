<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/LiveRoomSocketApi.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
/**
 * 多音频子类继承LiveRoomApi
 *
 */
class MutilLiveRoomSocketApi extends LiveRoomSocketApi
{
	
	/**
	 * 后台关闭房间时发送信息给消息服务器
	 * $data 数组
	 * act = 3
	 * dstroomid = M+火秀号
	 */
	static public function sendCloseRoom($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,30,$strdata);
		$CloseRoom = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
	}
	
	
	/**
	 * 发送多人房系统消息
	 *
	 * @param unknown_type $data
	 * @param unknown_type $broad
	 * 		broad=1表示群发
	 * 		broad=0表示单发
	 */
	static public function sendMutilLiveSystemMessages($data,$broad=1){
		$data["broad"] = ($broad==1) ? "1" : "0";
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$strdata = sprintf("%06X%03d%s",$body_length+3,20,$strdata);
		$SystemMessages = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$strdata);
		
		
//		$strdata = json_encode($data);
//		$body_length = strlen($strdata);
//		$strdata = sprintf("%06X%03d%s",$body_length+3,20,$strdata);
//		//$strdata = sprintf("%06X%03d%s",$body_length+3,04,$strdata);
//		$hotdata = SockProcess::sendAndReturn("192.168.2.172",10007,$strdata);
//		var_dump($hotdata);die();
	}
	
	static public function sendMutilLiveParameters($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,28,$strdata);
		$charmdata = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
	}
	
	/**
	 * 发送多人直播间激活房间相关信息
	 */
	static public function sendMutiliveRoominfo($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,21,$strdata);
		$charmdata = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
		
	}
	
	/**
	 * 获得某用户在某房间是否被踢
	 *
	 * @param unknown_type $data
	 */
	static public function sendIsKicking($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,29,$strdata);
		$charmdata = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
		return $IsKicking = json_decode(strstr($charmdata,"{"), true);
	}
	
	/**
	 * 多人直播间获得某房的用户列表
	 *
	 * @param unknown_type $data
	 */
	static public function sendRoomUsersList($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,22,$strdata);
		$RoomUsersList = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
//		log_h('列表1：'.$RoomUsersList);	
		return $RoomUsersList = json_decode(strstr($RoomUsersList,"{"), true);
		//print_r($RoomUsersList);	
	}
	
	/**
	 * 获得直播大厅多人房用户列表
	 *
	 * @param unknown_type $data
	 * @return unknown
	 */
	static public function sendIndexMultiRoomList($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,12,$strdata);
		$MultiRoomList = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
		//var_dump($MultiRoomList);die();
		return $MultiRoomList = json_decode(strstr($MultiRoomList,"{"), true);
	}
	
	/**
	 * 多人直播间获得某房间信息
	 *
	 * @param unknown_type $data
	 */
	static public function sendRoomLiveNews($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,23,$strdata);
		$RoomLiveNews = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
		return $RoomLiveNews = json_decode(strstr($RoomLiveNews,"{"), true);
	}
	
	/**
	 * 获得用户等级
	 *
	 * @param unknown_type $value
	 * @param unknown_type $type 1为明星，2为富豪
	 * @return unknown
	 */
	static public function getUserLevel($value,$type)
	{
		$dblink = new DataBase("");
		if ($value){
			$Level=0;
			$sql = "SELECT level,name FROM pre_live_level_config WHERE `type` ='$type' AND $value >= `valuelower` AND $value <= `valuehigher`";
			$Level= $dblink->getRow($sql);
			if (empty($Level) and $value>0){
				$sql = "SELECT MAX(`level`) AS level FROM pre_live_level_config WHERE `type` ='$type' ";
				$Level = $dblink->getRow($sql);
			}
			return $Level;
		}
	}
	
	/**
	 * 获得用户姓名与UID
	 *
	 * @param unknown_type $uid
	 * @return unknown
	 */
	static public function getUserName($uid){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT uid,IF(nickname!='',nickname,username) AS nickname FROM pre_common_member WHERE uid=$uid";
		$UserName = $dblink->getRow($sql);
		return  empty($UserName) ? 0 : $UserName;
		$dblink->dbclose();
	}
	
	/**
	 * 获得用户直播的场次ID
	 *
	 * @param unknown_type $roomid
	 * @return unknown
	 */
	static public function getUserLiveId($roomid){
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT MAX(id) AS id FROM pre_multilive_room_log WHERE roomid = $roomid AND end_time=0";
		$UserLiveId = $dblink->getRow($sql);
		return  empty($UserLiveId) ? 0 : $UserLiveId;
		$dblink->dbclose();
	}
	
	
	/**
	 * 设置或者取消管理员
	 * 
	 * @param unknown_type $rid	房间ID
	 * @param unknown_type $uid	用户ID
	 * @param unknown_type $act	操作：1，设置管理员；0，取消管理员
	 * @return mixed
	 */
	static public function setOrCancelRoomManager($rid, $uid, $act)
	{
		$data["roomid"] = $rid;
		$data["dstuid"] = $uid;
		$data["act"] = $act;
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,26,$strdata);
		$RoomLiveNews = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
		return $RoomLiveNews = json_decode(strstr($RoomLiveNews,"{"), true);
	}
}
?>