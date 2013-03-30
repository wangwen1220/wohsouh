<?php
/**
 * 
 * @param 会员数据导入类
 */

defined('IN_PHPCMS') or exit('No permission resources.');
//模型缓存路径
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
class member_import {
	private $import_db, $member_db, $phpsso_db,$queue;
	
	public function __construct() {
		$this->import_db = pc_base::load_model('import_model');
		$this->member_db = pc_base::load_model('member_model');
		$this->phpsso_db = pc_base::load_model('sso_members_model');
		$this->_init_phpsso();
		
	}
	
	/**
	 * 
	 * 会员数据导入 ...
	 * @param $val 用户数据数组
	 * @param $check_email 是否要检测EMAIL
	 */
	function add($info,$check_email) {
		if($check_email==1){
			//执行EMAIL or username 同名检测
			$username = $this->phpsso_db->get_one(array("username"=>$info['username']));
 			if($username) return false;
		}
		/*先插入phpsso_member表，生成的PHPSSOid,再用来插入mbmer基本表*/
		//判断是否存在随机码，
		$sso_array = array();
		$sso_array['username'] = $info['username'];
 		$sso_array['email'] = $info['email'];
		$sso_array['regip'] = $info['regip'];
		$sso_array['random'] = $info['encrypt'];
		$sso_array['password'] = $info['password'];
  		
		//插入SSO members 表中
 		$this->phpsso_db->insert($sso_array);
 		$sso_uid = $this->phpsso_db->insert_id();
		if(!$sso_uid) return FALSE; 
		
		//插入v9_member基本表,只需加入phpssouid值
		$info['phpssouid'] = $sso_uid;
		$userid = $this->member_db->insert($info);
		if($userid){
			return $userid;
		}
  	}
	
	/**
	 * 初始化phpsso
	 * about phpsso, include client and client configure
	 * @return string phpsso_api_url phpsso地址
	 */
	private function _init_phpsso() {
		pc_base::load_app_class('client', 'member', 0);
		define('APPID', pc_base::load_config('system', 'phpsso_appid'));
		$phpsso_api_url = pc_base::load_config('system', 'phpsso_api_url');
		$phpsso_auth_key = pc_base::load_config('system', 'phpsso_auth_key');
		$this->client = new client($phpsso_api_url, $phpsso_auth_key);
		return $phpsso_api_url;
	}
	  
}
?>