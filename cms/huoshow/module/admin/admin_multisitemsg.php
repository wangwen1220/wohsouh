<?
//引入需要的文件
//数据库操作类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
//火秀系统类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");

//后台所有php文件都需要加这句话，用于权限判断等初始化操作
$huoshowSys = & HuoshowSys::instance();
$huoshowSys->checkAdminLimit();
//模板初始化
$smarty1 = smarty_init();
$dblink = new DataBase("");

$tab = $_G["gp_tab"];
//关闭
if ($tab == "del") {
	$id = $_GET['id'];
	$sql = "DELETE FROM pre_mutilive_site_msg WHERE id =$id";
	$dblink->query($sql);
	header("Location:?action=huoshow&operation=multisitemsg");
}

$page = empty($_G["gp_page"])?1:$_G["gp_page"];
$page_record = 20;
$count = $dblink->getRow("SELECT COUNT(*) AS count FROM pre_mutilive_site_msg");
$msg_count = $count[0]["count"];
$msg_arr = $dblink->getRow("SELECT * FROM pre_mutilive_site_msg ORDER BY id limit ".($page-1)*$page_record.",$page_record");

$dblink->dbclose();
$page_split = new PagerSplit($msg_count,$page,$page_record);
$page_str = $page_split->GetPagerContent();

$smarty1->assign("page_str",$page_str);
$smarty1->assign("msg_arr",$msg_arr);
$smarty1->display("admin/admin_multisitemsg.html");
?>