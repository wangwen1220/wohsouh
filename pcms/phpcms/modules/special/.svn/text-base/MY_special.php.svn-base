<?php 
defined('IN_PHPCMS') or exit('No permission resources.');
require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php";

class MY_special extends special {
	function __construct() {
		parent::__construct();
		$this->siteid = $this->get_siteid();
		$this->categorys = getcache('category_content_'.$this->siteid,'commons');
	}
	
	/**
	 * 专题列表
	 */
	public function init() {
//		require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php";
		$list_menu = '<a class="on" href="?m=special&c=special&a=special_property_list"><em>专题属性</em></a> | <a class="on" href="?m=special&c=special&a=special_position_list"><em>专题推荐</em></a>';
//		$page = max(intval($_GET['page']), 1);
		$page = empty($_GET['page']) ? 1:$_GET['page'];
		$recordPerPage = 10;
		$tree = pc_base::load_sys_class('tree');
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		$categorys = array();
		if(!empty($this->categorys)) {
			foreach($this->categorys as $catid=>$r) 
			{
				if($this->siteid != $r['siteid'] || ($r['type']==2 && $r['child']==0)) continue;
				if($modelid && $modelid != $r['modelid']) continue;

				//如果没有子栏目并且不是顶级类，则不能选择
				if($r['child']==0 && $r["parentid"]!=0){
					$r["disabled"] = "disabled";
				}else {
					$categorys[$catid] = $r;
				}
			}
		}

		$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$tree->init($categorys);
		$string .= $tree->get_tree(0, $str);
		
		$sp_type = empty($_GET[catids]) ? "":"AND b.cat_id = '$_GET[catids]'";
		$letters = ($_GET['letters'] =="ASC") ? "letters ASC":"letters DESC";
		$username = empty($_GET['username']) ? "":"AND username= '$_GET[username]'";
		$title = empty($_GET['title']) ? "":"AND title ='$_GET[title]'";
//		$infos = $this->db->listinfo("siteid =1", ' `listorder` DESC, `id` DESC', $page, 6);
//		print_r($infos);
		$num_sql = "SELECT count(*) as num FROM v9_special a LEFT JOIN v9_special_category_map b ON a.id=b.special_id WHERE a.siteid =1 $username $title $sp_type ORDER BY $letters ";
		$num_arr = $this->db->sselect($num_sql);
		$num_count = $num_arr[0][num];
		$sql = "SELECT a.*,b.cat_id FROM v9_special a LEFT JOIN v9_special_category_map b ON a.id=b.special_id WHERE a.siteid =1 $username $title $sp_type ORDER BY $letters limit ".($page-1)*$recordPerPage.",$recordPerPage";
		$infos = $this->db->sselect($sql);
		$page_split = new PagerSplit($num_count,$page,$recordPerPage);
		$page_str = $page_split->GetPagerContent();
		pc_base::load_sys_class('format', '', 0);
		include $this->admin_tpl('special_list');
	}
					

