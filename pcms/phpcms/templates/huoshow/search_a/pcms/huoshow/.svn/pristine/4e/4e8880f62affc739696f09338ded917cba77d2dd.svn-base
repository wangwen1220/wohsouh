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
$space_url = DX_URL;
$smarty = smarty_init();
$dblink = new DataBase("");
$userinfo = UserApi::getLoginUserSessionInfo();
$uid = $userinfo['uid'];
//if (weibo::WeiboUidAllow($uid) == 1) {
	if (!empty($userinfo['uid'])) {
	//我的微薄数据相关信息(关注,我的粉丝,记录)
	$user_countinfo = weibo::getUserStatInfo($uid);
	$user_total = ($user_countinfo[0]['transmit_count'] + $user_countinfo[0]['dymic_count']);
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
	$recordPerPage=20;
	$group=weibo::getUserGroup($uid);//获取创建的用户分组
	//排序方式
	if(!empty($_G['gp_ordertype']) && is_numeric($_G['gp_ordertype'])) {
		$ordertype = $_G['gp_ordertype'];
	}else {
	$ordertype = 1;
	}
	//获取分组ID
	if(!empty($_G['gp_id']) && is_numeric($_G['gp_id'])) {
		$group_id = $_G['gp_id'];
	}else {
		$group_id = 0;
	}
	$oderAD='desc';
	$sourceuid=0;
	$displaygroup=true;
	$user_follow = weibo::getUserAllFollow($uid,$group_id,$page,$recordPerPage,$ordertype,$oderAD,$sourceuid,$displaygroup);
	if ($group_id == 0) {
		$count = count($dblink->getRow("select dst_uid from pre_weibo_follow where src_uid = '$uid'"));//获取关注用户数量
	}elseif ($group_id == -1) {
		$count = count ($dblink->getRow("SELECT a.dst_uid as uid FROM pre_weibo_follow a INNER JOIN pre_weibo_user_stat c ON a.dst_uid=c.uid WHERE a.src_uid='$uid' AND a.dst_uid NOT IN (SELECT uid FROM pre_weibo_group_info WHERE group_id IN (SELECT id FROM pre_weibo_group WHERE uid='$uid'))"));//获取未分组用户数量
	}elseif ($group_id == -2) {
		$count = count ($dblink->getRow("SELECT tmp.dst_uid AS uid FROM (SELECT dst_uid,follow_date, (SELECT COUNT(*) FROM pre_weibo_follow b WHERE b.src_uid=a.dst_uid AND b.dst_uid='$uid' LIMIT 1) AS each_other FROM pre_weibo_follow a WHERE a.src_uid='$uid') tmp INNER JOIN pre_common_member c ON tmp.dst_uid=c.uid INNER JOIN pre_weibo_user_stat d ON tmp.dst_uid=d.uid WHERE tmp.each_other=1"));//获取相互关注用户数量
	}elseif($group_id != 0) {
		$count = count ($dblink->getRow("SELECT a.uid,a.group_id FROM (pre_weibo_group_info a INNER JOIN pre_common_member b ON a.uid=b.uid) LEFT JOIN pre_weibo_user_stat d ON a.uid=d.uid LEFT JOIN pre_weibo_follow pf ON pf.dst_uid=a.uid WHERE a.group_id='$group_id' AND pf.src_uid='$uid'"));//获取创建分组下的用户数量
	}
	//$count = count($user_follow);
	//获取关注用户属于哪个分组
	for($i=0;$i<$count;$i++) {
		$userisgroup[$i] = $user_follow[$i]['group_info']['group_id'];
	}
	//对关注用户进行分组
	if (!empty($_G['gp_isgroupid']) && is_numeric($_G['gp_isgroupid'])) {
		$isgroupid = $_G['gp_isgroupid'];
		$dst_uid = $_G['gp_dst_uid'];
		$id = $_G['gp_id'];
		if($_G['gp_isgroupid'] >0) {
			weibo::putUserToGroup($uid,$dst_uid,$isgroupid);
			g("分组成功","home.php?mod=huoshow&do=weibo_userfollow&id=".$id);
		}elseif($_G['gp_isgroupid'] == -1) {
			weibo::delUserFromGroup($uid,$dst_uid);
			g("分组成功","home.php?mod=huoshow&do=weibo_userfollow&id=".$id);
		}
		
	}
	//分页
	$page_split = new PagerSplit($count,$page,$recordPerPage);
	$page_str = $page_split->GetPagerContent();
	$nogroup= weibo::getUserAllFollow($uid,-1,$page,$recordPerPage,$ordertype);//没有分组关注用户列表
	$page_split2 = new PagerSplit(count($nogroup),$page,$recordPerPage);
	$page_str2 = $page_split2->GetPagerContent();
	//取消关注用户
	if ($_G['gp_tab'] == "del") {
		$group_id=$_G['gp_id'];
		$src_uid = $uid;
		$dst_uid = $_G['gp_dst_uid'];
		weibo::cancelFollowUser($src_uid,$dst_uid);
		g("取消关注成功","/home.php?mod=huoshow&do=weibo_userfollow&id=".$group_id);
	}
	//删除分组
	if ($_GET['delgroup'] == 'del') {
		$group_id = $_GET['id'];
		weibo::deleteGroup($group_id);
		g("删除成功","/home.php?mod=huoshow&do=weibo_userfollow");
	}
	//获取分组下的所有用户发的动态和转发
	if ($_G['gp_getgroupmsg'] == 'msg') {
		$group_id = $_G['gp_id'];
		$current_page=1;
		$record_per_page=20;
		$lastMsgId=0;
		$getgroupallmsg = weibo::getUserAllMsg($uid,$current_page,$record_per_page,$lastMsgId,$group_id);
		
	}
	$smarty->assign("uid",$uid);
	$smarty->assign("space_url",$space_url);
	$smarty->assign("count",$count);
	$smarty->assign("group_id",$group_id);
	$smarty->assign("userisgroup",$userisgroup);
	$smarty->assign("user_total",$user_total);
	$smarty->assign("nogroup",$nogroup);
	$smarty->assign("group",$group);
	$smarty->assign("ordertype",$ordertype);
	$smarty->assign("page_str",$page_str);
	$smarty->assign("page_str2",$page_str2);
	$smarty->assign("beFollowCount",$beFollowCount);
	$smarty->assign("user_follow",$user_follow);
	$smarty->assign("user_countinfo",$user_countinfo);
	$smarty->assign("watched_count",$watched_count);
	$smarty->assign("user_recommend",$user_recommend);
	$smarty->display("home/home_weibo_user_follow.html");
	}else {
		g("请登录再进行操作","/");
	}
//}else {
	//g("微博功能暂未开放","http://".$SYSCONFIG["LiveSiteRoot"]);
//}
?>