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
	cpheader();
	shownav('extended', '财务接口');
	
	$startTime = !isset($_G['gp_duidate1']) ? strtotime($_G['gp_duidate1'].' 00:00:01',strtotime("-1 day")): strtotime($_G['gp_duidate1'].' 00:00:01');
	$startTime1 = !isset($_G['gp_duidate2']) ? strtotime($_G['gp_duidate2'].' 00:00:01',strtotime("-1 day")): strtotime($_G['gp_duidate2'].' 23:59:59');
	?>
	<script src="static/js/calendar.js" type="text/javascript"></script>
	<table border="0">
		<form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=financial" method="post">
		<tr style="background:#DEEFFB;">
			<td><strong>请您选择时间段：</strong>
				<input type="text"  size=11 name="duidate1" onclick="showcalendar(event, this)" value="<? echo date('Y-m-d',$startTime)?>"/> - 
	        	<input type="text" name="duidate2" size=11 onclick="showcalendar(event, this)" value="<? echo date('Y-m-d',$startTime1)?>"/>&nbsp;&nbsp;&nbsp;&nbsp;
	        	</td>
			<td><input type="submit" name="submit" value="搜索" /></td>
		</tr>
		</form>
	</table>
	<?
	showtableheader();
	if (!empty($startTime)) {
		$condition .= " AND createtime >= $startTime ";
		$summary .= "时间:".date('Y-m-d',$startTime);
	}
	if (!empty($startTime1)) {
		$condition .= " AND createtime <= $startTime1 ";
		$summary .= "到".date('Y-m-d',$startTime1)."期间";
	}
	
	$sql_fi  = "SELECT count(*) as count, counts,amount,sum(AFD_times) as AFD_times,sum(AFD) as AFD,sum(TFD_times) as TFD_times,sum(TFD) as TFD,sum(BFD_times) as BFD_times,sum(BFD) as BFD,sum(MRD_times) as MRD_times, sum(MRD) as MRD,sum(RCV_times) as RCV_times,sum(RCV) as RCV,sum(NFD) as NFD,sum(CFD) as CFD,sum(UFD) as UFD,sum(MRC_times) as MRC_times,sum(ABS(MRC)) as MRC,SUM(BMR) AS BMR FROM ".DB::table('ucenter_huocoin_stat_log')." WHERE 1 ".$condition;
	$query   = DB::query($sql_fi);
	$fi_rs   = DB::fetch($query);
	$sql1_xi = "SELECT count(*) as count, counts,amount,sum(AFD_times) as AFD_times,sum(AFD) as AFD,sum(MRD_times) as MRD_times,sum(MRD) as MRD,sum(MRC_times) as MRC_times,sum(MRC) as MRC,sum(RCV_times) as RCV_times,sum(RCV) as RCV FROM ".DB::table('ucenter_xiucoin_stat_log')." WHERE 1 ".$condition;
	$query1  = DB::query($sql1_xi);
	$xi_rs   = DB::fetch($query1);
	$sql2_gi = "SELECT count(*) as count, counts,amount,sum(MRD_times) as MRD_times,sum(MRD) as MRD,sum(MRC_times) as MRC_times,sum(MRC) as MRC FROM ".DB::table('ucenter_gift_stat_log')." WHERE 1 ".$condition;
	$query2  = DB::query($sql2_gi);
	$gi_rs   = DB::fetch($query2);
	$sql     = "SELECT * FROM ".DB::table('ucenter_huocoin_stat_log')." WHERE 1 ".$condition;
	//echo $sql;
	$query = DB::query($sql);
	//$finan_rs = DB::fetch($query)
	?>
	<table border="1">
		<tr style="background:#DEEFFB;">
			<td width="20">日期</td><td width="80">火币非零的帐户数</td><td>火币余额</td><td>充值次数</td><td>充值总额</td><td>任务次数</td>
			<td>任务总额</td><td>宝箱次数</td><td>宝箱总额</td><td>卖出礼物次数</td><td>卖出礼物总额</td><td>秀币转火币次数</td>
			<td>秀币转火币总额</td><td>内部增发</td><td>员工奖金</td><td>主播奖金</td><td>购买礼物次数</td><td>购买礼物总额</td>
			<td>购买房间火币总额</td>
		</tr>
		<?php while ($finan_rs = DB::fetch($query)) {?>
			<tr>
			<td><? echo date("Y-m-d",$finan_rs['createtime']);?></td>
			<td align="right"><? echo $finan_rs['counts']?></td>
			<td align="right"><? echo $finan_rs['amount']?></td>
			<td align="right"><? echo $finan_rs['AFD_times']?></td>
			<td align="right"><? echo $finan_rs['AFD']?></td>
			<td align="right"><? echo $finan_rs['TFD_times']?></td>
			<td align="right"><? echo $finan_rs['TFD']?></td>
			<td align="right"><? echo $finan_rs['BFD_times']?></td>
			<td align="right"><? echo $finan_rs['BFD']?></td>
			<td align="right"><? echo $finan_rs['MRD_times']?></td>
			<td align="right"><? echo $finan_rs['MRD']?></td>
			<td align="right"><? echo $finan_rs['RCV_times']?></td>
			<td align="right"><? echo $finan_rs['RCV']?></td>
			<td align="right"><? echo $finan_rs['NFD']?></td>
			<td align="right"><? echo $finan_rs['CFD']?></td>
			<td align="right"><? echo $finan_rs['UFD']?></td>
			<td align="right"><? echo $finan_rs['MRC_times']?></td>
			<td align="right"><? echo abs($finan_rs['MRC'])?></td>
			<td align="right"><? echo $finan_rs['BMR']?></td>
			
		</tr>
		<? } if($fi_rs['count'] >= 2) {?>
		<tr><td colspan="18"></td></tr>
		<tr style="background:#DEEFFB;">
			<td align="right" colspan=3>合计</td>
			<td align="right"><? echo $fi_rs['AFD_times']?></td>
			<td align="right"><? echo $fi_rs['AFD']?></td>
			<td align="right"><? echo $fi_rs['TFD_times']?></td>
			<td align="right"><? echo $fi_rs['TFD']?></td>
			<td align="right"><? echo $fi_rs['BFD_times']?></td>
			<td align="right"><? echo $fi_rs['BFD']?></td>
			<td align="right"><? echo $fi_rs['MRD_times']?></td>
			<td align="right"><? echo $fi_rs['MRD']?></td>
			<td align="right"><? echo $fi_rs['RCV_times']?></td>
			<td align="right"><? echo $fi_rs['RCV']?></td>
			<td align="right"><? echo $fi_rs['NFD']?></td>
			<td align="right"><? echo $fi_rs['CFD']?></td>
			<td align="right"><? echo $fi_rs['UFD']?></td>
			<td align="right"><? echo $fi_rs['MRC_times']?></td>
			<td align="right"><? echo $fi_rs['MRC']?></td>
			<td align="right"><? echo $fi_rs['BMR']?></td>
		</tr>
		<? } ?>
	</table>
	<br>
	<?
		$sql1 = "SELECT * FROM ".DB::table('ucenter_xiucoin_stat_log')." WHERE 1 ".$condition;
		$query1 = DB::query($sql1);
	?>
	<table border="1">
		<tr style="background:#DEEFFB;">
			<td width="20">日期</td><td>秀币非零的帐户数</td><td>秀币余额</td><td>用户充值次数</td><td>用户充值总额</td><td>卖出礼物次数</td><td>卖出礼物总额</td>
			<td>提现次数</td>	<td>提现总额</td><td>秀币转火币次数</td><td>秀币转火币总额</td>
		</tr>
		<?php while ($xiucoin_rs = DB::fetch($query1)) {?>
		<tr>
			<td><? echo date("Y-m-d",$xiucoin_rs['createtime']);?></td>
			<td align="right"><? echo $xiucoin_rs['counts']?></td>
			<td align="right"><? echo $xiucoin_rs['amount']?></td>
			<td align="right"><? echo $xiucoin_rs['AFD_times']?></td>
			<td align="right"><? echo $xiucoin_rs['AFD']?></td>			
			<td align="right"><? echo $xiucoin_rs['MRD_times']?></td>
			<td align="right"><? echo $xiucoin_rs['MRD']?></td>
			<td align="right"><? echo $xiucoin_rs['MRC_times']?></td>
			<td align="right"><? echo $xiucoin_rs['MRC']?></td>
			<td align="right"><? echo $xiucoin_rs['RCV_times']?></td>
			<td align="right"><? echo $xiucoin_rs['RCV']?></td>
		</tr>
		<? } if($xi_rs['count'] >= 2) {?>
		<tr><td colspan="18"></td></tr>
		<tr style="background:#DEEFFB;">
			<td align="right" colspan=3>合计</td>
			<td align="right"><? echo $xi_rs['AFD_times']?></td>
			<td align="right"><? echo $xi_rs['AFD']?></td>
			<td align="right"><? echo $xi_rs['MRD_times']?></td>
			<td align="right"><? echo $xi_rs['MRD']?></td>
			<td align="right"><? echo $xi_rs['MRC_times']?></td>
			<td align="right"><? echo $xi_rs['MRC']?></td>
			<td align="right"><? echo $xi_rs['RCV_times']?></td>
			<td align="right"><? echo $xi_rs['RCV']?></td>
		</tr>
		<? }?>
	</table>
	<br>
	<?
		$sql2 = "SELECT * FROM ".DB::table('ucenter_gift_stat_log')." WHERE 1 ".$condition;
		$query2 = DB::query($sql2);
	?>
	<table border="1">
		<tr style="background:#DEEFFB;">
			<td width="20">日期</td><td>礼物非零的帐户数</td><td>礼物总额</td><td>购买礼物次数</td>
			<td>购买礼物总额</td><td>卖出礼物次数</td><td>卖出礼物总额</td>
		</tr>
		<?php while ($gift_rs = DB::fetch($query2)) {?>
		<tr>
			<td><? echo date("Y-m-d",$gift_rs['createtime']);?></td>
			<td align="right"><? echo $gift_rs['counts']?></td>
			<td align="right"><? echo $gift_rs['amount']?></td>
			<td align="right"><? echo $gift_rs['MRD_times']?></td>
			<td align="right"><? echo $gift_rs['MRD']?></td>
			<td align="right"><? echo $gift_rs['MRC_times']?></td>
			<td align="right"><? echo $gift_rs['MRC']?></td>
		</tr>
		<? } if($gi_rs['count'] >= 2) {?>
		<tr><td colspan="18"></td></tr>
		<tr style="background:#DEEFFB;">
			<td align="right" colspan=3>合计</td>
			<td align="right"><? echo $gi_rs['MRD_times']?></td>
			<td align="right"><? echo $gi_rs['MRD']?></td>
			<td align="right"><? echo $gi_rs['MRC_times']?></td>
			<td align="right"><? echo $gi_rs['MRC']?></td>
		</tr>
		<? } ?>
	</table>
	<?

	//增发总额（内部增发 + 员工奖金 + 主播奖金 + 任务总额 + 宝箱总额）
	$shares  = $fi_rs['NFD']+$fi_rs['CFD']+$fi_rs['UFD'] + $fi_rs['TFD'] + $fi_rs['BFD'];
	//用户获得火币总额=充值总额 + 增发总额（内部增发 + 员工奖金 + 主播奖金 + 任务总额 + 宝箱总额）+ 卖出礼物 + 秀币转火币
	$in_huo  = $fi_rs['AFD'] + $shares + $fi_rs['MRD'] + $fi_rs['RCV'];
	//用户支出火币总额=购买礼物+购买房间
	$out_huo = $fi_rs['MRC'] + $fi_rs['BMR'];
	//用户获得秀币总额=用户充值 + 卖出礼物
	$in_xiu  = $xi_rs['AFD'] + $xi_rs['MRD'];
	//用户支出秀币总额=秀币提现 + 秀币转火币
	$out_xiu = $xi_rs['MRC'] + $xi_rs['RCV'];
	//损耗总额 = 卖出礼物总额 + 秀币提现 / 10
	$sumloss = $gi_rs['MRC'] + $xi_rs['MRC']/10;
	//营业总额=充值总额 - 增发总额 - 秀币提现 + 损耗总额	
	$turnover= $fi_rs['AFD'] - $shares - $xi_rs['MRC'] + $sumloss;
	//充值比例=充值总额/用户获得火币总额
	$prepaid = floor((($fi_rs['AFD'] * 100 ) / $in_huo) * 100 ) / 100 ;
	//增发比例=增发总额/用户获得火币总额
	$percentage = floor((($shares * 100) / $in_huo) * 100)/100;
	//提现比例=秀币提现/（用户支出火币总额 + 用户支出秀币总额）
	$carry   = floor((($xi_rs['MRC'] * 100) / ($out_huo + $out_xiu)) * 100) / 100;

	echo '<br><br>';
	echo "用户获得火币总额 = 充值总额 + 增发总额（内部增发 + 员工奖金 + 主播奖金 + 任务总额 + 宝箱总额）+ 卖出礼物 + 秀币转火币 = <span style='color:red;'>".$in_huo."</span><br>";
	echo "用户支出火币总额 = 购买礼物 + 购买房间 = <span style='color:red;'>".$out_huo."</span><br><br>";
	echo "用户获得秀币总额 = 用户充值 + 卖出礼物 = <span style='color:red;'>".$in_xiu."</span><br>";
	echo "用户支出秀币总额 = 秀币提现 + 秀币转火币 = <span style='color:red;'>".$out_xiu."</span><br><br>";

	echo "增发总额 = 内部增发 + 员工奖金 + 主播奖金 + 任务总额 + 宝箱总额 = <span style='color:red;'>".$shares."</span><br>";
	echo "损耗总额 = 卖出礼物 + 秀币提现／10 = <span style='color:red;'>".$sumloss."</span><br>";
	echo "营业总额 = 充值总额 - 增发总额 - 秀币提现 + 损耗总额 = <span style='color:red;'>".$turnover."</span><br>";
	echo "增发比例 = 增发总额／用户获得火币总额 = <span style='color:red;'>".$percentage."%</span><br>";
	echo "充值比例 = 充值总额／用户获得火币总额 = <span style='color:red;'>".$prepaid."%</span><br>";	
	echo "提现比例 = 秀币提现／（用户支出火币总额 + 用户支出秀币总额）= <span style='color:red;'>".$carry."%</span><br><br>";

	$yestday_year  = date("Y",strtotime("-1 day"));
	$yestday_month = date("m",strtotime("-1 day"));
	$yestday_day   = date("d",strtotime("-1 day"));
	$yestday_start = mktime( 0, 0, 0,$yestday_month,$yestday_day,$yestday_year);
	$yestday_end   = mktime(23,59,59,$yestday_month,$yestday_day,$yestday_year);
	$sql    = "select amount from pre_ucenter_xiucoin_stat_log where createtime>='$yestday_start' and createtime<='$yestday_end'";
	$yes_rs = DB::fetch(DB::query($sql));
	$yes_xiu_amount = $yes_rs["amount"]; //昨天的秀币余额
	$sql    = "select amount from pre_ucenter_huocoin_stat_log where createtime>='$yestday_start' and createtime<='$yestday_end'";
	$yes_rs = DB::fetch(DB::query($sql));
	$yes_huo_amount = $yes_rs["amount"]; //昨天的火币余额
	$sql    = "select amount from pre_ucenter_gift_stat_log where createtime>='$yestday_start' and createtime<='$yestday_end'";
	$yes_rs = DB::fetch(DB::query($sql));
	$yes_gift_amount= $yes_rs["amount"]; //昨天的礼物总数
	$gift_ratio = floor((($yes_gift_amount * 100) / ($yes_huo_amount + $yes_gift_amount)) * 100) / 100;
	echo "火币总额 = 昨日火币余额 + 昨日礼物总额 = <span style='color:red;'>".(intval($yes_huo_amount)+intval($yes_gift_amount))."</span><br>";
	echo "秀币总额 = 昨日秀币余额 = <span style='color:red;'>".$yes_xiu_amount."</span><br>";
	echo "礼物比例 = 昨日礼物总额／（昨日火币余额 + 昨日礼物总额）= <span style='color:red;'>".$gift_ratio."%</span><br>";
}
