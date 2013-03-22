<?php $this->display('header', 'system');?>
<div class="bk_10"></div>
<form id="setting_edit_ftp" action="?app=system&controller=setting&action=edit" method="POST">
<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
	<caption>FTP设置</caption>
	<tr>
		<th width="200">网站名称：</th>
		<td><input type="text" name="setting[sitename]" value="<?=$sitename?>" size="30"/></td>
	</tr>
	<tr>
		<th>网站地址：</th>
		<td><input type="text" name="setting[siteurl]" value="<?=$siteurl?>" size="50"/></td>
	</tr>
	<tr>
		<th>访问统计代码：</th>
		<td><textarea  name="setting[statcode]" rows="6" cols="50" class="bdr"><?=$statcode?></textarea></td>
	</tr>
	<tr>
		<th>网站关闭：</th>
		<td><input type="radio" name="setting[closed]" value="1" class="radio" <?php if ($closed) echo 'checked';?>/>是 <input type="radio" name="setting[closed]" value="0" class="radio" <?php if (!$closed) echo 'checked';?>>否</td>
	</tr>
	<tr>
		<th>关闭原因：</th>
		<td><textarea name="setting[closedreason]" rows="6" cols="50" class="bdr"><?=$closedreason?></textarea></td>
	</tr>
	<tr>
		<th></th>
		<td valign="middle">
		  <input type="submit" id="submit" value="保存" class="button_style_2"/>
		  <input type="reset" id="button" value="重填" class="button_style_1"/>
		  </td>
	</tr>
</table>
</form>
<div class="bk_10"></div>
<script type="text/javascript">
$(function(){
	$('#setting_edit_ftp').ajaxForm(function(json){
		if(json.state) ct.tips(json.message);
		else ct.error(json.error);
	});
});
</script>
<?php $this->display('footer', 'system');