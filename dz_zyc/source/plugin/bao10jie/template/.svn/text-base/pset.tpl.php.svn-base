<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style type="text/css">
.selinp {
	width: 200px;
	height: 19px;
	line-height: 19px;
	border: 1px solid #ccc;
	background: #fff;
}

.boardtbl {
	width: 700px;
}

.boardtbl tr {
	height: 25px;
	line-height: 25px;
	background:
		url(<?php echo HL_PLUGIN_PATH; ?>/bao10jie/calendar/line.gif) bottom
		repeat-x;
}

.initbl td {
	line-height: 25px;
}

.chkbg {
	background: #fff;
	border: 0;
}

label input {
	margin: -2px 1px;
}
</style>
<? if($saveOK < 2) { ?>

<div id="append_parent"></div>
<div class="container" id="cpcontainer">
<h3>Discuz! 提示</h3>
<div class="infobox">
<h4 class="infotitle2"><? if($saveOK == 0) { ?> <font color="red">抱歉！保存失败，请检查本插件的配置文件是否有可写权限</font>
<? }elseif($saveOK == -1) { ?> 您的设置已经保存成功! <br />
<font color="red">但是，您的服务器连接不到保10洁服务，请检查配置文件中的API地址或服务器的DNS设置！</font> <? } elseif($saveOK == -2) { ?>
您的设置已经保存成功! <br />
<font color="red">但是，您的服务器连接不到本插件的代理页面，请在配置文件中进行手工设置！</font> <? }elseif($saveOK == -3) { ?>
<font color="red"> 抱歉！保存失败，请检查本插件的配置文件是否有可写权限 <br />
您的服务器连接不到保10洁服务，请检查配置文件中的API地址或服务器的DNS设置！ </font> <? }elseif($saveOK == -4) { ?>
<font color="red">抱歉！保存失败，请检查本插件的配置文件是否有可写权限 <br />
您的服务器连接不到本插件的代理页面，请在配置文件中进行手工设置！</font> <? } else {?> 您的设置已经保存成功! <? } ?>
<br />
</h4>
<? if(HL_VERSION == "X2" || HL_VERSION == "X1.5"){ ?>
<p class="marginbot"><a
	href="admin.php?action=plugins&operation=config&identifier=bao10jie&pmod=admin_set"
	class="lightlink">如果您的浏览器没有自动跳转，请点击这里</a></p>
<script type="text/JavaScript">setTimeout("redirect('admin.php?action=plugins&operation=config&identifier=bao10jie&pmod=admin_set');", 3000);</script>
<? }else{ ?>
<p class="marginbot"><a
	href="admincp.php?action=plugins&operation=config&identifier=bao10jie&mod=admin_set"
	class="lightlink">如果您的浏览器没有自动跳转，请点击这里</a></p>
<script type="text/JavaScript">setTimeout("redirect('admincp.php?action=plugins&operation=config&identifier=bao10jie&mod=admin_set');", 3000);</script>
<? } ?></div>
</div>

<? } else { ?>
<script
	src="<?php echo HL_PLUGIN_PATH; ?>/bao10jie/js/jquery.js"
	type="text/javascript"></script>
<script language="javascript">

//回显各种状态
//$(function(){
//	$(selClass('.board_a')).each(function(){
//		var sid = $(this).attr('sid');
//		$(this).change(function(){
//			hideAll(sid, $(this));
//		});
//	});
//});

//分区调整其下对应列的状态
function chgAll(ty, d)
{
	var oo = $('#'+ty+d);
	var gval = oo.val();
	var oid = oo.attr('sid');
	
	var objArr = selClass('.'+ty+d);
	for(var i=0;i<objArr.length;i++){
		if($(objArr[i]).attr('disabled') != 'disabled'){
			var sel0 = sel1 = sel2 = '';
			eval('sel'+gval+'=" selected";');

			if(ty == 'board_a'){
				$(objArr[i]).html('<option value="0"'+sel0+'>关闭</option><option value="1"'+sel1+'>识别不处理</option><option value="2"'+sel2+'>识别并处理</option>');
				hideAll($(objArr[i]).attr('sid'), objArr[i]);
			}else{
				$(objArr[i]).html('<option value="2"'+sel2+'>删除</option><option value="0"'+sel0+'>通过</option><option value="1"'+sel1+'>待审</option>');
			}
		}
	}
	
	
	if(ty == 'board_a'){
		if(gval != 2){
			$('#board_b'+oid).attr('disabled', true);
			$('#board_c'+oid).attr('disabled', true);
			$('#board_d'+oid).attr('disabled', true);
		}else{
			$('#board_b'+oid).attr('disabled', false);
			$('#board_c'+oid).attr('disabled', false);
			$('#board_d'+oid).attr('disabled', false);
		}
	}

	if(ty == 'board_a'){
		oo.html('<option value="3">分区设置为</option><option value="0">关闭</option><option value="1">识别不处理</option><option value="2">识别并处理</option>');
	}else{
		oo.html('<option value="3">分区设置为</option><option value="2">删除</option><option value="0">通过</option><option value="1">待审</option>');
	}
	
	return true;
}

//全局调整其下所有对应列的状态
function pchgAll(ty, d)
{
	var dv = $('#'+d).val();

	if(dv == 3) return true;
	var objArr;
	var i;
	objArr = selClass('.'+ty);
	for(i=0;i<objArr.length;i++){
		if($(objArr[i]).attr('disabled') != 'disabled'){
			var sel0 = sel1 = sel2 = '';
			eval('sel'+dv+'=" selected";');
			if(ty == 'board_a'){
				$(objArr[i]).html('<option value="0"'+sel0+'>关闭</option><option value="1"'+sel1+'>识别不处理</option><option value="2"'+sel2+'>识别并处理</option>');
			}else{
				$(objArr[i]).html('<option value="2"'+sel2+'>删除</option><option value="0"'+sel0+'>通过</option><option value="1"'+sel1+'>待审</option>');
			}
		}
	}

	if(ty == 'board_a'){
		$('#'+d).html('<option value="3">全部设置为</option><option value="0">关闭</option><option value="1">识别不处理</option><option value="2">识别并处理</option>');
	}else{
		$('#'+d).html('<option value="3">全部设置为</option><option value="2">删除</option><option value="0">通过</option><option value="1">待审</option>');
	}
	
	if(d == 'boards_a0'){
		objArr = selClasses('.boards_b,.boards_c,.boards_d');
		if(dv != 2){
			for(i=0;i<objArr.length;i++){
				$(objArr[i]).attr('disabled', true);
			}
		}else{
			for(i=0;i<objArr.length;i++){
				$(objArr[i]).attr('disabled', false);
			}
		}
	}

	if(dv != 2 && ty == 'board_a'){
		objArr = selClasses('.board_b,.board_c,.board_d');
		for(i=0;i<objArr.length;i++){
			$(objArr[i]).html('<option value="">请选择</option>');
			$(objArr[i]).attr('disabled', true);
		}

	}else if(ty == 'board_a'){
		objArr = selClasses('.board_b');
		for(i=0;i<objArr.length;i++){
			$(objArr[i]).html('<option value="2" selected>删除</option><option value="0">通过</option><option value="1">待审</option>');
			$(objArr[i]).attr('disabled', false);
		}

		objArr = selClasses('.board_c');
		for(i=0;i<objArr.length;i++){
			$(objArr[i]).html('<option value="2">删除</option><option value="0">通过</option><option value="1" selected>待审</option>');
			$(objArr[i]).attr('disabled', false);
		}

		objArr = selClasses('.board_d');
		for(i=0;i<objArr.length;i++){
			$(objArr[i]).html('<option value="2">删除</option><option value="0" selected>通过</option><option value="1">待审</option>');
			$(objArr[i]).attr('disabled', false);
		}
	}
	return true;
}

//根据每行第一个下拉框的值，调整其后对应行的状态
function hideAll(sid, obj)
{
	if($(obj).val() == 0 || $(obj).val() == 1){
		$('#board_b'+sid).html('<option value="">请选择</option>');
		$('#board_b'+sid).attr('disabled', true);
		$('#board_c'+sid).html('<option value="">请选择</option>');
		$('#board_c'+sid).attr('disabled', true);
		$('#board_d'+sid).html('<option value="">请选择</option>');
		$('#board_d'+sid).attr('disabled', true);
	}else{
		$('#board_b'+sid).html('<option value="2" selected>删除</option><option value="0">通过</option><option value="1">待审</option>');
		$('#board_b'+sid).attr('disabled', false);
		$('#board_c'+sid).html('<option value="2">删除</option><option value="0">通过</option><option value="1" selected>待审</option>');
		$('#board_c'+sid).attr('disabled', false);
		$('#board_d'+sid).html('<option value="2">删除</option><option value="0" selected>通过</option><option value="1">待审</option>');
		$('#board_d'+sid).attr('disabled', false);
	}

	return true;
}
function selClasses(clns){
	var cln = clns.replace(/ |\t|\./g, '').split(',');
	var reArr = [];
	var temp;
	for(var i=0;i<cln.length;i++){
		temp = 	selClass(cln[i]);
		if(temp.length>0){
			reArr = reArr.concat(temp);
		}
	}
	return reArr;
}
function selClass(cln)
{
	var objs = document.getElementsByTagName('select');
	var obj = new Array();
	var j = 0, k = 0, m = 0, n = 0;
	var cln = cln.replace(/ |\t|\./g, '');
//alert(cln);
	for(var j in objs){
		var oo = null;
		try{
			oo = objs[j].className;
		}catch(e){

		}

		if('undefined' != oo && null != oo && '' != oo){
			var cls = oo.split(' ');

			for(m in cls){
				
					if('' != cls[m] && '' != cln[n] && cls[m] == cln){
						obj[k++] = objs[j];
					}
				
			}
		}
	}

	return obj;
}

function chkini()
{
	if(confirm('更改设置将会影响到帖子的处理效果。\r\n\r\n你确定这样做吗？')){
		return true;
	}
	return false;
}

</script>

<form action="" method="post" name="ini_form" id="ini_form"
	onsubmit="return chkini();">
<table width="99%" border="0" class="initbl" style="background: #fff;">
	<tr>
		<td height="40" valign="bottom" style="font-size: 13px"><b>版块设置：</b></td>
	</tr>
	<tr>
		<td>
		<table width="99%" border="0" cellpadding="0" cellspacing="0"
			class="boardtbl">
			<tr align="center" height="20">
				<td align="left" width="220"><b>版块名称</b></td>
				<td><b>是否识别</b></td>
				<td><b>垃圾处理</b></td>
				<td><b>疑似处理</b></td>
				<td><b>正常处理</b></td>
			</tr>
			<tr align="center">
				<td align="left" height="33">全局版块设置(对所有板块操作)</td>
				<td><select id="boards_a0"
					onchange="pchgAll('board_a', 'boards_a0')" style="width: 95px">
					<option value="3">全部设置为</option>
					<option value="0">关闭</option>
					<option value="1">识别不处理</option>
					<option value="2">识别并处理</option>
				</select></td>
				<td><select id="boards_b0"
					onchange="pchgAll('board_b', 'boards_b0')" style="width: 95px">
					<option value="3">全部设置为</option>
					<option value="2">删除</option>
					<option value="0">通过</option>
					<option value="1">待审</option>
				</select></td>
				<td><select id="boards_c0"
					onchange="pchgAll('board_c', 'boards_c0')" style="width: 95px">
					<option value="3">全部设置为</option>
					<option value="2">删除</option>
					<option value="0">通过</option>
					<option value="1">待审</option>
				</select></td>
				<td><select id="boards_d0"
					onchange="pchgAll('board_d', 'boards_d0')" style="width: 95px">
					<option value="3">全部设置为</option>
					<option value="2">删除</option>
					<option value="0">通过</option>
					<option value="1">待审</option>
				</select></td>
			</tr>

			<? if(is_array($pgroups)) { foreach($pgroups as $kg => $group) { ?>

			<tr align="center">
				<td align="left" height="33"><?=$group['name']?></td>
				<td><select class="boards_a board_a010" sid="<?=$group['fid']?>"
					name="board_a<?=$group['fid']?>" id="board_a<?=$group['fid']?>"
					onchange="chgAll('board_a', <?=$group['fid']?>)"
					style="font-weight: normal; width: 95px">
					<option value="3">分区设置为</option>
					<option value="0">关闭</option>
					<option value="1">识别不处理</option>
					<option value="2">识别并处理</option>
				</select></td>
				<td><select class="boards_b board_b010"
					name="boards_b<?=$group['fid']?>" id="board_b<?=$group['fid']?>"
					onchange="chgAll('board_b', <?=$group['fid']?>)"
					style="font-weight: normal; width: 95px">
					<option value="3">分区设置为</option>
					<option value="2">删除</option>
					<option value="0">通过</option>
					<option value="1">待审</option>
				</select></td>
				<td><select class="boards_c board_c010"
					name="boards_c<?=$group['fid']?>" id="board_c<?=$group['fid']?>"
					onchange="chgAll('board_c', <?=$group['fid']?>)"
					style="font-weight: normal; width: 95px">
					<option value="3">分区设置为</option>
					<option value="2">删除</option>
					<option value="0">通过</option>
					<option value="1">待审</option>
				</select></td>
				<td><select class="boards_d board_d010"
					name="boards_d<?=$group['fid']?>" id="board_d<?=$group['fid']?>"
					onchange="chgAll('board_d', <?=$group['fid']?>)"
					style="font-weight: normal; width: 95px">
					<option value="3">分区设置为</option>
					<option value="2">删除</option>
					<option value="0">通过</option>
					<option value="1">待审</option>
				</select></td>
			</tr>
			<? if($pforumtop[$group['fid']]) { if(is_array($pforumtop[$group['fid']])) { foreach($pforumtop[$group['fid']] as $kt => $tforum) { ?>
			<tr onmousemove="javascript:this.style.backgroundColor='#E8F3FD';"
				onmouseout="javascript:this.style.backgroundColor='#ffffff';"
				align="center">
				<td align="left"
					class="<? if(count($pforumtop[$group['fid']])-1 != $kt) { ?>board<? } else { ?>lastboard<? } ?>"><?=$tforum['name']?></td>
				<td><select sid="<?=$tforum['fid']?>"
					name="board_a[<?=$tforum['fid']?>]"
					class="board_a board_a<?=$group['fid']?>" 
					onchange="hideAll('<?=$tforum['fid']?>', this);" 
					style="width: 95px">
					<option value="0"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['0'] === 0) { ?>
						selected <? } ?>>关闭</option>
					<option value="1"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['0'] == 1 || !isset($Purify_BOARDS_IDENTIFY[$tforum['fid']]['0'])) { ?>
						selected <? } ?>>识别不处理</option>
					<option value="2"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['0'] == 2) { ?>
						selected <? } ?>>识别并处理</option>
				</select></td>
				<td><select name="board_b[<?=$tforum['fid']?>]"
					class="board_b board_b<?=$group['fid']?>"
					id="board_b<?=$tforum['fid']?>" style="width: 95px"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['0'] != 2) { ?>
					disabled <? } ?>>
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['0'] != 2) { ?>
					<option value="">请选择</option>
					<? }else{ ?>
					<option value="2"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['1'] == 2) { ?>
						selected <? } ?>>删除</option>
					<option value="0"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['1'] === 0) { ?>
						selected <? } ?>>通过</option>
					<option value="1"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['1'] == 1 || !isset($Purify_BOARDS_IDENTIFY[$tforum['fid']]['1'])) { ?>
						selected <? } ?>>待审</option>
						<? } ?>
				</select></td>
				<td><select name="board_c[<?=$tforum['fid']?>]"
					class="board_c board_c<?=$group['fid']?>"
					id="board_c<?=$tforum['fid']?>" style="width: 95px"
						<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['0'] != 2) { ?>
					disabled <? } ?>>
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['0'] != 2) { ?>
					<option value="">请选择</option>
					<? }else{ ?>
					<option value="2"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['2'] == 2) { ?>
						selected <? } ?>>删除</option>
					<option value="0"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['2'] === 0) { ?>
						selected <? } ?>>通过</option>
					<option value="1"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['2'] == 1 || !isset($Purify_BOARDS_IDENTIFY[$tforum['fid']]['2'])) { ?>
						selected <? } ?>>待审</option>
						<? } ?>
				</select></td>
				<td><select name="board_d[<?=$tforum['fid']?>]"
					class="board_d board_d<?=$group['fid']?>"
					id="board_d<?=$tforum['fid']?>" style="width: 95px"
						<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['0'] != 2) { ?>
					disabled <? } ?>>
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['0'] != 2) { ?>
					<option value="">请选择</option>
					<? }else{ ?>
					<option value="2"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['3'] == 2) { ?>
						selected <? } ?>>删除</option>
					<option value="0"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['3'] === 0 || !isset($Purify_BOARDS_IDENTIFY[$tforum['fid']]['3'])) { ?>
						selected <? } ?>>通过</option>
					<option value="1"
					<? if($Purify_BOARDS_IDENTIFY[$tforum['fid']]['3'] == 1) { ?>
						selected <? } ?>>待审</option>
						<? } ?>
				</select></td>
			</tr>

			<? if($pforumsub[$tforum['fid']]) { if(is_array($pforumsub[$tforum['fid']])) { foreach($pforumsub[$tforum['fid']] as $ks => $sforum) { ?>
			<tr onmousemove="javascript:this.style.backgroundColor='#E8F3FD';"
				onmouseout="javascript:this.style.backgroundColor='#ffffff';"
				align="center">
				<td align="left"
					class="<? if(count($pforumsub[$tforum['fid']])-1 != $ks) { ?>childboard<? } else { ?>lastchildboard<? } ?>"><?=$sforum['name']?></td>
				<td><select sid="<?=$sforum['fid']?>"
					name="board_a[<?=$sforum['fid']?>]"
					class="board_a board_a<?=$group['fid']?>" style="width: 95px">
					<option value="0"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['0'] === 0) { ?>
						selected <? } ?>>关闭</option>
					<option value="1"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['0'] == 1 || !isset($Purify_BOARDS_IDENTIFY[$sforum['fid']]['0'])) { ?>
						selected <? } ?>>识别不处理</option>
					<option value="2"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['0'] == 2) { ?>
						selected <? } ?>>识别并处理</option>
				</select></td>
				<td><select name="board_b[<?=$sforum['fid']?>]"
					class="board_b board_b<?=$group['fid']?>"
					id="board_b<?=$sforum['fid']?>" style="width: 95px"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['0'] != 2) { ?>
					disabled <? } ?>>
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['0'] != 2) { ?>
					<option value="">请选择</option>
					<? }else{ ?>
					<option value="2"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['1'] == 2) { ?>
						selected <? } ?>>删除</option>
					<option value="0"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['1'] === 0) { ?>
						selected <? } ?>>通过</option>
					<option value="1"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['1'] == 1 || !isset($Purify_BOARDS_IDENTIFY[$sforum['fid']]['1'])) { ?>
						selected <? } ?>>待审</option>
						<? } ?>
				</select></td>
				<td><select name="board_c[<?=$sforum['fid']?>]"
					class="board_c board_c<?=$group['fid']?>"
					id="board_c<?=$sforum['fid']?>" style="width: 95px"
						<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['0'] != 2) { ?>
					disabled <? } ?>>
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['0'] != 2) { ?>
					<option value="">请选择</option>
					<? }else{ ?>
					<option value="2"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['2'] == 2) { ?>
						selected <? } ?>>删除</option>
					<option value="0"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['2'] === 0) { ?>
						selected <? } ?>>通过</option>
					<option value="1"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['2'] == 1 || !isset($Purify_BOARDS_IDENTIFY[$sforum['fid']]['2'])) { ?>
						selected <? } ?>>待审</option>
						<? } ?>
				</select></td>
				<td><select name="board_d[<?=$sforum['fid']?>]"
					class="board_d board_d<?=$group['fid']?>"
					id="board_d<?=$sforum['fid']?>" style="width: 95px"
						<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['0'] != 2) { ?>
					disabled <? } ?>>
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['0'] != 2) { ?>
					<option value="">请选择</option>
					<? }else{ ?>
					<option value="2"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['3'] == 2) { ?>
						selected <? } ?>>删除</option>
					<option value="0"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['3'] === 0 || !isset($Purify_BOARDS_IDENTIFY[$sforum['fid']]['3'])) { ?>
						selected <? } ?>>通过</option>
					<option value="1"
					<? if($Purify_BOARDS_IDENTIFY[$sforum['fid']]['3'] == 1) { ?>
						selected <? } ?>>待审</option>
						<? } ?>
				</select></td>
			</tr>
			<? } } } } } } } } ?>
		</table>

		</td>
	</tr>
	<tr>
		<td height="40" valign="bottom" style="font-size: 13px"><b>已删除帖子在前台的显示方式：</b></td>
	</tr>
	<tr>
		<td height="30"><label><input type="radio" name="Purify_PURIFY_FIELD"
			value="invisible" id="ini_purify_field1"
			<? if($Purify_PURIFY_FIELD == 'invisible') { ?> checked="true"
			<? } ?> class="chkbg" />不显示——在前台帖子列表中不显示</label><br />
		<label><input type="radio" name="Purify_PURIFY_FIELD" value="status"
			id="ini_purify_field2" <? if($Purify_PURIFY_FIELD == 'status') { ?>
			checked="true" <? } ?> class="chkbg" />显示“屏蔽”字样——在前台帖子列表中显示‘屏蔽’字样</label><br />
		&nbsp;&nbsp;<font color="#999999">注：两种方式，在数据库中都不进行数据物理删除</font></td>
	</tr>

	<tr>
		<td height="40" valign="bottom"><b>每次补发脚本数量：</b></td>
	</tr>
	<tr>
		<td height="30"><input type="text" name="Purify_CALL_NUM"
			id="ini_call_num" value="<?php echo $Purify_CALL_NUM; ?>"
			style="width: 100px" /> <br />
		<font color="#999999">注：建议数量为5</font></td>
	</tr>
	<tr>
		<td height="40" valign="bottom" style="font-size: 13px"><b>记录日志：</b></td>
	</tr>
	<tr>
		<td height="30"><label><input type="radio" name="Purify_LOG_LEVEL"
			id="ini_log_level1" value="0" <? if($Purify_LOG_LEVEL == 0) { ?>
			checked="true" <? } ?> class="chkbg" />关闭&nbsp;&nbsp;</label> <label><input
			type="radio" name="Purify_LOG_LEVEL" id="ini_log_level2" value="1"
			<? if($Purify_LOG_LEVEL == 1) { ?> checked="true" <? } ?>
			class="chkbg" /><font color="green">正常</font>&nbsp;&nbsp;</label> <label><input
			type="radio" name="Purify_LOG_LEVEL" id="ini_log_level3" value="2"
			<? if($Purify_LOG_LEVEL == 2) { ?> checked="true" <? } ?>
			class="chkbg" />调试&nbsp;&nbsp;</label></td>
	</tr>
	<? if(HL_VERSION == "X2" || HL_VERSION == "X1.5"){ ?>
	<tr>
		<td height="40" valign="bottom" style="font-size: 13px"><b>启用分表：</b></td>
	</tr>
	<tr>
		<td height="30"><label><input type="radio" name="Purify_MULTI_POST"
			id="ini_mutli_post1" value="0" <? if($Purify_MULTI_POST == 0) { ?>
			checked="true" <? } ?> class="chkbg" />关闭&nbsp;&nbsp;</label> <label><input
			type="radio" name="Purify_MULTI_POST" id="ini_mutli_post2" value="1"
			<? if($Purify_MULTI_POST == 1) { ?> checked="true" <? } ?>
			class="chkbg" /><font color="green">启用</font>&nbsp;&nbsp;</label></td>
	</tr>
	<?php } ?>
	<tr>
		<td height="40""><input type="submit" name="handin" id="handin"
			class="btn button" value="提 交" /></td>
	</tr>
</table>

</form>

<? } ?>