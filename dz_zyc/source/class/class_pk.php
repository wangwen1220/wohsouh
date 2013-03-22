<?php
require  DISCUZ_ROOT.'source/function/function_live.php';

class pk
{
	
	
	/**
	 * 写限时礼物日志
	 * @param $user int/array
	 * @param $targetuser int/array
	 * @param $gift int/array
	 * @param $num int
	 * @param $amount int
	 */
	public function sendLimitGift ($user, $targetuser, $gift, $num, $amount,$roominfo) 
	{
		
		if (!is_array($user)) {
			$user = DB::fetch_first("SELECT * FROM ".DB::table('live_member_count')." WHERE uid=$user");
		}
		if (!is_array($targetuser)) {
			$targetuser = DB::fetch_first("SELECT * FROM ".DB::table('live_member_count')." WHERE uid=$targetuser");
		}
		if (!is_array($gift)) {
			$gift = DB::fetch_first("SELECT * FROM ".DB::table('live_gift')." WHERE giftid=$gift");
		}
		$sql = "SELECT * FROM ".DB::table('activity_period_bindgift')." WHERE perid ='".PERID."' AND giftid='".$gift['giftid']."'";
		
		if (DB::fetch_first($sql)){
			if (is_array($user) && is_array($targetuser) && is_array($gift) && $num>0 && $amount > 0) {
				$roomid = cGetRoomid($roominfo['uid']);
				$roomlogid = cGetRoomLogId($roominfo['uid']);
				if ($roominfo['uid']==$targetuser['uid']){
					$teamInfo = self::getRoomerTeamInfo($roominfo['uid']);
					$pkInfo = self::getPKInfo();
				}
				//赠送日志
				$data = array(
					'perid'=>PERID,
					'teamid'=>$teamInfo['teamid'],
					'round'=>$pkInfo['round'],
					'uid'=>$user['uid'],
					'username'=>$user['username'],
					'roomid'=>$roomid,
					'roomlogid'=>$roomlogid,
					'action'=>1,
					'giftid'=>$gift['giftid'],
					'giftname'=>$gift['name'],
					'giftprice'=>$gift['price'],
					'num'=>$num,
					'weight'=>1,
					'value'=>$amount,
					'targetuid'=>$targetuser['uid'],
					'targetusername'=>$targetuser['username'],
					'dateline'=>time(),
				);
				DB::insert('pk_gift_log', $data);
			
				//接受日志
				$data = array(
					'perid'=>PERID,
					'teamid'=>$teamInfo['teamid'],
					'round'=>$pkInfo['round'],
					'uid'=>$targetuser['uid'],
					'username'=>$targetuser['username'],
					'roomid'=>$roomid,
					'roomlogid'=>$roomlogid,
					'action'=>2,
					'giftid'=>$gift['giftid'],
					'giftname'=>$gift['name'],
					'giftprice'=>$gift['price'],
					'num'=>$num,
					'weight'=>1,
					'value'=>$amount,
					'targetuid'=>$user['uid'],
					'targetusername'=>$user['username'],
					'dateline'=>time(),
				);
				DB::insert('pk_gift_log', $data);
				return true;
			}else {
				return false;
			}
		}
	}
	
