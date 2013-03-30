<?php

/**
 * 分组微薄动态
 *
 * @author Administrator
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
header("Content-type: application/json; charset=utf-8");
$smarty = smarty_init();
$dblink = new DataBase("");
$user = UserApi::getLoginUserSessionInfo();
$roomid = $_GET['roomid'];
//如果roomid为空，则传Session_Uid
/*if (!empty($roomid)){
	$room_uid_arr = UserApi::getRenterUid($roomid);
	$room_uid = $room_uid_arr[0]['uid'];
}else {
	$room_uid = $user['uid'];
}*/
$room_uid = $user['uid'];
$group_id = $_GET['id'];//分组id
			$current_page=1;
			$record_per_page=2000;
			$lastMsgId = empty($_GET['page_id']) ? '0':$_GET['page_id'];
$getgroupallmsg = weibo::getUserAllMsg($room_uid,$current_page,$record_per_page,$lastMsgId,$group_id);//获取分组下的成员微博动态
for ($i=0;$i<count($getgroupallmsg);$i++){
	if ($getgroupallmsg[$i]['msg_type'] == 1){
		$getgroupallmsg[$i]['route_parent_msg_id'] = $getgroupallmsg[$i]['id'];
	}elseif ($getgroupallmsg[$i]['msg_type'] == 3){
		$getgroupallmsg[$i]['route_parent_msg_id'];
	}
	$getgroupallmsg[$i]['url'] = DX_URL.$getgroupallmsg[$i]['uid'];
}
if (empty($getgroupallmsg)) {
	$msg_count = 0;
}elseif (count($getgroupallmsg) > 0 && count($getgroupallmsg)<= 20){
	$msg_count = 1;
}else {
	$msg_count = 2;
	
}
if (is_array($getgroupallmsg)){
	$all_msg_data = array_slice($getgroupallmsg, 0, 20);
}else {
	$all_msg_data = array();
}
$msg_arr = array(
		'type' => $msg_count,
		'data' => $all_msg_data
		);
echo json_encode($msg_arr);

// $smarty->assign("user",$user);
// $smarty->assign("user_all_msg",$user_all_msg);
// $smarty->display("weibo/weibo_user_all_dynamic.html");
?>