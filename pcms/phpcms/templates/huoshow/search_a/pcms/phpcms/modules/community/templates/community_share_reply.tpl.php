<style type='text/css'>
.menu-content {
	margin: 10px;
	padding: 5px;
	border: 1px solid #FFBE7A;
	background-color: #FFFCED;
	line-height: 30px;
}
.menu-content label, .menu-content a {
	margin-left: 5px;
}
.menu-content input, .menu-content select {
	height: 20px;
	line-height: 20px;
}
.menu-content input.date {
	background-position: 100% 0;
}
.menu-content .brv {
	margin-right: 8px;
}
.content-menu, .subnav {/* 这两个东西影响布局暂时隐藏 */
	display: none;
}
.ui-table {
	font-size: 12px;
	width: 100%;
}
</style>
<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>
<form name="search" action="?m=community&c=communityshare&a=community_reply_share&search=yes" method="post">
  <div class='menu-content'>
		<label>发布日期：</label><?php echo form::date('start_time',$_GET['start_time'],0,0,'false');?><span class='brv'>-</span><?php echo form::date('end_time',$_GET['end_time'],0,0,'false');?>
		<label>用户名：</label> <input name="nickname" type="text" id="nickname" />
		
		<label>内容描述或关键词：</label>
		<input name="description" type="text" id="description" />
		<input type="submit" class='button' name="Submit" value="搜索" />
	  <!--<a href="?m=community&c=communitalbum&a=community_album_position&is_pos=all">分享评论管理</a>-->
	    <input name="shareid" type="hidden" id="shareid" value="<?php echo $shareid;?>" />
	</div>
</form>
<form name="myform" action="?m=community&c=communityshare&a=community_status_share" method="post">
<div class="pad_10">
	<div class="table-list">
		<table class='ui-table' width="100%" cellspacing="0" >
			<thead>
				<tr>
					<th width="2%"><input type="checkbox" id="checked-all" /></th>
					<th width="3%">ID</th>
					<th width="6%">用户名</th>
					<th width="4%">评论内容</th>
					<th width="6%">发布时间</th>
					<th width="10%">操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($arr as $r) { ?>
				<tr>
					<td align="center"><input name="shareid[]" type="checkbox" class='shareid' id="shareid[]" value="<?php echo $r['id']?>" /></td>
					<td align="center"><?php echo $r['id']?></td> 
					
					
					
					<td align="center"><?php echo $r['nickname']?></td>

					<td align="center"><?php echo $r['content']?></td>
					<td align="center"><?php echo $r['reply_time']?></td>
					<td align="center"> <a href="javascript:;" onclick="data_delete(this,'<?php echo $r['id']?>','<?php echo $r['uid']?>','确定删除评论？')"><?php echo L('delete')?></a></td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
	    <!-- >div class="btn"><input type="submit" class="button" name="dosubmit" value="<?//php echo L('listorder')?>" /></div-->  </div>
			<div class="btn" style='padding:4px 6px;'>
				<label for="checked-all">全选/取消</label>
				<input name="states" type="submit" class='button'  id="states-del" value="删除" />
			</div>

		<div id="pages" ><?php echo $page_str;?></div>
  </div>
</div>
<label>
</label>
</form>
<script type="text/javascript"> 
<!--
window.top.$('#display_center_id').css('display','none');
function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'修改专辑《'+name+'》',id:'edit',iframe:'?m=community&c=communitalbum&a=community_edit_album&typeid='+id,width:'540',height:'200'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}
function data_reply(id, name) {
	window.top.art.dialog({id:'reply'}).close();
	window.top.art.dialog({title:'评论管理《'+name+'》',id:'reply',iframe:'?m=community&c=communitalbum&a=community_reply_album&typeid='+id,okVal:'关闭',width:'540',height:'200'},function(){window.top.art.dialog({id:'reply'}).close()});
}
function data_delete(obj,id,uid,name){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'data_delete'}, 
	function(){
	$.get('?m=community&c=communityshare&a=community_del_share_reply&typeid='+id+'&uid='+uid+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};

//选择全部分享
var $checked_all = $('#checked-all'),
	$checkbox_shareid = $('.shareid:checkbox');
$checked_all.click(function(){//全选
	$checkbox_shareid.attr("checked", this.checked);
});
$checkbox_shareid.click(function(){//改变选择按钮的选择状态
	var $temp = $('.shareid:checkbox');
	//用filter方法筛选出选中的复选框。并直接给 $checked_all 赋值。
	$checked_all.attr('checked', $checkbox_shareid.length == $checkbox_shareid.filter(':checked').length);
});
//-->
</script>