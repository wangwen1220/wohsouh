<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_space.php 10932 2010-05-18 07:39:13Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/live');

$uid = empty($_G['uid']) ? 0 : intval($_G['uid']);
$operation = $_G['gp_operation'];
if ($operation=='give'){
	$giftid = $_G['gp_giftid'];
	$giftnum = intval($_G['gp_giftnum']);
	$targetuid = $_G['gp_targetuid'];
	$roomid = $_GET['roomid'];
	if ($targetuid!=$roomid or empty($targetuid)){
		$back = array(0, '只能给主播送礼物');
		echo json_encode($back);
		die();
	}
	//主播信息
	$anchorInfo = DB::fetch_first("SELECT a.*,IF( b.nickname != '', b.nickname, a.username ) AS nickname FROM ".DB::table('live_member_count')." a LEFT JOIN ".DB::table('common_member')." b ON a.uid=b.uid WHERE a.uid='$roomid'");
	$targetInfo = DB::fetch_first("SELECT a.*,IF( b.nickname != '', b.nickname, a.username ) AS nickname FROM ".DB::table('live_member_count')." a LEFT JOIN ".DB::table('common_member')." b ON a.uid=b.uid WHERE a.uid='$targetuid'");
	//礼物信息
	$giftInfo = DB::fetch_first("SELECT * FROM ".DB::table('live_gift')." WHERE giftid='$giftid'");
	if (isset($giftInfo['content'])) {
		$giftInfo['content'] = trim($giftInfo['content']);
	}
	//房间信息
	$sql = "SELECT * FROM ".DB::table('live_room')." WHERE roomid = '$roomid'";
	$roomInfo = DB::fetch_first($sql);
	
	$back = array();
	
	if (empty($giftInfo)) {
		$back = array(0, '请选择要赠送的礼物');
	} elseif (empty($uid)) {
		$back = array(0, '你未登录不能赠送礼物');
	} elseif (empty($anchorInfo)) {
		$back = array(0, '获取不到主播信息');
	} elseif ($uid == $targetInfo['uid']) {
		$back = array(0, '不能给自己赠送礼品');
	} elseif(!$giftnum || $giftnum < 0) {
		$back = array(0, '操作数量不合法');
	} else {
		//主播是否在线
		$online = MSN_RoomStatus($roomInfo['roomid']);
		//$online =1;
		if (empty($online)) {
			$back = array(0, '主播不在线不能赠送礼物');
		} else {
			//消费的火秀币
			$huoshow = $giftInfo['price'] * $giftnum;
			//用户的火秀币
			$hisHuoshow = SIPHuoShowGetBalance($uid);
	
			if ($hisHuoshow - $huoshow < 0) {
				$back = array(0, '您的火币余额不足哦！请到 <a href="home.php?mod=space&do=pay" target="_blank">支付中心</a> 进行充值，或者 <a href="home.php?mod=task" target="_blank">完成每日任务</a> 赚取火币。');
			} else {
				$remark='购买'.$giftnum.'个"'.$giftInfo['name'].'"礼物';
				$logId = SIPHuoShowUpdate($uid, 'MRC', -$huoshow, $remark);
				
				if ($logId) {
					
						
					//消费排行
					/////////////////////////////////////////////
					$money = $huoshow;
					
					//消费的火秀币变动情况
					$consumeOld = DB::result_first("SELECT consume FROM ".DB::table('ucenter_showcoin')." WHERE uid='$uid'");
					$consumeNow = $consumeOld + $money;
								
					$username = $_G['username'];
					$live_top_res = DB::fetch_first("SELECT * FROM ".DB::table('live_top')." WHERE uid ='{$uid}' AND cate='huoshow' LIMIT 1");
					if($live_top_res) {
						DB::query("UPDATE ".DB::table('live_top')." SET daynum=daynum + {$money} ,weeknum=weeknum + {$money} ,monthnum=monthnum + {$money}  WHERE id ='{$live_top_res['id']}'");
					} else {
						DB::insert('live_top', array('cate'=>'huoshow','uid'=>$uid,'username'=>$username,'daynum'=>$money,'weeknum'=>$money,'monthnum'=>$money));
					}
					DB::query("UPDATE ".DB::table('ucenter_showcoin')." SET consume=consume + {$money} WHERE uid ='{$uid}'");
					
					//财富等级升级提示
					include_once libfile('function/live');
					$huoshowLevelOld = cGetHuoshowLevel($consumeOld);
					$huoshowLevelNow = cGetHuoshowLevel($consumeNow);
					if ($huoshowLevelNow['level'] > $huoshowLevelOld['level']) {
						$noticeMsg = '恭喜'.$username.'财富等级升到'.$huoshowLevelNow['level'].'级';
						insertNotice($noticeMsg);	
					}
					///////////////////////////////////////////////
	
					
					cGiftLogAndUpdateData($uid, $targetInfo, $giftInfo, $giftnum, $huoshow,$roomInfo);
					//if ($_GET['gifttypeid']=='limit') pk::sendLimitGift($uid, $targetInfo, $giftInfo, $giftnum, $huoshow,$roomInfo);
					$back = array(1, '赠送成功');
					
					$sql ="SELECT * FROM ".DB::table('live_giftup')." WHERE roomid = '".$roomInfo['roomid']."'";
					$room = DB::result_first($sql);			
					if (!$room['rooid']){			
						$sql = "INSERT INTO ".DB::table('live_giftup')." (`roomid`,`time`) values ('".$roomInfo['roomid']."','".time()."')";				
						DB::query($sql);		
					}else{				
						$sql = "UPDATE ".DB::table('live_giftup')." SET `time` = '".time()."' WHERE roomid = ".$roomInfo['roomid'];
						DB::query($sql);
					}	 
					
					$sql = " INSERT INTO ".DB::table('live_giftlist')." "
						 . " (`roomid`,`uid`,`username`,`giftid`,`giftname`,`giftimage`,`nums`,`times`) "
						 . " VALUES ('".$roomInfo['roomid']."','".$_G['uid']."','".$_G['username']."','".$giftInfo['giftid']."','".$giftInfo['name']."','".$giftInfo['image']."','$giftnum','".time()."') ";
					DB::query($sql);
					
					
					$roomid = $roomInfo['roomid'];
					//+memcache缓存 2011.06.23 zhangcj
					//礼物列表、礼物更新时间过期
					$memcache = new cmemcache();
					$memcache->rm("live_giftlist-$roomid");
					$memcache->rm("live_giftup-$roomid");
					$memcache->close();
					//end
					
					
					//给消息服务器发送信息
					//$writeData = '{"roomid":"105","uid":"1","username":"admin","action":"msgChat","type":"3","msg":"用户XX给XX发送了一个礼物","usertype":"1","mode":"manage","giftid":"001"}';
					
					/*$giftIconUrl = "";
					for ($i = 0; $i < min($giftnum, 50); $i++) {
						$giftIconUrl .= "<img src='static2/images/gift/".$giftInfo['image']."' />";
					}*/
					$giftIconUrl = $giftInfo['image'];
					if ($_G['member']['nickname']){
						$sendUsername = $_G['member']['nickname'];
					}else{
						$sendUsername = $_G['username'];
					}
					if ($huoshow>=100){
						$noticeMsg = $targetInfo['nickname'].' 收到 '.$giftnum.'个'.$giftInfo['name'].'<img src = "/static2/images/gift/'.$giftIconUrl.'" style="width:22px;height:22px;"/>';
						insertNotice($noticeMsg);
					}
					if (empty($giftInfo['content'])) {
						$msg = $sendUsername.'送给'.$targetInfo['nickname'].$giftIconUrl.$giftInfo['name'].',共'.$giftnum.'个';
					} else {
						$search = array(
							//'{icon}...{icon}',
							//'{icon}*{num}',
							'{sender}',
							'{name}',
							//'{icon}',						
							'{unit}',
							'{receiver}'
						);
						$replace = array(
							//$giftIconUrl,
							//$giftIconUrl,
							$sendUsername,
							$giftInfo['name'],
							//$giftIconUrl,						
							$giftInfo['units'],
							$targetInfo['nickname']
						);
						$msg = str_replace($search, $replace, $giftInfo['content']);				
					}
					
					//发消息到消息服务器
					$writeData = '{"roomid":"'.$roomInfo['roomid']
					.'","uid":"1","username":"admin","action":"msgChat","type":"3","giftImg":"'.$giftIconUrl.'","giftNum":"'.$giftnum.'","msg":"'.$msg.'","usertype":"1","mode":"manage","giftid":"'.$giftInfo['giftid'].'"}';
					$dataMsg = getMsgLenStr(";115;$writeData", 4).";115;$writeData";
					socketData(API_SOCKET_HOST, MSN_PORT, $dataMsg);
					
				} else {
					$back = array(0, '系统原因导致赠送失败');
				}
			}
		}
	}
	echo json_encode($back);
	die();
}
if ($operation=='giftlist'){
	
	$period = PK::getPKInfo();
	if (key_exists('limitLeftTime', $period)){
		if ($period['limitLeftTime']==0 || $_GET['act']=='endLimitGift'){
			$giftType = cGetGiftType();
			$giftList = cGetGift();
			if ($_GET['act']!='endLimitGift'){
				$gtype=array(0=>array('typeid'=>'limit','name'=>'限时礼物'));			
				$giftType = array_merge($gtype,$giftType);
			
				$sql = "SELECT b.giftid,b.image,b.name,  'limit' as typeid,b.price,b.units,b.content FROM "
					 .DB::table('activity_period_bindgift')." a LEFT JOIN "
					 .DB::table('live_gift')." b ON a.giftid=b.giftid WHERE a.perid='".PERID."' ";
				
				$query = DB::query($sql);			
				while ($res = DB::fetch($query))
				{
					$giftList['limit'][] = $res;
				}
			}
			$html.= '
				<a href="#" onclick="hide_gift_box();return false;" class="close-gift-box">关闭</a>
				<div class="biaot3">';
			foreach ($giftType as $key=>$value){		
				$html.= '<a href="javascript:;" >'.$value[name].'</a> &nbsp;&nbsp;&nbsp;';		
			}
			$html.= '</div>';
			foreach ($giftType as $k=>$v){
				$html.= '<div class="lipin"><ul class="lipin-b">';
				foreach ($giftList[$v['typeid']] as $kk=>$vv)
				{
					$html.= '<li><a href="javascript:;" title="价格：'.$vv[price].'火币/个" giftName="'.$vv[name].'" giftTypeid="'.$vv[typeid].'" giftId="'.$vv[giftid].'"><img src="static2/images/gift/'.$vv['image'].'" width="48" height="48" />'.$vv[name].'</a></li>';
				}
				$html.= '</ul></div>';
			}
			
			echo json_encode(array('status'=>1,'data'=>$html));	
			die();
									
			
		}else{
			echo '{"status":"0","data":"'.$period['limitLeftTime'].'"}';
			die();
		}		
	}
}
	
?>
