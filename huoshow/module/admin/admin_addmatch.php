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

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Upload.class.php");
//后台所有php文件都需要加这句话，用于权限判断等初始化操作
$huoshowSys = & HuoshowSys::instance();
$huoshowSys->checkAdminLimit();
//模板初始化
$smarty1 = smarty_init();
$dblink = new DataBase("");
$up = new HUpload();
$up1 = new HUpload();

if(empty($operation)){
	$operation = 'addmatch';
}
//得到比赛类型
$matchtype = Match::GetMatchType();
$tab = $_G["gp_tab"];
if ($operation == 'addmatch') {
	//验证名称是否存在
	if ($tab == "ajax_checking_name") {
		$name = $_G['gp_name'];
		$check_name = $dblink->getRow("SELECT * FROM pre_match WHERE match_name_zh = '$name'");
		if(count($check_name)!=0){
			echo '名称已存在！！！';
		}else {
			echo '';
		}
		exit();
	}
	
	//添加比赛类型
	if($tab == "ajax_add_match_type") {
		$type = $_G['gp_match_type'];
		$sql = "INSERT INTO pre_match_type (`type_name`) VALUES ('$type')";
		$dblink->query($sql);
		$dblink->dbclose();
		die();
	}
	//新增赛事
	if (!empty($_POST)) {
		$Match_start_time=!isset($_REQUEST['gp_Match_start_time']) ? date('Y-m-d 00:00:00') : (empty($_G['gp_Match_start_time']) ? '' : $_G['gp_Match_start_time']);
		$Match_end_time=!isset($_G['gp_Match_end_time']) ? date('Y-m-d 23:59:59') : (empty($_G['gp_Match_end_time']) ? '' : $_G['gp_Match_end_time']);
		$Match_name_zh = $_G['gp_Match_name_zh'];
		$Match_name_en = $_G['gp_Match_name_en'];
		$Match_type = $_G['gp_Match_type'];
		$Match_summary = $_G['gp_Match_summary'];
		$awards_name = $_G['gp_awards_name'];
		$awards_value = $_G['gp_awards_value'];	
		$sql = "SELECT match_name_zh,match_name_en FROM pre_match WHERE match_name_zh='$Match_name_zh' OR match_name_en = '$Match_name_en'";
		$is_match_name = $dblink->getRow($sql);
		//if ($is_match_name[0]['match_name_zh'] != $Match_name_zh and $is_match_name[0]['match_name_en'] != $Match_name_en){
		if(count($is_match_name)==0){
			$up->upload($_FILES['Match_logo'],"match_logo");
			$up1->upload($_FILES['Match_img'],"match_img");
			$match_logo = $up->new_url;
			$match_img = $up1->new_url;	
			$sql = "INSERT INTO pre_match (`match_name_zh`,`match_name_en`,`match_type`,`match_start_time`,`match_end_time`,`match_summary`,`match_logo`,`match_img`) 	VALUES ('$Match_name_zh','$Match_name_en','$Match_type','$Match_start_time','$Match_end_time','$Match_summary','$match_logo','$match_img')";
			$dblink->query($sql);
			header("Location:?action=huoshow&operation=eventsadmin");
		}else {
			die('赛事中文名称或英文名称已存在,<a href="?action=huoshow&operation=addmatch"><strong>请重新添加</strong></a>！！！');
		}
	}
	
	$dblink->dbclose();
	$smarty1->assign("Match_start_time",$Match_start_time);
	$smarty1->assign("Match_end_time",$Match_end_time);
	$smarty1->assign("matchtype",$matchtype);
	$smarty1->display("admin/admin_addmatch.html");
	

}

?>