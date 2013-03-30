<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
//模板初始化
$smarty = smarty_init();
$abc = $_GET["ac"];

$smarty->display("home/room_live_admin.html");
?>