<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_duixian.php 16352 2011-01-07 11:00:19Z zhouyc $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if(empty($operation)){
	$operation = 'index';
}

if ($operation=='index'){
	if ($_GET['act']=='del') {
		$id = $_GET['id'];
		$sql = "DELETE FROM ".DB::table('keyword')." WHERE id = $id ";
		//echo $sql;
		$query = DB::query($sql);
	}
	
	cpheader();
	shownav('extended', '关键字管理');
	showsubmenu('关键字管理', array());
	showformheader('keyword');
	showtableheader();
	echo '<a href="admin.php?action=keyword&operation=add"><strong>添加</strong></a>';
	$_G['setting']['memberperpage'] = 10;
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	$key_rs = array();
	$sql = "SELECT COUNT(*) AS count FROM ".DB::table('keyword');
	$key_rs_count=DB::result_first($sql);
	if($key_rs_count > 0) {
		showsubtitle(array('ID','关键字','管理'));
		$multi = multi($key_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=keyword&submit=yes".$act);
		$sql = "SELECT * FROM ".DB::table('keyword')." order by id desc LIMIT $start_limit, {$_G[setting][memberperpage]}";
		//echo $sql;
		$query = DB::query($sql);
		while ($key_rs = DB::fetch($query)) {
			showtablerow('',array('',''),array(
			$key_rs['id'],
			$key_rs['keyword'],
			'<a href="admin.php?action=keyword&operation=edit&id='.$key_rs['id'].'">修改</a> '.
			'<a id="del" onclick="delError('."'admin.php?action=keyword&act=del&id=".$key_rs['id']."'".');"  href="javascript:;">删除</a>'
			));
		}
		showsubmit('', '', '', '', $multi);
		showtablefooter();
	}
}

if ($operation=='add') {
	cpheader();
	shownav('extended', '关键字管理');
	showsubmenu('关键字管理', array());
	showtableheader();
	
	if ($_GET['act']=='post') {
		$keyword = $_G['gp_keyword'];
		$keyData = array(
			'keyword' => $keyword
		);
		DB::insert('keyword',$keyData);
		header("Location: admin.php?action=keyword");
	}
	
	$fh = '<a href="admin.php?action=keyword" style="color:blue">返回关键字列表</a>';
	showformheader("keyword&operation=$operation&id=$id&act=post");
	showtableheader();
	echo '关键字：&nbsp;<input type="text" name="keyword"  /><br/>';
	showsubmit('submit', '提交', '', $fh);
	showformfooter();
}

if ($operation=='edit'){
	cpheader();
	shownav('extended', '关键字管理');
	showsubmenu('关键字管理', array());
	showtableheader();
	
	$id = $_GET['id'];
	if ($_GET['act']=='post') {
		//echo $_G['gp_bankcode'];
		$keyword = $_G['gp_keyword'];
		$sql = "UPDATE ".DB::table('keyword')." SET keyword='$keyword' WHERE id=$id ";
		//echo $sql;
		DB::query($sql);
	}
	
	$sql = "SELECT * FROM ".DB::table('keyword')." WHERE id=$id";
	//echo $sql;
	$key =DB::fetch_first($sql);
	$fh = '<a href="admin.php?action=keyword" style="color:blue">返回关键字列表</a>';
	showformheader("keyword&operation=$operation&id=$id&act=post");
	showtableheader();
	echo '关键字：&nbsp;<input type="text" name="keyword" value="'.$key['keyword'].'" /><br/>';
	showsubmit('submit', '提交', '', $fh);
	showformfooter();
}
?>
<script type="text/javascript">
function delError(href)
{
	if (!confirm("确定删除？注意：此操作不可恢复，请谨慎操作！")) {
		return false;
	}else{
		window.location.href= href;
	}
}
</script>










