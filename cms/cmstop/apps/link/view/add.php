<?php $this->display('header');?>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.uploadify.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.filemanager.js"></script>
<div class="bk_8"></div>
<form name="link_add" id="link_add" method="post" action="?app=link&controller=link&action=add">
	<input type="hidden" name="modelid" id="modelid" value="<?=$modelid?>">
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
        <tr>
            <th width="60"><span class="c_red">*</span> 栏目：</th>
            <td><?=element::category('catid', 'catid', $catid)?></td>
        </tr>
		<tr>
			<th><span class="c_red">*</span> 标题：</th>
			<td><?=element::title('title', $title, $color)?></td>
		</tr>
		<tr>
			<th><span class="c_red">*</span> 链接：</th>
			<td><input type="text" name="url" id="url" value="<?=$url?>" size="80" maxlength="100" /> </td>
		</tr>
		<tr>
			<th>Tags：</th>
			<td><?=element::tag('tags', $tags)?></td>
		</tr>
		<tr>
			<th>缩略图：</th>
			<td><?=element::thumb('thumb', '', '45')?></td>
		</tr>
        <tr>
            <th><?=element::tips('权重将决定文章在哪里显示和排序')?> 权重：</th>
            <td>
            <?=element::weight();?>
            </td>
          </tr>
        
			
		<tr>
			<th>状态：</th>
			<td>
			<label><input type="radio" name="status" id="status" value="6" checked="checked" />发布</label>
			<label><input type="radio" name="status" id="status" value="3" />送审</label>
			<label><input type="radio" name="status" id="status" value="1" />草稿</label>
			</td>
		</tr>
	</table>
	
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form">
		<tr>
			<th width="60"></th>
			<td width="60">
				<input type="submit" value="保存" class="button_style_2" style="float:left"/>
			</td><td style="color:#444;text-align:left">按Ctrl+S键保存</td>
		</tr>
	 </table>
</form>
<link href="<?=IMG_URL?>js/lib/colorInput/style.css" rel="stylesheet" type="text/css" />
<script src="<?=IMG_URL?>js/lib/cmstop.colorInput.js" type="text/javascript"></script>
<script type="text/javascript" src="apps/page/js/section.js"></script>
<script type="text/javascript" src="js/related.js"></script>
<?php $this->display('footer', 'system');