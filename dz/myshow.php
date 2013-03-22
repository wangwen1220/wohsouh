<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home.php 7813 2010-04-13 10:34:03Z wangjinbo $
 */

define('APPTYPEID', 1);
define('CURSCRIPT', 'myshow');

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

$space = array();

$mod = getgpc('mod');

if(!in_array($mod, array('index','upload','record','kge'))) 
{
	$mod = 'index';
}
define('CURMODULE', $mod);
runhooks();

require_once libfile('myshow/'.$mod, 'module');


?>