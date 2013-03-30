<?php
/**
 * 个人空间粉丝页
 *
 * @author Administrator
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
$smarty = smarty_init();
$dblink = new DataBase("");
$space_url = DX_URL;
$user = UserApi::getLoginUserSessionInfo();
$home_uid = $user['uid'];
//if (weibo::WeiboUidAllow($home_uid) == 1) {
	$lists = empty($_GET['list']) ? '1':$_GET['list'];
	$tab = $_GET['tab'];
	if($user===false){
		die("没有权限，请登陆");
	}else {
		if ($tab == 'del_fans'){
			$src_uid = $_GET['src_uid'];
			Weibo::cancelFollowUser($src_uid,$home_uid);
			g("移除粉丝成功","home.php?mod=huoshow&do=weibo_user_fans");
		}elseif ($tab == 'add_fans'){
			$dst_uid = $_GET['dst_uid'];
			Weibo::followUser($home_uid,$dst_uid);
			g("关注成功","home.php?mod=huoshow&do=weibo_user_fans");
		}
		if ($lists ==1){
			$ordertype = 1;
		}elseif ($lists ==2){
			$ordertype = 2;
		}elseif ($lists ==3){
			$ordertype = 3;
		}else {
			$ordertype = 4;
		}
		$user_info = Weibo::getUserStatInfo($home_uid);
		$user_total = ($user_info[0]['transmit_count'] + $user_info[0]['dymic_count']);
		$page_id = empty($_GET['page']) ? '1': $_GET['page'];
		$my_fans_arr = Weibo::getUserSelfFollow($home_uid,$page_id,20,0,$ordertype);
		$my_fans = $my_fans_arr["record_arr"];
		for ($i=0;$i<count($my_fans);$i++){
			$my_fans[$i]['total'] = ($my_fans[$i]['transmit_count'] + $my_fans[$i]['dymic_count']);
		}
		$page_split = new PagerSplit($my_fans_arr['record_count'],$page_id,20);
		$page_str = $page_split->GetPagerContent();
		$fans_count = $my_fans_arr['record_count'];
	}
	
	$smarty->assign("fans_count",$fans_count);
	$smarty->assign("page_str",$page_str);
	$smarty->assign("home_uid",$home_uid);
	$smarty->assign("space_url",$space_url);
	$smarty->assign("user_info",$user_info);
	$smarty->assign("user_total",$user_total);
	$smarty->assign("lists",$lists);
	$smarty->assign("my_fans",$my_fans);
	$smarty->display("home/home_weibo_user_fans.html");
//}else {
	//g("微博功能暂未开放","http://".$SYSCONFIG["LiveSiteRoot"]);
//}
?>