<?php
//是否提交
$do = (empty($_GET["do"]))?0:1;
//标识是从哪里登录
$login_type = $_GET["t"];

//处理类型
$process = $_GET["p"];

define("SOCIALPRX",$login_type);
if($do==1)
{
	
}
else
{
	require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/C".$login_type.".class.php";
	//var_dump(SOCIALPRX);
	$a = new $login_type();
	$a->$process();
}