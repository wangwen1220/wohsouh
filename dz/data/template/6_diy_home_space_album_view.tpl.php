<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_album_view');
0
|| checktplrefresh('./template/huoshow/home/space_album_view.htm', './template/huoshow/common/userabout.htm', 1332813974, 'diy', './data/template/6_diy_home_space_album_view.tpl.php', './template/huoshow', 'home/space_album_view')
|| checktplrefresh('./template/huoshow/home/space_album_view.htm', './template/huoshow/home/space_userabout.htm', 1332813974, 'diy', './data/template/6_diy_home_space_album_view.tpl.php', './template/huoshow', 'home/space_album_view')
;?>
<?php $_G['home_tpl_titles'] = array($album['albumname'], '相册'); ?><?php $friendsname = array(1 => '仅好友可见',2 => '指定好友可见',3 => '仅自己可见',4 => '凭密码可见'); if(empty($diymode)) { include template('common/header'); ?><div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em>
<a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;do=album">相册</a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=album&amp;view=me"><?=$space['nickname']?>的相册</a>
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
<h1 class="mt"><img alt="album" src="<?=STATICURL?>image/feed/album.gif" class="vm" /> 相册 - <?=$album['albumname']?></h1>
<ul class="tb cl">
<li<?=$actives['we']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=album&amp;view=we">好友的相册</a></li>
<li<?=$actives['me']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=album&amp;view=me">我的相册</a></li>
<li<?=$actives['all']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=album&amp;view=all">随便看看</a></li>
<li class="o"><a href="home.php?mod=spacecp&amp;ac=upload&amp;albumid=<?=$album['albumid']?>">上传图片</a></li>
<? if($_G['referer']) { ?>
<li class="y"><a href="<?=$_G['referer']?>">&laquo; 返回上一页</a></li>
<? } ?>
</ul>
<? } else { ?><?php $_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=album&amp;view=me\">TA的所有相册</a>";
$_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=album&amp;id=$_GET[id]\">$album[albumname]</a>"; include template('home/space_menu'); ?><hr class="l m0" />
<? } } else { include template('home/space_header'); ?><div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm">
<div class="bm_h cl">
<h1 class="mt">相册<span class="xs1 xw0">( <a href="home.php?mod=spacecp&amp;ac=upload">上传图片</a> )</span></h1>
</div>
<div class="bm_c">
<? } ?>

<div class="tbmu cl">
<? if($album['albumid']>0) { ?>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=album&amp;id=<?=$album['albumid']?>&amp;spaceuid=<?=$space['uid']?>&amp;handlekey=sharealbumhk_<?=$album['albumid']?>" id="a_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" class="oshr ofav">收藏</a>
<a href="home.php?mod=spacecp&amp;ac=share&amp;type=album&amp;id=<?=$album['albumid']?>&amp;handlekey=sharealbumhk_<?=$album['albumid']?>" id="a_share" onclick="showWindow(this.id, this.href, 'get', 0);" class="oshr">分享</a>
<? } ?>
<div class="y">
<?php if(!empty($_G['setting']['pluginhooks']['space_album_op_extra'])) echo $_G['setting']['pluginhooks']['space_album_op_extra']; if($space['self']) { ?><a href="<? if($album['albumid'] > 0) { ?>home.php?mod=spacecp&ac=album&op=edit&albumid=<?=$album['albumid']?><? } else { ?>home.php?mod=spacecp&ac=album&op=editpic&albumid=0<? } ?>">编辑</a><span class="pipe">|</span><? } if(($_G['uid'] == $album['uid'] || checkperm('managealbum')) && $album['albumid'] > 0) { ?>
<a href="home.php?mod=spacecp&amp;ac=album&amp;op=delete&amp;albumid=<?=$album['albumid']?>&amp;uid=<?=$album['uid']?>&amp;handlekey=delalbumhk_<?=$album['albumid']?>" id="album_delete_<?=$album['albumid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a><span class="pipe">|</span>
<? } if($_G['uid'] != $album['uid']) { ?>
<a href="javascript:;" onclick="showWindow('miscreport<?=$album['albumid']?>', 'misc.php?mod=report&rtype=album&rid=<?=$album['albumid']?>', 'get', -1);return false;">举报</a><span class="pipe">|</span>
<? } ?>
</div>
<? if($album['catname']) { ?>
<span class="xg1">系统分类</span><a href="home.php?mod=space&amp;do=album&amp;catid=<?=$album['catid']?>&amp;view=all"><?=$album['catname']?></a><span class="pipe">|</span>
<? } if($album['picnum']) { ?>共 <?=$album['picnum']?> 张图片<? } if($album['friend']) { ?>
<span class="xg1"> &nbsp; <?=$friendsname[$value['friend']]?></span>
<? } ?>
</div>

