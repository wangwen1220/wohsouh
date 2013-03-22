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

<link href="<?=IMG_URL?>js/lib/tree/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.tree.js"></script>
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
	    <li><a href="?app=system&controller=rank_comment&action=category" class="s_3">按栏目排行</a></li>
	    <li><a href="?app=system&controller=rank_comment&action=model">按模型排行</a></li>
	    <li><a href="?app=system&controller=rank_comment&action=admin">按编辑排行</a></li>
	</ul>
</div>
<div class="bg_1" id="tree_in">
  <div class="w_160 box_6 mar_r_8 f_l" style="position:relative;width:155px;background: #F9FCFD;">
    <h3><span class="dis_b b" onclick="">栏目列表</span></h3>
    <div id="category" style="position:absolute;z-index:3;"></div>
  </div>
  <div class="f_l" style="padding-left:10px;width:660px">
<form id="search">
<table>
<tr>
<td>
<input type="hidden" name="catid" value="<?=$catid?>">
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

var current_catid = '<?=$current_catid?>';
$('#category').tree({
	url:"?app=system&controller=rank_comment&action=cate&catid=%s",
	paramId : 'catid',
	paramHaschild:"hasChildren",
	renderTxt:function(div, id, item){
		return $('<span>'+item.name+'</span>');
	},
	active : function(div, id, item){
		tableApp.load('catid='+id+'&created_min='+$('#created_min').val()+'&created_max='+$('#created_max').val());
		$('input[name=catid]').val(id);
		current_catid = id;
	},
	prepared:function(){
		var t = this;
		$.getJSON('?app=system&controller=rank_comment&action=category_path&catid='+current_catid, function(path){
			t.open(path);
		});
	}
});

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