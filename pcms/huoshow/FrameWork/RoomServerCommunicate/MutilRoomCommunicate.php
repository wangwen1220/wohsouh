<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/RoomServerCommunicate/CommunicateBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");


class MutilRoomCommunicate extends CommunicateBase
{
	/**
	 * 退房
	 *
	 */
	public function on_logout()
	{
		
		$dblink = new DataBase("");	
//		file_put_contents($_SERVER['DOCUMENT_ROOT']."/huoshow/test_log.txt",$this->m_cmd_body,FILE_APPEND);
		$this->m_cmd_body = json_decode($this->m_cmd_body ,true);
		//退出UID
		$logout_uid = $this->m_cmd_body["logout_uid"];
		//退出房间
		$logout_rid = $this->m_cmd_body["logout_rid"];
		//房管数
		$room_master_count = $this->m_cmd_body["room_master_count"];
		//管理员数
		$room_manager_count = $this->m_cmd_body["room_manager_count"];
		$time = time();
		//得到统计ID，和进房时间
		$sql = "SELECT id,starttime FROM pre_mutilive_person_room_time WHERE roomid=$logout_rid AND uid=$logout_uid AND endtime=0 ORDER BY id DESC LIMIT 1";
		$room_time = $dblink->getRow($sql);
		$timediff = ($time - $room_time[0]["starttime"]);		
		if ($room_master_count == 0 && $room_manager_count == 0) {
			$sql = "SELECT IF(nickname!='',nickname,username) AS nickname FROM pre_common_member WHERE uid=$logout_uid";
			$logout_name = $dblink->getRow($sql);
			$sql = "SELECT MAX(id) AS max_id FROM pre_multilive_room_log WHERE roomid=$logout_rid AND end_time=0";
			$max_id = $dblink->getRow($sql);
			//修改退出房间信息
			$sql = "UPDATE pre_multilive_room_log SET close_uid='$logout_uid', close_username='".$logout_name[0]["nickname"]."', end_time='$time' WHERE id=".$max_id[0]["max_id"];
			$dblink->query($sql);
			//修改统计信息
			if ($room_time[0]["id"]){
				$sql = "UPDATE pre_mutilive_person_room_time SET endtime='$time',timediff='$timediff' WHERE id=".$room_time[0]["id"];
				$dblink->query($sql);
			}
		}else {
			if ($room_time[0]["id"]){
				$sql = "UPDATE pre_mutilive_person_room_time SET endtime='$time',timediff='$timediff' WHERE id=".$room_time[0]["id"];
				$dblink->query($sql);
			}
		}
		
	}
	/**
	 * Enter description here...
	 *
	 */
	public function on_inroom()
	{
		die("on_inroom");
	}
	
