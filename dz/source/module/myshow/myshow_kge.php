<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$top = array();
   $regdate1= strtotime('2010-11-18');
   $regdate2= strtotime('2011-01-17'); 
 $xuanshou = DB::query("SELECT m.uid,m.username,c.extcredits4 FROM ".DB::table('common_member_count')." c LEFT JOIN ".DB::table('common_member').
		" m ON c.uid=m.uid where regdate>$regdate1 and regdate<$regdate2 ORDER BY extcredits4 DESC LIMIT 10");

	$i = 0;
	
	if($xuanshou!=''){
	while ($rs = DB::fetch($xuanshou)) {
		
		
		$top[$i]['uid'] = $rs['uid'];
		$top[$i]['username'] = $rs['username'];
		$top[$i]['kge'] = $rs['extcredits4'];
		$i++;
	}
	}
	
	$renqi = DB::query("SELECT m.myshowid,m.title,m.click FROM (SELECT myshowid,title,dateline,(click1+click2+click3+click4+click5+click6+click7+click8) as 
	click FROM ".DB::table('video_list').") m where dateline>$regdate1 and dateline<$regdate2 ORDER BY click DESC LIMIT 10");
	$i = 0;
	while ($rs = DB::fetch($renqi)) {

		$top1[$i]['myshowid'] = $rs['myshowid'];
		$top1[$i]['title'] = cutstr($rs['title'],20,'...');
		$top1[$i]['click'] = $rs['click'];
		$i++;
	}
	
	$xinuser = DB::query("SELECT * FROM ".DB::table('common_member')." m where regdate>$regdate1 and regdate< $regdate2 ORDER BY regdate DESC LIMIT 16");
	$i = 0;
	while ($rs = DB::fetch($xinuser)) {
		
		$top2[$i]['avater'] = avatar($rs['uid'], 'small');
	  	
		$top2[$i]['uid'] = $rs['uid'];
		$top2[$i]['username'] = cutstr($rs['username'],6);
		
		$i++;
	}
	$xinzuo = DB::query("SELECT * FROM (SELECT uid,type,author,dateline,myshowid,title,(click1+click2+click3+click4+click5+click6+click7+click8) as click 
	FROM ".DB::table('video_list').") m where dateline>$regdate1 and dateline<$regdate2 ORDER BY dateline desc limit 12");
	$i = 0;
	while ($rs = DB::fetch($xinzuo)) {
		
	    
		$top3[$i]['myshowid'] = $rs['myshowid'];
		$top3[$i]['title'] = cutstr($rs['title'],40,'...');
		$top3[$i]['author']=$rs['author'];
		$top3[$i]['dateline']=date('Y-m-d',$rs['dateline']);
		$top3[$i]['click'] = $rs['click'];
		$top3[$i]['uid'] = $rs['uid'];
		$top3[$i]['type'] = $rs['type'];
		$i++;
	}
include template('myshow/kge');
?>