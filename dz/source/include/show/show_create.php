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
define(DX_URL, 'http://192.168.2.93/');
require_once libfile('function/space');

$live_admin=index_is_admin($_G['uid']) ? 1 : 0;
//echo $live_admin;exit;
//if($live_admin)
//{
//	showmessage('管理员不能进入', 'show.php', array(), array('showmsg' => true, 'login' => 1));
//}

//直播预告
//$index_live_notice_res=index_live_notice_res($_G['uid']);
space_merge($space, 'field_home');
space_merge($space, 'profile');
//$charm=get_charm($_G['uid']);

//创建房间
$roomid = cCreateRoom($_G['uid']);
//加入房间
if ($roomid) {
	cInRoom($_G['uid'], $roomid, 1);
}
//得到主播魅力值和消费值
$anchorInfo = DB::fetch_first("SELECT charm FROM ".DB::table('live_member_count')." WHERE uid=".$_G['uid']);

//火秀币暂为0
//$anchorInfo['huoshow'] = SIPHuoShowGetBalance($_G['uid']);
$anchorInfo['huoshow'] = 0;
//粉丝排行榜
$fansTop = cGetFansTop($_G['uid'], 10);
//礼品类型
$giftType = cGetGiftType();
$typeNum = count($giftType);

//礼品列表
$giftList = cGetGift();

//参加的赛事
//$index_rank_res=index_participate_rank($_G['uid']);
//是否明星会员
$live_user_value_res=index_live_user_value($_G['uid']);
//魅力等级
$charm_level_res=cGetCharmLevel($_G['uid'],2);
$live_charm_level_res=!empty($charm_level_res['level']) ? $charm_level_res['level'] : 0;


include_once(template('show/show_create'));

?>