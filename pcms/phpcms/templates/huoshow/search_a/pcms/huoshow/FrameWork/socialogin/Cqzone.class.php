<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/configs/config.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/ISocial.class.php";
include_once( $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/qzone/comm/config.php" );

class qzone implements ISocial
{

	private $WB_AKEY = "100277183";
	private $WB_SKEY = "58862cf5c6e5382bb4e647c90b1ae504";
	private $WB_CALLBACK;

	public function __construct()
	{
		global $SYSCONFIG;
		//$this->WB_CALLBACK = SOCIALCALLBAK;
		$this->WB_CALLBACK = SOCIALCALLBAK."?site=qzone";
		
	}

	public function get_user_base_info()
	{
		$access_str = $this->go_author_baseUrl("get_user_info");
	}
	
	public function go_author_baseUrl($process)
	{
		//用户点击qq登录按钮调用此函数
		$callbackurl = $this->WB_CALLBACK."&p=$process";
		$login_url = $this->qq_login($_SESSION["appid"], $_SESSION["scope"], $callbackurl);
		header("Location:$login_url");
	}

	
	/**
	 * 从qzone回调函数
	 * 
	 */
	public function get_access_token()
	{
		if($_REQUEST['state'] == $_SESSION['state']) //csrf
		{
			require_once($_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/qzone/comm/utils.php");
			$token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
			. "client_id=" . $_SESSION["appid"]. "&redirect_uri=" . urlencode($_SESSION["callback"])
			. "&client_secret=" . $_SESSION["appkey"]. "&code=" . $_REQUEST["code"];
		
			$response = get_url_contents($token_url);
			if (strpos($response, "callback") !== false)
			{
				$lpos = strpos($response, "(");
				$rpos = strrpos($response, ")");
				$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
				$msg = json_decode($response);
				if (isset($msg->error))
				{
					echo "<h3>error:</h3>" . $msg->error;
					echo "<h3>msg  :</h3>" . $msg->error_description;
					exit;
				}
			}
		
			$params = array();
			parse_str($response, $params);

			$params["oauth_token"] = $params["access_token"];
			$params["oauth_token_secret"] = "";
			$rv = "";
			foreach ( $params as $k=>$v )
			{
				$rv .="$k=$v&";
			}
			
			$rv = trim($rv,"&");
			
			return $rv;
			//debug
			//print_r($params);
		
			//set access token to session
			//$_SESSION["access_token"] = $params["access_token"];
			//$arr = $this->get_user_info($params["access_token"]);
			//var_dump($arr);die();
			
		}
	}
	
	/**
	 * 根据当前的访问token，获得用户基本信息
	 * @param unknown_type $access_token
	 */
	public function getuserinfo($accesstoken,$access_token_secret)
	{
		$this->get_openid($accesstoken);
		$access_token = $accesstoken;
		$get_user_info = "https://graph.qq.com/user/get_user_info?"
		. "access_token=" . $access_token
		. "&oauth_consumer_key=" . $_SESSION["appid"]
		. "&openid=" . $_SESSION["openid"]
		. "&format=json";
		$info = get_url_contents($get_user_info);
		$arr = json_decode($info, true);
		$return_arr[nickname] = $arr[nickname];
		$return_arr[site]="qzone";
		$return_arr[icon]=array(
				"30*30"=>$arr[figureurl],
				"50*50"=>$arr[figureurl_1],
				"100*100"=>$arr[figureurl_2],
				);
		$return_arr[uid] = $_SESSION["openid"];
		$return_arr[gender]=$arr[gender];
		return $return_arr;
	}
	
	/**
	 * 到qzone走登录流程
	 * @param unknown_type $appid		appid
	 * @param unknown_type $scope 	  	允许使用的接口
	 * @param unknown_type $callback	回调地址
	 * @return string
	 */
	private function qq_login($appid, $scope, $callback)
	{
		$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
		$login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
		. $appid . "&redirect_uri=" . urlencode($callback)
		. "&state=" . $_SESSION['state']
		. "&scope=".$scope;
		return $login_url;
	}
	
	private function get_openid($accesstoken) {
		$graph_url = "https://graph.qq.com/oauth2.0/me?access_token=$accesstoken";
		
		$str = get_url_contents ( $graph_url );
		if (strpos ( $str, "callback" ) !== false) {
			$lpos = strpos ( $str, "(" );
			$rpos = strrpos ( $str, ")" );
			$str = substr ( $str, $lpos + 1, $rpos - $lpos - 1 );
		}
		
		$user = json_decode ( $str );
		if (isset ( $user->error )) {
			echo "<h3>error:</h3>" . $user->error;
			echo "<h3>msg  :</h3>" . $user->error_description;
			exit ();
		}
		
		// debug
		// echo("Hello " . $user->openid);
		
		// set openid to session
		$_SESSION ["openid"] = $user->openid;
	}
	
}
?>