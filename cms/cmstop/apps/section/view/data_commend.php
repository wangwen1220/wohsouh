<?php $this->display('header');?>
<!--tablesorter-->
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/tablesorter/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/contextMenu/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.contextMenu.js"></script>

<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.table.js"></script>

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
<script type="text/javascript" src="apps/section/js/data.js"></script>
<style type="text/css">
#published {
	color:#444444;
	line-height:20px;
	margin:0 10px;
}
</style>
<div class="bk_8"></div>
<div class="table_head">
	<input type="button" value="设置" class="button_style_2 f_r attribute"/>
	<span id="published" class="f_r">
	<?php if($published):?>
	最后发布：<?=date('Y年n月j日 G:i',$published)?>
	<?php else:?>
	未发布
	<?php endif;?>
	</span>
	<input type="button" value="选取" class="button_style_2 f_l relate"/>
	<input type="button" value="添加" id="add" class="button_style_2 f_l"/>
	<input type="button" value="发布" class="button_style_2 f_l publish"/>
	<input type="button" value="预览" class="button_style_2 f_l view"/>
</div>
<div class="bk_8"></div>
<table width="98%" cellpadding="0" cellspacing="0" id="item_list" class="tablesorter table_list" style="margin-left:6px;">
  <thead>
    <tr>
      <th width="25" class="t_l bdr_3"><input type="checkbox" id="check_all" /></th>
      <th class="header" width="30">序号</th>
	  <th class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="title">标题</div>
	  </th>
      <th width="120" class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="created">发布时间</div>
	  </th>
	  <th width="9%" class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="createdby">发布人</div>
	  </th>
	  <th width="120" class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="commended">推荐时间</div>
	  </th>
	  <th width="9%" class="header ajaxer">
		  <em name="pop_layer_id"></em><div name="commendedby">推荐人</div>
	  </th>
      <th width="90">管理</th>
    </tr>
  </thead>
  <tbody id="list_body">
  </tbody>
</table>
<div class="table_foot">
	<p class="f_l">
		<input type="button" tips="移动到顶部：不同于通常的置顶功能，如果有新推荐内容还是会被推下来" onclick="data.top()" value="置顶" class="button_style_1"/>
		<input type="button" tips="移动到底部" onclick="data.bottom()" value="沉底" class="button_style_1"/>
		<input type="button" onclick="data.del()" value="删除" class="button_style_1"/>
		<input type="button" onclick="tableApp.load()" value="刷新" class="button_style_1"/>
		<div class="f_r">
			<input type="checkbox" id="history" value="1" class="checkbox_style_1"/>显示历史
			<input type="button" onclick="data.clear(<?=$sectionid?>)" value="清空历史" class="button_style_1"/>
		</div>
	</p>
</div>
<?php if($memo): ?>
<div style="padding:10px;text-align:center;width:98%;">
	<p style="border:1px #DDD solid;background:#efefef;width:500px;margin:0px auto;text-align:left;padding:5px;color:#333">备注：<?=$memo?></p>
</div>
<?php endif; ?>
<!--右键菜单-->
<ul id="right_menu" class="contextMenu">
   <li class="up"><a href="#data.up">上移</a></li>
   <li class="down"><a href="#data.down">下移</a></li>
   <li class="edit"><a href="#data.save">编辑</a></li>
   <li class=""><a href="#data.top">顶部</a></li>
   <li class=""><a href="#data.bottom">底部</a></li>
   <li class="del"><a href="#data.del">删除</a></li>
</ul>

<script type="text/javascript">
var app = '<?=$app?>';
var controller = '<?=$controller?>';
var row_template = '\
<tr id="tr_{dataid}">\
	<td><input type="checkbox" class="checkbox_style" name="chk_row" id="chk_row_{dataid}" value="{dataid}" /></td>\
	<td class="t_c sid">{sid}</td>\
	<td class="t_l"> <a href="{url}" target="_blank" title="查看内容"><div class="link"></div></a><a style="color:{color}" href="javascript:;" class="edit"> {title}</a> {history}</td>\
    <td class="t_c"> {created_str} </td>\
    <td class="t_c"> <a href="javascript: url.member({createdby});">{createdby_user}</a> </td>\
	<td class="t_c"> {commended_str} </td>\
    <td class="t_c"> <a href="javascript: url.member({commendedby});">{commendedby_user}</a> </td>\
    <td class="t_c manage">\
    	<img src="images/up.gif" alt="上移" title="上移" class="up">&nbsp;\
    	<img src="images/down.gif" alt="下移" title="下移" class="down">&nbsp;\
    	<img src="images/edit.gif" alt="编辑" title="编辑条目" class="edit">&nbsp;\
    	<img src="images/del.gif" alt="删除" title="删除" class="del">\
    </td>\
</tr>';
var sectionid = <?=$sectionid?>;
var tableApp = new ct.table('#item_list', {
    rowIdPrefix : 'tr_',
    rightMenuId : 'right_menu',
    pageField : 'page',
    dblclickHandler : 'data.save',
    rowCallback     : 'init_event',
    template : row_template,
    baseUrl  : '?app=<?=$app?>&controller=data&action=page&sectionid='+sectionid
});
$(function (){
	tableApp.load();
	$('#add').click(data.save);
	$('input.relate').click(function (){
		data.relate(sectionid);
	});
	$('input.attribute').click(function (){
		section.save(sectionid);
	});
	$('input.view').click(function (){
		section.view(sectionid);
	});
	$('input.publish').click(function (){
		section.publish(sectionid);
	});

	$('#history').click(function (){
		tableApp.load('history='+(this.checked ? 1 : 0));
	});
});
//init function
function init_event(id, tr)
{
	tr.find('a.edit, img.edit').click(function (){
		data.save(id);
	});
	tr.find('img.del').click(function (){
		data.del(id);
	});
	tr.find('img.up, img.down').click(function (){
		data.upDown(id, this.className);
	});
	$('td[tips],input[tips]').attrTips('tips');
}
</script>
<?php $this->display('footer','system');?>