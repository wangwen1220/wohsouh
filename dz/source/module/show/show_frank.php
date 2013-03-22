<?php
if (! defined ( 'IN_DISCUZ' )) {
	exit ( 'Access Denied' );
}

require_once libfile ( 'function/live' );
$ops = array('index','huoweek','huoday','huomonth','huoall');
$op = empty ( $_G ['gp_operation'] ) ? 'index' : $_G ['gp_operation'];
if (!in_array($op, $ops)) {
	$op = 'index';
}
$current = date('Y-m',time());
$frontone = date('Y-m',strtotime('-1 month', time()));
$fronttwo = date('Y-m',strtotime('-2 month', time()));
$frontthree = date('Y-m',strtotime('-3 month', time()));
//魅力值排行榜
if ($op == 'index') {
	include template ( 'show/frank' );
}elseif ($op == 'huoweek') {//火秀币排行榜
	$tpp = 15;
	$page = max ( 1, $_G ['page'] );
	$charmWeekTop = cGetHuoshowTopmul ( 'week', $tpp, $page );
	$muit_weekcount = DB::result_first ( "SELECT count(*) FROM " . DB::table ( 'live_top' ) . " WHERE uid NOT IN(SELECT uid FROM " . DB::table ( 'common_member' ) . " WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) AND cate='huoshow' AND weeknum>0" );
	$multiweek = multi ( $muit_weekcount, $tpp, $page, "http://space.huoshow.com/show.php?mod=frank&operation=huoweek",0,3 );
	$multiweek = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=frank&operation=huoweek&amp;page=(\d+)\"/", "href=\"javascript:huoweek(\\1)\"", $multiweek );
	$multiweek = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=frank&operation=huoweek&amp;page='+this.value", "huoweek(this.value)", $multiweek );
$uid=$_G['uid'];
	$sqluid=DB::result_first ("SELECT weeknum FROM " . DB::table ( 'live_top' ) . " WHERE uid NOT IN(SELECT uid FROM " . DB::table ( 'common_member' ) . " WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) AND cate='huoshow' AND uid=$uid");
		if($sqluid>0){
		$sqlc= DB::query("select count(weeknum) as num FROM " . DB::table ( 'live_top' ) . " WHERE uid NOT IN(SELECT uid FROM " . DB::table ( 'common_member' ) . " WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) AND cate='huoshow' and weeknum>=$sqluid");
		$i = 0;
		$um = array();
		$rs = DB::fetch($sqlc);
			$um[] = $rs['num'];
			
	}
	$back ['data'] = $charmWeekTop;
	$back ['pagehtml'] = $multiweek;
	$back ['pai']= $um;
	echo json_encode ( $back );
}elseif ($op == 'huoday') {
	$tpp = 15;
	$page = max ( 1, $_G ['page'] );
	$charmDayTop = cGetHuoshowTopmul('day',$tpp,$page);
	$muit_daycount=DB::result_first("SELECT count(*) FROM ".DB::table('live_top')." WHERE uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) AND cate='huoshow' AND daynum>0");
	$multiweek = multi ( $muit_daycount, $tpp, $page, "http://space.huoshow.com/show.php?mod=frank&operation=huoday",0,3);
	$multiweek = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=frank&operation=huoday&amp;page=(\d+)\"/", "href=\"javascript:huoday(\\1)\"", $multiweek );
	$multiweek = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=frank&operation=huoday&amp;page='+this.value", "huoday(this.value)", $multiweek );
