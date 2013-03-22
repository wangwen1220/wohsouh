<?php
/**
 * 多功能直播间操作API
 *
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
class MutiliveRoom
{
	/**
	 * 获得多人直播间的基本基本信息
	 *
	 * @param unknown_type $roomid 房间ID
	 */
	static public function getRoomBaseInfo($roomid)
	{
		if(!is_numeric($roomid))
			return getR(false,"房间号必须为数字");
		$dblink = new DataBase("");
		$sql = "SELECT a.room_name,a.room_type,a.cover_img,a.description,a.uid,a.username,a.dateline,a.expire_time,b.room_type_name,(select count(*) from pre_mutilive_room_manager c where c.roomid=a.roomid) as manager_count FROM pre_multilive_room a,pre_mutilive_room_type b WHERE a.room_class_id=b.id AND a.roomid='$roomid'";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		return $dbarr;
	}
	
	/**
	 * 某用户创建一个多人直播间 - 通过免费的方式
	 *
	 * @param unknown_type $uid 		申请的用户ID
	 * @param unknown_type $roomlevel 	申请的房间等级
	 * @param unknown_type $username 	用户名
	 */
	static public function createMutiliveRoomFree($uid,$roomlevel,$username)
	{
		if(!is_numeric($uid) || $uid<1)
			return getR(false,"用户ID格式错误");
		if(!is_numeric($roomlevel) || $roomlevel<1)
			return getR(false,"房间等级格式错误");
		if(empty($username))
			return getR(false,"用户名不得为空");
		$dblink = new DataBase("");
		//判断是否是巡管,true为巡管
		$isAdmin = MutiliveRoom::getIsTourTube($uid);
		if($isAdmin == true){
			return g('您是巡管，不允许此操作！','/home.php?mod=huoshow&do=apply_room&room_id='.$uid);
		}else {
			//判断是否连续免费申请，如果连续则提示本套餐正在使用中,0为可以再次购买
			$IsContinuousBuy = MutiliveRoom::getIsContinuousBuy($uid);
			if ($IsContinuousBuy == 0 ) {
				//判断之前有无申请过
				$sql = "SELECT room_type_id FROM pre_mutilive_room_buy_history WHERE uid='$uid' LIMIT 0,1";
				$dbarr = $dblink->getRow($sql);
				if(count($dbarr)==0) {//说明没有申请过
					//查看用户所申请的房间级别需要的魅力值和财富值
					$sql = "SELECT free_first_charm , free_first_rich FROM pre_mutilive_room_type WHERE `level`='$roomlevel'";
					$roomlevel_arr = $dblink->getRow($sql);
					if(count($roomlevel_arr)==0) {
						$dblink->dbclose();
						return getR(false,"不存在这个多人直播间等级");
					}
					//查看魅力值和财富值是否满足相应级别的要求
					//$sql = "SELECT a.uid,a.username,a.charm,b.consume FROM pre_live_member_count a,pre_ucenter_showcoin b 
							//WHERE a.uid=b.uid AND a.uid='$uid'";
					//$user_info = $dblink->getRow($sql);
					$sql = "SELECT uid,username,charm FROM pre_live_member_count WHERE uid='$uid'";
					$UserCharm = $dblink->getRow($sql);
					$sql = "select uid,consume from pre_ucenter_showcoin where uid='$uid'";
					$UserHuoMoney = $dblink->getRow($sql);
					//用户魅力值
					$user_charm = empty($UserCharm[0]['charm'])?0:$UserCharm[0]['charm'];
					//用户财富值
					$user_rich = empty($UserHuoMoney[0]['consume'])?0:$UserHuoMoney[0]['consume'];
					if($UserCharm[0]['charm']>=$roomlevel_arr[0]["free_first_charm"] ||
						$UserHuoMoney[0]['consume']>=$roomlevel_arr[0]["free_first_rich"])
					{
						date_default_timezone_set("Asia/Shanghai");
						$start_time = time();
						$end_time = strtotime('+1 month', time());
						$dblink->query("INSERT INTO pre_multilive_room (roomid,room_name,room_class_id,room_type,available,uid,username,stat,dateline,expire_time) values ('$uid','$username','$roomlevel','1','1','$uid','$username','1','$start_time','$end_time')");
						$dblink->query("INSERT INTO pre_mutilive_room_buy_history (uid,username,room_type_id,dateline,endtime,
							buy_state) values ('$uid','$username','$roomlevel','$start_time','$end_time','1')");
						$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg) values 
								('$uid','$username','1','用户 $username 首次申请多功能直播厅 级别为 $roomlevel . 成功')");
					}
					else {
						return getR(false,"魅力值或财富值不够申请此级别的多人直播间");
					}
				}
				else {//说明已经申请过，是续签
					$sql = "select roomid,expire_time from pre_multilive_room where uid='$uid'";
					$room_info_arr = $dblink->getRow($sql);
					$roomid = $room_info_arr[0]["roomid"];
					if(empty($roomid))
						return getR(false,"没有对应的房间");					
					//找出当前房间的过期日期
					$expire_time = $room_info_arr[0]["expire_time"];	
					//判断上月的火币消耗额有没有达到
					$room_total_huocoin = MutiliveRoom::getPreMonthPayHuoCoin($roomid,$expire_time);
					//查询对应等级的房间需要的火币数
					$sql = "select free_pay_huocoin from pre_mutilive_room_type where level='$roomlevel'";
					$room_level_arr = $dblink->getRow($sql);
					$room_level_huocoin = $room_level_arr[0]["free_pay_huocoin"];
					if(empty($room_level_huocoin))
						return getR(false,"等级为$roomlevel的多人直播间所需的火币消耗额异常");
					if($room_total_huocoin<$room_level_huocoin)
						return getR(false,"上月的火币消耗额不符合要求");
					else {
						//有种情况要考虑，比如某用户本月是1级房间，在月中时申请了2级房间通过，
						//那么月中到月尾应该仍然是1级，到月底系统自动调整为2级房间，因此需要一个事件表
						//存储到期时间，需要调整的级别，开通时间和结束时间，房间ID
						//crontab每一个小时遍历一次，把到期的记录刷新（更新房间表并新增购买日志表 ）
						
						date_default_timezone_set("Asia/Shanghai");
						$currentTime = time();
						//如果已经过期，则从现在开始计费
						if($expire_time<$currentTime) {
							$start_time = $currentTime;
							$end_time = strtotime('+1 month', $start_time);
							$dblink->query("update pre_multilive_room set room_class_id='$roomlevel',room_type='1',available='1',uid='$uid',username='$username',stat='1',expire_time='$end_time' where roomid='$uid'");
							$dblink->query("INSERT INTO pre_mutilive_room_buy_history (uid,username,room_type_id,dateline,endtime,buy_state) values ('$uid','$username','$roomlevel','$start_time','$end_time','1')");
							$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg) values 
								('$uid','$username','1','用户 $username 上月消耗火币$room_total_huocoin  申请多功能直播厅 级别为 $roomlevel (所需火币消耗量$room_level_huocoin). 成功')");
						}
						else {//续签，则入事件表
							$start_time = $expire_time+1;
							$end_time = strtotime('+1 month', $start_time);
							$sql = "INSERT INTO `pre_mutilive_next_pass_event` (`uid`,`username`,`mutillive_room_level`,`start_time`,`end_time`,`root_type`) 
							VALUES ('$uid','$username','$roomlevel','$start_time','$end_time','1')";
							$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg) values 
								('$uid','$username','1','用户 $username 申请多功能直播厅 级别为 $roomlevel 生效日期：".getLocalTimeStr($start_time)."过期日期:".getLocalTimeStr($end_time)."  成功')");
							$dblink->query($sql);
						}
					}
				}
			}else {
				return g('套餐正在使用中！','/home.php?mod=huoshow&do=apply_room&room_id='.$uid);
			}
		}
		//判断其魅力值和财富值是否满足要求
		$dblink->dbclose();
		return getR(true);
	}
	

	/**
	 *	某用户购买一个多人直播间 - 通过收费的方式
	 *
	 * @param unknown_type $uid					申请的用户ID
	 * @param unknown_type $roomlevel			申请的房间等级
	 * @param unknown_type $username			用户名
	 * @param unknown_type $timelevel			（1，一个月；2，一个季度；3，一年）
	 */
	static public function createMutiliveRoomPaySimple($uid,$roomlevel,$username,$timelevel)
	{
		//目前只允许按一个月，一个季度，一年这样的方式购买
		if(!is_numeric($timelevel) || $timelevel<1)
			return getR(false,"购买时间类型异常");
		$dblink = new DataBase("");
		//判断是否是巡管
		$isAdmin = MutiliveRoom::getIsTourTube($uid);
		if($isAdmin == true){
			return g('您是巡管，不允许此操作！','/home.php?mod=huoshow&do=apply_room&room_id='.$uid);
		}else {
			//判断是否连续购买或者免费续费，如果连续购买则提示本套餐正在使用中
			$IsContinuousBuy = MutiliveRoom::getIsContinuousBuy($uid);
			if ($IsContinuousBuy == 0) {
				//获得相应房间等级需要的火币数
				$sql = "SELECT huocoin_month,huocoin_quarter,huocoin_year FROM pre_mutilive_room_type WHERE `level`='$roomlevel'";
				$dbarr = $dblink->getRow($sql);
				if(count($dbarr)==0)
					return getR(false,"房间等级异常");
				switch ($timelevel)
				{
					case 1:
						$huoCoin = $dbarr[0]["huocoin_month"];
						$apptime = "+1 month";
						break;
					case 2:
						$huoCoin = $dbarr[0]["huocoin_quarter"];
						$apptime = "+3 month";
						break;
					case 3:
						$huoCoin = $dbarr[0]["huocoin_year"];
						$apptime = "+12 month";
						break;
				}
				//查看用户火币数
				$sql = "select showcoin from pre_ucenter_showcoin where uid='$uid'";
				$dbarr = $dblink->getRow($sql);
				$user_showcoin = empty($dbarr[0]["showcoin"])?0:$dbarr[0]["showcoin"];
				if($user_showcoin<$huoCoin)
					return getR(false,"火币不足以购买此房间");		
				//查看用户是否已经拥有多人直播间，如果有，查看过期时间是否已经到期，如果没有到期，则入事件表
				$sql = "SELECT `dateline`,`expire_time` FROM `pre_multilive_room` WHERE uid='$uid'";
				$dbarr = $dblink->getRow($sql);
				$starttime =  getCurrentTimeZone();
				if(count($dbarr)==0) {
					$endtime = strtotime($apptime, $starttime);
					$dblink->query("INSERT INTO pre_multilive_room (roomid,room_name,room_class_id,room_type,available,uid,username,stat,dateline,expire_time) values ('$uid','$username','$roomlevel','2','1','$uid','$username','1','$starttime','$endtime')");
					$dblink->query("INSERT INTO pre_mutilive_room_buy_history (uid,username,room_type_id,dateline,endtime,
						buy_state) values ('$uid','$username','$roomlevel','$starttime','$endtime','1')");
					$dblink->query("UPDATE `pre_ucenter_showcoin` SET showcoin=showcoin-$huoCoin,consume='$huoCoin' where uid='$uid'");
					//添加购买多人房间记录为显示购买房间名称
					$sql = "select room_type_name from pre_mutilive_room_type where level='$roomlevel'";
					$room_type_name = $dblink->getRow($sql);
					//MutiliveRoom::SIPHuoShowinsert($uid,'BMR',$huoCoin,'购买级别为'.$roomlevel.'的多音频房间');
					MutiliveRoom::SIPHuoShowinsert($uid,'BMR',$huoCoin,'购买'.$room_type_name[0]['room_type_name'].'多音频房间');
					$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg) values 
							('$uid','$username','2','用户 $username   购买多功能直播厅 级别为 $roomlevel (所需火币$huoCoin). 成功')");
				}else {
					if($dbarr[0]["expire_time"]<$starttime) //已经过期
					{
						$endtime = strtotime($apptime, $starttime);
						$dblink->query("update pre_multilive_room set room_class_id='$roomlevel',room_type='2',available='1',
							uid='$uid',username='$username',stat='1',expire_time='$endtime' where uid='$uid'");
						$dblink->query("INSERT INTO pre_mutilive_room_buy_history (uid,username,room_type_id,dateline,endtime,
							buy_state) values ('$uid','$username','$roomlevel','$starttime','$endtime','1')");
						$dblink->query("UPDATE `pre_ucenter_showcoin` SET showcoin=showcoin-$huoCoin,consume='$huoCoin' where uid='$uid'");
						MutiliveRoom::SIPHuoShowinsert($uid, 'BMR', $huoCoin,'购买多音频房间');
						$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg) values 
								('$uid','$username','2','用户 $username 购买多功能直播厅 级别为 $roomlevel 生效日期：".getLocalTimeStr($start_time)."过期日期:".getLocalTimeStr($endtime)."  成功')");
					}else {
						$starttime = $dbarr[0]["expire_time"];
						$endtime = strtotime($apptime, $starttime);
						$sql = "INSERT INTO `pre_mutilive_next_pass_event` (`uid`,`username`,`mutillive_room_level`,`start_time`,`end_time`,`root_type`) 
							VALUES ('$uid','$username','$roomlevel','$starttime','$endtime','2')";
						$dblink->query($sql);
						$dblink->query("UPDATE `pre_ucenter_showcoin` SET showcoin=showcoin-$huoCoin,consume='$huoCoin' where uid='$uid'");
						//添加购买多人房间记录为显示购买房间名称
						$sql = "select room_type_name from pre_mutilive_room_type where level='$roomlevel'";
						$room_type_name = $dblink->getRow($sql);
						//MutiliveRoom::SIPHuoShowinsert($uid,'BMR',$huoCoin,'购买级别为'.$roomlevel.'的多音频房间');
						MutiliveRoom::SIPHuoShowinsert($uid,'BMR',$huoCoin,'购买'.$room_type_name[0]['room_type_name'].'多音频房间');
						$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg) values 
								('$uid','$username','2','用户 $username 购买多功能直播厅 级别为 $roomlevel 生效日期：".getLocalTimeStr($starttime)."过期日期:".getLocalTimeStr($endtime)."  成功')");
					}
				}
			}else {
				return g('套餐正在使用中！','/home.php?mod=huoshow&do=apply_room&room_id='.$uid);
			}
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	
	
	/**
	 * 某用户购买一个多人直播间 - 通过收费的方式
	 *
	 * @param unknown_type $uid				申请的用户ID
	 * @param unknown_type $roomlevel		申请的房间等级
	 * @param unknown_type $username		申请的用户名
	 * @param unknown_type $starttime		房间开通的开始时间
	 * @param unknown_type $endtime			房间过期时间
	 */
	static public function createMutiliveRoomPay($uid,$roomlevel,$username,$starttime,$endtime)
	{
		//查看当前房间需要的货币数
		//一年期有优惠，一季度有优惠，假设一用户购买一年又4个月，如何计费？
		$time =  getCurrentTimeZone();
		if($starttime<$time || !is_numeric($starttime) || !is_numeric($endtime) || $starttime>$endtime)
			return getR(false,"开始时间或者结束时间异常");
		$huoCoin = MutiliveRoom::getPayMutilRoomHuoCoin($roomlevel,$starttime,$endtime);
		dieErr($huoCoin);
		$dblink = new DataBase("");
		//查看用户火币数
		$sql = "select showcoin from pre_ucenter_showcoin where uid='$uid'";
		$dbarr = $dblink->getRow($sql);
		$user_showcoin = empty($dbarr[0]["showcoin"])?0:$dbarr[0]["showcoin"];
		if($user_showcoin<$huoCoin)
			return getR(false,"火币不足以购买此房间");
		date_default_timezone_set("Asia/Shanghai");
		//查看用户是否已经拥有多人直播间，如果有，查看过期时间是否已经到期，如果没有到期，则入事件表
		$sql = "SELECT `dateline`,`expire_time` FROM `pre_multilive_room` WHERE uid='$uid'";
		$dbarr = $dblink->getRow($sql);
		if(count($dbarr)==0)
		{
				$dblink->query("INSERT INTO pre_multilive_room (roomid,room_class_id,room_type,available,uid,username,stat,
					dateline,expire_time) values ('$uid','$roomlevel','2','1','$uid','$username','1','$starttime','$endtime')");
				$dblink->query("INSERT INTO pre_mutilive_room_buy_history (uid,username,room_type_id,dateline,endtime,
					buy_state) values ('$uid','$username','$roomlevel','$start_time','$endtime','1')");
				$dblink->query("UPDATE `pre_ucenter_showcoin` SET showcoin=showcoin-$huoCoin,consume='$huoCoin' where uid='$uid'");
				$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg) values 
						('$uid','$username','2','用户 $username   购买多功能直播厅 级别为 $roomlevel (所需火币$huoCoin). 成功')");

		}
		else 
		{
			if($dbarr[0]["expire_time"]<$starttime) //已经过期
			{
				$dblink->query("update pre_multilive_room set room_class_id='$roomlevel',room_type='2',available='1',
					uid='$uid',username='$username',stat='1',dateline='$starttime',expire_time='$endtime' where uid='$uid'");
				$dblink->query("INSERT INTO pre_mutilive_room_buy_history (uid,username,room_type_id,dateline,endtime,
					buy_state) values ('$uid','$username','$roomlevel','$start_time','$endtime','1')");
				$dblink->query("UPDATE `pre_ucenter_showcoin` SET showcoin=showcoin-$huoCoin,consume='$huoCoin' where uid='$uid'");
				$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg) values 
						('$uid','$username','2','用户 $username 购买多功能直播厅 级别为 $roomlevel 生效日期：".getLocalTimeStr($start_time)."过期日期:".getLocalTimeStr($endtime)."  成功')");

			}
			else 
			{
				$sql = "INSERT INTO `pre_mutilive_next_pass_event` (`uid`,`username`,`mutillive_room_level`,`start_time`,`end_time`,`root_type`) 
					VALUES ('$uid','$username','$roomlevel','$start_time','$endtime','2')";
				$dblink->query($sql);
				$dblink->query("UPDATE `pre_ucenter_showcoin` SET showcoin=showcoin-$huoCoin,consume='$huoCoin' where uid='$uid'");
				$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg) values 
						('$uid','$username','2','用户 $username 购买多功能直播厅 级别为 $roomlevel 生效日期：".getLocalTimeStr($start_time)."过期日期:".getLocalTimeStr($endtime)."  成功')");

			}
		}
		
		$dblink->dbclose();
		return getR(true);
	}
	
	
	/**
	 * 系统管理员给指定用户开通多人直播间
	 * @param unknown_type $uid					申请的用户ID
	 * @param unknown_type $roomlevel			申请的房间等级
	 * @param unknown_type $username			用户名
	 * @param unknown_type $timelevel			（1，一个月；2，二个月；3，一季度）
	 * @param unknown_type $admin_uid			系统管理员UID
	 */
	static public function createMutiliveRoomSpecifiedUser($uid,$roomlevel,$username,$timelevel,$admin_uid)
	{
		if(!is_numeric($timelevel) || $timelevel<1)
			return getR(false,"购买时间类型异常");
		switch ($timelevel)
		{
			case 1:
				$apptime = "+1 month";
				break;
			case 2:
				$apptime = "+2 month";
				break;
			case 3:
				$apptime = "+3 month";
				break;
		}
		$starttime =  getCurrentTimeZone();
		$dblink = new DataBase("");
		date_default_timezone_set("Asia/Shanghai");
		//查看用户是否已经拥有多人直播间，如果有，查看过期时间是否已经到期，如果没有到期，则入事件表
		$sql = "SELECT `dateline`,`expire_time` FROM `pre_multilive_room` WHERE uid='$uid'";
		$dbarr = $dblink->getRow($sql);
		if(count($dbarr)==0) {
			$endtime = strtotime($apptime, $starttime);
			$dblink->query("INSERT INTO pre_multilive_room (roomid,room_name,room_class_id,room_type,available,uid,username,stat,
					dateline,expire_time) values ('$uid','$username','$roomlevel','1','1','$uid','$username','1','$starttime','$endtime')");
			$dblink->query("INSERT INTO pre_mutilive_room_buy_history (uid,username,room_type_id,dateline,endtime,
					buy_state) values ('$uid','$username','$roomlevel','$starttime','$endtime','1')");
			//$dblink->query("UPDATE `pre_ucenter_showcoin` SET showcoin=showcoin-$huoCoin,consume='$huoCoin' where uid='$uid'");
			//添加购买多人房间记录为显示购买房间名称
			$sql = "select room_type_name from pre_mutilive_room_type where level='$roomlevel'";
			$room_type_name = $dblink->getRow($sql);
			//MutiliveRoom::SIPHuoShowinsert($uid,'BMR',$huoCoin,'购买级别为'.$roomlevel.'的多音频房间');
			//MutiliveRoom::SIPHuoShowinsert($uid,'BMR',$huoCoin,'购买'.$room_type_name[0]['room_type_name'].'多音频房间');
			$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg,admin_uid) values
					('$uid','$username','6','系统管理员为指定用户购买房间','$admin_uid')");
			echo "系统管理员为指定用户($uid)赠送房间成功！";
		} else {
// 		echo "指定用户多功能房间已存在！";
		//return g('指定用户多功能房间已存在！','/');
			if($dbarr[0]["expire_time"]<$starttime) //已经过期
			{
				$endtime = strtotime($apptime, $starttime);
				$dblink->query("update pre_multilive_room set room_class_id='$roomlevel',room_type='1',available='1',
					uid='$uid',username='$username',stat='1',expire_time='$endtime' where uid='$uid'");
				$dblink->query("INSERT INTO pre_mutilive_room_buy_history (uid,username,room_type_id,dateline,endtime,
					buy_state) values ('$uid','$username','$roomlevel','$starttime','$endtime','1')");
				$dblink->query("INSERT INTO pre_mutilive_site_msg (src_uid,src_username,msg_state,msg,admin_uid) values 
						('$uid','$username','6','系统管理员为指定用户购买房间','$admin_uid')");
			}else
			{
				echo "指定用户($uid)多功能房间已存在！";
		
			}
		}
		$dblink->dbclose();
		return getR(true);
		}
	
	
	/**
	 * 获得购买某等级的多人直播间需要的火币数
	 * 一年期有优惠，一季度有优惠，假设一用户购买一年又4个月，如何计费？
	 *
	 * @param unknown_type $roomlevel		房间等级
	 * @param unknown_type $starttime		开始时间
	 * @param unknown_type $endtime			过期时间
	 */
	static public function getPayMutilRoomHuoCoin($roomlevel,$starttime,$endtime)
	{
		//根据目前的规则
		//购买的房间只能为一个月、一个季度、一年
		//$starttime,$endtime由外部函数算出开始和结束的时间
		//这个需要验证时间是否是一个月、一个季度、一年
		//如果跨月，一个月算多少天？
		die("给定时间范围的 获得购买某等级的多人直播间需要的火币数 功能为实现");
	}
	
	/**
	 * 获得某多人直播间消耗的货币总额
	 *
	 * @param unknown_type $roomid 房间ID
	 */
	static public function getMutilRoomExpendHuoCoin($roomid)
	{
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		$sql = "select gift_huocoid_sum from  pre_multilive_room_log where roomid='$roomid'";
		$dblink = new DataBase("");
		$tmpArr = $dblink->getRow($sql);
		$huocoin_num = $tmpArr[0]["gift_huocoid_sum"];
		$dblink->dbclose();
		return  empty($huocoin_num)?0:$huocoin_num;
	}
	
	/**
	 * 获得某时间段内某房间消耗的货币总额
	 *
	 * @param unknown_type $roomid 		房间ID
	 * @param unknown_type $starttime	开始时间
	 * @param unknown_type $endtime		结束时间
	 */
	static public function getMutilRoomExpendHuoCoinTime($roomid,$starttime,$endtime)
	{
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		if(empty($starttime) || !is_numeric($starttime) || $starttime<1)
			return getR(false,"开始时间格式错误");
		if(empty($endtime) || !is_numeric($endtime) || $endtime<1)
			return getR(false,"结束时间格式错误");	
		$sql = "select sum(gift_huocoid_sum) as gift_huocoid_sum from  pre_multilive_room_log where roomid='$roomid' 
			and start_time>'$starttime' and end_time<'$endtime'";
		$dblink = new DataBase("");
		$tmpArr = $dblink->getRow($sql);
		$huocoin_num = $tmpArr[0]["gift_huocoid_sum"];
		$dblink->dbclose();
		return  empty($huocoin_num)?0:$huocoin_num;		
	}
	

	/**
	 * 获得某个多人直播间送礼最多的排行榜(粉丝榜)
	 *
	 * @param unknown_type $roomid			房间ID
	 * @param unknown_type $starttime		开始时间 -1代表没有开始时间，否则为时间戳
	 * @param unknown_type $endtime			结束时间 -1代表没有结束时间，否则为时间戳
	 */
	static public function getMutilRoomSendMaxGiftList($roomid,$num,$starttime=-1,$endtime=-1)
	{
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		if ($starttime == -1 && $endtime == -1) {
			$sql = "SELECT a.uid,a.username, IF(m.nickname!='',m.nickname,m.username) AS nickname,SUM(a.giftprice*a.num) AS price
FROM pre_multilive_gift_log a LEFT JOIN pre_common_member m ON m.uid=a.uid WHERE a.roomid=$roomid AND a.action = 1 GROUP BY a.username ORDER BY price DESC LIMIT $num";
			$dblink = new DataBase("");
			$giftlist = $dblink->getRow($sql);
			for ($i=0;$i<count($giftlist);$i++){
				$giftlist[$i]["avatar"] = getLiveHead($giftlist[$i]["uid"],'middle');
			}
			$dblink->dbclose();
			return $giftlist;
		}
		
			
	}
	
	/**
	 * 获得某个多人直播间占麦时间排行榜
	 *
	 * @param unknown_type $roomid		房间ID
	 * @param unknown_type $starttime	开始时间 -1代表没有开始时间，否则为时间戳
	 * @param unknown_type $endtime		结束时间 -1代表没有结束时间，否则为时间戳
	 */
	static public function getMutilRoomMicKingList($roomid,$num,$starttime=-1,$endtime=-1)
	{
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		if ($starttime == -1 && $endtime == -1) {
			$sql = "SELECT a.uid,a.username,a.mic_num,IF(m.nickname!='',m.nickname,m.username) AS nickname,SUM(a.mic_endtime-a.mic_starttime) time FROM pre_mutilive_usemic_log a LEFT JOIN pre_common_member m ON m.uid=a.uid
WHERE a.mic_endtime!=0 AND a.roomid=$roomid GROUP BY a.uid ORDER BY TIME DESC LIMIT $num";
			$dblink = new DataBase("");
			$mickinglist = $dblink->getRow($sql);
			for ($i=0;$i<count($mickinglist);$i++){
				$mickinglist[$i]["time"] = MutiliveRoom::getTimeShowShape($mickinglist[$i]["time"]);
				$mickinglist[$i]["avatar"] = getLiveHead($mickinglist[$i]["uid"],'middle');
			}
			$dblink->dbclose();
			return $mickinglist;
			
		}
	}
	
	
	/**
	 * 获得礼物列表
	 *
	 */
	static public function getGiftList()
	{
		
	}

	/**
	 * 多音频房间个人动态信息
	 *
	 * @param unknown_type $roomid
	 * @return unknown
	 */
	static public function RoomPersonalDynamic(){
		$huoshowSys = HuoshowSys::instance();
		if ($huoshowSys->getCurrentEmbedEnv() == "dz") {
			require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/module/dz_ext/source/module/show/show_mutilive_dynamic.php");
		}else {
			echo '暂未开发！！！';
		}
	}
	
	/**
	 * 总时间显示
	 *
	 * @param unknown_type $totalTime
	 * @return unknown
	 */
	static public function getTotalTimeShow($totalTime) {
		$hours = floor($totalTime/3600);
		$minutes = floor(($totalTime%3600)/60);
		$seconds = $totalTime%60;
		$alwaysTime_str = $hours.'小时'.$minutes.'分'.$seconds.'秒';
		return $alwaysTime_str;
	}
	
	/**
	 * 另外的一种形式显示时间
	 *
	 * @param unknown_type $time
	 */
	static public function getTimeShowShape($time){
		$hours = floor($time/3600);
		$minutes = floor(($time%3600)/60);
		$seconds = $time%60;
		$alwaysTime_str = $hours.'<span style="color:#ccc">°</span>'.$minutes.'<span style="color:#ccc">′</span>'.$seconds.'<span style="color:#ccc">"</span>';
		return $alwaysTime_str;
	}
	
	/**
	 * 获取房间类型
	 *
	 */
	static public function getRoomTypeName(){
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_mutilive_room_type";
		$roomTypeArr = $dblink->getRow($sql);
		$dblink->dbclose();
		return $roomTypeArr;
	}
	
	/**
	 * 查询是否已有多音频房间记录
	 *
	 * @param unknown_type $uid
	 */
	static public function getIsMutilLiveRoom($uid){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_multilive_room WHERE roomid=$uid ";
		$isMutilLive = $dblink->getRow($sql);
		$dblink->dbclose();
		return  empty($isMutilLive) ? 0:$isMutilLive;
	}
	
	/**
	 * 获得$endime这个时间的前一个月火币消耗总额
	 *
	 * @param unknown_type $roomid			房间ID
	 * @param unknown_type $endime			套餐结束的时间戳
	 */
	static public function getPreMonthPayHuoCoin($roomid,$endtime){
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"uid格式错误");
		if(empty($endtime) || !is_numeric($endtime) || $endtime<1)
			return getR(false,"套餐结束格式错误");	
		$dblink = new DataBase("");
		//本月
		$thatmonth = time();
		//上月
		$lastmonth = strtotime('-1 month', $endtime);
		//下月
		$nextmonth = strtotime('+1 month', $endtime);
		//如果到期时间小于上月起始时间并大于下月结束时间，则不在时间范围内
		if ($thatmonth < $lastmonth || $thatmonth > $nextmonth) {
			return -1;//不在时间范围内
		}else {
			$sql = "SELECT SUM(gift_huocoid_sum) as gift_huocoid_sum FROM pre_multilive_room_log WHERE roomid='$roomid' 
			AND start_time>'$lastmonth' AND end_time<'$endtime'";
		}
		$PreMonthArr = $dblink->getRow($sql);
		$PreMonthPayHuoCoin = $PreMonthArr[0]["gift_huocoid_sum"];
		$dblink->dbclose();
		return  empty($PreMonthPayHuoCoin) ? 0 : $PreMonthPayHuoCoin;
	}
	
	/**
	 * 获取事件表是否有记录，有了数据则不能再次购买
	 *
	 * @param unknown_type $roomid
	 * @return unknown
	 */
	static public function getIsContinuousBuy($roomid){
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_mutilive_next_pass_event WHERE uid=$roomid";
		$IsContinuousBuy = $dblink->getRow($sql);
		$dblink->dbclose();
		return  empty($IsContinuousBuy) ? 0 : $IsContinuousBuy;
	}
	
	/**
	 * 获取是否有过申请多音频房间记录
	 *
	 * @param unknown_type $uid
	 */
	static public function getPurchaseRecords($uid){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_mutilive_room_buy_history WHERE uid=$uid ";// AND buy_state=1";
		$records = $dblink->getRow($sql);
		$dblink->dbclose();
		return  empty($records) ? 0 : $records;
	}
	

	/**
	 * 判断是否是巡管,$isAdmin=true为巡管
	 *
	 * @param unknown_type $uid
	 */
	static public function getIsTourTube($uid){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT uid FROM pre_live_admin";
		$dbAdmin = $dblink->getRow($sql);
		$isAdmin = false;
		for ($i=0;$i<count($dbAdmin);$i++){
			$dbAdmin[$i]["uid"] = $dbAdmin[$i]["uid"];
			if($uid == $dbAdmin[$i]["uid"])
				$isAdmin = true;
		}
		$dblink->dbclose();
		return $isAdmin;
	}
	
	
	/**
	 * 得到用户的火币数 huocoin
	 * 消费火币数 consume
	 * @param unknown_type $uid
	 */
	static public function getUserHuoMoney($uid){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT showcoin AS huocoin,consume AS consume FROM pre_ucenter_showcoin WHERE uid=$uid";
		$HuoMoney = $dblink->getRow($sql);
		$dblink->dbclose();
		return  empty($HuoMoney) ? 0 : $HuoMoney;
	}
	
	/**
	 * 得到用户的魅力值 charm
	 * @param unknown_type $uid
	 */
	static public function getUserCharm($uid){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT charm FROM pre_live_member_count WHERE uid=$uid";
		$HuoCharm = $dblink->getRow($sql);
		$dblink->dbclose();
		return  empty($HuoCharm) ? 0 : $HuoCharm;
	}
	
	/**
	 * 购买房间以后插入记录到数据表
	 *
	 * @param unknown_type $uid	
	 * @param unknown_type $operation 交易动作
	 * @param unknown_type $amount  交易金额
	 * @param unknown_type $remark  交易备注
	 * @return unknown
	 */
	static public function SIPHuoShowinsert($uid, $operation, $amount=0, $remark=''){
		if (!empty($uid) && !empty($operation)) {
			$balance = MutiliveRoom::getUserHuoMoney($uid);#余额
			$balance = $balance[0]["huocoin"];
			$time = getCurrentTimeZone();
			$dblink = new DataBase("");
			$sql = "INSERT INTO pre_ucenter_showcoin_log (`uid`,`operation`,`dateline`,`amount`,`type`,`remark`,`balance`) VALUES ($uid,'$operation',$time,'$amount','out','$remark',$balance)";
			$dblink->query($sql);
		}else {
			return false;
		}
	}
	
	/**
	 * 获取房间是否到期
	 *
	 * @param unknown_type $roomid		房间ID
	 * @return unknown
	 */
	static public function getRoomExpired($roomid){
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		//获得当前时间戳
		$time = getCurrentTimeZone();
		$sql = "SELECT * FROM pre_multilive_room WHERE roomid=$roomid LIMIT 1";
		$RoomExpired = $dblink->getRow($sql);
		//如果当前时间大于到期时间，1为到期，0为未过期
		if ($time > $RoomExpired[0]["expire_time"]) {
			return 1;
		}else {
			return 0;
		}
	}
	/**
	 * 多人直播间开放测试开关
	 * 得到用户uid
	 */
	static public function getUidAllow($uid){
		//if(empty($uid) || !is_numeric($uid) || $uid<1)
			//return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT config_value FROM pre_mutilive_config WHERE config_name LIKE 'mutil_room_test'";
		$mutilive_config = $dblink->getRow($sql);
		if(!empty($uid)) {	
			if (!is_numeric($uid) || $uid<1) {
				return getR(false,"uid格式错误");
			}
			$sql = "SELECT uid FROM pre_mutilive_allow_user_list WHERE uid=$uid";
			$mutilive_allowuser = $dblink->getRow($sql);
		}		
		//判断是否开启测试
		if ($mutilive_config[0]['config_value'] == 0 || ($mutilive_config[0]['config_value'] == 1 && $mutilive_allowuser[0]['uid'] != "")) {
			return 1;//1为开放测试
		}else {
			return 0;
		}
		$dblink->dbclose();
		
	}
	/**
	 * 房间到期后，判断是否有购买或续费过套餐
	 *
	 * @param unknown_type $roomid
	 * @return unknown
	 */
	
	static public function getBuyEvent($roomid,$type) {
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"uid格式错误");
			$dblink = new DataBase("");
		//判断是否到期
		$expire_time = MutiliveRoom::getRoomExpired($roomid);
		//判断房间到期查看事件表是否有记录
		$IsContinuousBuy = MutiliveRoom::getIsContinuousBuy($roomid);
		date_default_timezone_set("Asia/Shanghai");
		$time = time();
		//获取用户相关信息
		$user = UserApi::getUserInfo($roomid);
		$room_log = MutiliveRoom::RoomIsActivated($roomid);
		if ($room_log == 0) {
			//$room_log 为0，则为房间没激活，新增pre_multilive_room_log表记录
			$dblink->query("INSERT INTO pre_multilive_room_log (roomid,activate_uid,activate_username,start_time) VALUES ('".$roomid."','".$user[0]['uid']."','".$user[0]['username']."','".$time."')");
			
			//发送多人直播间激活房间相关信息
			$data = array(
			'uid' => $user[0]['uid'],
			'type' => $type,
			'username' => $user[0]['username'],
			'roomid' => $roomid,
			'date' => $time,
			);
			//$cmd_body = '021'.json_encode($data);
			//socketSendData(LOCAL_HOST, LOCAL_PORT, encodeCommand($cmd_body, 6));
			MutilLiveRoomSocketApi::sendMutiliveRoominfo($data);
//			LiveRoomSocketApi::sendMutiliveRoominfo($data);
		}		
		if ($expire_time ==1 && $IsContinuousBuy !=0 && $time >= $IsContinuousBuy[0]['start_time']) {
			//$expire_time ==1为房间到期，$IsContinuousBuy !=0为事件表有记录
			$mutilroombuyevent = MutiliveRoom::MutilRoomBuyEvent($roomid);
			if ($mutilroombuyevent !=0)
			return 1;
		}else {
			return 0;
		}
	}
		
		
	//}
	/**
	 * 对已经购买多人直播间但由于之前直播间还没有到期而进入日志表的
	 * 记录进行扫描，如果时间到，则进行相关的购买动作
	 * 包括修改多人直播间的类型、
	 *
	 * @author badroom
	 * @package defaultPackage
	 */
	static public function MutilRoomBuyEvent($roomid) {

		$dblink = new DataBase("");
		if (!empty($roomid)) {
		$sql = "SELECT id,uid,username,mutillive_room_level,start_time,end_time,root_type FROM pre_mutilive_next_pass_event WHERE uid=".$roomid;
		$dbarr = $dblink->getRow($sql);
				$dblink->query("update pre_multilive_room set room_class_id='".$dbarr[0]["mutillive_room_level"]."',room_type='".$dbarr[0]["root_type"]."',available='1',uid='".$dbarr[0]["uid"]."',username='".$dbarr[0]["username"]."',stat='1',ismsg='0',expire_time='".$dbarr[0]["end_time"]."' where uid='".$dbarr[0]["uid"]."'");
				$dblink->query("INSERT INTO pre_mutilive_room_buy_history (uid,username,room_type_id,dateline,endtime,buy_state) VALUES ('".$dbarr[0]["uid"]."','".$dbarr[0]["username"]."','".$dbarr[0]["mutillive_room_level"]."','".$dbarr[0]["start_time"]."','".$dbarr[0]["end_time"]."','".$dbarr[0]["root_type"]."')");
				$dblink->query("DELETE FROM pre_mutilive_next_pass_event WHERE id='".$dbarr[0]["id"]."'");
			return 1;
		}else {
			return 0;
		}
		$dblink->dbclose();
	}
	/**
	 * 进入房间操作
	 */
	static public function MutilRoomJoin($uid,$roomid){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		$dblink = new DataBase("");
		//$userlist = MutilLiveRoomSocketApi::sendRoomUsersList($roomid);//获取用户列表
		//获取用户相关信息
		$user = UserApi::getUserInfo($uid);
		$room_log = MutiliveRoom::RoomIsActivated($roomid);
		date_default_timezone_set("Asia/Shanghai");
		$time = time();
		$year = date('Y');//获取年份
		$month = date('n');//获取月份
		$date = date('j');//获取日期
		$IsManager = MutiliveRoom::RoomIsManager($uid,$roomid);//1为房间管理员
		if (($room_log == 0 && $uid == $roomid) || ($room_log == 0 && $IsManager == 1)) {
			//$room_log 为0，则为房间没激活，新增pre_multilive_room_log表记录
			$dblink->query("INSERT INTO pre_multilive_room_log (roomid,activate_uid,activate_username,start_time) VALUES ('".$roomid."','".$user[0]['uid']."','".$user[0]['username']."','".$time."')");
		}
		//进入多人直播间房间，已经登录则插入pre_mutilive_person_room_time表记录
		if (!empty($uid) && !empty($roomid)) {
			$dblink->query("INSERT INTO pre_mutilive_person_room_time (roomid,uid,username,date_year,date_month,date_day,starttime) VALUES ('".$roomid."','".$user[0]['uid']."','".$user[0]['username']."','".$year."','".$month."','".$date."','".$time."')");
		}
		$dblink->dbclose();
	}
	
	/**
	 * 查看房间是否激活,0为没激活，1为激活
	 * @param unknown_type $roomid  房间ID
	 */
	static public function RoomIsActivated($roomid){
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_multilive_room_log WHERE roomid=$roomid AND end_time = 0 ORDER BY id DESC LIMIT 1";
		$IsActivated = $dblink->getRow($sql);
		$IsActivated = empty($IsActivated) ? 0 : 1;
		MutiliveRoom::RoomActivationOrClose($IsActivated,$roomid);
		return $IsActivated;
		$dblink->dbclose();
	}
	
	/**
	 * 找出所有没有关闭的房间，并调用关闭成员函数
	 *
	 */
	static public function getRoomNoToClose(){
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_multilive_room_log WHERE end_time = 0 ORDER BY id";
		$Room_arr = $dblink->getRow($sql);
		for ($i=0;$i<count($Room_arr);$i++){
			MutiliveRoom::RoomActivationOrClose(0,$Room_arr[$i]["roomid"]);
		}
	}
	
	/**
	 * 房间激活或关闭成员函数
	 *
	 * @param unknown_type $IsActivated   
	 *  	0	为关闭房间,修改pre_multilive_room表，stat为0
	 * 		1	为激活房间,修改pre_multilive_room表，stat为1
	 * @param unknown_type $roomid  房间ID
	 */
	static public function RoomActivationOrClose($IsActivated,$roomid){
		$dblink = new DataBase("");
		if ($IsActivated == '1'){
			$sql = "UPDATE pre_multilive_room SET stat='1' WHERE roomid=$roomid";
		}else {
			$sql = "UPDATE pre_multilive_room SET stat='0' WHERE roomid=$roomid";
		}
		$dblink->query($sql);
	}

	/**
	 * 判断是否是房间管理员
	 */
	static public function RoomIsManager($uid,$roomid){
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_mutilive_room_manager WHERE roomid=$roomid AND uid=".$uid;
		$IsManager = $dblink->getRow($sql);
		return empty($IsManager) ? 0 : 1;
	}
	
	/**
	 * 获取用户类型
	 * 	1:巡管 2:主播 3:管理 4:观众 5:游客
	 * @param unknown_type $uid  用户ID
	 * @param unknown_type $roomid  主播ID
	 */
	static public function getUserType($uid,$roomid){
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return 5;
		$dblink = new DataBase("");
		//查看是不是巡管
		$sql = "SELECT uid,username FROM pre_live_admin WHERE uid=$uid";
		$tourtube = $dblink->getRow($sql);
		$sql = "SELECT uid,username FROM pre_multilive_room WHERE roomid=$roomid AND uid=$roomid";
		$anchor = $dblink->getRow($sql);
		//查看是不是管理员
		$sql = "SELECT uid,username FROM pre_mutilive_room_manager WHERE roomid=$roomid";
		$administrator = $dblink->getRow($sql);
		for ($i=0;$i<count($administrator);$i++){
			$administrator[$i]["uid"] = $administrator[$i]["uid"];
			if ($uid == $administrator[$i]["uid"]){
				return 3;
			}
		}
		//echo $admin_uid;
		//查看是不是普通用户
		$sql = "SELECT uid,username FROM pre_common_member WHERE uid=$uid";
		$ordinaryusers = $dblink->getRow($sql);
		if ($uid == $tourtube[0]["uid"]){
			return 1;
		}elseif ($uid == $anchor[0]["uid"]){
			return 2;
		}elseif ($uid == $ordinaryusers[0]["uid"]){
			return 4;
		}
		$dblink->dbclose();
	}
	
	
	/**
	 * 查看用户是否有多人房，并且是没有过期
	 *
	 */
	static public function getUserIsMutilLiveRoom($uid){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		date_default_timezone_set("Asia/Shanghai");
		$time = time();
		$sql = "SELECT * FROM pre_multilive_room WHERE uid=$uid AND expire_time > $time";
		$IsUserRoom = $dblink->getRow($sql);
		return empty($IsUserRoom) ? 0 : 1;
		$dblink->dbclose();
	}
	
	/**
	 * 获取房主管理员列表
	 *
	 * @param unknown_type $roomid
	 */
	static public function getRoomAdminList($roomid){
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		$dblink = new DataBase("");
		$roomuser = UserApi::getUserName($roomid);
		$sql = "SELECT uid,username FROM pre_mutilive_room_manager WHERE roomid=$roomid";
		$RoomAdminList = $dblink->getRow($sql);
		$userlist = array();
		$roomuser[0]["usertype"] = 2;
		$roomuser[0]["username"] = $roomuser[0]["nickname"];
		$userlist[] = $roomuser[0];
		for ($i=0;$i<count($RoomAdminList);$i++){
			$RoomAdminList[$i]["usertype"] = 3;
			$userlist[] = $RoomAdminList[$i];
		}
		return json_encode($userlist);
		$dblink->dbclose();
	}
	

	/**
	 * 根据多人直播间到期事件表的记录来修改房间相关信息
	 *
	 * @param unknown_type $rid	房间ID
	 */
	static public function changeRoomInfoFromEvent($rid)
	{
		$dblink = new DataBase("");
		$sql = "SELECT a.roomid,b.* FROM pre_multilive_room a LEFT JOIN pre_mutilive_next_pass_event b ON a.uid=b.uid WHERE a.roomid=$rid";
		$dbarr = $dblink->getRow($sql);
		$dblink->query("update pre_multilive_room set room_class_id='".$dbarr[0]["mutillive_room_level"]."',room_type='".$dbarr[0]["root_type"]."',available='1',uid='".$dbarr[0]["uid"]."',username='".$dbarr[0]["username"]."',ismsg='0','stat'='1',expire_time='".$dbarr[0]["end_time"]."' where uid='".$dbarr[0]["uid"]."'");
		$dblink->query("INSERT INTO pre_mutilive_room_buy_history (uid,username,room_type_id,dateline,endtime,buy_state) VALUES ('".$dbarr[0]["uid"]."','".$dbarr[0]["username"]."','".$dbarr[0]["mutillive_room_level"]."','".$dbarr[0]["start_time"]."','".$dbarr[0]["end_time"]."','".$dbarr[0]["root_type"]."')");
		//得到更新房间的用户，并发送消息
		$sql = "SELECT a.end_time,b.mic_count,b.people_limit,b.manager_count,(SELECT roomid FROM pre_multilive_room r WHERE r.uid=a.uid) AS roomid 
			FROM pre_mutilive_next_pass_event a LEFT JOIN pre_mutilive_room_type b ON a.mutillive_room_level=b.id WHERE a.uid=".$dbarr[0]["uid"];
		$room_data = $dblink->getRow($sql);
		$data = array(
			'rid' => $room_data[0]["roomid"],
			'miccount' => $room_data[0]["mic_count"],
			'peoplecount' => $room_data[0]["people_limit"],
			'manager' => $room_data[0]["manager_count"],
			'expiretime' => $room_data[0]["end_time"]
		);
		MutilLiveRoomSocketApi::sendMutilLiveParameters($data);
		$dblink->query("DELETE FROM pre_mutilive_next_pass_event WHERE id='".$dbarr[0]["id"]."'");
	}
	
	/**
	 * 活动礼物特殊处理函数
	 *
	 */
	static public function Gift_Present_special($roomid,$srcuid,$srcname,$dstuid,$dstname,$num,$g_image,$g_countent,$g_name,$g_units,$total_price){
		$dblink = new DataBase("");
		$sql = "INSERT INTO pre_live_party_user_box_list SET src_uid='$srcuid',src_username='$srcname',dst_uid='$dstuid',dst_username='$dstname',box_num='$num',state=0";
		$dblink->query($sql);
		$sql = "UPDATE pre_ucenter_showcoin SET showcoin=showcoin-'$total_price' WHERE uid= $srcuid";
		$dblink->query($sql);
		$icon_img = '';
		for ($j=0;$j<$num;$j++){
			$icon_img .= '<img width="70px" height="70" src="/static2/images/gift/'.$g_image.'" />';
		}
		$tmp_str  = str_replace("{sender}",$srcname,$g_countent);
		$tmp_str  = str_replace("{receiver}",$dstname,$tmp_str);
		$tmp_str  = str_replace("{icon}*{num}",$icon_img,$tmp_str);
		$tmp_str  = str_replace("{name}",$g_name,$tmp_str);
		$tmp_str  = str_replace("{num}",$num,$tmp_str);
		$tmp_str  = str_replace("{unit}",$g_units,$tmp_str);
		$data = array(
			'act' => "4",
			'type' => "0",
			'dstroomid' => "$roomid",
			'dstuid' => "$dstuid",
			'msg' => "$tmp_str",
		);
		MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data);
	}
}
?>