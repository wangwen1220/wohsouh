<?php

/**
 * 每个月的第一天，把上个月的富豪值写入到统计表
 *
 * @author Administrator
 * @package defaultPackage
 */

$root_path = realpath(dirname(__FILE__)."/../..");
$_SERVER['DOCUMENT_ROOT'] = $root_path;
require_once($root_path."/huoshow/FrameWork/DataBase.php");
date_default_timezone_set("Asia/Shanghai");
$dblink = new DataBase("");
//当前月-1，上月
$yy = strtotime('-1 month', time());
$y = date('Y',$yy);
$m = date('m',$yy);
$first = mktime(0,0,1,$m,1,$y);
if ($m == 12){
	$last = mktime(0,0,0,1,1,$y+1);
}else {
	$last = mktime(0,0,0,$m+1,1,$y);
}
$sql ="SELECT uid,username,dateline,SUM(giftprice*num) pic FROM pre_live_gift_log WHERE ACTION=1 
AND dateline >= $first AND dateline< $last GROUP BY uid ORDER BY pic DESC LIMIT 0,50";
$dataarr = $dblink->getRow($sql);
for ($i=0;$i<count($dataarr);$i++){
	$dataarr[$i]["year"] = date('Y',$dataarr[$i]["dateline"]);
	$dataarr[$i]["month"] = date('m',$dataarr[$i]["dateline"]);
	$sql = "INSERT INTO pre_live_rich_month_history (`year`,`month`,`uid`,`username`,`rich_num`) VALUES ('".$dataarr[$i]["year"]."','".$dataarr[$i]["month"]."','".$dataarr[$i]["uid"]."','".$dataarr[$i]["username"]."','".$dataarr[$i]["pic"]."') ";
	$dblink->query($sql);
}
?>