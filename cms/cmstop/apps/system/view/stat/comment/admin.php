<?php $this->display('stat/comment/header');?>

<div class="bg_1" id="tree_in">
  <div class="w_160 box_6 mar_r_8 f_l" style="position:relative;width:155px;height:740px;background: #F9FCFD;">
    <h3><span class="dis_b b">编辑列表</span></h3>
    <div id="category" style="position:absolute;z-index:3;">
    <ul id="admin_tree">
        <li><span id="0">全部</span></li>
<?php
$db = &factory::db();
$admins = $db->select("SELECT userid, name FROM #table_admin WHERE posts > 0");
foreach ($admins as $m): 
?>
		<li><span id="<?=$m['userid']?>"><?=$m['name']?></span></li>
<?php endforeach; ?>
    </ul>
    </div>
    <div id="bg" class="bg_3"></div>
  </div>
  <div class="f_l" style="padding-left:10px">
    <div class="bk_10"></div>
    <div id="stat" style="width:760px;"></div>
  </div>
  <div class="clear"></div>
</div>
<script type="text/javascript">
var current_userid = <?=$current_userid?>;

$("#admin_tree").treeview();
$("#admin_tree span").each(function(i){
    $(this).unbind('click');
    $(this).unbind('mouseover');
});
$("#admin_tree span").addClass('hand');
$("#admin_tree span").click(function(){
	var offset = $(this).offset();
	$('#bg').css('top', offset.top-$(this).height()-31);
	$('#stat').load('?app=system&controller=stat_comment&action=admin_stat&userid='+this.id);
	current_userid = this.id;
});

$('#'+current_userid).click();

$('#changestat').dropdown({
	changestat:{
		onchange:function(action, name){
			window.location.href = '?app=system&controller=stat_'+action+'&action=index';
		}
	}
});
</script>
<?php $this->display('footer', 'system');?>