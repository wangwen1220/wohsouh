<?php $this->display('stat/pv/header');?>

<div class="bg_1" id="tree_in">
  <div class="w_160 box_6 mar_r_8 f_l" style="position:relative;width:155px;height:740px;background: #F9FCFD;">
    <h3><span class="dis_b b">模型列表</span></h3>
    <div id="category" style="position:absolute;z-index:3;">
    <ul id="model_tree">
        <li><span id="0">全部</span></li>
<?php foreach (table('model') as $m){?>
		<li><span id="<?=$m['modelid']?>"><?=$m['name']?></span></li>
<?php } ?>
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
var current_modelid = <?=$current_modelid?>;

$("#model_tree").treeview();
$("#model_tree span").each(function(i){
    $(this).unbind('click');
    $(this).unbind('mouseover');
});
$("#model_tree span").addClass('hand');
$("#model_tree span").click(function(){
	var offset = $(this).offset();
	$('#bg').css('top', offset.top-$(this).height()-31);
	$('#stat').load('?app=system&controller=stat_pv&action=model_stat&modelid='+this.id);
	current_modelid = this.id;
});

$('#'+current_modelid).click();

$('#changestat').dropdown({
	changestat:{
		onchange:function(action, name){
			window.location.href = '?app=system&controller=stat_'+action+'&action=index';
		}
	}
});
</script>
<?php $this->display('footer', 'system');?>