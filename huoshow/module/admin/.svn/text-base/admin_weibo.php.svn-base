<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
$huoshowSys = & HuoshowSys::instance();
$huoshowSys->checkAdminLimit();
//模板初始化
$smarty1 = smarty_init();
$dblink = new DataBase("");
if ($_G['gp_tab'] == "delweibo") {
	$uid == $_G['gp_uid'];
	$dblink->query("DELETE from pre_weibo_recommend where uid = '$uid'");
	header("Location:?action=huoshow&operation=weibo");
}
if ($_G['gp_tab'] == "userlist") 
{
	getUserList();
	return;
}
if ($_G['gp_tab'] == "realtimedymic")
{
	getRealtimeDymic();
	return;
}
//分页
$page = empty($_G["gp_page"])?1:$_G["gp_page"];
$page_record = 10;
$count = $dblink->getRow("SELECT count(*) as count FROM pre_weibo_recommend order by id");
$components_count = $count[0]["count"];
$weibo_recommend = $dblink->getRow("SELECT * FROM pre_weibo_recommend order by id limit ".($page-1)*$page_record.",$page_record");
$page_split = new PagerSplit($components_count,$page,$page_record);
$page_str = $page_split->GetPagerContent();
$dblink->dbclose();
$smarty1->assign("weibo_recommend",$weibo_recommend);
$smarty1->assign("page_str",$page_str);
$smarty1->display("admin/admin_weibo.html");


function getUserList()
{
	global $smarty1,$_G;
	$page = empty($_G["gp_page"])?1:$_G["gp_page"];
	$post_type = $_G["gp_filter_type"];
	$uid=0;$username="";
	if($post_type=="uid")
		$uid = empty($_G["gp_filtervalue"])?0:$_G["gp_filtervalue"];
	elseif ($post_type=="username")
		$username = empty($_G["gp_filtervalue"])?"":$_G["gp_filtervalue"];
	$page_record = 50;
	$arr = Weibo::getAllUserStatInfo($page,$page_record,$uid,$username);
	dieErr($arr);
	
	$page_split = new PagerSplit($arr["num"],$page,$page_record);
	$page_str = $page_split->GetPagerContent();
	$smarty1->assign("arr",$arr["arr"]);
	$smarty1->assign("page_str",$page_str);
	$smarty1->display("admin/admin_weibo_userlist.html");
}

function getRealtimeDymic()
{
	global $smarty1,$_G;
	$page = empty($_G["gp_page"])?1:$_G["gp_page"];
	$uid = empty($_G["gp_uid"])?0:$_G["gp_uid"];
	$op = $_G["gp_op"];
	if($op=="deldymic")
	{
		$id = $_G["gp_id"];
		if(!is_numeric($id))
			die("id 异常");
		$current_uid_arr = UserApi::getLoginUserSessionInfo();
		Weibo::delMsg($current_uid_arr["uid"], $id);
		g("删除成功", 
		  "/admin.php?action=huoshow&operation=weibo&tab=realtimedymic");
	}
	
	$page_record = 20;
	$arr = Weibo::getRealtimeDymic($page,$page_record,$uid);
	dieErr($arr);
	//var_dump($arr);
	$page_split = new PagerSplit($arr["num"],$page,$page_record);
	$page_str = $page_split->GetPagerContent();
	$smarty1->assign("arr",$arr["arr"]);
	$smarty1->assign("page_str",$page_str);
	$smarty1->display("admin/admin_weibo_realtimedymic.html");
}
?>