<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div id="mood_mystatus" class="mtm mbn">
<? if($space['spacenote']) { ?><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=doing&amp;view=me" title="查看我的所有记录"><?=$space['spacenote']?> &raquo;</a><? } else { ?><label for="mood_message" class="xi2" style="cursor: pointer;">你还没有更新过心情记录 &raquo;</label><? } ?>
</div>
<script type="text/javascript">
var msgstr = '你可以更新记录, 让好友们知道你在做什么...';
function handlePrompt(type) {
var msgObj = $('mood_message');
if(type) {
$('moodfm').className = 'hover';
if(msgObj.value == msgstr) {
msgObj.value = '';
msgObj.className = 'msgfocus xg2';
}
if($('mood_message_menu')) {
if($('mood_message_menu').style.display === 'block') {
showFace('mood_message', 'mood_message', msgstr);
}

}
if(BROWSER.firefox || BROWSER.chrome) {
showFace('mood_message', 'mood_message', msgstr);
}
} else {
$('moodfm').className = '';
if(msgObj.value == ''){
msgObj.value = msgstr;
msgObj.className = 'xg1';
}
}
}
function reloadMood(showid) {
var x = new Ajax();
x.get('home.php?mod=spacecp&ac=doing&op=spacenote&inajax=1', function(s){
$('mood_mystatus').innerHTML = '<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=doing&amp;view=me" title="查看我的所有记录">'+s+'&raquo;</a>';
});
$('mood_message').value = '';
strLenCalc($('mood_message'), 'maxlimit');
handlePrompt(0);
}
</script>

<div id="moodfm">
<form method="post" autocomplete="off" id="mood_addform" action="home.php?mod=spacecp&amp;ac=doing&amp;handlekey=doing" onsubmit="if($('mood_message').value != msgstr) {ajaxpost(this.id, 'return_doing');} else {return false;}">
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td id="mood_statusinput" class="moodfm_input">
<textarea name="message" id="mood_message" class="xg1" onclick="showFace(this.id, 'mood_message', msgstr);" onfocus="handlePrompt(1);" onblur="handlePrompt(0);" onkeydown="if(ctrlEnter(event, 'addsubmit_btn')){if(event.keyCode == 13 ){ doane(event);}}" onkeyup="strLenCalc(this, 'maxlimit');">你可以更新记录, 让好友们知道你在做什么...</textarea>
</td>
<td class="moodfm_btn">
<input type="submit" name="addsubmit_btn" id="addsubmit_btn" value="发布" />
</td>
</tr>
<tr>
<td class="moodfm_f">
<span class="y">还可输入 <strong id="maxlimit">200</strong> 个字符</span>
<? if($_G['group']['maxsigsize']) { ?>
<input type="checkbox" name="to_signhtml" id="to_sign" class="pc" value="1" /> <label for="to_sign">同步到个人签名</label>
<? } ?>
<div id="return_doing" class="xi1 xw1"></div>
</td>
<td></td>
</tr>
</table>
<input type="hidden" name="addsubmit" value="true" />
<input type="hidden" name="spacenote" value="true" />
<input type="hidden" name="referer" value="home.php" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
</form>
<script type="text/javascript">
function succeedhandle_doing(url, msg, values) {
if(values['message']) {
showDialog(values['message']);
return false;
}
reloadMood(values['doid']);
}
</script>
</div>
