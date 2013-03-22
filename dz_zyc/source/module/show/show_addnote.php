<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_index.php 10793 2010-05-17 01:52:12Z xupeng $
 */

require_once libfile('function/live');
if(empty($_G['uid']))
{
	showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
}
if(!submitcheck('notesubmit'))
{
	include template('show/show_addnote');
	dexit();
}
else 
{
	$timeNow = time();
	$timeStart = strtotime($_POST['start_time']);
	$timeEnd = strtotime($_POST['end_time']);
	$content = $_POST['content'];
	
	if (empty($_POST['start_time']) || empty($_POST['end_time'])) {
		showmessage('演出时间不能为空');
	} elseif ($timeStart<$timeNow || $timeEnd<$timeNow) {
		showmessage('演出时间不能小于当前时间');
	} elseif ($timeEnd <= $timeNow) {
		showmessage('演出时间设置不正确');
	}
	
	if (empty($content)) {
		showmessage('演出内容不能为空');
	} elseif (mb_strlen($content,'utf-8')>30) {
		showmessage('演出内容不能超过30字');
	}

	$att=array(
		'uid'=>$_G['uid'],
		'username'=>$_G['username'],
		'content'=>$_POST['content'],
		'dateline'=>$timeNow,
		'start_time'=>$timeStart,
		'end_time'=>$timeEnd
	);
	$add_note_res=index_live_notice_insert($att);
	$referer="show.php?mod=my";
	//echo "<script>parent.getNote();</script>";
    showmessage('do_success', $referer, array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => 1));
}

?>