<?php
/**
 * 历史记录，日，魅力值，魅力之星，魅力指数写入200条
 *
 * @author Administrator
 * @package defaultPackage
 */

$root_path = realpath(dirname(__FILE__)."/../..");
$_SERVER['DOCUMENT_ROOT'] = $root_path;
require_once($root_path."/huoshow/FrameWork/DataBase.php");
require_once($root_path."/huoshow/FrameWork/LiveList.class.php");
$dblink = new DataBase("");
$time = date("Y-m-d",strtotime("-1 day"));
$yester_day  = strtotime($time);
$charm_arr_all = LiveList::Charm_Value_List('yesterday',50);
$charm_arr = $charm_arr_all["charm_data"];
$vote_arr_all = LiveList::Charm_Vote_List('yesterday',50);
$vote_arr = $vote_arr_all["vote_data"];
$exponent_arr_all = LiveList::Charm_Score_List('yesterday',50);
$exponent_arr = $exponent_arr_all["score_data"];
//魅力值 1
for ($i=0;$i<count($charm_arr);$i++){
	if ($charm_arr[$i]['uid'] == 0) 
		continue;
	$sql = "INSERT INTO pre_live_top_day_history (`uid`,`username`,`type`,`value`,`createtime`) VALUE ('".$charm_arr[$i]['uid']."','".$charm_arr[$i]['nickname']."','1','".$charm_arr[$i]['value']."','$yester_day')";
	$dblink->query($sql);
}
//魅力之星 2
for ($j=0;$j<count($vote_arr);$j++){
	$sql = "INSERT INTO pre_live_top_day_history (`uid`,`username`,`type`,`value`,`createtime`) VALUE ('".$vote_arr[$j]['uid']."','".$vote_arr[$j]['nickname']."','2','".$vote_arr[$j]['value']."','$yester_day')";
	$dblink->query($sql);
}
//魅力指数 0
for ($k=0;$k<count($exponent_arr);$k++){
	$exponent_arr[$k]["value"] = floor($exponent_arr[$k]["value"]);
	$sql = "INSERT INTO pre_live_top_day_history (`uid`,`username`,`type`,`value`,`createtime`) VALUE ('".$exponent_arr[$k]['uid']."','".$exponent_arr[$k]['nickname']."','0','".$exponent_arr[$k]['value']."','$yester_day')";
	$dblink->query($sql);
}
echo time()."\n";
?>