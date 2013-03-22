<?php

define('CURSCRIPT', 'purify');

class Purify {
	//常驻属性
	var $version; #current discuz version
	var $cur_date; #current date, etc 2011-09-15
	var $cur_time; #current time, etc 23:24:23
	var $timestamp; #current timestamp
	var $start_time; #current start micro time
	var $action; #act type,for example:predict,feedback etc
	var $cache_dir; #plugin cache dir path
	var $log_file; #log file path
	var $config = array(); #config array
	var $forum = array(); #board identify array
	var $db; #database object
	var $tblpre; #table pre
	var $table = array();

	//var $post = array(); #帖子内容
	//var $pids = array(); #帖子id列表
	//construct function
	function Purify() {
		$this->_init();
	}

	//instance object
	function &singleton() {
		static $obj;
		if (empty($obj)) {
			$obj = new Purify();
		}
		return $obj;
	}

	//init data
	function _init() {
		global $Purify_CONFIG;
		$this->version = HL_VERSION;
		$this->action = "predict";
		$this->format = 'json';
		$this->start_time = hl_float_time();
		$this->timestamp = time();
		$this->cur_date = date("Y-m-d");
		$this->cur_time = date("H:i:s");
		$this->cache_dir = HL_CACHE_ROOT . "/bao10jie";
		$this->log_file = $this->cache_dir . "/log/" . $this->cur_date . '.purify.php';
		//数据库
		$this->init_db();
		//字符集
		$this->config['charset'] = HL_CHARSET;
		//call文件路径
		$this->config['call_path'] = HL_CALL_PATH;
		//帖子url路径
		$this->config['post_path'] = HL_POST_PATH;
		//plugin cache file var
		if (file_exists($this->cache_dir . '/config.inc.php')) {
			require $this->cache_dir . '/config.inc.php';
			$this->config['app_id'] = $Purify_APP_ID;
			$this->config['app_key'] = $Purify_APP_KEY;
			$this->config['app_type'] = $Purify_APP_TYPE;
			$this->config['purify_api'] = $Purify_PREDICT_API;
			$this->config['feedback_api'] = $Purify_FEEDBACK_API;
			$this->config['purify_field'] = $Purify_PURIFY_FIELD;
			$this->config['log_level'] = $Purify_LOG_LEVEL;
			$this->config['timeout'] = $Purify_HTTP_DELAYTIME;
			$this->config['send_interval'] = floor($Purify_HTTP_DELAYTIME / 2);
			$this->config['bbs_domain'] = trim($Purify_BBS_ROOT);
			$this->config['purify_top'] = $Purify_SEND_TOP;
			$this->config['str_num'] = $Purify_SEND_StrNum;
			$this->config['time_limit'] = intval($Purify_TIME_LIMIT);
			$this->config['call_num'] = intval($Purify_CALL_NUM);
			$this->config['try_num'] = intval($Purify_TRY_NUM);
			$this->config['lag_showtime'] = intval($Purify_LAG_SHOWTIME);
			$this->forum = $Purify_BOARDS_IDENTIFY;
		} else {
			$this->config['app_id'] = $Purify_CONFIG['APP_ID'];
			$this->config['app_key'] = $Purify_CONFIG['APP_KEY'];
			$this->config['app_type'] = $Purify_CONFIG['APP_TYPE'];
			$this->config['purify_api'] = $Purify_CONFIG['PREDICT_API'];
			$this->config['feedback_api'] = $Purify_CONFIG['FEEDBACK_API'];
			$this->config['purify_field'] = $Purify_CONFIG['PURIFY_FIELD'];
			$this->config['log_level'] = $Purify_CONFIG['LOG_LEVEL'];
			$this->config['timeout'] = $Purify_CONFIG['HTTP_DELAYTIME'];
			$this->config['send_interval'] = floor($Purify_CONFIG['HTTP_DELAYTIME'] / 2);
			$this->config['bbs_domain'] = trim($Purify_CONFIG['BBS_ROOT']);
			$this->config['purify_top'] = $Purify_CONFIG['SEND_TOP'];
			$this->config['str_num'] = $Purify_CONFIG['SEND_StrNum'];
			$this->config['time_limit'] = intval($Purify_CONFIG['TIME_LIMIT']);
			$this->config['call_num'] = intval($Purify_CONFIG['CALL_NUM']);
			$this->config['try_num'] = intval($Purify_CONFIG['TRY_NUM']);
			$this->config['lag_showtime'] = intval($Purify_CONFIG['LAG_SHOWTIME']);
			$this->forum = $Purify_CONFIG['BOARDS_IDENTIFY'];
		}

		if ($this->config['bbs_domain']) {
			if (substr($this->config['bbs_domain'], 0, 7) != "http://") {
				$this->config['bbs_domain'] = "http://" . $this->config['bbs_domain'];
			}
			if (substr($this->config['bbs_domain'], -1) != "/") {
				$this->config['bbs_domain'] .= "/";
			}
		}
	}
	function init_db(){
		global $discuz, $db, $tablepre;
		if($this->version == "X2" || $this->version == "X1.5"){
			if(!$discuz){
				$discuz = & discuz_core::instance();
				$discuz->cachelist = array();
				$discuz->init();
			}
			$this->db = $discuz->db;
			$this->tblpre = $discuz->db->tablepre;
			//数据表
			$this->table = array(
				'thread' => 'forum_thread',
				'forum' => 'forum_forum'
			);
		}else{
			$this->db = $db;
			$this->tblpre = $tablepre;
			//数据表
			$this->table = array(
				'thread' => 'threads',
				'forum' => 'forums'
			);
		}
		return true;
	}
	//返回数据表全名
	function tblname($tablename){
		if($this->version == "X2" || $this->version == "X1.5"){
			$tablename = $this->db->table_name($tablename);
		}else{
			$tablename = $this->tblpre.$tablename;
		}
		return $tablename;
	}
	//设置日志生成路径及文件名
	function logFileSet($filename) {
		$this->log_file = $this->cache_dir . "/log/" . $this->cur_date . '.' . $filename . '.php';
		return true;
	}


