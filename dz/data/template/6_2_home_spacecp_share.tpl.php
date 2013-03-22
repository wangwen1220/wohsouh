<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_share');
0
|| checktplrefresh('./template/huoshow/home/spacecp_share.htm', './template/huoshow/home/space_share_li.htm', 1331877280, '2', './data/template/6_2_home_spacecp_share.tpl.php', './template/huoshow', 'home/spacecp_share')
|| checktplrefresh('./template/huoshow/home/spacecp_share.htm', './template/huoshow/common/userabout.htm', 1331877280, '2', './data/template/6_2_home_spacecp_share.tpl.php', './template/huoshow', 'home/spacecp_share')
;?><? include template('common/header'); if(!$_G['inajax']) { ?>
<div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em> <a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a>
</div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<? } if($_GET['op'] == 'delete') { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">删除分享</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form id="shareform_<?=$sid?>" name="shareform_<?=$sid?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=share&amp;op=delete&amp;sid=<?=$sid?>&amp;type=<?=$_GET['type']?>" <? if($_G['inajax'] && $_GET['gp_type']!='view') { ?> onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<input type="hidden" name="deletesubmit" value="true" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<div class="c">确定删除指定的分享吗</div>
<p class="o pns">
<button type="submit" name="deletesubmitbtn" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
</form>
<? if($_G['inajax'] && $_GET['gp_type']!='view') { ?>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
share_delete(values['sid']);
}
</script>
<? } } elseif($_GET['op'] == 'edithot') { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">调整热度</em>
<? if(!empty($_G['gp_inajax'])) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=share&amp;op=edithot&amp;sid=<?=$sid?>">
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<input type="hidden" name="hotsubmit" value="true" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">新的热度:<input type="text" name="hot" value="<?=$share['hot']?>" size="10" class="px" /></div>
<p class="o pns">
<button type="submit" name="btnsubmit" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
</form>
<? } elseif($_GET['op']=='link') { if(!$_G['inajax']) { ?>
<h1 class="mt">
<img src="static/image/feed/share.gif" class="vm" alt="share"> 分享
</h1>
<? } else { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">分享</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<? } ?>
<form id="shareform" name="shareform" action="home.php?mod=spacecp&amp;ac=share&amp;type=link" method="post" autocomplete="off" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<input type="hidden" name="refer" value="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=share&amp;view=me" />
<input type="hidden" name="topicid" value="<?=$_GET['topicid']?>" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="sharesubmit" value="true" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<div class="c tfm">
<p>分享网址、视频、音乐、Flash:</p>
<p class="mtn mbm"><input type="text" size="30" class="px" name="link" onfocus="javascript:if('http://'==this.value)this.value='';" onblur="javascript:if(''==this.value)this.value='http://'" id="share_link" value="<?=$linkdefault?>" /></p>
<p>描述:</p>
<p class="mtn mbm"><textarea id="share_general" name="general" cols="30" rows="3" class="pt" onkeydown="ctrlEnter(event, 'sharesubmit_btn')"><?=$generaldefault?></textarea></p>
<? if($type == 'thread') { ?>
<p><a href="javascript:;" onclick="setCopy($('share_general').value + '\n ' + $('share_link').value, '地址已经复制到剪贴板<br />你可以用快捷键 Ctrl + V 粘贴到 QQ、MSN 里。')" />通过 QQ、MSN 分享给朋友</a></p>
<? } if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="secq" onclick="showMenu({'ctrlid':this.id,'win':'{$_G['gp_handlekey']}'})"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="sec"><? include template('common/seccheck'); ?></div>
<? } ?>
</div>
<p class="o pns">
<button type="submit" name="sharesubmit_btn" id="sharesubmit_btn" value="true" class="pn pnc"><strong>分享</strong></button>
</p>
</form>
<? if($_G['inajax']) { ?>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, message, values) {
showCreditPrompt();
}
</script>
<? } } else { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">分享</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" id="shareform_<?=$id?>" name="shareform_<?=$id?>" action="home.php?mod=spacecp&amp;ac=share&amp;type=<?=$type?>&amp;id=<?=$id?>" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>'<? if($type == 'thread') { ?>, null, null, null, 'shareupdate()'<? } ?>);"<? } ?>>
<input type="hidden" name="sharesubmit" value="true">
<input type="hidden" name="referer" value="<?=$_G['referer']?>">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<div class="c">
<p class="cl">
<span class="y xg1">已有 <b><?=$share_count?></b> 人分享了此条目&nbsp;&nbsp;</span>
分享说明:
</p>
<textarea id="general_<?=$id?>" name="general" cols="50" rows="5" class="pt mtn" style="width: 400px;" onkeydown="ctrlEnter(event, 'sharesubmit_btn')" onkeyup="showPreview(this.value, 'quote_<?=$id?>')"></textarea>
<? if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu({'ctrlid':this.id,'win':'{$_G['gp_handlekey']}'})"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm sec"><? include template('common/seccheck'); ?></div>
<? } ?>
<ul id="share_preview" class="el mtm cl 1"><?php $value = $arr; if(empty($ajax_edit)) { ?><li id="share_<?=$value['sid']?>_li"><? } ?>
<div class="h">
<div class="y">
<?php if(!empty($_G['setting']['pluginhooks']['space_share_comment_op'][$k])) echo $_G['setting']['pluginhooks']['space_share_comment_op'][$k]; if($value['sid']) { ?><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=share&amp;id=<?=$value['sid']?>">评论</a><? } if($value['uid']==$_G['uid']) { ?>
<span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=share&amp;op=delete&amp;sid=<?=$value['sid']?>&amp;handlekey=dellshk_<?=$value['sid']?>" id="s_<?=$value['sid']?>_delete" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<? } ?>
</div>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" c="1"><?=$value['nickname']?></a>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=share&amp;id=<?=$value['sid']?>"><?=$value['title_template']?></a>
<? if($value['status'] == 1) { ?><span class="xgl">(待审核)<? } ?>
<span class="xg1"><?php echo dgmdate($value[dateline], 'u'); ?></span>
</div>
<div class="ec cl">
<? if($value['image']) { ?>
<a href="<?=$value['image_link']?>"><img src="<?=$value['image']?>" class="tn" alt="" /></a>
<? } ?>
<div class="d">
<?=$value['body_template']?>
</div>
<? if($value['type'] == 'video') { if(!empty($value['body_data']['imgurl'])) { ?>
<table class="mtm" title="点击播放" onclick="javascript:showFlash('<?=$value['body_data']['host']?>', '<?=$value['body_data']['flashvar']?>', this, '<?=$value['sid']?>');"><tr><td class="vdtn hm" style="background: url(<?=$value['body_data']['imgurl']?>) no-repeat">
<img src="<?=IMGDIR?>/vds.png" alt="点击播放" />
</td></tr></table>
<? } else { ?>
<img src="<?=IMGDIR?>/vd.gif" alt="点击播放" onclick="javascript:showFlash('<?=$value['body_data']['host']?>', '<?=$value['body_data']['flashvar']?>', this, '<?=$value['sid']?>');" class="tn" />
<? } } elseif($value['type'] == 'music') { ?>
<img src="<?=IMGDIR?>/music.gif" alt="点击播放" onclick="javascript:showFlash('music', '<?=$value['body_data']['musicvar']?>', this, '<?=$value['sid']?>');" class="tn" />
<? } elseif($value['type'] == 'flash') { ?>
<img src="<?=IMGDIR?>/flash.gif" alt="点击查看" onclick="javascript:showFlash('flash', '<?=$value['body_data']['flashaddr']?>', this, '<?=$value['sid']?>');" class="tn" />
<? } if($value['body_general']) { ?>
<div class="quote<? if($value['image']) { ?> z<? } ?>"><blockquote id="quote_<?=$id?>"><?=$value['body_general']?></blockquote></div>
<? } ?>
</div>
<? if(empty($ajax_edit)) { ?></li><? } ?></ul>
</div>
<p class="o pns">
<button type="submit" name="sharesubmit_btn" id="sharesubmit_btn" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
<? if($_G['inajax']) { ?>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?> (url, message, values) {
showCreditPrompt();
}
</script>
<? } } if(!$_G['inajax']) { ?>
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
<script type="text/javascript">inituserabout();</script></div>
</div>
<? } include template('common/footer'); ?>