<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_wall.php 16680 2010-09-13 03:01:08Z wangjinbo $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$perpage = 20;
$perpage = mob_perpage($perpage);

$page = empty($_GET['page'])?1:intval($_GET['page']);
if($page<1) $page=1;
$start = ($page-1)*$perpage;

ckstart($start, $perpage);

$theurl = "home.php?mod=space&uid=$space[uid]&do=$do";

$diymode = 1;

$cid = empty($_GET['cid'])?0:intval($_GET['cid']);
$csql = $cid?"cid='$cid' AND":'';

$list = array();
$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('home_comment')." WHERE $csql id='$space[uid]' AND idtype='uid'"),0);
if($count) {
	$query = DB::query("SELECT c.*,if(m.nickname!='',m.nickname,m.username) as nickname FROM ".DB::table('home_comment')." c
	LEFT JOIN ".DB::table('common_member')." m ON m.uid=c.uid 
	WHERE $csql id='$space[uid]' AND idtype='uid' ORDER BY dateline DESC LIMIT $start,$perpage");
	while ($value = DB::fetch($query)) {
		$temp=$value;
		$q=DB::query("select r.*,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('home_comment_reply')." r
		LEFT JOIN ".DB::table('common_member')." m ON m.uid=r.reply_uid 
		WHERE cid='".$value['cid']."' and reply_stat=1");
		while($v=DB::fetch($q)){
			$temp['reply_arr'][]=$v;
		}
		$list[] = $temp;
	}
}

$multi = multi($count, $perpage, $page, $theurl);

$navtitle = lang('space', 'sb_wall', array('who' => $space['username']));
$metakeywords = lang('space', 'sb_wall', array('who' => $space['username']));
$metadescription = lang('space', 'sb_wall', array('who' => $space['username']));

dsetcookie('home_diymode', 1);

include_once template("home/space_wall");

?>