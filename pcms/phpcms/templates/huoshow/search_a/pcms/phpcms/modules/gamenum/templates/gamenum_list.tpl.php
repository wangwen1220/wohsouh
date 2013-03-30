<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>

<form name="myform" action="?m=gamenum&c=gamenum&a=addgame" method="post">
<div class="pad_10">
	<div class="table-list">
	    <table width="100%" cellspacing="0" >
	        <thead>
				<tr>
					<!--<th width="5%">排序</th>-->
					<th width="5%">ID</th>
					<th width="20%">游戏名称</th>
					<th width="20">已发号</th>
					<th width="20">未发号</th>
					<th width="30%">管理操作</th>
				</tr>
	        </thead>
		    <tbody>
			
		    <?php foreach($result as $r) { ?>
				<tr>
					
					<td align="center"><?php echo $r['id']?></td>
					<td align="center"><?php echo $r['gamename']?></td>
					<td align="center"><?php echo $r['usenum']?></td>
					<td align="center"><?php echo $r['nousenum']?></td>
					<td align="center"><?php echo "<a href="."javascript:addgamenum('$r[id]','添加')".'>添加</a>';?></td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
	    <div class="btn"><input name="states" type="submit" class='button' id="js-set-top" value="添加游戏" /></div>  </div>
		<div><?php echo $page_str;?></div>
	</div>
</div>
</form>
<script type="text/javascript"> 
function addgamenum(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'添加游戏《'+name+'》',id:'edit',iframe:'?m=gamenum&c=gamenum&a=addgamenum&typeid='+id,width:'540',height:'50'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}

function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'添加游戏《'+name+'》',id:'edit',iframe:'?m=gamenum&c=gamenum&a=addgame&typeid='+id,width:'540',height:'50'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}

// 添加游戏
$('#js-set-top').click(function(){
	var ids = [];
	$('input.shareid:checked').each(function(){
		ids.push(this.value);
	});
	edit(ids, '游戏名称');
	return false;
});
</script>