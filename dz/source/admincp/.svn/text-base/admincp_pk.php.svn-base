<?php

/**
 * zhangchengjun
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$op = empty($_G['gp_op']) ? 'index' : $_G['gp_op'];
$ops = array('index', 'team', 'editteam', 'member', 'delmember', 'guess', 'addguess', 'editguess', 'delguess', 'setrightoption', 'givereward');
if (!in_array($op, $ops)) {
	$op = 'index';
}

//队伍
if ($op == 'index' || $op == 'team') {
	
	cpheader();
	shownav('extended', 'menu_pk');

	if (isset($_POST['submit'])) {
		if (empty($_G['gp_name'])) {
			cpmsg('队伍名称不能为空', "admin.php?frames=yes&action=pk&op=team", 'error');
		} else {
			if ($_FILES['logo']) {
				require_once DISCUZ_ROOT.'source/class/class_cupload.php';
				$objUpload = new cupload();
				
				$objUpload->setAllowTypes('jpg|png|gif|bmp');
				$objUpload->setDir('team');
				
				$logoName = 'team_'.time();
				$back = $objUpload->execute('logo', $logoName);
				$logoUploadSuccess = (@$back[0]['flag'] == 1) ? 1 : 0;
	
				$logo = $logoUploadSuccess ? '/data/team/'.$back[0]['name'] : '';
			} else {
				$logo = '';
			}
			
			$name = $_G['gp_name'];
			DB::insert('pk_team', array('name'=>$name, 'logo'=>$logo));
			
			cpmsg('operate_succeed', "admin.php?frames=yes&action=pk&op=team", 'succeed');
		}
	} else {
		$tpp = 10;
		$limit_start = ($page - 1) * $tpp;
		$addurl = '';
		
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('pk_team'));
		$query = DB::query("SELECT * FROM ".DB::table('pk_team')." ORDER BY teamid ASC");
		while ($rs = DB::fetch($query)) {
			$rs['membernum'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table('pk_team_member')." WHERE teamid=".$rs['teamid']);
			$list[] = $rs;
		}
		
		include_once(template('admincp/admincp_pk_team'));
	}

//编辑队伍信息
} elseif ($op == 'editteam') {
	
	cpheader();
	shownav('extended', 'menu_pk');
	
	if (isset($_POST['submit'])) {
		$teamid = intval($_G['gp_teamid']);
		
		if ($_FILES['logo']) {
			require_once DISCUZ_ROOT.'source/class/class_cupload.php';
			$objUpload = new cupload();
			
			$objUpload->setAllowTypes('jpg|png|gif|bmp');
			$objUpload->setDir('team');
			
			$logoName = 'team_'.time();
			$back = $objUpload->execute('logo', $logoName);
			$logoUploadSuccess = (@$back[0]['flag'] == 1) ? 1 : 0;
			
			if ($logoUploadSuccess) {
				$data['logo'] = '/data/team/'.$back[0]['name'];
			}
		}
		
		$data['name'] = $_G['gp_name'];
		
		DB::update('pk_team', $data, "teamid=$teamid");
		cpmsg('operate_succeed', "admin.php?frames=yes&action=pk&op=editteam&teamid=$teamid", 'succeed');		
	} else {
		$teamid = intval($_G['gp_teamid']);
		$teamInfo = DB::fetch_first("SELECT * FROM ".DB::table('pk_team')." WHERE teamid=$teamid");
		if (!empty($teamInfo)) {
			include_once(template('admincp/admincp_pk_editteam'));
		} else {
			cpmsg('队伍不存在', "admin.php?frames=yes&action=pk&op=team", 'error');
		}
	}

//成员
} elseif ($op == 'member') {
	
echo <<<EOT
<script src="static2/js/jquery.min.js" type="text/javascript"></script>
EOT;
	
	cpheader();
	shownav('extended', 'menu_pk');

	if (isset($_POST['submit'])) {
		$teamid = intval($_G['gp_teamid']);
		$member = $_G['gp_member'];
		if ($teamid && !empty($member)) {
			foreach ($member as $value) {
				$uid = $value;
				$userInfo = DB::fetch_first("SELECT uid,username FROM ".DB::table('common_member')." WHERE uid=$uid");
				$time = time();
				$data = array(
					'uid'=>$uid,
					'username'=>$userInfo['username'],
					'teamid'=>$teamid,
					'dateline'=>$time
				);
				DB::insert('pk_team_member', $data);
			}			
			cpmsg('operate_succeed', "admin.php?frames=yes&action=pk&op=member", 'succeed');
		} else {
			cpmsg('请选择队伍和主播', "admin.php?frames=yes&action=pk&op=member", 'error');
		}
	} else {
		$page = empty($_G['gp_page']) ? 1 : intval($_G['gp_page']);
		$tpp = 20;
		$limit_start = ($page - 1) * $tpp;
		
		$addUrl = $addC = '';
		$teamid = intval($_G['gp_teamid']);
		if ($teamid) {
			$addC .= " AND m.teamid=$teamid";
			$addUrl .= "&teamid=$teamid";
		}
		
		//队伍
		$query = DB::query("SELECT teamid,name FROM ".DB::table('pk_team'));
		while ($rs = DB::fetch($query)) {
			$teamList[] = $rs;
		}
		$addCondition = " AND r.uid IN(SELECT uid FROM ".DB::table('live_member_count')." WHERE level=2)";
		$addCondition .= " AND r.uid NOT IN(SELECT uid FROM ".DB::table('pk_team_member').")";
		//未分配主播
		$query = DB::query("SELECT r.uid,r.username FROM ".DB::table('live_room')." r WHERE 1$addCondition");
		while ($rs = DB::fetch($query)) {
			$noTeamMemberList[] = $rs;
		}
		
		//成员
		$count = DB::result_first("SELECT COUNT(*) FROM (SELECT m.* FROM ".DB::table('pk_team_member')." m 
			LEFT JOIN ".DB::table('pk_team')." t ON t.teamid=m.teamid 
			WHERE 1$addC) tmp");
		$query = DB::query("
			SELECT m.*,t.name FROM ".DB::table('pk_team_member')." m 
			LEFT JOIN ".DB::table('pk_team')." t ON t.teamid=m.teamid 
			WHERE 1$addC
			LIMIT $limit_start,$tpp
		");
		while ($rs = DB::fetch($query)) {
			$list[] = $rs;
		}
		
		$multi = multi($count, $tpp, $page, ADMINSCRIPT."?action=pk&op=member$addUrl");
		include_once(template('admincp/admincp_pk_member'));
	}

//删除成员
} elseif ($op == 'delmember') {
	
	cpheader();
	shownav('extended', 'menu_pk');
	
	$uid = intval($_G['gp_uid']);
	if ($uid) {
		DB::delete('pk_team_member', "uid=$uid");
	}
	cpmsg('operate_succeed', "admin.php?frames=yes&action=pk&op=member", 'succeed');

//竞猜列表
} elseif ($op == 'guess') {
	
	cpheader();
	shownav('extended', 'menu_pk');

	$query = DB::query("SELECT * FROM ".DB::table('pk_guess_config')." ORDER BY guessid DESC");
	while ($rs = DB::fetch($query)) {
		$during_str = '';
		if (!empty($rs['startdateline'])) {
			$during_str .= date('Y-m-d H:i:s', $rs['startdateline']).' - ';
		}
		if (!empty($rs['enddateline'])) {
			$during_str .= date('Y-m-d H:i:s', $rs['enddateline']);
		}
		

		$options = unserialize($rs['options']);
		$options_str = '';
		foreach ($options as $key=>$value) {
			$options_str .= $key.'.'.$value.'<br />';
		}
		
		$rs['options_str'] = $options_str;
		$tmp = $rs['drawed'] ? '' : '， <a href="admin.php?action=pk&op=setrightoption&guessid='.$rs['guessid'].'">重新设置</a>';
		$rs['rightoption_str'] = $rs['rightoption'] ? $options[$rs['rightoption']].$tmp : '未设置，<a href="admin.php?action=pk&op=setrightoption&guessid='.$rs['guessid'].'">立即设置</a>';
		$rs['during_str'] = $during_str;
		$rs['end_str'] = empty($rs['enddateline']) ? '未结束' : ($rs['enddateline'] > time() ? '未结束' : '已结束');
		$rs['drawed_str'] = ($rs['drawed'] == 1) ? '已发放' : '未发放, <a href="admin.php?action=pk&op=givereward&guessid='.$rs['guessid'].'">立即发放</a>';
		$list[] = $rs;
	}

	include_once(template('admincp/admincp_pk_guess'));

//创建竞猜
} elseif ($op == 'addguess') {
	
	cpheader();
	shownav('extended', 'menu_pk');

	if (isset($_POST['submit'])) {
		$fortype = $_G['gp_fortype'];
		$forid = $_G['gp_forid'];
		$startdateline = empty($_G['gp_starttime']) ? 0 : strtotime($_G['gp_starttime'].' 00:00:00');
		$enddateline = empty($_G['gp_endtime']) ? 0 : strtotime($_G['gp_endtime'].' 23:59:59');
		$needshowcoin = intval($_G['gp_needshowcoin']);
		$getshowcoin = intval($_G['gp_getshowcoin']);
		$i = 1;
		foreach ($_G['gp_options'] as $key=>$value) {
			if (!empty($value)) {
				$options[$i] = $value;
				$i++;
			}
		}

		if (empty($options)) {
			cpmsg('选项为空，请添加竞选项', "admin.php?frames=yes&action=pk&op=addguess", 'error');
		} else {
			$data = array(
				'uid'=>$_G['uid'],
				'username'=>$_G['username'],
				'fortype'=>$fortype,
				'forid'=>$forid,
				'startdateline'=>$startdateline,
				'enddateline'=>$enddateline,
				'options'=>serialize($options),
				'needshowcoin'=>$needshowcoin,
				'getshowcoin'=>$getshowcoin,
				'dateline'=>$dateline,
				'drawed'=>0,
			);
			DB::insert('pk_guess_config', $data);
			cpmsg('operate_succeed', "admin.php?frames=yes&action=pk&op=guess", 'succeed');
		}
	} else {
		include_once(template('admincp/admincp_pk_addguess'));
	}

//编辑竞猜
} elseif ($op == 'editguess') {
	
	cpheader();
	shownav('extended', 'menu_pk');

	if (isset($_POST['submit'])) {
		$guessid = intval($_G['gp_guessid']);
		$fortype = $_G['gp_fortype'];
		$forid = $_G['gp_forid'];
		$startdateline = empty($_G['gp_starttime']) ? 0 : strtotime($_G['gp_starttime'].' 00:00:00');
		$enddateline = empty($_G['gp_endtime']) ? 0 : strtotime($_G['gp_endtime'].' 23:59:59');
		$needshowcoin = intval($_G['gp_needshowcoin']);
		$getshowcoin = intval($_G['gp_getshowcoin']);
		$i = 1;
		foreach ($_G['gp_options'] as $key=>$value) {
			if (!empty($value)) {
				$options[$i] = $value;
				$i++;
			}
		}

		if (empty($options)) {
			cpmsg('选项为空，请添加竞选项', "admin.php?frames=yes&action=pk&op=editguess&guessid=$guessid", 'error');
		} else {
			$data = array(
				'fortype'=>$fortype,
				'forid'=>$forid,
				'startdateline'=>$startdateline,
				'enddateline'=>$enddateline,
				'options'=>serialize($options),
				'needshowcoin'=>$needshowcoin,
				'getshowcoin'=>$getshowcoin,
			);
			DB::update('pk_guess_config', $data, "guessid=$guessid");
			cpmsg('operate_succeed', "admin.php?frames=yes&action=pk&op=editguess&guessid=$guessid", 'succeed');
		}		
	} else {
		$guessid = intval($_G['gp_guessid']);
		if ($guessid) {
			$guessConfig = DB::fetch_first("SELECT * FROM ".DB::table('pk_guess_config')." WHERE guessid=$guessid");
			$options = unserialize($guessConfig['options']);
			$startdateline = empty($guessConfig['startdateline']) ? '' : date('Y-m-d', $guessConfig['startdateline']);
			$enddateline = empty($guessConfig['enddateline']) ? '' : date('Y-m-d', $guessConfig['enddateline']);
			include_once(template('admincp/admincp_pk_editguess'));
		}
	}

//删除竞猜
} elseif ($op == 'delguess') {
	
	cpheader();
	shownav('extended', 'menu_pk');

	$guessid = intval($_G['gp_guessid']);
	if ($guessid) {
		DB::delete('pk_guess_config', "guessid=$guessid");
		cpmsg('operate_succeed', "admin.php?frames=yes&action=pk&op=guess", 'succeed');
	}

//设置正确项
} elseif ($op == 'setrightoption') {
	
	cpheader();
	shownav('extended', 'menu_pk');

	if (isset($_POST['submit'])) {
		$guessid = intval($_G['gp_guessid']);
		$data = array(
			'rightoption'=>intval($_G['gp_rightoption'])
		);
		DB::update('pk_guess_config', $data, "guessid=$guessid");
		cpmsg('operate_succeed', "admin.php?frames=yes&action=pk&op=guess", 'succeed');
	} else {
		$guessid = intval($_G['gp_guessid']);
		if ($guessid) {
			$guessConfig = DB::fetch_first("SELECT * FROM ".DB::table('pk_guess_config')." WHERE guessid=$guessid");
			$options = unserialize($guessConfig['options']);
			include_once(template('admincp/admincp_pk_setrightoption'));
		}	
	}
	
//发放奖励
} elseif ($op == 'givereward') {
	
	cpheader();
	shownav('extended', 'menu_pk');
	
	$guessid = intval($_G['gp_guessid']);
	if ($guessid) {
		$guessConfig = DB::fetch_first("SELECT * FROM ".DB::table('pk_guess_config')." WHERE guessid=$guessid");
		if (!empty($guessConfig)) {
			//判断是否结束
			if ($guessConfig['enddateline'] <= time()) {
				if ($guessConfig['rightoption']>0) {

					$getshowcoin = intval($guessConfig['getshowcoin']);

					if ($getshowcoin) {
						//猜对的人员
						$query = DB::query("SELECT uid FROM ".DB::table('pk_guess_log')." WHERE guessid=".$guessConfig['guessid']." AND optionid=".$guessConfig['rightoption']." AND drawed=0");

						//发放奖励
						while ($rs = DB::fetch($query)) {
							$remark='猜对第'.$guessConfig['forid'].'轮PK赛奖励';
							$logId = SIPHuoShowUpdate($rs['uid'], 'MRC', $getshowcoin, $remark);
							if ($logId) {
								//更新状态
								DB::update("pk_guess_log", array('drawed'=>1), "uid=".$rs['uid']." AND guessid=".$guessConfig['guessid']);
							}
						}

						DB::update('pk_guess_config', array('drawed'=>1), "guessid=".$guessConfig['guessid']);
						cpmsg('发放完毕', "admin.php?frames=yes&action=pk&op=guess", 'succeed');	
					} else {
						cpmsg('没有可发送的奖励', "admin.php?frames=yes&action=pk&op=guess", 'error');
					}
				} else {
					cpmsg('还未设置正确选项，不能发放奖励', "admin.php?frames=yes&action=pk&op=guess", 'error');
				}
			} else {
				cpmsg('竞猜还未结束，不能发放奖励', "admin.php?frames=yes&action=pk&op=guess", 'error');
			}
		}
	}
}
?>