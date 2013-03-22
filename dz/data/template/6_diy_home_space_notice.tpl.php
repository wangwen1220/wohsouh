<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_notice');
0
|| checktplrefresh('./template/huoshow/home/space_notice.htm', './template/huoshow/home/spacecp_poke_type.htm', 1331876528, 'diy', './data/template/6_diy_home_space_notice.tpl.php', './template/huoshow', 'home/space_notice')
|| checktplrefresh('./template/huoshow/home/space_notice.htm', './template/huoshow/common/userabout.htm', 1331876528, 'diy', './data/template/6_diy_home_space_notice.tpl.php', './template/huoshow', 'home/space_notice')
;?>
<?php $_G['home_tpl_titles'] = array('提醒'); include template('common/header'); ?><div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em>
<a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;do=notice">消息</a>
</div>
</div>

<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><img alt="pm" src="<?=STATICURL?>image/feed/nts.gif" class="vm" /> 提醒</h1>
<ul class="tb cl">
<li><a href="home.php?mod=space&amp;do=pm">短消息</a></li>
<li<?=$actives['notice']?>><a href="home.php?mod=space&amp;do=notice">提醒</a></li>
<? if($_G['setting']['my_app_status']) { ?>
<li<?=$actives['userapp']?>><a href="home.php?mod=space&amp;do=notice&amp;view=userapp">应用消息</a></li>
<? } ?>
<li class="o"><a href="home.php?mod=spacecp&amp;ac=pm">发送消息</a></li>
</ul>

