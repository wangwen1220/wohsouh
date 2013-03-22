<?php
define('CURSCRIPT', 'home');
require './../../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

require_once("class/alipay_notify.php");
require_once("alipay_config.php");

$alipay = new alipay_notify($partner,$key,$sign_type,$_input_charset,$transport);    //构造通知函数信息
$verify_result = $alipay->notify_verify();  //计算得出通知验证结果

if($verify_result) {//验证成功


    if($_POST['trade_status'] == 'TRADE_FINISHED' ||$_POST['trade_status'] == 'TRADE_SUCCESS') {    //交易成功结束
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//请在这里加上商户的业务逻辑程序代
		//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	    $r6_Order           = $_POST['out_trade_no'];	//获取支付宝传递过来的订单号
	    $r3_Amt             = $_POST['total_fee'];		//获取支付宝传递过来的总价格
	    $money = $r3_Amt *  HUOSHOW_MONEY ;
		$remark = "支付宝充值[订单号$r6_Order]";
    	
	    //业务逻辑
		$orderInfo = DB::fetch_first("SELECT * FROM ".DB::table('buy_order')." WHERE code='$r6_Order'");
		$uid = $orderInfo['uid'];
		$username = $orderInfo['username'];
	
		if ($orderInfo['status'] == 0) {
			DB::update('buy_order', array('status'=>1,'bdateline'=>time()),"code='{$r6_Order}'");
			
			$res=SIPHuoShowUpdate($uid,'AFD',$money,$remark);
			
			/*需求改变，此段代码已不用
			 * if($res) {
				$live_top_res = DB::fetch_first("SELECT * FROM ".DB::table('live_top')." WHERE uid ='{$uid}' AND cate='huoshow' LIMIT 1");
	            if($live_top_res) {
	            	 DB::query("UPDATE ".DB::table('live_top')." SET daynum=daynum + {$money} ,weeknum=weeknum + {$money} ,monthnum=monthnum + {$money}  WHERE id ='{$live_top_res['id']}'");
	            } else {
	            	DB::insert('live_top', array('cate'=>'huoshow','uid'=>$uid,'username'=>$username,'daynum'=>$money,'weeknum'=>$money,'monthnum'=>$money));
	            }			
			}*/
		}
		//end
		
		echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //log_result("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
    else {
        echo "success";		//其他状态判断。普通即时到帐中，其他状态不用判断，直接打印success。

        //调试用，写文本函数记录程序运行情况是否正常
        //log_result ("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "fail";

    //调试用，写文本函数记录程序运行情况是否正常
    //log_result ("这里写入想要调试的代码变量值，或其他运行的结果记录");
}
?>