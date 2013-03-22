<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_duixian.php 16352 2011-07-27 11:00:19Z zhouyc $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if(empty($operation)){
	$operation = 'index';
}

if ($operation=='index'){
	cpheader();
	shownav('extended', '送星记录');
	//showsubmenu('送星记录', array());
	echo '
		<ul class="tab1">
			<li class="current"><a href="admin.php?action=sendstar"><span>送星记录</span></a></li>
			<li ><a href="admin.php?action=sendstar&operation=livetime"><span>直播时长</span></a></li>
			<li><a href="admin.php?action=sendstar&operation=Sendnews"><span>发送公告</span></a></li>
		</ul>';
	showtableheader();
	$sendstaruid = $_G['gp_sendstaruid'];
	$meetstaruid = $_G['gp_meetstaruid'];
	if (!empty($_G['gp_duidate1'])) {
		$startTime = strtotime($_G['gp_duidate1'].' 00:00:01');
	}
	if (!empty($_G['gp_duidate2'])) {
		$startTime1 = strtotime($_G['gp_duidate2'].' 23:59:59');
	}	
	?>
	<script src="static/js/calendar.js" type="text/javascript"></script>
	<table border="0">
		<form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=sendstar" method="post">
		<tr style="background:#DEEFFB;">
			<td><strong>送星UID:</strong><input type="text" name="sendstaruid" size="15" value="<?echo $sendstaruid;?>"/>&nbsp;&nbsp;</td>
			<td><strong>接星UID:</strong><input type="text" name="meetstaruid" size="15" value="<?echo $meetstaruid;?>"/>&nbsp;&nbsp;</td>
			<td><strong>送星时间:</strong>
				<input type="text"  size=15 name="duidate1" onclick="showcalendar(event, this)" value="<? if ($startTime){echo date('Y-m-d',$startTime);}?>"/>-
	        	<input type="text" name="duidate2" size=15 onclick="showcalendar(event, this)" value="<?if ($startTime1){echo date('Y-m-d',$startTime1);}?>"/>&nbsp;&nbsp;
	        	</td>
			<td><input type="submit" name="submit" value="搜索" /></td>
		</tr>
		</form>
	</table>
	<?php
	showtableheader();
	$condition='';
	$summary='';
	if ($sendstaruid){
		$condition = $condition."AND uid = '$sendstaruid' ";
		$summary .= "送星UID:".$sendstaruid;
		$act .= "&sendstaruid=".$sendstaruid;
	}
	if ($meetstaruid){
		$condition = $condition."AND touid = '$meetstaruid' ";
		$summary .= "接星UID:".$meetstaruid;
		$act .= "&meetstaruid=".$meetstaruid;
	}
	if (!empty($startTime)) {
		$condition .= " AND votetime >= '$startTime' ";
		$summary .= "时间:".date('Y-m-d',$startTime);
	}
	if (!empty($startTime1)) {
		$condition .= " AND votetime <= '$startTime1' ";
		$summary .= "到".date('Y-m-d',$startTime1)."期间";
	}
		
	$_G['setting']['memberperpage'] = 20;
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	$send_rs = array();
	$sql = "SELECT COUNT(*) FROM ".DB::table('live_charm_votelog')." WHERE 1 ".$condition;
	$send_rs_count=DB::result_first($sql);
	if ($send_rs_count > 0) {
		showsubtitle(array('送星UID', '接星UID', '接星人', '送星时间', '数量'));
		$multi = multi($send_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=sendstar&submit=yes".$act);
		$sql = "SELECT * FROM ".DB::table('live_charm_votelog')." WHERE 1 ".$condition."ORDER BY votetime DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
		//echo $sql;
		$query = DB::query($sql);
		while ($send_rs = DB::fetch($query)){
			$sql = "SELECT m.username,if(m.nickname!='',m.nickname,m.username) as nickname FROM ".DB::table('common_member')." m WHERE uid = ".$send_rs['touid'];
			$sendname = DB::fetch_first($sql);
			showtablerow('', array('', ''), array(
				$send_rs['uid'] ? $send_rs['uid'] : '<strong>火秀网系统</strong>',
				$send_rs['touid'],
				$sendname['nickname'],
				date('Y-m-d H:i:s',$send_rs['votetime']),
				$send_rs['amount'],
			));
		}
		showsubmit('', '', '', '', $multi);
		showtablefooter(); 
		//showformfooter();
	}
}

if ($operation=='livetime'){
	cpheader();
	shownav('extended', '送星记录');
	echo '
		<ul class="tab1">
			<li ><a href="admin.php?action=sendstar"><span>送星记录</span></a></li>
			<li class="current"><a href="admin.php?action=sendstar&operation=livetime"><span>直播时长</span></a></li>
			<li><a href="admin.php?action=sendstar&operation=Sendnews"><span>发送公告</span></a></li>
		</ul>';
	$liveuid = $_G['gp_liveuid'];
	if (!empty($_G['gp_duidate1'])) {
		$startTime = strtotime($_G['gp_duidate1'].' 00:00:01');
	}
	if (!empty($_G['gp_duidate2'])) {
		$startTime1 = strtotime($_G['gp_duidate2'].' 23:59:59');
	}
	?>
	<script src="static/js/calendar.js" type="text/javascript"></script>
	<table border="0">
		<form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=sendstar&operation=livetime" method="post">
		<tr style="background:#DEEFFB;">
			<td><strong>主播:</strong><input type="text" name="liveuid" size="15" value="<?echo $liveuid;?>"/>&nbsp;&nbsp;</td>
			<td><strong>比赛时间:</strong>
				<input type="text"  size=15 name="duidate1" onclick="showcalendar(event, this)" value="<? if ($startTime){echo date('Y-m-d',$startTime);}?>"/>-
	        	<input type="text" name="duidate2" size=15 onclick="showcalendar(event, this)" value="<?if ($startTime1){echo date('Y-m-d',$startTime1);}?>"/>&nbsp;&nbsp;
	        	</td>
			<td><input type="submit" name="submit" value="搜索" /></td>
		</tr>
		</form>
	</table>
	<?php
	showtableheader();
	$condition='';
	$summary='';
	if ($liveuid){
		$condition = $condition."AND uid = '$liveuid' ";
		$summary .= "UID:".$liveuid;
		$act .= "&liveuid=".$liveuid;
	}
	if (!empty($startTime)) {
		$condition .= " AND stime >= '$startTime' ";
		$summary .= "时间:".date('Y-m-d',$startTime);
	}
	if (!empty($startTime1)) {
		$condition .= " AND etime <= '$startTime1' ";
		$summary .= "到".date('Y-m-d',$startTime1)."期间";
	}
	
	$_G['setting']['memberperpage'] = 20;
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	$live_rs = array();
	$sql = "SELECT COUNT(*) FROM ".DB::table('live_roomer_votelog')." WHERE 1 ".$condition;
	$live_rs_count=DB::result_first($sql);
	if ($live_rs_count > 0) {
		showsubtitle(array('主播', '开始时间', '结束时间', '总时间'));
		$multi = multi($live_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=sendstar&operation=livetime&submit=yes".$act);
		$sql = "SELECT * FROM ".DB::table('live_roomer_votelog')." WHERE 1 ".$condition."ORDER BY etime DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
		$query = DB::query($sql);
		while ($live_rs = DB::fetch($query)){
			showtablerow('',array('',''),array(
				$live_rs['uid'],
				date('Y-m-d H:i:s',$live_rs['stime']),
				date('Y-m-d H:i:s',$live_rs['etime']),
				$totaltime = getTotalTimeShow($live_rs['totaltime'])
			));
		}
		showsubmit('', '', '', '', $multi);
		showtablefooter(); 
	}
	
}

if ($operation=='Sendnews'){
	cpheader();
	shownav('extended', '发送公告');
	//showsubmenu('送星记录', array());
	echo '
		<ul class="tab1">
			<li ><a href="admin.php?action=sendstar"><span>送星记录</span></a></li>
			<li ><a href="admin.php?action=sendstar&operation=livetime"><span>直播时长</span></a></li>
			<li class="current"><a href="admin.php?action=sendstar&operation=Sendnews"><span>发送公告</span></a></li>
		</ul>';
	
	if ($_GET['act']=='post') {
		$dstroomid = $_G['gp_dstroomid'];
		$dstuid = $_G['gp_dstuid'];
		$msg = $_G['gp_msg'];
		$data = array(
			'act' => '4',
			'dstuid' => $dstuid,
			'dstroomid' => $dstroomid,
			'msg' => $msg
		);
		//print_r($data);
		$cmd_body = '020'.json_encode($data);
		socketSendData(LOCAL_HOST, LOCAL_PORT, encodeCommand($cmd_body, 6));
		header("Location: admin.php?action=sendstar&operation=Sendnews");
	}
	
	$fh = '<a href="admin.php?action=sendstar&operation=Sendnews" style="color:blue">返回发送公告</a>';
	showformheader("sendstar&operation=$operation&act=post");
	showtableheader();
	echo '房间号：&nbsp;<input type="text" name="dstroomid" /><br/>';
	echo '<br>';
	echo '火秀号：&nbsp;<input type="text" name="dstuid" /><br/>';
	echo '<br>';
	echo '&nbsp;&nbsp;&nbsp;消息：&nbsp;<textarea cols="50" rows="3" name="msg"/>请输入系统消息！！！</textarea><br/>';
	showsubmit('submit', '提交', '', $fh);
	showformfooter();
}