<?php
/*
* 帖子净化插件——后台审核
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) exit('Access Denied');

############################
#更改帖子状态的处理
############################
if($pids){
	#帖子的URL地址
	$port = $_SERVER['SERVER_PORT'] == 80 ? '' : ':'.$_SERVER['SERVER_PORT'];
  	$turl = 'http://';
  	$turl .= $_SERVER['SERVER_NAME'];
  	$turl .= $port . rtrim(dirname($_SERVER['REQUEST_URI']), "/\\");
  	$turl .= '/forum.php?mod=viewthread&tid=';
  	
	foreach($pids as $pid){
		$postData = array();
		$pid = abs(intval($pid));#帖子ID
		if($thepid && $thepid != $pid) continue;#当单条处理时，从遍历中取出单条的ID，进行反馈与改变状态
		
		$sig = abs(intval($_POST['sig'.$pid]));#标引：0 1 2 3 
		$sts = abs(intval($_POST['sts'.$pid]));#处理动作  0 1 2 3 
		$first = abs(intval($_POST['first'.$pid]));#是否为主帖
		$tid = abs(intval($_POST['threadid'.$pid]));#主帖ID
		$fid = abs(intval($_POST['class'.$pid]));
		$uid = abs(intval($_POST['userid'.$pid]));

		if($thepid) {
			$sts = $thests;
			$pid = $thepid;
		}
		if(!$sts){#设置帖子的已确认状态，不做其它任何处理
			//DB::query("UPDATE ".DB::table('purifyhylanda')." SET isignore=1 WHERE pid={$pid}");
			continue;
		}
		if($sts == 3){#设置帖子的忽略状态，不做其它任何处理
			DB::query("UPDATE ".DB::table('purifyhylanda')." SET isignore=2 WHERE pid={$pid}");
			continue;
		}
		
		#设置帖子的状态
		$displayorder = $invisible = $status = $fstatus = 0;
		if(1 == $sts){#通过
			$displayorder = 0;
			$invisible = 0;
			$status = 0;
			$fstatus = 1;
		}elseif(2 == $sts){#删除
			$displayorder = -1;#主帖，忽略状态（即前台不显示状态）
			if('status' == $Purify_PURIFY_FIELD) 
				$status = 1;#主帖或回帖，屏蔽状态（即前台显示‘已被删除状态’）
			else 
				$invisible = -1;#回帖，忽略状态（即前台不显示状态）
			$fstatus = -1;
		}

		#更新主贴表中标识垃圾的字段
		if(1 == $first){
			DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder={$displayorder},lastposter='{$_POST['author'.$pid]}' WHERE tid={$tid}");
		}
		#discuz x2
		if(DISCUZ_VERSION == "X2" && ($sts==1 || $sts==2)){
			#更新审核状态
			$id = ($first==1) ? $tid : $pid;
			$idtype = ($first==1) ? 'tid' : 'pid';
			DB::delete('common_moderate', array('id' => $id, 'idtype' => $idtype));
		}

		#获取帖子分表名
		$posttable = getposttablebytid($tid);
		#更新帖子表中标识垃圾的字段,进行恢复操作时将两字段都弄成0,进行删除时仅对配置的字段更改成对应的值
		DB::query("UPDATE ".DB::table($posttable)." SET status={$status}, invisible={$invisible} WHERE pid={$pid}");
		#更新用户的发帖数与积分
		if(DB::affected_rows()){
			$adder = '';
			$act = 'reply';
			if($first) $act = 'post';
			$oldStatus = abs(intval($_POST['isit'.$pid]));
			
			if($oldStatus > 1 && $sts == 1){#对已待审与已删除的帖子，进行通过操作
				$adder = '+';
				
			}elseif($oldStatus == 1 && $sts == 2){#对已通过的帖子，进行删除操作	
				$adder = '-';
			}

			if($adder != ''){
				updatepostcredits($adder, $uid, $act, $fid);
			}
		}
		
		#将帖子的是否处理过的状态设置为‘已人工处理’及status字段
		DB::query("UPDATE ".DB::table('purifyhylanda')." SET isignore=1 WHERE pid={$pid}");
		#更新管理表status字段
		if($fstatus){
			DB::query("UPDATE ".DB::table('purifyhylanda')." SET status={$fstatus} WHERE pid={$pid}");
		}
		
		
		#更新主题的总数，更新版块的帖子总数
		$recycles = DB::affected_rows();
//		updatemodworks('MOD', $recycles);
//		if($tid) updatemodlog($tid, 'DEL');
		
		if($tid) updatethreadcount($tid);
		if($fid) updateforumcount($fid);
		
		#当帖子标引的状态与处理的动作不一致时，就提交反馈，否则只改变状态
		if($sts && $sig != 128 && $sts != $sig){
            $postData['pid'] = $pid;
            $postData['tid'] = intval($_POST['threadid'.$pid]);
			$postData['status'] = $sts;
			$postData['url'] = $turl . $tid;
			$postData['title'] = $_POST['title'.$pid];
			$postData['message'] = stripslashes($_POST['text'.$pid]);
			$postData['author'] = $_POST['author'.$pid];
			$postData['userid'] = $_POST['userid'.$pid];
			$postData['fid'] = $_POST['class'.$pid];
			$postData['ip'] = $_POST['ip'.$pid];
			$postData['date'] = $_POST['date'.$pid];
			$postData['reason'] = stripslashes(strip_tags(trim($_POST['reasons'.$pid])));
			
			$update = 0;#是否反馈成功
			
			//调用反馈接口
			$HL_Purify->feedback($postData);
		}
	
		#发送操作理由	
		$pm = array();
		if($_POST['reasons'.$pid] != '' && $_POST['author'.$pid]){
			$pm['action'] = 'modthreads_validate';
			$pm['authorid'] = intval($_POST['userid'.$pid]);

			if($sts == 2 || $sts == 4) $pm['action'] = 'modthreads_delete';
			$pm['notevar'] = array(
				'tid' => intval($_POST['threadid'.$pid]), 
				'threadsubject' => $_POST['tsubject'.$pid], 
				'reason' => dhtmlspecialchars($_POST['reasons'.$pid]),
			);
			$reason = $pm['notevar']['reason'];
			$post = $pm['notevar']['threadsubject'];
			$tid = $pm['notevar']['tid'];

			notification_add($pm['authorid'], 'system', $pm['action'], $pm['notevar'], 1);

		}

	}
}


############################
#以下为列出帖子的处理
############################

#初始化url参数
$url = "admin.php?action=plugins&operation=config&do=15&identifier=bao10jie&pmod=admin_feedback&sel_page={$pn}&it={$it}";
#初始化where参数
$where = "1";
//开启分表功能,某些查询关闭
if(!$Purify_MULTI_POST){
	if($selWord != ''){
		$selWords = stripslashes($selWord);
		$selWord = mysql_escape_string($selWord);
		$selWord = str_replace(array('%', '_'), array('\%', '\_'), $selWord);
		$where .= " AND (p.`message` like '%{$selWord}%' or p.`subject` like '%{$selWord}%')";
		$selWord = $selWords;
		$url .= '&sel_word='.$selWord;
	}
	if($selAuthor != ''){
		$selAuthors = stripslashes($selAuthor);
		$selAuthor = mysql_escape_string($selAuthor);
		$where .= " AND p.`author`='{$selAuthor}'";
		$selAuthor = $selAuthors;
		$url .= '&sel_author='.$selAuthor;
	}
	if($selIp != ''){
		$selIps = stripslashes($selIp);
		$selIp = mysql_escape_string($selIp);
		$where .= " AND p.`useip` like '%{$selIp}%'";
		$selIp = $selIps;
		$url .= '&sel_ip='.$selIp;
	}
}

if(!$it){
	if(!$selTime) $selTime = 24;
	if(!$selState) $selState = 3;
	if(!$selDoer) $selDoer = 1;
}
if($selFtime || $selTtime){
	if($selFtime){
		$where .= " AND f.`updatetime`>='".strtotime($selFtime)."'";
		$url .= '&sel_ftime='.$selFtime;
	}
	if($selTtime){
		$selTtime = strtotime($selTtime) + 86400 -1;
		$where .= " AND f.`updatetime`<=".$selTtime;
		$selTtime = date('Y-m-d', $selTtime);
		$url .= '&sel_ttime='.$selTtime;
	}
}else{
	$where .= " AND f.`updatetime`>='".($_SERVER['REQUEST_TIME'] - $selTime * 3600)."'";
	$url .= '&sel_time='.$selTime;
}
if($selPid > 0){
	$where .= " AND f.`pid`={$selPid}";
	$url .= '&sel_pid='.$selPid;
}
if($selBoard > 0){
	$where .= ' AND f.`fid`=' . $selBoard;
	$url .= '&sel_board='.$selBoard;
}
if($selMode > 0){
	if($selMode == 4){
		$where .= " AND f.`sig`=-1";
	}else{
		$where .= " AND f.`sig`=" . ($selMode-1);
	}
	$url .= '&sel_mode='.$selMode;
}
if($selState > 0){
	if($selState == 1){#通过
		$where .= " AND f.`status`=1";
	}elseif($selState == 2){#删除
		$where .= " AND f.`status`=-1";
	}elseif($selState == 3){#待审
		$where .= " AND f.`status`=0";
	}elseif($selState == 5){#仅识别
		$where .= " AND f.`status`=-2";
	}elseif($selState == 6){#未识别
		$where .= " AND f.`status`=-3";
	}
	$url .= '&sel_state='.$selState;
}
if($selType){
	$where .= ' AND f.`first`=' . ($selType-1);
	$url .= '&sel_type='.$selType;
}
if($selDoer > 0){
	if($selDoer < 4){
		$where .= ' AND f.`isignore`=' . ($selDoer-1);
	}
	$url .= '&sel_doer='.$selDoer;
}

//开启分表功能
if($Purify_MULTI_POST){
	#查询总数的SQL语句
	$sql_cnt = "SELECT count(*) as cnt 
	FROM `".DB::table('purifyhylanda')."` f 
	WHERE $where";
}else{
	#查询总数的SQL语句
	$sql_cnt = "SELECT count(*) as cnt 
	FROM `".DB::table('purifyhylanda')."` f
	INNER JOIN `".DB::table('forum_post')."` p ON p.`pid`=f.`pid`
	WHERE $where";
}
#查询符合条件的总数
$total = DB::result_first($sql_cnt);
if(!$pn) $pn = 20;
if(!$pg) $pg = 1;
if($total > 0){
	$tpg = ceil($total / $pn);
	if($pg > $tpg) {
		$pg = $tpg;
	}
}
#分页处理
$pger = new Pager;
if($total > 0){
	$pger->set_page($pn, 5, $url);
	$pger->set_style(12);
	$pager = $pger->print_page($total, $pg);
}

#查询符合条件的帖子的起始记录数
$from = $pn * ($pg - 1);
#计算当前页应该显示的记录数
$displayNum = ($from+$pn)>$total ? ($total-$from) : $pn;
#要查询的数据表名数组
$postTblArr = array();
#开启分表
if($Purify_MULTI_POST){
	//获得tid列表
	$tidsArr = array();
	$sql_tid .= "SELECT tid FROM `".DB::table('purifyhylanda')."` f 
	WHERE $where order by f.`updatetime` desc limit " . $from . ',' . $pn;
	$tidQuery = DB::query($sql_tid);
	while($tarr = DB::fetch($tidQuery)){
		$tidsArr[] = $tarr['tid'];
	}
	#获得帖子分表名数组
	$postTblArr = $HL_Purify->getPostTable($tidsArr);
	//file_put_contents("E:\log.txt", var_export($postTblArr, true));
}else{
	$postTblArr['forum_post'][0] = 0;
}

#帖子记录数组
$data = array();
#遍历表查询
if($postTblArr){
	foreach($postTblArr as $key => $val){
		#查询数据的SQL语句
		$sql = "SELECT p.`pid`,p.`tid`,p.`fid`,p.`author`,p.`authorid`,p.`subject`,p.`message`,
p.`useip`,p.`dateline`,p.`first`,p.`fid`,p.`status`,p.`invisible`,p.attachment,
p.htmlon,p.smileyoff,p.bbcodeoff,
m.name AS forumname,m.allowsmilies,m.allowhtml,m.allowbbcode,m.allowimgcode,
t.subject AS tsubject, t.displayorder,
f.`sig` AS sig, f.isignore, f.`sendtime`, f.`updatetime`,f.`status` as fstatus    
FROM `".DB::table('purifyhylanda')."` f 
INNER JOIN `".DB::table($key)."` p ON f.`pid`=p.`pid`
INNER JOIN `".DB::table('forum_thread')."` t ON t.`tid`=p.`tid`
INNER JOIN `".DB::table('forum_forum')."` m ON m.`fid`=p.`fid`
WHERE $where order by f.`updatetime` desc limit " . $from . ',' . $pn;
		$qy_res = DB::query($sql);
		while($row = DB::fetch($qy_res)){
			$data[] = $row;
		}
		if(!(count($data)<$displayNum)){
			break;
		}
	}
}
#真实数据数组
$res = array();
if($data){
	#解析帖子内容
	require_once libfile('function/forumlist');
	require_once libfile('function/post');
	require_once libfile('function/misc');
	require_once libfile('function/discuzcode');
	require_once libfile('class/censor');
	$censor = & discuz_censor::instance();
	$censor->highlight = '#FF0000';
	
	$sort = array();#排序键
	foreach($data as $post){
		$post['theauthor'] = $post['author'];
		if($post['authorid'] && $post['author']) {
			$post['author'] = "<a href=\"home.php?mod=space&do=profile&uid=$post[authorid]\" target=\"_blank\">$post[author]</a>";
		} elseif($post['authorid'] && !$post['author']) {
			$post['author'] = "<a href=\"home.php?mod=space&do=profile&uid=$post[authorid]\" target=\"_blank\">$lang[anonymous]</a>";
		} else {
			$post['author'] = $lang['guest'];
		}
		
		$post['title'] = $post['subject'];
		$post['subject'] = $post['subject'] ? $post['subject'] : $lang['nosubject'];
		$post['messages'] = htmlspecialchars($post['message']);
		$post['message'] = discuzcode($post['message'], $post['smileyoff'], $post['bbcodeoff'], sprintf('%00b', $post['htmlon']), $post['allowsmilies'], $post['allowbbcode'], $post['allowimgcode'], $post['allowhtml']);
		
		$censor->check($post['tsubject']);
		$censor->check($post['message']);
		$post_censor_words = $censor->words_found;
		if(count($post_censor_words) > 3) {
			$post_censor_words = array_slice($post_censor_words, 0, 3);
		}
		$post['censorwords'] = implode(', ', $post_censor_words);
		$post['modthreadkey'] = modauthkey($post['tid']);
		$post['luseip'] = $post['useip'];
		$post['useip'] = $post['useip'] . '-' . convertip($post['useip']);
	
		if($post['attachment']) {
			require_once libfile('function/attachment');
			#discuz x2
			if(DISCUZ_VERSION == "X2"){
				if($post['first'] == 1){
					$queryattach = DB::query("SELECT aid, filename, filesize, attachment, isimage, remote FROM ".DB::table(getattachtablebytid($post['tid']))." WHERE tid='$post[tid]'");
				}else{
					$queryattach = DB::query("SELECT aid, filename, filesize, attachment, isimage, remote FROM ".DB::table(getattachtablebytid($post['tid']))." WHERE pid='$post[pid]'");
				}
			}
			#discuz x1.5
			if(DISCUZ_VERSION == "X1.5"){
				$queryattach = DB::query("SELECT aid, filename, filetype, filesize, attachment, isimage, remote FROM ".DB::table('forum_attachment')." WHERE pid='$post[pid]'");
			}
			
			while($attach = DB::fetch($queryattach)) {
				$_G['setting']['attachurl'] = $attach['remote'] ? $_G['setting']['ftp']['attachurl'] : $_G['setting']['attachurl'];
				$attach['url'] = $attach['isimage']
				? " $attach[filename] (".sizecount($attach['filesize']).")<br /><br /><img src=\"".$_G['setting']['attachurl']."forum/$attach[attachment]\" onload=\"if(this.width > 400) {this.resized=true; this.width=400;}\">"
				: "<a href=\"".$_G['setting']['attachurl']."forum/$attach[attachment]\" target=\"_blank\">$attach[filename]</a> (".sizecount($attach['filesize']).")";
				if(DISCUZ_VERSION == "X2"){
					$post['message'] .= "<br /><br />$lang[attachment]: ".attachtype(fileext($attach['filename'])).$attach['url'];
				}
				if(DISCUZ_VERSION == "X1.5"){
					$post['message'] .= "<br /><br />$lang[attachment]: ".attachtype(fileext($attach['filename'])."\t".$attach['filetype']).$attach['url'];
				}
				
			}
		}
		
		if(count($post_censor_words)) {
			$post_censor_text = "<span style=\"color: red;\">({$post['censorwords']})</span>";
		} else {
			$post_censor_text = '';
		}
	
		$post['text'] = htmlspecialchars($post['message']);
		$post['dateline'] = date('Y-m-d H:i:s', $post['dateline']);
		$post['sendtime'] = date('Y-m-d H:i:s', $post['sendtime']);
	    if('' != $post['sig']) $post['sig']++;
	    else $post['sig'] = 0;
	
	    #帖子当前状态
		if(($post['status'] == 0 || $post['status'] == 4) && $post['invisible'] == 0) $post['isit'] = 1;#正常
		elseif($post['first'] == 1){
			if($post['displayorder'] == -2 || $post['displayorder'] == -3) $post['isit'] = 2;#待审
			if($post['displayorder'] == -1) $post['isit'] = 3;#已删除
		}
		elseif($post['first'] == 0){
			if($post['invisible'] == -2 || $post['invisible'] == -3) $post['isit'] = 2;#待审
			if($post['invisible'] == -1 || $post['status'] == 1) $post['isit'] = 3;#已删除
		}
		else $post['isit'] = 4;#已删除
	
		$res[] = $post;
	}
}
//排序
if($res){
	foreach($res as $key=>$val){
		$sort_desc[$key] = $val['updatetime'];
		$sort_asc[$key] = $val['pid'];
	}
	array_multisort($sort_desc, SORT_DESC, $sort_asc, SORT_DESC, $res);
}
#查询出操作理由
$tipopts = modreasonselect(1);
#查询出版块
$sql = "SELECT `fid`, `name` FROM `".DB::table('forum_forum')."` WHERE 1 and type<>'group' and status=1";
$qy = DB::query($sql);
while($row = DB::fetch($qy)){
	$boards[$row['fid']] = $row;
}
#解析到模板
include HL_PLUGIN_ROOT.HL_DS.'template'.HL_DS.'feedback.tpl.php';

