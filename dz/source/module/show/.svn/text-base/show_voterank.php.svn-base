<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_index.php 10793 2010-05-17 01:52:12Z xupeng $
 */

$uid=$_GET['uid'] ? $_GET['uid'] : 0;
$rank_id=$_GET['rank_id'] ? $_GET['rank_id'] : 0;
if(empty($_G['uid']))
{
	showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
}
if(empty($uid))
{
	showmessage('要投票的对象不存在');
}
if(empty($rank_id))
{
	showmessage('要投票的赛事不存在');
}
require_once libfile('function/home');
$somebody=getspace($uid);
if($uid==$_G['uid'])
{
	showmessage('自己不能给自己投票');
}
require_once libfile('function/live');
$vote_res=index_get_vote($_G['uid'],$rank_id,$uid);
if(empty($vote_res))
{
	showmessage('你已经投过票了');
}
$update_res=index_update_vote($uid,$rank_id);
$referer="show.php?mod=somebody&username=".$somebody['username'];
if($update_res)
{
	showmessage('do_success', $referer, array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => 1));
}
else 
{
	showmessage('操作失败', $referer, array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => 1));
}

?>