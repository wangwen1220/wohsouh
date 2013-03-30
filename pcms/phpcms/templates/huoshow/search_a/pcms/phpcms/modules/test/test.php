<?php

class test
{
	private $db;
	public function __construct() {
		pc_base::load_sys_class('db_factory', '', 0);
		$this->dblink = db_factory::get_instance($this->db_config)->get_database('default');
	}
	
	public function getAll()
	{
		$tmp = $this->dblink->getRow("select * from `pre_z_test`");
		var_dump($tmp);die();
	}
	
	public function attachment()
	{
		pc_base::load_sys_class('attachment','',0);
		$this->attachment = new attachment('content','0',1);
		$value = $this->attachment->download('content', "<img src='http://huoshow.com/sdf.jpg' />",1);
	}
	
	public function getImgTest()
	{
		$url = "/upload/2012/0316/1331885012837.JPG";
		thumb($url);
		
	}
	
	public function getContentstr()
	{
		$str = ' <p class="mcePageBreak">&nbsp;</p>sdfafafasf<p class="mcePageBreak">&nbsp;</p>sdfsf';
		$str = getContet($str);
		var_dump($str);
	}
	
	public function testTemplate()
	{
		include template('special','special_css_file');
	}
	
	public function testrequire()
	{
		$a = time();
		for($i=0;$i<10;$i++)
		{
			$aa = require($_SERVER["DOCUMENT_ROOT"]."/caches/caches_commons/caches_data/category_content_1.cache.php");
			//$this->category = getcache('category_content_1','commons');
		}
		echo time()-$a;
	}
	
	public function testPerfor()
	{
		
		
		xhprof_enable();
		xhprof_enable(XHPROF_FLAGS_NO_BUILTINS); //不记录内置的函数
		xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);  //同时分析CPU和Mem的开销
		$xhprof_on = true;
		
		for($i=0;$i<50;$i++)
			$this->category = getcache('category_content_1','commons');
		//var_dump($this->category);
		if($xhprof_on){
			$xhprof_data = xhprof_disable();
			$xhprof_root = PHPCMS_PATH.'/xhprof_html';
			require_once($xhprof_root."/xhprof_lib/utils/xhprof_lib.php");
			require_once($xhprof_root."/xhprof_lib/utils/xhprof_runs.php");
			$xhprof_runs = new XHProfRuns_Default();
			$run_id = $xhprof_runs->save_run($xhprof_data, "hx");
			echo '<a href="http://pnews.ck.huoshow.com/xhprof_html/xhprof_html/index.php?run='.$run_id.'&source=hx" target="_blank">统计</a>';
		}
		
	}
	
	public function testMemcache()
	{
		
		
		$memcache = new Memcache;
		$b = $memcache->connect('127.0.0.1', 11211, 3);
		$aaa = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/caches/caches_commons/caches_data/category_content_1.cache.php");
		$memcache->set("aaa", $aaa, false, 0);
		
		xhprof_enable();
		xhprof_enable(XHPROF_FLAGS_NO_BUILTINS); //不记录内置的函数
		xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);  //同时分析CPU和Mem的开销
		$xhprof_on = true;
		for($i=0;$i<1500;$i++)
		{
			$aa = $memcache->get("aaa");
		}
		if($xhprof_on){
			$xhprof_data = xhprof_disable();
			$xhprof_root = PHPCMS_PATH.'/xhprof_html';
			require_once($xhprof_root."/xhprof_lib/utils/xhprof_lib.php");
			require_once($xhprof_root."/xhprof_lib/utils/xhprof_runs.php");
			$xhprof_runs = new XHProfRuns_Default();
			$run_id = $xhprof_runs->save_run($xhprof_data, "hx");
			echo '<a href="http://pnews.ck.huoshow.com/xhprof_html/xhprof_html/index.php?run='.$run_id.'&source=hx" target="_blank">统计</a>';
		}	
		
	}
	
	public function buildallpage()
	{
		extract($_POST,EXTR_SKIP);
		$this->html = pc_base::load_app_class('html',"content");
		set_time_limit(0);
		$modelid = intval($_POST['modelid']);
		$this->db = pc_base::load_model('content_model');
		$this->categorys = getcache('category_content_1','commons');
		$catid[] = 0;

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
				//setcache('html_show_'.$_SESSION['userid'], $catids,'content');
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
				//setcache('html_show_'.$_SESSION['userid'], $catids,'content');
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
			$this->url = pc_base::load_app_class('url',"content");

			$n=0;
			$count = count($data);
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
				echo "id:".$r['id']."\t$n/$count\n";
				$this->html->show($urls[1],$r,0,'edit',$r['upgrade']);
				
				$n++;
			}
		}
	}
	
	
}

?>