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
$uid = empty($_GET['uid']) ? 0 : intval($_GET['uid']);

if($_GET['username']) {
	$member = DB::fetch_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$_GET[username]' LIMIT 1");
	$uid = $member['uid'];
}


if(empty($uid)) $uid = $_G['uid'];

$perpage = 9;
$page = empty($_GET['page']) ? 0 : intval($_GET['page']);
if($page<1) $page=1;
$start = ($page-1)*$perpage;

$magiclist=array();
$magiccount = DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_magiclog')." WHERE targetuid='{$uid}' AND action=3 ");
//$multipage = multi($magiccount, $_G['tpp'], $page, "home.php?mod=magic&action=shop&operation=$operation");
$multi = jsmulti('recevieGift',$magiccount, $perpage, $page);
$magiclist[] = array('count'=>$magiccount);
$magiclist[] = array('page'=>$page);
$magiclist[] = array('multi'=>$multi);
$magiclist[] = array('perpage'=>$perpage);
$query = DB::query("SELECT uid,magicid,dateline,targetuid,amount FROM ".DB::table('common_magiclog')." 
			WHERE targetuid='{$uid}' AND action='3' ORDER BY dateline DESC
		    LIMIT {$start},{$perpage}");
while($magic = DB::fetch($query)) 
{
	$query1 = DB::query("SELECT  name, identifier, description, price, num, salevolume, weight FROM ".DB::table('common_magic')." WHERE magicid='{$magic['magicid']}' LIMIT 1");
	$magic_res = DB::fetch($query1);
	$magic_res['pic'] = strtolower($magic_res['identifier']).'.gif';
	$magic_res['dateline']=dgmdate($magic['dateline'], 'u');
	$usernameower = DB::fetch_first("SELECT username FROM ".DB::table('common_member')." WHERE uid='{$magic['uid']}' LIMIT 1");
	$magic_res['usernameower']= !empty($usernameower['username']) ?  $usernameower['username']: $magic['uid'];
	$magic_res['amount']=$magic['amount'];
	$magiclist[] = $magic_res;
}
//print_r($magiclist);
echo json_encode($magiclist);
