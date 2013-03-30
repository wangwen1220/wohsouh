<?
//引入需要的文件
//数据库操作类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
//火秀系统类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
//函数类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Match.class.php");
//后台所有php文件都需要加这句话，用于权限判断等初始化操作
$huoshowSys = & HuoshowSys::instance();
$huoshowSys->checkAdminLimit();
//模板初始化
$smarty1 = smarty_init();
$dblink = new DataBase("");

$page = empty($_G["gp_page"])?1:$_G["gp_page"];
$page_record = 10;
$count = $dblink->getRow("SELECT count(*) as count FROM pre_match_regular_base a LEFT JOIN pre_match_plugin b ON a.plugin_id=b.id ORDER BY a.id");
$rules_count = $count[0]["count"];
$rules_arr = $dblink->getRow("SELECT a.*,b.plugin_name FROM pre_match_regular_base a LEFT JOIN pre_match_plugin b ON a.plugin_id=b.id ORDER BY a.id limit ".($page-1)*$page_record.",$page_record");
$page_split = new PagerSplit($rules_count,$page,$page_record);
$page_str = $page_split->GetPagerContent();


$dblink->dbclose();
$smarty1->assign("page_str",$page_str);
$smarty1->assign("rules_arr",$rules_arr);
$smarty1->display("admin/admin_rulesmanage.html");
?>