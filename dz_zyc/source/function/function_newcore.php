<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_core.php 17487 2010-10-19 10:21:29Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
function cVideoPic($rs, $size='small') {
	if ($size == 'middle') {
		$strsize = "_middle.jpg";
	} elseif ($size == 'big') {
		$strsize = "_big.jpg";
	} else {
		$strsize = "_small.jpg";
	}
	if($rs['isrecord']==1){
		$img=substr($rs['videourl'],0,-4).$strsize;
		$pic="http://".FILE_HOST."/saishi/".$rs[uid]."/".$img;
	}else{		
		if (empty($rs['temp_uid'])) {
			$img=$rs['videourl'].$strsize;
		} else {
			$temp = explode(".", $rs['videourl']);
			if(count($temp) > 1) array_pop($temp);
			$img= implode('.', $temp).$strsize;
		}
		$pic="http://".FILE_HOST."/huoshow/video/".$img;
	}
	return $pic;
}
function cVideoUrl($rs) {
	if($rs['isrecord']==1){
		$url="http://".FILE_HOST."/saishi/".$rs['uid']."/".$rs['videourl'];
	}else{		
		$url="http://".FILE_HOST."/huoshow/video/".$rs['videourl'];
	}
	return $url;
}
function cFilter($str) {
	if (! empty($str)) {
		$str = preg_replace('/\[img.*?\].*?\[\/img\]/is', '', $str);
		$str = preg_replace('/\[attach.*?\].*?\[\/attach.*?\]/is', '', $str);
		$str = preg_replace('/\[i.*?\](.*?)\[\/i\]/is', '', $str);
		$str = preg_replace('/\[font.*?\](.*?)\[\/font\]/is', '\1', $str);
		$str = preg_replace('/\[color.*?\](.*?)\[\/color\]/is', '', $str);
		$str = preg_replace('/\[url.*?\](.*?)\[\/url\]/is', '', $str);
		$str = preg_replace('/\[hide.*?\](.*?)\[\/hide\]/is', '', $str);
		$str = preg_replace('/\[audio.*?\](.*?)\[\/audio\]/is', '', $str);
		$str = preg_replace('/\[media.*?\](.*?)\[\/media\]/is', '', $str);
		$str = preg_replace('/\[flash.*?\](.*?)\[\/flash\]/is', '', $str);
		$str = preg_replace('/\[code.*?\](.*?)\[\/code\]/is', '', $str);
		$str = preg_replace('/\[quote.*?\](.*?)\[\/quote\]/is', '', $str);
		$str = preg_replace('/\[.*?\](.*?)\[\/.*?\]/is', '\1', $str);
		$str = preg_replace('/[ \r|\n|\t]/', '', $str);
		$str = strip_tags($str);
	}
	return $str;
}


/**
 * 获得秀币
 * @param 0/int/string $uid
 */
function SIPHuoShowGetBalance($uid=0) {
	$uid = cGetUid($uid);
	$query = DB::query("SELECT showcoin FROM ".DB::table('ucenter_showcoin')." WHERE uid='$uid'");
	$result = DB::result($query);
	if($result)
	{
		return $result;
	}
	else
	{
		return 0;
	}
}

/**
 * 获得火币
 * @param 0/int/string $uid
 */
function SIPHuoCoinGetBalance($uid=0) {
	$uid = cGetUid($uid);
	$query = DB::query("SELECT huocoin FROM ".DB::table('ucenter_showcoin')." WHERE uid='$uid'");
	$result = DB::result($query);
	if($result)
	{
		return $result;
	}
	else
	{
		return 0;
	}
}

/**
 * 获得送礼物消费的火秀币
 * @param 0/int/string $uid
 */
function HuoShowGetConsume($uid=0) {
	$uid = cGetUid($uid);
	$query = DB::query("SELECT consume FROM ".DB::table('ucenter_showcoin')." WHERE uid='$uid'");
	$result = DB::result($query);
	if($result)
	{
		return $result;
	}
	else
	{
		return 0;
	}
}

/**
 * 获得送礼物消费的火币
 * @param 0/int/string $uid
 */
function HuoCoinGetConsume($uid=0) {
	$uid = cGetUid($uid);
	$query = DB::query("SELECT consume_huo FROM ".DB::table('ucenter_showcoin')." WHERE uid='$uid'");
	$result = DB::result($query);
	if($result)
	{
		return $result;
	}
	else
	{
		return 0;
	}
}

/**
 * 更新秀币
 * @param 0/int/string $uid
 * @param string $action
 * @param int $amount
 */
function SIPHuoShowUpdate($uid=0, $operation='AFD', $amount=0,$remark='') {
	$uid = cGetUid($uid);
	
	if (!empty($uid) && !empty($amount)) {	
		$rs = DB::fetch_first("SELECT showcoin FROM ".DB::table('ucenter_showcoin')." WHERE uid='$uid'");
		if(! empty($rs)){
			DB::query("UPDATE ".DB::table('ucenter_showcoin')." SET showcoin=showcoin + '$amount' WHERE uid='$uid'");
			SIPHuoShowinsert($uid, $operation, $amount,$remark);
		}else{
			DB::insert('ucenter_showcoin', array('uid' => $uid, 'showcoin' => $amount));
			SIPHuoShowinsert($uid, $operation, $amount,$remark);
		}
		//通知火币更新
		$data = array(
			'act'=>'1',
			'dstuid'=>$uid
		);
		$cmd_body = '020'.json_encode($data);
		socketSendData(LOCAL_HOST, LOCAL_PORT, encodeCommand($cmd_body, 6));
		return true;
	}else {
		return false;
	}
}

/**
 * 更新火币
 * @param 0/int/string $uid
 * @param string $action
 * @param int $amount
 */
