<?php

//引入需要的文件
//数据库操作类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
//火秀系统类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
//后台所有php文件都需要加这句话，用于权限判断等初始化操作
$huoshowSys = & HuoshowSys::instance();
$huoshowSys->checkAdminLimit();
//var_dump($_GET);

$dblink = new DataBase("");
$select_user = $_G["gp_select"];
$jinzhistate =$_G["gp_jinzhistate"];
if(!empty($jinzhistate))
{
	$count = count($select_user);
	$admin_info = UserApi::getLoginUserSessionInfo();
	$admin_id = $admin_info["uid"];
	$matchid=$_GET['matchid'];
	$forbid_reason =$_G["gp_forbid_reason"];
	$useremail = $eventsuser[0]['email'];
	for($i=0;$i<$count;$i++)
	{
		if($jinzhistate=="current")
			$dblink->query("insert into pre_match_forbid_user (`uid`,`forbid_match_id`,`forbid_admin_id`,`forbid_reason`) VALUES ('$select_user[$i]','$matchid','$admin_id','$forbid_reason')");
		elseif ($jinzhistate=="all")
			$dblink->query("insert into pre_match_forbid_user_forever (`uid`,`forbid_admin_id`,`forbid_reason`) VALUES ('$select_user[$i]','$admin_id','$forbid_reason')");
		//发邮件
		$emailsql=$dblink->getRow("select email from pre_common_member where uid='".$select_user[$i]."'");
		$email=$emailsql['email'];
		$fto = "$email";
		$subject="test";
		$from_mail="huoshow@huoshow.com";
		$emailbody="$forbid_reason";
		$headers = "From: $from_mail\nReply-To: $from_mail\nContent-Type:text/html;charset=iso-8859-1";
		mail("$fto", "$subject", "$emailbody", "$headers");
		//发站内消息
	}
}

$matchid=$_G["gp_matchid"];
if(empty($matchid))
	die("缺少赛事ID信息");
	
$username = $_G["gp_username"];
if($username=="请输入用户名称")
	$username = "";


$sql_con = "where 1=1 ";
if(!empty($username))
	$sql_con.=" and username like '%$username%'";
//模板初始化
$smarty1 = smarty_init();

//开始程序逻辑
//$_G["gp_ 在huoshow中也有定义，因此可以放心使用,代表_GET或者_POST传值
$page = empty($_G["gp_page"])?1:$_G["gp_page"];
//每页条目数
$page_record = 10;
//查询，获得记录总数
$db_arr = $dblink->getRow("select count(*) as count from pre_match_apply_user a left join pre_common_member b on a.uid=b.uid $sql_con and a.match_id=$matchid order by a.uid desc");
$user_count = $db_arr[0]["count"];
$sql = "select a.uid,a.match_id,a.join_match_time,a.match_total_time,b.username from pre_match_apply_user a left join pre_common_member b on a.uid=b.uid  $sql_con and a.match_id=$matchid order by uid desc limit ".($page-1)*$page_record.",$page_record";
$eventsuser = $dblink->getRow($sql);
$count = count($eventsuser);
for($i=0;$i<$count;$i++)
{
	$sql = "select uid from pre_match_recommend_live_index where uid='".$eventsuser[$i]["uid"]."' limit 0,1";
	$tmp_live_arr = $dblink->getRow($sql);
	$eventsuser[$i]["islive"] = empty($tmp_live_arr)?0:1;
	$sql = "select uid from pre_match_recommend_match where uid='".$eventsuser[$i]["uid"]."' and match_id='$matchid' limit 0,1";
	$tmp_match_arr = $dblink->getRow($sql);
	$eventsuser[$i]["ismatch"] = empty($tmp_match_arr)?0:1;
}
if ($jinzhistate=="current"){
	$sql = "INSERT INTO pre_match_forbid_user (`uid`,`forbid_reason`) VALUES ('$uid','$forbid_reason')";
	$forbiduser=$dblink->query($sql);
}
if ($_GET['add']=='liveroom'){
		$uid=$_GET['uid'];
		if (!empty($uid)){
			$sql= "INSERT INTO pre_match_recommend_live_index (`uid`) VALUES ('$uid')";
			$addliveroom =$dblink->query($sql);
			
		}
}
if ($_GET['add']=='eventsroom'){
		$uid=$_GET['uid'];
		//$match_id=$_GET['match_id'];
		$matchid=$_GET['matchid'];
		if (!empty($uid)){
			$sql= "INSERT INTO pre_match_recommend_match (`uid`,`match_id`) VALUES ('$uid','$matchid')";
			$liveroom =$dblink->query($sql);
		}
}
if ($_GET['delete']=='liveroom'){
		$uid=$_GET['uid'];
		if (!empty($uid)){
			$sql = "DELETE FROM pre_match_recommend_live_index where uid=$uid";
			$deleteliveroom =$dblink->query($sql);
		}
}
if ($_GET['delete']=='eventsroom'){
		$uid=$_GET['uid'];
		//$match_id=$_GET['match_id'];
		$matchid=$_GET['matchid'];
		if (!empty($uid)){
			$sql = "DELETE FROM pre_match_recommend_match where uid=$uid and match_id=$matchid";
			$liveroom =$dblink->query($sql);
		}
}
//关闭数据库链接
$dblink->dbclose();
//获得分页字符串
//注意，分页类除了适用动态链接，也适用伪静态链接和js链接，具体看类实现
$page_split = new PagerSplit($user_count,$page,$page_record,"/admin.php?action=huoshow&operation=eventsuser&matchid=$matchid&username=$username&page={#page}");
$page_str = $page_split->GetPagerContent();


//开始定义模板
$smarty1->assign("eventsuser",$eventsuser);
$smarty1->assign("check_liveroom",$check_liveroom);
$smarty1->assign("deleteliveroom",$deleteliveroom);
$smarty1->assign("addliveroom",$addliveroom);
$smarty1->assign("deleteliveroom",$deleteliveroom);
$smarty1->assign("matchid",$matchid);
$smarty1->assign("page_str",$page_str);
$smarty1->assign("liveroom",$liveroom);
$smarty1->assign("username",$username);
$smarty1->display("admin/admin_eventsuser.html");
?>
