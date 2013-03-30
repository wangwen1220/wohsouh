<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"请输入分类名称",onfocus:"请输入分类名称",oncorrect:"<?php echo L('input_right');?>"}).inputValidator({min:1,max:15,onerrormin:"请输入分类名称",onerror:"名称最多 15 个字"})
			.ajaxValidator({
				dataType: 'text',
				async: true,
				url: '/index.php?m=community&c=communityey&a=ajax_classname_exist&name='+this.value,
				success: function(d){
					if(d == 1){
						return false;
					}else{
						return true;
					}
				},
				buttons: $("#dosubmit"),
				error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
				onerror: "该分类名已经存在，请更改",
				onwait: "正在对分类名进行校验，请稍候..."
			});
		//$("#pic").formValidator({onshow:"(上传图片格式为30*30：.jpg .png .gif)",onfocus:"(上传图片格式为30*30：.jpg .png .gif)",oncorrect:"<?php echo L('input_right');?>"}).inputValidator({min:1,onerror:"(上传图片格式为30*30：.jpg .png .gif)"});
	})
//-->
</script>
<form action="?m=community&c=communityey&a=community_edit_class" method="post" id="myform" enctype="multipart/form-data">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<th width="80"><strong>分类名称：</strong></th>
		<td><input name="name" id="name" class="input-text" type="text" size="25" value="<?php echo  $list_arr[0]['name']?>"></td>
	</tr>
	<input type="hidden" name="h_name" value="<?php echo  $list_arr[0]['name']?>">
	<!--tr>
		<th width="80"><strong>分类图标：</strong></th>
		<td><input id="pic" type="file" name="image" value="<?php //echo $list_arr[0]['pic']?>" size="25"/><input type="text" name="himage" style="display:none;" value="<?php echo $list_arr[0]['pic']?>" size="25" /><img width="30" height="30" src="<?php echo $list_arr[0]['pic']?>"/></td>
	</tr-->
</tbody>
</table>
<div class="bk15"></div>
<input type="hidden" name="classid" value="<?php echo $classid?>"/>
<input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class='dialog'>&nbsp;
<input type="reset" value=" <?php echo L('clear')?> " class='dialog'>
</form>