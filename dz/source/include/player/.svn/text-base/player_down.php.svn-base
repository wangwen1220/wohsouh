<?php
/**
 * zhangcj
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//取配置数据
$query = DB::query("SELECT * FROM ".DB::table('add_setting')." WHERE skey IN('liveplayer_url','liveplayer_ver2')");
while ($rs = DB::fetch($query)) {
	$addSetting[$rs['skey']] = $rs['svalue'];
}

header("location: ".$addSetting['liveplayer_url']);
?>