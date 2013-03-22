<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('register');
0
|| checktplrefresh('./template/huoshow/member/register.htm', './template/huoshow/common/seccheck.htm', 1331795746, '2', './data/template/6_2_member_register.tpl.php', './template/huoshow', 'member/register')
;?><? include template('common/header'); if(!empty($message)) { ?>
<script type="text/javascript" onload="1"><?php $_G['setting']['bbname'] = str_replace('\\\'', '\\\\\'', $_G['setting']['bbname']); ?>if(document.body.stat) document.body.stat('register_succeed', 'member.php?mod=<?=$_G['setting']['regname']?>');
display('main_regmessaqge');
display('layer_reg');
display('layer_regmessage');
<? if($_G['setting']['regverify'] == 1) { ?>
$('messageleft1').innerHTML = '<p>感谢你注册 <? echo addslashes($_G['setting']['bbname']); ?></p><p>你的帐号处于非激活状态，请收取邮件激活你的帐号</p>';
$('messageright1').innerHTML = '<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">个人中心</a><br />如果你没有收到我们发送的系统邮件，请进入个人中心点击“重新验证 Email”或在“密码和安全问题”中更换另外一个 Email 地址。注意：在完成激活之前，根据管理员设置，你将只能以待验证会员的身份访问论坛，你可能不能进行发帖等操作。激活成功后，上述限制将自动取消。';
setTimeout("window.location.href='home.php?mod=spacecp&ac=profile&op=password'", <?=$mrefreshtime?>);
<? } elseif($_G['setting']['regverify'] == 2) { ?>
$('messageleft1').innerHTML = '<p>感谢你注册 <? echo addslashes($_G['setting']['bbname']); ?></p><p>请等待管理员审核你的帐号</p>';
$('messageright1').innerHTML = '<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">个人中心</a>';
setTimeout("window.location.href='home.php?mod=spacecp&ac=profile&op=password'", <?=$mrefreshtime?>);
<? } else { ?>
$('messageleft1').innerHTML = '<p>感谢你注册 <? echo addslashes($_G['setting']['bbname']); ?></p>';<?php $dreferer = str_replace('&amp;', '&', dreferer()); if($dreferer) { ?>
$('messageright1').innerHTML = '<a href="javascript:;" onclick="location.href=\'<?=$dreferer?>\';">如果页面没有响应，请点这里刷新</a>';
setTimeout('location.href=\'<?=$dreferer?>\'', <?=$mrefreshtime?>);
<? } else { ?>
$('messageright1').innerHTML = '<a href="javascript:;" onclick="location.reload()">如果页面没有响应，请点这里刷新</a>';
<? } } ?>
setMenuPosition('fwin_register', 'fwin_register', '00');
</script>
<? } else { if(empty($_G['gp_infloat'])) { ?>
<div id="ct" class="wp cl">
<div class="mn">
<? } ?>
<div class="blr" id="main_regmessaqge">
<h3 id="layer_reginfo_t" class="flb"<? if($bbrules && $bbrulesforce) { ?> style="display: none"<? } ?>>
<em id="returnmessage4"><? if(!empty($_G['gp_infloat'])) { if($_G['gp_action'] != 'activation') { ?><?=$_G['setting']['reglinkname']?><? } else { ?>你的帐号需要激活<? } } ?></em>
<span>
<? if(!empty($_G['gp_infloat'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('register')" title="关闭">关闭</a><? } ?>
</span>
</h3>
<div id="layer_bbrule"<? if(!($bbrules && $bbrulesforce)) { ?> style="display: none"<? } ?>>
<h3 class="flb"><em><?=$_G['setting']['bbname']?> 网站服务条款</em>
<span>
<? if(!empty($_G['gp_infloat'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('register')" title="关闭">关闭</a><? } ?>
</span>
</h3>
<div class="c cl<? if(!empty($_G['gp_infloat'])) { ?> floatwrap<? } ?>"><?=$bbrulestxt?></div>
<p class="fsb pns cl<? if(empty($_G['gp_infloat'])) { ?> hm<? } ?>">
<button class="pn pnc" onclick="$('agreebbrule').checked = true;display('layer_reg');display('layer_reginfo_t');display('layer_reginfo_b');display('layer_bbrule');<? if($_G['setting']['sitemessage']['register'] && ($bbrules && $bbrulesforce)) { ?>showRegprompt();<? } ?>"><span>同意</span></button>			
<button class="pn pnc" onclick="$('agreebbrule').checked = false;display('layer_reg');display('layer_reginfo_t');display('layer_reginfo_b');display('layer_bbrule');<? if($_G['setting']['sitemessage']['register'] && ($bbrules && $bbrulesforce)) { ?>showRegprompt();<? } ?>"><span>不同意</span></button>
</p>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['register_top'])) echo $_G['setting']['pluginhooks']['register_top']; ?>
<form method="post" autocomplete="off" name="register" id="registerform" enctype="multipart/form-data" onsubmit="ajaxpost('registerform', 'returnmessage4', 'returnmessage4', 'onerror');return false;" action="member.php?mod=<?=$_G['setting']['regname']?>">
<div id="layer_reg" class="c cl"<? if($bbrules && $bbrulesforce) { ?> style="display: none"<? } ?>>
<input type="hidden" name="regsubmit" value="yes" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" /><?php $dreferer = str_replace('&amp;', '&', dreferer()); ?><input type="hidden" name="referer" value="<?=$dreferer?>" />
<? if(!empty($_G['gp_infloat'])) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="activationauth" value="<? if($_G['gp_action'] == 'activation') { ?><?=$activationauth?><? } ?>" />
<div class="lgfm">
<div id="reginfo_a">
<span id="activation_hidden"<? if($_G['gp_action'] == 'activation') { ?> style="display:none"<? } ?>>
<? if($invite) { ?>
<span>
<label><em>推荐人:</em><a href="home.php?mod=space&amp;uid=<?=$invite['uid']?>" target="_blank"><?=$invite['username']?></a></label>
</span>
<? } ?>
<label><em>用户名:</em><input type="text" id="username" name="<?=$_G['setting']['reginput']['username']?>" autocomplete="off" size="25" maxlength="15" value="" onBlur="checkusername()" tabindex="1" class="txt" /> *</label>
<label><em>密码:</em><input type="password" name="<?=$_G['setting']['reginput']['password']?>" size="25" id="password" onkeypress="detectCapsLock(event, this)" tabindex="1" class="txt" /> *</label>
<label><em>确认密码:</em><input type="password" name="<?=$_G['setting']['reginput']['password2']?>" size="25" id="password2" onkeypress="detectCapsLock(event, this)" tabindex="1" value="" class="txt" /> *</label>
<label><em>Email:</em><input type="text" name="<?=$_G['setting']['reginput']['email']?>" autocomplete="off" size="25" id="email" onBlur="checkemail()" tabindex="1" class="txt" /> *</label>
</span>
<? if($_G['gp_action'] == 'activation') { ?>
<span id="activation_user">
<label><em>用户名:</em><?=$username?></label>
</span>
<? } if(empty($invite) && ($_G['setting']['regstatus'] == 2 || $_G['setting']['regstatus'] == 3)) { ?>
<label class="xs2"><em>邀请码:</em><input type="text" name="invitecode" autocomplete="off" size="25" id="invitecode"<? if($_G['setting']['regstatus'] == 2) { ?> onBlur="checkinvite()"<? } ?> tabindex="1" class="txt" /> <? if($_G['setting']['regstatus'] == 2) { ?> *<? } ?></label>
*为必填项，如果没有邀请码请留空
<? } if($secqaacheck || $seccodecheck) { ?>
<div class="rgs"><?
$sectpl = <<<EOF
<label><em><sec>: </em><sec> *</label><label><em style="height:30px">&nbsp;</em><sec></label>
EOF;
?><?php $sechash = 'S'.random(4);
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
<?php if(!empty($_G['setting']['pluginhooks']['register_input'])) echo $_G['setting']['pluginhooks']['register_input']; ?>
</div>
<div id="reginfo_b"<? if(!empty($_G['gp_infloat'])) { ?> style="display:none"<? } ?>>
<? if($_G['setting']['regverify'] == 2) { ?>
<label><em>注册原因:</em><input name="regmessage" autocomplete="off" size="25" tabindex="1" class="txt" /> *</label>
<p class="xg1">您填写的注册原因会被当作申请注册的重要参考依据，请务必认真填写，我们会认真审核。</p>
<? } if(is_array($_G['cache']['fields_register'])) foreach($_G['cache']['fields_register'] as $field) { if($htmls[$field['fieldid']]) { ?>
<div class="reginfo"<? if($field['description']) { ?> title="<? echo htmlspecialchars($field['description']); ?>"<? } ?>><em><?=$field['title']?>:</em><div id="td_<?=$field['fieldid']?>" class="reg_c"><?=$htmls[$field['fieldid']]?></div><? if($field['required']) { ?>&nbsp;*<? } ?></div>
<? } } ?>
</div>
</div>
<div class="lgf"<? if($_G['gp_action'] == 'activation') { ?> style="margin-top: 10px;"<? } ?>>
<h4>已有帐号？<a href="member.php?mod=logging&amp;action=login" onclick="hideWindow('register');showWindow('login', this.href);return false;">现在登录</a></h4>
<? if($_G['gp_action'] == 'activation') { ?>
<p>放弃激活，<a href="javascript:;" onclick="$('registerform').activationauth.value='',$('activation_hidden').style.display='',$('activation_user').style.display='none'">现在<?=$_G['setting']['reglinkname']?></a></p>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['register_side'])) echo $_G['setting']['pluginhooks']['register_side']; ?>
</div>
</div>
<p id="layer_reginfo_b" class="fsb pns cl"<? if($bbrules && $bbrulesforce) { ?> style="display: none"<? } ?>>
<? if($_G['setting']['sitemessage']['register']) { ?><a href="javascript:;" id="custominfo_register" class="y"><img src="<?=IMGDIR?>/info_small.gif" alt="帮助" /></a><? } ?>
<span id="reginfo_a_btn">
<? if($_G['gp_action'] != 'activation') { ?><em>&nbsp;</em><? } if(($field || $_G['setting']['regverify'] == 2) && !empty($_G['gp_infloat'])) { ?>
<button type="button" class="pn pnc" tabindex="1" onclick="regstep('reginfo_a','reginfo_b'); return false;"><span>下一步</span></button>
</span>
<span id="reginfo_b_btn" style="display:none">
<button class="pn pn" tabindex="1" type="button" onclick="regstep('reginfo_b','reginfo_a'); return false;"><span>上一步</span></button>
<? } ?>
<button class="pn pnc" id="registerformsubmit" type="submit" name="regsubmit" value="true" tabindex="1"><span><? if($_G['gp_action'] == 'activation') { ?>激活<? } else { ?>提交<? } ?></span></button>
<? if($bbrules) { ?>
<input type="checkbox" class="pc" name="agreebbrule" value="<?=$bbrulehash?>" id="agreebbrule" checked="checked" /> <label for="agreebbrule">同意<a href="javascript:;" onclick="display('layer_reg');display('layer_reginfo_t');display('layer_reginfo_b');display('layer_bbrule');">网站服务条款</a></label>
<? } ?>
</span>
</p>
</form>
</div>
<div id="layer_regmessage"<? if(empty($_G['gp_infloat'])) { ?> class="f_c blr nfl"<? } ?> style="display: none">
<h3 class="flb">
<? if(!empty($_G['gp_infloat'])) { ?>
<em>用户登录</em>
<span><a href="javascript:;" class="flbc" onclick="hideWindow('login')" title="关闭">关闭</a></span>
<? } ?>
</h3>
<div class="c"><div class="alert_right">
<div id="messageleft1"></div>
<p class="alert_btnleft" id="messageright1"></p>
</div>
</div>

<script type="text/javascript" reload="1">
hideWindow('login');
<? if($_G['gp_action'] != 'activation') { ?>
function initinput_register() {
<? if(!($bbrules && $bbrulesforce)) { ?>
$('registerform').username.focus();
<? } ?>
}
if(BROWSER.ie && BROWSER.ie < 7) {
setTimeout('initinput_register()', 500);
} else {
initinput_register();
}
<? } if($_G['setting']['sitemessage']['register']) { ?>
function showRegprompt() {
showPrompt('custominfo_register', 'mouseover', '<? echo trim($_G['setting']['sitemessage']['register'][array_rand($_G['setting']['sitemessage']['register'])]); ?>', <?=$_G['setting']['sitemessage']['time']?>);
}
<? if(!($bbrules && $bbrulesforce)) { ?>
showRegprompt();
<? } } ?>

var profile_username_toolong = '用户名超过 15 个字符';
var profile_username_tooshort = '用户名小于3个字符';
var doublee = parseInt('<?=$_G['setting']['doublee']?>');
var lastusername = lastpassword = lastemail = lastinvitecode = '';

function errorhandle_register(msg, values) {
$('returnmessage4').className = msg == '<? echo addslashes($_G['setting']['reglinkname']); ?>' ? '' : 'onerror';
$('returnmessage4').innerHTML = msg;
}

function checkusername() {
var username = trim($('username').value);
if(username == '' || username == lastusername) {
return;
} else {
lastusername = username;
}
var unlen = username.replace(/[^\x00-\xff]/g, "**").length;
if(unlen < 3 || unlen > 15) {
errorhandle_register(unlen < 3 ? profile_username_tooshort : profile_username_toolong, {'key':1});
return;
}
ajaxget('forum.php?mod=ajax&infloat=register&handlekey=register&action=checkusername&username=' + (BROWSER.ie && document.charset == 'utf-8' ? encodeURIComponent(username) : username), 'returnmessage4');
}

function checkemail() {
var email = trim($('email').value);
if(email == '' || email == lastemail) {
return;
} else {
lastemail = email;
}
ajaxget('forum.php?mod=ajax&infloat=register&handlekey=register&action=checkemail&email=' + email, 'returnmessage4');
}

function checkinvite() {
var invitecode = trim($('invitecode').value);
if(invitecode == '' || invitecode == lastinvitecode) {
return;
} else {
lastinvitecode = invitecode;
}
ajaxget('forum.php?mod=ajax&infloat=register&handlekey=register&action=checkinvitecode&invitecode=' + invitecode, 'returnmessage4');	
}

function trim(str) {
return str.replace(/^\s*(.*?)[\s\n]*$/g, '$1');
}
<? if(($field && !empty($_G['gp_infloat'])) || $_G['setting']['regverify'] == 2) { ?>
function regstep(obja,objb){
$(obja).style.display = $(obja+'_btn').style.display = 'none';
$(objb).style.display = $(objb+'_btn').style.display = '';
}
<? } ?>
//note 填写生日
function showbirthday(){
var el = $('birthday');
var birthday = el.value;
el.length=0;
el.options.add(new Option('日', ''));
for(var i=0;i<28;i++){
el.options.add(new Option(i+1, i+1));
}
if($('birthmonth').value!="2"){
el.options.add(new Option(29, 29));
el.options.add(new Option(30, 30));
switch($('birthmonth').value){
case "1":
case "3":
case "5":
case "7":
case "8":
case "10":
case "12":{
el.options.add(new Option(31, 31));
}
}
} else if($('birthyear').value!="") {
var nbirthyear=$('birthyear').value;
if(nbirthyear%400==0 || (nbirthyear%4==0 && nbirthyear%100!=0)) el.options.add(new Option(29, 29));
}
el.value = birthday;
}
</script>
<? } ?><?php updatesession(); if(empty($_G['gp_infloat'])) { ?>
</div></div>
</div>
<? } include template('common/footer'); ?>