<?php $this->display('header', 'system');?>
<div class="bk_10"></div>
<div class="suggest w_650 mar_l_8">
	<h2>友情提示</h2>
	<p>大众版的搜索是直接搜数据库，如果需要更快速准确、请用商业版的Sphinx全文搜索引擎，它可以提供比数据库本身更专业的搜索功能。</p>
</div>
<div class="bk_10"></div>
<form id="setting_sphinx" action="?app=search&controller=setting&action=index" method="POST" >
<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
	<caption>搜索设置</caption>
	<tr>
		<th width="100">开启搜索：</th>
		<td><input type="checkbox"  name="setting[open]" id="open" value="1" <?php if($setting['open']){?> checked="checked" <? }?>/></td>
	</tr>
	<tr>
		<th width="100">搜索间隔：</th>
		<td><input type="text"  name="setting[limit]" id="limit" value="<?php echo $setting['limit']?>" size="3"/> 秒</td>
	</tr>
	<tr>
		<th width="100">每页内容数：</th>
		<td><input type="text"  name="setting[pagesize]" id="pagesize" value="<?php echo $setting['pagesize']?>"/></td>
	</tr>
	<tr>
		<th width="100">内容剪切字数：</th>
		<td><input type="text"  name="setting[contentCut]" id="contentCut" value="<?php echo $setting['contentCut']?>"/></td>
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
	$("#setting_sphinx").ajaxForm('submit_ok');
	$("#test").click(function(){
		var host = $("#host").val();
		var port = $("#port").val();
		$.ajax({
			type : 'POST',
			url :"?app=search&controller=setting&action=test",
			data :{
				host	:host,
				port	:port
			},
			success : submit_ok,
			dataType : 'json'
		});
	});
});
$('img.tips').attrTips('tips', 'tips_green', 200, 'top');
function submit_ok(data) {
	if(data.state) {
		ct.tips(data.message);
	} else {
		ct.error(data.error);
	}
}
</script>
<?php $this->display('footer', 'system');