	//执行帖子反馈操作
	function feedback($post) {
		$this->action = "feedback"; #action type,for example:feedback,predict etc
		$this->logFileSet("feedback"); #set log file name
		//log start
		$this->log("/*****" . $this->cur_date . " " . $this->cur_time . "*****/");
		$this->log('feedback function call', true);
		$this->log('pid:[' . $post['pid'] . ']');
		//检查帖子标引必要性
		$checkRes = $this->checkPost($post);
		if (!$checkRes)
		return false;

		//是否主题帖
		//        if ($post['first'] == 1){
		//        	$post['pubaction'] = 1;
		//        } else {
		//        	$post['pubaction'] = 2;
		//        }
		$this->log('prepare to send request', true);
		$params = $this->get_params($post);
		$this->log('params ok', true);

		$url = $this->config['feedback_api'];
		//发送请求
		$resp = $this->send_request($url, $params, 0, 3, false);

		$this->log("complete!");
		return $resp;
	}
	//执行帖子同步操作
	function rsync($pid, $action) {
		//$this->action = "feedback"; #action type,for example:feedback,predict etc
		$this->logFileSet("rsync"); #set log file name
		//log start
		$this->log("/*****" . $this->cur_date . " " . $this->cur_time . "*****/");
		$this->log('rsync function call', true);
		$this->log('pid:[' . $pid . ']');
		
		//从purifyhylanda表获取帖子信息
		$sql = sprintf('SELECT * FROM %s WHERE pid = %s', $this->tblname('purifyhylanda'), $pid);
		$query = $this->db->query($sql);
		$post = $this->db->fetch_array($query);
		#帖子不存在
		if(!$post || !$post['tid']){
			return -2;
		}
		#标引失败,不处理
		if($post['sig']<0){
			return -1;
		}
		
		#获取帖子分表名
		if($this->version == "X2" || $this->version == "X1.5"){
			$posttable = getposttablebytid($post['tid']);
		}else{
			$posttable = 'posts';
		}
		$this->log("post table : ".$posttable, true);
		
		#校验帖子是否存在
		$sql = "SELECT `pid`,`tid`,`first`,`invisible`,`status`,`fid`,`authorid` FROM `".$this->tblname($posttable)."` WHERE `pid`={$pid} LIMIT 0,1";
		$query = $this->db->query($sql);
		$res = $this->db->fetch_array($query);
		#帖子不存在
		if(!$res){
			return -2;
		}
		//临时属性
		$res['posttable'] = $posttable;
		$this->res = $res;
		
		#按操作动作进行更改帖子状态
		if($action==1){#通过
			if($post['status'] == 1){#状态已同步，不用更改
				return 1;
			}
			$upArr = array(
				'invisible'=>0, 
				'status'=>0, 
				'fstatus'=>1,
				'displayorder'=>0
			);
			$this->updateStatus($upArr);
		}elseif($action==2){#删除(前台显示‘已删除’字样)
			if($post['status'] == -1){#状态已同步，不用更改
				return 1;
			}
			$upArr = array(
				'invisible'=>0, 
				'status'=>1,
				'fstatus'=>-1, 
				'displayorder'=>-1
			);
			$this->updateStatus($upArr);
		}elseif($action==3){#删除(前台直接不显示帖子)
			if($post['status'] == -1){#状态已同步，不用更改
				return 1;
			}
			$upArr = array(
				'invisible'=>-1, 
				'status'=>0,
				'fstatus'=>-1,
				'displayorder'=>-1
			);
			$this->updateStatus($upArr);
		}elseif($action==4){#待审
			if($post['status'] == 0){#状态已同步，不用更改
				return 1;
			}
			$upArr = array(
				'invisible'=>-2, 
				'status'=>0,
				'fstatus'=>0, 
				'displayorder'=>-2
			);
			$this->updateStatus($upArr);
		}else{
			$this->log("nothing to do!");
			return 0;
		}
		$this->log("complete!");
		//清除临时属性
		$this->res = 0;
		return 1;
	}
	//更新帖子状态
	function updateStatus($upArr){
		$res = $this->res;
		$posttable = $res['posttable'];
		$this->db->query("UPDATE `".$this->tblname($posttable)."` SET `invisible`={$upArr['invisible']},`status`={$upArr['status']} WHERE `pid`={$res['pid']}");
		if($res['first']){#主题帖
			$this->db->query("UPDATE `".$this->tblname($this->table['thread'])."` SET `displayorder`={$upArr['displayorder']} WHERE `tid`={$res['tid']}");	
		}
		//编辑权限（含时间段）判断
		$mod = $this->modCheck($res['fid']);
		$audit = bindec($mod['thread'] * 10 + $mod['reply']);
		//更新积分
		$this->updateCreditsCount_syc($upArr['displayorder'], $res['tid'], $res['fid'], $res['authorid'], $res['first'], $audit);

		#discuz X2,更新审核状态表,status[0:审核中;1:忽略],通过或删除则删除记录
		if($this->version == "X2"){
			$idtype = $res['first'] ? 'tid' : 'pid';
			$id = $res['first'] ? $res['tid'] : $res['pid'];
			$where = "`id`={$id} and `idtype`='{$idtype}'";
			$sql = "";
			if ($this->db->result_first("SELECT id from `" . $this->tblname('common_moderate') . "` where $where limit 1")) {
				if ($upArr['fstatus'] == 0) {#待审
					$sql = "UPDATE `".$this->tblname('common_moderate')."` SET `status`='0' WHERE $where";
				}else{
					$sql = "DELETE FROM `".$this->tblname('common_moderate')."` WHERE $where";
				}
			} else {//插入
				if ($upArr['fstatus'] == 0) {#待审
					$sql = "INSERT INTO `" . $this->tblname('common_moderate') . "` (`id`,`idtype`,`status`,`dateline`) VALUES ({$id},'{$idtype}',0,{$this->timestamp})";	
				}
			}
			if($sql){
				$this->db->query($sql);
			}
		}
		#更新管理表帖子状态
		$this->db->query("UPDATE `" . $this->tblname('purifyhylanda') . "` SET `status`={$upArr['fstatus']}, `edittime`={$this->timestamp} WHERE `pid`={$res['pid']}");
		return true;
	}
	/*
	 * $displayorder: 帖子状态 0：正常 -1：垃圾 -2：疑似
	 * $tid: 主题ID
	 * $fid: 版块ID
	 * $authorid: 作者ID
	 * $first: 是否为主题帖 1：是  0：否
	 *
	 */
	function updateCreditsCount_syc($displayorder, $tid, $fid, $authorid, $first, $audit){
		global $creditspolicy;#discuz 6 7
		#更新版块帖子数，更新主题回帖数、最新帖子。今天的帖子总数暂时不做更新
		if($tid) updatethreadcount($tid);
		if($fid) updateforumcount($fid);
		#更新用户的发帖数与积分
		$adder = '';
		$act = $first ? 'post' : 'reply';
		if ($displayorder == 0) {#处理成通过
			$adder = '+';
		} else {#处理成删除或待审
			$adder = '-';
		}
		if($this->version == "X2" || $this->version == "X1.5"){
			if ($adder != '') {
				updatepostcredits($adder, $authorid, $act, $fid);
			}
		}else{
			if ($adder != '' && $creditspolicy[$act]) {
				updatepostcredits($adder, $authorid, $creditspolicy[$act]);
			}
		}
		return true;
	}
	function updateCreditsCount($displayorder, $tid, $fid, $authorid, $first, $audit){
		global $creditspolicy;#discuz 6 7
		#更新版块帖子数，更新主题回帖数、最新帖子。今天的帖子总数暂时不做更新
		if($tid) updatethreadcount($tid);
		if($fid) updateforumcount($fid);
		#更新用户的发帖数与积分
		$adder = '';
		$act = $first ? 'post' : 'reply';
		if ($displayorder == 0) {#处理成通过
			if (($audit > 1 && $first) || ($audit % 2 == 1 && !$first)) {#需审核版块
				$adder = '+';
			}
		} else {#处理成删除或待审
			if (($audit < 2 && $first) || ($audit % 2 == 0 && !$first)) {#不需审核版块
				$adder = '-';
			}
		}
		if($this->version == "X2" || $this->version == "X1.5"){
			if ($adder != '') {
				updatepostcredits($adder, $authorid, $act, $fid);
			}
		}else{
			if ($adder != '' && $creditspolicy[$act]) {
				updatepostcredits($adder, $authorid, $creditspolicy[$act]);
			}
		}
		return true;
	}
	function modCheck($fid){
		//发帖或编辑贴权限判断
		$mod = array('thread'=>0, 'reply'=>0);
	    if (periodscheck('postmodperiods', 0)) {#时间段判断
	        $mod['thread'] = $mod['reply'] = 1;
	    } else {#版块和用户组权限判断
	        $query = $this->db->query("SELECT `modnewposts` FROM `".$this->tblname($this->table['forum'])."` WHERE `fid`={$fid} LIMIT 0,1");
	        $forumMod = $this->db->fetch_row($query);
	        if ($forumMod[0] == 2){
	            $mod['thread'] = $mod['thread'] = 1;
	        }elseif ($forumMod[0] == 1){
	            $mod['thread'] = 1;
	        }    
	    }
	    return $mod;
	}
	//执行帖子净化操作
	function run($post) {
		//$this->action = "predict";#action type,for example:feedback,predict etc
		$this->log('run function call', true);
		//检查帖子标引必要性
		$checkRes = $this->checkPost($post);
		if (!$checkRes)
		return false;

		//构造出代理页面的地址
		if (!$this->config['bbs_domain']) {
			$this->log('error for bbs domain null');
			return false;
		}

		// 更新管理表
		if ($this->db->result_first("SELECT pid from `" . $this->tblname('purifyhylanda') . "` where `pid`={$post['pid']} limit 1")) {
			$this->db->query("UPDATE `" . $this->tblname('purifyhylanda') . "` SET `sig`=-1, `fid`={$post['fid']},`isignore`=0, `status`=-3, `updatetime`={$this->timestamp} WHERE `pid`={$post['pid']}");
		} else {// 插入管理表
			$this->db->query("INSERT INTO `" . $this->tblname('purifyhylanda') . "`(`pid`,`updatetime`,`first`,`fid`,`tid`) VALUES ({$post['pid']},{$this->timestamp},{$post['first']},{$post['fid']},{$post['tid']})");
		}

		$post['date'] = date('Y-m-d H:i:s', $post['dateline']);

		//更新缓存表
		if ($this->db->result_first("SELECT pid from `" . $this->tblname('cachehylanda') . "` where pid=" . $post['pid'] . " limit 1")) {
			$upval = "`fid`=".intval($post['fid']);
			$upval .= ",`tid`=".intval($post['tid']);
			$upval .= ",`first`=".intval($post['first']);
			$upval .= ",`audit`=".intval($post['audit']);
			$upval .= ",`title`='".hl_strSlash($post['subject'])."'";
			$upval .= ",`message`='".hl_strSlash($post['message'])."'";
			$upval .= ",`userid`=".intval($post['authorid']);
			$upval .= ",`author`='".$post['author']."'";
			$upval .= ",`ip`='".$post['useip']."'";
			$upval .= ",`date`='".$post['date']."'";
			$upval .= ",`timestamp`=".$this->timestamp;
			$upval .= ",`locked`=0";
			$this->db->query("UPDATE `" . $this->tblname('cachehylanda') . "` SET $upval WHERE `pid`={$post['pid']}");
		} else {//插入缓存表
			$inval = "(`pid`,`fid`,`tid`,`first`,`audit`,`title`,`message`";
			$inval .= ",`userid`,`author`,`ip`,`date`,`timestamp`,`locked`)";
			$inval .= " VALUES ";
			$inval .= "(".intval($post['pid']).",".intval($post['fid']);
			$inval .= ",".intval($post['tid']).",".intval($post['first']);
			$inval .= ",".intval($post['audit']).",'".hl_strSlash($post['subject'])."'";
			$inval .= ",'".hl_strSlash($post['message'])."',".intval($post['authorid']);
			$inval .= ",'".$post['author']."','".$post['useip']."'";
			$inval .= ",'".$post['date']."',".$this->timestamp;
			$inval .= ",0)";
			$this->db->query("INSERT INTO `" . $this->tblname('cachehylanda') . "` ".$inval);
		}


		$this->log('set purifyhylanda ok', true);

		//清除过期锁定
		$timesum = $this->config['time_limit'] * $this->config['call_num'];
		$expires = $this->timestamp - $timesum;
		$this->db->query("UPDATE `" . $this->tblname('cachehylanda') . "` SET `locked`=0 WHERE `timestamp`<{$expires}");

		$this->log('prepare to send request', true);

		//查询数据
		$safetime = $this->timestamp - intval(ceil($timesum/5));#安全时间
		$query = $this->db->query('SELECT pid FROM ' . $this->tblname('cachehylanda') . " WHERE locked = 0 and `timestamp`<{$safetime} ORDER BY pid DESC limit 0," . $this->config['call_num']);

		$pids = '0'; #id串
		$posts = array(); #帖子数组
		while ($row = $this->db->fetch_array($query)) {
			$pids .= ',' . $row['pid'];
			$posts[] = $row['pid'];
		}

		//当前帖子必须发送
		if(!in_array($post['pid'], $posts)){
			$pids .= ',' . $post['pid'];
			$posts[] = $post['pid'];
		}
		//多余检验
		if (!$posts) {
			$this->log('error for no data pufify complete!');
			return false;
		}

		#操作时间更新
		$this->db->query("UPDATE `" . $this->tblname('cachehylanda') . "` SET `timestamp`={$this->timestamp} WHERE `pid` in ({$pids})");
		$callUrl = $this->config['bbs_domain'] . $this->config['call_path'];

		$this->log('send pids:' . $pids);

		#循环处理
		foreach ($posts as $pid) {
			$this->log('start pid:' . $pid, true);

			$callPost = 'sig=' . md5($this->config['app_key']);
			$callPost .= '&pid=' . $pid;
			#调用代理页面，只POST不接收
			$this->send_request($callUrl, $callPost, 0, 3, false);

			$this->log('end pid:' . $pid, true);
		}
		$this->log('purify complete!', true);
		return true;
	}

