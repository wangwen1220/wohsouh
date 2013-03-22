<?php

/**
 * zhangchengjun
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$op = empty($_G['gp_op']) ? 'index' : $_G['gp_op'];
$ops = array('index', 'create');
if (!in_array($op, $ops)) {
	$op = 'index';
}

if ($op == 'index') {
	cpheader();
	shownav('extended', 'menu_huoshowno');

	$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);
	$tpp = 20;
	$limit_start = ($page - 1) * $tpp;
	
	$id = isset($_G['gp_id']) ? $_G['gp_id'] : '';
	$status = isset($_G['gp_status']) ? $_G['gp_status'] : 'all';
	$level = isset($_G['gp_level']) ? $_G['gp_level'] : 'all';
	
	$addC = $addUrl = "";
	if (!empty($id)) {
		$addC = " AND id='$id'";
		$addUrl .= "&id=$id";
	}
	if ($status != 'all') {
		$addC .= " AND status=$status";
		$addUrl .= "&status=$status";
	}
	if ($level != 'all') {
		$addC .= " AND level=$level";
		$addUrl .= "&level=$level";
	}
	
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('ucenter_huoshowno')." WHERE 1$addC");
	$query = DB::query("SELECT * FROM ".DB::table('ucenter_huoshowno')." WHERE 1$addC ORDER BY id ASC LIMIT $limit_start,$tpp");
	while ($rs = DB::fetch($query)) {
		$rs['dateline_str'] = empty($rs['dateline']) ? 0 : date('Y-m-d H:i', $rs['dateline']);
		$rs['usedateline_str'] = empty($rs['usedateline']) ? 0 : date('Y-m-d H:i', $rs['usedateline']);			
		$list[] = $rs;			
	}
	
	$multi = multi($count, $tpp, $page, ADMINSCRIPT."?action=huoshowno$addUrl");
	include_once(template('admincp/admincp_huoshowno'));
	
//生成火秀号
} elseif ($op == 'create') {
	cpheader();
	shownav('extended', 'menu_huoshowno');
	
	if (isset($_POST['submit'])) {
		$neednum = $_POST['neednum'];
		if ($neednum) {
			$successNum = createHuoshoNo($neednum);
			$msg = $successNum ? "成功生成 $successNum 个火秀号" : "操作失败";
			cpmsg($msg, "admin.php?frames=yes&action=huoshowno&op=create", 'succeed');
		}
	} else {
		$total = DB::result_first("SELECT COUNT(*) FROM ".DB::table('ucenter_huoshowno')." WHERE 1");
		include_once(template('admincp/admincp_huoshowno_create'));
	}
	
}
?>