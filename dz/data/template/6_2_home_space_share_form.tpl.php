<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<form id="shareform" name="shareform" action="home.php?mod=spacecp&amp;ac=share&amp;type=link&amp;view=<?=$_GET['view']?>&amp;from=<?=$_GET['from']?>" method="post" autocomplete="off" class="sfm" <? if($_G['gp_view'] == 'me') { ?>onsubmit="ajaxpost(this.id, 'return_shareadd')"<? } ?>>
<p class="mbn">分享网址、视频、音乐、Flash</p>
<p>
<input type="text" name="link" onfocus="javascript:if('http://'==this.value)this.value='';$('share_desc').style.display='block';" onblur="javascript:if(''==this.value)this.value='http://';" id="share_link" value="http://" class="px vm" />&nbsp;
<button type="submit" name="sharesubmit_btn" value="true" id="sharesubmit_btn" class="pn vm"><strong>分享</strong></button>
<a href="javascript:;" onclick="showDialog('<strong>如何分享视频？</strong><br/>填写视频所在网页的网址。(不需要填写视频的真实地址)<br/>我们支持的视频网站有：<br/>Youtube、优酷、酷6、Mofile、偶偶视频、56、新浪视频、搜狐视频。<br/><br/><strong>如何分享音乐？</strong><br/>填写音乐文件的地址。(后缀需要是 mp3 或者 wma)<br/><br/><strong>如何分享 Flash？</strong><br/>填写 Flash 文件的地址。(后缀需要是 swf)', 'notice', '分享说明', '', '', '', '');" class="xi2"><img src="<?=IMGDIR?>/faq.gif" alt="faq" class="vm" /> 帮助</a>
</p>
<div id="share_desc" class="cl" style="display: none;">
<p class="mtm mbn">描述</p>
<p><textarea id="share_general" name="general" rows="3" onkeydown="ctrlEnter(event, 'sharesubmit_btn')" class="pt"></textarea></p>
<? if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu(this.id)"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm sec"><? include template('common/seccheck'); ?></div>
<? } ?>
</div>
<input type="hidden" name="referer" value="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=share&amp;view=me&amp;quickforward=1" />
<input type="hidden" name="sharesubmit" value="true" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<? if($_G['gp_view'] == 'me') { ?>
<input type="hidden" name="handlekey" value="shareadd" />
<? } ?>
<p id="return_shareadd"></p>
</form>