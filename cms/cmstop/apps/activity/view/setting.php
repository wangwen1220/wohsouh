<?php $this->display('header', 'system');?>
<div class="bk_8"></div>
<form id="activity_setting" method="POST" action="?app=activity&controller=setting&action=index">
<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
	<caption>活动设置</caption>
	<tr>
		<th width="120"><img src="images/question.gif" width="16" height="16" class="tips hand" tips="百度地图API使您能够将百度地图嵌入自己的网页中。一个地图 API 密钥只对一个“目录”或域有效。您必须有百度帐户才能获得地图API密钥，并且API密钥会与您的百度帐户关联。" align="absmiddle"/>百度地图API：</th>
		<td><input type="text" name="setting[baidumap]" value="<?=$setting['baidumap']?>" size="40"/> &nbsp;&nbsp;&nbsp;<a href="http://openapi.baidu.com/map/signup.html" target="_blank">立即注册</a>
		</td>
	</tr>
	<tr>
	    <th>&nbsp;</th>
	    <td  class="t_c"><input type="submit" class="button_style_2" value="保存" /></td>
	</tr>
</table>
</form>
<script type="text/javascript">
$(function(){
	$('#activity_setting').ajaxForm(function (response) {
		ct.tips('保存成功');
	});
	$('.tips').attrTips('tips', 'tips_green');
});
</script>
<?php $this->display('footer', 'system');?>