	// 标记帖子状态
	function mark($pid) {
		$this->log('mark function call', true);
		$pid = intval($pid);
		if (!$pid) {
			$this->log('pid null error');
			return false;
		}
		#sleep
		if ($this->config['lag_showtime']) {
			sleep($this->config['lag_showtime']);
			$this->log('has slept ' . $this->config['lag_showtime'] . ' seconds', true);
		}
		#query cache data
		$query = $this->db->query('SELECT * FROM ' . $this->tblname('cachehylanda') . ' WHERE pid = ' . $pid);
		$post = $this->db->fetch_array($query);

		if (!$post) {
			$this->log('nothing to do, complete!');
			return false;
		}
		#locked
		if ($post['locked']) {
			$this->log('locked, complete!');
			return false;
		}
		#锁定缓存记录,更新管理表发送时间
		$this->db->query("UPDATE `" . $this->tblname('cachehylanda') . "` SET `locked`=1 WHERE `pid`={$post['pid']}");
		$this->db->query("UPDATE `" . $this->tblname('purifyhylanda') . "` SET `sendtime`={$this->timestamp} WHERE `pid`={$post['pid']}");

		$this->log('lock ok', true);

		//是否主题帖
		if ($post['first'] == 1) {
			$post['pubaction'] = 1;
		} else {
			$post['pubaction'] = 2;
		}
		if (!$post['url']) {
			$post['url'] = $this->config['bbs_domain'] . $this->config['post_path'] . $post['tid'];
		}
		$params = $this->get_params($post);
		$this->log('params ok', true);
		//发送请求
		$url = $this->config['purify_api'];
		$resp = $this->send_request($url, $params, 1, $this->config['timeout']);
		$tryNum = 0;
		while (!$resp && $tryNum < $this->config['try_num']) {
			$resp = $this->send_request($url, $params, 1, $this->config['timeout']);
			$tryNum++;
		}

		if (!$resp)
		return false;
		$this->log('prepare parse response', true);

		//解析返回数据
		if ($this->format == 'json') {
			$result = json_decode($resp, true);
		}
		if (!$result) {
			$this->log("error for json decode,data:" . $resp);
			return false;
		}

		$result = (array) current(current(current($result)));

		if (!isset($result['textId'])) {
			$this->log("error for result textId null,data:" . $resp);
			return false;
		}

		if (!isset($result['flag'])) {
			$this->log("error for result flag null,data:" . $resp);
			return false;
		}
		$result['flag'] = intval($result['flag']); //识别结果
		//$result['textId'] = intval($result['textId']);
		//$result['class'] = intval($result['class']);
		if (65535 == $result['flag'])
		$result['flag'] = 127; //已接收状态

		$this->log('mark result parse ok', true);
		//返回标引值不正确
		if ($result['flag'] > 2) {
			$this->log('error for result flag illegal,data:' . $result['flag']);
			return false;
		}
		$flag = $result['flag']; //识别结果
		$fid = $post['fid'];

		$this->log('flag:' . $flag);

		#更新管理表,删除缓存记录
		$this->db->query("UPDATE `" . $this->tblname('purifyhylanda') . "` SET `sig`={$flag},`edittime`={$this->timestamp},`status`=-2 WHERE `pid`={$pid}");
		$this->db->query("DELETE FROM `" . $this->tblname('cachehylanda') . "` WHERE `pid`={$pid}");
		$this->log('update hylanda table ok', true);

		#处理帖子状态,当前版块设置为识别不处理
		if (2 != $this->forum[$fid][0]) {
			$this->log('mark only done');
			return true;
		}

		$idx = (0 == $flag) ? 3 : $flag;
		$status = -2;#默认仅识别
		switch ($this->forum[$fid][$idx]) {
			case 0: // 通过
				$fields = array('status' => 0, 'invisible' => 0);
				$displayorder = 0;
				$status = 1;
				break;
			case 1: // 待审核
				$fields = array('invisible' => -2, 'status' => 0);
				$displayorder = -2;
				$status = 0;
				break;
			case 2: // 删除
				$displayorder = -1;
				$status = -1;
				if ('status' == $this->config['purify_field']) {#删除显示屏蔽字样
					$fields = array('status' => 1, 'invisible' => 0);
				} else {#删除不可见
					$fields = array('invisible' => -1, 'status' => 0);
				}
		}

		#处理帖子状态,当前版块设置为识别并处理
		#更新主题帖状态及最后发布人和发布时间
		if ($post['first']) {
			$sql = "UPDATE `".$this->tblname($this->table['thread'])."` SET `lastpost`={$this->timestamp}, `lastposter`='{$post['author']}',`displayorder`='{$displayorder}', `moderated`='1' WHERE `tid`={$post['tid']}";
			$res1 = $this->db->query($sql);
			if ($res1) {
				$this->log('has update the status of thread table,sql:'.$sql, true);
			}
		}
		#discuz X2,更新审核状态表,status[0:审核中;1:忽略],通过或删除则删除记录
		if($this->version == "X2"){
			$idtype = $post['first'] ? 'tid' : 'pid';
			$id = $post['first'] ? $post['tid'] : $post['pid'];
			$where = "`id`={$id} and `idtype`='{$idtype}'";
			$sql = "";
			if ($this->db->result_first("SELECT id from `" . $this->tblname('common_moderate') . "` where $where limit 1")) {
				if ($status == 0) {#待审
					$sql = "UPDATE `".$this->tblname('common_moderate')."` SET `status`='0' WHERE $where";
				}else{
					$sql = "DELETE FROM `".$this->tblname('common_moderate')."` WHERE $where";
				}
			} else {//插入
				if ($status == 0) {#待审
					$sql = "INSERT INTO `" . $this->tblname('common_moderate') . "` (`id`,`idtype`,`status`,`dateline`) VALUES ({$id},'{$idtype}',0,{$this->timestamp})";	
				}
			}
			if($sql){
				$this->db->query($sql);
			}
		}

		#获取帖子分表名
		if($this->version == "X2" || $this->version == "X1.5"){
			$posttable = getposttablebytid($post['tid']);
		}else{
			$posttable = 'posts';
		}
		$this->log("post table : ".$posttable, true);
		#更新帖子状态
		$res2 = $this->db->query("UPDATE `".$this->tblname($posttable)."` SET `invisible`={$fields['invisible']}, `status`={$fields['status']} WHERE `pid`={$pid}");
		if ($res2) {
			$this->log('has update the status of post table', true);
		}
		#更新管理表帖子状态
		$this->db->query("UPDATE `" . $this->tblname('purifyhylanda') . "` SET `status`={$status} WHERE `pid`={$pid}");
		#更新用户积分
		$this->updateCreditsCount($displayorder, $post['tid'], $post['fid'], $post['userid'], $post['first'], $post['audit']);
		$this->log('has update the credits of member', true);

		#版本信息、主题信息
		//updatemodworks('MOD', $recycles);
		//updatemodlog($post['tid'], 'DEL');

		$this->log('has update count', true);

		$this->log(str_replace(array("\n", "\r", "\t", " "), '', var_export($_POST, TRUE)), true);

		$this->log('mark done');

		return true;
	}

