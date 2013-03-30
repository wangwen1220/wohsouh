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


$action = $_REQUEST["submit_post"];
$checkstate = $_REQUEST["checkstate"];
$check_uid = $_REQUEST["check_uid"];
$particulars_search = empty($_REQUEST["particulars_search"])?"yes":$_REQUEST["particulars_search"];
echo "搜索:";


?>
<script src="static/js/calendar.js" type="text/javascript"></script>
<style type="text/css">
<!--
.STYLE2 {color: #000000}
table
  {
  border-collapse:inherit;
  }

-->
</style>


<table width="998" border="0" align="center" cellpadding="0" cellspacing="0" style="color:#fff;">
    <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=coinstat" method="post">
    <tr>
      <td>UID <input type="text" name="uid" size=30  maxlength="50" value="<?php echo $uid?>"/></td>
      <td>用户名 <input type="text" name="username" size=30  maxlength="50" value="<?php echo $username?>"/></td>
      </tr>
       <tr><td>&nbsp;</td></tr>
       <tr>
        <td>时间范围 <input type="text" size=30 name="dateline1" onclick="showcalendar(event, this)" value="<? echo $dateline1;?>"/>-
        <input type="text" name="dateline2" size=30 onclick="showcalendar(event, this)" value="<? echo $dateline2;?>"/ ></td>
        <td><input type="submit" name="submit" value="搜索" />
         <input name="submit_post" type="hidden" id="submit_post" value="yes" />
		 <input name="particulars_search" type="hidden" id="particulars_search" value="<?php echo $particulars_search;?>" />
		 <input name="checkstate" type="hidden" id="checkstate" value="<?php echo $checkstate;?>" />
		 
		 </td>
       </tr>
	</form>
</table>
<?php


if($action == "yes")
{
	$act = "&dateline1=$dateline1&dateline2=$dateline2";
	
	if (!empty($dateline1)) {
		$dateline1_str = $dateline1;
		$dateline1 = strtotime($dateline1);
		
	}
	if (!empty($dateline2)) {
		$dateline2_str = $dateline2;
		$dateline2 = strtotime($dateline2);
	}
	$condition='';
	$condition1='';
	$condition3='';
	$summary='';
	if ($uid){
		$condition = $condition."AND b.uid = '$uid' ";
		$condition3 = $condition3."AND b.uid = '$uid' ";
		$summary .= "UID:".$uid;
		$act .= "&uid=".$uid;
	}
	if ($username){
		$condition = $condition."AND b.username = '$username' ";
		$condition3 = $condition3."AND b.username = '$username' ";
		$act .= "&username=".$username;
		$summary .= "用户人:".$username;
		$condition1=$condition1."AND c.username = '$username' ";

	}
/*
	if (!empty($dateline1)) {
		$condition .= " AND a.dateline >= '$dateline1' ";
		$summary .= "在 ".date('Y-m-d',$dateline1);
	}
	if (!empty($dateline2)) {
		$condition .= " AND a.dateline <= '$dateline2' ";
		$summary .= "到".date('Y-m-d',$dateline2)."期间";
	}
*/
$_G['setting']['memberperpage'] = 20;

$page = max(1, $_G['page']);
$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
$search_condition = array_merge($_GET, $_POST);
foreach($search_condition as $k => $v) {
if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
	unset($search_condition[$k]);
}
}
?>
	<br />
	<table width="998" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
	  <tr>
		<td bgcolor="#FFFFFF"><table width="210" height="28" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<form name="form_4" id="form_4" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=coinstat" method="post">
			<td align="center" <?php if($particulars_search=="yes") {?> bgcolor="#CCCCCC"<?php }?>><a href="######" onclick="document.getElementById('form_4').submit();">详细交易查询</a>
			<input name="uid" type="hidden" id="uid" value="<?php echo $uid;?>" />
		 		 <input name="username" type="hidden" id="username" value="<?php echo $username;?>" />
		  			<input name="dateline1" type="hidden" id="dateline1" value="<?php echo $dateline1_str;?>" />
		 		 <input name="dateline2" type="hidden" id="dateline2" value="<?php echo $dateline2_str;?>" />
		 		 <input name="submit_post" type="hidden" id="submit_post" value="yes" />
				 <input name="particulars_search" type="hidden" id="particulars_search" value="yes" />
			</td>
			</form>
			<form name="form_5" id="form_5" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=coinstat" method="post">
			<td align="center" <?php if($particulars_search=="no") {?> bgcolor="#CCCCCC"<?php }?>><a href="######" onclick="document.getElementById('form_5').submit();">总体交易查询</a>
			<input name="uid" type="hidden" id="uid" value="<?php echo $uid;?>" />
		 		 <input name="username" type="hidden" id="username" value="<?php echo $username;?>" />
		  			<input name="dateline1" type="hidden" id="dateline1" value="<?php echo $dateline1_str;?>" />
		 		 <input name="dateline2" type="hidden" id="dateline2" value="<?php echo $dateline2_str;?>" />
		 		 <input name="submit_post" type="hidden" id="submit_post" value="yes" />
				 <input name="particulars_search" type="hidden" id="particulars_search" value="no" />
			
			</td>
			</form>
		  </tr>
		</table></td>
	  </tr>
	  <tr>
		<td bgcolor="#FFFFFF">
		<?php
		
		if($particulars_search=="yes")
		{
				//var_dump($condition);
				$showcoin_rs = array();
				$showcoin_rs_count=DB::result_first("SELECT COUNT(*) AS count FROM pre_ucenter_showcoin a,pre_common_member b WHERE 1 AND a.uid=b.uid $condition");
		
				$sql = "SELECT a.showcoin,b.uid,b.username FROM pre_ucenter_showcoin a,pre_common_member b WHERE a.uid=b.uid  $condition
						order by a.showcoin desc	 LIMIT $start_limit, {$_G[setting][memberperpage]}";
				//var_dump($sql);
				$query = DB::query($sql);
		?>
		<table width="986" height="41" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
		  <tr>
			<td width="94" height="20" align="center" bgcolor="#FFFFFF"><span class="STYLE2">UID</span></td>
			<td width="166" align="center" bgcolor="#FFFFFF"><span class="STYLE2">用户名</span></td>
			<td width="161" align="center" bgcolor="#FFFFFF"><span class="STYLE2">查询选项</span></td>
			<td width="106" align="center" bgcolor="#FFFFFF"><span class="STYLE2">记录</span></td>
			<td width="179" align="center" bgcolor="#FFFFFF"><span class="STYLE2">时间</span></td>
			<td width="273" align="center" bgcolor="#FFFFFF">备注</td>
		  </tr>
		  
		  <?php 
		  	while($showcoin_rs = DB::fetch($query)) { 

		  ?>
		  <tr>
			<td height="20" align="center" bgcolor="#FFFFFF"><?php echo  $showcoin_rs["uid"];?></td>
			<td align="center" bgcolor="#FFFFFF"><?php echo  $showcoin_rs["username"];?></td>
			
			<td align="center" bgcolor="#FFFFFF">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="58%" align="center">
                  <?php echo  $showcoin_rs["showcoin"];?>				  </td>
				  <form name="form<?php echo  $showcoin_rs["uid"];?>" id="form<?php echo  $showcoin_rs["uid"];?>" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=coinstat&page=<?php echo $page?>" method="post">
                  <td width="42%">
                  <select name="checkstate" id="checkstate" onchange="document.getElementById('form<?php echo  $showcoin_rs["uid"];?>').submit();">
                    <option value="showcoin" <?php if($checkstate=="showcoin" && $check_uid==$showcoin_rs["uid"]) {?>selected="selected"<?php }?>>余额</option>
					<option value="in" <?php if($checkstate=="in" && $check_uid==$showcoin_rs["uid"]) { ?>selected="selected"<?php }?>>收入</option>
					<option value="out" <?php if($checkstate=="out" && $check_uid==$showcoin_rs["uid"]) { ?>selected="selected"<?php }?>>送出</option>
					<option value="buy" <?php if($checkstate=="buy" && $check_uid==$showcoin_rs["uid"]) { ?>selected="selected"<?php }?>>兑换</option>
                  </select>                  
				  </td>
				  <input name="uid" type="hidden" id="uid" value="<?php echo $uid;?>" />
		 		 <input name="username" type="hidden" id="username" value="<?php echo $username;?>" />
		  			<input name="dateline1" type="hidden" id="dateline1" value="<?php echo $dateline1_str;?>" />
		 		 <input name="dateline2" type="hidden" id="dateline2" value="<?php echo $dateline2_str;?>" />
				 <input name="check_uid" type="hidden" id="check_uid" value="<?php echo $showcoin_rs["uid"];?>" />
		 		 <input name="submit_post" type="hidden" id="submit_post" value="yes" />
			  </form>
                </tr>
              </table>			  </td>
			
			<td colspan="3" align="left" valign="top" bgcolor="#FFFFFF">
			<table width="560" border="0" cellspacing="0" cellpadding="0">
			
              <tr>
                <td width="108" height="25" align="center" >
				<?php 
				
					if( !empty($checkstate) && $checkstate!="showcoin" && !empty($check_uid) && $check_uid==$showcoin_rs["uid"])
					{
						$sql3 = "SELECT sum(a.amount) as cc FROM pre_ucenter_showcoin_log a WHERE a.TYPE='$checkstate' AND a.dateline >= '$dateline1' 
	AND a.dateline <= '$dateline2' AND a.uid='".$showcoin_rs["uid"]."' ";
						$showcoin_rs_count3=DB::result_first($sql3);
						echo "<font color='red'>统计:".$showcoin_rs_count3."</font>";
					}
					else
					{echo "-";}
				?>				</td>
                <td width="181" align="center" >-</td>
                <td width="271" align="center" >-</td>
              </tr>
			  <?php
			  	
				if( !empty($checkstate) && $checkstate!="showcoin" && !empty($check_uid) && $check_uid==$showcoin_rs["uid"])
				{
					
					if($checkstate!="buy")//兑换历史
					{
						$sql2 = "SELECT a.uid,a.dateline,a.amount,a.remark FROM pre_ucenter_showcoin_log a WHERE a.TYPE='$checkstate' AND a.dateline >= '$dateline1' AND a.dateline <= '$dateline2' AND a.uid='".$showcoin_rs["uid"]."' ";
					}
					else
					{
						$sql2 = "SELECT a.uid,a.updatetime as dateline,a.rmb as amount,a.status as remark FROM pre_bank_withdraw a WHERE  a.updatetime >= '$dateline1' AND a.updatetime <= '$dateline2' AND (a.status=2 or a.status=3) and a.uid='".$showcoin_rs["uid"]."' ";
					}
					$query2 = DB::query($sql2);
					while($showcoin_rs2 = DB::fetch($query2)) { 
			 ?>
			 	<tr>
                	<td width="108" height="25" align="center" style="border-bottom:solid 1px #000000;"><?php echo $showcoin_rs2["amount"];?></td>
               	 <td width="181" align="center" style="border-bottom:solid 1px #000000;"><?php echo date("Y-m-d H:i:s",$showcoin_rs2["dateline"]);?></td>
                	<td width="271" align="center" style="border-bottom:solid 1px #000000;"><?php echo get_remark($showcoin_rs2["remark"],$checkstate);?></td>
                </tr>
			<?php 
				}
			  }?>
            </table>
			
			</td>
		  </tr>
		  <? } ?>
		  
		</table>
		
		
		<?php 
			
		} 
		else //总体查询
		{
		
			if($dateline1>=$dateline2)
				die("日期范围错误");
			if(empty($checkstate))
				$checkstate = "in";
			if($checkstate=="buy")//兑换历史
			{
				$showcoin_rs_count=DB::result_first("SELECT count(distinct a.uid) FROM pre_bank_withdraw a,pre_common_member b WHERE a.uid=b.uid and (a.status=2 or a.status=3) and a.updatetime >= '$dateline1' AND a.updatetime <= '$dateline2' $condition");
				$sql_search = "SELECT a.uid,b.username, SUM(a.rmb)  AS amount ,a.status as type FROM pre_bank_withdraw a,pre_common_member b WHERE a.uid=b.uid  AND (a.status=2 or a.status=3) and a.updatetime >= '$dateline1' AND a.updatetime <= '$dateline2' $condition GROUP BY a.uid order by amount desc LIMIT $start_limit, {$_G[setting][memberperpage]}";
			}
			else
			{
				$showcoin_rs_count=DB::result_first("SELECT count(distinct a.uid) FROM pre_ucenter_showcoin_log a,pre_common_member b WHERE a.uid=b.uid and a.`type`='$checkstate'  AND a.dateline >= '$dateline1' AND a.dateline <= '$dateline2' $condition");
				$sql_search = "SELECT a.uid,SUM(a.amount) as amount,a.type,b.username FROM pre_ucenter_showcoin_log a,pre_common_member b  WHERE a.uid=b.uid AND a.`type`='$checkstate'  AND a.dateline >= '$dateline1' AND a.dateline <= '$dateline2' $condition GROUP BY a.uid order by amount desc LIMIT $start_limit, {$_G[setting][memberperpage]}";
			}
			
			//var_dump($sql_search);
			$query_total = DB::query($sql_search);
			
		?>
		<table width="986" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
		  <tr><td align="center" bgcolor="#FFFFFF"><span class="STYLE2">UID</span></td>
		    <td align="center" bgcolor="#FFFFFF"><span class="STYLE2">用户名</span></td>
			<form name="form_search_total" id="form_search_total" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=coinstat&page=<?php echo $page?>" method="post">
		    <td align="center" bgcolor="#FFFFFF">查询选项
		      <select name="checkstate" id="checkstate" onchange="document.getElementById('form_search_total').submit();">
                <option value="in" <?php if($checkstate=="in") { ?>selected="selected"<?php }?>>收入</option>
                <option value="out" <?php if($checkstate=="out")  { ?>selected="selected"<?php }?>>送出</option>
                <option value="buy" <?php if($checkstate=="buy" ) { ?>selected="selected"<?php }?>>兑换</option>
              </select>
			  <input name="uid" type="hidden" id="uid" value="<?php echo $uid;?>" />
		 		 <input name="username" type="hidden" id="username" value="<?php echo $username;?>" />
		  			<input name="dateline1" type="hidden" id="dateline1" value="<?php echo $dateline1_str;?>" />
		 		 <input name="dateline2" type="hidden" id="dateline2" value="<?php echo $dateline2_str;?>" />
		 		 <input name="submit_post" type="hidden" id="submit_post" value="yes" />
				 <input name="particulars_search" type="hidden" id="particulars_search" value="no" />
			  </td>
		    <td align="center" bgcolor="#FFFFFF">消费记录</td>
			</form>
		  </tr>
		  <?php
		  
		  while($show_total_record = DB::fetch($query_total)) 
		  { 
		  ?>
		  <tr>
		    <td bgcolor="#FFFFFF"><?php echo $show_total_record["uid"];?></td>
		    <td bgcolor="#FFFFFF"><?php echo $show_total_record["username"];?></td>
		    <td bgcolor="#FFFFFF"><?php echo $show_total_record["amount"];?></td>
		    <td bgcolor="#FFFFFF"><?php echo get_type($show_total_record["type"]);?></td>
	      </tr>
		  <?php
		  }
		  ?>
		</table>
		<?php }?>
		</td>
	  </tr>
	  <tr><td>
	  <?php
	  
	 // var_dump($showcoin_rs_count);
	  	$multi = multi($showcoin_rs_count,$_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=coinstat&submit_post=yes&particulars_search=$particulars_search&checkstate=$checkstate".$act);
	  	showsubmit('', '', '', '', $multi);
	  	?>
	  </td></tr>
	</table>
	<br />
<?php } ?>
<?php
die();
if(isset($_G['gp_submit']) && 1==2){
	
   showformheader('showcoin');
	showtableheader();
	
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



function get_remark($remark, $status)
{
	if($status=="buy")
	{
		switch($remark)
		{
		case 2:
			return "已汇款";
			break;
		case 3:
			return "已结束";
			break;
		default:
			return "ERROR";
		}
	}
	else
		return $remark;
}

function get_type($type)
{
	switch($type)
	{
		case 'in':
			return "收入";
			break;
		case 'out':
			return "消费";
			break;
		case '2':
			return "已汇款";
			break;
		case '3':
			return "已结束";
			break;
		default:
			return "ERROR";
	}
	return NULL;
}
?>














