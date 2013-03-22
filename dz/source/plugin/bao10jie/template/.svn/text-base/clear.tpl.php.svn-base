<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style type="text/css">
.selinp{width:200px;height:19px;line-height:19px;border:1px solid #ccc;background:#fff;}
.boardtbl{width:700px;}
.boardtbl tr{height:25px;line-height:25px;background:url(<?php echo HL_PLUGIN_PATH; ?>/bao10jie/calendar/line.gif) bottom repeat-x;}
.initbl td{line-height:25px;}
.chkbg{background:#fff;border:0;}
label input{margin: -2px 1px;}
</style>
<? if($saveOK) { ?>

<div id="append_parent"></div>
<div class="container" id="cpcontainer">
	<h3>Discuz! 提示</h3>
	<div class="infobox">
		<h4 class="infotitle2">
			数据清理成功!
		<br />
		</h4>
            <? if(HL_VERSION == "X2" || HL_VERSION == "X1.5"){ ?>
		<p class="marginbot">
			<a href="admin.php?action=plugins&operation=config&identifier=bao10jie&pmod=admin_clear" class="lightlink">如果您的浏览器没有自动跳转，请点击这里</a>
		</p>
		<script type="text/JavaScript">setTimeout("redirect('admin.php?action=plugins&operation=config&identifier=bao10jie&pmod=admin_clear');", 3000);</script>
                <? }else{ ?>
                <p class="marginbot">
			<a href="admincp.php?action=plugins&operation=config&identifier=bao10jie&mod=admin_clear" class="lightlink">如果您的浏览器没有自动跳转，请点击这里</a>
		</p>
		<script type="text/JavaScript">setTimeout("redirect('admincp.php?action=plugins&operation=config&identifier=bao10jie&mod=admin_clear');", 3000);</script>
                <? } ?>
	</div>
</div>
<? } else { ?>
<script language="javascript">
function chkini()
{
	if(confirm('清除数据将无法恢复.\r\n\r\n您确定这样做吗？')){
		return true;
	}
	return false;
}
</script>
<form action="" method="post" name="ini_form" id="ini_form" onsubmit="return chkini();">
<table width="99%" border="0" class="initbl" style="background: #fff;">
	<tr>
		<th height="40"">
		<b>清理数据范围:</b>
		
		<select name="clear_day" style="width: 90px">
			<option value="7">1周以前</option>
			<option value="14">2周以前</option>
			<option value="30">30天以前</option>
			<option value="60">60天以前</option>
			<option value="90">90天以前</option>
			<option value="180">180天以前</option>
			<option value="365">365天以前</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="handin" id="handin" class="btn button" value="提 交" />
		</th>
	</tr>
	<tr>
		<td height="40" style="color:red;">注:(数据清理以'标引时间'为准)</td>
	</tr>
</table>
</form>

<? } ?>