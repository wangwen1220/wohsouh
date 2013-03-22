<link href="<?=IMG_URL?>js/lib/colorInput/style.css" rel="stylesheet" type="text/css" />
<script src="<?=IMG_URL?>js/lib/cmstop.colorInput.js" type="text/javascript"></script>
<div class="bk_8"></div>
<form name="<?=$controller?>_form" id="<?=$controller?>_form" method="POST" action="?app=<?=$app?>&controller=<?=$controller?>&action=<?=$action?>&sid=<?=$_GET['sid']?>">
	<input type="hidden" name="dataid" value="<?=$dataid?>"/>
	<input type="hidden" name="sectionid" value="<?=$_GET['sectionid']?>"/>
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form">
		<tr>
			<th width="70"><span class="c_red">*</span> 标题：</th>
			<td><?=element::title('title', $title, $color,40)?></td>
		</tr>
		<tr>
			<th><span class="c_red">*</span> 链接：</th>
			<td><input type="text" name="url" id="url" value="<?=$url?>" size="60"/></td>
		</tr>
		<tr>
			<th> 缩略图：</th>
			<td><?=element::thumb('thumb', $thumb, 20)?></td>
		</tr>
		<tr>
			<th> 摘要：</th>
			<td><textarea name="description"><?=$description?></textarea></td>
		</tr>
		<tr>
			<th><img align="absmiddle" tips="若不填即为当前时间" class="tips hand" src="images/question.gif"/> 日期：</th>
			<td><input type="text" name="created" class="input_calendar"  value="<?if($created) echo date('Y-m-d H:i:s', $created)?>" size="24"/></td>
		</tr>
	</table>
</form>
<script type="text/javascript">
$(function (){
	$('.tips').attrTips('tips', 'tips_green', 200, 'top');
	$('input.input_calendar').focus(function(){
		WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});
	});
	$('#title').width(320);
	$('input.color-input').colorInput();
	$('label.input-box').css('margin-left', 3);
})
</script>
<style type="text/css">
table.table_form textarea{
	width: 318px;
	height: 50px;
}
#title {
	width: 200px;
}
</style>