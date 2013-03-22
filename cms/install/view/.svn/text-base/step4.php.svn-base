<?php $this->display('header');?>
<div id="main">
  <div id="left" class="guide">
    <ul class="f-14">
      <li class="white">运行环境检测</li>
      <li class="white">数据库设置</li>
      <li class="white">站点设置</li>
      <li id="g-4">扩展选择</li>
      <li>安装完成</li>
    </ul>
  </div>
  <div id="right" class="p-b">
    <!--站点设置 begin-->
	<div class="box-2">
		<h1 class="blue mar-t-5">选择您需要的模块</h1>
	</div>
	<form action="javascript:;" method="post">
	
      <table cellpadding="0" cellspacing="0" class="mar-t-12 table-form" width="600" >
      	<caption style="background: #01A8DF; color: #fff;">核心组件</caption>
        <tr>
		<?php foreach($core AS $k => $v):?>
			<td width="24%" title="<?php echo $v['description']?>">
				<label><input type="checkbox" value="<?php echo $v['app']?>" disabled="1" checked="1" />
				<?php echo $v['name']?></label>
			</td>
			<?php if($k % 4 == 3) echo '</tr><tr>'; ?>
		<?php endforeach; ?>
        </tr>
      </table>
      
       <table cellpadding="0" cellspacing="0" class="mar-t-12 table-form" width="600" >
      	<caption style="background: #01A8DF; color: #fff;">可选模型 (<a class="selected">全选</a>/<a class="cancel">取消</a>)</caption>
        <tr>
		<?php foreach($model AS $k => $v):?>
			<td width="24%" title="<?php echo $v['description']?>">
				<label><input type="checkbox" name="apps[]" value="<?php echo $v['app']?>" <?php echo $v['selected']?>/>
				<?php echo $v['name']?></label>
			</td>
			<?php if($k % 4 == 3) echo '</tr><tr>'; ?>
		<?php endforeach; ?>
        </tr>
      </table>
      
      <table cellpadding="0" cellspacing="0" class="mar-t-12 table-form" width="600" >
      	<caption style="background: #01A8DF; color: #fff;">可选模块 (<a class="selected">全选</a>/<a class="cancel">取消</a>)</caption>
        <tr>
		<?php foreach($app AS $k => $v):?>
			<td width="24%" title="<?php echo $v['description']?>">
				<label><input type="checkbox" name="apps[]" value="<?php echo $v['app']?>" <?php echo $v['selected']?>/>
				<?php echo $v['name']?></label>
			</td>
			<?php if($k % 4 == 3) echo '</tr><tr>'; ?>
		<?php endforeach; ?>
        </tr>
      </table>
      
      </form>
      <!--站点设置 end-->
    <div id="btn-area">
	    <span class="f-l dis-b w-80">
		    <a href="?action=step3" class="btn-back">返回上一步</a>
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
	$('#submit').click(function (){
		$.post("?action=apps", $('form').serialize(), function (data){
			if(data == 1) {
				location.href = '?action=step5';
			}else{
				alert('保存错误：' + data);
			}
		});
	});
	
	$('a.selected, a.cancel').click(function (){
		$(this).parents('table').find('input:checkbox').attr('checked', $(this).attr('className') == 'selected');
	});
})
</script>