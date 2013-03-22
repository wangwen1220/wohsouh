<?php $this->display('header');?>
<style type="text/css">
#search_f {
	padding-right: 16px;
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
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/tablesorter/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/contextMenu/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.contextMenu.js"></script>

<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.table.js"></script>

<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/dropdown/style.css"/>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.dropdown.js"></script>

<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/suggest/style.css" />
<script src="<?=IMG_URL?>js/lib/cmstop.suggest.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/tree/style.css" />
<script src="<?=IMG_URL?>js/lib/cmstop.tree.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/editplus/style.css" />
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.editplus.js"></script>
<script type="text/javascript" src="js/cmstop.editplus_plugin.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="tiny_mce/editor.js"></script>

<script type="text/javascript" src="apps/section/js/section.js"></script>
<div class="bk_8"></div>
<div class="tag_1">
	<span class="f_l">
		<input type="button" id="add" value="添加区块" class="button_style_4 f_l"/>
		<input type="button" id="publish" value="全部生成" class="button_style_4 f_l"/>
		<input type="button" id="catBtn" value="分类管理" class="button_style_4 f_l"/>
	</span>
	<div class="search search_icon f_r">
	<form method="GET" name="search_f" id="search_f" action="javascript:;">
		<input type="text" name="keywords" id="keywords" value="<?=$keywords?>" size="15"/>
		<a id="submit" type="submit" href="javascript:;">搜素</a>
	</form>
	</div>
	<ul class="tag_list" style="left:250px;position:absolute;">
		<li><a type="" href="javascript:;" class="s_3">全部</a></li>
		<li><a type="commend" href="javascript:;">推荐位</a></li>
		<li><a type="auto" href="javascript:;">自动</a></li>
		<li><a type="html" href="javascript:;">代码</a></li>
	</ul>
</div>
<table width="98%" cellpadding="0" cellspacing="0" id="item_list" class="tablesorter table_list" style="margin-left:6px;">
  <thead>
    <tr>
      <th width="25" class="t_l bdr_3"><input type="checkbox" id="check_all" /></th>
       <th width="50" class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="sectionid">ID</div>
	  </th>
      <?php if(!$_GET['classid']): ?>
      <th width="70" class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="classid">分类</div>
	  </th>
	  <?php endif;?>
	  <th width="20%" class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="name">名称</div>
	  </th>
      <th width="8%" class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="type">类型</div>
	  </th>
      <th width="110" class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="modified">最后更新</div>
	  </th>
	  <th width="9%" class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="modifiedby">更新者</div>
	  </th>
	  <th>备注</th>
      <th width="120">管理</th>

    </tr>
  </thead>
  <tbody id="list_body">
  </tbody>
</table>
<div class="table_foot">
		<input type="button" onclick="section.del()" value="删除" class="button_style_1"/>
		<input type="button" tips="移动到顶部：不同于通常的置顶功能，如果有新推荐内容还是会被推下来" onclick="section.top()" value="置顶" class="button_style_1"/>
		<input type="button" tips="移动到底部" onclick="section.bottom()" value="沉底" class="button_style_1"/>
		<input type="button" onclick="section.publish()" value="发布" class="button_style_1"/>
		<span class="f_r">
			<select id="classid" class="classid">
				<option value="">移动到</option>
				<?php foreach ($class AS $r): ?>
					<option value="<?php echo $r['classid']?>"><?php echo $r['name']?></option>
				<?php endforeach;?>
			</select>&nbsp;
		</span>
</div>
<!--右键菜单-->
<ul id="right_menu" class="contextMenu">
	<li class="edit"><a href="#section.top">置顶</a></li>
   <li class="up"><a href="#section.up">上移</a></li>
   <li class="down"><a href="#section.down">下移</a></li>
   <li class="edit"><a href="#section.bottom">沉底</a></li>
   <li class="publish"><a href="#section.publish">发布</a></li>
   <li class="log"><a title="编辑区块数据" href="#section.data">编辑</a></li>
   <li class="view"><a href="#section.view">预览</a></li>
   <li class="priv"><a href="#section.priv">权限</a></li>
   <li class="edit"><a title="设置区块属性" href="#section.save">设置</a></li>
   <li class="copy"><a title="复制调用代码" href="#section.copy">调用</a></li>
   <li class="del"><a href="#section.del">删除</a></li>
