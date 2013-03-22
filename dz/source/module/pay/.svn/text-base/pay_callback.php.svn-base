<?php
/**
 * zhangchengjun
 */

$paytype = $_G['gp_paytype'];

if ($paytype == 'yibao') {#易宝支付
	include_once(DISCUZ_ROOT.'api/yibao/yeepayCommon.php');
	
	$return = getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
	$bRet = CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
	
	if($bRet){
		$money = $r3_Amt *  HUOSHOW_MONEY ;
		if($r1_Code == "1"){//支付成功		
			#需要比较返回的金额与商家数据库中订单的金额是否相等，只有相等的情况下才认为是交易成功.
			#并且需要对返回的处理进行事务控制，进行记录的排它性处理，防止对同一条交易重复发货的情况发生.
			
		    $remark = "易宝充值[订单号$r6_Order]";
		    
			if($r9_BType == "1") {#浏览器重定向
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
				
			} elseif($r9_BType == "2") {#服务器点对点通讯
				//业务逻辑
				$orderInfo = DB::fetch_first("SELECT * FROM ".DB::table('buy_order')." WHERE code='$r6_Order'");
				$uid = $orderInfo['uid'];
				$username = $orderInfo['username'];
				
				if ($orderInfo['status'] == 0) {
					DB::update('buy_order', array('status'=>1,'bdateline'=>time()),"code='{$r6_Order}'");
					$res=SIPHuoShowUpdate($uid,'AFD',$money,$remark);
					
					/*需求改变，此段代码已不用
					 * 
					 if($res) {
						$live_top_res = DB::fetch_first("SELECT * FROM ".DB::table('live_top')." WHERE uid ='{$uid}' AND cate='huoshow' LIMIT 1");
			            if($live_top_res) {
			            	 DB::query("UPDATE ".DB::table('live_top')." SET daynum=daynum + {$money} ,weeknum=weeknum + {$money} ,monthnum=monthnum + {$money}  WHERE id ='{$live_top_res['id']}'");
			            } else {
			            	DB::insert('live_top', array('cate'=>'huoshow','uid'=>$uid,'username'=>$username,'daynum'=>$money,'weeknum'=>$money,'monthnum'=>$money));
			            }			
					}*/
				}
				//end
				
				#如果需要应答机制则必须回写流,以success开头,大小写不敏感.
				echo "success";
				echo "<br />交易成功";
				echo  "<br />在线支付服务器返回";
				die;	 
			}
		} else {
			//支付失败;
		}	
	} else {
		//数据伪造;
	}
	
	header("Location: http://".$_SERVER['SERVER_NAME']."/home.php?mod=space&do=pay");
		
} elseif ($paytype == 'alipay') {#支付宝支付

}
