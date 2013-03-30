<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');?>
<div class="pad-lr-10">
<form name="searchform" action="" method="get" >
<input type="hidden" value="admin" name="m">
<input type="hidden" value="position" name="c">
<input type="hidden" value="init" name="a">
<table class="search-form" width="100%" cellspacing="0">
	<tbody>
		<tr>
			<td>
				<div class="explain-col">
					<strong>推荐位名称：</strong>
					<input type="text" class="input-text" value="<?php echo $keyword;?>" name="keyword">
					<input type="submit" value="搜索" class="button" name="search">
				</div>
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>
<form name="myform" action="?m=admin&c=position&a=listorder" method="post">
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="12%"  align="left"><?php echo L('listorder');?></th>
             <th width="7%"  align="left">ID</th>
            <th colspan="2"><?php echo L('posid_name');?></th>
            <th width="17%"><?php echo L('posid_catid');?></th>
            <th width="12%"><?php echo L('posid_modelid');?></th>
			
            <th width="22%"><?php echo L('posid_operation');?></th>
            </tr>
        </thead>
    <tbody>
 <?php 
if(is_array($infos)){
	foreach($infos as $info){
?>   
	<tr>
	<td width="12%">
	<input name='listorders[<?php echo $info['posid']?>]' type='text' size='2' value='<?php echo $info['listorder']?>' class="input-text-c">	</td>
	<td width="7%"  align="left"><?php echo $info['posid']?></td>
	<td  width="16%" align="center"><?php echo $info['name']?>&nbsp;</td>
	<td  width="14%" align="center"><a class="add fb" href="javascript:editpos(<?php echo $info['posid']?>,'选取新闻 - <?php echo $info['name']?>')">[选取新闻]</a></td>
	<td width="17%" align="center"><?php echo $info['catid'] ? $category[$info['catid']]['catname'] : L('posid_all')?></td>
	<td width="12%" align="center"><?php echo $info['modelid'] ? $model[$info['modelid']]['name'] : L('posid_all')?></td>	
	
	
	<td width="22%" align="center">
	<a href="?m=admin&c=position&a=public_item&posid=<?php echo $info['posid']?>&menuid=<?php echo $_GET['menuid']?>"><?php echo L('posid_item_manage')?></a> |
	<a href="javascript:edit(<?php echo $info['posid']?>, '<?php echo new_addslashes($info['name'])?>')"><?php echo L('edit')?></a> | 
	<?php if($info['siteid']=='0' && $_SESSION['roleid'] != 1) {?>
	<font color="#ccc"><?php echo L('delete')?></font>
	<?php } else {?>
	<a href="javascript:confirmurl('?m=admin&c=position&a=delete&posid=<?php echo $info['posid']?>', '<?php echo L('posid_del_cofirm')?>')"><?php echo L('delete')?></a>	
	<?php } ?>	</td>
	</tr>
<?php 
	}
}
?>
    </tbody>
    </table>
  
    <div class="btn"><input type="submit" class="button" name="dosubmit" value="<?php echo L('listorder')?>" /></div>  </div>

 <div id="pages"> <?php echo $pages?></div>
</div>
</div>
</form>
</body>
<a href="javascript:edit(<?php echo $v['siteid']?>, '<?php echo $v['name']?>')">
</html>
<script type="text/javascript">
<!--
	window.top.$('#display_center_id').css('display','none');
	function edit(id, name) {
	window.top.art.dialog({title:'<?php echo L('edit')?>--'+name, id:'edit', iframe:'?m=admin&c=position&a=edit&posid='+id ,width:'500px',height:'360px'}, 	function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;
	var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}

function editpos(id, name) {
	window.top.art.dialog({title:name, id:'torecommend', iframe:'?m=admin&c=position&a=selectInfoToRecommend&pid='+id ,width:'850px',height:'580px'}, 	function(){var d = window.top.art.dialog({id:'torecommend'}).data.iframe;
	var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'torecommend'}).close()});
}
//-->
</script>