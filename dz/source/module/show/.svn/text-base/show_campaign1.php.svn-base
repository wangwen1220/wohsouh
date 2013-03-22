<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_space.php 10932 2010-05-18 07:39:13Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$operation = $_G['gp_operation'];
$num = empty($_G['gp_num']) ? 5 : $_G['gp_num'];

if ($operation == 'usertop') {//用户排名
	$top = array();
	$query = DB::query("SELECT m.uid,m.username,c.extcredits4 FROM ".DB::table('common_member_count')." c LEFT JOIN ".DB::table('common_member').
		" m ON c.uid=m.uid ORDER BY extcredits4 DESC LIMIT $num");
	
	$i = 0;
	
	while ($rs = DB::fetch($query)) {
		if($i == 0) {
			$no = 1;
		} elseif ($rs['extcredits4'] == $top[$i-1]['campaign1']) {
			$no = $top[$i-1]['no'];
		} else {
			$no = $i + 1;
		}
		$top[$i]['no'] = $no;
		$top[$i]['uid'] = $rs['uid'];
		$top[$i]['username'] = $rs['username'];
		$top[$i]['campaign1'] = $rs['extcredits4'];
		$i++;
	}
	
	echo json_encode($top);
} elseif ($operation == 'myshowtop') {
	$query = DB::query("SELECT m.myshowid,m.title,m.click FROM (SELECT myshowid,title,(click1+click2+click3+click4+click5+click6+click7+click8) as click FROM ".DB::table('video_list').") m ORDER BY click DESC LIMIT $num");
	
	$i = 0;
	while ($rs = DB::fetch($query)) {
		if($i == 0) {
			$no = 1;
		} elseif ($rs['click'] == $top[$i-1]['click']) {
			$no = $top[$i-1]['no'];
		} else {
			$no = $i + 1;
		}
		$top[$i]['no'] = $no;
		$top[$i]['myshowid'] = $rs['myshowid'];
		$top[$i]['title'] = $rs['title'];
		$top[$i]['click'] = $rs['click'];
		$i++;
	}
	
	echo json_encode($top);
}
?>