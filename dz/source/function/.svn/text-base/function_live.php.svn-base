<?php
/**
 *    直播大厅预告数据  
 *    return array()
 *    by ya   
 */
function index_live_notice_res($uid=0,$limit=10)
{
	//echo "SELECT uid,username,dateline FROM ".DB::table('live_notice')." WHERE uid ='{$uid}' ORDER BY `dateline` DESC LIMIT 10";
	$return_res=array();
	$query = DB::query("SELECT uid,username,content,start_time,end_time FROM ".DB::table('live_notice')." WHERE uid ='{$uid}'  AND start_time>".time()." ORDER BY id DESC LIMIT {$limit}");
	while ($value = DB::fetch($query)) 
	{
		$return_res[]= $value;
	}
	
	return $return_res;
}

/**
 *    直播大厅预告数据插入 
 *    return array()
 *    by ya   
 */
function index_live_notice_insert($arr=array())
{
	return DB::insert('live_notice', $arr,1);
}
/**
 *    统计有效的预告数
 *    return int
 *    by ya   
 */
function index_live_notice_res_count($uid=0)
{
	//$query = DB::query("SELECT COUNT(*) FROM ".DB::table('live_notice')." WHERE dateline > ".time()." AND uid='{$uid}'");
	$query = DB::query("SELECT COUNT(*) FROM ".DB::table('live_notice')." WHERE dateline > ".time()."");
	return $res= DB::result($query);
}

/**
 *    粉丝排行榜
 *    $limit 查询条数
 *    return array
 *    by ya   
 */
