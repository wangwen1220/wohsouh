<?php
defined('IN_PHPCMS') or exit('No permission resources.');
//模型缓存路径
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
//定义在单独操作内容的时候，同时更新相关栏目页面
define('RELATION_HTML',true);

pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('form','',0);
pc_base::load_app_func('util');
pc_base::load_sys_class('format','',0);

class MY_content extends content {
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 初始化模型
	 * @param $catid
	 */
	public function set_modelid($catid) {
		$siteids = getcache('category_content','commons');
		if(!$siteids[$catid]) return false;
		$siteid = $siteids[$catid];
		$this->category = getcache('category_content_'.$siteid,'commons');
		if($this->category[$catid]['type']!=0) return false;
		$this->modelid = $this->category[$catid]['modelid'];
		$this->db->set_model($this->modelid);
		$this->tablename = $this->db->table_name;
		if(empty($this->category)) {
			return false;
		} else {
			return true;
		}
	}
	
	public function init() {
		$show_header = $show_dialog  = $show_pc_hash = '';
		$moren = $_GET["mr"];
		if(isset($_GET['catid']) && $_GET['catid'] 
				&& $this->categorys[$_GET['catid']]['siteid']==$this->siteid
				&& empty($moren)) 
		{
			$catid = $_GET['catid'] = intval($_GET['catid']);
			$category = $this->categorys[$catid];
			$modelid = $category['modelid'];
			$admin_username = param::get_cookie('admin_username');
			//查询当前的工作流
			$setting = string2array($category['setting']);
			$workflowid = $setting['workflowid'];
			$workflows = getcache('workflow_'.$this->siteid,'commons');
			$workflows = $workflows[$workflowid];
			$workflows_setting = string2array($workflows['setting']);

			//将有权限的级别放到新数组中
			$admin_privs = array();
			foreach($workflows_setting as $_k=>$_v) {
				if(empty($_v)) continue;
				foreach($_v as $_value) {
					if($_value==$admin_username) $admin_privs[$_k] = $_k;
				}
			}
			//工作流审核级别
			$workflow_steps = $workflows['steps'];
			$workflow_menu = '';
			$steps = isset($_GET['steps']) ? intval($_GET['steps']) : 0;
			//工作流权限判断
			if($_SESSION['roleid']!=1 && $steps && !in_array($steps,$admin_privs)) showmessage(L('permission_to_operate'));
			$this->db->set_model($modelid);
			if($this->db->table_name==$this->db->db_tablepre) 
				showmessage(L('model_table_not_exists'));
			$status = $steps ? $steps : 99;
			if(isset($_GET['reject'])) $status = 0;
			$where = 'catid='.$catid.' AND status='.$status;
			$order = 'id desc';
			$list = empty($_GET['s_user']) ? '1':$_GET['s_user'];
			$list1 = empty($_GET['s_time']) ? '1':$_GET['s_time'];
			//用户		
			if ($list == "asc"){
				$order = "username ASC";
			}elseif ($list == "desc") {
				$order = "username DESC";
			}
			if ($list1 == "asc"){
				$order = "updatetime ASC";
			}elseif ($list1 == "desc") {
				$order = "updatetime DESC";
			}
			
			//搜索
			
			if(isset($_GET['start_time']) && $_GET['start_time']) {
				$start_time = strtotime($_GET['start_time']);
				$where .= " AND `inputtime` > '$start_time'";
			}
			if(isset($_GET['end_time']) && $_GET['end_time']) {
				$end_time = strtotime($_GET['end_time']);
				$where .= " AND `inputtime` < '$end_time'";
			}
			if($start_time>$end_time) showmessage(L('starttime_than_endtime'));
			if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
				$type_array = array('title','description','username');
				$searchtype = intval($_GET['searchtype']);
				if($searchtype < 3) {
					$searchtype = $type_array[$searchtype];
					$keyword = strip_tags(trim($_GET['keyword']));
					$where .= " AND `$searchtype` like '%$keyword%'";
				} elseif($searchtype==3) {
					$keyword = intval($_GET['keyword']);
					$where .= " AND `id`='$keyword'";
				}
			}
			if(isset($_GET['posids']) && !empty($_GET['posids'])) {
				$posids = $_GET['posids']==1 ? intval($_GET['posids']) : 0;
				$where .= " AND `posids` = '$posids'";
			}
			
			$datas = $this->db->listinfo($where,$order,$_GET['page']);
			$pages = $this->db->pages;
			$pc_hash = $_SESSION['pc_hash'];
			for($i=1;$i<=$workflow_steps;$i++) {
				if($_SESSION['roleid']!=1 && !in_array($i,$admin_privs)) continue;
				$current = $steps==$i ? 'class=on' : '';
				$r = $this->db->get_one(array('catid'=>$catid,'status'=>$i));
				$newimg = $r ? '<img src="'.IMG_PATH.'icon/new.png" style="padding-bottom:2px" onclick="window.location.href=\'?m=content&c=content&a=&menuid='.$_GET['menuid'].'&catid='.$catid.'&steps='.$i.'&pc_hash='.$pc_hash.'\'">' : '';
				$workflow_menu .= '<a href="?m=content&c=content&a=&menuid='.$_GET['menuid'].'&catid='.$catid.'&steps='.$i.'&pc_hash='.$pc_hash.'" '.$current.' ><em>'.L('workflow_'.$i).$newimg.'</em></a><span>|</span>';
			}
			if($workflow_menu) {
				$current = isset($_GET['reject']) ? 'class=on' : '';
				$workflow_menu .= '<a href="?m=content&c=content&a=&menuid='.$_GET['menuid'].'&catid='.$catid.'&pc_hash='.$pc_hash.'&reject=1" '.$current.' ><em>'.L('reject').'</em></a><span>|</span>';
			}
			include $this->admin_tpl('content_list');
		} else {
			$catid = $_GET['catid'];
			if(!empty($catid) && is_numeric($catid) && $catid>0)
			{
				$sql = "select arrchildid from v9_category where catid='$catid'";
				$dbarr = $this->db->sselect($sql);
				$catstr = $dbarr[0]["arrchildid"];
				
				$addsql = " and a.catid in ($catstr)";
			}
			else
				$addsql = "";
			$fusername = $_GET['fusername'];
			if(!empty($fusername))
			{
				$fusersql = " and a.username='$fusername'";
			}
			else
			{
				$fusersql = "";
			}
			$order = 'a.input_time DESC';
			$list = empty($_GET['s_user']) ? '1':$_GET['s_user'];
			$list1 = empty($_GET['s_time']) ? '1':$_GET['s_time'];
			//用户
			if ($list == "asc"){
				$order = "a.username ASC";
			}elseif ($list == "desc") {
				$order = "a.username DESC";
			}
			if ($list1 == "asc"){
				$order = "a.last_update_time ASC";
			}elseif ($list1 == "desc") {
				$order = "a.last_update_time DESC";
			}
			
			//搜索
				
			if(isset($_GET['start_time']) && $_GET['start_time']) {
				$start_time = strtotime($_GET['start_time']);
				$where .= " AND a.`input_time` > '$start_time'";
			}
			if(isset($_GET['end_time']) && $_GET['end_time']) {
				$end_time = strtotime($_GET['end_time']);
				$where .= " AND a.`input_time` < '$end_time'";
			}
			if($start_time>$end_time) showmessage(L('starttime_than_endtime'));
			if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
				$type_array = array('title','description','username');
				$searchtype = intval($_GET['searchtype']);
				if($searchtype < 3) {
					$searchtype = $type_array[$searchtype];
					$keyword = strip_tags(trim($_GET['keyword']));
					$where .= " AND a.`$searchtype` like '%$keyword%'";
				} elseif($searchtype==3) {
					$keyword = intval($_GET['keyword']);
					$where .= " AND a.`id`='$keyword'";
				}
			}
			/* if(isset($_GET['posids']) && !empty($_GET['posids'])) {
				$posids = $_GET['posids']==1 ? intval($_GET['posids']) : 0;
				$where .= " AND `posids` = '$posids'";
			} */
			
