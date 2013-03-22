<?php
define('CURSCRIPT', 'apidb');

require '../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();
require_once libfile('function/live');
//初始化数据
$act= $_GET['act'];
$uid = $_G['uid'];
$username = empty($_G['member']['nickname']) ? $_G['username'] : $_G['member']['nickname'];

$debug = true;
$logUrl = dirname(dirname(__FILE__)).'/data/log/zhibo_'.date('Ymd', time()).'.log';

//获得比赛结束时间
if ($act=='getVoteEndTime'){
	
	$roomid = $_GET['roomid'];
	
	####写日志####
	$logMsg = date('Y-m-d H:i:s').':getVoteEndTime - require -'.$roomid;
	$debug && error_log($logMsg."\n", 3, $logUrl);
	####end
	
	if (empty($roomid)) {
		echo 0;
	} else {
		$sumTime = 60*60*4;
		$stime = strtotime(date("Y-m-d 00:00:00"));		
		$time = time();
		
		if ($time >= $stime && ($time <= $stime + $sumTime)) {//如果是到了00:00，则返回0
			echo 0;
		} else {//活动期间
			$lastsql="SELECT sum(totaltime) as sumtime FROM pre_live_roomer_votelog WHERE  uid='$roomid' AND stime>$stime ";
			$lastrs = DB::fetch_first($lastsql);
			$lastTotalTime = $lastrs['sumtime'];
			$thissql = "SELECT stime FROM pre_live_roomer_votelog WHERE etime=0 AND totaltime=0 AND uid='$roomid'";
			
			$thisrs = DB::fetch_first($thissql);
			if(!empty($thisrs)){
				$thisTotalTime = time()-$thisrs['stime'];
				$totalTimeByDay = $thisTotalTime+$lastTotalTime;
			}else{
				$totalTimeByDay = $lastTotalTime;
			}
			$backTime = $sumTime-$totalTimeByDay;
			
			if ($backTime < 0) {//如果为负，则返回0
				echo 0;
			} else {
				
				//修正距离00:00小于4小时引起的时间问题
				$actEndTime = ($stime + 86400 - $time);				
				//end
				
				$backTime = min($backTime, $actEndTime);
				
				####写日志####
				$logMsg = date('Y-m-d H:i:s').':getVoteEndTime - back -'.$roomid.'-'.$backTime;
				$debug && error_log($logMsg."\n", 3, $logUrl);
				####end
				
				echo $backTime;
			}		
		}
	}	
	die();
}

//获取宝箱图片
elseif ($act=='getboximg'){
	$src = '../static/image/randbox/box1.gif';
	header('Location: '.$src);
	die();
}

//获得公告
elseif ($act=='getnotice'){
	
	#页面传递过来的id
	$t = isset($_GET['t']) ? intval($_GET['t']) : 0;
	if ($t < 0) {
		echo '';
	} else {
		#数据库中最新id
		$sql = "SELECT id FROM pre_live_new_notice ORDER BY id DESC limit 1";
		$r = DB::fetch_first($sql);
		$lastId = $r['id'];
		
		//如果传递过来的id大于等于数据库中最新id则返回空，否则大于该id的数据
		if ($t >= $lastId){
			echo '';
		} else {
			$res = array();
			if ($t>0){
				$sql = "SELECT id,notice,dateline FROM pre_live_new_notice WHERE `id`>'$t' ORDER BY id DESC LIMIT 5";
				$query = DB::query($sql);
				$i=0;
				while ($rs = DB::fetch($query)){
					$res[$i]['notice'] = $rs['notice'];
					$res[$i]['time']=date("H:i",$rs['dateline']);
					$i++;
				}
			}
			$array = array('type'=>'notice','notice'=>$res,'t'=>$lastId);
			//print_r($array);die();
			$json = json_encode($array);
			
			die($json);	
		}
	}
	
	die();
}

//主播排行榜信息
elseif ($act == 'roomertopinfo'){
	require_once '../source/function/function_live.php';
	$roomid = $_GET['roomid'];
	$backinfo = getRoomerLiveTop($roomid);
	die(json_encode($backinfo))	;
}

