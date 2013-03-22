<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_debate');
0
|| checktplrefresh('./template/huoshow/home/space_debate.htm', './template/huoshow/common/userabout.htm', 1331877369, 'diy', './data/template/6_diy_home_space_debate.tpl.php', './template/huoshow', 'home/space_debate')
;?>
<?php $_G[home_tpl_spacemenus][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=debate&amp;view=me\">TA的所有辩论</a>"; include template('common/header'); ?><div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em>
<a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;do=debate">辩论</a>
<? if($_GET['view']=='me') { ?>
 <em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=debate&amp;view=me"><?=$space['nickname']?>的辩论</a>
<? } ?>
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
<? if((!$_G['uid'] && !$space['uid']) || $space['self']) { ?>
<h1 class="mt"><img alt="debate" src="<?=IMGDIR?>/debatesmall.gif" class="vm" /> 辩论</h1>
<? } if($space['self']) { ?>
<ul class="tb cl">
<li<?=$actives['we']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=debate&amp;view=we">好友发起的辩论</a></li>
<li<?=$actives['me']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=debate&amp;view=me">我的辩论</a></li>
<li<?=$actives['all']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=debate&amp;view=all">随便看看</a></li>
<? if($_G['group']['allowpostdebate']) { ?>
<li class="o">
<? if($_G['setting']['debateforumid']) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['setting']['debateforumid']?>&amp;special=5">发起新辩论</a>
<? } else { ?>
<a href="forum.php?mod=misc&amp;action=nav&amp;special=5" onclick="showWindow('nav', this.href)">发起新辩论</a>
<? } ?>
</li>
<? } ?>
</ul>
<? } else { include template('home/space_menu'); } if($_GET['view'] == 'me') { ?>
<p class="tbmu">
<a href="home.php?mod=space&amp;do=debate&amp;view=me&amp;type=orig"<?=$typeactives['orig']?>>我发起的辩论</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=debate&amp;view=me&amp;type=reply"<?=$typeactives['reply']?>>我参与的辩论</a>
</p>
<? } elseif($_GET['view'] == 'all') { ?>
<p class="tbmu">
<a href="home.php?mod=space&amp;do=debate&amp;view=all"<?=$orderactives['dateline']?>>最新辩论</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=debate&amp;view=all&amp;order=hot"<?=$orderactives['hot']?>>热门辩论</a>
</p>
<? } if($userlist) { ?>
<p class="tbmu">
按好友查看
<select name="fuidsel" onchange="fuidgoto(this.value);" class="ps">
<option value="">全部好友</option><? if(is_array($userlist)) foreach($userlist as $value) { ?><option value="<?=$value['fuid']?>"<?=$fuid_actives[$value['fuid']]?>><?=$value['nickname']?></option>
<? } ?>
</select>
</p>
<? } if($count) { if(is_array($special)) foreach($special as $tid => $thread) { ?><div class="ds bbda mbw">
<h3 class="ph mbn"><a href="forum.php?mod=viewthread&amp;tid=<?=$thread['tid']?>" class="xi2"><?=$thread['subject']?></a></h3>
<p class="xg2 mbw hm"><?=$thread['message']?></p>
<table summary="全部观点" cellspacing="0" cellpadding="0">
<tr>
<td class="si_1">
<div class="point">
<strong>正方观点 (<?=$thread['affirmvotes']?>)</strong>
<p><?=$thread['affirmpoint']?></p>
</div>
</td>
<td class="sc_1">
<div class="point_chart" title="点击支持" style="cursor: pointer;" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?=$thread['tid']?>&amp;stand=1" id="affirmbutton_<?=$thread['tid']?>" onclick="ajaxmenu(this);doane(event);" >
<div class="chart" style="height: <?=$thread['affirmvotesheight']?>;" title="正方 (<?=$thread['affirmvotes']?>)"></div>
</div>
</td>
<th><div></div></th>
<td class="sc_2">
<div class="point_chart" title="点击支持" style="cursor: pointer;" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?=$thread['tid']?>&amp;stand=2" id="negabutton_<?=$thread['tid']?>" onclick="ajaxmenu(this);doane(event);">
<div class="chart" style="height: <?=$thread['negavotesheight']?>;" title="反方 (<?=$thread['negavotes']?>)"></div>
</div>
</td>
<td class="si_2">
<div class="point">
<strong>反方观点 (<?=$thread['negavotes']?>)</strong>
<p><?=$thread['negapoint']?></p>
</div>
</td>
</tr>
</table>
</div>
<? } ?>

<div class="tl">
<? if($list) { ?>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="icn">&nbsp;</td>
<th>&nbsp;</th>
<td class="num">正方</td>
<td class="num">反方</td>
<td class="num">人气</td>
<td width="55">进度</td>
</tr><? if(is_array($list)) foreach($list as $tid => $thread) { ?><tr>
<td>
<a href="forum.php?mod=viewthread&amp;tid=<?=$thread['tid']?>" title="新窗口打开">
<? if($thread['folder'] == 'lock') { ?>
<img src="<?=IMGDIR?>/folder_lock.gif" class="vm" />
<? } elseif($thread['special'] == 5) { ?>
<img src="<?=IMGDIR?>/debatesmall.gif" alt="辩论" class="vm" />
<? } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<img src="<?=IMGDIR?>/pin_<?=$thread['displayorder']?>.gif" alt="<?=$_G['setting']['threadsticky'][3-$thread['displayorder']]?>" class="vm" />
<? } else { ?>
<img src="<?=IMGDIR?>/folder_<?=$thread['folder']?>.gif" class="vm" />
<? } ?>
</a>
</td>
<th height="45">
<a href="forum.php?mod=viewthread&amp;tid=<?=$thread['tid']?>" class="xi2"><?=$thread['subject']?></a>
<? if($thread['digest'] > 0) { ?>
<img src="<?=IMGDIR?>/digest_<?=$thread['digest']?>.gif" alt="精华 <?=$thread['digest']?>" align="absmiddle" />
<? } if($thread['attachment'] == 2) { ?>
<img src="<?=STATICURL?>image/filetype/image_s.gif" alt="图片附件" align="absmiddle" />
<? } elseif($thread['attachment'] == 1) { ?>
<img src="<?=STATICURL?>image/filetype/common.gif" alt="附件" align="absmiddle" />
<? } if($thread['multipage']) { ?><span class="tps"><?=$thread['multipage']?></span><? } ?>
</th>
<td class="xi1"><?=$thread['affirmvotes']?></td>
<td class="xi2"><?=$thread['negavotes']?></td>
<td><?=$thread['replies']?></td>
<td><? if(!$thread['closed']) { ?>进行中<? } else { if($thread['winner']) { if($thread['winner']==1) { ?>正方<? } else { ?>反方<? } ?>获胜<? } else { ?>平局<? } } ?></td>
</tr>
<? } ?>
</table>
<? } if($hiddennum) { ?>
<p class="mtm">本页有 <?=$hiddennum?> 个 辩论因隐私问题而隐藏</p>
<? } ?>
</div>

<? if($multi) { ?><div class="pgs cl mtm"><?=$multi?></div><? } } else { ?>
<div class="emp">还没有相关的辩论。</div>
<? } ?>
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
<script type="text/javascript">inituserabout();</script><div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>

</div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>

<script type="text/javascript">
function fuidgoto(fuid) {
window.location.href = 'home.php?mod=space&do=debate&view=we&fuid='+fuid;
}
</script><? include template('common/footer'); ?>