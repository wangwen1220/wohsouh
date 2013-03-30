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

class communitalbum extends admin {
	protected  $db,$priv_db;
	public $siteid,$categorys;
	public function __construct() {
	}
	
	public function init() {
		//die("22222");
		include $this->admin_tpl('community_list');
	}
	
	/**
	 * 专辑列表
	 *
	 */
	public function community_album_list(){
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		if ($_GET['search'] == "yes") {
			$classid = $_POST['classname'];
			$nickname=$_POST['nickname'];
			$classname=$_POST['classname'];
			$star_time = $_POST['start_time'];
			$end_time = $_POST['end_time'];
			$albumname = $_POST['albumname'];
			//($classid=="all") ? 0 :$classid;//获取选择分类
			if (($classid == "all") ||($classid == "")) {
				$classid = 0;
			}
			//这里判断的是搜索筛选之后的分页条件
			if($_GET['classid'] !=""){
				$classid = $_GET['classid'];
			}
			if($_GET['nickname'] !=""){
				$nickname = $_GET['nickname'];
			}
			if($_GET['start_time'] !=""){
				$start_time = $_GET['start_time'];
			}
			if($_GET['end_time'] !=""){
				$end_time = $_GET['end_time'];
			}
			if($_GET['albumname'] !=""){
				$albumname = $_GET['albumname'];
			}
			
			//print_r($classid);
			
			$datas = Community::getAlbumList($classid,0,1,$page,10,$nickname,$star_time,$end_time,$albumname);
			$page_split = new PagerSplit($datas['-msg-']['count'],$page,10,"/index.php?m=community&c=communitalbum&a=community_album_list&nickname=$nickname&classid=$classid&start_time=$start_time&end_time=$end_time&albumname=$albumname&search=yes&page={#page}");
		$page_str = $page_split->GetPagerContent();
		}else{
			$datas = Community::getAlbumList(0,0,1,$page);
			$page_split = new PagerSplit($datas['-msg-']['count'],$page);
			$page_str = $page_split->GetPagerContent();
		}
		//$count = $datas['-msg-']['count'];
		$count = count($datas['-msg-']['arr']);
		//print_r($count);
		$content = $datas['-msg-']['arr'];
		if(checkErr($datas)){
			$list_arr = $content;
			$classname = Community::getClassList();
			$class_name= $classname['-msg-']['arr'];//获取全部类别
			//print_r($class_name);
			$arr = array();
			for($i=0;$i<$count;$i++){
				$arr[$i]['id'] = $list_arr[$i]['id'];
				$arr[$i]['album_name'] = $list_arr[$i]['album_name'];
				$arr[$i]['file_count'] = $list_arr[$i]['file_count'];
				$arr[$i]['be_reply_count'] = $list_arr[$i]['be_reply_count'];
				$arr[$i]['nickname'] = $list_arr[$i]['nickname'];
				$arr[$i]['input_time'] = $list_arr[$i]['input_time'];
				$arr[$i]['recommend'] = $list_arr[$i]['recommend'];
				$arr[$i]['count'] = Community::GetAlbumCount($content[$i]['id']);
				
			}
		}else {
			echo $datas["-msg-"];
			die();
		}
		
		//$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=community&c=communityey&a=community_add_label\', title:\''.'添加标签'.'\', width:\'540\', height:\'200\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', '添加标签');
		/*$page_split = new PagerSplit($datas['-msg-']['count'],$page,10,"/index.php?m=community&c=communitalbum&a=community_album_list&menuid=1589&nickname=$nickname&classid=$classid&start_time=$start_time&end_time=$end_time&albumname=$albumname&page={#page}");
		$page_str = $page_split->GetPagerContent();*/
		$show_header = $show_validator = '';
		include $this->admin_tpl('community_album_list');
	}
	
	
	
