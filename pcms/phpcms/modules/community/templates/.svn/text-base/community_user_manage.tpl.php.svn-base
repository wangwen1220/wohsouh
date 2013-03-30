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
<input type="hidden" value="init" name="a">
<table class="search-form" width="100%" cellspacing="0">
	<tbody>
		<tr>
			<td>
				<div class="explain-col">
					<select name="searchtype">
						<option value="1">用户名</option>
						<option value="2">用户ID</option>
						<option value="3">邮箱</option>
						<option value="4">昵称</option>
					</select>
					<input type="text" class="input-text" value="" name="keyword">
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
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<th width="5%">用户ID</th>
					<th width="7%">用户名</th>
					<th width="7%">昵称</th>
					<th width="8%">邮箱</th>
					<th width="5%">分享总数</th>
					<th width="5%">上传数</th>
					<th width="5%">采集数</th>
					<th width="5%">转藏数</th>
					<th width="5%">关注数</th>
					<th width="5%">粉丝数</th>
					<th width="5%">专辑数</th>
					<th width="5%">推荐</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($datas as $r) { ?>
				<tr>
					<td align="center"><?php echo $r[uid]?></td>
					<td align="center"><?php echo $r[username]?></td>
					<td align="center"><?php echo $r[nickname]?></td>
					<td align="center"><?php echo $r[email]?></td>
					<td align="center"><?php echo $r[share]?></td>
					<td align="center"><?php echo $r[sc]?></td>
					<td align="center"><?php echo $r[cj]?></td>
					<td align="center"><?php echo $r[zc]?></td>
					<td align="center"><?php echo $r[follow]?></td>
					<td align="center"><?php echo $r[fans]?></td>
					<td align="center"><?php echo $r[album]?></td>
					<td align="center">
						<?php if ($r[is_recommend] == 1) {?>
							<a href="javascript:;" title="取消推荐" onclick="recommend(this,'<?php echo $r['uid']?>','<?php echo trim(new_addslashes($r['username']));?>',1)"><img src="<?php echo IMG_PATH?>data_invalid.gif" /></a>
						<?php }else { ?>
							<a href="javascript:;" title="推荐" onclick="recommend(this,'<?php echo $r['uid']?>','<?php echo trim(new_addslashes($r['username']));?>',2)"><img src="<?php echo IMG_PATH?>data_valid.gif" /></a>
						<?php }?>
					</td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
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
	$.get('?m=community&c=usermanage&a=recommend&typeid='+id+'&list='+list+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};
//-->
</script>