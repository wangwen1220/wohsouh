<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/configs/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");

$huoshowSys = HuoshowSys::instance();
$huoshowSys->checkAdminLimit();
$smarty1 = smarty_init();

$dateline1=!isset($_REQUEST['gp_dateline1']) ? date('Y-m-d 00:00:00',strtotime("-1 month")) : (empty($_G['gp_dateline1']) ? '' : $_G['gp_dateline1']);
$dateline2=!isset($_G['gp_dateline2']) ? date('Y-m-d 23:59:59') : (empty($_G['gp_dateline2']) ? '' : $_G['gp_dateline2']);
//$admin_info = UserApi::getAdminSessionInfo();

$page = empty($_G['gp_page'])?1:$_G['gp_page'];

//die("sss");
$action = $_REQUEST["submit_post"];
$checkstate = $_REQUEST["checkstate"];
$check_uid = $_REQUEST["check_uid"];
$particulars_search = empty($_REQUEST["particulars_search"])?"yes":$_REQUEST["particulars_search"];

$db = new DataBase("");

if($action == "yes")
{
	$act = "&dateline1=$dateline1&dateline2=$dateline2";

	if (!empty($dateline1)) {
		$dateline1_str = $dateline1;
		$dateline1 = strtotime($dateline1);

	}
	if (!empty($dateline2)) {
		$dateline2_str = $dateline2;
		$dateline2 = strtotime($dateline2);
	}
	$condition='';
	$condition1='';
	$condition3='';
	$summary='';
	if ($uid){
		$condition = $condition."AND b.uid = '$uid' ";
		$condition3 = $condition3."AND b.uid = '$uid' ";
		$summary .= "UID:".$uid;
		$act .= "&uid=".$uid;
	}
	if ($username){
		$condition = $condition."AND b.username = '$username' ";
		$condition3 = $condition3."AND b.username = '$username' ";
		$act .= "&username=".$username;
		$summary .= "用户人:".$username;
		$condition1=$condition1."AND c.username = '$username' ";

	}
	$_G['setting']['memberperpage'] = 20;
	var_dump($_G['setting']['memberperpage']);
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	
	if($particulars_search=="yes")
	{
		$sql = "SELECT COUNT(*) AS count FROM pre_ucenter_showcoin a,pre_common_member b WHERE 1 AND a.uid=b.uid $condition";
		$showcoin_rs_arr = $db->getRow($sql);
		$showcoin_rs_count = $showcoin_rs_arr[0]["count"];
		$sql = "SELECT a.showcoin,b.uid,b.username FROM pre_ucenter_showcoin a,pre_common_member b WHERE a.uid=b.uid  $condition
							order by a.showcoin desc	 LIMIT $start_limit, {$_G[setting][memberperpage]}";
		$showcoin_rs_arr = $db->getRow($sql);
		$smarty1->assign("showcoin_rs_arr",$showcoin_rs_arr);
	}
	else 
	{
		if($dateline1>=$dateline2)
			die("日期范围错误");
		if(empty($checkstate))
			$checkstate = "in";
		if($checkstate=="buy")//兑换历史
		{
			$showcoin_rs = $db->getRow("SELECT count(distinct a.uid) as count FROM pre_bank_withdraw a,pre_common_member b WHERE a.uid=b.uid and (a.status=2 or a.status=3) and a.updatetime >= '$dateline1' AND a.updatetime <= '$dateline2' $condition");
			$showcoin_rs_count = $showcoin_rs[0]["count"];
			$sql_search = "SELECT a.uid,b.username, SUM(a.rmb)  AS amount ,a.status as type FROM pre_bank_withdraw a,pre_common_member b WHERE a.uid=b.uid  AND (a.status=2 or a.status=3) and a.updatetime >= '$dateline1' AND a.updatetime <= '$dateline2' $condition GROUP BY a.uid order by amount desc LIMIT $start_limit, {$_G[setting][memberperpage]}";
		}
		else
		{
			$showcoin_rs = $db->getRow("SELECT count(distinct a.uid) as count FROM pre_ucenter_showcoin_log a,pre_common_member b WHERE a.uid=b.uid and a.`type`='$checkstate'  AND a.dateline >= '$dateline1' AND a.dateline <= '$dateline2' $condition");
			$showcoin_rs_count =  $showcoin_rs[0]["count"];
			$sql_search = "SELECT a.uid,SUM(a.amount) as amount,a.type,b.username FROM pre_ucenter_showcoin_log a,pre_common_member b  WHERE a.uid=b.uid AND a.`type`='$checkstate'  AND a.dateline >= '$dateline1' AND a.dateline <= '$dateline2' $condition GROUP BY a.uid order by amount desc LIMIT $start_limit, {$_G[setting][memberperpage]}";
		}
		$db_total_arr = $db->getRow($sql_search);
		$smarty1->assign("showcoin_rs_count",$showcoin_rs_count);
		$smarty1->assign("db_total_arr",$db_total_arr);
	}
	
	
}

$smarty1->assign("dateline1",$dateline1);
$smarty1->assign("dateline2",$dateline2);
$smarty1->assign("username",$_G['gp_username']);
$smarty1->assign("particulars_search",$particulars_search);
$smarty1->assign("checkstate",$checkstate);
$smarty1->assign("submit_post",$action);
$smarty1->assign("page",$page);
$smarty1->display("admin/admin_coinwatch.html");







function get_remark($remark, $status)
{
	if($status=="buy")
	{
		switch($remark)
		{
		case 2:
			return "已汇款";
			break;
		case 3:
			return "已结束";
			break;
		default:
			return "ERROR";
		}
	}
	else
		return $remark;
}

function get_type($type)
{
	switch($type)
	{
		case 'in':
			return "收入";
			break;
		case 'out':
			return "消费";
			break;
		case '2':
			return "已汇款";
			break;
		case '3':
			return "已结束";
			break;
		default:
			return "ERROR";
	}
	return NULL;
}
?>