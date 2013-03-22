<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_space.php 17496 2010-10-20 03:03:15Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$uid = empty($_GET['uid']) ? 0 : intval($_GET['uid']);

if($_GET['username']) {
	$member = DB::fetch_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$_GET[username]' LIMIT 1");
	if(empty($member)) {
		showmessage('space_does_not_exist');
	}
	$uid = $member['uid'];
}

//$dos = array('live', 'doing');

$do = (!empty($_GET['do']))?$_GET['do']:'index';
if($do == 'index' && $_G['inajax']) {
	$do = 'profile';
}

if(empty($uid) || in_array($do, array('notice', 'pm'))) $uid = $_G['uid'];

if($uid) {
	$space = getspace($uid);
	if(empty($space)) {
		showmessage('space_does_not_exist');
	}
}
else 
{
	showmessage('login_before_enter_home', null, array(), array('showmsg' => true, 'login' => 1));
}

if(!in_array($do, array('doing')) && empty($uid)) {
	showmessage('login_before_enter_home', null, array(), array('showmsg' => true, 'login' => 1));
}

/*
	if($do != 'profile' && $do != 'index' && !ckprivacy($do, 'view')) {
		$_G['privacy'] = 1;
		require_once libfile('space/profile', 'include');
		include template('home/space_privacy');
		exit();
	}
*/

$filepath = $_G['gp_filepath'];
/*
	如果有需要单独访问的页面直接加到array中
*/
if(in_array($do,array("ajax")))
{
	require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/module/home/$do/$filepath.php");
	die();
}

include_once template("home/space_huoshow");

?>