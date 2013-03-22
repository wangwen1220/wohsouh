<?php
/**
 * 人气用户推荐
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
//人气用户推荐
//按粉丝数排行
//$sql = "SELECT a.uid,a.is_watched_count,IF(b.nickname!='',b.nickname,b.username) AS name FROM pre_weibo_user_stat a,pre_common_member b WHERE a.uid=b.uid ORDER BY a.is_watched_count DESC LIMIT 6";
//改成随机会员显示12个
$sql = "select * from (select uid,if(nickname!='',nickname,username) as name from pre_common_member order by uid desc) as test order by rand() limit 12";
$watched_count = $dblink->getRow($sql);
$num = count($watched_count);
for ($i=0;$i<$num;$i++) {
	$watched_count[$i]["head_img_url"] = getLiveHead($watched_count[$i]["uid"],"small");
	$sql = "select * from pre_weibo_follow where src_uid='".$uid."' and dst_uid=".$watched_count[$i]['uid'];
	$is_attention = $dblink->getRow($sql);
	//判断是否已经关注,1为已经关注
	if (count($is_attention)>0) {
		$watched_count[$i]['is_att'] =1;
	}else {
		$watched_count[$i]['is_att'] =0;
	}

}
$smarty->assign("watched_count",$watched_count);
$smarty->assign("uid",$uid);
$smarty->assign("space_url",$space_url);
$smarty->display("home/home_weibo_hotrecommend.html");
?>