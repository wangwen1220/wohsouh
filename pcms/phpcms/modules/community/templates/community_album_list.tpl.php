<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>
<div class="subnav">
	<div class="content-menu ib-a blue line-x"><a class="on" href="?m=community&c=communitalbum&a=community_album_position&is_pos=all"><em>专辑推荐管理</em></a></div>
</div>
<div class="pad-lr-10">
<form name="search" action="?m=community&c=communitalbum&a=community_album_list&search=yes" method="post">
<table class="search-form" width="100%" cellspacing="0">
	<tbody>
		<tr>
			<td>
				<div class="explain-col">
					 创建者:<input name="nickname" type="text" id="nickname" />
					 分类：<select name="classname" id="classname">
							<option value="all">全部</option>
							<?php foreach($class_name as $r) { ?>
							<option value="<?php echo $r[id]?>"><?php echo $r[name]; ?></option>
							<?php } ?>
						</select>
					创建日期：<?php echo form::date('start_time',$_GET['start_time'],0,0,'false');?>- &nbsp;<?php echo form::date('end_time',$_GET['end_time'],0,0,'false');?>
					专辑名或关键字：
					<input name="albumname" type="text" id="albumname" />
					<input type="submit" name="Submit" value="搜索" />
				</div>
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>
<form name="myform" action="?m=community&c=communitalbum&a=xx" method="post">
<div class="pad_10">
	<div class="table-list">
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<!--<th width="2%">&nbsp;</th>-->
					<th width="6%">ID</th>
					<th width="6%">专辑名称</th>
					<th width="6%">分享总数</th>
					<th width="6%">图片数</th>
					<th width="6%">视频数</th>
					<th width="6%">商品数</th>
					<th width="6%">评论数</th>
					<th width="6%">所属分类</th>
					<th width="6%">创建者</th>
					<th width="8%">创建时间</th>
					<!--<th width="15%">专辑评论</th>-->
					<th width="6%">是否推荐</th>
					<th width="20%">管理操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($arr as $r) { ?>
				<tr>
					<!--<td align="center"><input type="checkbox" name="checkbox" value="checkbox" /></td>-->
					<td align="center"><?php echo $r['id']?></td>
					<td align="center"><?php echo $r['album_name']?></td>
					<td align="center"><?php echo $r['file_count']?></td>
					<td align="center"><?php echo $r['count']['pic_count']?></td>
					<td align="center"><?php echo $r['count']['video_count']?></td>
					<td align="center"><?php echo $r['count']['goods_count']?></td>
					<td align="center"><?php echo $r['be_reply_count']?></td>
					<td align="center"><?php echo $r['count']['class_name']?></td>
					<td align="center"><?php echo $r['nickname']?></td>
					<td align="center"><?php echo $r['input_time']?></td>
					<td align="center"><?php if ($r[recommend] == 1) {?>
							<a href="javascript:;" data-id='1' data-name='确定取消推荐专辑？' onclick="albumrecommend(this,'<?php echo $r['id']?>',$(this).attr('data-name'),$(this).attr('data-id'))"><img src="<?php echo IMG_PATH?>data_valid.gif" /></a>
						<?php }else { ?>
							<a href="javascript:;" data-id='2' data-name='确定推荐？' onclick="albumrecommend(this,'<?php echo $r['id']?>',$(this).attr('data-name'),$(this).attr('data-id'))"><img src="<?php echo IMG_PATH?>data_invalid.gif" /></a>
						<?php }?></td>
					<td align="center"><a href="javascript:edit('<?php echo $r['id']?>','<?php echo trim(new_addslashes($r['album_name']))?>')"><?php echo L('edit');?></a> | <a href="javascript:;" onclick="data_delete(this,'<?php echo $r['id']?>','您确定要删除此专辑！此操作不可恢复！')"><?php echo L('delete')?></a> | <!--<a href="javascript:data_reply('<?php //echo $r['id']?>','<?php //echo trim(new_addslashes($r['album_name']));?>')"><?php //echo L('comment_mange')?></a>--><a href="?m=community&c=communitalbum&a=community_reply_album&album_id=<?php echo $r['id']?>">评论管理</a></td>
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
var IMG_PATH = '<?php echo IMG_PATH?>';
window.top.$('#display_center_id').css('display','none');
function albumrecommend(obj,id,name,list){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'albumrecommend'}, 
	function(){
	$.get('?m=community&c=communitalbum&a=albumrecommend&typeid='+id+'&list='+list+'&pc_hash='+pc_hash,function(data){
				if(data) {
					//$(obj).parent().parent().fadeOut("slow");
					if(list == 1){
						$(obj).attr('data-id', "2").attr('data-name', '确定推荐？');
						$(obj).find('img').attr('src', IMG_PATH + 'data_invalid.gif');
					}else{
						$(obj).attr('data-id', "1").attr('data-name', '确定取消推荐专辑？');
						$(obj).find('img').attr('src', IMG_PATH + 'data_valid.gif');
					}
				}
			}) 	
		 }, 
	function(){});
};
function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'修改专辑《'+name+'》',id:'edit',iframe:'?m=community&c=communitalbum&a=community_edit_album&typeid='+id,width:'540',height:'200'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}
function data_reply(id, name) {
	window.top.art.dialog({id:'reply'}).close();
	window.top.art.dialog({title:'评论管理《'+name+'》',id:'reply',iframe:'?m=community&c=communitalbum&a=community_reply_album&typeid='+id,okVal:'关闭',width:'540',height:'200'},function(){window.top.art.dialog({id:'reply'}).close()});
}
function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'data_delete'}, 
	function(){
	$.get('?m=community&c=communitalbum&a=community_del_album&typeid='+id+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
					//$(obj).find('img').attr('src', IMG_PATH + 'data_invalid.gif');
				}
			}) 	
		 }, 
	function(){});
};
//-->
</script>