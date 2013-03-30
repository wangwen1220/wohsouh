<?php
/*
 * 火秀新社区相关操作封装
 * @author chengkui
 *
 */
defined('IN_PHPCMS') or exit('No permission resources.');
//模型原型存储路径
define('MODEL_PATH',PC_PATH.'modules'.DIRECTORY_SEPARATOR.'content'.DIRECTORY_SEPARATOR.'fields'.DIRECTORY_SEPARATOR);
//模型缓存路径
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
define('RELATION_HTML',true);

require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/DataBase.php";
require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/weibo.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php";

pc_base::load_app_class('admin','admin',0);

class position extends admin {
	
	protected  $db,$priv_db;
	public $siteid,$categorys;
	function __construct() {
		//parent::__construct();
//		$this->db = pc_base::load_model('sitemodel_model');
//		$this->siteid = $this->get_siteid();
//		if(!$this->siteid) $this->siteid = 1;
	}
	
	/**
	 * 获取推荐位列表
	 */
	public function init(){
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$r = Community::getPositionList(0,1,'desc',$page,20);
		$datas = $r["arr"];
		$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=community&c=position&a=add\', title:\''.'添加推荐位'.'\', width:\'540\', height:\'200\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', '添加推荐位');
		$page_split = new PagerSplit($r["num"],$page,20);
		$page_str = $page_split->GetPagerContent();
		include $this->admin_tpl('community_pos_list');
	}
	
	public function listorder(){
		$data = $_POST[listorders];
		$posid = intval($_GET['posid']);
		Community::Add_Pos_Listorder($data);
		header("Location: /index.php?m=community&c=position&a=posdata_item&posid=$posid&pc_hash=".$_SESSION['pc_hash']);
	}
	
	public function add(){
		if(isset($_POST['dosubmit'])) {
			$name = $_POST['name'];
			$max = $_POST['max'];
			$order = $_POST['listorder'];
			$data = Community::AddEditPosition(0, $name, $max, $order);
			showmessage(L('add_success'), '', '', 'add');
		}else {
			$show_header = $show_validator = '';
			include $this->admin_tpl('community_add_pos');
		}
	}
	
	public function edit(){
		if (isset($_POST['dosubmit'])) {
			$posid = $_POST['posid'];
			$name = $_POST['name'];
			$max = $_POST['max'];
			$order = $_POST['listorder'];
			$data = Community::AddEditPosition($posid,$name, $max, $order);
			showmessage(L('add_success'), '', '', 'edit');
		}else {
			$posid = intval($_GET['typeid']);
			$r = Community::getPositionList($posid,1);
			$datas = $r["arr"];
			$show_header = $show_validator = '';
			include $this->admin_tpl('community_edit_pos');
		}
	}
	
	public function del(){
		$posid = intval($_GET['typeid']);
		Community::delPosition($posid);
		echo 1;
	}
	
	/**
	 * 推荐下的数据列表
	 */
	public function posdata_item(){
		$posid = intval($_GET['posid']);
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$r = Community::getPositionDataList($posid, 2, 'desc', $page, 20);
		$datas = $r["arr"];
		$page_split = new PagerSplit($r["num"],$page,20);
		$page_str = $page_split->GetPagerContent();	
		$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=community&c=position&a=add\', title:\''.'添加推荐位'.'\', width:\'540\', height:\'200\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', '添加推荐位');
		include $this->admin_tpl('community_posdata_item');
	}
	
	/**
	 * 已经选取信息
	 */
	public function posdata_select(){
		$posid = intval($_GET['typeid']);
		$page = empty($_GET['page']) ? '1':$_GET['page'];

		$datas = Community::getPositionGatherInfo(1);
		
		$r = Community::getPositionDataList($posid, 2, 'desc', $page, 20);
		$datas_list = $r["arr"];
		include $this->admin_tpl('community_posdata_select');
	}
	
	/**
	 * 删除已选择数据
	 */
	public function del_posdata_select(){
		$posid = intval($_GET['typeid']);
		Community::delPositionData($posid);
		echo 1;
	}
	
	
	/**
	 * ajax获取要选取信息
	 */
	public function posdata_select_info(){
//		$page = empty($_GET['page']) ? '1':$_GET['page'];	
		$list = empty($_GET['list']) ? 1:$_GET['list'];
		if ($list == 1) {	//分类
			$arr = Community::getPositionGatherInfo($list);
		}elseif ($list == 2){	//标签
			$arr = Community::getPositionGatherInfo($list);
		}elseif ($list == 3){	//专辑
			$arr = Community::getPositionGatherInfo($list);
		}	
		
		foreach ($arr as $k=>$v){
			echo '<tr title="点击选择" onclick="select_list(this,\''.$v[name].'\',\''.$v[id].'\',\''.$v[url].'\')">';
			echo '<td align="center">'.$v[id].'</td>';
			echo '<td align="center">'.$v[name].'<input type="hidden" class="classid" name="classid" value="'.$v[url].'"/></td>';
			echo '</tr>';
		}
	}
	
	/**
	 * 添加推荐位信息
	 */
	public function add_position_data(){
		$datas = $_POST[data];
		$posid = intval($_GET['posid']);
		$data = Community::Add_pos_data_news($datas, $posid, $classid);
		if (checkErr($data)){
			echo 1;
		}
	}
		
}

