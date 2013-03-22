<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_live.php 10932 2011-01-17 07:39:13Z zhouyc $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$uid = $_G['uid'];
$username = $_G['username'];
$timet = time();
//没登录
if(empty($uid)) {
	showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
}

//$sql = "SELECT COUNT(fans) fans FROM ".DB::table('live_contribution')." WHERE uid=$uid AND fans = 1";
//$sql = " SELECT COUNT(*) fans FROM ".DB::table('live_contribution')." WHERE targetuid IN (SELECT uid FROM ".DB::table('live_artists')." WHERE agent=$uid AND status = 1) AND fans = 1";
//echo $sql;

//用户余额
$sql = "SELECT * FROM ".DB::table('ucenter_showcoin')." WHERE uid = $uid";
$userHuoShowCoin = DB::fetch_first($sql);

//领取了的工资
$sql = "select sum(totalmony) wages from ".DB::table('live_wage_log')." where uid=$uid";
$bring = DB::fetch_first($sql);

//得到pre_live_member_count资料
$sql = "select * from ".DB::table('live_member_count')." where uid=$uid ";
$nametype = DB::fetch_first($sql);
//echo $nametype['interest'];
if ($nametype) {
	$sql = "select * from ".DB::table('live_room')." where uid=".$nametype['uid'];
	$userlive = DB::fetch_first($sql);
}

//明星等级
$chartmLevel = cGetStarLevel($nametype['charm']);
$charl = $_G['setting']['level']['charm'];
//需要升级的差值
$char = $charl[$chartmLevel['level']]['valuelower']-$nametype['charm'];	

//得到粉丝
$fans = getFans($uid);

//经纪人等级
$agentlevel = cGetAgentLevel($nametype['interest']);
//echo $agentlevel['name'].'<br>';
$agent1 = $_G['setting']['level']['totalmony'];
//需要升级的差值
$agent = $agent1[$agentlevel['level']]['valuelower']-$nametype['interest'];

$agentfans = cGetAgentFansLevel($fans['fans']);
//echo $agentfans['name'].'<br>';
$fans1 = $_G['setting']['level']['fans'];
$fans = $fans1[$agentfans['level']]['valuelower']-$fans['fans'];

//粉丝功能暂时不开通
//if ($agentlevel['level'] == $agentfans['level']){
//	echo '相等就取第一个:'.$agentlevel['level'];
//}else {
//	if ($agentlevel['level'] < $agentfans['level']){
//		echo '能力值小于推广值取第一个'.$agentlevel['level'];
//	}else {
//		echo '能力值大于推广值取第二个'.$agentfans['level'];
//	}
//}


//得到pre_live_artists资料
$sql = "SELECT * FROM ".DB::table('live_artists')." where uid=$uid ORDER BY starttime desc";
$artists = DB::fetch_first($sql);

//得到经纪人有多少艺人
$sql = "select COUNT(*) coun from ".DB::table('live_artists')." where agent=$uid and status=1 ";
$countagent = DB::fetch_first($sql);

//是否有有人申请
$sql = "select COUNT(*) coun from ".DB::table('live_artists')." where agent=$uid and status=-1 ";
$tip = DB::fetch_first($sql);

//得到经纪人姓名
//$sql = "select * from ".DB::table('live_member_count')." where uid in(select agent from ".DB::table('live_artists')." where uid=$uid)";
$sql = "select c.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('live_member_count')." c
left join ".DB::table('common_member')." m on m.uid=c.uid
where c.uid in(select agent from ".DB::table('live_artists')." where uid=$uid) ";
$agentname = DB::fetch_first($sql);

//已领取多少秀币和火币,秀币和火币的比例是2:1
$sql = "select sum(xiumony) xiumoney FROM ".DB::table('live_wage_log')." where uid=$uid ";
$myxiumony = DB::fetch_first($sql);
$sql = "select sum(houmony) houmoney FROM ".DB::table('live_wage_log')." where uid=$uid ";
$myhoumony = DB::fetch_first($sql);

