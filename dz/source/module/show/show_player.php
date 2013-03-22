<?php
/**
 * zhangcj
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$dos = array('index', 'down', 'install', 'update');

$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'index';

require_once libfile('player/'.$do, 'include');
?>