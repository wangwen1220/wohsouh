<?
//引入需要的文件
//数据库操作类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
//火秀系统类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");
//后台所有php文件都需要加这句话，用于权限判断等初始化操作
$huoshowSys = & HuoshowSys::instance();
$huoshowSys->checkAdminLimit();
//模板初始化
$smarty1 = smarty_init();
$dblink = new DataBase("");
$tab = $_G["gp_tab"];
//关闭
if ($tab == "del") {
	//$id = $_GET['id'];
	$uid =$_GET['uid'];
	$roomid = $_GET['roomid'];
	//$sql = "DELETE FROM pre_mutilive_room_manager WHERE id =$id";
	$sql = "DELETE FROM pre_mutilive_room_manager WHERE roomid='$roomid' and uid='$uid'";
	$dblink->query($sql);
	MutilLiveRoomSocketApi::setOrCancelRoomManager($roomid, $uid, 0);
	header("Location:?action=huoshow&operation=multidetailed&roomid=$roomid");
}

$roomid = $_GET['roomid'];
//$sql = "SELECT * FROM pre_mutilive_room_manager WHERE roomid=$roomid";
$sql = "SELECT *,(SELECT SUM(pointticket_price) FROM pre_multilive_gift_log b WHERE b.uid=a.uid AND ACTION=2) AS price FROM pre_mutilive_room_manager a WHERE a.roomid=$roomid";
$manager_arr = $dblink->getRow($sql);

$dblink->dbclose();
$smarty1->assign("manager_arr",$manager_arr);
$smarty1->assign("roomid",$roomid);
$smarty1->display("admin/admin_multidetailed.html");
?>