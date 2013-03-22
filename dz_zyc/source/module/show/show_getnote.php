<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_space.php 10932 2010-05-18 07:39:13Z zhengqingpeng $
 */


require_once libfile('function/live');
$uid=empty($_GET['uid']) ? 0 : intval($_GET['uid']);

$res=array();
if(empty($uid))
{
	$uid = $_G['uid'];
	//echo json_encode($notelist);exit;
}

$notelist=index_live_notice_res($uid);
if($notelist)
{
	foreach ($notelist as $v)  
	{
		$v['dateline']=date('Y-m-d H:i',$v['start_time']).' 至 '.date('Y-m-d H:i',$v['end_time']);
		$res[]=$v;
	}
}
echo json_encode($res);
