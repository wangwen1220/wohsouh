<?php
set_time_limit(0);
error_reporting(0);
define('WWW_URL','/');
define(IMG_URL, '/img/');
$limit = 100;
require_once 'Db.class.php';
$dbinc =  require_once '../cmstop/config/db.php';
$db = new Db($dbinc['host'],$dbinc['username'],$dbinc['password'],$dbinc['dbname'],$dbinc['charset']);
$table_pre = 'cmstop_';



$act = @$_GET['act'];
if ($act=='remendiaocha' && @$_GET['cid']!=''){
	$contentId = $_GET['cid'];
	$sql = "select * from #table_vote  where contentid = $contentId";
	$r = getRow($sql);
	
    $total = $r[total];  
	
	$sql = "SELECT * FROM #table_vote_option where contentid= $contentId order by votes desc limit 1";
	$rs = getRow($sql);
	$maxvotes = $rs[votes];    
    $prevotes = round($maxvotes/$total,2)*100;
	$arr=array('total'=>$total,'prevotes'=>$prevotes);
	echo $_GET['jsoncallback'], '(', json_encode($arr), ')'; 
	die();
	
	
}
function trueSql($sql){
	global $table_pre;
	$sql = str_replace('#table_', $table_pre, $sql);
	return $sql;
}
function getAll($sql){
	global $db,$table_pre;
	$sql = str_replace('#table_', $table_pre, $sql);
	return $db->getAll($sql);
}
function getOne($sql){
	global $db,$table_pre;
	$sql = str_replace('#table_', $table_pre, $sql);
	return $db->getOne($sql);
}
function getRow($sql){
	global $db,$table_pre;
	$sql = str_replace('#table_', $table_pre, $sql);
	return $db->getRow($sql);
}