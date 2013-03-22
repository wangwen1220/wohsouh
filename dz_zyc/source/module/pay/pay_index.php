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

$uid = empty($_G['uid']) ? 0 : intval($_G['uid']);
//没登录
if(empty($uid))
{
	showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
}


if(submitcheck('setpaysubmit')) 
{
	if($_G['gp_p3_Amt'])
	{
		/*if(!preg_match("/^[0-9]+(\.[0-9]{1})?$/",$_G['gp_p3_Amt']))
		{
			showmessage("金额只能输入正整数或带一位小数的正数","home.php?mod=spacecp&ac=pay");
		}*/
		$arr=array(
		'uid'=>$_G['uid'],
		'username'=>$_G['username'],
		'money'=>$_G['gp_p3_Amt'],
		'ip'=>$_SERVER['REMOTE_ADDR'],
		'dateline'=>time()
		);
		$id=DB::insert('buy_order', $arr,1);
		if($id)
		{
			include_once(DISCUZ_ROOT.'yibao/yeepayCommon.php') ;
			//echo $p1_MerId;exit;
			$p2_Order					= $id;
			$p3_Amt						= $_G['gp_p3_Amt'];
			$p4_Cur						= "CNY";
			$p5_Pid						= $_G['uid'];
			$p6_Pcat					= "";
			$p7_Pdesc					= "";
			$p8_Url						= "http://".$_SERVER['SERVER_NAME']."/pay.php?mod=callback";
			$pa_MP						= "";
			$pd_FrpId					= "";
			$pr_NeedResponse	        = 0;
			$hmac = getReqHmacString($p2_Order,$p3_Amt,$p4_Cur,$p5_Pid,$p6_Pcat,$p7_Pdesc,$p8_Url,$pa_MP,$pd_FrpId,$pr_NeedResponse);
			$pdata=array(
			'p0_Cmd'=>$p0_Cmd,
			'p1_MerId'=>$p1_MerId,
			'p2_Order'=>$p2_Order,
			'p3_Amt'=>$p3_Amt,
			'p4_Cur'=>$p4_Cur,
			'p5_Pid'=>$p5_Pid,
			'p6_Pcat'=>$p6_Pcat,
			'p7_Pdesc'=>$p7_Pdesc,
			'p8_Url'=>$p8_Url,
			'p9_SAF'=>$p9_SAF,
			'pa_MP'=>$pa_MP,
			'pd_FrpId'=>$pd_FrpId,
			'pr_NeedResponse'=>$pr_NeedResponse,
			'hmac'=>$hmac
			);
			//echo "<html>";
			//echo "<head>";
			//echo "<title>To YeePay Page</title>";
			//echo "</head>";
			echo '<body onload="document.yeepay.submit();">';
			echo "<form name='yeepay' action='{$reqURL_onLine}' method='post' target='_bank'>";
			echo "<input type='hidden' name='p0_Cmd'					value='{$p0_Cmd}'>";
			echo "<input type='hidden' name='p1_MerId'				value='{$p1_MerId}'>";
			echo "<input type='hidden' name='p2_Order'				value='{$p2_Order}'>";
			echo "<input type='hidden' name='p3_Amt'					value='{$p3_Amt}'>";
			echo "<input type='hidden' name='p4_Cur'					value='{$p4_Cur}'>";
			echo "<input type='hidden' name='p5_Pid'					value='{$p5_Pid}'>";
			echo "<input type='hidden' name='p6_Pcat'					value='{$p6_Pcat}'>";
			echo "<input type='hidden' name='p7_Pdesc'				value='{$p7_Pdesc}'>";
			echo "<input type='hidden' name='p8_Url'					value='{$p8_Url}'>";
			echo "<input type='hidden' name='p9_SAF'					value='{$p9_SAF}'>";
			echo "<input type='hidden' name='pa_MP'						value='{$pa_MP}'>";
			echo "<input type='hidden' name='pd_FrpId'				value='{$pd_FrpId}'>";
			echo "<input type='hidden' name='pr_NeedResponse'	value='{$pr_NeedResponse}'>";
			echo "<input type='hidden' name='hmac'						value='{$hmac}'>";
			echo "</form>";
			echo "</body>";
			//echo "</html>";
			
			/*$post_params=yibao_create_post_params($pdata);
			$ch = curl_init ();
			curl_setopt ( $ch, CURLOPT_URL, $reqURL_onLine );
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			curl_setopt ( $ch, CURLOPT_AUTOREFERER, 1 );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_params );
			//curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
			$result = curl_exec ( $ch );
			//prin_r($result);exit;
			curl_close ( $ch );*/
		}
		
	}
	else 
	{
		showmessage("请输入金额","pay.php");
	}
}
else 
{
	$huoshow_money=SIPHuoShowGetBalance($_G['uid']);
	include template('pay/pay_index');
}

function yibao_create_post_params($params) 
{
		$post_params = array ();
		foreach ( $params as $key => &$val ) 
		{
			if (is_array ( $val ))
				$val = implode ( ',', $val );
			$post_params [] = $key . '=' . urlencode ( $val );
		}
		return implode ( '&', $post_params );
}
?>