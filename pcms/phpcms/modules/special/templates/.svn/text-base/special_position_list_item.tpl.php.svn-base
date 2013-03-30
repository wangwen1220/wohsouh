<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>
<div class="subnav" style=" padding:0 0 0 10px;">
	<div class="content-menu ib-a blue line-x"><?php echo $list_menu?></div>
</div>
<div style="margin-left:10px;padding:5px;">
<a class="add fb" href="javascript:associated_label('<?php echo $posid?>','选取专题')"><font color="#FF0000">[选取专题]</font></a>
</div>
<div class="pad_10">
	<div class="table-list">
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="5%">ID</th>
					<th width="20%">专题</th>
					<th width="20%">图片数量</th>
					<th width="20%">新闻数量</th>
					<th width="20%">创建时间</th>
					<th width="20%">管理操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($datas as $r) { ?>
				<tr>
					<td align="center"><?php echo $r['id']?></td>
					<td align="center"><?php echo $r['special_name']?></td>
					<td align="center"><?php echo $r['pic_total']?></td>
					<td align="center"><?php echo $r['news_total']?></td>
					<td align="center"><?php echo date('Y-m-d h:i:s',$r['inputtime'])?></td>
					<td align="center"><a href="javascript:;" onclick="data_delete(this,'<?php echo $r['id']?>','确定删除《<?php echo trim(new_addslashes($r['special_name']));?>》专题？此操作不可恢复！')"><?php echo L('delete')?></a></td>
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

function associated_label(id, name) {
	window.top.art.dialog({id:'associated_label'}).close();
	window.top.art.dialog({title:'推荐位《'+name+'》',id:'associated_label',iframe:'?m=special&c=special&a=special_position_select&typeid='+id,width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'associated_label'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'associated_label'}).close()});
}
function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'data_delete'}, 
	function(){
	$.get('?m=special&c=special&a=special_position_select_del&typeid='+id+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};
//-->
</script>