	/**
	 * 添加专题
	 */
	public function add() {
		if (isset($_POST['dosubmit']) && !empty($_POST['dosubmit'])) {
			$special = $this->check($_POST['special']);
//			print_r($_POST);
			if(!empty($_POST["cssfile"]))
				$special["css_file"] = $_POST["cssfile"];
				$special["top_title"] = $_POST["top_title"];
				$special["keyword"] = $_POST["keyword"];
				$special["property_type"] = $_POST["propertytype"];
				$special["letters"] = $_POST["letters"];
				$special["game_state"] = $_POST["game_state"];
				$special["developers"] = $_POST["developers"];
				$special["operators"] = $_POST["operators"];
				$special["official"] = $_POST["official"];
//			print_r($special);
//			die();
			$id = $this->db->insert($special, true);
			if ($id) {
				//插入属性关联表		1为游戏
				if ($special["property_type"] == 1){
					$this->db->sselect("INSERT INTO v9_special_list_game_tmp SET special_id=$id,
					game_type='$_POST[property_0]',game_style='$_POST[property_1]',
					game_area='$_POST[property_2]',game_menu='$_POST[property_3]'");
				}
				$this->special_api->_update_type($id, $_POST['type']);
				$this->special_api->_update_navigate($id, $_POST['link']);
				//id,title,description,createtime,thumb
				$special_arr_tmp = $this->db->sselect("select id,title,description,createtime,thumb 
						from v9_special where id='$id'");
				$special_arr['id'] = $id;
				$special_arr['title'] = $special_arr_tmp[0]["title"];
				$special_arr['description'] = $special_arr_tmp[0]["description"];
				$special_arr['createtime'] = $special_arr_tmp[0]["createtime"];
				$special_arr['thumb'] = $special_arr_tmp[0]["thumb"];
				
				$this->updatePosInfo($special_arr,$special["posid"]);
				if ($special['siteid']>1) {
					$site = pc_base::load_app_class('sites', 'admin');
					$site_info = $site->get_by_id($special['siteid']);
					if ($special['ishtml']) {
						$url =  $site_info['domain'].'special/'.$special['filename'].'/';
					} else {
						$url = $site_info['domain'].'index.php?m=special&c=index&id='.$id;
					}
				} else {
					$url = $special['ishtml'] ? APP_PATH.substr(pc_base::load_config('system', 'html_root'), 1).'/special/'.$special['filename'].'/' : APP_PATH.'index.php?m=special&c=index&id='.$id;
				}
				$this->db->update(array('url'=>$url), array('id'=>$id, 'siteid'=>$this->get_siteid()));
				
				//调用生成静态类
				if ($special['ishtml']) {
					$html = pc_base::load_app_class('html', 'special'); 
					$html->_index($id, 20, 5);
				}
				//更新附件状态
				if(pc_base::load_config('system','attachment_stat')) {
					$this->attachment_db = pc_base::load_model('attachment_model');
					$this->attachment_db->api_update(array($special['thumb'], $special['banner']),'special-'.$id, 1);
				}
				
				//增加专题类别
				if($_POST["spicialclass"]==1)
				{
					$catids = $_POST["catids"];
					$cat_count = count($catids);
					for($i=0;$i<$cat_count;$i++)
					{
						$this->db->sselect("insert into v9_special_category_map (special_id,cat_id) 
								values ('".$id."','".$catids[$i]."')");
					}
				}
				$this->special_cache();
			}
			showmessage(L('add_special_success'), HTTP_REFERER);
		} else {
			//获取站点模板信息
			pc_base::load_app_func('global', 'admin');
			$siteid = $this->get_siteid();
			$template_list = template_list($siteid, 0);
			$site = pc_base::load_app_class('sites','admin');
			$info = $site->get_by_id($siteid);
			foreach ($template_list as $k=>$v) {
				$template_list[$v['dirname']] = $v['name'] ? $v['name'] : $v['dirname'];
				unset($template_list[$k]);
			}
			//获得推荐位信息
			$pos_arr = $this->getPosArr();
			//$specialid = $info["id"];
			$css_file = "default_blue.css";
			$content_class = pc_base::load_app_class('content_tag','content');
			$css_arr = $content_class->getSpecialCssfile(array('templatename'=>'index'));
			
			//获取属性
			$propert_arr = $this->db->sselect("SELECT * FROM v9_special_list WHERE parentid=0");
			
			//得到专题最大ID，最为生成目录
			$max_arr = $this->db->sselect("SELECT MAX(id) as max_id FROM v9_special LIMIT 1");
			$max_data = ($max_arr[0][max_id]+1);
			
			/*栏目数据引入*/
			$show_header = $show_dialog  = '';
			$admin_username = param::get_cookie('admin_username');
			$modelid = false;
			
			$tree = pc_base::load_sys_class('tree');
			$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
			$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
			$categorys = array();
			if(!empty($this->categorys)) {
				foreach($this->categorys as $catid=>$r) 
				{
					if($this->siteid != $r['siteid'] || ($r['type']==2 && $r['child']==0)) continue;
					if($modelid && $modelid != $r['modelid']) continue;

					//如果没有子栏目并且不是顶级类，则不能选择
//					if($r['child']==0 && $r["parentid"]!=0){
//						$r["disabled"] = "disabled";
//						$r["catname"] = "";
//					}else{
//						$r['disabled'] = '';
//					}
					if($r['child']==0 && $r["parentid"]!=0){
						$r["disabled"] = "disabled";
					}else {
						$categorys[$catid] = $r;
					}
				}
			}
			//var_dump($categorys);
			$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";

			$tree->init($categorys);
			$string .= $tree->get_tree(0, $str);
			
			include $this->admin_tpl('special_add');
		}
	}
	
	/**
	 * 删除专题 未执行删除操作，仅进行递归循环
	 */
	public function delete($id = 0) {
		if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id'])) && !$id) {
			showmessage(L('illegal_action'), HTTP_REFERER);
		}
		
		
		if(is_array($_POST['id']) && !$id) {
			array_map(array($this, delete), $_POST['id']);
			$this->special_cache();
			showmessage(L('operation_success'), HTTP_REFERER);
		} elseif(is_numeric($id) && $id) {
			$id = $_GET['id'] ? intval($_GET['id']) : intval($id);
			$this->special_api->_del_special($id);
			$this->special_api->_del_special_link($id);
			$this->db->sselect("delete from v9_special_category_map where special_id='$id'");
			$this->db->sselect("DELETE FROM v9_special_list_game_tmp WHERE special_id='$id'");
			return true;
		} else {
			$id = $_GET['id'] ? intval($_GET['id']) : intval($id);
			$this->special_api->_del_special($id);
			$this->db->sselect("delete from v9_special_category_map where special_id='$id'");
			$this->db->sselect("DELETE FROM v9_special_list_game_tmp WHERE special_id='$id'");
			showmessage(L('operation_success'), HTTP_REFERER);
		}
	}
	
	/**
	 * 专题修改
	 */
	public function edit() {
		if (!isset($_GET['specialid']) || empty($_GET['specialid'])) {
			showmessage(L('illegal_action'), HTTP_REFERER);
		}
		$_GET['specialid'] = intval($_GET['specialid']);
		if (isset($_POST['dosubmit']) && !empty($_POST['dosubmit'])) {
			$special = $this->check($_POST['special'], 'edit');
			if(!empty($_POST["cssfile"]))
				$special["css_file"] = $_POST["cssfile"];
			$special["top_title"] = $_POST["top_title"];
			$special["keyword"] = $_POST["keyword"];
			$special["letters"] = $_POST["letters"];
			$special["game_state"] = $_POST["game_state"];
			$special["developers"] = $_POST["developers"];
			$special["operators"] = $_POST["operators"];
			$special["official"] = $_POST["official"];
			$siteid = get_siteid();
			$site = pc_base::load_app_class('sites', 'admin');
			$site_info = $site->get_by_id($siteid);
			if ($special['ishtml'] && $special['filename']) {
				if ($siteid>1) {
					$special['url'] =  $site_info['domain'].'special/'.$special['filename'].'/';
				} else {
					$special['url'] = APP_PATH.substr(pc_base::load_config('system', 'html_root'), 1).'/special/'.$special['filename'].'/';
				}
			} elseif ($special['ishtml']=='0') {
				if ($siteid>1) {
					$special['url'] = $site_info['domain'].'index.php?m=special&c=index&specialid='.$_GET['specialid'];
				} else {
					$special['url'] = APP_PATH.'index.php?m=special&c=index&specialid='.$_GET['specialid'];
				}
			}
			$this->db->update($special, array('id'=>$_GET['specialid'], 'siteid'=>$this->get_siteid()));
			$this->special_api->_update_type($_GET['specialid'], $_POST['type'], 'edit');
			$this->special_api->_update_navigate($_GET['specialid'], $_POST['link'],'edit');
			$special_arr_tmp = $this->db->sselect("select id,title,description,createtime,thumb
					from v9_special where id='".$_GET['specialid']."'");
			$special_arr['id'] = $_GET['specialid'];
			$special_arr['title'] = $special_arr_tmp[0]["title"];
			$special_arr['description'] = $special_arr_tmp[0]["description"];
			$special_arr['createtime'] = $special_arr_tmp[0]["createtime"];
			$special_arr['thumb'] = $special_arr_tmp[0]["thumb"];
			
			$this->updatePosInfo($special_arr,$_POST["specialposidarr"]);
			
			//调用生成静态类
			if ($special['ishtml']) {
				$html = pc_base::load_app_class('html', 'special');
				$html->_index($_GET['specialid'], 20, 5);
			}
			//更新附件状态
			if(pc_base::load_config('system','attachment_stat')) {
				$this->attachment_db = pc_base::load_model('attachment_model');
				$this->attachment_db->api_update(array($special['thumb'], $special['banner']),'special-'.$_GET['specialid'], 1);
			}
			
			//增加专题类别
			if($_POST["spicialclass"]==1)
			{
				$catids = $_POST["catids"];
				$cat_count = count($catids);
				$this->db->sselect("delete from v9_special_category_map where special_id='".$_GET['specialid']."'");
				for($i=0;$i<$cat_count;$i++)
				{
					$this->db->sselect("insert into v9_special_category_map (special_id,cat_id)
							values ('".$_GET['specialid']."','".$catids[$i]."')");
				}
			}
			else
			{
				$this->db->sselect("delete from v9_special_category_map where special_id='".$_GET['specialid']."'");
			}
			
			$this->special_cache();
			showmessage(L('edit_special_success'), HTTP_REFERER);
		} else {
			$info = $this->db->get_one(array('id'=>$_GET['specialid'], 'siteid'=>$this->get_siteid()));
			//获得当前专题的可选css列表
			//$css_file_arr = $this->getCssfileFromSpecialname($info["index_template"]);
			//获得推荐位信息
			$pos_arr = $this->getPosArr();
			
			$specialid = $info["id"];
			$css_file = $info["css_file"];
			$content_class = pc_base::load_app_class('content_tag','content');
			$css_arr = $content_class->getSpecialCssfile(array('specialid'=>$specialid));
			
			//获取属性
			$propert_arr = $this->db->sselect("SELECT * FROM v9_special_list WHERE parentid=0");
			//获取专题属性
			$property_type = $info["property_type"];
			$ispropert_arr = $this->db->sselect("SELECT * FROM v9_special_list WHERE id=$property_type");
			if (count($ispropert_arr)){
				$dbarr = $this->db->sselect("SELECT id,parentid,`name` AS list_name FROM v9_special_list WHERE parentid=".$ispropert_arr[0]['id']);
				$propert_data_arr = $this->db->sselect("SELECT * FROM v9_special_list_game_tmp WHERE special_id=$specialid");	
			}
			
			//获取站点模板信息
			pc_base::load_app_func('global', 'admin');
			$template_list = template_list($this->siteid, 0);
			foreach ($template_list as $k=>$v) {
				$template_list[$v['dirname']] = $v['name'] ? $v['name'] : $v['dirname'];
				unset($template_list[$k]);
			}
			if ($info['pics']) {
				$pics = explode('|', $info['pics']);
			}
			if ($info['voteid']) {
				$vote_info = explode('|', $info['voteid']);
			}
			$type_db = pc_base::load_model('type_model');
//			$types = $type_db->select(array('module'=>'special', 'parentid'=>$_GET['specialid'], 'siteid'=>$this->get_siteid()), '`typeid`, `name`, `listorder`, `typedir`', '', '`listorder` ASC, `typeid` ASC');
			$types = $type_db->select(array('module'=>'special', 'parentid'=>$_GET['specialid'], 'siteid'=>$this->get_siteid()), '`typeid`, `name`, `listorder`, `typedir`, `template`, `navigation`', '','`listorder` ASC, `typeid` ASC');
			
			$link_db = pc_base::load_model('special_navigate_model');
			$link_arr = $link_db->sselect("select id,special_id,navigation_name,link,`order`
											from v9_special_navigation
											where special_id='$specialid'
											order by `order` desc ");
			
			//获得专题推荐位信息
			$special_pos_arr_tmp = $link_db->sselect("SELECT posid 
					FROM v9_position_data 
					WHERE id='$specialid' AND modelid='-1'");
			for($i=0;$i<count($special_pos_arr_tmp);$i++)
			{
				$special_pos_arr[$special_pos_arr_tmp[$i]["posid"]] = "yes";
			}
			//获得专题与栏目对应关系
			$special_cat_map_arr = $this->db->sselect("select special_id,cat_id from v9_special_category_map where special_id='".$_GET['specialid']."'");
			$spacial_cat_map_count = count($special_cat_map_arr);
			for($i=0;$i<$spacial_cat_map_count;$i++)
			{
				$tmp_map[$special_cat_map_arr[$i][cat_id]] = $special_cat_map_arr[$i][special_id];
			}
			/*栏目数据引入*/
			$show_header = $show_dialog  = '';
			$admin_username = param::get_cookie('admin_username');
			$modelid = false;
				
			$tree = pc_base::load_sys_class('tree');
			$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
			$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
			$categorys = array();
			if(!empty($this->categorys))
			{
				foreach($this->categorys as $catid=>$r)
				{
					if($this->siteid != $r['siteid'] || ($r['type']==2 && $r['child']==0))
						continue;
					if($modelid && $modelid != $r['modelid'])
						continue;
			
					//如果没有子栏目并且不是顶级类，则不能选择
//					if($r['child']==0 && $r["parentid"]!=0)
//						$r["disabled"] = "disabled";
//					else
//						$r['disabled'] = '';
					if(!empty($tmp_map[$catid]))
						$r['selected'] = "selected";
					else
						$r['selected'] = '';
					if($r['child']==0 && $r["parentid"]!=0){
						$r["disabled"] = "disabled";
					}else {
						$categorys[$catid] = $r;
					}	
//					$categorys[$catid] = $r;
				}
			}
			//var_dump($categorys);
			$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
			
			$tree->init($categorys);
			$string .= $tree->get_tree(0, $str);
			include $this->admin_tpl('special_edit');
		}
	}
	
	
	/**
	 * 获取推荐位数组
	 */
	private function getPosArr()
	{
		/*获得推荐位信息*/
		$pos_arr = $this->db->sselect("SELECT posid,`name` from v9_position WHERE is_zhuanti='1' ORDER BY listorder DESC");
		return $pos_arr;
	}
	
	
	/**
	 * 把专题内容推送到推荐位中
	 * $special_info 专题信息
	 * @param unknown_type $posarr 推荐位数组
	 */
	private function updatePosInfo($special_info,$posarr)
	{
		$this->db->sselect("delete from v9_position_data
				where id='".$special_info["id"]."' and modelid='-1'");
		if(is_array($posarr) && count($posarr)>0)
		{
			
		
			foreach($posarr as $k=>$v)
			{
				if(!is_numeric($v) || $v<0)
					continue;
				$tmp['title'] = $special_info['title'];
				$tmp['description'] = $special_info['description'];
				$tmp['inputtime'] = $special_info['createtime'];
				$tmp['thumb'] = $special_info['thumb'];
				$tmp['style'] = '';
				$tmp_str = addslashes(var_export($tmp,true));
				$thumb_add = empty($special_info["thumb"])?0:1;
				$sql = "insert into v9_position_data (id,posid,modelid,thumb,`data`,siteid)
						values ('".$special_info["id"]."','$v','-1',
						'$thumb_add','$tmp_str',
						'".$this->get_siteid()."')";
				$this->db->sselect($sql);
			}
		}
	}
	
	/**
	 *	专题列表
	 */
	public function special_property_list(){
		$list_menu = '<a class="on" href="?m=special&c=special&a=init"><em>专题</em></a> | <a class="on" href="?m=special&c=special&a=special_property_list"><em>专题属性</em></a>';
		$list_arr = $this->db->sselect("SELECT * FROM v9_special_list WHERE parentid=0");
		$show_header = $show_validator = '';
		include $this->admin_tpl('special_property_list');
	}
	
	/**
	 * 专题添加分类
	 */
	public function special_add_class(){
		if(isset($_POST['dosubmit'])) {
			$name = $_POST['name'];
			$this->db->sselect("INSERT INTO v9_special_list SET `name`='$name',parentid=0");
			showmessage(L('add_success'), '', '', 'add');
		}else{
			$show_header = $show_validator = '';
			include $this->admin_tpl('special_add_class');
		}
	}
	
	/**
	 * 专题修改分类
	 */
	public function special_edit_class(){
		if(isset($_POST['dosubmit'])) {
			$id = $_POST['id'];
			$name = $_POST['name'];
			$this->db->sselect("UPDATE v9_special_list SET `name`='$name' WHERE id=$id");
			showmessage(L('update_success'), '', '', 'edit');
		}else{
			$typeid = $_GET['typeid'];
			$datas = $this->db->sselect("SELECT * FROM v9_special_list WHERE id=$typeid");
			$show_header = $show_validator = '';
			include $this->admin_tpl('special_edit_class');
		}
	}
	
	/**
	 *	专题类型列表
	 */
	public function special_type_list(){
		$type_id = $_GET[id];
		$list_menu = '<a class="on" href="?m=special&c=special&a=init"><em>专题</em></a> | <a class="on" href="?m=special&c=special&a=special_property_list"><em>专题属性</em></a>';
		$list_arr = $this->db->sselect("SELECT * FROM v9_special_list WHERE parentid=$type_id");
//		$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=special&c=special&a=special_add_type\', title:\''.'添加类型'.'\', width:\'540\', height:\'150\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', '添加类型');
		$show_header = $show_validator = '';
		include $this->admin_tpl('special_type_list');
	}
	
	/**
	 *	专题添加类型
	 */
	public function special_add_type(){
		if(isset($_POST['dosubmit'])) {
			$name = $_POST['name'];
			$typeid = $_POST['typeid'];
			$this->db->sselect("INSERT INTO v9_special_list SET `name`='$name',parentid=$typeid");
			showmessage(L('add_success'), '', '', 'add');
		}else{
			$typeId =  $_GET['typeid'];
			$show_header = $show_validator = '';
			include $this->admin_tpl('special_add_type');
		}
	}
	
	
	/**
	 *	专题属性列表
	 */
	public function special_property_last_list(){
		$type_id = $_GET[id];
		$list_menu = '<a class="on" href="?m=special&c=special&a=init"><em>专题</em></a> | <a class="on" href="?m=special&c=special&a=special_property_list"><em>专题属性</em></a>';
		$list_arr = $this->db->sselect("SELECT * FROM v9_special_list_data WHERE `type`=$type_id");
		$show_header = $show_validator = '';
		include $this->admin_tpl('special_property_last_list');
	}
	
	/**
	 *	专题添加属性
	 */
	public function special_add_property(){
		if(isset($_POST['dosubmit'])) {
			$name = $_POST['name'];
			$typeid = $_POST['typeid'];
			$this->db->sselect("INSERT INTO v9_special_list_data SET `name`='$name',`type`=$typeid");
			showmessage(L('add_success'), '', '', 'add');
		}else{
			$typeId =  $_GET['typeid'];
			$show_header = $show_validator = '';
			include $this->admin_tpl('special_add_property');
		}
	}
	
	/**
	 *	专题修改属性
	 */
	public function special_edit_property(){
		if(isset($_POST['dosubmit'])) {
			$id = $_POST['id'];
			$name = $_POST['name'];
			$this->db->sselect("UPDATE v9_special_list_data SET `name`='$name' WHERE id=$id");
			showmessage(L('update_success'), '', '', 'edit');
		}else{
			$typeid = $_GET['typeid'];
			$datas = $this->db->sselect("SELECT * FROM v9_special_list_data WHERE id=$typeid");
			$show_header = $show_validator = '';
			include $this->admin_tpl('special_edit_property');
		}
	}
	
	/**
	 *	删除专题属性
	 */
	public function special_del_property(){
		$typeid= $_GET['typeid'];
		$this->db->sselect("DELETE FROM v9_special_list_data WHERE id=$typeid");
		echo 1;
	}
	
	/**
	 *	专题推荐位列表
	 */
	public function special_position_list(){
		$list_menu = '<a class="on" href="?m=special&c=special&a=init"><em>专题</em></a> | <a class="on" href="?m=special&c=special&a=special_position_list"><em>专题推荐</em></a>';
		$page = empty($_GET['page']) ? 1:$_GET['page'];
		$recordPerPage = 20;
		$num_sql = "SELECT count(*) as num FROM v9_special_position ORDER BY posid DESC";
		$num_arr = $this->db->sselect($num_sql);
		$num_count = $num_arr[0][num];
		$sql = "SELECT * FROM v9_special_position ORDER BY posid DESC LIMIT ".($page-1)*$recordPerPage.",$recordPerPage";
		$datas = $this->db->sselect($sql);
		$page_split = new PagerSplit($num_count,$page,$recordPerPage);
		$page_str = $page_split->GetPagerContent();
		$show_header = $show_validator = '';
		include $this->admin_tpl('special_position_list');
	}
	
	/**
	 *	添加推荐位
	 */
	public function special_add_pos(){
		if(isset($_POST['dosubmit'])) {
			$name = $_POST['name'];
			$this->db->sselect("INSERT INTO v9_special_position SET `name`='$name'");
			showmessage(L('add_success'), '', '', 'add');
		}else{
			$show_header = $show_validator = '';
			include $this->admin_tpl('special_add_pos');
		}
	}
	
	/**
	 *  修改推荐位
	 */
	public function special_edit_pos(){
		if(isset($_POST['dosubmit'])) {
			$id = $_POST['id'];
			$name = $_POST['name'];
			$this->db->sselect("UPDATE v9_special_position SET `name`='$name' WHERE posid=$id");
			showmessage(L('update_success'), '', '', 'edit');
		}else{
			$typeid = $_GET['typeid'];
			$datas = $this->db->sselect("SELECT * FROM v9_special_position WHERE posid=$typeid");
			$show_header = $show_validator = '';
			include $this->admin_tpl('special_edit_pos');
		}
	}
	
	/**
	 *	删除推荐位
	 */
	public function special_del_pos(){
		$id = $_GET['typeid'];
		$this->db->sselect("DELETE FROM v9_special_position WHERE posid='$id'");
		$data_arr = $this->db->sselect("SELECT id FROM v9_special_position_data WHERE posid='$id'");
		for($i=0;$i<count($data_arr);$i++){
			$this->db->sselect("DELETE FROM v9_special_position_data WHERE id=".$data_arr[$i][id]);
		}
		echo 1;
	}
	
	/**
	 *	关联推荐位列表
	 */
	public function special_position_list_item(){
		$list_menu = '<a class="on" href="?m=special&c=special&a=init"><em>专题</em></a> | <a class="on" href="?m=special&c=special&a=special_position_list"><em>专题推荐</em></a>';
		$posid = $_GET['posid'];		
		$page = empty($_GET['page']) ? 1:$_GET['page'];
		$recordPerPage = 20;
		$num_sql = "SELECT count(*) as num FROM v9_special_position_data WHERE posid=$posid";
		$num_arr = $this->db->sselect($num_sql);
		$num_count = $num_arr[0][num];
		$sql = "SELECT * FROM v9_special_position_data WHERE posid=$posid ORDER BY inputtime DESC LIMIT ".($page-1)*$recordPerPage.",$recordPerPage";
		$datas = $this->db->sselect($sql);
		$page_split = new PagerSplit($num_count,$page,$recordPerPage);
		$page_str = $page_split->GetPagerContent();
		$show_header = $show_validator = '';
		include $this->admin_tpl('special_position_list_item');
		
	}
	
	/**
	 * 选取新闻并入库
	 */
	public function special_position_select(){
		if (($_GET['ajax_select'])=="yes") {
//			print_r($_POST['data']);
			$postid = $_GET['postid'];
			$arr = $_POST['data'];
			if (count($arr)){
				for ($i=0;$i<count($arr);$i++){
					$sql = "SELECT *,(SELECT COUNT(*) FROM v9_special_content b WHERE b.specialid=a.id AND b.thumb='') AS news_total,
							(SELECT COUNT(*) FROM v9_special_content c WHERE c.specialid=a.id AND c.thumb !='') AS pic_total
							FROM v9_special a WHERE a.id=".$arr[$i];
					$s_arr = $this->db->sselect($sql);
					for ($j = 0; $j < count($s_arr); $j++) {
						$sql = "INSERT INTO v9_special_position_data SET posid='".$postid."',special_id='".$s_arr[$j][id]."',special_name='".$s_arr[$j][title]."',url='".$s_arr[$j][url]."',news_total='".$s_arr[$j][news_total]."',pic_total='".$s_arr[$j][pic_total]."',thumb='".$s_arr[$j][thumb]."',inputtime='".$s_arr[$j][createtime]."'";
						$this->db->sselect($sql);
//						echo $sql;
					}
				}
			}
		}else {
			$title = empty($_POST['title']) ? "1=1":"title = '$_POST[title]'";
			$pos_id = $_GET['typeid'];
			//获取已选择的专题
			$sql = "SELECT * FROM v9_special_position_data WHERE posid=$pos_id ORDER BY inputtime desc";
			$isselected = $this->db->sselect($sql);
			//获取所有专题
			$sql = "SELECT * FROM v9_special WHERE $title";
			$isspecial = $this->db->sselect($sql);
			include $this->admin_tpl('special_position_select');
		}
	}
	
	/**
	 *	删除选取新闻
	 */
	public function special_position_select_del(){
		$typeid = $_GET['typeid'];
		$sql = "DELETE FROM v9_special_position_data WHERE id=$typeid";
		$this->db->sselect($sql);
		echo 1;
	}
	
}


?>