	/**
	 * 送礼
	 *
	 */
	public function on_send_gift()
	{
//		return ;
		$dblink = new DataBase("");
//		$dblink->query("insert into pre_z_test SET ttt='".$gifthuoshow[0]["image"]."' ");die();
		$this->m_cmd_body = json_decode($this->m_cmd_body ,true);
		//房间ID
		$room_id = $this->m_cmd_post["roomid"];
		//收礼人UID
		$dstuid = $this->m_cmd_body["dstuid"];
		//送礼人UID
		$srcuid = $this->m_cmd_post["src_uid"];
		//礼物ID
		$giftid = $this->m_cmd_body["param1"];
		//数量
		$num = $this->m_cmd_body["param2"];		
		//当前时间
		date_default_timezone_set("Asia/Shanghai");
		$time = time();
		
		if(empty($room_id) || !is_numeric($room_id) || $room_id<1)
			return getR(false,"room_id格式错误");
		if(empty($dstuid) || !is_numeric($dstuid) || $dstuid<1)
			return getR(false,"dstuid格式错误");
		if(empty($srcuid) || !is_numeric($srcuid) || $srcuid<1)
			return getR(false,"srcuid格式错误");
		
		//根据房间得到房主信息及UID
		$sql = "SELECT a.uid,IF(m.nickname!='',m.nickname,m.username) AS username FROM 
pre_multilive_room a LEFT JOIN pre_common_member m ON m.uid=a.uid WHERE a.uid='.$room_id.' LIMIT 1";
		$room_master_data = $dblink->getRow($sql);
		//请求用户列表
		$user_data = array(
			'roomid' => "$room_id"
		);
		$user_str = MutilLiveRoomSocketApi::sendRoomUsersList($user_data);
		//默认UID为False
		$is_user_uid = false;
		$dstname = '';
		$is_mic = 0;
		for ($i=0;$i<count($user_str['userlist']);$i++){
			if ($dstuid == $user_str['userlist'][$i]["uid"]){
				$is_user_uid = true;
				$dstname = $user_str['userlist'][$i]["username"];
			}
			if ($user_str['userlist'][$i]["is_mic"] == 1){
				$is_mic = 1;
			}
		}
		//检查UID是否是用户列表里的
		if ($is_user_uid == false || $is_mic == 0) {
			$data = array(
				'act' => 4,
				'type' => 0,
				'dstroomid' => "$room_id",
				'dstuid' => "$srcuid",
				'msg' => '此用户不在麦上，不能送礼',
			);
			MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data,0);
		}else {
			//得到用户余额
			$sql = "SELECT showcoin,consume FROM pre_ucenter_showcoin WHERE uid=$srcuid";
			$userbalance = $dblink->getRow($sql);
			//根据用户ID得到用户名
			$srcname = UserApi::getUserName($srcuid);
			//计算用户购买礼物所需要的火币
			$sql = "SELECT SUM(price*'$num') AS total_price,name,price,content,image,units FROM pre_live_gift WHERE giftid=$giftid";
			$gifthuoshow = $dblink->getRow($sql);
			//判断火币余额是否大于所购买礼物所需的火币
			if ($userbalance[0]["showcoin"] >= $gifthuoshow[0]["total_price"]) {//购买成功
				if ($giftid == DZ_GIFT_BAG_ID){
MutiliveRoom::Gift_Present_special($room_id,$srcuid,$srcname[0]["nickname"],$dstuid,$dstname,$num,$gifthuoshow[0]["image"],$gifthuoshow[0]["content"],$gifthuoshow[0]["name"],$gifthuoshow[0]["units"],$gifthuoshow[0]["total_price"]);
					return ;
				}
				$gift_remark = "购买 $num 个 ".$gifthuoshow[0]["name"]."（礼物）—赠送给用户：$dstuid ";
				$sql = "UPDATE pre_ucenter_showcoin SET showcoin=showcoin-'".$gifthuoshow[0]["total_price"]."',consume=consume+'".$gifthuoshow[0]["total_price"]."' WHERE uid= $srcuid";
				$dblink->query($sql);
				$data = array(
					'act' => 1,
					'dstuid' => "$srcuid"
				);
				
				MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data);
				$sql = "INSERT INTO pre_ucenter_showcoin_log SET uid= $srcuid,operation = 'MRC',dateline = '$time',amount=amount-'".$gifthuoshow[0]["total_price"]."',TYPE='out',remark='$gift_remark',balance=('".$userbalance[0]["showcoin"]."'-'".$gifthuoshow[0]["total_price"]."')";
				$dblink->query($sql);
				//得到场此ID
				$sql = "SELECT MAX(id) as max_id FROM pre_multilive_room_log WHERE roomid=$room_id";
				$max_id = $dblink->getRow($sql);
				//多人直播间每场送礼日志
				$sql = "INSERT INTO pre_multilive_gift_log SET uid = '$srcuid',username='".$srcname[0]["nickname"]."',roomid=$room_id,roomlogid='".$max_id[0]["max_id"]."',ACTION='1',giftid=$giftid,giftname='".$gifthuoshow[0]["name"]."',giftprice='".$gifthuoshow[0]["price"]."',
num='$num',targetuid=$dstuid,targetusername='$dstname',dateline='$time'";
				$dblink->query($sql);
				//接收
				$sql = "INSERT INTO pre_multilive_gift_log SET uid = '$dstuid',username='$dstname',roomid=$room_id,roomlogid='".$max_id[0]["max_id"]."',ACTION='2',giftid=$giftid,giftname='".$gifthuoshow[0]["name"]."',giftprice='".$gifthuoshow[0]["price"]."',
num='$num',targetuid=$srcuid,targetusername='".$srcname[0]["nickname"]."',dateline='$time'";
				$dblink->query($sql);
				$icon_img = '';
				for ($j=0;$j<$num;$j++){
					$icon_img .= '<img width="70px" height="70" src="/static2/images/gift/'.$gifthuoshow[0]["image"].'" />';
				}
				$tmp_str  = str_replace("{sender}",$srcname[0]["nickname"],$gifthuoshow[0]["content"]);
				$tmp_str  = str_replace("{receiver}",$dstname,$tmp_str);
				$tmp_str  = str_replace("{icon}*{num}",$icon_img,$tmp_str);
				$tmp_str  = str_replace("{name}",$gifthuoshow[0]["name"],$tmp_str);
				$tmp_str  = str_replace("{num}",$num,$tmp_str);
				$tmp_str  = str_replace("{unit}",$gifthuoshow[0]["units"],$tmp_str);
				$data = array(
					'act' => "4",
					'type' => "0",
					'dstroomid' => "$room_id",
					'dstuid' => "$dstuid",
					'msg' => "$tmp_str",
				);
				MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data);
				//礼物价值火币
				$gift_price_tatal = $gifthuoshow[0]["total_price"];
				//获得系统提点设置
				$sql ="SELECT config_value FROM pre_mutilive_config WHERE config_name='total_percent'";
				$config_value = $dblink->getRow($sql);
				//获得当前多人房等级提点设置 -- by ck a.roomid=$dstuid?
				$sql = "SELECT b.room_huocoin_percent FROM pre_multilive_room a,pre_mutilive_room_type b WHERE a.room_class_id = b.id AND a.roomid=$room_id";
				$mulroom_percent = $dblink->getRow($sql);
				$sys_percent_f = floatval($config_value[0]["config_value"]);
				$mulroom_percent_f = floatval($mulroom_percent[0]["room_huocoin_percent"]);
				//收礼人提点=礼物总额*（1-系统总提点-房间提点）
                $ticket_price_all = $gift_price_tatal*(1-$sys_percent_f-$mulroom_percent_f);
                $sql = "INSERT INTO pre_mutilive_ticket_log (roomid,uid,username,reason,session_id,src_uid,gift_id,gift_num,ticket_price) VALUES ($room_id,$dstuid,'$dstname',3,'".$max_id[0]["max_id"]."',$srcuid,$giftid,$num,$ticket_price_all)";
                $dblink->query($sql);
				//收礼人点券统计入库
				$sql = "SELECT id FROM pre_mutilive_ticket_stat WHERE uid=$dstuid";
				$sql_statement = $dblink->getRow($sql);
				if (count($sql_statement) > 0) {
					$sql = "UPDATE pre_mutilive_ticket_stat SET pointticket_totalprice=pointticket_totalprice+'$ticket_price_all' WHERE id=".$sql_statement[0]["id"];
					$dblink->query($sql);
				}else {
					$sql = "INSERT pre_mutilive_ticket_stat (uid,pointticket_totalprice) VALUES ($dstuid,$ticket_price_all) ";
					$dblink->query($sql);
				}
				$manager_percent = 0;//管理员的提点
                $room_master_percent = 0; //房间的提点
                $allmanager = 0;
                //系统提点不能为空
                if (!empty($config_value[0]["config_value"])){
                	//房间管理员提点
                	$sql = "SELECT uid,username,percent FROM pre_mutilive_room_manager WHERE roomid=$room_id AND percent>0";
                	$room_manager = $dblink->getRow($sql);
                	for ($i=0;$i<count($room_manager);$i++){
                		//所有管理员的总提点
                		$allmanager_per += $room_manager[$i]["percent"];
                		//管理员提点
                		$manager_percent = $room_manager[$i]["percent"];
                		//房间提点=房间的总提点
                		$room_master_percent = $mulroom_percent_f;
                		//管理员=礼物总额*房间提点*管理员相应提点
                		$m_ticket_price_all = ($gift_price_tatal*$room_master_percent*$manager_percent);
                		//管理员点券入库
                		$sql = "INSERT INTO pre_mutilive_ticket_log (roomid,uid,username,reason,session_id,src_uid,gift_id,gift_num,ticket_price) VALUES ($room_id,'".$room_manager[$i]["uid"]."','".$room_manager[$i]["username"]."',1,'".$max_id[0]["max_id"]."',$srcuid,$giftid,$num,$m_ticket_price_all)";
                		$dblink->query($sql);
                		$sql = "SELECT id FROM pre_mutilive_ticket_stat WHERE uid=".$room_manager[$i]["uid"];
                		$dst_ticket_id = $dblink->getRow($sql);
                		if (count($dst_ticket_id) > 0) {
                			$sql = "UPDATE pre_mutilive_ticket_stat SET pointticket_totalprice=pointticket_totalprice+'$m_ticket_price_all' WHERE id=".$dst_ticket_id[0]["id"];
                			$dblink->query($sql);
                		}else {
                			$sql = "INSERT pre_mutilive_ticket_stat (uid,pointticket_totalprice) VALUES ('".$room_manager[$i]["uid"]."',$m_ticket_price_all) ";
                			$dblink->query($sql);
                		}
                	}
                	//房主提点=礼物总额*房间提点*（1-管理员总提点）
                	$room_master_percent = 1-$allmanager_per;
                    $ticket_price_all = ($gift_price_tatal*$mulroom_percent_f*$room_master_percent);
                    //房主点券入库
                    $sql = "INSERT INTO pre_mutilive_ticket_log (roomid,uid,username,reason,session_id,src_uid,gift_id,gift_num,ticket_price) VALUES ($room_id,'".$room_master_data[0]["uid"]."','".$room_master_data[0]["username"]."',2,'".$max_id[0]["max_id"]."',$srcuid,$giftid,$num,$ticket_price_all)";
                    $dblink->query($sql);
                    $sql = "SELECT id FROM pre_mutilive_ticket_stat WHERE uid=".$room_master_data[0]["uid"];
                    $master_id = $dblink->getRow($sql);
                    if (count($master_id) > 0) {
                    	$sql = "UPDATE pre_mutilive_ticket_stat SET pointticket_totalprice=pointticket_totalprice+'$ticket_price_all' WHERE id=".$master_id[0]["id"];
                    	$dblink->query($sql);
                    }else {
                    	$sql = "INSERT pre_mutilive_ticket_stat (uid,pointticket_totalprice) VALUES ('".$room_master_data[0]["uid"]."',$ticket_price_all) ";
                    	$dblink->query($sql);
                    } 
                }
                //更改member_count魅力值
                $sql = "UPDATE pre_live_member_count SET charm=charm+'$gift_price_tatal' WHERE uid=$dstuid";
                $dblink->query($sql);
                //计算接收方的明星等级
                $sql = "SELECT id,totalnum FROM pre_live_top WHERE uid='$dstuid' AND cate='charm' limit 0,1";
                $live_top = $dblink->getRow($sql);
                if (count($live_top) > 0) {
	                $sql = "UPDATE pre_live_top SET cate='charm', daynum=daynum+'$gift_price_tatal',weeknum=weeknum+'$gift_price_tatal',monthnum=monthnum+'$gift_price_tatal',totalnum=totalnum+'$gift_price_tatal' WHERE uid=$dstuid AND cate='charm'";
	                $dblink->query($sql);
                }else {
                	$sql = "INSERT INTO pre_live_top SET cate='charm', uid=$dstuid,username='$dstname',daynum=$gift_price_tatal,weeknum=$gift_price_tatal,monthnum=$gift_price_tatal,totalnum=$gift_price_tatal ";
                	$dblink->query($sql);
                }
				$original_charm =  $live_top[0]["totalnum"];
				$original_charm_level = MutilLiveRoomSocketApi::getUserLevel($original_charm,2);
                $now_charm_level = MutilLiveRoomSocketApi::getUserLevel($original_charm+$gift_price_tatal,2);
                $charm_remark = "恭喜$dstname明星等级上升到".$now_charm_level[0]["level"]."级";
                if ($now_charm_level[0]["level"] > $original_charm_level[0]["level"] and $now_charm_level[0]["level"]>1) {
                	$data = array(
						'act' => '4',
						'type' => '1',
						'msg' => "$charm_remark",
					);
					MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data);
                }
                //计算赠送方的富豪等级
                $sql = "SELECT id,totalnum FROM pre_live_top WHERE uid='$srcuid' AND cate='huoshow' limit 0,1";
                $src_top = $dblink->getRow($sql);
                if (count($src_top) > 0) {
                	$sql = "UPDATE pre_live_top SET cate='huoshow',daynum=daynum+'$gift_price_tatal',weeknum=weeknum+'$gift_price_tatal',monthnum=monthnum+'$gift_price_tatal',totalnum=totalnum+'$gift_price_tatal' WHERE uid=$srcuid AND cate='huoshow'";
                	$dblink->query($sql);
                }else {
                	$sql = "INSERT INTO pre_live_top SET cate='huoshow', uid='$srcuid',username='".$srcname[0]["nickname"]."',daynum=$gift_price_tatal,weeknum=$gift_price_tatal,monthnum=$gift_price_tatal,totalnum=$gift_price_tatal ";
                	$dblink->query($sql);
                }
                //原有的消费值
                $original_consume = $userbalance[0]["consume"];
                $original_level = MutilLiveRoomSocketApi::getUserLevel($original_consume,1);
                $now_level = MutilLiveRoomSocketApi::getUserLevel($original_consume+$gift_price_tatal,1);
                $remark = "恭喜".$srcname[0]["nickname"]."富豪等级上升到".$now_level[0]["level"]."级";
                //当前等级大于原有等级发送系统消息
                if ($now_level[0]["level"] > $original_level[0]["level"] and $now_level[0]["level"]>1) {
                	$data = array(
						'act' => '4',
						'type' => '1',
						'msg' => "$remark",
					);
					MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data);
                }
			}else {//失败
				$data = array(
					'act' => 4,
					'type' => 0,
					'dstroomid' => $room_id,
					'dstuid' => $srcuid,
					'msg' => "您的火币余额不足！请到 <a href='home.php?mod=space&do=pay' target='_blank'>支付中心</a> 进行充值，或者 <a href='home.php?mod=task' target='_blank'>完成每日任务</a> 赚取火币。",
				);
				MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data,0);
			}
		}
	}
	
	/**
	 * 设置管理员
	 *
	 */
	public function on_setup_manager()
	{
		$dblink = new DataBase("");		
		$this->m_cmd_body = json_decode($this->m_cmd_body ,true);
		//房间ID
		$roomid = $this->m_cmd_body["roomid"];
		//设的人UID
		$dstuid = $this->m_cmd_body["dstuid"];
		//被设或被取消人UID
		$uid = $this->m_cmd_body["uid"];
		//act:1设为管理员 0:取消设置管理员
		$act = $this->m_cmd_body["act"];
		if ($act == '1') {
			$sql = "SELECT b.room_name,b.uid,b.username,
			(SELECT COUNT(*) FROM pre_mutilive_room_manager a WHERE a.roomid=b.roomid) AS manage,
			(SELECT manager_count FROM pre_mutilive_room_type t WHERE t.id=b.room_class_id ) AS manage_count 
			FROM pre_multilive_room b WHERE b.stat=1 AND b.roomid=$roomid AND b.uid=$dstuid";
			$manager = $dblink->getRow($sql);
			if ($manager[0]["manage"] <= $manager[0]["manage_count"]) {
				$manager_name = UserApi::getUserName($uid);
				$sql = "INSERT INTO pre_mutilive_room_manager SET roomid=$roomid,uid=$uid,username='".$manager_name[0]["nickname"]."',type=1,percent=0";
				$dblink->query($sql);
			}else {
				$data = array(
					'act' => 4,
					'type' => 0,
					'dstroomid' => $roomid,
					'dstuid' => $dstuid,
					'msg' => '管理员已到上限',
				);
				MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data);
			}			
		}
		if ($act == '0') {
			$sql = "DELETE FROM pre_mutilive_room_manager WHERE roomid=$roomid AND uid=$uid";
			$dblink->query($sql);
		}
	}
	
	/**
	 * 上麦
	 *
	 */
	public function on_top_michael(){
		$dblink = new DataBase("");	
		//房间ID
		$roomid = $this->m_cmd_post["roomid"];		
		//上麦用户UID
		$uid = $this->m_cmd_post["uid"];
		//用户占卖开始时间
		$mic_starttime = $this->m_cmd_post["mic_starttime"];
		//用户占麦的麦号
		$mic_num = $this->m_cmd_post["mic_num"];
		//用户姓名
		$michael_name = MutilLiveRoomSocketApi::getUserName($uid);
		//场次ID
		$live_id = MutilLiveRoomSocketApi::getUserLiveId($roomid);
		$sql = "INSERT INTO pre_mutilive_usemic_log SET roomid='$roomid',roomlogid='".$live_id[0]["id"]."',uid='$uid',username='".$michael_name[0]["nickname"]."',mic_starttime='$mic_starttime',mic_num='$mic_num'";
		$dblink->query($sql);
	}
	
	/**
	 * 下麦
	 *
	 */
	public function on_down_michael(){
		$dblink = new DataBase("");
		//房间ID
		$roomid = $this->m_cmd_post["roomid"];
		//下麦用户UID
		$uid = $this->m_cmd_post["uid"];
		$time = time();
		$sql = "UPDATE pre_mutilive_usemic_log SET mic_endtime='$time' WHERE roomid = '$roomid' AND uid = '$uid' AND mic_endtime = 0";
		$dblink->query($sql);
	}
	
	/**
	 * 通知PHP消息服务器启动（可能是主动关闭后启动，也可能是崩溃后启动）
	 *	执行相应的操作
	 */
	public function on_server_start(){
		$dblink = new DataBase("");
		$end_time = $this->m_cmd_post["date"];
		$time = time();
		$sql = "UPDATE pre_multilive_room_log SET end_time='$end_time' WHERE end_time=0";
		$dblink->query($sql);
		$sql = "SELECT id,starttime FROM pre_mutilive_person_room_time WHERE endtime=0";
		$room_time = $dblink->getRow($sql);
		for ($i=0;$i<count($room_time);$i++){
			$timediff = $time - $room_time[$i]["starttime"];
			$sql = "UPDATE pre_mutilive_person_room_time SET endtime='$end_time',timediff='$timediff' WHERE endtime=0 AND id=".$room_time[$i]["id"];
			$dblink->query($sql);
		}
		
		$sql = "UPDATE pre_mutilive_usemic_log SET mic_endtime='$end_time' WHERE mic_endtime=0";
		$dblink->query($sql);
		MutiliveRoom::getRoomNoToClose();
	}
	
	/**
	 * 通知某房间已经到期
	 *
	 */
	public function on_room_expire(){
		$roomid = $this->m_cmd_post["roomid"];
//		log_h('rid：'.$roomid);
		MutiliveRoom::changeRoomInfoFromEvent($roomid);
	}
	
}
?>