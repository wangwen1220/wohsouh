<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_share.php 6752 2010-03-25 08:47:54Z cnteacher $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$timet = time();
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
$dblink = new DataBase("");
//是否是打开的礼物
$gift_bag_id = DZ_GIFT_BAG_ID;
$sql = "SELECT * FROM pre_live_gift WHERE giftid = $gift_bag_id AND available=1";
$giftdata=$dblink->getRow($sql);
$isGiftBag = count($giftdata);

if($_GET['show']!=''){//接收礼物列表
	if ($_GET['show']=='2'){
		$action = 2;
	}elseif ($_GET['show']=='1'){
		$action = 1;
	}
	
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	$multilivepage = empty($_GET['multilivepage'])?1:intval($_GET['multilivepage']);
	if($page<1) $page=1;
	$id = empty($_GET['id'])?0:intval($_GET['id']);
	
	$perpage = 20;//分页行数
	
	$start = ($page-1)*$perpage;
	$multilivestart= ($multilivepage-1)*$perpage;
	ckstart($start, $perpage);
	ckstart($multilivestart, $perpage);
	$gets = array(
		'mod' => 'space',		
		'do' => 'gifts',		
		'dateline'=>$_GET['dateline'],
		'show' => $_GET['show'],		
	);
	$theurl = 'home.php?'.url_implode($gets);
	
	$dateline = $_GET['dateline'];
	$condition = '';
	if ($dateline){
		if ($dateline=='day'){
			$stime = strtotime(date("Y-m-d").' 00:00:00');
			$condition = " AND a.dateline >='$stime'";
		}
		if ($dateline=='week'){
			$stime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"));			
			$condition = " AND a.dateline >='$stime'";
		}
		if ($dateline=='month'){
			$stime = strtotime(date("Y-m").'-01 00:00:00');
			$condition = " AND a.dateline >='$stime'";
		}
	}
	$count = DB::result(DB::query("SELECT count(*) FROM ".DB::table('live_gift_log ')." a WHERE action = '$action' AND uid = ".$_G['uid']."$condition"),0);
	if ($count){
		$sql = "SELECT a.*,b.identifier,b.image,if(m.nickname!='',m.nickname,m.username) as nickname FROM ".DB::table('live_gift ')." b 
		right JOIN ".DB::table('live_gift_log')." a
		ON a.giftid = b.giftid  
		LEFT JOIN ".DB::table('common_member')." m ON m.uid=a.targetuid
		WHERE a.action = '$action' AND a.uid = ".$_G['uid'] ;
		if ($condition){
			$sql = $sql . $condition;
		}
		$sql = $sql." ORDER BY a.dateline DESC LIMIT $start,$perpage";
		$query = DB::query($sql);
		$rs = array();
		$i=0;
		while($res = DB::fetch($query)){
			$rs[$i] = $res;
			$rs[$i]['sendtime'] = date("Y-m-d H:i:s",$res['dateline']);
			$i++;
		}
		
		//print_r($rs);
	}
	$multi = livepage($count, $perpage, $page, $theurl,$multilivepage);

	$count2 = DB::result(DB::query("SELECT COUNT(*) FROM pre_multilive_gift_log a WHERE ACTION = '$action' AND uid=".$_G['uid']."$condition "),0);
	if ($count2) {
		$sql = "SELECT a.*,b.image FROM pre_multilive_gift_log a LEFT JOIN pre_live_gift b ON a.giftid=b.giftid WHERE ACTION ='$action' AND uid=".$_G['uid'];
		if ($condition){
			$sql = $sql . $condition;
		}
		$sql = $sql." ORDER BY a.dateline DESC LIMIT $multilivestart,$perpage";
		$query = DB::query($sql);
		$morers = array();
		$i=0;
		while($res = DB::fetch($query)){
			$morers[$i] = $res;
			$morers[$i]['sendtime'] = date("Y-m-d H:i:s",$res['dateline']);
			$i++;
		}
	}
	$livepage = $page;
	$multi2 = multilivepage($count2, $perpage, $multilivepage, $theurl,$livepage);
	
	include_once template("home/space_gifts_record");
	//echo $sql;
}else {
	if($_GET['act']=='sell'){
		if ($_GET['coin']=='showcoin'){
			$cointype = 2;
			$coinName='火币';
		}else{
			$cointype = 1;
			$coinName='秀币';
		}
		if($_GET['ajax']=='t'){				
			$giftid = $_GET['giftid'];
			$cointype = $_GET['cointype'];
			if($giftid=='all'){//出售全部
					$sql = "SELECT  a.id,a.uid,a.num,b.giftid,b.name,b.price ,b.identifier,b.image
					FROM ".DB::table('live_member_gift_count')." a 
					LEFT JOIN ".DB::table('live_gift')." b 
					ON a.giftid = b.giftid  
					WHERE a.uid = ".$_G['uid']." AND a.num>0";
				$query = DB::query($sql);
				$sumPrice = 0;	
				$rst = DB::fetch($query);
				while ($rst){									
					$sql = "UPDATE ".DB::table('live_member_gift_count')." SET num = num - ".$rst['num']." 
							WHERE uid=".$_G['uid']." AND num >=".$rst['num']." AND giftid=".$rst['giftid']." and id='".$rst['id']."'";
					DB::query($sql);
					
					if (!DB::affected_rows()){	
						$sql = "UPDATE ".DB::table('live_member_gift_count')." SET num = num + ".$rst['num']." 
								WHERE uid=".$_G['uid']."  AND giftid=".$rst['giftid'];				
					}else{
						$sumPrice = $sumPrice+($rst['price']*$rst['num'])/2;
					}
					$rst = DB::fetch($query);
				}
				$sumPrice = floor($sumPrice);
				
				if ($cointype==1){
					SIPHuoCoinUpdate($_G['uid'],'MRD',$sumPrice,$_G['username'].' 一键卖出礼物');
				}else{
					SIPHuoShowUpdate($_G['uid'],'MRD',$sumPrice,$_G['username'].' 一键卖出礼物');
				}
				$echo = 1;		
								
			}else{
				$selnum = $_GET['sellnums'];
				if($selnum<=0 or $giftid<=0 or $_G['uid']<=0){
					$res=0;
				}else{				
					$sql = "UPDATE ".DB::table('live_member_gift_count')." SET num = num-$selnum WHERE uid = ".$_G['uid']." AND num>=$selnum AND giftid = $giftid";	
						//echo 	$sql;
					DB::query($sql);	
								
					if(DB::affected_rows()){						
						$sql = "SELECT * FROM ".DB::table('live_gift')." WHERE giftid = ".$giftid;
						$value = DB::fetch_first($sql);
						$sumPrice = floor(($selnum*$value['price'])/2);
						if ($cointype==1){							
							SIPHuoCoinUpdate($_G['uid'],'MRD',$sumPrice,$_G['username'].' 出售 '.$selnum.' 个 '.$value['name'].' 礼物');
						}else{							
							SIPHuoShowUpdate($_G['uid'],'MRD',$sumPrice,$_G['username'].' 出售 '.$selnum.' 个 '.$value['name'].' 礼物');
						}
						
						$echo = 1;
						
					}else{
						$echo = 0;
					}
				}
			}
			echo $_GET['jsoncallback'], '(', json_encode($echo), ')'; 
			die();
		}
		if($_GET['giftid']!=''){
			
			$giftid = $_GET['giftid'];
			$id = $_GET['id'];
			$sql = "SELECT a.*,b.uid,b.num FROM ".DB::table('live_gift')." a 
			LEFT JOIN ".DB::table('live_member_gift_count')." b ON a.giftid=b.giftid 
			WHERE a.giftid = ".$giftid ." AND b.uid=".$_G['uid']." AND b.id=$id";
			//echo $sql;
			$query  = DB::query($sql);
			$value = DB::fetch_first($sql);
			$value['sellprice'] = $value['price']/2;
			$value['totalprice'] = floor($value['sellprice']*$value['num']);
			$typeName = $value['name'];
		}else{
			$typeName = '全部';
			$sumPrice = $_GET['sumprice'];
					
		}
		
		header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
	<root><![CDATA[';
		include_once template("home/space_gifts_sell");
		echo ']]></root>';
	
		
	}else{
	$sql = "SELECT  a.id,a.uid,a.num,b.giftid,b.name,b.price ,b.identifier,b.image
			FROM ".DB::table('live_member_gift_count')." a 
			LEFT JOIN ".DB::table('live_gift')." b 
			ON a.giftid = b.giftid  
			WHERE a.uid = ".$_G['uid']." AND a.num>0";
//	require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
//	$dblink = new DataBase("");
	$db_arr = $dblink->getRow($sql);
	$count = count($db_arr);
	$sumPrice = 0;
	$validate_only = array();
	$j=0;
	for($i=0;$i<$count;$i++)
	{
		$only_tmp = $db_arr[$i]['uid']."-".$db_arr[$i]['giftid'];
		if(empty($validate_only[$only_tmp])) {
			$validate_only[$only_tmp] = true;
			$rs[$j] = $db_arr[$i];
			$rs[$j]['sum_price']=$db_arr[$i]['price']*$db_arr[$i]['num'];
			$sumPrice = $sumPrice+$rs[$j]['sum_price'];
			$j++;
		}else {
			$sql = "DELETE FROM pre_live_member_gift_count WHERE id=".$db_arr[$i]['id'];
			//var_dump($sql);
			$dblink->query($sql);
			continue;
		}
		
	}
	//var_dump($rs);
	/*
	$query = DB::query($sql);
	$rs = array();
	$i = 0;
	$sumPrice = 0;
	//$validate_only = array();
	while ($rst = DB::fetch($query)){
		$only_tmp = $rst['uid']."-".$rst['giftid'];
//		echo $only_tmp.'<br>';
		//var_dump($validate_only[$only_tmp]);
		if(empty($validate_only[$only_tmp])) {
			$validate_only[$only_tmp] = true;
		}else {
			$sql = "DELETE FROM pre_live_member_gift_count WHERE id=".$rst['id'];
			echo $sql;
			$query= DB::query($sql);
			continue;
		}
		$rs[$i] = $rst;
		$rs[$i]['sum_price']=$rst['price']*$rst['num'];
		$sumPrice = $sumPrice+$rs[$i]['sum_price'];
		$i++;
	}
	echo '<br>';
	print_r($rs);
	*/
	$sumShowPrice =  floor($sumPrice/2);
	$sumPrice = floor($sumPrice/2);
	include_once template("home/space_gifts");
	}
}