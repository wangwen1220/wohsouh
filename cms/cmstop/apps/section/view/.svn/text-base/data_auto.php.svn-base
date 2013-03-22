<?php $this->display('header'); ?>
<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/editplus/style.css" />
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.editplus.js"></script>
<script type="text/javascript" src="js/cmstop.editplus_plugin.js"></script>
<script type="text/javascript" src="tiny_mce/editor.js"></script>
<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/suggest/style.css" />
<script src="<?=IMG_URL?>js/lib/cmstop.suggest.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/tree/style.css" />
<script src="<?=IMG_URL?>js/lib/cmstop.tree.js" type="text/javascript"></script>

<script type="text/javascript" src="apps/section/js/data.js"></script>

<style type="text/css">
body {
	padding-left: 6px;
}
#published {
	color:#444444;
	line-height:20px;
	margin:0 10px;
}
</style>
<table width="98%" cellspacing="0" cellpadding="0" border="0" class="table_form">
	<tbody>
		<tr>
			<td><textarea name="data" id="data" wrap="off"><?=$data?></textarea></td>
		</tr>
		<tr>
			<td>
				<input type="submit" class="button_style_2 publish" value="发布"/>
				<span id="published">
				<?php if($published):?>
				最后发布：<?=date('Y年n月j日 G:i',$published)?>
				<?php else:?>
				未发布
				<?php endif;?>
				</span>
			</td>
		</tr>
	</tbody>
</table>

<script type="text/javascript">
var sectionid = "<?=$sectionid?>";
$(function (){
	var w = $(document).width();
	var h = $(document).height();
	$('#data').editplus({
		buttons:'wrap,|,db,content,discuz,|,loop,ifelse,elseif,template,|,preview,section,clip',
		width: w - 15,
		height: h - 40
	});
	$('input.publish').click(function (){
		var content = $('#data').val();
		$.post('?app=section&controller=data&action=saveData&sectionid='+sectionid, {content: content}, function (rs){
			if(rs.state) {
				ct.tips('保存并发布成功');
				$('#published').text('最后发布：'+rs.message);
			}else{
				ct.error(rs.error);
			}
		}, 'json');
	});
});
</script>
