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
$op = $_G['gp_op'];

$uid = $_G['uid'];
$avatar = avatar1($roomid, 'middle',true,false,true);
//$anchorInfo = DB::fetch_first("SELECT * FROM ".DB::table('live_member_count')." WHERE uid='$roomid'");
//if (!$anchorInfo){
//	showmessage('没有此主播!', 'show.php', array(), array('showmsg' => true, 'login' => 1));
//}





$sql = "SELECT uid FROM ".DB::table('common_member')." WHERE uid='$roomid' LIMIT 1";
$member = DB::fetch_first($sql);
if (!$member){
	showmessage('没有此用户!', 'show.php', array(), array('showmsg' => true, 'login' => 1));
}
$uid = $member['uid'];
$space = getspace($uid);
space_merge($space, 'field_home');
space_merge($space, 'profile');


//取配置数据
$query = DB::query("SELECT * FROM ".DB::table('add_setting')." WHERE skey IN('liveplayer_ver','liveplayer_ver2', 'liveplayer_url', 'livedown_ver', 'livedown_url')");
while ($rs = DB::fetch($query)) {
	$addSetting[$rs['skey']] = $rs['svalue'];
}
if($_SERVER["REQUEST_METHOD"]=='POST'){
	//echo $_SERVER["REQUEST_URI"];
	header('Location: '.$_SERVER["REQUEST_URI"]);
	exit;
}
$module = $_G['gp_module'];
if(empty($module))
	$module = "show";
include_once template("show/show_huoshow");

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
