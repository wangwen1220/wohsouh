<?php $this->display('header');?>
<style type="text/css">
#search_f {
	padding-left: 8px;
	width: 650px;
	float: left;
}
.selectDiv {
	float: left;
	margin: 1px 8px 0 0;
}
.ct_selector {
	float: left;
	padding-left: 6px;
}
#pup_model li {
	cursor: pointer;
	background: url(<?php echo IMG_URL?>js/lib/dropdown/bg.gif) no-repeat scroll 3px -46px transparent;
}
#pup_model li.over {
	color: #d00;
}

/** 下拉菜单 **/
div.dropmenu {
	position: relative;
}
div.dropmenu h3 {
	background: url(css/images/bg.gif) no-repeat scroll 0 -481px transparent;
	height: 22px;
	line-height: 24px;
	padding-left: 14px;
	cursor: pointer;
	width: 42px;
	color: #fff;
}
div.dropmenu h3 a {
	color: #fff;
}
div.dropmenu ul {
	display: none;
	position: absolute;
	left: 0;
	top: 24;
	background: #fff;
	border:1px solid #9EC6DD;
	z-index:999;
}
div.dropmenu li {
	border-bottom:1px solid #D0E6EC;
	line-height:24px;
	text-align:right;
	padding-right:6px;
}
#add {margin-left: 6px;}
</style>

<!--tablesorter-->
<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/contextMenu/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.contextMenu.js"></script>

<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.table.js"></script>
<script type="text/javascript" src="apps/section/js/classify.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/dropdown/style.css"/>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.dropdown.js"></script>

<div class="bk_8"></div>
<input type="button" id="add" value="添加分类" class="button_style_4 f_l"/>
<div class="bk_8"></div>
<table width="98%" cellpadding="0" cellspacing="0" id="item_list" class="tablesorter table_list" style="margin-left:6px;">
  <thead>
    <tr>
      <th width="25" class="t_l bdr_3"><input type="checkbox" id="check_all" /></th>
      <th width="5%">顺序</th>
	  <th width="20%">名称</th>
	  <th width="5%">区块数</th>
	  <th>备注</th>
      <th width="120">管理</th>
    </tr>
  </thead>
  <tbody id="list_body">
  </tbody>
</table>
<div class="table_foot">
	<p class="f_l">
		<input type="button" onclick="classify.del()" value="删除" class="button_style_1"/>
	</p>
</div>
<!--右键菜单-->
<ul id="right_menu" class="contextMenu">
	<li class="up"><a href="#classify.up">上移</a></li>
	<li class="down"><a href="#classify.down">下移</a></li>
	<li class="edit"><a href="#classify.save">编辑</a></li>
	<li class="del"><a href="#classify.del">删除</a></li>
</ul>

<script type="text/javascript">
var app = '<?=$app?>';
var controller = '<?=$controller?>';
var row_template = '\
<tr id="tr_{classid}">\
	<td><input type="checkbox" class="checkbox_style" name="chk_row" id="chk_row_{classid}" value="{classid}" /></td>\
	<td class="t_c"> {sort} </td>\
	<td class="t_l name"><a href="javascript:;" class="view"> {name}</a> </td>\
	<td class="t_c name"> {num} </td>\
    <td class="t_l"> {memo} </td>\
    <td class="t_c manage">\
    	<img src="images/up.gif" alt="上移" title="上移" class="up">&nbsp;<img src="images/down.gif" alt="下移" title="下移" class="down">&nbsp;<img src="images/edit.gif" alt="编辑" title="编辑" class="edit">&nbsp;<img src="images/del.gif" alt="删除" title="删除" class="del">\
    </td>\
</tr>';

var tableApp = new ct.table('#item_list', {
    rowIdPrefix : 'tr_',
    rightMenuId : 'right_menu',
    pageField : 'page',
    dblclickHandler : 'classify.save',
    rowCallback     : 'init_event',
    template : row_template,
    baseUrl  : '?app=<?=$app?>&controller=<?=$controller?>&action=page'
});
$(function (){
	tableApp.load();
	$('#add').click(classify.save);
});
//init function
function init_event(id, tr)
{
	tr.find('img.edit').click(function (){
		classify.save(id);
	});
	tr.find('a.view').click(function (){
		classify.view(id);
	});
	tr.find('img.del').click(function (){
		classify.del(id);
	});
	tr.find('img.up, img.down').click(function (){
		classify.upDown(id, this.className);
	});
}
</script>
<?php $this->display('footer','system');?>