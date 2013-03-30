<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>
<form name="is_pos" action="?m=community&c=communitalbum&a=community_album_position" method="get">
<!--<div>&nbsp;&nbsp;&nbsp;<a href="?m=community&c=communitalbum&a=community_album_position&is_pos=1">本分类推荐</a> | <a href="?m=community&c=communitalbum&a=community_album_position&is_pos=2">广场推荐</a> | <a href="?m=community&c=communitalbum&a=community_album_position&is_pos=3">用户关注推荐</a></div>-->
</form>
<form name="myform" action="?m=community&c=communitalbum&a=xx" method="post">
<div class="pad_10">
	<div class="table-list">
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="2%">&nbsp;</th>
					<th width="8%">ID</th>
					<th width="8%">专辑名称</th>
					<th width="8%">分享总数</th>
					<th width="8%">图片数</th>
					<th width="8%">视频数</th>
					<th width="8%">商品数</th>
					<th width="8%">评论数</th>
					<th width="8%">所属分类</th>
					<th width="8%">创建者</th>
					<th width="8%">创建时间</th>
					<!--<th width="15%">专辑评论</th>-->
					<th width="8%">排序</th>
					<th width="8%">操作</th>

				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($arr as $r) { ?>
				<tr>
					<td align="center"><input type="checkbox" name="checkbox" value="checkbox" /></td>
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
					<td align="center"><?php echo $r['id']?></td>
					<td align="center"><a href="?m=community&c=communitalbum&a=community_album_position">取消推荐</a></td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
	    <!-- >div class="btn"><input type="submit" class="button" name="dosubmit" value="<?//php echo L('listorder')?>" /></div-->  </div>
		<div ><?php echo $page_str;?></div>
	</div>
</div>
</form>