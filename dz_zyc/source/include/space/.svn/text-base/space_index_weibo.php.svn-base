<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_home.php 17249 2010-09-27 10:17:23Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!$_G['uid'] && $_G['setting']['privacy']['view']['home']) {
	showmessage('home_no_privilege', '', array(), array('login' => true));
}

if (!empty($_G['uid'])){
	//header("Location:home.php?mod=huoshow&do=weibo");
	if(empty($cp_mode)) include_once template("diy:home/space_index_weibo");
}else {
	if(empty($cp_mode)) include_once template("diy:home/space_index_weibo");
}
?>