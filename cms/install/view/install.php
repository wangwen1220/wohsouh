<style>
.suc{padding-left:150px; padding: 110px 0 70px 40px;}
 .suc h1{color:#f30; font-weight:bold; height:36px; line-height:36px; margin:20px 0; padding-left:48px; background:url(images/bg-suc.jpg) no-repeat 0 0;}
 .suc p{margin:20px 0; line-height:20px;}
</style>
<div class="suc">
<?php if($error):?>
	<p>安装出现错误</p>
	<a target="_top" href="?action=step1">返回</a> </p>
<?php else: ?>
	<h1>恭喜！您的网站已安装完成！</h1>
	<p>您的网站管理地址为：<br/>
	<a target="_top" href="<?php echo $url?>"><?php echo $url?></a> </p>
	<p>管理员：<?php echo $username?>　<br/>
	   密　码：<?php echo $password?></p>
	<p>请牢记您以上信息，您可以在登陆后修改登录信息及基本参数。</p>
	<?php if(file_exists(WWW_PATH.'index.php')):?>
	<p style="color:red">请通过FTP删除 ./index.php 文件</p>
	<?php endif?>
<?php endif?>
</div>
<script>
	setTimeout(function (){
		document.body.scrollTop = 99999;
	}, 100);
</script>