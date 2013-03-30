<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('form','',0);
pc_base::load_sys_class('format','',0);
class search_yxk {
	function __construct() {
		$this->db = pc_base::load_model('search_model');
		$this->content_db = pc_base::load_model('content_model');
	}
	
	/**
	 * 关键词搜索
	 */
	public function init() {
		//获取siteid
		$siteid = isset($_REQUEST['siteid']) && trim($_REQUEST['siteid']) ? intval($_REQUEST['siteid']) : 1;
		
		//搜索配置
		$search_setting = getcache('search');
		$setting = $search_setting[$siteid];

		$search_model = getcache('search_model_'.$siteid);
		$type_module = getcache('type_module_'.$siteid);
		$CATEGORYS = getcache('category_content_'.$siteid,'commons');
		if(isset($_GET['q'])) {
			if(trim($_GET['q'])=='') {
				header('Location: '.APP_PATH.'search_yxk.php?m=search');exit;
			}
			$cat_id = empty($_GET['catid']) ? "all" : $_GET['catid'];
			//状态
			$copytype = empty($_GET['copytype']) ? "all" : $_GET['copytype'];
			//版本
			$language = empty($_GET['language']) ? "all" : $_GET['language'];
			//时间
			$time = empty($_GET['time']) ? "all" : $_GET['time'];
//			$typeid = empty($_GET['typeid']) ? 48 : intval($_GET['typeid']);
//			$time = empty($_GET['time']) || !in_array($_GET['time'],array('all','day','month','year')) ? 'all' : trim($_GET['time']);
			$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
			$recordPerPage = 20;
			
			$q = safe_replace(trim($_GET['q']));
			$q = htmlspecialchars(strip_tags($q));
			$q = str_replace('%', '', $q);	//过滤'%'，用户全文搜索
			$search_q = $q;	//搜索原内容

			if ($cat_id == "all") {
				$cat_sql = "";
			}else {
				$cat_sql = " AND catid=$cat_id";
			}
			if ($copytype == "all") {
				$cop_sql = "";
			}else {
				$cop_sql = " AND copytype LIKE '$copytype%'";
			}
			if ($language == "all") {
				$lan_sql = "";
			}else {
				$lan_sql = " AND `language` LIKE '$language%'";
			}
			$where = $cat_sql.$cop_sql.$lan_sql;
			if ($time == 1) {
				$order_sql = "ORDER BY inputtime desc";
			}elseif ($time == 2 ){
				$order_sql = "ORDER BY stars asc";
			} else {
				$order_sql = "ORDER BY id desc";
			}
			
			$sql = "SELECT count(*) count FROM v9_pcdownload WHERE title LIKE '%$search_q%'$where";
			$countarr = $this->db->sselect($sql);
			$num = $countarr[0]["count"];
			
			$sql = "SELECT * FROM v9_pcdownload WHERE title LIKE '%$search_q%'$where $order_sql LIMIT ".($page-1)*$recordPerPage.",$recordPerPage";
			echo $sql;
			$dc_data = $this->db->sselect($sql);
			$pages = pages($num, $page, $recordPerPage);
			
			include	template('search','game_search_yxk_list');
		} else {
			include	template('search','index');
		}
	}

	
	public function public_get_suggest_keyword() {
		$url = $_GET['url'].'&q='.$_GET['q'];
        //如果查询词中包含非法字符，则直接die
        //这里有个漏洞，可以直接获取任意文件内容
        if(strpos($_GET["q"],"phpsso_server")!=false)
            die("");
		
		$res = @file_get_contents($url);
		if(CHARSET != 'gbk') {
			$res = iconv('gbk', CHARSET, $res);
		}
		echo $res;
	}
	
	/**
	 * 提示搜索接口
	 * TODO 暂时未启用，用的是google的接口
	 */
	public function public_suggest_search() {
		//关键词转换为拼音
		pc_base::load_sys_func('iconv');
		$pinyin = gbk_to_pinyin($q);
		if(is_array($pinyin)) {
			$pinyin = implode('', $pinyin);
		}
		$this->keyword_db = pc_base::load_model('search_keyword_model');
		$suggest = $this->keyword_db->select("pinyin like '$pinyin%'", '*', 10, 'searchnums DESC');
		
		foreach($suggest as $v) {
			echo $v['keyword']."\n";
		}

		
	}
}
?>