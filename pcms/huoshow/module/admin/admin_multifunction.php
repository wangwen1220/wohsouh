<?
//引入需要的文件
//数据库操作类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
//火秀系统类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");

//后台所有php文件都需要加这句话，用于权限判断等初始化操作
$huoshowSys = & HuoshowSys::instance();
$huoshowSys->checkAdminLimit();
//模板初始化
$smarty1 = smarty_init();
$dblink = new DataBase("");
$tab = $_G["gp_tab"];

//关闭
if ($tab == "del") {
	$rid = $_GET['roomid'];
	//op等于close为关闭房间，否则为激活房间。
	if ($_G["gp_op"] == "close"){
		$sql = "UPDATE pre_multilive_room SET system_close=1 WHERE roomid= $rid";
		$dblink->query($sql);
		//关闭房间发送信息给消息服务器
		$data = array(
			'rid'=> "$rid",
		);
		MutilLiveRoomSocketApi::sendCloseRoom($data);
	}else {
		$sql = "UPDATE pre_multilive_room SET system_close=0 WHERE roomid= $rid";
		$dblink->query($sql);
	}
	header("Location:?action=huoshow&operation=multifunction");
}
$RoomTypeName = MutiliveRoom::getRoomTypeName();

$dateline = !isset($_G['gp_dateline']) ?  '' : strtotime($_G['gp_dateline'].' 00:00:01');
$dateline2 = !isset($_G['gp_dateline2']) ? '' : strtotime($_G['gp_dateline2'].' 23:59:59');
$room_name = !isset($_G['gp_room_name']) ? '' : $_G['gp_room_name'];
$room_type = !isset($_G['gp_room_type']) ? '' : $_G['gp_room_type'];
$room_class_id = !isset($_G['gp_room_class_id']) ? '' : $_G['gp_room_class_id'];
$condition='';
$con_date='';

if (!empty($dateline)){
	$con_date.= "AND c.dateline >= $dateline AND c.dateline <= $dateline2";
}
if(!empty($room_name)){
	$condition.= " AND b.username like '%$room_name%'";
}
if(!empty($room_type)){
	$condition.= " AND b.room_type = '$room_type'";	
}
if(!empty($room_class_id)){
	$condition.= " AND b.room_class_id = '$room_class_id'";	
}
//时间上

$page = empty($_G["gp_page"])?1:$_G["gp_page"];
$page_record = 20;
$count = $dblink->getRow("SELECT COUNT(*) AS count,(SELECT COUNT(*) FROM pre_mutilive_room_manager a WHERE a.roomid=b.roomid) AS manage ,(SELECT SUM(c.giftprice * c.num) FROM pre_multilive_gift_log c WHERE c.roomid=b.roomid $con_date) AS huo FROM pre_multilive_room b WHERE 1 $condition");
$multi_count = $count[0]["count"];
$multi_arr = $dblink->getRow("SELECT *,(SELECT COUNT(*) FROM pre_mutilive_room_manager a WHERE a.roomid=b.roomid) AS manage,(SELECT SUM(c.giftprice * c.num) FROM pre_multilive_gift_log c WHERE c.roomid=b.roomid $con_date) AS huo FROM pre_multilive_room b WHERE 1 $condition ORDER BY roomid limit ".($page-1)*$page_record.",$page_record");
for($i=0;$i<count($multi_arr);$i++)
{
	$multi_arr[$i]["dateline"] = getLocalTimeStr($multi_arr[$i]["dateline"]);
	$multi_arr[$i]["expire_time"] = getLocalTimeStr($multi_arr[$i]["expire_time"]);
}	

$dblink->dbclose();
$page_split = new PagerSplit($multi_count,$page,$page_record,"/admin.php?action=huoshow&operation=multifunction&room_name=$room_name&room_type=$room_type&room_class_id=$room_class_id&page={#page}");
$page_str = $page_split->GetPagerContent();
$smarty1->assign("RoomTypeName",$RoomTypeName);
$smarty1->assign("room_name",$room_name);
$smarty1->assign("room_type",$room_type);
$smarty1->assign("room_class_id",$room_class_id);
$smarty1->assign("multi_count",$multi_count);
$smarty1->assign("page_str",$page_str);
$smarty1->assign("multi_arr",$multi_arr);
$smarty1->assign("dateline",getLocalTimeStr($dateline));
$smarty1->assign("dateline2",getLocalTimeStr($dateline2));
$smarty1->display("admin/admin_multifunction.html");
?>