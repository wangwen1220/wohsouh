<?php $this->display('header', 'system');?>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/tablesorter/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/pagination/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/contextMenu/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/dropdown/style.css"/>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.dropdown.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.table.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.tablesorter.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.contextMenu.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.pagination.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.treeview.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/datepicker/WdatePicker.js"></script>
<div class="bk_10"></div>
<div class="table_head tag_1">
	<div>
		<ul class="tag_list">
		<li><a href="?app=<?=$app?>&controller=article&action=index&catid=<?=$catid?>&modelid=1&status=3">编辑送审</a></li>
		<li><a href="?app=<?=$app?>&controller=<?=$controller?>&action=index&catid=<?=$catid?>" class="s_3" >用户投稿</a></li>
		</ul>
	</div>
</div>
<div id="created_x" class="th_pop" style="display:none;width:150px">
	<div>
		<a href="javascript: tableApp.load('created_min=<?=date('Y-m-d', TIME)?>');">今日</a> |
		<a href="javascript: tableApp.load('created_min=<?=date('Y-m-d', strtotime('yesterday'))?>&created_max=<?=date('Y-m-d', strtotime('yesterday'))?>');">昨日</a> | 
		<a href="javascript: tableApp.load('created_min=<?=date('Y-m-d', strtotime('last monday'))?>');">本周</a> | 
		<a href="javascript: tableApp.load('created_min=<?=date('Y-m-01', strtotime('this month'))?>');">本月</a>
	</div>
	<ul>
		<?php  for ($i=2; $i<=7; $i++) { 
			$createdate = date('Y-m-d', strtotime("-$i day"));?>
		<li><a href="javascript: tableApp.load('created_min=<?=$createdate?>&created_max=<?=$createdate?>');"><?=$createdate?></a></li>
		<?php } ?>
	</ul>
</div>
<table width="98%" cellpadding="0" cellspacing="0" id="item_list" class="tablesorter table_list mar_l_8">
	<thead>
		<tr>
		<th width="30" class="t_l bdr_3"><input type="checkbox" id="check_all" class="checkbox_style"/></th>
		<th width="60">所属频道</th>
		<th>标题</th>
		<th width="80">管理操作</th>
		<th width="55">作者</th>
		<th width="120" class="ajaxer"><em class="more_pop" name="created_x"></em><div name="created">投稿时间</div></th>
		</tr>
	</thead>
	<tbody id="list_body"></tbody>
</table>
<div class="table_foot">
	<div id="pagination" class="pagination f_r"></div>
	<div class="f_r"> 共有<span id="pagetotal">0</span>条记录&nbsp;&nbsp;&nbsp;每页
	<input type="text" name="pagesize" size="3" id="pagesize" value=""/>条&nbsp;&nbsp;</div>
	<p class="f_l">
		<input type="button" name="audit" onclick="contribute.audit();" value="通过" class="button_style_1"/>
		<input type="button" name="reject" onclick="contribute.reject();" value="退稿" class="button_style_1"/>
	</p>
</div>
<!--右键菜单-->
<ul id="right_menu" class="contextMenu">
	<li class="view"><a href="#contribute.view">查看</a></li>
	<li class="audit"><a href="#contribute.audit">通过</a></li>
	<li class="reject"><a href="#contribute.reject">退稿</a></li>
</ul>
<script type="text/javascript" src="apps/article/js/contribute.js"></script>
<script type="text/javascript">
var manage_td = '<img src="images/edit.gif" alt="编辑" title="编辑" width="16" height="16" class="manage" onclick="contribute.edit(\'{contentid}\');"/>&nbsp;<img src="images/sh.gif" alt="通过" title="通过" width="16" height="16" class="manage" onclick="contribute.audit(\'{contentid}\');"/>&nbsp;<img src="images/reject.gif" alt="退稿" title="退稿" width="16" height="16" class="manage" onclick="contribute.reject(\'{contentid}\');"/>';
var row_template = '<tr id="row_{contentid}">';
	row_template +='	<td><input type="checkbox" class="checkbox_style" name="chk_row" id="chk_row_{contentid}" value="{contentid}" /></td>';
	row_template +='	<td class="t_c">{catname}</td>';
	row_template +='	<td><a href="javascript:contribute.view({contentid});" >{title}</a> </td>';
	row_template +='	<td class="t_c" id="manage_{contentid}" name="manage" value="manage">'+manage_td+'</td>';
	row_template +='	<td class="t_c">{createdbyname}</td>';
	row_template +='	<td class="t_c">{created}</td>';
	row_template +='</tr>';

var tableApp = new ct.table('#item_list', {
	rowIdPrefix : 'row_',
	rightMenuId : 'right_menu',
	pageField : 'page',
	pageSize : 15,
	dblclickHandler : 'contribute.view',
	jsonLoaded : 'json_loaded',
	rowCallback : 'init_row_event',
	template : row_template,
	baseUrl  : '?app=<?=$app?>&controller=<?=$controller?>&action=page&catid=<?=$catid?>&modelid=1&status=3'
});

function init_row_event(id, tr) {
	tr.find('a.title_list').attrTips('tips');
}

function json_loaded(json) {
	$('#pagetotal').html(json.total);
}
tableApp.load();
$(function(){
	$('#pagesize').val(tableApp.getPageSize());
});
</script>
<?php $this->display('footer','system'); ?>