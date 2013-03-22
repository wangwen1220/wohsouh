<?php
//站点类型
$site = $_REQUEST["site"];
//处理类型
$process = $_REQUEST["p"];

global $site,$process,$api_key,$api_key_secret,$request_token_url,
$authorize_url,$access_token_url,$hmac_method,$sig_method;
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/C$site.class.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/DataBase.php"; 

$smarty = smarty_init();
$dblink = new DataBase("");

$cauth = new $site();
//if(empty($_REQUEST['oauth_token'])) return false;
$str = $cauth->get_access_token();
parse_str($str,$arr);
if($process=="get_user_info")
{
	$arr = $cauth->getuserinfo($arr[oauth_token],$arr[oauth_token_secret]);
//	var_dump($arr);
	//设置一个session
	$_SESSION['Social_Login'] = 'social';
	if ($arr['site'] == 'douban'){
		$s_source = 1;
	}elseif ($arr['site'] == 'sina'){
		$s_source = 2;
	}elseif ($arr['site'] == 'qzone'){
		$s_source = 3;
	}else {
		$s_source = 4;
	}
	//根据社会化id和来源ID查找对应uid
	$sql = "SELECT * FROM pre_community_bind WHERE social_Uid='$arr[uid]' AND source='$s_source'";
	$dbarr = $dblink->getRow($sql);
	
	if (count($dbarr)>0){//绑定，则根据uid查得用户信息登录
		if (!empty($arr[uid])) {
			$sql = "SELECT uid,username,password FROM pre_common_member WHERE uid=".$dbarr[0]['uid'];
			$login_data = $dblink->getRow($sql);
			$_SESSION['Social_Uid'] = $login_data[0]['uid'];
			$code_url = "/member.php?mod=logging&action=login&loginsubmit=yes&handlekey=login&floatlogin=yes&loginfield=username&username=".$login_data[0][username]."&questionid=0&answer=&loginsubmit=yes&isbound=isbound&social_session=".$_SESSION['Social_Login']."&session_uid=".$_SESSION['Social_Uid'];
			header('location:'.$code_url);
		}else {
			$code_url = "/member.php?mod=logging&action=login";
			header('location:'.$code_url);
		}

	}else {//没有绑定，0则到绑定页面新增加记录再登录
		if (!empty($arr[uid])) {
			$formhash = formhash_huo();
			$smarty->assign("formhash",$formhash);
			$smarty->assign("s_uid",$arr[uid]);
			$smarty->assign("s_name",$arr[nickname]);
			$smarty->assign("s_source",$s_source);
			$smarty->assign("pcms_url",PCMS_URL);
			$smarty->display("commom/social_login.html");
		}else {
			$code_url = "/member.php?mod=logging&action=login";
			header('location:'.$code_url);
		}
	}
}
else
{
	$cauth->$process();
}




/*
$fun = $site.'_'.$process;
$fun();




function douban_get_user_info()
{
	global $site,$process,$api_key,$api_key_secret,$request_token_url,
			$authorize_url,$access_token_url,$hmac_method,$sig_method;
	require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/C$site.class.php";
	
	$cauth = new $site();
	if(empty($_REQUEST['oauth_token'])) return false;
	$str = $cauth->get_access_token();
	parse_str($str,$arr);
	$arr = $cauth->getuserinfo($arr[oauth_token],$arr[oauth_token_secret]);
}
*/


?>