</ul>

<script type="text/javascript">
var app = '<?=$app?>';
var controller = '<?=$controller?>';
var row_template = '\
<tr id="tr_{sectionid}">\
	<td><input type="checkbox" class="checkbox_style" name="chk_row" id="chk_row_{sectionid}" value="{sectionid}" /></td>\
	<td class="t_c"> {sectionid} </td>\n';
	<?php if(!$_GET['classid']): ?>
      row_template += '\t<td class="t_c"> {catName} </td>\n';
	<?php endif;?>
	row_template += '\t<td class="t_l name"><a href="javascript:;" class="data"> {name}</a> </td>\
    <td class="t_c"> {typeText} </td>\
    <td class="t_c"> {modified} </td>\
    <td class="t_c"> <a href="javascript: url.member({modifiedby});">{modifiedUser}</a> </td>\
	<td class="t_l"> {cutMemo}</td>\
    <td class="t_c manage">\
    	<img src="images/up.gif" alt="上移" title="上移" class="up">&nbsp;<img src="images/down.gif" alt="下移" title="下移" class="down">&nbsp;<img src="images/refresh.gif" alt="发布" title="发布" class="publish">&nbsp;<img src="images/page_white_copy.png" alt="复制" title="复制调用代码" class="copy">&nbsp;<img src="images/edit.gif" alt="设置" title="设置" class="edit">&nbsp;<img src="images/del.gif" alt="删除" title="删除" class="del">\
    </td>\
</tr>';

var url = '?app=<?=$app?>&controller=<?=$controller?>&action=page';
var classid = '<?=$_GET['classid']?>';
if(classid > 0) url += '&classid=<?=$_GET['classid']?>';
var tableApp = new ct.table('#item_list', {
    rowIdPrefix : 'tr_',
    rightMenuId : 'right_menu',
    pageField : 'page',
    dblclickHandler : 'section.save',
    rowCallback     : 'init_event',
    template : row_template,
    baseUrl  : url
});
$(function (){
	$('#search_f').submit(function (){
		tableApp.load($('#search_f').serialize());
	}).submit();
	//回车搜索
	$('#keywords').keydown(function (e){
		if(e.keyCode == 13) {
			$('#search_f').submit();
		}
	});
	$('#add').click(section.save);
	$('#publish').click(section.publish);
	$('#catBtn').click(function (){
		ct.assoc.open('?app=section&controller=classify&action=index', 'newtab');
	});
	
	$('ul.tag_list li a').click(function (){
		tableApp.load('type='+$(this).attr('type'));
		$('ul.tag_list li a.s_3').removeClass('s_3');
		$(this).addClass('s_3');
		$('#keywords').val('');
	}).focus(function (){
		$(this).blur();
	});
	$('#submit').click(function (){
		$('#search_f').submit();
	}).focus(function (){
		$(this).blur();
	});
	$('#classid').change(section.cat).val('');
});
//init function
function init_event(id, tr)
{
	tr.find('a.edit, img.edit').click(function (){
		section.save(id);
	});
	tr.find('a.data, img.data').click(function (){
		section.data(id);
	});
	tr.find('a.view, img.view').click(function (){
		section.view(id);
	});
	tr.find('img.del').click(function (){
		section.del(id);
	});
	tr.find('img.publish').click(function (){
		section.publish(id);
	});
	tr.find('img.copy').click(function (){
		section.copy(id);
	});
	tr.find('img.up, img.down').click(function (){
		section.upDown(id, this.className);
	});
	$('a[tips],input[tips]').attrTips('tips');
}
</script>
<?php $this->display('footer','system');?>