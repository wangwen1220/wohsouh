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

$live_admin=index_is_admin($_G['uid']) ? 1 : 0;
//echo $live_admin;exit;
//if($live_admin)
//{
//	showmessage('管理员不能进入', 'show.php', array(), array('showmsg' => true, 'login' => 1));
//}

//如果已经创建一个房间则不能再创建
/*$existed = DB::result_first("SELECT COUNT(*) FROM pre_live_room WHERE stat>0 AND roomid=".$_G['uid']);
if ($existed) {
	showmessage('抱歉，你已经创建了一个房间，不能创建多个!', 'show.php');
}
*/

//直播预告
//$index_live_notice_res=index_live_notice_res($_G['uid']);
space_merge($space, 'field_home');
space_merge($space, 'profile');
//$charm=get_charm($_G['uid']);

//创建房间
if(empty($_REQUEST['type'])){
	$roomid = cCreateRoom($_G['uid']); 
}else{
    $roomid = cCreateRoom($_G['uid'],$_REQUEST['type']);
}
//获取主播类型
$live_type=GetTypee($_G['uid']);

//加入房间
if ($roomid) {
	cInRoom($_G['uid'], $roomid, 1);
}
//得到主播魅力值
$anchorInfo = DB::fetch_first("SELECT charm FROM ".DB::table('live_member_count')." WHERE uid=".$_G['uid']);
//得到主播消费的火秀币
$anchorInfo['huoshow'] = HuoShowGetConsume($_G['uid']);
//用户魅力，财富等级
$chartmLevel =cGetCharmLevel($anchorInfo[charm]);
$huoshowlevel =cGetHuoshowLevel($anchorInfo['huoshow']);
//得到有那些等级
$charl=$_G['setting']['level']['charm'];
$huol=$_G['setting']['level']['huoshow'];
//需要升级的差值		
$char=$charl[$chartmLevel['level']]['valuelower']-$anchorInfo['charm'];	
$charzhi=(($anchorInfo['charm']-$charl[$chartmLevel['level']-1]['valuelower'])/($charl[$chartmLevel['level']]['valuelower']-$charl[$chartmLevel['level']-1]['valuelower']))*100;
$huoshow=$huol[$huoshowlevel['level']]['valuelower']-$anchorInfo['huoshow'];
$huozhi=(($anchorInfo['huoshow']-$huol[$huoshowlevel['level']-1]['valuelower'])/($huol[$huoshowlevel['level']]['valuelower']-$huol[$huoshowlevel['level']-1]['valuelower']))*100;
//粉丝排行榜
//$fansTop = cGetFansTop($_G['uid'], 10);
//礼物排名
//$giftpai=cGetGiftpai($_G['uid']);
//参加的赛事
//$index_rank_res=index_participate_rank($_G['uid']);
//是否明星会员
$live_user_value_res=index_live_user_value($_G['uid']);
if($live_user_value_res==0){
	//showmessage('只有<font color="red">火秀明星</font>才能开启直播。<a href="portal.php?mod=topic&topicid=1"><b>点击这里</b></a> 联系在线经纪人，申请成为<font color="red">火秀明星</font><br/>', 'portal.php?mod=topic&topicid=1', array(), array('showmsg' => true, 'login' => 1));
	$live_type=1;	
}

//魅力等级
$charm_level_res=cGetCharmLevel($_G['uid'],2);
$live_charm_level_res=!empty($charm_level_res['level']) ? $charm_level_res['level'] : 0;

//取配置数据
$query = DB::query("SELECT * FROM ".DB::table('add_setting')." WHERE skey IN('liveplayer_ver','liveplayer_ver2', 'liveplayer_url', 'livedown_ver', 'livedown_url')");
while ($rs = DB::fetch($query)) {
	$addSetting[$rs['skey']] = $rs['svalue'];
}
if($_SERVER["REQUEST_METHOD"]=='POST'){
	//echo $_SERVER["REQUEST_URI"];
	header('Location: '.$_SERVER["REQUEST_URI"]);
	exit;
}

$usertype = 2;//主播
$roomType = 0;#0主播，1观众(js中用到)
//flash后面加上时间
$time = time();
include_once(template('show/show_pmy'));
?>