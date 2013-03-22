<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_album_pic');
0
|| checktplrefresh('./template/huoshow/home/space_album_pic.htm', './template/huoshow/common/seccheck.htm', 1331805812, 'diy', './data/template/6_diy_home_space_album_pic.tpl.php', './template/huoshow', 'home/space_album_pic')
|| checktplrefresh('./template/huoshow/home/space_album_pic.htm', './template/huoshow/common/userabout.htm', 1331805812, 'diy', './data/template/6_diy_home_space_album_pic.tpl.php', './template/huoshow', 'home/space_album_pic')
|| checktplrefresh('./template/huoshow/home/space_album_pic.htm', './template/huoshow/home/space_userabout.htm', 1331805812, 'diy', './data/template/6_diy_home_space_album_pic.tpl.php', './template/huoshow', 'home/space_album_pic')
;?>
<?php $_G['home_tpl_titles'] = array(getstr($pic['title'], 60, 0, 0, 0, -1), $album['albumname'], '相册'); ?><?php $friendsname = array(1 => '仅好友可见',2 => '指定好友可见',3 => '仅自己可见',4 => '凭密码可见'); if(empty($diymode)) { include template('common/header'); ?><div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
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

<? } else { include template('home/space_header'); } if(empty($diymode)) { ?>
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
<li class="o"><a href="home.php?mod=spacecp&amp;ac=upload&amp;albumid=<?=$pic['albumid']?>">上传图片</a></li>
<? if($_G['referer']) { ?>
<li class="y"><a href="<?=$_G['referer']?>">&laquo; 返回上一页</a></li>
<? } ?>
</ul>
<? } else { ?><?php $_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=album&amp;view=me\">TA的所有相册</a>";
$_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=album&amp;id=$pic[albumid]\">$album[albumname]</a>";
$_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=album&amp;picid=$pic[picid]\">查看原图</a>"; include template('home/space_menu'); ?><hr class="l m0" />
<? } } else { ?>
<div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm">
<div class="bm_h">
<h1>相册<span class="xs1 xw0">( <a href="home.php?mod=spacecp&amp;ac=upload">上传图片</a> )</span></h1>
</div>
<div class="bm_c">
<? } ?>
<div class="tbmu" id="pic_block">
<div class="y">
<a href="javascript:;" onclick="imageRotate('pic', 1)"><img class="vm" src="<?=STATICURL?>image/common/rleft.gif" /></a>
<a href="javascript:;" onclick="imageRotate('pic', 2)"><img class="vm" src="<?=STATICURL?>image/common/rright.gif" /></a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;uid=<?=$pic['uid']?>&amp;do=<?=$do?>&amp;picid=<?=$upid?>&amp;goto=up#pic_block">上一张</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;uid=<?=$pic['uid']?>&amp;do=<?=$do?>&amp;picid=<?=$nextid?>&amp;goto=down#pic_block" id="nextlink">下一张</a><span class="pipe">|</span>
<? if($_GET['play']) { ?>
<a href="javascript:;" id="playid" class="osld" onclick="playNextPic(false);">停止播放</a>
<? } else { ?>
<a href="javascript:;" id="playid" class="osld" onclick="playNextPic(true);">幻灯播放</a>
<? } ?><span id="displayNum"></span>
</div>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=album&amp;id=<?=$pic['albumid']?>">&laquo; 返回图片列表</a>
<? if($album['picnum']) { ?><span class="pipe">|</span>当前第 <?=$sequence?> 张<span class="pipe">|</span>共 <?=$album['picnum']?> 张图片<? } ?>&nbsp;
<? if($album['friend']) { ?>
<span class="xg1"> &nbsp; <?=$friendsname[$value['friend']]?></span>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_albumpic_top'])) echo $_G['setting']['pluginhooks']['space_albumpic_top']; ?>
</div>

<div class="vw pic">

<div id="photo_pic" class="c<? if($pic['magicframe']) { ?> magicframe magicframe<?=$pic['magicframe']?><? } ?>">
<? if($pic['magicframe']) { ?>
<div class="pic_lb1">
<table cellpadding="0" cellspacing="0" class="">
<tr>
<td class="frame_jiao frame_top_left"></td>
<td class="frame_x frame_top_middle"></td>
<td class="frame_jiao frame_top_right"></td>
</tr>
<tr>
<td class="frame_y frame_middle_left"></td>
<td class="frame_middle_middle">
<? } ?><a href="home.php?mod=space&amp;uid=<?=$pic['uid']?>&amp;do=<?=$do?>&amp;picid=<?=$nextid?>&amp;goto=down#pic_block"><img src="<?=$pic['pic']?>" id="pic" alt="" /></a>
<script type="text/javascript">
function createElem(e){
var obj = document.createElement(e);
obj.style.position = 'absolute';
obj.style.zIndex = '1';
obj.style.cursor = 'pointer';
obj.onmouseout = function(){ this.style.background = 'none';}
return obj;
}
function viewPhoto(){
var pre = createElem('div');
var next = createElem('div');
var cont = $('photo_pic');
var tar = $('pic');
var space = 0;
var w = cont.offsetWidth/2;
if(!!window.ActiveXObject && !window.XMLHttpRequest){
space = -(cont.offsetWidth - tar.width)/2;
}

pre.style.left = space + 'px';
next.style.left = space + w + 'px';
pre.style.top = next.style.top = 0;

pre.style.width = next.style.width = w + 'px';
pre.style.height = next.style.height = tar.height + 'px';
pre.innerHTML = next.innerHTML = '<img src="<?=IMGDIR?>/emp.gif" width="' + w + '" height="' + tar.height + '" />';

pre.onmouseover = function(){ this.style.background = 'url(<?=IMGDIR?>/pic-prev.gif) no-repeat 10px 50%'; }
pre.onclick = function(){ window.location = 'home.php?mod=space&uid=<?=$pic['uid']?>&do=<?=$do?>&picid=<?=$upid?>&goto=up#pic_block'; }

next.onmouseover = function(){ this.style.background = 'url(<?=IMGDIR?>/pic-next.gif) no-repeat 94% 50%'; }
next.onclick = function(){ window.location = 'home.php?mod=space&uid=<?=$pic['uid']?>&do=<?=$do?>&picid=<?=$nextid?>&goto=down#pic_block'; }

cont.style.position = 'relative';
cont.appendChild(pre);
cont.appendChild(next);
}
window.onload = function(){
viewPhoto();
}
</script>
<? if($pic['magicframe']) { ?>
</td>
<td class="frame_y frame_middle_right"></td>
</tr>
<tr>
<td class="frame_jiao frame_bottom_left"></td>
<td class="frame_x frame_bottom_middle"></td>
<td class="frame_jiao frame_bottom_right"></td>
</tr>
</table>
</div>
<? } ?>
</div>

<div class="pns mlnv vm mtm cl">
<a href="home.php?mod=space&amp;uid=<?=$pic['uid']?>&amp;do=<?=$do?>&amp;picid=<?=$upid?>&amp;goto=up#pic_block" class="btn" title="上一张"><img src="<?=STATICURL?>image/common/pic_nv_prev.gif" alt="上一张"/></a><? if(is_array($piclist)) foreach($piclist as $value) { ?><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=album&amp;picid=<?=$value['picid']?>#pic_block"><img alt="" src="<?=$value['pic']?>"<? if($value['picid']==$picid) { ?> class="a"<? } ?> /></a><? } ?><a href="home.php?mod=space&amp;uid=<?=$pic['uid']?>&amp;do=<?=$do?>&amp;picid=<?=$nextid?>&amp;goto=down#pic_block" class="btn" title="下一张"><img src="<?=STATICURL?>image/common/pic_nv_next.gif" alt="下一张"/></a>
</div>

<div class="d">
<? if($pic['title']||$pic['status']) { ?><p id="a_set_title"><?=$pic['title']?><? if($pic['status'] == 1) { ?><b>(待审核)</b><? } ?></p><? } ?>
<p class="xg1">
<? if($pic['hot']) { ?><span class="hot">热度 <em><?=$pic['hot']?></em></span><? } if($do=='event') { ?><a href="home.php?mod=space&amp;uid=<?=$pic['uid']?>" target="_blank"><?=$pic['username']?></a><? } ?>
上传于 <?php echo dgmdate($pic[dateline]); ?> (<?=$pic['size']?>)
</p>
<? if(isset($_GET['exif'])) { if($exifs) { if(is_array($exifs)) foreach($exifs as $key => $value) { if($value) { ?><p><?=$key?> : <?=$value?></p><? } } } else { ?>
<p>无EXIF信息</p>
<? } } ?>
<p class="xs1">
<a href="<?=$pic['pic']?>" target="_blank">查看原图</a>
<? if(!isset($_GET['exif'])) { ?>
<span class="pipe">|</span><a href="<?=$theurl?>&exif=1">查看EXIF信息</a>
<? } if($_G['group']['allowdiy'] || $_G['group']['allowauthorizedblock']) { ?>
<span class="pipe">|</span><a href="portal.php?mod=portalcp&amp;ac=portalblock&amp;op=recommend&amp;idtype=picid&amp;id=<?=$pic['picid']?>" onclick="showWindow('recommend', this.href, 'get', 0)">模块推送</a>
<? } if($pic['uid'] != $_G['uid']) { ?>
<span class="pipe">|</span><a href="javascript:;" onclick="showWindow('miscreport<?=$pic['picid']?>', 'misc.php?mod=report&rtype=pic&rid=<?=$pic['picid']?>', 'get', -1);return false;">举报</a>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_albumpic_bottom'])) echo $_G['setting']['pluginhooks']['space_albumpic_bottom']; ?>
</p>
</div>

<div class="o cl">
<a href="home.php?mod=spacecp&amp;ac=share&amp;type=pic&amp;id=<?=$pic['picid']?>&amp;handlekey=sharealbumhk_<?=$pic['picid']?>" id="a_share_<?=$pic['picid']?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="oshr">分享</a>

<?php if(!empty($_G['setting']['pluginhooks']['space_albumpic_op_extra'])) echo $_G['setting']['pluginhooks']['space_albumpic_op_extra']; if($pic['uid'] == $_G['uid']) { if($_G['magic']['frame']) { ?>
<img src="<?=STATICURL?>image/magic/frame.small.gif" alt="frame" class="vm" />
<? if($pic['magicframe']) { ?>
<a id="a_magic_frame" href="home.php?mod=spacecp&amp;ac=magic&amp;op=cancelframe&amp;idtype=picid&amp;id=<?=$pic['picid']?>" onclick="ajaxmenu(event,this.id)">取消相框</a>
<? } else { ?>
<a id="a_magic_frame" href="home.php?mod=magic&amp;mid=frame&amp;idtype=picid&amp;id=<?=$pic['picid']?>" onclick="ajaxmenu(event,this.id, 1)">加相框</a>
<? } ?>
<span class="pipe">|</span>
<? } } if($_G['uid'] == $pic['uid'] || checkperm('managealbum')) { ?>
<a href="home.php?mod=spacecp&amp;ac=album&amp;op=editpic&amp;albumid=<?=$pic['albumid']?>&amp;picid=<?=$pic['picid']?>">管理图片</a><span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=album&amp;op=edittitle&amp;albumid=<?=$pic['albumid']?>&amp;picid=<?=$pic['picid']?>&amp;handlekey=edittitlehk_<?=$pic['picid']?>" id="a_set_title" onclick="showWindow(this.id, this.href, 'get', 0);">编辑说明</a>
<? } if(checkperm('managealbum')) { ?>
<span class="pipe">|</span>IP: <?=$pic['postip']?>
<span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=album&amp;picid=<?=$pic['picid']?>&amp;op=edithot&amp;handlekey=picedithothk_<?=$pic['picid']?>" id="a_hot_<?=$pic['picid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">热度</a>
<? } ?>
<!--a href="home.php?mod=spacecp&amp;ac=common&amp;op=report&amp;idtype=picid&amp;id=<?=$pic['picid']?>&amp;handlekey=reportpichk_<?=$pic['picid']?>" id="a_report" onclick="showWindow(this.id, this.href, 'get', 0);">举报</a-->
</div>

</div>
<!--[diy=diyclicktop]--><div id="diyclicktop" class="area"></div><!--[/diy]-->
<div id="click_div"><? include template('home/space_click'); ?></div>
<!--[diy=diycommenttop]--><div id="diycommenttop" class="area"></div><!--[/diy]-->
<div id="pic_comment" class="bm bw0 mtm mbm">
<h3 class="pbn bbs">
<? if(!empty($list)) { ?>
<a href="home.php?mod=space&amp;uid=<?=$pic['uid']?>&amp;do=<?=$do?>&amp;picid=<?=$pic['picid']?>#quickcommentform_<?=$picid?>" class="y xi2 xw0">发表评论</a>
<? } ?>
评论
</h3>
<div id="comment">
<? if($cid) { ?>
<div class="i">
当前只显示与你操作相关的单个评论，<a href="<?=$theurl?>#comment">点击此处查看全部评论</a>
</div>
<? } ?>

<div id="comment_ul" class="xld xlda"><? if(is_array($list)) foreach($list as $value) { include template('home/space_comment_li'); } ?>
</div>
</div>
<? if($multi) { ?><div class="pgs cl mtm"><?=$multi?></div><? } ?>
</div>
<form id="quickcommentform_<?=$picid?>" name="quickcommentform_<?=$picid?>" action="home.php?mod=spacecp&amp;ac=comment&amp;handlekey=qcpic_<?=$picid?>" method="post" autocomplete="off" onsubmit="ajaxpost('quickcommentform_<?=$picid?>', 'return_qcpic_<?=$picid?>');doane(event);" class="bm bw0" style="width: 600px;">
<? if($_G['uid']) { ?>
<p>
<span id="comment_face" onclick="showFace(this.id, 'comment_message');return false;" style="cursor: pointer;"><img src="<?=IMGDIR?>/facelist.gif" alt="facelist" class="vm" /></span>
<?php if(!empty($_G['setting']['pluginhooks']['space_albumpic_face_extra'])) echo $_G['setting']['pluginhooks']['space_albumpic_face_extra']; if($_G['setting']['magicstatus'] && !empty($_G['setting']['magics']['doodle'])) { ?>
<a id="a_magic_doodle" href="home.php?mod=magic&amp;mid=doodle&amp;showid=comment_doodle&amp;target=comment_message" onclick="showWindow(this.id, this.href, 'get', 0)"><img src="<?=STATICURL?>image/magic/doodle.small.gif" alt="doodle" class="vm" /> <?=$_G['setting']['magics']['doodle']?></a>
<? } ?>
</p>
<? } ?>
<div class="tedt mtn mbn">
<div class="area">
<? if($_G['uid']) { ?>
<textarea id="comment_message" onkeydown="ctrlEnter(event, 'commentsubmit_btn');" name="message" rows="3" class="pt"></textarea>
<? } else { ?>
<div class="pt hm">你需要登录后才可以评论 <a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">登录</a> | <a href="member.php?mod=<?=$_G['setting']['regname']?>" onclick="showWindow('register', this.href)" class="xi2"><?=$_G['setting']['reglinkname']?></a></div>
<? } ?>
</div>

</div>
<? if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu(this.id);"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm mbm sec"><?php $sechash = 'S'.random(4);
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');
$sectpldefault = $sectpl;
$sectplqaa = str_replace('<hash>', 'qaa'.$sechash, $sectpldefault);
$sectplcode = str_replace('<hash>', 'code'.$sechash, $sectpldefault);
$secshow = !isset($secshow) ? 1 : $secshow;
$sectabindex = !isset($sectabindex) ? 1 : $sectabindex; ?><?
$__STATICURL = STATICURL;$seccheckhtml = <<<EOF

<input name="sechash" type="hidden" value="{$sechash}" />

EOF;
 if($sectpl) { if($secqaacheck) { 
$seccheckhtml .= <<<EOF

{$sectplqaa['0']}验证问答{$sectplqaa['1']}<input name="secanswer" id="secqaaverify_{$sechash}" type="text" autocomplete="off" style="width:100px" class="txt px vm" onblur="checksec('qaa', '{$sechash}')" tabindex="{$sectabindex}" />
<a href="javascript:;" onclick="updatesecqaa('{$sechash}');doane(event);" class="xi2">换一个</a>
<span id="checksecqaaverify_{$sechash}"><img src="{$__STATICURL}image/common/none.gif" width="16" height="16" class="vm" /></span>
{$sectplqaa['2']}<span id="secqaa_{$sechash}"></span>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updatesecqaa('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplqaa['3']}

EOF;
 } if($seccodecheck) { 
$seccheckhtml .= <<<EOF

{$sectplcode['0']}验证码{$sectplcode['1']}<input name="seccodeverify" id="seccodeverify_{$sechash}" type="text" autocomplete="off" style="width:100px" class="txt px vm" onblur="checksec('code', '{$sechash}')" tabindex="{$sectabindex}" />
<a href="javascript:;" onclick="updateseccode('{$sechash}');doane(event);" class="xi2">换一个</a>
<span id="checkseccodeverify_{$sechash}"><img src="{$__STATICURL}image/common/none.gif" width="16" height="16" class="vm" /></span>
{$sectplcode['2']}<span id="seccode_{$sechash}"></span>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updateseccode('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplcode['3']}

EOF;
 } } 
$seccheckhtml .= <<<EOF


EOF;
?><?php unset($secshow); if(empty($secreturn)) { ?><?=$seccheckhtml?><? } ?></div>
<? } ?>
<p class="pns">
<input type="hidden" name="refer" value="<?=$theurl?>" />
<input type="hidden" name="id" value="<?=$picid?>" />
<input type="hidden" name="idtype" value="picid" />
<input type="hidden" name="commentsubmit" value="true" />
<input type="hidden" name="quickcomment" value="true" />
<button type="submit" name="commentsubmit_btn" value="true" id="commentsubmit_btn" class="pn"<? if(!$_G['uid']) { ?> onclick="showWindow(this.id, this.form.action);return false;"<? } ?>><strong>评论</strong></button>
<span id="__quickcommentform_<?=$picid?>"></span>
<span id="return_qcpic_<?=$picid?>"></span>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
</p>
</form>
</div>


<script type="text/javascript">
function succeedhandle_qcpic_<?=$picid?>(url, msg, values) {
if(values['cid']) {
comment_add(values['cid']);
} else {
$('return_qcpic_<?=$picid?>').innerHTML = msg;
}
<? if(checkperm('seccode') && $sechash) { if($secqaacheck) { ?>
updatesecqaa('<?=$sechash?>');
<? } if($seccodecheck) { ?>
updateseccode('<?=$sechash?>');
<? } } ?>
}
</script>

<script type="text/javascript">
var interval = 5000;
var timerId = -1;
var derId = -1;
var replay = false;
var num = 0;
var endPlay = false;
function forward() {
window.location.href = 'home.php?mod=space&uid=<?=$pic['uid']?>&do=<?=$do?>&picid=<?=$nextid?>&goto=down&play=1#pic_block';
}
function derivativeNum() {
num++;
$('displayNum').innerHTML = '[' + (interval/1000 - num) + ']';
}
function playNextPic(stat) {
if(stat || replay) {
derId = window.setInterval('derivativeNum();', 1000);
$('displayNum').innerHTML = '[' + (interval/1000 - num) + ']';
$('playid').onclick = function (){replay = false;playNextPic(false);};
$('playid').innerHTML = '停止播放';
timerId = window.setInterval('forward();', interval);
} else {
replay = true;
num = 0;
if(endPlay) {
$('playid').innerHTML = '重新播放';
} else {
$('playid').innerHTML = '幻灯播放';
}
$('playid').onclick = function (){playNextPic(true);};
$('displayNum').innerHTML = '';
window.clearInterval(timerId);
window.clearInterval(derId);
}
}
<? if($_GET['play']) { if($sequence && $album['picnum']) { ?>
if(<?=$sequence?> == <?=$album['picnum']?>) {
endPlay = true;
playNextPic(false);
} else {
playNextPic(true);
}
<? } else { ?>
playNextPic(true);
<? } } ?>

function update_title() {
$('title_form').style.display='';
}

var elems = selector('dd[class~=magicflicker]'); 
for(var i=0; i<elems.length; i++){
magicColor(elems[i]);
}
</script>

<!--end bm-->

<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
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
<script type="text/javascript">inituserabout();</script><? } ?>
</div>

</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
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
<? } include template('common/footer_1_5'); ?>