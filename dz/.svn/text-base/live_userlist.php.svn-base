<?php
error_reporting(0);
header("Content-Type: text/xml; charset=UTF-8");
require_once './source/class/class_core.php';
require_once './source/function/function_home.php';

$discuz = & discuz_core::instance();

$discuz->init();


$roomid=@$_GET['roomid'];
$t=@$_GET['t'];
if ($roomid){
	
	
	$sql = "SELECT `time` FROM pre_live_roomup WHERE roomid='$roomid' ORDER BY time DESC limit 1 ";
	$dbt = DB::fetch_first($sql);	
	//echo $sql;
	if ($dbt['time']>$t){
		$sql = "SELECT * FROM pre_live_userlist  WHERE roomid = '$roomid' GROUP BY roomid,uid ORDER BY usertype ASC";		
		$query=DB::query($sql);
		while ($res = DB::fetch($query)){
			settype($res['roomid'], "string");
			settype($res['uid'], "string");
			settype($res['usertype'], "string");
			settype($res['canSay'], "string");	
			$arr[] = $res;		
		}
		
		if (!$arr){		
			$arr=array();
		}
		
		$ret = array('type'=>'userlist','userlist'=>$arr,'t'=>$dbt['time']);
		
		die( json_encode($ret));		
	}else {
		echo '';
		die();	
	}
}