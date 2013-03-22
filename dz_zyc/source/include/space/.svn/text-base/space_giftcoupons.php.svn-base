<?php
/**
 *    我的礼券
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
$dblink = new DataBase("");
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$uid = $_G['uid'];
$time = time();
$sql = "SELECT * FROM pre_mutilive_ticket_stat WHERE uid=$uid";
$giftc_arr = $dblink->getRow($sql);
$sumPrice = floor($giftc_arr[0]["pointticket_totalprice"]);
//是否是打开的礼物
$gift_bag_id = DZ_GIFT_BAG_ID;
$sql = "SELECT * FROM pre_live_gift WHERE giftid = $gift_bag_id AND available=1";
$giftdata=$dblink->getRow($sql);
$isGiftBag = count($giftdata);
if ($_GET['act']=='sell') {
	$sump = $_GET['sumprice'];
	$type = $_GET['type'];
	header("Content-Type: text/xml; charset=utf-8");
	echo '<?xml version="1.0" encoding="utf-8"?>
	<root><![CDATA[';
	include_once template("home/space_giftcoupons_sell");
	echo ']]></root>';
	return;
}

if ($_GET['act']=='allsell') {
	$huo_total = $_GET['sumprice'];
	$huo_type = $_GET['type'];
	$sql = "UPDATE pre_mutilive_ticket_stat SET pointticket_totalprice='0' WHERE uid=$uid";
	$dblink->query($sql);
	if ($huo_type == 1){
		SIPHuoCoinUpdate($_G['uid'],'MRD',$huo_total,($_G['uid']).' 一键卖出礼券');
		echo 1;
	}else {
		SIPHuoShowUpdate($_G['uid'],'MRD',$huo_total,($_G['uid']).' 一键卖出礼券');
		echo 1;
	}
	return;
}

//关闭数据库链接
$dblink->dbclose();
include_once template("home/space_giftcoupons");
?>