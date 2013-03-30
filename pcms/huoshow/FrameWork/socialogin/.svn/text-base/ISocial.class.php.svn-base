<?php
/**
 * 社会化登录抽象接口,所有提供社会化登录的功能都实现此接口
 * @author chengkui
 *
 */

define("SOCIALCALLBAK","http://{$SYSCONFIG["SpaceSiteRoot"]}/api/denglu.php");

interface ISocial 
{

	/**
	 * 完成第一步，获得oauth_token
	 */
	public function go_author_baseUrl($process);
	
	
	/**
	 * 获得access token
	 */
	public function get_access_token();
	
	/**
	 * 获得用户基本信息
	 */
	public function get_user_base_info();
}



?>