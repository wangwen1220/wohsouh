<?php
defined('IN_PHPCMS') or exit('No permission resources.');
//模型原型存储路径
define('MODEL_PATH',PC_PATH.'modules'.DIRECTORY_SEPARATOR.'content'.DIRECTORY_SEPARATOR.'fields'.DIRECTORY_SEPARATOR);
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

class communityey extends admin {
	protected  $db,$priv_db;
	public $siteid,$categorys;
	public function __construct() {
		//parent::__construct();
//		$this->db = pc_base::load_model('community_model');
//		$this->siteid = $this->get_siteid();
//		$this->categorys = getcache('category_community_'.$this->siteid,'commons');
//		//权限判断
//		if(isset($_GET['catid']) && $_SESSION['roleid'] != 1 && ROUTE_A !='pass' && strpos(ROUTE_A,'public_')===false) {
//			$catid = intval($_GET['catid']);
//			$this->priv_db = pc_base::load_model('category_priv_model');
//			$action = $this->categorys[$catid]['type']==0 ? ROUTE_A : 'init';
//			//$priv_datas = $this->priv_db->get_one(array('catid'=>$catid,'is_admin'=>1,'action'=>$action));
//			//if(!$priv_datas) showmessage(L('permission_to_operate'),'blank');
//		}
	}
	
	public function init() {
		echo '1111';
		die("22222");
		include $this->admin_tpl('community_list');
	}
	
	/**
	 * 分类排序
	 */
	public function community_class_listorder(){
		$data = $_POST[listorders];
		Community::Add_Class_Listorder($data);
		header("Location: /index.php?m=community&c=communityey&a=community_class_list&pc_hash=".$_SESSION['pc_hash']);
	}
	
