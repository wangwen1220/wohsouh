<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_duixian.php 16352 2011-01-07 11:00:19Z zhouyc $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if(empty($operation)){
	$operation = 'index';
}



if ($operation=='index'){
	if ($_GET['act']=='delete') {
	$id = $_GET['id'];
	$sql = "DELETE FROM ".DB::table('bank_withdraw')." WHERE id = $id ";
	//echo $sql;
	$query = DB::query($sql);
	}
	cpheader();
	shownav('extended', '兑现管理');
	showsubmenu('兑现管理', array());
	showformheader('duixian');
	showtableheader();
	
	$orderno = $_G['gp_orderno'];
	$username = $_G['gp_username'];
	$rmb = $_G['gp_rmb'];
	$status = $_G['gp_status'];
	if (!empty($_G['gp_duidate1'])) {
		$startTime = strtotime($_G['gp_duidate1'].' 00:00:01');
	}
	if (!empty($_G['gp_duidate2'])) {
		$startTime1 = strtotime($_G['gp_duidate2'].' 23:59:59');
	}
	
	echo "搜索:";
	?>
	<script src="static/js/calendar.js" type="text/javascript"></script>
	<script type="text/javascript">
		function delError(href)
		{
			if (!confirm("确定删除？注意：此操作不可恢复，请谨慎操作！")) {
				return false;
			}else{
				window.location.href= href;
			}
		}		
	</script>
	<table border="0">
		<form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=duixian" method="post">
			<tr style="background:#DEEFFB;">
				<td ><strong>流水号:</strong><input type="text" name="orderno" size="15" value="<?echo $orderno;?>"/>&nbsp;</td>
				<td ><strong>申请人:</strong><input type="text" name="username" size="15" value="<?echo $username;?>"/>&nbsp;</td>
				<td><strong>时间:</strong> 
	        	<input type="text"  size=15 name="duidate1" onclick="showcalendar(event, this)" value="<? if ($startTime){echo date('Y-m-d',$startTime);}?>"/>-
	        	<input type="text" name="duidate2" size=15 onclick="showcalendar(event, this)" value="<?if ($startTime1){echo date('Y-m-d',$startTime1);}?>"/>
	        	</td>
				<td><strong>状  态:</strong>
					<select name="status" >
						<?php if ($status){?>
					    <option value="<?php echo $status;?>"><?php echo getWithDrawCnName($status);?></option>
					     <?php }?>
					    <option value="0">--全部--</option>
					    <option value="-1" >投诉中</option>
					    <option value="-2" >失败</option>
					    <option value="1" >待审核</option>
					    <option value="2" >已汇款</option>
					    <option value="3" >已结束</option>
				    </select>&nbsp;
				</td>
				<td><input type="submit" name="submit" value="搜索" /></td>
			</tr>
		</form>
	</table>
	
	<?php
//	if(isset($_G['gp_submit'])){
	//	$act = "&startTime=$startTime&startTime1=$startTime1";
	//	if (!empty($startTime)) {
	//		$startTime = strtotime($startTime);
	//	}
	//	if (!empty(startTime1)) {
	//		startTime1 = strtotime(startTime1);
	//	}
		
		 $condition='';
		 $summary='';
			if ($orderno){
				$condition = $condition."AND orderno like '%$orderno%' ";
				$summary .= "流水号:".$orderno;	
				$act .= "&orderno=".$orderno;
			}
			if ($username){
				$condition = $condition."AND username like '%$username%' ";
				$act .= "&username=".$username;
				$summary .= "用户人:".$username;
			}
	       	if ($rmb){
				$condition = $condition."AND rmb = '$rmb' ";
				$act .= "&paytype=".$rmb;
				$summary .= "人民币:".$rmb;
			}
	       	if ($status!= '0' and !empty($status)){
				$condition = $condition."AND status = '$status' ";	
				$act .= "&status=".$status;
			}
			if (!empty($startTime)) {
				$condition .= " AND createtime >= '$startTime' ";
				$summary .= "时间:".date('Y-m-d',$startTime);
			}
			if (!empty($startTime1)) {
				$condition .= " AND createtime <= '$startTime1' ";
				$summary .= "到".date('Y-m-d',$startTime1)."期间";
			}
			
	   	showformheader('duixian');
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
	    $sql = "SELECT COUNT(*) AS count FROM ".DB::table('bank_withdraw')." WHERE 1 ".$condition."";
	   	//echo $sql;
		$order_rs_count=DB::result_first($sql);
		if($order_rs_count > 0) {
			showsubtitle(array('流水号', '申请人', '兑换金额', '创建时间','状态'));
			$multi = multi($order_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=duixian&submit=yes".$act);
			$sql = "SELECT * FROM ".DB::table('bank_withdraw')." 
			 		WHERE 1 ".$condition." 
					ORDER BY createtime DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
			//echo $sql;
			$query = DB::query($sql);
	    	while($duixian_rs = DB::fetch($query)) {			
				showtablerow('', array('', ''), array(
				$duixian_rs['orderno'],
				$duixian_rs['username'],
				$duixian_rs['rmb'].'&nbsp;人民币',
				date('Y-m-d H:i:s',$duixian_rs['createtime']),
				getWithDrawCnName($duixian_rs['status']),
				'<a href="admin.php?action=duixian&operation=view&id='.$duixian_rs['id'].'">管理</a>',
				'<a id="del" onclick="delError('."'admin.php?action=duixian&act=delete&id=".$duixian_rs['id']."'".');"  href="javascript:;">删除</a>'
				));	
	          //$dp=$dp+$duixian_rs['ptype'];
	          //$duixiansum=$duixian_rs['count'];
				}
				showsubmit('', '', '', '', $multi);
				showtablefooter();
				showformfooter();
	    //}
		}else{
			echo '<strong style="color:brown; border-top:1px dotted #DEEFFB; line-height:30px; padding-left:20px;" >没有符合记录的订单！！！</strong>';
		}
//	}
	
	?>
<?
}
if ($operation=='view'){
	cpheader();
	shownav('extended', '订单详情');
	showsubmenu('订单详情', array());	
?>

<script src="static2/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
(function($){
	window.remError = function(){
		$("#error_info").hide();
		$("#reply_info").hide();
		$("#rem_info").show();
	}
	window.showError = function(){
		$("#error_info").show();
		$("#reply_info").hide();
		$("#rem_info").hide();
		
	}
	window.hideError = function(){
		$("#error_info").hide();
		$("#reply_info").show();
		$("#rem_info").hide();
	}
	window.submitForm = function(){
		var status  = $('input[name="status"]:[checked]').val();
		if(status == 2){
			if (!confirm("确认已经汇款吗？"))
			{
			    return false;
			}
		}
		if(status == -2){
			if (!confirm("确认提交错误信息吗？"))
			{
			    return false;
			}
		}
		if(status == undefined){
			alert('请选择订单状态？');
			return false;
		}
	}
	
})(jQuery);


</script>
<?php	
	$id = $_GET['id'];
	$sql = "SELECT a.*,b.account_name,b.areaname,b.bankname,b.bankno FROM ".DB::table('bank_withdraw')." a LEFT JOIN ".DB::table('bank_account')." b ON a.bank_account_id = b.id WHERE a.id = $id";
	$info = DB::fetch_first($sql);	
	//提交错误信息
	if ($_GET['act']=='post') {
		$errInfo = $_G['gp_info'];
		$solution = $_G['gp_solution'];
		$status = $_G['gp_status'];
		//修改状态		
		$sql="UPDATE ".DB::table('bank_withdraw')." SET status ='$status' WHERE id=$id ";
		DB::query($sql);		
		if ($status=='-2' ){
			$errorData = array(
				'uid'=>$_G['uid'],'username'=>$_G['username'],'withdraw_id'=>$id,'bef_status'=>$info['status'],
				'after_status'=>'-2','type'=>3,'info'=>$errInfo,'backinfo'=>$solution,'dateline'=>time()
			);
			DB::insert('bank_withdraw_log',$errorData);
			if(SIPHuoCoinUpdate($info['uid'],'AFD',+$info['huoshowcoin'],'兑现失败返回秀币：'.$info['huoshowcoin'].'个')){
				DB::query("UPDATE ".DB::table('ucenter_showcoin')." SET consume_huo =consume_huo  - {$info['huoshowcoin']} WHERE uid ='{$info['uid']}'");			
				header("Location: admin.php?action=duixian");				
			}
		}
		
		if ($status=='2' || $status == '-1' ){
			$complaintData = array(
				'uid'=>$_G['uid'],'username'=>$_G['username'],'withdraw_id'=>$id,'bef_status'=>$info['status'],
				'after_status'=>$status,'type'=>0,'info'=>$_POST['info'],'dateline'=>time()
			);
			if (!empty($_POST['reminfo'])) {
				$complaintData['type']=2;
				$complaintData['info']=$_POST['reminfo'];
			}
			
			if (!empty($_POST['reinfo'])) {
				$complaintData['type']=2;
				$complaintData['info']=$_POST['reinfo'];
			}
			
			DB::insert('bank_withdraw_log',$complaintData);
		}

		
	}
	$sql = "SELECT a.*,b.account_name,b.areaname,b.bankname,b.bankno FROM ".DB::table('bank_withdraw')." a LEFT JOIN ".DB::table('bank_account')." b ON a.bank_account_id = b.id WHERE a.id = $id";
	$info = DB::fetch_first($sql);
	$info['areaname']=unserialize($info['areaname']);
	$info['createtime'] = date("Y-m-d H:i:s",$info['createtime']);
	$info['status_name'] = getWithDrawCnName($info['status']);
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">		       			
       			<tr style="height:30px;">
       			<td width="120">&nbsp;&nbsp;流水号：
       			</td>
       			<td>'.$info['orderno'].'
       			</td>
       			</tr>
       			<tr style="height:30px;">
       			<td width="120">&nbsp;&nbsp;创建时间：
       			</td>
       			<td>'.$info['createtime'].'
       			</td>
       			</tr>
       			<tr style="height:30px;">
       			<td width="120">&nbsp;&nbsp;使用秀币：
       			</td>
       			<td>'.$info['huoshowcoin'].'
       			</td>
       			</tr>
       			<tr style="height:30px;">
       			<td width="120">&nbsp;&nbsp;兑换金额：
       			</td>
       			<td>'.$info['rmb'].'
       			</td>
       			</tr>
       			<tr style="height:30px;">
       			<td width="120">&nbsp;&nbsp;开户人姓名：
       			</td>
       			<td>'.$info['account_name'].'
       			</td>
       			</tr>
       			<tr style="height:30px;">
       			<td width="120">&nbsp;&nbsp;银行开户城市：
       			</td>
       			<td>'.$info['areaname']['level1']['name'].' '.$info['areaname']['level2']['name'].'
       			</td>
       			</tr>
       			<tr style="height:30px;">
       			<td width="120">&nbsp;&nbsp;银行名称：
       			</td>
       			<td>'.$info['bankname'].'
       			</td>
       			</tr>
		       			
       			<tr style="height:30px;">
       			<td width="120">&nbsp;&nbsp;银行卡号：
       			</td>
       			<td>'.$info['bankno'].'
       			</td>
       			</tr>
       			<tr style="height:30px;">
       			<td width="120">&nbsp;&nbsp;提现状态：
       			</td>
       			<td>'.$info['status_name'].'
       			</td>
       			</tr>
    </table>';
?>
<br>
<a href="admin.php?action=duixian" style="color:blue"><<返回兑换列表</a>
<br>
<?	
	//状态 1 待审核  2 已经汇款  3 已经结束    -1 投诉中   -2 订单失败
	if ($info['status']==1){
		showformheader("duixian&operation=$operation&id=$id&act=post","onSubmit = 'return submitForm()'");
		showtableheader();
		echo '<br>';
		echo '<input id="remittance" type ="radio" name ="status" value="2"  onclick="hideError();">
		已汇款&nbsp;&nbsp;&nbsp;';
		echo '<input type ="radio" id="errorOrders" name ="status" 
		value="-2" onclick="showError();"><a href="javascript:;">订单错误</a>';
		echo '<div id="error_info" style="display:none;"><br>';
		echo '&nbsp;错误详情：<br>&nbsp;<textarea cols="50" rows="3" name="info"/>您的帐号信息有误，请检查后重新提交。</textarea><br><br>';
		echo '&nbsp;解决方案：<br>&nbsp;<textarea cols="50" rows="3" name="solution"/>已经将您剩余的秀币返还到您的帐号！</textarea>';
		echo '</div>';
		showsubmit('submit', '确认', '', '','');
		showformfooter();	
	}
	
	//投诉状态
	if ($info['status'] == -1){
		showformheader("duixian&operation=$operation&id=$id&act=post","onSubmit = 'return submitForm()'");
		showtableheader();
		$sql = "SELECT * FROM ".DB::table('bank_withdraw_log')." WHERE withdraw_id = $id ORDER BY id DESC";
		//echo $sql;
		$complaintss = DB::fetch_first($sql);
		echo '<br>';
		echo '<input id="remittance" type ="radio" name ="status" value="-1"  onclick="hideError();">
		回复投诉&nbsp;&nbsp;&nbsp;';
		echo '<input id="rem" type ="radio" name ="status" value="2"  onclick="remError();">
		已汇款&nbsp;&nbsp;&nbsp;';
		echo '<input type ="radio" id="errorOrders" name ="status" value="-2" onclick="showError();">
		<a href="javascript:;">订单错误</a>';
		echo '<div id="rem_info" style="display:none;"><br/>';
		echo '&nbsp;回复投诉：<br>&nbsp;<textarea cols="50" rows="3" name="reminfo"/></textarea>';
		echo '</div>';
		echo '<div id="reply_info" style="display:none;"><br>';
		//echo '&nbsp;投诉原因：<br><br>&nbsp;&nbsp;'.$complaintss['info'].'<br><br>';
		echo '&nbsp;回复投诉：<br>&nbsp;<textarea cols="50" rows="3" name="reinfo"/></textarea>';
		echo '</div>';
		echo '<div id="error_info" style="display:none;"><br>';
		echo '&nbsp;错误详情：<br>&nbsp;<textarea cols="50" rows="3" name="info"/>您的帐号信息有误，请检查后重新提交。</textarea><br><br>';
		echo '&nbsp;解决方案：<br>&nbsp;<textarea cols="50" rows="3" name="solution"/>已经将您剩余的秀币返还到您的帐号！</textarea>';
		echo '</div>';
		showsubmit('submit', '确认', '', '','');
		showformfooter();
		
	}
	
	//错误订单
	if ($info['status'] == -2){	
		$sql = "SELECT * FROM ".DB::table('bank_withdraw_log')." WHERE withdraw_id = $id ORDER BY id DESC";
		$errors = DB::fetch_first($sql);
		//echo $info['uid'];
		//echo $errors['info'].$errors['backinfo'];
		?>
		<br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #eeeeee;background: #FFE8E8;">
			<tr style="height:30px;">
				<td><h1 style="color:red;">&nbsp;&nbsp;错误详情：</h1></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;<?echo $errors['info'];?></td>
			</tr>
			<tr style="height:30px;">
				<td><h1 style="color:red;">&nbsp;&nbsp;解决方案:</h1></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;<?echo $errors['backinfo']?></td>
			</tr>
		</table>
		<?		
	}
	
	// 2 已经汇款  3 已经结束  -1 投诉中   -2 订单失败
	if ($info['status'] == 2 || $info['status'] ==3 || $info['status'] == -2 || $info['status']==-1){
		$sql= "SELECT count(*) as count FROM ".DB::table('bank_withdraw_log')." WHERE type in (1,2) and withdraw_id = $id ";
		$rem = DB::fetch_first($sql);
		if ($rem['count'] != 0){
			showtableheader('投诉记录');
			showsubtitle(array('操作人', '详情', '状态', '时间'));
			$complaints = array();
			$complaints_count=DB::result_first("SELECT COUNT(*) AS count FROM ".DB::table('bank_withdraw_log')."");
			if ($complaints_count > 0) {
				$query = DB::query("SELECT * FROM ".DB::table('bank_withdraw_log')." WHERE withdraw_id = $id AND TYPE IN(1,2) ORDER BY id DESC");
				while($complaints = DB::fetch($query)) {
					showtablerow('', array('', ''), array(
					$complaints['type'] == 2 ? 
					$complaints['username'].'&nbsp;（回复投诉）' : $complaints['username'].'&nbsp;（投诉）',
					$complaints['type'] == 2 ? 
					'原因：'.$complaints['info'] : 
					'原因：'.$complaints['info'].'&nbsp;<br/>补充：&nbsp;'.$complaints['backinfo'],
					getWithDrawCnName($complaints['bef_status'])==getWithDrawCnName($complaints['after_status']) ? 
					getWithDrawCnName($complaints['bef_status']) : 
					'由'.getWithDrawCnName($complaints['bef_status']).'变更为'.getWithDrawCnName($complaints['after_status']),
					date('Y-m-d H:i:s',$complaints['dateline']),
					));
				}
				showsubmit('', '', '', '', $multipage);
			}
		}
	}
	
	$sql = "SELECT * FROM ".DB::table('bank_withdraw_log')." WHERE  withdraw_id = $id ORDER BY dateline DESC ";
	//echo $sql;
	$query = DB::query($sql);
	
	while ($res = DB::fetch($query)){
		$res['createtime'] = date("Y-m-d H:i:s",$res['dateline']);
		
		$res['bef_status_name'] = getWithDrawCnName($res['bef_status']);
		$res['after_status_name'] = getWithDrawCnName($res['after_status']);
		
		if ($res['type']==1 ){
			$res['typename']='投诉';
			$tousu[] = $res;
		}
		if ($res['type']==2){
			$res['typename']='回复投诉';
			$tousu[] = $res;
		}
		if ($res['type']==3){
				$res['typename']='错误订单';
				$errorInfo[] = $res;
			}			
	}
	$sql = "SELECT * FROM ".DB::table('bank_withdraw_log')." WHERE id = $id";
	$errorInfo = DB::fetch_first($sql);
	if ($errorInfo){
		$errorInfo['dateline'] =  date("Y-m-d H:i:s",$errorInfo['dateline']);
	}
}












