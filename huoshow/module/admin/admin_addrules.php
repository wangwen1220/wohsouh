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
$plugintype = Match::GetPlugin();
if (!empty($_POST)) {
	$plugin_id = $_G['gp_plugin_id'];
	$regular_descript = $_G['gp_regular_descript'];
	$regular_short_name = $_G['gp_regular_short_name'];
	$regular_sql = $_G['gp_regular_sql'];
	$sql = "INSERT INTO pre_match_regular_base (`plugin_id`,`regular_descript`,`regular_short_name`,`regular_sql`) VALUES ($plugin_id,'$regular_descript','$regular_short_name','$regular_sql')";
	$dblink->query($sql);
	header("Location:?action=huoshow&operation=rulesmanage");
}

$dblink->dbclose();
$smarty1->assign("plugintype",$plugintype);
$smarty1->display("admin/admin_addrules.html");
?>