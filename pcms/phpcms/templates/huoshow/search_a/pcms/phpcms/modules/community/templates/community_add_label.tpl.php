<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'100'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"请输入标签名称",onfocus:"请输入标签名称",oncorrect:"<?php echo L('input_right');?>"}).inputValidator({min:1,max:50,onerrormin:"请输入标签名称",onerror:"名称最多 50 个字"})
			.ajaxValidator({
				dataType: 'text',
				async: true,
				url: '/index.php?m=community&c=communityey&a=ajax_tagname_exist&name='+this.value,
				success: function(d){
					if(d == 1){
						return false;
					}else{
						return true;
					}
				},
				buttons: $("#dosubmit"),
				error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
				onerror: "该标签名已经存在，请更改",
				onwait: "正在对标签名进行校验，请稍候..."
			});
	})
//-->
</script>
<form action="?m=community&c=communityey&a=community_add_label" method="post" id="myform">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<td colspan="2">添加多个标签请用|分开; 例如：AA|BB
		</td>
	</tr>
	<tr>
		<th width="80"><strong>标签名称：</strong></th>
		<!--td><input name="name" id="name" class="input-text" type="text" size="25"></td-->
		<td><textarea rows="5" cols="45" id="name" name="name" class="input-text"></textarea></td>
	</tr>
</tbody>
</table>
<div class="bk15"></div>
<input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class='dialog'>&nbsp;
<input type="reset" value=" <?php echo L('clear')?> " class='dialog'>
</form>