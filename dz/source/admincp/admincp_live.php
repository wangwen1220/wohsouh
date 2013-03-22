<?php

/**
 * zhangchengjun
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$op = empty($_G['gp_op']) ? 'index' : $_G['gp_op'];
$ops = array('index', 'attribute', 'pw', 'livelog', 'notice', 'violation', 'violationlog', 'close', 'addstar', 'cancelstar', 'addagent', 'agent', 'cancelagent', 'yugao','audience','details', 'admin');
if (!in_array($op, $ops)) {
	$op = 'index';
}

//做自动解除操作
cCheckViolation();

if ($op == 'index') {#索引页
	//按时间段搜索
	if ($_GET['act'] == 'livett') {
		cpheader();
		echo '<div class="itemtitle"><h3>直播管理</h3>
		<ul class="tab1">
			<li class="current"><a href="admin.php?action=live"><span>火秀明星管理</span></a></li>
			<li><a href="admin.php?action=live&op=addstar"><span>增加火秀明星</span></a></li>
			<li><a href="admin.php?action=live&op=addagent"><span>增加火秀经纪人</span></a></li>
			<li><a href="admin.php?action=live&op=agent"><span>火秀经纪人管理</span></a></li>
			<li><a href="admin.php?action=live&op=yugao"><span>直播预告</span></a></li>
			<li><a href="admin.php?action=live&op=audience"><span>观众统计</span></a></li>
			<li><a href="admin.php?action=live&op=admin"><span>巡管</span></a></li>
		</ul></div>';
		?>
			<script src="static/js/calendar.js" type="text/javascript"></script>
			<form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=live&act=livett" method="post">
				<table class="tb tb2 ">
					<tr>
						<td width="40%">时间段：
							<input type="text"  size=15 name="duidate1" onclick="showcalendar(event, this)" value="<? if ($startTime){echo date('Y-m-d',$startTime);}?>"/>-
	        				<input type="text" name="duidate2" size=15 onclick="showcalendar(event, this)" value="<?if ($startTime1){echo date('Y-m-d',$startTime1);}?>"/>
						</td>
						<td width="60%"><input class="btn" type="submit" name="submit" value="搜索" /></td>
					</tr>
				</table>
			</form>
		<?
		$startTime = empty($_G['gp_duidate1']) ? '' : $_G['gp_duidate1'];
		$startTime1 = empty($_G['gp_duidate2']) ? '' : $_G['gp_duidate2'];
		$condition='';
		$summary='';	
		if (!empty($startTime)) {
			$tmp = strtotime($startTime);
			$condition .= " AND start_time>=$tmp";
		}
		if (!empty($startTime1)) {
			$tmp = strtotime($startTime1.' 23:59:59');
			$condition .= " AND end_time<=$tmp";
		}
		
		showtableheader();
		$_G['setting']['memberperpage'] = 20;
		$page = max(1, $_G['page']);
		$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	 	$search_condition = array_merge($_GET, $_POST);
	    foreach($search_condition as $k => $v) {
	    	if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
	      		unset($search_condition[$k]);
	      	}
	    }
	    $duixian_rs = array();
	    $sql = "SELECT COUNT(*) AS count FROM ".DB::table('live_room_log')." WHERE 1 ".$condition."";
	   	//echo $sql;
		$order_rs_count=DB::result_first($sql);
		if($order_rs_count > 0) {
			showsubtitle(array('用户名', '直播时长', '人数', '收益'));
			$multi = multi($order_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=live&act=livett&submit=yes".$act);
			$sql = "SELECT * FROM ".DB::table('live_room_log')." WHERE 1 ".$condition." ORDER BY end_time desc
					 LIMIT $start_limit, {$_G[setting][memberperpage]}";
			//echo $sql;
			$query = DB::query($sql);
	    	while($duixian_rs = DB::fetch($query)) {			
				showtablerow('', array('', ''), array(
				$duixian_rs['username'],
				cTotalTimeShow($duixian_rs['totaltime']),
				$duixian_rs['max_members'],
				$duixian_rs['income']
				));	
			}
			showsubmit('', '', '', '', $multi);
			showtablefooter();
		}
		
	}else {
	cpheader();
	shownav('extended', 'menu_live');
	//搜索条件
	$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);
	$uid = !empty($_G['gp_uid']) ? intval($_G['gp_uid']) : '';
	$username = isset($_G['gp_username']) ? $_G['gp_username'] : '';
	$roomid = !empty($_G['gp_roomid']) ? intval($_G['gp_roomid']) : '';
	$status = isset($_G['gp_status']) ? $_G['gp_status'] : '';
	$charmlevel1 = !empty($_G['gp_charmlevel1']) ? intval($_G['gp_charmlevel1']) : '';
	$charmlevel2 = !empty($_G['gp_charmlevel2']) ? intval($_G['gp_charmlevel2']) : '';
	$huoshowlevel1 = !empty($_G['gp_huoshowlevel1']) ? intval($_G['gp_huoshowlevel1']) : '';
	$huoshowlevel2 = !empty($_G['gp_huoshowlevel2']) ? intval($_G['gp_huoshowlevel2']) : '';
	$status_1 = $status_2 = $status_0 = $status__1 = 0;
	if (is_string($status) && !empty($status)) {
		$status = explode(',', $status);
	}
	if (is_array($status)) {
		$status_str = implode(',', $status);
		in_array('1', $status) && $status_1 =1;
		in_array('2', $status) && $status_2 =1;
		in_array('0', $status) && $status_0 =1;
		in_array('-1', $status) && $status__1 =1;
	}
	
	
	//if (isset($_G['gp_submit'])) {
		require_once libfile('function/live');
		$tpp = 50;
		$limit_start = ($page - 1) * $tpp;
		$addurl = '';
		
		//生成SQL
		$addCondition = '';
		if ($uid) {#uid
			$addCondition .= " AND r.uid=$uid";
			$addurl .= "&uid=$uid";
		}
		if (!empty($username)) {#用户名
			$addCondition .= " AND r.username='$username'";
			$addurl .= "&username=$username";
		}
		if ($roomid) {#房间号
			$addCondition .= " AND r.roomid=$roomid";
			$addurl .= "&roomid=$roomid";
		}
		if (is_array($status)) {#主播状态
			$addCondition .= " AND r.stat IN($status_str)";
			$addurl .= "&status=$status_str";
		}
		if ($charmlevel1 || $charmlevel2) {#直播等级
			//主播等级的魅力值配置
			if (!empty($_G['setting']['level']['charm'])) {
				$levelInfo = $_G['setting']['level']['charm'];
			} else {
				$query = DB::query("SELECT * FROM ".DB::table('live_level_config')." WHERE type=2 ORDER BY level ASC");
				while ($rs = DB::fetch($query)) {
					$levelInfo[] = $rs;
				}
				$_G['setting']['level']['charm'] = $levelInfo;
			}
			
			$uidCondition_charm = "";
			if ($charmlevel1) {
				$startCharm = $levelInfo[$charmlevel1 - 1]['valuelower'];
				$uidCondition_charm .= " AND charm>=$startCharm";
				$addurl .= "&charmlevel1=$charmLevel1";
			}
			if ($charmlevel2) {
				$endCharm = $levelInfo[$charmlevel2 - 1]['valuehigher'];
				$uidCondition_charm .= " AND charm<=$endCharm";
				$addurl .= "&charmlevel2=$charmLevel2";
			}
			$addCondition .= " AND r.uid IN(SELECT uid FROM ".DB::table('live_member_count')." WHERE 1$uidCondition_charm)";
		}
		if ($huoshowlevel1 || $huoshowlevel2) {#财富等级
			//财富等级配置
			if (!empty($_G['setting']['level']['huoshow'])) {
				$levelInfo = $_G['setting']['level']['huoshow'];
			} else {
				$query = DB::query("SELECT * FROM ".DB::table('live_level_config')." WHERE type=1 ORDER BY level ASC");
				while ($rs = DB::fetch($query)) {
					$levelInfo[] = $rs;
				}
				$_G['setting']['level']['huoshow'] = $levelInfo;
			}
			
			$uidCondition_huoshow = "";
			if ($huoshowlevel1) {
				$startHuoshow = $levelInfo[$huoshowlevel1 - 1]['valuelower'];
				$uidCondition_huoshow .= " AND showcoin>=$startHuoshow";
				$addurl .= "&huoshowLevel1=$huoshowLevel1";
			}
			if ($huoshowlevel2) {
				$endHuoshow = $levelInfo[$huoshowlevel2 - 1]['valuehigher'];
				$uidCondition_huoshow .= " AND showcoin<=$endHuoshow";
				$addurl .= "&huoshowLevel2=$huoshowLevel2";
			}
			$addCondition .= " AND r.uid IN(SELECT uid FROM ".DB::table('ucenter_showcoin')." WHERE 1$uidCondition_huoshow)";
		}
		
		$addCondition .= " AND r.uid IN(SELECT uid FROM ".DB::table('live_member_count')." WHERE level=2)";
		$count = DB::result_first("SELECT COUNT(r.uid) FROM ".DB::table('live_room')." r 
			LEFT JOIN ".DB::table('live_room_config')." rc ON r.uid=rc.uid 
			LEFT JOIN ".DB::table('live_member_count')." c ON r.uid=c.uid 
			LEFT JOIN ".DB::table('ucenter_showcoin')." s ON r.uid=s.uid 
			WHERE 1$addCondition");
		$query = DB::query("SELECT r.*,rc.pass,rc.password,c.charm,s.showcoin FROM ".DB::table('live_room')." r 
			LEFT JOIN ".DB::table('live_room_config')." rc ON r.uid=rc.uid 
			LEFT JOIN ".DB::table('live_member_count')." c ON r.uid=c.uid 
			LEFT JOIN ".DB::table('ucenter_showcoin')." s ON r.uid=s.uid 
			WHERE 1$addCondition 
			LIMIT $limit_start,$tpp");
		while ($rs = DB::fetch($query)) {
			
			switch ($rs['stat']) {
				case -1: $rs['status_str'] = '违规暂停';break;
				case 0: $rs['status_str'] = '停止直播';break;
				case 1: $rs['status_str'] = '正在直播';break;
				case 2: $rs['status_str'] = '暂停直播';break;
			}
			
			$charmLevel = cGetCharmLevel($rs['charm']);
			$huoshowLevel = cGetHuoshowLevel($rs['showcoin']);
			$rs['level_charm'] = $charmLevel['level'];
			$rs['level_huoshow'] = $huoshowLevel['level'];
			
			$rs['totaltime_str'] = cTotalTimeShow($rs['totaltime']);
			$rs['dateline_str'] = date('Y-m-d H:i', $rs['dateline']);
			
			$list[] = $rs;
		}
		
		$multi = multi($count, $tpp, $page, ADMINSCRIPT."?action=live&submit=yes$addurl");
	//}
	include_once(template('admincp/admincp_live'));
	}
} elseif ($op == 'attribute' || $op == 'pw') {#房间属性
	cpheader();
	shownav('extended', 'menu_live');
	
	$uid = empty($_G['gp_uid']) ? 0 : intval($_G['gp_uid']);
	if ($uid) {
		
		if (isset($_G['gp_submit']) && $op == 'attribute') {
			$data = array(
				'roomtitle'=>$_G['gp_title'],
				'titlecolor'=>$_G['gp_titlecolor'],
				'roominfo'=>$_G['gp_content'],
				'roominfocolor'=>$_G['gp_contentcolor'],
				'img'=>$_G['gp_img'],
				'starts'=>$_G['gp_starts']
			);
			DB::update('live_room_config', $data, "uid=$uid");
			cpmsg('update_succeed', "admin.php?frames=yes&action=live&op=attribute&uid=$uid", 'succeed');
		} else {
			$roomAttribute = DB::fetch_first("SELECT c.*,r.username 
			FROM ".DB::table('live_room_config')." c
			LEFT JOIN ".DB::table('live_room')." r ON c.uid=r.uid  
			WHERE c.uid=$uid");
			if (!empty($roomAttribute)) {
				include_once(template('admincp/admincp_live_attribute'));
			} else {
				die('房间信息不存在');
			}
		}
		
	} else {
		die('参数错误');
	}
	
}elseif ($op == 'livetime1'){
	
}elseif ($op == 'livelog') {

	cpheader();
	shownav('extended', 'menu_live');
	
	$uid = empty($_G['gp_uid']) ? 0 : intval($_G['gp_uid']);
	if ($uid) {
		
		//主播用户名
		$username = DB::result_first("SELECT username FROM ".DB::table('common_member')." WHERE uid=$uid");
		
		$timestart = empty($_G['gp_timestart']) ? '' : $_G['gp_timestart'];
		$timeend = empty($_G['gp_timeend']) ? '' : $_G['gp_timeend'];
		
		$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);
		$tpp = 20;
		$limit_start = ($page - 1) * $tpp;
		
		$addCondition = '';
		$addurl = '';
		if (!empty($timestart)) {
			$tmp = strtotime($timestart);
			$addCondition .= " AND start_time>=$tmp";
			$addurl .= "&timestart=$timestart";
		}
		if (!empty($timeend)) {
			$tmp = strtotime($timeend.' 23:59:59');
			$addCondition .= " AND end_time<=$tmp";
			$addurl .= "&timeend=$timeend";
		}
		
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_room_log')." WHERE uid=$uid$addCondition");
		$query = DB::query("SELECT * FROM ".DB::table('live_room_log')." WHERE uid=$uid$addCondition ORDER BY start_time DESC LIMIT $limit_start,$tpp");
		while ($rs = DB::fetch($query)) {
			$rs['start_time_str'] = empty($rs['start_time']) ? 0 : date('Y-m-d H:i', $rs['start_time']);
			$rs['end_time_str'] = empty($rs['end_time']) ? 0 : date('Y-m-d H:i', $rs['end_time']);			
			$rs['totaltime_str'] = cTotalTimeShow($rs['totaltime']);
			$list[] = $rs;			
		}
		
		//总历时,总收益
		$tmp = DB::fetch_first("SELECT SUM(totaltime) AS totalTime,SUM(income) AS totalHuoshow FROM ".DB::table('live_room_log')." WHERE uid=$uid$addCondition");
		$totalTime = empty($tmp['totalTime']) ? 0 : $tmp['totalTime'];
		$totalHuoshow = empty($tmp['totalHuoshow']) ? 0 : $tmp['totalHuoshow'];
		$totalTime_str = cTotalTimeShow($totalTime);
		
		$multi = multi($count, $tpp, $page, ADMINSCRIPT."?action=live&op=livelog&uid=$uid$addurl");
		include_once(template('admincp/admincp_live_livelog'));
		
	} else {
		die('参数错误');
	}
	
} elseif ($op == 'notice') {
	
	$tabs = array('index', 'audit', 'recommand');
	$tab = isset($_G['gp_tab']) ? $_G['gp_tab'] : 'index';
	if (!in_array($tab, $tabs)) {
		$tab = 'index';
	}

	if ($tab == 'index') {
		echo <<<EOT
<script src="static2/js/jquery.min.js" type="text/javascript"></script>
EOT;
		cpheader();
		shownav('extended', 'menu_live');
		$uid = empty($_G['gp_uid']) ? 0 : intval($_G['gp_uid']);
		if ($uid) {
			
			//主播用户名
			$username = DB::result_first("SELECT username FROM ".DB::table('common_member')." WHERE uid=$uid");
			
			$auditstatus = isset($_G['gp_auditstatus']) ? $_G['gp_auditstatus'] : 'all';
			$recommand = isset($_G['gp_recommand']) ? $_G['gp_recommand'] : 'all';
			
			$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);
			$tpp = 20;
			$limit_start = ($page - 1) * $tpp;
			
			//搜索条件
			$addCondition = $addurl = '';
			if ($auditstatus != 'all') {
				$addCondition .= " AND auditstatus=$auditstatus";
				$addurl .= "&auditstatus=$auditstatus";
			}
			if ($recommand != 'all') {
				$addCondition .= " AND recommand=$recommand";
				$addurl .= "&recommand=$recommand";
			}
			
			$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_notice')." WHERE uid=$uid$addCondition");
			$query = DB::query("SELECT * FROM ".DB::table('live_notice')." WHERE uid=$uid$addCondition LIMIT $limit_start, $tpp");
			while ($rs = DB::fetch($query)) {
				$rs['start_time_str'] = date('Y-m-d H:i', $rs['start_time']);
				$rs['end_time_str'] = date('Y-m-d H:i', $rs['end_time']);
				$list[] = $rs;
			}
			
			$multi = multi($count, $tpp, $page, ADMINSCRIPT."?action=live&op=notice&uid=$uid$addurl");
			include_once(template('admincp/admincp_live_notice'));
		} else {
			die('参数错误');
		}
	} elseif ($tab == 'audit') {
		$id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
		if ($id) {
			DB::update("live_notice", array('auditstatus'=>1), "id=$id");
			echo 1;
		}
		die;
	} elseif ($tab == 'recommand') {
		$id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
		$v = isset($_G['gp_v']) ? intval($_G['gp_v']) : '';
		if ($id && is_numeric($v)) {
			DB::update("live_notice", array('recommand'=>$v), "id=$id");
			$back = ($v == 1) ? 1 : 2;
			echo $back;
		}
		die;
	}
	
} elseif ($op == 'violation') {#违规
	cpheader();
	shownav('extended', 'menu_live');
	$uid = empty($_G['gp_uid']) ? 0 : intval($_G['gp_uid']);
	if ($uid) {
		if (isset($_G['gp_submit'])) {			
			$tabs = array('index', 'cancel');
			$tab = empty($_G['gp_tab']) ? 'index' : $_G['gp_tab'];
			
			if ($tab == 'index') {
				$reason = $_G['gp_reason'];
				$hours = intval($_G['gp_hours']);
				$startTime = time();
				$endTime = $startTime + ($hours*60*60);
				$removetype = empty($_G['gp_removetype']) ? 3 : intval($_G['gp_removetype']);
				
				$roomInfo = DB::fetch_first("SELECT * FROM ".DB::table('live_room')." WHERE uid=$uid AND stat>=0");
				if (!empty($roomInfo)) {
					$msg = "本房间违规，被管理员暂停使用 $hours 小时";
					
					//发消息到消息服务器
					$writeData='{"mode":"manage","roomid":"'.$roomInfo['roomid'].'","usertype":"1","uid":"1","username":"admin","action":"msgKick","actionto":"all","stoptime":"3","msg":"'.$msg.'"}';
					$dataMsg = getMsgLenStr(";115;$writeData", 4).";115;$writeData";
					$back = socketData(API_SOCKET_HOST, MSN_PORT, $dataMsg);

					$backArr = json_decode($back, true);
					if ($backArr['state'] == 1) {
					//if (1) {
						$data = array(
							'uid'=>$uid,
							'username'=>$roomInfo['username'],
							'reason'=>$reason,
							'start_time'=>$startTime,
							'end_time'=>$endTime,
							'totaltime'=>($endTime-$startTime),
							'removetype'=>$removetype,
							'status'=>1,
							'opuid'=>$_G['uid']
						);
						DB::insert('live_violation', $data, true);
						DB::update('live_room', array('stat'=>-1), "uid=$uid");
						cpmsg('operate_succeed', "admin.php?frames=yes&action=live&op=violationlog&uid=$uid", 'succeed');
					} else {
						die('消息服务器返回违规处理不成功。err:'.$backArr['state']);
					}
				} else {
					die('参数错误');
				}
			} elseif ($tab == 'cancel') {#取消违规
				$violationlog = DB::fetch_first("SELECT * FROM ".DB::table('live_violation')." WHERE uid=$uid AND status=1 ORDER BY start_time DESC LIMIT 1");
				if (!empty($violationlog)) {
					DB::update('live_violation', array('status'=>0), "id=".$violationlog['id']);
				}
				DB::update('live_room', array('stat'=>0), "uid=$uid");
				cpmsg('operate_succeed', "admin.php?frames=yes&action=live&op=close", 'succeed');
			}
		} else {
			$roomInfo = DB::fetch_first("SELECT * FROM ".DB::table('live_room')." WHERE uid=$uid");
			if (!empty($roomInfo)) {
				
				if ($roomInfo['stat'] == -1) {
					$violationlog = DB::fetch_first("SELECT * FROM ".DB::table('live_violation')." WHERE uid=$uid AND status=1 ORDER BY start_time DESC LIMIT 1");
					$violationlog['start_time_str'] = date('Y-m-d H:i', $violationlog['start_time']);
				}
				
				//主播用户名
				$username = $roomInfo['username'];
				include_once(template('admincp/admincp_live_violation'));
			} else {
				die('参数错误');
			}
		}
	} else {
		die('参数错误');
	}
	
} elseif ($op == 'violationlog') {#违规记录
	cpheader();
	shownav('extended', 'menu_live');
	$uid = empty($_G['gp_uid']) ? 0 : intval($_G['gp_uid']);
	if ($uid) {
		
		//主播用户名
		$username = DB::result_first("SELECT username FROM ".DB::table('common_member')." WHERE uid=$uid");

		$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);
		$tpp = 20;
		$limit_start = ($page - 1) * $tpp;

		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_violation')." WHERE uid=$uid");
		$query = DB::query("SELECT * FROM ".DB::table('live_violation')." WHERE uid=$uid ORDER BY id DESC LIMIT $limit_start,$tpp");
		while ($rs = DB::fetch($query)) {
			$rs['start_time_str'] = date('Y-m-d H:i', $rs['start_time']);
			$rs['end_time_str'] = date('Y-m-d H:i', $rs['end_time']);
			$rs['hours'] = floor($rs['totaltime']/(60*60));
			$rs['removetype_str'] = ($rs['removetype']==2) ? '手动解除' : '自动解除'; 
			$list[] = $rs;
		}
		
		$multi = multi($count, $tpp, $page, ADMINSCRIPT."?action=live&op=violationlog&uid=$uid");
		include_once(template('admincp/admincp_live_violationlog'));
	} else {
		die('参数错误');
	}
	
} elseif ($op == 'close') {
		echo <<<EOT
<script type="text/javascript">window.top.opener = null;window.top.close();</script>
EOT;
} elseif ($op == 'addstar') {
	cpheader();
	shownav('extended', 'menu_live');
	if (isset($_G['gp_submit'])) {
		
		if (is_numeric($_G['gp_username'])) {
			$uid = intval($username);
			$addUrl = "&uid=$uid";
			$userInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE uid=$uid");
		} else {
			$username = $_G['gp_username'];
			$addUrl = "&username=$username";
			$userInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE username='$username'");
		}
		
		if (!empty($userInfo)) {
			$uid = $userInfo['uid'];
			$username = $userInfo['username'];
			
			$room = DB::fetch_first("SELECT * FROM ".DB::table('live_room')." WHERE uid=$uid");
			$roomConfig = DB::fetch_first("SELECT * FROM ".DB::table('live_room_config')." WHERE uid=$uid");
			$livMemberCount = DB::fetch_first("SELECT * FROM ".DB::table('live_member_count')." WHERE uid=$uid");
			
			//live_room
			if (empty($room)) {
				DB::insert('live_room', array('roomid'=>$uid,'uid'=>$uid,'username'=>$username,'dateline'=>time()));
			}
			//live_room_config
			if (empty($roomConfig)) {
				DB::insert('live_room_config', array('uid'=>$uid,'roomtitle'=>$username));
			}
			//live_member_count
			if (empty($livMemberCount)) {
			DB::insert('live_member_count',array('uid'=>$uid,'username'=>$username,'level'=>2,'contribution'=>0,'charm'=>0));
			} else {
				DB::update('live_member_count', array('level'=>2), "uid=$uid");
			}
			$dstroomid = (string)$uid;
			$data = array(
				'act'=>'3',
				'dstroomid'=>$dstroomid
			);
			$cmd_body = '020'.json_encode($data);
			socketSendData(LOCAL_HOST, LOCAL_PORT, encodeCommand($cmd_body, 6));
			cpmsg('operate_succeed', "admin.php?frames=yes&action=live&submit=yes$addUrl", 'succeed');
		} else {
			cpmsg('user_noexists', "admin.php?frames=yes&action=live&op=addstar", 'error');
		}
	} else {
		include_once(template('admincp/admincp_live_addstar'));
	}
	
} elseif ($op == 'cancelstar') {//取消火秀明星
	cpheader();
	shownav('extended', 'menu_live');
	
	$uid = empty($_G['gp_uid']) ? 0 : intval($_G['gp_uid']);
	if ($uid) {
		DB::update('live_member_count', array('level'=>1), array('uid'=>$uid));
		$dstroomid = (string)$uid;
		$data = array(
			'act'=>'3',
			'dstroomid'=>$dstroomid
		);
		$cmd_body = '020'.json_encode($data);
		socketSendData(LOCAL_HOST, LOCAL_PORT, encodeCommand($cmd_body, 6));
		cpmsg('operate_succeed', 'admin.php?frames=yes&action=live', 'succeed');
	} else {
		cpmsg('operate_succeed', 'admin.php?frames=yes&action=live', 'error');
	}

} elseif ($op == 'addagent') {//增加火秀经纪人
	cpheader();
	shownav('extended', 'menu_live');
	if (isset($_G['gp_submit'])) {
		
		if (is_numeric($_G['gp_username'])) {
			$uid = intval($username);
			$userInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE uid=$uid");
		} else {
			$username = $_G['gp_username'];
			$userInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE username='$username'");
		}
		
		if (!empty($userInfo)) {
			$uid = $userInfo['uid'];
			$username = $userInfo['username'];
			
			$livMemberCount = DB::fetch_first("SELECT * FROM ".DB::table('live_member_count')." WHERE uid=$uid");
			
			//live_member_count
			if (empty($livMemberCount)) {
				DB::insert('live_member_count', array('uid'=>$uid,'username'=>$username,'level'=>1,'contribution'=>0,'charm'=>0,'isagent'=>1));
			} else {
				DB::update('live_member_count', array('isagent'=>1), "uid=$uid");
			}
			
			cpmsg('operate_succeed', "admin.php?frames=yes&action=live&op=agent&username=$username&submit=yes", 'succeed');
		} else {
			cpmsg('user_noexists', "admin.php?frames=yes&action=live&op=addagent", 'error');
		}
	} else {
		include_once(template('admincp/admincp_live_addagent'));
	}

} elseif ($op == 'cancelagent') {
	cpheader();
	shownav('extended', 'menu_live');
	
	$uid = empty($_G['gp_uid']) ? 0 : intval($_G['gp_uid']);
	if ($uid) {
		DB::update('live_member_count', array('isagent'=>0), array('uid'=>$uid));
		cpmsg('operate_succeed', 'admin.php?frames=yes&action=live&op=agent', 'succeed');
	} else {
		cpmsg('operate_succeed', 'admin.php?frames=yes&action=live&op=agent', 'error');
	}
	
} elseif ($op == 'agent') {//火秀经纪人
	cpheader();
	shownav('extended', 'menu_live');
	
	$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);
	$tpp = 20;
	$limit_start = ($page - 1) * $tpp;
	
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_member_count')." WHERE isagent=1");
	$query = DB::query("SELECT * FROM ".DB::table('live_member_count')." WHERE isagent=1 LIMIT $limit_start, $tpp");
	while ($rs = DB::fetch($query)) {
		$rs['stars_str'] = '';
		$agentId = $rs['uid'];
		$queryStar = DB::query("SELECT uid,username FROM ".DB::table('live_artists')." WHERE agent=$agentId");
		while ($tmp = DB::fetch($queryStar)) {
			$rs['stars_str'] .= '<a href="admin.php?frames=yes&action=live&username='.$tmp['username'].'&submit=yes" target="_blank">'.$tmp['username'].'</a>,';
		}
		$rs['stars_str'] = rtrim($rs['stars_str'], ',');
		$list[] = $rs;
	}
	$multi = multi($count, $tpp, $page, ADMINSCRIPT."?action=live&op=agent&page=$page");
	
	include_once(template('admincp/admincp_live_agent'));


}elseif ($op == 'admin') {//巡管
	cpheader();
	shownav('extended', 'menu_live');
	$act = isset($_G['gp_act']) ? $_G['gp_act'] : '';
	if ($act == 'add') {
		if (is_numeric($_G['gp_username'])) {
			$uid = intval($username);
			$userInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE uid=$uid");
		} else {
			$username = $_G['gp_username'];
			$userInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE username='$username'");
		}
		
		if (!empty($userInfo)) {
			$uid = $userInfo['uid'];
			$username = $userInfo['username'];
			
			$existed = DB::result_first("SELECT COUNT(*) FROM pre_live_admin WHERE uid=$uid");
			if (!$existed) {
				$data = array(
					'uid'=>$uid,
					'username'=>$username,
					'dateline'=>time()
				);
				DB::insert("live_admin", $data);
				cpmsg('添加成功', "admin.php?frames=yes&action=live&op=admin", 'succeed');
			} else {
				cpmsg('该用户已经是巡管', "admin.php?frames=yes&action=live&op=admin", 'error');
			}
		} else {
			cpmsg('用户不存在', "admin.php?frames=yes&action=live&op=admin", 'error');
		}
	} elseif ($act == 'del') {
		$uid = intval($_G['gp_uid']);
		if ($uid) {
			DB::delete("live_admin", "uid=$uid");
			cpmsg('删除成功', "admin.php?frames=yes&action=live&op=admin", 'succeed');
		}
	} else {
		$query = DB::query("SELECT * FROM pre_live_admin ORDER BY dateline ASC");
		while ($rs = DB::fetch($query)) {
			$list[] = $rs;
		}
		
		include_once(template('admincp/admincp_live_admin'));
	}
	
}elseif ($op == 'audience') {//观众统计
	
	$uid = !empty($_G['gp_uid']) ? intval($_G['gp_uid']) : '';
	$username = isset($_G['gp_username']) ? $_G['gp_username'] : '';
	
	$condition='';
	if ($uid) {
		$condition .= " AND uid=$uid";
	}
	if (!empty($username)) {
		$condition = $condition."AND username like '%$username%' ";
	}

	cpheader();
	shownav('extended', 'menu_live');
	$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);
	$tpp = 20;
	$limit = ($page - 1) * $tpp;
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_member_count')." where 1 $condition");
	$query = DB::query("SELECT * FROM ".DB::table('live_member_count')." where 1 $condition order by watch_totaltime desc LIMIT $limit, $tpp");
	$i = 0;
	while ($res = DB::fetch($query)){
		$audience[$i] = $res;
		$sql = " select * from ".DB::table('live_user_log')." where uid = ".$res['uid']." order by logout_time desc" ;
		$bb = DB::fetch_first($sql);
		$audience[$i][login_time] = $bb;
		$audience[$i][logout_time] = $bb;
		$i++;
	}
	$multi = multi($count, $tpp, $page, ADMINSCRIPT."?action=live&op=audience&page=$page");
	
	include_once(template('admincp/admincp_live_audience'));
	
} elseif ($op == 'details'){
	//详细
	cpheader();
	shownav('extended', 'menu_live');
	$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);
	$tpp = 20;
	$limit = ($page - 1) * $tpp;
	$uid = $_GET['uid'];
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_user_log')." where uid=$uid ");
	$query = DB::query("SELECT * FROM ".DB::table('live_user_log')." where uid=$uid order by logout_time desc LIMIT $limit, $tpp");
//	$query = DB::query($sql);
	while ($rs = DB::fetch($query)) {
		$rs['login_time'] = date("Y-m-d H:i:s",$rs['login_time']);
		$rs ['logout_time'] = date("Y-m-d H:i:s",$rs['logout_time']);
		$details[] = $rs;
	}
	$multi = multi($count, $tpp, $page, ADMINSCRIPT."?action=live&op=details&uid=$uid&page=$page");
	include_once(template('admincp/admincp_live_details'));
	
} elseif ($op=='yugao'){
	if ($_GET['a']=='shenhe'){
		if ($_GET['id']){
			$sql = "UPDATE ".DB::table('live_notice')." SET auditstatus = 1 WHERE id = ".$_GET['id'];
			DB::query($sql);
		}
	}
	if ($_GET['a']=='tuijian'){
		if ($_GET['id']){
			$sql = "UPDATE ".DB::table('live_notice')." SET recommand = 1 WHERE id = ".$_GET['id'];
			DB::query($sql);
		}
	}
	if ($_GET['a']=='quxiaotuijian'){
		if ($_GET['id']){
			$sql = "UPDATE ".DB::table('live_notice')." SET recommand = 0 WHERE id = ".$_GET['id'];
			DB::query($sql);
		}
	}
	if ($_GET['a']=='delete'){
		if ($_GET['id']){
			$sql = "DELETE FROM   ".DB::table('live_notice')." WHERE id = ".$_GET['id'];
			DB::query($sql);
		}
	}
	if ($_GET['a']=='bianji'){
		cpheader();
		if ($_POST){
			$start_time=strtotime($_POST['stime'].":00");
			$end_time=strtotime($_POST['etime'].":00");
			$content=$_POST['content'];
			if ($_GET['id']){
				$data=array('start_time'=>$start_time,'end_time'=>$end_time,'content'=>$content ); 
				DB::update('live_notice',$data,' id='.$_GET['id']);
			}
			echo '<meta http-equiv="refresh" content="2;url=admin.php?action=live&op=yugao">';
			echo '<a href="/admin.php?action=live&op=yugao"><< 返回预告列表</a><br><br>';
		
			echo '<span style="color:green">保存成功</span>';
			return;
		}
		echo '<script src="static/js/calendar.js" type="text/javascript"></script>';
		shownav('extended', 'menu_live');
		echo '<div class="itemtitle"><h3>直播管理</h3>
<ul class="tab1">
<li ><a href="admin.php?action=live"><span>火秀明星管理</span></a></li>
<li><a href="admin.php?action=live&op=addstar"><span>增加火秀明星</span></a></li>
<li><a href="admin.php?action=live&op=addagent"><span>增加火秀经纪人</span></a></li>
<li><a href="admin.php?action=live&op=agent"><span>火秀经纪人管理</span></a></li>
<li class="current"><a href="admin.php?action=live&op=yugao"><span>直播预告</span></a></li>
<li><a href="admin.php?action=live&op=audience"><span>观众统计</span></a></li>
</ul></div>';
		if (!empty($_GET['id'])){
			$id = $_GET['id'];
			$sql = "SELECT * FROM ".DB::table('live_notice')." WHERE id=$id";
			$info = DB::fetch_first($sql);
		}
		shownav('extended', 'memu_activity');
		echo '<a href="/admin.php?action=live&op=yugao"><< 返回预告列表</a><br><br>';
		showformheader("live&op=yugao&a=bianji&id=$id");
		?>		
		UID<br>
		<input name="name" id="name" class="txt" style="width:250px;"  value="<?php echo $info['uid'];?>" disabled="disabled"><br><br>
		用户名<br>
		<input name="intro" id="intro"  class="txt" style="width:250px;" value = "<?php echo $info['username'];?>"  disabled="disabled"><br><br>
		
		时间范围<br>
		<input name="stime" id="stime" class="txt" style="width:115px" onclick="showcalendar(event, this,true)" onfocus="showcalendar(event, this,true)"
			 value="<?php if ($info['start_time']) echo date("Y-m-d H:i",$info['start_time']);?>"
		style="width:260px;" >~
		<input name="etime" id="etime"  class="txt"  style="width:115px;" onclick="showcalendar(event, this,true)"  onfocus="showcalendar(event, this,true)" 
			 value="<?php if ($info['end_time']) echo date("Y-m-d H:i",$info['end_time']);?>"
		style="width:260px;" >
		
		<br><br>
		内容<br>
		<textarea name="content" id="content" rows="6" cols="5" class="tarea" style="width:250px;"><?php echo $info['content'];?></textarea><br><br>
		<?php 
		showsubmit('submit', '提交', '', '','');
		showformfooter();
		return;
	}
	cpheader();
	shownav('extended', 'menu_live');
	$_G['setting']['memberperpage'] = 50;
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'op', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	$condition='';
	if ($search_condition['uid']){
		$suid = $search_condition['uid'];
		$condition = $condition." AND uid = $suid ";
	}
	
	if ($search_condition['username']){
		$susername = $search_condition['username'];
		$condition = $condition." AND username = '$susername' ";
	}
	
	if ($search_condition['auditstatus']!='all' and $search_condition['auditstatus']!=''){
		$sauditstatus = $search_condition['auditstatus'];
		$condition = $condition." AND auditstatus = '$sauditstatus' ";
		if ($sauditstatus==0){
			$sauditstatusName='待审核';
		}else{
			$sauditstatusName='审核通过';
		}
		
	}
	
	if ($search_condition['recommand']!='all' and $search_condition['recommand']!=''){
		$srecommand = $search_condition['recommand'];
		$condition = $condition." AND recommand = '$srecommand' ";
		if ($srecommand==0){
			$srecommandName='未推荐';
		}else{
			$srecommandName='推荐';
		}
	}
	$sql = "SELECT COUNT(*) AS count FROM ".DB::table('live_notice')." a WHERE 1 ".$condition;
	//echo $sql;
	$counts=DB::result_first($sql);
	if($counts > 0) {
		$multipage = multi($counts, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=live&op=yugao&submit=yes&uid=$suid&username=$susername&auditstatus=$sauditstatus&recommand=$srecommand");
		$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
		$sql = "SELECT * FROM ".DB::table('live_notice')." WHERE 1  ".$condition."ORDER BY id DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
			
		$query = DB::query($sql);
	}
	echo '<div class="itemtitle"><h3>直播管理</h3>
<ul class="tab1">
<li ><a href="admin.php?action=live"><span>火秀明星管理</span></a></li>
<li><a href="admin.php?action=live&op=addstar"><span>增加火秀明星</span></a></li>
<li><a href="admin.php?action=live&op=addagent"><span>增加火秀经纪人</span></a></li>
<li><a href="admin.php?action=live&op=agent"><span>火秀经纪人管理</span></a></li>
<li class="current"><a href="admin.php?action=live&op=yugao"><span>直播预告</span></a></li>
<li><a href="admin.php?action=live&op=audience"><span>观众统计</span></a></li>
<li><a href="admin.php?action=live&op=admin"><span>巡管</span></a></li>
</ul></div>';
	showformheader("live&op=yugao");
	$forms= '
	用户名<input name="username" id="username" class="txt" style="width:100px;" value="'.$susername.'"> 
	UID<input name="uid" id="uid" class="txt" style="width:100px;" value="'.$suid.'">
	<select name="auditstatus">';
	if($sauditstatusName){
		$forms=$forms.'<option value="'.$sauditstatus.'">'.$sauditstatusName.'</option>';
	}
	$forms=$forms.'<option value="all">全部状态</option>
	<option value="0">待审核</option>
	<option value="1">审核通过</option>
	</select>
	<select name="recommand">';
	if($srecommandName){
		$forms=$forms.'<option value="'.$srecommand.'">'.$srecommandName.'</option>';
	}
	$forms=$forms.'<option value="all">是否推荐</option>
	<option value="0">未推荐</option>
	<option value="1">推荐</option>
	</select>
	<input type="submit" class="btn" value="提交">
	';
	echo $forms;
	showformfooter();
	showtableheader();
	
	showsubtitle(array('用户', '直播时间','内容','状态','推荐','操作'));
	if($counts > 0) {
		
		
		while ($res = DB::fetch($query)){
			if ($res['auditstatus']==1){
				$res['statusname']='<span style="color:green">审核通过</span>';
			}else{
				$res['statusname']='<span style="color:brown">待审核</span>';
			}
			if ($res['recommand']==1){
				$res['tuiname']='<span style="color:green">推荐</span>';
				$optname="<a href='admin.php?action=live&op=yugao&a=quxiaotuijian&id=".$res['id']."&uid=$suid&username=$susername&auditstatus=$sauditstatus&recommand=$srecommand'>取消推荐</a>";
			}else{
				$res['tuiname']='未推荐';
				$optname="<a href='admin.php?action=live&op=yugao&a=tuijian&id=".$res['id']."&uid=$suid&username=$susername&auditstatus=$sauditstatus&recommand=$srecommand'>推荐</a>";
			
			}
			showtablerow('', array('', ''), array(
			$res['username'].'('.$res['uid'].')',
			date("Y-m-d H:i:s",$res['start_time']).'~'.date("Y-m-d H:i:s",$res['end_time']),
			$res['content'],
			$res['statusname'],
			$res['tuiname'],
			"
			<a href='admin.php?action=live&op=yugao&a=shenhe&id=".$res['id']."&uid=$suid&username=$susername&auditstatus=$sauditstatus&recommand=$srecommand'>审核</a>
			$optname
			<a href='admin.php?action=live&op=yugao&a=bianji&id=".$res['id']."&uid=$suid&username=$susername&auditstatus=$sauditstatus&recommand=$srecommand'>编辑</a>
			<a onclick='return deleteHref(this.href)' href='admin.php?action=live&op=yugao&a=delete&id=".$res['id']."&uid=$suid&username=$susername&auditstatus=$sauditstatus&recommand=$srecommand'>删除</a>			
			"
			));
		}
	}
	showsubmit('', '', '', '', $multipage);
	showtablefooter();
	echo '<script>
	function deleteHref(href){
		if (!confirm("确认删除？"))
		{
		    return false;
		}	
	} 
	</script>
	';	
}
?>