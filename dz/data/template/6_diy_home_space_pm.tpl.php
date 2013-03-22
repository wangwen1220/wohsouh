<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_pm');
0
|| checktplrefresh('./template/huoshow/home/space_pm.htm', './template/huoshow/home/space_pm_node.htm', 1331876532, 'diy', './data/template/6_diy_home_space_pm.tpl.php', './template/huoshow', 'home/space_pm')
|| checktplrefresh('./template/huoshow/home/space_pm.htm', './template/huoshow/common/seditor.htm', 1331876532, 'diy', './data/template/6_diy_home_space_pm.tpl.php', './template/huoshow', 'home/space_pm')
|| checktplrefresh('./template/huoshow/home/space_pm.htm', './template/huoshow/common/userabout.htm', 1331876532, 'diy', './data/template/6_diy_home_space_pm.tpl.php', './template/huoshow', 'home/space_pm')
;?>
<?php $_G['home_tpl_titles'] = array('短消息'); include template('common/header'); ?><div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em>
<a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;do=pm">消息</a>
</div>
</div>

<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><img alt="pm" src="<?=STATICURL?>image/feed/pm.gif" class="vm" /> 消息</h1>
<ul class="tb cl">
<li class="a"><a href="home.php?mod=space&amp;do=pm">短消息</a></li>
<li><a href="home.php?mod=space&amp;do=notice">提醒</a></li>
<? if($_G['setting']['my_app_status']) { ?>
<li><a href="home.php?mod=space&amp;do=notice&amp;view=userapp">应用消息</a></li>
<? } ?>
<li class="o"><a href="home.php?mod=spacecp&amp;ac=pm">发送消息</a></li>
</ul>

