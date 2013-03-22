<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_friend');
0
|| checktplrefresh('./template/huoshow/home/space_friend.htm', './template/huoshow/common/userabout.htm', 1331868577, 'diy', './data/template/6_diy_home_space_friend.tpl.php', './template/huoshow', 'home/space_friend')
|| checktplrefresh('./template/huoshow/home/space_friend.htm', './template/huoshow/home/space_userabout.htm', 1331868577, 'diy', './data/template/6_diy_home_space_friend.tpl.php', './template/huoshow', 'home/space_friend')
;?>
<? if(empty($diymode)) { include template('common/header'); ?><div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em>
<a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em>
<a href="home.php?mod=space&amp;do=friend">好友</a>
</div>
</div>
<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<div class="bm bw0">
<? if($space['self']) { ?>
<h1 class="mt"><img alt="friend" src="<?=STATICURL?>image/feed/friend.gif" class="vm" /> 好友</h1>
<ul class="tb cl">
<li<?=$actives['me']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend">好友列表</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=search">查找好友</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=find">可能认识的人</a></li>
<? if($_G['setting']['regstatus'] > 1) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=invite">邀请好友</a></li>
<? } ?>
<li><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=request">好友请求</a></li>
</ul>
<div class="tbmu">
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend"<?=$a_actives['me']?>>全部好友列表</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend&amp;view=online&amp;type=friend"<?=$a_actives['onlinefriend']?>>当前在线的好友</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend&amp;view=online&amp;type=member"<?=$a_actives['onlinemember']?>>在线成员</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend&amp;view=online&amp;type=near"<?=$a_actives['onlinenear']?>>就在我附近的朋友</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend&amp;view=visitor"<?=$a_actives['visitor']?>>我的访客</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend&amp;view=trace"<?=$a_actives['trace']?>>我的足迹</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend&amp;view=blacklist"<?=$a_actives['blacklist']?>>我的黑名单</a>
</div>
<? if($groups) { ?>
<div class="tbmu">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=group" class="y xg1">批量分组</a>
<a href="home.php?mod=space&amp;do=friend&amp;group=-1">全部好友</a><? if(is_array($groups)) foreach($groups as $key => $value) { ?> 	<span class="pipe">|</span><a href="home.php?mod=space&amp;do=friend&amp;group=<?=$key?>" id="friend_groupname_<?=$key?>" groupname="<?=$value?>" onmouseover="showMenu(this.id);"<?=$groupselect[$key]?>><? if(isset($space['privacy']['filter_gid'][$key])) { ?><span class="xg1">[屏蔽]</span><? } ?><?=$value?></a>
<div id="friend_groupname_<?=$key?>_menu" class="p_pop" style="display:none;">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=groupignore&amp;group=<?=$key?>&amp;handlekey=ignorehk_<?=$key?>" id="c_ignore_<?=$key?>" onclick="showWindow('ignoregroup', this.href, 'get', 0);" title="屏蔽用户组动态" class="c_delete"><? if(isset($space['privacy']['filter_gid'][$key])) { ?>取消<? } else { ?>屏蔽<? } ?></a>
<? if($key) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=groupname&amp;group=<?=$key?>&amp;handlekey=edithk_<?=$key?>" id="c_edit_<?=$key?>" onclick="showWindow(this.id, this.href, 'get', 0);" title="编辑用户组名" class="c_edit">编辑</a>
<? } ?>
</div>
<? } ?>
</div>
<script type="text/javascript">
function succeedhandle_ignoregroup(url, msg, values) {
var liObj = $('friend_groupname_'+values['group']);
var prefix = '';
if(values['ignore']) {
prefix = '<span class="xg1">[屏蔽]</span>';
}
$('c_ignore_'+values['group']).innerHTML = values['ignore'] ? '取消' : '屏蔽';
liObj.innerHTML = prefix + liObj.getAttribute('groupname');
}
</script>
<? } ?>
<div class="tbmu">
<? if($_GET['view']=='blacklist') { ?>
加入到黑名单的用户，将会从你的好友列表中删除。同时，对方将不能进行与你相关的打招呼、踩日志、加好友、评论、留言、短消息等互动行为。
<? } elseif($_GET['view']=='me') { ?>
当前共有 <?=$count?> 个好友。
<? if($maxfriendnum) { ?>
(最多可以添加 <?=$maxfriendnum?> 个好友)
<p>
<? if($_G['setting']['magicstatus'] && $_G['setting']['magics']['friendnum']) { ?>
<img src="<?=STATICURL?>image/magic/friendnum.small.gif" alt="friendnum" class="vm" />
<a id="a_magic_friendnum" href="home.php?mod=magic&amp;mid=friendnum" onclick="showWindow('magics', this.href, 'get', 0);return false;">我要扩容好友数</a>
(你可以购买道具“<?=$_G['setting']['magics']['friendnum']?>”来扩容，让自己可以添加更多的好友。)
<? } ?>
</p>
<? } ?>
<p class="mtm">
好友列表按照好友热度高低排序<br />
						好友热度是系统根据你与好友之间交互的动作自动累计的一个参考值，数值越大，表示你与这位好友互动越频繁。
</p>
<? } elseif($_GET['view']=='online') { if($_GET['type'] == 'friend') { ?>
这些好友当前在线，赶快去拜访一下吧
<? } elseif($_GET['type']=='near') { ?>
通过系统匹配，这些朋友就在你附近，你可能认识他们
<? } else { ?>
显示当前全部在线的用户
<? } } elseif($_GET['view']=='visitor') { ?>
他们拜访过你，回访一下吧
<? } elseif($_GET['view']=='trace') { ?>
你曾经拜访过的用户列表
<? } ?>
</div>
<div class="tbmu bbs">
<? if($_GET['view']=='me') { ?>
<form method="get" autocomplete="off" action="home.php" class="pns">
<input type="hidden" name="mod" value="space" />
<input type="hidden" name="do" value="friend" />
<input type="hidden" name="searchmode" value="1" />
<input type="hidden" name="searchsubmit" value="1" />
<input type="text" name="searchkey" class="px vm" size="15" value="查找好友" onclick="if(this.value=='查找好友')this.value='';" />
<button type="submit" class="pn vm"><em>搜索</em></button>
</form>
<? } else { ?>
<form method="get" autocomplete="off" action="home.php" class="pns">
<input type="hidden" name="mod" value="spacecp" />
<input type="hidden" name="ac" value="friend" />
<input type="hidden" name="op" value="search" />
<input type="hidden" name="searchmode" value="1" />
<input type="hidden" name="searchsubmit" value="1" />
<input type="text" name="searchkey" class="px vm" size="15" value="找人" onclick="if(this.value=='找人')this.value='';" />
<button type="submit" class="pn vm"><em>搜索</em></button>
</form>
<? } ?>
</div>

