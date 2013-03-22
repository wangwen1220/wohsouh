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

/*if(empty($_COOKIE[SIP_COOKIES_NAME]))
{
	showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
}*/
$username=trim($_G['gp_username']);
//$username=mb_convert_encoding($username, "UTF-8", "GB2312");
if($username)
{
	if($username==$_G['username'])
	{
		showmessage('不能以观众的身份进入自己的房间', 'show.php?mod=test', array(), array('showmsg' => true, 'login' => 1));
	}
	$member = DB::fetch_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$username' LIMIT 1");
    $zbuid = $member['uid'];
	
	
	//进入主播的房间
	if ($_G['uid']) {
		cInWhoseRoom($_G['uid'], $zbuid, 2);
		cContributionAndCharm($_G['uid'], $zbuid, 0);//给主播增加了0点贡献度，并成为主播的粉丝
	}	    
} 
else 
{
	showmessage('错误没有此主播', 'show.php', array(), array('showmsg' => true, 'login' => 1));
}

$dos = array('index','watch');

$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'watch';

require_once libfile('show/'.$do, 'include');

?>