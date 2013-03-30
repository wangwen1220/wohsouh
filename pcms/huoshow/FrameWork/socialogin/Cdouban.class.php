<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/configs/config.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/ISocial.class.php";
include_once( $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/douban/OAuth.php" );
include_once( $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/douban/config.php" );


class douban implements ISocial
{
	
	
	public function __construct()
	{
		$this->WB_CALLBACK = SOCIALCALLBAK."?site=douban";
	}
	
	
	public function go_author_baseUrl($process)
	{
		global $api_key,$api_key_secret,$request_token_url,
			$authorize_url,$access_token_url,$hmac_method,$sig_method;
		$consumer = new OAuthConsumer($api_key, $api_key_secret);
		$req_req = OAuthRequest::from_consumer_and_token($consumer, NULL, 
				"GET", $request_token_url);
		$req_req->sign_request($sig_method, $consumer, NULL);

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $req_req->to_url());
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		parse_str($result, $arr);
		$param_str = 'oauth_token=' . $arr['oauth_token'];

		session_start();
		$_SESSION['request_token_secret'] = $arr['oauth_token_secret'];
		
		$callback = urlencode($this->WB_CALLBACK."&p=$process");
		$authorize_request_url = $authorize_url . "?" . $param_str . "&oauth_callback=" . $callback;
		header('location:'.$authorize_request_url);
	}
	
	public function get_access_token()
	{
		global $api_key,$api_key_secret,$request_token_url,
			$authorize_url,$access_token_url,$hmac_method,$sig_method;

		$oauth_token = $_REQUEST['oauth_token'];
		if(empty($oauth_token))
			return false;
		session_start();
		$oauth_token_secret = $_SESSION['request_token_secret'];
		
		$consumer = new OAuthConsumer($api_key, $api_key_secret);
		$request_token = new OAuthConsumer($oauth_token, $oauth_token_secret);
		$acc_req = OAuthRequest::from_consumer_and_token($consumer, $request_token, "GET", $access_token_url);
		$acc_req->sign_request($sig_method, $consumer, $request_token);
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $acc_req->to_url());
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		/*
		parse_str($result,$arr);

		//$consumer = new OAuthConsumer($api_key, $api_key_secret);
		//$request_token = new OAuthConsumer($oauth_token, $oauth_token_secret);
		
		$url = 'http://api.douban.com/people/@me';
		$acc_token = new OAuthConsumer($arr[oauth_token], $arr[oauth_token_secret]);
		$acc_req = OAuthRequest::from_consumer_and_token($consumer, $acc_token, "get", $url);
		$acc_req->sign_request($sig_method, $consumer, $acc_token);
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $acc_req->to_url());
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		var_dump($result);die();
	
		*/
		
		//parse_str($result, $params);
		//var_dump($result);
		return $result;
	}
	
	public function get_user_base_info()
	{
		$access_str = $this->go_author_baseUrl("get_user_info");
	}
	
	public function getuserinfo($accesstoken,$access_token_secret)
	{
		global $api_key,$api_key_secret,$request_token_url,
		$authorize_url,$access_token_url,$hmac_method,$sig_method;
		$token = $accesstoken;
		$token_secret = $access_token_secret;
		
		$consumer = new OAuthConsumer($api_key, $api_key_secret);
		//$request_token = new OAuthConsumer($oauth_token, $oauth_token_secret);
		
		$url = 'http://api.douban.com/people/%40me';
		$acc_token = new OAuthConsumer($token, $token_secret);
		$acc_req = OAuthRequest::from_consumer_and_token($consumer, $acc_token, "get", $url);
		$acc_req->sign_request($sig_method, $consumer, $acc_token);
	
		//var_dump($acc_req->to_header());
		//var_dump($header);die();
		/*
		$requestBody = "<?xml version='1.0' encoding='UTF-8'?>
		<entry xmlns:ns0=\"http://www.w3.org/2005/Atom\" xmlns:db=\"http://www.douban.com/xmlns/\">
		<content>哈哈哈哈test</content>
		</entry>";
		*/
		//var_dump($acc_req->to_url());
		$ch = curl_init();
		
		//curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
		//var_dump($acc_req->get_signature_base_string());die();
		curl_setopt($ch,CURLOPT_URL, $acc_req->to_url());
		
		//curl_setopt($ch,CURLOPT_HEADER,1);
		//curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch,CURLOPT_POST,1);
		//curl_setopt($ch,CURLOPT_POSTFIELDS, $acc_req->to_postdata());
		$result = curl_exec($ch);
		//var_dump($result);
		curl_close($ch);
		
		//$uid_patten = "/\<db\:uid\>([\d]{1,})/";
		$uid_patten = "/\<id\>([^\n]+)\<\/id\>/";
		preg_match($uid_patten,$result,$match);
		$tmp_uid = $match[1];
		
		$return_arr[uid] = substr($tmp_uid, strrpos($tmp_uid,"/")+1);
		
		$icon_patten = "/\<link href\=\"([^\"]+)\" rel=\"icon\"\/>/";
		preg_match($icon_patten,$result,$match);
		$return_arr[icon] = array("48*48"=>$match[1]);
		
		$nickname_patten = "/\<title\>([^\n]+)\<\/title\>/";
		preg_match($nickname_patten,$result,$match);
		$return_arr[nickname] = $match[1];
		$return_arr[site] = "douban";
		$return_arr[gender]="";

		return $return_arr;
	}
	
	
	
}


?>