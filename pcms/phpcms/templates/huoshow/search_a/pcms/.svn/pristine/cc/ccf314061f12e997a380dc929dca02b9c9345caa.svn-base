<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"请输入属性",onfocus:"请输入属性",oncorrect:"<?php echo L('input_right');?>"}).inputValidator({min:1,onerror:"请输入属性"});
	})
//-->
</script>
<form action="?m=special&c=special&a=special_edit_property" method="post" id="myform">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<th width="100"><strong>属性名称：</strong></th>
		<td><input name="name" id="name" class="input-text" type="text" size="25" value="<?php echo $datas[0][name] ?>"></td>
	</tr>
</tbody>
</table>
<div class="bk15"></div>
<input type="hidden" name="id" value="<?php echo $datas[0][id]?>"/>
<input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class='dialog'>&nbsp;
<input type="reset" value=" <?php echo L('clear')?> " class='dialog'>
</form>