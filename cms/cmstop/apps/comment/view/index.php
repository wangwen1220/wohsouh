<?php $this->display('header', 'system');?>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/pagination/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/contextMenu/style.css"/>
<script type="text/javascript" src="<?=IMG_URL?>apps/comment/js/comment.table.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.contextMenu.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.pagination.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/datepicker/WdatePicker.js"></script>
<script type="text/javascript" src="apps/comment/js/comment.js"></script>
<div class="bk_10"></div>
<div class="tag_1 mar_l_8">
	<ul class="tag_list">
		<li><a href="?app=comment&controller=comment&action=index&disabled=0" <?php if($disabled ==0) { ?>class="s_3" <?php } ?> >已审</a></li>
		<li><a href="?app=comment&controller=comment&action=index&disabled=1" <?php if($disabled ==1) { ?>class="s_3" <?php } ?> >待审</a></li>
	</ul>
</div>
<table class="table_form mar_5 mar_l_8" cellpadding="0" cellspacing="0" width="760px">
	<tr>
		<th width="11%">快捷通道</th>
		<td width="89%">
			<input name="rwkeyword" id="rwkeyword" type="text" size="20" value="请输入url或者文章id" onfocus="this.value == '请输入url或者文章id' && (this.value = '')" onblur=" this.value || (this.value = '请输入url或者文章id')" style="width:300px"/>　
			<input type="button" id="rw" value="列出" class="button_style_1"/>
		</td>
	</tr>
	<tr>
		<th>检索</th>
		<td>
		<form  name="search_f" id="search_f" action="?app=comment&controller=comment&action=page" method="GET" onsubmit="tableApp.load($('#search_f'));return false;">
			<input type="text" name="published" id="published" class="input_calendar" value="" size="20"/>
				至 
			<input type="text" name="unpublished" id="unpublished" class="input_calendar" value="" size="20"/>
			<select name="type" id="type">
			  <option value="1">关键词</option>
			  <option value="2">IP</option>
			  <option value="3">用户名</option>
			</select>
			<input name="keywords" id="keywords" type="text" size="20" value="<?php echo $keyword;?>"/> 
			<input type="submit" value="搜索" class="button_style_1"/>
			<input type="button" value="删除" onclick="comment.searchDel();" class="button_style_1"/>
		</form>
		</td>
	</tr>
</table>
<div class="bk_10"></div>
<div class="tag_list_1 pad_8 layout mar_l_8" id="bytime_list">
	<a href="javascript:tableApp.load('status=0');" id="all" class="s_5">全部</a>
	<a href="javascript: tableApp.load('published=<?=date('Y-m-d', TIME)?>');">今天</a>
	<a href="javascript: tableApp.load('published=<?=date('Y-m-d', strtotime('yesterday'))?>&unpublished=<?=date('Y-m-d', strtotime('yesterday'))?>');">昨天</a>
	<a href="javascript: tableApp.load('published=<?=date('Y-m-d', strtotime('last monday'))?>');">本周</a>
	<a href="javascript: tableApp.load('published=<?=date('Y-m-d', strtotime('last month'))?>');">本月</a>
	<div class="clear"></div>
</div>

<div id="content" class="mar_l_8"></div>
<div class="bk_10"></div>
<div class="clear"></div>
<div class="table_foot mar_l_8" style="width:80%">
	<span class="f_l">
		<input type="checkbox" id="selectAll"/>&nbsp;&nbsp;
		<?php if($disabled) {?><input type="button" id="check" onclick="comment.multiCheck();" value="通过" class="button_style_1"/><?php } ?>
		<input type="button" id="delete"  onclick="comment.multiDel();"  value="删除" class="button_style_1"/>
	</span>
	<span id="pagination" class="pagination f_r"></span>
	<span class="f_r"><label id="status"></label>共有<span id="pagetotal">0</span>条记录&nbsp;&nbsp;&nbsp;每页<input value="<?php echo $pagesize;?>" id="pagesize" size="2">条</span>
