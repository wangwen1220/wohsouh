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
require_once($root_path."/huoshow/FrameWork/LiveList.class.php");
$dblink = new DataBase("");
$huoshow_arr = LiveList::cGetHaselgroveList('lastmonthnum',50);
//当前月-1，上月
date_default_timezone_set("Asia/Shanghai");
$yy = strtotime('-1 month', time());
$y = date('Y',$yy);
$m = date('m',$yy);
for ($i=0;$i<count($huoshow_arr);$i++){
	$sql = "INSERT INTO pre_live_rich_month_history (`year`,`month`,`uid`,`username`,`rich_num`) VALUES ('$y','$m','".$huoshow_arr[$i]["uid"]."','".$huoshow_arr[$i]["username"]."','".$huoshow_arr[$i]["value"]."') ";
	$dblink->query($sql);
}
echo time()."\n";
?>