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
$uid = empty($_G['uid']) ? 0 : intval($_G['uid']);
//没登录
if(empty($uid))
{
	showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
}
$live_user_value_res=index_live_user_value($uid);
//if($live_user_value_res)
//{
//	showmessage('抱歉明星会员不能使用flash直播', 'show.php', array(), array('showmsg' => true, 'login' => 1));
//}

$dos = array('index','create');

$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'create';

if($uid) 
{
	$space = getspace($uid, 'uid');
	$live_uid=substr(sha1($uid),0,24);
}
require_once libfile('show/'.$do, 'include');

?>