</div>
<ul id="ip_menu" class="contextMenu">
	<li class="delete"><a href="#comment.ipDeleteAll">删除所有</a></li>
	<li class="new"><a href="#comment.ipDisallow">锁定ip</a></li>
	<li class="edit"><a href="#comment.ipEdit">修改ip</a></li>
</ul>
<script type="text/javascript">
var ipTime = <?php echo $SETTING['iptime'];?>;
var row_template = '<div class="comment_list mar_5" id="div_{commentid}">';
	row_template +='<ul class="f_l">';
	row_template +='	<li><span class="f_r"><a href="javascript:void(0);" class="u" onclick="comment.url({createdby})">{username}</a> <a href="javascript:void(0);" class="u ip"  value= "{commentid}" id="ip_{commentid}" title="点击弹出菜单">{ip}</a><span class="c_gray">({location})</span> <span class="c_gray"> 顶 ({support})</span><span class="date">{created}</span></span> <input type="checkbox" name="commentid[{commentid}]" id="checkbox3" class="mar_3 checkbox_style" value="{commentid}"/><span>{warn}</span><a href="{url}" target="_blank"class="c_blue b">{title}</a>  <a href="javascript:void(0);" onclick="comment\.get_by_contentid({contentid})" title="全部评论"><img src="images/dialog.gif" style="vertical-align:bottom"></a></li>';
	row_template +='	<li><div ondblclick="comment.setTextArea(this,{commentid})" id="content{commentid}" style="line-height:20px;padding:3px;overflow:hidden;">{content}</div> </li>';
	row_template +='</ul>';
	row_template +='<ol class="f_l"  style="margin-left:10px"><li></li>';
	row_template +='	<?php if($disabled) {?><li><a href="javascript:comment.check({commentid})" class="check" value="{commentid}"><img src="images/sh.gif" alt="通过审核" height="16" width="16" class="hand" name="通过审核"/></a></li><?php } ?><li><a href="javascript:comment.del({commentid})" class="del" value="{commentid}"><img src="images/del.gif" alt="删除" height="16" width="16" class="hand" name="删除"/></a></li><li><a href="javascript:comment.edit({commentid})" class="edit"><img src="images/edit.gif" alt="修改" height="16" width="16" class="hand" name="修改"/></a></li></ol>';
	row_template +='<div class="clear"></div>';
	row_template +='</div>';
var tableApp = new ct.table('#content', {
	rowIdPrefix : 'div_',
	pageSize : 15,
	rowCallback: 'init_row_event',
	jsonLoaded : 'json_loaded',
	template : row_template,
	baseUrl  : '?app=<?=$app?>&controller=<?=$controller?>&action=comment_page&disabled=<?=$disabled?>'
});
function init_row_event(id, tr) {
	tr.find('.ip').contextMenu('#ip_menu',
	function(action) {
		var callback = ct.func(action);
		callback && callback(id, tr);
	}).click(function(e){
		var t = $(this);
		setTimeout(function(){t.trigger('contextMenu',[e])},0);
	});
}

function json_loaded(json) {
	$('#pagetotal').html(json.total);
	
}

$(function() {
	$.validate.setConfigs({
		xmlPath:'/apps/comment/validators/'
	});
	tableApp.load();
	$('#pagesize').val(tableApp.getPageSize());
	$('#pagesize').blur(function(){
		var p = $(this).val();
		tableApp.setPageSize(p);
		tableApp.load();
	});
	
	$('input.input_calendar').focus(function(){
		WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});
	});
	$('#rw').click(function(){
		var value = $('#rwkeyword').val();
		tableApp.load('rwkeyword='+value);
	});
	$('#bytime_list > a').click(function(){
		$('#bytime_list > a.s_5').removeClass('s_5');
		$(this).addClass('s_5');
	}).focus(function(){
		this.blur();
	});
	$('#selectAll').click(function(){
		var d = $(this);
		var checkbox = $('#content').find('input:checkbox');
		if(d.attr('checked') == true) {
			checkbox.each(function(){
				$(this).attr('checked','checked');
			});
		} else {
			checkbox.each(function(){
				$(this).attr('checked','');
			});
		}
	});
});
</script>
<?php $this->display('footer', 'system');?>