<?php

/**
 *      本程序由靖飒开发
 *      若要二次开发或用于商业用途的，需要经过靖飒同意。
 *
 *      2011-04-18
 */

define('PDIR', 'plugin.php?id=ulove:ulove');
define('MDIR', 'source/plugin/ulove/images');
define('PTEM', './source/plugin/ulove/template');
define('PINC', './source/plugin/ulove/include');
define('PNAME', '暗恋要不要');

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//得到动作参数
$discuz_dotion = 220;


//------------获取网页传递的参数-------------------------------------------//

$tion				= trim(dhtmlspecialchars($_G['gp_tion']));
$uid				= intval($_G['gp_uid']);
$pid				= intval($_G['gp_pid']);

//------------获取系统全局变量-------------------------------------------//

$discuz_uid			= $_G['uid'];									//用户ID
$discuz_user		= $_G['username'];								//用户ID
$timestamp			= TIMESTAMP;									//时间
$timeoffset			= $_G['member']['timeoffset'];					//时间差
//------------获取插件的后台参数---------------------------------------------//

$getvar				= $_G['cache']['plugin']['ulove'];

$isusercredits		= $getvar['isusercredits'];					//用户发布视频使用的自定义积分字段是
$isprevent			= $getvar['isprevent'];						//会员是否可以使用防止暗恋自己的功能？
$preventboy			= $getvar['preventboy'];					//如果开启了防止暗恋功能，被暗恋时男同志显示什么提示？:
$preventgirl		= $getvar['preventgirl'];					//如果开启了防止暗恋功能，被暗恋时女同志显示什么提示？:
$ismysex			= $getvar['ismysex'];						//如果暗恋同性，提示什么
$selesex			= $getvar['selesex'];						//如果会员还没填写性别就暗恋别人，提示什么？
$ismyself			= $getvar['ismyself'];						//如果暗恋自己，提示什么？
$partysex			= $getvar['partysex'];						//如果被暗恋者还没选择性别，那么提示什么？
$nolovestr			= $getvar['nolovestr'];						//个人资料【出家】选项内选择出家的具体文字是？
$mynolove			= $getvar['mynolove'];						//自己已经出家，还要暗恋别人时，提示什么?
//2.0版新增功能
$isfield			= $getvar['isfield'];						//您要使用的自定义用户字栏目是？?
$isgay				= $getvar['isgay'];							//是否允许同性相恋?
$daysum				= $getvar['daysum'];						//每天最多可以暗恋几个人？?
$anthomaniac		= $getvar['anthomaniac'];					//超过当天暗恋对象的数量时提示什么？?



//------------参数、变量等获取完成---------------------------------------------//
//print_r($_G);			//打印参数备用功能


//------------获取跟钞票有关的东东---------------------------------------------//

if($isusercredits){
	$vcuser = 'extcredits'.$isusercredits;
	$vcname = $_G['setting']['extcredits'][$isusercredits]['title'];
	$vcunit = $_G['setting']['extcredits'][$isusercredits]['unit'];
	$vcsize = $_G['member'][$vcuser];
}

//------------判断权限---------------------------------------------//


