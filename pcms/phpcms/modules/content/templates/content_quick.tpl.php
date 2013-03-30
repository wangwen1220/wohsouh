<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');?>
<div id="closeParentTime" style="display:none"></div>
<script id="content_quick" type="text/javascript" src="<?php echo JS_PATH?>huoshow_editor.js"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
	if(window.top.$("#current_pos").data('clicknum')==1 || window.top.$("#current_pos").data('clicknum')==null) {
	if(parent.document.getElementById('display_center_id') != null) parent.document.getElementById('display_center_id').style.display='';
	if(parent.document.getElementById('center_frame')) parent.document.getElementById('center_frame').src = '?m=content&c=content&a=public_categorys&type=add&menuid=<?php echo $_GET['menuid'];?>&pc_hash=<?php echo $_SESSION['pc_hash'];?>';
	window.top.$("#current_pos").data('clicknum',0);
}
$(document).ready(function(){
	//setInterval(closeParent,3000);
});
function closeParent() {
	if($('#closeParentTime').html() == '') {
		window.top.$(".left_menu").addClass("left_menu_on");
		window.top.$("#openClose").addClass("close");
		window.top.$("html").addClass("on");
		$('#closeParentTime').html('1');
		window.top.$("#openClose").data('clicknum',1);
	}
}
//-->
</SCRIPT>
<div class="pad-10">

<div id="searchid" style="display:inline;">
<form name="searchform" action="" method="get" >
<input type="hidden" value="content" name="m">
<input type="hidden" value="content" name="c">
<input type="hidden" value="init" name="a">
<input type="hidden" value="yes" name="mr">
<input type="hidden" value="<?php echo $catid;?>" name="catid">
<input type="hidden" value="<?php echo $fusername;?>" name="fusername">
<input type="hidden" value="1" name="search">
<input type="hidden" value="<?php echo $_SESSION[pc_hash];?>" name="pc_hash">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
				<?php echo L('addtime');?>:
				<?php echo form::date('start_time',$_GET['start_time'],0,0,'false');?>- &nbsp;<?php echo form::date('end_time',$_GET['end_time'],0,0,'false');?>

				<select name="searchtype">
					<option value='0' <?php if($_GET['searchtype']==0) echo 'selected';?>><?php echo L('title');?></option>
					<option value='1' <?php if($_GET['searchtype']==1) echo 'selected';?>><?php echo L('intro');?></option>
					<option value='2' <?php if($_GET['searchtype']==2) echo 'selected';?>><?php echo L('username');?></option>
					<option value='3' <?php if($_GET['searchtype']==3) echo 'selected';?>>ID</option>
				</select>

				<input name="keyword" type="text" value="<?php if(isset($keyword)) echo $keyword;?>" class="input-text" />
				<input type="submit" name="search" class="button" value="<?php echo L('search');?>" />
				<a id='reload_content_list' href='javascript:;'>刷新列表</a>
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
</div>
<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
			 <th width="20"><input type="checkbox" value="" id="check_box" onclick="selectall('ids[]');"></th>
            <th width="40">ID</th>
			<th width="670"><?php echo L('title');?></th>
            <th width="101">栏目</th>
            <th width="77"><?php echo L('hits');?></th>
            <th width="80">
            <?php if ($list=="desc"){?>
            <a href="?m=content&c=content&a=init&mr=yes&menuid=822&catid=<?php echo $catid;?>&pc_hash=<?php echo $_SESSION[pc_hash];?>&s_user=asc"><?php echo L('publish_user');?></a>
            <?php }else{?>
            <a href="?m=content&c=content&a=init&mr=yes&menuid=822&catid=<?php echo $catid;?>&pc_hash=<?php echo $_SESSION[pc_hash];?>&s_user=desc"><?php echo L('publish_user');?></a>
            <?php }?>
            </th>
            <th width="150">
            <?php if ($list1=="desc"){?>
            <a href="?m=content&c=content&a=init&mr=yes&menuid=822&catid=<?php echo $catid;?>&pc_hash=<?php echo $_SESSION[pc_hash];?>&s_time=asc"><?php echo L('updatetime');?></a>
            <?php }else{?>
            <a href="?m=content&c=content&a=init&mr=yes&menuid=822&catid=<?php echo $catid;?>&pc_hash=<?php echo $_SESSION[pc_hash];?>&s_time=desc"><?php echo L('updatetime');?></a>
            <?php }?>
            </th>
			<th width="138"><?php echo L('operations_manage');?></th>
            </tr>
        </thead>
