<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_space.php 10932 2010-05-18 07:39:13Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$operation = $_G['gp_operation'];
$num = empty($_G['gp_num']) ? 5 : $_G['gp_num'];

if ($operation == 'usertop') {//用户排名
	$top = array();
   	$regdate1= strtotime('2010-12-18');
   	$regdate2= strtotime('2011-01-17 23:59:59'); 
	$query = DB::query("SELECT m.uid, m.username, sum( c.click1 + c.click2 + c.click3 + c.click4 + c.click5 + c.click6 + c.click7 + c.click8 ) AS extcredits4 FROM ".DB::table('video_list')." c LEFT JOIN ".DB::table('common_member').
		" m ON c.uid=m.uid where c.dateline>$regdate1 and c.dateline<$regdate2 group by m.uid ORDER BY extcredits4 DESC LIMIT $num");
	$i = 0;

	while ($rs = DB::fetch($query)) {
		if($i == 0) {
			$no = 1;
		} elseif ($rs['extcredits4'] == $top[$i-1]['kge']) {
			$no = $top[$i-1]['no'];
		} else {
			$no = $i + 1;
		}
		$top[$i]['no'] = $no;
		$top[$i]['uid'] = $rs['uid'];
		$top[$i]['username'] = $rs['username'];
		$top[$i]['kge'] = $rs['extcredits4'];
		$i++;
	}
		
	echo json_encode($top);
} elseif ($operation == 'myshowtop') {
   $regdate1= strtotime('2010-12-18');
   $regdate2= strtotime('2011-01-17 23:59:59'); 
	$query = DB::query("SELECT m.myshowid,m.title,m.click FROM (SELECT myshowid,title,dateline,(click1+click2+click3+click4+click5+click6+click7+click8) as click FROM ".DB::table('video_list').") m where dateline>$regdate1 and dateline<$regdate2 ORDER BY click DESC LIMIT $num");
	$i = 0;
	while ($rs = DB::fetch($query)) {
		if($i == 0) {
			$no = 1;
		} elseif ($rs['click'] == $top[$i-1]['click']) {
			$no = $top[$i-1]['no'];
		} else {
			$no = $i + 1;
		}
		$top[$i]['no'] = $no;
		$top[$i]['myshowid'] = $rs['myshowid'];
		$top[$i]['title'] = cutstr($rs['title'],20,'...');
		$top[$i]['click'] = $rs['click'];
		$i++;
	}
	
	echo json_encode($top);
} elseif ($operation == 'newuser') {
	$regdate1= strtotime('2010-12-18');
    $regdate2= strtotime('2011-01-17 23:59:59'); 
	$query = DB::query("SELECT count(uid) as myshownum,uid,author FROM  ".DB::table('video_list')." where auditstatus=2 and dateline>$regdate1 and dateline< $regdate2 group by uid ORDER BY dateline DESC LIMIT $num");
	
	$i = 0;
	while ($rs = DB::fetch($query)) {
		if($i == 0) {
			$no = 1;
		} elseif ($rs['status'] == $top[$i-1]['click']) {
			$no = $top[$i-1]['no'];
		} else {
			$no = $i + 1;
		}
		$top[$i]['avater'] = avatar($rs['uid'], 'small');
	  	$top[$i]['no'] = $no;
		$top[$i]['uid'] = $rs['uid'];
		$top[$i]['username'] = cutstr($rs['author'],6);
		
		$i++;
	}
	
	echo json_encode($top);
} elseif ($operation == 'newzuo') {  
   $regdate1= strtotime('2010-12-18');
   $regdate2= strtotime('2011-01-17 23:59:59'); 
   $query = DB::query("SELECT * FROM (SELECT uid,type,author,dateline,auditstatus,myshowid,title,(click1+click2+click3+click4+click5+click6+click7+click8) as click, viewnum FROM ".DB::table('video_list').") m where auditstatus=2 and dateline>$regdate1 and dateline<$regdate2 ORDER BY dateline desc limit $num");	
   $i = 0;
	while ($rs = DB::fetch($query)) {
		if($i == 0) {
			$no = 1;
		} elseif ($rs['click'] == $top[$i-1]['click']) {
			$no = $top[$i-1]['no'];
		} else {
			$no = $i + 1;
		}
		
	  	$top[$i]['no'] = $no;
		$top[$i]['myshowid'] = $rs['myshowid'];
		$top[$i]['title'] = cutstr($rs['title'],26,'...');
		$top[$i]['author']=$rs['author'];
		$top[$i]['dateline']=date('Y-m-d',$rs['dateline']);
		$top[$i]['click'] = $rs['click'];
        $top[$i]['viewnum'] = $rs['viewnum'];
		$top[$i]['uid'] = $rs['uid'];
		$top[$i]['type'] = $rs['type'];
		$i++;
	}
	
	echo json_encode($top);
}elseif ($operation == 'newzuo2') {
	$tpp = 20;
	$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);  
	$start_limit = ($page - 1) * $tpp;
	
   $regdate1= strtotime('2010-12-18');
   $regdate2= strtotime('2011-01-17 23:59:59'); 
   $jilu_res_count = DB::result_first("SELECT count(*) FROM (SELECT uid,type,author,dateline,auditstatus,myshowid,title,(click1+click2+click3+click4+click5+click6+click7+click8) as click, viewnum FROM ".DB::table('video_list').") m where type=1 and auditstatus=2 and dateline>$regdate1 and dateline<$regdate2");
   $query = DB::query("SELECT * FROM (SELECT uid,type,author,dateline,auditstatus,myshowid,title,(click1+click2+click3+click4+click5+click6+click7+click8) as click, viewnum FROM ".DB::table('video_list').") m where type=1 and auditstatus=2 and dateline>$regdate1 and dateline<$regdate2 ORDER BY click desc limit $start_limit,$tpp");	
   $i = 0;
	while ($rs = DB::fetch($query)) {
		if($i == 0) {
			$no = 1;
		} elseif ($rs['click'] == $top[$i-1]['click']) {
			$no = $top[$i-1]['no'];
		} else {
			$no = $i + 1;
		}
		
	  	$top[$i]['no'] = $no;
		$top[$i]['myshowid'] = $rs['myshowid'];
		$top[$i]['title'] = cutstr($rs['title'],26,'...');
		$top[$i]['author']=$rs['author'];
		$top[$i]['dateline']=date('Y-m-d',$rs['dateline']);
		$top[$i]['click'] = $rs['click'];
        $top[$i]['viewnum'] = $rs['viewnum'];
		$top[$i]['uid'] = $rs['uid'];
		$top[$i]['type'] = $rs['type'];
		$i++;
	}
	
	$multi = multi($jilu_res_count, $tpp, $page, "http://space.huoshow.com/show.php?mod=kge&operation=newzuo2");
	$multi = preg_replace("/href=\"http:\/\/space.huoshow.com\/show.php\?mod=kge&operation=newzuo2&amp;page=(\d+)\"/", "href=\"javascript:list4(\\1)\"", $multi);
	$multi = str_replace("window.location='http://space.huoshow.com/show.php?mod=kge&operation=newzuo2&amp;page='+this.value", "list4(this.value)", $multi);
	//echo $multi;
	$back['data'] = $top;
	$back['pagehtml'] = $multi;
	
	echo json_encode($back);
}elseif ($operation == 'newshi2') { 
	$tpp = 16;
	$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);  
	$start_limit = ($page - 1) * $tpp;
	 
   $regdate1= strtotime('2010-12-18');
   $regdate2= strtotime('2011-01-17 23:59:59'); 
   $jilu_res_count = DB::result_first("SELECT count(*) FROM (SELECT uid,videourl,type,author,dateline,auditstatus,myshowid,title,(click1+click2+click3+click4+click5+click6+click7+click8) as click FROM ".DB::table('video_list').") m where type=2 and auditstatus=2 and dateline>$regdate1 and dateline<$regdate2");
   $query = DB::query("SELECT * FROM (SELECT uid,videourl,type,author,dateline,auditstatus,myshowid,title,(click1+click2+click3+click4+click5+click6+click7+click8) as click FROM ".DB::table('video_list').") m where type=2 and auditstatus=2 and dateline>$regdate1 and dateline<$regdate2 ORDER BY click desc limit $start_limit,$tpp");	
   $i = 0;
	while ($rs = DB::fetch($query)) {
		if($i == 0) {
			$no = 1;
		} elseif ($rs['click'] == $top[$i-1]['click']) {
			$no = $top[$i-1]['no'];
		} else {
			$no = $i + 1;
		}
		
	  	$top[$i]['no'] = $no;
	  	$top[$i]['image']=cVideoPic($rs,'small');
		$top[$i]['myshowid'] = $rs['myshowid'];
		$top[$i]['title'] = cutstr($rs['title'],16,'...');
		$top[$i]['author']=$rs['author'];
		$top[$i]['uid'] = $rs['uid'];
		$top[$i]['type'] = $rs['type'];
		$top[$i]['click'] = $rs['click'];
		$i++;
	}
	$multi = multi($jilu_res_count, $tpp, $page, "http://space.huoshow.com/show.php?mod=kge&operation=newshi2");
	$multi = preg_replace("/href=\"http:\/\/space.huoshow.com\/show.php\?mod=kge&operation=newshi2&amp;page=(\d+)\"/", "href=\"javascript:shipin(\\1)\"", $multi);
	$multi = str_replace("window.location='http://space.huoshow.com/show.php?mod=kge&operation=newshi2&amp;page='+this.value", "shipin(this.value)", $multi);
	//echo $multi;
	$back['data'] = $top;
	$back['pagehtml'] = $multi;
	
	echo json_encode($back);
}elseif ($operation == 'newshi') {  
   $regdate1= strtotime('2010-12-18');
   $regdate2= strtotime('2011-01-17 23:59:59'); 
   $query = DB::query("SELECT * FROM (SELECT uid,videourl,type,author,dateline,auditstatus,myshowid,title FROM ".DB::table('video_list').") m where type=2 and auditstatus=2 and dateline>$regdate1 and dateline<$regdate2 ORDER BY dateline desc limit $num");	
   $i = 0;
	while ($rs = DB::fetch($query)) {
		if($i == 0) {
			$no = 1;
		} elseif ($rs['click'] == $top[$i-1]['click']) {
			$no = $top[$i-1]['no'];
		} else {
			$no = $i + 1;
		}
		
	  	$top[$i]['no'] = $no;
	  	$top[$i]['image']=cVideoPic($rs,'small');
		$top[$i]['myshowid'] = $rs['myshowid'];
		$top[$i]['title'] = cutstr($rs['title'],16,'...');
		$top[$i]['author']=$rs['author'];
		$top[$i]['uid'] = $rs['uid'];
		$top[$i]['type'] = $rs['type'];
		$i++;
	}
	
	echo json_encode($top);
}
?>
