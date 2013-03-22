<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_duixian.php 16352 2011-01-07 11:00:19Z zhouyc $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if(empty($operation)){
	$operation = 'index';
}

if ($operation=='index'){
	cpheader();
	shownav('extended', '魅力指数');
	//showsubmenu('上月魅力指数排行', array());
	echo '
		<ul class="tab1">
			<li class="current"><a href="admin.php?action=charm"><span>上月魅力指数</span></a></li>
			<li ><a href="admin.php?action=charm&operation=yesterday"><span>昨天魅力指数</span></a></li>
		</ul>';
	showformheader('charm');
	showtableheader();
	?>
	<script src="static/js/calendar.js" type="text/javascript"></script>
	<table border="0">
		<form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=charm" method="post">
			<tr style="background:#DEEFFB;">
				<td><strong>名称：</strong><input type="text" name="username" size="15" value="<?echo $username;?>"/>&nbsp;&nbsp;</td>
				<td><strong>人数：</strong><input type="text" name="number" size="15" value="<?echo $number;?>"/>&nbsp;</td>
				<td><input type="submit" name="submit" value="搜索" /></td>
			</tr>
		</form>
	</table>
	<?php
	$username = $_G['gp_username'];
	$number = $_G['gp_number'];
	//$number = empty($_G['gp_number']) ? '20' : $_G['gp_number'];
	//print_r($_POST);
	showformheader('charm');
	showtableheader();
	//$_G['setting']['memberperpage'] = 20;
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $number;
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	
	$condition='';
	$summary='';
	if ($username){
		$condition = $condition."AND nickname like '%$username%' ";
		$act .= "&username=".$username;
	}
	if ($number == ''){
		$num = $num."limit $start_limit,100";
	}else {
		$num = $num."limit $start_limit,$number";
	}
	//最大魅力值
	$maxCharm = DB::result_first("SELECT lastmonthnum FROM ".DB::table('live_top')." WHERE cate = 'charm' AND uid NOT IN(SELECT uid FROM  ".DB::table('common_member')." WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) ORDER BY lastmonthnum DESC LIMIT 1");
	//最大投票
	$maxVote = DB::result_first("SELECT lastmonthnum FROM ".DB::table('live_top')." WHERE cate='vote' AND uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) ORDER BY lastmonthnum DESC LIMIT 1");
	$maxvote;
	//列表
	$addSql = '';
	if ($maxCharm) {
		$addSql .= "tmp.charm*6000/$maxCharm";
	}
	if ($maxVote) {
		$addSql = $addSql ? $addSql."+tmp.vote*4000/$maxVote" : "tmp.vote*4000/$maxVote";
	}
	$addSql = $addSql ? "($addSql) AS amount" : 'tmp.vote AS amount';

	$charm_rs = array();
	$charm_rs_count = DB::result_first("SELECT COUNT(*) AS COUNT FROM 
(SELECT a.uid,a.charm,b.vote FROM (SELECT uid,lastmonthnum AS charm FROM pre_live_top WHERE cate='charm') a,
(SELECT uid,lastmonthnum AS vote FROM pre_live_top WHERE cate='vote') b WHERE a.uid=b.uid) tmp	LEFT JOIN pre_common_member m 
ON m.uid=tmp.uid");
	if($charm_rs_count > 0) {
		showsubtitle(array('UID','名称','魅力值','得票值','上月魅力指数'));
			$multi = multi($charm_rs_count, $number, $page, ADMINSCRIPT."?action=charm&submit=yes".$act);
			$query = DB::query("
				SELECT tmp.uid,tmp.charm,tmp.vote,if(m.nickname!='',m.nickname,m.username) as nickname,$addSql 
				FROM 
					(SELECT a.uid,a.charm,b.vote 
					FROM
						(SELECT uid,lastmonthnum AS charm 
						FROM ".DB::table('live_top')." 
						WHERE cate='charm') a,
						(SELECT uid,lastmonthnum AS vote 
						FROM ".DB::table('live_top')."
						WHERE cate='vote') b 
					WHERE a.uid=b.uid) tmp
				LEFT JOIN ".DB::table('common_member')." m ON m.uid=tmp.uid 
				WHERE 1 ".$condition." ORDER BY amount DESC 
				$num");
			while($charm_rs = DB::fetch($query)) {
				showtablerow('', array('', ''), array(
				$charm_rs['uid'],
				$charm_rs['nickname'],
				$charm_rs['charm'],
				$charm_rs['vote'],
				$charm_rs['amount'] = floor($charm_rs['amount'])
				));
			}
			echo '<br>';
			echo '<strong><a href="admin.php?action=charm&operation=derived&username='.$username.'&number='.$number.'">导出</a></strong>';
			showsubmit('', '', '', '', $multi);
			showtablefooter();
			showformfooter();
	}
	
}

if ($operation=='derived') {
	cpheader();
	showtableheader();
	header("Content-type:application/vnd.ms-excel");
	header("Content-Disposition:filename=test.xls");
	
	//echo $_GET['username'].'----'.$_GET['number'];
	$username = $_GET['username'];
	$number = $_GET['number'];
	$condition='';
	$summary='';
	if ($username){
		$condition = $condition."AND nickname like '%$username%' ";
		$act .= "&username=".$username;
	}
	if ($number == ''){
		$num = $num."limit 0,100";
	}else {
		$num = $num."limit 0,$number";
	}
	//最大魅力值
	$maxCharm = DB::result_first("SELECT lastmonthnum FROM ".DB::table('live_top')." WHERE cate = 'charm' AND uid NOT IN(SELECT uid FROM  ".DB::table('common_member')." WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) ORDER BY lastmonthnum DESC LIMIT 1");
	//最大投票
	$maxVote = DB::result_first("SELECT lastmonthnum FROM ".DB::table('live_top')." WHERE cate='vote' AND uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) ORDER BY lastmonthnum DESC LIMIT 1");
	$maxvote;
	//列表
	$addSql = '';
	if ($maxCharm) {
		$addSql .= "tmp.charm*6000/$maxCharm";
	}
	if ($maxVote) {
		$addSql = $addSql ? $addSql."+tmp.vote*4000/$maxVote" : "tmp.vote*4000/$maxVote";
	}
	$addSql = $addSql ? "($addSql) AS amount" : 'tmp.vote AS amount';

	$charm_rs = array();
	showsubtitle(array('UID','名称','魅力值','得票值','上月魅力指数'));
	$query = DB::query("
				SELECT tmp.uid,tmp.charm,tmp.vote,if(m.nickname!='',m.nickname,m.username) as nickname,$addSql 
				FROM 
					(SELECT a.uid,a.charm,b.vote 
					FROM
						(SELECT uid,lastmonthnum AS charm 
						FROM ".DB::table('live_top')." 
						WHERE cate='charm') a,
						(SELECT uid,lastmonthnum AS vote 
						FROM ".DB::table('live_top')."
						WHERE cate='vote') b 
					WHERE a.uid=b.uid) tmp
				LEFT JOIN ".DB::table('common_member')." m ON m.uid=tmp.uid 
				WHERE 1 ".$condition." ORDER BY amount DESC 
				$number");
	while($charm_rs = DB::fetch($query)) {
		showtablerow('', array('', ''), array(
		$charm_rs['uid'],
		$charm_rs['nickname'],
		$charm_rs['charm'],
		$charm_rs['vote'],
		$charm_rs['amount'] = floor($charm_rs['amount'])
		));
	}
}

if ($operation=='yesterday') {
	cpheader();
	shownav('extended', '魅力指数');
	echo '
		<ul class="tab1">
			<li ><a href="admin.php?action=charm"><span>上月魅力指数</span></a></li>
			<li class="current"><a href="admin.php?action=charm&operation=yesterday"><span>昨天魅力指数</span></a></li>
		</ul>';
	showformheader('charm');
	showtableheader();
	
	$_G['setting']['memberperpage'] = 20;
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	
	//最大魅力值
	$maxCharm = DB::result_first("SELECT yesterday FROM pre_live_top WHERE cate = 'charm' AND uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) AND uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) ORDER BY yesterday DESC LIMIT 1");
	//最大投票
	$maxVote = DB::result_first("SELECT yesterday FROM pre_live_top WHERE cate='vote' AND uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) AND uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) ORDER BY yesterday DESC LIMIT 1");
	//列表
	$addSql = '';
	if ($maxCharm) {
		$addSql .= "tmp.charm*6000/$maxCharm";
	}
	if ($maxVote) {
		$addSql = $addSql ? $addSql."+tmp.vote*4000/$maxVote" : "tmp.vote*4000/$maxVote";
	}
	$addSql = $addSql ? "($addSql) AS amount" : 'tmp.vote AS amount';
	$charm_rs = array();
	$charm_rs_count = DB::result_first("SELECT COUNT(*) AS COUNT FROM 
(SELECT a.uid,a.charm,b.vote FROM (SELECT uid,yesterday AS charm FROM pre_live_top WHERE cate='charm') a,
(SELECT uid,yesterday AS vote FROM pre_live_top WHERE cate='vote') b WHERE a.uid=b.uid) tmp	LEFT JOIN pre_common_member m 
ON m.uid=tmp.uid");
	if($charm_rs_count > 0) {
		showsubtitle(array('UID','名称','魅力值','星星数','昨天魅力指数'));
		$multi = multi($charm_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=charm&operation=yesterday&submit=yes".$act);
		$query = DB::query("
					SELECT tmp.uid,tmp.charm,tmp.vote,if(m.nickname!='',m.nickname,m.username) as nickname,$addSql 
					FROM 
						(SELECT a.uid,a.charm,b.vote 
						FROM
							(SELECT uid,yesterday AS charm 
							FROM pre_live_top 
							WHERE cate='charm') a,
							(SELECT uid,yesterday AS vote 
							FROM pre_live_top 
							WHERE cate='vote') b 
						WHERE a.uid=b.uid) tmp
					LEFT JOIN pre_common_member m ON m.uid=tmp.uid 
					ORDER BY amount DESC 
					LIMIT $start_limit, {$_G[setting][memberperpage]}");
		while($charm_rs = DB::fetch($query)) {
			showtablerow('', array('', ''), array(
			$charm_rs['uid'],
			$charm_rs['nickname'],
			$charm_rs['charm'],
			$charm_rs['vote'],
			$charm_rs['amount'] = floor($charm_rs['amount'])
			));
		}
		showsubmit('', '', '', '', $multi);
		showtablefooter();
	}
}