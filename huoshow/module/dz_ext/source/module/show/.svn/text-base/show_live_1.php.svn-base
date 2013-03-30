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
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$roomid=trim($_G['gp_roomid']);
$uid = $_G['uid'];
$avatar = avatar1($roomid, 'middle',true,false,true);
$hs_system = & HuoshowSys::instance();

require_once(template('show/show_live_1'));
?>
