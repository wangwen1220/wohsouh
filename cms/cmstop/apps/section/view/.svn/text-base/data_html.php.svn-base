<?php $this->display('header'); ?>

<script src="<?php echo IMG_URL?>js/lib/jquery.uploadify.js" type="text/javascript"></script>
<script src="<?php echo IMG_URL?>js/lib/cmstop.filemanager.js" type="text/javascript"></script>
<script src="<?php echo ADMIN_URL?>tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script src="<?php echo ADMIN_URL?>tiny_mce/editor.js" type="text/javascript"></script>

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
	$('input.publish').click(function (){
		var content = tinyMCE.activeEditor.getContent();
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
tinyMCE.init({
	// General options
	mode : "exact",
	theme : "advanced",
	elements : "data",
	language : "ch",
	width : ct.innerWidth() - 20,
	height : ct.innerHeight() - 50,
	pagebreak_separator : "<!-- my page break -->",
	convert_urls : false,
	forced_root_block : '',
	plugins : 
"safari,pagebreak,style,advimage,advlink,insertdatetime,preview,searchreplace,contextmenu,paste,template,inlinepopups,onekeyclear,fullscreen,media,insertimage,ct_vote",
	// Theme options
	theme_advanced_buttons1 : 
"undo,bold,italic,underline,fontsizeselect,forecolor,|,link,unlink,|,justifyleft,justifycentr,justifyright,|,image,media,ctVote,code",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false,
	// Example content CSS (should be your site CSS)
	content_css : "css/content.css",
	extended_valid_elements : "a[class|name|href|target|title|onclick|rel],script[type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder],img[class|src|border=0|width|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],$elements",
	setup : function(ed){
		 ed.onPostProcess.add(function(ed, o) {
		 	o.content = o.content.replace(/<br><br>/ig,'</p><p>');
		 });
	}
});
</script>