	/**
	 * 修改专辑名称
	 *
	 */
	public function community_edit_album(){
		if (isset($_POST['dosubmit'])) {
			//$albumid = $_GET['typeid'];
			$albumid = intval($_POST['albumid']);
			$album_name = $_POST['album_name'];
			$album_discription = $_POST['album_discription'];
			Community::updateAlbum($albumid,$album_name,$album_discription,"","","","");
			showmessage(L('update_success'), '', '', 'community_edit_album');
		}else {
			$albumid = intval($_GET['typeid']);
			$datas = Community::getAlbumInfo($albumid);
			if(checkErr($datas)){
				$list_data = $datas["-msg-"];
				$list_arr = $list_data["arr"];
			}else {
				echo $datas["-msg-"];
				die();
			}
			$show_header = $show_validator = '';
			include $this->admin_tpl('community_edit_album');	
		}
		
	}
	
	
	/**
	 * 删除专辑
	 *
	 */
	public function community_del_album(){
		$album_id = array(intval($_GET['typeid']));
		Community::deleteAlbum($album_id[0]);
		echo 1;
	}
	
	
	/**
	 * 专辑评论列表
	 *
	 */
	public function community_reply_album(){
		/*if (isset($_POST['dosubmit'])) {
			//$replyid = intval($_POST['replyid']);
			//Community::deleteAlbumReply($replyid);
			//echo "修改成功";
			//showmessage(L('update_success'), '', '', 'community_edit_album');
		}else {*/
		$album_id = array(intval($_GET['album_id']));
		$datas = Community::getAlbumReply($album_id[0]);
			if(checkErr($datas)){
				$list_data = $datas["-msg-"];
				$list_arr = $list_data["arr"];
			}else {
				echo $datas["-msg-"];
				die();
			}
			$show_header = $show_validator = '';
			include $this->admin_tpl('community_album_reply');
		}
	//}
	
	
	/**
	 * 删除专辑评论
	 *
	 */
	public function community_del_reply(){

		$replyid = intval($_GET['typeid']);
		Community::deleteAlbumReply($replyid);
		echo 1;
	}
	
	/**
	 * 专辑推荐/取消推荐
	 */
	public function albumrecommend(){
		$albumid = intval($_GET['typeid']);
		if ($_GET['list'] == 1) {
			$r = Community::AlbumRecommend(1, $albumid);
		}else {
			$r = Community::AlbumRecommend(2, $albumid);
		}
		if (checkErr($r)) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	/**
	 * 专辑推荐管理
	 *
	 */
	public function community_album_position(){
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		
			$is_pos = $_GET['is_pos'];
			//print_r($is_pos);die();
			$datas = Community::getAlbumList(0,0,1,$page,10,"","","","",$is_pos);
		
		//$datas = Community::getAlbumList(0,0,1,$page);
		$count = count($datas['-msg-']['arr']);
		$content = $datas['-msg-']['arr'];
		if(checkErr($datas)){
			$list_arr = $content;
			$arr = array();
			for($i=0;$i<$count;$i++){
				$arr[$i]['id'] = $list_arr[$i]['id'];
				$arr[$i]['album_name'] = $list_arr[$i]['album_name'];
				$arr[$i]['file_count'] = $list_arr[$i]['file_count'];
				$arr[$i]['be_reply_count'] = $list_arr[$i]['be_reply_count'];
				$arr[$i]['nickname'] = $list_arr[$i]['nickname'];
				$arr[$i]['input_time'] = $list_arr[$i]['input_time'];
				$arr[$i]['recommend'] = $list_arr[$i]['recommend'];
				$arr[$i]['count'] = Community::GetAlbumCount($content[$i]['id']);
				
			}
		}else {
			echo $datas["-msg-"];
			die();
		}
		$page_split = new PagerSplit($datas['-msg-']['count'],$page);
		$page_str = $page_split->GetPagerContent();
		include $this->admin_tpl('community_album_pos_list');

	}
}
?>