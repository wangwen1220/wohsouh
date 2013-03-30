<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>
<div class="subnav">
	<div class="content-menu ib-a blue line-x"><?php echo $list_menu?></div>
</div>
<div class="pad-lr-10">
<form name="searchform" action="" method="get" >
<input type="hidden" value="community" name="m">
<input type="hidden" value="usermanage" name="c">
<input type="hidden" value="user_private_msg" name="a">
<table class="search-form" width="100%" cellspacing="0">
	<tbody>
		<tr>
			<td>
				<div class="explain-col">
					时间：<?php echo form::date('start_time',$_GET['start_time'],0,0,'false');?>- &nbsp;<?php echo form::date('end_time',$_GET['end_time'],0,0,'false');?>
					关键字：<input type="text" class="input-text" value="" name="keyword">
					<input type="submit" value="搜索" class="button" name="search">
				</div>
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>
<form name="myform" action="?m=community&c=communityey&a=listorder" method="post">
<div class="pad_10">
	<div class="table-list">
	    <table id='js-table' width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="2%"><input type="checkbox" value="" id="check_box" onclick="selectall('ids[]');"></th>
					<th width="3%">ID</th>
					<th width="8%">用户</th>
					<th width="10%">内容</th>
					<th width="8%">时间</th>
					<th width="3%">操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($datas as $r) { ?>
				<tr>
					<td align="center"><input class="inputcheckbox " name="ids[]" value="<?php echo $r['id'];?>" type="checkbox"></td>
					<td align="center"><?php echo $r[id]?></td>
					<td align="center"><?php echo $r[src_name]?><font style="color:red">→</font><?php echo $r[dst_name]?></td>
					<td align="center"><?php echo $r[msg]?></td>
					<td align="center"><?php echo $r[append_time]?></td>
					<td align="center">
						<a href="javascript:;" title="删除" onclick="recommend(this,'<?php echo $r['id']?>','<?php echo trim(new_addslashes($r['msg']));?>')">删除</a>
					</td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
	    <div class="btn">
			<input type="button" id='js-button' class="button" value="删除" data-id='?m=community&c=usermanage&a=del_user_msg' />
	    </div>
		<div><?php echo $page_str;?></div>
	</div>
</div>
</form>
<script type="text/javascript"> 
<!--
window.top.$('#display_center_id').css('display','none');
function recommend(obj,id,name,list){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'recommend'},
	function(){
	var ids = [id];
	$.post('?m=community&c=usermanage&a=del_user_msg&pc_hash='+pc_hash, {"ids": ids}, function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};

$('#js-button').click(function(){
	var url = $(this).attr('data-id'),
		data = $('#js-table tbody :checkbox:checked').serialize();
	if(!data) return false;
	$.post(url, data, function(d){
		window.top.right.location.reload();
	});
	return false;
});
//-->
</script>