<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_space.php 10932 2010-05-18 07:39:13Z zhengqingpeng $
 */
set_time_limit(0);
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
if($uid) 
{
	$space = getspace($uid, 'uid');
	$live_uid=substr(sha1($uid),0,24);
}
$live_user_value_res=index_live_user_value($uid);
if(!$live_user_value_res)
{
	showmessage('抱歉普通会员不能使用p2p直播', 'show.php', array(), array('showmsg' => true, 'login' => 1));
}

$back = cCheckViolation($_G['uid']);
if ($back == 1) {
	showmessage('违规处罚中，暂停直播服务', 'show.php');
}

//设置IP和端口号
$addr= "shub.netwaymedia.com" ;
$port=8085;
$data_str_string='';$data_mid_string='';$data_end_string='';
for($i=0;$i<strlen(sha1($live_uid)); $i+=2)
{
	 $da=substr(sha1($live_uid),$i,2);
	 $data_mid_string.="\x{$da}";
}
eval( "\$newd_ata_mid_string = \"".$data_mid_string."\";" );
//echo $data_mid_string;exit;
$data_str_string="\x01\x00\x00\x00\x18\x00\x00\x00\x03\x81\x02";
$data_end_string="\x00\x00\x00\x00\x00";
//创建一个SOCKET
$socket_type=getprotobyname("tcp");
if(($sock=socket_create(AF_INET,SOCK_STREAM,$socket_type))<0)
{
    echo "socket_create() failed :".socket_strerror($sock)."<br />";exit;
}

$result=socket_connect($sock, $addr, $port) ;
if($result < 0 )
{
	echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result)."<br />";exit;
}
//$data_mid_string="[H\xd8\x8a\x19\x94\x1e?\x15\x1dI\xec\xd7+0\xb6P\xea\x91z";
$all_data=$data_str_string.$newd_ata_mid_string.$data_end_string;
if(!socket_write($sock, $all_data))  
{
	echo "socket_write() failed: reason: " . socket_strerror($sock) . "<br />";
}

$out =socket_read($sock, 1024);

socket_close($sock); 

$dos = array('index','pmy');

$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'pmy';


require_once libfile('show/'.$do, 'include');

?>