function SIPHuoCoinUpdate($uid=0, $operation='AFD', $amount=0,$remark='') {
	$uid = cGetUid($uid);
	
	if (!empty($uid) && !empty($amount)) {	
		$rs = DB::fetch_first("SELECT showcoin FROM ".DB::table('ucenter_showcoin')." WHERE uid='$uid'");
		if(! empty($rs)){
			DB::query("UPDATE ".DB::table('ucenter_showcoin')." SET huocoin=huocoin + '$amount' WHERE uid='$uid'");
			SIPHuoCoininsert($uid, $operation, $amount,$remark);
		}else{
			DB::insert('ucenter_showcoin', array('uid' => $uid, 'huocoin' => $amount));
			SIPHuoCoininsert($uid, $operation, $amount,$remark);
		}
		//通知秀币更新
		return true;
	}else {
		return false;
	}
}

/**
 * 秀币日志
 * @param 0/int/string $uid
 * @return array/false
 */
function SIPHuoShowinsert($uid, $operation, $amount=0, $remark='') {
	$uid = cGetUid($uid);
	if (!empty($uid) && !empty($operation)) {
		$type = ($amount < 0) ? 'out' : 'in';
		
		$balance = SIPHuoShowGetBalance($uid);#余额
		DB::insert('ucenter_showcoin_log', array('uid'=>$uid, 'operation'=>$operation, 'dateline'=>time(), 'amount'=>$amount, 'type'=>$type, 'remark'=>$remark, 'balance'=>$balance));

	}else {
		return false;
	}
}

/**
 * 火币日志
 * @param 0/int/string $uid
 * @return array/false
 */
function SIPHuoCoininsert($uid, $operation, $amount=0, $remark='') {
	$uid = cGetUid($uid);
	if (!empty($uid) && !empty($operation)) {
		$type = ($amount < 0) ? 'out' : 'in';
		
		$balance = SIPHuoCoinGetBalance($uid);#余额
		DB::insert('ucenter_huocoin_log', array('uid'=>$uid, 'operation'=>$operation, 'dateline'=>time(), 'amount'=>$amount, 'type'=>$type, 'remark'=>$remark, 'balance'=>$balance));

	}else {
		return false;
	}
}

/**
 * 获取秀币消费日志
 * @param 0/int/string $uid
 * @return array/false
 */
function SIPHuoShowHistory($uid) {
	$uid = cGetUid($uid);
	if (!empty($uid)) {
		$query = DB::query("SELECT * FROM ".DB::table('ucenter_showcoin_log')." WHERE uid='$uid'");	
		$albums = array();
		while($album = DB::fetch($query)) {
			$albums[] = $album;
		}
		return $albums;
	}else{
		return false;
	}
}

/**
 * 获取火币消费日志
 * @param 0/int/string $uid
 * @return array/false
 */
function SIPHuoCoinHistory($uid) {
	$uid = cGetUid($uid);
		if (!empty($uid)) {
	$query = DB::query("SELECT * FROM ".DB::table('ucenter_huocoin_log')." WHERE uid='$uid'");	
	
		$albums = array();
		while($album = DB::fetch($query)) {
			$albums[] = $album;
		}
		return $albums;
	}else{
		return false;
	}
}

/**
 * 获取MY秀播放列表
 * @param 0/int/string $uid
 * @return array/false
 */
function MyShow($uid) {
	$uid = cGetUid($uid);
	if (!empty($uid)) {
	$num = DB::result_first("SELECT COUNT(*) FROM ".DB::table('video_list')." WHERE uid='$uid'");
	if($num){
		$query = DB::query("SELECT uid,author as username,myshowid,title,timelength as duration,videourl as filename,image FROM ".DB::table('video_list')." WHERE uid='$uid' order by dateline desc limit 10");
		while($rs = DB::fetch($query)) {
			$result[] = $rs;
		}
		return $result;
	}else{
		$query = DB::query("SELECT uid,author as username,myshowid,title,timelength as duration,videourl as filename,image FROM ".DB::table('video_list')." WHERE recommand=1 and auditstatus =2 order by dateline desc limit 10");	
	   while($rs = DB::fetch($query)) {
			$result[] = $rs;
		}
		return $result;
	}
}
}

function jsmulti($type='getFansData',$num, $perpage, $curpage, $mpurl='', $maxpages = 0, $page = 10, $autogoto = FALSE, $simple = FALSE) {
	global $_G;
	$ajaxtarget = !empty($_G['gp_ajaxtarget']) ? " ajaxtarget=\"".htmlspecialchars($_G['gp_ajaxtarget'])."\" " : '';
    
	$a_name = '';
	if(strpos($mpurl, '#')) {
		$a_strs = explode('#', $mpurl);
		$mpurl = $a_strs[0];
		$a_name = '#'.$a_strs[1];
	}

	if(defined('IN_ADMINCP')) {
		$shownum = $showkbd = TRUE;
		$lang['prev'] = '&lsaquo;&lsaquo;';
		$lang['next'] = '&rsaquo;&rsaquo;';
	} else {
		$shownum = $showkbd = FALSE;
		$lang['prev'] = lang('core','prevpage');
		$lang['next'] = lang('core', 'nextpage');
	}

	$multipage = '';
	$mpurl .= strpos($mpurl, '?') ? '&amp;' : '?';

	$realpages = 1;
	$_G['page_next'] = 0;
	if($num > $perpage) {
		$offset = 2;

		$realpages = @ceil($num / $perpage);
		$pages = $maxpages && $maxpages < $realpages ? $maxpages : $realpages;

		if($page > $pages) {
			$from = 1;
			$to = $pages;
		} else {
			$from = $curpage - $offset;
			$to = $from + $page - 1;
			if($from < 1) {
				$to = $curpage + 1 - $from;
				$from = 1;
				if($to - $from < $page) {
					$to = $page;
				}
			} elseif($to > $pages) {
				$from = $pages - $page + 1;
				$to = $pages;
			}
		}
		$_G['page_next'] = $to;

		$multipage = ($curpage - $offset > 1 && $pages > $page ? '<a href="javascript:;" class="first"'.$ajaxtarget.' onclick="'.$type.'(1);" >1 ...</a>' : '').
		($curpage > 1 && !$simple ? '<a href="javascript:;" class="prev"'.$ajaxtarget.' onclick="'.$type.'('.($curpage-1).');"><</a>' : '');
		for($i = $from; $i <= $to; $i++) {
			$multipage .= $i == $curpage ? '<span class="current">'.$i.'</span>' :
			'<a href="javascript:;"'.$ajaxtarget.' onclick="'.$type.'('.$i.');" >'.$i.'</a>';
		}

		$multipage .= ($to < $pages ? '<a href="javascript:;" class="last"'.$ajaxtarget.' onclick="'.$type.'('.$realpages.');">... '.$realpages.'</a>' : '').
		($curpage < $pages && !$simple ? '<a href="javascript:;" class="nxt"'.$ajaxtarget.' onclick="'.$type.'('.($curpage+1).');">></a>' : '').
		($showkbd && !$simple && $pages > $page && !$ajaxtarget ? '<kbd><input type="text" name="custompage" size="3" onkeydown="if(event.keyCode==13) {window.location=\''.$mpurl.'page=\'+this.value; doane(event);}" /></kbd>' : '');

		//$multipage = $multipage ? '<div class="pg">'.($shownum && !$simple ? '<em>&nbsp;'.$num.'&nbsp;</em>' : '').$multipage.'</div>' : '';
		$multipage = $multipage ? '<div style="float: right;">'.($shownum && !$simple ? '<em>&nbsp;'.$num.'&nbsp;</em>' : '').$multipage.'</div>' : '';
	}
	$maxpage = $realpages;
	return $multipage;
}

