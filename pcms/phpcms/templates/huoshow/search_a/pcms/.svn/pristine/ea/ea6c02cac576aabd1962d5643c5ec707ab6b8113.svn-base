<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>
<div style="margin-left:10px;padding:5px;">
<!--<a class="add fb" href="javascript:associated_label('<?php //echo $posid?>','选取新闻')"><font color="#FF0000">[选取新闻]</font></a>-->
<a href="javascript:associated_label('<?php echo $classid?>','选取新闻')"><font color="#FF0000">[选取新闻]</font></a>
</div>
<div class="pad-lr-10">

<form name="searchform" action="?m=community&c=communityey&a=community_class_tagdata_item&classid=<?php echo $classid?>" method="post" >
<table class="search-form" width="100%" cellspacing="0">
	<tbody>
		<tr>
			<td>
				<div class="explain-col">
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
<form name="myform" action="?m=community&c=communityey&a=community_class_tag_listorder&classid=<?php echo $classid?>" method="post">
<div class="pad_10">
	<div class="table-list">
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="5%">排序</td>
					<th width="5%">ID</th>
					<th width="30%">名称</th>
					<th width="20%">
					<?php if ($order == "listorder ASC") {?>
					<a href="?m=community&c=communityey&a=community_class_tagdata_item&classid=<?php echo $classid?>&order=desc">使用次数</a>
					<?php }elseif ($order == "num asc"){ ?>
					<a href="?m=community&c=communityey&a=community_class_tagdata_item&classid=<?php echo $classid?>&order=desc">使用次数</a>
					<?php }else{ ?>
					<a href="?m=community&c=communityey&a=community_class_tagdata_item&classid=<?php echo $classid?>&order=asc">使用次数</a>
					<?php }?>
					</th>
					<th width="20%">管理操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($datas as $r) { ?>
				<tr>
					<td align="center"><input type="text" name="listorders[<?php echo $r['tag_id']?>]" value="<?php echo $r['listorder']?>" size="3" class='input-text-c'></td>
					<td align="center"><?php echo $r['tag_id']?></td>
					<td align="center"><?php echo $r['tag_name']?></td>
					<td align="center"><?php echo $r['num']?></td>
					<td align="center"><a href="javascript:;" onclick="data_delete(this,'<?php echo $r['tag_id']?>','<?php echo $r['classid']?>','<?php echo trim(new_addslashes($r['tag_name']));?>')">取消关联</a></td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
	    <div class="btn"><input type="submit" class="button" name="dosubmit" value="<?php echo L('listorder')?>" /></div>  
	    </div>
		<div id="pages"><?php echo $page_str;?></div>
	</div>
</div>
</form>
<script type="text/javascript"> 
<!--
window.top.$('#display_center_id').css('display','none');

<!--function associated_label(id, name) {
	//window.top.art.dialog({id:'associated_label'}).close();
	//window.top.art.dialog({title:'推荐位《'+name+'》',id:'associated_label',iframe:'?m=community&c=position&a=posdata_select&typeid='+id,width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'associated_label'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'associated_label'}).close()});
//}-->
function associated_label(id, name) {
	window.top.art.dialog({id:'associated_label'}).close();
	window.top.art.dialog({title:'分类《'+name+'》关联标签',id:'associated_label',iframe:'?m=community&c=communityey&a=community_class_associated_label&typeid='+id,width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'associated_label'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'associated_label'}).close()});
}

function data_delete(obj,id,classid,name){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'data_delete'}, 
	function(){
	$.get('?m=community&c=communityey&a=community_del_class_tag&typeid='+id+'&classid='+classid+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};
//-->
</script>