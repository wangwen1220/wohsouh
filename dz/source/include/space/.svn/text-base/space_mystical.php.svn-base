<?php

/**
 *    神秘礼包
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Chance.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");
$dblink = new DataBase("");

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$uid = $_G['uid'];
$username = $_G['username'];
$time = getLocalTimeStr(time());
$page = empty($_G["gp_page"])?1:$_G["gp_page"];
$page_record = 10;
$count = $dblink->getRow("SELECT count(*) as count FROM pre_live_party_user_box_list WHERE dst_uid= $uid ORDER BY receive_time DESC");
$m_count = $count[0]["count"];
$sql = "SELECT * FROM pre_live_party_user_box_list WHERE dst_uid= $uid ORDER BY receive_time DESC LIMIT ".($page-1)*$page_record.",$page_record";
$mystical = $dblink->getRow($sql);
$page_split = new PagerSplit($m_count,$page,$page_record);
$page_str = $page_split->GetPagerContent();
//得到打开神秘礼包以后的礼物
$sql = "SELECT SUM(party_gift_num) AS num,a.party_gift_id,b.party_gift_name FROM pre_live_party_user_box_gift_list a,pre_live_party_gift_list b WHERE a.party_gift_id=b.id AND a.uid = $uid GROUP BY party_gift_id ORDER BY num DESC";
$openmysticalgift = $dblink->getRow($sql);
//查询是否有实体礼物
//$sql = "SELECT COUNT(num) as num FROM pre_live_party_user_box_entity_gift_log WHERE uid='$uid' ";
$sql = "select uid,username,num,gift_name,gift_id from pre_live_party_user_box_entity_gift_log where uid='$uid' ";
$numgift = $dblink->getRow($sql);
if ($_GET['open'] == 'opengift') {
	$id = $_GET['id'];
	$page = $_G["gp_page"];
	$box_num = $_GET['box_num'];
	$src_uid = $_GET['src_uid'];
	$sql = "select sum(box_num) as sum from pre_live_party_user_box_list where state =1";
	$gift = $dblink->getRow($sql);
	$sumgifts = $gift[0]['sum'] + $box_num;
 if ($sumgifts >=20000) {
	  			
	  		if ($gift[0]['sum']< 20000) {
	  			$isentitygift =20000;
	  			if ((($gift[0]['sum'] < $isentitygift ) &&($sumgifts >$isentitygift)) || ($sumgifts == $isentitygift))
	  			$msggift = 1;//添加送出实体礼物成功条件
				$giftname1 = "4季彩吧持久卷密睫毛膏,价值55元";
	  		}elseif ($gift[0]['sum'] < 50000){
	  			$isentitygift = 50000;
	  			if ((($gift[0]['sum'] < $isentitygift ) &&($sumgifts >$isentitygift)) || ($sumgifts == $isentitygift))
	  			$msggift = 2;//添加送出实体礼物成功条件
				$giftname2 = "巧茜妮恒润甜睡免洗面膜80G,价值65元";
	  		}elseif ($gift[0]['sum'] < 80000){
	  			$isentitygift = 80000;
	  			if ((($gift[0]['sum'] < $isentitygift ) &&($sumgifts >$isentitygift)) || ($sumgifts == $isentitygift))
	  			$msggift = 3;//添加送出实体礼物成功条件
				$giftname3 = "蜜乐兔重点去纹滚珠眼霜15G,价值128元";
	  		}elseif ($gift[0]['sum'] < 120000){
	  			$isentitygift = 120000;
	  			if ((($gift[0]['sum'] < $isentitygift ) &&($sumgifts >$isentitygift)) || ($sumgifts == $isentitygift))
	  			$msggift = 4;//添加送出实体礼物成功条件
	  			$giftname4 = "蜜乐兔粉嫩保湿BB霜40G,价值98元";
	  		}elseif ($gift[0]['sum'] < 160000){
	  			$isentitygift = 160000;
	  			if ((($gift[0]['sum'] < $isentitygift ) &&($sumgifts >$isentitygift)) || ($sumgifts == $isentitygift))
	  			$msggift = 5;//添加送出实体礼物成功条件
				$giftname5 = "蒙芭拉超细亲肤粉饼 18G,价值58元";
	  		}elseif ($gift[0]['sum'] < 200000) {
	  			$isentitygift = 200000;
	  			if ((($gift[0]['sum'] < $isentitygift ) &&($sumgifts >$isentitygift)) || ($sumgifts == $isentitygift))
	  			$msggift = 6;//添加送出实体礼物成功条件
				$giftname6 = "法国泊诗AquaBOSS全效BB霜35G,价值88元";
	  		}
		

		}
		$sql = "UPDATE pre_live_party_user_box_list SET state=1,open_time='$time' WHERE id=$id";
		$dblink->query($sql);
		//写入礼物
		$sql = "INSERT INTO pre_live_party_user_box_gift_list (`uid`,`src_uid`,`party_gift_id`,`box_id`,`party_gift_num`) VALUES ($uid,$src_uid,'1',$id,$box_num)";
	$dblink->query($sql);
	//查看日志表是否有记录，如果有进行更新，没有则新增
	$sql = "SELECT * FROM pre_live_party_user_box_gift_log WHERE uid = $uid AND party_gift_id = '1'";
	$gift_log = $dblink->getRow($sql);
	if (count($gift_log) > 0) {
		$sql = "UPDATE pre_live_party_user_box_gift_log SET gift_num=gift_num+$box_num WHERE uid=$uid AND party_gift_id='1'";
		$dblink->query($sql);
	}else {
		$sql = "INSERT INTO pre_live_party_user_box_gift_log (uid,party_gift_id,gift_num) VALUES ($uid,'1',$box_num)";
		$dblink->query($sql);
	}
		if(!empty($msggift)) {
				if ($msggift == 1) {
				$giftname = $giftname1;
			}elseif($msggift == 2) {
				$giftname = $giftname2;
			}elseif ($msggift == 3) {
				$giftname = $giftname3;
			}elseif ($msggift == 4) {
				$giftname = $giftname4;
			}elseif ($msggift == 5) {
				$giftname = $giftname5;
			}elseif ($msggift == 6) {
				$giftname = $giftname6;
			}
				$sql = "INSERT INTO pre_live_party_user_box_entity_gift_log (`uid`,`username`,`num`,`receive_time`,`gift_name`,`gift_id`) VALUES ($uid,'$username','1','$time','$giftname','$msggift')";
				$dblink->query($sql);
				//发送信息到直播间
				$data = array(
					'act' => '4',
					'type' => '1',
					'msg' => '恭喜 '.$username.' 打开神秘礼包，获得了'.$box_num.'个康乃馨和1个'.$giftname.'礼物',
				);
				$cmd_body = '020'.json_encode($data);
				socketSendData(LOCAL_HOST, LOCAL_PORT, encodeCommand($cmd_body, 6));
				MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data);
				g('打开礼包成功！您获得了'.$box_num.'个康乃馨和1个'.$giftname.'礼物 ','/home.php?mod=space&do=mystical&page='.$page);
		}else {	
				//发送信息到直播间
				$data = array(
					'act' => '4',
					'type' => '1',
					'msg' => '恭喜 '.$username.' 打开神秘礼包，获得了'.$box_num.'个康乃馨 ',
				);
				$cmd_body = '020'.json_encode($data);
				socketSendData(LOCAL_HOST, LOCAL_PORT, encodeCommand($cmd_body, 6));
				MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data);
				g('打开礼包成功！您获得了'.$box_num.'个康乃馨礼物 ','/home.php?mod=space&do=mystical&page='.$page);
			}
		//}
	
}
include_once template("home/space_mystical");
?>