<div class="bk_8"></div>
<form name="<?=$controller?>_form" id="<?=$controller?>_form" method="POST" action="?app=<?=$app?>&controller=<?=$controller?>&action=<?=$action?>">
	<input type="hidden" name="classid" value="<?=$classid?>"/>
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form">
		<tr>
			<th width="50"><span class="c_red">*</span> 名称：</th>
			<td><input type="text" name="name" id="name" value="<?=$name?>" size="40"/></td>
		</tr>
		<tr>
			<th> 备注：</th>
			<td><textarea name="memo"><?=$memo?></textarea></td>
		</tr>
	</table>
</form>
<script type="text/javascript">
$(function (){
	$('#name').focus;
	if("<?=$classid?>" == 1)
	{
		$('#name').attr('disabled', 1);
	}
})
</script>
<style type="text/css">
#name {
	width: 230px;
}
table.table_form textarea{
	width: 230px;
	height: 50px;
}
</style>