	//获得帖子分表
	function getPostTable($tids){
		global $_G;
		$tables = array();#表名数组
		if(!is_array($tids)) {
			return false;
		}
		$tids = array_unique($tids);
		$tids = array_flip($tids);
		loadcache('threadtableids');
		$threadtableids = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
		if(!in_array(0, $threadtableids)) {
			$threadtableids = array_merge(array(0), $threadtableids);
		}

		foreach($threadtableids as $tableid) {
			$threadtable = $tableid ? "forum_thread_$tableid" : 'forum_thread';
			$query = DB::query("SELECT tid, posttableid FROM ".DB::table($threadtable)." WHERE tid IN(".dimplode(array_keys($tids)).")");
			while ($value = DB::fetch($query)) {
				$posttable = 'forum_post'.($value['posttableid'] ? "_$value[posttableid]" : '');
				$tables[$posttable][$value['tid']] = $value['tid'];
				unset($tids[$value['tid']]);
			}
			if(!count($tids)) {
				break;
			}
		}

		return $tables;
	}
	//SOCKET方式发送数据
	function send_request($url, $post = '', $limit = 1, $timeout = 10, $block = TRUE) {
		$this->log('function send_request run', true);
		$return = '';
		$matches = parse_url($url);
		$host = $matches['host'];
		$path = $matches['path'] ? $matches['path'] . ($matches['query'] ? '?' . $matches['query'] : '') : '/';
		$port = !empty($matches['port']) ? $matches['port'] : 80;
		$cookie = '';
		$ip = '';
		if ($post) {
			$this->log('socket post data ok', true);
			$out = "POST $path HTTP/1.0\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host\r\n";
			$out .= 'Content-Length: ' . strlen($post) . "\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Cache-Control: no-cache\r\n";
			$out .= "Cookie: $cookie\r\n\r\n";
			$out .= $post;
		} else {
			$out = "GET $path HTTP/1.0\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Cookie: $cookie\r\n\r\n";
		}

		if (function_exists('fsockopen')) {
			$this->log('function fsockopen exists', true);
			$fp = fsockopen($host, $port, $errno, $errstr, $timeout);
		} else {
			$fp = null;
			$errstr = "function 'fsockopen' not exists";
		}
		//请求失败
		if (!$fp) {
			$this->log('request url msg[host:' . $host . ',port:' . $port . ',path:' . $path . ']');
			$this->log("error for socket,message:" . $errstr);
			return false;
		}
		$this->log('socket request ok', true);

		$r = fwrite($fp, $out);
		//socket写失败
		if (!$r) {
			@fclose($fp);
			$this->log('error for socket write');
			return false;
		}
		//阻塞或非阻塞模式
		stream_set_blocking($fp, $block);
		//timeout
		stream_set_timeout($fp, $timeout);
		//只写不读,直接返回,注意,此时没有关闭socket线程
		if ($limit == 0) {
			usleep(100000);
			@fclose($fp);
			$this->log('socket write ok and close socket', true);
			return true;
		}

		$this->log('prepare get data from socket', true);
		//从socket管道读数据头
		while (!feof($fp)) {
			if (($header = @fgets($fp)) && ($header == "\r\n" || $header == "\n")) {
				break;
			}
			$state = intval(str_replace(array(' ', 'http/1.0'), '', strtolower($header)));
			if ($state && 302 < $state) {
				$this->log("socket header:" . str_replace(array("\r\n", "\n"), '', $header), true);
			}
		}
		$return = ""; #return value
		//从socket管道读数据
		while (!feof($fp) && $limit > 0) {
			$data = fread($fp, ($limit == 1 || $limit > 8192 ? 8192 : $limit));
			$return .= $data;
			$limit -= strlen($data);
		}

		//获得meta数据
		$status = stream_get_meta_data($fp);
		@fclose($fp);
		//超时
		if ($status['timed_out']) {
			$this->log('error for socket read timeout');
			return false;
		}

		return $return;
	}

