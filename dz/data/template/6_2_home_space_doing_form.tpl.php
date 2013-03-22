<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<script type="text/javascript">
var msgstr = '你可以更新记录, 让好友们知道你在做什么...';
function handlePrompt(type) {
var msgObj = $('message');
if(type) {
if(msgObj.value == msgstr) {
msgObj.value = '';
msgObj.className = 'xg2';
}
if($('message_menu')) {
if($('message_menu').style.display == 'block') {
showFace('message', 'message', msgstr);
}
}
if(BROWSER.firefox || BROWSER.chrome) {
showFace('message', 'message', msgstr);
}
} else {
if(msgObj.value == ''){
msgObj.value = msgstr;
msgObj.className = 'xg1';
}
}
}
</script>

<div id="moodfm">
<form method="post" autocomplete="off" id="mood_addform" action="home.php?mod=spacecp&amp;ac=doing&amp;view=<?=$_GET['view']?>" onsubmit="if($('message').value == msgstr){return false;}">
<table cellspacing="0" cellpadding="0">
<tr>
<td id="mood_statusinput" class="moodfm_input">
<textarea name="message" id="message" class="xg1" onfocus="handlePrompt(1);" onclick="showFace(this.id, 'message', msgstr);" onblur="handlePrompt(0);" onkeyup="strLenCalc(this, 'maxlimit')" onkeydown="ctrlEnter(event, 'add');" rows="4">你可以更新记录, 让好友们知道你在做什么...</textarea>
</td>
<td class="moodfm_btn">
<input type="submit" name="add" id="add" value="发布" />
</td>
</tr>
<tr>
<td class="moodfm_f">
<div id="return_doing" class="xi1 xw1"></div>
<span class="y">还可输入 <strong id="maxlimit">200</strong> 个字符</span>
<? if($_G['group']['maxsigsize']) { ?>
<input type="checkbox" name="to_signhtml" id="to_sign" class="pc" value="1" /> <label for="to_sign">同步到个人签名</label>
<? } ?>
</td>
<td></td>
</tr>
</table>
<input type="hidden" name="addsubmit" value="true" />
<input type="hidden" name="refer" value="<?=$theurl?>" />
<input type="hidden" name="topicid" value="<?=$topicid?>" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
</form>
</div>