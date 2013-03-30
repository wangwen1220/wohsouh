<?php
/**
 * 修改分组
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
$id=$_GET['id'];
$smarty->assign("id",$id);
$smarty->display("home/home_weibo_changegroup.html");
?>
