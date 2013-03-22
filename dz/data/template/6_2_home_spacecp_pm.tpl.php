<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_pm');
0
|| checktplrefresh('./template/huoshow/home/spacecp_pm.htm', './template/huoshow/common/seditor.htm', 1331876552, '2', './data/template/6_2_home_spacecp_pm.tpl.php', './template/huoshow', 'home/spacecp_pm')
|| checktplrefresh('./template/huoshow/home/spacecp_pm.htm', './template/huoshow/common/seditor.htm', 1331876552, '2', './data/template/6_2_home_spacecp_pm.tpl.php', './template/huoshow', 'home/spacecp_pm')
|| checktplrefresh('./template/huoshow/home/spacecp_pm.htm', './template/huoshow/common/userabout.htm', 1331876552, '2', './data/template/6_2_home_spacecp_pm.tpl.php', './template/huoshow', 'home/spacecp_pm')
;?><? include template('common/header'); if(!$_G['inajax']) { ?>
<div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z"><a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em> <a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em> 消息</div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<? } if($_GET['op'] == 'delete') { ?>

<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">删除短消息</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<div id="<?=$pmid?>">
<form id="delpmform_<?=$pmid?>" name="delpmform_<?=$pmid?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=delete&amp;folder=<?=$folder?>&amp;pmid=<?=$pmid?>&amp;deluid=<?=$deluid?>"  <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<input type="hidden" name="deletesubmit" value="true" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">确定删除指定的短消息吗？</div>
<p class="o pns">
<button type="submit" name="deletesubmit_btn" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
</form>
</div>
<? if($_G['inajax']) { ?>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
$('pmlist_'+values['pmid']).style.display = 'none';
}
</script>
<? } } elseif($_GET['op'] == 'getpmuser') { ?>
<?=$jsstr?>
<? } elseif($_GET['op'] == 'ignore') { ?>

<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">屏蔽<?=$username?></em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form id="ignoreuserform" name="ignoreuserform" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=ignore&amp;only=1"  <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<input type="hidden" name="ignoresubmit" value="true" />
<input type="hidden" name="ignoreuser" value="<?=$_G['gp_username']?>" />
<input type="hidden" name="single" value="1" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">确定屏蔽该用户吗？</div>
<p class="o pns">
<button type="submit" name="deletesubmit_btn" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
</form>
<? } elseif($_GET['op'] == 'showmsg') { if($msgonly) { if(is_array($msglist)) foreach($msglist as $day => $msgarr) { ?><li class="cl">
<h4 class="xg1"><?=$day?></h4>
</li><? if(is_array($msgarr)) foreach($msgarr as $key => $value) { ?><?php $class=$value['msgtoid']==$_G['uid']?'cl':'cl pmm'; ?><li class="<?=$class?>">
<div class="pmt"><?=$value['msgfrom']?>: </div>
<div class="pmd"><?=$value['message']?></div>
</li>
<? } } } else { ?>
<div class="pm">
<h3 class="flb">
<em>正在与<?=$msguser?>聊天中……<? if($online) { ?>[在线]<? } else { ?>[离线]<? } ?></em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<div class="pm_tac bbda cl">
<a href="home.php?mod=space&amp;do=pm&amp;subop=view&amp;pmid=<?=$pmid?>&amp;touid=<?=$touid?>&amp;daterange=<?=$daterange?>" class="y" target="_blank">查看与<?=$msguser?>的聊天记录</a>
<a href="home.php?mod=space&amp;uid=<?=$touid?>" target="_blank">访问<?=$msguser?>的空间</a>
</div>
<div class="c">
<ul class="pmb" id="msglist"><? if(is_array($msglist)) foreach($msglist as $day => $msgarr) { ?><li class="cl">
<h4 class="xg1"><?=$day?></h4>
</li><? if(is_array($msgarr)) foreach($msgarr as $key => $value) { ?><?php $class=$value['msgtoid']==$_G['uid']?'cl':'cl pmm'; ?><li class="<?=$class?>">
<div class="pmt"><?=$value['msgfrom']?>: </div>
<div class="pmd"><?=$value['message']?></div>
</li>
<? } } ?>
</ul>
<script type="text/javascript">
var refresh = true;
var refreshHandle = -1;
</script>
<div class="pmfm">
<form id="pmform_<?=$touid?>" name="pmform_<?=$touid?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=send&amp;touid=<?=$touid?>" onsubmit="parsepmcode(this);<? if($_G['inajax']) { ?>ajaxpost(this.id,  'return_<?=$_G['gp_handlekey']?>');<? } ?>">
<input type="hidden" name="pmsubmit" value="true" />
<input type="hidden" name="touid" value="<?=$touid?>" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<? if($_G['inajax']) { ?>
<div id="return_<?=$_G['gp_handlekey']?>" class="xi1" style="margin-bottom:5px"></div>
<input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" />
<? } ?>
<div class="tedt">
<div class="bar"><?php $seditor = array('pm', array('bold', 'color', 'img', 'link', 'quote', 'code', 'smilies')); ?><div class="fpd">
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
<textarea rows="3" cols="80" name="message" class="pt" id="pmmessage" onkeydown="ctrlEnter(event, 'pmsubmit_btn');"></textarea>
<input type="hidden" name="messageappend" id="messageappend" value="<?=$messageappend?>" />
</div>
</div>
<div class="mtn pns cl">
 					<button type="submit" class="pn pnc" id="pmsubmit_btn"><strong>发送</strong></button>
 					<div class="pma mtn z">
<a href="javascript:;" title="刷新" onclick="refreshMsg();"><img src="<?=IMGDIR?>/pm-ico5.png" alt="刷新" class="vm" /> 刷新</a>
 					</div>
</div>
</form>
<script type="text/javascript">var forumallowhtml = 0,allowhtml = 0,allowsmilies = true,allowbbcode = parseInt('<?=$_G['group']['allowsigbbcode']?>'),allowimgcode = parseInt('<?=$_G['group']['allowsigimgcode']?>');var DISCUZCODE = [];DISCUZCODE['num'] = '-1';DISCUZCODE['html'] = [];</script>
<script src="<?=$_G['setting']['jspath']?>bbcode.js?<?=VERHASH?>" type="text/javascript"></script>
<script type="text/javascript">
var msgListObj = $('msglist');
msgListObj.scrollTop = msgListObj.scrollHeight;
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
var liObj = document.createElement("li");
var pmMsg = $('pmmessage');
liObj.className = 'cl pmm';
pmMsg.value = ($('messageappend').value ? $('messageappend').value + '\n' : '') + pmMsg.value;
$('messageappend').value = '';
liObj.innerHTML = '<div class="pmt"><?=$_G['username']?>: </div><div class="pmd">'+bbcode2html(parseurl(pmMsg.value))+'</div>';
msgListObj.appendChild(liObj);
msgListObj.scrollTop = msgListObj.scrollHeight;
pmMsg.value = "";
showCreditPrompt();
}

function refreshMsg() {
if(refresh) {
var x = new Ajax();
x.get('home.php?mod=spacecp&ac=pm&op=showmsg&msgonly=1&touid=<?=$touid?>&pmid=<?=$pmid?>&inajax=1&daterange=<?=$daterange?>', function(s){
msgListObj.innerHTML = s;
msgListObj.scrollTop = msgListObj.scrollHeight;
   						});
} else {
window.clearInterval(refreshHandle);
}
}
refreshHandle = window.setInterval('refreshMsg();', 8000);
hideMenu();
</script>
</div>
</div>
</div>
<? } } else { if(!$_G['inajax']) { ?>
<h1 class="mt cl">
<span class="y xs1 xw0 mtn"><a href="home.php?mod=space&amp;do=pm&amp;view=inbox">返回收件箱</a></span>
<img class="vm" src="<?=STATICURL?>image/feed/pm.gif" alt="pm"> 发送消息
</h1>
<? } else { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">发送消息</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<? } ?>

<div id="__pmform_<?=$pmid?>">
<form id="pmform_<?=$pmid?>" name="pmform_<?=$pmid?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=send&amp;touid=<?=$touid?>&amp;pmid=<?=$pmid?>" onsubmit="parsepmcode(this);<? if($_G['inajax']) { ?>ajaxpost(this.id,  'return_<?=$_G['gp_handlekey']?>');<? } ?>">
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<input type="hidden" name="pmsubmit" value="true" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<? if($_G['inajax']) { ?>
<input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" />
<? } ?>
<div class="c">
<table cellspacing="0" cellpadding="0" class="tfm pmform">
<? if(!$touid) { ?>
<tr>
<th><label for="username">收件人:</label></th>
<td>
<input type="text" id="username" name="username" value="" class="px" />
</td>
</tr>

<? } ?>
<tr>
<th><label for="message">内容:</label></th>
<td>
<div class="tedt">
<div class="bar"><?php $seditor = array('send', array('bold', 'color', 'img', 'link', 'quote', 'code', 'smilies')); ?><div class="fpd">
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
<textarea rows="8" cols="40" name="message" class="pt" id="sendmessage" onkeydown="ctrlEnter(event, 'pmsubmit_btn');"></textarea>
</div>
</div>
</td>
</tr>
<? if($_G['inajax']) { ?>
</table>
</div>
<p class="o pns">
<button type="submit" name="pmsubmit_btn" id="pmsubmit_btn" value="true" class="pn pnc"><strong>发送</strong></button>
</p>
<? } else { ?>
<tr>
<th>&nbsp;</th>
<td>
<button type="submit" name="pmsubmit_btn" id="pmsubmit_btn" value="true" class="pn pnp"><strong>发送</strong></button>
</td>
</tr>
</table>
</div>
<? } ?>
</form>
</div>
<? } if(!$_G['inajax']) { ?>
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