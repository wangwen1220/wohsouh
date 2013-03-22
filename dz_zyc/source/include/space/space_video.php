<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_doing.php 16856 2010-09-16 02:53:58Z wangjinbo $
 */

if(!defined('IN_DISCUZ')) 
{
	exit('Access Denied');
}
$perpage = 20;
$perpage = mob_perpage($perpage);

$page = empty($_GET['page'])?0:intval($_GET['page']);
if($page<1) $page=1;
$start = ($page-1)*$perpage;

ckstart($start, $perpage);

$list = array();
$count = 0;

if(empty($_GET['view'])) {
	$_GET['view'] = 'we';
}

$gets = array(
	'mod' => 'space',
	'uid' => $space['uid'],
	'do' => 'video',
	'view' => $_GET['view'],
	'searchkey' => $_GET['searchkey'],
	'from' => $_GET['from']
);
$theurl = 'home.php?'.url_implode($gets);


$diymode = 0;


if($_GET['from'] == 'space') $diymode = 1;

$wheresql = "uid='$space[uid]' AND `type`=2 AND auditstatus=2 ";

$actives = array($_GET['view'] =>' class="a"');


if(empty($count)) 
{
	$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('video_list')." WHERE $wheresql"), 0);
}
if($count) {
	$query = DB::query("SELECT * FROM ".DB::table('video_list')."
		WHERE $wheresql
		ORDER BY dateline DESC
		LIMIT $start,$perpage");
	while ($value = DB::fetch($query)) 
	{
		$value['pic']=cVideoPic($value, 'small');
		$list[]=$value;
	}
}

$multi = multi($count, $perpage, $page, $theurl);

dsetcookie('home_diymode', $diymode);

$navtitle = "视频";

if($space['username']) 
{
	$navtitle =$space['username']."的视频";
}
$metakeywords = $navtitle;
$metadescription = $navtitle;
include_once template('diy:home/space_video_list');