	//检查帖子标引必要性
	function checkPost($post, $is_filter) {
		if (!$this->config['app_id'] || !$this->config['app_key']) {
			$msg = "error for appId:[{$this->config['app_id']}]";
			$msg .= " or appKey:[{$this->config['app_key']}]";
			$this->log($msg);
			return false;
		}
		if (!$post || empty($post)) {
			$this->log('error for $post var empty');
			return false;
		}
		if (!$post['pid']) {
			$this->log('error for $post[pid] null in run function');
			return false;
		}
		#如果版块没有配置处理方式时，默认都是：识别不处理，待审、待审、通过
		if (!$this->forum[$post['fid']]) {
			$this->forum[$post['fid']] = array(1, 1, 1, 0);
		}
		// 版块关闭了插件不标引
		if (!$this->forum[$post['fid']][0]) {
			$this->log('this forum is close');
			return false;
		}

		// 草稿的回复不标引
		if ($post['tid'] && $post['invisible'] == -3 && $this->is_draft($post['tid'])) {
			$this->log('draft and not indexing');
			return false;
		}
		// 帖子数据不完整，不标引
		if ('' == $post['message']) {
			$this->log('error for $post[message] null');
			return false;
		}
		// 帖子内容的字符数太少，小于设定值时，不标引
		if ($this->config['str_num'] && hl_pstrLen($post['message']) < $this->config['str_num']) {
			$this->log('character number less than ' . $this->config['str_num'] . ' and exit');
			return false;
		}
		// 帖子为置顶帖，不标引
		if ($this->config['purify_top'] == 0 && $post['first'] == 1) {#判断为主题帖时，是否为置顶状态
			$table = $this->tblname($this->table['thread']);
			$sql = "SELECT `displayorder` FROM `".$table."` WHERE `tid`={$post['tid']} LIMIT 0,1";
			$isTop = $this->db->fetch_array($this->db->query($sql));
			if ($isTop['displayorder'] > 0) {
				$this->log('it belongs to top thread and exit');
				return false;
			}
		}
		return true;
	}

