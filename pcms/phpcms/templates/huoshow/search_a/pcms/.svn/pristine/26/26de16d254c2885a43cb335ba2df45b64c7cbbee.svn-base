<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>

<div class="pad_10">
	<div class="table-list">
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="5%">ID</th>
					<th width="30%">推荐位名称</th>
					<th width="20%">管理操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($datas as $r) { ?>
				<tr>
					<td align="center"><?php echo $r['posid']?></td>
					<td align="center"><?php echo $r['name']?></td>
					<td align="center"><a href="javascript:edit('<?php echo $r['posid']?>','<?php echo trim(new_addslashes($r['name']))?>')"><?php echo L('edit');?></a> | <a href="javascript:;" onclick="data_delete(this,'<?php echo $r['posid']?>','确定删除《<?php echo trim(new_addslashes($r['name']));?>》推荐位？此操作不可恢复！')"><?php echo L('delete')?></a> | <a href="?m=community&c=position&a=posdata_item&posid=<?php echo $r['posid']?>">信息管理</a></td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
		<div ><?php echo $page_str;?></div>
	</div>
</div>
<script type="text/javascript"> 
<!--
window.top.$('#display_center_id').css('display','none');
function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'修改推荐位《'+name+'》',id:'edit',iframe:'?m=community&c=position&a=edit&typeid='+id,width:'540',height:'200'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}
function associated_label(id, name) {
	window.top.art.dialog({id:'associated_label'}).close();
	window.top.art.dialog({title:'分类《'+name+'》关联标签',id:'associated_label',iframe:'?m=community&c=communityey&a=community_class_associated_label&typeid='+id,width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'associated_label'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'associated_label'}).close()});
}
function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'data_delete'}, 
	function(){
	$.get('?m=community&c=position&a=del&typeid='+id+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};
//-->
</script>