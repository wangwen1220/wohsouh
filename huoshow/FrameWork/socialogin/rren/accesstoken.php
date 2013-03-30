<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require_once 'config.inc.php';
require_once 'RenrenOAuthApiService.class.php';
require_once 'RenrenRestApiService.class.php';

session_start();
$code = $_GET["code"];
if($code)
{
	echo '<hr>使用code换取accesstoken：<hr><br>';
	//获取accesstoken
	$oauthApi = new RenrenOAuthApiService;
	$post_params = array('client_id'=>$config->APIKey,
		'client_secret'=>$config->SecretKey,
		'redirect_uri'=>$config->redirecturi,
		'grant_type'=>'authorization_code',
		'code'=>$code
	);
	var_dump($post_params);
	$token_url='http://graph.renren.com/oauth/token';
	$access_info=$oauthApi->rr_post_curl($token_url,$post_params);//使用code换取token
	
	$access_token=$access_info["access_token"];
	$expires_in=$access_info["expires_in"];
	$refresh_token=$access_info["refresh_token"];
	//session_start();
	$_SESSION["access_token"]=$access_token;
	echo '<hr>使用accesstoken获取登录用户的信息：<hr><br>';
	//获取用户信息RenrenRestApiService
	$restApi = new RenrenRestApiService;
	$params = array('fields'=>'uid,name,sex,birthday,mainurl,hometown_location,university_history,tinyurl,headurl','access_token'=>$access_token);
	$res = $restApi->rr_post_curl('users.getInfo', $params);//curl函数发送请求
	var_dump($res);
	//$res = $restApi->rr_post_fopen('users.getInfo', $params);//如果你的环境无法支持curl函数，可以用基于fopen函数的该函数发送请求
	//print_r($res);//输出返回的结果
}
else
{
	//如果获取不到code，将错误信息打出来
	echo 'error parameter code is null:<br>'.$_SERVER["QUERY_STRING"];
}

?>