$uid=$_G['uid'];
	$sqluid=DB::result_first ("SELECT daynum FROM " . DB::table ( 'live_top' ) . " WHERE uid NOT IN(SELECT uid FROM " . DB::table ( 'common_member' ) . " WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) AND cate='huoshow' AND uid=$uid");
		if($sqluid>0){
		$sqlc= DB::query("select count(daynum) as num FROM " . DB::table ( 'live_top' ) . " WHERE uid NOT IN(SELECT uid FROM " . DB::table ( 'common_member' ) . " WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) AND cate='huoshow' and daynum>=$sqluid");
		$i = 0;
		$um = array();
		$rs = DB::fetch($sqlc);
			$um[] = $rs['num'];
			
	}
	$back ['data'] = $charmDayTop;
	$back ['pagehtml'] = $multiweek;
	$back ['pai']= $um;
	echo json_encode ( $back );
}elseif ($op == 'huomonth') {
//	当前月-1，上月
//	$current = date('Y-m',time());
//	$frontone = date('Y-m',strtotime('-1 month', time()));
//	$fronttwo = date('Y-m',strtotime('-2 month', time()));
//	$frontthree = date('Y-m',strtotime('-3 month', time()));
	//当前月
	$monthtime = date('m',time());
	//选择几月
	$chooseTime = strtotime($_G['gp_date']);
	$choose = date('m',$chooseTime);
	
	if (!isset($_G['gp_date']) || $_G['gp_date'] == "undefined" || $choose == $monthtime){
		$tpp = 15;
		$page = max ( 1, $_G ['page'] );
		$charmmonthTop = cGetHuoshowTopmul('month',$tpp,$page);
		$muit_monthcount=DB::result_first("SELECT count(*) FROM ".DB::table('live_top')." WHERE uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) AND cate='huoshow' AND monthnum>0");
		$multiweek = multi ( $muit_monthcount, $tpp, $page, "http://space.huoshow.com/show.php?mod=frank&operation=huomonth",0,3);
		$multiweek = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=frank&operation=huomonth&amp;page=(\d+)\"/", "href=\"javascript:huomonth(\\1)\"", $multiweek );
		$multiweek = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=frank&operation=huomonth&amp;page='+this.value", "huomonth(this.value)", $multiweek );
		$uid=$_G['uid'];
		$sqluid=DB::result_first ("SELECT monthnum FROM " . DB::table ( 'live_top' ) . " WHERE uid NOT IN(SELECT uid FROM " . DB::table ( 'common_member' ) . " WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) AND cate='huoshow' AND uid=$uid");
			if($sqluid>0){
			$sqlc= DB::query("select count(monthnum) as num FROM " . DB::table ( 'live_top' ) . " WHERE uid NOT IN(SELECT uid FROM " . DB::table ( 'common_member' ) . " WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) AND cate='huoshow' and monthnum>=$sqluid");
			$i = 0;
			$um = array();
			$rs = DB::fetch($sqlc);
				$um[] = $rs['num'];
				
		}
		$back ['pagehtml'] = $multiweek;
		$back ['pai']= $um;
//		$back ['data'] = $charmmonthTop;
	}else {
		$startTime = strtotime($_G['gp_date']);
		$y = date('Y',$startTime);
		$m = date('m',$startTime);
		$sql = "SELECT uid,username as nickname,rich_num as amount FROM pre_live_rich_month_history WHERE `YEAR`=$y AND `MONTH`=$m ORDER BY amount DESC LIMIT 15";
		$query = DB::query($sql);
		while ($rs = DB::fetch($query)){
			$charmmonthTop[] = $rs;
		}
		$back ['pagehtml'] = '';
		
	}
	$back ['data'] = empty($charmmonthTop) ? '':$charmmonthTop;
	$back ['startTime'] = $y.'-'.$m;
	$back ['pagehtml'] = '';
	echo json_encode ( $back );
}elseif ($op == 'huoall') {
	$tpp = 15;
	$page = max ( 1, $_G ['page'] );
	$charmallTop = cGetHuoshowTopmul('all',$tpp,$page);
	$muit_allcount=DB::result_first("SELECT count(*) FROM ".DB::table('ucenter_showcoin')." s LEFT JOIN ".DB::table('common_member')." m ON m.uid=s.uid WHERE s.consume>0 AND s.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) AND s.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0)");
	$multiweek = multi ( $muit_allcount, $tpp, $page, "http://space.huoshow.com/show.php?mod=frank&operation=huoall",0,3);
	$multiweek = preg_replace ( "/href=\"http:\/\/space.huoshow.com\/show.php\?mod=frank&operation=huoall&amp;page=(\d+)\"/", "href=\"javascript:huoall(\\1)\"", $multiweek );
	$multiweek = str_replace ( "window.location='http://space.huoshow.com/show.php?mod=frank&operation=huoall&amp;page='+this.value", "huoall(this.value)", $multiweek );
$uid=$_G['uid'];
	$sqluid=DB::result_first ("SELECT consume FROM ".DB::table('ucenter_showcoin')." s LEFT JOIN ".DB::table('common_member')." m ON m.uid=s.uid WHERE s.consume>0 AND s.uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) AND s.uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) and s.uid=$uid");
		if($sqluid>0){
		$sqlc= DB::query("select count(consume) as num FROM " . DB::table ( 'ucenter_showcoin' ) . " WHERE uid NOT IN(SELECT uid FROM ".DB::table('common_member')." WHERE groupid=1) AND uid NOT IN(SELECT uid FROM ".DB::table('live_room')." WHERE stat<0) and consume>=$sqluid");
		$i = 0;
		$um = array();
		$rs = DB::fetch($sqlc);
			$um[] = $rs['num'];
			
	}
	$back ['data'] = $charmallTop;
	$back ['pagehtml'] = $multiweek;
	$back ['pai']= $um;
	echo json_encode ( $back );
}
?>