<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');?>
<div class="bk10"></div>
<link rel="stylesheet" href="<?php echo CSS_PATH;?>jquery.treeview.css" type="text/css" />
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.treeview.js"></script>
<?php if($ajax_show) {?>
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.treeview.async.js"></script>
<?php }?>
<SCRIPT LANGUAGE="JavaScript">
<!--
var folder_pc_hash = '<?echo $_SESSION["pc_hash"]?>';
<?php if($ajax_show) {?>
$(document).ready(function(){
    $("#category_tree").treeview({
			control: "#treecontrol",
			url: "index.php?m=content&c=content&a=public_sub_categorys&menuid=<?php echo $_GET['menuid']?>",
			ajax: {
				data: {
					"additional": function() {
						return "time: " + new Date;
					},
					"modelid": function() {
						return "<?php echo $modelid?>";
					}
				},
				type: "post"
			}
	});
});
<?php } else {?>
$(document).ready(function(){
	$("#category_tree").treeview({
			control: "#treecontrol",
			persist: "cookie",
			cookieId: "treeview-black"
	}).trigger('click');
});
<?php }?>
function open_list(obj) {

	window.top.$("#current_pos_attr").html($(obj).html());
}
//-->
</SCRIPT>
<script type="text/javascript" id='category_tree_page' src="<?php echo JS_PATH;?>huoshow_editor.js"></script>
 <style type="text/css">
.filetree *{white-space:nowrap;}
.filetree span.folder, .filetree span.file{display:auto;padding:1px 0 1px 16px;}
 </style>
 <div id="treecontrol">
 <span style="display:none">
		<a href="#"></a>
		<a href="#"></a>
		</span>
		<a href="#"><img src="<?php echo IMG_PATH;?>minus.gif" /> <img src="<?php echo IMG_PATH;?>application_side_expand.png" /> 展开/收缩</a>
</div>
<?php
 if($_GET['from']=='block') {
?>
<ul class="filetree  treeview"><li class="collapsable"><div class="hitarea collapsable-hitarea"></div><span><img src="<?php echo IMG_PATH.'icon/home.png';?>" width="15" height="14">&nbsp;<a href='?m=block&c=block_admin&a=public_visualization&type=index' target='right'><?php echo L('block_site_index');?></a></span></li></ul>
<?php } else { ?>
<ul class="filetree  treeview"><li class="collapsable"><div class="hitarea collapsable-hitarea"></div><span><img src="<?php echo IMG_PATH.'icon/box-exclaim.gif';?>" width="15" height="14">&nbsp;<a id='822' class='tab_link audit_content' href='?m=content&c=content&a=public_checkall&menuid=822' target='right'><?php echo L('checkall_content');?></a></span></li></ul>
<!--<ul class="filetree  treeview"><li class="collapsable"><div class="hitarea collapsable-hitarea"></div><span><img src="<?php echo IMG_PATH.'icon/box-exclaim.gif';?>" width="15" height="14">&nbsp;<a href='?m=content&c=content&a=public_draftbox&menuid=822' target='right'><?php echo '草稿箱';?></a></span></li></ul>-->
<?php } echo $categorys; ?>