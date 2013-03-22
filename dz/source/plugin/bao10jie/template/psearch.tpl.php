<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style type="text/css">
.selinp{width:245px;height:19px;line-height:19px;border:1px solid #ccc;background:#fff;}
</style>
<br />
<link href="<?php echo HL_PLUGIN_PATH ?>/bao10jie/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
var hl_plugin_path = "<?php echo HL_PLUGIN_PATH ?>";
//-->
</script>
<script src="<?php echo HL_PLUGIN_PATH ?>/bao10jie/calendar/calendar.js" type="text/javascript"></script>

<script>
function chksearch()
{
	var pid = document.getElementById('sel_pid').value;
	
	if(pid != '' && isNaN(pid)){
		alert('帖子ID必须为数字型字符');
		return false;
	}
	
	return true;
}
</script>

<form name="psel_form" id="psel_form" onsubmit="return chksearch();" action="<?=$submit_url?>" method="post" >
<table border="0" cellpadding="0" cellspacing="0" class="psel">
<?php if(!$Purify_MULTI_POST){ ?>
<tr>
<td height="40">内容关键词：</td><td><input class="selinp" type="text" name="sel_word" value="<?=htmlspecialchars($selWord)?>"/></td>
</tr>
<tr>
<td height="40">发帖用户名：</td><td><input class="selinp" type="text" name="sel_author" value="<?=htmlspecialchars($selAuthor)?>" /></td>
</tr>
<tr>
<td height="40">发帖IP：</td><td><input class="selinp" type="text" name="sel_ip" id="sel_ip" value="<?=htmlspecialchars($selIp)?>" /></td>
</tr>
<?php }else{ ?>
<tr>
<td colspan="2" style="color:red;font-size:12px;">
由于开启分表功能,某些搜索项被隐藏了!
</td>
</tr>
<?php } ?>
<tr>
<td height="40">所在版块：</td><td>
<select name="sel_board" style="width:250px;">
<option value="0">所有版块</option><? if(is_array($boards)) { foreach($boards as $key => $one) { ?><option value="<?=$one['fid']?>" <? if($selBoard == $one['fid']) { ?>selected<? } ?>><?=$one['name']?></option><? } } ?></select>
</td>
</tr>
<tr>
<td height="40">帖子ID：</td><td><input class="selinp" type="text" name="sel_pid" id="sel_pid" value="<?if($selPid) echo $selPid;?>" /></td>
</tr>
<tr>
<td height="40">发表时间范围：</td>
<td>
<span id="sel_ftime_span"></span>&nbsp;—&nbsp;<span id="sel_ttime_span"></span>
<script language="javascript">
print_calendar_input("sel_ftime_span", "sel_ftime", "<?=$selFtime?>");
print_calendar_input("sel_ttime_span", "sel_ttime", "<?=$selTtime?>");
</script>
</td>
</tr>
<tr>
<td></td><td align="right">
<input class="btn" type="submit" name="handin" id="handin" value="提 交">&nbsp;</td>
</tr>
</table>
</form>

<hr size="1" color="#cccccc" width="100%"/>