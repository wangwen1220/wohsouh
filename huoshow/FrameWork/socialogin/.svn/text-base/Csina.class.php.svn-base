<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/configs/config.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/ISocial.class.php";
include_once( $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/sina/config.php" );
include_once( $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/socialogin/sina/saetv2.ex.class.php" );

class sina implements ISocial
{
	
	private $WB_CALLBACK;
	
	public function __construct()
	{
		$this->WB_CALLBACK = SOCIALCALLBAK."?site=sina";
	}
	
	public function go_author_baseUrl($process)
	{
		$callback = $this->WB_CALLBACK."&p=$process";
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		$code_url = $o->getAuthorizeURL( $callback );
//		var_dump($code_url);
		header("Location: $code_url");
	}
	
	public function get_access_token()
	{
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		$process = "get_user_info";
		$callback = $this->WB_CALLBACK."&p=$process";
		if (isset($_REQUEST['code'])) {
			$keys = array();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = $callback;
			$token = $o->getAccessToken( 'code', $keys ) ;
		}else {
			
		}
//		var_dump($_REQUEST);
//		$o = new SaeTOAuthV2( $this->WB_AKEY , $this->WB_SKEY );
		//$o->getAccessToken("code",);
	}
	
	public function get_user_base_info()
	{
		$access_str = $this->go_author_baseUrl("get_user_info");
	}
	
	public function getuserinfo($accesstoken,$access_token_secret)
	{
		
	}
	
	
}
?>