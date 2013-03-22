<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_index.php 10793 2010-05-17 01:52:12Z xupeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/space');
require_once libfile('function/live');
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
$tpp = 32;
$getNoticsNum = 1;
//是否明星
$isStar   = $_G['uid'] ? index_live_user_value($_G['uid']) : 0;
$isBroker = $_G['uid'] ? isBroker($_G['uid']) : 0;

$op = empty($_G['gp_operation']) ? 'index' : $_G['gp_operation'];

if ($op == 'index') {
	//得到UID是否是开通测试的
	$allow = MutiliveRoom::getUidAllow($_G['uid']);
	//得到UID是否有多音房并且房间是没过期
	//$User_MutilLiveRoom = MutiliveRoom::getUserIsMutilLiveRoom($_G['uid']);
	//获取房间是否到期
	$is_user_room = MutiliveRoom::getRoomExpired($_G['uid']);
	//得到是否有房间
	$is_user_rooms = MutiliveRoom::getIsMutilLiveRoom($_G['uid']);
	if ($is_user_rooms ==0){ //没房
		$is_room_colse = 1;
	}elseif ($is_user_room ==1){ //到期
		$is_room_colse = 2;
	}else {
		$is_room_colse = 3;
	}
	//焦点图
	$focusImges = cGetFocusImages();
	$show_right_ad1 = getShowRightAd1();
	
	//最新公告
	$notices = cGetNotices($getNoticsNum);
	
	//首页魅力指数exponent，魅力clarm，魅力之星votes
	$data = array(
		'count' => '7',
		'exponent' => array(
			'today' => 0,
			'week' => 0,
			'month' => 0
		),
		'clarm' => array(
			'today' => 0,
			'week' => 0,
			'month' => 0
		),
		'votes' => array(
			'today' => 0,
			'week' => 0,
			'month' => 0
		)
	);
	$cmd_body = '010'.json_encode($data);
	$recvdata = socketSendAndRecvData(LOCAL_HOST,LOCAL_PORT, encodeCommand($cmd_body, 6), 5);
	$exponent = json_decode($recvdata, true);
//	print_r($exponent);
	//最新公告
	$notices = cGetNotices();
	//官方公告
	$OffNotice=OfNotice();
	//官方帮助
	$OffHelp  = ofHelp();
	//联系方式
	$OffContact = ofContact();
	
	$friend = friend();
	//魅力值排行榜
	$Charm_Value = Charm_Value();
	//魅力之星排行榜
	$Charm_Vote = Charm_Vote();
	//魅力指数排行榜
	$Charm_Score = Charm_Score();
	//PK赛相关
	//print_r($team1);
	include_once(template('show/show_index'));
}if ($op == 'SearchAnchor'){//搜索主播
	$tpp = 36;
	$page = empty($_G['gp_page']) ? 0 : intval($_G['gp_page']);
	$page = max(1, $page);
	$type = $_G['gp_type'];
	$keyword = $_G['gp_keyword'];
	if ($type==1){
		$extra.=$keyword?"r.uid like '$keyword%'":'';
	}
	if ($type==2){
		$extra.=$keyword?"(cm.nickname like '%$keyword%' or cm.username like '%$keyword%')":'';
	}
	$anchorsInfo = cGetAnchors($tpp, $page,$extra);
	$anchorsNum = $anchorsInfo['total'];#主播数
	$onlineAnchors = $anchorsInfo['onlineAnchors'];#在线主播数
	$onlineMember = $anchorsInfo['onlineMember'];#在线人数
	$hotanchors = $anchorsInfo['list'];#主播列表
	//print_r($hotanchors);
	$multi = multi($anchorsNum, $tpp, $page, "show.php?operation=SearchAnchor&type=$type&keyword=$keyword");
	
	include_once(template('show/show_search'));
	
}elseif ($op == 'SearchMatchAnchor') {#在线并可投票的主播列表
	$tpp = 36;
	$page = empty($_G['gp_page']) ? 0 : intval($_G['gp_page']);
	$page = max(1, $page);
	$type = $_G['gp_type'];
	$keyword = $_G['gp_keyword'];
	if ($type==1){
		$extra.=$keyword?"r.uid like '$keyword%'":'';
	}
	if ($type==2){
		$extra.=$keyword?"(cm.nickname like '%$keyword%' or cm.username like '%$keyword%')":'';
	}
	$anchorsInfo = cGetActiveAnchors('', $page,$extra);
	$anchorsNum = $anchorsInfo['total'];#主播数
	$onlineAnchors = $anchorsInfo['onlineAnchors'];#在线主播数
	$onlineMember = $anchorsInfo['onlineMember'];#在线人数
	$matchanchor = $anchorsInfo['list'];#主播列表
	
	$multi = multi($anchorsNum, $tpp, $page, "show.php?operation=SearchAnchor&type=$type&keyword=$keyword");
	
	include_once(template('show/show_search'));
	
}elseif ($op == 'friend'){
	//ini_set("display_errors","on");
	$count = 10;
	$query = DB::query("SELECT * FROM ".DB::table('live_gift_friendship_top_now')." WHERE type = 0 ORDER BY value DESC LIMIT 7");
	while ($rs = DB::fetch($query)) {
		$rs["uid_a_username_short"] = str_cut($rs["uid_a_username"],$count);
		$rs["uid_b_username_short"] = str_cut($rs["uid_b_username"],$count);
		$friend_day[]= $rs;
	}
	$query = DB::query("SELECT * FROM ".DB::table('live_gift_friendship_top_now')." WHERE type = 1 ORDER BY value DESC LIMIT 7");
	while ($rs = DB::fetch($query)){
		$rs["uid_a_username_short"] = str_cut($rs["uid_a_username"],$count);
		$rs["uid_b_username_short"] = str_cut($rs["uid_b_username"],$count);
		$friend_week[] = $rs;
	}
	$query = DB::query("SELECT * FROM ".DB::table('live_gift_friendship_top_now')." WHERE type = 2 ORDER BY value DESC LIMIT 7");
	while ($rs = DB::fetch($query)){
		$rs["uid_a_username_short"] = str_cut($rs["uid_a_username"],$count);
		$rs["uid_b_username_short"] = str_cut($rs["uid_b_username"],$count);
//		if ($rs["uid_a"] == "105107" && $rs["uid_b"] == "109039") {
//			$rs["value"] = 	$rs["value"] - 	190000;
//		}
		$friend_month[] = $rs;
	}
	
	include_once(template('show/show_friend'));
} elseif ($op == 'ajax') {
	$tab = $_G['gp_tab'];
	if($tab == 'get_all_gift_list')
	{
		header("Content-type: text/html; charset=utf-8");
  		//礼品类型
		$giftType = cGetGiftType();
		$typeNum = count($giftType);
		//礼品列表
		$giftList = cGetGift();
		include_once(template('show/gift_api'));
		die();
	}
	if($tab == 'get_uid_gift_order_list')
	{
		header("Content-type: text/html; charset=utf-8");
		$uid  = $_GET["uid"];
		if(!is_numeric($uid))
			die("uid应该是数字");
		$giftpai=cGetGiftpai($uid);
		include_once(template('show/get_uid_gift_order_list'));
		die();
	}
	if ($tab == 'anchors') {#主播列表
		//得到UID是否是开通测试的
		$allow = MutiliveRoom::getUidAllow($_G['uid']);
		
		$matchpage = empty($_G['gp_matchpage']) ? 0 : intval($_G['gp_matchpage']);	//比赛页
		$hotpage = empty($_G['gp_hotpage']) ? 0 : intval($_G['gp_hotpage']);	//热门页
		$count = 32;	//每页多少条
		$matchpage = max(1, $matchpage);
		$hotpage = max(1, $hotpage);
		$match_limit = ($matchpage - 1) * $count;
		$hot_limit = ($hotpage - 1) * $count;
		$data = array(
			'match' => $match_limit,
			'hot' => $hot_limit,
			'count' => $count
		);
		$cmd_body = '012'.json_encode($data);
		$recvdata = socketSendAndRecvData(LOCAL_HOST,LOCAL_PORT, encodeCommand($cmd_body, 6), 5);
		$recvdata = json_decode($recvdata, true);
		$matchnumber = $recvdata['match']['rooms']; //比赛区总条数
		$hotnumber= $recvdata['hot']['rooms']; //热门区总条数
		
		if ($recvdata['hot']) {//热门区
			$multi = multi($hotnumber, $count, $hotpage, "show.php?operation=ajax&tab=anchors");
			$multi = preg_replace("/href=\"show.php\?operation=ajax&tab=anchors&amp;page=(\d+)\"/", "href=\"javascript:setHotPage(\\1)\"", $multi);
			$html.='<ul id="hotanchor_nav">';
                        foreach ($recvdata['hot']['lists'] as $key=>$value) {
                            //print_r($recvdata['hot']['lists']);die('11111111111');
                            $stat_str=($value['online']==1)?'<img src="static2/images/zaixian.png" width="44" height="15" />':'';
                            $avatar = avatar($value['uid'],'middle',true,false,true,'/uc_server');
                            $html.='<li>
                                <div class="pp-box">
                                <div class="pp-bg">
                                <a class="pp" href="/'.$value['uid'].'" target="_blank" style="background-image:url('.$avatar.');">
                                <span class="hotanchor_sha">
                                <img src="static2/images/charmlevel/'.$value['level'].'.png" width="16" height="16" />
                                </span>
                                <span class="hotanchor_D_2">'.$stat_str.'</span>
                                <span class="hotanchor_D_on">['.$value['users'].$maxRoomMember.']</span>
                                </a>
                                </div>
                                </div>
                                <p class="hotanchor_ben">
                                <a href="/'.$value['uid'].'" target="_blank">'.$value['nicename'].'<br>('.$value['uid'].')</a>
                                </p>
                                </li>';
                            if(($key+1)%4==0){
                                $html.='<div style="clear:both;"></div>';
                            }
                        }
			$html.='</ul>';
			$back1 = array('status'=>1, 'anchors'=>$html, 'pageHtml'=>$multi, 'onlineAnchors'=>$recvdata['hot']['casts'], 'onlineMember'=>$recvdata['hot']['users']);
//			echo json_encode($back1);
		}
		if ($recvdata['match']) {//比赛区
			$multi = multi($matchnumber, $count, $matchpage, "show.php?operation=ajax&tab=anchors");
			$multi = preg_replace("/href=\"show.php\?operation=ajax&tab=anchors&amp;page=(\d+)\"/", "href=\"javascript:setMatchPage(\\1)\"", $multi);
			$htm2.='<ul id="hotanchor_nav">';
			foreach ($recvdata['match']['lists'] as $key=>$value) {
				$stat_str=($value['online']==1)?'<img src="static2/images/cansai.png" width="44" height="15" />':'';
				$avatar = avatar($value['uid'],'middle',true,false,true,'/uc_server');
				$htm2.='<li>
					<div class="pp-box">
					<div class="pp-bg">
					<a class="pp" href="/'.$value['uid'].'" target="_blank" style="background-image:url('.$avatar.');">
					<span class="hotanchor_sha">
					<img src="static2/images/charmlevel/'.$value['level'].'.png" width="16" height="16" />
					</span>
					<span class="hotanchor_D_2">'.$stat_str.'</span>
					<span class="hotanchor_D_on">['.$value['users'].$maxRoomMember.']</span>
					</a>
					</div>
					</div>
					<p class="hotanchor_ben">
					<a href="/'.$value['uid'].'" target="_blank">'.$value['nicename'].'<br>('.$value['uid'].')</a>
					</p>
					</li>';
				if ($key%4==3&&$key!=($tpp-1)) {
					$htm2.= '</ul>';
					$htm2.='<div class="clear"></div>';
					$htm2.='';
					$htm2.='<ul id="hotanchor_nav">';
				}
			}
			$htm2.='</ul><div class="clear"></div>';
			$back2 = array('status'=>1, 'anchors'=>$htm2, 'pageHtml'=>$multi, 'onlineAnchors'=>$recvdata['match']['casts'], 'onlineMember'=>$recvdata['match']['users']);
//			echo json_encode($back1);
		}
		if ($allow == '1'){	
			//多音房用户列表
			require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");
			$mutilpage = empty($_G['gp_mutilpage']) ? 0 : intval($_G['gp_mutilpage']);	//热门页
			$mutilpage = max(1, $mutilpage);
			$mutil_limit = ($mutilpage - 1) * $count;
			$data = array(
				'hot' => "$mutil_limit",
				'count' => "$count"
			);
			$mutil = MutilLiveRoomSocketApi::sendIndexMultiRoomList($data);
			$mutilnumber= $mutil['hot']['rooms']; //热门区总条数
			if ($mutil['hot']) {
					$multi = multi($mutilnumber, $count, $mutilpage, "show.php?operation=ajax&tab=anchors");
					$multi = preg_replace("/href=\"show.php\?operation=ajax&tab=anchors&amp;page=(\d+)\"/", "href=\"javascript:setMutilPage(\\1)\"", $multi);
					$htm3.='<ul id="hotanchor_nav">';
					$num = 1;
					foreach ($mutil['hot']['lists'] as $key=>$value) {
						//麦数必需不等于0
						if ($value['managercount'] >0 or $value['mastercount'] > 0){
							$mutilcover = getLiveCover($value['uid'],'middle','livecover');
							$htm3.='<li>
								<div class="pp-box">
								<div class="pp-bg">
								<a class="pp" href="/mv'.$value['roomid'].'" target="_blank" style="background-image:url('.$mutilcover.');">
								<span class="hotanchor_D_on">['.$value['users'].$maxRoomMember.']</span>
								</a>
								</div>
								</div>
								<p class="hotanchor_ben">
								<a href="/mv'.$value['roomid'].'" target="_blank">'.$value['nicename'].'<br>('.$value['uid'].')</a>
								</p>
								</li>';
							if($num%4==0){
                                $htm3.='<div style="clear:both;"></div>';
                            }
                            $num++;
						}
					}
					$htm3.='</ul>';
					$back3 = array('status'=>1, 'multianchors'=>$htm3, 'pageHtml'=>$multi, 'multionlineAnchors'=>$mutil['hot']['casts'], 'multionlineMember'=>$mutil['hot']['users']);
			}
		}
		$AnchorList = array('list1'=>$back1, 'list2'=>$back2,'list3'=>$back3);
		echo json_encode($AnchorList);
	
	} elseif ($tab == 'forecast') {#预告
		$forecast = cGetForecast();
		$html = '';
		foreach ($forecast as $key=>$value) {
            $html .= '<div class="showrqinrkuang">';
            $html .= '<div class="showrqinrtext1">'.$value['dateline_str1'].'</div>';
            $html .= '<div class="showrqinrtext2">';
            $html .= '<p class="showrqinrtext3"><span class="shijian">'.$value['dateline_str2'].'</span><a href="#">'.$value['username'].'</a>              </p> </div>';
            if ($value['recommand']==1) {
                 $html .= '<div class="show_xian">'.avatar($value['uid'], 'small');
                 $html .= '<p>'.$value['content'].'</p>';
                 $html .= '<div class="kais_anniu"><a href="v'.$value['roomid'].'" target="_blank"><img src="static2/images/kais_anniu.gif" width="56" height="14" /></a><a href="v'.$value['roomid'].'" target="_blank"><img src="static2/images/kais_anniu_01.gif" width="57" height="14" /></a></div>';
                 $html .= '</div>';
            }
            $html .= '</div>';
		}
		if (empty($html)) {
			$html = '<div>暂无通告</div>';
		}
		$back = array('status'=>1, 'html'=>$html);
		echo json_encode($back);
	} elseif ($tab == 'notices') {#最新公告
		$html = '';
		$notices = cGetNotices($getNoticsNum);
		foreach ($notices as $key=>$value) {
			$html .= "$value";
		}
		if (empty($html)) {
			$html = '暂无公告';
		}
		$back = array('status'=>1, 'html'=>$html);
		echo json_encode($back);
	}elseif ($tab=='getRoomstatus'){
		$status = MSN_RoomStatus($_GET['spaceuid']);		
		if ($status){
			$back = array('status'=>$status);
		}else {
			$back = array('status'=>0);
		}
		echo json_encode($back);
	}elseif ($tab=='getGiftList'){
		$t=@$_GET['t'];
		$roomid = $_GET['roomeruid'];
		//+memcache缓存 2011.06.28 zhangcj
		//礼物更新时间
		$memcache = new cmemcache();
		$data = $memcache->get("live_giftup-$roomid");
		if ($data !== false) {
			$newTime = $data;
		} else {
			$newTime = DB::result_first("SELECT `time` FROM pre_live_giftup WHERE roomid='".$_GET['roomeruid']."' ORDER BY time DESC limit 1");
			//echo $newTime.'<br>';
			$memcache->set("live_giftup-$roomid", $newTime, CMEMCACHE_LIVE_GIFTLIST);
		}
		$memcache->close();
		//end		
		
		if ($newTime>$t){
			$back=array();
			
			//+memcache缓存 2011.06.23 zhangcj
			$memcache = new cmemcache();
			$data = $memcache->get("live_giftlist-$roomid");
			if ($data !== false) {
				$back = $data;
			} else {
				$sql = " SELECT a.* ,if(b.nickname!='',b.nickname,b.username ) as nickname "
				       ." FROM ".DB::table('live_giftlist')." a LEFT JOIN ".DB::table('common_member')." b ON a.uid = b.uid  
				       WHERE a.roomid='".$_GET['roomeruid']."' ORDER BY a.id DESC";
				 //echo $sql;			
				$query=DB::query($sql);	
				$i=0;		
				while ($res = DB::fetch($query)){
					$back[$i]=$res;
					$back[$i]['username']=$res['nickname'];
					$i++;
				}
				$memcache->set("live_giftlist-$roomid", $back, CMEMCACHE_LIVE_GIFTLIST);
			}
			$memcache->close();
			//end
			if ($back){				
				$ret = array('type'=>'giftlist','giftlist'=>$back,'t'=>$newTime);
				echo json_encode($ret);
			}else {
				die();
			}
			
		}else{			
			die();
		}
		
	}elseif ($tab=='setRoomBg')
	{
		if ($_GET['act']=='save'){
			$gbg = $_GET['bg'];
			$bg = "#space_body {background-image:url('".$gbg."') !important;background-repeat:repeat !important;}";			
			$setarr['spacecss'] = daddslashes($bg);
			if ($_G['uid']){
				if(DB::update('common_member_field_home', $setarr, "uid = {$_G['uid']}"))
				{					
					echo '{"status":1}';
				}else{
					echo '{"status":0}';
				}
			}else {
				echo '{"status":0}';
			}
			die();
		}
		if (submitcheck('uploadsubmit')) {
			require_once libfile('function/spacecp');
			$albumid = $picid = 0;
		
			if(!checkperm('allowupload')) {
				echo "<script>";
				echo "alert(\"".lang('spacecp', 'not_allow_upload')."\")";
				echo "</script>";
				exit();
			}
			$uploadfiles = pic_save($_FILES['attach'], $_POST['albumid'], $_POST['pic_title'], false);
			if($uploadfiles && is_array($uploadfiles)) {
				$albumid = $uploadfiles['albumid'];
				$picid = $uploadfiles['picid'];
				$uploadStat = 1;
				require_once libfile('function/spacecp');
				album_update_pic($albumid);
			} else {
				$uploadStat = $uploadfiles;
			}
		
			$picurl = pic_get($uploadfiles['filepath'], 'album', $uploadfiles['filepath'], $uploadfiles['remote'],0);
		
			echo "<script>";
			if($uploadStat == 1) {
				$bg = "body {background-image:url('".$picurl."') !important;background-repeat:repeat !important;}";
			
				$setarr['spacecss'] = daddslashes($bg);
				DB::update('common_member_field_home', $setarr, "uid = {$_G['uid']}");
				echo "parent.upbgsuss('".$picurl."','1')";
			} else {
				echo "parent.upbgsuss('', '0')";
			}
			echo "</script>";
			die();
			
		}
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		if($page<1) $page=1;	
		$perpage = 7;
		$perpage = mob_perpage($perpage);	
		$start = ($page-1)*$perpage;	
		ckstart($start, $perpage);
		$wheresql = "albumid='0' AND uid='$space[uid]'";
		$query = DB::query("SELECT * FROM ".DB::table('home_pic')." WHERE $wheresql ORDER BY dateline DESC LIMIT $start,$perpage");
		while ($value = DB::fetch($query)) {
			$value['pic'] = pic_get($value['filepath'], 'album', $value['thumb'], $value['remote'],0);
			$value['tmppic'] = pic_get($value['filepath'], 'album', $value['thumb'], $value['remote']);
			$list[] = $value;
		}
		$lastBg = DB::fetch_first("SELECT spacecss FROM ".DB::table('common_member_field_home')." WHERE uid = '$space[uid]'");
		header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
	<root><![CDATA[';
		
		include_once(template('show/show_setroombg'));
		echo ']]></root>';
		
	}elseif ($tab=='setRoomPlayer'){
		$roomid = $_G['uid'];
		if ($_GET['act']=='save'){
			$player = $_GET['player'];		
			$sql = "UPDATE ".DB::table('live_room')." SET `type`='$player' WHERE roomid = '$roomid'";
			
			if (DB::query($sql)){
				echo 1;
			}else{
				echo 0;
			}
			die();
		}
		
		$sql = "SELECT * FROM ".DB::table('live_room')." WHERE roomid = '$roomid'";
		$roominfo = DB::fetch_first($sql);
		$anchorInfo = DB::fetch_first("SELECT * FROM ".DB::table('live_member_count')." WHERE uid=".$_G['uid']);
		
		header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
	<root><![CDATA[';	
		include_once(template('show/show_setroomplayer'));
		echo ']]></root>';
		
	}elseif ($tab=='setNotice')
	{
		if($_GET['act']=='save'){
			$roomnotice=trim($_GET['roomnotice']);			
			$roomnotice_link=trim($_GET['roomnotice_link']);
			$s_roomnotice=trim($_GET['s_roomnotice']);
			$s_roomnotice_link=trim($_GET['s_roomnotice_link']);
			if (strlen($roomnotice)>150 or strlen($s_roomnotice)>150 or strlen($roomnotice_link)>100 or strlen($s_roomnotice_link)>100)
			{
				
				echo '{"status":"-1"}';
				die();
			}
			$data = array();
			$data['roomnotice']=$roomnotice;			
			$data['s_roomnotice']=$s_roomnotice;			
			if (!empty($roomnotice_link)){
				if (!preg_match('/http:\/\/[\w]+[-.]+huoshow+[-.]+com+[^\s]*/', $roomnotice_link) )
				{
					echo '{"status":"-2"}';
					die();
				}else {					
					$data['roomnotice_link']=$roomnotice_link;
				}			
			}
			if (!empty($s_roomnotice_link)){
				if (!preg_match('/http:\/\/[\w]+[-.]+huoshow+[-.]+com+[^\s]*/', $s_roomnotice_link))
				{
					echo '{"status":"-2"}';
					die();
				}else {					
					$data['s_roomnotice_link']=$s_roomnotice_link;
				}
			}
			
			$roominfo =  serialize($data);			
			$sql = "UPDATE ".DB::table('live_room_config')." SET roominfo = '$roominfo' WHERE uid=".$_G['uid'];	
			if(DB::query($sql)){			
				echo '{"status":1}';
				$dstuid = (string)$_G['uid'];
				$data = array(
					'act'=>'3',
					'dstroomid'=> $dstuid,
					'type'=>'1'
				);
				$cmd_body = '020'.json_encode($data);
				socketSendData(LOCAL_HOST, LOCAL_PORT, encodeCommand($cmd_body, 6));
			}else{
				echo '{"status":0}';
			}
			die();
		}
		$sql = "SELECT * FROM ".DB::table('live_room_config')." WHERE uid=".$_G['uid'];	
		$room = DB::fetch_first($sql);
		$roominfo = unserialize($room['roominfo']);
		
		header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
	<root><![CDATA[';
		
		include_once(template('show/show_setnotice'));
		echo ']]></root>';
	}elseif ($tab=='add')
	{
		$uid = $_G['uid'];
		$targetuid = $_GET['targetuid'];
		$applicationfans = cGetIsFans($uid,$targetuid);
	}elseif ($tab=='pkteam'){
		$teamId = $_GET['teamid'];
		$toPage = $_GET['page'];		
		$team = PK::getTeamMemberInfo($teamId, 4, $toPage);
		//print_r($team);
		echo '<div class="pk_Race_shenma_pic">
        <ul id="nav">';         
          foreach($team['list'] as $key=>$value){
      		echo '<li>';
            if ($value['online']==1){
            	echo '<div class="info"><span class="sha"><img src="static2/images/live_pk_images/zaixian.png" width="12" height="12" style="position: absolute;"/></span>
            	<span class="D_2"  style="position: absolute;"><img src="static2/images/live_pk_images/renshu.png" width="8" height="10"  /> '.$value['onlineMember'].'/100</span>             
            	</div>';
            } else{
            	echo '<div class="info_01"><span class="sha"><img src="static2/images/live_pk_images/lixian.png" width="37" height="12" /></span> </div>';
            }           
            echo '<p class="ben"><a href="/v'.$value['uid'].'">'.$value['avatar'].$value['username'].'</a></p></li>';
          	if ($key%2==1 && $key!=3){
          		echo '</ul>   </div>       <div class="clear"></div>   <div class="pk_Race_shenma_pic">  <ul id="nav">';
         	}
        };
        echo '</ul> </div>';
		
			
	}
}

/**
* 截取指定长度的字符串(UTF-8专用 汉字和大写字母长度算1，其它字符长度算0.5)
*
* @param string $string: 原字符串
* @param int $length: 截取长度
* @param string $etc: 省略字符（...）
* @return string: 截取后的字符串
*/
function str_cut($sourcestr, $cutlength = 80, $etc = '...')
{
$returnstr = '';
$i = 0;
$n = 0.0;
$str_length = strlen($sourcestr); //字符串的字节数
while ( ($n<$cutlength) and ($i<$str_length) )
{
   $temp_str = substr($sourcestr, $i, 1);
   $ascnum = ord($temp_str); //得到字符串中第$i位字符的ASCII码
   if ( $ascnum >= 252) //如果ASCII位高与252
   {
    $returnstr = $returnstr . substr($sourcestr, $i, 6); //根据UTF-8编码规范，将6个连续的字符计为单个字符
    $i = $i + 6; //实际Byte计为6
    $n++; //字串长度计1
   }
   elseif ( $ascnum >= 248 ) //如果ASCII位高与248
   {
    $returnstr = $returnstr . substr($sourcestr, $i, 5); //根据UTF-8编码规范，将5个连续的字符计为单个字符
    $i = $i + 5; //实际Byte计为5
    $n++; //字串长度计1
   }
   elseif ( $ascnum >= 240 ) //如果ASCII位高与240
   {
    $returnstr = $returnstr . substr($sourcestr, $i, 4); //根据UTF-8编码规范，将4个连续的字符计为单个字符
    $i = $i + 4; //实际Byte计为4
    $n++; //字串长度计1
   }
   elseif ( $ascnum >= 224 ) //如果ASCII位高与224
   {
    $returnstr = $returnstr . substr($sourcestr, $i, 3); //根据UTF-8编码规范，将3个连续的字符计为单个字符
    $i = $i + 3 ; //实际Byte计为3
    $n++; //字串长度计1
   }
   elseif ( $ascnum >= 192 ) //如果ASCII位高与192
   {
    $returnstr = $returnstr . substr($sourcestr, $i, 2); //根据UTF-8编码规范，将2个连续的字符计为单个字符
    $i = $i + 2; //实际Byte计为2
    $n++; //字串长度计1
   }
   elseif ( $ascnum>=65 and $ascnum<=90 and $ascnum!=73) //如果是大写字母 I除外
   {
    $returnstr = $returnstr . substr($sourcestr, $i, 1);
    $i = $i + 1; //实际的Byte数仍计1个
    $n++; //但考虑整体美观，大写字母计成一个高位字符
   }
   elseif ( !(array_search($ascnum, array(37, 38, 64, 109 ,119)) === FALSE) ) //%,&,@,m,w 字符按１个字符宽
   {
    $returnstr = $returnstr . substr($sourcestr, $i, 1);
    $i = $i + 1; //实际的Byte数仍计1个
    $n++; //但考虑整体美观，这些字条计成一个高位字符
   }
   else //其他情况下，包括小写字母和半角标点符号
   {
    $returnstr = $returnstr . substr($sourcestr, $i, 1);
    $i = $i + 1; //实际的Byte数计1个
    $n = $n + 0.5; //其余的小写字母和半角标点等与半个高位字符宽...
   }
}
if ( $i < $str_length )
{
   $returnstr = $returnstr . $etc; //超过长度时在尾处加上省略号
}
return $returnstr;
}
?>
