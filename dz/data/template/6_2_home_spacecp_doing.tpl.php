<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_doing');
0
|| checktplrefresh('./template/huoshow/home/spacecp_doing.htm', './template/huoshow/common/userabout.htm', 1331795884, '2', './data/template/6_2_home_spacecp_doing.tpl.php', './template/huoshow', 'home/spacecp_doing')
;?><? include template('common/header'); if($_GET['op'] == 'delete') { if(!$_G['inajax']) { ?>
<div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z"><a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em> <a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a></div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<? } ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">删除记录</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" id="doingform_<?=$doid?>_<?=$id?>" name="doingform" action="home.php?mod=spacecp&amp;ac=doing&amp;op=delete&amp;doid=<?=$doid?>&amp;id=<?=$id?>">
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">确定删除该记录吗？</div>
<p class="o pns">
<button name="deletesubmit" type="submit" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
<? if(!$_G['inajax']) { ?>
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
<? } } elseif($_GET['op'] == 'spacenote') { if($space['spacenote']) { ?><?=$space['spacenote']?><? } } elseif($_GET['op'] == 'docomment' || $_GET['op'] == 'getcomment') { ?>
<div id="<?=$_G['gp_key']?>_form_<?=$doid?>_<?=$id?>">
<form id="<?=$_G['gp_key']?>_docommform_<?=$doid?>_<?=$id?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=doing&amp;op=comment&amp;doid=<?=$doid?>&amp;id=<?=$id?>" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?> class="pns" style="margin: 5px 0 0;">
<span id="<?=$_G['gp_key']?>_form_<?=$doid?>_<?=$id?>_face" onclick="showFace(this.id, '<?=$_G['gp_key']?>_form_<?=$doid?>_<?=$id?>_t');return false;" style="cursor: pointer;"><img src="<?=IMGDIR?>/facelist.gif" alt="facelist" class="vm" /></span>
<textarea name="message" id="<?=$_G['gp_key']?>_form_<?=$doid?>_<?=$id?>_t" cols="40" class="px pts" oninput="resizeTx(this);" onpropertychange="resizeTx(this);" onkeyup="strLenCalc(this, '<?=$_G['gp_key']?>_form_<?=$doid?>_<?=$id?>_limit')" onkeydown="ctrlEnter(event, '<?=$_G['gp_key']?>_replybtn_<?=$doid?>_<?=$id?>');"></textarea>&nbsp;
<input type="hidden" name="commentsubmit" value="true" />
<button type="submit" name="do_button" id="<?=$_G['gp_key']?>_replybtn_<?=$doid?>_<?=$id?>" class="pn" value="true"><em>回复</em></button>
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<a name="btncancel" href="javascript:;" onclick="docomment_form_close(<?=$doid?>, <?=$id?>, '<?=$_G['gp_key']?>');">取消</a>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div id="<?=$_G['gp_key']?>_form_<?=$doid?>_<?=$id?>_t_limit" class="mtn" style="display: none;">还可输入 <span id="<?=$_G['gp_key']?>_form_<?=$doid?>_<?=$id?>_limit">200</span> 个字符</div>
</form>
<span id="return_<?=$_G['gp_handlekey']?>"></span>
</div>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
docomment_get(values['doid'], '<?=$_G['gp_key']?>');
}
</script>
<? if($_GET['op'] == 'getcomment') { include template('home/space_doing_li'); } } else { ?>

<div id="content"><? include template('home/space_doing_form'); ?></div>

<? } include template('common/footer'); ?>