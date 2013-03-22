<?php
/*************
# 插件设置
*************/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) exit('Access Denied');

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'common.php';
$saveOK = 0;
if(!empty($_POST['clear_day'])){
	$clear_day = intval($_POST['clear_day']);
	$clear_time = time()-$clear_day*24*3600;
	if (HL_VERSION == "X2" || HL_VERSION == "X1.5") {
		DB::query("DELETE FROM ".DB::table("purifyhylanda")." WHERE sendtime<{$clear_time}");
		DB::query("DELETE FROM ".DB::table("cachehylanda")." WHERE timestamp<{$clear_time}");
	}else{
		$db->query("DELETE FROM {$tablepre}purifyhylanda WHERE sendtime<{$clear_time}");
		$db->query("DELETE FROM {$tablepre}cachehylanda WHERE timestamp<{$clear_time}");
	}
	$saveOK = 1;
}

include HL_PLUGIN_ROOT.HL_DS.'template'.HL_DS.'clear.tpl.php';

?>

