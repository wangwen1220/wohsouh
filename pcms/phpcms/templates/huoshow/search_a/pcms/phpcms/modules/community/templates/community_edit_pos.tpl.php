<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"请输入推荐位名称",onfocus:"请输入推荐位名称",oncorrect:"<?php echo L('input_right');?>"}).inputValidator({min:1,onerror:"请输入推荐位名称"});
		//$("#pic").formValidator({onshow:"(上传图片格式为30*30：.jpg .png .gif)",onfocus:"(上传图片格式为30*30：.jpg .png .gif)",oncorrect:"<?php echo L('input_right');?>"}).inputValidator({min:1,onerror:"(上传图片格式为30*30：.jpg .png .gif)"});
	})
//-->
</script>
<form action="?m=community&c=position&a=edit" method="post" id="myform" enctype="multipart/form-data">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<th width="100"><strong>推荐位名称：</strong></th>
		<td><input name="name" id="name" class="input-text" type="text" size="25" value="<?php echo $datas[0][name] ?>"></td>
	</tr>
	<tr>
		<th width="100"><strong>最大保存条数：</strong></th>
		<td><input id="pic" type="text" name="max" value="<?php echo $datas[0][maxnum] ?>" size="25"/></td>
	</tr>
	<tr>
		<th width="100"><strong>排序：</strong></th>
		<td><input type="text" name="listorder" value="<?php echo $datas[0][listorder] ?>" size="25" /></td>
	</tr>
</tbody>
</table>
<div class="bk15"></div>
<input type="hidden" name="posid" value="<?php echo $posid?>"/>
<input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class='dialog'>&nbsp;
<input type="reset" value=" <?php echo L('clear')?> " class='dialog'>
</form>