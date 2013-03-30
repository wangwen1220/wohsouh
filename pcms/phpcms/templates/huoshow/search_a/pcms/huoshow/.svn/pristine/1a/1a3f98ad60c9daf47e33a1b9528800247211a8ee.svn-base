<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/configs/config.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/ISocial.class.php";
include_once($_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/rren/RenrenRestApiService.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/rren/RenrenOAuthApiService.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/rren/config.inc.php");

class renren implements ISocial
{
	
	public function __construct()
	{
		$this->WB_CALLBACK = SOCIALCALLBAK."?site=renren";
	}
	
	public function go_author_baseUrl($process){
		global $config;
		$callback = urlencode($this->WB_CALLBACK."&p=$process");
		$code_url = "https://graph.renren.com/oauth/authorize?client_id=".$config->APPID."&response_type=code&scope=".$config->scope."&state=a%3d1%26b%3d2&redirect_uri=".$callback."&x_renew=true";
//		var_dump($code_url);
		header('location:'.$code_url);
	}
	
	public function get_access_token(){
		global $config;
		session_start();
		$code = $_GET["code"];
		$process = "get_user_info";
		$callback = ($this->WB_CALLBACK."&p=$process");
//		$callback = 'http://space.zyc.huoshow.com/huoshow/FrameWork/socialogin/rren/accesstoken.php';
		if($code){
			//获取accesstoken
			$oauthApi = new RenrenOAuthApiService;
			$post_params = array(
				'client_id' => $config->APIKey,
				'client_secret' => $config->SecretKey,
				'redirect_uri' => $callback,
				'grant_type' => 'authorization_code',
				'code' => $code
			);
			$token_url='http://graph.renren.com/oauth/token';
			$access_info = $oauthApi->rr_post_curl($token_url,$post_params);//使用code换取token
//			var_dump($access_info);
			$access_token = $access_info["access_token"];
			$expires_in = $access_info["expires_in"];
			$refresh_token = $access_info["refresh_token"];
			$_SESSION["access_token"] = $access_token;
			$token_arr = array(
				'oauth_token' => $access_token,
				'oauth_token_secret' => ''
			);
			$token_data = "";
			foreach ( $token_arr as $k=>$v )
			{
				$token_data .="$k=$v&";
			}
			$token_data = trim($token_data,"&");
			return $token_data;
		}else {
			//如果获取不到code，将错误信息打出来
			echo 'error parameter code is null:<br>'.$_SERVER["QUERY_STRING"];
		}
	}
	
	public function get_user_base_info()
	{
		$access_str = $this->go_author_baseUrl("get_user_info");
	}
	
	public function getuserinfo($oauth_token,$oauth_token_secret='')
	{
		$restApi = new RenrenRestApiService;
		$params = array('fields'=>'uid,name,sex,birthday,mainurl,hometown_location,university_history,tinyurl,headurl','access_token'=>$oauth_token);
		$res = $restApi->rr_post_curl('users.getInfo', $params);//curl函数发送请求
		$ren_data['uid'] = $res[0]["uid"];
		$ren_data['nickname'] = $res[0]["name"];
		$ren_data['site'] = "renren";
		$ren_data['icon'] = array(
			"50*50" => $res[0]['tinyurl'],
			"100*100" => $res[0]['headurl'],
			"200*180" => $res[0]['mainurl'],
		);
		return $ren_data;
	}
	
}

?>