//总收益
$xiubi = $nametype['interest'] - $bring['wages'];
$houbi = floor ( $xiubi / 2 );

//今日收益
$stime =strtotime(date("Y-m-d").'00:00:00');
$day ="select sum(income) money from ".DB::table('live_artists')." a left join ".DB::table('live_room_log')." b on a.uid=b.uid where a.agent=$uid and a.status=1 and a.starttime <= b.start_time AND end_time >=$stime";
$dayrevenue = DB::fetch_first($day);
$dayearnings= floor($dayrevenue['money'] / 10 );

//本月收益
$stime = strtotime(date("Y-m").'-01 00:00:00');
$month = "select sum(income) money from ".DB::table('live_artists')." a left join ".DB::table('live_room_log')." b on a.uid=b.uid where a.agent=$uid and a.status=1 and a.starttime <= b.start_time and end_time >=$stime";
$monthrevenue = DB::fetch_first($month);
$monthearnings = floor($monthrevenue['money'] / 10 );

//我的艺人
if($_GET['act']=='artists'){
	//经纪人的艺人
	$name = $_G['gp_name'];
	$income = $_G['gp_income'];
	$status = $_GET['status'];

	if (!empty($_G['gp_duidate1'])) {
		$startTime = strtotime($_G['gp_duidate1'].' 00:00:01');
	}
	if (!empty($_G['gp_duidate2'])) {
		$startTime1 = strtotime($_G['gp_duidate2'].' 23:59:59');
	}
	$condition='';
	$summary='';
	if ($name){
		$condition = $condition." AND username like '%$name%' ";
	}
	if (!empty($startTime)) {
		$condition .= " AND starttime >= '$startTime' ";
		$summary .= "时间:".date('Y-m-d',$startTime);
	}
	if (!empty($startTime1)) {
		$condition .= " AND starttime <= '$startTime1' ";
		$summary .= "到".date('Y-m-d',$startTime1)."期间";
	}

	if ($income) {
		if ($income == '3') {
			$ob = " and status = -1";
		}
		if ($income == '4') {
			$ob = " and status = 1";
		}
		if ($income == '5') {
			$ob = " and status = 2";
		}
	}
	if ($status){
		if ($status == 'sq') {
			$status = " and status = -1 ";
		}
		if ($status == 'qy') {
			$status = " and status = 1 ";
		}
		if ($status == 'jy') {
			$status = " and status = 2 ";
		}
	}
//	$al = "select COUNT(DISTINCT(username)) count from ".DB::table('live_artists')." where agent = $uid ";
//	$qb = DB::fetch_first($al);
	$sq = "select COUNT(DISTINCT(username)) count from ".DB::table('live_artists')." where agent = $uid and status = -1 ";
	$sqz = DB::fetch_first($sq);
	$qy = "select COUNT(DISTINCT(username)) count from ".DB::table('live_artists')." where agent = $uid and status = 1 ";
	$yqy = DB::fetch_first($qy);
	$jy = "select COUNT(DISTINCT(username)) count from ".DB::table('live_artists')." where agent = $uid and status = 2 ";
	$yjy = DB::fetch_first($jy);
	$al = $sqz['count'] + $yqy['count'] + $yjy['count'];
	
	//分页
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	if($page<1) $page=1;
	$perpage = 10;
	$start = ($page-1)*$perpage;
	$count = DB::result_first("select COUNT(*) from ".DB::table('live_artists')." where agent=$uid ");
	$sql = "select * from ".DB::table('live_artists')." where 1 ".$condition." $status and agent = $uid $ob group by username order by status LIMIT $start,$perpage";
	//echo $sql.'<br>';
	$art_rs = DB::query($sql);
	$i=0;
	while ($res = DB::fetch($art_rs)) {
		$myartists[$i] = $res;
//		$sql = "select *,sum(income) AS money from ".DB::table('live_room_log')." a join ".
//		DB::table('live_artists')." b on a.uid=b.uid where a.uid=".$res['uid']."
//				and b.starttime <= a.start_time  GROUP BY a.username ";
		$sql = "select a.*,b.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname,sum(income) AS money from ".DB::table('live_room_log')." a left join ".DB::table('live_artists')." b on a.uid=b.uid left join ".DB::table('common_member')." m on m.uid=b.uid where a.uid=".$res['uid']." and b.starttime <= a.start_time  GROUP BY a.username ";
		$bb = DB::fetch_first($sql);
		$myartists[$i]['money']=$bb;
		$myartists[$i]['end_time']=$bb;
		$myartists[$i]['nickname']=$bb;
		$i++;
	}
	
	$multi = multi($count, $perpage, $page, "home.php?mod=space&do=live&act=artists");

	//接受申请人
	if ($_GET['opt']=='accept') {
		$uid = $_GET['uid'];
		$sql = "UPDATE ".DB::table('live_artists')." SET status='1',starttime=$timet WHERE uid=$uid and status = -1";
		//echo $sql;
		DB::query($sql);
		header("Location: home.php?mod=space&do=live");
	}

	//拒绝申请人
	if ($_GET['opt']=='refused') {
		$uid = $_GET['uid'];
		$sql = "delete from ".DB::table('live_artists')." where uid=$uid ";
		DB::query($sql);
		header("Location: home.php?mod=space&do=live");
	}
	
	//经纪人解约
	if ($_GET['opt']=='release'){
		$upsql = "update ".DB::table('live_artists')." set status='2' where uid=".$_GET['uid'];
		DB::query($upsql);
		header("Location: home.php?mod=space&do=live");
	}
	
	//明星解约
	if ($_GET['opt'] == 'remove'){
		SIPHuoShowUpdate($uid,'SWC',-$_GET['money'],'您与经纪人'.$_GET['username'].'解约赔偿：'.$_GET['money'].'个火币');
		SIPHuoShowUpdate($_GET['uid'],'AFD',+$_GET['money'],'您获得'.$username.'的解约补偿：'.$_GET['money'].'个火币');
		$upsql = "update ".DB::table('live_artists')." set status='2' where uid=$uid";
		DB::query($upsql);
		header("Location: home.php?mod=space&do=live");
	}
	
	//明星解约不成功
	if ($_GET['opt'] == 'remove1'){
		header("Location: home.php?mod=space&do=live");
	}
	
	include_once template("home/space_live_artists");
	return ;
}

