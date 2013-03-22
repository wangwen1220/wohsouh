<?php $this->display('header', 'system');?>
<!--tablesorter-->
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/tablesorter/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.tablesorter.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.table.js"></script>
<!--contextmenu-->
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/contextMenu/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.contextMenu.js"></script>
<!--pagination-->
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/pagination/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.pagination.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/dropdown/style.css"/>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.dropdown.js"></script>

<link href="<?=IMG_URL?>js/lib/treeview/treeview.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.treeview.js"></script>

<div class="bk_8"></div>
<div class="tag_1">
   <div id="add_data">
	  <select id="changerank" style="width:100px;z-index:99;" marginTop="1" marginLeft="0">
  		  <option value="pv">点击排行</option>
  		  <option value="comment" selected>评论排行</option>
	  </select>
	</div>
	<ul class="tag_list" style="margin-left:160px">
	    <li><a href="?app=system&controller=rank_comment&action=index">全站排行</a></li>
	    <li><a href="?app=system&controller=rank_comment&action=category">按栏目排行</a></li>
	    <li><a href="?app=system&controller=rank_comment&action=model" class="s_3">按模型排行</a></li>
	    <li><a href="?app=system&controller=rank_comment&action=admin">按编辑排行</a></li>
	</ul>
</div>
<div class="bg_1" id="tree_in">
  <div class="w_160 box_6 mar_r_8 f_l" style="position:relative;width:155px;background: #F9FCFD;">
    <h3><span class="dis_b b" onclick="">模型列表</span></h3>
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
  <div class="f_l" style="padding-left:10px;width:660px">
<form id="search">
<table>
<tr>
<td>
<input type="hidden" name="modelid" value="<?=$modelid?>">
<input type="text" name="created_min" id="created_min" class="input_calendar" value="<?=$created_min?>" size="20"/> ~ 
<input type="text" name="created_max" id="created_max" class="input_calendar" value="<?=$created_max?>" size="20"/>
</td>
<td><input type="button" value="查询" class="button_style_1" onclick="tableApp.load($('#search'));"/></td>
</tr>
</table>
</form>
<table width="98%" cellpadding="0" cellspacing="0" id="item_list" class="tablesorter table_list mar_t_8">
<thead>
  <tr>
    <th class="bdr_3">标题</th>
    <th width="60">评论</th>
    <th width="50">类型</th>
    <th width="100">录入</th>
    <th width="120">录入时间</th>
  </tr>
</thead>
<tbody id="list_body">
</tbody>
</table>
<div class="table_foot" style="width:98%">
  <div id="pagination" class="pagination f_r"></div>
</div>
  </div>
  <div class="clear"></div>
</div>
<script type="text/javascript">
var row_template = '<tr id="row_{contentid}">';
row_template +='	<td><a href="javascript: ct.assoc.open(\'?app={modelalias}&controller={modelalias}&action=view&contentid={contentid}\', \'newtab\');">{title}</a></td>';
row_template +='	<td class="t_r">{comments}</td>';
row_template +='	<td class="t_c">{modelname}</td>';
row_template +='	<td class="t_c"><a href="javascript: url.member({createdby});">{createdbyname}</a></td>';
row_template +='	<td class="t_c">{created}</td>';
row_template +='</tr>';

var tableApp = new ct.table('#item_list', {
    rowIdPrefix : 'row_',
    rightMenuId : null,
    pageField : 'page',
    pageSize : 15,
    dblclickHandler : null,
    rowCallback     : 'init_row_event',
    template : row_template,
    baseUrl  : '?app=system&controller=rank_comment&action=page'
});

function init_row_event(id, tr)
{
    tr.find('a.title_list').attrTips('tips');
}

var current_modelid = <?=$current_modelid?>;

$("#model_tree").treeview();
$("#model_tree span").each(function(i){
    $(this).unbind('click');
    $(this).unbind('mouseover');
});
$("#model_tree span").addClass('hand');
$("#model_tree span").click(function(){
	var offset = $(this).offset();
	$('#bg').css('top', offset.top-$(this).height()-25);
	tableApp.load('modelid='+this.id+'&created_min='+$('#created_min').val()+'&created_max='+$('#created_max').val());
	current_modelid = this.id;
	$('input[name=modelid]').val(this.id);
});

$('#'+current_modelid).click();

$('#changerank').dropdown({
	changerank:{
		onchange:function(action, name){
			window.location.href = '?app=system&controller=rank_'+action+'&action=index';
		}
	}
});

$('input.input_calendar').focus(function(){
	WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});
});
</script>
<?php $this->display('footer', 'system');?>