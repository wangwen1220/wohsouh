<?php

/**
 * 净化帖子
 */
error_reporting(0);
set_time_limit(60);
Ignore_User_Abort(True);#忽略客户打断
date_default_timezone_set('PRC');

define('APPTYPEID', 1006);
define('CURSCRIPT', 'call');
define('ALLOWGUEST', 1);

require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'common.php';
if(HL_VERSION == "X2" || HL_VERSION == "X1.5"){
    $discuz = & discuz_core::instance();
    $discuz->cachelist = array();
    $discuz->init();
}

//初始化工作类
$HL_Purify = & Purify::singleton();

//log start
$HL_Purify->logFileSet("call");
$HL_Purify->log("/*****".$HL_Purify->cur_date." ".$HL_Purify->cur_time."*****/");

#获取外部参数
$BAO10jie_sig = strip_tags(trim($_POST['sig']));#签名
$BAO10jie_pid = abs(intval($_POST['pid'])); #帖子ID

#参数校验
if (!$BAO10jie_sig) {
    $HL_Purify->log('sig check error');
    exit('-10');
}
if (md5($HL_Purify->config['app_key']) != $BAO10jie_sig) {
    $HL_Purify->log('error for app key is not same to sig');
    exit('-102');
}
if (!$BAO10jie_pid) {
    $HL_Purify->log('pid check error');
    exit('-11');
}
$HL_Purify->log('pid : ' . $BAO10jie_pid);
$HL_Purify->mark($BAO10jie_pid);

#校验签名
//if (!$Purify_APP_KEY) {
//    runCallLog('app key check error', true);
//    exit('-101');
//}

$HL_Purify->log('complete');
exit('1');


