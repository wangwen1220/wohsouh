<?
//数据库操作类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
//火秀系统类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/FormBuild.php");
//后台所有php文件都需要加这句话，用于权限判断等初始化操作
$huoshowSys = & HuoshowSys::instance();
//$huoshowSys->checkAdminLimit();

$match_id = $_G["gp_matchid"];
if(empty($match_id) || $match_id<0)
{
	die("没有提交赛事ID");
}
$jsonstr = $_G["gp_jsonstr"];
$action = $_G["gp_action"];

//模板初始化
$smarty1 = smarty_init();

$dblink = new DataBase("");

$sql = "select form_json from pre_match_form_json where match_id='$match_id'";
$db_arr = $dblink->getRow($sql);
if(empty($action)) //显示
{
	if(count($db_arr)>0)	
		$smarty1->assign("jsonstr",$db_arr[0]["form_json"]);
}
elseif ($action=="view")//预览
{
	$formbuild = new FormBuild();
	echo $formbuild->buildForm($json_str);
	die();
}
elseif ($action=="submit")
{
	if(empty($jsonstr))
		die("没有提交json数据");
	if(count($db_arr)==0) //新增数据
	{
		$dblink->query("insert into pre_match_form_json (match_id,form_json) values ('$match_id','$jsonstr')");
		$formbuild = new FormBuild();
		if(!$formbuild->createTable($jsonstr,"pre_match_autotable_$match_id"))
			die("建立表格时出错");
	}
	else //修改数据并改表结构 
	{
		$sql = "select * from pre_match_autotable_$match_id limit 0,1";
		//$db_arr = $dblink->getRow($sql);
		$db_arr = array();
		if(count($db_arr)>0)
			die("数据表中已经有数据，结构不可改！");
		else 
		{
			$formbuild = new FormBuild();
			//$formbuild->alterTable($jsonstr,"pre_match_autotable_$match_id");
			if(!$formbuild->alterTable($jsonstr,"pre_match_autotable_$match_id"))
				die("修改表格时出错");
		}
	}
	die("成功建立了当前赛事的自定义表单");
}
$dblink->dbclose();

$smarty1->assign("matchid",$match_id);
$smarty1->display("admin/admin_buildform.html");
?>