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

if ($operation == 'editawards') {
	$id = $_GET['id'];
	$matchid = $_GET['matchid'];
	
	$sql = "SELECT * FROM pre_match_awards WHERE id=$id";
	$awards = $dblink->getRow($sql);
	
	//删除
	if($tab == "delawards") {
		$sql = "DELETE FROM pre_match_awards WHERE id = $id ";
		$dblink->query($sql);
		header("Location:?action=huoshow&operation=awards&matchid=$matchid");
	}
	
	if (!empty($_POST)){
		$awards_name = $_G['gp_awards_name'];
		$awards_value = $_G['gp_awards_value'];
		$sql = "UPDATE pre_match_awards SET awards_name='$awards_name',awards_value='$awards_value' WHERE id= $id";
		$dblink->query($sql);
		header("Location:?action=huoshow&operation=awards&matchid=$matchid");
	}
	
}
$dblink->dbclose();
$smarty1->assign("awards",$awards[0]);
$smarty1->display("admin/admin_editawards.html");
?>