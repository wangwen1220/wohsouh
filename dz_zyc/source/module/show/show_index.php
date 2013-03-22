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
$uid = empty($_GET['uid']) ? 0 : intval($_GET['uid']);

if($_GET['username']) {
	$member = DB::fetch_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$_GET[username]' LIMIT 1");
	$uid = $member['uid'];
} 

$dos = array('index');
$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'index';

if(empty($uid)) $uid = $_G['uid'];

if($uid) {
	$space = getspace($uid, 'uid');
	//获取火秀币
    //include_once(DISCUZ_ROOT.'sip/function_credit.php');
	$huoxiu=SIPHuoShowGetBalance($uid);
}
require_once libfile('show/'.$do, 'include');

?>
