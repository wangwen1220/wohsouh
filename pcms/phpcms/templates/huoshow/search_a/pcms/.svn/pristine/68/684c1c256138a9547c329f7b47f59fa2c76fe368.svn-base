<?php
defined('IN_PHPCMS') or exit('No permission resources.');

pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('form','',0);

class MY_create_html extends create_html {

	public function __construct() {
			parent::__construct();
			
	}
	
	
	/**
	* 生成内容页
	*/
	public function show() {
		if(isset($_POST['dosubmit'])) {
			extract($_POST,EXTR_SKIP);
			$this->html = pc_base::load_app_class('html');
			set_time_limit(0);
			$modelid = intval($_POST['modelid']);
			if($modelid) {
				//设置模型数据表名
				$this->db->set_model($modelid);
				$table_name = $this->db->table_name;

				if($type == 'lastinput') {
					$offset = 0;
				} else {
					$page = max(intval($page), 1);
					$offset = $pagesize*($page-1);
				}
				$where = ' WHERE status=99 ';
				$order = 'ASC';
				
				if(!isset($first) && is_array($catids) && $catids[0] > 0)  {
					setcache('html_show_'.$_SESSION['userid'], $catids,'content');
					$catids = implode(',',$catids);
					$where .= " AND catid IN($catids) ";
					$first = 1;
				} elseif(count($catids)==1 && $catids[0] == 0) {
					$catids = array();
					foreach($this->categorys as $catid=>$cat) {
							if($cat['child'] || $cat['siteid'] != $this->siteid || $cat['type']!=0) continue;
								$setting = string2array($cat['setting']);
								if(!$setting['content_ishtml']) continue;
							$catids[] = $catid;
						}
					//print_r($catids);
					setcache('html_show_'.$_SESSION['userid'], $catids,'content');
					$catids = implode(',',$catids);
					$where .= " AND catid IN($catids) ";
					$first = 1;
				} elseif($first) {
					$catids = getcache('html_show_'.$_SESSION['userid'],'content');
					$catids = implode(',',$catids);
					$where .= " AND catid IN($catids) ";
				} else {
					$first = 0;
				}
				if(count($catids)==1 && $catids[0]==0) {
					$message = L('create_update_success');
					$forward = '?m=content&c=create_html&a=show';
					showmessage($message,$forward);
				}
				if($type == 'lastinput' && $number) {
					$offset = 0;
					$pagesize = $number;
					$order = 'DESC';
				} elseif($type == 'date') {
					if($fromdate) {
						$fromtime = strtotime($fromdate.' 00:00:00');
						$where .= " AND `inputtime`>=$fromtime ";
					}
					if($todate) {
						$totime = strtotime($todate.' 23:59:59');
						$where .= " AND `inputtime`<=$totime ";
					}
				} elseif($type == 'id') {
					$fromid = intval($fromid);
					$toid = intval($toid);
					if($fromid) $where .= " AND `id`>=$fromid ";
					if($toid) $where .= " AND `id`<=$toid ";
				}
				if(!isset($total) && $type != 'lastinput') {
					$rs = $this->db->query("SELECT COUNT(*) AS `count` FROM `$table_name` $where");
					$result = $this->db->fetch_array($rs);
					
					$total = $result[0]['count']; 
					$pages = ceil($total/$pagesize);
					$start = 1;
				}
				//var_dump("SELECT * FROM `$table_name` $where ORDER BY `id` $order LIMIT $offset,$pagesize");die();
				$rs = $this->db->query("SELECT * FROM `$table_name` $where ORDER BY `id` $order LIMIT $offset,$pagesize");
				$data = $this->db->fetch_array($rs);
				$tablename = $this->db->table_name.'_data';
				$this->url = pc_base::load_app_class('url');
				foreach($data as $r) {
					if($r['islink']) continue;
					$this->db->table_name = $tablename;
					$r2 = $this->db->get_one(array('id'=>$r['id']));
					if($r) $r = array_merge($r,$r2);
					if($r['upgrade']) {
						$urls[1] = $r['url'];
					} else {
						$urls = $this->url->show($r['id'], '', $r['catid'],$r['inputtime']);
					}
					$this->html->show($urls[1],$r,0,'edit',$r['upgrade']);
				}

				if($pages > $page) {
					$page++;
					$http_url = get_url();
					$creatednum = $offset + count($data);
					$percent = round($creatednum/$total, 2)*100;

					$message = L('need_update_items',array('total'=>$total,'creatednum'=>$creatednum,'percent'=>$percent));
					$forward = $start ? "?m=content&c=create_html&a=show&type=$type&dosubmit=1&first=$first&fromid=$fromid&toid=$toid&fromdate=$fromdate&todate=$todate&pagesize=$pagesize&page=$page&pages=$pages&total=$total&modelid=$modelid" : preg_replace("/&page=([0-9]+)&pages=([0-9]+)&total=([0-9]+)/", "&page=$page&pages=$pages&total=$total", $http_url);
				} else {
					delcache('html_show_'.$_SESSION['userid'],'content');
					$message = L('create_update_success');
					$forward = '?m=content&c=create_html&a=show';
				}
				showmessage($message,$forward,200);
			} else {
				//当没有选择模型时，需要按照栏目来更新
				if(!isset($set_catid)) {
					if($catids[0] != 0) {
						$update_url_catids = $catids;
					} else {
						foreach($this->categorys as $catid=>$cat) {
							if($cat['child'] || $cat['siteid'] != $this->siteid || $cat['type']!=0) continue;
								$setting = string2array($cat['setting']);
								if(!$setting['content_ishtml']) continue;
							$update_url_catids[] = $catid;
						}
					}
					setcache('update_html_catid'.'-'.$this->siteid.'-'.$_SESSION['userid'],$update_url_catids,'content');
					$message = L('start_update');
					$forward = "?m=content&c=create_html&a=show&set_catid=1&pagesize=$pagesize&dosubmit=1";
					showmessage($message,$forward,200);
				}
				if(count($catids)==1 && $catids[0]==0) {
					$message = L('create_update_success');
					$forward = '?m=content&c=create_html&a=show';
					showmessage($message,$forward,200);
				}
				$catid_arr = getcache('update_html_catid'.'-'.$this->siteid.'-'.$_SESSION['userid'],'content');
				$autoid = $autoid ? intval($autoid) : 0;
				if(!isset($catid_arr[$autoid])) showmessage(L('create_update_success'),'?m=content&c=create_html&a=show',200);
				$catid = $catid_arr[$autoid];
				
				$modelid = $this->categorys[$catid]['modelid'];
				//设置模型数据表名
				$this->db->set_model($modelid);
				$table_name = $this->db->table_name;

				$page = max(intval($page), 1);
				$offset = $pagesize*($page-1);
				$where = " WHERE status=99 AND catid='$catid'";
				$order = 'ASC';
				
				if(!isset($total)) {
					$rs = $this->db->query("SELECT COUNT(*) AS `count` FROM `$table_name` $where");
					$result = $this->db->fetch_array($rs);
					$total = $result[0]['count']; 
					$pages = ceil($total/$pagesize);
					$start = 1;
				}
				$rs = $this->db->query("SELECT * FROM `$table_name` $where ORDER BY `id` $order LIMIT $offset,$pagesize");
				$data = $this->db->fetch_array($rs);
				$tablename = $this->db->table_name.'_data';
				$this->url = pc_base::load_app_class('url');
				foreach($data as $r) {
					if($r['islink']) continue;
					//写入文件
					$this->db->table_name = $tablename;
					$r2 = $this->db->get_one(array('id'=>$r['id']));
					if($r2) $r = array_merge($r,$r2);
					if($r['upgrade']) {
						$urls[1] = $r['url'];
					} else {
						$urls = $this->url->show($r['id'], '', $r['catid'],$r['inputtime']);
					}
					$this->html->show($urls[1],$r,0,'edit',$r['upgrade']);
				}
				if($pages > $page) {
					$page++;
					$http_url = get_url();
					$creatednum = $offset + count($data);
					$percent = round($creatednum/$total, 2)*100;
					$message = '【'.$this->categorys[$catid]['catname'].'】 '.L('have_update_items',array('total'=>$total,'creatednum'=>$creatednum,'percent'=>$percent));
					$forward = $start ? "?m=content&c=create_html&a=show&type=$type&dosubmit=1&first=$first&fromid=$fromid&toid=$toid&fromdate=$fromdate&todate=$todate&pagesize=$pagesize&page=$page&pages=$pages&total=$total&autoid=$autoid&set_catid=1" : preg_replace("/&page=([0-9]+)&pages=([0-9]+)&total=([0-9]+)/", "&page=$page&pages=$pages&total=$total", $http_url);
				} else {
					$autoid++;
					$message = L('start_update').$this->categorys[$catid]['catname']." ...";
					$forward = "?m=content&c=create_html&a=show&set_catid=1&pagesize=$pagesize&dosubmit=1&autoid=$autoid";
				}
				showmessage($message,$forward,200);
			}

		} else {
			$show_header = $show_dialog  = '';
			$admin_username = param::get_cookie('admin_username');
			$modelid = isset($_GET['modelid']) ? intval($_GET['modelid']) : 0;
			
			$tree = pc_base::load_sys_class('tree');
			$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
			$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
			$categorys = array();
			if(!empty($this->categorys)) {
				foreach($this->categorys as $catid=>$r) {
					if($this->siteid != $r['siteid'] || ($r['type']!=0 && $r['child']==0)) continue;
					if($modelid && $modelid != $r['modelid']) continue;
					if($r['child']==0) {
						$setting = string2array($r['setting']);
						if(!$setting['content_ishtml']) continue;
					}
					$r['disabled'] = $r['child'] ? 'disabled' : '';
					$categorys[$catid] = $r;
				}
			}
			$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";

			$tree->init($categorys);
			$string .= $tree->get_tree(0, $str);
			include $this->admin_tpl('create_html_show');
		}

	}
	
	
	
