
<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"请输入专辑名称",onfocus:"请输入专辑名称",oncorrect:"<?php echo L('input_right');?>"}).inputValidator({min:1,onerror:"请输入专辑名称"});
	})
//-->
</script>

<form action="?m=community&c=communitalbum&a=community_edit_album" method="post" id="myform">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<th width="60"><strong>专辑名称：</strong></th>
		<td><input name="album_name" id="album_name" class="input-text" type="text" size="25" value="<?php echo  $list_arr[0]['album_name']?>"></td>
		<th width="80"><strong>专辑描述：</strong></th>
		<td><input name="album_discription" id="album_discription" class="input-text" type="text" size="25" value="<?php echo  $list_arr[0]['description']?>"></td>
	</tr>
</tbody>
</table>

<div class="bk15"></div>
<input type="hidden" name="albumid" value="<?php echo $list_arr[0]['id'] ?>"/>
<input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class='dialog'>&nbsp;
<input type="reset" value=" <?php echo L('clear')?> " class='dialog'>
</form>