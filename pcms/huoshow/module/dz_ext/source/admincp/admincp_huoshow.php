<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_faq.php 13088 2010-07-21 03:54:52Z monkey $
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
$huoshowSys = & HuoshowSys::instance();
$huoshowSys->checkAdminLimit();

$uid = $_G['gp_uid'];
$username=$_G['gp_username'];
cpheader();

$huoshowSys->echoAdminCss();
shownav('extended', 'menu_huoshowext_'.$_G['gp_operation']);
//如果是做ajax操作则不引用
if (!$_G["gp_tab"]){
	showsubmenu('menu_huoshowext_'.$_G['gp_operation'], array());
}

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/module/admin/admin_".$_G['gp_operation'].".php");
/*
if($_G['gp_operation'] == 'coinwatch')
{
	shownav('extended', 'menu_huoshowext_coinwatch');
	showsubmenu('menu_huoshowext_coinwatch', array());
	require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/module/admin/admin_coinwatch.php");
}
*/
?>














