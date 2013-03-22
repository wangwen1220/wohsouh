<?php
define('CURSCRIPT', 'apidb');
define('ACTID',4);
require './../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();
//主播类
require DISCUZ_ROOT.'source/function/function_live.php';

$act = @$_GET['act'];
if(trim($act)=='') die();
//$dzUrl = 'http://dev.huoshow.com/';
$dzUrl = $_GET['dz_url'];

if ($act == 'zhuanti') {
	$data=getActzhuantiList();	
	die(json_encode($data));
	
}

if ($act == 'anchors') {
//	$sql = "SELECT t.*,c.charm as ch,m.username,if(m.nickname!='',m.nickname,m.username) as nickname 
//		FROM ".DB::table('live_top')." as t left join ".DB::table('live_member_count')." as c on t.uid=c.uid 
//		LEFT JOIN ".DB::table('common_member')." m ON m.uid=c.uid
//		WHERE t.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) 
//		AND t.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) 
//		AND t.cate='charm' AND t.monthnum>0 ORDER BY t.monthnum DESC LIMIT 10";
//	//echo $sql;
//	$query = DB::query($sql);
//	while ($rs = DB::fetch($query)){
//		$rs[avatar] = avatar($rs['uid'],'middle');
//		$anchors[]=$rs;
//		$data = $anchors;
//	}
//	//print_r($data);
//	die(json_encode($data));
	
	
	//排行
	$tpp = 6;
	$anchorsInfo = cGetAnchors($tpp, 1);
	$anchorsNum = $anchorsInfo['total'];#主播数
	$onlineAnchors = $anchorsInfo['onlineAnchors'];#在线主播数
	$onlineMember = $anchorsInfo['onlineMember'];#在线人数
	$anchors = $anchorsInfo['list'];#主播列表 
//	$anchors['avatar'] = avatar($anchorsInfo['uid'], 'small');
	$data = $anchors;
	//print_r($data);
	die(json_encode($data));
	
	
	
	
}