//开始比赛
elseif ($act == 'startVote'){
	
	####写日志####
	$logMsg = date('Y-m-d H:i:s').':startVote - require -'.$uid;
	$debug && error_log($logMsg."\n", 3, $logUrl);
	####end
	
	//未登录
	if (empty($uid)){
		$html = '你还没有登录!';
		die(json_encode(array('status'=>-1,'html'=>$html)));
	}
	
	//非主播
	if ($uid != $_GET['roomid']){
		$html = '你还没有开始直播';
		die(json_encode(array('status'=>0,'html'=>$html)));
	}
	
	//读取主播信息
	$rs = DB::fetch_first("SELECT stat,canvote FROM pre_live_room WHERE roomid='$uid'");
	
	//未直播
	if ($rs['stat'] == 0){
		$html = '你还没有开始直播!';
		die(json_encode(array('status'=>0,'html'=>$html)));
	}
	
	//如果未开始比赛，则开始比赛
	if ($rs['canvote']==0){
		
		//初始化数据
		$time = time();
		$stime = strtotime(date("Y-m-d 00:00:00"));		
		$adminKickUseTime = $time - (10*60);//管理员踢出后10分钟才能开始比赛
		
		//被管理员踢出
		$rst = DB::result_first("SELECT COUNT(*) FROM pre_live_roomer_votelog WHERE uid='$uid' AND is_end_by_admin=1 AND etime>$adminKickUseTime");
		if ($rst){
			$html = '您刚被请出比赛区，请休息十分钟哦!';
			die(json_encode(array('status'=>0,'html'=>$html)));
		}
		
		//被管理员踢出3次
		$rst = DB::result_first("SELECT COUNT(*) AS counts FROM pre_live_roomer_votelog WHERE uid='$uid' AND is_end_by_admin=1 AND etime>$stime");
		if ($rst >= 3){
			$html = '今天您已经被终止三次了，明天再来比赛吧!';
			die(json_encode(array('status'=>0,'html'=>$html)));
		}
		
		//已满4小时比赛时间
		$rst = DB::result_first("SELECT SUM(totaltime) as sumtime FROM pre_live_roomer_votelog WHERE uid='$uid' AND stime>$stime");
		if ($rst >= 4*60*60){
			$html = '你今天已满4小时比赛时间了';
			die(json_encode(array('status'=>0,'html'=>$html)));
		}
		
		//开始比赛
		DB::query("UPDATE pre_live_room SET canvote=1 WHERE uid='$uid'");
		
		//判断时间------
		$existed = DB::result_first("SELECT COUNT(*) FROM pre_live_roomer_votelog WHERE etime=0 AND uid=$uid");
		if (!$existed) {
			DB::query("INSERT INTO pre_live_roomer_votelog (`uid`,`stime`) VALUES ('$uid','$time')");			
		}		
		//end
		
		
		//+ 开始投票
		$dataMsg = getMsgLenStr(";111;$uid", 4).";111;$uid";
		socketData(API_SOCKET_HOST, MSN_PORT, $dataMsg);
		//end
		
		####写日志####
		$logMsg = date('Y-m-d H:i:s').':startVote - msg -'.$uid.'-'.$dataMsg;
		$debug && error_log($logMsg."\n", 3, $logUrl);
		####end
	}
	
	$html = '比赛已经开启！';
	die(json_encode(array('status'=>1,'html'=>$html)));
}

