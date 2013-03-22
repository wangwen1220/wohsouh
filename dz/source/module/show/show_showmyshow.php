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
//主播不在线时，播放主播上传的音视频。
require_once libfile('function/live');
$act=$_G ['gp_operation'];
$uid=$_G['gp_uid'];
if(trim($uid)=='')die();
if($act=='showmyshow'){
	$query=DB::query("select * from ".DB::table("video_list")." where auditstatus=2 and uid=$uid order by dateline desc");
	$i = 0;
	 while($rs = DB::fetch($query)) {
	//$data[$i]="{ file:".cVideoUrl($rs).",image:".cVideoPic($rs, 'big')."},";
		$data[$i]['file']=cVideoUrl($rs);
		if($rs['type']==1){
		$data[$i]['image']="http://dev.huoshow.com/static2/images/video_default.gif";
		}else{
		$data[$i]['image']=cVideoPic($rs, 'big');
		}
		$data[$i]['title']=$rs['title'];
		//$data[$i]['description']=$rs['author'];
		$data[$i]['duration']=$rs['timelength'];
	$i++;
	}
	   die(json_encode($data));
	
}
