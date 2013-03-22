<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_tasks.php 9116 2010-04-27 03:09:21Z monkey $
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
cpheader();          

$_G['setting']['memberperpage'] = 10;
$page = max(1, $_G['page']);
$start_limit = ($page - 1) * $_G['setting']['memberperpage'];

//echo ';
$operation = $operation ? $operation : 'act';

// A zhangchengjun 2011.06.15
if ($operation == 'medal') {
	
	$act = $_G['gp_act'];
	if ($act == 'addmember') {//添加获奖用户		
		if (isset($_G['gp_submit_addmember'])) {			
			$time = time();
			$matchid = intval($_G['gp_matchid']);			
			$medal[1] = explode(',', str_replace('，', ',', $_G['gp_medal1']));
			$medal[2] = explode(',', str_replace('，', ',', $_G['gp_medal2']));
			$medal[3] = explode(',', str_replace('，', ',', $_G['gp_medal3']));
			$medal = cTrim($medal);
			!is_array($medal[1]) && $medal[1] = array();
			!is_array($medal[2]) && $medal[2] = array();
			!is_array($medal[3]) && $medal[3] = array();
			
			foreach ($medal as $key=>$value) {
				if (empty($value)) {//如果为空则清除该比赛获奖人
					DB::delete('pre_activity_medal', "matchid='$matchid' AND medal=$key");
				} else {//不为空则：1.如果已获奖人不在此内则删除 2.在此内的则不变 3.新的获奖人需添加
					
					$q1 = DB::query("SELECT userid,username FROM pre_activity_medal WHERE matchid=$matchid AND medal=$key");
					while ($r1 = DB::fetch($q1)) {
						$tmpKey = array_search($r1['username'], $value);
						if ($tmpKey === FALSE) {
							#1.如果已获奖人不在此内则删除					
							DB::delete("activity_medal", "matchid=$matchid AND medal=$key AND username='".$r1['username']."'");
						} else {
							#2.在此内的则不变,同时删除检查过的用户
							unset($value[$tmpKey]);
						}
					}					
					
					#3.剩下的则为新的获奖人,需添加。添加时需检查是否为主播。
					foreach ($value as $k=>$v) {
						#3.1主播信息
						$anchorInfo = DB::fetch_first("SELECT uid,username FROM pre_live_room WHERE username='$v'");
						if (!empty($anchorInfo)) {							
							$data = array(
								'userid'=>$anchorInfo['userid'],							
								'username'=>$anchorInfo['username'],
								'matchid'=>$matchid,
								'medal'=>$key,
								'dateline'=>$time				
							);
							DB::insert('activity_medal', $data);							
						} else {
							//错误的主播名;
						}
					}
				}
			}
			cpmsg('操作完成！', "admin.php?frames=yes&action=activity&operation=medal&act=addmember&id=$matchid", 'succeed');			
		} else {
			$matchid = intval($_G['gp_id']);
			$medal = array(1=>array(), 2=>array(), 3=>array());
			
			$query = DB::query("SELECT username,medal FROM pre_activity_medal WHERE matchid=$matchid ORDER BY medal ASC ,dateline ASC");
			while ($rs = DB::fetch($query)) {
				$medal[$rs['medal']][] = $rs['username'];
			}
			
			$medalShow[1] = implode(',', $medal[1]);
			$medalShow[2] = implode(',', $medal[2]);
			$medalShow[3] = implode(',', $medal[3]);
			
			cpheader();
			include_once(template('admincp/admincp_activity_medal_addmember'));
		}
	} elseif ($act == 'delete') {
		$matchid = intval($_G['gp_id']);
		
		DB::delete('activity_medal', "matchid=$matchid");
		DB::delete('activity_match', "id=$matchid");
		
		cpmsg('操作完成！', "admin.php?frames=yes&action=activity&operation=medal", 'succeed');
	} else {
		if (isset($_G['gp_submit_match'])) {
			$activity = $_G['gp_activity'];
			$year = $_G['gp_year'];
			$month = $_G['gp_month'];
			
			if (empty($activity)) {
				cpmsg('没有选择活动！', "admin.php?frames=yes&action=activity&operation=medal", 'error');
			} else {
				$existed = DB::result_first("SELECT COUNT(*) FROM pre_activity_match WHERE activity=$activity AND year=$year AND month=$month");
				if ($existed) {
					cpmsg('比赛已存在！', "admin.php?frames=yes&action=activity&operation=medal", 'error');
				} else {
					$data = array(
						'activity'=>$activity,
						'year'=>$year,
						'month'=>$month
					);
					DB::insert('activity_match', $data);
					cpmsg('操作成功！', "admin.php?frames=yes&action=activity&operation=medal", 'succeed');
				}
			}
			
		} else {
			//活动
			$query = DB::query("SELECT id,name FROM pre_activity");
			while ($rs = DB::fetch($query)) {
				$activity[] = $rs;
			}
			//比赛
			$query = DB::query("SELECT m.*,a.name AS activity_name  
				FROM pre_activity_match m 
				LEFT JOIN pre_activity a ON a.id=m.activity
				ORDER BY m.activity ASC, m.year ASC, m.month ASC");
			while ($rs = DB::fetch($query)) {
				//获奖人员
				$matchid = $rs['id'];
				$q1 = DB::query("SELECT username,medal FROM pre_activity_medal WHERE matchid=$matchid ORDER BY medal ASC,dateline ASC");
				$medals  = array(0=>array(), 1=>array(), 2=>array());
				while ($r1 = DB::fetch($q1)) {
					if ($r1['medal'] == 1) {
						$medals[0][] = $r1['username'];
					} elseif ($r1['medal'] == 2) {
						$medals[1][] = $r1['username'];
					} elseif ($r1['medal'] == 3) {
						$medals[2][] = $r1['username'];
					}
				}
				$rs['medals_str'] = "金牌：".implode(',', $medals[0]). " 银牌：".implode(',', $medals[1]). " 铜牌：".implode(',', $medals[2]);
				$match[] = $rs;
			}
			
			cpheader();
			include_once(template('admincp/admincp_activity_medal'));
		}
	}	
	die;
}
//end

$search_condition = array_merge($_GET, $_POST);
foreach($search_condition as $k => $v) {
	if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
		unset($search_condition[$k]);
	}
}
?>
<script type="text/javascript">
function deleact(href){
	if (!confirm("确认删除？"))
	{
	    return false;
	}	
	
}
</script>
<?php 
if($operation=='act'){
	shownav('extended', 'memu_activity');
	showsubmenu('', array(
			array('活动', 'activity&operation=act&a=list', 1),
			array('积分', 'activity&operation=jifen&a=list', 0),
			array('荣誉', 'activity&operation=medal', 0),
			
	));
	if ($_GET['a']=='list' or empty($_GET['a'])){
		$condition='';
		if ($search_condition['name']){
			$searchName = $search_condition['name'];
			$condition = $condition." AND name = like '%$searchName%' ";
		}		
		echo '<a href="/admin.php?action=activity&operation=act&a=add"  class="addtr">添加活动</a>';
		?>
		
		<?php 
		showtableheader();
		showsubtitle(array('活动名称', '活动状态','operation'));
	
		$counts=DB::result_first("SELECT COUNT(*) AS count FROM ".DB::table('activity')." a WHERE 1 ".$condition." ");
		if($counts > 0) {
			$multipage = multi($counts, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=activity&operation=act&a=list&submit=yes");
			$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
			$sql = "SELECT * FROM ".DB::table('activity')." WHERE 1  ".$condition."ORDER BY id DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
			
			$query = DB::query($sql);
			
			while ($res = DB::fetch($query)){
				showtablerow('', array('', ''), array(
				$res['name'],
				getActivityStatusName($res['status']),
				'
				<a href="admin.php?action=activity&operation=act&a=info&id='.$res['id'].'">参与用户</a>
				<a href="admin.php?action=activity&operation=act&a=change_status&id='.$res['id'].'">更改状态</a>
				<a href="admin.php?action=activity&operation=settime&a=list&actid='.$res['id'].'">时段管理</a>
				<a href="admin.php?action=activity&operation=act&a=add&id='.$res['id'].'">编辑</a>
				<a href="admin.php?action=activity&operation=act&a=delete&id='.$res['id'].'" onclick="return deleact(this.href)">删除</a>
				
				'
				));
			}
		}
		showsubmit('', '', '', '', $multipage);
		showtablefooter();
	}
	
	if ($_GET['a']=='info'){
		$actid = $_GET['id'];
		if($_GET['value']){
			$value = $_GET['value'];
			$uid = $_GET['uid'];
			$perid = $_GET['perid'];
			$sql = "UPDATE ".DB::table('activity_partner')." SET status=$value WHERE actid=$actid AND uid = '$uid' AND perid='$perid'";
			DB::query($sql);
		}
		$sql = "SELECT * FROM ".DB::table('activity')." WHERE id=$actid";
		$actinfo = DB::fetch_first($sql);
		showtableheader();
		echo '<I style="font-size:15px;font-weight:bold;">'.$actinfo['name'].'</I><br><br>';
		echo '<a href="/admin.php?action=activity"><< 返回到活动列表</a><br><br>';
		showsubtitle(array('用户名', '时段名称','时段时间范围','积分名称','获得积分','获得魅力值','状态','操作'));
	
		$counts=DB::result_first("SELECT COUNT(*) AS count FROM ".DB::table('activity_partner')." a WHERE a.actid=$actid ".$condition." ");
		if($counts > 0) {
			$multipage = multi($counts, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=activity&operation=act&a=list&submit=yes");
			$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
			$sql = "SELECT a.uid, a.charm,a.username,a.perid,sum(a.points) as points ,  c.name AS cname, c.stime, c.etime,a.status "
				 ." FROM ".DB::table('activity_partner')." a "				
				 ." LEFT JOIN ".DB::table('activity_period')." c ON a.perid = c.id "
				 ." WHERE a.actid =$actid "
				 ." GROUP BY a.uid "
				 ." ORDER BY a.id DESC  "
			     ." LIMIT $start_limit, {$_G[setting][memberperpage]}";
		
		 
			$query = DB::query($sql);
			
			while ($res = DB::fetch($query)){
				$integral = getActBindInfoByPid($res['perid']);
				if ($res['status']==0) {
					$statusCnName = '待审核';
					$opt = '<a href="/admin.php?action=activity&operation=act&a=info&value=1&id='.$actid.'&uid='.$res['uid'].'&perid='.$res['perid'].'">通过</a> 
					<a href="/admin.php?action=activity&operation=act&a=info&value=2&id='.$actid.'&uid='.$res['uid'].'&perid='.$res['perid'].'">不通过</a>';
				}
				if ($res['status']==1) {
					$statusCnName = '通过';
					$opt = '<a href="/admin.php?action=activity&operation=act&a=info&value=2&id='.$actid.'&uid='.$res['uid'].'&perid='.$res['perid'].'">不通过</a>';
				}
				if ($res['status']==2) {
					$statusCnName = '不通过';
					$opt = '<a href="/admin.php?action=activity&operation=act&a=info&value=1&id='.$actid.'&uid='.$res['uid'].'&perid='.$res['perid'].'">通过</a>';
				}
				$cname='未设置时段';
				if ($res['cname']){
					$cname=$res['cname'];
				}
				$pname = '时段未绑定积分';
				if ($res['pname']){
					$pname = $res['pname'];
				}
				if ($res['stime']){
					$timeroll = date("Y-m-d",$res['stime']).'~'.date("Y-m-d",$res['etime']);
				}else{
					$timeroll='无';
				}
				foreach ($integral as $k=>$v){
					
					$res['pname']=$res['pname'].'['.$v['name'].'] <br>';
				}
				showtablerow('', array('', ''), array(
				$res['username'],$cname,$timeroll,$pname,$res['points']	,$res['charm'],	$statusCnName,$opt
				));
			}
		}
		showsubmit('', '', '', '', $multipage);
		showtablefooter();
		
	}
	
	
	if ($_GET['a']=='save'){
		$id=$_GET['id'];
		
		$name=$_POST['name'];
		$intro=$_POST['intro'];
		$rule=$_POST['rule'];
		$participation=$_POST['participation'];
		$awards=$_POST['awards'];
		$time=time();
		if (empty($id)){
			$data = array(
			'name'=>$name,
			'status'=>1,
			'ctime'=>$time,
			'cby'=>$_G['uid'],
			'uptime'=>$time,
			'upby'=>$_G['uid'],
			'intro'=>$intro,
			'rule'=>$rule,
			'participation'=>$participation,
			'awards'=>$awards);	
			DB::insert('activity',$data);
		}else{		
			$data = array(
			'name'=>$name,			
			'intro'=>$intro,
			'rule'=>$rule,
			'uptime'=>$time,
			'upby'=>$_G['uid'],
			'participation'=>$participation,
			'awards'=>$awards);
			DB::update('activity',$data,"  id=$id ");
		}
		echo '<meta http-equiv="refresh" content="2;url=admin.php?action=activity&a=list">';
		echo '<a href="/admin.php?action=activity"><< 返回到活动列表</a><br><br>';
		
		echo '<span style="color:green">保存成功</span>';
		
		
	}
	
	if ($_GET['a']=='delete'){
		$id=$_GET['id'];
		if (!empty($id)){
			$sql = "DELETE FROM ".DB::table('activity')." WHERE id=$id";
			DB::query($sql);
			$sql = "DELETE FROM ".DB::table('activity_period')." WHERE actid=$id";
			DB::query($sql);
			$sql = "DELETE FROM ".DB::table('activity_period_bind')." WHERE actid=$id";
			DB::query($sql);
			header("Location: admin.php?action=activity");
		}
		
	}
	
	if ($_GET['a']=='add'){	
		
		if (!empty($_GET['id'])){
			$id = $_GET['id'];
			$sql = "SELECT * FROM ".DB::table('activity')." WHERE id=$id";
			$actinfo = DB::fetch_first($sql);
		}
		shownav('extended', 'memu_activity');
		echo '<a href="/admin.php?action=activity"><< 返回到活动列表</a><br><br>';
		showformheader("activity&operation=act&a=save&id=$id");
		?>		
		活动名称<br>
		<input name="name" id="name" class="txt" style="width:260px;" value="<?php echo $actinfo['name'];?>"><br><br>
		活动简介<br>
		<textarea name="intro" id="intro" rows="6" cols="5" class="tarea" style="width:260px;"><?php echo $actinfo['intro'];?></textarea><br><br>
		活动规则<br>
		<textarea name="rule" id="rule" rows="6" cols="5" class="tarea" style="width:260px;"><?php echo $actinfo['rule'];?></textarea><br><br>
		参与方法<br>
		<textarea name="participation" id="participation" rows="6" cols="5" class="tarea" style="width:260px;"><?php echo $actinfo['participation'];?></textarea><br><br>
		奖项设置<br>
		<textarea name="awards" id="awards" rows="6" cols="5" class="tarea" style="width:260px;"><?php echo $actinfo['awards'];?></textarea><br><br>
		<?php 
		showsubmit('submit', '提交', '', '','');
		showformfooter();
	}
	
	if ($_GET['a']=='change_status'){
		$id = $_GET['id'];
		
		$sql = "SELECT * FROM ".DB::table('activity')." WHERE id=$id";
		$actinfo = DB::fetch_first($sql);
		
		if ($_GET['act']=='save'){
			$status = $_POST['status'];		
			if (!empty($status)){
				
				if ($status==2 and $actinfo['status']!=2){
					
					$sTime = time();
										
				}else{
					$sTime = $actinfo['sTime'];
				}
				if ($status==3 and $actinfo['status']!=3){
					$eTime = time();					
				}else{
					$eTime = $actinfo['eTime'];
				}
				$sql = "UPDATE ".DB::table('activity')." SET sTime='$sTime',eTime='$eTime', status = $status,uptime=".time().",upby=".$_G['uid']." WHERE id= $id";
				DB::query($sql);
				echo '<meta http-equiv="refresh" content="2;url=admin.php?action=activity">';
				echo '<a href="/admin.php?action=activity"><< 返回到活动列表</a><br><br>';			
				echo '<span style="color:green">保存成功</span>';
			}else{
				echo '<meta http-equiv="refresh" content="2;url=admin.php?action=activity">';
				echo '<a href="/admin.php?action=activity"><< 返回到活动列表</a><br><br>';	
				echo '<span style="color:red">保存失败</span>';
			}
			return;
			
		}
		
		
		$statusName = getActivityStatusName($actinfo['status']);
		shownav('extended', 'memu_activity');
		echo '<I style="font-size:15px;font-weight:bold;">'.$actinfo['name'].'</I><br><br>';
		echo '<a href="/admin.php?action=activity"><< 返回到活动列表</a><br><br>';
		showformheader("activity&operation=act&a=change_status&id=$id&act=save");
		
		echo '更 改 为：<select name="status" class="select">';
		echo '<option value="'.$actinfo['status'].'">'.$statusName.'</option>';
		echo '<option value="1">'.getActivityStatusName(1).'</option>';
		echo '<option value="2">'.getActivityStatusName(2).'</option>';
		echo '<option value="3">'.getActivityStatusName(3).'</option>';
		echo '</select><br><br>';
		showsubmit('submit', '提交', '', '','');
		showformfooter();
	}
}




if ($operation=='jifen'){
	shownav('extended', 'menu_setting_credits');
	showsubmenu('', array(
			array('活动', 'activity&operation=act&a=list', 0),
			array('积分', 'activity&operation=jifen&a=list', 1),
			array('荣誉', 'activity&operation=medal', 0),			
		));
		
	if ($_GET['a']=='list' or empty($_GET['a'])){
		echo '<a href="/admin.php?action=activity&operation=jifen&a=add"  class="addtr">添加积分</a>';
		showtableheader();
		showsubtitle(array('积分名称', '标识','operation'));
		$counts=DB::result_first("SELECT COUNT(*) AS count FROM ".DB::table('activity_integral')." a WHERE 1 ".$condition." ");
		if($counts > 0) {
			$multipage = multi($counts, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=activity&operation=jifen&a=list&submit=yes");
			$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
			$sql = "SELECT * FROM ".DB::table('activity_integral')." WHERE 1  ".$condition."ORDER BY id DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
			
			$query = DB::query($sql);
			
			while ($res = DB::fetch($query)){
				showtablerow('', array('', ''), array(
				$res['name'],
				$res['tag'],
				'				
				<a href="admin.php?action=activity&operation=jifen&a=add&id='.$res['id'].'">编辑</a>
				<a href="admin.php?action=activity&operation=jifen&a=delete&id='.$res['id'].'" onclick="return deleact(this.href)">删除</a>
				'
				));
			}
		}
		showsubmit('', '', '', '', $multipage);
		showtablefooter();
	}
	
	if ($_GET['a']=='add'){
		if (!empty($_GET['id'])){
			$id = $_GET['id'];
			$sql = "SELECT * FROM ".DB::table('activity_integral')." WHERE id=$id";
			$info = DB::fetch_first($sql);
		}
		
		echo '<a href="/admin.php?action=activity&operation=jifen&a=list"><< 返回到积分列表</a><br><br>';
		showformheader("activity&operation=jifen&a=save&id=$id");
		?>		
		积分名称<br>
		<input name="name" id="name" class="txt" style="width:260px;" value="<?php echo $info['name'];?>"><br><br>
		积分标签<br>
		<input name="tag" id="tag" class="txt" style="width:260px;" value="<?php echo $info['tag'];?>"><br><br>
		
		<?php 
		showsubmit('submit', '提交', '', '','');
		showformfooter();
	}
	if ($_GET['a']=='delete'){
		$id=$_GET['id'];
		if (!empty($id)){
			$sql = "DELETE FROM ".DB::table('activity_integral')." WHERE id=$id";
			DB::query($sql);
			$sql = "DELETE FROM ".DB::table('activity_period_bind')." WHERE integral_id=$id";
			DB::query($sql);
			header("Location: admin.php?action=activity&operation=jifen");
		}
		
	}
	
	if ($_GET['a']=='save'){
		$id=$_GET['id'];
		
		$name=$_POST['name'];
		$tag=$_POST['tag'];
		
		$data = array(
			'name'=>$name,
			'tag'=>$tag);	
		if (empty($id)){					
			DB::insert('activity_integral',$data);
		}else{				
			DB::update('activity_integral',$data,"  id=$id ");
		}
		echo '<meta http-equiv="refresh" content="2;url=admin.php?action=activity&operation=jifen">';
		echo '<a href="/admin.php?action=activity&operation=jifen"><< 返回到积分列表</a><br><br>';
		
		echo '<span style="color:green">保存成功</span>';
		
		
	}
}

if ($operation=='settime'){
	shownav('extended', 'memu_activity');
	showsubmenu('', array(
			array('时段管理', 'activity&operation=act&a=list', 1),
			array('活动', 'activity&operation=act&a=list', 0),
			array('积分', 'activity&operation=jifen&a=list', 0),
			
	));
	$actid=$_GET['actid'];
	$actid = $_GET['actid'];
	$sql = "SELECT * FROM ".DB::table('activity')." WHERE id=$actid";
	$actinfo = DB::fetch_first($sql);
		
	if ($_GET['a']=='list' or empty($_GET['a'])){	
		echo '<I style="font-size:15px;font-weight:bold;">'.$actinfo['name'].'</I><br><br>';
		echo '<a href="/admin.php?action=activity"><< 返回到活动列表</a><br><br>';
		echo '<a href="/admin.php?action=activity&operation=settime&a=add&actid='.$actid.'"  class="addtr">添加时段</a>';
		showtableheader();
		showsubtitle(array('时段名称', '有效期','月时段','周时段','日时段','operation'));
		$sql = "SELECT COUNT(*) AS count FROM ".DB::table('activity_period')." a WHERE actid = $actid ".$condition." ";		
		$counts=DB::result_first($sql);
		
		if($counts > 0) {
			$multipage = multi($counts, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=activity&operation=settime&a=list&submit=yes");
			$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
			$sql = "SELECT * FROM ".DB::table('activity_period')." WHERE actid=$actid  ".$condition."ORDER BY id DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
			
			$query = DB::query($sql);
			
			while ($res = DB::fetch($query)){
				echo '<tr class="hover">';
				echo '<td>'.$res['name'].'</td>';
				echo '<td>'.date("Y-m-d",$res['stime']).'~'.date("Y-m-d",$res['etime']).'</td>';		
				echo '<td>'.$res['smonth'].'号 ~ '.$res['emonth'].'号</td>';	
				echo '<td>周'.$res['sweek'].' ~ 周'.$res['eweek'].'</td>';	
				echo '<td>'.$res['sdaytime'].'点 ~ '.$res['edaytime'].'点</td>';		
				echo '<td>				
				<a href="admin.php?action=activity&operation=settime&a=add&actid='.$actid.'&id='.$res['id'].'">编辑</a>
				<a href="admin.php?action=activity&operation=settime&a=delete&actid='.$actid.'&id='.$res['id'].'" onclick="return deleact(this.href)">删除</a>
				</td></tr>'
				;
			}
		}
		showsubmit('', '', '', '', $multipage);
		showtablefooter();
		
		
		
	}
	
	if ($_GET['a'] =='delete'){
		$id=$_GET['id'];
		if (!empty($id)){
			$sql = "DELETE FROM ".DB::table('activity_period')." WHERE id=$id";
			DB::query($sql);
			$sql = "DELETE FROM ".DB::table('activity_period_bind')." WHERE perid=$id";
			DB::query($sql);
			$sql = "DELETE FROM ".DB::table('activity_period_bindgift')." WHERE perid=$id";
			DB::query($sql);
			upAct($actid, $_G['uid']);
			header("Location: admin.php?action=activity&operation=settime&actid=$actid");
		}
	}
	if ($_GET['a']=='save'){
		
		$id=$_GET['id'];
		$actid=$_GET['actid'];		
		$name=$_POST['name'];
		$stime=strtotime($_POST['stime'].' 00:00:00');
		$etime=strtotime($_POST['etime'].' 23:59:59');
		
		$smonth = $_POST['smonth'];
		$emonth = $_POST['emonth'];
		$sweek = $_POST['sweek'];
		$eweek = $_POST['eweek'];
		$sdaytime = $_POST['sdaytime'];
		$edaytime = $_POST['edaytime'];
		
		$sminute = $_POST['sminute'];
		$eminute = $_POST['eminute'];
		
		$jifenid = $_POST['jifennameid'];
		if ($jifenid){
			$jifenidArr = explode(',', $jifenid);
		}
		$giftid = $_POST['giftid'];
		if ($giftid){
			$giftArr = explode(',', $giftid);
		}		
		$data = array(
		'actid'=>$actid,'name'=>$name,
		'stime'=>$stime,'etime'=>$etime,
		'smonth'=>$smonth,'emonth'=>$emonth,
		'sweek'=>$sweek,'eweek'=>$eweek,
		'sdaytime'=>$sdaytime,'edaytime'=>$edaytime,
		'sminute'=>$sminute,'eminute'=>$eminute,
		
		'bandattr'=>$_POST['bandattr']
		);
		
		if (empty($id)){					
			$lastid = DB::insert('activity_period',$data,true);			
			
			if ($jifenid){
				for ($i=0;$i<count($jifenidArr);$i++){
					if (!empty($jifenidArr[$i])){					
						$integralId=getIntegralId($_POST['jifens'.$jifenidArr[$i]]);
						if (!empty($integralId)){					
							$data2 = array('perid'=>$lastid,'integral_id'=>$integralId,'integral_script'=>$_POST['script'.$jifenidArr[$i]],'actid'=>$actid);				
							DB::insert('activity_period_bind',$data2);					
						}
					}			
					
				}
			}
			if ($giftid){
				for ($i=0;$i<count($giftArr);$i++)
				{
					if (!empty($giftArr[$i])){	
						$data3 = array('actid'=>$actid,'perid'=>$lastid,'giftid'=>$giftArr[$i]);
						DB::insert('activity_period_bindgift',$data3);
					}
				}
			}
		}else{				
			DB::update('activity_period',$data,"  id=$id ");
			$sql = "DELETE FROM ".DB::table('activity_period_bind')." WHERE perid=$id";
			DB::query($sql);
			$sql = "DELETE FROM ".DB::table('activity_period_bindgift')." WHERE perid=$id";
			DB::query($sql);
			if ($_POST['bandattr']=='integral'){
				if ($jifenid){
					for ($i=0;$i<(count($jifenidArr)-1);$i++){
						$integralId=getIntegralId($_POST['jifens'.$jifenidArr[$i]]);
						$bid=$_POST['bind'.$jifenidArr[$i]];
						if (!empty($integralId)){					
							$data2 = array('perid'=>$id,'integral_id'=>$integralId,'integral_script'=>$_POST['script'.$jifenidArr[$i]],'actid'=>$actid);				
							DB::insert('activity_period_bind',$data2);	
											
							
						}
					}
				}
			}
			if ($_POST['bandattr']=='gift'){
				if ($giftid){
					for ($i=0;$i<count($giftArr);$i++)
					{
						if (!empty($giftArr[$i])){	
							$data3 = array('actid'=>$actid,'perid'=>$id,'giftid'=>$giftArr[$i]);
							DB::insert('activity_period_bindgift',$data3);
						}
					}
				}
			}
		}		
		upAct($actid, $_G['uid']);
		echo '<meta http-equiv="refresh" content="2;url=admin.php?action=activity&operation=settime&actid='.$actid.'">';
		echo '<a href="/admin.php?action=activity&operation=settime&actid='.$actid.'"><< 返回到时段列表</a><br><br>';
		
		echo '<span style="color:green">保存成功</span>';
		
		
	}
	
	if ($_GET['a']=='add'){
		
		if (!empty($_GET['id'])){
			$id = $_GET['id'];
			$sql = "SELECT * FROM ".DB::table('activity_period')." WHERE id=$id";
			$periodInfo = DB::fetch_first($sql);
			$bandattr = $periodInfo['bandattr'];			
		}
		shownav('extended', 'memu_activity');
		echo '<I style="font-size:15px;font-weight:bold;">'.$actinfo['name'].'</I><br><br>';
		echo '<a href="/admin.php?action=activity&operation=settime&actid='.$actid.'"><< 返回到时段列表</a><br><br>';
		
		?>
		<script src="static/js/calendar.js" type="text/javascript"></script>
		
		<script type="text/javascript">
			var jishu=2;
			function addBindIntegral(){
				
				var ihtml = '<div id="jifen'+jishu+'" style="width:100%">';
				ihtml+='<div id="jifens'+jishu+'"style="height:100px;width:130px;float:left">';
				ihtml+='<select name="jifens'+jishu+'"  id="bind'+jishu+'" class="select" onchange="showselect('+"'"+jishu+"'"+',this);">';				
				ihtml+=$('addjifendisplay').innerHTML;
				ihtml+='</select><br><br><br>标签：<span id="tag'+jishu+'"></span></div><div style="height:100px;width:300px;float:left">';
				ihtml+='<textarea name="script'+jishu+'" id="script'+jishu+'" rows="6" cols="5" class="tarea" style="width:260px;">积分脚本</textarea><br><br></div>';
				ihtml+='<div style="height:100px;width:50px;float:left">';
				ihtml+='<a style="width:22px;border-width:0px;font-family:webdings;" href="###" onclick="cls('+"'jifen"+jishu+"'"+')">r</a></div></div>';
				jishu++;
				$('addjifen').innerHTML=$('addjifen').innerHTML+ihtml;
				return false;
			}
			function changeBindAttr(e)
			{
				if(e.value=='integral'){
					$('bindgift').style.display="none";
					$('bindjifen').style.display="block";
				}
				if(e.value=='gift'){
					$('bindgift').style.display="block";
					$('bindjifen').style.display="none";
				}
				if(e.value=='0'){
					$('bindgift').style.display="none";
					$('bindjifen').style.display="none";
				}
			}
			function cls(id){ 				
				$('addjifen').removeChild($(id)); 
			}
			function showselect(id,v){
				
				$('tag'+id).innerHTML=v.value;
				$('script'+id).value=v.value+'*1';
			}
			function setGiftid(e){
				var giftv = ','+e.value+',';
				if(e.checked==true){					
					$('giftid').value+=giftv;
					document.getElementById('td_'+e.value).style.background="#E2EAF6";
					
				}else{
					$('giftid').value = $('giftid').value.replace (giftv,'');
					$('td_'+e.value).style.background="#FFFFFF";
				}
			}
			function cform(){
				if($('name').value==''){
					alert('请填写时段名称');
					$('name').focus();
					return false;
				}
				if($('stime').value==''){
					alert('请填设置时段开始时间');
					$('stime').focus();
					return false;
				}
				if($('etime').value==''){
					alert('请填设置时段结束时间');
					$('etime').focus();
					return false;
				}
				if($('bandattr').value=='integral'){
					$('jifennameid').value='';
					for(var i=1;i<jishu;i++){
						if($('jifen'+i)){
							if(($('bind'+i).value)=='0'){
								alert('请选择积分');
								$('bind'+i).focus();
									
								$('jifennameid').value='';						
								return false;
							}else{							
								$('jifennameid').value+=i+',';
								
							}
						}
					}	
				}			
			}		
		</script>
		<?php showformheader("activity&operation=settime&a=save&actid=$actid&id=$id",'onsubmit="return cform();"');?>
		<table>		
		<tr><td colspan="2">时段名称</td>	</tr>
		<tr><td colspan="2">
		<input name="name" id="name" class="txt" style="width:174px;" value="<?php echo $periodInfo['name'];?>"><br><br></td>	</tr>
		<tr><td colspan="2">日期范围<br></td>	</tr>
		<tr><td colspan="2">
		<input name="stime" id="stime" class="txt" style="width:75px;" onclick="showcalendar(event, this)" onfocus="showcalendar(event, this)" value="<?php if($periodInfo['stime']) echo date("Y-m-d",$periodInfo['stime']);?>"
		style="width:260px;" > ~
		<input name="etime" id="etime"  class="txt"  style="width:75px;" onclick="showcalendar(event, this)" value="<?php if($periodInfo['etime']) echo date("Y-m-d",$periodInfo['etime']);?>"
		style="width:260px;" ><br><br></td>	</tr>
		<tr><td >月范围</td></tr>		
		<tr><td ><select name="smonth" id="smonth">
		<?php if ($periodInfo) echo '<option value="'.$periodInfo['smonth'].'">'.$periodInfo['smonth'].'号</option>';?>
		<option value='1'>1号</option>
		<option value='2'>2号</option>
		<option value='3'>3号</option>
		<option value='4'>4号</option>
		<option value='5'>5号</option>
		<option value='6'>6号</option>
		<option value='7'>7号</option>
		<option value='8'>8号</option>
		<option value='9'>9号</option>
		<option value='10'>10号</option>
		<option value='11'>11号</option>
		<option value='12'>12号</option>
		<option value='13'>13号</option>
		<option value='14'>14号</option>
		<option value='15'>15号</option>
		<option value='16'>16号</option>
		<option value='17'>17号</option>
		<option value='18'>18号</option>
		<option value='19'>19号</option>
		<option value='20'>20号</option>
		<option value='21'>21号</option>
		<option value='22'>22号</option>
		<option value='23'>23号</option>
		<option value='24'>24号</option>
		<option value='25'>25号</option>
		<option value='26'>26号</option>
		<option value='27'>27号</option>
		<option value='28'>28号</option>
		<option value='29'>29号</option>
		<option value='30'>30号</option>
		<option value='31'>31号</option>
		
		</select> ~
		<select name="emonth" id="emonth">
		<?php if ($periodInfo) echo '<option value="'.$periodInfo['emonth'].'">'.$periodInfo['emonth'].'号</option>';?>
		<option value='31'>31号</option>	
		<option value='1'>1号</option>
		<option value='2'>2号</option>
		<option value='3'>3号</option>
		<option value='4'>4号</option>
		<option value='5'>5号</option>
		<option value='6'>6号</option>
		<option value='7'>7号</option>
		<option value='8'>8号</option>
		<option value='9'>9号</option>
		<option value='10'>10号</option>
		<option value='11'>11号</option>
		<option value='12'>12号</option>
		<option value='13'>13号</option>
		<option value='14'>14号</option>
		<option value='15'>15号</option>
		<option value='16'>16号</option>
		<option value='17'>17号</option>
		<option value='18'>18号</option>
		<option value='19'>19号</option>
		<option value='20'>20号</option>
		<option value='21'>21号</option>
		<option value='22'>22号</option>
		<option value='23'>23号</option>
		<option value='24'>24号</option>
		<option value='25'>25号</option>
		<option value='26'>26号</option>
		<option value='27'>27号</option>
		<option value='28'>28号</option>
		<option value='29'>29号</option>
		<option value='30'>30号</option>
		
		</select><br><br></td></tr>
		<tr><td >星期范围</td></tr>
		<tr><td >		
		<select name="sweek" id="sweek">
		<?php if ($periodInfo) echo '<option value="'.$periodInfo['sweek'].'">周'.$periodInfo['sweek'].'</option>';?>
		<option value='1'>周一</option>
		<option value='2'>周二</option>
		<option value='3'>周三</option>
		<option value='4'>周四</option>
		<option value='5'>周五</option>
		<option value='6'>周六</option>
		<option value='7'>周日</option>
		</select> ~
		<select name="eweek" id="eweek">
		<?php if ($periodInfo) echo '<option value="'.$periodInfo['eweek'].'">周'.$periodInfo['eweek'].'</option>';?>
		<option value='7'>周日</option>
		<option value='1'>周一</option>
		<option value='2'>周二</option>
		<option value='3'>周三</option>
		<option value='4'>周四</option>
		<option value='5'>周五</option>
		<option value='6'>周六</option>		
		</select><br><br></td></tr>
		<tr><td >每天时段</td></tr>
		<tr><td ><select name="sdaytime" id="sdaytime">
		<?php if ($periodInfo) echo '<option value="'.$periodInfo['sdaytime'].'">'.$periodInfo['sdaytime'].'点</option>';?>
		<option value='0'>0点</option>
		<option value='1'>1点</option>
		<option value='2'>2点</option>
		<option value='3'>3点</option>
		<option value='4'>4点</option>
		<option value='5'>5点</option>
		<option value='6'>6点</option>
		<option value='7'>7点</option>
		<option value='8'>8点</option>
		<option value='9'>9点</option>
		<option value='10'>10点</option>
		<option value='11'>11点</option>
		<option value='12'>12点</option>
		<option value='13'>13点</option>
		<option value='14'>14点</option>
		<option value='15'>15点</option>
		<option value='16'>16点</option>
		<option value='17'>17点</option>
		<option value='18'>18点</option>
		<option value='19'>19点</option>
		<option value='20'>20点</option>
		<option value='21'>21点</option>
		<option value='22'>22点</option>
		<option value='23'>23点</option>		
		</select><input name="sminute" type="text" value="<?php if ($periodInfo) {echo $periodInfo['sminute'];}else{ echo 30;}?>" style="width:40px;" class="txt"> ~ 
		<select name="edaytime" id="edaytime">
		<?php if ($periodInfo) echo '<option value="'.$periodInfo['edaytime'].'">'.$periodInfo['edaytime'].'点</option>';?>
		<option value='23'>23点</option>	
		<option value='0'>0点</option>
		<option value='1'>1点</option>
		<option value='2'>2点</option>
		<option value='3'>3点</option>
		<option value='4'>4点</option>
		<option value='5'>5点</option>
		<option value='6'>6点</option>
		<option value='7'>7点</option>
		<option value='8'>8点</option>
		<option value='9'>9点</option>
		<option value='10'>10点</option>
		<option value='11'>11点</option>
		<option value='12'>12点</option>
		<option value='13'>13点</option>
		<option value='14'>14点</option>
		<option value='15'>15点</option>
		<option value='16'>16点</option>
		<option value='17'>17点</option>
		<option value='18'>18点</option>
		<option value='19'>19点</option>
		<option value='20'>20点</option>
		<option value='21'>21点</option>
		<option value='22'>22点</option>
		</select><input name="eminute" type="text" value="<?php if ($periodInfo) {echo $periodInfo['eminute'];}else{ echo 59;}?>" style="width:40px;" class="txt"><br><br></td></tr>
		<tr><td >选择绑定属性<br></td></tr>
		<tr><td ><select name="bandattr" id="bandattr" onchange="changeBindAttr(this)">
		<?php if ($bandattr){
			if ($bandattr=='gift'){
				echo '<option value="gift">礼物</option>';
			}
			if ($bandattr=='integral'){
				echo '<option value="integral">积分</option>';
			}
		}else{
		?>
		<option value="0">请选择</option>
		<?php }?>
		<option value="integral">积分</option>
		<option value="gift">礼物</option>
		</select><br><br></td></tr>
		
		<tr><td valign="top" colspan="2" >
			<?php 
			if ($bandattr){
				if ($bandattr=='gift'){
					echo '<div id="bindgift">';
				}else{
					echo '<div id="bindgift" style="display:none;">';
				}
			}else{
				echo '<div id="bindgift" style="display:none;">';
			}
			?>
			
			<span>选择要绑定的礼物</span>
			<?php 
			if ($periodInfo){
				echo getGiftList($periodInfo['id']);
			}else{
				echo getGiftList();
			}
			?>
			</div>
			<?php 			
			if ($bandattr){
				if ($bandattr=='integral'){
					echo '<div id="bindjifen">';
				}else{
					echo '<div id="bindjifen" style="display:none;">';
				}
			}else{
				echo '<div id="bindjifen" style="display:none;">';
			}
			?>
			
			<span>选择要绑定的积分</span>
			<div id="addjifen">
				<?php 
				if ($periodInfo){
					$bindList = getActBindInfoByPid($periodInfo['id']);
					$kk=1;
					$jifennameid='';
					foreach ($bindList as $k=>$v){?>
					<div id="jifen<?php echo $kk?>" style="width:100%">	
						<div id="jifens<?php echo $kk?>"style="height:100px;width:130px;float:left">
						<select name="jifens<?php echo $kk?>" id="bind<?php echo $kk?>" class="select" onchange="showselect('<?php echo $kk?>',this);">
						<option value='<?php echo $v['tag']?>'><?php echo $v['name']?></option>
						<?php 
						$integralList = getIntegral();		
						foreach ($integralList as $key=>$value){
						?>
						<option value="<?php echo $value['tag']?>"><?php echo $value['name']?></option>
						<?php }?>
						</select><br><br><br>标签：
						<span id="tag<?php echo $kk?>"><?php echo $v['tag']?></span>	
						</div>	
						<div style="height:100px;width:300px;float:left">
						<textarea name="script<?php echo $kk?>" id="script<?php echo $kk?>" rows="6" cols="5" class="tarea" style="width:260px;"><?php echo $v['integral_script'];?></textarea><br><br>
						</div>	
						<?php 
						if ($kk>=2){?>
							 <div style="height:100px;width:50px;float:left">
							<a style="width:22px;border-width:0px;font-family:webdings;" 
							href="###" onclick="cls('jifen<?php echo $kk;?>')">r</a></div>
						<?php }
						?>				
					</div>
				<?php 
					$jifennameid = $jifennameid.$kk.',';
					$kk++;}
				}else{
				?>
				<div id="jifen1" style="width:100%">	
					<div id="jifens1"style="height:100px;width:130px;float:left">
					<select name="jifens1" id="bind1" class="select" onchange="showselect('1',this);">
					<option value='0'>请选择</option>
					<?php 
					$integralList = getIntegral();		
					foreach ($integralList as $key=>$value){
					?>
					<option value="<?php echo $value['tag']?>"><?php echo $value['name']?></option>
					<?php }?>
					</select><br><br><br>标签：
					<span id="tag1"></span>	
					</div>	
					<div style="height:100px;width:300px;float:left">
					<textarea name="script1" id="script1" rows="6" cols="5" class="tarea" style="width:260px;">积分脚本</textarea><br><br>
					</div>					
				</div>
				<?php }?>
			</div>
			<?php if ($kk){?>
			<script type="text/javascript">
			jishu=<?php echo $kk;?>
			</script>
			<?php }?>
			<a href="/admin.php?action=activity&operation=settime&a=add_bind_integral" 
		 onclick="return addBindIntegral(this.href);" class="addtr">添加绑定积分</a>
		 </div>
		</td>
		</tr>
		<tr>
		<td></td><td></td>
		</tr>
		</table>
		
		<div id="addjifendisplay" style="display:none;">
				
					<option value='0'>请选择</option>
					<?php 
					$integralList = getIntegral();		
					foreach ($integralList as $key=>$value){
					?>
					<option value="<?php echo $value['tag']?>"><?php echo $value['name']?></option>
					<?php }?>
					
					
				
			
		</div>
		<input type="text" value="<?php echo $jifennameid;?>" id="jifennameid" name="jifennameid" style="display:none;">
		<?php 
		showsubmit('submit', '提交', '', '','');
		showformfooter();
	}
}




function getActivityStatusName($status){
	switch ($status	){
		case 1:
			return '<span style="color:brown">未开始</span>';
		case 2:
			return '<span style="color:green">进行中</span>';			
		case 3:
			return '<span style="color:gray">已结束</span>';
	}
}

/**
 * 
 * 获取积分ID by tag * 
 * @param string $tag
 */
function getIntegralId($tag){
	$sql = "SELECT * FROM ".DB::table('activity_integral')." WHERE tag='$tag'";
	$rs = DB::fetch_first($sql);
	return $rs['id'];
}

/**
 * 
 * 更新活动的最后修改时间
 * @param unknown_type $actid
 * @param unknown_type $uid
 */
function upAct($actid,$uid){
	$sql = "UPDATE ".DB::table('activity')." SET uptime=".time().",upby=$uid WHERE id=$actid";
	DB::query($sql);
}
function getGiftList($pid=null){
	if ($pid){
		$sql = "SELECT * FROM ".DB::table('activity_period_bindgift')." WHERE perid = '$pid'";
		$query=DB::query($sql);
		while ($rs=DB::fetch($query))
		{
			$gift[] = $rs['giftid'];
			$giftstr.= ','.$rs['giftid'].',';
		}
		
	}
	$sql = "SELECT * FROM ".DB::table('live_gift')." WHERE 1 ";
	$query=DB::query($sql);
	$html='<div style="height:380px;OVERFLOW-X:auto;OVERFLOW:scroll;border:solid 1px #cccccc;"><table><tr>';
	$i=0;
	while (@$res = DB::fetch($query))
	{
		if ($i%10==0 ){
			$html.='</tr><tr>';
		}
		$html.='<td id="td_'.$res['giftid'].'" style="padding:2px;border:solid 1px #cccccc; ';
		if ($gift){
			if (in_array($res['giftid'], $gift)){
				$html.=' background:#E2EAF6; ';
			}
		}
		$html.='">
		<img src="/static2/images/gift/'.$res['image'].'" style="width:50px;margin-bottom:5px;"/><br>
		<input name="'.$res['giftid'].'" class="checkbox" type="checkbox" value="'.$res['giftid'].'"';
		if ($gift){
			if (in_array($res['giftid'], $gift)){
				$html.=' checked="checked" ';
			}
		}
		$html.=' onclick="setGiftid(this)"/>'.$res['name'].'</td>';
		
		$i++;
	}
	$html.='</tr></table><input id="giftid" name="giftid" style="display:none;" value="'.$giftstr.'"/></div>';
	return $html;
}
?>