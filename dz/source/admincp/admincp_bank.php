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
		$sql = "DELETE FROM ".DB::table('bank')." WHERE id = $id ";
		//echo $sql;
		$query = DB::query($sql);
	}
	
	cpheader();
	shownav('extended', '银行管理');
	showsubmenu('银行管理', array());
	showformheader('bank');
	showtableheader();
	echo '<a href="admin.php?action=bank&operation=add"><strong>添加</strong></a>';
	$_G['setting']['memberperpage'] = 10;
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	$bank_rs = array();
	$sql = "SELECT COUNT(*) AS count FROM ".DB::table('bank');
	$bank_rs_count=DB::result_first($sql);
	if($bank_rs_count > 0) {
		showsubtitle(array('显示顺序','银行代码','银行名称','管理'));
		$multi = multi($bank_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=bank&submit=yes".$act);
		$sql = "SELECT * FROM ".DB::table('bank')." ORDER BY orders LIMIT $start_limit, {$_G[setting][memberperpage]}";
		//echo $sql;
		$query = DB::query($sql);
		while ($bank_rs = DB::fetch($query)) {
			showtablerow('',array('',''),array(
			$bank_rs['orders'],
			$bank_rs['bankcode'],
			$bank_rs['name'],
			'<a href="admin.php?action=bank&operation=edit&id='.$bank_rs['id'].'">修改</a> '.
			'<a id="del" onclick="delError('."'admin.php?action=bank&act=del&id=".$bank_rs['id']."'".');"  href="javascript:;">删除</a>'
			));
		}
		showsubmit('', '', '', '', $multi);
		showtablefooter();
	}
}

if ($operation=='add') {
	cpheader();
	shownav('extended', '银行管理');
	showsubmenu('添加银行信息', array());
	showtableheader();
	
	if ($_GET['act']=='post') {
		$orders = $_G['gp_orders'];
		$bankcode = $_G['gp_bankcode'];
		$name = $_G['gp_name'];
		$bankData = array(
			'orders' => $orders , 'bankcode' => $bankcode , 'name' => $name
		);
		DB::insert('bank',$bankData);
		header("Location: admin.php?action=bank");
	}
	
	$fh = '<a href="admin.php?action=bank" style="color:blue">返回银行列表</a>';
	showformheader("bank&operation=$operation&id=$id&act=post");
	showtableheader();
	echo '显示顺序：&nbsp;<input type="text" name="orders" /><br/>';
	echo '<br>';
	echo '银行代号：&nbsp;<input type="text" name="bankcode" /><br/>';
	echo '<br>';
	echo '银行名称：&nbsp;<input type="text" name="name"  /><br/>';
	showsubmit('submit', '提交', '', $fh);
	showformfooter();
}

if ($operation=='edit'){
	cpheader();
	shownav('extended', '银行管理');
	showsubmenu('修改银行帐号信息', array());
	showtableheader();
	
	$id = $_GET['id'];
	if ($_GET['act']=='post') {
		//echo $_G['gp_bankcode'];
		$orders = $_G['gp_orders'];
		$bankcode = $_G['gp_bankcode'];
		$name = $_G['gp_name'];
		$sql = "UPDATE ".DB::table('bank')." SET orders='$orders',bankcode='$bankcode',name='$name' WHERE id=$id ";
		//echo $sql;
		DB::query($sql);
	}
	
	$sql = "SELECT * FROM ".DB::table('bank')." WHERE id=$id";
	//echo $sql;
	$bank =DB::fetch_first($sql);
	$fh = '<a href="admin.php?action=bank" style="color:blue">返回银行列表</a>';
	showformheader("bank&operation=$operation&id=$id&act=post");
	showtableheader();
	echo '显示顺序：&nbsp;<input type="text" name="orders" value="'.$bank['orders'].'" /><br/>';
	echo '<br>';
	echo '银行代号：&nbsp;<input type="text" name="bankcode" value="'.$bank['bankcode'].'" /><br/>';
	echo '<br>';
	echo '银行名称：&nbsp;<input type="text" name="name" value="'.$bank['name'].'" /><br/>';
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










