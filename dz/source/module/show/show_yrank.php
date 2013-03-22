<?php
if (! defined ( 'IN_DISCUZ' )) {
	exit ( 'Access Denied' );
}
require_once libfile ( 'function/live' );
$ops = array('index','huoweek','huoday','huomonth');
$op = empty ( $_G ['gp_operation'] ) ? 'index' : $_G ['gp_operation'];
if (!in_array($op, $ops)) {
	$op = 'index';
}

//友谊排行榜
if ($op == 'index') {
	include template ( 'show/yrank' );
}elseif ($op == 'huoweek') {//友谊排行榜
	if (!isset($_G['gp_duidate']) || $_G['gp_duidate'] == "undefined"){
		$startTime = strtotime($_G['gp_duidate'].' 00:00:01');
		$startTime = time();
		$query = DB::query("SELECT * FROM ".DB::table('live_gift_friendship_top_now')." WHERE type = 1 ORDER BY value DESC LIMIT 7");
		while ($rs = DB::fetch($query)){
			$friendDayTop[] = $rs;
		}
	}else {
		$startTime = strtotime($_G['gp_duidate'].' 00:00:01');
		$startTime1 = strtotime($_G['gp_duidate'].' 23:59:59');
		if (!empty($startTime)) {
			$condition .= " AND createtime >= $startTime ";
			$summary .= "时间:".date('Y-m-d',$startTime);
		}
		if (!empty($startTime)) {
			$condition .= " AND createtime <= $startTime1 ";
			$summary .= "时间:".date('Y-m-d',$startTime1);
		}
		$query = DB::query("SELECT * FROM ".DB::table('live_gift_friendship_top_history')." WHERE type = 1".$condition." ORDER BY value DESC LIMIT 7");
		while ($rs = DB::fetch($query)){
			$friendDayTop[] = $rs;
		}
	}
	$back ['data'] = $friendDayTop;
	$back ['pagehtml'] = $multiweek;
	$back ['startTime'] = date('d',$startTime);
	echo json_encode ( $back );
}
elseif ($op == 'huoday') {
	$daytime = time();
	$daytime = date('Y-m-d',$daytime);
	if (!isset($_G['gp_duidate']) || $_G['gp_duidate'] == "undefined" || $_G['gp_duidate'] == $daytime){
		$startTime = strtotime($_G['gp_duidate'].' 00:00:01');
		$startTime = time();
		$query = DB::query("SELECT * FROM ".DB::table('live_gift_friendship_top_now')." WHERE type = 0 ORDER BY value DESC LIMIT 7");
		while ($rs = DB::fetch($query)){
			$friendDayTop[] = $rs;
		}
	}else {
		$startTime = strtotime($_G['gp_duidate'].' 00:00:01');
		$startTime1 = strtotime($_G['gp_duidate'].' 23:59:59');
		if (!empty($startTime)) {
			$condition .= " AND createtime >= $startTime AND createtime <= $startTime1";
			$summary .= "时间:".date('Y-m-d',$startTime);
		}
		$query = DB::query("SELECT * FROM ".DB::table('live_gift_friendship_top_history')." WHERE type = 0".$condition." ORDER BY value DESC LIMIT 7");
		while ($rs = DB::fetch($query)){
			$friendDayTop[] = $rs;
		}
	}
	$back ['data'] = $friendDayTop;
	//$back ['pagehtml'] = $multiweek;
	$back ['startTime'] = date('d',$startTime);
	echo json_encode ( $back );
}elseif ($op == 'huomonth') {
	//本月
	$daytime = time();
	$monthtime = date('m',$daytime);
	//选择几月
	$chooseTime = strtotime($_G['gp_duidate']);
	$choose = date('m',$chooseTime);
	
	if (!isset($_G['gp_duidate']) || $_G['gp_duidate'] == "undefined" || $choose == $monthtime){
//		$startTime = strtotime($_G['gp_duidate'].' 00:00:01');
		$startTime = time();
//		$tpp = 7;
//		$page = max ( 1, $_G ['page'] );
//		$start_limit = ($page - 1) * $tpp;
		$query = DB::query("SELECT * FROM ".DB::table('live_gift_friendship_top_now')." WHERE type = 2 ORDER BY value DESC LIMIT 7");
		while ($rs = DB::fetch($query)){
			$friendDayTop[] = $rs;
		}
		//$muit_weekcount = DB::result_first ( "SELECT count(*) FROM ".DB::table('live_gift_friendship_top_now')." WHERE type = 2 ORDER BY id " );
		//$multiweek = multi ( $muit_weekcount, $tpp, $page, "http://space.huoshow.com/show.php?mod=yrank&operation=huomonth",0,3 );
		//$multiweek = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=yrank&operation=huomonth&amp;page=(\d+)\"/", "href=\"javascript:huomonth(\\1)\"", $multiweek );
		//$multiweek = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=yrank&operation=huomonth&amp;page='+this.value", "huomonth(this.value)", $multiweek );
	}else {
		$startTime = strtotime($_G['gp_duidate']);
		$y = date('Y',$startTime);
		$m = date('m',$startTime);
		//月有多少天
		//$dd=cal_days_in_month(CAL_GREGORIAN,$m,$y);
		//月起始天
		$first = mktime(0,0,1,$m,1,$y);
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
		$query = DB::query("SELECT * FROM ".DB::table('live_gift_friendship_top_history')." WHERE type = 2".$condition." ORDER BY value DESC LIMIT 7");
		while ($rs = DB::fetch($query)){
			$friendDayTop[] = $rs;
		}
	}
	$back ['data'] = $friendDayTop;
	//$back ['pagehtml'] = !isset($multiweek) ? $multiweek : '';
	$back ['startTime'] = date('m',$startTime);
	echo json_encode ( $back );
}
?>