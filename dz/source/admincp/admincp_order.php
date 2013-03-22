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
$optype=$_G['gp_optype'];
$paytype=$_G['gp_paytype'];
$ptype= isset($_G['gp_ptype']) ? $_G['gp_ptype'] : 'all';
$dateline1=!isset($_G['gp_dateline1']) ? date('Y-m-d 00:00:00',strtotime("-1 month")) : (empty($_G['gp_dateline1']) ? '' : $_G['gp_dateline1']);
$dateline2=!isset($_G['gp_dateline2']) ? date('Y-m-d 23:59:59') : (empty($_G['gp_dateline2']) ? '' : $_G['gp_dateline2']);
$bdateline1=!isset($_G['gp_bdateline1']) ? date('Y-m-d 00:00:00',strtotime("-1 month")) : (empty($_G['gp_bdateline1']) ? '' : $_G['gp_bdateline1']);
$bdateline2=!isset($_G['gp_bdateline2']) ? date('Y-m-d 23:59:59') : (empty($_G['gp_bdateline2']) ? '' : $_G['gp_bdateline2']);

//输出HTML页面头部
cpheader();
//菜单
shownav('extended', 'memu_order');
showsubmenu('memu_order', array());
echo "搜索:";
?>
<script src="static/js/calendar.js" type="text/javascript"></script>
<table width="998" border="0" align="center" cellpadding="0" cellspacing="0" style="color:#fff;">
    <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=order" method="post">
    <tr>
      <td width="40%">UID <input type="text" name="uid" size=30  maxlength="50" value="<?php echo $uid?>"/></td>
      <td width="40%">用户名 <input type="text" name="username" size=30  maxlength="50" value="<?php echo $username?>"/></td>
      <td width="20%"></td>
      </tr>
      <tr>
      <td>操作类型 
      <select name="optype">
		  <?php if(!empty($optype)){?>
          <option value="<?php echo $optype;?>"><?php if($optype==1){ echo '购入自用';}elseif($optype==2){echo '赠送他人';} ?></option>
          <?php }?> 
          <option value="" <?php if(empty($optype)){echo 'selected';}?>>所有操作类型</option>>
          <option value="1" >购入自用</option>
          <option value="2" >赠送他人</option>
      </select>
      </td>
      <td>支付方式 
      <select name="paytype">
		  <?php if(!empty($paytype)){?>
          <option value="<?php echo $paytype;?>"><?php if($paytype==1){ echo '易宝';}elseif($paytype==2){echo '支付宝';}elseif($paytype==3){echo '财付通';} ?></option>
          <?php }?>
          <option value="" <?php if(empty($paytype)){echo 'selected';}?>>所有支付方式</option>>
          <option value="1" >易宝</option>
          <option value="2" >支付宝</option>
          <option value="3" >财付通</option>
      </select>
      </td>
        <td>订单状态 
      <select name="ptype" onchange="showpaidtime(this.value);">
      <?php if($ptype <> "all"){?>
          <option value="<?php echo $ptype;?>"><?php if($ptype==0){ echo '等待支付';}elseif($ptype==1){echo '成功支付';}elseif($ptype==-1){echo '过期废单';} ?></option>
          <?php }?>
          <option value="all" <?php if($ptype=='all'){echo 'selected';}?>>所有订单状态</option>>
          <option value="0" >等待支付</option>
          <option value="1" >成功支付</option>
          <option value="-1" >过期废单</option>
      </select>
      <script type="text/javascript">
	  	function showpaidtime(val){
			if(val=='1'){
				document.getElementById("paidtime").style.display="block";	
			}else{
				document.getElementById("paidtime").style.display="none";	
			}
	  	}
	  </script>
        </td>
        </tr>
        <tr>
        <td>下单时间 <input type="text"  size=22 name="dateline1" onclick="showcalendar(event, this)" value="<? echo $dateline1;?>"/>-
        <input type="text" name="dateline2" size=22 onclick="showcalendar(event, this)" value="<? echo $dateline2;?>"/></td>
        <td><div id="paidtime" <?php if($ptype<>1){echo 'style="display:none;"';}else{echo 'style="display:block;"';}?>>成交时间
        <input type="text" name="bdateline1" size=22 onclick="showcalendar(event, this)" value="<? echo $bdateline1;?>"/>-
         <input type="text" name="bdateline2" size=22 onclick="showcalendar(event, this)" value="<? echo $bdateline2; ?>"/></div></td>
        <td><input type="submit" name="submit" value="搜索" /></td>
       </tr>
	</form>
  </table>