<? if($list) { ?>
<ul class="ptw ml mlp cl"><? if(is_array($list)) foreach($list as $key => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=<?=$do?>&amp;picid=<?=$value['picid']?>"><? if($value['pic']) { ?><img src="<?=$value['pic']?>" alt="" /><? } ?></a><? if($value['status'] == 1) { ?><b>(待审核)</b><? } ?>
</li>
<? } ?>
</ul>
<? if($pricount) { ?><p>本页有 <?=$pricount?> 张图片因作者的隐私设置或未通过而隐藏</p><? } if($multi) { ?><div class="pgs cl mtm"><?=$multi?></div><? } } else { if(!$pricount) { ?><p class="emp">该相册下还没有图片。</p><? } if($pricount) { ?><p>本页有 <?=$pricount?> 张图片因作者的隐私设置或未通过而隐藏</p><? } } if($albumlist) { ?>
<div class="bm mtm">
<div class="bm_h cl">
<? if($albumlist) { ?>
<div class="y mtn">
<a href="javascript:;" id="sabup" onclick="switchAlbum(0);this.blur();return false;" title="上一组"><img src="<?=STATICURL?>image/common/pic_nv_prev.gif" alt="上一组"/></a> 
<a href="javascript:;" id="sabdown" onclick="switchAlbum(1);this.blur();return false;" title="下一组"><img src="<?=STATICURL?>image/common/pic_nv_next.gif" alt="下一组"/></a>
</div>
<? } ?>
<h2>切换不同的相册查看</h2>
</div>
<div class="bm_c">
<div id="pnv" class="bn pns cl">
<? if($albumlist) { if(is_array($albumlist)) foreach($albumlist as $key => $ablums) { ?><ul id="albumbox_<?=$key?>" class="ptm ml mla mla1 z" <? if(!isset($ablums[$id]) && !($key==0 && $id<0)) { ?> style="display: none;"<? } else { ?><?php $nowalbum=$key; } ?>><? if(is_array($ablums)) foreach($ablums as $akey => $value) { ?><?php $pwdkey = 'view_pwd_album_'.$value['albumid']; ?><li>
<div class="c<? if($value['albumid']==$id) { ?> a<? } ?>"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=album&amp;id=<?=$value['albumid']?>" title="<?=$value['albumname']?>" <? if($value['uid']!=$_G['uid'] && $value['friend']=='4' && $value['password'] && empty($_G['cookie'][$pwdkey])) { ?> onclick="showWindow('right_album_<?=$value['albumid']?>', this.href, 'get', 0);"<? } ?>><? if($value['pic']) { ?><img src="<?=$value['pic']?>" alt="<?=$value['albumname']?>" /><? } ?></a>
</div>
</li>
<? } ?>
</ul>
<? } ?>
<script type="text/javascript">
var nowAlbum = <?=$nowalbum?>;
var maxAlbum = <?=$maxalbum?>;
function switchAlbum(down) {
if(down) {
if(nowAlbum + 1 < maxAlbum) {
$('albumbox_'+nowAlbum).style.display = 'none';
nowAlbum++;
$('albumbox_'+nowAlbum).style.display = '';
}
} else {
if(nowAlbum - 1 >= 0) {
$('albumbox_'+nowAlbum).style.display = 'none';
nowAlbum--;
$('albumbox_'+nowAlbum).style.display = '';
}
}
initSwitchButton();
}
function initSwitchButton(){
$('sabdown').style.display = maxAlbum-nowAlbum == 1 ? 'none' : '';
$('sabup').style.display = nowAlbum ? '' : 'none';
}
window.onload = function () {initSwitchButton();}
</script>
<? } ?>
</div>
</div>
</div>
<? } ?>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
</div>
</div>
<? if(empty($diymode)) { ?>
<div class="appl">
<? if(empty($diymode)) { ?><?php if(!empty($_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE]; ?><?php getuserapp(1); ?><ul><? if(is_array($_G['setting']['spacenavs'])) foreach($_G['setting']['spacenavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { if(in_array($nav['code'], array('userpanelarea1', 'userpanelarea2'))) { if(!empty($_G['my_panelapp']) && $_G['setting']['my_app_status']) { if($nav['code']=='userpanelarea1' && !empty($_G['my_panelapp']['1'])) { if(is_array($_G['my_panelapp']['1'])) foreach($_G['my_panelapp']['1'] as $appid => $app) { ?><li>
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

<? } ?>
</div>
<? } else { ?>
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
<? } ?>

</div>

<? if(empty($diymode)) { ?>
<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>
<? } include template('common/footer_1_5'); ?>