//解约并得出盈利
if ($_GET['act']=='release'){
	$id=$_GET['uid'];
	$relname = "select a.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('live_member_count')." a left join ".DB::table('common_member')." m on m.uid=a.uid where a.uid=$id";
	$username=DB::fetch_first($relname);
	header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
	<root><![CDATA[';
		include_once template("home/space_live_release");
		echo ']]></root>';
	return;
}

//艺人与经纪人解约
if ($_GET['act'] == 'remove'){
	$id=$_GET['uid'];
	//echo "本人UID:".$_G['uid'].'----------'."经纪人UID:".$id;
	$money = $userHuoShowCoin['showcoin'];
	$sql = "select *,m.username,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('live_member_count')." a left join ".DB::table('common_member')." m on m.uid=a.uid where a.uid=$id";
	$agusername=DB::fetch_first($sql);
	if ($agusername['uid']){
		//根据艺人UID得到经纪人等级
		$sql = "select * from ".DB::table('live_member_count')." where uid=".$agusername['uid'];
		$bringss = DB::fetch_first($sql);
		//能力值
		$agentlevels = cGetAgentLevel($bringss['interest']);
		//得到粉丝
		//$fanslevels = getFans($agusername['uid']);
		//推广值
		//$agentfanslevels = cGetAgentFansLevel($fanslevels['fans']);
		
		if ( $agentlevels['level'] < '7'){
			if ($money >= '5000') {
				$aaa = 5000;
			}else {
				$aaa = 5000;
				header("Content-Type: text/xml; charset=utf-8");
				echo '<?xml version="1.0" encoding="utf-8"?>
					<root><![CDATA[';
				include_once template("home/space_live_remove1");
				echo ']]></root>';
				return;
			}
		}
		if ( $agentlevels['level'] >= '7' and $agentlevels['level'] < '13'){
			if ($money >= '30000') {
				$aaa = 30000;
			}else {
				$aaa = 30000;
				header("Content-Type: text/xml; charset=utf-8");
				echo '<?xml version="1.0" encoding="utf-8"?>
					<root><![CDATA[';
				include_once template("home/space_live_remove1");
				echo ']]></root>';
				return;
			}
		}
		if ( $agentlevels['level'] >= '13' and $agentlevels['level'] < '19'){
			if ($money >= '80000') {
				$aaa = 80000;
			}else {
				$aaa = 80000;
				header("Content-Type: text/xml; charset=utf-8");
				echo '<?xml version="1.0" encoding="utf-8"?>
					<root><![CDATA[';
				include_once template("home/space_live_remove1");
				echo ']]></root>';
				return;
			}
		}
		if ( $agentlevels['level'] >= '19' and $agentlevels['level'] < '25'){
			if ($money >= '150000') {
				$aaa = 150000;
			}else {
				$aaa = 150000;
				header("Content-Type: text/xml; charset=utf-8");
				echo '<?xml version="1.0" encoding="utf-8"?>
					<root><![CDATA[';
				include_once template("home/space_live_remove1");
				echo ']]></root>';
				return;
			}
		}
		if ( $agentlevels['level'] >= '25' and $agentlevels['level'] < '31'){
			if ($money >= '300000') {
				$aaa = 300000;
			}else {
				$aaa = 300000;
				header("Content-Type: text/xml; charset=utf-8");
				echo '<?xml version="1.0" encoding="utf-8"?>
					<root><![CDATA[';
				include_once template("home/space_live_remove1");
				echo ']]></root>';
				return;
			}
		}
		if ( $agentlevels['level'] >= '31'){
			if ($money >= '500000') {
				$aaa = 500000;
			}else {
				$aaa = 500000;
				header("Content-Type: text/xml; charset=utf-8");
				echo '<?xml version="1.0" encoding="utf-8"?>
					<root><![CDATA[';
				include_once template("home/space_live_remove1");
				echo ']]></root>';
				return;
			}
		}
		
	}
	header("Content-Type: text/xml; charset=utf-8");
	echo '<?xml version="1.0" encoding="utf-8"?>
	<root><![CDATA[';
		include_once template("home/space_live_remove");
		echo ']]></root>';
	return;
	
}


//得到经纪人
if($_GET['act']=='seeagent'){	
	$sql = "SELECT c.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname FROM " .DB::table('live_member_count')." c left join ".DB::table('common_member')." m on m.uid=c.uid WHERE isagent=1 ORDER BY charm DESC";
	$query = DB::query($sql);
	while ($res = DB::fetch($query)){
		$seeagent[] = $res;
	}
	//艺人向经纪人发送请求,把艺人添加到一个新表
	if ($_GET['opt']=='addagent') {
		$uid = $_GET['uid'];
		$name = $_G['username'];
		$sql = "select * from ".DB::table('live_artists')." where uid=".$_G['uid'];
		$isexist = DB::fetch_first($sql);
		if ($isexist['agent'] == $uid) {
			$sql = "UPDATE ".DB::table('live_artists')." SET status='-1',starttime=$timet WHERE uid=".$_G['uid']." and status = 2";
			DB::query($sql);
			header("Location: home.php?mod=space&do=live");
		}else {
			if ($_G['uid'] == $uid){
				echo "不能与自己签约!!!";
			}else {
				$artistsData = array(
				'uid'=>$_G['uid'],'username'=>$name,'status'=> -1,'agent'=>$uid,'starttime'=>$timet
			);
				//print_r($artistsData);
				DB::insert('live_artists',$artistsData);
				header("Location: home.php?mod=space&do=live");
			}
		}
		
	}
	include_once template("home/space_live_seeagent");
	return ;
}


//经纪人收益
if($_GET['act']=='earnings'){
	//经纪人收益
	$username = $_G['gp_username'];
	$income = $_G['gp_income'];
	if (!empty($_G['gp_duidate1'])) {
		$startTime = strtotime($_G['gp_duidate1'].' 00:00:01');
	}
	if (!empty($_G['gp_duidate2'])) {
		$startTime1 = strtotime($_G['gp_duidate2'].' 23:59:59');
	}
	$condition='';
	$summary='';
	if ($username){
		$condition = $condition."AND b.username like '%$username%' ";
	}

	if (!empty($startTime)) {
		$condition .= " AND b.start_time >= '$startTime' ";
		$summary .= "时间:".date('Y-m-d',$startTime);
	}
	if (!empty($startTime1)) {
		$condition .= " AND b.start_time <= '$startTime1' ";
		$summary .= "到".date('Y-m-d',$startTime1)."期间";
	}
	if ($income) {
		if ($income == '1'){
			$ob = " order by income desc";
		}
		if ($income == '2'){
			$ob = " order by income ";
		}
		if ($income == '6') {
			$ob = " order by start_time desc";
		}
		if ($income == '7') {
			$ob = " order by start_time";
		}
		if ($income == '8') {
			$ob = " order by max_members desc";
		}
		if ($income == '9') {
			$ob = " order by max_members";
		}
	}else {
		$ob = "order by start_time desc";
	}
	//分页
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	if($page<1) $page=1;
	$perpage = 12;
	$start = ($page-1)*$perpage;
	$count = DB::result_first("select COUNT(*) from ".DB::table('live_artists')." a left join ".DB::table('live_room_log')." b on a.uid=b.uid where a.agent=$uid and a.status=1 and a.starttime <= b.start_time ");
//	$sql = "select * from ".DB::table('live_artists')." a left join ".DB::table('live_room_log')."
//			b on a.uid=b.uid where 1 ".$condition." and a.agent=$uid and a.status=1 
//			and a.starttime <= b.start_time $ob LIMIT $start,$perpage";
	$sql = " select a.*,b.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname FROM ".DB::table('live_artists')." a left join ".DB::table('common_member')." m on m.uid=a.uid left join ".DB::table('live_room_log')." b on a.uid=b.uid where 1 ".$condition." and a.agent=$uid and a.status=1 and a.starttime <= b.start_time $ob LIMIT $start,$perpage";
	$earnin = DB::query($sql);
	while ($res = DB::fetch($earnin)) {
		$res['start_time'] = date("Y-m-d H:i:s",$res['start_time']);
		$res['end_time'] = date("Y-m-d H:i:s",$res['end_time']);
//		$res['income'] = $res['income'] / 10;
		$earnings[] = $res;
	}
	$multi = multi($count, $perpage, $page, "home.php?mod=space&do=live&act=earnings");
	
	$sql = "select SUM(income) inc from ".DB::table('live_artists')." a left join ".DB::table('live_room_log')."
			b on a.uid=b.uid where a.agent=$uid and a.status=1 
			and a.starttime <= b.start_time ";
	$mon = DB::fetch_first($sql);
	//echo $mon['inc'];
	
	include_once template("home/space_live_earnings");
	return ;
}

//我的收益
if($_GET['act']=='myincome'){
//	$username = $_G['gp_username'];
	$income = $_G['gp_income'];
	//echo $income;
	if (!empty($_G['gp_duidate1'])) {
		$startTime = strtotime($_G['gp_duidate1'].' 00:00:01');
	}
	if (!empty($_G['gp_duidate2'])) {
		$startTime1 = strtotime($_G['gp_duidate2'].' 23:59:59');
	}
	$condition='';
	$summary='';
	if (!empty($startTime)) {
		$condition .= " AND a.start_time >= '$startTime' ";
		$summary .= "时间:".date('Y-m-d',$startTime);
	}
	if (!empty($startTime1)) {
		$condition .= " AND a.start_time <= '$startTime1' ";
		$summary .= "到".date('Y-m-d',$startTime1)."期间";
	}
	if ($income) {
		if ($income == '1'){
			$ob = " order by a.income desc";
		}
		if ($income == '2'){
			$ob = " order by a.income ";
		}
		if ($income == '6') {
			$ob = " order by a.start_time desc";
		}
		if ($income == '7') {
			$ob = " order by a.start_time";
		}
		if ($income == '8') {
			$ob = " order by a.max_members desc";
		}
		if ($income == '9') {
			$ob = " order by a.max_members";
		}
	}else {
		$ob = "order by a.start_time desc";
	}
	
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	if($page<1) $page=1;
	$perpage = 12;
	$start = ($page-1)*$perpage;
	$count = DB::result_first("select COUNT(*) from ".DB::table('live_room_log')." where uid = $uid");
	$sql = "select * from ".DB::table('live_room_log')." where 1 ".$condition." and uid = $uid $ob LIMIT $start,$perpage";
	
	//$sql = "select c.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('live_member_count')." c left join ".DB::table('common_member')." m on m.uid=c.uid
	
	$sql = "select a.*,m.username,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('live_room_log')." a left join ".DB::table('common_member')." m on m.uid=a.uid where 1 ".$condition." and a.uid = $uid $ob LIMIT $start,$perpage";
	
	$earnin = DB::query($sql);
	while ($res = DB::fetch($earnin)) {
		$res['start_time'] = date("Y-m-d H:i:s",$res['start_time']);
		$res['end_time'] = date("Y-m-d H:i:s",$res['end_time']);
		$earnings[] = $res;
	}
	$multi = multi($count, $perpage, $page, "home.php?mod=space&do=live&act=myincome");
	
	$sql = "select sum(income) m from ".DB::table('live_room_log')." where uid=$uid ";
	$toalmymon = DB::fetch_first($sql);
	include_once template("home/space_live_myincome");
	return ;
}

//我的薪水
if($_GET['act']=='salary'){
	$xiumony = $_G ['gp_input1'];
	$houmony = $_G ['gp_input2'];
	$name = $_G ['username'];
	SIPHuoShowUpdate($uid, 'AFD', +$xiumony, '您获得盈利：'.$xiumony.'个火币');
	SIPHuoCoinUpdate($uid, 'AFD', +$houmony, '您获得盈利：'.$houmony.'个秀币');
	if ($_GET['opt']=='lingqu'){
		$salaryData = array(
			'uid'=>$_G['uid'],'username'=>$name,'houmony'=>$houmony,'xiumony'=>$xiumony,'totalmony'=>$xiubi,'starttime'=>$timet
		);
		DB::insert('live_wage_log',$salaryData);
		header("Location: home.php?mod=space&do=live");
	}
	
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	if($page<1) $page=1;
	$perpage = 10;
	$start = ($page-1)*$perpage;
	$count = DB::result_first("select COUNT(*) from ".DB::table('live_wage_log')." where uid = $uid");
	$sql = "select * from ".DB::table('live_wage_log')." where uid = $uid LIMIT $start,$perpage";
	$salary = DB::query($sql);
	while ($res = DB::fetch($salary)) {
		$res['starttime'] = date("Y-m-d H:i:s",$res['starttime']);
		$mysalary[] = $res;
	}
	$multi = multi($count, $perpage, $page, "home.php?mod=space&do=live&act=salary");
		
	include_once template("home/space_live_salary");
	return ;
}

include_once template("home/space_live");
return ;

?>