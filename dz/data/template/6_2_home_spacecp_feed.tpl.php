<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_feed');
0
|| checktplrefresh('./template/huoshow/home/spacecp_feed.htm', './template/huoshow/common/seccheck.htm', 1331877195, '2', './data/template/6_2_home_spacecp_feed.tpl.php', './template/huoshow', 'home/spacecp_feed')
;?><? include template('common/header'); if($_GET['op'] == 'getcomment') { ?>

<div class="cmt brm">
<div id="comment_ol_<?=$feedid?>" class="xld xlda"><? if(is_array($list)) foreach($list as $value) { include template('home/space_comment_li'); } ?>
</div>
<? if($multi) { ?><div class="pgs cl mtm"><?=$multi?></div><? } ?>
<form id="feedform_<?=$feedid?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=feed&amp;feedid=<?=$feedid?>" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<span id="face_<?=$feedid?>" title="插入表情" onclick="showFace(this.id, 'feedmessage_<?=$feedid?>');return false;" style="cursor: pointer;"><img src="<?=IMGDIR?>/facelist.gif" alt="facelist" class="vm" /></span>
<span id="note_<?=$feedid?>"></span>
<textarea id="feedmessage_<?=$feedid?>" name="message" rows="2" class="pt"  onkeydown="return ctrlEnter(event, 'feedbutton');"></textarea>
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
<input type="hidden" name="commentsubmit" value="true" />
<p class="pns"><button type="submit" name="feedbutton" id="feedbutton" class="pn" value="true"><strong>评论</strong></button></p>
<span id="return_<?=$_G['gp_handlekey']?>"></span>
<input type="hidden" name="referer" value="home.php?mod=space&amp;do=hot&amp;id=<?=$feedid?>" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="quickcomment" value="1" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
</form>
</div>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?> (url, message, values) {
feedcomment_add(values['cid'], <?=$feedid?>);
hideWindow('<?=$_G['gp_handlekey']?>');
<? if(checkperm('seccode') && $sechash) { if($secqaacheck) { ?>
updatesecqaa('<?=$sechash?>');
<? } if($seccodecheck) { ?>
updateseccode('<?=$sechash?>');
<? } } ?>

}
</script>

<? } elseif($_GET['op'] == 'menu') { if($feed['uid']==$_G['uid']) { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">删除动态</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" id="feedform_<?=$feedid?>" name="feedform_<?=$feedid?>" action="home.php?mod=spacecp&amp;ac=feed&amp;op=delete&amp;feedid=<?=$feedid?>&amp;handlekey=<?=$_G['gp_handlekey']?>" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<input type="hidden" name="feedsubmit" value="true" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c altw">
<div class="alert_info">确定删除该动态吗？</div>
</div>
<p class="o pns">
<button name="feedsubmitbtn" type="submit" class="pn pnc" value="true"><strong>确定</strong></button>
<!--
<? if(checkperm('managefeed')) { ?>
<a href="home.php?mod=spacecp&amp;ac=feed&amp;op=edit&amp;feedid=<?=$feedid?>" target="_blank" class="pn"><strong class="z">编辑</strong></a>
<? } ?>
-->
</p>
</form>
<? } else { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">屏蔽动态</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" id="feedform_<?=$feedid?>" name="feedform_<?=$feedid?>" action="home.php?mod=spacecp&amp;ac=feed&amp;op=ignore&amp;icon=<?=$feed['icon']?>&amp;feedid=<?=$feedid?>" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<input type="hidden" name="feedignoresubmit" value="true" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<div class="c altw">
<p>在下次浏览时不再显示此类动态</p>
<p class="ptn"><input type="radio" name="uid" id="uid1" value="<?=$feed['uid']?>" checked="checked" /> <label for="uid1">仅屏蔽该好友的</label></p>
<p class="ptn"><input type="radio" name="uid" id="uid0" value="0" /> <label for="uid0">屏蔽所有好友的</label></p>
</div>
<p class="o pns">
<button name="feedignoresubmitbtn" type="submit" class="pn pnc" value="true"><strong>确定</strong></button>
<!--
<? if(checkperm('managefeed')) { ?>
<a href="admin.php?action=feed&amp;operation=edit&amp;feedid=<?=$feedid?>" target="_blank" class="pn"><strong class="z">编辑</strong></a>
<? } ?>
-->
</p>
</form>
<? } ?>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
var obj = $('feed_'+ values['feedid'] +'_li');
obj.style.display = "none";
hideWindow('<?=$_G['gp_handlekey']?>');
}
</script>
<? } include template('common/footer'); ?>