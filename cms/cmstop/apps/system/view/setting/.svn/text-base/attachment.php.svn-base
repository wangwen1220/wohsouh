<?php $this->display('header', 'system');?>
<div class="bk_10"></div>
<form id="setting_edit_attachment" action="?app=system&controller=setting&action=edit" method="POST">
<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
	<caption>基本设置</caption>
	<tr>
		<th width="150">允许上传的附件类型：</th>
		<td><input type="text" name="setting[attachexts]" value="<?=$attachexts?>" size="80"/></td>
	</tr>
</table>
<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
	<caption>缩略图</caption>
	<tr>
		<th width="150">缩略图：</th>
		<td>
		<input type="radio" name="setting[thumb_enabled]" value="1" class="radio" <?php if ($thumb_enabled == 1) echo 'checked';?>/> 启用 &nbsp; <input type="radio" name="setting[thumb_enabled]" value="0" class="radio" <?php if ($thumb_enabled == 0) echo 'checked';?>/> 禁用
		</td>
	</tr>
	<tr>
		<th>缩略图大小：</th>
		<td><input type="text" name="setting[thumb_width]" value="<?=$thumb_width?>" size="5"/> X <input type="text" name="setting[thumb_height]" value="<?=$thumb_height?>" size="5"/></td>
	</tr>
	<tr>
		<th>缩略图质量：</th>
		<td><input type="text" name="setting[thumb_quality]" value="<?=$thumb_quality?>" size="5"/></td>
	</tr>
</table>
<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
	<caption>图片水印</caption>
	<tr>
		<th width="150">图片水印：</th>
		<td>
		<input type="radio" name="setting[watermark_enabled]" value="1" class="radio" <?php if ($watermark_enabled == 1) echo 'checked';?>/> 启用 &nbsp; <input type="radio" name="setting[watermark_enabled]" value="0" class="radio" <?php if ($watermark_enabled == 0) echo 'checked';?>/> 禁用
		</td>
	</tr>
	<tr>
		<th>水印位置：</th>
		<td>
		<table style="margin-bottom: 3px; margin-top:3px;">
			<tr>
				<td><input class="radio" type="radio" name="setting[watermark_position]" value="1" <?php if ($watermark_position == 1) echo 'checked';?>> #1</td>
				<td><input class="radio" type="radio" name="setting[watermark_position]" value="2" <?php if ($watermark_position == 2) echo 'checked';?>> #2</td>
				<td><input class="radio" type="radio" name="setting[watermark_position]" value="3" <?php if ($watermark_position == 3) echo 'checked';?>> #3</td>
			</tr>
			<tr>
				<td><input class="radio" type="radio" name="setting[watermark_position]" value="4" <?php if ($watermark_position == 4) echo 'checked';?>> #4</td>
				<td><input class="radio" type="radio" name="setting[watermark_position]" value="5" <?php if ($watermark_position == 5) echo 'checked';?>> #5</td>
				<td><input class="radio" type="radio" name="setting[watermark_position]" value="6" <?php if ($watermark_position == 6) echo 'checked';?>> #6</td>
			</tr>
			<tr>
				<td><input class="radio" type="radio" name="setting[watermark_position]" value="7" <?php if ($watermark_position == 7) echo 'checked';?>> #7</td>
				<td><input class="radio" type="radio" name="setting[watermark_position]" value="8" <?php if ($watermark_position == 8) echo 'checked';?>> #8</td>
				<td><input class="radio" type="radio" name="setting[watermark_position]" value="9" <?php if ($watermark_position == 9) echo 'checked';?>> #9</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<th>水印添加条件：</th>
		<td><input type="text" name="setting[watermark_minwidth]" value="<?=$watermark_minwidth?>" size="5"/> X <input type="text" name="setting[watermark_minheight]" value="<?=$watermark_minheight?>" size="5"/></td>
	</tr>
	<tr>
		<th>水印图片类型：</th>
		<td>
		<input type="radio" name="setting[watermark_ext]" value="gif" class="radio" <?php if ($watermark_ext == 'gif') echo 'checked';?>/> GIF &nbsp;
		<input type="radio" name="setting[watermark_ext]" value="png" class="radio" <?php if ($watermark_ext == 'png') echo 'checked';?>/> PNG 
		</td>
	</tr>
	<tr>
		<th>水印透明度：</th>
		<td><input type="text" name="setting[watermark_trans]" value="<?=$watermark_trans?>" size="5"/></td>
	</tr>
	<tr>
		<th>JPEG 水印质量：</th>
		<td><input type="text" name="setting[watermark_quality]" value="<?=$watermark_quality?>" size="5"/></td>
	</tr>
	<tr>
		<th></th>
		<td valign="middle">
		  <input type="submit" id="submit" value="保存" class="button_style_2"/>
		</td>
	</tr>
</table>
</form>
<div class="bk_10"></div>
<script type="text/javascript">
$(function(){
	$('#setting_edit_attachment').ajaxForm(function(json){
		if(json.state) ct.tips(json.message);
		else ct.error(json.error);
	});
});
</script>
<?php $this->display('footer', 'system');