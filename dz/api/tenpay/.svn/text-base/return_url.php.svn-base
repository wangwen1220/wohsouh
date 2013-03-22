<?php
define('CURSCRIPT', 'home');
require './../../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

//---------------------------------------------------------
//财付通即时到帐支付应答（处理回调）示例，商户按照此文档进行开发即可
//---------------------------------------------------------

require_once ("./classes/PayResponseHandler.class.php");
require_once ("tenpay_config.php");

/* 密钥 */
$key = $tenpaykey;

/* 创建支付应答对象 */
$resHandler = new PayResponseHandler();
$resHandler->setKey($key);

//判断签名
if($resHandler->isTenpaySign()) {
	
	//交易单号
	$transaction_id = $resHandler->getParameter("transaction_id");
	
	//商户订单号
	$sp_billno = $resHandler->getParameter("sp_billno");
	
	//金额,以分为单位
	$total_fee = $resHandler->getParameter("total_fee");
	
	//支付结果
	$pay_result = $resHandler->getParameter("pay_result");
	
	if( "0" == $pay_result ) {
	
		//------------------------------
		//处理业务开始
		//------------------------------
		
		//注意交易单不要重复处理
		//注意判断返回金额
		
		//充值所得的火秀币
		$money = $total_fee / 100 *  HUOSHOW_MONEY ;
	
		//定单的备注信息
		$remark = "财付通充值[订单号$sp_billno]";
		
		$orderInfo = DB::fetch_first("SELECT * FROM ".DB::table('buy_order')." WHERE code='$sp_billno'");
		$uid = $orderInfo['uid'];
		$username = $orderInfo['username'];
	
		if ($orderInfo['status'] == 0) {
			//更新定单状态
			DB::update('buy_order', array('status'=>1,'bdateline'=>time()),"code='$sp_billno'");
			
			//更新秀币
			$res=SIPHuoShowUpdate($uid,'AFD',$money,$remark);
			
		}
				
		//------------------------------
		//处理业务完毕
		//------------------------------	
		
		//调用doShow, 打印meta值跟js代码,告诉财付通处理成功,并在用户浏览器显示$show页面.
		$resHandler->doShow($tenpay_show_url);
	
	} else {
		//当做不成功处理
		echo "<br/>" . "支付失败" . "<br/>";
	}
	
} else {
	echo "<br/>" . "认证签名失败" . "<br/>";
}

//echo $resHandler->getDebugInfo();

?>