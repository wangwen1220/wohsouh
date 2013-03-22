<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home.php 7813 2010-04-13 10:34:03Z wangjinbo $
 */

define('APPTYPEID', 1);
define('CURSCRIPT', 'show');

require_once './source/class/class_core.php';
require_once './source/function/function_home.php';
$discuz = & discuz_core::instance();
$modcachelist = array();
$cachelist = array();
if(isset($modcachelist[CURMODULE])) {
	$cachelist = $modcachelist[CURMODULE];
}

$discuz->cachelist = $cachelist;
$discuz->init();
//require_once './source/class/class_pk.php';
$space = array();
//$period = PK::getPKInfo();
$mod = getgpc('mod');

if(!in_array($mod, array('huoshow','index','my','somebody','fans','gift','receviegift','addfans','addnote','voterank','getnote','campaign1','kge','showmyshow','test','watch','create','player','player_swf','rank','frank','vrank','zrank','yrank','personalinfo','live','live_1'))) 
{
	$mod = 'index';
	$_GET['do'] = 'show';
	if("http://".$_SERVER ['HTTP_HOST']."/"!=DX_HUOSHOW_SHOW_URL)
	{
		header('HTTP/1.0 301 Moved Permanently');  
		header('Location:'.DX_HUOSHOW_SHOW_URL);		
	}	 
}
define('CURMODULE', $mod);
runhooks();
$liveSeoTitle='美女视频_美女主播_火秀直播大厅_火秀网';
require_once libfile('show/'.$mod, 'module');

?>