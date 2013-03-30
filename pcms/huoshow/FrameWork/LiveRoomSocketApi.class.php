<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/SocketApi.php");

class LiveRoomSocketApi
{
	
	/**
	 * 获取比赛区、热门区的数据
	 *
	 * @param unknown_type $data[]数组
	 * 		match	记录起点
	 * 		hot	 	记录起点
	 * 		count 	条数
	 * 		
	 */
	static public function getHotMatchData($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,12,$strdata);
		$hotdata = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
		return $hotdata = json_decode(strstr($hotdata,"{"), true);
	}
	
	/**
	 * 获取大厅魅力指数，魅力值，魅力之星，日-周-月排行榜，
	 * 魅力指数exponent，魅力clarm，魅力之星votes
	 *
	 * @param unknown_type $data[]数组
	 * 		count = 7
	 * 		exponent => array (today =>0,week=>0,month=>0)
	 * 		clarm = array (today =>0,week=>0,month=>0)
	 * 		votes = array (today =>0,week=>0,month=>0)
	 */
	static public function getRankingData($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,10,$strdata);
		$rankdata = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
		return $rankdata = json_decode(strstr($rankdata,"{"), true);
			
	}
	
	
	/**
	 * 获取 魅力值,魅力指数,魅力之星,的日-周-月-总排行榜
	 *
	 * @param unknown_type $data[]数组
	 * 				count  每页多少条
	 * 	魅力值
	 * 		1.日: 	clarm array ( today => 记录起点 )
	 * 		2.周:	clarm array ( week => 记录起点 )
	 * 		3.月:	clarm array ( month => 记录起点 )
	 * 		4.总:	clarm array ( total => 记录起点 )
	 * 	魅力指数
	 * 		1.日:	exponent array ( today => 记录起点 )
	 * 		2.周:	exponent array ( week => 记录起点 )
	 * 		3.月:	exponent array ( month => 记录起点 )
	 * 		4.总:	exponent array ( total => 记录起点 )
	 *  魅力之星
	 * 		1.日:	votes array ( today => 记录起点 )
	 * 		2.周:	votes array ( week => 记录起点 )
	 * 		3.月:	votes array ( month => 记录起点 )
	 * 		4.总:	votes array ( total => 记录起点 )
	 */
	static public function getTotalList($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,10,$strdata);
		$charmdata = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
		return $charmdata = json_decode(strstr($charmdata,"{"), true);
	}
	
	/**
	 * 后台发送直播间公告信息 
	 *
	 * @param unknown_type $data[]数组
	 * 		act = 4
	 * 		dstuid 	用户火秀号
	 * 		dstroomid	房间号
	 * 		msg
	 */
	static public function sendNotice($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,20,$strdata);
		$charmdata = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
	}
	
	/**
	 * 后台取消和增加火秀明星
	 *
	 * @param unknown_type $data[]
	 * 		act = 3
	 * 		dstroomid	房间号
	 */
	static public function sendCancelStar($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,20,$strdata);
		$charmdata = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
	}
	
	/**
	 * 修改个人信息等...
	 *
	 * @param unknown_type $data[]
	 * 		act = 2
	 * 		dstuid 用户火秀号
	 */
	static public function sendPersonalProfile($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,20,$strdata);
		$charmdata = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
	}
	
	/**
	 * 添加火币或者是充值
	 *
	 * @param unknown_type $data[]
	 * 		act = 1
	 * 		dstuid 用户火秀号
	 */
	static public function sendHuoShowUpdate($data){
		$strdata = json_encode($data);
		$body_length = strlen($strdata);
		$comand_num = sprintf("%06X%03d%s",$body_length+3,20,$strdata);
		$charmdata = SockProcess::sendAndReturn(MUTIL_ROOM_SERVER_S_HOST,MUTIL_ROOM_SERVER_S_PORT,$comand_num);
	}

		
}
?>