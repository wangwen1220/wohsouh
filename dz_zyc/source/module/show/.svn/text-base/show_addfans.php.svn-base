<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_index.php 10793 2010-05-17 01:52:12Z xupeng $
 */

$uid=$_GET['uid'] ? $_GET['uid'] : 0;

if(empty($_G['uid']))
{
	showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
}
if(empty($uid))
{
	showmessage('要加入的对象不存在');
}
require_once libfile('function/home');
$somebody=getspace($uid);
if($uid==$_G['uid'])
{
	showmessage('自己不能加入自己创建的粉丝圈');
}
require_once libfile('function/live');
$fansower_res=index_get_fansower($uid);
if(empty($fansower_res))
{
	showmessage('要加入的对象还没创建粉丝圈');
}
$att=array(
'fid'=>$fansower_res['fid'],
'uid'=>$_G['uid'],
'username'=>$_G['username'],
'level'=>4,
'joindateline'=>time()
);
$add_fans_res=index_add_fans($att);
$referer="show.php?mod=somebody";
showmessage('do_success', $referer, array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => 1));
?>