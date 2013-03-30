<?php /* Smarty version 2.6.26, created on 2012-09-11 15:06:33
         compiled from commom/social_login.html */ ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?php echo $this->_tpl_vars['pcms_url']; ?>
statics/css/huoshow_home.css" rel="stylesheet" />
<script src="<?php echo $this->_tpl_vars['pcms_url']; ?>
statics/js/jquery.min.js"></script>
<script src="<?php echo $this->_tpl_vars['pcms_url']; ?>
statics/js/huoshow_common.js"></script>
<div id='overlay'></div>
<div id='bind_account'>
	<h3><?php if ($this->_tpl_vars['s_source'] == 1): ?>豆瓣网<?php elseif ($this->_tpl_vars['s_source'] == 2): ?>新浪网<?php elseif ($this->_tpl_vars['s_source'] == 3): ?>QQ网<?php else: ?>人人网<?php endif; ?>授权成功，请绑定你的火秀账号 <a href='javascript:;' hidefocus='true' id='close_bind_box'>X</a></h3>
	<dl>
		<dt class='bind_account selected'>我有火秀账号</dt>
		<dd>
			<form id="bind_account_form" class="bind_account_form" method="POST" action="/member.php?mod=logging&action=login&loginsubmit=yes&handlekey=login&floatlogin=yes&loginfield=username&questionid=0&answer=&loginsubmit=yes">
				<input type="hidden" name="s_binding" value="binding"/>
				<div><label for='account_email'>用户名：</label><input type="text" name="username" class='account_email' id="account_email" /></div>
				<div><label for='account_psw'>密&nbsp;&nbsp;码：</label><input type="password" name="password" class='text account_psw' id="account_psw" /></div>
				<div><button type="submit" name="loginsubmit" value="true" class="bind_account_submit">登录绑定</button></div>
				<p>绑定火秀已有账号，即可同时使用你的第三方网站账号登录火秀网<p>
			</form>
		</dd>
		<dt class='bind_new_account'>创建火秀账号</dt>
		<dd class='fn_hide'>
			<form method="post" autocomplete="off" name="register" id="bind_new_account_form" class="bind_new_account_form" action="/member.php?mod=register">
				<input type="hidden" name="s_uid" value="<?php echo $this->_tpl_vars['s_uid']; ?>
"/>
				<input type="hidden" name="s_source" value="<?php echo $this->_tpl_vars['s_source']; ?>
"/>
				<input type="hidden" name="s_binding" value="binding"/>
				<input type="hidden" name="regsubmit" value="yes" />
				<input type="hidden" name="inajax" value="1"/>
				<input type="hidden" name="formhash" value="<?php echo $this->_tpl_vars['formhash']; ?>
" />
				<input type="hidden" name="activationauth" value="0" />
				<input type="hidden" name="invitecode" value="0" />
				<input type="hidden" name="referer" value="0" />
				<div id='error_tips' style='color:red;height:15px;text-align:center;'></div>
				<div><label for='username'>用户名：</label><input id="username" type="text" tabindex="1" onblur="checkusername(this)" value="<?php echo $this->_tpl_vars['s_name']; ?>
" autocomplete="off" name="username" class="new_account_email"></div>
				<div><label for='new_account_email'>昵&nbsp;&nbsp;称：</label><input type="text" tabindex="1" value="<?php echo $this->_tpl_vars['s_name']; ?>
