<?php

/**
 * 其它应用操作在此PHP做处理
 *
 * @author Administrator
 * @package defaultPackage
 */
define('CURSCRIPT', 'apidb');
require '../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();
$uid = $_G['uid'];
$act= $_GET['act'];
if ($act == 'live_hot_list'){
	//给JS调用,热门用户直播列表
	$data = array(
		'match' => 0,
		'hot' => 0,
		'count' => 30
	);
	$cmd_body = '012'.json_encode($data);
	$recvdata = socketSendAndRecvData(LOCAL_HOST,LOCAL_PORT, encodeCommand($cmd_body, 6), 5);
	$recvdata = json_decode($recvdata, true);
	$hot_arr = array();
	foreach ($recvdata['hot']['lists'] as $k=>$v){
		if ($v['online']==1) {
			$v['avatar'] = avatar($v['uid'],'middle',true,false,true,'/uc_server');
			$hot_arr[]=$v;
		}
	}
	echo json_encode($hot_arr);
}
?>