//停止比赛
elseif ($act=='endVote'){
	
	####写日志####
	$logMsg = date('Y-m-d H:i:s').':endVote - require -'.$uid;
	$debug && error_log($logMsg."\n", 3, $logUrl);
	####end
	
	if(empty($uid)){
		$html = '你还没有登录!';
		die(json_encode(array('status'=>-1,'html'=>$html)));
	} else {
		
		//初始化数据
		$roomid=$_GET['roomid'];
		$is_end_by_admin = 0;
		$time = time();
		
		//如果用户不是主播，则判断是否管理员和巡管
		if ($uid != $roomid){
			
			//是否巡管
			$existed = DB::result_first("SELECT COUNT(*) FROM pre_live_admin WHERE uid=$uid");
			
			if($_G['adminid'] == 1 || $existed){
				$is_end_by_admin=1;
			}else{
				$html = '你不是管理员！';
				die(json_encode(array('status'=>0,'html'=>$html)));
			}
		}
		
		//停止比赛 ,更新比赛状态，更新比赛记录
		DB::query("UPDATE pre_live_room SET canvote=0 WHERE uid='$roomid' LIMIT 1");
		$stime = DB::result_first("SELECT stime FROM pre_live_roomer_votelog WHERE etime=0 AND stime>0 AND uid='$roomid'");
		if ($stime){
			$totalVtime = $time - $stime;				
			$sql = "UPDATE pre_live_roomer_votelog 
				SET etime=$time,
					totaltime=$totalVtime,
					is_end_by_admin='$is_end_by_admin' 
				WHERE uid='$roomid' AND etime=0";
			DB::query($sql);
		}
		
		//+ 结束投票
		$dataMsg = getMsgLenStr(";111;$roomid", 4).";111;$roomid";
		socketData(API_SOCKET_HOST, MSN_PORT, $dataMsg);
		//end
		
		####写日志####
		$logMsg = date('Y-m-d H:i:s').':endVote - msg -'.$uid.'-'.$dataMsg;
		$debug && error_log($logMsg."\n", 3, $logUrl);
		####end
		
		$html = '比赛已经关闭！';
		die(json_encode(array('status'=>1,'html'=>$html)));
	}
}

