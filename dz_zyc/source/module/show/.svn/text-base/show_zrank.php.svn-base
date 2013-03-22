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
//本周
$weektime = date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1));
$Thisweek= strtotime($weektime);
//上周
$lasttime = date("Y-m-d H:i:s",mktime(0,0,0,date("m"),date("d")-date("w")+1-8));
$Lastk= strtotime($lasttime);
//上上周
$Lastk1 = strtotime("-1 week",$Lastk);
if ($op == 'index') {
	include template ( 'show/zrank' );
} elseif ($op == 'week') {
	if(!isset($_G['gp_duidate']) || $_G['gp_duidate'] == "undefined" || $_G['gp_duidate'] == $Thisweek){
		//首页魅力指数exponent，魅力clarm，魅力之星votes
		require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/LiveList.class.php");
		$dblink = new DataBase("");
		$tpp = 15;
		$page = max ( 1, $_G ['page'] );
		$zWeekTop_all = LiveList::Charm_Score_List('weeknum',$tpp,'',$page);
		$zWeekTop = $zWeekTop_all["score_data"];
		$total_count = $zWeekTop_all['score_count'][0]['count'];
		$multiweek = multi ( $total_count, $tpp, $page, "http://space.huoshow.com/show.php?mod=zrank&operation=week",0,3);
		$multiweek = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=zrank&operation=week&amp;page=(\d+)\"/", "href=\"javascript:week(\\1)\"", $multiweek );
		$multiweek = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=zrank&operation=week&amp;page='+this.value", "week(this.value)", $multiweek );
		$back ['pagehtml'] = $multiweek;
//		$back ['data'] = $zWeekTop;
	}else {
		//上周结束时间
		$startTime = $_G['gp_duidate'];
		//上周开始时间
		$LastTime = strtotime('+1 week', $startTime);
		$sql = "SELECT uid,username AS nickname,value FROM pre_live_top_week_history WHERE TYPE=0 AND createtime>=$startTime AND createtime<$LastTime ORDER BY value DESC LIMIT 15";
		$query = DB::query($sql);
		while ($rs = DB::fetch($query)){
			$zWeekTop[] = $rs;
		}
//		$back ['data'] = $zWeekTop;
		$back ['pagehtml'] = '';
	}
	$back ['data'] = empty($zWeekTop) ? '':$zWeekTop;
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
		$page = max ( 1, $_G ['page'] );
		$zDayTop_all = LiveList::Charm_Score_List('daynum',$tpp,'',$page);
		$zDayTop = $zDayTop_all["score_data"];
		$total_count = $zDayTop_all['score_count'][0]['count'];
		$multiday = multi ( $total_count, $tpp, $page, "http://space.huoshow.com/show.php?mod=zrank&operation=day",0,3);
		$multiday = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=zrank&operation=day&amp;page=(\d+)\"/", "href=\"javascript:day(\\1)\"", $multiday );
		$multiday = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=zrank&operation=day&amp;page='+this.value", "day(this.value)", $multiday );
		$back ['pagehtml'] = $multiday;
		$back ['startTime'] = date('d',$startTime);
	}else {
		$startTime = strtotime($_G['gp_duidate'].' 00:00:00');
		$startTime1 = strtotime($_G['gp_duidate'].' 23:59:59');
		if (!empty($startTime)) {
			$condition .= " AND createtime >= $startTime AND createtime <= $startTime1";
			$summary .= "时间:".date('Y-m-d',$startTime);
		}
		$query = DB::query("SELECT *, username AS nickname FROM ".DB::table('live_top_day_history')." WHERE TYPE = 0 ".$condition." ORDER BY value DESC LIMIT 15");
		while ($rs = DB::fetch($query)){
			$zDayTop[] = $rs;
		}
		
		$back ['startTime'] = date('d',$startTime);
		$back ['pagehtml'] = '';
	}
	$back ['data'] = $zDayTop;
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
		$zMonthTop_all = LiveList::Charm_Score_List('monthnum',$tpp,'',$page);
		$zMonthTop = $zMonthTop_all["score_data"];
		$total_count = $zMonthTop_all['score_count'][0]['count'];
		$multimonth = multi ( $total_count, $tpp, $page, "http://space.huoshow.com/show.php?mod=zrank&operation=huomonth",0,3);
		$multimonth = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=zrank&operation=huomonth&amp;page=(\d+)\"/", "href=\"javascript:huomonth(\\1)\"", $multimonth );
		$multimonth = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=zrank&operation=huomonth&amp;page='+this.value", "huomonth(this.value)", $multimonth );
		
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
		$query = DB::query("SELECT *, username AS nickname FROM ".DB::table('live_top_month_history')." WHERE TYPE = 0 ".$condition." ORDER BY value DESC LIMIT 15");
		while ($rs = DB::fetch($query)){
			$zMonthTop[] = $rs;
		}
		$back ['startTime'] = $m;
		$back ['pagehtml'] = '';
	}
	$back ['data'] = $zMonthTop;
	echo json_encode ( $back );
}elseif ($op == 'all') {
	require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/LiveList.class.php");
	$dblink = new DataBase("");
	$startTime = time();
	$tpp = 15;
	$page = max ( 1, $_G ['page'] );
	$zAllTop_all = LiveList::Charm_Score_List('totalnum',$tpp,'',$page);
	$zAllTop = $zAllTop_all["score_data"];
	$total_count = $zAllTop_all['score_count'][0]['count'];
	$multiall = multi ( $total_count, $tpp, $page, "http://space.huoshow.com/show.php?mod=zrank&operation=all",0,3);
	$multiall = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=zrank&operation=all&amp;page=(\d+)\"/", "href=\"javascript:all(\\1)\"", $multiall );
	$multiall = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=zrank&operation=all&amp;page='+this.value", "all(this.value)", $multiall );
	$back ['data'] = $zAllTop;
	$back ['pagehtml'] = $multiall;
	echo json_encode ( $back );
}
?>