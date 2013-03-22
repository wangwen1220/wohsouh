<?php
/**
 * 创建分组
 *
 * @author Administrator
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
$smarty = smarty_init();
$dblink = new DataBase("");
$uid=$_GET['uid'];
$smarty->assign("uid",$uid);
$smarty->display("home/home_weibo_setgroup.html");
?>