<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_space.php 10932 2010-05-18 07:39:13Z zhengqingpeng $
 */
/*
性能监控
xhprof_enable();
*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/live');

$roomid=trim($_G['gp_roomid']);
$uid = $_G['uid'];
if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
	die("roomid格式错误");
$avatar = avatar1($roomid, 'middle',true,false,true);
//$anchorInfo = DB::fetch_first("SELECT * FROM ".DB::table('live_member_count')." WHERE uid='$roomid'");
//if (!$anchorInfo){
//	showmessage('没有此主播!', 'show.php', array(), array('showmsg' => true, 'login' => 1));
//}

//活跃天数
//$active = DB::fetch_first("SELECT IF(SUM(matchtimes)>=3600, 1, 0) AS num FROM ".DB::table('live_roomer_statlog')." WHERE uid =$roomid ");
//
$stime = strtotime(date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),1,date("Y")))); 
////$endtime = strtotime(date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("t"),date("Y")))); 
//
////本月比赛直播时长
//$memcache = new cmemcache();
//$data = $memcache->get("live_total_broadcast_mon_$roomid");
//if ($data !== false){
//	$month_time = $data;
//}else {
//	$monthlivetime = DB::fetch_first(" SELECT SUM(matchtimes) totaltime FROM ".DB::table('live_roomer_statlog')." WHERE uid='$roomid' AND createtime >= $stime");
//	$month_time = getTotalTimeShow($monthlivetime['totaltime']);
//}
//$memcache->close();
$active = DB::fetch_first("SELECT SUM(matchtimes) AS totaltime, SUM(IF(matchtimes>=3600, 1,0)) AS active FROM ".DB::table('live_roomer_statlog')." WHERE uid=$roomid AND createtime >= $stime");

$month_time = cTotalTimeShow($active['totaltime']);

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
$dblink = new DataBase("");
$user_ip = getIp();
if (!empty($uid)){
$sql = "INSERT INTO pre_live_member_login_ip SET uid='$uid',roomid='$roomid',ip='$user_ip'";
$dblink->query($sql);
}

//是否是打开的礼物
$gift_bag_id = DZ_GIFT_BAG_ID;
$sql = "SELECT * FROM pre_live_gift WHERE giftid = $gift_bag_id AND available=1";
$giftdata=$dblink->getRow($sql);
$isGiftBag = count($giftdata);

//得到该用户是否是已关注
if($uid != $roomid){
	$sql = "select * from pre_weibo_follow where src_uid='$uid' and dst_uid=$roomid";
	$is_attention = $dblink->getRow($sql);
	if (count($is_attention)>0) {
		$is_att =1;
	}
}

//得到神秘礼物
$openmysticalgift = cGetPartyUserGiftRanking($roomid);

//获得荣誉勋章
$hoormedal = array();
$sql = "SELECT * FROM pre_forum_medal WHERE medalid IN(SELECT medalid FROM pre_forum_medallog WHERE uid = '$roomid') LIMIT 30";
$query = DB::query($sql);
while($res = DB::fetch($query)){
	$hoormedal[] = $res;
}
//print_r($hoormedal);
//得到数组个数
$result =count($hoormedal);

if($roomid)
{
	if ($_COOKIE['kicked'] and $_COOKIE['kicked']==$roomid){
		showmessage('您已经被踢出此房间，请休息片刻或者进入其他房间', 'show.php', array(), array('showmsg' => true, 'login' => 1));
	}
	    
	   	$sql = "SELECT * FROM ".DB::table('live_room_config')." WHERE uid=".$roomid;	
		$roomcfg = DB::fetch_first($sql);
		$notice = unserialize($roomcfg['roominfo']);//房间公告
		//礼品类型
		$giftType = cGetGiftType();
		$typeNum = count($giftType);		
		//礼品列表
		$giftList = cGetGift();
//		$roomerLiveTop = getRoomerLiveTop($roomid);	
		
//		$sql = "SELECT * FROM ".DB::table('activity_period')." WHERE id='".PERID."'";
//		$period = DB::fetch_first($sql);	
		
		/*
		$period = PK::getPKInfo();
		if (key_exists('limitLeftTime', $period)){
			if ($period['limitLeftTime']==0){
				$sql = "SELECT b.giftid,b.image,b.name,  'limit' as typeid,b.price,b.units,b.content FROM "
					 .DB::table('activity_period_bindgift')." a LEFT JOIN "
					 .DB::table('live_gift')." b ON a.giftid=b.giftid WHERE a.perid='".PERID."' ";
				$query = DB::query($sql);
				while ($res = DB::fetch($query))
				{
					$giftList['limit'][] = $res;
				}						
				$gtype=array(0=>array('typeid'=>'limit','name'=>'限时礼物'));
				$giftType = array_merge($gtype,$giftType);
			}
			$limitGiftLeftTime = $period['limitLeftTime'];
			$limitGiftEndTime = $period['limitEndTime'];			
		}
		*/		
		if($roomid==$_G['uid'])
		{
				$t=time();
				$t1=strtotime(date("Y-m-d"." 09:00:00"));
				$t2=strtotime(date("Y-m-d"." 23:59:59"));			
			/*	if ($t<$t1 or $t>$t2){
					showmessage('您好！直播开放时间段为每天9：00——24：00，欢迎您在开放时间段前来！<br>火秀直播即将全天开放，敬请关注！ ', 'show.php', array(), array('showmsg' => true, 'login' => 1));
					return false;
				} */
				if(empty($uid))
				{
					showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
				}
				if($uid) 
				{
					$space = getspace($uid, 'uid');
					$live_uid=substr(sha1($uid),0,24);
				}
//				$live_user_value_res=index_live_user_value($uid);
//				if(!$live_user_value_res)
//				{
//					showmessage('抱歉普通会员不能使用p2p直播', 'show.php', array(), array('showmsg' => true, 'login' => 1));
//				}
				$back = cCheckViolation($_G['uid']);
				if ($back == 1) {
					showmessage('违规处罚中，暂停直播服务', 'show.php');
				}
				//获取主播类型
				if (!$_REQUEST['type']){
					$live_type=GetTypee($_G['uid']);
				}else{
					$live_type = $_REQUEST['type'];
				}
				if ($live_type==2){					
					//设置IP和端口号
					$addr= "shub.netwaymedia.com" ;
					$port=8085;
					$data_str_string='';$data_mid_string='';$data_end_string='';
					for($i=0;$i<strlen(sha1($live_uid)); $i+=2)
					{
						 $da=substr(sha1($live_uid),$i,2);
						 $data_mid_string.="\x{$da}";
					}
					eval( "\$newd_ata_mid_string = \"".$data_mid_string."\";" );
					//echo $data_mid_string;exit;
					//$data_str_string="\x01\x00\x00\x00\x18\x00\x00\x00\x03\x81\x02";
					$data_str_string="\x01\x00\x00\x00\x18\x00\x00\x00\x01\x82\x02";
					$data_end_string="\x00\x00\x00\x00\x00";
					//创建一个SOCKET
					$socket_type=getprotobyname("tcp");
					if(($sock=socket_create(AF_INET,SOCK_STREAM,$socket_type))<0)
					{
					    echo "socket_create() failed :".socket_strerror($sock)."<br />";exit;
					}
					
					$result=socket_connect($sock, $addr, $port) ;
					if($result < 0 )
					{
						echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result)."<br />";exit;
					}
					//$data_mid_string="[H\xd8\x8a\x19\x94\x1e?\x15\x1dI\xec\xd7+0\xb6P\xea\x91z";
					$all_data=$data_str_string.$newd_ata_mid_string.$data_end_string;
					if(!socket_write($sock, $all_data))  
					{
						echo "socket_write() failed: reason: " . socket_strerror($sock) . "<br />";
					}
					
					$out =socket_read($sock, 1024);
					
					socket_close($sock); 
				}
				$dos = array('index','pmy');
				
				$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'pmy';
				
				require_once libfile('show/pmy', 'include');
				return ;
		}else{
				$dos = array('index','psomebody');
				require_once libfile('show/psomebody', 'include');
		}
} 
else 
{
	showmessage('错误没有此主播', 'show.php', array(), array('showmsg' => true, 'login' => 1));
}

/*
性能监控
// stop profiler
$xhprof_data = xhprof_disable();
// Saving the XHProf run
// using the default implementation of iXHProfRuns.
include_once "/local/ck_files/xhprof_lib/utils/xhprof_lib.php";
include_once "/local/ck_files/xhprof_lib/utils/xhprof_runs.php";

$xhprof_runs = new XHProfRuns_Default();

// Save the run under a namespace "xhprof_foo".
//
// **NOTE**:
// By default save_run() will automatically generate a unique
// run id for you. [You can override that behavior by passing
// a run id (optional arg) to the save_run() method instead.]
//
$run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo");
*/
?>