	// 是否是草稿
	function is_draft($tid) {
		$table = $this->tblname($this->table['thread']);
		$sql = 'SELECT displayorder FROM `' . $table . '` WHERE tid = ' . $tid;
		$draft = $this->db->fetch_array($this->db->query($sql));
		return ($draft && ($draft == -4));
	}
	// 获取帖子内容根据PID
	function get_post_pid($pid, $posttable = "forum_post") {
		$fields = 'tid, pid, fid, subject, message, author, authorid, first, useip, status, dateline';
		$sql = sprintf('SELECT %s FROM %s WHERE pid = %s', $fields, $this->tblname($posttable), $pid);
		$query = $this->db->query($sql);
		return $this->db->fetch_array($query);
	}
	//get params
	function get_params($post) {
		$xml = $this->build_xml_data($post);
		$transId = md5(rand(1, 10000));
		$transId .= md5($this->start_time . $post['pid']);

		$params = 'appType=' . $this->config['app_type'];
		$params .= '&appid=' . $this->config['app_id'];
		$params .= '&format=' . $this->format;
		$params .= '&param=' . $xml;
		$params .= '&time=' . $this->timestamp;
		$params .= '&transId=' . $transId;
		$params .= '&v=2.0';

		$sig = md5($params . $this->config['app_key']);
		$this->log("sig:" . $params . $this->config['app_key'], true);

		$params = 'appType=' . $this->config['app_type'];
		$params .= '&appid=' . $this->config['app_id'];
		$params .= '&format=' . $this->format;
		$params .= '&param=' . urlencode($xml);
		$params .= '&time=' . $this->timestamp;
		$params .= '&transId=' . $transId;
		$params .= '&v=2.0';
		$params .= '&sig=' . $sig;

		return $params;
	}

