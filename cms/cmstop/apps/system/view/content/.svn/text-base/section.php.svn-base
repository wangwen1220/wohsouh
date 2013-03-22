<div class="pop_box_area" style="overflow:hidden;">
	<div id="commendDiv" class="box_10" style="border:none;">
		<? foreach ($sections AS $cat): ?>
		<fieldset class="clearfix">
			<legend><?=$cat['name']?></legend>
			<ul class="clearfix">
			<? foreach ($cat['data'] AS $r): ?>
				<li sectionid="<?=$r['sectionid']?>"  tips="<?=$r['memo']?>" class="<?if($r['selected']) echo 'selected'?>">
					<input type="checkbox"<?if($r['selected']) echo ' checked'?> value="<?=$r['sectionid']?>" name="sectionid[]"/>
					<?=$r['name']?>
				</li>
			<? endforeach; ?>
			</ul>
		</fieldset>
		<div class="clear"></div>
		<? endforeach; ?>
	</div>

</div>
<style type="text/css">
div.box_10 {
	width: 95%;
	margin: 6px 0 0 6px;
}
.pop_box div.btn_area {
	background: none;
	text-align: center;
}
#commendDiv {
	overflow: auto;
	height: 95%;
}
#commendDiv li {
	height: 22px;
	line-height: 22px;
	padding-left: 6px;
	cursor: default;
	width: 140px;
	margin: 1px 1px 0 0;
	float: left;
	-moz-user-select: none; 
}
#commendDiv li.selected {
	background: #eee;
	color: #666;
}
#commendDiv li.hover {
	background: #eff;
}
#select,#cancel {
	cursor: pointer;
}

</style>
<script type="text/javascript">
$(function (){
	$('#commendDiv li').click(function (){
		if($(this).hasClass('selected')){
			$(this).removeClass('selected').find('input').attr('checked', 0);
		}else{
			$(this).removeClass('hover').addClass('selected').find('input').attr('checked', 1);
		}
	}).mouseover(function (){
		$('#commendDiv li.hover').removeClass('hover');
		if(!$(this).hasClass('selected')) $(this).addClass('hover');
	});
	$('#enter').click(save);
	$('#exit').click(exit);
	$('#commendDiv')[0].onselectstart = function (){return false;};
 	$('.clearfix').find('li').attrTips('tips');
});
function save()
{
	var ids = '', commend_text = '';
	$('#commendDiv li.selected').each(function (i, e){
		ids += $(e).attr('sectionid')+',';
		commend_text += $(e).text()+',';
	});
	if(ids) {
		ids = ids.substr(0, ids.length - 1);
		commend_text = commend_text.substr(0, commend_text.length - 1);
	}
	$('#sectionids').val(ids);
	$('#commend_text').text(commend_text);
	action=='edit' && $('#upsection').toggle($('#commend_text').html()!=''?true:false);
	exit();
}
function exit()
{
	$('span.close').click();
}
</script>
