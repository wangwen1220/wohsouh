<?php
if (! defined ( 'IN_DISCUZ' )) {
	exit ( 'Access Denied' );
}

require_once libfile ( 'function/live' );
$ops = array('index', 'week','day','huomonth','all');
$op = empty ( $_G ['gp_operation'] ) ? 'index' : $_G ['gp_operation'];
if (!in_array($op, $ops)) {
	$op = 'index';
}
//魅力值排行榜

if ($op == 'index') {
	include template ( 'show/vrank' );
} elseif ($op == 'week') {
	require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/LiveList.class.php");
	$dblink = new DataBase("");
	$startTime = time();
	$tpp = 15;
	$total_count = 120;
	$page = max ( 1, $_G ['page'] );
	$voteWeekTop_all = LiveList::Charm_Vote_List('weeknum',$tpp,$page);
	$voteWeekTop = $voteWeekTop_all["vote_data"];
	$total_count = $voteWeekTop_all['vote_count'][0]['count'];
	$multiweek = multi ( $total_count, $tpp, $page, "http://space.huoshow.com/show.php?mod=vrank&operation=week",0,3);
	$multiweek = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=vrank&operation=week&amp;page=(\d+)\"/", "href=\"javascript:week(\\1)\"", $multiweek );
	$multiweek = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=vrank&operation=week&amp;page='+this.value", "week(this.value)", $multiweek );
	$back ['data'] = $voteWeekTop;
	$back ['pagehtml'] = $multiweek;
	echo json_encode ( $back );
}elseif ($op == 'day') {
	$daytime = time();
	$daytime = date('Y-m-d',$daytime);
	if (!isset($_G['gp_duidate']) || $_G['gp_duidate'] == "undefined" || $_G['gp_duidate'] == $daytime){	
		require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/LiveList.class.php");
		$dblink = new DataBase("");
		$startTime = time();
		$tpp = 15;
		$total_count = 120;
		$page = max ( 1, $_G ['page'] );
		$voteDayTop_all = LiveList::Charm_Vote_List('daynum',$tpp,$page);
		$voteDayTop = $voteDayTop_all["vote_data"];
		$total_count = $voteDayTop_all['vote_count'][0]['count'];
		$multiday = multi ( $total_count, $tpp, $page, "http://space.huoshow.com/show.php?mod=vrank&operation=day",0,3);
		$multiday = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=vrank&operation=day&amp;page=(\d+)\"/", "href=\"javascript:day(\\1)\"", $multiday );
		$multiday = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=vrank&operation=day&amp;page='+this.value", "day(this.value)", $multiday );
		$back ['data'] = $voteDayTop;
		$back ['pagehtml'] = $multiday;
		$back ['startTime'] = date('d',$startTime);
	}else {
		$startTime = strtotime($_G['gp_duidate'].' 00:00:00');
		$startTime1 = strtotime($_G['gp_duidate'].' 23:59:59');
		if (!empty($startTime)) {
			$condition .= " AND createtime >= $startTime AND createtime <= $startTime1";
			$summary .= "时间:".date('Y-m-d',$startTime);
		}
		$query = DB::query("SELECT *, username AS nickname FROM ".DB::table('live_top_day_history')." WHERE TYPE = 2 ".$condition." ORDER BY value DESC LIMIT 15");
		while ($rs = DB::fetch($query)){
			$vDayTop[] = $rs;
		}
		$back ['data'] = $vDayTop;
		$back ['startTime'] = date('d',$startTime);
		$back ['pagehtml'] = '';
	}
	
	echo json_encode ( $back );
}elseif ($op == 'huomonth') {
	//本月
	$daytime = time();
	$monthtime = date('m',$daytime);
	//选择几月
	$chooseTime = strtotime($_G['gp_duidate']);
	$choose = date('m',$chooseTime);
	
	if (!isset($_G['gp_duidate']) || $_G['gp_duidate'] == "undefined" || $choose == $monthtime){
		require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/LiveList.class.php");
		$dblink = new DataBase("");
		$startTime = time();
		$tpp = 15;
		$page = max ( 1, $_G ['page'] );
		$voteMonthTop_all = LiveList::Charm_Vote_List('monthnum',$tpp,$page);
		$voteMonthTop = $voteMonthTop_all["vote_data"];
		$total_count = $voteMonthTop_all['vote_count'][0]['count'];
		$multimonth = multi ( $total_count, $tpp, $page, "http://space.huoshow.com/show.php?mod=vrank&operation=huomonth",0,3);
		$multimonth = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=vrank&operation=huomonth&amp;page=(\d+)\"/", "href=\"javascript:huomonth(\\1)\"", $multimonth );
		$multimonth = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=vrank&operation=huomonth&amp;page='+this.value", "huomonth(this.value)", $multimonth );
		$back ['data'] = $voteMonthTop;
		$back ['pagehtml'] = $multimonth;
		$back ['startTime'] = date('m',$startTime);
	}else {
		$startTime = strtotime($_G['gp_duidate']);
		$y = date('Y',$startTime);
		$m = date('m',$startTime);
		//月有多少天
		//$dd=cal_days_in_month(CAL_GREGORIAN,$m,$y);
		//月起始天
		$first = mktime(0,0,0,$m,1,$y);
		//月最后一天
		if ($m == 12){
			$last = mktime(0,0,0,1,1,$y+1);
		}else {
			$last = mktime(0,0,0,$m+1,1,$y);
		}
		
		if (!empty($startTime)) {
			$condition .= " AND createtime >= $first AND createtime < $last";
			//$summary .= "时间:".date('Y-m-d',$startTime);
		}
		$query = DB::query("SELECT *, username AS nickname FROM ".DB::table('live_top_month_history')." WHERE TYPE = 2 ".$condition." ORDER BY value DESC LIMIT 15");
		while ($rs = DB::fetch($query)){
			$vMonthTop[] = $rs;
		}
		$back ['data'] = $vMonthTop;
		$back ['startTime'] = $m;
		$back ['pagehtml'] = '';
	}
	echo json_encode ( $back );
}elseif ($op == 'all') {
	require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/LiveList.class.php");
	$dblink = new DataBase("");
	$startTime = time();
	$tpp = 15;
	$page = max ( 1, $_G ['page'] );
	$voteAllTop_all = LiveList::Charm_Vote_List('totalnum',$tpp,$page);
	$voteAllTop = $voteAllTop_all["vote_data"];
	$total_count = $voteAllTop_all['vote_count'][0]['count'];
	$multiall = multi ( $total_count, $tpp, $page, "http://space.huoshow.com/show.php?mod=vrank&operation=all",0,3);
	$multiall = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=vrank&operation=all&amp;page=(\d+)\"/", "href=\"javascript:all(\\1)\"", $multiall );
	$multiall = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=vrank&operation=all&amp;page='+this.value", "all(this.value)", $multiall );
	$back ['data'] = $voteAllTop;
	$back ['pagehtml'] = $multiall;
	echo json_encode ( $back );
}
?>