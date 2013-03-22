<?php 
define('CURSCRIPT', 'home');
require './../../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

require_once("class/alipay_notify.php");
require_once("alipay_config.php");

//构造通知函数信息
$alipay = new alipay_notify($partner,$key,$sign_type,$_input_charset,$transport);
//计算得出通知验证结果
$verify_result = $alipay->return_verify();

if($verify_result) {//验证成功
    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {//支付成功
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//请在这里加上商户的业务逻辑程序代码
		
		//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
	    $r6_Order           = $_GET['out_trade_no'];    //获取订单号
	    $r3_Amt         = $_GET['total_fee'];	    //获取总价格
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
		
	    header("Location: http://".$_SERVER['SERVER_NAME']."/home.php?mod=space&do=pay&op=showcoinlog");
		die;
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    } else {
    	//支付失败;
    }
} else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的return_verify函数，比对sign和mysign的值是否相等，或者检查$veryfy_result有没有返回true    
}

header("Location: http://".$_SERVER['SERVER_NAME']."/home.php?mod=space&do=pay");
?>