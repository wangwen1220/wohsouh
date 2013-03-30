<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<style type="text/css">
	.subnav {
		display: none;
	}
	.table_form {
		margin-top: 18px;
	}
	.table_form tbody tr {
		border-bottom: 1px solid #f7f7f7;
	}
	.table_form tbody th, .table_form tbody td {
		border: none;
		padding: 12px 0;
	}
	.table_form tbody select {
		min-width: 80px;
	}
	.table_form tbody select,
	.table_form tbody input {
		border: 1px solid #CBE2E9;
	}
	#time {
		width: 80px;
	}
	#setTime {
		min-width: auto;
	}
</style>
<form action="?m=community&c=communityshare&a=community_status_share&topshare=yes" method="post" id="myform">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<th width="80"><strong>置顶：</strong></th>
		<td><label>
		  <select name="toptype">
		    <option value="3">首页置顶</option>
		    <option value="2">分类置顶</option>
		    <option value="1">全局置顶</option>
	      </select>
		</label></td>
	</tr>
	<tr>
		<th width="80"><strong>有效期：</strong></th>
		<td >
			<input type='text' id='time' name='time' value='一天' />
			<select name="setTime" id='setTime'>
				<option value="3">一天</option>
				<option value="2">12小时</option>
				<option value="1">1小时</option>
				<option value="0">自定义</option>
			</select>
			</td>
		<!-- <td height="250"><?php echo form::date('end_time',$_GET['end_time'],0,0,'false');?></td> -->
	</tr>
	<input type="hidden" name="h_name" value="<?php echo  $list_arr[0]['tag_name']?>">
</tbody>
</table>
<div class="bk15"></div>
<input type="hidden" name="id" value="<?php echo $id?>"/>
<input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class='dialog'>&nbsp;
<input type="reset" value=" <?php echo L('clear')?> " class='dialog'>
</form>
<link href="<?php echo CSS_PATH?>dialog.css" rel="stylesheet" type="text/css" />
<script src="<?php echo JS_PATH?>dialog.js" type="text/javascript"></script>
<script>
	// 提交表单
	$('#myform').ajaxForm({
		success: function(d){
			if(d == 1){
				parent.art.dialog('置顶操作成功，两秒后窗口自动关闭！').time(2);
				parent.art.dialog({id:'edit'}).close();
			}else if(d == '置顶个数超过3个，请先取消置顶'){
				alert('置顶个数超过3个，请先取消置顶！');
			}else{
				alert('提交失败，请联系管理员！');
			}
		}
	});

	//选择有效期
	$('#setTime').change(function(){
		var $ths = $("option:selected", this),
			$time = $('#time'),
			text = $ths.text();
		if(text == '自定义'){
			art.dialog('<div id="customeTime"><input type="text" id="hour" style="width:50px" /> 点 <input type="text" id="second" style="width:50px" /> 分</div>', function(){
				var dateNow = new Date();
				//var time = dateNow.getFullYear() + '' + dateNow.getMonth() + 1 + '' + dateNow.getDate() + ' ' + $('#hour').val() + ':' + $('#second').val();
				var time = $('#hour').val() + ':' + $('#second').val();
				$time.val(time);
			});
		}else{
			$time.val(text);
		}
	});
</script>