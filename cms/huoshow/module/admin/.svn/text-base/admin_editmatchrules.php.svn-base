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

if ($operation == 'editmatchrules') {
	$id = $_GET['id'];
	$matchid = $_GET['matchid'];
	$rules_name = Match::GetRules();
	//得到赛事规则列表
	$sql = "SELECT * FROM pre_match_regular_connection WHERE id=$id";
	$rules = $dblink->getRow($sql);
	//根据规则ID得到规则名称
	$rules_name_id = Match::GetRulesName($rules[0]['regular_id']);
	//删除
	if($tab == "delmatchrules") {
		$sql = "DELETE FROM pre_match_regular_connection WHERE id = $id ";
		$dblink->query($sql);
		header("Location:?action=huoshow&operation=matchrules&matchid=$matchid");
	}
	
	if (!empty($_POST)){
		$regular_id = $_G['gp_regular_id'];
		$precent = $_G['gp_precent'];
		$sql = "SELECT regular_id FROM pre_match_regular_connection WHERE regular_id='$regular_id' AND id != $id";
		$is_regular = $dblink->getRow($sql);
		if ($is_regular[0]['regular_id'] != $regular_id ){
			$sql = "UPDATE pre_match_regular_connection SET regular_id='$regular_id',precent='$precent' WHERE id= $id";
			$dblink->query($sql);
			header("Location:?action=huoshow&operation=matchrules&matchid=$matchid");
		}else {
			die('规则已存在,<a href="?action=huoshow&operation=editmatchrules&id='.$id.'&matchid='.$matchid.'"><strong>请返回重新选择规则</strong></a>！！！');
		}
	}
	
}

$dblink->dbclose();
$smarty1->assign("rules",$rules[0]);
$smarty1->assign("rules_name_id",$rules_name_id);
$smarty1->assign("rules_name",$rules_name);
$smarty1->display("admin/admin_editmatchrules.html");
?>