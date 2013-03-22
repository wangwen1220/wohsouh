<?php $this->display('stat/comment/header');?>

<!-- 输出表格 -->
<div class="f_l" style="width:48%;margin:0 10px 10px 10px;padding-bottom:20px">
	<div class="box_10 mar_t_10">
        <h3><span class="f_l b">按频道统计</span></h3>
        <?=$catTable?>
	</div>
	<div class="box_10 mar_t_10 ">
        <h3><span class="f_l b">按模型统计</span></h3>
        <?=$modelTable?>
	</div>
</div>

<div class="f_r" style="width:48%;margin:0 10px 10px 10px;;padding-bottom:20px">
	<div class="box_10 mar_t_10">
        <h3><span class="f_l b">按部门统计</span></h3>
        <?=$dpmTable?>
	</div>
	<div class="box_10 mar_t_10">
        <h3><span class="f_l b">按编辑统计</span></h3>
        <?=$adminTable?>
	</div>
</div>
<!-- 表格结束  -->

<script type="text/javascript">
$('#changestat').dropdown({
	changestat:{
		onchange:function(action, name){
			window.location.href = '?app=system&controller=stat_'+action+'&action=index';
		}
	}
});
</script>
<?php $this->display('footer', 'system');?>