//给主播投票
elseif ($act=='charmVote'){
	
	//初始化数据
	$toUid = $_GET['touid'];
	$voteTime = time();
	$stime = strtotime(date("Y-m-d 00:00:00"));
	
	//未登录
	if (empty($uid)){
		$html = '你还没有登录!';
		die(json_encode(array('status'=>-1,'html'=>$html)));
	}
	
	//主播id为空
	if (empty($toUid)){
		$html = '请选择要赠送的主播';		
		die(json_encode(array('status'=>0,'html'=>$html)));		
	}
	
	//如果是主播自己
	if ($toUid == $uid) {
		$html = '请不要给自己赠送魅力之星！';		
		die(json_encode(array('status'=>0,'html'=>$html)));
	}
	
	//主播不在线
	$existed = DB::result_first("SELECT COUNT(*) FROM pre_live_userlist WHERE roomid='$toUid' AND uid='$toUid'");	
	if (empty($existed)){
		$html = '主播不在线';		
		die(json_encode(array('status'=>0,'html'=>$html)));
	}
	
	//1分钟之后才能赠送
	$loginTime = DB::result_first("SELECT times FROM pre_live_userlist WHERE roomid='$toUid' AND uid='$uid'");
	if (empty($loginTime) || ($loginTime + 30 > $voteTime)) {
		$html = '连接上服务器一分钟后才能赠送魅力之星';
		die(json_encode(array('status'=>0,'html'=>$html)));
	}
	
	//比赛未开始
	$canVote = DB::result_first("SELECT canvote FROM pre_live_room WHERE uid='$toUid'");
	if ($canVote == 0){
		$html = '我还没准备好接受您送的魅力之星呢，稍等一下啦！';	
		die(json_encode(array('status'=>0,'html'=>$html)));	
	}
	
	//计算总时间,判断是否已满4小时比赛时间
	$lastTotalTime = DB::result_first("SELECT SUM(totaltime) as sumtime FROM pre_live_roomer_votelog WHERE uid='$toUid' AND stime>$stime");
	$curStime = DB::result_first("SELECT stime FROM pre_live_roomer_votelog WHERE etime=0 AND totaltime=0 AND uid='$toUid'");
	if (empty($curStime)) {
		$totalTimeByDay = $lastTotalTime;
	} else {
		$totalTimeByDay = $lastTotalTime + ($voteTime - $curStime);
	}
	if ($totalTimeByDay >= 4*60*60){			
		$html = '我今天已满4小时比赛时间了，明天再给我送魅力之星吧！';
		die(json_encode(array('status'=>0,'html'=>$html)));
	}
	
	//读取主播信息
	$toUserInfo = DB::fetch_first("SELECT uid,if(nickname!='',nickname,username) AS username FROM pre_common_member WHERE uid=$toUid");	
	if (empty($toUserInfo)){
		$html = '请选择要赠送的主播';
		die(json_encode(array('status'=>0,'html'=>$html)));
	}
	
	$toUsername = $toUserInfo['username'];
	$voteNum = 1;
	$msgInfo = array(
		$toUsername." <span style='color:green'>".'又收到了</span> '.$username." <span style='color:green'>"."送来的宝贵一个<img src='/static2/images/vote_star.gif' />，可喜可贺！</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：哥送的不是星，是寂寞……</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：呀呀呀 送错了 能收回吗？</span>",
		$toUsername." <span style='color:green'>".'收到</span> '.$username." <span style='color:green'>"."送的一个<img src='/static2/images/vote_star.gif' />，说：今年过年不收礼 收礼只收火秀魅力之星</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：你不是没有观众，而是我一直太低调</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，愿</span> ".$toUsername." <span style='color:green'>"."在星光之路上越走越远！</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：我是你的忠实粉丝哦！</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：我代表月亮送你一颗魅力之星！</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，魅力之星代表我的心……</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：再也没有什么，能比你的歌声更让我放松……</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：别说我的魅力之星你无所谓</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，祝愿</span> ".$toUsername." <span style='color:green'>"."取得更好成绩！</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，希望</span> ".$toUsername." <span style='color:green'>"."再接再厉，加油拿奖！</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，祝愿</span> ".$toUsername." <span style='color:green'>"."夺得第一名！</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：你问我爱你有多深，它能代表我的心……</span>",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，我要送你999999999个魅力之星",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：你在我心中是最美！",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：你是最棒的！",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：你是最有魅力的！",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：火秀有你更精彩！",
		$username." <span style='color:green'>".'给</span> '.$toUsername." <span style='color:green'>"."送了一个<img src='/static2/images/vote_star.gif' />，说：火秀的大奖等你拿！"
	);
	$msg = $msgInfo[array_rand($msgInfo,1)];
	
	//该用户对主播的最后投票时间
	$sql = "SELECT * FROM pre_live_charm_votelog WHERE uid=$uid AND touid=$toUid";
	$lastVoteTime = DB::result_first("SELECT votetime 
		FROM pre_live_charm_votelog 
		WHERE uid=$uid AND touid=$toUid ORDER BY votetime DESC LIMIT 1");

	if (empty($lastVoteTime) || ($lastVoteTime+60 < $voteTime)){
		//写日志
		$data = array(
			'uid'=>$uid,
			'touid'=>$toUid,
			'votetime'=>$voteTime
		);
		DB::insert('live_charm_votelog', $data);
		
		//更新最近投票时间，更新排行榜
		DB::query("UPDATE pre_live_top
			SET `daynum`=`daynum`+$voteNum,
				`weeknum`=`weeknum`+$voteNum,
				`monthnum`=`monthnum`+$voteNum,
				`totalnum`=`totalnum`+$voteNum 
			WHERE uid=$toUid AND cate='vote'");		
	} else {			
		$html = '请休息一分钟！';			
		die(json_encode(array('status'=>0,'html'=>$html)));
	}

	
	//计算主播的魅力指数,发消息到消息服务器及反馈给客户端
	$thisUserCharm = DB::result_first("SELECT monthnum FROM pre_live_top WHERE cate='charm' AND uid=$toUid limit 1");
	$thisUserVote = DB::result_first("SELECT monthnum FROM pre_live_top WHERE cate='vote' AND uid=$toUid limit 1");
	$MC = DB::result_first("SELECT monthnum FROM pre_live_top 
		WHERE uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) 
			AND uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) 
			AND cate='charm' 
		ORDER BY monthnum DESC 
		LIMIT 1");
	$MV = DB::result_first("SELECT monthnum FROM pre_live_top 
		WHERE uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) 
			AND uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) 
			AND cate='vote'
		ORDER BY monthnum DESC 
		LIMIT 1");		
	$score = ($thisUserCharm/$MC*0.6+$thisUserVote/$MV*0.4)*(1*10000);
	
	//发送消息到消息服务器
	$writeData='{"roomid":"'.$toUid.'","uid":"1","username":"","action":"msgChat","actionto":"all","msg":"'.$msg.'","usertype":"1","mode":"manage"}'; 
	$dataMsg = getMsgLenStr(";115;$writeData", 4).";115;$writeData";
	socketData(API_SOCKET_HOST, MSN_PORT, $dataMsg);
	//end
	
	//反馈信息到客户端
	$backinfo = array('charm'=>$thisUserCharm,'vote'=>$thisUserVote,'score'=>floor($score));
	$html = '赠送成功！';
	die(json_encode(array('status'=>1,'html'=>$html,'info'=>$backinfo)));
}

