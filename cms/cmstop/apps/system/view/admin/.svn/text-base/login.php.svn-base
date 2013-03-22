<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$CONFIG['charset']?>" />
<title><?=$SETTING['sitename']?>_网站后台登录</title>
<link rel="stylesheet" type="text/css" href="css/admin.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/validator/style.css" />
<style type="text/css">
body {background-color:#06c;text-align:center;}
div, ul, li {margin:0;padding:0;}
#logindiv {background:url(css/images/bg_login.jpg) no-repeat 0 0;height:229px;width:490px;color:#fff;font-size:12px;margin:150px auto;	padding:1px; position:relative;}
ul {margin-left:200px;margin-top:56px;}
ul li {list-style:none;	text-align:left;height:30px;line-height:30px;}
.btn_login {background:url(css/images/bg.gif) no-repeat -42px -68px; height:24px; width:64px;border:0;	cursor:pointer;	text-align:left; margin:0 0 0 53px;}
.w_120 {width:120px;}
</style>
<script type="text/javascript" src="<?php echo IMG_URL;?>js/lib/jquery.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL;?>js/config.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL;?>js/cmstop.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL;?>js/lib/cmstop.validator.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL;?>js/lib/jquery.cookie.js"></script>
<script type="text/javascript">
$(function(){
	var url = '/admin/?app=system&controller=admin&action=login';
	// ajax或iframe方式
	if (self != top) {
		top.location.href = url;
	}
	// IE7,IE8下的showModalDialog
	else if (window.dialogArguments) {
		if (window.dialogArguments.top) {
			window.dialogArguments.top.location.href = url;
		} else {
			window.dialogArguments.location.href = url;
		}
		self.close();
	}
	// window.open及火狐下的showModalDialog
	else if (!$.browser.msie && opener) {
		opener.location.href = url;
	}
	
	function dmsg(msg){
		var win = $(window);
		$(document.body).append('<div style="height:'+win.height()+'px;width:'+win.width()+';position:absolute;top:0;left:0;background-color:#ccc;filter:alpha(opacity=60);opacity:0.6;z-index:10"></div>')
		.append('<div style="border:5px solid #FED669;background-color:#FFFDD7;height:100px;width:400px;position:absolute;top:50%;margin-top:-120px;margin-left:-200px;font-size:14px;line-height:100px;z-index:12">'+msg+'</div>');
		$('input').attr('disabled', 'disabled');
	}
	var ieversion = parseInt((/.+msie[\/: ]([\d.]+)/i.exec(navigator.userAgent) || {1:0})[1]);
	if (ieversion && ieversion < 7) {
		dmsg('您当前使用的浏览器版本(IE6)过低，请升级至IE7及以上版本');
	} else if (!$.support.boxModel) {
		dmsg('您当前使用了Quirks模式，请切换到标准模式');
	}
	
	var rememberusername = $.cookie(COOKIE_PRE+'rememberusername');
	var username = $('input[name=username]');
	var password = $('input[name=password]');
	var seccode = $('#seccode');
	
	if (rememberusername !== null)
	{
		username.val(rememberusername);
		password.focus();
	}
	else
	{
		username.focus();
	}
	
	$('#login').submit(function (){
		if(!username.val())
		{
			ct.tips('请输入用户名');
			$('.ct_tips').css('top',160);
			return username.focus();
		}
		if(!password.val())
		{
			ct.tips('请输入密码');
			$('.ct_tips').css('top',160);
			return password.focus();
		}
		if(!seccode.val())
		{
			ct.tips('请输入验证码');
			$('.ct_tips').css('top',160);
			return seccode.focus();
		}
		$.post(url, $(this).serialize(), function (rs){
			if (rs.state)
			{
				if (rs.ucsynlogin) {
					for (var i=0,l=rs.ucsynlogin.length;i<l;i++) {
						if(typeof rs.ucsynlogin[i] == 'string') {
							$.getScript(rs.ucsynlogin[i]);
						}
					}
				}
				setTimeout(function (){
					window.location.href = '<?=$refer?>';
				}, 500);
			}else{
				ct.tips(rs.error, 'error');
				$('.ct_tips').css('top',160);
				$('#seccode_image').click();
				seccode.val('');
				if(rs.error.indexOf('不存在') > 0) {
					username.select().focus();
				}
				if(rs.error == '密码错误') {
					password.select().focus();
				}
				if(rs.error == '验证码不正确') {
					seccode.focus();
				}
			}
		}, 'json');
	});
});
</script>
</head>
<body>
<div id="logindiv">
  <ul>
  <form name="login" id="login" class="validator" action="javascript:;" method="POST">
    <li>用户名：
      <label>
      <input type="text" name="username" size="20" />
      </label>
    </li>
    <li>密　码：
      <label>
      <input type="password" name="password" size="20" />
      </label>
    </li>
    <li>验证码：
      <label>
        <input type="text" name="seccode" id="seccode" size="4" maxlength="4" style="ime-mode:disabled;"/> <img id="seccode_image" src="?app=system&controller=seccode&action=image" onclick="this.src='?app=system&controller=seccode&action=image&id='+Math.random()*5;" style="cursor:pointer;" alt="验证码,看不清楚?请点击刷新验证码" align="absmiddle"/>
      </label>
    </li>
    <li>
      <label>
        <input type="submit" class="btn_login" value=""/>
      </label>
    </li>
   </form>
  </ul>
</div>
</body>
</html>
