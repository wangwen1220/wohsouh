<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>
<div style="margin-left:10px;padding:5px;">
<a class="add fb" href="javascript:associated_label('<?php echo $posid?>','选取新闻')"><font color="#FF0000">[选取新闻]</font></a>
</div>
<form name="myform" action="?m=community&c=position&a=listorder&posid=<?php echo $posid?>" method="post">
<div class="pad_10">
	<div class="table-list">
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="5%">排序</td>
					<th width="5%">ID</th>
					<th width="30%">名称</th>
					<th width="20%">管理操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($datas as $r) { ?>
				<tr>
					<td align="center"><input type="text" name="listorders[<?php echo $r['id']?>]" value="<?php echo $r['listorder']?>" size="3" class='input-text-c'></td>
					<td align="center"><?php echo $r['id']?></td>
					<td align="center"><?php echo $r['name']?></td>
					<td align="center"><a href="javascript:;" onclick="data_delete(this,'<?php echo $r['id']?>','确定删除《<?php echo trim(new_addslashes($r['name']));?>》此操作不可恢复！')"><?php echo L('delete')?></a></td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
	    <div class="btn"><input type="submit" class="button" name="dosubmit" value="<?php echo L('listorder')?>" /></div>  </div>
		<div ><?php echo $page_str;?></div>
	</div>
</div>
</form>
<script type="text/javascript"> 
<!--
window.top.$('#display_center_id').css('display','none');

function associated_label(id, name) {
	window.top.art.dialog({id:'associated_label'}).close();
	window.top.art.dialog({title:'推荐位《'+name+'》',id:'associated_label',iframe:'?m=community&c=position&a=posdata_select&typeid='+id,width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'associated_label'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'associated_label'}).close()});
}

function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'data_delete'}, 
	function(){
	$.get('?m=community&c=position&a=del_posdata_select&typeid='+id+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};
//-->
</script>