//系统投票
elseif ($act == 'sysVote') {
	$roomid = $_GET['roomid'];
	
	####写日志####
	$logMsg = date('Y-m-d H:i:s').':sysVote - require -'.$roomid;
	$debug && error_log($logMsg."\n", 3, $logUrl);
	####end
	
	if ($roomid) {
		$voteNum = 150;
		
		//获取系统赠送时间
		$sysVoteTime = cGetSysVoteTime($roomid);
		
		if (!empty($sysVoteTime)) {
			//投票日志
			$data = array(
				'uid'=>0,//系统
				'touid'=>$roomid,
				'votetime'=>time(),
				'amount'=>$voteNum,
				'fromtime'=>$sysVoteTime['stime'],
				'totime'=>$sysVoteTime['etime']
			);
			if(DB::insert('live_charm_votelog', $data)) {	
				
				####写日志####
				$logMsg = date('Y-m-d H:i:s').':sysVote - db -['.$sysVoteTime['stime'].'-'.$sysVoteTime['etime'].']('.date('Y-m-d H:i:s', $sysVoteTime['stime']).'-'.date('Y-m-d H:i:s', $sysVoteTime['etime']).')';
				$debug && error_log($logMsg."\n", 3, $logUrl);
				####end
				
				//排行榜
				$exitVote = DB::result_first("SELECT COUNT(*) FROM pre_live_top WHERE uid='$roomid' AND cate='vote'");
				if ($exitVote){
					$sql = "UPDATE pre_live_top 
						SET `daynum`=`daynum`+$voteNum,
							`weeknum`=`weeknum`+$voteNum,
							`monthnum`=`monthnum`+$voteNum,
							`totalnum`=`totalnum`+$voteNum 
						WHERE uid='$roomid' AND cate='vote'";			
					DB::query($sql);
				} else {
					$toUsername = DB::result_first("SELECT if(nickname!='',nickname,username) as username 
						FROM pre_common_member 
						WHERE uid='$roomid'");
					$data = array(
						'cate'=>'vote',
						'uid'=>$roomid,
						'username'=>$toUsername,
						'daynum'=>$voteNum,
						'weeknum'=>$voteNum,
						'monthnum'=>$voteNum,
						'totalnum'=>$voteNum
					);
					DB::insert('live_top', $data);
				}
				
				//给消息服务器发消息
				$dataCon = '{"roomid":"'.$roomid.'","voteNum":"'.$voteNum.'"}';
				$dataMsg = getMsgLenStr(";107;$dataCon", 4).";107;$dataCon";
				socketData(API_SOCKET_HOST, MSN_PORT, $dataMsg);
			}
		} else {
			//通知消息服务器更新时间
			$dataMsg = getMsgLenStr(";113;$roomid", 4).";113;$roomid";
			socketData(API_SOCKET_HOST, MSN_PORT, $dataMsg);
		}
		
		####写日志####
		$logMsg = date('Y-m-d H:i:s').':sysVote - tomsg -'.$dataMsg;
		$debug && error_log($logMsg."\n", 3, $logUrl);
		####end
	}
}

//激活宝箱
elseif ($act=='randbox'){
	
	//初始化数据
	$key = $_GET['key'];
	$roomid = $_GET['roomid'];
	$time = time();
		
	//未登录
	if (empty($uid)){
		echo '你还没有登录!';
		die();
	}
	
	//该用户最近一次抢宝记录
	$owner = DB::fetch_first("SELECT id,owntime FROM pre_pk_randbox WHERE owner=$uid ORDER BY owntime DESC limit 1");
	if ($owner){
		
		//如果本次抢宝距离上次不到10分钟，则需判断是否连续3次抢宝
		if (($time - $owner['owntime']) < 10*60){
			$query = DB::query("SELECT owner 
				FROM pre_pk_randbox 
				WHERE 1 
				ORDER BY owntime DESC 
				LIMIT 3");
			
			$i=0;
			while ($rs = DB::fetch($query))	{				
				if ($rs['owner'] == $uid) $i++;				
			}
			
			if ($i == 3) {
				echo '你已经连续抢到了好几次了，留点机会给别人吧！';
				die();
			}
		}
	}	
	
	//该宝箱是否还在
	$existed = DB::fetch_first("SELECT COUNT(*) FROM pre_pk_randbox WHERE `isuse`=0 AND `key`='$key'");
	if ($existed){
		
		//宝箱火币概率
		$arrayRandBox = array(
			'1'=>0.05,
			'2'=>0.15,
			'5'=>0.4,
			'10'=>0.2,
			'15'=>0.07,
			'25'=>0.05,
			'35'=>0.04,
			'50'=>0.02,
			'80'=>0.01,
			'100'=>0.01
		);
		
		//火币
		$huoCoin = randomArray($arrayRandBox);

		//开箱获得火币
		DB::query("UPDATE pre_pk_randbox 
			SET isuse=1,
				huocin=$huoCoin,
				owner=$uid,
				owntime=$time 
			WHERE `key`='$key' AND isuse=0");
		if (DB::affected_rows()){
			
			SIPHuoShowUpdate($uid, 'BFD', $huoCoin, '活动：抢宝箱');
			$msg = $username."<span style='color:green'>".' 眼明手快，抢到了宝箱，得到了 '.$huoCoin.' 火币，大家加油哦！</span>';	
			
			//如果25火币以上则写到公告里
			if ($huoCoin>=25){
				insertNotice(strip_tags($msg));	
			}
			
			//发消息到消息服务器
			$writeData='{"roomid":"'.$roomid.'","uid":"1","username":"","action":"msgChat","actionto":"all","msg":"'.$msg.'","usertype":"1","mode":"manage"}';			
			$dataMsg = getMsgLenStr(";115;$writeData", 4).";115;$writeData";
			socketData(API_SOCKET_HOST, MSN_PORT, $dataMsg);
			
			//反馈信息到客户端
			echo '恭喜你抢到了宝箱！你打开了宝箱，得到了 '.$huoCoin.' 火币！';;
			die();
		}else{
			echo '对不起，宝箱已经被别人抢跑了，下次要动作快些哦！';
			die();
		}
	}else{
		echo '对不起，宝箱已经被别人抢跑了，下次要动作快些哦';
		die();
	}
}

/**
 * *
 * 更新直播间主播信息
 */
elseif ($act=='getUserinfo'){
	$uid = $_G['gp_uid'];
	if(empty($uid) || !is_numeric($uid) || $uid<1)
		die("uid格式错误！！");
	$usersinfo = getUsersInfo($uid);
	$chartmLevel = $usersinfo[chartmLevel][level] +1; 
	$huoshowlevel = $usersinfo[huoshowlevel][level] +1;
	//获得荣誉勋章
	$hoormedal = array();
	$sql = "SELECT * FROM pre_forum_medal WHERE medalid IN(SELECT medalid FROM pre_forum_medallog WHERE uid = '$uid') LIMIT 6";
	$query = DB::query($sql);
	while($res = DB::fetch($query)){
		$hoormedal[] = $res;
	}
	//得到数组个数
	$result =count($hoormedal);
	//得到个性签名
	$sql = "SELECT * FROM ".DB::table('common_member_field_forum')." WHERE uid= $uid";
	//$query = DB::query($sql);
	$persona = DB::fetch_first($sql);
	//$personality = unserialize($persona['sightml']);
	echo '<div id="grxingxkuang"><div class="jiangbt">个人简介</div><div class="mykuang"><div class="mykuang-l">';
	echo '<a target="_blank" href="'.DX_URL.$uid.'" class="avatar"><img src="'.$usersinfo[avatar].'" class="avatar"/></a><p>';
	echo '<img src="static/image/common/pt_icn.png"/><a href="'.DX_URL.$uid.'" target="_blank">访问Ta的空间</a></p>';
	echo '</div>';
	echo '<ul><li style="width:350px;">';
	echo '<span class="text5">';
	if ($usersinfo[anchorinfo][nickname]) {
		echo $usersinfo[anchorinfo][nickname];
	}else {
		echo $usersinfo[anchorinfo][realname];
	}
	echo '</span>';
	if ($hoormedal){
		foreach ($hoormedal as $key=>$value){
			if ($value[medalid] > 10){
			echo '<img alt="'.$value[description].'" src="static/image/common/'.$value[image].'" width="38px" height="52px"/>';	
			}
		}	
	}else {
		echo '您没有获得勋章';
	}
	echo '</li><li><span class="textm">明星等级：</span><img src="static2/images/charmlevel/'.$usersinfo[chartmLevel][level].'.png"/>';
	echo '<span onmouseout="this.className=\'\'" onmouseover="this.className=\'hover\'" style="position:relative;">';
	echo '<strong> <span style="width:'.$usersinfo[charzhi].'%;" class="column" id="col1">'.$usersinfo[charzhi].'%</span> </strong>';
	echo '<span class="col_tips">魅力值:'.$usersinfo[anchorinfo][charm].' 距离升级还需'.$usersinfo[char].' 魅力值</span>';
	echo '</span><img src="static2/images/charmlevel/'.$chartmLevel.'.png" style="opacity:';
	echo 0.2+(1-0.2)*($usersinfo[charzhi]/100).'filter:alpha(opacity=';
	echo 20+(1-0.2)* $usersinfo[charzhi].');" /></li>';
	echo '<li><span class="textm"> 富豪等级：</span><img src="static2/images/huoshowlevel/'.$usersinfo[huoshowlevel][level].'.png"/>';
	echo '<span onmouseout="this.className=\'\'" onmouseover="this.className=\'hover\'" style="position:relative;">';
	echo '<strong> <span style="width: '.$usersinfo[huozhi].'%;" class="column" id="col1">'.$usersinfo[huozhi].'%</span> </strong>';
	echo '<span class="col_tips">豪爽度:'.$usersinfo[anchorinfo][huoshow].' 距离升级还需消费  '.$usersinfo[huoshow].' 火币 </span>';
	echo '</span><img src="static2/images/huoshowlevel/'.$huoshowlevel.'.png" style="opacity:';
	echo 0.2+(1-0.2)*($usersinfo[huozhi]/100).'filter:alpha(opacity=';
	echo 20+(1-0.2)* $usersinfo[huozhi].');" /></li>';
	echo '<li style="float:left; width:80px;">性别：';
	if ($usersinfo[anchorinfo][gender]==0) {
		echo '保密';
	}
	if ($usersinfo[anchorinfo][gender]==1) {
		echo '男';
	}
	if ($usersinfo[anchorinfo][gender]==2) {
		echo '女';
	}
	if (!empty($usersinfo[anchorinfo][resideprovince])) {
		echo '</li><li style="float:left;">';
		echo '居住城市：'.$usersinfo[anchorinfo][resideprovince];
		if (!empty($usersinfo[anchorinfo][residecity])){
			echo $usersinfo[anchorinfo][residecity];
		}
	}
	echo '</li></ul></div></div>';
	if ($persona){
		echo '<div><div class="jiangbt">个性签名</div>';
		echo '<div class="text6">'.$persona[sightml];
		echo '</div></div>';
	}
}

/**
 * *
 * 直播间公告
 */
elseif ($act=='getNotice'){
	$uid = $_GET['uid'];
	$sql = "SELECT a.*,IF(m.nickname!='',m.nickname,m.username) AS nickname FROM ".DB::table('live_room_config')." a LEFT JOIN ".DB::table('common_member')." m ON a.uid = m.uid WHERE a.uid=$uid";	
	$roomcfg = DB::fetch_first($sql);
	$notice = unserialize($roomcfg['roominfo']);
	
    if ($notice[roomnotice]){
    	if ($notice[roomnotice_link]){
    		echo '<a href="'.$notice[roomnotice_link].'" target="_blank" >';
    	}
    	echo $notice[roomnotice];
    	if ($notice[roomnotice_link]){
			echo '</a>';
    	}
    }else {
    	echo $roomcfg[nickname] ? '欢迎来到'.$roomcfg[nickname].'的直播间': '欢迎来到'.$roomcfg[roomtitle].'的直播间';
    }
	
}

/**
* 全概率计算
*
* @param array $p array('a'=>0.5,'b'=>0.2,'c'=>0.4)
* @return string 返回上面数组的key
* @author Lukin <my@lukin.cn>
*/
function randomArray($ps){
	
	static $arr = array(); 
	$key = md5(serialize($ps));
	if (!isset($arr[$key])) {
		$max = array_sum($ps);
		foreach ($ps as $k=>$v) {
			$v = $v / $max * 10000;
			for ($i=0; $i<$v; $i++) $arr[$key][] = $k;
		}
	}
	return $arr[$key][mt_rand(0,count($arr[$key])-1)];
}

function getUserLiveTopMax($time,$cate){
	if ($time=='all' and $cate=='charm'){
		$sql = "SELECT charm FROM ".DB::table('live_member_count')."  WHERE 
		uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 		
		ORDER BY  charm  
		DESC LIMIT 1";
		$rs = DB::fetch_first($sql);
		return $rs['charm'];
	}else{
		$sql = "SELECT * FROM ".DB::table('live_top')." WHERE 
		uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
		AND cate like '$cate'
		ORDER BY  $time 
		DESC LIMIT 1";
		$rs = DB::fetch_first($sql);
		return $rs[$time];
	}
}

/**
 * 获取系统赠送时间
 * zhangcj 2001.07.18
 * @param $roomid int
 * @return array
 */
function cGetSysVoteTime($roomid) {
	
	//初始值
	$sysVoteTime = array('stime'=>0, 'etime'=>0);
	$now = time();
	$totalTime = 0;	
	$timeDuring = 1800;
	
	//判断是否00:00
	$tmp01 = strtotime(date('Y-m-d 00:00:00'));
	$tmp02 = strtotime(date('Y-m-d 00:31:00'));
	if ($now >= $tmp01 && $now <= $tmp02) {
		$isMidNight = true;
	} else {
		$isMidNight = false;
	}
	
	//初始化活动时间
	if ($isMidNight) {
		$activityStart = strtotime(date('Y-m-d 18:00:00'))-86400;
		$activityEnd = strtotime(date('Y-m-d 00:00:00'));
	} else {
		$activityStart = strtotime(date('Y-m-d 18:00:00'));
		$activityEnd = strtotime(date('Y-m-d 00:00:00'))+86400;
	}	
	
	//最近时间
	$lastTime = DB::result_first("SELECT MAX(totime)  
		FROM pre_live_charm_votelog 
		WHERE touid=$roomid AND fromtime>=$activityStart");
	
	//如果存在则取下一段时间,否则取活动期间的一段
	if ($lastTime) {
		$query = DB::query("SElECT stime,etime,totaltime 
			FROM pre_live_roomer_votelog 
			WHERE uid=$roomid AND is_end_by_admin=0 AND (stime>=$lastTime OR (stime<$lastTime AND etime>$lastTime)) 
			ORDER BY stime ASC");
	} else {
		$query = DB::query("SELECT stime,etime,totaltime 
			FROM pre_live_roomer_votelog 
			WHERE uid=$roomid AND is_end_by_admin=0 AND (stime>=$activityStart OR (stime<$activityStart AND etime>$activityStart))
			ORDER BY stime ASC");
	}
	
	//取时间段
	while ($rs = DB::fetch($query)) {
		
		if (empty($sysVoteTime['stime'])) {//第一条比较特殊		
			//最近时间，记录开始时间，活动开始时间最大值
			$sysVoteTime['stime'] = max($lastTime, $rs['stime'], $activityStart);

			//时间累加
			if (empty($rs['etime'])) {//如果该场直播还未结束
				$totalTime += ($now - $sysVoteTime['stime']);
			} else {//已结束
				$totalTime += ($rs['etime'] - $sysVoteTime['stime']);
			}
		} else {
			//时间累加
			if (empty($rs['etime'])) {//如果该场直播还未结束
				$totalTime += ($now - $rs['stime']);
			} else {//已结束
				$totalTime += $rs['totaltime'];
			}
		}		
		
		
		if ($totalTime >= $timeDuring) {//如果达到要求则跳出循环
			if (empty($rs['etime'])) {
				$sysVoteTime['etime'] = $now - ($totalTime - $timeDuring);
			} else {
				$sysVoteTime['etime'] = $rs['etime'] - ($totalTime - $timeDuring);
			}
			break;
		}
	}

	//返回值
	if (!empty($sysVoteTime['stime']) && !empty($sysVoteTime['etime'])) {
		return $sysVoteTime;
	} else {
		return false;
	}
}