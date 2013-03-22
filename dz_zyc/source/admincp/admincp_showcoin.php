<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_faq.php 13088 2010-07-21 03:54:52Z monkey $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$uid = $_G['gp_uid'];
$username=$_G['gp_username'];
$dateline1=!isset($_G['gp_dateline1']) ? date('Y-m-d 00:00:00',strtotime("-1 month")) : (empty($_G['gp_dateline1']) ? '' : $_G['gp_dateline1']);
$dateline2=!isset($_G['gp_dateline2']) ? date('Y-m-d 23:59:59') : (empty($_G['gp_dateline2']) ? '' : $_G['gp_dateline2']);

cpheader();
shownav('extended', 'memu_showcoin');
showsubmenu('memu_showcoin', array());
echo "搜索:";
?>
<script src="static/js/calendar.js" type="text/javascript"></script>
<table width="998" border="0" align="center" cellpadding="0" cellspacing="0" style="color:#fff;">
    <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=showcoin" method="post">
    <tr>
      <td>UID <input type="text" name="uid" size=30  maxlength="50" value="<?php echo $uid?>"/></td>
      <td>用户名 <input type="text" name="username" size=30  maxlength="50" value="<?php echo $username?>"/></td>
      </tr>
       <tr><td>&nbsp;</td></tr>
       <tr>
        <td>时间范围 <input type="text" size=30 name="dateline1" onclick="showcalendar(event, this)" value="<? echo $dateline1;?>"/>-
        <input type="text" name="dateline2" size=30 onclick="showcalendar(event, this)" value="<? echo $dateline2;?>"/ ></td>
        <td><input type="submit" name="submit" value="搜索" /></td>
       </tr>
	</form>
  </table>
<?php
if(isset($_G['gp_submit'])){
	$act = "&dateline1=$dateline1&dateline2=$dateline2";
	if (!empty($dateline1)) {
		$dateline1 = strtotime($dateline1);
	}
	if (!empty($dateline2)) {
		$dateline2 = strtotime($dateline2);
	}
	
	
 $condition='';
 $condition1='';
	 $summary='';
		if ($uid){
			$condition = $condition."AND a.uid = '$uid' ";
			$summary .= "UID:".$uid;	
			$act .= "&uid=".$uid;
		}
		if ($username){
			$condition = $condition."AND c.username = '$username' ";
			$act .= "&username=".$username;
			$summary .= "用户人:".$username;
			$condition1=$condition1."AND c.username = '$username' ";
			
		}
      
		if (!empty($dateline1)) {
			$condition .= " AND a.dateline >= '$dateline1' ";
			$summary .= "在 ".date('Y-m-d',$dateline1);
		}
		if (!empty($dateline2)) {
			$condition .= " AND a.dateline <= '$dateline2' ";
			$summary .= "到".date('Y-m-d',$dateline2)."期间";
		}
   showformheader('showcoin');
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
		$showcoin_rs = array();
		$showcoin_rs_count=DB::result_first("SELECT COUNT(*) AS count FROM ".DB::table('ucenter_showcoin_log')." a LEFT JOIN ".DB::table('common_member')." c on a.uid=c.uid WHERE 1 ".$condition." ");
		if($showcoin_rs_count > 0) {
			showsubtitle(array('UID', '用户名','收入', '支出', '余额', '交易时间', '备注'));
	$multi = multi($showcoin_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=showcoin&submit=yes".$act);
		
			$sql = "SELECT * FROM ".DB::table('ucenter_showcoin_log')." a 
					LEFT JOIN ".DB::table('common_member')." c on a.uid=c.uid WHERE 1 ".$condition." 
					ORDER BY a.dateline DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
			$query = DB::query($sql);
			
			while($showcoin_rs = DB::fetch($query)) {
				$intype='';	
				$outtype='';
			if($showcoin_rs['type']=='in'){
				$intype=$showcoin_rs['amount'];
			}else{
				//$outtype=substr($showcoin_rs['amount'],1);	
				$outtype=$showcoin_rs['amount'];	
			}
			if(substr($outtype,0,1)=='-'){
				$outtype=substr($outtype,1);
			}
				showtablerow('', array('', ''), array(
				$showcoin_rs['uid'],
				$showcoin_rs['username'],
				$intype,
				$outtype,
				$showcoin_rs['balance'],
				date('Y-m-d H:i:s',$showcoin_rs['dateline']),
				$showcoin_rs['remark']
				));
				}
		
			showsubmit('', '', '', '', $multi);
			showtablefooter();
			showformfooter();
    //}
}else{
	echo "没有符合记录的订单！";
	
}	
if($showcoin_rs_count > 0){
	$numsql = "SELECT * FROM ".DB::table('ucenter_showcoin_log')." a 
	                LEFT JOIN ".DB::table('common_member')." c on a.uid=c.uid WHERE 1 ".$condition." 
					ORDER BY a.uid DESC";
	$numquery = DB::query($numsql);
			$innum=0;
			$outnum=0;
			
			$acount1=0;
			while($num_rs = DB::fetch($numquery)) {
			if($num_rs['type']=='in'){
			$innum=$innum+$num_rs['amount'];
			}else{
			$outnum=$outnum+substr($num_rs['amount'],1);
			}
			$acount1=$innum-$outnum;
			}
			
			$numsql1 = "SELECT sum(s.showcoin) as showcoin FROM ".DB::table('ucenter_showcoin')." s
			           LEFT JOIN ".DB::table('common_member')." c on s.uid=c.uid
					   WHERE 1 ".$condition1;
	$numquery1 = DB::query($numsql1);
	$num_rs1 = DB::fetch($numquery1);
echo "<br><br>";
echo "<h3>总计：</h3><br><span style='color:red;'> ".$summary." </span>
总共产生<span style='color:red;'> ".$showcoin_rs_count."</span> 笔用户交易，
用户总共收入<span style='color:red;'> ".$innum."</span>火币，支出<span style='color:red;'> ".$outnum."</span>火币,期间余额为<span style='color:red;'> ".$acount1."</span> 火币，
用户当前总余额为<span style='color:red;'> ".$num_rs1['showcoin']."</span>火币";
echo "<br>";
echo "说明：期间余额=用户期间收入火币-用户期间支出火币,总余额=所有用户当前总余额之和";
}
}
?>














