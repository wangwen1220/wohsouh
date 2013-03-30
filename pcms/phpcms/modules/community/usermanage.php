<?php
defined('IN_PHPCMS') or exit('No permission resources.');
//模型缓存路径
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
//定义在单独操作内容的时候，同时更新相关栏目页面
define('RELATION_HTML',true);
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php";
require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php";

pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('form','',0);
pc_base::load_app_func('util');
pc_base::load_sys_class('format','',0);

class usermanage extends admin {
	protected  $db,$priv_db;
	public $siteid,$categorys;
	public function __construct() {
		
	}
	
	public function init() {
		$list_menu = '<a class="on" href="?m=community&c=usermanage&a=init"><em>会员列表</em></a> | <a class="on" href="?m=community&c=usermanage&a=recommend_list"><em>推荐会员</em></a> | <a class="on" href="?m=community&c=usermanage&a=user_private_msg"><em>会员私信</em></a>';
		$page = empty($_GET['page']) ? 1:$_GET['page'];
		$per_page = 20;
		if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
			$searchtype = intval($_GET['searchtype']);
			$keyword = $_GET['keyword'];
		}
		$data_arr = Community::getAllUserInfo($searchtype,$keyword,$page,$per_page);
		$datas = $data_arr[arr];
		$num = $data_arr[num];
		$page_split = new PagerSplit($num,$page,$per_page);
		$page_str = $page_split->GetPagerContent();
		
		$show_header = $show_validator = '';
		include $this->admin_tpl('community_user_manage');
	}
	
	/**
	 * 推荐会员列表
	 */
	public function recommend_list(){
		$list_menu = '<a class="on" href="?m=community&c=usermanage&a=init"><em>会员列表</em></a> | <a class="on" href="?m=community&c=usermanage&a=recommend_list"><em>推荐会员</em></a> | <a class="on" href="?m=community&c=usermanage&a=user_private_msg"><em>会员私信</em></a>';
		$page = empty($_GET['page']) ? 1:$_GET['page'];
		//$pre_page = 20;
		if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
			$searchtype = intval($_GET['searchtype']);
			$keyword = $_GET['keyword'];
		}
		$data_arr = Community::getAllUserInfo($searchtype,$keyword,$page,20,1);
		$datas = $data_arr[arr];
		$num = $data_arr[num];
		$page_split = new PagerSplit($num,$page,20);
		$page_str = $page_split->GetPagerContent();
		$show_header = $show_validator = '';
		include $this->admin_tpl('recommend_list');
	}
	
	/**
	 * 会员私信列表
	 */
	public function user_private_msg(){
		$list_menu = '<a class="on" href="?m=community&c=usermanage&a=init"><em>会员列表</em></a> | <a class="on" href="?m=community&c=usermanage&a=recommend_list"><em>推荐会员</em></a> | <a class="on" href="?m=community&c=usermanage&a=user_private_msg"><em>会员私信</em></a>';
		$page = empty($_GET['page']) ? 1:$_GET['page'];
		if (isset($_GET['start_time']) && !empty($_GET['start_time'])) {
			$start_time = $_GET['start_time'];
		}
		if (isset($_GET['end_time']) && !empty($_GET['end_time'])) {
			$end_time = $_GET['end_time'];
		}
		if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
			$keyword = $_GET['keyword'];
		}
		$data_arr = Community::getAllUserPrivateMail($keyword,$start_time,$end_time,$page,20);
		$datas = $data_arr[arr];
		$num = $data_arr[num];
		$page_split = new PagerSplit($num,$page,20);
		$page_str = $page_split->GetPagerContent();
		
		$show_header = $show_validator = '';
		include $this->admin_tpl('user_private_msg');
	}
	
	/**
	 * 删除私信
	 */
	public function del_user_msg(){
		$arr = $_POST[ids];
		Community::delUserMsg($arr);
		echo 1;
	}
	
	/**
	 * 取消所有的推荐会员
	 */
	public function canceled_all_recommend(){
		$arr = $_POST[ids];
		Community::CanceledAllRecommendUser($arr);
	}
	
	/**
	 * 推荐会员，取消会员
	 */
	public function recommend(){
		$uid = $_GET['typeid'];
		if ($_GET['list'] == 1) {
			$r = Community::UserRecommend(1, $uid);
		}else {
			$r = Community::UserRecommend(2, $uid);
		}
		if (checkErr($r)) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
}
	