function index_live_fans_res($limit=10)
{
	$return_res=array();
	$query = DB::query("
	SELECT COUNT(*) as fans ,fid FROM ".DB::table('forum_groupuser')." 
	WHERE fid IN (SELECT  fid FROM ".DB::table('forum_groupuser')." WHERE `level`=5) 
	AND `level` !=5 
	GROUP BY fid 
	ORDER BY fans DESC 
	LIMIT {$limit}");
	while ($value = DB::fetch($query)) 
	{
		//fans_ower
		$query_fans_ower = DB::query("SELECT uid,username FROM ".DB::table('forum_groupuser')." WHERE fid='{$value['fid']}' AND `level`=5 LIMIT 1");
		$value_fans_ower = DB::fetch($query_fans_ower);
		$value['uid']=$value_fans_ower['uid'];
		$value['username']=$value_fans_ower['username'];
		//get sex
		$query_sex = DB::query("SELECT `gender` FROM ".DB::table('common_member_profile')." WHERE uid='{$value_fans_ower['uid']}'");
		$value_sex = DB::fetch($query_sex);
		$value['gender']=!empty($value_sex['gender']) ? $value_sex['gender'] : 0;
		//get view
		$query_view = DB::query("SELECT `views` FROM ".DB::table('common_member_count')." WHERE uid='{$value_fans_ower['uid']}'");
		$value_view = DB::fetch($query_view);
		$value['views']=!empty($value_view['views']) ? $value_view['views'] : 0;
		
		$return_res[]= $value;
	}
	return $return_res;
}

/**
 *    用户的粉丝
 *    $uid 用户ID 
 *    return array
 *    by ya   
 */
function index_fans_list($uid=0,$offest=0,$limit=10)
{
	$res=array();
	$query_ower = DB::query("SELECT * FROM ".DB::table('forum_groupuser')." WHERE uid='{$uid}' AND `level`=5 LIMIT 1");
	$res_ower= DB::fetch($query_ower);
	if($res_ower)
	{
		$query_count = DB::query("SELECT COUNT(*) FROM ".DB::table('forum_groupuser')." WHERE fid='{$res_ower['fid']}' AND `level`!=5");
		$count=DB::result($query_count);
		//$multipage = multi(DB::result($query, 0), $_G['tpp'], $page, 'home.php?mod=magic&action=log&amp;operation=receivelog');

		$query_list = DB::query("SELECT uid,username FROM ".DB::table('forum_groupuser')." 
			WHERE fid='{$res_ower['fid']}' AND `level`!=5 
			ORDER BY joindateline DESC
			LIMIT {$offest},{$limit}");
		while($value = DB::fetch($query_list))
		{
			$res[] = $value;
		}
		
	}
	return $res;
}

/**
 * 申请成为粉丝
 * return int
 */
function cGetIsFans($uid,$targetuid)
{
	$uid = intval($uid);
	$targetuid = intval($targetuid);
	$userFans = DB::fetch_first("SELECT * FROM ".DB::table('live_contribution')." WHERE uid=$uid AND targetuid=$targetuid");
	if ($userFans['fans'] == '0' ) {
		$sql = "UPDATE ".DB::table('live_contribution')." SET fans = '1' WHERE uid = ".$userFans['uid']." AND targetuid= ".$userFans['targetuid'];
		if(DB::query($sql)){
			echo '{"status":1}';
		}else{
			echo '{"status":0}';
		}
		return true;
	}
}

/**
 * 得到主播经纪人
 * $uid主播UID
 * return array
 */
function AnchorAgent($uid)
{
	$anchoragent = array();
	$query = DB::query("SELECT uid,username FROM ".DB::table('live_member_count')." where uid IN(SELECT agent FROM ".DB::table('live_artists')." WHERE uid = $uid)");
	while($res= DB::fetch($query))
	{
		$anchoragent[] = $res;
	}
	return $anchoragent;
}

/**
 *    收到的礼物
 *    $uid 用户ID 
 *    return array
 *    by ya   
 */
function index_receive_gift($uid=0,$limit=10)
{
	$query = DB::query("SELECT COUNT(*) FROM ".DB::table('common_magiclog')." WHERE targetuid='{$uid}' AND action='3'");
	//$multipage = multi(DB::result($query, 0), $_G['tpp'], $page, 'home.php?mod=magic&action=log&amp;operation=receivelog');

	$query = DB::query("SELECT ml.*, me.username FROM ".DB::table('common_magiclog')." ml
			LEFT JOIN ".DB::table('common_member')." me ON me.uid=ml.uid
			WHERE ml.targetuid='{$uid}' AND ml.action='3' ORDER BY ml.dateline DESC
			LIMIT {$limit}");
	while($log = DB::fetch($query)) 
	{
		$log['dateline'] = dgmdate($log['dateline'], 'u');
		//$log['name'] = $magicarray[$log['magicid']]['name'];
		$loglist[] = $log;
	}
	return $loglist;
}

/**
 *    是否管理员
 *    $uid 用户ID 
 *    return int
 *    by ya   
 */
function index_is_admin($uid=0)
{
	$query = DB::query("SELECT COUNT(*) FROM ".DB::table('ucenter_admins')." WHERE uid='{$uid}'");
	return DB::result($query, 0);
}

/**
 *    加入fans
 *    $uid 用户ID 
 *    return int
 *    by ya   
 */
function index_add_fans($arr=array())
{
	return DB::insert('forum_groupuser', $arr,1);
}
/**
 *    返回粉丝圈主的信息 
 *    $uid 用户ID 
 *    return array
 *    by ya   
 */
function index_get_fansower($touid=0)
{
	$query_ower = DB::query("SELECT * FROM ".DB::table('forum_groupuser')." WHERE uid='{$touid}' AND `level`=5 LIMIT 1");
	return  DB::fetch($query_ower);
}

/**
 *    参加的赛事
 *    $uid 用户ID 
 *    return array
 *    by ya   
 */
function index_participate_rank($uid=0 ,$limit=6)
{
	$result=array();
	$query = DB::query("SELECT scores, rank_id FROM ".DB::table('rank_member')." WHERE uid='{$uid}' ORDER BY dateline DESC LIMIT {$limit}");
	while($res= DB::fetch($query))
	{
		$query_rank = DB::query("SELECT logo,`name` FROM ".DB::table('rank_list')." WHERE id='{$res['rank_id']}' AND `status` < 3 LIMIT 1");
		$rank=DB::fetch($query_rank);
		$result[]=array_merge($res,$rank);
	}
	return $result;
}
/**
 *    是否已经投过票
 *    $uid 用户ID 
 *    $rank_id 赛事ID
 *    $touid 被投票的用户ID
 *    return int
 *    by ya   
 */
function index_get_vote($uid=0,$rank_id=0,$touid=0)
{
	$query = DB::query("SELECT COUNT(*) FROM ".DB::table('rank_vote')." WHERE uid='{$uid}' AND rank_id={$rank_id} AND vote_id={$touid}");
	return DB::result($query, 0);
}
/**
 *    更新投票数
 *    $uid 用户ID 
 *    $rank_id 赛事ID
 *    return int
 *    by ya   
 */
function index_update_vote($uid=0,$rank_id=0)
{
	 return DB::query("UPDATE ".DB::table('rank_member')." SET `vote`=`vote` + 1 WHERE uid = ($uid) AND rank_id={$rank_id}");
}

/**
 * 创建房间
 * @param $uid
 * @param $type
 * @return int
 */
function cCreateRoom($uid,$type=null) {
	if (empty($type)){
		$sql = "SELECT type FROM ".DB::table('live_room')." WHERE uid=$uid ";
		$rs = DB::fetch_first($sql);
		if ($rs){
			$type=$rs['type'];
		}else{
			$type=1;
		}
	}
	$uid = intval($uid);
	$userInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE uid=$uid");
	if (! empty($userInfo)) {
		$rs = DB::fetch_first("SELECT roomid FROM ".DB::table('live_room')." WHERE uid=$uid ");
		if (empty($rs['roomid'])) {
			$data = array(
				'roomid'=>$uid,
				'uid'=>$uid,
				'username'=>$userInfo['username'],
				'dateline'=>time(),
			    'type'=>$type
			);
			DB::insert('live_room', $data);
			$roomid =$uid;
			
			$dataConfig = array('uid'=>$uid,'roomtitle'=>$userInfo['username']);
			DB::insert('live_room_config', $dataConfig);
			return $roomid;
		} else {
			$sql = "UPDATE ".DB::table('live_room')." SET dateline = '".time()."' ,type='$type' WHERE roomid = ".$rs['roomid'];
			DB::query($sql);
			$roomid = $rs['roomid'];
		}
		return $roomid;
	} else {
		return 0;
	}
}

/**
 * 获取主播类型
 */

function GetTypee($uid){
	return DB::result_first("SELECT type FROM ".DB::table('live_room')." WHERE uid=$uid ");
		
}
/**
 * 进入房间
 * @param $uid int
 * @param $roomid int
 * @param $level int
 * @return bool
 */
function cInRoom($uid, $roomid, $level) {
	$uid = intval($uid);
	$roomid = intval($roomid);
	$level = intval($level);
	
	$userInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE uid=$uid");
	
	if (! empty($userInfo) && $uid > 0 && $roomid > 0 && $level > 0) {
		$username = $userInfo['username'];
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_room_member')." WHERE roomid=$roomid AND uid=$uid");
		if ($count) {			
			return true;
		} else {
			$data = array(
				'roomid'=>$roomid,
				'uid'=>$uid,
				'username'=>$username,
				'level'=>$level,
				'contribution'=>0,
				'dateline'=>time()
			);
			DB::insert('live_room_member', $data);
			
			$memberCount = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_member_count')." WHERE uid=$uid");
			if (empty($memberCount)) {
				$data = array(
					'uid'=>$uid,
					'username'=>$username,
					'level'=>1,
					'contribution'=>0,
					'charm'=>0
				);
				DB::insert('live_member_count', $data);
			}
			
			return true;
		}
	} else {
		return false;
	}
}

/**
 * 进入$targetuid的房间
 * @param $uid int
 * @param $targetuid int
 * @param $level int
 * @return bool
 */
function cInWhoseRoom($uid, $targetuid, $level) {
	$targetuid = intval($targetuid);
	
	$roomid = cGetRoomid($targetuid);
	$back = cInRoom($uid, $roomid, $level);
	if ($back) {
		;
	}
	return $back;
}

/**
 * 获得主播当前所在的房间号
 * @param $uid
 * @return int
 */
function cGetRoomid($uid) {
	$uid= $uid ? $uid :0;
	$roomInfo = DB::fetch_first("SELECT roomid FROM ".DB::table('live_room')." WHERE  uid=$uid");
	if (!empty($roomInfo)) {
		return $roomInfo['roomid'];
	} else {
		return 0;
	}
}

/**
 * 
 *获取场次ID
 * @param integer $roomid
 */
function cGetRoomLogId($uid){
	$sql = "SELECT id  FROM ".DB::table('live_room_log')." WHERE  uid=$uid ORDER BY id DESC LIMIT 1";
	$roomLogInfo = DB::fetch_first($sql);
	if (!empty($roomLogInfo)) {
		return $roomLogInfo['id'];
	} else {
		return false;
	}
}
/**
 * 粉丝排行榜
 * @param $uid int
 * @param $num int
 * @return array
 */
function cGetFansTop($uid, $num = 10, $period = 'all') {
	$toplist = array();
	$uid = intval($uid);
	if ($uid > 0) {
		
		//+memcache缓存 2011.06.24 zhangcj
		$memcache = new cmemcache();
		$data = $memcache->get("live_fans2_$period-$uid");
		if ($data !== false) {
			$toplist = $data;
		} else {
			switch ($period) {
				case 'day':
					$datelineStart = strtotime(date('Y-m-d')." 00:00:00");
					/*
					$query = DB::query("SELECT gl.uid,gl.username,SUM(gl.value) AS contribution,m.nickname,m.groupid 
						FROM pre_live_gift_log gl 
						LEFT JOIN pre_common_member m ON m.uid=gl.uid 
						WHERE gl.targetuid=$uid AND gl.action=1 AND gl.dateline>$datelineStart 
						GROUP BY gl.uid 
						ORDER BY contribution DESC LIMIT $num");
					*/
					$query = DB::query("SELECT gl.uid,gl.username,SUM(gl.VALUE) AS contribution,pre_common_member.nickname,pre_common_member.groupid,pre_live_member_count.charm FROM pre_live_gift_log gl
							LEFT JOIN (pre_common_member,pre_live_member_count) ON (pre_common_member.uid=gl.uid AND 
							pre_live_member_count.uid=pre_common_member.uid)
							WHERE gl.targetuid=$uid AND gl.ACTION=1 AND gl.dateline>$datelineStart 
							GROUP BY gl.uid ORDER BY contribution DESC LIMIT $num");
					break;
				case 'month':
					//代码有问题，不能获得charm
					/*
					$query = DB::query("SELECT gl.uid,gl.username,SUM(gl.value) AS contribution,m.nickname,m.groupid 
						FROM pre_live_gift_log gl 
						LEFT JOIN pre_common_member m ON m.uid=gl.uid 
						WHERE gl.targetuid=$uid AND gl.action=1 AND gl.dateline > UNIX_TIMESTAMP()-30*24*3600 
						GROUP BY gl.uid 
						ORDER BY contribution DESC LIMIT $num");
					*/
					$query = DB::query("SELECT gl.uid,gl.username,SUM(gl.VALUE) AS contribution,pre_common_member.nickname,pre_common_member.groupid,pre_live_member_count.charm FROM pre_live_gift_log gl
							LEFT JOIN (pre_common_member,pre_live_member_count) ON (pre_common_member.uid=gl.uid AND 
							pre_live_member_count.uid=pre_common_member.uid)
							WHERE gl.targetuid=$uid AND gl.ACTION=1 AND gl.dateline > UNIX_TIMESTAMP()-30*24*3600 
							GROUP BY gl.uid ORDER BY contribution DESC LIMIT $num");
					break;
				default:
					$query = DB::query("SELECT gl.uid,gl.username,SUM(gl.VALUE) AS contribution,pre_common_member.nickname,pre_common_member.groupid,pre_live_member_count.charm FROM pre_live_gift_log gl
							LEFT JOIN (pre_common_member,pre_live_member_count) ON (pre_common_member.uid=gl.uid AND 
							pre_live_member_count.uid=pre_common_member.uid)
							WHERE gl.targetuid=$uid AND gl.ACTION=1  AND gl.dateline>0
							GROUP BY gl.uid ORDER BY contribution DESC LIMIT $num");
					/*
					$query = DB::query("SELECT c.uid,c.username,m.nickname,c.contribution,m.groupid,l.charm FROM ".DB::table('live_contribution')." c
						LEFT JOIN ".DB::table('common_member')." m ON m.uid=c.uid
						LEFT JOIN ".DB::table('live_member_count')." l ON l.uid=c.uid
						WHERE targetuid=$uid ORDER BY contribution DESC LIMIT $num");
						*/
					break;
			}
			
			while($rs = DB::fetch($query)) {
				//$groupInfo = DB::fetch_first("SELECT stars FROM ".DB::table('common_usergroup')." WHERE groupid='".$rs['groupid']."'");
				//$rs['stars'] = $groupInfo['stars'];
				if ($rs['nickname']) $rs['username']= $rs['nickname'];
				$charm_levelInfo = cGetCharmLevel($rs['charm']); //?$rs['charm']
				$huoshow_levelInfo = cGetHuoshowLevel(HuoShowGetConsume($rs['uid']));
				$rs['charm_level'] = $charm_levelInfo['level'];
				$rs['huoshow_level'] = $huoshow_levelInfo['level'];
				$rs['level1'] = $rs['charm_level'];
				$rs['level2'] .= $rs['huoshow_level'];
				$rs['avatar'] = avatar1($rs['uid'], 'small',true,false,true); 
				$toplist[] = $rs;
			}
			//printf($toplist);
			$memcache->set("live_fans2_$period-$uid", $toplist, 600);
		}
		$memcache->close();
		//end
		
	}
	return $toplist;
}

/**
 * 礼物类型
 * @return array
 */
function cGetGiftType() {
	$giftType = array();
	$query = DB::query("SELECT typeid,name FROM ".DB::table('live_gift_type')." ORDER BY displayorder ASC");
	while ($rs = DB::fetch($query)) {
		$giftType[] = $rs;
	}
	return $giftType;
}
/**
 * 是否明星会员
 * @param int char $u用户ID或用户名
 * @param $type int 0用户uid，1用户名
 * @return array
 */
function index_live_user_value($u,$type=0)
{
	if($type)
	{
		$query = DB::query("SELECT level FROM ".DB::table('live_member_count')." WHERE username='{$u}' LIMIT 1");
		$res = DB::fetch($query);
	}
	else 
	{
		$query = DB::query("SELECT level FROM ".DB::table('live_member_count')." WHERE uid='{$u}'  LIMIT 1");
		$res = DB::fetch($query);
	}
	if($res)
	{
		if($res['level']=='2')
		{
			return 1;
		}
		else 
		{
			return 0;
		}
	}
	else 
	{
		return 0;
	}
}
/**
 * 是否火秀经纪人
 * @param int $uid 用户ID
 * @return Boolean
 */
function isBroker($uid)
{
	$query = DB::query("SELECT isagent FROM ".DB::table('live_member_count')." WHERE uid='$uid'  LIMIT 1");
	$res = DB::fetch($query);
	return $res["isagent"];
}
/**
 * 礼物数
 * @param $typeid int
 * @return int
 */
function cGetGiftNum($typeid = null) {
	$sql = ' WHERE 1';
	if (!empty($type)) {
		$sql .= " AND typeid=$typeid";
	}
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_gift')."$sql");
	return $count;
}

/**
 * 获得礼物列表
 * @param $typeid int
 * @param $tpp int
 * @param $page int
 * @return array
 */
function cGetGift() {
	$gift = array();
	
	$query = DB::query("SELECT * FROM ".DB::table('live_gift')." WHERE available=1");
	while ($rs = DB::fetch($query)) {
		$gift[$rs['typeid']][] = $rs;
	}
	return $gift;
}
//礼物排名
function cGetGiftpai($uid) {
		$memcache = new cmemcache();
		$data = $memcache->get("live_gift_hot_$uid");
		if ($data !== false) {
			$giftpai = $data;
		} 
		else 
		{
			$query=DB::query("SELECT b.name as giftname,a.num,b.price as giftprice,a.giftid,b.identifier,b.image,
			                 (select count(*) from ".DB::table('live_member_gift_count')." s where s.num>a.num and s.giftid=a.giftid)+1 as top 
			                 from ".DB::table('live_member_gift_count')." a inner JOIN ".DB::table('live_gift')." b ON a.giftid=b.giftid 
			                 WHERE a.uid=$uid AND a.num >0 and b.available=1 and b.rank=1 order by a.num,a.giftid desc ");
			while($rs = DB::fetch($query)) 
			{
				$giftpai[]=$rs;
			}
			$memcache->set("live_gift_hot_$uid", $giftpai, CMEMCACHE_LIVE_GIFTHOT);
		}
		$memcache->close();
		return $giftpai;
}

/**
 * 用户神秘礼物排名
 *
 * @param unknown_type $uid
 */
function cGetPartyUserGiftRanking($uid) {
	$memcache = new cmemcache();
	$data = $memcache->get("pre_live_party_user_box_gift_log_$uid");
	if ($data !== false) {
		$PartyUserGiftRanking = $data;
	} 
	else {
		$sql = "SELECT a.uid,a.gift_num,a.party_gift_id,
		(SELECT img FROM pre_live_party_gift_list p WHERE p.id=a.party_gift_id) AS img,
(SELECT party_gift_name FROM pre_live_party_gift_list p WHERE p.id=a.party_gift_id) AS party_gift_name,
(SELECT COUNT(*) FROM pre_live_party_user_box_gift_log s WHERE s.gift_num > a.gift_num AND s.party_gift_id=a.party_gift_id)+1 AS top
FROM pre_live_party_user_box_gift_log a WHERE a.uid=$uid ORDER BY a.gift_num DESC";
		$query=DB::query($sql);
		while($rs = DB::fetch($query)) {
			$PartyUserGiftRanking[]=$rs;
		}
		$memcache->set("pre_live_party_user_box_gift_log_$uid", $PartyUserGiftRanking, CMEMCACHE_LIVE_GIFTHOT);
	}
	$memcache->close();
	return $PartyUserGiftRanking;
}
	
/**
 * 获得礼物列表(1维)
 * @param $typeid int
 * @param $tpp int
 * @param $page int
 * @return array
 */
function cGetGiftAll() {
	$gift = array();
	
	$query = DB::query("SELECT * FROM ".DB::table('live_gift'));
	while ($rs = DB::fetch($query)) {
		$gift[] = $rs;
	}
	return $gift;
}


function cGetCharmTop($way = 'day', $num = 10) {
	//+memcache缓存 2011.07.16 zhangcj
	$memcache = new cmemcache();
	$data = $memcache->get("live_charmtop_$way-$num");
	if ($data !== false) {
		$top = $data;
	} else {
		$top = array();
		if ($way == 'all') {
			$query = DB::query("SELECT c.uid,c.charm,m.username,if(m.nickname!='',m.nickname,m.username) as nickname  
			FROM ".DB::table('live_member_count')." c
			LEFT JOIN ".DB::table('common_member')." m ON m.uid=c.uid 
			WHERE c.charm>0 AND c.uid IN(SELECT uid FROM ".DB::table('live_member_count')." WHERE level=2) 
			AND c.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
			AND c.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
			ORDER BY c.charm DESC LIMIT $num");
			$i = 0;
			while ($rs = DB::fetch($query)) {
				$levelInfo = cGetCharmLevel($rs['charm']);
				$top[$i]['uid'] = $rs['uid'];
				$top[$i]['nickname'] = $rs['nickname'];
				$top[$i]['amount'] = $rs['charm'];
				$top[$i]['level'] = $levelInfo['level'];
				$i++;
			}
		} else {
			switch ($way) {
				case 'day':
					$sql = ' ORDER BY t.daynum DESC';
					break;
				case 'week':
					$sql = ' ORDER BY t.weeknum DESC';
					break;
				case 'month':
					$sql = ' ORDER BY t.monthnum DESC';
					break;
			}
			
			$query = DB::query("SELECT t.*,c.charm as ch,m.username,if(m.nickname!='',m.nickname,m.username) as nickname 
			FROM ".DB::table('live_top')." as t left join ".DB::table('live_member_count')." as c on t.uid=c.uid 
			LEFT JOIN ".DB::table('common_member')." m ON m.uid=c.uid
			WHERE t.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
			AND t.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
			AND t.cate='charm'$sql LIMIT $num");
			$i = 0;
			$getNum = 0;
			$userIdArr = array();
			$userIdArr[] = 0;
			while ($rs = DB::fetch($query)) {
				switch ($way) {
					case 'day':
						$amount = $rs['daynum'];
						break;
					case 'week':
						$amount = $rs['weeknum'];
						break;
					case 'month':
						$amount = $rs['monthnum'];
						break;
				}
				$levelInfo = cGetCharmLevel($rs['ch']);
				$top[$i]['uid'] = $rs['uid'];
				$top[$i]['nickname'] = $rs['nickname'];
				$top[$i]['amount'] = $amount;
				$top[$i]['level'] = $levelInfo['level'];
				$i++;
				$userIdArr[] = $rs['uid'];
			}
			$getNum = $i;
		}
		$memcache->set("live_charmtop_$way-$num", $top, 3);	
	}
	$memcache->close();

	return $top;
}

/**
 * 魅力值排行分页
 * @param $num int
 * @return array
 */
function cGetCharmTopmul($way = 'day', $num = 10,$page = 1) {
		
	$start_limit = ($page - 1) * $num;
	$top = array();
	if ($way == 'all') {
		$query = DB::query("SELECT c.uid,c.charm,m.username,if(m.nickname!='',m.nickname,m.username) as nickname 
		FROM ".DB::table('live_member_count')." c LEFT JOIN ".DB::table('common_member')." m ON m.uid=c.uid
		WHERE c.charm>0 AND c.uid IN(SELECT uid FROM ".DB::table('live_member_count')." WHERE level=2) 
		AND c.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND c.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
		ORDER BY c.charm DESC LIMIT $start_limit,$num");
		$i = 0;
		while ($rs = DB::fetch($query)) {
			$levelInfo = cGetCharmLevel($rs['charm']);
			$top[$i]['uid'] = $rs['uid'];
			$top[$i]['nickname'] = $rs['nickname'];
			$top[$i]['amount'] = $rs['charm'];
			$top[$i]['level'] = $levelInfo['level'];
			$i++;
		}
	} else {
		switch ($way) {
			case 'day':
				$sql = ' AND t.daynum>0 ORDER BY t.daynum DESC';
				break;
			case 'week':
				$sql = ' AND t.weeknum>0 ORDER BY t.weeknum DESC';
				break;
			case 'month':
				$sql = ' AND t.monthnum>0 ORDER BY t.monthnum DESC';
				break;
		}
		
		$query = DB::query("SELECT t.*,c.charm as ch,m.username,if(m.nickname!='',m.nickname,m.username) as nickname
		FROM ".DB::table('live_top')." as t left join ".DB::table('live_member_count')." as c on t.uid=c.uid 
		LEFT JOIN ".DB::table('common_member')." m ON m.uid=c.uid
		WHERE t.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND t.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
		AND t.cate='charm'$sql LIMIT $start_limit,$num");
		$i = 0;
		while ($rs = DB::fetch($query)) {
			switch ($way) {
				case 'day':
					$amount = $rs['daynum'];
					break;
				case 'week':
					$amount = $rs['weeknum'];
					break;
				case 'month':
					$amount = $rs['monthnum'];
					break;
			}
			$levelInfo = cGetCharmLevel($rs['ch']);
			$top[$i]['uid'] = $rs['uid'];
			$top[$i]['nickname'] = $rs['nickname'];
			$top[$i]['amount'] = $amount;
			$top[$i]['level'] = $levelInfo['level'];
			$i++;
		}
	}

	return $top;
}
/**
 * 
 * 投票排行
 */
function cGetZhishuTopList(){
	$list = array();	
	
	$list['week'] = cGetCharmScoreTop('week', 10);
	$list['month'] = cGetCharmScoreTop('month', 10);
	$list['all'] = cGetCharmScoreTop('all', 10);	
	return $list;
}
/**
 * 魅力指数排行
 * @param $num int
 * @return array
 */
function cGetCharmScoreTop($type = 'day', $num = 10) {
	
	//+memcache缓存 2011.07.16 zhangcj
	$memcache = new cmemcache();
	$data = $memcache->get("live_charmscoretop_$type-$num");
	if ($data !== false) {
		$list = $data;
	} else {
		$list = array();
		
		if ($type == 'all') {//all		
			
			//最大魅力值
			$maxCharm = DB::result_first("SELECT charm 
				FROM pre_live_member_count 
				WHERE uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) 
				AND uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) 
				ORDER BY charm DESC 
				LIMIT 1");
			
			//最大投票
			$maxVote = DB::result_first("SELECT totalnum 
				FROM pre_live_top 
				WHERE cate='vote' 
				AND uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) 
				AND uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0)
				ORDER BY totalnum DESC 
				LIMIT 1");
			
			//列表
			$addSql = '';
			if ($maxCharm) {
				$addSql .= "tmp.charm*6000/$maxCharm";
			}
			if ($maxVote) {
				$addSql = $addSql ? $addSql."+tmp.vote*4000/$maxVote" : "tmp.vote*4000/$maxVote";
			}
			$addSql = $addSql ? "($addSql) AS amount" : 'tmp.vote AS amount';
			
			$query = DB::query("
				SELECT tmp.uid,tmp.vote,tmp.charm,if(m.nickname!='',m.nickname,m.username) as nickname,$addSql 
				FROM 
					(SELECT t.uid,t.totalnum AS vote,c.charm 
					FROM pre_live_top t 
					LEFT JOIN pre_live_member_count c ON c.uid=t.uid 
					WHERE t.uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1)
					AND t.uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) 
					AND t.cate='vote') tmp 
				LEFT JOIN pre_common_member m ON m.uid=tmp.uid 
				ORDER BY amount DESC 
				LIMIT $num");
			
			while($rs = DB::fetch($query)) {
				$levelInfo = cGetCharmLevel($rs['charm']);
				$rs['level'] = $levelInfo['level'];
				$rs['amount'] = floor($rs['amount']);
				$list[] = $rs;
			}
		} else {//天，周，月
			switch($type) {
				case 'day':
					$clum = 'daynum';
					break;
				case 'week':
					$clum = 'weeknum';
					break;
				case 'month':
					$clum = 'monthnum';
					break;
			}
			
			//最大魅力值
			$maxCharm = DB::result_first("SELECT $clum 
				FROM pre_live_top 
				WHERE cate = 'charm' 
				AND uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) 
				AND uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) 
				ORDER BY $clum DESC 
				LIMIT 1");
			
			//最大投票
			$maxVote = DB::result_first("SELECT $clum 
				FROM pre_live_top 
				WHERE cate='vote' 
				AND uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) 
				AND uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0)
				ORDER BY $clum DESC 
				LIMIT 1");
			
			//列表
			$addSql = '';
			if ($maxCharm) {
				$addSql .= "tmp.charm*6000/$maxCharm";
			}
			if ($maxVote) {
				$addSql = $addSql ? $addSql."+tmp.vote*4000/$maxVote" : "tmp.vote*4000/$maxVote";
			}
			$addSql = $addSql ? "($addSql) AS amount" : 'tmp.vote AS amount';
			
			$query = DB::query("
				SELECT tmp.uid,tmp.charm,tmp.vote,if(m.nickname!='',m.nickname,m.username) as nickname,$addSql 
				FROM 
					(SELECT a.uid,a.charm,b.vote 
					FROM
						(SELECT uid,$clum AS charm 
						FROM pre_live_top 
						WHERE cate='charm') a,
						(SELECT uid,$clum AS vote 
						FROM pre_live_top 
						WHERE cate='vote') b 
					WHERE a.uid=b.uid) tmp
				LEFT JOIN pre_common_member m ON m.uid=tmp.uid 
				ORDER BY amount DESC 
				LIMIT $num");
			
			while($rs = DB::fetch($query)) {
				$levelInfo = cGetCharmLevel($rs['charm']);
				$rs['level'] = $levelInfo['level'];
				$rs['amount'] = floor($rs['amount']);
				$list[] = $rs;
			}
		}
		
		$memcache->set("live_charmscoretop_$type-$num", $list, 3);	
	}
	$memcache->close();
	//end
	
	return $list;
}

/**
 * 魅力指数排行分页
 * @param $num int
 * @return array
 */
function cGetCharmScoreTopmul($way = 'day', $num = 10,$page = 1) {
		
	$start_limit = ($page - 1) * $num;
	$top = array();
	if ($way == 'all') {
		$query = DB::query("SELECT c.uid,c.charm,m.username,if(m.nickname!='',m.nickname,m.username) as nickname 
		FROM ".DB::table('live_member_count')." c LEFT JOIN ".DB::table('common_member')." m ON m.uid=c.uid
		WHERE c.charm>0 AND c.uid IN(SELECT uid FROM ".DB::table('live_member_count')." WHERE level=2) 
		AND c.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND c.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
		ORDER BY c.charm DESC LIMIT 0,10000");
		$i = 0;
		$maxCharm = DB::fetch_first("SELECT charm FROM ".DB::table('live_member_count')."  WHERE 
		uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 		
		ORDER BY  charm  
		DESC LIMIT 1 ");
		$maxCharm=$maxCharm['charm'];
		while ($rs = DB::fetch($query)) {
			$levelInfo = cGetCharmLevel($rs['charm']);
			$top[$i]['uid'] = $rs['uid'];
			$top[$i]['nickname'] = $rs['nickname'];
			$top[$i]['amount'] = $rs['charm'];
			$top[$i]['level'] = $levelInfo['level'];
			$i++;
		}
	} else {
		switch ($way) {
			case 'day':
				$clum = 'daynum';
				$sql = ' AND t.daynum>0 ORDER BY t.daynum DESC';
				break;
			case 'week':
				$clum = 'weeknum';
				$sql = ' AND t.weeknum>0 ORDER BY t.weeknum DESC';
				break;
			case 'month':
				$clum = 'monthnum';
				$sql = ' AND t.monthnum>0 ORDER BY t.monthnum DESC';
				break;
		}
		$maxCharm = DB::fetch_first("SELECT * FROM ".DB::table('live_top')." WHERE 
		uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
		AND cate like 'charm'
		ORDER BY  $clum 
		DESC LIMIT 1");
		$maxCharm=$maxCharm[$clum];
		$query = DB::query("SELECT t.*,c.charm as ch,m.username,if(m.nickname!='',m.nickname,m.username) as nickname
		FROM ".DB::table('live_top')." as t left join ".DB::table('live_member_count')." as c on t.uid=c.uid 
		LEFT JOIN ".DB::table('common_member')." m ON m.uid=c.uid
		WHERE t.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND t.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
		AND t.cate='charm'$sql LIMIT 0,10000");
		$i = 0;
		
		while ($rs = DB::fetch($query)) {
			switch ($way) {
				case 'day':
					$amount = $rs['daynum'];
					break;
				case 'week':
					$amount = $rs['weeknum'];
					break;
				case 'month':
					$amount = $rs['monthnum'];
					break;
			}
			$levelInfo = cGetCharmLevel($rs['ch']);
			$top[$i]['uid'] = $rs['uid'];
			$top[$i]['nickname'] = $rs['nickname'];
			$top[$i]['amount'] = $amount;
			
			$top[$i]['level'] = $levelInfo['level'];
			$i++;
		}
	}
	
	
	$sql2 = "SELECT t.* FROM ".DB::table('live_top')." t WHERE uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
			AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) and cate like 'vote'  ".$sql;
	$query = DB::query($sql2);
	$maxVote = 0;
	$i=0;
	$vote = array();
	while ($rs = DB::fetch($query)) {
		switch ($way) {
			case 'day':
				$amount = $rs['daynum'];
				break;
			case 'week':
				$amount = $rs['weeknum'];
				break;
			case 'month':
				$amount = $rs['monthnum'];
				break;
			case 'all':
				$amount = $rs['totalnum'];
				break;
		}
		if ($maxVote<$amount) $maxVote=$amount;
		$vote[$i]['uid']=$rs['uid'];		
		$vote[$i]['amount']=$amount;		
		$i++;
	}
	$i=0;
	foreach ($top as $key=>$value){
		
		$uid = $value['uid'];
		$thisUserVote = 0;
		$thisUserCharm = $value['amount'];
		foreach ($vote as $k=>$v){
			if ($v['uid']==$uid){
				$thisUserVote = $v['amount'];
				break;
			}
		}
		if ($thisUserVote==0) {
			$MV=1;
		} else{
			$MV = $maxVote;
		}
		if ($thisUserCharm==0) {
			$MC=1;
		}	else{
			$MC = $maxCharm;
		}	
		$value['amount'] = ($thisUserCharm/$MC*0.6+$thisUserVote/$MV*0.4)*(1*10000);
		$res[$i]=$value;
		$i++;
	}	
	foreach ($res as $k=>$v){
		$tmp[] = $v['amount'];
		
	}
	array_multisort($tmp,SORT_DESC,$res);
	$i=1;
	//print_r($res);
	foreach ($res as $k=>$v){		
		if ($start_limit<$i){
			$v['amount'] = floor($v['amount']);
			$rst[] = $v;
		}
		if ($i==($start_limit+$num)) break;
		$i++;
		
	}	
	
	return $rst;
}
/**
 * 
 * 投票排行
 */
function cGetVoteTopList(){
	$list = array();	
	
	$list['week'] = getLiveVoteTop('weeknum', 10);
	$list['month'] = getLiveVoteTop('monthnum', 10);
	$list['all'] = getLiveVoteTop('totalnum', 10);	
	return $list;
}
/**
 * 
 * 获取投票排行榜
 * @param unknown_type $way
 * @param unknown_type $num
 */
function getLiveVoteTop($way, $num = 10) 
{
	$sql = "SELECT t.uid,t.$way as amount, if(m.nickname!='',m.nickname,m.username) as nickname FROM ".DB::table('live_top')." t 
	LEFT JOIN ".DB::table('common_member')." m ON t.uid=m.uid 
	WHERE t.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND t.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
		AND t.cate='vote' ORDER BY t.$way DESC limit  $num ";
	$query = DB::query($sql);
	while ($res = DB::fetch($query))
	{
		$list[] = $res;
	}
	return $list;
}
/**
 * 
 * 获取投票排行榜分页
 * @param unknown_type $way
 * @param unknown_type $num
 */
function getLiveVoteTopMul($way, $num = 10,$page = 1) {
		
	$start_limit = ($page - 1) * $num;

	$sql = "SELECT t.uid,t.$way as amount, if(m.nickname!='',m.nickname,m.username) as nickname FROM ".DB::table('live_top')." t 
	LEFT JOIN ".DB::table('common_member')." m ON t.uid=m.uid 
	WHERE t.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND t.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
		AND t.cate='vote' ORDER BY t.$way DESC limit $start_limit,$num ";
	$query = DB::query($sql);
	while ($res = DB::fetch($query))
	{
		$list[] = $res;
	}
	return $list;
}
/**
 * 
 * 获取主播排行榜信息
 * @param unknown_type $uid
 */
function getRoomerLiveTop($uid){
	
	$memcache = new cmemcache();
	$data = $memcache->get("live_main_broad_hot_$uid");
	if ($data !== false) 
	{
			$backinfo = $data;
	}
	else 
	{
	
		$sql = "SELECT monthnum FROM ".DB::table('live_top')." WHERE cate like 'charm' AND uid = $uid limit 1 ";
		$charm = DB::fetch_first($sql);
		$thisUserCharm = $charm['monthnum'];
		
		$sql = "SELECT monthnum FROM ".DB::table('live_top')." WHERE cate like 'vote' AND uid = $uid limit 1 ";
		$vote = DB::fetch_first($sql);
		$thisUserVote = $vote['monthnum'];
		
		$sql = "SELECT * FROM ".DB::table('live_top')." WHERE 
		uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
		AND cate like 'charm'
		ORDER BY  monthnum  
		DESC LIMIT 1";
		$maxCharm = DB::fetch_first($sql);
		$MC = $maxCharm['monthnum'];
		$sql = "SELECT * FROM ".DB::table('live_top')." WHERE 
		uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
		AND cate like 'vote'
		ORDER BY  monthnum  
		DESC LIMIT 1";
		$maxVote = DB::fetch_first($sql);
		$MV = $maxVote['monthnum'];
		
		$score = ($thisUserCharm/$MC*0.6+$thisUserVote/$MV*0.4)*(1*10000);
		
		
		$allZhishu = cGetCharmScoreTopmul ( 'month', 10000, 1 );	
		$um = 0;
		
		for ($i=0;$i<count($allZhishu);$i++){
			if ($allZhishu[$i]['uid']==$uid) {
				$um = $i+1;
				break;
			}
		}
		
		$backinfo = array('charm'=>$charm['monthnum']+0,'vote'=>$vote['monthnum']+0,'score'=>floor($score)+0,'paiming'=>$um);
		$memcache->set("live_main_broad_hot_$uid", $backinfo, 3600);
	}
	return $backinfo;
}
/**
 * 财富排行分页
 * @param $num int
 * @return array
 */
function cGetHuoshowTopmul($way = 'day', $num = 10,$page = 1) {
	$start_limit = ($page - 1) * $num;
	$top = array();
	if ($way == 'all') {
//		$query = DB::query("SELECT s.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname
//		FROM ".DB::table('ucenter_showcoin')." s 
//		LEFT JOIN ".DB::table('common_member')." m ON m.uid=s.uid 
//		WHERE s.consume>0 AND s.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1)
//		AND s.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
//		ORDER BY s.consume DESC LIMIT $start_limit,$num");
		$query = DB::query("SELECT l.uid,l.totalnum as consume,IF(m.nickname!='',m.nickname,m.username) AS nickname FROM pre_live_top l 
			LEFT JOIN pre_common_member m ON m.uid=l.uid WHERE 
			l.uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) AND 
			l.uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) AND cate='huoshow' 
			ORDER BY totalnum DESC LIMIT $start_limit,$num");
		$i = 0;
		while ($rs = DB::fetch($query)) {
			$showcoin = $rs['consume'];
			$levelInfo = cGetHuoshowLevel($showcoin);
			$top[$i]['uid'] = $rs['uid'];
			$top[$i]['nickname'] = $rs['nickname'];
			$top[$i]['amount'] = $showcoin;
			$top[$i]['level'] = $levelInfo['level'];
			$i++;
		}
	} else {
		switch ($way) {
			case 'day':
				$sql = ' AND daynum>0 ORDER BY daynum DESC';
				break;
			case 'week':
				$sql = ' AND weeknum>0 ORDER BY weeknum DESC';
				break;
			case 'month':
				$sql = ' AND monthnum>0 ORDER BY monthnum DESC';
				break;
		}
		
		$query = DB::query("SELECT l.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname
		FROM ".DB::table('live_top')." l LEFT JOIN ".DB::table('common_member')." m ON m.uid=l.uid WHERE l.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) AND l.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) AND cate='huoshow'$sql 
		LIMIT $start_limit,$num");
		$i = 0;
		while ($rs = DB::fetch($query)) {
			switch ($way) {
				case 'day':
					$amount = $rs['daynum'];
					break;
				case 'week':
					$amount = $rs['weeknum'];
					break;
				case 'month':
					$amount = $rs['monthnum'];
					break;
			}
			$levelInfo = cGetHuoshowLevel($amount);
			$top[$i]['uid'] = $rs['uid'];
			$top[$i]['nickname'] = $rs['nickname'];
			$top[$i]['amount'] = $amount;
			$top[$i]['level'] = $levelInfo['level'];
			$i++;
		}
	}

	return $top;
}
/**
 * 财富排行
 * @param $num int
 * @return array
 */
function cGetHuoshowTop($way = 'day', $num = 10) {
	$top = array();
	if ($way == 'all') {
		$query = DB::query("SELECT s.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname
		FROM ".DB::table('ucenter_showcoin')." s 
		LEFT JOIN ".DB::table('common_member')." m ON m.uid=s.uid 
		WHERE s.consume>0 AND s.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
		ORDER BY s.consume DESC LIMIT $num");
		$i = 0;
		while ($rs = DB::fetch($query)) {
			$showcoin = $rs['consume'];
			$levelInfo = cGetHuoshowLevel($showcoin);
			$top[$i]['uid'] = $rs['uid'];
			$top[$i]['nickname'] = $rs['nickname'];
			$top[$i]['amount'] = $showcoin;
			$top[$i]['level'] = $levelInfo['level'];
			$i++;
		}
	} else {
		switch ($way) {
			case 'day':
				$sql = ' AND daynum>0 ORDER BY daynum DESC';
				break;
			case 'week':
				$sql = ' AND weeknum>0 ORDER BY weeknum DESC';
				break;
			case 'month':
				$sql = ' AND monthnum>0 ORDER BY monthnum DESC';
				break;
		}
		
		$query = DB::query("SELECT l.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname
		FROM ".DB::table('live_top')." l
		 LEFT JOIN ".DB::table('common_member')." m ON m.uid=l.uid 
		WHERE l.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) AND l.cate='huoshow'$sql 
		LIMIT $num");
		$i = 0;
		while ($rs = DB::fetch($query)) {
			switch ($way) {
				case 'day':
					$amount = $rs['daynum'];
					break;
				case 'week':
					$amount = $rs['weeknum'];
					break;
				case 'month':
					$amount = $rs['monthnum'];
					break;
			}
			$levelInfo = cGetHuoshowLevel($amount);
			$top[$i]['uid'] = $rs['uid'];
			$top[$i]['nickname'] = $rs['nickname'];
			$top[$i]['amount'] = $amount;
			$top[$i]['level'] = $levelInfo['level'];
			$i++;
		}
	}

	return $top;
}

/**
 * 用户A增加对用户B增加的贡献度
 * @param int $uid
 * @param int $targetuid
 * @param int $value
 */
function cContributionAndCharm($uid, $targetuid, $value = 0) {
	$roomid = cGetRoomid($targetuid);
	
	//A对B的贡献度
	$rs = DB::fetch_first("SELECT * FROM ".DB::table('live_contribution')." WHERE uid=$uid AND targetuid=$targetuid");
	if (empty($rs)) {
		$userInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE uid=$uid");		
		$data = array(
			'uid'=>$uid,
			'username'=>$userInfo['username'],
			'targetuid'=>$targetuid,
			'contribution'=>0
		);
		DB::insert('live_contribution', $data);		
	}
	DB::query("UPDATE ".DB::table('live_contribution')." SET contribution=contribution+$value WHERE uid=$uid AND targetuid=$targetuid");
	
	//A对房间的贡献度
	DB::query("UPDATE ".DB::table('live_room_member')." SET contribution=contribution+$value WHERE uid=$uid AND roomid=$roomid");
	
	//魅力值的变动情况
	$charmOld = DB::result_first("SELECT charm FROM ".DB::table('live_member_count')." WHERE uid=$targetuid");
	$charmNow = $charmOld + $value;
	
	//A的贡献度和B的魅力值
	DB::query("UPDATE ".DB::table('live_member_count')." SET contribution=contribution+$value WHERE uid=$uid");
	DB::query("UPDATE ".DB::table('live_member_count')." SET charm=charm+$value WHERE uid=$targetuid");
	
	$targetuserInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE uid=$targetuid");
	$username = $targetuserInfo['username'];
	if ($value) {
		//魅力值排行数据
		$rs = DB::fetch_first("SELECT * FROM ".DB::table('live_top')." WHERE uid=$targetuid AND cate='charm' AND uid=$targetuid");
		if (!empty($rs)) {
			DB::query("UPDATE ".DB::table('live_top')." SET daynum=daynum+$value,weeknum=weeknum+$value,monthnum=monthnum+$value WHERE uid=$targetuid AND cate='charm'");
		} else {
			
			$data = array(
				'cate'=>'charm',
				'uid'=>$targetuid,
				'username'=>$username,
				'daynum'=>$value,
				'weeknum'=>$value,
				'monthnum'=>$value
			);
			DB::insert('live_top', $data);
		}
	}
	
	//魅力等级升级提示
	$charmLevelOld = cGetCharmLevel($charmOld);
	$charmLevelNow = cGetCharmLevel($charmNow);
	if ($charmLevelNow['level'] > $charmLevelOld['level']) {
		MSN_MsgSystem('恭喜'.$username.'主播等级升到'.$charmLevelNow['level'].'级');
	}
}

/**
 * 用户富豪等级
 * @param $amount int
 * @param $type int  1.具体数值，2.用户uid
 * @return array
 */
function cGetHuoshowLevel($amount, $type=1) {
	global $_G;
	
	if (!empty($_G['setting']['level']['huoshow'])) {
		$levelInfo = $_G['setting']['level']['huoshow'];
	} else {
		$query = DB::query("SELECT * FROM ".DB::table('live_level_config')." WHERE type=1 ORDER BY level ASC");
		while ($rs = DB::fetch($query)) {
			$levelInfo[] = $rs;
		}
		$_G['setting']['level']['huoshow'] = $levelInfo;
	}
	
	$result = array();
	
	if ($type == 2) {
		$uid = $amount;
		$amount = SIPHuoShowGetBalance($uid);
	}
	foreach ($levelInfo as $key=>$value) {
		if (	($key == 0 && $amount <= $value['valuelower']) || 
				($key == (count($levelInfo)-1) && $amount >= $value['valuelower']) || 
				($amount >= $value['valuelower'] && $amount <= $value['valuehigher'])	) {
			
			$result['level'] = $value['level'];
			$result['name'] = $value['name'];
			$result['icon'] = $value['icon'];
			break;
		}
	}
	return $result;
}

/**
 * 用户魅力等级
 * @param $amount int
 * @param $type int 1.具体数值，2.用户uid
 * @return array
 */
function cGetCharmLevel($amount, $type=1) {
	global $_G;
	if (!empty($_G['setting']['level']['charm'])) {
		$levelInfo = $_G['setting']['level']['charm'];
	} else {
		$query = DB::query("SELECT * FROM ".DB::table('live_level_config')." WHERE type=2 ORDER BY level ASC");
		while ($rs = DB::fetch($query)) {
			$levelInfo[] = $rs;
		}
		$_G['setting']['level']['charm'] = $levelInfo;
	}
	
	$result = array();
	
	if ($type == 2) {
		$uid = $amount;
		$userInfo = DB::fetch_first("SELECT charm FROM ".DB::table('live_member_count')." WHERE uid=$uid");
		$amount = @$userInfo['charm'];
	}
	
	foreach ($levelInfo as $key=>$value) {
		if (	($key == 0 && $amount <= $value['valuelower']) || 
				($key == (count($levelInfo)-1) && $amount >= $value['valuelower']) || 
				($amount >= $value['valuelower'] && $amount <= $value['valuehigher'])	) {
			
			$result['level'] = $value['level'];
			$result['name'] = $value['name'];
			$result['icon'] = $value['icon'];
			break;
		}
	}
	return $result;
}

/**
 * 写礼物日志，及更新用户数据
 * @param $user int/array
 * @param $targetuser int/array
 * @param $gift int/array
 * @param $num int
 * @param $amount int
 */
function cGiftLogAndUpdateData($user, $targetuser, $gift, $num, $amount,$roominfo) {
	
	if (!is_array($user)) {
		$user = DB::fetch_first("SELECT * FROM ".DB::table('live_member_count')." WHERE uid=$user");
	}
	if (!is_array($targetuser)) {
		$targetuser = DB::fetch_first("SELECT * FROM ".DB::table('live_member_count')." WHERE uid=$targetuser");
	}
	if (!is_array($gift)) {
		$gift = DB::fetch_first("SELECT * FROM ".DB::table('live_gift')." WHERE giftid=$gift");
	}
	
	if (is_array($user) && is_array($targetuser) && is_array($gift) && $num>0 && $amount > 0) {
		$roomid = cGetRoomid($roominfo['uid']);
		$roomlogid = cGetRoomLogId($roominfo['uid']);
		//赠送日志
		$data = array(
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
		DB::insert('live_gift_log', $data);
		
		//接受日志
		$data = array(
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
		DB::insert('live_gift_log', $data);
		
		//用户礼物数
		$userGift = DB::fetch_first("SELECT * FROM ".DB::table('live_member_gift_count')." WHERE uid=".$targetuser['uid']." AND giftid='".$gift['giftid']."'");
		if (empty($userGift)) {
			$data = array(
				'uid'=>$targetuser['uid'],
				'giftid'=>$gift['giftid'],
				'num'=>$num,
			);
			DB::insert('live_member_gift_count', $data);
		} else {
			DB::query("UPDATE ".DB::table('live_member_gift_count')." SET num=num+$num WHERE uid=".$targetuser['uid']." AND giftid='".$gift['giftid']."'");
		}
		
		//增加贡献度与增加魅力值
		cContributionAndCharm($user['uid'], $targetuser['uid'], $amount);
		addActCharm( $targetuser['uid'],$amount);
		
		//+memcache缓存 2011.06.27 zhangcj
		//粉丝列表过期
		$memcache = new cmemcache();
		$memcache->rm("live_fans_all-".$targetuser['uid']);
		$memcache->rm("live_fans_month-".$targetuser['uid']);
		$memcache->rm("live_fans_day-".$targetuser['uid']);
		$memcache->close();
		//end
	}
}
/**
 * 
 * 增加活动魅力值
 * @param INTEGER $uid
 * @param INTEGER $charm
 */
function addActCharm($uid,$charm,$actid=0){
	if ($actid==0){
		$sql = " SELECT a.*  FROM ".DB::table('activity_partner')
			     . " a LEFT JOIN ".DB::table('activity')." b ON a.actid=b.id "		   
			     . " WHERE a.uid = '$uid' AND b.status=2";
		$rs = DB::fetch_first($sql);
		$actid = $rs['actid'];
	}
	
	if ($rs){
		$sql = "UPDATE ".DB::table('activity_partner')." SET charm = charm+$charm WHERE uid=$uid AND actid=$actid";
		DB::query($sql);
	}
}
/**
 * 获得主播信息
 * @return array
 */
function cGetAnchors($tpp, $page=1,$extra='') {
	
	//去掉用数据库来缓存数据
	/*$endTime = time() - 60;
	$dbAnchors = DB::fetch_first("SELECT * FROM ".DB::table("add_setting")." WHERE skey='anchors'");
	if ($dbAnchors['dataline'] > $endTime) {
		$result = unserialize($dbAnchors['svalue']);
	} else {*/
		
		
		//初始化
		$result = array('total'=>0, 'onlineAnchors'=>0, 'onlineMember'=>0, 'list'=>array());
		$limitStart = ($page-1)*$tpp;
		$onlineAnchors = $rooms = $olRoom = array();
	
		//+memcache缓存 2011.06.27 zhangcj
//		$memcache = new cmemcache();
//		$data = $memcache->get("live_hall");
//		if ($data !== false) {
//			$result = $data;
//		} else {		
//			cm.groupid<>1  and
			$where=" r.stat>=0";
			$where=($extra?"$extra and ":'').$where;
			$sql="SELECT r.stat,r.roomid,r.uid,r.username,rc.level,rc.charm,s.consume,if(cm.nickname!='',cm.nickname,cm.username) as nickname ,r.type 
				FROM ".DB::table('live_room')." r 
				LEFT JOIN ".DB::table('live_member_count')." rc ON r.uid=rc.uid 
				LEFT JOIN ".DB::table('ucenter_showcoin')." s ON r.uid=s.uid
				LEFT JOIN ".DB::table('common_member')." cm on r.uid=cm.uid
				WHERE $where ORDER BY rc.charm DESC ";
			$query=DB::query($sql);			
			while($rs=DB::fetch($query)){
				$tmp = cGetCharmLevel($rs['charm'], 1);
				$rs['charmLevel'] = $tmp['level'];
				$tmp = cGetHuoshowLevel($rs['consume'], 1);
				$rs['huoshowLevel'] = $tmp['level'];
				$rs['onlineMember'] = 0;			
				$rs['online'] = 0;		
				$rs['avatar'] = avatar($rs['uid'], 'middle',TRUE,FALSE,TRUE);
				$result['list'][] = $rs;	

				//+在线主播
				if ($rs['stat']==1) {
					$onlineAnchors[] = $rs['roomid'];
				}
				//end
			}		
			
			
			$sql = "SELECT a.roomid,a.uid FROM pre_live_userlist a GROUP BY a.roomid,a.uid ORDER BY a.usertype ASC";
			//echo $sql;		
			$query=DB::query($sql);
			while ($res = DB::fetch($query)){				
				$arr[$res['roomid']][$res['uid']]=$res['uid'];
			}		
			foreach ($arr as $key=>$value) {
				//房间
				$rooms[$key] = count($value);
				
				$result['onlineMember'] += count($value);
				
				if (in_array($key, $onlineAnchors)) {
					$olRoom[] = $key;
				}
			}
			
			$result['onlineAnchors'] = count($olRoom);
			
			//排序
			$arrLeft = $arrRight = array();
			foreach ($result['list'] as $key=>$value) {
				if (array_key_exists($value['uid'], $rooms)) {
					$result['list'][$key]['onlineMember'] = $rooms[$value['uid']];
					//$result['list'][$key]['online'] = max(1, $value['online']);
					if (in_array($value['uid'], $olRoom)) {
						$result['list'][$key]['online'] = 1;
						$arrLeft[] = $result['list'][$key];
					}else {
						if ($result['list'][$key]['level']==2){
							$result['list'][$key]['online'] = 0;
							$arrRight[] = $result['list'][$key];
						}
					}
				} else {
					if ($result['list'][$key]['level']==2){
						$arrRight[] = $result['list'][$key];
					}
				}
			}
			
			$result['list'] = array_merge($arrLeft, $arrRight);
			$result['total']=$result['list']?count($result['list']):0;
		
//			$memcache->set("live_hall", $result, CMEMCACHE_LIVE_HALL);
//		}
//		$memcache->close();
		//end
			
		//去掉用数据库来缓存数据
		/*DB::update('add_setting', array('svalue'=>serialize($result), 'dateline'=>time()), array('skey'=>'anchors'));
	}*/
	
	
	
	$result['list']=@array_slice($result['list'],$limitStart,$tpp);
	//	
	//end	
	//print_r($result);die();
	return $result;
}

/**
 * 获取在线的、开启投票功能的、今天开启投票功能小于4小时的主播信息
 * @return array
 */
function cGetActiveAnchors($tpp=null, $page=1,$extra='') {
	//定义返回数组
	$result = array('total'=>0, 'onlineAnchors'=>0, 'onlineMember'=>0, 'list'=>array());
	if ($tpp!=null){
		$limitStart = ($page-1)*$tpp;
	}
	
	//+memcache缓存 2011.06.27 zhangcj
//	$memcache = new cmemcache();
//	$data = $memcache->get("live_hall_active");
//	if ($data !== false) {
//		$result = $data;
//	} else {	
		$onlineAnchors = $rooms = array();
		
		//对时间的计算
		$timenow=time();//当前unix时间
		
		//本日的unix起始时间和结束时间
		$startTimeByday=mktime('0','0','0',date('m',$timenow),date('d',$timenow),date('Y',$timenow));
		$endTimeByday=mktime('23','59','59',date('m',$timenow),date('d',$timenow),date('Y',$timenow));
		
		//查询所有非管理组、主播未违规、已经开启投票、在线的主播信息。
		$where="cm.groupid<>1  and r.stat>=0 and r.canvote=1 and ul.usertype=2";
		$where=($extra?"$extra and ":'').$where;
		$sql="SELECT r.roomid,r.uid,r.username,rc.level,rc.charm,s.consume,if(cm.nickname!='',cm.nickname,cm.username) as nickname ,r.type 
			FROM ".DB::table('live_room')." r 
			LEFT JOIN ".DB::table('live_member_count')." rc ON r.uid=rc.uid 
			LEFT JOIN ".DB::table('ucenter_showcoin')." s ON r.uid=s.uid
			LEFT JOIN ".DB::table('common_member')." cm on r.uid=cm.uid
			RIGHT JOIN ".DB::table('live_userlist')." ul on r.uid=ul.uid
			WHERE $where ORDER BY rc.charm DESC ";
		//echo $sql;
		$query=DB::query($sql);			
		while($rs=DB::fetch($query)){
			//今天投票时间小于4小时的房间
			$lastsql="SELECT sum(totaltime) as sumtime FROM ".DB::table('live_roomer_votelog')." WHERE  uid= '".$rs['uid']."' AND stime > ".$startTimeByday;
			$lastrs = DB::fetch_first($lastsql);
			$lastTotalTime = $lastrs['sumtime'];
			$thissql = "SELECT stime FROM ".DB::table('live_roomer_votelog')." WHERE etime=0 AND totaltime=0 AND uid= '".$rs['uid']."'";
			$thisrs = DB::fetch_first($thissql);
			if(!empty($thisrs)){
				$thisTotalTime = time()-$thisrs['stime'];
				$totalTimeByDay = $thisTotalTime+$lastTotalTime;
			}else{
				$totalTimeByDay = $lastTotalTime;
			}
			if($totalTimeByDay<=14400){
				//魅力等级
				$tmp = cGetCharmLevel($rs['charm'], 1);
				$rs['charmLevel'] = $tmp['level'];
				//消费等级
				$tmp = cGetHuoshowLevel($rs['consume'], 1);
				$rs['huoshowLevel'] = $tmp['level'];
				$rs['onlineMember'] = 0;			
				$rs['online'] = 0;		
				$rs['avatar'] = avatar($rs['uid'], 'middle',TRUE,FALSE,TRUE);
				$result['list'][] = $rs;
			}
		}		
		
		//在线信息
		$sql = "SELECT a.* FROM pre_live_userlist  a GROUP BY a.roomid,a.uid ORDER BY a.usertype ASC";		
		$query=DB::query($sql);
		//按房间分组
		while ($res = DB::fetch($query)){				
			$arr[$res['roomid']][$res['uid']]=$res['uid'];
		}		
		foreach ($arr as $key=>$value) {
			foreach ($result['list'] as $k=>$v){
				if ($key==$v['roomid']){
					//房间
					$rooms[$key] = count($value);
					//在线主播
					if (isset($value[$key])) {
						$onlineAnchors[] = $key;
					}
					//所有在线总人数
					$result['onlineMember'] += count($value);
				}
			}
			
		}
		//在线主播数
		$result['onlineAnchors'] = count($result['list']);
		
		//排序
		$arrLeft = $arrRight = array();
		foreach ($result['list'] as $key=>$value) {
			if (array_key_exists($value['uid'], $rooms)) {
				$result['list'][$key]['onlineMember'] = $rooms[$value['uid']];
				//$result['list'][$key]['online'] = max(1, $value['online']);
				if (in_array($value['uid'], $onlineAnchors)) {
					$result['list'][$key]['online'] = 1;
					$arrLeft[] = $result['list'][$key];
				}else {
					if ($result['list'][$key]['level']==2){
						$result['list'][$key]['online'] = 0;
						$arrRight[] = $result['list'][$key];
					}
				}
			} else {
				if ($result['list'][$key]['level']==2){
					$arrRight[] = $result['list'][$key];
				}
			}
		}
		
		$result['list'] = array_merge($arrLeft, $arrRight);
		$result['total']=$result['list']?count($result['list']):0;
			
//		$memcache->set("live_hall_active", $result, CMEMCACHE_LIVE_HALL_ACTIVE);
//	}
//	$memcache->close();
	//end
	
	if($tpp!=null){
		$result['list']=@array_slice($result['list'],$limitStart,$tpp);
	}
	//	
	//end	
	//print_r($result);die();
	return $result;
}

/**
 * 直播预告
 * @return array
 */
function cGetForecast() {
	$list = array();
	$nowTime = time();
	$query = DB::query("SELECT n.uid,n.username,n.content,n.dateline,n.start_time,n.end_time,n.recommand,r.roomid  
		FROM ".DB::table('live_notice')." n 
		LEFT JOIN ".DB::table('live_room')." r ON n.uid=r.uid  
		WHERE n.auditstatus=1 AND n.start_time>$nowTime 
		ORDER BY n.start_time ASC 
		LIMIT 20");
	/*$query = DB::query("SELECT n.uid,n.username,n.content,n.dateline,n.start_time,n.end_time,n.recommand,r.roomid  
		FROM ".DB::table('live_notice')." n 
		LEFT JOIN ".DB::table('live_room')." r ON n.uid=r.uid  
		WHERE 1  
		ORDER BY n.dateline ASC 
		LIMIT 20");*/
	while ($rs = DB::fetch($query)) {
		$rs['dateline_str1'] = date('Y年m月d日', $rs['start_time']);
		$week = date('N', $rs['start_time']);
		switch ($week) {
			case 1: $rs['dateline_str1'] .= ' 星期一';break;
			case 2: $rs['dateline_str1'] .= ' 星期二';break;
			case 3: $rs['dateline_str1'] .= ' 星期三';break;
			case 4: $rs['dateline_str1'] .= ' 星期四';break;
			case 5: $rs['dateline_str1'] .= ' 星期五';break;
			case 6: $rs['dateline_str1'] .= ' 星期六';break;
			case 7: $rs['dateline_str1'] .= ' 星期日';break;
		}
		$rs['dateline_str2'] = date('H:i', $rs['start_time']);
		$rs['avatar'] = avatar($rs['uid'], 'small');
		$list[] = $rs;
	}
	return $list;
}

/**
 * 魅力值排行
 * @return array
 */
function cGetCharmTopList() {
	$list = array();
	
	//魅力值排行榜
	//$list['day'] = cGetCharmTop('day', 10);
	$list['week'] = cGetCharmTop('week', 10);
	$list['month'] = cGetCharmTop('month', 10);
	$list['all'] = cGetCharmTop('all', 10);	
	return $list;
}

/**
 * 财富值排行
 * @return array
 */
function cGetHuoshowTopList() {
	$list = array();
	
	//火秀币排行榜
	//$list['day'] = cGetHuoshowTop('day', 10);
	$list['week'] = cGetHuoshowTop('week', 10);
	$list['month'] = cGetHuoshowTop('month', 10);
	$list['all'] = cGetHuoshowTop('all', 10);
	
	return $list;
}

/**
 * 消息服务器公告
 * @return array
 */
function cGetNotices($num = 1) {
	$endTime = time() - 60;
	$dbNotices = DB::fetch_first("SELECT * FROM ".DB::table("add_setting")." WHERE skey='notices'");
	if ($dbNotices['dateline'] > $endTime) {
		$list = unserialize($dbNotices['svalue']);
	} else {
		$list = array();
	
		//消息服务器返回的公告信息
		//$writeData = '{"action":"sysMessage","numbers":"'.$num.'","mode":"nologin"}';
		//$back = socketData(API_SOCKET_HOST, MSN_PORT, $writeData);
		//$backArr = json_decode($back, true);
//		if ($backArr['state'] == 1) {
//			foreach ($backArr['sysMessage'] as $value) {
//				$list[] = $value['msg'];
//			}
//		}
		DB::update('add_setting', array('svalue'=>serialize($list), 'dateline'=>time()), array('skey'=>'notices'));
	}
	
	return $list;
}

/**
 * 获取直播焦点图
 * @return string
 */
function cGetFocusImages() {
	/*$cache_file = DISCUZ_ROOT."caches/pages/section_40.html";
	if(file_exists($cache_file))
	{
		$focusImages = file_get_contents($cache_file);
	}
	else 
	{*/
		/*$endTime = time() - 3600;
		$cache = DB::fetch_first("SELECT * FROM ".DB::table("add_setting")." WHERE skey='focusimages'");
		if ($cache['dateline'] > $endTime) {
			$focusImages = unserialize($cache['svalue']);
		} else {*/
			//$focusImages = file_get_contents(WWW_URL.'section/40.html');
			$focusImages = file_get_contents(PCMS_URL."/api.php?op=newslive&p=get_cGetFocusImages");
			//DB::update('add_setting', array('svalue'=>serialize($focusImages), 'dateline'=>time()), array('skey'=>'focusimages'));
		//}
	//}
		
	return $focusImages;
}
/**
 * 
 * 获取直播首页右侧广告区块
 */
function getShowRightAd1(){
	/*$cache_file = DISCUZ_ROOT."caches/pages/section_52.html";
	if(file_exists($cache_file))
	{
		$rightAd1 = file_get_contents($cache_file);
	}
	else 
	{
		$endTime = time() - 3600;
		$cache = DB::fetch_first("SELECT * FROM ".DB::table("add_setting")." WHERE skey='show_right_ad1'");
		if ($cache['dateline'] > $endTime) {
			$rightAd1 = unserialize($cache['svalue']);
		} else {*/
			//$rightAd1 = file_get_contents(WWW_URL."section/52.html");
			$rightAd1 = file_get_contents(PCMS_URL."/api.php?op=newslive&p=get_getShowRightAd1");
			//DB::update('add_setting', array('svalue'=>serialize($rightAd1), 'dateline'=>time()), array('skey'=>'show_right_ad1'));
		//}
	//}
	return $rightAd1;
}
/**
 * 官方公告
 * @return string
 */
function OfNotice() {
	/*$cache_file = DISCUZ_ROOT."caches/pages/section_45.html";
	if(file_exists($cache_file))
	{
		$ofnotice = file_get_contents($cache_file);
	}
	else 
	{
		$endTime = time() - 3600;
		$cache = DB::fetch_first("SELECT * FROM ".DB::table("add_setting")." WHERE skey='ofnotice'");
		if ($cache['dateline'] > $endTime) {
			$ofnotice = unserialize($cache['svalue']);
		} else {*/
			//$ofnotice = file_get_contents("../cms/section/45.html");
			$ofnotice = file_get_contents(PCMS_URL."/api.php?op=newslive&p=get_OfNotice");
			/*if (empty($ofnotice)){
				$ofnotice = file_get_contents("http://www.huoshow.com/section/45.html");
			}*/
			//DB::update('add_setting', array('svalue'=>serialize($ofnotice), 'dateline'=>time()), array('skey'=>'ofnotice'));
		//}
	//}
	return $ofnotice;
}
/**
 * 官方帮助
 * @return string
 */
function OfHelp() {
	/*$cache_file = DISCUZ_ROOT."caches/pages/section_357.html";
	if(file_exists($cache_file))
	{
		$ofhelp = file_get_contents($cache_file);
	}
	else 
	{
		$endTime = time() - 3600;
		$cache = DB::fetch_first("SELECT * FROM ".DB::table("add_setting")." WHERE skey='ofhelp'");
		if ($cache['dateline'] > $endTime) {
			$ofhelp = unserialize($cache['svalue']);
		} else {*/
			//$ofhelp = file_get_contents("../cms/section/357.html");
			$ofhelp = file_get_contents(PCMS_URL."/api.php?op=newslive&p=get_OfHelp");
			/*if (empty($ofhelp)){
				$ofhelp = file_get_contents("http://www.huoshow.com/section/357.html");
			}*/
			//DB::update('add_setting', array('svalue'=>serialize($ofhelp), 'dateline'=>time()), array('skey'=>'ofhelp'));
		//}
	//}
	return $ofhelp;
}

/**
 * 友谊帮助
 * @return string
 */
function friend() {
	$cache_file = DISCUZ_ROOT."caches/pages/huoshow_index_friend.html";
	if(file_exists($cache_file)) {
		$friend = file_get_contents($cache_file);
	}
	return $friend;
}

function Charm_Value() {
	$cache_file = DISCUZ_ROOT."caches/pages/huoshow_index_charmvalue.html";
	if(file_exists($cache_file)) {
		$Charm_Value = file_get_contents($cache_file);
	}
	return $Charm_Value;
}

function Charm_Vote() {
	$cache_file = DISCUZ_ROOT."caches/pages/huoshow_index_charmvote.html";
	if(file_exists($cache_file)) {
		$Charm_Vote = file_get_contents($cache_file);
	}
	return $Charm_Vote;
}

function Charm_Score() {
	$cache_file = DISCUZ_ROOT."caches/pages/huoshow_index_charmscore.html";
	if(file_exists($cache_file)) {
		$Charm_Score = file_get_contents($cache_file);
	}
	return $Charm_Score;
}

/**
 * 联系方式
 * @return string
 */
function ofContact() {
	
	/*$cache_file = DISCUZ_ROOT."caches/pages/section_358.html";
	if(file_exists($cache_file))
	{
		$ofcontact = file_get_contents($cache_file);
	}
	else 
	{
		$endTime = time() - 3600;
		$cache = DB::fetch_first("SELECT * FROM ".DB::table("add_setting")." WHERE skey='ofcontact'");
		if ($cache['dateline'] > $endTime) {
			$ofcontact = unserialize($cache['svalue']);
		} else {*/
			//$ofcontact = file_get_contents("../cms/section/358.html");
			$ofcontact = file_get_contents(PCMS_URL."/api.php?op=newslive&p=get_ofContact");
			/*if (empty($ofcontact)){
				$ofcontact = file_get_contents("http://www.huoshow.com/section/358.html");
			}*/
			//DB::update('add_setting', array('svalue'=>serialize($ofcontact), 'dateline'=>time()), array('skey'=>'ofcontact'));
		//}
	//}
	return $ofcontact;
}

/**
 * *
 * 获取用户信息
 * $uid是用户UID
 */
function getUsersInfo($uid){
	//用户信息
	$sql = "SELECT a.*,c.contribution,c.charm ,IF(m.nickname!='',m.nickname,m.username) AS nickname FROM ".DB::table('common_member_profile')." a LEFT JOIN ".DB::table('live_member_count')." c ON a.uid=c.uid LEFT JOIN ".DB::table('common_member')." m ON a.uid = m.uid WHERE a.uid=$uid ";
	$anchorInfo = DB::fetch_first($sql);
	//头像
	$avatar = avatar1($uid, 'middle',true,false,true);
	//火秀币
	$anchorInfo['huoshow'] = HuoShowGetConsume($_G['uid']);
	//用户魅力，财富等级
	$chartmLevel =cGetCharmLevel($anchorInfo[charm]);
	$huoshowlevel =cGetHuoshowLevel($anchorInfo['huoshow']);
	$sql = "SELECT * FROM ".DB::table('live_level_config')." WHERE type=2";
	$query=DB::query($sql);			
	while($rs=DB::fetch($query)){
		$charl[] = $rs;
	}
//	$charl=$_G['setting']['level']['charm'];
	$sql = "SELECT * FROM ".DB::table('live_level_config')." WHERE type=1";
	$query=DB::query($sql);			
	while($rs=DB::fetch($query)){
		$huol[] = $rs;
	}
	//$huol=$_G['setting']['level']['huoshow'];
	//需要升级的差值
	$char=$charl[$chartmLevel['level']]['valuelower']-$anchorInfo['charm'];	
$charzhi=(($anchorInfo['charm']-$charl[$chartmLevel['level']-1]['valuelower'])/($charl[$chartmLevel['level']]['valuelower']-$charl[$chartmLevel['level']-1]['valuelower']))*100;
			
	$huoshow=$huol[$huoshowlevel['level']]['valuelower']-$anchorInfo['huoshow'];
$huozhi=(($anchorInfo['huoshow']-$huol[$huoshowlevel['level']-1]['valuelower'])/($huol[$huoshowlevel['level']]['valuelower']-$huol[$huoshowlevel['level']-1]['valuelower']))*100;
	
	$userinfo = array('anchorinfo'=>$anchorInfo,'chartmLevel'=>$chartmLevel,'huoshowlevel'=>$huoshowlevel,'char'=>$char,'charzhi'=>$charzhi,'huoshow'=>$huoshow,'huozhi'=>$huozhi,'avatar'=>$avatar);
	return $userinfo;
}

/**
 * 用户进入直播间获得IP
 *
 * @return unknown
 */
function getDz_Ip(){
	if (getenv('HTTP_CLIENT_IP')){
		$ip = getenv('HTTP_CLIENT_IP');
	} elseif (getenv('HTTP_X_FORWARDED_FOR')) {
		list($ip) = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
	} elseif (getenv('REMOTE_ADDR')) {
		$ip = getenv('REMOTE_ADDR');
	}else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
