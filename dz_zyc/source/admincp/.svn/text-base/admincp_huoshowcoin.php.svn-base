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

require_once libfile('function/delete');

//每页列表数量
$_G['setting']['memberperpage'] = 20;
//获取当前要显示的列表页
$page = max(1, intval($_G['page']));
$start_limit = ($page - 1) * $_G['setting']['memberperpage'];


$search_condition = array_merge($_GET, $_POST);

//过滤非搜索条件参数
foreach($search_condition as $k => $v) {
	if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page','sortbyhuocoin')) || $v === '') {
		unset($search_condition[$k]);
	}
}

if($operation == 'search') {
	if(!submitcheck('submit', 1)) {		
		showsubmenu('menu_huoshowcoin', array());		
		showsearchform('search');		

	}else{
		$condition='';
		$parameter = '';
		$orderby = '';
		if ($search_condition['uid']){
			$searchUid = $search_condition['uid'];
			$condition = $condition."AND a.uid = '$searchUid' ";
		}
		if ($search_condition['username']){
			$searchUsername = $search_condition['username'];
			$condition = $condition."AND a.username = '$searchUsername' ";
		}
		//按火币数量排序
		if(!empty($_GET['sortbyhuocoin'])){
			//升序
			if($_GET['sortbyhuocoin']=='asc'){
				$parameter = '&sortbyhuocoin=desc';
				$orderby = 'ORDER BY b.showcoin ASC';
			}elseif($_GET['sortbyhuocoin']=='desc'){
			//降序
				$parameter = '&sortbyhuocoin=asc';
				$orderby = 'ORDER BY b.showcoin DESC';
			}
		}else{
			$parameter = '&sortbyhuocoin=desc';
		}	
		shownav('extended', 'menu_huoshowcoin');
		showsubmenu('menu_huoshowcoin', array());
		showtableheader();
		echo '<a href="admin.php?action=huoshowcoin&operation=search" style="">重新搜索</a>';
				
		showsubtitle(
			array(
				'uid', 
				'username', 
				'<a href="'.ADMINSCRIPT.'?action=huoshowcoin&operation=search&submit=yes&page='.$page.$parameter.'">火币(排序)</a>', 
				'operation'
			)
		);
		$problem_res = array();
		$problem_res_count=DB::result_first("SELECT COUNT(*) AS count FROM ".DB::table('ucenter_members')." a WHERE 1 ".$condition." ");
		if($problem_res_count > 0) {
			$multipage = multi($problem_res_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=huoshowcoin&operation=search&submit=yes&sortbyhuocoin=".$_GET['sortbyhuocoin']);
			$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
			$sql = "SELECT a.uid,a.username,b.showcoin FROM ".DB::table('ucenter_members')." a 
					LEFT JOIN ".DB::table('ucenter_showcoin')." b ON a.uid = b.uid 
					WHERE 1 ".$condition." GROUP BY a.uid ".$orderby. 
					"  LIMIT $start_limit, {$_G[setting][memberperpage]}";
			//echo $sql;
			$query = DB::query($sql);
			
			while($problem_res = DB::fetch($query)) {
				
				showtablerow('', array('', ''), array(
				$problem_res['uid'],
				$problem_res['username'],
				intval($problem_res['showcoin']),
				'<a href="admin.php?action=huoshowcoin&operation=chongzhi&username='.urlencode($problem_res['username']).'&uid='.$problem_res['uid'].'">充值</a>'
				));

			}
			showsubmit('', '', '', '', $multipage);
			showtablefooter();
			showformfooter();
		}
	}
      
}
if($operation == 'chongzhi') {
	if(!submitcheck('submit', 1)) {	
		showformheader("huoshowcoin&operation=$operation", "onSubmit=\"if($('updatecredittype1') && $('updatecredittype1').checked && !window.confirm('$lang[members_reward_clean_alarm]')){return false;} else {return true;}\"");
		showtableheader();
		showsetting('username', 'username', $_G['gp_username'], 'text','readonly');
		showsetting('uid', 'uid', $_G['gp_uid'], 'text','readonly');
		showsetting('火币', 'ucenter_showcoin', '', 'text');
		?>
		<strong>充值类型:</strong><br><br>
		<select name="type" >
			<?php if ($type){?>
		    <option value="<?php echo $type;?>"><?php echo getPrepaidPhone($type);?></option>
		     <?php }?>
		    <option value="choose">--请选择--</option>
		    <option value="AFD" >用户充值</option>
		    <option value="NFD" >内部增发</option>
		    <option value="CFD" >员工奖金</option>
		    <option value="UFD" >主播奖金</option>
	    </select>
	    <?
		showsetting('充值原因', 'remark', '', 'textarea');
		showsubmit('submit', '充值', '', '','');
		
		showtagfooter('tbody');
	}else{
		$czUername = $search_condition['username'];
		$czUid = $search_condition['uid'];
		$czShowcoin = $search_condition['ucenter_showcoin'];	
		$remark = $search_condition['remark'];
		$type = $search_condition['type'];
		if(trim($remark)=='' or trim($czShowcoin)=='' or trim($type) == 'choose'){
			if(trim($remark)==''){
				echo '<span style="color:red;font-size:15px;font-weight:bold;">充值失败：充值原因必须填写</span> <br><br> ';
			}
			if(trim($czShowcoin)==''){
				echo '<span style="color:red;font-size:15px;font-weight:bold;">充值失败：火币数量必须填写</span> <br><br> ';
			}
			if(trim($type)== 'choose'){
				echo '<span style="color:red;font-size:15px;font-weight:bold;">充值类型：充值类型必须选择</span> <br><br> ';
			}
		}else{
			if(SIPHuoShowUpdate($czUid,$type,$czShowcoin,'管理员:'.$_G['username'].' 充值火币：'.$czShowcoin.' 充值原因：'.$remark)){
				echo '<span style="color:green;font-size:15px;font-weight:bold;">充值成功</span> <br><br>';
			}else{
				echo '<span style="color:red;font-size:15px;font-weight:bold;">充值失败</span> <br><br> ';
			}			
			
		}
		echo '<a href="admin.php?action=huoshowcoin&operation=chongzhi&username='.$_G['gp_username'].'&uid='.$_G['gp_uid'].'">继续充值</a> ';
		echo '<a href="admin.php?action=huoshowcoin&operation=search&submit=yes&username='.$_G['gp_username'].'&uid='.$_G['gp_uid'].'">返回</a> ';
		
	}
}

function showsearchform($operation = '') {
	global $_G, $lang;
	showformheader("huoshowcoin&operation=$operation", "onSubmit=\"if($('updatecredittype1') && $('updatecredittype1').checked && !window.confirm('$lang[members_reward_clean_alarm]')){return false;} else {return true;}\"");
	showtableheader();
	showsetting('members_search_user', 'username', $_G['gp_username'], 'text');
	showsetting('members_search_uid', 'uid', $_G['gp_uid'], 'text');
	
	showtagfooter('tbody');
	showsubmit('submit', $operation == 'clean' ? 'members_delete' : 'search', '', '');
	
}
