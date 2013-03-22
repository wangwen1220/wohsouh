<?php

/**
 * 本活动于2011-12-24 00：00：01 到 2012-1-3号 23：59：59
 * 活动礼包到期自动打开礼包，如主播未打开礼包，则系统自动打开礼包兑换成圣诞树礼物并自动兑换成火币，道具消失
 *
 * @author Administrator
 * @package defaultPackage
 */

$root_path = realpath(dirname(__FILE__)."/../..");
$_SERVER['DOCUMENT_ROOT'] = $root_path;
require_once($root_path."/huoshow/FrameWork/DataBase.php");
require_once($root_path."/huoshow/FrameWork/MutilLiveRoom.class.php");
require_once($root_path."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");
date_default_timezone_set("Asia/Shanghai");
ini_set("display_errors","on");
$dblink = new DataBase("");
$time = time();
//过期时间 2012-01-03 23:59:59  =>  1325606399
$expiration = 1325606399;
$expiration1 = getLocalTimeStr($expiration);
//if ($time >= $expiration) {
	//得到没有打开的礼包
	$sql = "SELECT * FROM pre_live_party_user_box_list WHERE state = 0 ";
	$notopenarr = $dblink->getRow($sql);
	for ($a=0;$a<count($notopenarr);$a++){
		//插入记录
		$sql = "INSERT INTO pre_live_party_user_box_gift_list (`uid`,`src_uid`,`party_gift_id`,`box_id`,`party_gift_num`) VALUES	('".$notopenarr[$a]["dst_uid"]."','".$notopenarr[$a]["src_uid"]."',1,'".$notopenarr[$a]["id"]."','".$notopenarr[$a]["box_num"]."')";
		$dblink->query($sql);
		//更改礼包状态和打开时间
		$sql = "UPDATE pre_live_party_user_box_list SET state=1,open_time='$expiration1' WHERE dst_uid=".$notopenarr[$a]["dst_uid"];
		$dblink->query($sql);
		
		//查看日志表是否有记录，如果有进行更新，没有则新增
		$sql = "SELECT * FROM pre_live_party_user_box_gift_log WHERE uid = '".$notopenarr[$a]["dst_uid"]."' AND party_gift_id = 1";
		$gift_log = $dblink->getRow($sql);
		if (count($gift_log) > 0) {
			$sql = "UPDATE pre_live_party_user_box_gift_log SET gift_num=gift_num+'".$notopenarr[$a]["box_num"]."' WHERE party_gift_id = '1' AND uid='".$notopenarr[$a]["box_num"]."'";
			$dblink->query($sql);
		}else {
			$sql = "INSERT INTO pre_live_party_user_box_gift_log (uid,party_gift_id,gift_num) VALUES ('".$notopenarr[$a]["dst_uid"]."',1,'".$notopenarr[$a]["box_num"]."')";
			$dblink->query($sql);
		}
	}
	//得到礼物列表的ID
	$sql = "SELECT * FROM pre_live_party_gift_list";
	$giftlist = $dblink->getRow($sql);
	//根据礼物ID得到有多少个人拥有这个礼物
	for ($i=0;$i<count($giftlist);$i++){
		$sql = "SELECT uid,party_gift_id,SUM(party_gift_num) AS num,SUM(party_gift_num* '".$giftlist[$i]["party_gift_huocoin"]."') AS huocoin,SUM(party_gift_num*'".$giftlist[$i]["party_gift_charm"]."') AS charm
FROM pre_live_party_user_box_gift_list WHERE party_gift_id = '".$giftlist[$i]["id"]."' AND isexpired = 0 GROUP BY uid";
		$m_gift = $dblink->getRow($sql);
		for ($j=0;$j<count($m_gift);$j++){
			//更改魅力值
			$sql = "UPDATE pre_live_member_count SET charm = charm+'".$m_gift[$j]["charm"]."' WHERE uid=".$m_gift[$j]["uid"];
			$dblink->query($sql);
			//判断pre_live_top UID是否存在
			$sql = "SELECT *,(SELECT IF(m.nickname!='',m.nickname,m.username) AS nickname FROM pre_ucenter_members m WHERE s.uid=m.uid) AS nickname,(SELECT newprompt FROM pre_common_member b WHERE s.uid=b.uid ) AS newprompt FROM pre_live_top s WHERE s.cate='charm' AND s.uid=".$m_gift[$j]["uid"];
			$istopuid =$dblink->getRow($sql);
			if (count($istopuid) > 0) {
				//更改历史记录表的魅力值
				$sql = "UPDATE pre_live_top SET daynum = daynum+'".$m_gift[$j]["charm"]."',weeknum= weeknum+'".$m_gift[$j]["charm"]."',monthnum=monthnum+'".$m_gift[$j]["charm"]."',totalnum=totalnum+'".$m_gift[$j]["charm"]."' WHERE cate='charm' AND uid =".$m_gift[$j]["uid"];
				$dblink->query($sql);
			}else {
				$sql = "INSERT INTO pre_live_top (`cate`,`uid`,`username`,`daynum`,`weeknum`,`monthnum`,`totalnum`) VALUES ('charm','".$m_gift[$j]["uid"]."','".$istopuid[0]["nickname"]."','".$m_gift[$j]["charm"]."','".$m_gift[$j]["charm"]."','".$m_gift[$j]["charm"]."','".$m_gift[$j]["charm"]."')";
				$dblink->query($sql);
			}
			$original_charm =  $istopuid[0]["totalnum"];
			$original_charm_level = MutilLiveRoomSocketApi::getUserLevel($original_charm,2);
            $now_charm_level = MutilLiveRoomSocketApi::getUserLevel(($original_charm+$m_gift[$j]["charm"]),2);
            $charm_remark = "恭喜".$istopuid[0]["nickname"]."明星等级上升到".$now_charm_level[0]["level"]."级";
            if ($now_charm_level[0]["level"] > $original_charm_level[0]["level"] && $now_charm_level[0]["level"] >1) {
            	$sql = "INSERT INTO pre_home_notification (`uid`,`type`,`new`,`authorid`,`author`,`note`,`dateline`,`from_id`,`from_num`) 
VALUES ('".$istopuid[0]["uid"]."','livemessage','1','".$istopuid[0]["uid"]."','".$istopuid[0]["nickname"]."','$charm_remark','$time','0','1')";
				$dblink->query($sql);
				$newp = $istopuid[0]["newprompt"] + 1;
				//更新提醒数值
				$dblink->query("UPDATE pre_common_member SET `newprompt` = '$newp' WHERE uid=".$istopuid[0]["uid"]);
            }
			//火秀币表是否存在记录
			$sql = "SELECT * FROM pre_ucenter_showcoin WHERE uid = ".$m_gift[$j]["uid"];
			$isshowid =$dblink->getRow($sql);
			if (count($isshowid) > 0) {
				//更改火币
				$sql = "UPDATE pre_ucenter_showcoin SET showcoin = showcoin+'".$m_gift[$j]["huocoin"]."' WHERE uid=".$m_gift[$j]["uid"];
				$dblink->query($sql);
			}else {
				//新增加火币
				$sql = "INSERT INTO pre_ucenter_showcoin (`uid`,`showcoin`,`consume`,`huocoin`,`consume_huo`) VALUES ('".$m_gift[$j]["uid"]."','".$m_gift[$j]["huocoin"]."','0','0','0') ";
				$dblink->query($sql);
			}
			
		}
		//根据ID得到送礼人得到多少豪爽度
		$sql = "SELECT uid,src_uid,party_gift_id,SUM(party_gift_num) AS num,SUM(party_gift_num* '".$giftlist[$i]["party_gift_rich"]."') AS rich FROM pre_live_party_user_box_gift_list WHERE party_gift_id = '".$giftlist[$i]["id"]."' AND isexpired = 0 GROUP BY src_uid";
		$m_rich = $dblink->getRow($sql);
		for ($k=0;$k<count($m_rich);$k++){
			//火秀币表是否存在记录
			$sql = "SELECT s.*,(SELECT IF(m.nickname!='',m.nickname,m.username) AS nickname FROM pre_ucenter_members m WHERE s.uid=m.uid) AS nickname,(SELECT newprompt FROM pre_common_member b WHERE s.uid=b.uid ) AS newprompt FROM pre_ucenter_showcoin as s WHERE s.uid = ".$m_rich[$k]["src_uid"];
			$isshowid =$dblink->getRow($sql);
			if (count($isshowid) > 0) {
				//更改豪爽度
				$sql = "UPDATE pre_ucenter_showcoin SET consume = consume+'".$m_rich[$k]["rich"]."' WHERE uid=".$m_rich[$k]["src_uid"];
				$dblink->query($sql);
			}else {
				$sql = "INSERT INTO pre_ucenter_showcoin (`uid`,`showcoin`,`consume`,`huocoin`,`consume_huo`) VALUES ('".$m_rich[$k]["src_uid"]."','0','".$m_rich[$k]["rich"]."','0','0') ";
				$dblink->query($sql);
			}
			//原有的消费值
            $original_consume = $isshowid[0]["consume"];
            $original_level = MutilLiveRoomSocketApi::getUserLevel($original_consume,1);
            $now_level = MutilLiveRoomSocketApi::getUserLevel(($original_consume+$m_rich[$k]["rich"]),1);
            $remark = "恭喜".$isshowid[0]["nickname"]."富豪等级上升到".$now_level[0]["level"]."";
            if ($now_level[0]["level"] > $original_level[0]["level"] && $now_level[0]["level"] >1) {
            	$sql = "INSERT INTO pre_home_notification (`uid`,`type`,`new`,`authorid`,`author`,`note`,`dateline`,`from_id`,`from_num`) 
VALUES ('".$isshowid[0]["uid"]."','livemessage','1','".$isshowid[0]["uid"]."','".$isshowid[0]["nickname"]."','$remark','$time','0','1')";
				$dblink->query($sql);
				$newp = $isshowid[0]["newprompt"] + 1;
				//更新提醒数值
				$dblink->query("UPDATE pre_common_member SET `newprompt` = '$newp' WHERE uid=".$isshowid[0]["uid"]);
            }
            
            //查找是否有记录
            $sql = "SELECT * FROM pre_live_top WHERE cate='huoshow' AND uid=".$m_rich[$k]["src_uid"];
            $rich_count = $dblink->getRow($sql);
            if (count($rich_count) > 0) {
				//更改历史记录表的豪福值
				$sql = "UPDATE pre_live_top SET daynum = daynum+'".$m_rich[$k]["rich"]."',weeknum= weeknum+'".$m_rich[$k]["rich"]."',monthnum=monthnum+'".$m_rich[$k]["rich"]."',totalnum=totalnum+'".$m_rich[$k]["rich"]."' WHERE cate='huoshow' AND uid =".$m_rich[$k]["src_uid"];
				$dblink->query($sql);
			}else {
				$sql = "INSERT INTO pre_live_top (`cate`,`uid`,`username`,`daynum`,`weeknum`,`monthnum`,`totalnum`) VALUES ('huoshow','".$m_rich[$k]["src_uid"]."','".$isshowid[0]["nickname"]."','".$m_rich[$k]["rich"]."','".$m_rich[$k]["rich"]."','".$m_rich[$k]["rich"]."','".$m_rich[$k]["rich"]."')";
				$dblink->query($sql);
			}
		}
	}
	
	//更改用户活动礼物为过期
	$sql = "SELECT id FROM pre_live_party_user_box_gift_list";
	$up_gift = $dblink->getRow($sql);
	for ($s=0;$s<count($up_gift);$s++){
		$sql = "UPDATE pre_live_party_user_box_gift_list SET isexpired=1 WHERE id=".$up_gift[$s]["id"];
		$dblink->query($sql);
	}
die("执行完毕！！！")	
//}

?>