<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="subnav">
	<div class="content-menu ib-a blue line-x"><?php echo $list_menu?> | <a class="on" href="javascript:add('<?php echo $type_id?>','添加属性类型')"><em>添加属性类型</em></a></div>
</div>

<form name="myform" action="" method="post">
<div class="pad_10">
	<div class="table-list">
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="5%">ID</th>
					<th width="10%">类型名称</th>
					<th width="10%">操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($list_arr as $r) { ?>
				<tr>
					<td align="center"><?php echo $r[id]?></td>
					<td align="center"><?php echo $r[name]?></td>
					<td align="center"><a href="?m=special&c=special&a=special_property_last_list&id=<?php echo $r[id]?>">查看</a> | <a href="javascript:edit('<?php echo $r['id']?>','<?php echo trim(new_addslashes($r['name']))?>')"><?php echo L('edit');?></a> </td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
	</div>
</div>
</form>
<script type="text/javascript"> 
<!--
window.top.$('#display_center_id').css('display','none');
function add(id,name){
	window.top.art.dialog({id:'add'}).close();
	window.top.art.dialog({title:'添加类型',id:'add',iframe:'?m=special&c=special&a=special_add_type&typeid='+id,width:'540',height:'200'}, function(){var d = window.top.art.dialog({id:'add'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'add'}).close()});
}

function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'修改类型《'+name+'》',id:'edit',iframe:'?m=special&c=special&a=special_edit_class&typeid='+id,width:'540',height:'200'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}

function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'data_delete'}, 
	function(){
	$.get('?m=community&c=communityey&a=community_del_class&typeid='+id+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};
//-->
</script>