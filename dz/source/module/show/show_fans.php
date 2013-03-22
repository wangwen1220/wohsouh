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

require_once libfile('function/live');
$uid = empty($_G['gp_uid']) ? 0 : $_G['gp_uid'];

$fanType = isset($_G['gp_type']) ? $_G['gp_type'] : 'month';

//粉丝排行榜
$fansTop = cGetFansTop($uid, 10, $fanType);
echo json_encode($fansTop);

