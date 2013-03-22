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

if (!empty($_POST)) {
	$match_id = $_G['gp_match_id'];
	$awards_name = $_G['gp_awards_name'];
	$awards_value = $_G['gp_awards_value'];
	$sql = "INSERT INTO pre_match_awards (`match_id`,`awards_name`,`awards_value`) VALUES ($match_id,'$awards_name','$awards_value')";
//	echo $sql;
	$dblink->query($sql);
	header("Location:?action=huoshow&operation=awards&matchid=$match_id");
}

$dblink->dbclose();
$smarty1->assign("plugintype",$plugintype);
$smarty1->display("admin/admin_addawards.html");
?>