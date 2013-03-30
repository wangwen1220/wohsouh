<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>

<form name="myform" action="?m=community&c=communityey&a=community_class_listorder" method="post">
<div class="pad_10">
	<div class="table-list">
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="5%">排序</th>
					<th width="5%">ID</th>
					<th width="20%">分类名称</th>
					<th width="*">图标</th>
					<th width="30%">管理操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($list_arr as $r) { ?>
				<tr>
					<td align="center"><input type="text" name="listorders[<?php echo $r['id']?>]" value="<?php echo $r['order']?>" size="3" class='input-text-c'></td>
					<td align="center"><?php echo $r['id']?></td>
					<td align="center"><?php echo $r['name']?></td>
					<td align="center"><img width="30" height="30" src="<?php echo $r['pic']?>"/></td>
					<td align="center"><a href="javascript:edit('<?php echo $r['id']?>','<?php echo trim(new_addslashes($r['name']))?>')"><?php echo L('edit');?></a> | <a href="javascript:;" onclick="data_delete(this,'<?php echo $r['id']?>','<?php echo trim(new_addslashes($r['name']));?>')"><?php echo L('delete')?></a> | <!--<a href="javascript:associated_label('<?php //echo $r['id']?>','<?php //echo trim(new_addslashes($r['name']))?>')">关联标签</a>--><a href="?m=community&c=communityey&a=community_class_tagdata_item&classid=<?php echo $r['id']?>">关联标签</a></td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
	    <div class="btn"><input type="submit" class="button" name="dosubmit" value="<?php echo L('listorder')?>" /></div>  </div>
		<div><?php echo $page_str;?></div>
	</div>
</div>
</form>
<script type="text/javascript"> 
<!--
window.top.$('#display_center_id').css('display','none');
function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'修改分类《'+name+'》',id:'edit',iframe:'?m=community&c=communityey&a=community_edit_class&typeid='+id,width:'540',height:'200'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}
function associated_label(id, name) {
	window.top.art.dialog({id:'associated_label'}).close();
	window.top.art.dialog({title:'分类《'+name+'》关联标签',id:'associated_label',iframe:'?m=community&c=communityey&a=community_class_associated_label&typeid='+id,width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'associated_label'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'associated_label'}).close()});
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