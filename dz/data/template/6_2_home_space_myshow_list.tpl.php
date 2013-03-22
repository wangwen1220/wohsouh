<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_myshow_list');
0
|| checktplrefresh('./template/huoshow/home/space_myshow_list.htm', './template/huoshow/common/userabout.htm', 1331885896, '2', './data/template/6_2_home_space_myshow_list.tpl.php', './template/huoshow', 'home/space_myshow_list')
|| checktplrefresh('./template/huoshow/home/space_myshow_list.htm', './template/huoshow/home/space_userabout.htm', 1331885896, '2', './data/template/6_2_home_space_myshow_list.tpl.php', './template/huoshow', 'home/space_myshow_list')
;?><? include template('common/header'); ?><div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em>
<a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;do=myshow">MY秀</a>
<? if($_GET['view']=='me') { ?>
 <em>&rsaquo;</em> <a href="home.php?mod=space&amp;do=myshow&amp;view=me"><?=$space['nickname']?>的MY秀</a>
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
<h1 class="mt"><img alt="blog" src="<?=STATICURL?>image/feed/myshow.png" class="vm" /> MY秀</h1>
<? } if($space['self']) { ?>
<ul class="tb cl">
<li<?=$actives['we']?>><a href="home.php?mod=space&amp;do=myshow&amp;view=we">好友的MY秀</a></li>
<li<?=$actives['me']?>><a href="home.php?mod=space&amp;do=myshow&amp;view=me">我的MY秀</a></li>
<li<?=$actives['all']?>><a href="home.php?mod=space&amp;do=myshow&amp;view=all">随便看看</a></li>
<li class="o"><a href="home.php?mod=spacecp&amp;ac=myshow">发布新作品</a></li>
</ul>
<? } else { include template('home/space_menu'); } if($_GET['view'] == 'me') { ?>
<form method="post" autocomplete="off" action="home.php?mod=space&amp;do=myshow&amp;view=me">				
<p class="tbmu">
按类型查看
<select name="type" class="ps">
<option value="">全部</option>
<option value="1" <? if($type==1) { ?>selected="selected"<? } ?>>音频</option>
<option value="2" <? if($type==2) { ?>selected="selected"<? } ?>>视频</option>
</select>

按审核查看
<select name="audit" class="ps">				
 
<option value="" selected="selected">全部</option>
<option value="1" <? if($audit==1) { ?>selected="selected"<? } ?>>审核中</option>
<option value="2" <? if($audit==2) { ?>selected="selected"<? } ?>>已审核</option>
</select>
<input name="fanart" value="1" type="checkbox" <? if($fanart==1) { ?>checked="checked"<? } ?>>只看原创
<button type="submit" class="pn"><strong>下一步</strong></button>
</p>				
</form>
<? } elseif(($_GET['view'] == 'all' && empty($_G['gp_uid']))) { ?>
<p class="tbmu">
<a href="home.php?mod=space&amp;do=myshow&amp;view=<?=$_GET['view']?>&amp;order=dateline" <?=$orderactives['dateline']?>>最近发布的MY秀</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=myshow&amp;view=<?=$_GET['view']?>&amp;order=hot" <?=$orderactives['hot']?>>热门MY秀推荐</a>
</p>
<? } if($searchkey) { ?>
<p class="tbmu">以下是搜索日志 <span style="color: red; font-weight: 700;"><?=$searchkey?></span> 结果列表</p>
<? } if($count) { ?>
<div class="xld <? if(empty($diymode)) { ?>xlda<? } ?>">
<table class="t1" cellpadding="0" cellspacing="0">
<tbody><tr>
<th width="150">封面</th>
<th width="250">标题</th>
<th width="170">上传</th>
<th width="120">播放</th>
<? if($_GET['view']=='me') { ?><th>状态</th><? } else { ?><th width="150">作者</th><? } ?>
</tr><? if(is_array($list)) foreach($list as $key => $value) { ?><tr>
<td height="70">
<? if($value['type']==1) { ?>
<a href="home.php?mod=space&amp;do=myshow&amp;view=<?=$_GET['view']?>&amp;id=<?=$value['myshowid']?>"><img src="<?=$value['image']?>" onerror="this.onerror=null;this.src='static2/images/audio_default.gif'" height="60" width="90"></a>
<? } else { ?>
<a href="home.php?mod=space&amp;do=myshow&amp;view=<?=$_GET['view']?>&amp;id=<?=$value['myshowid']?>"><img src="<?=$value['image']?>" onerror="this.onerror=null;this.src='static2/images/video_default.gif'" height="60" width="90"></a>
<? } ?>
</td>
<td height="70"><a href="home.php?mod=space&amp;do=myshow&amp;view=<?=$_GET['view']?>&amp;id=<?=$value['myshowid']?>"><?=$value['title']?></a></td>
<td height="70"><? echo date('Y-m-d H:i:s', $value['dateline']);; ?></td>
<td height="70"><?=$value['viewnum']?></td>
<? if($_GET['view']=='me') { ?><td><? if($value['auditstatus']==1) { ?>审核中<? } else { ?>已审核<? } ?></td><? } else { ?><td height="70"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>"><?=$value['nickname']?></a></td><? } ?>

</tr>
<? } ?>
</tbody>
</table>
<? if($pricount) { ?>
<p class="mtm">本页有 <?=$pricount?> 篇日志因作者的隐私设置或未通过审核而隐藏</p>
<? } ?>
</div>
<? if($multi) { ?><div class="pgs cl mtm"><?=$multi?></div><? } } else { ?>
<div class="emp">还没有相关的MY秀。</div>
<? } if(empty($diymode)) { ?>
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
<script type="text/javascript">inituserabout();</script></div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>

<script type="text/javascript">
function fuidgoto(fuid) {
window.location.href = 'home.php?mod=space&do=blog&view=we&fuid='+fuid;
}
</script>

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