<p class="tbmu">
<a href="home.php?mod=space&amp;do=pm&amp;filter=newpm"<?=$actives['newpm']?>>未读消息</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=pm&amp;filter=privatepm"<?=$actives['privatepm']?>>私人消息</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=pm&amp;filter=systempm"<?=$actives['systempm']?>>系统消息</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=pm&amp;filter=announcepm"<?=$actives['announcepm']?>>公共消息</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=pm&amp;subop=ignore"<?=$actives['ignore']?>>忽略列表</a>
</p>
<? if($touid) { ?>
<p class="tbmu">
你们的历史记录:
<a href="home.php?mod=space&amp;do=pm&amp;subop=view&amp;touid=<?=$touid?>&amp;daterange=1"<?=$actives['1']?>>最近一天</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=pm&amp;subop=view&amp;touid=<?=$touid?>&amp;daterange=2"<?=$actives['2']?>>最近两天</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=pm&amp;subop=view&amp;touid=<?=$touid?>&amp;daterange=3"<?=$actives['3']?>>最近三天</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=pm&amp;subop=view&amp;touid=<?=$touid?>&amp;daterange=4"<?=$actives['4']?>>本周</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=pm&amp;subop=view&amp;touid=<?=$touid?>&amp;daterange=5"<?=$actives['5']?>>全部</a><span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=export&amp;touid=<?=$touid?>">导出</a>
</p>
<? } if($_GET['subop'] == 'view') { if($list) { ?>
<div id="pm_ul" class="xld xlda"><? if(is_array($list)) foreach($list as $key => $value) { ?><dl id="pmlist_<?=$value['pmid']?>" class="ptm pbm cl bbda">
<dd class="m avt" <? if(count($list)-1 == $key) { ?>id="bottom"<? } ?>>
<? if($value['msgfromid']) { ?>
<a href="home.php?mod=space&amp;uid=<?=$value['msgfromid']?>"><?php echo avatar($value[msgfromid],small); ?></a>
<? } else { ?>
<img src="<?=IMGDIR?>/systempm.gif" alt="systempm" />
<? } ?>
</dd>
<dt>
<? if($value['msgfromid']) { ?><a href="home.php?mod=space&amp;uid=<?=$value['msgfromid']?>" class="xi2"><?=$value['msgfrom']?></a> <? } ?><span class="xg1 xw0"><?php echo dgmdate($value[dateline], 'u'); ?></span>
</dt>
<dd class="xs2"><?=$value['message']?></dd>
</dl><? } ?>
<div id="pm_append" style="display: none"></div>
</div>
<? } else { ?>
<div class="emp">
当前没有相应的短消息。
</div>
<? } if($touid && $list) { ?>
<div id="pm_ul_post" class="xld xlda">
<dl class="cl">
<span id="pmforum_return"></span>
<dd class="m avt">
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"><?php echo avatar($space[uid],small); ?></a>
</dd>
<dt><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>" class="xi2"><?=$space['username']?></a></dt>
<dd>
<form id="pmform" class="pmform" name="pmform" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=send&amp;touid=<?=$touid?>&amp;pmid=<?=$pmid?>&amp;daterange=<?=$daterange?>&amp;handlekey=pmsend&amp;pmsubmit=yes" onsubmit="parsepmcode(this);ajaxpost('pmform', 'pmforum_return', 'pmforum_return');return false;">
<div class="tedt">
<div class="bar"><?php $seditor = array('reply', array('bold', 'color', 'img', 'link', 'quote', 'code', 'smilies')); ?><div class="fpd">
<? if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="fbld"<? if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?=$seditor['0']?>', '[b]', '[/b]')"<? } ?>>B</a>
<? } if(in_array('color', $seditor['1'])) { ?>
<a href="javascript:;" title="设置文字颜色" class="fclr" id="<?=$seditor['0']?>forecolor"<? if(empty($seditor['2'])) { ?> onclick="showColorBox(this.id, 2, '<?=$seditor['0']?>');doane(event)"<? } ?>>Color</a>
<? } if(in_array('img', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>img" href="javascript:;" title="图片" class="fmg"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'img')"<? } ?>>Image</a>
<? } if(in_array('link', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>url" href="javascript:;" title="添加链接" class="flnk"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'url')"<? } ?>>Link</a>
<? } if(in_array('quote', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>quote" href="javascript:;" title="引用" class="fqt"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'quote')"<? } ?>>Quote</a>
<? } if(in_array('code', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>code" href="javascript:;" title="代码" class="fcd"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'code')"<? } ?>>Code</a>
<? } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?=$seditor['0']?>sml"<? if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<? } ?>>Smilies</a>
<? if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?=VERHASH?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?=$seditor['0']?>smiliesdiv', <?=$_G['setting']['smcols']?>, '<?=$seditor['0']?>');</script>
<? } } ?>
</div></div>
<div class="area">
<textarea rows="3" cols="40" name="message" class="pt" id="replymessage" onkeydown="ctrlEnter(event, 'pmsubmit');"></textarea>
</div>
</div>
<p class="mtn">
<button type="submit" name="pmsubmit" id="pmsubmit" value="true" class="pn"><strong>回复</strong></button>
</p>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
</form>
</dd>
</dl>
</div>
<? } } elseif($_GET['subop'] == 'ignore') { ?>

<form id="ignoreform" name="ignoreform" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=ignore">
<table cellspacing="0" cellpadding="0" width="100%" class="tfm">
<caption>
<p>添加到该列表中的用户给你发送短消息时将不予接收</p>
								<p>添加多个忽略人员名单时用逗号 "," 隔开，如“张三,李四,王五”</p>
								<p>如需禁止所有用户发来的短消息，请设置为 "&#123;ALL&#125;"</p>
</caption>
<tr>
<td><textarea id="ignorelist" name="ignorelist" cols="80" rows="5" class="pt" style="width: 95%;" onkeydown="ctrlEnter(event, 'ignoresubmit');"><?=$ignorelist?></textarea></td>
</tr>
<tr>
<td><button type="submit" name="ignoresubmit" id="ignoresubmit" value="true" class="pn"><strong>保存</strong></button></td>
</tr>
</table>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
</form>

<? } else { if($count) { ?>
<div class="xld xlda mbn">
<? if($newannouncepm) { ?>
<dl id="pmlist_<?=$newannouncepm['pmid']?>" class="bbda cl" style="background-color: <?=SPECIALBG?>;">
<dd class="m">
<img src="<?=IMGDIR?>/annpm.png" alt="公共消息" />
</dd>
<dt>
<span class="xg1 xw0"><?php echo dgmdate($newannouncepm[dateline], 'u'); ?></span>
</dt>
<dd<? if($value['new']) { ?> class="xw1"<? } ?>>
<a href="home.php?mod=space&amp;do=pm&amp;subop=view&amp;pmid=<?=$newannouncepm['pmid']?>&amp;from=privatepm" class="xi2"><?=$newannouncepm['message']?></a>
</dd>
<dd class="pns">
<a href="home.php?mod=space&amp;do=pm&amp;subop=view&amp;pmid=<?=$newannouncepm['pmid']?>&amp;from=privatepm" class="xi2">查看详情 <em>&rsaquo;</em></a>
<a href="home.php?mod=space&amp;do=pm&amp;filter=announcepm" class="xi2">查看更多</a>
</dd>
</dl>
<? } if(is_array($list)) foreach($list as $key => $value) { ?><dl id="pmlist_<? if($value['touid']) { ?><?=$value['touid']?><? } else { ?><?=$value['pmid']?><? } ?>" class="ptm pbm bbda cl">
<dd class="m avt">
<? if($value['touid']) { ?>
<a href="home.php?mod=space&amp;uid=<?=$value['touid']?>"><?php echo avatar($value[touid],small); ?></a>
<? } else { ?>
<img src="<?=IMGDIR?>/systempm.gif" alt="systempm" />
<? } ?>
</dd>
<dt>
<? if($_G['gp_filter']!='announcepm') { if($_G['gp_filter']=='systempm') { ?>
<a class="d" href="home.php?mod=spacecp&amp;ac=pm&amp;op=delete&amp;folder=inbox&amp;pmid=<?=$value['pmid']?>&amp;handlekey=delpmhk_<?=$value['pmid']?>" id="a_delete_<?=$value['pmid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<? } else { ?>
<a class="d" href="home.php?mod=spacecp&amp;ac=pm&amp;op=delete&amp;folder=inbox&amp;<? if($value['touid']) { ?>deluid=<?=$value['touid']?><? } else { ?>pmid=<?=$value['pmid']?><? } ?>&amp;handlekey=delpmhk_<?=$value['pmid']?>" id="a_delete_<?=$value['pmid']?>" onclick="showWindow(this.id, this.href, 'get', 0);" title="删除">删除</a>
<? } } if($value['touid']) { ?>
<span class="xw1 <? if(!$value['new']) { ?>xg1<? } ?>">
<a href="<? if($value['touid']) { ?>home.php?mod=space&do=pm&subop=view&pmid=<?=$value['pmid']?>&touid=<?=$value['touid']?>&daterange=<?=$value['daterange']?><? } else { ?>home.php?mod=space&do=pm&subop=view&pmid=<?=$value['pmid']?><? } ?>"><?=$value['msgfrom']?></a>
</span>
<? } ?>
<span class="xg1 xw0">
<a href="<? if($value['touid']) { ?>home.php?mod=space&do=pm&subop=view&pmid=<?=$value['pmid']?>&touid=<?=$value['touid']?>&daterange=<?=$value['daterange']?><? } else { ?>home.php?mod=space&do=pm&subop=view&pmid=<?=$value['pmid']?><? } ?>"><?php echo dgmdate($value[dateline], 'u'); ?></a>
</span>
</dt>
<dd>
<p class="pm_smry <? if($value['new']) { ?>xw1<? } else { ?>xg1<? } ?>"><?=$value['message']?></p>
<p class="ptn xi2">
<a href="<? if($value['touid']) { ?>home.php?mod=space&do=pm&subop=view&pmid=<?=$value['pmid']?>&touid=<?=$value['touid']?>&daterange=<?=$value['daterange']?><? } else { ?>home.php?mod=space&do=pm&subop=view&pmid=<?=$value['pmid']?><? } ?>">查看详情&raquo;</a>
</p>
</dd>
</dl>
<? } ?>
</div>
<? if($multi) { ?><div class="pgs cl"><?=$multi?></div><? } } else { ?>
<div class="emp">
当前没有相应的短消息。
</div>
<? } } ?>

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