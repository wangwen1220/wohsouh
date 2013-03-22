<?php

/**
 * 全部微薄动态
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
if (!empty($roomid)){
	$room_uid_arr = UserApi::getRenterUid($roomid);
	$room_uid = $room_uid_arr[0]['uid'];
}else {
	$room_uid = $user['uid'];
}

$lastMsgId = empty($_GET['page_id']) ? '0':$_GET['page_id'];
$user_all_msg = Weibo::getUserAllMsg($room_uid,1,21,$lastMsgId);
for ($i=0;$i<count($user_all_msg);$i++){
	if ($user_all_msg[$i]['msg_type'] == 1){
		$user_all_msg[$i]['route_parent_msg_id'] = $user_all_msg[$i]['id'];
	}elseif ($user_all_msg[$i]['msg_type'] == 3){
		$user_all_msg[$i]['route_parent_msg_id'];
	}
	$user_all_msg[$i]['url'] = DX_URL.$user_all_msg[$i]['uid'];
	$user_all_msg[$i]['url_b'] = DX_URL;
}
if (empty($user_all_msg)) {
	$msg_count = 0;
}elseif (count($user_all_msg) > 0 && count($user_all_msg)<= 20){
	$msg_count = 1;
}else {
	$msg_count = 2;
	
}
if (is_array($user_all_msg)){
	$all_msg_data = array_slice($user_all_msg, 0, 20);
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