<?php $this->display('header');?>
<div id="main">
  <div id="left" class="guide">
    <ul class="f-14">
      <li class="white">运行环境检测</li>
      <li class="white">数据库设置</li>
      <li id="g-3">站点设置</li>
      <li>扩展选择</li>
      <li>安装完成</li>
    </ul>
  </div>
  <div id="right" class="p-b">
    <!--站点设置 begin-->
    <div class="box-2">
      <h1 class="blue mar-t-5">创建数据库配置,搭建网站数据存储平台</h1>
      <p class="gray">请输入网站管理员信息，网站名，路径等基本信息</p></div>
      <form method="post" action="javascirpt:;">
	      <table cellpadding="0" cellspacing="0" class="mar-t-12 table-form" >
	        <caption>网站信息</caption>
	        <tr>
	          <th class="t-r f-n" width="80">网站名</th>
	          <td><input name="seotitle" type="text" value="<?php echo $seotitle?>" /></td>
	        </tr>
	        <tr>
	          <th class="t-r f-n">创始人帐号</th>
	          <td><input name="username" type="text" value="<?php echo $username;?>"/></td>
	        </tr>
	        <tr>
	          <th class="t-r f-n">密码</th>
	          <td><input style="width:149px;" name="password" type="password" value="<?php echo $password;?>" /> 默认密码为：<?php echo $password;?></td>
	        </tr>
	        <tr>
	          <th class="t-r f-n">确认密码</th>
	          <td><input style="width:149px;" name="repassword" type="password" value="<?php echo $password;?>" /></td>
	        </tr>
	        <tr>
	          <th class="t-r f-n">创始人邮箱</th>
	          <td><input name="email" type="text" value="<?php echo $email;?>"/></td>
	        </tr>
	        <tr>
	          <th class="t-r f-n">系统密钥</th>
	          <td>
	          	<input id="authkey" name="authkey" type="text" value="<?php echo $authkey?>" />
	          	<input id="createKey" type="button" value="随机生成"/>
	          	<a class="help" title="每个网站拥有不同的密钥以避免Cookie欺骗等危险">?</a>
	          </td>
	        </tr>
	      </table>
      </form>
    <!--站点设置 end-->
    <div id="btn-area">
	    <span class="f-l dis-b w-80">
	    	<a href="?action=step2" class="btn-back">返回上一步</a>
	    </span>
	    <span class="f-r dis-b w-80 mar-t-10">
		    <a id="submit" href="javascript:;" class="btn">下一步</a>
	    </span>
    </div>
  </div>
  <div class="clear"></div>
</div>
<div id="foot">Copyright &copy; Cmstop.com All Rights Reserved. <strong>思拓合众</strong> 版权所有 <a href="#" class="yellow">京ICP备09082107号</a></div>
</body>
</html>
<script>
$(function (){
	$('#createKey').click(function (){
		$.get('?action=authkey&'+new Date(), function (key){ 
			$('#authkey').val(key);
		});
	});
	
	$('input[name=password]').focus();
	$('#submit').click(function (){
		if(!$('input[name=seotitle]').val())
		{
			alert('请输入网站名');
			return $('input[name=seotitle]').focus();
		}
		if(!$('input[name=password]').val())
		{
			alert('请输入密码');
			return $('input[name=password]').focus();
		}
		if($('input[name=password]').val() != $('input[name=repassword]').val())
		{
			alert('两次输入的密码不一致');
			return $('input[name=repassword]').focus();
		}
		if(!$('input[name=authkey]').val())
		{
			alert('系统密钥不能为空');
			return $('input[name=authkey]').focus();
		}
		$.post("?action=siteinfo", $('form').serialize(), function (data){
			if(data == 1) {
				location.href = '?action=step4';
			}else{
				alert('保存错误：' + data);
			}
		});
	});
})
</script>