<?php

/**
 * 缓存当前周的魅力值、魅力指数、魅力之星，200条，做直播间排名用的
 *
 * @author Administrator
 * @package defaultPackage
 */

$root_path = realpath(dirname(__FILE__)."/../..");
$_SERVER['DOCUMENT_ROOT'] = $root_path;
require_once($root_path."/huoshow/FrameWork/DataBase.php");
require_once($root_path."/huoshow/FrameWork/LiveList.class.php");
$dblink = new DataBase("");
//取得月相关记录
$month_data_all = LiveList::Charm_Score_List('weeknum',200);
$month_data = $month_data_all["score_data"];
//先清除再新增
$sql = "DELETE FROM pre_live_top_month_current";
$dblink->query($sql);
for ($i=0;$i<count($month_data);$i++){
	$month_data[$i]["value"] = floor($month_data[$i]["value"]);
	$sql = "INSERT INTO pre_live_top_month_current (`charm`,`vote`,`exponent`,`uid`,`username`) VALUES ('".$month_data[$i]["charm"]."','".$month_data[$i]["vote"]."','".$month_data[$i]["value"]."','".$month_data[$i]["uid"]."','".$month_data[$i]["nickname"]."')";
	$dblink->query($sql);
}
echo time()."\n";
?>