/**
 * 获得用户的uid
 * @param 0/int
 * @return int
 */
function cGetUid($uid){
	if ($uid == 0) {
		global $_G;
		$uid = $_G['uid'];
	}
	
	return $uid;
}

/**
 * 生成订单号
 * @return string
 */
function cGetOrderNo() {
	list($usec, $sec) = explode(" ", microtime());
	return 'H'.((float)$usec + (float)$sec)*100;
}

/**
 * 总时间显示 例：42:08:12
 * @param $totalTime
 * @return string
 */
function cTotalTimeShow($totalTime) {
	$hours   = floor($totalTime/3600);
	$minutes = floor(($totalTime%3600)/60);
	$seconds = $totalTime%60;
	return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
}

function getTotalTimeShow($totalTime) {
	$hours = floor($totalTime/3600);
	$minutes = floor(($totalTime%3600)/60);
	$seconds = $totalTime%60;
	$alwaysTime_str = $hours.'时'.$minutes.'分'.$seconds.'秒';
	return $alwaysTime_str;
}

//发送信息
function socketSendData($server, $port, $writeData){	
	$commonProtocol = getprotobyname('TCP');
	$socket = socket_create(AF_INET, SOCK_STREAM, $commonProtocol);
	socket_connect($socket, $server, $port);
	socket_write($socket, $writeData, strlen($writeData));//发送数据
	socket_close($sock);	
}

//接收榜行榜信息
function socketSendAndRecvData($server, $port, $senddata, $timeout){
	$commonProtocol = getprotobyname('TCP');
	$socket = socket_create(AF_INET, SOCK_STREAM, $commonProtocol);
	socket_connect($socket, $server, $port);
	socket_write($socket, $senddata, strlen($senddata));//发送数据	
	
	socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout,'usec' => 0));//设置接收数据超时时间		
	$hex_len = @socket_read($socket, 6, PHP_BINARY_READ);
	if( $hex_len ) {
		$len = hexdec($hex_len);
		$i = 0;
		while($i < $len) {
			$recvdata .= @socket_read($socket, $len - $i, PHP_BINARY_READ);
			$i = strlen($recvdata);
		}
		if( $recvdata ) {
			$recvdata = substr($recvdata, 3, $len - 3);	
		}
	}
	socket_close($sock);
	return $recvdata;
}

/**
 * 给消息服务器发命令
 * @param string $server 服务器ip
 * @param int $port 端口
 * @param string $writeData 命令json
 */
function socketData($server, $port, $writeData){	
	$writeData = $writeData."\n";//操作数据				
	$commonProtocol = getprotobyname('TCP');
	$socket = socket_create(AF_INET, SOCK_STREAM, $commonProtocol);
	socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1); //设置端口可以重用
	socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec"=>5, "usec"=>0));
	socket_connect($socket, $server, $port);
	socket_write($socket, $writeData, strlen($writeData));//发送数据	
}

/**
 * 长度
 * @param string $str
 * @param int $len
 * @return string
 */
function getMsgLenStr($str, $len = '') {
	$strLen = strlen($str);
	if (!empty($len) && strlen($strLen) < $len) {
		$zeroNum = $len - strlen($strLen);
		while ($zeroNum) {
			$strLen = '0'.$strLen;
			$zeroNum--;
		}
	}
	return $strLen;
}

function encodeCommand($body, $len_width = '') {
	$strHexLen = dechex(strlen($body));
	$intHexLen = strlen($strHexLen);
	if (!empty($len_width) && $intHexLen < $len_width) {
		$zeroNum = $len_width - $intHexLen;
		while ($zeroNum) {
			$strHexLen = '0'.$strHexLen;
			$zeroNum --;
		}
	}
	return $strHexLen.$body;
}

/**
 * 验证用户违规
 * @param $uid //int,'all'
 * 如果$uid = 'all', 所以主播做自动解除操作,没有返回值
 *     $uid = 具体某个用户id, 对该用户做自动解除操作，并返回该用户当前是否被处罚,返回值为0或1。0表示当前没有被处罚，1表示当前正在被处罚
 * @return void; 0,1
 */
