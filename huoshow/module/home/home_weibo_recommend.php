<?php
/**
 * 可能感兴趣的人
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
//可能感兴趣的人随机显示
$sql = "SELECT * FROM (SELECT a.uid,a.id,IF(b.nickname!='',b.nickname,b.username) as name FROM pre_weibo_recommend a,pre_common_member b WHERE a.uid=b.uid ORDER BY a.id DESC ) AS test ORDER BY RAND() LIMIT 6";
$user_recommend = $dblink->getRow($sql);
$num = count($user_recommend);
for($i=0;$i<$num;$i++) {
	$user_recommend[$i]["head_img_url"] = getLiveHead($user_recommend[$i]["uid"],"small");
	$sql = "select * from pre_weibo_follow where src_uid='".$uid."' and dst_uid=".$user_recommend[$i]['uid'];
	$is_attention = $dblink->getRow($sql);
	//判断是否已经关注,1为已经关注
	if (count($is_attention)>0) {
		$user_recommend[$i]['is_att'] =1;
	}else {
		$user_recommend[$i]['is_att'] =0;
	}
}
$smarty->assign("user_recommend",$user_recommend);
$smarty->assign("uid",$uid);
$smarty->assign("space_url",$space_url);
$smarty->display("home/home_weibo_user_recommend.html");
?>