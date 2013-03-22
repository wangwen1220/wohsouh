<?php $this->display('header', 'system');?>

<div class="pop_box_area" style="height:445px; overflow:hidden;">
  <div class="operation_area layout">
    <div class="f_r">
      <input type="button" value="手工添加" class="button_style_1" onclick="related_add()"/>
    </div>
    <div class="search_icon">
      <form method="GET" id="system_related_search" action="?app=system&controller=related&action=related">
        <input type="text" name="keywords" id="keywords" size="10" title="请输入关键词" value="<?=$keywords?>" class="w_160">&nbsp;
        <?=element::model('modelid', 'modelid', $model)?>&nbsp;
        <?=element::category('catid', 'catid', $catid)?>
        <input type="submit" value="搜索" class="button_style_1" style="width:60px"/>
      </form>
    </div>
  </div>
    <div class="bdr_r f_r" style="width:408px;">
      <h3>已选(<span id="checked_count">0</span>)</h3>
      <div class="h_350">
        <ul id="list" class="txt_list">
        </ul>
      </div>
    </div>
    <div class="bdr_r f_l" style="width:410px;">
      <h3 class="layout"><span class="f_r"><img src="images/dx.gif" title="按时间 新→旧 排序" height="20" width="16" onclick="related_sort('desc')" class="hand"/>　<img src="images/zx.gif" title="按时间 旧→新 排序" height="20" width="16" onclick="related_sort('asc')" class="hand" /></span><span class="f_l">待选(<span id="count">0</span>/<span id="total">0</span>)</span></h3>
      <div id="scroll_div" class="h_350">
        <ul id="data" class="txt_list">
        </ul>
      </div>
    </div>
    <div class="clear"></div>
   <div class="btn_area t_c">
    <input type="button" value="确定" class="button_style_1" onclick="related_ok()"/>
    <input type="button" value="取消" class="button_style_1" onclick="related_cancel()"/>
  </div>
</div>
<script type="text/javascript" src="js/related.js"></script>
<script type="text/javascript">
var related = '';
var page = 1;
var pagesize = 20;
var count = 0;
var total = 0;
var rid = 0;
var checked_count = 0;
var loading = false;
var show_more_lock = false;

$('#scroll_div').scroll(function(){
	var o = $('#scroll_div');
	if (o.scrollTop()+o.height() > o.get(0).scrollHeight - 90)
	{
		if (window.loading ) return;
		if (window.show_more_lock) return;
		if (count >= total) return;

		window.laoding = true;
		window.show_more_lock = true;
		page++;
		$.getJSON('?app=system&controller=related&action=related', 'catid='+$('#catid').val()+'&modelid='+$('#modelid').val()+'&keywords='+$('#keywords').val()+'&page='+page+'&pagesize='+pagesize, function(response) {
			if(response.state)
			{
				related_append(response.data);
				if (sort_mode != '') related_sort(sort_mode);
				count += response.data.length;
				$('#count').html(count);
			}
			else
			{
			}
			setTimeout(function(){ window.show_more_lock = false;},10);
			window.loading = false;
		});
	}
});

$(function(){
	var data = window.dialogArguments.relateddata;
	
	if ($.isArray(data))
	{
	    for (var i=0,l=data.length;i<l;i++)
	    {
	        related_list_add(null, data[i]);
	    }
	}
});
async_form('system_related_search', 'related_search_ok');
$('#system_related_search').submit();
</script>
</body></html>
