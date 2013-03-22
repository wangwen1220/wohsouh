<?php

/**
 * zhangchengjun
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

//取配置数据
$query = DB::query("SELECT * FROM ".DB::table('add_setting')." WHERE skey IN('liveplayer_ver', 'liveplayer_ver2', 'liveplayer_url', 'livedown_ver', 'livedown_url')");
while ($rs = DB::fetch($query)) {
	$addSetting[$rs['skey']] = $rs['svalue'];

}
cpheader();
shownav('extended', 'menu_liveplayer');

if(!submitcheck('modsubmit')) {
	showsubmenu('menu_liveplayer', array());
	showformheader('liveplayer');
	showtableheader();
	showsetting('IE插件版本号', 'liveplayer_ver2', $addSetting['liveplayer_ver2'], 'text');
	showsetting('直播插件版本号', 'liveplayer_ver', $addSetting['liveplayer_ver'], 'text');
	showsetting('直播插件路径', 'liveplayer_url', $addSetting['liveplayer_url'], 'text');
	showsetting('直播下载器版本号', 'livedown_ver', $addSetting['livedown_ver'], 'text');
	showsetting('直播下载器路径', 'livedown_url', $addSetting['livedown_url'], 'text');
	showsubmit('modsubmit', 'submit', '', '','');

	showtablefooter();
	showformfooter();
} else {
	$liveplayer_ver = $_G['gp_liveplayer_ver'];
	$liveplayer_ver2 = $_G['gp_liveplayer_ver2'];
	$liveplayer_url = $_G['gp_liveplayer_url'];
	$livedown_ver = $_G['gp_livedown_ver'];
	$livedown_url = $_G['gp_livedown_url'];
   	if (!isset($addSetting['liveplayer_ver'])) {
		DB::insert('add_setting', array('skey'=>'liveplayer_ver', 'svalue'=>$liveplayer_ver));
	} else {
		DB::update('add_setting', array('svalue'=>$liveplayer_ver), "skey='liveplayer_ver'");
	}
	if (!isset($addSetting['liveplayer_ver2'])) {
		DB::insert('add_setting', array('skey'=>'liveplayer_ver2', 'svalue'=>$liveplayer_ver2));
	} else {
		DB::update('add_setting', array('svalue'=>$liveplayer_ver2), "skey='liveplayer_ver2'");
	}
	if (!isset($addSetting['liveplayer_url'])) {
		DB::insert('add_setting', array('skey'=>'liveplayer_url', 'svalue'=>$liveplayer_url));
	} else {
		DB::update('add_setting', array('svalue'=>$liveplayer_url), "skey='liveplayer_url'");
	}
	
	if (!isset($addSetting['livedown_ver'])) {
		DB::insert('add_setting', array('skey'=>'livedown_ver', 'svalue'=>$livedown_ver));
	} else {
		DB::update('add_setting', array('svalue'=>$livedown_ver), "skey='livedown_ver'");
	}
	if (!isset($addSetting['livedown_url'])) {
		DB::insert('add_setting', array('skey'=>'livedown_url', 'svalue'=>$livedown_url));
	} else {
		DB::update('add_setting', array('svalue'=>$livedown_url), "skey='livedown_url'");
	}
	
	cpmsg('addseting_update_succeed', 'action=liveplayer', 'succeed');
}