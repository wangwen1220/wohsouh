<?php
header("Content-Type: text/xml; charset=UTF-8");
require './../source/class/class_core.php';
require_once './../source/function/function_home.php';

$discuz = & discuz_core::instance();
$discuz->init();
define('WWW_HOST','http://'.$_SERVER['HTTP_HOST'].'/');
runhooks();
$datas = array();
if($_G['uid']) {
	//消息
	$newpm=$_G['member']['newpm'] ? $_G['member']['newpm'] :0;
	if ($_G['member']['nickname']) {
		$username= $_G['member']['nickname'];
	}else {
		$username= $_G['username'];
	}
	//用户组
	$usergroup=$_G['group']['grouptitle'] ? $_G['group']['grouptitle'] : "";
	$user_money[]=array(
        "title" =>"用户组" ,
        "value"=>$usergroup,
        "unit"=>"",
        "img"=>"",
	);
	//论坛管理权限
	if($_G['group']['radminid'] > 1){
		$forum=array('fid'=>$_G['fid'],'name'=>"{$_G['setting']['navs'][2]['navname']}管理");
	}else {
		$forum=array();
	}
	$avatar = avatar1($_G['uid'], 'small',true,false,true);
	$datas = array(
		'user_id' => $_G['uid'],
		'user_name' => $username,
		'user_avatar' => $avatar,
		'sys_msg_num' => $newpm,
		'sys_msg_url' => WWW_HOST."home.php?mod=space&do=pm",
		'user_msg_num' => '',
		'user_msg_url' => '',
		'formhash' => $forum,
		'logout_url' => WWW_HOST."member.php?mod=logging&action=logout&formhash=".FORMHASH,
	);
	echo $_GET['jsoncallback'].'('.json_encode($datas).')';
}
?>