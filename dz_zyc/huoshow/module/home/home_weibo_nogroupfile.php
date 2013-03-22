<?php
/**
 * 个人微薄关注
 *
 * @author Administrator
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
//define('DX_URL', 'http://space.'.GLOBAL_SITEDOMAIN."/");
$smarty = smarty_init();
$dblink = new DataBase("");
$userinfo = UserApi::getLoginUserSessionInfo();
$uid = $userinfo['uid'];
$space_url = DX_URL;
$id = $_GET['id'];//获取分组ID
$page = empty($_G["gp_page"])?1:$_G["gp_page"];
$recordPerPage=20;
if(!empty($_GET['ordertype'])) {
	$ordertype = $_GET['ordertype'];
}else {
$ordertype = 1;
}
$nogroup= weibo::getUserAllFollow($uid,-1,$page,$recordPerPage,$ordertype);//没有分组关注用户列表
$count = count($nogroup);//查询是否还有未分组用户
if (!empty($count)) {
	$count = 1;
}else {
	$count =0;
}
$page_split2 = new PagerSplit(count($nogroup),$page,$recordPerPage);
$page_str2 = $page_split2->GetPagerContent();
$smarty->assign("uid",$uid);
$smarty->assign("space_url",$space_url);
$smarty->assign("id",$id);
$smarty->assign("count",$count);
$smarty->assign("nogroup",$nogroup);
$smarty->display("home/home_weibo_nogroup.html");
?>