<tbody>
    <?php
	if(is_array($datas)) {
		$sitelist = getcache('sitelist','commons');
		$release_siteurl = $sitelist[$category['siteid']]['url'];
		$path_len = -strlen(WEB_PATH);
		$release_siteurl = substr($release_siteurl,0,$path_len);
		$this->hits_db = pc_base::load_model('hits_model');
		
		foreach ($datas as $r) {
			$hits_r = $this->hits_db->get_one(array('hitsid'=>'c-'.$r['modeid'].'-'.$r['id']));
	?>
        <tr id="<?php echo $r['id'];?>">
		<td align="center"><input class="inputcheckbox " name="ids[]" value="<?php echo $r['id'];?>" type="checkbox"></td>
       
		<td align='center' ><?php echo $r['id'];?></td>
		<td>
		<?php
		if($status==99) {
			if($r['islink']) {
				echo '<a href="'.$r['url'].'" target="_blank">';
			} elseif(strpos($r['url'],'http://')!==false) {
				echo '<a href="'.$r['url'].'" target="_blank">';
			} else {
				echo '<a href="'.$release_siteurl.$r['url'].'" target="_blank">';
			}
		} else {
			echo '<a href="javascript:;" onclick=\'window.open("?m=content&c=content&a=public_preview&steps='.$steps.'&catid='.$r[catid].'&id='.$r['id'].'","manage")\'>';
		}?><span<?php echo title_style($r['style'])?>><?php echo $r['title'];?></span></a> <?php if($r['thumb']!='') {echo '<img src="'.IMG_PATH.'icon/small_img.gif" title="'.L('thumb').'">'; } if($r['posids']) {echo '<img src="'.IMG_PATH.'icon/small_elite.gif" title="'.L('elite').'">';} if($r['islink']) {echo ' <img src="'.IMG_PATH.'icon/link.png" title="'.L('islink_url').'">';}?></td>
		<td align="center"><?php echo $r[catname]?></td>
		<td align='center' title="<?php echo L('today_hits');?>: <?php echo $hits_r['dayviews'];?>&#10;<?php echo L('yestoday_hits');?>: <?php echo $hits_r['yestodayviews'];?>&#10;<?php echo L('week_hits');?>: <?php echo $hits_r['weekviews'];?>&#10;<?php echo L('month_hits');?>: <?php echo $hits_r['monthviews'];?>"><?php echo $hits_r['views'];?></td>
		<td align='center'>
		<?php
			echo $r['username'];
		?></td>
		<td align='center'><?php echo format::date($r['last_update_time'],1);?></td>
		<td align='center'><a class='tab_content_link tab_content_edit' href="?m=content&c=content&a=edit&catid=<?php echo $r['catid'];?>&id=<?php echo $r['id']?>&pc_hash=<?php echo $_SESSION['pc_hash'];?>" <?php 	if($_GET["iframep"]=="yes") { ?>target="_parent"<?php } ?> ><?php echo L('edit');?></a> 
		| <a href="javascript:view_comment('<?php echo id_encode('content_'.$r['catid'],$r['id'],$this->siteid);?>','<?php echo safe_replace($r['title']);?>')"><?php echo L('comment');?></a></td>
	</tr>
     <?php }
	}
	?>
</tbody>
     </table>
    <div class="btn"><label for="check_box"><?php echo L('selected_all');?>/<?php echo L('cancel');?></label>
		<input type="hidden" value="<?php echo $pc_hash;?>" name="pc_hash">
    	
		
		<input type="button" class="button" value="<?php echo L('createhtml');?>" onclick="myform.action='?m=content&c=create_html&a=batch_show_global&dosubmit=1&pc_hash=<?php echo $_SESSION['pc_hash'];?>';myform.submit();"/>
		
		<input type="button" class="button" value="<?php echo L('delete');?>" onclick="myform.action='?m=content&c=content&a=delete_all&pc_hash=<?php echo $_SESSION['pc_hash'];?>';return confirm_delete()"/>
		
		
		<?php echo runhook('admin_content_init')?>
	</div>
    <div id="pages"><?php echo $pages;?></div>
</div>
</form>
</div>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>cookie.js"></script>
<script type="text/javascript"> 
<!--
function push() {
	var str = 0;
	var id = tag = '';
	$("input[name='ids[]']").each(function() {
		if($(this).attr('checked')==true) {
			str = 1;
			id += tag+$(this).val();
			tag = '|';
		}
	});
	if(str==0) {
		alert('<?php echo L('you_do_not_check');?>');
		return false;
	}
	window.top.art.dialog({id:'push'}).close();
	window.top.art.dialog({title:'<?php echo L('push');?>��',id:'push',iframe:'?m=content&c=push&action=position_list&catid=<?php echo $catid?>&modelid=<?php echo $modelid?>&id='+id,width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'push'}).data.iframe;
	var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'push'}).close()});
}
function confirm_delete(){
	if(confirm('<?php echo L('confirm_delete', array('message' => L('selected')));?>')) $('#myform').submit();
}
function view_comment(id, name) {
	window.top.art.dialog({id:'view_comment'}).close();
	window.top.art.dialog({yesText:'<?php echo L('dialog_close');?>',title:'<?php echo L('view_comment');?>:'+name,id:'view_comment',iframe:'index.php?m=comment&c=comment_admin&a=lists&show_center_id=1&commentid='+id,width:'800',height:'500'}, function(){window.top.art.dialog({id:'edit'}).close()});
}
function reject_check(type) {
	if(type==1) {
		var str = 0;
		$("input[name='ids[]']").each(function() {
			if($(this).attr('checked')==true) {
				str = 1;
			}
		});
		if(str==0) {
			alert('<?php echo L('you_do_not_check');?>');
			return false;
		}
		document.getElementById('myform').action='?m=content&c=content&a=pass&catid=<?php echo $catid;?>&steps=<?php echo $steps;?>&reject=1';
		document.getElementById('myform').submit();
	} else {
		$('#reject_content').css('display','');
		return false;
	}	
}
setcookie('refersh_time', 0);
function refersh_window() {
	var refersh_time = getcookie('refersh_time');
	if(refersh_time==1) {
		window.location.reload();
	}
}
setInterval("refersh_window()", 3000);
//-->
</script>
</body>
</html>