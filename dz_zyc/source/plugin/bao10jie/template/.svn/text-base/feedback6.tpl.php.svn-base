<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>

<style type="text/css">
.seldiv{background:#f0f7fd url(plugins/bao10jie/calendar/line.gif) bottom repeat-x;width:99%;line-height:32px;margin:10px 0;}
.selectdiv{float:left;width:850px;margin-top:0 !important;margin-top:8px;}
.listDiv{width:99%;background:#fff;padding: 10px 0;}
.listDiv a{color:#2366a8;}
.poststbl{border:1px solid #ccc;margin-bottom:10px;}
.bg0{background:#ffffff;}
.bg1{background:#ccffcc;}
.bg2{background:#ffebe7;}
.bg3{background:#f0f0f0;}
.sts_check{border:0;background:#fff;margin:-2px 1px;}
.poststbl td{line-height:25px;padding:7px;overflow:hidden;}
.poststbl td div.pmdiv{height:20px;margin:0 2px;float:left;line-height:20px;}
.poststbl td div.pmdiv a{text-decoration:none;}
*+html .poststbl td div.tmdbq{margin-top:1px;}
*+html .poststbl td div.tmdbq select{height:22px;}
.poststbl td div.tmdbq select{height:21px;line-height:21px;}
.pagebar a{padding:3px 4px 2px 4px;margin:2px;font-family:"宋体";}
.pagebar b{padding:3px 4px 2px 4px;margin:2px;font-family:"宋体";background:#F3E3C7;border:1px solid #F8C094;color:#DC6A0E;}
.pagebar span{padding:3px 4px 2px 4px;margin:2px;font-family:"宋体";background:#F5FEF9;border:1px solid #C5E7F3;text-decoration:none;}
.pagebar a:link{background:#F5FEF9;border:1px solid #C5E7F3;text-decoration:none;}
.pagebar a:visited{background:#F5FEF9;border:1px solid #C5E7F3;text-decoration:none;}
.pagebar a:hover{background:#F3E3C7;border:1px solid #F8C094;color:#DC6A0E;text-decoration:none;}
.alonesub {padding:0;margin:0;border:0;background:#fff;height:16px;line-height:16px;color:#2366a8;cursor:pointer;}
</style>
<link media="all" type="text/css" href="images/admincp/admincp.css" rel="stylesheet" />
<script type="text/javascript" src="plugins/bao10jie/js/jquery.js"></script>
<script type="text/javascript">

function subsel()
{
	document.getElementById('sel_form').submit();
	return true;
}

function chgchk(v)
{
	$('.sts_check').each(function(){
		var sts = $(this).val();
		var dd = $(this).attr('id').split('_');
		if(v == sts){
			$(this).attr('checked', 'checked');
		}else{
			$(this).removeAttr('checked');
		}
		if(dd[0] == 'pass'){
			chgbg(dd[1], v);
		}
		
	})
}

function chgbg(d, v)
{
	v = parseInt(v);
	d = parseInt(d);
	if(v) $('#ptbl'+d).attr('class', 'poststbl bg'+v);
	else $('#ptbl'+d).attr('class', 'poststbl bg0');
}

function chgreason(d)
{
	$('#reasons'+d).val($('#rson'+d).val());
}

function chgsts(d, v)
{
	$('#thepid').val(d);
	$('#thests').val(v);

	return true;
}

</script>
<table border="0" class="seldiv" cellpadding="0" cellspacing="0"><tr><td style="padding-top:3px">

<form name="sel_form" id="sel_form" method="post" action="">
<div class="selectdiv">
<input type="hidden" name="page" id="page" value="0" />

<?php if($it != 'psel') { ?>

&nbsp;<b>请选择：</b>
<select name="sel_time" id="sel_time" onchange="subsel()">
<option value="2" <?php if($selTime == 2) { ?>selected<?php } ?>>最近2小时</option>
<option value="24" <?php if($selTime == 24) { ?>selected<?php } ?>>最近1天</option>
<option value="72" <?php if($selTime == 72) { ?>selected<?php } ?>>最近3天</option>
<option value="168" <?php if($selTime == 168) { ?>selected<?php } ?>>最近7天</option>
<option value="720" <?php if($selTime == 720) { ?>selected<?php } ?>>最近30天</option>
</select>
<select name="sel_board" id="sel_board" onchange="subsel()" style="width:180px;overflow:hidden;">
	<option value="0">所有版块</option>
	<?php if(is_array($boards)) { foreach($boards as $key => $one) { ?>
	<option value="<?php echo $one['fid']?>" <?php if($selBoard == $one['fid']) { ?>selected<?php } ?>><?php echo $one['name']?></option>
	<?php } } ?>
</select>
<select name="sel_type" id="sel_type" onchange="subsel()">
<option value="0">全部</option>
<option value="2" <?php if($selType == 2) { ?>selected<?php } ?>>主题</option>
<option value="1" <?php if($selType == 1) { ?>selected<?php } ?>>回复</option>
</select>
<select name="sel_mode" id="sel_mode" onchange="subsel()">
<option value="0" <?php if($selMode == 0) { ?>selected<?php } ?>>操作建议</option>
<option value="1" <?php if($selMode == 1) { ?>selected<?php } ?>>建议通过</option>
<option value="2" <?php if($selMode == 2) { ?>selected<?php } ?>>建议删除</option>
<option value="3" <?php if($selMode == 3) { ?>selected<?php } ?>>建议审核</option>
<option value="4" <?php if($selMode == 4) { ?>selected<?php } ?>>等待处理</option>
</select>
<select name="sel_state" id="sel_state" onchange="subsel()">
<option value="4" <?php if($selState == 4) { ?>selected<?php } ?>>帖子状态</option>
<option value="1" <?php if($selState == 1) { ?>selected<?php } ?>>已通过</option>
<option value="2" <?php if($selState == 2) { ?>selected<?php } ?>>已删除</option>
<option value="3" <?php if($selState == 3 || $selState == 0) { ?>selected<?php } ?>>待审核</option>
</select>
<select name="sel_doer" id="sel_doer" onchange="subsel()">
<option value="4" <?php if($selDoer == 4) { ?>selected<?php } ?>>确认状态</option>
<option value="1" <?php if($selDoer == 1) { ?>selected<?php } ?>>未确认</option>
<option value="2" <?php if($selDoer == 2) { ?>selected<?php } ?>>已确认</option>
<option value="3" <?php if($selDoer == 3) { ?>selected<?php } ?>>已忽略</option>
</select>
<?php } else { ?>
<input type="hidden" name="it" value="<?php echo $it?>" />
<input type="hidden" name="sel_author" value="<?php echo $selAuthor?>" />
<input type="hidden" name="sel_ip" value="<?php echo $selIp?>" />
<input type="hidden" name="sel_pid" value="<?php echo $selPid?>" />
<input type="hidden" name="sel_word" value="<?php echo $selWord?>" />
<input type="hidden" name="sel_ftime" value="<?php echo $selFtime?>" />
<input type="hidden" name="sel_ttime" value="<?php echo $selTtime?>" />
&nbsp;<b>符合条件的帖子数：<?php echo $total?>帖</b>&nbsp;&nbsp;<a href="admincp.php?action=plugins&operation=config&identifier=bao10jie&mod=admin_search&sel_word=<?php echo urlencode(base64_encode($selWord))?>&sel_author=<?php echo urlencode(base64_encode($selAuthor))?>&sel_ip=<?php echo urlencode(base64_encode($selIp))?>&sel_board=<?php echo $selBoard?>&sel_pid=<?php echo $selPid?>&sel_ftime=<?php echo $selFtime?>&sel_ttime=<?php echo $selTtime?>&it=<?php echo $it?>">重新搜索</a>
<?php } ?>

	<select name="sel_page" id="sel_page" onchange="subsel()">
		<option value="10" <?php if($pn == 10) { ?>selected<?php } ?>>每页10条</option>
		<option value="20" <?php if($pn == 20) { ?>selected<?php } ?>>每页20条</option>
		<option value="50" <?php if($pn == 50) { ?>selected<?php } ?>>每页50条</option>
		<option value="100" <?php if($pn == 100) { ?>selected<?php } ?>>每页100条</option>
	</select>
	&nbsp;&nbsp;
	<input class="button" type="button" name="sel_refresh" id="sel_refresh" value="刷 新" onclick="javascript:subsel();"/>
</div>
</form>
</td></tr>
</table>

<div class="listDiv">
<?php if($HY_res) { ?>
<form name="verify_form" id="verify_form" action="<?php echo $url.'&page='.$pg;?>" method="post" onsubmit="">
	<input type="hidden" name="thepid" id="thepid" value="" />
	<input type="hidden" name="thests" id="thests" value="" />	
	<?php if(is_array($HY_res)) { foreach($HY_res as $key => $thread) { ?>
<table name="ptbl" id="ptbl<?php echo $thread['pid']?>" border="1" cellspacing="0" cellpadding="0" width="99%" class="poststbl <?php if($thread['sig'] == 1) { ?>bg1<?php } if($thread['sig'] == 2) { ?>bg2<?php } ?>" align="center">
<tr>
<td width="70" height="30" align="center" style="text-align:center">
	<input type="hidden" name="pids[]" value="<?php echo $thread['pid']?>" />
	<input type="hidden" name="isit<?php echo $thread['pid']?>" value="<?php echo $thread['isit']?>" />
	<input type="hidden" name="status<?php echo $thread['pid']?>" value="<?php echo $thread['status']?>" />
	<input type="hidden" name="tsubject<?php echo $thread['pid']?>" value="<?php echo htmlspecialchars($thread['tsubject'])?>" />
	<input type="hidden" name="invisible<?php echo $thread['pid']?>" value="<?php echo $thread['invisible']?>" />
	<input type="hidden" name="textid<?php echo $thread['pid']?>" value="<?php echo $thread['textid']?>" />
	<input type="hidden" name="title<?php echo $thread['pid']?>" value="<?php echo $thread['title']?>" />
	<input type="hidden" name="text<?php echo $thread['pid']?>" value="<?php echo $thread['messages']?>" />
	<input type="hidden" name="author<?php echo $thread['pid']?>" value="<?php echo $thread['theauthor']?>" />
	<input type="hidden" name="userid<?php echo $thread['pid']?>" value="<?php echo $thread['authorid']?>" />
	<input type="hidden" name="threadid<?php echo $thread['pid']?>" value="<?php echo $thread['tid']?>" />
	<input type="hidden" name="class<?php echo $thread['pid']?>" value="<?php echo $thread['fid']?>" />
	<input type="hidden" name="date<?php echo $thread['pid']?>" value="<?php echo $thread['dateline']?>" />
	<input type="hidden" name="ip<?php echo $thread['pid']?>" value="<?php echo $thread['luseip']?>" />
	<input type="hidden" name="first<?php echo $thread['pid']?>" value="<?php echo $thread['first']?>" />
	<input type="hidden" name="sig<?php echo $thread['pid']?>" value="<?php echo $thread['sig']?>" />
	<input type="hidden" name="url<?php echo $thread['pid']?>" value="http://<?php echo $_SERVER['SERVER_NAME']?>/viewthread.php?tid=<?php echo $thread['tid']?>" />

	<?php if($thread['sig'] == 1) { ?><font color="blue">建议<br />通过</font><?php } elseif($thread['sig'] == 2) { ?><font color="red">建议<br /> 删除</font><?php } elseif($thread['sig'] == 3) { ?><font color="#FFCC00">建议<br /> 审核</font><?php } else { ?><font color="#000000"> 等待<br /> 处理</font><?php } ?>
</td>
<td>
	<a href="forumdisplay.php?fid=<?php echo $thread['fid']?>" target="_blank"><?php echo $boards[$thread['fid']]['name']?></a> &raquo; 
	<a href="viewthread.php?tid=<?php echo $thread['tid']?>" target="_blank"><?php echo $thread['tsubject']?></a> 
	<?php if(!$thread['first']) { ?> &raquo;<?php if($thread['subject']) { ?><?php echo $thread['subject']?><?php } else { ?>无标题<?php } } ?><br />
	作者：<?php echo $thread['author']?>&nbsp;&nbsp;
	主题ID：<?php echo $thread['tid']?>&nbsp;&nbsp; 
	帖子ID：<?php echo $thread['pid']?>&nbsp;&nbsp;
	IP：<a href="admincp.php?action=plugins&operation=config&identifier=bao10jie&mod=admin_search&sel_page=<?php echo $pn?>&sel_doer=<?php echo $selDoer?>&sel_time=<?php echo $selTime?>&sel_type=<?php echo $selType?>&sel_board=<?php echo $selBoard?>&sel_mode=<?php echo $selMode?>&sel_ip=<?php echo urlencode(base64_encode($thread['useip']))?>"><?php echo $thread['useip']?></a>&nbsp;&nbsp;
	发布时间：<?php echo $thread['dateline']?>&nbsp;&nbsp;
	标引时间：<?php echo $thread['sendtime']?>&nbsp;&nbsp;
	状态：
	<?php if($thread['isit'] == 1) { ?>
	<font color="blue">已通过</font>&nbsp;
		<?php if($thread['isignore'] == 0) { ?>
			<!--<font color="black">未确认</font>-->
		<?php } if($thread['isignore'] == 1) { ?>
			(<font color="green">已确认</font>)
		<?php } if($thread['isignore'] == 2) { ?>
			(<font color="red">已忽略</font>)
		<?php } ?>
	<?php } if($thread['isit'] == 2) { ?>
	<font color="black">待审核</font>&nbsp;
		<?php if($thread['isignore'] == 0) { ?>
			<!--<font color="black">未确认</font>-->
		<?php } if($thread['isignore'] == 1) { ?>
			(<font color="green">已确认</font>)
		<?php } if($thread['isignore'] == 2) { ?>
			(<font color="red">已忽略</font>)
		<?php } ?>
	<?php } if($thread['isit'] >= 3) { ?>
	<font color="red">已删除</font>&nbsp;
		<?php if($thread['isignore'] == 0) { ?>
			<!--<font color="black">未确认</font>-->
		<?php } if($thread['isignore'] == 1) { ?>
			(<font color="green">已确认</font>)
		<?php } if($thread['isignore'] == 2) { ?>
			(<font color="red">已忽略</font>)
		<?php } ?>
	<?php } ?>
</td>
</tr>
<tr>
	<td align="center">
		<label><input class="sts_check" type="radio" id="pass_<?php echo $thread['pid']?>" name="sts<?php echo $thread['pid']?>" value="1"
		onclick="chgbg(<?php echo $thread['pid']?>, 1)" <?php if($thread['sig'] == 1) { ?>checked<?php }?> />通过</label><br />
		<label><input class="sts_check" type="radio" id="del_<?php echo $thread['pid']?>" name="sts<?php echo $thread['pid']?>" value="2"
		onclick="chgbg(<?php echo $thread['pid']?>, 2)" <?php if($thread['sig'] == 2) { ?>checked<?php }?> />删除</label><br />
		<label><input class="sts_check" type="radio" id="ignore_<?php echo $thread['pid']?>" name="sts<?php echo $thread['pid']?>" value="3" 
		onclick="chgbg(<?php echo $thread['pid']?>, 3)" />忽略</label><br />
	</td>
	<td id="mod_80_row2">
		<div style="width:100%;overflow: auto; overflow-x: hidden; max-height:120px; height:auto !important; height:120px; word-break: break-all;"><?php echo $thread['message']?></div>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<div class="pmdiv">
			<input type="submit" name="passsub" id="passsub" value="通过" class="alonesub" onclick="javascript:chgsts(<?php echo $thread['pid'] ?>, 1)" />&nbsp;
			<input type="submit" name="passsub" id="passsub" value="删除" class="alonesub" onclick="javascript:chgsts(<?php echo $thread['pid'] ?>, 2)" />&nbsp;
			<input type="submit" name="passsub" id="passsub" value="忽略" class="alonesub" onclick="javascript:chgsts(<?php echo $thread['pid'] ?>, 3)" />&nbsp;
			<!--<a href="javascript:void(0);" onclick="javascript:chgsts(<?php echo $thread['pid'] ?>, 1)">通过</a>&nbsp;
			<a href="javascript:void(0);" onclick="javascript:chgsts(<?php echo $thread['pid'] ?>, 2)">删除</a>&nbsp;
			<a href="javascript:void(0);" onclick="javascript:chgsts(<?php echo $thread['pid'] ?>, 3)">忽略</a>&nbsp;-->
			<a href="post.php?action=edit&fid=<?php echo $thread['fid']?>&tid=<?php echo $thread['tid']?>&pid=<?php echo $thread['pid']?>&page=1&modthreadkey=<?php echo $thread['modthreadkey']?>" target="_blank" style="background:#fff;padding:2px 3px 0 3px;">编辑</a>
			&nbsp; | &nbsp;操作理由
		</div>
		<div class="pmdiv">
			<input type="text" name="reasons<?php echo $thread['pid']?>" id="reasons<?php echo $thread['pid']?>" />
		</div>
		<div class="tmdbq">
			<select name="rson<?php echo $thread['pid']?>" id="rson<?php echo $thread['pid']?>" onchange="chgreason(<?php echo $thread['pid']?>)">
				<option value="">无</option>
				<?php echo $tipopts?>
			</select>
		</div>
	</td>
</tr>
</table>

<?php } } ?>

<table border="0" cellpadding="5" cellspacing="5" width="100%" style="margin-bottom:25px;">
<tr>
	<td width="250" align="left">&nbsp;
		<a href="javascript:;" onclick="chgchk(1)">全部通过</a>&nbsp;&nbsp;
		<a href="javascript:;" onclick="chgchk(2)">全部删除</a>&nbsp;&nbsp;
		<a href="javascript:;" onclick="chgchk(3)">全部忽略</a>&nbsp;&nbsp;
		<a href="javascript:;" onclick="chgchk(0)">全部取消</a>
	</td>
<td width="70" align="left">
	<input type="submit" name="handin" id="handin" value="提交" class="button" />
</td>
<td align="right" class="pagebar" style="text-align:right">
<?php echo $pager?>
</td>
</tr>
</table>
</form>

<?php } else { ?>

<center><font color="red"><b>没有符合条件的内容!</b></font>
</br></br>
<div class="pagebar" style="width:98%;text-align:right;">
<?php echo $pager?>
</div>
</center>
<?php } ?>

</div>