	/**
	 * 批量生成静态页，而不用管具体是哪个catid
	 * 内部调用batch_show
	 * 
	 */
	public function batch_show_global()
	{
		$ids = $_POST["ids"];
		$ids_str = implode(',', $ids);
		$sql = "select id,catid from v9_global_id where id in ($ids_str)";
		$dbarr = $this->db->sselect($sql);
		$map_id_catid = array();
		foreach ($dbarr as $k=>$v)
		{
			$map_id_catid[$v["id"]] = $v["catid"];
		}
		$count = count($ids);
		$_POST["dosubmit"] = 1;
		
		for($i=0;$i<$count;$i++)
		{
			$_GET['catid'] = $map_id_catid[$ids[$i]];
			$_GET['showmsg'] = "no";
			$this->batch_show();
		}
		showmessage(L('operation_success'),HTTP_REFERER);
	}
	
	/**
	 * 批量生成内容页
	 */
	public function batch_show() {
		if(isset($_POST['dosubmit'])) {
			$catid = intval($_GET['catid']);
			if(!$catid) showmessage(L('missing_part_parameters'));
			$modelid = $this->categorys[$catid]['modelid'];
			$setting = string2array($this->categorys[$catid]['setting']);
			$content_ishtml = $setting['content_ishtml'];
			if($content_ishtml) {
				$this->url = pc_base::load_app_class('url');
				$this->db->set_model($modelid);
				
				if(empty($_POST['ids'])) showmessage(L('you_do_not_check'));
				$this->html = pc_base::load_app_class('html');
				$ids = implode(',', $_POST['ids']);
				$rs = $this->db->select("catid='$catid' AND id IN ($ids)");
				$tablename = $this->db->table_name.'_data';
				foreach($rs as $r) {
					if($r['islink']) continue;
					$this->db->table_name = $tablename;
					$r2 = $this->db->get_one(array('id'=>$r['id']));
					if($r2) $r = array_merge($r,$r2);
					//判断是否为升级或转换过来的数据
					if(!$r['upgrade']) {
						$urls = $this->url->show($r['id'], '', $r['catid'],$r['inputtime']);
					} else {
						$urls[1] = $r['url'];
					}
					$this->html->show($urls[1],$r,0,'edit',$r['upgrade']);
				}
				$showmsg = $_GET["showmsg"];
				if($showmsg!="no")
					showmessage(L('operation_success'),HTTP_REFERER);
			}
		}
	}
}
?>