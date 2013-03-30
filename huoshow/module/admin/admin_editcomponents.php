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

if ($operation == 'editcomponents') {	
	$id = $_GET['id'];
	$sql = "SELECT * FROM pre_match_plugin WHERE id = $id" ;
	$components = $dblink->getRow($sql);
	
	//删除
	if($tab == "delcomponents") {
		$sql = "DELETE FROM pre_match_plugin WHERE id = $id ";
		$dblink->query($sql);
		header("Location:?action=huoshow&operation=components");
	}
	
	if (!empty($_POST)) {
		$plugin_name = $_G['gp_plugin_name'];
		$plugin_link = $_G['gp_plugin_link'];
		$sql = "SELECT plugin_name FROM pre_match_plugin WHERE plugin_name='$plugin_name' AND id != $id";
		$is_plugin_name = $dblink->getRow($sql);
		if ($is_plugin_name[0]['plugin_name'] != $plugin_name ){
			$sql = "UPDATE pre_match_plugin SET plugin_name='$plugin_name',plugin_link='$plugin_link' WHERE id= $id";
			$dblink->query($sql);
			header("Location:?action=huoshow&operation=components");
		}else {
			die('名称已存在,<a href="?action=huoshow&operation=editcomponents&id='.$id.'"><strong>请重新修改</strong></a>！！！');
		}
	}
	
}

$dblink->dbclose();
$smarty1->assign("components",$components[0]);
$smarty1->display("admin/admin_editcomponents.html");
?>