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

if ($operation == 'siteinfo') {	
	//删除
	if($tab == "ishide") {
		$id = $_GET['id'];
		$sql = "UPDATE pre_match_event SET ishide=2 WHERE id= $id";
		$dblink->query($sql);
		header("Location:?action=huoshow&operation=siteinfo");
	}
	
	$page = empty($_G["gp_page"])?1:$_G["gp_page"];
	$page_record = 10;
	//SELECT a.*,b.match_name_zh FROM pre_match_event a LEFT JOIN pre_match b ON a.src_uid = b.id ORDER BY a.id
	$count = $dblink->getRow("SELECT count(*) as count FROM pre_match_event a LEFT JOIN pre_match b ON a.src_uid = b.id WHERE a.ishide=1 ORDER BY a.id");
	$site_count = $count[0]["count"];
	$site_arr = $dblink->getRow("SELECT a.*,b.match_name_zh FROM pre_match_event a LEFT JOIN pre_match b ON a.src_uid = b.id WHERE a.ishide=1 ORDER BY a.id limit ".($page-1)*$page_record.",$page_record");
}


//关闭数据库链接
$dblink->dbclose();
//获得分页字符串
//注意，分页类除了适用动态链接，也适用伪静态链接和js链接，具体看类实现
$page_split = new PagerSplit($site_count,$page,$page_record);
$page_str = $page_split->GetPagerContent();

$smarty1->assign("site_arr",$site_arr);
$smarty1->assign("page_str",$page_str);
$smarty1->assign("site_arr",$site_arr);

$smarty1->display("admin/admin_siteinfo.html");
?>