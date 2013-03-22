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
     $shouuid=$_G['gp_shouuid'];
	 $username=$_G['gp_username'];
	 $songuid=$_G['gp_songuid'];
	 $song=$_G['gp_song'];
	 $gift=$_G['gp_gift'];
$litime1=!isset($_G['gp_litime1']) ? date('Y-m-d 00:00:00',strtotime("-1 month")) : (empty($_G['gp_litime1']) ? '' : $_G['gp_litime1']);
$litime2=!isset($_G['gp_litime2']) ? date('Y-m-d 23:59:59') : (empty($_G['gp_litime2']) ? '' : $_G['gp_litime2']);

cpheader();
shownav('extended', 'memu_jilu');
showsubmenu('memu_jilu', array());
require_once libfile('function/live');
$giftListTmp = cGetGiftAll();
$giftList = array();
echo "搜索:";
?>
<script src="static/js/calendar.js" type="text/javascript"></script>
<table width="998" border="0" align="center" cellpadding="0" cellspacing="0" style="color:#fff;">
    <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=jilu" method="post">
    <tr>
      <td>收礼人UID <input type="text" name="shouuid" size=30  maxlength="50" value="<?php echo $shouuid?>"/></td>
      <td>收礼人 <input type="text" name="username" size=30  maxlength="50" value="<?php echo $username?>"/></td>
      <td>送礼人UID： <input type="text" name="songuid" size=30  maxlength="50" value="<?php echo $songuid?>"/></td>
      <td>送礼人： <input type="text" name="song" size=30  maxlength="50" value="<?php echo $song?>"/></td>
      
      </tr>
      <tr><td>&nbsp;</td></tr>
       <tr>
       <td>礼物<select name="gift">
      <option value="<?php echo $gift;?>"><?php echo $gift; ?></option>
      <option value="">all</option>
       <?php  foreach ($giftListTmp as $key=>$value) {
	echo "<option value=\"$value[giftid]\" $selected >$value[name]</option>\n";
	$i++;
       }
?>
      </select></td>
        <td colspan="2">送礼时间 <input type="text" name="litime1"  onclick="showcalendar(event, this)"  size="30" value="<? echo $litime1;?>"/>-
        <input type="text" name="litime2" size="30"  onclick="showcalendar(event, this)" value="<? echo $litime2;?>"/ ></td>
        <td colspan="1"><input type="submit" name="submit" value="搜索" /></td>
       </tr>
	</form>
  </table>
<?php
if(isset($_G['gp_submit'])){
	$act = "&litime1=$litime1&litime2=$litime2";
	if (!empty($litime1)) {
		$litime1 = strtotime($litime1);
	}
	if (!empty($litime2)) {
		$litime2 = strtotime($litime2);
	}
	
	
 $condition='';
	 $summary='';
		if ($shouuid){
			$condition = $condition."AND a.targetuid = '$shouuid' ";
			$summary.="收礼人UID:".$shouuid;	
			$act .= "&shouuid=".$shouuid;
		}
		if ($username){
			$condition = $condition."AND a.targetusername = '$username' ";
			$summary.="用户收礼人:".$username;
			$act .= "&username=".$username;
		}
       if ($songuid){
			$condition = $condition."AND a.uid = '$songuid' ";
			$summary.="送礼人UID:".$songuid;
			$act .= "&songuid=".$songuid;
		}
       if ($song){
			$condition = $condition."AND a.username = '$song' ";
			$summary.="用户送礼人:".$song;
			$act .= "&song=".$song;
		}
       if ($gift){
			$condition = $condition."AND a.giftid = '$gift' ";	
			$act .= "&gift=".$gift;
		}
		
		
		if (!empty($litime1)) {
			$condition .= " AND a.dateline >= '$litime1' ";
			$summary.="在".date('Y-m-d',$litime1);
			
		}
		if (!empty($litime2)) {
			$condition .= " AND a.dateline <= '$litime2' ";
			$summary.="到".date('Y-m-d',$litime2)."期间";
		}
	showformheader('jilu');
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
		$jilu_res = array();
		$jilu_res_count=DB::result_first("SELECT COUNT(*) AS count FROM ".DB::table('live_gift_log')." a WHERE 1 and action=1 ".$condition." ");
		if($jilu_res_count > 0) {
		showsubtitle(array('suid', 'susername', 'sluid', 'slusername', 'liwu', 'shoulang', 'danwei', 'zongj', 'shijian'));
	$multi = multi($jilu_res_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=jilu&submit=yes".$act);
		
			$sql = "SELECT * FROM ".DB::table('live_gift_log')." a 
					WHERE 1 and action=1 ".$condition." 
					ORDER BY a.dateline DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
			
			$query = DB::query($sql);
			
			while($jilu_res = DB::fetch($query)) {
				$giftname=$jilu_res['giftname'];
				$chpr=$jilu_res['giftprice']*$jilu_res['num'];
				showtablerow('', array('', ''), array(
				$jilu_res['targetuid'],
				$jilu_res['targetusername'],
				$jilu_res['uid'],
				$jilu_res['username'],
				$jilu_res['giftname'],
				$jilu_res['num'],
				$jilu_res['giftprice'],
				$chpr,
				date('Y-m-d H:i:s',$jilu_res['dateline'])
		
				));
				
         // $sum=$sum+$chpr;
				}
		if ($gift){
			$summary.=$giftname;
		     }
			showsubmit('', '', '', '', $multi);
			showtablefooter();
			showformfooter();
    }
	
if($jilu_res_count > 0){
$numsql = "SELECT * FROM ".DB::table('live_gift_log')." a 
					WHERE 1 and action=1 ".$condition." 
					ORDER BY a.dateline DESC";
			
			$query2 = DB::query($numsql);	
			while($s_res = DB::fetch($query2)) {
				$sum1=$s_res['giftprice']*$s_res['num'];
				 $sum=$sum+$sum1;
			}
echo "<br><br>";
echo "<h3>总计：</h3><br><span style='color:red;'> ".$summary." </span>
总共产生<span style='color:red;'> ".$jilu_res_count." </span>次礼物记录；总价值为<span style='color:red;'> ".$sum." </span>火币。";
echo "<br><br><h3>礼物汇总:</h3>";
showtableheader();
showsubtitle(array('礼物', '总数量', '单价', '总价值'));
$summ="SELECT giftname,sum(num) AS num,sum(giftprice) as sumprice,giftprice from ".DB::table('live_gift_log')." a WHERE 1 and action=1 ".$condition." group by giftid  ";
$query1 = DB::query($summ);
			   $giftprice=0;
				while($summ_res = DB::fetch($query1)) {
				//$giftprice=$giftprice+$summ_res['giftprice'];
				showtablerow('', array('', ''), array(
				$summ_res['giftname'],
				$summ_res['num'],
				$summ_res['giftprice'],
				$summ_res['giftprice']*$summ_res['num']
				));
				
			}
//showtablerow('', array('', ''), array( $sumliwu,$liwu));
showtablefooter();
}else{
	echo "<span style='color:red;'>没有符合条件的记录！！！</span>";
}
}
?>














