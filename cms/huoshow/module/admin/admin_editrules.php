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
$tab = $_G["gp_tab"];

if ($operation == 'editrules') {
	$id = $_GET['id'];
	//得到组件
	$plugintype = Match::GetPlugin();
	
	//删除
	if($tab == "delrules") {
		$sql = "DELETE FROM pre_match_regular_base WHERE id = $id ";
		$dblink->query($sql);
		header("Location:?action=huoshow&operation=rulesmanage");
	}
	
	//得到规则列表
	$sql = "SELECT * FROM pre_match_regular_base WHERE id = $id" ;
	$rules = $dblink->getRow($sql);
	//根据组件ID得到组件名称
	$plugin_name = Match::GetPluginName($rules[0]['plugin_id']);
	
	if (!empty($_POST)) {
		$plugin_id = $_G['gp_plugin_id'];
		$regular_descript = $_G['gp_regular_descript'];
		$regular_short_name = $_G['gp_regular_short_name'];
		$regular_sql = $_G['gp_regular_sql'];
		$sql = "UPDATE pre_match_regular_base SET plugin_id='$plugin_id',regular_descript='$regular_descript',regular_short_name='$regular_short_name',regular_sql='$regular_sql' WHERE id = $id " ;
		$dblink->query($sql);
		header("Location:?action=huoshow&operation=rulesmanage");
	}
}


$dblink->dbclose();
$smarty1->assign("plugintype",$plugintype);
$smarty1->assign("plugin_name",$plugin_name);
$smarty1->assign("rules",$rules[0]);
$smarty1->display("admin/admin_editrules.html");
?>