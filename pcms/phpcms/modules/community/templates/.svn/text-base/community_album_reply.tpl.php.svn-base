<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>

<form action="?m=community&c=communitalbum&a=community_reply_album" method="post" id="myform">
<table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="5%">ID</th>
					<th width="45%">评论内容</th>
					<!--<th width="15%">专辑评论</th>-->
					<th width="20%">评论用户</th>
					<th width="30%">评论时间</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($list_arr as $r) { ?>
				<tr>
					<td align="center"><?php echo $r['id']?></td>
					<td align="center"><?php echo $r['reply_content']?></td>
					<td align="center"><?php echo $r['nickname']?></td>
					<td align="center"><?php echo $r['reply_time']?>&nbsp;<a href="javascript:;" onclick="data_delete(this,'<?php echo $r['id']?>','<?php echo "确定删除？";//trim(new_addslashes($r['nickname']));?>')"><?php echo L('delete')?></a></td>
				</tr>
			<?php }?>
			</tbody>
	    </table>

<div class="bk15"></div>
<input type="hidden" name="replyid" value="<?php echo $list_arr[0]['id'] ?>"/>
<input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class='dialog'>&nbsp;
<input type="reset" value=" <?php echo L('clear')?> " class='dialog'>
</form>

<script type="text/javascript"> 
<!--
window.top.$('#display_center_id').css('display','none');
function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'data_delete'}, 
	function(){
	$.get('?m=community&c=communitalbum&a=community_del_reply&typeid='+id+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};
//-->
</script>