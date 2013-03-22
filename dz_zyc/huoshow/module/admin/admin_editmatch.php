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
//$huoshowSys->checkAdminLimit();
//模板初始化
$smarty1 = smarty_init();

$dblink = new DataBase("");
$up = new HUpload();
$up1 = new HUpload();
//得到比赛类型
$matchtype = Match::GetMatchType();
$match_id = $_GET['match_id'];
$sql = "SELECT * FROM pre_match WHERE id=$match_id";
$seematch = $dblink->getRow($sql);
$type_id = Match::GetMatchTypeId($match_id);

//修改赛事
if (!empty($_POST)) {
	$Match_start_time=!isset($_REQUEST['gp_Match_start_time']) ? date('Y-m-d 00:00:00') : (empty($_G['gp_Match_start_time']) ? '' : $_G['gp_Match_start_time']);
	$Match_end_time=!isset($_G['gp_Match_end_time']) ? date('Y-m-d 23:59:59') : (empty($_G['gp_Match_end_time']) ? '' : $_G['gp_Match_end_time']);
	$Match_name_zh = $_G['gp_Match_name_zh'];
	$Match_name_en = $_G['gp_Match_name_en'];
	$Match_type = $_G['gp_Match_type'];
	$Match_summary = $_G['gp_Match_summary'];
	$awards_name = $_G['gp_awards_name'];
	$awards_value = $_G['gp_awards_value'];
	if (!$_FILES['Match_logo']['tmp_name']) {
		$image = $_G['gp_logo'];
	}else {
		$up->upload($_FILES['Match_logo'],"match_logo");
		$image = $up->new_url;
	}
	if (!$_FILES['Match_img']['tmp_name']) {
		$image1 = $_G['gp_img'];
	}else {
		$up1->upload($_FILES['Match_img'],"match_img");
		$image1 = $up1->new_url;
	}
	$sql = "SELECT match_name_zh,match_name_en FROM pre_match WHERE (match_name_zh='$Match_name_zh' OR match_name_en = '$Match_name_en') AND id != $match_id";
	$is_match_name = $dblink->getRow($sql);
	if(count($is_match_name)==0){
		$sql = "UPDATE pre_match SET match_name_zh='$Match_name_zh',match_name_en='$Match_name_en',match_type='$Match_type',match_start_time='$Match_start_time',match_end_time='$Match_end_time',match_summary='$Match_summary',match_logo='$image',match_img='$image1' WHERE id=$match_id";
		$dblink->query($sql);
		header("Location:?action=huoshow&operation=eventsadmin");
	}else {
		die('赛事中文名称或英文名称已存在,<a href="?action=huoshow&operation=editmatch&match_id='.$match_id.'"><strong>请重新修改</strong></a>！！！');
	}
}

$dblink->dbclose();
$smarty1->assign("Match_start_time",$Match_start_time);
$smarty1->assign("Match_end_time",$Match_end_time);
$smarty1->assign("seematch",$seematch[0]);
$smarty1->assign("matchtype",$matchtype);
$smarty1->assign("type_id",$type_id);
$smarty1->display("admin/admin_editmatch.html");
?>