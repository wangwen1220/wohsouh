<?php
/**
 * zhangcj
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//取配置数据
$query = DB::query("SELECT * FROM ".DB::table('add_setting')." WHERE skey IN('liveplayer_ver','liveplayer_ver2', 'liveplayer_url', 'livedown_ver', 'livedown_url')");
while ($rs = DB::fetch($query)) {
	$addSetting[$rs['skey']] = $rs['svalue'];
}

include_once(template('show/player_install'));
?>