<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home.php 16805 2010-09-15 03:56:11Z zhangguosheng $
 */

header("Content-Type: text/xml; charset=UTF-8");
require_once './source/class/class_core.php';
require_once './source/function/function_home.php';

$discuz = & discuz_core::instance();

$discuz->init();


runhooks();
$res=array();
$user_money=array();
//$uid=$_GET['uid'];

if($_G['uid'])
{
	/*if($uid!=$_G['uid'])
	{
		$res=array();
	}
	else 
	{
	*/
		//提醒
		$notice=$_G['member']['newprompt'] ? $_G['member']['newprompt'] :0;
		//消息
		$newpm=$_G['member']['newpm'] ? $_G['member']['newpm'] :0;
		//网站管理权限门户
		if ($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || $_G['group']['allowauthorizedblock'] || $_G['group']['allowauthorizedarticle'])
		{
			$portalcp=1;
		}
	    else 
	    {
	    	$portalcp=0;
	    }
	    //论坛管理权限
	    if($_G['group']['radminid'] > 1)
	    {
	    	$forum=array('fid'=>$_G['fid'],'name'=>"{$_G['setting']['navs'][2]['navname']}管理");
	    }
	    else 
	    {
	    	$forum=array();
	    }
	    //网站管理权限管理中心
	   if($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])
	   {
	   	   $admin=1;
	   }
	   else 
	   {
	   	   $admin=0;
	   }
	   //积分
	   
	   $credits=$_G['member']['credits'] ? $_G['member']['credits'] : 0 ;
	   //
	   $user_money[]=array(
        "title" =>"积分" ,
        "value"=>$credits,
        "unit"=>"",
        "img"=>"",
        );
       //威望金钱贡献相关
       if(!empty($_G['setting']['extcredits']))
       {
       	  foreach ( $_G['setting']['extcredits'] as $k=>$v)
       	  {
       	  	if (empty($v['hiddeninheader']))
       	  	{
       	  		$user_money[]=array(
       	  		"title" =>$v['title'],
       	  		"value"=>getuserprofile('extcredits'.$k),
       	  		"unit"=>$v['unit'],
       	  		"img"=>$v['img'],
       	  		);
       	  	}
       	  }
       }
	   if ($_G['member']['nickname']) {
	       $username= $_G['member']['nickname'].'('.$_G['uid'].')';	
	   }else {
	       $username= $_G['username'].'('.$_G['uid'].')';	
	   }
	   //用户组
	   $usergroup=$_G['group']['grouptitle'] ? $_G['group']['grouptitle'] : "";
	   $user_money[]=array(
        "title" =>"用户组" ,
        "value"=>$usergroup,
        "unit"=>"",
        "img"=>"",
        );
        $res=array(
        'notice'=>$notice,
        'newpm'=>$newpm,
        'portalcp'=>$portalcp,
        'forum'=>$forum,
        'admin'=>$admin,
        'money'=>$user_money,
        'formhash'=>FORMHASH,
        'huoshowbi'=>SIPHuoShowGetBalance($_G['uid']),
        'huobi'=>SIPHuoCoinGetBalance($_G['uid']),
        'uid'=>$_G['uid'],
        'username'=>$username
        );
	//}
}
else 
{
	$res=array();
}
//print  json_encode($res);
echo $_GET['jsoncallback'], '(', json_encode($res), ')'; 
exit;

