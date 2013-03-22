<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_thread');
0
|| checktplrefresh('./template/huoshow/home/space_thread.htm', './template/huoshow/common/userabout.htm', 1332118756, 'diy', './data/template/6_diy_home_space_thread.tpl.php', './template/huoshow', 'home/space_thread')
|| checktplrefresh('./template/huoshow/home/space_thread.htm', './template/huoshow/home/space_userabout.htm', 1332118756, 'diy', './data/template/6_diy_home_space_thread.tpl.php', './template/huoshow', 'home/space_thread')
;?>
<?php $filter = array( 'common' => '已发表', 'save' => '草稿箱', 'close' => '已关闭', 'aduit' => '待审核', 'recyclebin' => '回收站');
$_G[home_tpl_spacemenus][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=thread&amp;view=me\">TA的所有帖子</a>"; if(empty($diymode)) { include template('common/header'); ?><div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em>
<a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em>
<a href="home.php?mod=space&amp;do=thread">帖子</a>
<? if($_G['gp_view']=='me') { ?>
 <em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=thread&amp;view=me"><?=$space['nickname']?>的帖子</a>
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
<h1 class="mt"><img alt="thread" src="<?=STATICURL?>image/feed/thread.gif" class="vm" /> 帖子</h1>
<? } if($space['self']) { ?>
<ul class="tb cl">
<li<?=$actives['we']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=thread&amp;view=we">好友的帖子</a></li>
<li<?=$actives['me']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=thread&amp;view=me">我的帖子</a></li>
<li<?=$actives['all']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=thread&amp;view=all&amp;order=dateline">随便看看</a></li>
<li class="o"><a href="forum.php?mod=misc&amp;action=nav" onclick="showWindow('nav', this.href, 'get', 0)">发帖</a></li>
</ul>
<? if($_G['gp_view'] == 'me') { ?>
<p class="tbmu bw0">
<? if($viewtype != 'postcomment') { ?>
<span class="y">
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=thread&amp;view=me&amp;type=<?=$viewtype?>&amp;from=<?=$_G['gp_from']?>&amp;filter=" <? if(!$_G['gp_filter']) { ?>class="a"<? } ?>>全部</a><? if(is_array($filter)) foreach($filter as $key => $name) { ?><span class="pipe">|</span><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=thread&amp;view=me&amp;type=<?=$viewtype?>&amp;from=<?=$_G['gp_from']?>&amp;filter=<?=$key?>" <? if($key == $_G['gp_filter']) { ?>class="a"<? } ?>><?=$name?></a>
<? } ?>
</span>
<? } ?>
<a href="home.php?mod=space&amp;do=thread&amp;view=me&amp;type=thread&amp;uid=<?=$space['uid']?>" <?=$orderactives['thread']?>>主题</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=thread&amp;view=me&amp;type=reply&amp;uid=<?=$space['uid']?>" <?=$orderactives['reply']?>>回复</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=thread&amp;view=me&amp;type=postcomment&amp;uid=<?=$space['uid']?>" <?=$orderactives['postcomment']?>>点评</a>
</p>
<? } elseif($_G['gp_view'] == 'all') { ?>
<p class="tbmu bw0">
<a href="home.php?mod=space&amp;do=thread&amp;view=all&amp;order=dateline" <?=$orderactives['dateline']?>>最新帖子</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=thread&amp;view=all&amp;order=hot" <?=$orderactives['hot']?>>热门帖子</a>
</p>
<? } } else { include template('home/space_menu'); ?><p class="tbmu bw0">按照发布时间排序</p>
<? } if($userlist) { ?>
<p class="tbmu bw0">
按好友查看
<select name="fuidsel" onchange="fuidgoto(this.value);" class="ps">
<option value="">全部好友</option><? if(is_array($userlist)) foreach($userlist as $value) { ?><option value="<?=$value['fuid']?>"<?=$fuid_actives[$value['fuid']]?>><?=$value['nickname']?></option>
<? } ?>
</select>
</p>
<? } if($actives['we'] && !$userlist && !$list) { ?>
<p class="mbm"></p>
<? } } else { include template('home/space_header'); ?><div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm">
<div class="bm_h cl">
<h1 class="mt">
<? if($_G['gp_type'] == 'reply') { ?>
<span class="xs1 xw0"><a href="home.php?mod=space&amp;do=thread&amp;view=me&amp;type=thread&amp;uid=<?=$space['uid']?>&amp;from=space">主题</a><span class="pipe">|</span></span>回复
<? } else { ?>
主题<span class="xs1 xw0"><span class="pipe">|</span><a href="home.php?mod=space&amp;do=thread&amp;view=me&amp;type=reply&amp;uid=<?=$space['uid']?>&amp;from=space">回复</a></span>
<? } if($space['self']) { ?><span class="xs1 xw0">( <a href="forum.php?mod=misc&amp;action=nav" onclick="showWindow('nav', this.href, 'get', 0)">发帖</a> )</span><? } ?>
</h1>
</div>
<div class="bm_c">
<? } ?>