	/**
	 * 
	 * 获取PK赛信息
	 */
	public function getPKInfo()
	{
		$sql = "SELECT a.*,b.status,b.sTime as actStime FROM ".DB::table('activity_period')." a LEFT JOIN ".DB::table('activity')." b ON a.actid=b.id WHERE a.id='".PERID."' ";
		
		$period = DB::fetch_first($sql);
		
		if ($period['status']!=2){
			$rs = array('status'=>0,'info'=>'活动未开始');
			return $rs;
		}
		$actTime= $period['stime']+($period['sdaytime']*3600);
		$actWeek = date("w",$actTime);
		
		if ($actWeek==0) $actWeek=7;		
		$nowtime = time();			
		$nowday = date("d");
		$nowweek = date("w");
		$nowhour = date("H");
		$nowminute=date("i");	
		if ($nowweek==0) $nowweek=7;		
		$roundStatus=1;
		if ($nowtime>$actTime){
			
			if ($nowweek<=$actWeek){				
				$actTime = $actTime-$actWeek*24*3600;
			}
			$round = ceil(($nowtime-$actTime)/60/60/24/7)+0;				
			if ($nowweek<$period['sweek']){
				$roundStatus = 0;							
			}else{
				if ($nowweek==$period['sweek']){
					if ($nowhour.$nowminute<$period['sdaytime'].$period['sminute']){						
						$roundStatus = 0;
					}
				}				
			}	
			if ($nowweek>$period['eweek']){
				$roundStatus = 0;				
			}else{
				if ($nowweek==$period['eweek']){
					if ($nowhour.$nowminute>$period['edaytime'].$period['eminute']){						
						$roundStatus = 0;
					}
				}
			}			
		}else{
			$round=0;
			$roundStatus = 0;
		}		
		$limitLeftTime=0;
		
						
		$limitEndTime=strtotime(date("Y-m-d ".$period['edaytime'].":".$period['eminute'].":00"))-strtotime(date("Y-m-d ".$period['sdaytime'].":".$period['sminute'].":00"));
		
		if ($nowhour.$nowminute<$period['sdaytime'].$period['sminute']){			
			$limitLeftTime=strtotime(date("Y-m-d ".$period['sdaytime'].":".$period['sminute'].":00"))-time();//剩余时间				
		}else{			
			$limitLeftTime=strtotime(date("Y-m-d ",strtotime("+1 days")).$period['sdaytime'].":".$period['sminute'].":00")-time();//剩余时间		
			
		}	
		
		if ( $nowtime>$period['etime']){
			$rs = array('status'=>0,'info'=>'活动时段已经结束');
			return $rs;
		}		
		if ($period['stime']<$nowtime && $nowtime<$period['etime']){			
			if ($period['smonth']<=$nowday && $nowday<=$period['emonth']){
				if ($period['sweek']<=$nowweek && $nowweek<=$period['eweek']){					
					if ($period['sdaytime'].$period['sminute']<=$nowhour.$nowminute && $nowhour.$nowminute<=$period['edaytime'].$period['eminute']){
						$limitLeftTime=0;
						$limitEndTime=strtotime(date("Y-m-d ".$period['edaytime'].":".$period['eminute'].":00"))-time();
						$gameStatus=1;
					}else{
						if ($nowhour.$nowminute<$period['sdaytime'].$period['sminute']){
							$limitLeftTime=strtotime(date("Y-m-d ".$period['sdaytime'].":".$period['sminute'].":00"))-time();//剩余时间							
						}else{
							$limitLeftTime=strtotime(date("Y-m-d ",strtotime("+1 days")).$period['sdaytime'].":".$period['sminute'].":00")-time();//剩余时间
						}
					}
				}else{
					$limitLeftTime=strtotime(date("Y-m-d ".$period['sdaytime'].":".$period['sminute'].":00"))-time();//剩余时间
					if ($nowweek<$period['sweek']){		
						$leftDay = $period['sweek']-$nowweek;						
						$limitLeftTime = $limitLeftTime+$leftDay*24*3600;
						
					}
					if ($nowweek>$period['eweek']){
						$leftDay = 7-$nowweek+$period['sweek'];	
						$limitLeftTime = $limitLeftTime+$leftDay*24*3600;						
					}
				}
			}else{
				$limitLeftTime=strtotime(date("Y-m-d ".$period['sdaytime'].":".$period['sminute'].":00"))-time();//剩余时间
				if ($nowday<$period['smonth']){
					$leftDay = $period['smonth']-$nowday;
					
					$thatWeek = date("w",strtotime("$leftDay days"));
					if ($thatWeek==0) $thatWeek=7;					
					if ($thatWeek>$period['eweek']){				
						$leftDay = $leftDay+(7-$thatWeek+$period['sweek']);
					}else{
						$leftDay = $leftDay+($period['sweek']-$thatWeek);
					}	
					$limitLeftTime = $limitLeftTime+$leftDay*24*3600;
				}
				if ($nowday>$period['emonth']){
					$leftDay = date("t")-$nowday+$period['smonth'];
					
					$thatWeek = date("w",strtotime("$leftDay days"));
					
					if ($thatWeek==0) $thatWeek=7;	
					if ($thatWeek>$period['eweek']){				
						$leftDay = $leftDay+(7-$thatWeek+$period['sweek']);
					}else{
						$leftDay = $leftDay+($period['sweek']-$thatWeek);
					}
					$limitLeftTime = $limitLeftTime+$leftDay*24*3600;
					
				}
			}
		}else{
			if ($nowtime<$period['stime']){
				
				$leftDay = floor(($period['stime']+($period['sdaytime']*3600+$period['sminute']*60)-$nowtime)/24/3600);				
				$leftTime = $period['stime']-$nowtime;
				$thatDay = date("d",$period['stime']);
				$thatWeek = date("w",$period['stime']);
				if ($thatWeek==0) $thatWeek=7;				
				if ($thatDay<$period['smonth']){					
					$leftDay = $leftDay+($period['smonth']-$thatDay);
					$thatWeek = date("w",strtotime("+$leftDay days"));
				}			
				if ($thatWeek<$period['sweek']){
					$leftDay = $leftDay+($period['sweek']-$thatWeek);
				}							
				$limitLeftTime = $limitLeftTime+$leftDay*24*3600;
			}
		}
		if ((time()+$limitLeftTime)>$period['etime']){	
			$rs = array('status'=>0,'info'=>'活动时段已经结束');
			return $rs;
		}
		
		$rs['perStartTime']=$period['stime'];//时段开始时间
		$rs['perEndTime']=$period['etime'];//时段结束时间
		
		$rs['perSDay']=date("Y年m月d日",$period['stime']);//时段开始时间
		$rs['perEDay']=date("m月d日",$period['etime']);//时段结束时间
		
		$rs['perStartMonth']=$period['smonth'];//时段结束时间		
		$rs['perEndtMonth']=$period['smonth'];//时段结束时间
		
		$rs['perStartWeek']=$period['sweek'];//时段结束时间
		$rs['perEndWeek']=$period['eweek'];//时段结束时间
		$rs['perStartDayhour'] = $period['sdaytime'];
		$rs['perStartDayminute'] = $period['sminute'];
		$rs['perEndDayhour'] = $period['edaytime'];
		$rs['perEndDayminute'] = $period['eminute'];
		$rs['perStartDaytime']=$period['sdaytime'].':'.$period['sminute'];//时段结束时间
		$rs['perEndDaytime']=$period['edaytime'].':'.$period['eminute'];//时段结束时间
		
		
		$rs['limitLeftTime']=$limitLeftTime;//时段剩余时间（秒）
				
		$rs['limitEndTime'] = $limitLeftTime+$limitEndTime;
		$rs['gameStatus'] = $gameStatus;
		$rs['round']=$round;//比赛第几轮数
		$rs['roundStatus']=$roundStatus;//轮数状态，1表示上面$round轮已经开始，0表示未开始	
		$rs['status']=1;
		return $rs;
	}
	/**
	 * 
	 * 获取主播所在队伍
	 * @param integer $uid
	 */
	public function getRoomerTeamInfo($uid)
	{
		$sql = "SELECT a.*,b.name,b.logo FROM ".DB::table('pk_team_member')." a LEFT join ".DB::table('pk_team')." b ON a.teamid = b.teamid WHERE a.uid='$uid'";
		return DB::fetch_first($sql);
		
	}
	