if($tion == 'sendlove'){	//■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■发布视频段代码■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
	$uloves = 0;
	if(!$uid || !$pid){
		$msg = "非法提交的连接，可能是通过不正确的途径连接到本页的，请以正常的方式重试！<br><br><br>";
	}elseif(!$discuz_uid){
		$msg = '未登录用户不能使用暗恋功能，因为您还没有本国度的身体证呢，请现在通过以下方式继续操作：<br><br>--- [<a href="member.php?mod=logging&action=login" class="xi1">登录论坛</a>] --- [<a href="member.php?mod=register" class="xi1">免费注册</a>] --- ';
	}elseif($uid == $discuz_uid){
		$msg = $ismyself;
	}
	
	if(!$msg){
		$query = DB::query("SELECT gender, $isfield FROM ".DB::table('common_member_profile')." WHERE uid='$discuz_uid'");
		$mypro = DB::fetch($query);
		if(!$mypro['gender']){
			$msg = $selesex;//我还没性别
		}elseif($mypro[$isfield] == $nolovestr){
			$msg = $mynolove;//自己出家了
		}
	}

	if(!$msg){
		//提取用户的性别资料
		$query = DB::query("SELECT m.username, p.gender, p.$isfield FROM ".DB::table('common_member')." m LEFT JOIN ".DB::table('common_member_profile')." p USING(uid) WHERE m.uid='$uid'");
		$userdate = DB::fetch($query);
		if(!$userdate['gender']){
			$msg = $partysex;//对方没性别
		}elseif($mypro['gender'] == $userdate['gender']){
			if(!$isgay){
				$msg = $ismysex;//同性恋
			}
		}elseif($userdate[$isfield] == $nolovestr && $userdate['gender'] == 1){//出家的男人
			$msg = $preventboy;
		}elseif($userdate[$isfield] == $nolovestr && $userdate['gender'] == 2){//出家的女人
			$msg = $preventgirl;
		}
	}

	if(!$msg){
		//查看是否有这条记录
		$query = DB::query("SELECT id FROM hsk_ulove WHERE sendid='$discuz_uid' and toid='$uid'");
		if($mypro = DB::fetch($query)){
			//不能重复发送
			$msg = '已经发送过暗恋TA的信号了，请耐心地等待好消息吧！<br><br><br>';
			$uloves = 2;

		}
	}

	//2.0新增功能【还得查查是否超过每天暗恋的限量】
	if($daysum && !$msg){
		$today_y = gmdate("Y", $timestamp + 3600 * $timeoffset);
		$today_m = gmdate("m", $timestamp + 3600 * $timeoffset);
		$today_d = gmdate("d", $timestamp + 3600 * $timeoffset);
		$todayz = mktime(0, 0, 0, $today_m, $today_d, $today_y);

		$query = DB::query("SELECT COUNT(*) FROM hsk_ulove WHERE sendid='$discuz_uid' and dateline>=$todayz");
		$todaymax = DB::result($query, 0);
		if($todaymax >= $daysum){
			//超过限量了！
			$msg = $anthomaniac;
		}
	}

	if(!$msg){

		//添加记录
		DB::query("INSERT INTO hsk_ulove (sendid, toid, dateline) 
					VALUES ($discuz_uid, '$uid', '$timestamp')");

		if($isusercredits){
			DB::query("UPDATE ".DB::table('common_member_count')." SET $vcuser=$vcuser+1 WHERE uid='$uid'");
		}

		//再检查一下TA是否有暗恋你
		$query = DB::query("SELECT id FROM hsk_ulove WHERE sendid='$uid' and toid='$discuz_uid'");
		if($mypro = DB::fetch($query)){
			//相互暗恋
			$uloves = 1;
		}

		//发送一条短信息给双方
		if($uloves == 1){
			//相互暗恋的双方都发送信息
			notification_add($discuz_uid, 'system', 'system_notice', array('subject' => $userdate['username'].'和你正相互暗恋着~~~！', 'message' => '你好，怀着无比激动的心情告诉你一件令你万分激动的事情：<br><br>你苦苦暗恋的对象 <a href="home.php?mod=space&uid='.$uid.'" class="xi2">'.$userdate['username'].'</a> ，TA也在暗恋着你！还不赶快和TA打个招呼吧？！<br>不要忘记到论坛发个小贴庆祝一下，让大家都为你们开心一下哦！'), 1)	;
			notification_add($uid, 'system', 'system_notice', array('subject' => $discuz_user.'和你正相互暗恋着~~~！', 'message' => '你好，怀着无比激动的心情告诉你一件令你万分激动的事情：<br><br>你苦苦暗恋的对象 <a href="home.php?mod=space&uid='.$discuz_uid.'" class="xi2">'.$discuz_user.'</a>，TA也在暗恋着你！还不赶快和TA打个招呼吧？！<br>不要忘记到论坛发个小贴庆祝一下，让大家都为你们开心一下哦！'), 1)	;
		}else{
			//只发送给对方
			notification_add($uid, 'system', 'system_notice', array('subject' => '【暗恋通知】：有人正在暗恋你哦~~！', 'message' => '你好，怀着无比激动的心情告诉你一件令您万分激动的事情：<br><br>就在刚刚，有人通过无线传情表达了TA对你的爱慕————没错，有人暗恋你了！<br>遗憾的是我们也不知道TA是谁，只有在你也点击了暗恋TA之后，才会知道哦！'), 1)	;
			$uloves = 2;
		}
		$msg = '成功啦，羞答答的暗恋请你静悄悄的等哟！<br><br><br>';
	}

	showmessage($msg);

	//include template("ulove_sendlove", 'Kannol', PTEM);

}elseif($tion == "setting"){

	if(!$discuz_uid){
		showmessage('not_loggedin', NULL, array(), array('login' => 1));
	}

	$navname = $navtitle ="编辑我的资料";

	if(!submitcheck('reportsubmit')) {
		$query = DB::query("SELECT gender, $isfield FROM ".DB::table('common_member_profile')." WHERE uid='$discuz_uid'");
		$mypro = DB::fetch($query);

		$gender[$mypro['gender']] = 'selected';
		if($mypro[$isfield] == $nolovestr){
			$myfield[1] = 'selected';
		}


		//print_r($gender);

		include template("ulove_setting", 'Kannol', PTEM);
	}else{
		$gender = intval($_G['gp_gender']);
		$gpfield = 'gp_'.$isfield;
		$myfields = trim(dhtmlspecialchars($_G[$gpfield]));

		DB::query("UPDATE ".DB::table('common_member_profile')." SET $isfield='$myfields', gender='$gender' WHERE uid='$discuz_uid'");
		
		if($myfields == $nolovestr){
			//如果出家，就删除他的暗恋对象！
			DB::query("DELETE FROM hsk_ulove where sendid='$discuz_uid'");
		}

		showmessage("已经成功的设置了自己的信息，现在准备转入下一页面。", PDIR."&tion=setting");
	}
		

}else{//■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■我的视频列表段代码■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

	$navname = $navtitle ="暗恋要不要使用介绍";
	include template("ulove_index", 'Kannol', PTEM);

}
?>