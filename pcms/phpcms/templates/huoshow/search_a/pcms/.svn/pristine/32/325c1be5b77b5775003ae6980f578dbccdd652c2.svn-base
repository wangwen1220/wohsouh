<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>
<div class="pad-lr-10">
<form name="searchform" action="" method="get" >
<input type="hidden" value="community" name="m">
<input type="hidden" value="communityey" name="c">
<input type="hidden" value="community_label_list" name="a">
<table class="search-form" width="100%" cellspacing="0">
	<tbody>
		<tr>
			<td>
				<div class="explain-col">
					<strong>类型：</strong>
					<select name="searchtype">
						<option value="0">全部</option>
						<option value="1">系统标签</option>
						<option value="2">用户标签</option>
					</select>
					<strong>热度：</strong>
					<input type="text" class="input-text" value="<?php echo $hot;?>" name="hot">
					<strong>创建日期：</strong>
					<?php echo form::date('start_time',$_GET['start_time'],0,0,'false');?>- &nbsp;<?php echo form::date('end_time',$_GET['end_time'],0,0,'false');?>
					<strong>标签名：</strong>
					<input type="text" class="input-text" value="<?php echo $keyword;?>" name="keyword">
					<input type="submit" value="搜索" class="button" name="search">
				</div>
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>
<form name="myform" action="?m=community&c=communityey&a=xx" method="post">
<div class="pad_10">
	<div class="table-list">
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="5%">ID</th>
					<th width="30%">标签名称</th>
					<th width="15%">类型</th>
					<th width="15%">使用次数</th>
					<th width="20%">添加时间</th>
					<th width="20%">管理操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($list_arr as $r) { ?>
				<tr>
					<td align="center"><?php echo $r['id']?></td>
					<td align="center"><?php echo $r['tag_name']?></td>
					<td align="center"><?php if ($r['uid']==0){?><span style="color:red;">系统标签</span><?php }else {?>用户标签<?php }?></td>
					<td align="center"><?php echo $r['num']?></td>
					<td align="center"><?php echo $r['datetime']?></td>
					<td align="center"><a href="javascript:edit('<?php echo $r['id']?>','<?php echo trim(new_addslashes($r['tag_name']))?>')"><?php echo L('edit');?></a> | <a href="javascript:;" onclick="data_delete(this,'<?php echo $r['id']?>','确定要删除《<?php echo trim(new_addslashes($r['tag_name']));?>》标签？此操作不可恢复!')"><?php echo L('delete')?></a></td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
	    <!-- >div class="btn"><input type="submit" class="button" name="dosubmit" value="<?//php echo L('listorder')?>" /></div-->  </div>
		<div><?php echo $page_str;?></div>
	</div>
</div>
</form>
<script type="text/javascript"> 
<!--
window.top.$('#display_center_id').css('display','none');
function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'修改标签《'+name+'》',id:'edit',iframe:'?m=community&c=communityey&a=community_edit_label&typeid='+id,width:'540',height:'200'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}
function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'data_delete'}, 
	function(){
	$.get('?m=community&c=communityey&a=community_del_label&typeid='+id+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};
//-->
</script>