<? if($_GET['view']=='blacklist') { ?>
<h2 class="mtw xs2">添加黑名单用户</h2>
<div class="bm bmn mtm cl">
<form method="post" autocomplete="off" name="blackform" action="home.php?mod=spacecp&amp;ac=friend&amp;op=blacklist&amp;start=<?=$_GET['start']?>">
<table cellpadding="0" cellspacing="0" class="tfm">
<tr>
<th>用户名</th>
<td>
<input type="text" name="username" value="" size="15" class="px vm" />
<button type="submit" name="blacklistsubmit_btn" id="moodsubmit_btn" value="true" class="pn vm"><em>添加</em></button>
</td>
</tr>
</table>
<input type="hidden" name="blacklistsubmit" value="true" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
</form>
</div>
<? } } } else { include template('home/space_header'); ?><div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm">
<div class="bm_h"><h1>好友</h1></div>
<div class="bm_c">
<? } if($space['self']) { if($list) { ?>
<div id="friend_ul">
<ul class="buddy cl"><? if(is_array($list)) foreach($list as $key => $value) { ?><li id="friend_<?=$value['uid']?>_li">
<? if($value['username'] == '') { ?>
<div class="avt"><img src="<?=STATICURL?>image/magic/hidden.gif" alt="匿名" /></div>
<h4>匿名</h4>
<? } else { ?>
<div class="avt"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" c="1"><?php echo avatar($value[uid],small); ?></a></div>
<h4>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>"<?php g_color($value[groupid]); ?>><?=$value['nickname']?></a>
<? if($space['self']) { ?><span id="friend_note_<?=$value['uid']?>" class="maxh note xw0" title="<?=$value['note']?>"><?=$value['note']?></span><? } if($ols[$value['uid']]) { ?><img src="<?=IMGDIR?>/ol.gif" alt="online" title="在线 <?php echo dgmdate($ols[$value[uid]], 'H:i'); ?>" class="vm" /> <? } ?><?php g_icon($value[groupid]); if($value['videostatus']) { ?>
<img src="<?=IMGDIR?>/videophoto.gif" alt="videophoto" class="vm" />
<? } ?>
</h4>
<? if($value['recentnote']) { ?><p class="maxh"><?=$value['recentnote']?></p><? } } if($_GET['view']=='blacklist') { ?>
<div class="xg1"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=blacklist&amp;subop=delete&amp;uid=<?=$value['uid']?>&amp;start=<?=$_GET['start']?>">黑名单除名</a></div>
<? } elseif($_GET['view']=='visitor' || $_GET['view'] == 'trace') { ?>
<div class="xg1"><?php echo dgmdate($value[dateline], 'n月j日'); ?></div>
<? } elseif($_GET['view']=='online') { ?>
<div class="xg1"><?php echo dgmdate($ols[$value[uid]], 'H:i'); ?></div>
<? } else { ?>
<div class="xg1">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=changenum&amp;uid=<?=$value['uid']?>&amp;handlekey=hotuserhk_<?=$value['uid']?>" id="friendnum_<?=$value['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">热度(<span id="spannum_<?=$value['uid']?>"><?=$value['num']?></span>)</a><span class="pipe">|</span>
<a href="javascript:;" id="interaction_<?=$value['uid']?>" onmouseover="showMenu(this.id);">互动</a><span class="pipe">|</span>
<? if(!$value['isfriend']) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$value['uid']?>&amp;handlekey=adduserhk_<?=$value['uid']?>" id="a_friend_<?=$key?>" onclick="showWindow(this.id, this.href, 'get', 0);">加为好友</a>
<? } else { ?>
<a href="javascript:;" id="opfrd_<?=$value['uid']?>" onmouseover="showMenu(this.id);" class="showmenu">管理</a>
<? } ?>
</div>
<? if($value['isfriend']) { ?>
<div id="opfrd_<?=$value['uid']?>_menu" class="p_pop" style="display: none; width: 80px;">
<p><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=<?=$value['uid']?>&amp;handlekey=editgrouphk_<?=$value['uid']?>" id="friend_group_<?=$value['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">好友分组</a></p>
<p><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=editnote&amp;uid=<?=$value['uid']?>&amp;handlekey=editnote_<?=$value['uid']?>" id="friend_editnote_<?=$value['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">备注</a></p>
<p><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?=$value['uid']?>&amp;handlekey=delfriendhk_<?=$value['uid']?>" id="a_ignore_<?=$key?>" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a></p>
</div>
<? } ?>
<div id="interaction_<?=$value['uid']?>_menu" class="p_pop" style="display: none; width: 80px;">
<p><a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=<?=$value['uid']?>" id="a_poke_<?=$key?>" onclick="showWindow(this.id, this.href, 'get', 0);" title="打个招呼">打个招呼</a></p>
<p><a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?=$value['uid']?>&amp;touid=<?=$value['uid']?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?=$key?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)">发送消息</a></p>
<?php if(!empty($_G['setting']['pluginhooks']['space_interaction_extra'])) echo $_G['setting']['pluginhooks']['space_interaction_extra']; ?>
</div>
<? } ?>
</li>
<? } ?>
</ul>
</div>
<? if($multi) { ?><div class="pgs cl mtm"><?=$multi?></div><? } } else { ?>
<div class="emp">没有相关用户列表。</div>
<? } } else { ?>
<p class="tbmu">当前共有 <?=$count?> 个好友。</p><? include template('home/space_list'); } if(empty($diymode)) { ?>
</div>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
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
<script type="text/javascript">inituserabout();</script><? if($space['self']) { if($_G['setting']['my_app_status']) { ?>
<script type="text/javascript">
function my_sync_tip(msg, close_time) {;
showDialog(msg, 'notice');
}
function my_sync_friend() {
my_sync_tip('正在同步好友信息...', 0);
var my_scri = document.createElement("script");
document.getElementsByTagName("head")[0].appendChild(my_scri);
my_scri.charset = "UTF-8";
var url = "http://uchome.manyou.com/user/syncFriends";
my_scri.src = url + "?sId=<?=$_G['setting']['my_siteid']?>&uUchId=<?=$space['uid']?>&ts=<?=$_G['timestamp']?>&key=<?php echo md5($_G['setting'][my_siteid] . $_G['setting'][my_sitekey] . $space[uid] . $_G[timestamp]); ?>";
}
</script>
<hr class="da" />
<div class="bn">
<h2>在游戏中找不到自己的好友？</h2>
<p>请点击下面的的按钮，将好友信息同步到里面。</p>
<p class="pns pnn mtm"><button type="button" onclick="my_sync_friend(); return false;" title="将好友关系同步至Manyou平台，以便在应用里看到他们" class="pn"><em>刷新好友信息</em></button></p>
</div>
<? } } ?>
<div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>
</div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>
<? } else { ?>
</div>
</div>
</div>
<div class="sd"><div id="pcd" class="bm cl">
<div class="hm">
<p><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"><?php echo avatar($space[uid],middle); ?></a></p>
<h2 class="xs2"><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"><?=$space['nickname']?></a></h2>
</div>
<ul class="xl xl2 cl ul_list">
<? if($space['self']) { ?>
<li class="ul_diy"><a href="home.php?mod=space&amp;diy=yes">装扮空间</a></li>
<li class="ul_msg"><a href="home.php?mod=space&amp;do=wall">查看留言</a></li>
<li class="ul_avt"><a href="home.php?mod=spacecp&amp;ac=avatar">编辑头像</a></li>
<li class="ul_profile"><a href="home.php?mod=spacecp&amp;ac=profile">更新资料</a></li>
<? } else { ?><?php require_once libfile('function/friend');$isfriend=friend_check($space[uid]); if(!$isfriend) { ?>
<li class="ul_add"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$space['uid']?>&amp;handlekey=addfriendhk_<?=$space['uid']?>" id="a_friend_li_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">加为好友</a></li>
<? } else { ?>
<li class="ul_ignore"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?=$space['uid']?>&amp;handlekey=ignorefriendhk_<?=$space['uid']?>" id="a_ignore_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">解除好友</a></li>
<? } ?>
<li class="ul_contect"><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=wall">给我留言</a></li>
<li class="ul_poke"><a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=<?=$space['uid']?>&amp;handlekey=propokehk_<?=$space['uid']?>" id="a_poke_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">打个招呼</a></li>
<li class="ul_pm"><a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?=$space['uid']?>&amp;touid=<?=$space['uid']?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?=$space['uid']?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)">发送消息</a></li>
<? } ?>
</ul>
<? if(checkperm('allowbanuser') || checkperm('allowedituser') || $_G['adminid'] == 1) { ?>
<hr class="da mtn m0">
<ul class="ptn xl xl2 cl">
<? if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<li>
<? if(checkperm('allowbanuser')) { ?>
<a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?=$space['username']?>&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?=$space['uid']?><? } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<? } else { ?>
<a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?=$space['username']?>&submit=yes&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?=$space['uid']?><? } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<? } ?>
</li>
<? } if($_G['adminid'] == 1) { ?>
<li><a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?=$space['username']?>" id="umanageli" onmouseover="showMenu(this.id)" class="showmenu">内容管理</a></li>
<? } ?>
</ul>
<? if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<ul id="usermanageli_menu" class="p_pop" style="width: 80px; display:none;">
<? if(checkperm('allowbanuser')) { ?>
<li><a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?=$space['username']?>&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?=$space['uid']?><? } ?>" target="_blank">禁止用户</a></li>
<? } if(checkperm('allowedituser')) { ?>
<li><a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?=$space['username']?>&submit=yes&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?=$space['uid']?><? } ?>" target="_blank">编辑用户</a></li>
<? } ?>
</ul>
<? } if($_G['adminid'] == 1) { ?>
<ul id="umanageli_menu" class="p_pop" style="width: 80px; display:none;">
<li><a href="admin.php?action=threads&amp;users=<?=$space['username']?>" target="_blank">管理帖子</a></li>
<li><a href="admin.php?action=doing&amp;searchsubmit=1&amp;users=<?=$space['username']?>" target="_blank">管理记录</a></li>
<li><a href="admin.php?action=blog&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理日志</a></li>
<li><a href="admin.php?action=feed&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理动态</a></li>
<li><a href="admin.php?action=album&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理相册</a></li>
<li><a href="admin.php?action=pic&amp;searchsubmit=1&amp;users=<?=$space['username']?>" target="_blank">管理图片</a></li>
<li><a href="admin.php?action=comment&amp;searchsubmit=1&amp;authorid=<?=$space['uid']?>" target="_blank">管理评论</a></li>
<li><a href="admin.php?action=share&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理分享</a></li>
<li><a href="admin.php?action=threads&amp;operation=group&amp;users=<?=$space['username']?>" target="_blank">群组主题</a></li>
<li><a href="admin.php?action=prune&amp;searchsubmit=1&amp;operation=group&amp;users=<?=$space['username']?>" target="_blank">群组帖子</a></li>
</ul>
<? } } ?>
</div>
</div></div>
<? } include template('common/footer_1_5'); ?>