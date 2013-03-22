<?php $this->display('header', 'system');?>
<!--tablesorter-->
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/tablesorter/style.css" />
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.table.js"></script>
<!--contextmenu-->
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/contextMenu/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.contextMenu.js"></script>

<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.uploadify.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/navigator/style.css"/>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.navigator.js"></script>

<script type="text/javascript" src="apps/system/js/template.js"></script>
<div class="bk_10"></div>
<div class="table_head" style="min-width:800px;">
  <div class="search_icon search f_r mar_r_8">
      <form onsubmit="return false;" id="search_f">
        <input type="text" name="keywords" value="" size="30"/>
        <a href="javascript:;" style="outline:none" onfocus="this.blur()" onclick="App.table.load($('#search_f'));return false;" title="搜索">搜素</a>
      </form>
  </div>
  <input type="button" name="add" class="button_style_4 f_l" onclick="App.add();  return false;" value="新建模板"/>
  <div class="f_l" style="width:80px;height:22px;">
  	<div style="position:absolute;z-index:9;">
  		<div id="uploadify"></div>
  	</div>
	<input type="button" class="button_style_4" onclick="App.add();  return false;" value="上传模板" style="position:absolute;z-index:8;"/>
  </div>
  <div class="f_l w_400" id="navigator"></div>
</div>
<div class="bk_8"></div>
<table width="98%" id="item_list" class="table_list mar_l_8" cellspacing="0" cellpadding="0" style="empty-cells:show;table-layout:fixed;">
  <thead>
    <tr>
      <th width="260" class="bdr_3">名称</th>
      <th class="t_c">别名</th>
      <th width="80">管理操作</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<!--右键菜单-->
<ul id="right_menu_folder" class="contextMenu">
   <li class="edit"><a href="#App.open">打开</a></li>
   <li class="delete"><a href="#App.del">删除</a></li>
   <li class="edit"><a href="#App.alias">别名</a></li>
</ul>
<ul id="right_menu_file" class="contextMenu">
   <li class="edit"><a href="#App.edit">编辑</a></li>
   <li class="delete"><a href="#App.del">删除</a></li>
   <li class="edit"><a href="#App.alias">别名</a></li>
</ul>
<script type="text/javascript">
App.init('?app=<?=$app?>&controller=<?=$controller?>');
</script>
<?php $this->display('footer', 'system');