" readonly="readonly" autocomplete="off" name="nickname" class="new_account_email"></div>
				<div><label for='email'>Email：</label><input type="text" name="email" autocomplete="off" size="25" id="email" class="new_account_email" /></div>
				<div><label for='new_account_psw'>密&nbsp;&nbsp;码：</label><input type="password" name="password" class='text new_account_psw' id="new_account_psw" /></div>
				<div><label for='new_account_psw2'>确认密码：</label><input type="password" name="password2" class='text new_account_psw2' id="new_account_psw2" /></div>
				<div><button type="submit" name="regsubmit" class="bind_new_account_submit" value="true">创建绑定</button></div>
				<div class='bind_agree'><input type="checkbox" checked='ckecked'name="bind_agree" class='ckbox bind_agree' id="bind_agree" /><label for='bind_agree' class='bind_agree'>我已阅读并同意火秀网注册协议及版权声明</label></div>
				<p>绑定火秀已有账号，即可同时使用你的第三方网站账号登录火秀网<p>
			</form>
		</dd>
</div>
<?php echo '
<script type="text/javascript" reload="1">
	var profile_username_toolong = \'用户名超过 15 个字符\';
	var profile_username_tooshort = \'用户名小于3个字符\';
	var doublee = parseInt(\'1\');
	var lastusername = lastpassword = lastemail = lastinvitecode = \'\';
	var $error_tips = $(\'#error_tips\');

	function show_tips(msg) {
		msg = $.trim(msg);
		if(msg == \'注册\' || msg == \'\'){
			$error_tips.removeClass(\'invalid\').css(\'opacity\', 0);
		}else{
			$error_tips.html(msg).addClass(\'invalid\').css(\'opacity\', 1);
		}
	}

	function checkusername(ths) {
		var username = $.trim($(\'#username\').val());
		/*if(username == \'\' || username == lastusername) {
			return;
		} else {
			lastusername = username;
		}*/
		var unlen = username.replace(/[^\\x00-\\xff]/g, "**").length;
		if(unlen < 3) {
			show_tips(profile_username_tooshort);
			return;
		}else if(unlen > 15){
			show_tips(profile_username_toolong);
			return;
		}else{
			show_tips(\'\');
		}

		if(username == \'\'){
			show_tips(\'用户名不能为空\');
		}else{
			$.get(\'/forum.php?mod=ajax&infloat=register&handlekey=register&action=checkusername&username=\' + ($.browser.msie && document.charset == \'utf-8\' ? encodeURIComponent(username) : username), function(d){
				show_tips($(d).find(\'.alert_info\').text());
			});
		}
	}

	$(\'#email\').blur(function(){
		var email = $.trim($(\'#email\').val());
		/*if(email == \'\' || email == lastemail) {
			return;
		} else {
			lastemail = email;
		}*/
		if(email == \'\'){
			show_tips(\'Email 不能为空\');
		}else{
			//ajaxget(\'forum.php?mod=ajax&infloat=register&handlekey=register&action=checkemail&email=\' + email, \'returnmessage4\');
			$.get(\'/forum.php?mod=ajax&infloat=register&handlekey=register&action=checkemail&email=\' + email, function(d){
				show_tips($(d).find(\'.alert_info\').text());
			});
		}
	});

	$(\'#new_account_psw\').blur(function(){
		if(this.value == \'\'){
			show_tips(\'请输入密码\');
		}else if(this.value.length < 6){
			show_tips(\'密码至少 6 位\');
		}else{
			show_tips(\'\');
		}
	});

	$(\'#new_account_psw2\').blur(function(){
		if(this.value == \'\'){
			show_tips(\'请输入确认密码\');
		}else if(this.value != $(\'#new_account_psw\').val()){
			show_tips(\'两次输入的密码不一致\');
		}else{
			show_tips(\'\');
		}
	});

	$(\'#bind_new_account_form\').submit(function(){
		//$(\'#username\').blur();
		if($error_tips.hasClass(\'invalid\')){
			return false;
		}else{
			$(\'#username\').blur();
			$(\'#email\').blur();
			if($error_tips.hasClass(\'invalid\')) return false;
			$(\'#new_account_psw\').blur();
			if($error_tips.hasClass(\'invalid\')) return false;
			$(\'#new_account_psw2\').blur();
			if($error_tips.hasClass(\'invalid\')) return false;
		}
	});
</script>
'; ?>