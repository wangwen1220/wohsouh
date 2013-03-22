<?php $this->display('header');?>
<div id="main">
  <div id="left" class="guide">
    <ul class="f-14">
      <li id="g-1">运行环境检测</li>
      <li>数据库设置</li>
      <li>站点设置</li>
      <li>扩展选择</li>
      <li>安装完成</li>
    </ul>
  </div>
  <div id="right" class="p-b">
    <!--运行环境检测 begin-->
    <div class="box-2">
      <h1 class="blue mar-t-5">检测您的服务器环境是否可以顺利安装CMSTOP</h1>
    </div>
    <div id="tableDiv">
		<table width="98%" cellpadding="0" cellspacing="0" class="table-list">
			<tr>
				<th>检查项目</th>
				<th>当前配置</th>
				<th>推荐配置</th>
				<th width="60"></th>
			</tr>
			<tbody id="envs">
				<?php foreach ($env AS $r): ?>
				<tr>
					<td class="f-b"><?php echo $r['text'];?></td>
					<td><?php echo $r['current'];?></td>
					<td><?php echo $r['recommend'];?></td>
					<td><?php echo $r['rs'];?></td>
				</tr>
				<?php endforeach; ?>
				<tr by="ssi/index.shtml">
					<td class="f-b">服务器端包含（ssi）</td>
					<td><span style="color:orange">正在探测...</span></td>
					<td>必须开启</td>
					<td></td>
				</tr>
				<tr by="ssi/">
					<td class="f-b">index.shtml索引页</td>
					<td><span style="color:orange">正在探测...</span></td>
					<td>必须开启</td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table width="98%" cellpadding="0" cellspacing="0" class="table-list">
			<tr>
				<th>目录检测</th>
				<th>当前状态</th>
				<th width="60"></th>
			</tr>
			<?php
			foreach ($list as $k=>$v): 
			?>
			<tr class="">
				<td class="f-b"><?php echo $v['pos'];?></td>
				<td><?php if($v['is_writable']): ?><font color="green">可写</font><?php else:?><font color="red">不可写</font><?php endif;?></td>
				<td><?php echo $v['recommend']; ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
    <!--运行环境检测 end-->
    <div id="btn-area"><span class="f-l w-80 dis-b"><a href="?action=start" class="btn-back">返回上一步</a></span><span  class="f-l dis-b"><p class="orange" style="width:480px;margin:12px 0 0 20px;">
		<?php
		if ($pass) {
			echo '恭喜！您的服务器可以运行CmsTop。';
		} else {
			echo '您的服务器环境无法正常运行CmsTop，请先修改配置';
		}
		?>
	</p></span>
			<span class="f-r dis-b w-80 mar-t-10">
	<a href="<?php echo $pass?'?action=step2':"javascript:alert('您的服务器环境不支持，请先配置正确好服务器');"?>" class="btn">下一步</a></span></div>
  </div>
  <div class="clear"></div>
</div>
<div id="foot">Copyright &copy; Cmstop.com All Rights Reserved. <strong>思拓合众</strong> 版权所有 <a href="#" class="green">京ICP备09082107号</a></div>
<script>
$('#envs>tr[by]').each(function(){
	var t = this;
	$.get(this.getAttribute('by'),function(text){
		if (text == 'pass') {
			t.cells[1].innerHTML = '支持';
			t.cells[3].innerHTML = '<span style="color:green">&#x221A;</span>';
		} else {
			t.cells[1].innerHTML = '不支持';
			t.cells[3].innerHTML = '<span style="color:red">&#x00D7;</span>';
		}
	});
});
</script>
</body>
</html>
