<?php
defined('IN_PHPCMS') or exit('No permission resources.');
//模型缓存路径
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
//定义在单独操作内容的时候，同时更新相关栏目页面
define('RELATION_HTML',true);
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php";

pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('form','',0);
pc_base::load_app_func('util');
pc_base::load_sys_class('format','',0);

class communityreport extends admin {
	protected  $db,$priv_db;
	public $siteid,$categorys;
	public function __construct() {
	}
	
	public function init() {
		echo '1111wjy';
		die("22222");
		include $this->admin_tpl('community_list');
	}
	
	/**
	 * 举报列表
	 *
	 */
	public function community_report_list(){
		$datas = Community::getReportList();//举报列表
		if (empty($datas)){
			echo "暂时没有举报内容";
		}
		include $this->admin_tpl('community_report_list');
	}
}
?>