function cCheckViolation($uid) {
	if ($uid == 'all') {
		$nowTime = time();
		$query = DB::query("SELECT id,uid FROM ".DB::table('live_violation')." WHERE status=1 AND removetype IN(1,3) AND end_time<$nowTime GROUP BY uid ORDER BY start_time DESC");
		while ($rs = DB::fetch($query)) {
			$ids[] = $rs['id'];
			$uids[] = $rs['uid'];
		}
		$ids = implode(',', $ids);
		$uids = implode(',', $uids);
		if (!empty($ids) && !empty($uids)) {
			DB::update('live_violation', array('status'=>0), "id IN($ids)");
			DB::update('live_room', array('stat'=>0), "uid IN($uids)");
		}
	} elseif ($uid) {
		$roomInfo = DB::fetch_first("SELECT * FROM ".DB::table('live_room')." WHERE uid=$uid");
		if (!empty($roomInfo)) {
			if ($roomInfo['stat'] == -1) {
				$violationLog = DB::fetch_first("SELECT * FROM ".DB::table('live_violation')." WHERE uid=$uid AND status=1 ORDER BY start_time DESC LIMIT 1");
				if (!empty($violationLog)) {
					if ($violationLog == 2) {#手动解除
						return 1;
					} else {#自动解除
						$nowTime = time();
						$endTime = $violationLog['end_time'];
						if ($endTime < $nowTime) {#已过处罚时间
							DB::update('live_violation', array('status'=>0), "id=".$violationLog['id']);
							DB::update('live_room', array('stat'=>0), "uid=$uid");
							return 0;
						} else {
							return 1;
						}
					}
				} else {
					DB::update('live_room', array('stat'=>0), "uid=$uid");
					return 0;
				}
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
}
function getWithDrawCnName($status){
	if ($status==1) return '<strong style="color:brown">待审核</strong>';
	if ($status==2) return  '<strong style="color:green">已汇款</strong>';
	if ($status==3) return  '<strong style="color:gray">成功</strong>';
	if ($status=='-1') return  '<strong style="color:blue">投诉中</strong>';
	if ($status=='-2') return  '<strong style="color:red">失败</strong>';
}

function getLiveCnName($income){
	if ($income==0) return  '<strong style="color:green">请选择</strong>';
	if ($income==1) return  '<strong style="color:green">收益由高到低排列</strong>';
	if ($income==2) return  '<strong style="color:gray">收益由低到高排列</strong>';
	if ($income==3) return  '<strong style="color:gray">申请中</strong>';
	if ($income==4) return  '<strong style="color:gray">已签约</strong>';
	if ($income==5) return  '<strong style="color:gray">已解约</strong>';
	if ($income==6) return  '<strong style="color:gray">时间由高到低排列</strong>';
	if ($income==7) return  '<strong style="color:gray">时间由低到高排列</strong>';
	if ($income==8) return  '<strong style="color:gray">人数由高到低排列</strong>';
	if ($income==9) return  '<strong style="color:gray">人数由低到高排列</strong>';
}

function getLitersDrop($liters_drop){
	if ($liters_drop == 1) return '<stront style="color:green">上升</strong>';
	if ($liters_drop == 2) return '<stront style="color:green">持平</strong>';
	if ($liters_drop == 3) return '<stront style="color:green">下降</strong>';
}

function getIsOpen($isopen){
	if ($isopen == 1) return '<stront style="color:green">开启</strong>';
	if ($isopen == 0) return '<stront style="color:green">关闭</strong>';
}

function getIsRecommend($isrecommend){
	if ($isrecommend == 1) return '<stront style="color:green">推荐</strong>';
	if ($isrecommend == 0) return '<stront style="color:green">不推荐</strong>';
}

/**充值类型*/
function getPrepaidPhone($type){
	if ($type== 'choose') return  '<strong style="color:green">请选择</strong>';
	if ($type == 'AFD') return '<stront style="color:green">用户充值</strong>';
	if ($type == 'NFD') return '<stront style="color:green">内部增发</strong>';
	if ($type == 'CFD') return '<stront style="color:green">员工奖励</strong>';
	if ($type == 'UFD') return '<stront style="color:green">活动获奖</strong>';
}

/**
 * 消息服务器--发送系统消息
 * @param $msg string
 * @param $uid int
 * @return bool
 */
function MSN_MsgSystem($msg, $uid=1) {
	insertNotice($msg);
}
/**
 * 获取主播在线状态
 * @param $roomid int
 * @return int
 */
function MSN_RoomStatus($roomid) {
	
	//+memcache缓存 2011.06.23 zhangcj
	/*$memcache = new cmemcache();
	$data = $memcache->get("live_roomstatus-$roomid");
	if ($data !== false) {
		$status = $data;
	} else {*/
		$status = DB::result_first("SELECT stat FROM ".DB::table('live_room')." WHERE roomid='$roomid'");
		/*$sql = "SELECT COUNT(*) FROM ".DB::table('live_userlist')." WHERE roomid='$roomid'  and uid = '$roomid' and usertype=2";
		$rs = DB::result_first($sql);*/
		if ($status){
			$status = "$status";
		}else{
			$status = '0';
		}
		/*$memcache->set("live_roomstatus-$roomid", $status, CMEMCACHE_LIVE_ROOMSTATUS);
	}
	$memcache->close();*/
	//end
	
	return $status;
}

/**
 * 排行榜类型
 */
function getTopType(){
	
	$query = DB::query("SELECT id,name FROM ".DB::table('top_type') );
	while ($rs = DB::fetch($query)) {
		$toptype[] = $rs;
	}
	return $toptype;
}

/**
 * 排行榜名称
 */
function getTopNmae($id){
	$sql = "SELECT * FROM ".DB::table('top_type')." WHERE id=$id ";
	$rs =DB::fetch_first($sql);
	return $rs;
}

/**
 * 获取排行榜列表
 * @param integer $type
 */
function getTopList($type){
	$sql = "SELECT a.*,b.name FROM ".DB::table('top')." a LEFT JOIN ".DB::table('top_type')." b ON a.type=b.id  WHERE a.type = $type limit 10";
	$query = DB::query($sql);
	while ($rs = DB::fetch($query)){
		$filmlist[] = $rs;
	}
	return $filmlist;
}

/**
 * 
 * 获取活动列表信息
 * @param integer $actid
 * @param integer $limit
 * @param integer $status
 * @param string $sc
 * @return array
 */
function getActInfo($actid=null,$limit=0,$status=0,$sc='DESC'){
	if ($actid){
		$sql="SELECT * FROM ".DB::table('activity')." WHERE id=$actid";
		$actinfo = DB::fetch_first($sql);
		if($actinfo){
			$sql="SELECT * FROM ".DB::table('activity_period')." WHERE actid=$actid";
			$query1=DB::query($sql);
			$arr1=array();
			$i=0;
			while ($res1=DB::fetch($query1)){
				$arr1[$i]=$res1;
				
				$sql = "SELECT a.*,b.tag,b.name FROM ".DB::table('activity_period_bind')
					 . " a LEFT JOIN ".DB::table('activity_integral')
					 . " b ON a.integral_id = b.id WHERE a.perid=".$res1['id']." ORDER BY a.id ASC";
				$query2=DB::query($sql);
				$arr2=array();
				$j=0;
				while ($res2=DB::fetch($query2)){
					$arr2[$j]=$res2;
					$j++;
				}
				$arr1[$i]['period_bind']=$arr2;
				$i++;
			}
		
			$actinfo['period']=$arr1;
		}
		return $actinfo;
	}else{
		
		if($status!=0){
			$c=" AND status= ".$status." ";
		}
		$c=$c." ORDER BY id ".$sc." ";
		if($limit!=0){
			$c=$c." LIMIT ".$limit;
		}
		$sql="SELECT * FROM ".DB::table('activity')." WHERE 1 ".$c;
		
		$query0=DB::query($sql);
		$arr0=array();
		$h=0;
		while ($res0=DB::fetch($query0)){		
			$arr0[$h]=$res0;
			$sql="SELECT * FROM ".DB::table('activity_period')." WHERE actid=".$res0['id'];
			$query1=DB::query($sql);
			$arr1=array();
			$i=0;
			while ($res1=DB::fetch($query1)){
				$arr1[$i]=$res1;
				
				$sql = "SELECT a.*,b.tag,b.name FROM ".DB::table('activity_period_bind')
					 . " a LEFT JOIN ".DB::table('activity_integral')
					 . " b ON a.integral_id = b.id WHERE a.perid=".$res1['id']." ORDER BY a.id ASC";
				$query2=DB::query($sql);
				$arr2=array();
				$j=0;
				while ($res2=DB::fetch($query2)){
					$arr2[$j]=$res2;
					$j++;
				}
				$arr1[$i]['period_bind']=$arr2;
				$i++;
			}
			$arr0[$h]['period']=$arr1;
			$h++;
		}
		return $arr0;
	}
}
/**
 * 获取活动参与者的魅力排行榜
 */
function getActCharmList($actid,$perid=0,$num=10){
	$sql = " SELECT a.uid,sum(points) as points ,a.charm ,if(c.nickname!='',c.nickname,c.username) AS nickname ,d.stat FROM ".DB::table('activity_partner')
		
		 . "  a LEFT JOIN ".DB::table('common_member')." c ON a.uid = c.uid "
		 . " LEFT JOIN ".DB::table('live_room')." d ON a.uid = d.uid "
		 . "WHERE a.actid = $actid AND a.perid=$perid AND a.status = 1 GROUP BY a.uid ORDER BY `a`.`charm` DESC  LIMIT $num";
		 //echo $sql.'<br>';
	$query = DB::query($sql);
	$i=0;
	while(@$res = DB::fetch($query)){
		$rs[$i]=$res;
		$sql = "SELECT myshowid,title FROM ".DB::table('video_list')." WHERE auditstatus = 2 AND uid='".$res['uid']."' ORDER BY myshowid DESC limit 2 ";
		
		$q = DB::query($sql);
		while ($rst = DB::fetch($q)){
			$rss[] = $rst;
		}		
		$rs[$i]['show'] = $rss;
		unset($rss);
		$i++;
	}	
	return $rs;
}

/**
 * 魅力之星魅力排行榜
 * 
 */
function getActzhuantiList(){
	$sql = " SELECT a.uid,a.username,b.monthnum,IF(m.nickname!='',m.nickname,m.username) AS nickname FROM ".DB::table('live_member_count')." a LEFT JOIN ".DB::table('live_top')." b ON a.uid = b.uid
LEFT JOIN ".DB::table('common_member')." m ON m.uid = a.uid WHERE a.level = 2 AND b.cate='charm' ORDER BY b.monthnum DESC LIMIT 10";
	//echo $sql;
	$query = DB::query($sql);
	$i=0;
	while(@$res = DB::fetch($query)){
		$rs[$i]=$res;
		$sql = "SELECT myshowid,title FROM ".DB::table('video_list')." WHERE auditstatus = 2 AND uid='".$res['uid']."' ORDER BY myshowid DESC limit 1 ";
		
		$q = DB::query($sql);
		while ($rst = DB::fetch($q)){
			$rss[] = $rst;
		}	
		
		$rs[$i]['stat']=MSN_RoomStatus($res['uid']);
		$rs[$i]['show'] = $rss;
		unset($rss);
		$i++;
	}
	return $rs;
	
}
/**
 * 
 * 参与活动 
 * 参与者UID， 参与的活动ID，参与的活动对于的时段ID
 * @param integer $uid
 * @param integer $actid
 * @param integer $perid
 */
function joinAct($uid,$actid,$perid=null){
	
	if ($uid){
		$time=time();
		$sql="SELECT * FROM ".DB::table('activity')." WHERE id=$actid";		
		$actinfo = DB::fetch_first($sql);
		
		if($actinfo['status']==2){
			//时段信息
			$periodInfo = getActPeriodInfo($actid,$perid);				
			if ($periodInfo ){				
				foreach ($periodInfo as $key=>$value){
					//如果绑定的类型为积分
					if($value['bandattr']=='integral'){
						//如果当前时间在此时段内，则可以参加并获得积分
						if ($time>$value['stime'] && $time<$value['etime']){
							//绑定时段的积分脚本信息
							$bindInfo = getActBindInfoByPid($value['id']);
							if ($bindInfo){
								foreach ($bindInfo as $ke=>$va){
									//计算积分脚本
									$point = getActBindPoint($va['integral_script']);
									addActUserPoint($uid, $actid,$value['id'], $va['integral_id'], $point);									
								}
							}
						}
					}else{
						
						addActUserPoint($uid, $actid);
					}
				}
				return true;
			}else{
				return false;
			}			
		}else{
			return false;
		}
	}else{
		return false;
	}
}

/**
 * 
 * 参与活动并添加活动积分
 * 用户ID，活动ID，时段ID，积分ID，分数
 * @param integer $uid
 * @param integer $actid
 * @param integer $perid
 * @param integer $integral_id
 * @param integer $point
 */
function addActUserPoint($uid,$actid,$perid=0,$integral_id=0,$point=0){
	$userinfo = DB::fetch_first("SELECT * FROM ".DB::table('ucenter_members')." WHERE uid=$uid");
	$sql = "SELECT * FROM ".DB::table('activity_partner')
	." WHERE uid=$uid AND actid=$actid AND  perid=$perid AND  integral_id=$integral_id";
	$rs = DB::fetch_first($sql);
	if ($rs){
		return false;
	}
	$data = array(
	'uid'=>$uid,
	'perid'=>$perid,
	'username'=>$userinfo['username'],
	'actid'=>$actid,
	'integral_id'=>$integral_id,'points'=>$point);
	DB::insert('activity_partner',$data);
	return true;
}
/**
 * 
 * 获取活动时段数组
 * @param integer $actid
 * @param integer $perid
 */
function getActPeriodInfo($actid,$perid=null){
	$sql="SELECT * FROM ".DB::table('activity_period')." WHERE actid=$actid";
	if ($perid){
		$sql = $sql." AND id=$perid";
	}	
	$query1=DB::query($sql);
	$arr1=array();
	$i=0;
	while ($res1=DB::fetch($query1)){
		$arr1[$i]=$res1;
		$i++;
	}
	return $arr1;
}

/**
 * 
 * 获取活动时段绑定的积分数组
 * @param integer $pid
 */
function getActBindInfoByPid($pid){
	$sql = "SELECT a.*,b.tag,b.name FROM ".DB::table('activity_period_bind')
		 . " a LEFT JOIN ".DB::table('activity_integral')
		 . " b ON a.integral_id = b.id WHERE a.perid=".$pid." ORDER BY a.id ASC";
	$query=DB::query($sql);
	$arr=array();
	$j=0;
	while ($res=DB::fetch($query)){
		$arr[$j]=$res;
		$j++;
	}
	return $arr;
}

/**
 * 
 * 获取活动积分列表
 */
function getIntegral(){
	$sql = "SELECT * FROM ".DB::table('activity_integral');
	$query = DB::query($sql);
	while ($res = DB::fetch($query)){
		$arr[]=$res;
	}
	return $arr;
}
//如果脚步中有多个标签，对统计会有问题。如果tag1*2+tag2*3 是统计那种标签的积分
/** 
 * 
 * 计算活动时段绑定积分的脚本总值
 * @param unknown_type $script
 */
function getActBindPoint($script){
	$integral = getIntegral();
	foreach ($integral as $key=>$value){
		$script = str_replace($value['tag'], 1, $script);
	}	
	return  eval( "return   $script; "); 
	
}


/**
 * 获得火秀号----可能没有地方用到，启作用的是dz/uc_server/model/user.php  getHuoshowNo()138
 * return int
 */
function getHuoshowNo() {
	
	//最后发布的号码
	$lastNo = DB::result_first("SELECT uid FROM ".DB::table('common_member')." ORDER BY uid DESC LIMIT 1");
	$getNo = $lastNo + 1;
	
	$search = true;
	
	while ($search) {
		//判断号码是否合法
		if (strlen($getNo) == 5 || strlen($getNo) == 6) {
			//等级
			$level = huoshowNoLevel($getNo);
			if ($level == 1) {
				//查看是否已使用
				$useed = DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_member')." WHERE uid='$getNo'");
				if ($useed) {
					$getNo++;
				} else {
					$search = false;
				}
			} else {
				$getNo++;
			}
		} else {
			$search = false;
			$getNo = '';
		}
	}
	
	return $getNo;
}

/**
 * 生成火秀号
 * @param int $num
 * @return int
 */
function createHuoshoNo($num) {
	$successNum = 0;
	$num = intval($num);
	if ($num > 0) {
		//最后发布的号码
		$lastNo = DB::result_first("SELECT id FROM ".DB::table('ucenter_huoshowno')." ORDER BY id DESC LIMIT 1");
		if (empty($lastNo) || strlen($lastNo) < 5) {
			$fromNo = 10000;
		} else {
			$fromNo = $lastNo + 1;
		}
		
		$dateline = time();
		for ($i = 0; $i < $num; $i++) {
			$data = array(
				'id'=>$fromNo,
				'level'=>huoshowNoLevel($fromNo),
				'dateline'=>$dateline
			);
			DB::insert('ucenter_huoshowno', $data);
			$fromNo++;
			$successNum++;
			if (strlen($fromNo) > 6) {
				break;
			}
		}
	}
	
	return $successNum;
}

/**
 * 火秀号的等级
 * @param int $no
 * @return int
 */
function huoshowNoLevel($no) {
	if ($no >= 10000 && $no <= 99999) {
		return 6;#10000-99999为6级
	} else {
		$no = (string)$no;
		
		//计算连续相同的个数
		$num = $count = 1;
		for ($i = 0; $i < strlen($no); $i++) {
			if ($i > 0) {
				if ($no[$i] == $no[$i-1]) {
					$count++;
				} else {
					$count = 1;
				}
				$num = max($num, $count);
			}
		}
		
		if ($num >= 5) {
			return 4;#连续相同5个以上为4级
		} elseif ($num == 4) {
			return 3;#连续相同4个以上为3级
		} elseif ($num == 3) {
			return 2;#连续相同3个以上为2级
		} else {
			
			$c5 = $no[5]-$no[4];
			$c4 = $no[4]-$no[3];
			$c3 = $no[3]-$no[2];
			$c2 = $no[2]-$no[1];
			$c1 = $no[1]-$no[0];
			
			if (((1 == $c5) && ($c5 == $c4) && ($c4 == $c3) && ($c3 == $c2) && ($c2 == $c1)) || 
				((-1 == $c5) && ($c5 == $c4) && ($c4 == $c3) && ($c3 == $c2) && ($c2 == $c1))) {
				return 5;#全连续的为5级
			} else {
				return 1;#剩下的
			}
		}
	}
}

/**
 * 经纪人等级
 * @param $amount int
 * @param $type int 1.具体数值，2.用户uid
 * @return array
 */
function cGetAgentLevel($amount) {
	global $_G;
	if (!empty($_G['setting']['level']['totalmony'])) {
		$levelInfo = $_G['setting']['level']['totalmony'];
	} else {
		$query = DB::query("SELECT * FROM ".DB::table('live_level_config')." WHERE type=3 ORDER BY level ASC");
		while ($rs = DB::fetch($query)) {
			$levelInfo[] = $rs;
		}
		$_G['setting']['level']['totalmony'] = $levelInfo;
	}
	
	$result = array();
	
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
 * 获取粉丝数
 * $uid 经纪人UID
 * @return array
 */
function getFans($uid)
{
	$sql = " SELECT COUNT(*) fans FROM ".DB::table('live_contribution')." WHERE targetuid IN (SELECT uid FROM ".DB::table('live_artists')." WHERE agent=$uid AND status = 1) AND fans = 1";
	$fans = DB::fetch_first($sql);
	return $fans;
}

/**
 * 经纪人粉丝等级
 * @param $amount int
 * @param $type int 1.具体数值，2.用户uid
 * @return array
 */
function cGetAgentFansLevel($amount) {
	global $_G;
	if (!empty($_G['setting']['level']['fans'])) {
		$levelInfo = $_G['setting']['level']['fans'];
	} else {
		$query = DB::query("SELECT * FROM ".DB::table('live_level_config')." WHERE type=4 ORDER BY level ASC");
		while ($rs = DB::fetch($query)) {
			$levelInfo[] = $rs;
		}
		$_G['setting']['level']['fans'] = $levelInfo;
	}
	
	$result = array();
	
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
	 * 
	 * 获取用户等级
	 * @param integer $uid
	 * @param integer $value
	 * @param integer $type
	 */
function getUserLevel($value,$type)
{
	if ($value){
		$Level=0;
		$sql = "SELECT level,name FROM ".DB::table('live_level_config')." WHERE `type` ='$type' AND $value >= `valuelower` AND $value <= `valuehigher`";
		$Level= DB::fetch_first($sql);
		if (empty($Level) and $value>0){
			$sql = "SELECT MAX(`level`) AS level FROM pre_live_level_config WHERE `type` ='$type' ";
			$Level = DB::fetch_first($sql);
		}
		return $Level;
	}
}


/**
 * 用户魅力等级
 * @param $amount int
 * @param $type int 1.具体数值，2.用户uid
 * @return array
 */
function cGetStarLevel($amount, $type=1) {
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
/*
 * my秀精华任务获取版块分类
 * 
 */
function videoClassify($id){
	$query=DB::query("select * from ".DB::table('video_classify')." where type_id=$id");
	while($classify = DB::fetch($query)) {
			$v_classify[] = $classify;
		}
		return $v_classify;
}
function videoType(){
	$query=DB::query("select * from ".DB::table('video_type'));
	while($vtype = DB::fetch($query)) {
			$type[] = $vtype;
		}
		return $type;
}
function videoname($id){
	return DB::result_first("select name from ".DB::table('video_classify')." where id=$id");

		 
}
/**
 * 
 * 通过curl获取URL信息
 * @param String $url
 */
function curlGetContents($url){
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 	
	$data = curl_exec($ch); 
	curl_close($ch);
	return $data;
}

/**
 * 
 * 插入直播公告
 * @param string $notice
 */
function insertNotice($notice){
	$time = time();
	$sql = "INSERT INTO ".DB::table('live_new_notice')." (notice,dateline) VALUES ('$notice','$time')";
	$back = DB::query($sql);

	//+memcache缓存 2011.06.23 zhangcj
	//公告过期
	$memcache = new cmemcache();
	$memcache->rm("live_new_notice");
	$memcache->close();
	//end	

	return $back;
}

/**
 * 去掉前后空格
 * @param string/array $data
 * @return string/array
 */
function cTrim($data) {
	if (is_array($data)) {
		foreach ($data as $key=>$value) {
			$data[$key] = cTrim($value);
		}
	} else {
		$data = trim($data);
	}
	return $data;
}

/**
 * 页面执行完后关闭DB连接
 */
function cCloseDBLink() {
	global $discuz;
	
	if ($discuz) {
		$discuz->db->close();
	}
}


/**
 * 生成缩略图
 * @param string $srcName
 * @param int $newWidth
 * @param int $newHeight
 * @param string $newName
 */
function resizeImg($srcName, $newWidth, $newHeight, $newName='') {
	
	//图片名称
	if ($newName == '') {
		$nameArr = explode('.', $srcName);
		$expName = array_pop($nameArr);
		$expName = $newWidth.'x'.$newHeight.'.'.$expName;
		array_push($nameArr, $expName);
		$newName = implode('.', $nameArr);
	}
	
	//读取图片信息
	$info = '';
	$data = getimagesize($srcName, $info);
	
	switch ($data[2]) {
		case 1:
			if (function_exists("imagecreatefromgif")) {
				$im = imagecreatefromgif($srcName);
			} else {
				die('你的GD库不能使用GIF格式的图片');
			}
			break;
		case 2:
			if (function_exists("imagecreatefromjpeg")) {
				$im = imagecreatefromjpeg($srcName);
			} else {
				die('你的GD库不能使用jpeg格式的图片');
			}
			break;
		case 3:
			$im = imagecreatefrompng($srcName);
			break;
		default:
			return false;
		break;
	}	
	$srcW = imagesx($im);#宽度
	$srcH = imagesy($im);#高度
	
	//缩放后的尺寸
	$newRate = $newWidth / $newHeight;
	$srcRate = $srcW / $srcH;
	if ($newRate <= $srcRate) {
		$toW = $newWidth;
		$toH = $toW * ($srcH / $srcW);
	} else {
		$toH = $newHeight;
		$toW = $toH * ($srcW / $srcH);
	}
	
	//开始缩放
	if ($srcW > $newWidth || $srcH > $newHeight) {
		if (function_exists("imagecreatetruecolor")) {
			@$ni = imagecreatetruecolor($toW, $toH);
			if ($ni) {
				imagecopyresampled($ni, $im, 0, 0, 0, 0, $toW, $toH, $srcW, $srcH);
			} else {
				$ni = imagecreate($toW, $toH);
				imagecopyresampled($ni, $im, 0, 0, 0, 0, $toW, $toH, $srcW, $srcH);
			}
		} else {
			$ni = imagecreate($toW, $toH);
			imagecopyresampled($ni, $im, 0, 0, 0, 0, $toW, $toH, $srcW, $srcH);			
		}
		
		if (function_exists("imagejpeg")) {
			imagejpeg($ni, $newName);
		} else {
			imagepng($ni, $newName);
		}
		
		imagedestroy($ni);
	} else {
		copy($srcName, $newName);
	}
	
	imagedestroy($im);
}

/**
 * 生成缩略图
 * @param string $srcName
 * @param int $newWidth
 * @param int $newHeight
 * @param string $newName
 */
function resizeImgForForum($srcName, $newWidth, $newHeight, $newName='') {
	
	//图片名称
	if ($newName == '') {
		$nameArr = explode('.', $srcName);
		$expName = array_pop($nameArr);
		$expName = $newWidth.'x'.$newHeight.'.'.$expName;
		array_push($nameArr, $expName);
		$newName = implode('.', $nameArr);
	}
	
	//读取图片信息
	$info = '';
	$data = getimagesize($srcName, $info);
	
	switch ($data[2]) {
		case 1:
			if (function_exists("imagecreatefromgif")) {
				$im = imagecreatefromgif($srcName);
			} else {
				die('你的GD库不能使用GIF格式的图片');
			}
			break;
		case 2:
			if (function_exists("imagecreatefromjpeg")) {
				$im = imagecreatefromjpeg($srcName);
			} else {
				die('你的GD库不能使用jpeg格式的图片');
			}
			break;
		case 3:
			$im = imagecreatefrompng($srcName);
			break;
		default:
			return false;
		break;
	}	
	$srcW = imagesx($im);#宽度
	$srcH = imagesy($im);#高度
	
	//缩放后的尺寸
	$newRate = $newWidth / $newHeight;
	$srcRate = $srcW / $srcH;
	if ($newRate <= $srcRate) {
		$toW = $newWidth;
		$toH = $toW * ($srcH / $srcW);
	} else {
		$toH = $newHeight;
		$toW = $toH * ($srcW / $srcH);
	}
	
	if ($toW < $newWidth) {
		$toH = $toH * ($newWidth/$toW);
		$toW = $newWidth;
		$needCut = true;
	} elseif ($toY < $newHeight) {
		$toW = $toW * ($newHeight/$toH);
		$toH = $newHeight;
		$needCut = true;
	} else {
		$needCut = false;
	}
	
	//缩放
	if ($srcW > $newWidth || $srcH > $newHeight) {
		if (function_exists("imagecreatetruecolor")) {
			@$ni = imagecreatetruecolor($toW, $toH);
			if ($ni) {
				imagecopyresampled($ni, $im, 0, 0, 0, 0, $toW, $toH, $srcW, $srcH);
			} else {
				$ni = imagecreate($toW, $toH);
				imagecopyresampled($ni, $im, 0, 0, 0, 0, $toW, $toH, $srcW, $srcH);
			}
		} else {
			$ni = imagecreate($toW, $toH);
			imagecopyresampled($ni, $im, 0, 0, 0, 0, $toW, $toH, $srcW, $srcH);			
		}
		
		if (function_exists("imagejpeg")) {
			imagejpeg($ni, $newName);
		} else {
			imagepng($ni, $newName);
		}
		
		imagedestroy($ni);
	} else {
		copy($srcName, $newName);
	}	
	imagedestroy($im);
	
	
	//裁剪
	if ($needCut) {
		copy($newName, $srcName);
		
		//读取图片信息
		$info = '';
		$data = getimagesize($srcName, $info);
		
		switch ($data[2]) {
			case 1:
				if (function_exists("imagecreatefromgif")) {
					$im = imagecreatefromgif($srcName);
				} else {
					die('你的GD库不能使用GIF格式的图片');
				}
				break;
			case 2:
				if (function_exists("imagecreatefromjpeg")) {
					$im = imagecreatefromjpeg($srcName);
				} else {
					die('你的GD库不能使用jpeg格式的图片');
				}
				break;
			case 3:
				$im = imagecreatefrompng($srcName);
				break;
			default:
				return false;
			break;
		}	
		$srcW = imagesx($im);#宽度
		$srcH = imagesy($im);#高度
		
		if (function_exists("imagecreatetruecolor")) {
			@$ni = imagecreatetruecolor($newWidth, $newHeight);
			if ($ni) {
				imagecopyresampled($ni, $im, 0, 0, 0, 0, $newWidth, $newHeight, $newWidth, $newHeight);
			} else {
				$ni = imagecreate($newWidth, $newHeight);
				imagecopyresampled($ni, $im, 0, 0, 0, 0, $newWidth, $newHeight, $newWidth, $newHeight);
			}
		} else {
			$ni = imagecreate($newWidth, $newHeight);
			imagecopyresampled($ni, $im, 0, 0, 0, 0, $newWidth, $newHeight, $newWidth, $newHeight);			
		}

		if (function_exists("imagejpeg")) {
			imagejpeg($ni, $newName);
		} else {
			imagepng($ni, $newName);
		}
		
		imagedestroy($ni);
	}	
}

?>