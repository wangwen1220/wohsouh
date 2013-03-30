<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
?>
<div style=" padding:5px;"><a class="add fb" href="javascript:editpos(<?php echo $posid?>,'选取新闻')"><font color="#FF0000">[选取新闻]</font></a></div>
<form name="myform" action="?m=admin&c=position&a=public_item" method="post">
<input type="hidden" value="<?php echo $posid?>" name="posid">
<div class="pad_10">
<div class="table-list">

	<table id='position_list_table' width="100%" cellspacing="0">
		<thead>
			<tr>
				<th width="10%"  align="left"><input type="checkbox" value="" id="check_box" onclick="selectall('items[]');"></th>
				<th width="7%"  align="left"><?php echo L('listorder');?></th>
				<th width="13%"  align="left">ID</th>
				<th width="10%"  align="left"><?php echo L('title');?></th>
				<th width="15%"><?php echo L('catname');?></th>
				<th width="15%"><?php echo L('inputtime')?></th>
				<th width="15%"><?php echo L('来源');?></th>
				<th width="15%"><?php echo L('posid_operation');?></th>
			</tr>
		</thead>
		<tbody>
		<?php 
			if(is_array($infos)){
			$n=0;
				foreach($infos as $info){
				
		?>
			<tr id='<?php echo $info['id']?>'>
				<td width="10%">
					<input type="checkbox" name="items[]" value="<?php echo $info['id'],'-',$info['modelid']?>" id="items" boxid="items">
				</td>
				<td width="7%">
					<input name='listorders[<?php echo $info['catid'],'-',$info['id']?>]' type='text' size='3' value='<?php echo $info['listorder']?>' class="input-text-c">
			  </td>	
				<td width="13%"  align="left"><?php echo $info['id']?>
				<?php if($n!=0) {?>
				&nbsp;<a href="/index.php?m=admin&c=position&a=setPositionListOrder&posid=<?php echo $posid?>&cid=<?php echo $info['id']?>&op=1">[置顶]</a>
				<?php }?>				</td>
				<td width="10%"  align="left"><?php echo $info['title']?> <?php if($info['thumb']!='') {echo '<img src="'.IMG_PATH.'icon/small_img.gif">'; }?></td>
				<td  width="15%" align="center"><?php echo $info['catname']?></td>
				<td width="15%" align="center"><?php echo date('Y-m-d H:i:s',$info['inputtime'])?></td>
				<td width="15%" align="center"><?php if($info['modelid']==-1) echo "专题"; else echo "资讯";?></td>
				<td width="15%" align="center">
				<?php if($info['modelid']==-1) { ?>
					<a href="<?php echo $info['url']?>">修改专题</a>
				<?php } else {?>
					<a href="<?php echo $info['url']?>" target="_blank"><?php echo L('posid_item_view')?></a> | <a onclick="javascript:openwinx('?m=content&c=content&a=edit&catid=<?php echo $info['catid']?>&id=<?php echo $info['id']?>','')" href="javascript:;"><?php echo L('posid_item_edit');?></a> | <a href="javascript:item_manage(<?php echo $info['id']?>,<?php echo $info['posid']?>, <?php echo $info['modelid']?>,'<?php echo $info['title']?>')"><?php echo L('posid_item_manage')?></a>
				<?php } ?>
				</td>
			</tr>
				<?php 
				$n++;
				}
			}
		?>
		</tbody>
	</table>

	<div class="btn"><label for="check_box"><?php echo L('select_all')?>/<?php echo L('cancel')?></label> <input type="button" class="button" value="<?php echo L('listorder')?>" onclick="myform.action='?m=admin&c=position&a=public_item_listorder';myform.submit();"/> <input type="submit" class="button" name="dosubmit" value="<?php echo L('posid_item_remove')?>" /> </div></div>

	<div id="pages"> <?php echo $pages?></div>
</div>
</div>
</form>
</body>
</html>
<script type="text/javascript">
	function item_manage(id,posid, modelid, name) {
	window.top.art.dialog({title:'<?php echo L('edit')?>--'+name, id:'edit', iframe:'?m=admin&c=position&a=public_item_manage&id='+id+'&posid='+posid+'&modelid='+modelid ,width:'550px',height:'430px'}, 	function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;
	var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}
</script>
<script type="text/javascript" src="<?php echo JS_PATH?>jquery.tablednd.js"></script>
<script type="text/javascript">
<!--
	$(function(){
		$("#position_list_table tbody tr:even").addClass('even');
		$("#position_list_table tbody").tableDnD({
			onDragClass: "ondrag",
			onDrop: function(table, row){
				var $next_row = $(row).next();
				var posid, did, cid = row.id;
				if($next_row.length){
					did = $next_row[0].id;
				}else{
					did = 0;
				}
				window.location.href = "/index.php?m=admin&c=position&a=setPositionListOrder&posid=<?php echo $posid?>" + "&cid=" + cid + "&did=" + did+"&pc_hash=<?php echo $_SESSION["pc_hash"]?>&op=2";
				//$.get("/index.php?m=admin&c=position&a=setPositionListOrder", {posid: posid, cid: cid, did: did});
			}
		});
	});
	
	
	function editpos(id, name) {
	window.top.art.dialog({title:name, id:'torecommend', iframe:'?m=admin&c=position&a=selectInfoToRecommend&pid='+id ,width:'850px',height:'580px'}, 	function(){var d = window.top.art.dialog({id:'torecommend'}).data.iframe;
	var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'torecommend'}).close()});
}
//-->
</script>