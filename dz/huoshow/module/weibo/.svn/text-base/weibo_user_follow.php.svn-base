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

$smarty = smarty_init();
$dblink = new DataBase("");
$userinfo = UserApi::getLoginUserSessionInfo();
$uid = $userinfo['uid'];
if (!empty($userinfo['uid'])) {
//我的微薄数据相关信息(关注,我的粉丝)
$user_countinfo = weibo::getUserStatInfo($uid);
//可能感兴趣的人随机显示
$sql = "SELECT * FROM (SELECT a.uid,a.id,IF(b.nickname!='',b.nickname,b.username) as name FROM pre_weibo_recommend a,pre_common_member b WHERE a.uid=b.uid ORDER BY a.id DESC ) AS test ORDER BY RAND() LIMIT 6";
$user_recommend = $dblink->getRow($sql);
$num = count($user_recommend);
for($i=0;$i<$num;$i++) {
	$user_recommend[$i]["head_img_url"] = getLiveHead($user_recommend[$i]["uid"],"small");
}
//人气用户推荐
$sql = "SELECT a.uid,a.is_watched_count,IF(b.nickname!='',b.nickname,b.username) AS name FROM pre_weibo_user_stat a,pre_common_member b WHERE a.uid=b.uid ORDER BY a.is_watched_count DESC LIMIT 6";
$watched_count = $dblink->getRow($sql);
$num = count($watched_count);
for ($i=0;$i<$num;$i++) {
	$watched_count[$i]["head_img_url"] = getLiveHead($watched_count[$i]["uid"],"small");
}
//获得某用户关注的所有用户信息
$page = empty($_G["gp_page"])?1:$_G["gp_page"];
$recordPerPage=5;
$group_id=0;
$user_follow = weibo::getUserAllFollow($uid,$group_id,$page,$recordPerPage);
/*$num = count ($user_follow);
for ($i=0;$i<$num;$i++) {
	$sql = "select is_watched_count from pre_weibo_user_stat where uid=".$user_follow[$i]['uid'];
	$user_follow[$i]['followCount'] = $dblink->getRow($sql);
	
}*/
//分页
$sql = "select count(*) as count from pre_weibo_follow where src_uid='$uid'";
$follow_count = $dblink->getRow($sql);//统计关注人数
$page_split = new PagerSplit($follow_count[0]['count'],$page,$recordPerPage);
$page_str = $page_split->GetPagerContent();
if ($_GET['tab'] = "del") {
	$src_uid = $_GET['src_uid'];
	$dst_uid = $_GET['dst_uid'];
	weibo::cancelFollowUser($src_uid,$dst_uid);
}
$smarty->assign("uid",$uid);
$smarty->assign("page_str",$page_str);
$smarty->assign("beFollowCount",$beFollowCount);
$smarty->assign("user_follow",$user_follow);
$smarty->assign("user_countinfo",$user_countinfo);
$smarty->assign("watched_count",$watched_count);
$smarty->assign("user_recommend",$user_recommend);
$smarty->display("weibo/weibo_user_follow.html");
}else {
	g("请登录再进行操作","/");
}
?>