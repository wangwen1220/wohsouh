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

require_once libfile('function/live');

$roomid=trim($_G['gp_roomid']);

if($roomid)
{
		if ($_COOKIE['kicked'] and $_COOKIE['kicked']==$roomid){
	    	showmessage('您已经被踢出此房间，请休息片刻或者进入其他房间', 'show.php', array(), array('showmsg' => true, 'login' => 1));
	    }
	    
		if($roomid==$_G['uid'])
		{
			showmessage('正进入自己的直播', 'show.php?mod=pmy', array(), array('showmsg' => true, 'login' => 1));
		}
		
		//如果已经登录了该房间则不能再登录
		/*
		if (!empty($_G['uid'])) {
			$existed = DB::result_first("SELECT COUNT(*) FROM pre_live_userlist WHERE roomid=$roomid AND uid=".$_G['uid']);
			if ($existed) {
				showmessage('您已经在其它地方登录此房间!', 'show.php');
			}
		}
		*/	
		$sql = "SELECT uid FROM ".DB::table('common_member')." WHERE uid='$roomid' LIMIT 1";
		
		$member = DB::fetch_first($sql);
		
		
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
		$anchorInfo = DB::fetch_first("SELECT charm FROM ".DB::table('live_member_count')." WHERE uid=$uid");
		//$anchorInfo['huoshow'] = SIPHuoShowGetBalance($uid);
		//火秀币
		$anchorInfo['huoshow'] = HuoShowGetConsume($uid);
		//用户魅力，财富等级
        $chartmLevel =cGetCharmLevel($anchorInfo[charm]);
        $huoshowlevel =cGetHuoshowLevel($anchorInfo['huoshow']);
        $charl=$_G['setting']['level']['charm'];
        $huol=$_G['setting']['level']['huoshow'];
		//火秀币
		
		//$anchorInfo['huoshow'] = 0;
		
		//粉丝排行榜
		//$fansTop = cGetFansTop($uid, 10);
		
		//礼品类型
		//$giftType = cGetGiftType();
		//$typeNum = count($giftType);
		
		//礼品列表
		//$giftList = cGetGift();
		$live_uid=substr(sha1($uid),0,24);
//		$some_body_live_uid=substr(sha1($_G['uid']),0,24);
                if ( empty($_G['uid']) )
                    $some_body_live_uid = "";
                else
                    $some_body_live_uid=substr(sha1($_G['uid']),0,24);
       //礼物排名
       //$giftpai=cGetGiftpai($uid);
       //获取主播类型
      $live_type=GetTypee($uid);
      
} 
else 
{
	showmessage('错误没有此主播', 'show.php', array(), array('showmsg' => true, 'login' => 1));
}

$dos = array('index','psomebody');

$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'psomebody';

require_once libfile('show/'.$do, 'include');
?>
