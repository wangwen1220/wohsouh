<?php
require_once libfile('function/feed');

$roomid = $_GET['roomid'];
$sql = "SELECT f.*,IF(m.nickname!='',m.nickname,m.username) AS nickname FROM pre_home_feed f LEFT JOIN pre_common_member m ON m.uid=f.uid WHERE 1 AND f.uid=$roomid ORDER BY dateline DESC LIMIT 0,10";
$query = DB::query($sql);
while ($value = DB::fetch($query)) {
	if(!isset($hotlist[$value['feedid']]) && !isset($hotlist_all[$value['feedid']]) && ckfriend($value['uid'], $value['friend'], $value['target_ids'])) {
		$value = mkfeed($value);
		if($value['dateline']>=$_G['home_today']) {
			$list['today'][] = $value;
		} elseif ($value['dateline']>=$_G['home_today']-3600*24) {
			$list['yesterday'][] = $value;
		} else {
			$theday = dgmdate($value['dateline'], 'Y-m-d');
			$list[$theday][] = $value;
		}
	}
	$count++;
}

include_once template("diy:home/space_dynamic");
?>