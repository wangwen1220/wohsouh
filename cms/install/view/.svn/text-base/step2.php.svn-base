<?php $this->display('header');?>
<div id="main">
  <div id="left" class="guide">
    <ul class="f-14">
      <li class="white">运行环境检测</li>
      <li id="g-2">数据库设置</li>
      <li>站点设置</li>
      <li>扩展选择</li>
      <li>安装完成</li>
    </ul>
  </div>
  <div id="right" class="p-b">
    <!--数据库设置 begin-->
    <div class="box-2">
      <h1 class="blue mar-t-5">创建数据库配置,搭建网站数据存储平台</h1>
      <p class="gray">请输入网站管理员信息，网站名，路径等基请填入您的网站数据库连接参数。请填入您的网站数据库连接参数。
请填入您的网站数据库连接参数。本信息</p></div>

		<form method="post" action="javascirpt:;">
			<input type="hidden" name="charset" value="<?php echo $charset?>"/>
			<input type="hidden" name="driver" value="<?php echo $driver?>"/>
			<table cellpadding="0" cellspacing="0" class="mar-t-12 table-form" >
				<caption>数据库设置</caption>
			<tr>
				<th width="80" class="t-r f-n">主机</th>
				<td>
					<input name="host" type="text" value="<?php echo $host?>" />
					<a class="help" title="如果数据库和程序不在同一服务器请填IP">?</a>
				</td>
			</tr>
			<tr>
				<th class="t-r f-n">用户名</th>
				<td><input name="username" type="text" value="<?php echo $username?>" /></td>
			</tr>
			<tr>
				<th class="t-r f-n">密码</th>
				<td><input name="password" type="password" value="<?php echo $password?>" /></td>
			</tr>
			<tr>
				<th class="t-r f-n">端口</th>
				<td>
					<input name="port" type="text" value="<?php echo $port?>" />
				</td>
			</tr>
			<tr>
				<th class="t-r f-n">数据库名</th>
				<td><input name="dbname" type="text" value="<?php echo $dbname?>" /></td>
			</tr>
			<tr>
				<th class="t-r f-n">表前辍</th>
				<td>
					<input name="prefix" type="text" value="<?php echo $prefix?>" />
					<a class="help" title="如果您要安装多个cmstop，请修改前辍">?</a>
				</td>
			</tr>
			<tr>
				<th class="t-r f-n">持久连接</th>
				<td>
					<input type="radio" value="1" name="pconnect" class="radio_style"<?php if($pconnect == 1) echo ' checked="true"';?> />是&nbsp;&nbsp;
					<input type="radio" value="0" name="pconnect" class="radio_style"<?php if($pconnect == 0) echo ' checked="true"';?> />否
					<a class="help" title="如果启用持久连接，则数据库连接上后不释放，保存一直连接状态，多占用资源，但提升效率">?</a>
				</td>
			</tr>
			</table>
			<button style="margin: 6px 0 18px 98px;" type="button" id="test">连接测试</button>
		    <div id="btn-area">
				<span class="f-l dis-b w-80">
					<a href="?action=step1" class="btn-back">返回上一步</a>
				</span>
				<span class="f-r dis-b w-80 mar-t-10">
					<a id="submit" href="javascript:;" class="btn">下一步</a>
				</span>
		    </div>
    	</form>
  </div>
  <div class="clear"></div>
</div>
<div id="foot">Copyright &copy; Cmstop.com All Rights Reserved. <strong>思拓合众</strong> 版权所有 <a href="#" class="yellow">京ICP备09082107号</a></div>
</body>
</html>

<script>
$(function (){
	$('input[name=password]').focus();
	$('#test').click(test);
	$('#submit').click(function (){
		if(!$('input[name=username]').val())
		{
			alert('请输入数据库用户名');
			return $('input[name=username]').focus();
		}
		test('next');
	});
});
/**
 * 1。测试通过
 * 2。连接不上mysql
 * 3。无此数据库
 * 4。数据表冲突
 * 5。其他
 */
function test(action)
{
	$.post("?action=test", $('form').serialize(), function (data){
		if(data == 1) {
			if(action == 'next') {
				location.href = '?action=step3';
			}else{
				alert('连接成功');
			}
		} else if(data == 2) {
			alert('连接mysql失败');
		} else if(data == 3) {
			var dbname = $('input[name=dbname]').val();
			if (confirm('没有发现'+dbname+'数据库, 是否自动创建?')) {
				location.href = '?action=step3';
			}
		} else if(data == 4) {
			if (confirm('数据库中存在与CmsTop同名的表，确定覆盖安装吗？\n\n此操作会丢失数据！')) {
				location.href = '?action=step3';
			}
		} else if(data == 5) {
			var dbname = $('input[name=dbname]').val();
			alert('不存在数据库'+dbname+'，且无权限创建数据库');
		} else if(data == 6) {
			var dbname = $('input[name=dbname]').val();
			alert('无权限在数据库'+dbname+'中创建数据表');
		} else if(data == 7) {
			alert('数据库不支持InnoDB，请检查MySQL版本与配置');
		} else {
			alert('连接失败');
		}
	});
}
</script>