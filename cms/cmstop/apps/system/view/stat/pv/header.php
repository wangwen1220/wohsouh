<?php $this->display('header', 'system');?>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/dropdown/style.css"/>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.dropdown.js"></script>
<link href="<?=IMG_URL?>js/lib/treeview/treeview.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.treeview.js"></script>
<link href="<?=IMG_URL?>js/lib/tree/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.tree.js"></script>
<div class="bk_8"></div>
<div class="tag_1">
   <div id="add_data">
	  <select id="changestat" style="width:100px;z-index:99;" marginTop="1" marginLeft="0">
  		  <option value="content">内容统计</option>
  		  <option value="comment">评论统计</option>
  		  <option value="pv" selected>访问统计</option>
	  </select>
	</div>
	<ul class="tag_list" style="margin-left:160px">
	    <li><a href="?app=system&controller=stat_pv&action=index"<?if($action == 'index') echo 'class="s_3";'?>>综合统计</a></li>
	    <li><a href="?app=system&controller=stat_pv&action=category"<?if($action == 'category') echo 'class="s_3";'?>>按栏目统计</a></li>
	    <li><a href="?app=system&controller=stat_pv&action=model"<?if($action == 'model') echo 'class="s_3";'?>>按模型统计</a></li>
	    <li><a href="?app=system&controller=stat_pv&action=department"<?if($action == 'department') echo 'class="s_3";'?>>按部门统计</a></li>
	    <li><a href="?app=system&controller=stat_pv&action=admin"<?if($action == 'admin') echo 'class="s_3";'?>>按编辑统计</a></li>
	</ul>
	<div style="float: left;padding-top: 5px;margin-left: 30px;">
		<a id="refreshBtn" title="系统依靠计划任务统计数据，会有一定延时，如果要查看实时数据，请点击" href="javascript:;">刷新数据</a>
		| <a id="clearBtn" href="javascript:;" title="清空所有访问数据">清空数据</a>
		<!--| <a id="testBtn" href="javascript:;" title="随机访问几百次，仅供测试">模拟访问</a>-->
	</div>
</div>
<script>
$(function (){
	$('#refreshBtn').click(function (){
		$.get("?app=system&controller=stat_pv&action=refresh", function (data) {
			if(data == 1){
				location.reload();
			}
		});
	});
	$('#testBtn').click(function (){
		$.get("?app=system&controller=stat_pv&action=test", function (data) {
			if(data == 1){
				location.reload();
			}
		});
	});
	$('#clearBtn').click(function (){
		ct.confirm("确定删除所有访问数据？请谨慎操作",function (){
			$.get("?app=system&controller=stat_pv&action=clear", function (data) {
				if(data == 1){
					location.reload();
				}
			});
		});
	});
});
</script>