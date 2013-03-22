<?php $this->display('header', 'system');?>
<div class="bk_8"></div>
<textarea id="note"><?=$note?></textarea>
<p id="lastUpdate">最后更新时间：<span><?=date('Y-m-d H:i:s', $lastmodified)?></span></p>
<div class="bk_8"></div>
<script type="text/javascript">
$(function (){
	$('#note').change(function (){
		$.post('?app=system&controller=my&action=note', {note: $(this).val()}, function (data){
			if(data.state) {
				$('#lastUpdate span').text(data.time);
			}else{
				ct.error('更新出错');
			}
		}, 'json');
	});
})
</script>
<style>
#note {
	width: 500px;
	height: 300px;
	display: block;
	margin-bottom: 30px;
	margin-left: 10px;
}
#lastUpdate {
	font-weight: bold;
	font-size: 14px;
	margin-left: 10px;
}
#lastUpdate span {
	color: #a00;
}
</style>