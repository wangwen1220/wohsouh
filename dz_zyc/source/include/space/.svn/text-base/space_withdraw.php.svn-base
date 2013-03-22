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

$uid = $_G['uid'];
$username = $_G['username'];
//没登录
if(empty($uid)) {
	showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
}
$timet = time();
//用户余额
$userHuoShowCoin = SIPHuoCoinGetBalance($uid);
$sql = "SELECT * FROM ".DB::table('ucenter_showcoin')." WHERE uid = $uid";

$daycash = DB::fetch_first("SELECT COUNT(*) AS count FROM ".DB::table('bank_withdraw')." WHERE uid=$uid AND createtime >UNIX_TIMESTAMP()-24*3600");

//设置帐号页面
if($_GET['act']=='addbank'){
	if($_GET['id']){
		$id=$_GET['id'];
		$sql = "SELECT * FROM ".DB::table('bank_account')." WHERE id = $id  AND  uid= $uid ";
		$bankinfo = DB::fetch_first($sql);
		if($bankinfo){		
			$bankinfo['areaname'] = unserialize($bankinfo['areaname']);				
			$sql = "SELECT * FROM ".DB::table('common_district')." WHERE upid = ".$bankinfo['areaname']['level1']['id'];
			
			$query = DB::query($sql);	
			while ($res = DB::fetch($query)){
				$level2city[]=$res;
			}
		}
			
	}
	
	$sql = "SELECT * FROM ".DB::table('common_district')." WHERE level = 1";
	$query = DB::query($sql);	
	while ($res = DB::fetch($query)){
		$level1[]=$res;
	}
	
	$sql = "SELECT * FROM ".DB::table('bank')." ORDER BY orders ASC";
	$query = DB::query($sql);	
	while ($res = DB::fetch($query)){
		$bank[]=$res;
	}
	
	header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
	<root><![CDATA[';
		include_once template("home/space_withdraw_bank");
		echo ']]></root>';	
	return;
}
if ($_GET['act']=='deletebankacount'){
	if(DB::delete('bank_account','id='.$_GET['id'].' AND  uid='.$uid)){
		echo 1;
	}else{
		echo 0;
	}
	return;
}
//设置银行帐号
if ($_GET['act']=='savebankacount'){
	$account_name = trim($_POST['account_name']);	
	$level1 = trim($_POST['level1']);	
	$level1name = trim($_POST['level1name']);	
	$level2 = trim($_POST['level2']);
	$level2name = trim($_POST['level2name']);	
	$bankid = $_POST['bankid'];
	$bankname = trim($_POST['bankname']);
	$bankno = trim($_POST['bankno']);
	$isdefault = $_POST['isdefault'];
	$id = $_POST['id'];
	if (empty($account_name) or empty($level1) or empty($level2) or empty($bankname) or empty($bankno) ) {
		echo 0 ;
		return ;
	}
	$areaname = array(
	'level1'=>array('id'=>$level1,'name'=>$level1name),
	'level2'=>array('id'=>$level2,'name'=>$level2name)
	);
	
	$areaname = serialize($areaname);
	if ($isdefault=='1'){
		$sql = "UPDATE ".DB::table('bank_account')." SET `isdefault` = 0 WHERE uid = $uid";
		DB::query($sql);
	}
	
	$data = array('uid'=>$uid,'account_name'=>$account_name,'areaname'=>$areaname,'bankid'=>$bankid,'bankname'=>$bankname,'bankno'=>$bankno,'isdefault'=>$isdefault);
	if ($_GET['method']=='save'){
		if (DB::update('bank_account',$data,'id='.$id.' AND  uid='.$uid)){
			echo 1;
		}else{
			echo 0;
		}
	}elseif ($_GET['method']=='add'){
		if (DB::insert('bank_account',$data)){
			echo 1;
		}else{
			echo 0;
		}
	}
	return;
}

//获取下级城市
if($_GET['act']=='getcity'){
	$upid = $_GET['upid'];
	if (!empty($upid)){
		$sql =  "SELECT * FROM ".DB::table('common_district')." WHERE upid = $upid";
		$query = DB::query($sql);
		
		while ($res = DB::fetch($query)){
			
			$rs=$rs. '<option value="'.$res['id'].'">'.$res['name'].'</option>';
		}
		echo $_GET['jsoncallback'], '(', json_encode($rs), ')'; 
	}
	return;
}
//银行帐号列表
if($_GET['act']=='banklist'){
	$sql = "SELECT * FROM ".DB::table('bank_account')." WHERE uid = $uid ORDER BY `isdefault` DESC ";
	$query = DB::query($sql);		
	while ($res = DB::fetch($query)){
		$len=strlen($res['bankno']);
		$res['bankno'] = substr($res['bankno'],($len-4));
		for($i=0;$i<$len-4;$i++){
			$res['bankno'] = '*'.$res['bankno'];
		}	
		$res['areaname'] = unserialize($res['areaname']);	
		
		$bankInfo[] = $res;
	}
	$sql = "SELECT * FROM ".DB::table('bank_withdraw_fl')." ORDER BY huoshow_coin ";
	$query = DB::query($sql);		
	while ($res = DB::fetch($query)){	
		$fl[] = $res;
	}
	include_once template("home/space_withdraw_banklist");
	return;
}

//兑现
if ($_GET['act']=='duixian'){
	$bank_account_id = $_POST['account'];
	$huoshowcoin = $_POST['withdraw'];
	if ($huoshowcoin>0){
		$sql = "SELECT * FROM ".DB::table('bank_withdraw_fl')." WHERE huoshow_coin = '$huoshowcoin'";
		$rs = DB::fetch_first($sql);
		$rmb = $rs['rmb'];
	}else{
		echo 0;
		return;
	}
	
	if ($huoshowcoin>$userHuoShowCoin){
		echo '-1';
		return;
	}
	if(SIPHuoCoinUpdate($uid,'MRC',-$huoshowcoin,'兑现秀币：'.$huoshowcoin.'个')){
		DB::query("UPDATE ".DB::table('ucenter_showcoin')." SET consume_huo =consume_huo  + {$huoshowcoin} WHERE uid ='{$uid}'");
		$orderno = cGetOrderNo();
		$orderData = array(
		'orderno'=>$orderno,
		'uid'=>$uid,
		'username'=>$username,
		'huoshowcoin'=>$huoshowcoin,
		'rmb'=>$rmb,
		'bank_account_id'=>$bank_account_id,
		'createtime'=>$timet,
		'updatetime'=>$timet,
		'updateby'=>$uid,
		'status'=>1
		);
		
		if (DB::insert('bank_withdraw',$orderData)){
			$sql = "SELECT * FROM ".DB::table('bank_account')." WHERE id = ".$bank_account_id ." AND  uid= $uid";
			$account = DB::fetch_first($sql);
			$extData = array('widthdraw_id'=>DB::insert_id(),
			'orderno'=>$orderno,
			'uid'=>$uid,
			'account_name'=>$account['account_name'],
			'areaname'=>$account['areaname'],
			'bankid'=>$account['bankid'],
			'bankname'=>$account['bankname'],
			'bankno'=>$account['bankno']
			);
			if (DB::insert('bank_withdraw_ext',$extData)){
				echo 1;
				return;	
			}else{
				echo 0;
				return;			
			}
		}else{
			SIPHuoCoinUpdate($uid,'AFD',$huoshowcoin,'兑现秀币创建订单失败，返回秀币：'.$huoshowcoin.'个');
			DB::query("UPDATE ".DB::table('ucenter_showcoin')." SET consume_huo =consume_huo  - {$huoshowcoin} WHERE uid ='{$uid}'");
			echo 0;
			return;
		}
	}else{
		echo 0;
		return;
	}
}

//操作订单
if ($_GET['act']=='operation'){
	$id = $_GET['id'];
	
	$sql = "SELECT * FROM ".DB::table('bank_withdraw')." WHERE id = $id";	
	$orderInfo = DB::fetch_first($sql);
	if ($_GET['opt']=='confirm'){		
		$sql = "UPDATE ".DB::table('bank_withdraw')." SET  updatetime='$timet',updateby ='$uid',status=3 WHERE id=$id";
		if(DB::query($sql)){
			$logData = array('uid'=>$uid,'username'=>$username,'withdraw_id'=>$id,'bef_status'=>$orderInfo['status'],'after_status'=>'3','type'=>0,'dateline'=>time());
			if (DB::insert('bank_withdraw_log',$logData)){
				echo 1;
			}else{
				echo 0;
			}			
		}else{
			echo 0;
		}
		return;
	}
	if ($_GET['opt']=='complaint'){
		
		$sql = "UPDATE ".DB::table('bank_withdraw')." SET  updatetime='$timet',updateby ='$uid',status ='-1' WHERE id=$id";
		if(DB::query($sql)){
			$logData = array('uid'=>$uid,'username'=>$username,'withdraw_id'=>$id,'bef_status'=>$orderInfo['status'],'after_status'=>'-1','type'=>1,'info'=>$_POST['info'],'dateline'=>time(),'backinfo'=>$_POST['backinfo']);
			if (DB::insert('bank_withdraw_log',$logData)){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
		return;
	}
}
//投诉页面
if ($_GET['act']=='complaint'){
	$id=$_GET['id'];
	header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
	<root><![CDATA[';
		include_once template("home/space_withdraw_complaint");
		echo ']]></root>';
	return;
}

//兑现记录
if($_GET['act']=='record'){
	//订单详情
	if ($_GET['opt']=='info'){
		
		$id = $_GET['id'];
		$sql = "SELECT a.*,b.account_name,b.areaname,b.bankname,b.bankno FROM ".DB::table('bank_withdraw')." a LEFT JOIN ".DB::table('bank_account')." b ON a.bank_account_id = b.id WHERE a.id = $id AND a.uid = $uid ";
		$info = DB::fetch_first($sql);
		if (!empty($info['area'])){
			$info['areaname']=unserialize($info['areaname']);
			$info['createtime'] = date("Y-m-d H:i:s",$info['createtime']);
			$len=strlen($info['bankno']);
			$info['bankno'] = substr($info['bankno'],($len-4));
			for($i=0;$i<$len-4;$i++){
				$info['bankno'] = '*'.$info['bankno'];
			}	
		}else{
			$sql = "SELECT * FROM ".DB::table('bank_withdraw_ext')." WHERE widthdraw_id = ".$info['id'];
			$extInfo = DB::fetch_first($sql);
			$info['account_name'] = $extInfo['account_name'];
			$info['bankname'] = $extInfo['bankname'];
			$info['areaname']=unserialize($extInfo['areaname']);
			$info['createtime'] = date("Y-m-d H:i:s",$info['createtime']);
			$info['bankno'] = $extInfo['bankno'];
			$len=strlen($info['bankno']);
			$info['bankno'] = substr($info['bankno'],($len-4));
			for($i=0;$i<$len-4;$i++){
				$info['bankno'] = '*'.$info['bankno'];
			}	
		}
		$info['status_name'] = getWithDrawCnName($info['status']);
		
		$sql = "SELECT * FROM ".DB::table('bank_withdraw_log')." WHERE  withdraw_id = $id AND type!=0 ORDER BY dateline DESC ";
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
		
//		$sql = "SELECT * FROM ".DB::table('bank_withdraw_err')." WHERE id = $id";
//		$errorInfo = DB::fetch_first($sql);
//		if ($errorInfo){
//			$errorInfo['dateline'] =  date("Y-m-d H:i:s",$errorInfo['dateline']);
//		}
		//print_r($tousu);
		
		include_once template("home/space_withdraw_info");
		return;
	}
	
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	if($page<1) $page=1;
	$perpage = 10;
	$start = ($page-1)*$perpage;
	
	$orderLog = array();
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('bank_withdraw')." WHERE uid='$uid'");	
	if ($_GET['oderby']){
		$orderBy = $_GET['oderby'];
	}else {
		$orderBy = 'createtime';
		
	}
	if ($_GET['sc']=='desc'){
		$sc = 'asc';
	}else{
		$sc = 'desc';
	}
	$sql = "SELECT * FROM ".DB::table('bank_withdraw')." WHERE uid = $uid  ORDER BY $orderBy $sc LIMIT  $start,$perpage";
	$query = DB::query($sql);		
	while ($res = DB::fetch($query)){
		
		$res['status_name'] = getWithDrawCnName($res['status']);
		
		$res['createtime'] = date("Y-m-d H:i:s",$res['createtime']);
		
		$order[] = $res;
	}
	$multi = multi($count, $perpage, $page, "home.php?mod=space&do=withdraw&act=record");
	include_once template("home/space_withdraw_record");
	return;
	
}else{
	$sql = "SELECT * FROM ".DB::table('bank_account')." WHERE uid = $uid ORDER BY `isdefault` DESC ";
	$query = DB::query($sql);		
	while ($res = DB::fetch($query)){
		$len=strlen($res['bankno']);
		$res['bankno'] = substr($res['bankno'],($len-4));
		for($i=0;$i<$len-4;$i++){
			$res['bankno'] = '*'.$res['bankno'];
		}	
		$res['areaname'] = unserialize($res['areaname']);	
		
		$bankInfo[] = $res;
	}
	$sql = "SELECT * FROM ".DB::table('bank_withdraw_fl')." ORDER BY huoshow_coin ";
	$query = DB::query($sql);		
	while ($res = DB::fetch($query)){	
		$fl[] = $res;
	}
	$sql = "SELECT COUNT(*) AS counts FROM ".DB::table('bank_withdraw')." WHERE uid=$uid AND status=2";
	$yifukuan = DB::fetch_first($sql);	
	$yifukuanCount = $yifukuan['counts'];
	
	$sql = "SELECT COUNT(*) AS counts FROM ".DB::table('bank_withdraw')." WHERE uid=$uid AND status=-2";
	$cuowu = DB::fetch_first($sql);
	$cuowuCount = $cuowu['counts'];
	
	$sql = "SELECT a.*  FROM ".DB::table('bank_withdraw_log')
		 ." a LEFT JOIN ".DB::table('bank_withdraw')." b ON a.withdraw_id = b.id "
		 ." WHERE b.uid=$uid AND b.status=-1 AND a.type=2 GROUP BY a.withdraw_id ";
	
	$query = DB::query($sql);
	while ($res = DB::fetch($query)){	
		$huifu[] = $res;
	}
	
	$huifuCount=count($huifu);
	
	include_once template("home/space_withdraw");
}


?>