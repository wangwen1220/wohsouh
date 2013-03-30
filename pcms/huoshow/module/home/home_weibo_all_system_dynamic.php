<?php

/**
 * 全部系统微薄动态
 *
 * @author Administrator
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
$smarty = smarty_init();
$dblink = new DataBase("");
$user = UserApi::getLoginUserSessionInfo();
$lastMsgId = empty($_GET['page_id']) ? '0':$_GET['page_id'];
$system_arr = Weibo::getSysAllMsgFront($lastMsgId,21);
for ($i=0;$i<count($system_arr);$i++){
	if ($system_arr[$i]['msg_type'] == 1){
		$system_arr[$i]['route_parent_msg_id'] = $system_arr[$i]['id'];
	}elseif ($system_arr[$i]['msg_type'] == 3){
		$system_arr[$i]['route_parent_msg_id'];
	}
	$system_arr[$i]['url'] = DX_URL.$system_arr[$i]['uid'];
	$system_arr[$i]['url_b'] = DX_URL;
}
if (empty($system_arr)) {
	$msg_count = 0;
}elseif (count($system_arr) > 0 && count($system_arr)<= 20){
	$msg_count = 1;
}else {
	$msg_count = 2;

}
if (is_array($system_arr)){
	$all_sys_data = array_slice($system_arr, 0, 20);
}else {
	$all_sys_data = array();
}
$msg_arr = array(
	'type' => $msg_count,
	'data' => $all_sys_data
);
echo json_encode($msg_arr);