			$steps = isset($_GET['steps']) ? intval($_GET['steps']) : 0;
			$status = $steps ? $steps : 99;
			$page=$_GET["page"];
			$page = (!is_numeric($page) || $page<=0)?1:$page;
			$recordPerPage = $_GET["pagesize"];
			$recordPerPage = (!is_numeric($recordPerPage) || $recordPerPage<=0)?20:$recordPerPage;

			$sql = "select count(*) as count from v9_global_id a
					where a.catid is not null $addsql $fusersql $where";
			$countarr = $this->db->sselect($sql);
			$num = $countarr[0]["count"];
			$sql = "SELECT a.id,a.modeid,a.title,a.catid,
					a.last_update_time,a.input_time,
					a.username,a.url,b.catname
					FROM v9_global_id a
					inner join v9_category b on a.catid=b.catid
					WHERE a.status='99' and a.catid is not null $addsql $fusersql $where
					ORDER BY $order LIMIT ".($page-1)*$recordPerPage.",$recordPerPage";
			$datas = $this->db->sselect($sql);
			//$page = max(intval($page), 1);
			$pages = pages($num, $page, $recordPerPage);
			
			include $this->admin_tpl('content_quick');
		}
	}
	
	
	public function edit() {
		//设置cookie 在附件添加处调用
		param::set_cookie('module', 'content');
		if(isset($_POST['dosubmit']) || isset($_POST['dosubmit_continue'])) {
			define('INDEX_HTML',true);
			$id = intval($_POST['id']);
			$p_hash = $_SESSION['pc_hash'];
			$catid = $_POST['info']['catid'] = intval($_POST['info']['catid']);
			if(trim($_POST['info']['title'])=='') showmessage(L('title_is_empty'));
			$modelid = $this->categorys[$catid]['modelid'];
			$this->db->set_model($modelid);
			$this->db->edit_content($_POST['info'],$id);
			if(isset($_POST['dosubmit'])) {
				//header("Location: /index.php?m=content&c=content&a=init&menuid=822&catid=$catid&pc_hash=$p_hash");
				showmessage(L('update_success').L('2s_close'),'blank','','','function set_time() {$("#secondid").html(1);}setTimeout("set_time()", 500);document.body.id="close_tab";document.body.rel="/index.php?m=content&c=content&a=init&menuid=822&catid='.$catid.'&pc_hash='.$p_hash.'";setTimeout(function(){$.getScript("/statics/js/huoshow_editor.js");}, 1200);');
			} else {
				showmessage(L('update_success'),HTTP_REFERER);
			}
		} else {
			$show_header = $show_dialog = $show_validator = '';
			//从数据库获取内容
			$id = intval($_GET['id']);
			if(!isset($_GET['catid']) || !$_GET['catid']) showmessage(L('missing_part_parameters'));
			$catid = $_GET['catid'] = intval($_GET['catid']);
	
			$this->model = getcache('model', 'commons');
	
			param::set_cookie('catid', $catid);
			$category = $this->categorys[$catid];
			$modelid = $category['modelid'];
			$this->db->table_name = $this->db->db_tablepre.$this->model[$modelid]['tablename'];
			$r = $this->db->get_one(array('id'=>$id));
			$this->db->table_name = $this->db->table_name.'_data';
			$r2 = $this->db->get_one(array('id'=>$id));
			if(!$r2) showmessage(L('subsidiary_table_datalost'),'blank');
			$data = array_merge($r,$r2);
			require CACHE_MODEL_PATH.'content_form.class.php';
			$content_form = new content_form($modelid,$catid,$this->categorys);

			$forminfos = $content_form->get($data);
			$formValidator = $content_form->formValidator;
			include $this->admin_tpl('content_edit');
		}
		header("Cache-control: private");
	}
	
	public function add() {
		if(isset($_POST['dosubmit']) || isset($_POST['dosubmit_continue']) || 
				isset($_POST['dosubmit_draft']) ) {
			//不生成首页
			define('INDEX_HTML',false);
			$catid = $_POST['info']['catid'] = intval($_POST['info']['catid']);
			$p_hash = $_SESSION['pc_hash'];
			if(trim($_POST['info']['title'])=='') showmessage(L('title_is_empty'));
			$category = $this->categorys[$catid];
			if($category['type']==0) {
				
				$modelid = $this->categorys[$catid]['modelid'];
				$this->db->set_model($modelid);
				//如果该栏目设置了工作流，那么必须走工作流设定
				$setting = string2array($category['setting']);
				$workflowid = $setting['workflowid'];
				if($workflowid && $_POST['status']!=99) {
					//如果用户是超级管理员，那么则根据自己的设置来发布
					$_POST['info']['status'] = $_SESSION['roleid']==1 ? intval($_POST['status']) : 1;
				} else {
					$_POST['info']['status'] = 99;
				}
				//存草稿箱
				if(isset($_POST['dosubmit_draft'])) 
				{
					
					$draft_ajax = $_POST["draft_ajax"];
					$this->db->table_name = "v9_content_draft_box";
					$param = array(
							"title"=>$_POST['info'][title],
							"username"=>param::get_cookie('admin_username'),
							"modelid"=>$modelid,
							"catid"=>$catid,
							"post_data"=>new_addslashes(var_export($_POST,true)),
							);

					$id = $this->db->insert($param);
					if($draft_ajax==1)//是ajx模式
					{
						echo $id;
						die();
					}
					else
						showmessage(L('add_success'),HTTP_REFERER);
				}
				$cont_id = $this->db->add_content($_POST['info']);
				//根据关键词，自动添入专题相对应的专题栏目
				$keywords_arr = explode(" ",$_POST['info']['keywords']);
				if (count($keywords_arr)) {
					//查找专题名称与专题下的栏目名称
					$special_data = $this->db->sselect("SELECT a.id,a.title,b.typeid,b.name FROM v9_special a LEFT JOIN v9_type b ON a.id=b.parentid WHERE a.title='$keywords_arr[0]' AND b.name='$keywords_arr[1]'");
					if (count($special_data)) {
						$c = pc_base::load_model('content_model');
						$c->set_model($_POST['modelid']);
						$info = array();
						$info[$cont_id] = $c->get_content($catid, $cont_id);
						$specialid = $special_data[0]['id'];
						$title = $info[$cont_id]['title'];
						$typeid = $special_data[0]['typeid'];
						$thumb = $info[$cont_id]['thumb'];
						$keywords = $info[$cont_id]['keywords'];
						$description = $info[$cont_id]['description'];
						$url = $info[$cont_id]['url'];
						$curl =$info[$cont_id]['id'].'|'.$info[$cont_id]['catid'];
						$username = $info[$cont_id]['username'];
						$inputtime = $info[$cont_id]['inputtime'];
						$updatetime = $info[$cont_id]['updatetime'];
						$islink = $info[$cont_id]['islink'];
						$this->db->sselect("INSERT INTO v9_special_content (specialid,title,typeid,thumb,keywords,description,url,curl,username,inputtime,updatetime,islink) VALUE 
						('$specialid','$title','$typeid','$thumb','$keywords','$description','$url','$curl','$username','$inputtime','$updatetime','$islink')");
					}
				}
				if(isset($_POST['dosubmit'])) {
					header("Location: /index.php?m=content&c=content&a=init&menuid=822&catid=$catid&pc_hash=$p_hash");
// 					showmessage(L('add_success').L('2s_close'),'blank','','','function set_time() {$("#secondid").html(1);}setTimeout("set_time()", 500);setTimeout("window.close()", 1200);');
				} else {
					showmessage(L('add_success'),HTTP_REFERER);
				}
			} else {
				//单网页
				$this->page_db = pc_base::load_model('page_model');
				$style_font_weight = $_POST['style_font_weight'] ? 'font-weight:'.strip_tags($_POST['style_font_weight']) : '';
				$_POST['info']['style'] = strip_tags($_POST['style_color']).';'.$style_font_weight;
	
				if($_POST['edit']) {
					$this->page_db->update($_POST['info'],array('catid'=>$catid));
				} else {
					$catid = $this->page_db->insert($_POST['info'],1);
				}
				$this->page_db->create_html($catid,$_POST['info']);
				$forward = HTTP_REFERER;
			}
			showmessage(L('add_success'),$forward);
		} else {
			$show_header = $show_dialog = $show_validator = '';
			//设置cookie 在附件添加处调用
			param::set_cookie('module', 'content');
	
			if(isset($_GET['catid']) && $_GET['catid']) {
				$catid = $_GET['catid'] = intval($_GET['catid']);
	
				param::set_cookie('catid', $catid);
				$category = $this->categorys[$catid];
				if($category['type']==0) {
					$modelid = $category['modelid'];
					//取模型ID，依模型ID来生成对应的表单
					require CACHE_MODEL_PATH.'content_form.class.php';
					$content_form = new content_form($modelid,$catid,$this->categorys);
					$forminfos = $content_form->get();
					$formValidator = $content_form->formValidator;
					$setting = string2array($category['setting']);
					$workflowid = $setting['workflowid'];
					$workflows = getcache('workflow_'.$this->siteid,'commons');
					$workflows = $workflows[$workflowid];
					$workflows_setting = string2array($workflows['setting']);
					$nocheck_users = $workflows_setting['nocheck_users'];
					$admin_username = param::get_cookie('admin_username');
					if(!empty($nocheck_users) && in_array($admin_username, $nocheck_users)) {
						$priv_status = true;
					} else {
						$priv_status = false;
					}
					include $this->admin_tpl('content_add');
				} else {
					//单网页
					$this->page_db = pc_base::load_model('page_model');
						
					$r = $this->page_db->get_one(array('catid'=>$catid));
						
					if($r) {
						extract($r);
						$style_arr = explode(';',$style);
						$style_color = $style_arr[0];
						$style_font_weight = $style_arr[1] ? substr($style_arr[1],12) : '';
					}
					include $this->admin_tpl('content_page');
				}
			} else {
				include $this->admin_tpl('content_add');
			}
			header("Cache-control: private");
		}
	}
	
	/**
	 * 审核所有内容
	 */
	public function public_checkall() {
		//获取栏目ID
		$parentid = $_POST[info][parentid];	
		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$show_header = '';
		$workflows = getcache('workflow_'.$this->siteid,'commons');
		$datas = array();
		$pagesize = 20;
		$sql = '';
		if (in_array($_SESSION['roleid'], array('1'))) {
			$super_admin = 1;
			$status = isset($_GET['status']) ? $_GET['status'] : -1;
		} else {
			$super_admin = 0;
			$status = isset($_GET['status']) ? $_GET['status'] : 1;
			if($status==-1) $status = 1;
		}
		if($status>4) $status = 4;
		//搜索栏目内容
		if ($_GET['s'] == "see" && $parentid!=0 && $parentid!=1 && $parentid!=2 && $parentid!=3 && $parentid!=4 && $parentid!=5){
			if(!$this->set_modelid($parentid)) return false;
			if($status==-1) {
				$status_sql = "`status` NOT IN (99,0,-2)";
			} else {
				$status_sql = "`status` = '$status' ";
			}
			//var_dump($this->category[$parentid]['child']);
			if($this->category[$parentid]['child']) {
				$catids_str = $this->category[$parentid]['arrchildid'];
				$pos = strpos($catids_str,',')+1;
				$catids_str = substr($catids_str, $pos);
				$sql = "$status_sql AND catid IN ($catids_str)";
			} else {
				$sql = "$status_sql AND catid='$parentid'";
			}
			$this->content_check_db = pc_base::load_model('content_check_model');
			$datas = $this->content_check_db->listinfo($sql,'inputtime DESC',$page);		
			$pages = $this->content_check_db->pages;
		}else {
			$this->priv_db = pc_base::load_model('category_priv_model');;
			$admin_username = param::get_cookie('admin_username');
			if($status==-1) {
				$sql = "`status` NOT IN (99,0,-2) AND `siteid`=$this->siteid";
			} else {
				$sql = "`status` = '$status' AND `siteid`=$this->siteid";
			}
			if($status!=0 && !$super_admin) {
				//以栏目进行循环
				foreach ($this->categorys as $catid => $cat) {
					if($cat['type']!=0) continue;
					//查看管理员是否有这个栏目的查看权限。
					if (!$this->priv_db->get_one(array('catid'=>$catid, 'siteid'=>$this->siteid, 'roleid'=>$_SESSION['roleid'], 'is_admin'=>'1'))) {
						continue;
					}
					//如果栏目有设置工作流，进行权限检查。
					$workflow = array();
					$cat['setting'] = string2array($cat['setting']);
					if (isset($cat['setting']['workflowid']) && !empty($cat['setting']['workflowid'])) {
						$workflow = $workflows[$cat['setting']['workflowid']];
						$workflow['setting'] = string2array($workflow['setting']);
						$usernames = $workflow['setting'][$status];
						if (empty($usernames) || !in_array($admin_username, $usernames)) {//判断当前管理，在工作流中可以审核几审
							continue;
						}
					}
					$priv_catid[] = $catid;
				}
				if(empty($priv_catid)) {
					$sql .= " AND catid = -1";
				} else {
					$priv_catid = implode(',', $priv_catid);
					$sql .= " AND catid IN ($priv_catid)";
				}
			}
			$this->content_check_db = pc_base::load_model('content_check_model');
			$datas = $this->content_check_db->listinfo($sql,'inputtime DESC',$page);		
			$pages = $this->content_check_db->pages;
			
		}
		include $this->admin_tpl('content_checkall');
	}
	
	/**
	 * 删除
	 */
	public function delete() {
		if(isset($_GET['dosubmit'])) {
			$catid = intval($_GET['catid']);
			if(!$catid) showmessage(L('missing_part_parameters'));
			$modelid = $this->categorys[$catid]['modelid'];
			$sethtml = $this->categorys[$catid]['sethtml'];
			$siteid = $this->categorys[$catid]['siteid'];
			
			$html_root = pc_base::load_config('system','html_root');
			if($sethtml) $html_root = '';
			
			$setting = string2array($this->categorys[$catid]['setting']);
			$content_ishtml = $setting['content_ishtml']; 
			$this->db->set_model($modelid);
			$this->hits_db = pc_base::load_model('hits_model');
			$this->queue = pc_base::load_model('queue_model');
			
			if(isset($_GET['ajax_preview'])) {
				$ids = intval($_GET['id']);
				$_POST['ids'] = array(0=>$ids);
			}
			
			if(empty($_POST['ids'])) showmessage(L('you_do_not_check'));
			//附件初始化
			$attachment = pc_base::load_model('attachment_model');
			$this->content_check_db = pc_base::load_model('content_check_model');
			$this->position_data_db = pc_base::load_model('position_data_model');
			$this->search_db = pc_base::load_model('search_model');
			$this->comment = pc_base::load_app_class('comment', 'comment');
			$search_model = getcache('search_model_'.$this->siteid,'search');
			$typeid = $search_model[$modelid]['typeid'];
			$this->url = pc_base::load_app_class('url', 'content');
			foreach($_POST['ids'] as $id) {
				$r = $this->db->get_one(array('id'=>$id));
				if($content_ishtml && !$r['islink']) {
					$urls = $this->url->show($id, 0, $r['catid'], $r['inputtime']);
					$fileurl = $urls[1];
					if($this->siteid != 1) {
						$sitelist = getcache('sitelist','commons');
						$fileurl = $html_root.'/'.$sitelist[$this->siteid]['dirname'].$fileurl;
					}
					//删除静态文件，排除htm/html/shtml外的文件
					$lasttext = strrchr($fileurl,'.');
					$len = -strlen($lasttext);
					$path = substr($fileurl,0,$len);
					$path = ltrim($path,'/');
					$filelist = glob(PHPCMS_PATH.$path.'*');
					foreach ($filelist as $delfile) {
						$lasttext = strrchr($delfile,'.');
						if(!in_array($lasttext, array('.htm','.html','.shtml'))) continue;
						@unlink($delfile);
						//删除发布点队列数据
						$delfile = str_replace(PHPCMS_PATH, '/', $delfile);
						$this->queue->add_queue('del',$delfile,$this->siteid);
					}
				} else {
					$fileurl = 0;
				}
				//删除内容
				$this->db->delete_content($id,$fileurl,$catid);
				//删除统计表数据
				$this->hits_db->delete(array('hitsid'=>'c-'.$modelid.'-'.$id));
				//删除附件
				$attachment->api_delete('c-'.$catid.'-'.$id);
				//删除审核表数据
				$this->content_check_db->delete(array('checkid'=>'c-'.$id.'-'.$modelid));
				//删除推荐位数据
				$this->position_data_db->delete(array('id'=>$id,'catid'=>$catid,'module'=>'content'));
				//删除全站搜索中数据
				$this->search_db->delete_search($typeid,$id);
				
				//删除相关的评论,删除前应该判断是否还存在此模块
				if(module_exists('comment')){
					$commentid = id_encode('content_'.$catid, $id, $siteid);
					$this->comment->del($commentid, $siteid, $id, $catid);
				}
				
 			}
			//更新栏目统计
			$this->db->cache_items();
//			die("assss");
			if ($_GET['del_all'] != "no"){
				showmessage(L('operation_success'),HTTP_REFERER);	
			}
		} else {
			showmessage(L('operation_failure'));
		}
	}
	
	public function delete_all(){
		$data = $_POST['ids'];
		for ($i=0;$i<count($data);$i++){
			//根据ID查找
			$sql = "SELECT * FROM v9_global_id WHERE id=".$data[$i];
			$result = $this->db->sselect($sql);
			//删除v9_global_id数据
			if (count($result)>0){
				$sql = "DELETE FROM v9_global_id WHERE id=".$result[0]['id'];
				$this->db->query($sql);
				$_GET["dosubmit"] = 1;
				$_POST['ids'] = array($result[0]['id']);
				$_POST['pc_hash'] = $_SESSION['pc_hash'];
				$_GET["catid"] = $result[0]['catid'];
				$_GET["siteid"] = $this->siteid;
				$_GET["modelid"] = $result[0]['modelid'];
				$_GET["sethtml"] = $result[0]['url'];
				$_GET["del_all"] = "no";
				$this->delete();
			}
		}
		showmessage(L('operation_success'),HTTP_REFERER);
	}


	/**
	 * 批量移动文章
	 */
	public function remove() {
		if(isset($_POST['dosubmit'])) {
			$this->content_check_db = pc_base::load_model('content_check_model');
			if($_POST['fromtype']==0) {
				if($_POST['ids']=='') showmessage(L('please_input_move_source'));
				if(!$_POST['tocatid']) showmessage(L('please_select_target_category'));
				$tocatid = intval($_POST['tocatid']);
				$modelid = $this->categorys[$tocatid]['modelid'];
				if(!$modelid) showmessage(L('illegal_operation'));
				$ids = array_filter(explode(',', $_POST['ids']),"intval");
				foreach ($ids as $id) {
					$checkid = 'c-'.$id.'-'.$this->siteid;
					$this->content_check_db->update(array('catid'=>$tocatid), array('checkid'=>$checkid));
				}
				$ids = implode(',', $ids);
				$this->db->set_model($modelid);
				$this->db->update(array('catid'=>$tocatid),"id IN($ids)");
				$this->db->sselect("update v9_global_id set catid='$tocatid' where id IN($ids)");
			} else {
				if(!$_POST['fromid']) showmessage(L('please_input_move_source'));
				if(!$_POST['tocatid']) showmessage(L('please_select_target_category'));
				$tocatid = intval($_POST['tocatid']);
				$modelid = $this->categorys[$tocatid]['modelid'];
				if(!$modelid) showmessage(L('illegal_operation'));
				$fromid = array_filter($_POST['fromid'],"intval");
				$fromid = implode(',', $fromid);
				$this->db->set_model($modelid);
				$this->db->update(array('catid'=>$tocatid),"catid IN($fromid)");
				$this->db->sselect("update v9_global_id set catid='$tocatid' where catid IN($fromid)");
			}
			showmessage(L('operation_success'),HTTP_REFERER);
			//ids
		} else {
			$show_header = '';
			$catid = intval($_GET['catid']);
			$modelid = $this->categorys[$catid]['modelid'];
			$tree = pc_base::load_sys_class('tree');
			$tree->icon = array('&nbsp;&nbsp;│ ','&nbsp;&nbsp;├─ ','&nbsp;&nbsp;└─ ');
			$tree->nbsp = '&nbsp;&nbsp;';
			$categorys = array();
			
			foreach($this->categorys as $cid=>$r) {
				if($this->siteid != $r['siteid'] || $r['type']) continue;
				//if($modelid && $modelid != $r['modelid']) continue;
				if($r['child'])
				{
					$r['disabled'] = 'disabled';
					//$r['disabled'] = '';
				}
				else 
				{
					if($modelid && $modelid != $r['modelid'])
						$r['disabled'] = 'disabled';
					else
						$r['disabled'] = '';
				}
				//$r['disabled'] = $r['child'] ? 'disabled' : '';
				$r['selected'] = $cid == $catid ? 'selected' : '';
				$categorys[$cid] = $r;
				
			}
			$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
			$tree->init($categorys);
			$string .= $tree->get_tree(0, $str);
 			$str  = "<option value='\$catid' \$disabled>\$spacer \$catname</option>";
 			
 			$categorys1 = array();
 			foreach($this->categorys as $cid=>$r) {
 				if($this->siteid != $r['siteid'] || $r['type']) continue;
 				/*
 				if($r['child'])
 				{
 					$r['disabled'] = 'disabled';
 					//$r['disabled'] = '';
 				}
 				else
 					$r['disabled'] = '';
 				*/
 				$categorys1[$cid] = $r;
 			}
			$source_string = '';
			$tree->init($categorys1);
			$source_string .= $tree->get_tree(0, $str);
			$ids = empty($_POST['ids']) ? '' : implode(',',$_POST['ids']);
			include $this->admin_tpl('content_remove');
		}
	}
	
	
	function del_recycle_bin(){
		$_POST['ids'] = array(147521,147493,147494,147419,147410,147303,147052,147187,147233,147190,147191,147076,147239,147077,
				147176,147180,147182,147183,147131,147125,147112,147091,147246,147241,147242,147084,147243,147240,
				147071,146873,146868,146874,146876,147055,147054,147057,147245,146861,146875,146881,146750,146751,
				146616,147113,146614,146615,146611,146522,147043,146333,146343,146337,146298,146255,146246,146220,
				146136,146152,146263,146170,146182,146127,146052,146048,145986,145980,145963,145982,145962,145930,
				146001,145783,145760,145749,145764,145693,145707,145544,145660,145361,145525,145528,145533,145426,
				145418,145520,145368,145369,145239,145054,145403,145064,145245,145072,144928,144979,144980,144981,
				145012,144930,144645,144646,144431,144563,144561,144562,144450,144578,144374,144407,144437,145277,
				144361,144478,144473,144406,144480,144358,144240,144337,144124,144135,144115,144137,144529,144218,
				144026,144022,144025,144024,144029,143830,144055,144085,143946,144046,143833,143727,143735,143562,
				143561,143671,143687,143744,143603,143611,143676,143615,143572,143664,143652,143658,143612,143623,
				143660,143666,143667,143662,143626,143661,143496,143433,143510,143434,143458,143466,144021,143625,
				143383,143224,143125,143176,142995,142951,142968,142969,142970,142971,142972,142973,142974,143019,
				142952,142943,142944,142945,143020,143021,143168,142877,142876,142878,142730,142946,142947,142753,
				142799,142836,142746,142866,143028,143029,143030,143031,143032,143042,143043,143045,143046,143047,
				143048,143049,143050,143051,143052,143053,143054,143055,143056,143057,143058,143059,143060,143061,
				143062,143063,143064,143065,143066,143067,143068,143069,143072,143073,143074,143016,142948,143022,
				142949,142950,142531,142530,142528,142529,142527,142526,142525,142524,142523,142522,142521,142520,
				142519,142518,142517,142516,142515,142532,142538,142587,142588,142589,142494,142590,142495,142591,
				142496,142573,142592,142593,142594,142539,142497,142575,142498,142499,142540,142595,142596,142597,
				142598,142577,142599,142646,142541,142578,142542,142566,142579,142567,142569,142572,142560,142546,
				142564,142547,142548,142500,142501,142502,142503,142504,142488,142505,142506,142507,142508,142509,
				142510,142511,142549,142512,142513,142584,142550,142585,142551,142586,142552,142565,142489,142490,
				142553,142491,142554,142492,142555,142556,142557,142558,142580,142581,142582,142559,142369,142493,
				142315,142307,142583,142248,142254,142280,142600,142601,142602,142603,142604,142605,142606,142607,
				142608,142609,142610,142618,142619,142620,142621,142622,142624,142626,142627,142628,142629,142630,
				142631,142632,142633,142634,142635,142636,142637,142638,142639,142640,142641,143033,143034,143035,
				143036,143037,143038,143039,143040,143070,143071,142387,142256,142652,142039,142054,141958,141886,
				141840,141858,141860,142611,142612,142613,142614,141992,142000,141562,141561,141554,141547,141545,
				141762,141397,141522,141602,141603,141604,141605,141428,141432,141606,141527,142093,142094,142095,
				142096,142097,142098,142099,142100,142101,142102,142103,142104,142105,142135,142136,142615,142616,
				142617,141433,141533,141509,141513,141424,141426,141439,141447,142704,141411,141412,141278,141413,
				141280,141283,141286,141173,141175,141402,141403,141301,141291,141292,141237,141276,141277,143023,
				141081,141274,140806,140947,140931,140932,140826,140942,140933,140943,140939,140827,141031,140934,
				140935,140936,141023,140940,140945,140927,140831,140834,140944,140937,140930,140938,140941,140929,
				140946,141040,140988,140864,140838,140840,140770,140772,143015,140761,140738,140762,140733,140763,
				140959,140764,140652,140653,140654,140655,140656,140736,140627,140626,140625,140624,140623,140622,
				140621,140620,140619,140618,140617,140612,140611,140610,140609,140608,140606,140607,140605,140604,
				140403,140401,140399,140398,140396,140395,140393,140394,140392,140391,140390,140389,140388,140387,
				140386,140385,140384,140426,140428,140406,140429,140430,140407,140431,140327,140424,140432,140507,
				140504,140765,140508,140408,140509,140316,140573,140510,140511,140520,140409,140425,140307,140410,
				140411,140412,140317,140302,140308,140413,140414,140342,140415,140416,140417,140418,140309,140348,
				140427,140433,140512,140453,140514,140456,140311,140454,140365,140457,140420,140458,140434,140423,
				140452,140451,140455,140450,140354,140377,140378,140405,140361,140236,140379,140492,140495,140496,
				140499,140505,140500,140501,140142,140050,140029,140127,140076,139985,140599,140600,140601,142625,
				140130,140133,140069,141092,139762,139760,139759,139761,139681,139783,139805,139806,139822,139702,
				139704,139811,140557,140560,140565,139705,139823,139708,139709,139710,139713,139714,139669,139673,
				139529,139698,139594,139530,139608,139408,139409,139513,139413,139414,139469,139423,139427,139429,
				139406,139453,139405,139231,139230,139203,139084,139075,139172,139184,139185,139175,139176,139177,
				139076,139204,139022,139008,139009,139031,139029,139024,139025,139035,139037,139012,139077,139013,
				138896,138891,139014,139015,138974,140048,138765,138764,138762,138779,138780,138783,138980,139094,
				138858,139266,139267,139268,139269,139271,139272,139273,139274,139275,139276,139277,139278,139279,
				139280,139281,138784,138785,138786,138787,138794,138777,138709,138711,138708,138710,138798,138707,
				138776,138685,138693,138498,138496,138490,138500,138441,138439,138440,138438,138437,138436,138434,
				138520,138445,138503,138679,138504,139099,138509,138510,138450,138451,138809,138511,138512,138513,
				138514,138516,138517,138519,138390,138373,138374,138375,138411,138376,138377,138378,138412,138413,
				138379,138380,138381,138414,138382,138383,138384,138385,138386,139017,138415,138416,138417,138418,
				138419,138420,138459,138421,138422,138423,138424,138387,138388,138389,138425,138426,138427,138428,
				138429,138253,138255,138254,138256,138410,138139,138140,138242,142705,138030,138052,137936,137899,
				138055,137948,137952,137959,137767,137732,137424,137566,137532,137529,137527,137526,137525,137520,
				137523,137517,137519,137515,137514,137509,137512,137508,137505,137504,137503,137502,137501,137500,
				137565,137567,137568,137476,137537,137477,137478,137538,137479,137480,137482,137583,137483,137935,
				137485,137486,137491,137492,137557,137493,137494,137420,137417,137425,137419,137549,137469,137472,
				137550,137552,137554,138967,137368,137367,137366,137365,137364,137362,137363,137360,137361,137359,
				137358,137357,137431,137596,137597,137339,137340,137341,137342,137344,137345,137346,137347,137348,
				137376,137377,137378,137379,137589,137507,137510,137511,137380,137381,137513,137382,137383,137571,
				137384,137385,137272,137267,137266,137265,137264,137263,137262,137261,137260,137259,137258,137257,
				137256,137255,137254,137253,137228,137229,137230,137231,137211,137212,137213,137214,137215,137216,
				137217,137218,137219,137530,137220,137603,137221,137598,137600,137601,137602,137534,137533,137198,
				137624,137625,137627,137628,137535,137182,137188,137606,137611,137612,137604,137181,137626,137620,
				137605,137621,137629,137622,137613,137614,137615,137616,137617,137618,137607,137619,137608,137623,
				137128,137609,136967,136822,136944,137506,136950,136953,136959,137490,136961,136935,137175,137176,
				136548,137397,136379,136378,136377,136376,136375,136374,136373,136372,136371,136370,136369,136368,
				136367,136366,136365,136653,136643,136640,136655,136645,136648,136588,136589,136590,136591,136592,
				136593,136597,136599,136600,136601,136602,136611,136612,136613,136934,136439,136288,136185,136184,
				136183,136182,136181,136180,136446,136208,136210,136126,136869,136149,139321,136073,136084,136654,
				136101,136074,136088,136090,136075,137610,136004,136014,136001,136173,136094,136095,136109,136104,
				135983,139588,135700,135758,135709,135715,135716,135717,135753,135667,135669,135672,135673,135674,
				135675,135676,135677,135678,136174,136175,136177,136178,136179,135609,135610,135561,135420,135589,
				135423,135461,135183,135316,135289,135308,135361,135336,135337,135338,135339,135340,135341,135083,
				135084,135085,135295,135298,134987,134958,135031,134846,134866,134868,134877,134769,134770,134771,
				134772,134773,134774,134775,134776,134777,134730,134760,134778,134719,134720,134723,134726,134883,
				134656,134644,134640,134636,134633,134631,134629,134627,134625,134626,134624,134703,134898,134734,
				134735,134736,134737,134738,134894,134895,134896,134556,134460,134757,134453,134573,134454,134597,
				134602,135013,135015,134455,134300,134362,134224,134222,134216,134209,134208,134365,134366,134306,
				134367,134309,134312,134322,134324,134330,134331,134368,134369,134370,134364,134332,134333,134334,
				134335,134336,134337,134338,134339,134393,134077,134094,134198,134066,134340,134096,134097,134098,
				134090,134341,134087,134091,133811,133722,133796,133797,133798,133799,134620,133816,133532,133527,
				133523,133519,133517,133518,133514,133515,133512,133593,133551,133600,133614,133619,133620,133621,
				133622,133623,133630,133412,133316,133485,133486,133498,133783,133205,133184,133212,133214,133200,
				133187,133215,133217,133419,133105,133100,133099,133091,133075,133072,133070,133066,133420,133435,
				133430,133160,133165,133170,133171,133173,133174,132993,133175,133176,133008,132898,132901,132904,
				132905,132906,132956,133414,133025,133045,134167,134203,132927,132763,132663,132662,132659,132690,
				132634,132633,132618,132617,132622,132639,132715,132726,132727,132728,132729,132520,132523,133133,
				132451,132459,133030,133031,133054,133055,133056,132430,132311,132271,132264,132262,132261,132260,
				132259,132258,132257,132256,132255,132254,132253,132252,132251,132365,132158,132368,132369,132370,
				132152,132350,132352,132353,132354,132355,132183,132367,132391,132014,132039,132381,132199,132202,
				132203,132205,132222,132607,132608,131961,131962,131948,131949,131950,131951,131952,131941,131953,
				131954,131955,131956,131894,131778,131774,131770,131765,131762,131761,131759,131758,131895,131896,
				131897,131959,131960,131898,131899,131942,131900,131904,131901,131944,131937,131945,131906,131946,
				131947,131682,131697,131816,131818,131820,131666,131826,131838,131638,131857,131859,131544,131728,
				131730,132230,131646,131658,131672,131527,131673,131540,131633,131444,131454,131465,131445,131446,
				131741,131742,131743,131294,131295,131297,131350,131276,131275,131299,131277,131301,131283,131279,
				131303,131281,131284,131292,131226,131293,131209,131207,131175,131176,131330,131331,131178,131228,
				131335,131067,131070,131229,131069,131236,131071,131313,131239,131243,131252,131253,131254,131255,
				131256,131194,131257,131258,131259,131842,131000,131327,131891,131892,131843,131844,131845,130832,
				131260,130898,130897,131304,131130,131134,131135,131143,131149,131156,131157,131734,131735,131736,
				131737,131738,132208,130963,131203,130808,130805,131217,130709,130780,130768,130892,130719,131181,
				130503,131086,130972,131061,130508,130466,131087,130517,130518,130519,130520,130521,130522,130523,
				130524,130525,130526,130845,130527,130528,130529,140476,131686,130342,130343,130367,130749,130739,
				130979,130424,131085,130625,130532,130591,131146,131155,131159,130644,131091,130339,131077,130382,
				130359,130374,130360,130363,130392,130393,130394,130395,130396,130397,130398,130399,130605,130661,
				130380,130662,130378,130544,130663,130225,130226,130227,130228,130230,130233,130180,130178,130181,
				130179,130231,130239,140464,130234,130388,131094,130068,130079,130113,130235,130386,129972,129995,
				129990,130112,129997,130003,130007,130553,130554,130555,130556,130557,130558,130595,131170,131171,
				131172,131173,131174,131747,132040,130051,129820,140462,129860,130389,129939,129936,129937,129791,
				129761,130561,130578,129623,140469,129658,129665,129591,129588,140470,129554,129560,130562,130563,
				130564,130565,130566,130567,130568,130569,130570,130571,130572,130573,130574,130575,140474,140468,
				140475,129118,129125,129287,130327,129129,129271,129123,140472,130576,131147,128975,128940,128941,
				128942,128943,128944,128945,128946,128983,128947,128932,128948,128933,128949,128950,129044,129049,
				128984,128951,128952,128953,128934,128989,128862,128863,128956,128995,129004,129005,129006,129007,
				129010,129011,129012,129013,129014,129015,129016,129017,129018,129019,129020,129021,129022,129023,
				129024,129025,129026,129027,129028,129029,128786,128799,128819,128962,128806,128646,128642,128809,
				128641,128905,128911,128916,128928,128930,128494,128500,128505,128472,128475,128512,128517,128518,
				128519,128520,128521,128522,128523,128524,128458,140477,128561,128558,128559,128560,128355,128374,
				128196,128357,128485,128398,128401,128411,128420,128921,128922,128923,128924,128925,128074,128137,
				128771,128028,128031,127893,128129,142264,128384,128389,128422,127871,127869,128423,140471,127902,
				127904,127657,127548,127550,127485,127566,127488,127538,127492,127494,127495,127499,127510,127511,
				127512,127513,127443,127514,128525,128526,128527,127389,128528,128529,128530,128531,128532,127522,
				127448,127523,127528,127382,127451,127530,127531,127534,127426,127168,127611,127207,127155,127182,
				127175,128395,128396,128419,127453,127143,127160,130960,127464,127469,127470,127073,127080,127051,
				126969,127063,127054,127066,126932,126975,126920,126922,127006,126916,127007,127100,127012,126978,
				127019,126815,126911,127035,127037,126742,126741,126793,126896,126613,126892,126589,126982,127317,
				127318,127319,127322,126985,126548,126549,126521,126503,126474,126989,127040,127041,126389,126390,
				126367,126368,126369,126372,126375,126379,126422,126424,126425,126426,126358,126427,126428,126429,
				126383,125985,126386,126387,126006,126009,126359,126010,126443,126444,125966,125967,126012,126015,
				126844,126850,126851,126853,126070,125968,125916,125969,126021,126022,125970,125971,126023,126017,
				126024,125973,125976,126020,125979,125981,126025,126026,126058,126061,126360,131080,126059,126062,
				126060,126063,125818,125608,126064,125537,125558,125825,125827,126291,126294,126312,126315,126316,
				126317,126322,126323,126324,126330,126343,126344,126345,125541,125543,125412,129725,126065,125233,
				125128,125061,125057,125053,125133,125149,125152,125158,125160,125150,125638,124971,125174,124790,
				124792,124791,126067,125964,126068,124737,126069,124396,124681,124693,124688,124711,124707,124808,
				124709,124684,124388,124404,124294,126071,124332,124007,124000,124333,124060,124047,124089,124090,
				124105,124107,126946,126951,126952,126955,124015,123902,123908,123700,123609,123912,133134,126066,
				123616,123472,129463,123477,123473,123619,123134,123129,123128,123618,123482,126353,122978,122685,
				122686,122687,122689,122724,122425,122201,121975,121977,121985,126073,126074,121566,121563,126076,
				125671,126079,126090,126080,126081,126082,126083,126085,126086,126087,126088,126089,126091,126075,
				120671,120628,120620,120621,120622,120850,120623,120515,126092,126077,120138,120518,120525,120133,
				120521,120125,120132,120114,120091,120086,120090,120020,126072,126104,126094,126129,126095,126096,
				126097,126098,126099,126100,126101,126126,126102,126103,126114,126115,126105,126128,126116,126117,
				126118,126093,126112,126119,126130,126078,126120,126131,126132,126133,126134,125965,126106,126113,
				126111,126121,126122,126107,125025,102957,126109,126108,126123,124990,126137,126138,126147,126135,
				126136,126125,126139,126143,126144,126150,126145,126140,126148,126141,126146,126149,126142,126162,
				126170,126163,126164,126165,126127,126166,126167,126168,126169,126156,126157,126155,126158,126171,
				126152,126153,126172,126154,126174,126159,126160,126173,126161,126175,126176,126177,126181,126182,
				126183,126205,126184,126185,126186,126187,126188,126189,126190,126206,126191,126192,126207,126193,
				126208,126204,126209,126210,126211,126212,126213,126214,126215,126216,75715,72387,68531,142623,39889,
				141179,39877,39887,4100,3633,142953,137475,140766,139668,140090,140094,142954,6913,53181,120126,
				120386,120883,121216,121743,122165,122208,122470,122951,123402,123827,124617,125229,126416,126467,
				126999,127015,127087,127501,128379,128488,128978,128990,130497,130509,130947,131218,131365,131823,
				132335,132621,132703,132705,133149,133152,133164,133544,133598,134184,134186,135688,137350,139763,
				140657,141095,141435,143076,147067);
		$this->delete_all();
	}
	

}
?>