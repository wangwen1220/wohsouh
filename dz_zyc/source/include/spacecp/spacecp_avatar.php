<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: spacecp_avatar.php 9904 2010-05-05 07:54:40Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(submitcheck('avatarsubmit')) {
	showmessage('do_success', 'cp.php?ac=avatar&quickforward=1');
}

loaducenter();
$uc_avatarflash = uc_avatar($_G['uid'], 'virtual', 0);
$dstuid = (string)$_G['uid'];
$data = array(
	'act'=>'2',
	'dstuid'=> $dstuid
);
$cmd_body = '020'.json_encode($data);
socketSendData(LOCAL_HOST, LOCAL_PORT, encodeCommand($cmd_body, 6));
if(empty($space['avatarstatus']) && uc_check_avatar($_G['uid'], 'middle')) {
	DB::update('common_member', array('avatarstatus'=>'1'), array('uid'=>$_G['uid']));
	DB::update2('`huoshow_bbs_x2`.pre_common_member', array('avatarstatus'=>'1'), array('uid'=>$_G['uid']));
	updatecreditbyaction('setavatar');
	if($_G['setting']['my_app_status']) manyoulog('user', $_G['uid'], 'update');
	
}
$actives = array('avatar' =>' class="a"');
include template("home/spacecp_avatar");

?>