<? if($view=='userapp') { ?>

<script type="text/javascript">
function manyou_add_userapp(hash, url) {
if(isUndefined(url)) {
$(hash).innerHTML = "<tr><td colspan=\"2\">成功忽略了该条应用消息</td></tr>";
} else {
$(hash).innerHTML = "<tr><td colspan=\"2\">正在引导你进入...</td></tr>";
}
var x = new Ajax();
x.get('home.php?mod=misc&ac=ajax&op=deluserapp&hash='+hash, function(s){
if(!isUndefined(url)) {
location.href = url;
}
});
}
</script>

<div class="ct_vw cl">
<div class="ct_vw_sd">
<ul class="mtw">
<? if($list) { ?><li><a href="home.php?mod=space&amp;do=notice&amp;view=userapp">全部应用消息</a></li><? } if(is_array($apparr)) foreach($apparr as $type => $val) { ?><li class="mtn">
<a href="home.php?mod=userapp&amp;id=<?=$val['0']['appid']?>&amp;uid=<?=$space['uid']?>" title="<?=$val['0']['typename']?>"><img src="http://appicon.manyou.com/icons/<?=$val['0']['appid']?>" alt="<?=$val['0']['typename']?>" class="vm" /></a>
<a href="home.php?mod=space&amp;do=notice&amp;view=userapp&amp;type=<?=$val['0']['appid']?>"> <?php echo count($val); ?> 个 <?=$val['0']['typename']?> <? if($val['0']['type']) { ?>请求<? } else { ?>邀请<? } ?></a>
</li>
<? } ?>
</ul>
</div>
<div class="ct_vw_mn">
<? if($list) { if(is_array($list)) foreach($list as $key => $invite) { ?><h4 class="mtw mbm">
<a href="home.php?mod=space&amp;do=notice&amp;view=userapp&amp;op=del&amp;appid=<?=$invite['0']['appid']?>" class="y xg1">忽略该应用的所有邀请</a>
<a href="home.php?mod=userapp&amp;id=<?=$invite['0']['appid']?>&amp;uid=<?=$space['uid']?>" title="<?=$apparr[$invite['0']['appid']]?>"><img src="http://appicon.manyou.com/icons/<?=$invite['0']['appid']?>" alt="<?=$apparr[$invite['0']['appid']]?>" class="vm" /></a> 
你有 <?php echo count($invite); ?> 个 <?=$invite['0']['typename']?> <? if($invite['0']['type']) { ?>请求<? } else { ?>邀请<? } ?>
</h4>
<div class="xld xlda"><? if(is_array($invite)) foreach($invite as $value) { ?><dl class="bbda cl">
<dd class="m avt mbn">
<a href="home.php?mod=space&amp;uid=<?=$value['fromuid']?>"><?php echo avatar($value[fromuid],small); ?></a>
</dd>
<dt id="<?=$value['hash']?>">
<div class="xw0 xi3"><?=$value['myml']?></div>
</dt>
</dl>
<? } ?>
</div>
<? } if($multi) { ?><div class="pgs cl"><?=$multi?></div><? } } else { ?>
<div class="emp">没有新的应用请求或邀请</div>
<? } ?>
</div>
</div>

<? } else { ?>

<div class="tbmu" style="display:none;">
<a href="home.php?mod=space&amp;do=notice" <? if(empty($type)) { ?>class="a"<? } ?>>全部通知</a><? if(is_array($noticetypes)) foreach($noticetypes as $key => $name) { ?><span class="pipe">|</span><a href="home.php?mod=space&amp;do=notice&amp;type=<?=$key?>" <? if($key==$type) { ?>class="a"<? } ?>><?=$name?></a>
<? } ?>
</div>
<div class="tbms mtm mbm">
<a href="home.php?mod=spacecp&amp;ac=privacy&amp;op=filter" target="_blank" class="y xi2">动态筛选</a>
提示：当你感觉有些通知对你造成骚扰时，请点击通知右侧的屏蔽小图标，可屏蔽此类通知。
</div>

<? if($newprompt) { ?>
<div class="xld xlda">
<script type="text/javascript">
var promptNum = {pendingfriends:<?=$space['pendingfriends']?>,pokes:<?=$space['pokes']?>};
function getNewFriendQuery(uid) {
promptNum.pendingfriends--;
if(promptNum.pendingfriends >= 1) {
$('pendingfriend_'+uid).parentNode.style.display = 'none';
$("pendingFriendsNum").innerHTML = promptNum.pendingfriends;
if(promptNum.pendingfriends > 1) {
var newPObj = document.createElement("dl");
var x = new Ajax();
x.get('home.php?mod=spacecp&ac=friend&op=getonequery&inajax=1', function(s){
newPObj.innerHTML = s;
});
$('pendingFriendsBody').appendChild(newPObj);

}
} else {
$("pendingFriendsList").style.display = 'none';
}
}

function getNewPokeQuery(uid) {
promptNum.pokes--;
if(promptNum.pokes >= 1) {
$('pokeQuery_'+uid).parentNode.style.display = 'none';
$("pokesNum").innerHTML = promptNum.pokes;
if(promptNum.pokes > 1) {
var newPObj = document.createElement("dl");
var x = new Ajax();
x.get('home.php?mod=spacecp&ac=poke&op=getpoke&inajax=1', function(s){
newPObj.innerHTML = s;
});
$('pokesBody').appendChild(newPObj);
}
} else {
$("pokesList").style.display = 'none';
}
}
function errorhandle_pokeignore(msg, values) {
getNewPokeQuery(values['uid']);
}
</script>
<? if($pendingfriends) { ?>
<div id="pendingFriendsList" class="bbs pbm">
<div class="pbm ptm cl">
<h2><img src="<?=STATICURL?>image/feed/friend.gif" alt="friend" class="vm" /> <strong class="xi1" id="pendingFriendsNum"><?=$space['pendingfriends']?></strong> 个好友请求</h2>
</div>
<div id="pendingFriendsBody" class="nts"><? if(is_array($pendingfriends)) foreach($pendingfriends as $value) { ?><dl class="cl">
<dd class="m avt"><a href="home.php?mod=space&amp;uid=<?=$value['fuid']?>" c="1"><?php echo avatar($value[fuid],middle); ?></a></dd>
<dt id="pendingfriend_<?=$value['fuid']?>">
<p class="mbm">
<a href="home.php?mod=space&amp;uid=<?=$value['fuid']?>" class="xi2"><?=$value['fusername']?></a>:
<span class="xw0">
请求加您为好友<? if($value['note']) { ?>,&nbsp;理由:<?=$value['note']?><? } ?>
&nbsp; <span class="xg1"><?php echo dgmdate($value[dateline], 'n-j H:i'); ?></span>
</span>
</p>
<div class="pbn ptm xi2 xw0 cl">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$value['fuid']?>&amp;from=notice" id="afr_<?=$value['fuid']?>" class="xw1" onclick="showWindow(this.id, this.href, 'get', 0);">批准申请</a><span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?=$value['fuid']?>&amp;confirm=1&amp;from=notice" id="afi_<?=$value['fuid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">忽略</a>
</div>
</dt>
</dl>
<? } ?>
</div>
<div class="nts"><div class="more"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=request" target="_blank" class="xi2">查看更多...</a></div></div>

</div>
<? } if($pokes) { ?><?php $icons = array(
0 => '不用动作',
1 => '<img alt="cyx" src="'.STATICURL.'image/poke/cyx.gif" class="vm" /> 踩一下',
2 => '<img alt="wgs" src="'.STATICURL.'image/poke/wgs.gif" class="vm" /> 握个手',
3 => '<img alt="wx" src="'.STATICURL.'image/poke/wx.gif" class="vm" /> 微笑',
4 => '<img alt="jy" src="'.STATICURL.'image/poke/jy.gif" class="vm" /> 加油',
5 => '<img alt="pmy" src="'.STATICURL.'image/poke/pmy.gif" class="vm" /> 抛媚眼',
6 => '<img alt="yb" src="'.STATICURL.'image/poke/yb.gif" class="vm" /> 拥抱',
7 => '<img alt="fw" src="'.STATICURL.'image/poke/fw.gif" class="vm" /> 飞吻',
8 => '<img alt="nyy" src="'.STATICURL.'image/poke/nyy.gif" class="vm" /> 挠痒痒',
9 => '<img alt="gyq" src="'.STATICURL.'image/poke/gyq.gif" class="vm" /> 给一拳',
10 => '<img alt="dyx" src="'.STATICURL.'image/poke/dyx.gif" class="vm" /> 电一下',
11 => '<img alt="yw" src="'.STATICURL.'image/poke/yw.gif" class="vm" /> 依偎',
12 => '<img alt="ppjb" src="'.STATICURL.'image/poke/ppjb.gif" class="vm" /> 拍拍肩膀',
13 => '<img alt="yyk" src="'.STATICURL.'image/poke/yyk.gif" class="vm" /> 咬一口'
); ?><div id="pokesList" class="bbs pbm">
<div class="pbm ptm cl">
<h2><img src="<?=STATICURL?>image/feed/poke.gif" alt="poke" class="vm" /> <strong class="xi1" id="pokesNum"><?=$space['pokes']?></strong> 个新招呼</h2>
</div>
<div id="pokesBody" class="nts"><? if(is_array($pokes)) foreach($pokes as $value) { ?><dl class="cl">
<dd class="m avt"><a href="home.php?mod=space&amp;uid=<?=$value['fromuid']?>" c="1"><?php echo avatar($value[fromuid],small); ?></a></dd>
<dt id="pokeQuery_<?=$value['fromuid']?>">
<p class="mbm">
<a href="home.php?mod=space&amp;uid=<?=$value['fromuid']?>" class="xi2"><?=$value['fromusername']?></a>:
<span class="xw0">
<? if($value['iconid']) { ?><?=$icons[$value['iconid']]?><? } else { ?>打个招呼<? } if($value['note']) { ?>, 说: <?=$value['note']?><? } ?>
&nbsp; <span class="xg1"><?php echo dgmdate($value[dateline], 'n-j H:i'); ?></span>
</span>
</p>
<div class="pbn ptm xi2 xw0 cl">
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=reply&amp;uid=<?=$value['fromuid']?>&amp;from=notice" id="a_p_r_<?=$value['fromuid']?>" class="xw1" onclick="showWindow(this.id, this.href, 'get', 0);">回打招呼</a><span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=ignore&amp;uid=<?=$value['fromuid']?>&amp;from=notice" id="a_p_i_<?=$value['fromuid']?>" onclick="showWindow('pokeignore', this.href, 'get', 0);">忽略</a>
</div>
</dt>
</dl>
<? } ?>
</div>
<div class="nts"><div class="more"><a href="home.php?mod=spacecp&amp;ac=poke" target="_blank" class="xi2">查看更多...</a></div></div>
</div>
<? } if($space['myinvitations']) { ?>
<div id="myInviteList" class="bbs pbm">
<div class="pbm ptm cl">
<h2><img src="<?=STATICURL?>image/feed/userapp.gif" alt="userapp" class="vm" /> <strong class="xi1" id="myInviteNum"><?=$space['myinvitations']?></strong> 个应用消息</h2>
</div>
<div class="nts">
<dl class="cl">
<dd class="m avt mbn"><img src="<?=IMGDIR?>/systempm.gif" alt="systempm" /></dd>
<dt class="ntc_body" id="myInviteBody">
<p class="mbm"><a href="home.php?mod=space&amp;do=notice&amp;view=userapp" target="_blank" class="xi2">进入应用消息页面进行相关操作</a></p>
<div class="pbn ptm xi2 xw0 cl">&nbsp;</div>
</dt>
</dl>
</div>
</div>
<? } ?>

</div>
<? } if($list) { ?>
<div class="xld xlda bbs">
<div class="pbm ptm cl">
<h2><img src="<?=STATICURL?>image/feed/notice.gif" alt="notice" class="vm" /> <strong class="xi1"><?=$newnotice?></strong> 条新通知 , 共<strong class="xi1"><?=$count?></strong>条通知</h2>
</div>
<div class="nts"><? if(is_array($list)) foreach($list as $key => $value) { ?><dl class="cl">
<dd class="m avt mbn">
<? if($value['authorid']) { ?>
<a href="home.php?mod=space&amp;uid=<?=$value['authorid']?>"><?php echo avatar($value[authorid],small); ?></a>
<? } else { ?>
<img src="<?=IMGDIR?>/systempm.gif" alt="systempm" />
<? } ?>
</dd>
<dt>
<a class="d b" href="home.php?mod=spacecp&amp;ac=common&amp;op=ignore&amp;authorid=<?=$value['authorid']?>&amp;type=<?=$value['type']?>&amp;handlekey=addfriendhk_<?=$value['authorid']?>" id="a_note_<?=$value['id']?>" onclick="showWindow(this.id, this.href, 'get', 0);" title="屏蔽">屏蔽</a>
<span class="xg1 xw0"><?php echo dgmdate($value[dateline], 'u'); ?></span>
</dt>
<dd class="ntc_body" style="<?=$value['style']?>">
<?=$value['note']?>
</dd>

<? if($value['from_num']) { ?>
<dd class="xg1 xw0">还有 <?=$value['from_num']?> 个相同通知被忽略</dd>
<? } if($value['authorid'] && !$value['isfriend']) { ?>
<dd class="mtw xi2">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$value['authorid']?>&amp;handlekey=addfriendhk_<?=$value['authorid']?>" id="add_note_friend_<?=$value['authorid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">加为好友</a>
<span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=<?=$value['authorid']?>" id="a_poke_<?=$value['authorid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">打个招呼</a>
</dd>
<? } ?>
</dl>
<? } ?>
</div>
</div>

<? if($view!='userapp' && $space['notifications']) { ?>
<div class="mtm mbm"><a href="home.php?mod=space&amp;do=notice&amp;ignore=all">还有 <?=$value['from_num']?> 个相同通知被忽略 <em>&rsaquo;</em></a></div>
<? } if($multi) { ?><div class="pgs cl"><?=$multi?></div><? } } } ?>
</div>
</div>
<div class="appl"><?php if(!empty($_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE]; ?><?php getuserapp(1); ?><ul><? if(is_array($_G['setting']['spacenavs'])) foreach($_G['setting']['spacenavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { if(in_array($nav['code'], array('userpanelarea1', 'userpanelarea2'))) { if(!empty($_G['my_panelapp']) && $_G['setting']['my_app_status']) { if($nav['code']=='userpanelarea1' && !empty($_G['my_panelapp']['1'])) { if(is_array($_G['my_panelapp']['1'])) foreach($_G['my_panelapp']['1'] as $appid => $app) { ?><li>
<a href="userapp.php?mod=app&amp;id=<?=$app['appid']?>" title="<?=$app['appname']?>"><img <? if($app['icon']) { ?>src="<?=$app['icon']?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?=$app['appid']?>'"<? } else { ?> src="http://appicon.manyou.com/icons/<?=$app['appid']?>"<? } ?> name="<?=$appid?>" alt="<?=$app['appname']?>" /><?=$app['appname']?></a>
</li>
<? } } elseif($nav['code']=='userpanelarea2' && !empty($_G['my_panelapp']['2'])) { if(is_array($_G['my_panelapp']['2'])) foreach($_G['my_panelapp']['2'] as $appid => $app) { ?><li>
<a href="userapp.php?mod=app&amp;id=<?=$app['appid']?>" title="<?=$app['appname']?>"><img <? if($app['icon']) { ?>src="<?=$app['icon']?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?=$app['appid']?>'"<? } else { ?> src="http://appicon.manyou.com/icons/<?=$app['appid']?>"<? } ?> name="<?=$appid?>" alt="<?=$app['appname']?>" /><?=$app['appname']?></a>
</li>
<? } } } } else { ?>
<?=$nav['code']?>
<? } } } ?>
</ul>
<? if($_G['setting']['my_app_status']) { if(!empty($_G['cache']['userapp'])) { ?>
<ul id="my_defaultapp"><? if(is_array($_G['cache']['userapp'])) foreach($_G['cache']['userapp'] as $value) { ?><li><a href="userapp.php?mod=app&amp;id=<?=$value['appid']?>"><img <? if($value['icon']) { ?>src="<?=$value['icon']?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?=$value['appid']?>'"<? } else { ?> src="http://appicon.manyou.com/icons/<?=$value['appid']?>"<? } ?> alt="<?=$value['appname']?>" /><?=$value['appname']?></a></li>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['userapp_menu_top'])) echo $_G['setting']['pluginhooks']['userapp_menu_top']; ?>
</ul>
<? } if($_G['my_menu']) { ?>
<ul id="my_userapp"><? if(is_array($_G['my_menu'])) foreach($_G['my_menu'] as $value) { ?><li id="userapp_li_<?=$value['appid']?>"><a href="userapp.php?mod=app&amp;id=<?=$value['appid']?>" title="<?=$value['appname']?>"><img <? if($value['icon']) { ?>src="<?=$value['icon']?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?=$value['appid']?>'"<? } else { ?> src="http://appicon.manyou.com/icons/<?=$value['appid']?>"<? } ?> alt="<?=$value['appname']?>" /><?=$value['appname']?></a></li>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['userapp_menu_middle'])) echo $_G['setting']['pluginhooks']['userapp_menu_middle']; ?>
</ul>
<? } if($_G['my_menu_more']) { ?>
<p class="pbm bbda xg1 cl"><a href="javascript:;" class="unfold" id="a_app_more" onclick="userapp_open();">展开</a></p>
<? } if(checkperm('allowmyop')) { ?>
<ul class="myo mtm">
<li><a href="userapp.php?mod=manage&amp;my_suffix=%2Fapp%2Flist"><img src="<?=IMGDIR?>/app_add.gif" alt="app_add" />添加<?=$_G['setting']['navs']['5']['navname']?></a></li>
<li><a href="userapp.php?mod=manage&amp;ac=menu"><img src="<?=IMGDIR?>/app_set.gif" alt="app_set" />管理<?=$_G['setting']['navs']['5']['navname']?></a></li>
</ul>
<? } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE]; ?>
<script type="text/javascript">inituserabout();</script><div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>

</div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div><? include template('common/footer'); ?>