	/**
	 * 
	 * 获取指定轮数的获胜方,如果$round==null则取上一轮的获胜方
	 * @param integer $round
	 */
	public function getTeamWinner($round=null)
	{
		if (!$round) {
			$pkinfo = self::getPKInfo();				
			$round = $pkinfo['round']-1;			
		}
		if ($round>0){
			$sql = "SELECT sum(num) AS counts, `teamid` FROM ".DB::table('pk_gift_log')
			     . " WHERE `round` = '$round' AND teamid <>0 AND ACTION =2 AND perid ='".PERID."' "
			     . " GROUP BY teamid ORDER BY `counts` DESC LIMIT 1 ";
			
			$rs = DB::fetch_first($sql);
			return $rs;
			
		}
		return false;
	}
	
	/**
	 * 
	 * 获取队伍的火秀金星数，如果轮数为空则取所有轮数的总数
	 * @param integer $teamid
	 * @param integer $round
	 */
	public function getTeamVenus($teamid=null,$round=null)
	{
		$sql = "SELECT sum( num ) AS counts  FROM ".DB::table('pk_gift_log'). " WHERE 1 ";
		if ($round){
			$sql = $sql." AND `round` = '$round' ";
		}		
		if ($teamid){
			$sql = $sql." AND `teamid` ='$teamid' ";
		}else{
			$sql = $sql." AND `teamid` <>0 ";
		}
		
		$sql = $sql." AND `ACTION` =2 AND `perid` ='".PERID."'  GROUP BY teamid ORDER BY `counts` DESC LIMIT 1 ";
		
		$rs = DB::fetch_first($sql);
		return intval($rs['counts']);
	}

