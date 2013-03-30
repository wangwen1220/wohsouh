<?php

/**
 * 在这里进行直播间的逻辑操作
 *
 * @author chengkui
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/configs/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");

$smarty = smarty_init();

//初始化火秀系统环境
/*
	对于不希望被直接通过url访问到的嵌入文件，
	不要加
		$hs_system = & HuoshowSys::instance();
	只需要用
		if(!HuoshowSys::systemIsLoad())
			exit("Access Error");
	因为被引入的文件一定在引入文件中被初始化过环境
*/


if(!HuoshowSys::systemIsLoad())
	exit("Access Error");

//获得用户的session信息
$loginUserInfo = UserApi::getLoginUserSessionInfo();
//获得已登录用户的uid
$uid = $loginUserInfo["uid"];
//$_G["gp_ 不论在dz下还是huoshow都有用，代表_GET和_POST
$roomid = $_G["gp_roomid"];
if(!empty($uid) && $uid==$roomid)
{
	//开始主播端业务逻辑，当然你也可以require_once一个单独的页面处理。
	$smarty->display("show/show_main.html");
}
else 
{
	//开始观众端业务逻辑,当然你也可以require_once一个单独的页面处理。
	$smarty->display("show/show_somebody.html");
}

?>