	/**
	 * 分类列表
	 *
	 */
	public function community_class_list(){
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$datas = Community::getClassList($page,20);
		if(checkErr($datas)){
			$class_list = $datas["-msg-"];
			$list_arr = $class_list["arr"];
			$page_split = new PagerSplit($class_list["num"],$page,20);
			$page_str = $page_split->GetPagerContent();
		}else {
			echo $datas["-msg-"];
			die();
		}
		$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=community&c=communityey&a=community_add_class\', title:\''.'添加分类'.'\', width:\'540\', height:\'150\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', '添加分类');
		include $this->admin_tpl('community_class_list');
	}
	
	/**
	 * 关联标签
	 *
	 */
	public function community_class_associated_label(){
		if (($_GET['createclass'])=="yes") {
			$classid = $_GET['typeid'];//分类ID
			$tagid = $_POST['data'];
			$count = count($tagid);
			for($i=0;$i<$count;$i++) {
				Community::createClassTagMap($classid,$tagid[$i]);
			}
			echo 1;
		}else {
//			print_r($_POST);
			$tag_name = empty($_POST['tag_name']) ? 0:$_POST['tag_name'];
			
			$classid = $_GET['typeid'];//分类ID
			$datas = Community::getTagList(0,$tag_name,0,1,5000);
			$r = Community::getClassTagMap($classid);
			$taglist = $r['-msg-'];//已选择的标签
			if (checkErr($datas)) {
				$class_list = $datas["-msg-"]["arr"];//可选择标签
			}else {
				echo $datas["-msg-"];
				die();
			}
			include $this->admin_tpl('community_class_associated_label');
		}
	}
	
	//关联标签列表
	public function community_class_tagdata_item(){
		$classid = intval($_GET['classid']);
		$order = empty($_GET['order']) ? "listorder ASC":"num ". $_GET['order'];
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$keyword = empty($_POST['keyword']) ? "":$_POST['keyword'];
		$r = Community::getClassTagMapAdmin($classid,$page,20,$order,$keyword);
		$datas = $r['-msg-']["arr"];
		$num = $r['-msg-']["num"];
		$page_split = new PagerSplit($num,$page,20);
		$page_str = $page_split->GetPagerContent();	

		include $this->admin_tpl('community_class_tagdata_item');

	}
	//删除分类与标签映射关系
	public function community_del_class_tag(){
		$classid = $_GET['classid'];
		$tagid = $_GET['typeid'];
		Community::deleteClassTagMap($classid,$tagid);
		echo 1;
	}
	
	/**
	 * 分类标签排序
	 */
	public function community_class_tag_listorder(){
		$data = $_POST[listorders];
		$classid =  $_GET[classid];
		Community::Add_Class_Tag_Listorder($data,$classid);
		header("Location: /index.php?m=community&c=communityey&a=community_class_tagdata_item&classid=$classid&pc_hash=".$_SESSION['pc_hash']);
	}
	
	
	/**
	 * 添加分类
	 *
	 */
	public function community_add_class(){
		if(isset($_POST['dosubmit'])) {
//			if (!$_FILES['image']['name']) {
//				$image = $_POST['image'];
//			}else{		
//				$upload_size = $_FILES["image"]["size"];
////				$upload_filetype = $_FILES["image"]["type"]; //获取文件类型
////				$max_size = 102400;
//				$uploaddir = "community_uplad/class_pic"; //指定文件存储路径
//				if (!file_exists($uploaddir)) mkdir($uploaddir, 0777, 1 );
//				$image = $uploaddir.'/'.time().$_FILES['image']['name'];	
//				if(!copy($_FILES['image']['tmp_name'], $image)) {	
//					die('上传失败');
//				}
//			}
			$image = "";
			$datas = Community::createClass($_POST['name'],$image);
			showmessage(L('add_success'), '', '', 'add');
//			showmessage(L('add_success'), '', '', 'community_add_class');
		}else {
			$show_header = $show_validator = '';
			include $this->admin_tpl('community_add_class');
		}
	}
	
	/**
	 * 修改分类
	 *
	 */
	public function community_edit_class(){
		if (isset($_POST['dosubmit'])) {
			$classid = $_POST['classid'];
//			if (!$_FILES['image']['tmp_name']) {
//				$image = $_POST['himage'];
//			}else{		
//				$uploaddir = "community_uplad/class_pic"; //指定文件存储路径
//				if (!file_exists($uploaddir)) mkdir($uploaddir, 0777, 1 );
//				$image = $uploaddir.'/'.$_FILES['image']['name'];	
//				if(!copy($_FILES['image']['tmp_name'], $image)) {	
//					die('上传失败');
//				}
//			}
			$image = "";
			$h_name = $_POST['h_name'];
			Community::updateClass($classid,$_POST['name'],$image,$h_name);
			showmessage(L('update_success'), '', '', 'edit');
		}else {
			$classid = intval($_GET['typeid']);
			$datas = Community::getClassInfo($classid);
			if (checkErr($info)) {
				$class_list = $datas["-msg-"];
				$list_arr = $class_list["arr"];
				//print_r($list_arr);
			}else {
				echo $datas["-msg-"];
				die();
			}
			$show_header = $show_validator = '';
			include $this->admin_tpl('community_edit_class');
		}
	}
	
	/**
	 * 分类删除
	 *
	 */
	public function community_del_class(){
		$classid = intval($_GET['typeid']);
		$data = Community::deleteClass($classid);
		echo 1;
	}
	
	/**
	 * 标签列表
	 *
	 */
	public function community_label_list(){
//		if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
			$searchtype = $_GET['searchtype'];
			$keyword = $_GET['keyword'];
			$hot = $_GET['hot'];
			$start_time = $_GET['start_time'];
			$end_time = $_GET['end_time'];
//		}
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$datas = Community::getTagList_Admin($searchtype,$keyword,0,$page,20,$hot,$start_time,$end_time);
		if(checkErr($datas)){
			$list_arr = $datas["-msg-"]["arr"];
			$page_split = new PagerSplit($datas["-msg-"]["num"],$page,20);
			$page_str = $page_split->GetPagerContent();
		}else {
			echo $datas["-msg-"];
			die();
		}
		$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=community&c=communityey&a=community_add_label\', title:\''.'添加标签'.'\', width:\'540\', height:\'300\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', '添加标签');
		include $this->admin_tpl('community_label_list');	
	}
	
	/**
	 * 添加标签
	 *
	 */
	public function community_add_label(){
		if(isset($_POST['dosubmit'])){
			$tmp=explode(',',$_POST['name']);
			$arr=array();
			foreach($tmp as $t) {
				$arr = explode('|',$t);
			}
			Community::AdminCreateTag($arr,0);
			showmessage(L('add_success'), '', '', 'add');
		}else {
			$show_header = $show_validator = '';
			include $this->admin_tpl('community_add_label');
		}
	}
	
	/**
	 * 修改标签
	 *
	 */
	public function community_edit_label(){
		if (isset($_POST['dosubmit'])) {
			$tagid = $_POST['tagid'];
			$tag_name = $_POST['name'];
			$h_name = $_POST['h_name'];
			Community::updateTga($tagid,$tag_name,$h_name);
			showmessage(L('update_success'), '', '', 'edit');
		}else {
			$tagid = intval($_GET['typeid']);
			$datas = Community::getTagInfo($tagid);
			if(checkErr($datas)){
				$list_data = $datas["-msg-"];
				$list_arr = $list_data["arr"];
			}else {
				echo $datas["-msg-"];
				die();
			}
			$show_header = $show_validator = '';
			include $this->admin_tpl('community_edit_label');	
		}
		
	}
	
	/**
	 * 删除标签
	 *
	 */
	public function community_del_label(){
		$tagid = array(intval($_GET['typeid']));
		Community::deleteTag($tagid);
		echo 1;
	}
	
	
	/**
	 * 分类是否存在	1为存在，0为可添加
	 */
	public function ajax_classname_exist(){
		$classname = $_GET['name'];
		$data = Community::getClassNameIsExist($classname);
		echo $data;
		
	}
	
	/**
	 * 标签是否存在	1为存在，0为可添加
	 */
	public function ajax_tagname_exist(){
		$tagname = $_GET['name'];
		$tmp=explode(',',$tagname);
		$arr=array();
		foreach($tmp as $t) {
			$arr = explode('|',$t);
		}
//		print_r($arr);
//		$data = Community::getTagNameIsExist($arr);
		echo 0;
	}
	

}
?>