	/**
	 * 队伍成员信息
	 * 
	 * @author zhangcj
	 * 
	 * @param int $teamid
	 * @param int $tpp
	 * @param int $page
	 * @return array
	 */
	public function getTeamMemberInfo($teamid, $tpp=6, $page=1) {
		$list = array('count'=>0, 'list'=>array());

		$limitStart = ($page-1)*$tpp;
		$list['count'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table('pk_team_member')." WHERE teamid='$teamid'");
		$query = DB::query("SELECT * FROM (
			SELECT r.roomid,r.uid,r.username,r.stat,rc.charm ,if(cm.nickname!='',cm.nickname,cm.username) as nickname 
			FROM ".DB::table('live_room')." r
			LEFT JOIN ".DB::table('live_member_count')." rc ON r.uid=rc.uid 
			LEFT JOIN ".DB::table('live_userlist')." ul ON r.uid=ul.uid 
			LEFT JOIN ".DB::table('common_member')." cm ON r.uid=cm.uid 
			WHERE r.uid IN(SELECT uid FROM ".DB::table('pk_team_member')." WHERE teamid='$teamid')
		) tmp ORDER BY tmp.stat DESC , tmp.charm DESC LIMIT $limitStart,$tpp");
		
		while ($rs = DB::fetch($query)) {
			$tmp = cGetCharmLevel($rs['charm'], 1);
			$rs['charmLevel'] = $tmp['level'];
			$rs['onlineMember'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_userlist')." WHERE roomid=".$rs['roomid']);
			$rs['online'] = $rs['stat']==1 ? 1 : 0;
			$rs['avatar'] = avatar($rs['uid'], 'middle');
			$rs['avatar'] = str_replace('<img ', '<img width="96" height="96" ', $rs['avatar']);
			$list['list'][] = $rs;		
		}
		
		return $list;
	}


	/**
	 * 队伍信息
	 *
	 * @author zhangcj
	 * @return array
	 */
	public function getTeams() {
		$query = DB::query("SELECT * FROM ".DB::table('pk_team'));
		while ($rs = DB::fetch($query)) {
			$list[] = $rs;
		}
		return $list;
	}

	/**
	 * 竞猜当前配置
	 *
	 * @author zhangcj
	 * @param int $round
	 * @return array
	 */
	public function getGuessConfig() {
		$time = time();
		return DB::fetch_first("SELECT * FROM ".DB::table('pk_guess_config')." WHERE rightoption=0 AND fortype=1 AND startdateline<$time AND enddateline>$time");
	}

	/**
	 * 竞猜人数
	 *
	 * @author zhangcj
	 * @param int $round
	 * @return int
	 */
	public function getGuessPersonNum($round) {
		$num = DB::result_first("SELECT COUNT(*) 
			FROM ".DB::table('pk_guess_log')." 
			WHERE guessid=(
				SELECT guessid FROM ".DB::table('pk_guess_config')." WHERE fortype=1 AND forid=$round
			)");

		return intval($num);
	}

	/**
	 * 我的竞猜信息
	 *
	 * @author zhangcj
	 * @return array
	 */
	public function getGuessList($uid) {
		$query = DB::query("SELECT l.*,c.options,c.rightoption,c.getshowcoin,c.forid 
			FROM ".DB::table('pk_guess_log')." l 
			LEFT JOIN ".DB::table('pk_guess_config')." c ON l.guessid=c.guessid 
			WHERE l.uid='$uid' 
			ORDER BY l.dateline DESC");
		while ($rs = DB::fetch($query)) {
			$rs['dateline_str'] = date('Y-m-d H:i:s', $rs['dateline']);
			$options = unserialize($rs['options']);
			$rs['optionid_str'] = $options[$rs['optionid']];

			if (empty($rs['rightoption'])) {
				$rs['result_str'] = '结果未揭晓';
				$rs['draw_str'] = '';
			} elseif ($rs['optionid']==$rs['rightoption']) {
				$rs['result_str']='猜中了';
				$rs['draw_str'] = $rs['getshowcoin'].'个火币';
			} else {
				$rs['result_str'] = '未猜中';
				$rs['draw_str'] = '无';
			}
			
			$rs['guesstitle'] = '猜猜第'.$rs['forid'].'轮谁会胜出？';


			$list[] = $rs;
		}
		return $list;
	}

	/**
	 * 获取某轮的比赛信息
	 *
	 * @author zhangcj
	 * @param int $round
	 * @return array
	 */
	public function getPKRoundInfo($round){

		$round = intval($round);
		$list = array();

		$query = DB::query("SELECT l.teamid,l.num,l.dateline,t.name,t.logo 
			FROM ".DB::table('pk_gift_log')." l 
			LEFT JOIN ".DB::table('pk_team')." t ON t.teamid=l.teamid 
			WHERE l.perid=2 AND l.round=$round AND l.action=2 AND l.teamid>0
			ORDER BY dateline DESC
			");
		
		while ($rs = DB::fetch($query)) {
			if ($rs['dateline'] < strtotime(date('Y-m-d', time()))) {
				$k = date('Y年m月d日', $rs['dateline']);
				if (!isset($list[$k])) {
					$list[$k][1] = array('goldenStar'=>0,'percent'=>'0%','name'=>'','logo'=>'');
					$list[$k][2] = array('goldenStar'=>0,'percent'=>'0%','name'=>'','logo'=>'');
				}
				if ($rs['teamid'] == 1) {
					$list[$k][1]['goldenStar'] += $rs['num'];
					$list[$k][1]['name'] = $rs['name'];
					$list[$k][1]['logo'] = $rs['logo'];
				} elseif ($rs['teamid'] == 2) {
					$list[$k][2]['goldenStar'] += $rs['num'];
					$list[$k][2]['name'] = $rs['name'];
					$list[$k][2]['logo'] = $rs['logo'];
				}	
			}
		}
		
		//计算百分比
		foreach ($list as $key=>$value) {
			$list[$key][1]['percent'] = floor(($value[1]['goldenStar'] / ($value[1]['goldenStar'] + $value[2]['goldenStar']))*100).'%';
			$list[$key][2]['percent'] = floor(($value[2]['goldenStar'] / ($value[1]['goldenStar'] + $value[2]['goldenStar']))*100).'%';
		}

		return $list;
	}

	/**
	 * 获取队伍名字
	 * $teamid 获胜队伍teamid
	 */
	public function getTeamName($teamid){
		if ($teamid){
			$sql = "SELECT * FROM ".DB::table('pk_team')." where teamid=$teamid";
			$teamname = DB::fetch_first($sql);
			return $teamname;
		}
	}
	
	/**
	 * 红人榜,round为空则取上一轮的红人
	 */
	public function getRedsList($round=null){
		if (!$round) {
			$pkinfo = self::getPKInfo();				
			$round = $pkinfo['round']-1;			
		}
		if ($round>0){
			$sql = "SELECT a.username,b.name,b.logo,c.charm,m.username,if(m.nickname!='',m.nickname,m.username) as nickname,SUM(num) num FROM ".DB::table('pk_gift_log')."	a LEFT JOIN ".DB::table('pk_team')." b on a.teamid = b.teamid LEFT JOIN
".DB::table('live_member_count')." c on a.uid = c.uid left join ".DB::table('common_member')." m on m.uid=c.uid WHERE a.round=$round AND a.teamid <>0 AND a.action = 2 AND a.perid='".PERID."' GROUP BY a.uid ORDER BY num DESC LIMIT 10";	
			$query = DB::query($sql);
			while ($rs = DB::fetch($query)){
				$tmp = cGetCharmLevel($rs['charm'], 1);
				$rs['charmLevel'] = $tmp['level'];
				$redslist[] = $rs;
			}
			return $redslist;
		}
	}
	
	/**
	 * 
	 * 获取比赛情况  队伍列表 按天排序 
	 * @param unknown_type $num
	 */
	public function getWinTeamListByDay($num=6,$round=null)
	{
		$sql = "SELECT a.teamid, b.name,a.round, sum( a.num ) AS counts, substring( from_unixtime( a.`dateline` ) , 1, 10 ) AS dayline "
			 . " FROM `pre_pk_gift_log` a LEFT JOIN ".DB::table('pk_team') . " b ON a.teamid = b.teamid "
			 . " WHERE a.action =2 "
			 . " AND a.dateline<'".strtotime(date("Y-m-d 00:00:01"))."' ";
		if ($round!=null) $sql =$sql." AND a.round='$round'";
		$sql = $sql. " AND a.teamid <>0 "
			 . " AND a.perid =".PERID." "
			 . " GROUP BY dayline, a.teamid "
			 . " ORDER BY `dayline` DESC  ";
		$query = DB::query($sql);
		
		$i=0;
		while (@$rs = DB::fetch($query)){	
			$res1 = $rs;		
			if ($i==0) {
				$list[$i] = $rs;
				$i++;
			}else{				
				if ($list[$i-1]['dayline'] == $rs['dayline']){
					if ($list[$i-1]['counts']<=$rs['counts']){
						unset($list[$i-1]);
						$list[$i] = $rs;
						$i++;						
					}
				}else{
					$list[$i] = $rs;
					$i++;
				}		
			}	
		}
		$j=0;
		foreach ($res1 as $key=>$value){	
			if ($j==$num) break;		
			$res1[$j] = $value;
			$res1[$j]['showday'] = substr($value['dayline'],8,2)+0;
			$j++;
			
		}	
		$j=0;
		foreach ($list as $k=>$v){
			if ($j==$num) break;
			$res[$j] = $v;
			$res[$j]['showday'] = substr($v['dayline'],8,2)+0;
			$j++;
			
		}
		$result['winList']=$res;
		$result['roundList']=$res1;	
		return $result;		
	}
}