<?php
if(isset($_G['gp_submit'])){
	$act = "&dateline1=$dateline1&dateline2=$dateline2&bdateline1=$bdateline1&bdateline2=$bdateline2";
	if (!empty($dateline1)) {
		$dateline1 = strtotime($dateline1);
	}
	if (!empty($dateline2)) {
		$dateline2 = strtotime($dateline2);
	}
	if (!empty($bdateline1)) {
		$bdateline1 = strtotime($bdateline1);
	}
	if (!empty($bdateline2)) {
		$bdateline2 = strtotime($bdateline2);
	}
	
	$condition='';
	$summary='';
	if ($uid){
		$condition = $condition."AND a.uid = '$uid' ";
		$summary .= "UID:".$uid;	
		$act .= "&uid=".$uid;
	}
	if ($username){
		$condition = $condition."AND a.username = '$username' ";
		$act .= "&username=".$username;
		$summary .= "用户人:".$username;
		
	}
	if ($paytype){
		$condition = $condition."AND a.paytype = '$paytype' ";
		$act .= "&paytype=".$paytype;
		//$summary .= "支付方式:".$paytype;
	}
	if ($optype){
		$condition = $condition."AND a.optype = '$optype' ";
		$act .= "&optype=".$optype;
		//$summary .= "操作类型:".$optype;
	}
	if ($ptype <> 'all'){
		$condition = $condition."AND a.status = '$ptype' ";	
		$act .= "&ptype=".$ptype;
		//$summary .= "订单状态:".$ptype;
		}
	if (!empty($dateline1)) {
		$condition .= " AND a.dateline >= '$dateline1' ";
		$summary .= "下单时间:".date('Y-m-d',$dateline1);
	}
	if (!empty($dateline2)) {
		$condition .= " AND a.dateline <= '$dateline2' ";
		$summary .= "到".date('Y-m-d',$dateline2)."期间 ";
	}
	if (!empty($bdateline1) and ($ptype == 1)) {
		$condition .= " AND a.bdateline >= '$bdateline1' ";
		$summary.= "成交时间:".date('Y-m-d',$bdateline1);
	}
	if (!empty($bdateline2) and ($ptype == 1)) {
		$condition .= " AND a.bdateline <= '$bdateline2' ";
		$summary.= "到".date('Y-m-d',$bdateline2)."期间 ";
	}

	showformheader('order');
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
	$order_rs = array();
	$order_rs_count=DB::result_first("SELECT COUNT(*) AS count FROM ".DB::table('buy_order')." a WHERE 1 ".$condition." ");
	if($order_rs_count > 0) {
		showsubtitle(array('UID', '用户名', '订单号', '操作类型', '业务名称','交易金额', '支付方式', '下单时间', '成交时间', '订单状态'));
		$multi = multi($order_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=order&submit=yes".$act);
	
		$sql = "SELECT * FROM ".DB::table('buy_order')." a 
				WHERE 1 ".$condition." 
				ORDER BY a.dateline DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
		$query = DB::query($sql);
		
		while($order_rs = DB::fetch($query)) {
			//定单操作的用途
			if($order_rs['optype']==1){ 
				$optype="购入自用";
			}else{
				$optype="赠送他人";
			}
			//使用的支付方式
			if($order_rs['paytype']==1){ 
				$paytype="易宝";
			}elseif($order_rs['paytype']==2){
				$paytype="支付宝";
			}elseif($order_rs['paytype']==3){
				$paytype="财付通";
			}
			//定单的状态
			if($order_rs['status']==1){ 
				$ptype="成功支付";		
			}elseif ($order_rs['status']==0){
				$ptype="等待支付";			
			}else{
				$ptype="过期废单";
			}
			//成交时间
			if(!empty($order_rs['bdateline'])){
				$bdate = date('Y-m-d H:i:s',$order_rs['bdateline']);
			}else{
				$bdate = '';	
			}
			showtablerow('', array('', ''), array(
			$order_rs['uid'],
			$order_rs['username'],
			$order_rs['code'],
			$optype,
			"火币",
			$order_rs['money'],
			$paytype,			
			date('Y-m-d H:i:s',$order_rs['dateline']),
			$bdate,
			$ptype
			));
			
			$dp=$dp+$order_rs['ptype'];
			  
		}	
		showsubmit('', '', '', '', $multi);
		showtablefooter();
		showformfooter();
		
	}else{
		echo '<font style="color:#FF0000;">没有符合记录的订单！</font>';
		
	}	
	if($order_rs_count > 0){
		$cp=0;
		$dp=0;
		$gp=0;
		$ss=0;
		$sdp=0;
		$sgp=0; 
		$sqlo = "SELECT * FROM ".DB::table('buy_order')." a 
				WHERE 1 ".$condition." 
				ORDER BY a.uid DESC";
		$query1 = DB::query($sqlo);
		
		while($o_rs = DB::fetch($query1)) {
		if($o_rs['status']==1){ 
			$cp=$cp+1;
			$ss=$ss+$o_rs['money'];
			
		}elseif($o_rs['status']==0){
			$dp=$dp+1;
			$sdp=$sdp+$o_rs['money'];
		}else{
			$gp=$gp+1;
			$sgp=$sgp+$o_rs['money'];
		}
		$cz=$cz+$o_rs['money'];
		}
		echo "<br><br>";
		echo "<h3>总计：</h3><br><span style='color:red;'> ".$summary." </span>
		总共有<span style='color:red;'> ".$order_rs_count."</span> 订单，
		其中成功订单<span style='color:red;'> ".$cp."</span>，过期订单<span style='color:red;'> ".$gp."</span>，
		待付订单<span style='color:red;'> ".$dp."</span>。总交易金额<span style='color:red;'> ".$cz."</span> RMB，
		其中成功交易<span style='color:red;'> ".$ss."</span> RMB，作废交易<span style='color:red;'>".$sgp."</span> RMB，
		待付交易<span style='color:red;'>".$sdp."</span> RMB。";	  
	}
}
?>














