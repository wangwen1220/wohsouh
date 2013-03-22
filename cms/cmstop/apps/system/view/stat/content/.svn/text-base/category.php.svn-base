<?php $this->display('stat/content/header');?>

<div class="bg_1" id="tree_in">
  <div class="w_160 box_6 mar_r_8 f_l" style="position:relative;width:155px;height:740px;background: #F9FCFD;">
    <h3><span class="dis_b b" onclick="">栏目列表</span></h3>
    <div id="category_" style="position:absolute;z-index:3;"></div>
    
  </div>
  <div class="f_l" style="padding-left:10px">
    <div class="bk_10"></div>
    <div id="stat" style="width:760px;"></div>
  </div>
  <div class="clear"></div>
</div>
<script type="text/javascript">

var current_catid = '<?=$current_catid?>';
$('#category_').tree({
	url:"?app=system&controller=stat_content&action=cate&catid=%s",
	paramId : 'catid',
	paramHaschild:"hasChildren",
	renderTxt:function(div, id, item){
		return $('<span>'+item.name+'</span>');
	},
	active : function(div, id, item){
		$('#stat').load('?app=system&controller=stat_content&action=category_stat&catid='+id);
		current_catid = id;
	},
	prepared:function(){
		var t = this;
		$.getJSON('?app=system&controller=stat_content&action=category_path&catid='+current_catid, function(path){
			t.open(path);
		});
	}
});

$('#changestat').dropdown({
	changestat:{
		onchange:function(action, name){
			window.location.href = '?app=system&controller=stat_'+action+'&action=index';
		}
	}
})
</script>
<?php $this->display('footer', 'system');?>