<div class="tl">
<form method="post" autocomplete="off" name="delform" id="delform" action="home.php?mod=space&amp;do=thread&amp;view=all&amp;order=dateline" onsubmit="showDialog('确定要删除选中的主题吗？', 'confirm', '', '$(\'delform\').submit();'); return false;">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="delthread" value="true" />

<table cellspacing="0" cellpadding="0">
<tr class="th">
<td class="icn">&nbsp;</td>
<? if($_G['gp_view'] == 'all' && $pruneperm && !$_G['gp_archiveid']) { ?>
<td class="o">&nbsp;</td>
<? } ?>
<th><? if($viewtype == 'reply' || $viewtype == 'postcomment') { ?>帖子<? } else { ?>主题<? } ?></th>
<td class="frm">版块<? if($actives['me'] && $space['uid'] == $_G['uid']) { ?>/群组<? } ?></td>
<? if($viewtype != 'postcomment') { if(!$actives['me']) { ?>
<td class="by">作者</td>
<? } ?>
<td class="num">回复/查看</td>
<? if($actives['me']) { ?>
<td class="by"><cite>最后发帖</cite></td>
<? } } ?>
</tr>

<? if($list) { if(is_array($list)) foreach($list as $thread) { ?><tr<? if($actives['me'] && $viewtype=='reply' || $viewtype=='postcomment') { ?> class="bw0_all"<? } ?>>
<td class="icn">
<a href="forum.php?mod=viewthread&amp;tid=<?=$thread['tid']?>&amp;highlight=<?=$index['keywords']?>" title="新窗口打开" target="_blank">
<? if($thread['folder'] == 'lock') { ?>
<img src="<?=IMGDIR?>/folder_lock.gif" />
<? } elseif($thread['special'] == 1) { ?>
<img src="<?=IMGDIR?>/pollsmall.gif" alt="投票" />
<? } elseif($thread['special'] == 2) { ?>
<img src="<?=IMGDIR?>/tradesmall.gif" alt="商品" />
<? } elseif($thread['special'] == 3) { ?>
<img src="<?=IMGDIR?>/rewardsmall.gif" alt="悬赏" />
<? } elseif($thread['special'] == 4) { ?>
<img src="<?=IMGDIR?>/activitysmall.gif" alt="活动" />
<? } elseif($thread['special'] == 5) { ?>
<img src="<?=IMGDIR?>/debatesmall.gif" alt="辩论" />
<? } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<img src="<?=IMGDIR?>/pin_<?=$thread['displayorder']?>.gif" alt="<?=$_G['setting']['threadsticky'][3-$thread['displayorder']]?>" />
<? } else { ?>
<img src="<?=IMGDIR?>/folder_<?=$thread['folder']?>.gif" />
<? } ?>
</a>
</td>
<? if($_G['gp_view'] == 'all' && $pruneperm && !$_G['gp_archiveid']) { ?>
<td class="o">
<? if($thread['digest'] == 0) { if($thread['displayorder'] == 0) { ?>
<input type="checkbox" name="moderate[]" value="<?=$thread['tid']?>" class="pc" />
<? } else { ?>
<input type="checkbox" class="pc" disabled="disabled" />
<? } } else { ?>
<input type="checkbox" class="pc" disabled="disabled" />
<? } ?>
</td>
<? } ?>
<th>
<? if($viewtype == 'reply' || $viewtype == 'postcomment') { ?>
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;ptid=<?=$thread['tid']?>&amp;pid=<?=$thread['pid']?>" target="_blank"><?=$thread['subject']?></a>
<? } else { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?=$thread['tid']?>" target="_blank" <? if($thread['displayorder'] == -1) { ?>class="recy"<? } ?>><?=$thread['subject']?></a>
<? } if($thread['digest'] > 0) { ?>
<img src="<?=IMGDIR?>/digest_<?=$thread['digest']?>.gif" alt="精华 <?=$thread['digest']?>" align="absmiddle" />
<? } if($thread['attachment'] == 2) { ?>
<img src="<?=STATICURL?>image/filetype/image_s.gif" alt="图片附件" align="absmiddle" />
<? } elseif($thread['attachment'] == 1) { ?>
<img src="<?=STATICURL?>image/filetype/common.gif" alt="附件" align="absmiddle" />
<? } if($thread['multipage']) { ?><span class="tps"><?=$thread['multipage']?></span><? } if(!$_G['gp_filter']) { if($thread['displayorder'] == -1) { ?><span class="xg1"><?=$filter['recyclebin']?></span>
<? } elseif($thread['displayorder'] == -2) { ?><span class="xg1"><?=$filter['aduit']?></span>
<? } elseif($thread['displayorder'] == -3) { ?><span class="xg1"><?=$filter['ignored']?></span>
<? } elseif($thread['displayorder'] == -4) { ?><span class="xg1"><?=$filter['save']?></span>
<? } elseif($thread['closed'] == 1) { ?><span class="xg1"><?=$filter['close']?></span>
<? } } ?>
</th>
<td>
<a href="forum.php?mod=forumdisplay&amp;fid=<?=$thread['fid']?>" class="xg1"><?=$forums[$thread['fid']]?></a>
</td>
<? if($viewtype != 'postcomment') { if(!$actives['me']) { ?>
<td>
<cite><a href="home.php?mod=space&amp;uid=<?=$thread['authorid']?>"><?=$thread['nickname']?></a></cite>
<em><?=$thread['dateline']?></em>
</td>
<? } ?>

<td class="num">
<a href="forum.php?mod=viewthread&amp;tid=<?=$thread['tid']?>" class="xi2"><?=$thread['replies']?></a>
<em><?=$thread['views']?></em>
</td>

<? if($actives['me']) { ?>
<td class="by">
<cite><a href="home.php?mod=space&amp;username=<?=$thread['lastposterenc']?>"><?=$thread['nickname']?></a></cite>
<em><a href="forum.php?mod=redirect&amp;tid=<?=$thread['tid']?>&amp;goto=lastpost#lastpost"><?=$thread['lastpost']?></a></em>
</td>
<? } } ?>
</tr>
<? if($actives['me'] && $viewtype=='reply') { ?>
<tr>
<td colspan="5" class="xg1"><? if($thread['message']) { ?>&nbsp;<img src="<?=IMGDIR?>/icon_quote_m_s.gif" style="vertical-align:middle;" /> <?=$thread['message']?> <img src="<?=IMGDIR?>/icon_quote_m_e.gif" style="vertical-align:middle;" /><? } ?></td>
</tr>
<? } if($actives['me'] && $viewtype=='postcomment') { ?>
<tr>
<td class="icn">&nbsp;</td>
<td colspan="2" class="xg1"><?=$thread['comment']?></td>
</tr>
<? } } } else { ?>
<tr>
<td colspan="<? if($viewtype != 'postcomment') { if(($_G['gp_view'] == 'all' && $pruneperm && !$_G['gp_archiveid'])) { ?>6<? } else { ?>5<? } } else { ?>3<? } ?>"><p class="emp">还没有相关的帖子。</p></td>
</tr>
<? } ?>
</table>

<? if($_G['gp_view'] == 'all' && $pruneperm && !$_G['gp_archiveid'] && $list) { ?>
<p class="mtm pns">
<input type="checkbox" name="chkall" id="chkall" class="pc vm" onclick="checkall(this.form, 'moderate')" />
<label for="chkall">全选</label>&nbsp;&nbsp;
<button type="submit" name="delsubmit" value="true" class="pn vm"><em>删除选中主题</em></button>
</p>
<? } ?>
</form>

<? if($hiddennum) { ?>
<p class="mtm">本页有 <?=$hiddennum?> 篇帖子因隐私问题而隐藏</p>
<? } ?>
</div>
<? if($multi) { ?><div class="pgs cl mtm"><?=$multi?></div><? } ?>


<script type="text/javascript">
function fuidgoto(fuid) {
window.location.href = 'home.php?mod=space&do=thread&view=we&fuid='+fuid;
}
</script>

<? if(empty($diymode)) { ?>

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
</div>
<? } include template('common/footer'); ?>