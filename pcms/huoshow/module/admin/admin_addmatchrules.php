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
$rules_name = Match::GetRules();

if (!empty($_POST)){
	$match_id = $_GET['match_id'];
	$regular_id = $_G['gp_regular_id'];
	$precent = $_G['gp_precent'];
	$sql = "SELECT regular_id FROM pre_match_regular_connection WHERE regular_id='$regular_id'";
	$is_regular = $dblink->getRow($sql);
	if ($is_regular[0]['regular_id'] != $regular_id ){
		$sql = "INSERT INTO pre_match_regular_connection (`match_id`,`regular_id`,`precent`) VALUES ('$match_id','$regular_id','$precent')";
		$dblink->query($sql);
		header("Location:?action=huoshow&operation=matchrules&matchid=$match_id");
	}else {
		die('规则已存在,<a href="?action=huoshow&operation=addmatchrules&match_id='.$match_id.'"><strong>请返回重新添加规则</strong></a>！！！');
	}
}

$dblink->dbclose();
$smarty1->assign("rules_name",$rules_name);
$smarty1->display("admin/admin_addmatchrules.html");
?>