<?php

/**
 * 个人微薄动态
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
if($user===false){
	die("没有权限，请登陆");
}else {
	$roomid = $_GET['roomid'];
	//如果roomid为空，则传Session_Uid
	if (!empty($roomid)){
		$room_uid_arr = UserApi::getRenterUid($roomid);
		$room_uid = $room_uid_arr[0]['uid'];
	}else {
		$room_uid = $user['uid'];
	}
	$user_msg = Weibo::getUserSelfMsg($room_uid,1,1);
	for ($i=0;$i<count($user_msg);$i++){
		if ($user_msg[$i]['msg_type'] == 1){
			$user_msg[$i]['route_parent_msg_id'] = $user_msg[$i]['id'];
		}elseif ($user_msg[$i]['msg_type'] == 3){
			$user_msg[$i]['route_parent_msg_id'];
		}
		$user_msg[$i]['url'] = DX_URL.$user_msg[$i]['uid'];
		$user_msg[$i]['url_b'] = DX_URL;
	}
}
echo json_encode($user_msg[0]); 
// $smarty->assign("user",$user);
// $smarty->assign("user_msg",$user_msg);
// $smarty->display("weibo/weibo_return_user_dynamic.html");
?>