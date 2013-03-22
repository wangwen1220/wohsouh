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

/*if(empty($_COOKIE[SIP_COOKIES_NAME]))
{
	showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
}*/
$username=trim($_G['gp_username']);

//$username=mb_convert_encoding($username, "UTF-8", "GB2312");
if($username)
{
		if($username==$_G['username'])
		{
			showmessage('正进入自己的直播', 'show.php?mod=my', array(), array('showmsg' => true, 'login' => 1));
		}
		
		$member = DB::fetch_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$username' LIMIT 1");
	    $uid = $member['uid'];
		if ($_COOKIE['kicked']==$member['uid']){
	    	showmessage('您已经被踢出此房间，请休息片刻或者进入其他房间', 'show.php', array(), array('showmsg' => true, 'login' => 1));
	    }
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
		
		//主播信息
		$anchorInfo = DB::fetch_first("SELECT * FROM ".DB::table('live_member_count')." WHERE uid=$uid");
		//$anchorInfo['huoshow'] = SIPHuoShowGetBalance($uid);
		//火秀币
		$anchorInfo['huoshow'] = 0;
		
		//粉丝排行榜
		$fansTop = cGetFansTop($uid, 10);
		
		//礼品类型
		$giftType = cGetGiftType();
		$typeNum = count($giftType);
		
		//礼品列表
		$giftList = cGetGift();
		 //获取主播类型
      $live_type=GetTypee($uid);
		$live_uid=substr(sha1($uid),0,24);
		if ( empty($_G['uid']) )
	    	    $some_body_live_uid = "";
		else
                    $some_body_live_uid=substr(sha1($_G['uid']),0,24);
} 
else 
{
	showmessage('错误没有此主播', 'show.php', array(), array('showmsg' => true, 'login' => 1));
}
//echo $some_body_live_uid;
$dos = array('index','somebody');

$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'somebody';

require_once libfile('show/'.$do, 'include');

?>
