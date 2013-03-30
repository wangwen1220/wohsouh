<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>

<form id='myform' name="myform" action="?m=community&c=position&a=add_position_data&posid=<?php echo $posid;?>" method="post">
<div class="pad-10">
	<div style="float:left; width:466px; padding:2px; border:1px solid #d8d8d8; margin-left:10px; margin-top:10px; margin-right:10px;">
		<table class="table-list" width="100%" cellspacing="0">
			<thead>
				<tr id='js-tab'>
					<th colspan='2'><span><a href='?m=community&c=position&a=posdata_select_info'>分类</a></span><span><a href='?m=community&c=position&a=posdata_select_info&list=2'>标签</a></span><span><a href='?m=community&c=position&a=posdata_select_info&list=3'>专辑</a></span></th>
				</tr>
				<tr>
					<th width="100">ID</th>
					<th>名称2</th>
				</tr>
			</thead>
			<tbody id="load_catgory">
			</tbody>
		</table>
	</div>
	<div style="overflow:hidden;_float:left;margin-top:10px;*margin-top:0;_margin-top:0">
		<fieldset>
		<legend>已选推荐名称</legend>
		<!--<input type="hidden" value="1" name="siteid" id="siteid" />-->
		<input type='hidden' name='ids' value="" id="relation" />
		<ul id="catname" class="list-dot-othors">
		<?php foreach($datas_list as $r) { ?>
			<li class='oldli'><span class='old'><?php echo $r['name']?></span></li>
		<?php }?>
		</ul>
		</fieldset>
	</div>
</div>
<input id="dosubmit" class="dialog" type="submit" value="提交" name="dosubmit">
</form>

<style type="text/css">
	.table-list tbody tr{ cursor: pointer; }
	.table-list thead th { cursor: default; }
	.table-list tr.selected{background-color:#FFFFF4;}
	.table-list tr.selected:hover{cursor: default; }
	.table-list tr:hover{ background-color:#fbffe4; cursor: pointer; }
	.list-dot-othors li{float:none; width:auto}
	.list-dot-othors li:hover{background-color: #f8f8f8;}
	.list-dot-othors li .old{color:#666;}
	.subnav{ display: none; }/* 无内容暂时隐藏 */
	#js-tab th {
		background-color: #C6D6FD;
	}
	#js-tab span {
		display: inline-block;
		width: 33%;
		height: 30px;
		line-height: 30px;
		text-align: center;
	}
	#js-tab span a:hover {
		color: #000;
	}
	.table-list thead th a {
		background: url("../images/sort.gif") no-repeat scroll 100% 50% transparent;
		display: inline-block;
		color: #000;
		font-size: 16px;
		outline: medium none;
		padding-right: 16px;
		text-decoration: underline;
	}
</style>

<script>
<!--
// 已存在的名称加底色
function select_list(obj,title,id,url) {
	if(!$(obj).hasClass('selected')){
		//var relation_val = $('#relation').val();
		var sid = 'v'+id;
		//var classid = $(obj).find('.classid').val();
		$(obj).addClass('selected ' + sid).attr('title', '已经选择了');
		var str = '<li id="'+sid+'"><input type="hidden" class="data" value=\'{"name": "'+title+'", "url": "'+url+'", "classid": "'+id+'"}\' /><span>'+title+'</span><a href="javascript:;" class="close" onclick=\'remove_id("'+sid+'")\'></a></li>';
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
$('#myform').submit(function(){
	var url = this.action,
		$input_data = $('#catname input.data'),
		datas = '',
		data;
	$input_data.each(function(i){
		if(datas == ''){
			datas = this.value;
		}else{
			datas = datas+', '+this.value;
		}
	});
	datas = '{"data": ['+datas+']}';
	data = jQuery.parseJSON(datas);
	$.post(url, data, function(d){
		if(d){
			window.parent.right.location.reload();
			window.top.art.dialog({id:'associated_label'}).close();
		}
	});
	return false;
});

// Tab 切换 AJAX 加载数据
$('#js-tab a').click(function(){
	$.get(this.href, function(d){
		if(d){
			$('#load_catgory').html(d);
			$('#catname li:[id]').remove('');
			$("#catname .old").each(function(){
				var name = this.innerHTML;
				$('#load_catgory td:contains("'+name+'")').parent().addClass('selected').attr('title', '已经选择了');
			});
		}else{
			alert('数据加载错误！');
		}
	});
	return false;
}).first().triggerHandler('click');

//change_siteid(1);
//-->
</script>
