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
//没登录
if(empty($uid)) {
	showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
}

$op = empty($_G['gp_op']) ? 'index' : $_G['gp_op'];
/*
*查看用户订单记录
*/
if ($op == 'orderlog') {
	
	//更新无效订单
	$threedays = strtotime("-3 day");
	DB::update("buy_order", array('status'=>-1), "status=0 AND uid=$uid AND dateline<$threedays");
	
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	if($page<1) $page=1;
	$perpage = 10;
	$start = ($page-1)*$perpage;
	
	$orderLog = array();
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('buy_order')." WHERE uid='$uid' OR (optype=2 && targetuid='$uid')");
	$query = DB::query("SELECT * FROM ".DB::table('buy_order')." WHERE uid='$uid' OR (optype=2 && targetuid='$uid') ORDER BY dateline DESC LIMIT $start,$perpage");
	while ($rs = DB::fetch($query)) {
		$orderLog[] = $rs;
	}
	$multi = multi($count, $perpage, $page, "home.php?mod=space&do=pay&op=orderlog");
	
	include template('home/space_pay_orderlog');
} 
/*
*查看用户消费记录
*/
elseif ($op == 'showcoinlog') {
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	if($page<1) $page=1;
	$perpage = 10;
	$start = ($page-1)*$perpage;
	
	$orderLog = array();
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('ucenter_showcoin_log')." WHERE uid='$uid'");
	$query = DB::query("SELECT * FROM ".DB::table('ucenter_showcoin_log')." WHERE uid='$uid' ORDER BY dateline DESC LIMIT $start,$perpage");
	while ($rs = DB::fetch($query)) {
		$showcoinLog[] = $rs;
	}
	$multi = multi($count, $perpage, $page, "home.php?mod=space&do=pay&op=showcoinlog");
	
	include template('home/space_pay_showcoinlog');
} 
/*
*显示用户支付中心
*/
else {
	$step = empty($_G['gp_step']) ? 1 : $_G['gp_step'];
	if(submitcheck('gotopaysubmit') || !empty($_G['gp_yibao_order'])) {
		if(in_array($_G['gp_paytype'], array('yibao', 'alipay','tenpay')) && $_G['gp_p3_Amt']) {
			if (empty($_G['gp_yibao_order'])) {
				//验证输入金额
				if (!is_numeric($_G['gp_p3_Amt']) || !in_array($_G['gp_paytype'], array('yibao','alipay','tenpay')) ) {
					showmessage("验证出错","home.php?mod=space&do=pay");
				}
				
				//生成订单
				$uid = $_G['uid'];
				$username = $_G['username'];
				$p3_Amt = $_G['gp_p3_Amt'];
				$code = cGetOrderNo();
				$paytype = $_G['gp_paytype'];
				if ($paytype == 'yibao') {
					$table_paytype = 1;
				} elseif ($paytype == 'alipay') {
					$table_paytype = 2;
				} elseif ($paytype == 'tenpay') {
					$table_paytype = 3;	
				}
				$paytype = $_G['gp_paytype'];
				$pd_Frpid = $_G['gp_pd_FrpId'];		
				$optype = 1;
				if ($optype == 1) {
					$targetuid = $_G['uid'];
					$targetusername = $_G['username'];
				} elseif ($optype == 2) {
					;
				}
				
				$ip = $_SERVER['REMOTE_ADDR'];
				$duringTime = time()-30;//解决弹出窗口会刷新页面
				$lastSamePay = DB::fetch_first("SELECT * FROM ".DB::table('buy_order')." 
					WHERE uid='$uid' AND username='$username' AND money='$p3_Amt' AND ip='$ip' 
					AND paytype='$table_paytype' AND paybank='$pd_Frpid' AND status=0 AND optype='$optype' 
					AND targetuid='$targetuid' AND targetusername='$targetusername' AND dateline>$duringTime 
					ORDER BY dateline DESC 
					LIMIT 1");
				if (!empty($lastSamePay)) {
					$id = $lastSamePay['id'];
					$code = $lastSamePay['code'];
				} else {
					$data = array(
						'uid'=>$uid,
						'username'=>$username,
						'money'=>$p3_Amt,
						'ip'=>$ip,
						'dateline'=>time(),
						'code'=>$code,
						'paytype'=>$table_paytype,
						'paybank'=>$pd_Frpid,
						'status'=>0,
						'optype'=>$optype,
						'targetuid'=>$targetuid,
						'targetusername'=>$targetusername
					);
					$id = DB::insert('buy_order', $data, 1);		
				}
			} else {
				$code = $_G['gp_yibao_order'];
				$paytype = $_G['gp_paytype'];
				$orderInfo = DB::fetch_first("SELECT * FROM ".DB::table('buy_order')." WHERE code='$code' AND status=0");
				if (!empty($orderInfo)) {
					$id = $orderInfo['id'];
					$p3_Amt = $orderInfo['money'];
					$pd_Frpid = $orderInfo['paybank'];
				} else {
					die('error');
				}
			}
			
			//跳到支付网关
			if ($id) {
				
				if ($paytype == 'yibao') {#易宝网关	
					if (!empty($_G['gp_yibao_order'])) {
						include (DISCUZ_ROOT.'api/yibao/yeepayCommon.php') ;				
						$p2_Order					= $code;
						$p3_Amt						= $p3_Amt;
						$p4_Cur						= "CNY";
						$p5_Pid						= iconv('UTF-8', 'GBK', "火币");
						$p6_Pcat					= "";
						$p7_Pdesc					= "";
						$p8_Url						= "http://".$_SERVER['SERVER_NAME']."/pay.php?mod=callback&paytype=yibao";
						$pa_MP						= "";
						$pd_FrpId					= $pd_Frpid;
						$pr_NeedResponse	        = 1;
						$hmac = getReqHmacString($p2_Order,$p3_Amt,$p4_Cur,$p5_Pid,$p6_Pcat,$p7_Pdesc,$p8_Url,$pa_MP,$pd_FrpId,$pr_NeedResponse);
						
						header("Content-type: text/html; charset=GBK"); 
						include template('home/space_pay_step3');
					} else {
						//$sHtmlText = "<form id='yibaosubmit' name='yibaosubmit' action='home.php?mod=space&do=pay&step=3' method='post' target='_bank'>";
						$sHtmlText = "<form id='yibaosubmit' name='yibaosubmit' action='home.php?mod=space&do=pay&step=3' method='post'>";						
						$sHtmlText .= "<input type='hidden' name='formhash' value='".FORMHASH."' />";
						$sHtmlText .= "<input type='hidden' name='paytype' value='yibao'>";
						$sHtmlText .= "<input type='hidden' name='yibao_order' value='{$code}'>";
						$sHtmlText .= "<input type='hidden' name='p3_Amt' value='{$p3_Amt}'>";
						$sHtmlText .= "<input type='submit' name='gotopaysubmit' value='yes' style='display:none'></form>";
						$sHtmlText .= "</form>";
						$sHtmlText .= "<script>document.forms['yibaosubmit'].submit();</script>";
						include template('home/space_pay_step4');
					}
				} elseif ($paytype == 'alipay') {#支付宝网关
					require(DISCUZ_ROOT."api/alipay/alipay_config.php");
					require(DISCUZ_ROOT."api/alipay/class/alipay_service.php");
					
					$notify_url = "http://".$_SERVER['SERVER_NAME']."/api/alipay/notify_url.php";
					$return_url = "http://".$_SERVER['SERVER_NAME']."/api/alipay/return_url.php";
					
					/*以下参数是需要通过下单时的订单数据传入进来获得*/
					//必填参数
					$out_trade_no = $code;		//请与贵网站订单系统中的唯一订单号匹配
					$subject      = '火币';	//订单名称，显示在支付宝收银台里的“商品名称”里，显示在支付宝的交易管理的“商品名称”的列表里。
					$body         = '可以用来购买礼物';	//订单描述、订单详细、订单备注，显示在支付宝收银台里的“商品描述”里
					$total_fee    = $p3_Amt;	//订单总金额，显示在支付宝收银台里的“应付总额”里
					
					//扩展功能参数——默认支付方式
					$pay_mode	  = "directPay";
					if ($pay_mode == "directPay") {
						$paymethod    = "directPay";	//默认支付方式，四个值可选：bankPay(网银); cartoon(卡通); directPay(余额); CASH(网点支付)
						$defaultbank  = "";
					} else {
						$paymethod    = "bankPay";		//默认支付方式，四个值可选：bankPay(网银); cartoon(卡通); directPay(余额); CASH(网点支付)
						$defaultbank  = $pay_mode;		//默认网银代号，代号列表见http://club.alipay.com/read.php?tid=8681379
					}
					
					//构造要请求的参数数组，无需改动
					$parameter = array(
					        "service"			=> "create_direct_pay_by_user",	//接口名称，不需要修改
					        "payment_type"		=> "1",               			//交易类型，不需要修改
					
					        //获取配置文件(alipay_config.php)中的值
					        "partner"			=> $partner,
					        "seller_email"		=> $seller_email,
					        "return_url"		=> $return_url,
					        "notify_url"		=> $notify_url,
					        "_input_charset"	=> $_input_charset,
					        "show_url"			=> $show_url,
					
					        //从订单数据中动态获取到的必填参数
					        "out_trade_no"		=> $out_trade_no,
					        "subject"			=> $subject,
					        "body"				=> $body,
					        "total_fee"			=> $total_fee,
					
					        //扩展功能参数——网银提前
					        "paymethod"			=> $paymethod,
					        "defaultbank"		=> $defaultbank,
					
					        //扩展功能参数——防钓鱼
					        "anti_phishing_key"	=> $anti_phishing_key,
							"exter_invoke_ip"	=> $exter_invoke_ip,
					
							//扩展功能参数——自定义参数
							"buyer_email"		=> $buyer_email,
					        "extra_common_param"=> $extra_common_param,
							
							//扩展功能参数——分润
					        "royalty_type"		=> $royalty_type,
					        "royalty_parameters"=> $royalty_parameters
					);

					//构造请求函数
					$alipay = new alipay_service($parameter,$key,$sign_type);
					$sHtmlText = $alipay->build_form();
					include template('home/space_pay_step4');
				} elseif ($paytype == 'tenpay'){#财付通网关		
					require_once (DISCUZ_ROOT."api/tenpay/classes/PayRequestHandler.class.php");
					require_once (DISCUZ_ROOT."api/tenpay/tenpay_config.php");
					
					$order_no = $code;
					$product_name = '火币';
					$order_price = $p3_Amt;
					$remarkexplain = '可以用来购买礼物';
					
					/* 商户号 */
					$bargainor_id = $tenpayid;
					
					/* 密钥 */
					$key = $tenpaykey;
					
					/* 返回处理地址 */
					$return_url = $tenpay_return_url;
					
					//date_default_timezone_set(PRC);
					$strDate = date("Ymd");
					$strTime = date("His");
					
					//4位随机数
					$randNum = rand(1000, 9999);
					
					//10位序列号,可以自行调整。
					$strReq = $strTime . $randNum;
					
					/* 商家订单号,长度若超过32位，取前32位。财付通只记录商家订单号，不保证唯一。 */
					$sp_billno = $order_no;
					
					/* 财付通交易单号，规则为：10位商户号+8位时间（YYYYmmdd)+10位流水号 */
					$transaction_id = $bargainor_id . $strDate . $strReq;
					
					/* 商品价格（包含运费），以分为单位 */
					$total_fee = $order_price*100;
					
					/* 商品名称 */
					$desc = $product_name;
					
					/* 创建支付请求对象 */
					$reqHandler = new PayRequestHandler();
					$reqHandler->init();
					$reqHandler->setKey($key);
					
					//----------------------------------------
					//设置支付参数
					//----------------------------------------
					$reqHandler->setParameter("bargainor_id", $bargainor_id);			//商户号
					$reqHandler->setParameter("sp_billno", $sp_billno);					//商户订单号
					$reqHandler->setParameter("transaction_id", $transaction_id);		//财付通交易单号
					$reqHandler->setParameter("total_fee", $total_fee);					//商品总金额,以分为单位
					$reqHandler->setParameter("return_url", $return_url);				//返回处理地址
					$reqHandler->setParameter("desc", $desc);							//商品名称 
					$reqHandler->setParameter("attach", $remarkexplain);				// remarkexplain
					
					//用户ip,测试环境时不要加这个ip参数，正式环境再加此参数
					$reqHandler->setParameter("spbill_create_ip", $_SERVER['REMOTE_ADDR']);
					
					//请求的URL
					$reqUrl = $reqHandler->getRequestURL();
					
					//debug信息
					//$debugInfo = $reqHandler->getDebugInfo();
					
					//echo "<br/>" . $reqUrl . "<br/>";
					//echo "<br/>" . $debugInfo . "<br/>";
					
					//重定向到财付通支付
					$reqHandler->doSend();
					include template('home/space_pay_step4');
				}
			} else {
				showmessage("订单生成失败", "home.php?mod=space&do=pay");
			}		
		} else {
			showmessage("请输入金额", "home.php?mod=space&do=pay");
		}
	} else {
		
		//银行
		$bank = array(
			array('id'=>'ICBC-NET', 'name'=>'工商银行', 'icon'=>'gongshang.gif'),
			array('id'=>'CMBCHINA-NET', 'name'=>'招商银行', 'icon'=>'zhaohang.gif'),
			array('id'=>'ABC-NET', 'name'=>'中国农业银行 ', 'icon'=>'nongye.gif'),
			array('id'=>'CCB-NET', 'name'=>'建设银行 ', 'icon'=>'jianshe.gif'),
			array('id'=>'BCCB-NET', 'name'=>'北京银行 ', 'icon'=>'beijing.gif'),
			array('id'=>'BOCO-NET', 'name'=>'交通银行 ', 'icon'=>'jiaotong.gif'),
			array('id'=>'CIB-NET', 'name'=>'兴业银行 ', 'icon'=>'xingye.gif'),
			array('id'=>'NJCB-NET', 'name'=>'南京银行 ', 'icon'=>'nanjing.gif'),
			array('id'=>'CMBC-NET', 'name'=>'中国民生银行 ', 'icon'=>'minsheng.gif'),
			array('id'=>'CEB-NET', 'name'=>'光大银行 ', 'icon'=>'guangda.gif'),
			array('id'=>'BOC-NET', 'name'=>'中国银行 ', 'icon'=>'zhongguo.gif'),
			array('id'=>'PAB-NET', 'name'=>'平安银行 ', 'icon'=>'pingan.gif'),
			array('id'=>'CBHB-NET', 'name'=>'渤海银行 ', 'icon'=>'buohai.gif'),
			array('id'=>'HKBEA-NET', 'name'=>'东亚银行 ', 'icon'=>'dongya.gif'),
			array('id'=>'NBCB-NET', 'name'=>'宁波银行 ', 'icon'=>'ningbo.gif'),
			array('id'=>'ECITIC-NET', 'name'=>'中信银行 ', 'icon'=>'zhongxin.gif'),
			array('id'=>'SDB-NET', 'name'=>'深圳发展银行 ', 'icon'=>'shenfa.gif'),
			array('id'=>'GDB-NET', 'name'=>'广东发展银行 ', 'icon'=>'guangfa.gif'),
			array('id'=>'SPDB-NET', 'name'=>'上海浦东发展银行 ', 'icon'=>'shangpufa.gif'),
			array('id'=>'POST-NET', 'name'=>'中国邮政 ', 'icon'=>'youzheng.gif'),
			array('id'=>'BJRCB-NET', 'name'=>'北京农村商业银行 ', 'icon'=>'nongcunshangye.gif'),
		);
		
		if ($step == 1) {
			$paytype = empty($_G['gp_paytype']) ? 'yibao' : $_G['gp_paytype'];
			if ($paytype == 'yibao') {
				include template('home/space_pay_step1');
			} elseif ($paytype == 'alipay') {
				include template('home/space_pay_step1_alipay');
			} elseif ($paytype == 'tenpay') {
				include template('home/space_pay_step1_tenpay');
			} elseif ($paytype == 'huocoin') {
				$coinInfo = DB::fetch_first("SELECT * FROM ".DB::table('ucenter_showcoin')." WHERE uid=".$_G['uid']);
				include template('home/space_pay_step1_huocoin');
			}
		} elseif ($step == 2) {
			$paytype = $_G['gp_paytype'];
			$pd_FrpId = $_G['gp_pd_FrpId'];
			$p3_Amt = $_G['gp_p3_Amt'];
			$p3_Amt_show = round($p3_Amt, 2);
			$huoshow = $p3_Amt * 100;
			
			foreach ($bank as $value) {
				if ($pd_FrpId == $value['id']) {
					$selectedBankInfo = $value;
					break;
				}
			}
			
			if ($paytype == 'yibao') {
				include template('home/space_pay_step2');
			} elseif ($paytype == 'alipay') {
				include template('home/space_pay_step2_alipay');
			} elseif ($paytype == 'tenpay'){ 
				include template('home/space_pay_step2_tenpay');
			}elseif ($paytype == 'huocoin') {
				$huocoin = $showcoin = floor(intval($p3_Amt));
				$curHuocoin = SIPHuoCoinGetBalance($_G['uid']);					
				if ($curHuocoin >= $huocoin) {
					//扣火币
					$remark = "兑换火币，花费 $huocoin 个秀币";
					$back = SIPHuoCoinUpdate($_G['uid'], 'RCV', -$huocoin, $remark);
					//加秀币
					if ($back) {
						$remark = "秀币兑换 $showcoin 个火币";
						$back = SIPHuoShowUpdate($_G['uid'], 'RCV', $showcoin, $remark);
						showmessage("兑换成功", "home.php?mod=space&do=pay&paytype=huocoin");die();
					}
					showmessage("兑换失败", "home.php?mod=space&do=pay&paytype=huocoin");
				} else {
					showmessage("秀币不够", "home.php?mod=space&do=pay&paytype=huocoin");
				}

			}
		} elseif ($step == 3) {
			include template('home/space_pay_step4');
		}
	}
}
?>