<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_index.php 10793 2010-05-17 01:52:12Z xupeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/space');

//如果已经登录了该房间则不能再登录
/*if (!empty($_G['uid'])) {
	$existed = DB::result_first("SELECT COUNT(*) FROM pre_live_userlist WHERE roomid=$roomid AND uid=".$_G['uid']);
	if ($existed) {
		showmessage('您已经在其它地方登录此房间,不能再次登录!', 'show.php');
	}
}*/

if (!empty($_G['uid'])){
	$usertype=4;
	//判断是否为巡管，如果是则提升超管权限
	$existed = DB::result_first("SELECT COUNT(*) FROM pre_live_admin WHERE uid=".$_G['uid']);
	if ($existed) {
		$usertype = 1;
	}
	//end
}else{
	$usertype='5';
}
$sql = "SELECT uid FROM ".DB::table('common_member')." WHERE uid='$roomid' LIMIT 1";
	
$member = DB::fetch_first($sql);
	
if (!$member){
	showmessage('没有此用户!', 'show.php', array(), array('showmsg' => true, 'login' => 1));
}
$uid = $member['uid'];
$space = getspace($uid);
space_merge($space, 'field_home');
space_merge($space, 'profile');
if(!empty($space['groupid']))
{
	$gname_res=DB::fetch_first("SELECT grouptitle FROM ".DB::table('common_usergroup')." WHERE groupid='{$space['groupid']}' LIMIT 1");
	$space['show_groupname']=$gname_res['grouptitle'];
}
				//$charm=get_charm($uid);
				
//进入主播的房间
if ($_G['uid']) {
	cInWhoseRoom($_G['uid'], $uid, 2);
	//cContributionAndCharm($_G['uid'], $uid, 0);//给主播增加了0点贡献度，并成为主播的粉丝
}

//得到主播魅力值和消费值
$anchorInfo = DB::fetch_first("SELECT charm FROM ".DB::table('live_member_count')." WHERE uid='$uid'");
//$anchorInfo['huoshow'] = SIPHuoShowGetBalance($uid);
//火秀币
$anchorInfo['huoshow'] = HuoShowGetConsume($uid);
//用户魅力，财富等级
$chartmLevel =cGetCharmLevel($anchorInfo[charm]);
$huoshowlevel =cGetHuoshowLevel($anchorInfo['huoshow']);
$charl=$_G['setting']['level']['charm'];
$huol=$_G['setting']['level']['huoshow'];
//需要升级的差值
				
$char=$charl[$chartmLevel['level']]['valuelower']-$anchorInfo['charm'];	
$charzhi=(($anchorInfo['charm']-$charl[$chartmLevel['level']-1]['valuelower'])/($charl[$chartmLevel['level']]['valuelower']-$charl[$chartmLevel['level']-1]['valuelower']))*100;
		
$huoshow=$huol[$huoshowlevel['level']]['valuelower']-$anchorInfo['huoshow'];
$huozhi=(($anchorInfo['huoshow']-$huol[$huoshowlevel['level']-1]['valuelower'])/($huol[$huoshowlevel['level']]['valuelower']-$huol[$huoshowlevel['level']-1]['valuelower']))*100;	
//$anchorInfo['huoshow'] = 0;
				
//粉丝排行榜
//$fansTop = cGetFansTop($uid, 10);	

$live_uid=substr(sha1($uid),0,24);
//		$some_body_live_uid=substr(sha1($_G['uid']),0,24);
if ( empty($_G['uid']) )
	$some_body_live_uid = "";
else
	$some_body_live_uid=substr(sha1($_G['uid']),0,24);
//礼物排名

//$giftpai=cGetGiftpai($uid);

//直播预告
$index_live_notice_res=index_live_notice_res($uid);
//获取主播类型
$live_type=GetTypee($uid);
//取配置数据
$query = DB::query("SELECT * FROM ".DB::table('add_setting')." WHERE skey IN('liveplayer_ver','liveplayer_ver2', 'liveplayer_url', 'livedown_ver', 'livedown_url')");
while ($rs = DB::fetch($query)) {
	$addSetting[$rs['skey']] = $rs['svalue'];
}

//参加的赛事
//$index_rank_res=index_participate_rank($uid);

$roomType = 1;#0主播，1观众(js中用到)
//flash后面加上时间
$time = time();
include_once(template('show/show_psomebody'));

?>