	// 构造XML数据，接口不支持批量，目前都是单条
	function build_xml_data($post) {
		$xml = '<?xml version="1.0" encoding="UTF-8" ?>';
		$xml .= '<contents>';
		$xml .= '<content>';
		if ('feedback' == $this->action) {
			$xml .= '<status><![CDATA[' . $post['status'] . ']]></status>';
			$xml .= '<reason><![CDATA[' . $post['reason'] . ']]></reason>';
		}
		$xml .= '<url><![CDATA[' . $post['url'] . ']]></url>';
		$xml .= '<title><![CDATA[' . stripslashes($post['title']) . ']]></title>';
		$xml .= '<text><![CDATA[' . stripslashes($post['message']) . ']]></text>';
		$xml .= '<userId><![CDATA[' . $post['userid'] . ']]></userId>';
		$xml .= '<author><![CDATA[' . $post['author'] . ']]></author>';
		$xml .= '<class><![CDATA[' . $post['fid'] . ']]></class>';
		$xml .= '<ip><![CDATA[' . $post['ip'] . ']]></ip>';
		$xml .= '<pubDate><![CDATA[' . $post['date'] . ']]></pubDate>';
		$xml .= '<textId><![CDATA[' . $post['pid'] . ']]></textId>';
		$xml .= '<threadId><![CDATA[' . $post['tid'] . ']]></threadId>';
		$xml .= '<authorEx><![CDATA[' . $post['authorex'] . ']]></authorEx>';
		$xml .= '<contentEx><![CDATA[' . $post['contentex'] . ']]></contentEx>';
		$xml .= '<structureEx><![CDATA[' . $post['structureex'] . ']]></structureEx>';
		$xml .= '<rules><![CDATA[' . $post['rules'] . ']]></rules>';
		$xml .= '<pubAction><![CDATA[' . $post['pubaction'] . ']]></pubAction>';
		$xml .= '</content>';
		$xml .= '</contents>';

		$xml = $this->convert($xml);

		return $xml;
	}
	function convert($text, $des = "send"){
		if ('UTF-8' != strtoupper($this->config['charset'])) {
			if($des=='send'){
				if (function_exists('mb_convert_encoding')) {
					$text = mb_convert_encoding($text, 'utf-8', 'gbk');
				} else {
					$text = iconv('gbk', 'utf-8//ignore', $text);
				}
			}else{
				if (function_exists('mb_convert_encoding')) {
					$text = mb_convert_encoding($text, 'gbk', 'utf-8');
				} else {
					$text = iconv('utf-8', 'gbk//ignore', $text);
				}
			}
			
		}
		return $text;
	}
	/*
	 * log function
	 * @param string $text log content
	 * @param bool $debug true or false:debug mode open or close
	 * default false
	 * return empty array
	 */
	function log($text, $debug = false) {
		//log close
		if (!$this->config['log_level'])
		return false;
		$use_time = round((hl_float_time() - $this->start_time) * 1000, 2);
		$text = $use_time . " " . $text;
		if (!file_exists($this->log_file)) {
			$text = "<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>\r\n" . $text;
		}
		$text = $this->convert($text, 'accept');
		//log debug mode
		if ($this->config['log_level'] == 2) {
			file_put_contents($this->log_file, $text . "\r\n", FILE_APPEND);
			return true;
		}
		//default normal mode
		if (!$debug) {
			file_put_contents($this->log_file, $text . "\r\n", FILE_APPEND);
		}
		return true;
	}

}
