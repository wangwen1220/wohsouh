<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<form name="form1" action="?m=special&c=special&a=special_position_select&typeid=<?php echo $pos_id?>" method="post">
<div class="pad-10">
	<div style="float:left; width:466px; padding:2px; margin-left:10px; margin-right:10px;">
	专题：<input type="text" name="title" value="" />
	<input type="submit" name="submit" value="搜索"/>
	</div>
</div>
</form>
<form id='myform' name="myform" action="" method="post">
<div class="pad-10"> 
	<div style="float:left; width:466px; padding:2px; border:1px solid #d8d8d8; margin-left:10px; margin-top:10px; margin-right:10px;">
		<table width="100%" cellspacing="0" class="table-list">
			<thead>
				<tr>
					<th width="100">专题ID</th>
					<th>专题</th>
					<th>创建时间</th>
				</tr>
			</thead>
			<tbody id="load_catgory">
				<?php foreach($isspecial as $r) { ?>
				<tr title="点击选择" onclick="select_list(this,'<?php echo $r['title']?>',<?php echo $r['id']?>)">
					<td align="center"><?php echo $r['id']?></td>
					<td align="center"><?php echo $r['title']?></td>
					<td align="center"><?php echo date('Y-m-d',$r['createtime'])?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<div style="overflow:hidden;_float:left;margin-top:10px;*margin-top:0;_margin-top:0">
		<fieldset>
		<legend>已选专题</legend>
		<!--<input type="hidden" value="1" name="siteid" id="siteid" />-->
		<input type='hidden' name='ids' value="" id="relation" />
		<ul id="catname" class="list-dot-othors">
			<?php foreach($isselected as $r) { ?>
			<li><span class='old'><?php echo $r['special_name']?></span></li>
			<?php }?>
		</ul>
		</fieldset>
	</div>
</div>
<input id="dosubmit" class="dialog" type="submit" value="提交" name="dosubmit">
</form>

<style type="text/css">
	.table-list tbody tr{ cursor: pointer; }
	.table-list tr.selected{background-color:#FFFFF4;}
	.table-list tr.selected:hover{cursor: default; }
	.table-list tr:hover{ background-color:#fbffe4; cursor: pointer; }
	.list-dot-othors li{float:none; width:auto}
	.list-dot-othors li:hover{background-color: #f8f8f8;}
	.list-dot-othors li .old{color:#666;}
	.subnav{ display: none; }/* 无内容暂时隐藏 */
</style>

<script>
<!--
// 已存在的名称加底色
$("#catname .old").each(function(){
	var name = this.innerHTML;
	$('#load_catgory td:contains("'+name+'")').parent().addClass('selected').attr('title', '已经选择了');
});
function select_list(obj,title,id,url) {
	if(!$(obj).hasClass('selected')){
		//var relation_val = $('#relation').val();
		var sid = 'v'+id,
			classid = $(obj).find('.classid').val();
		$(obj).addClass('selected ' + sid).attr('title', '已经选择了');
		var str = '<li id="'+sid+'" class="newadd" data-id="'+id+'"><input type="hidden" class="data" value=\'{"name": "'+title+'", "id": "'+id+'", "url": "'+url+'", "classid": "'+classid+'"}\' /><span>'+title+'</span><a href="javascript:;" class="close" onclick=\'remove_id("'+sid+'")\'></a></li>';
		$('#catname').append(str);
	}
}
function change_siteid(siteid) {
	$("#load_catgory").load("?m=content&c=content&a=public_getsite_categorys&siteid="+siteid);
	$("#siteid").val(siteid);
}
//移除ID
function remove_id(id) {
	$('#'+id).remove();
	$('#load_catgory .'+id).removeClass('selected');
}

//AJAX提交
$('#myform').submit(function(){
	var url = window.parent.$('#atrDialogIframe_associated_label').attr('src'),
		data = [];
	$('#catname li.newadd').each(function(i){
		data.push(this.id.slice(1));
	});
	$.post(url + '&ajax_select=yes&postid='+<?php echo $pos_id?>, {"data": data}, function(d){
		//if(d == 1){
			window.top.right.location.reload();
			//window.top.art.dialog().close();
			window.top.$('.aui_close').click();
		//}
	});
	return false;
});

//change_siteid(1);
//-->
</script>
