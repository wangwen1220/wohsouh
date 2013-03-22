<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$uid = $_G['gp_uid'];
$username=$_G['gp_username'];
$dateline1=!isset($_G['gp_dateline1']) ? date('Y-m-d 00:00:00',strtotime("-1 month")) : (empty($_G['gp_dateline1']) ? '' : $_G['gp_dateline1']);
$dateline2=!isset($_G['gp_dateline2']) ? date('Y-m-d 23:59:59') : (empty($_G['gp_dateline2']) ? '' : $_G['gp_dateline2']);
cpheader();
shownav('extended', 'memu_giftwatch');
showsubmenu('memu_giftwatch', array());

$action = $_REQUEST["submit_post"];
$checkstate = $_REQUEST["checkstate"];
$check_uid = $_REQUEST["check_uid"];
$target_uid = $_REQUEST["target_uid"];
$gift_id = empty($_REQUEST["gift_id"])?1:$_REQUEST["gift_id"];
$particulars_search = empty($_REQUEST["particulars_search"])?"yes":$_REQUEST["particulars_search"];
echo "搜索:";

?>
<script src="static/js/calendar.js" type="text/javascript"></script>
<style type="text/css">
<!--
.STYLE2 {color: #000000}
table
  {
  border-collapse:inherit;
  }
td { font-size:12px;}
-->
</style>
<script language="javascript">

function submit_total_gift(ele,target_uid,curretn_uid)
{
	//不是某一个用户
	if(target_uid==curretn_uid)
	{
		$ele_arr = document.getElementById('td_gift_'+curretn_uid).childNodes;
		for(i=0;i<$ele_arr.length;i++)
		{
			//alert($ele_arr[i].id+":"+$ele_arr[i].value);
			if($ele_arr[i].id=="target_uid")
				$ele_arr[i].value = "";
		}
	}
	document.getElementById('form_'+curretn_uid).submit();
}
</script>
<table width="998" border="0" align="center" cellpadding="0" cellspacing="0" style="color:#fff;">
    <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=giftwatch" method="post">
       
       <tr>
        <td>时间范围 <input type="text" size=30 name="dateline1" onclick="showcalendar(event, this)" value="<? echo $dateline1;?>"/>-
        <input type="text" name="dateline2" size=30 onclick="showcalendar(event, this)" value="<? echo $dateline2;?>"/ ></td>
        <td><input type="submit" name="submit" value="搜索" />
         <input name="submit_post" type="hidden" id="submit_post" value="yes" />
		 <input name="particulars_search" type="hidden" id="particulars_search" value="<?php echo $particulars_search;?>" />
		 <input name="checkstate" type="hidden" id="checkstate" value="<?php echo $checkstate;?>" />
		 <input name="$gift_id" type="hidden" id="$gift_id" value="<?php echo $$gift_id;?>" />
		 		 </td>
       </tr>
	</form>
</table>

<?php


if($action == "yes")
{
	$act = "&dateline1=$dateline1&dateline2=$dateline2";
	
	if (!empty($dateline1)) {
		$dateline1_str = $dateline1;
		$dateline1 = strtotime($dateline1);
		
	}
	if (!empty($dateline2)) {
		$dateline2_str = $dateline2;
		$dateline2 = strtotime($dateline2);
	}
	$condition='';
	$condition1='';
	$condition3='';
	$summary='';
	/*
	if ($uid){
		$condition = $condition."AND b.uid = '$uid' ";
		$condition3 = $condition3."AND b.uid = '$uid' ";
		$summary .= "UID:".$uid;
		$act .= "&uid=".$uid;
	}
	if ($username){
		$condition = $condition."AND b.username = '$username' ";
		$condition3 = $condition3."AND b.username = '$username' ";
		$act .= "&username=".$username;
		$summary .= "用户人:".$username;
		$condition1=$condition1."AND c.username = '$username' ";

	}
	if (!empty($dateline1)) {
		$condition .= " AND a.dateline >= '$dateline1' ";
		$summary .= "在 ".date('Y-m-d',$dateline1);
	}
	if (!empty($dateline2)) {
		$condition .= " AND a.dateline <= '$dateline2' ";
		$summary .= "到".date('Y-m-d',$dateline2)."期间";
	}
*/
$_G['setting']['memberperpage'] = 20;

$page = max(1, $_G['page']);
$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
$search_condition = array_merge($_GET, $_POST);
/*
foreach($search_condition as $k => $v) {
if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
	unset($search_condition[$k]);
}
}
*/

?>
	<br />
	<table width="988" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <td align="left" valign="top" bgcolor="#FFFFFF"><table width="300" border="0" cellspacing="0" cellpadding="0">
			<form name="form_4" id="form_4" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=giftwatch" method="post">
			<td align="center" <?php if($particulars_search=="yes") {?> bgcolor="#CCCCCC"<?php }?>><a href="######" onclick="document.getElementById('form_4').submit();">礼物总排行查询</a>
		  			<input name="dateline1" type="hidden" id="dateline1" value="<?php echo $dateline1_str;?>" />
		 		 <input name="dateline2" type="hidden" id="dateline2" value="<?php echo $dateline2_str;?>" />
		 		 <input name="submit_post" type="hidden" id="submit_post" value="yes" />
				 <input name="particulars_search" type="hidden" id="particulars_search" value="yes" />
			</td>
			</form>
			<form name="form_5" id="form_5" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=giftwatch" method="post">
			<td align="center" <?php if($particulars_search=="no") {?> bgcolor="#CCCCCC"<?php }?>><a href="######" onclick="document.getElementById('form_5').submit();">单种礼物排行查询</a>
		  			<input name="dateline1" type="hidden" id="dateline1" value="<?php echo $dateline1_str;?>" />
		 		 <input name="dateline2" type="hidden" id="dateline2" value="<?php echo $dateline2_str;?>" />
		 		 <input name="submit_post" type="hidden" id="submit_post" value="yes" />
				 
				 <input name="particulars_search" type="hidden" id="particulars_search" value="no" />
			
			</td>
			</form>
        </table></td>
      </tr>
	  	<?php
		
		if($particulars_search=="yes")
		{
				//var_dump($condition);
				$showcoin_rs = array();
				$showcoin_rs_count=DB::result_first("SELECT COUNT(distinct a.uid) AS count FROM pre_live_gift_log a WHERE a.dateline >= '$dateline1' 
	AND a.dateline <= '$dateline2' and action='2'");
		
				$sql = "SELECT a.uid,a.username,SUM(a.num) AS `sum`,SUM(a.num*a.giftprice) AS price FROM pre_live_gift_log a WHERE a.dateline >= '$dateline1' 
	AND a.dateline <= '$dateline2' and a.action='2' GROUP BY a.uid ORDER BY `sum` DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
				//var_dump($sql);
				$query = DB::query($sql);
		?>
      <tr>
        <td align="left" valign="top" bgcolor="#FFFFFF"><table width="976" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="125" align="center" bgcolor="#FFFFFF">收礼人UID</td>
            <td width="106" align="center" bgcolor="#FFFFFF">收礼人</td>
            <td width="184" align="center" bgcolor="#FFFFFF">礼物</td>
            <td width="184" align="center" bgcolor="#FFFFFF">数量</td>
            <td width="185" align="center" bgcolor="#FFFFFF">单价</td>
            <td width="185" align="center" bgcolor="#FFFFFF">总价值</td>
          </tr>
		  <?php
		  
		  while($showcoin_rs2 = DB::fetch($query)) { 
		  ?>
          <tr>
            <td bgcolor="#FFFFFF"><?php echo $showcoin_rs2['uid'];?></td>
            <td bgcolor="#FFFFFF"><?php echo $showcoin_rs2['username'];?></td>
            <td colspan="4" align="left" valign="top" bgcolor="#FFFFFF"><table width="741" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr>
			    <form name="form_<?php echo $showcoin_rs2['uid'];?>" id="form_<?php echo $showcoin_rs2['uid'];?>" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=giftwatch&page=<?php echo $page;?>" method="post">
                <td width="184" height="20" align="center" id="td_gift_<?php echo $showcoin_rs2['uid'];?>">全部&nbsp;&nbsp;<a href="####" onclick="submit_total_gift(this,<?php echo empty($target_uid)?"null":$target_uid;?>,<?php echo $showcoin_rs2['uid'];?>);"><?php if($target_uid==$showcoin_rs2['uid']) echo "收起"; else echo"查看明细";?></a>
				<input name="dateline1" type="hidden" id="dateline1" value="<?php echo $dateline1_str;?>" />
		 		 <input name="dateline2" type="hidden" id="dateline2" value="<?php echo $dateline2_str;?>" />
		 		 <input name="submit_post" type="hidden" id="submit_post" value="yes" />
				 <input name="particulars_search" type="hidden" id="particulars_search" value="yes" />
				 <input name="target_uid" type="hidden" id="target_uid" value="<?php echo $showcoin_rs2['uid'];?>" />
				</td>
				
				</form>
                <td width="184" align="center"><?php echo $showcoin_rs2['sum'];?></td>
                <td width="184" align="center">-</td>
                <td width="184" align="center"><?php echo $showcoin_rs2['price'];?></td>
				
				<?php if(!empty($target_uid) && $target_uid==$showcoin_rs2['uid'])
					{
						$sql_total = "SELECT a.giftname,a.giftid,a.giftprice,SUM(a.num) AS `sum`,SUM(a.num*a.giftprice) as price FROM pre_live_gift_log a WHERE uid='$target_uid' and action='2' and a.dateline >= '$dateline1' 
	AND a.dateline <= '$dateline2'  GROUP BY giftid order by `sum` desc";
						$query3 = DB::query($sql_total);
						while($showcoin_rs3 = DB::fetch($query3)) { 
				?>
              </tr>
			  	<td width="184" height="20" align="center"><?php echo $showcoin_rs3["giftname"];?></td>
				<form name="form_7_<?php echo $showcoin_rs3['giftid'];?>" id="form_7_<?php echo $showcoin_rs3['giftid'];?>" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=giftwatch" method="post">
				<td width="184" align="center"><a href="####" onclick="document.getElementById('form_7_<?php echo $showcoin_rs3['giftid'];?>').submit();"><?php echo $showcoin_rs3['sum'];?></a>
				
				<input name="dateline1" type="hidden" id="dateline1" value="<?php echo $dateline1_str;?>" />
		 		 <input name="dateline2" type="hidden" id="dateline2" value="<?php echo $dateline2_str;?>" />
		 		 <input name="submit_post" type="hidden" id="submit_post" value="yes" />
				 <input name="particulars_search" type="hidden" id="particulars_search" value="no" />
				 <input name="target_uid" type="hidden" id="target_uid" value="<?php echo $showcoin_rs2['uid'];?>" />
				 <input name="gift_id" type="hidden" id="gift_id" value="<?php echo $showcoin_rs3['giftid'];?>" /> 
				</td>
				</form>
				
                <td width="184" align="center"><?php echo $showcoin_rs3['giftprice'];?></td>
                <td width="184" align="center"><?php echo $showcoin_rs3['price'];?></td>
			  <tr>
			  <?php
			  			}
			 		 }
			  ?>
			  </tr>
            </table></td>
          </tr>
		  <?php
		  }
		  ?>
        </table></td>
      </tr>
	  <?php }
	  else //单种查询
	  {
	  	//礼物列表
		$gift_sql = "SELECT giftid,`name` FROM pre_live_gift ORDER BY `name` ASC";
		$gift_query = DB::query($gift_sql);
		
		$condition = "";
		if(!empty($target_uid))
		{
		//var_dump($gift_id);
		//var_dump($_REQUEST["gift_id"]);
			$showcoin_rs_count=DB::result_first("select count(*)  AS count from  pre_live_gift_log a WHERE a.dateline >= '$dateline1' AND a.dateline <= '$dateline2' AND a.giftid='$gift_id' and a.uid='$target_uid' and action='2'");
			$gift_signal_sql = "select a.giftname,a.uid,a.username, a.targetuid,a.targetusername,a.num as `sum`,a.giftprice,a.giftprice*a.num as price,a.dateline from  pre_live_gift_log a WHERE a.dateline >= '$dateline1' AND a.dateline <= '$dateline2' AND a.giftid='$gift_id' and a.uid='$target_uid' and a.action=2 order by a.dateline DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
		}	
		else
		{
			$showcoin_rs_count=DB::result_first("select count(distinct uid)  AS count FROM pre_live_gift_log a WHERE a.dateline >= '$dateline1' AND a.dateline <= '$dateline2' AND a.giftid='$gift_id' and action='2'");
			$gift_signal_sql = "SELECT a.giftname,a.uid,a.username,a.targetuid,a.targetusername,SUM(a.num) AS `sum`,SUM(a.num*a.giftprice) AS price,a.giftprice FROM pre_live_gift_log a WHERE a.dateline >= '$dateline1'  AND a.dateline <= '$dateline2' AND a.giftid='$gift_id' and action='2'  GROUP BY a.uid ORDER BY `sum` DESC LIMIT $start_limit, {$_G[setting][memberperpage]}";
	  	}
		$gift_signal_query = DB::query($gift_signal_sql);
	  ?>
      <tr>
        <td align="left" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
            <tr>
              <td align="center" bgcolor="#FFFFFF">收礼人UID</td>
              <td align="center" bgcolor="#FFFFFF">收礼人</td>
              <td align="center" bgcolor="#FFFFFF">送礼人UID</td>
              <td align="center" bgcolor="#FFFFFF">送礼人</td>
			  <form name="form_6" id="form_6" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=giftwatch" method="post">
              <td align="center" bgcolor="#FFFFFF">
                <label>礼物
                <select name="gift_id" id="gift_id" onchange="document.getElementById('form_6').submit();">
				<?php 
				while($showgift_query = DB::fetch($gift_query)) { 
				?>
				<option value="<?php echo $showgift_query["giftid"];?>" <?php if($showgift_query["giftid"]==$gift_id) {?>selected="selected"<?php }?>><?php echo substr(pingyinFirstChar($showgift_query["name"]),0,3)."_".$showgift_query["name"];?></option>
				<?php }?>}
                </select>
              </label>
			  <input name="dateline1" type="hidden" id="dateline1" value="<?php echo $dateline1_str;?>" />
		 		 <input name="dateline2" type="hidden" id="dateline2" value="<?php echo $dateline2_str;?>" />
		 		 <input name="submit_post" type="hidden" id="submit_post" value="yes" />
				 <input name="particulars_search" type="hidden" id="particulars_search" value="no" />
				 <input name="target_uid" type="hidden" id="target_uid" value="<?php echo $target_uid;?>" />
			  </td>
			  </form>
              <td align="center" bgcolor="#FFFFFF">数量</td>
              <td align="center" bgcolor="#FFFFFF">单价</td>
              <td align="center" bgcolor="#FFFFFF">总价值</td>
            </tr>
			<?php 
				while($gift_signal_query_rs = DB::fetch($gift_signal_query)) { 
			?>
			
            <tr>
              <td align="center" bgcolor="#FFFFFF"><?php echo $gift_signal_query_rs["uid"];?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $gift_signal_query_rs["username"];?></td>
              <td align="center" bgcolor="#FFFFFF"><?php if(!empty($target_uid)) echo $gift_signal_query_rs["targetuid"]; else echo "-";?></td>
              <td align="center" bgcolor="#FFFFFF"><?php if(!empty($target_uid)) echo $gift_signal_query_rs["targetusername"]; else echo "-";?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $gift_signal_query_rs["giftname"];?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $gift_signal_query_rs["sum"];?><?php if(!empty($target_uid)) echo "&nbsp;<br />(送礼时间：".date("Y-m-d H:i:s",$gift_signal_query_rs["dateline"].")"); ?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $gift_signal_query_rs["giftprice"];?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $gift_signal_query_rs["price"];?></td>
            </tr>
			<?php 
			}
			?>
          </table></td>
      </tr>
	  
	  <?php } ?>
      <tr>
        <td align="right" bgcolor="#FFFFFF">
		<?php
	  
	 // var_dump($showcoin_rs_count);
	  	$multi = multi($showcoin_rs_count,$_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=giftwatch&submit_post=yes&particulars_search=$particulars_search&target_uid=$target_uid&gift_id=$gift_id".$act);
	  	showsubmit('', '', '', '', $multi);
	  	?>
		</td>
      </tr>
    </table>
<?php }

function pingyinFirstChar($sourcestr){ 
	$returnstr=''; 	
	$i=0; 
	$n=0; 
	$str_length=strlen($sourcestr);//字符串的字节数 
	while ($i<=$str_length) { 
		$temp_str=substr($sourcestr,$i,1); 
		$ascnum=Ord($temp_str);//得到字符串中第$i位字符的ascii码 
		if ($ascnum>=224){  //如果ASCII位高与224，
			$returnstr=$returnstr.getHanziInitial(substr($sourcestr,$i,3)); //根据UTF-8编码规范，将3个连续的字符计为单个字符			
			$i=$i+3;				//实际Byte计为3
		}else if($ascnum>=192){  //如果ASCII位高与192，
			$returnstr=$returnstr.getHanziInitial(substr($sourcestr,$i,2)); //根据UTF-8编码规范，将2个连续的字符计为单个字符 
			$i=$i+2;				//实际Byte计为2
		}else if($ascnum>=65 && $ascnum<=90){  //如果是大写字母，
			$returnstr=$returnstr.substr($sourcestr,$i,1); 
			$i=$i+1;				//实际的Byte数仍计1个
		}else{  //其他情况下，包括小写字母和半角标点符号，
			$returnstr=$returnstr.strtoupper(substr($sourcestr,$i,1));  //小写字母转换为大写
			$i=$i+1;				//实际的Byte数计1个
		} 
	} 
	return $returnstr; 
}

function getHanziInitial($s0){
	if(ord($s0) >= "1" and ord($s0) <= ord("z")){
		return strtoupper($s0);
	}
	$s = iconv("UTF-8", "gbk//IGNORE", $s0); // 不要转换成GB2312内没有的字符哦，^_^
	$asc = @ord($s{0}) * 256 + @ord($s{1})-65536;
	if($asc >= -20319 and $asc <= -20284)return "A";
	if($asc >= -20283 and $asc <= -19776)return "B";
	if($asc >= -19775 and $asc <= -19219)return "C";
	if($asc >= -19218 and $asc <= -18711)return "D";
	if($asc >= -18710 and $asc <= -18527)return "E";
	if($asc >= -18526 and $asc <= -18240)return "F";
	if($asc >= -18239 and $asc <= -17923)return "G";
	if($asc >= -17922 and $asc <= -17418)return "H";
	if($asc >= -17417 and $asc <= -16475)return "J";
	if($asc >= -16474 and $asc <= -16213)return "K";
	if($asc >= -16212 and $asc <= -15641)return "L";
	if($asc >= -15640 and $asc <= -15166)return "M";
	if($asc >= -15165 and $asc <= -14923)return "N";
	if($asc >= -14922 and $asc <= -14915)return "O";
	if($asc >= -14914 and $asc <= -14631)return "P";
	if($asc >= -14630 and $asc <= -14150)return "Q";
	if($asc >= -14149 and $asc <= -14091)return "R";
	if($asc >= -14090 and $asc <= -13319)return "S";
	if($asc >= -13318 and $asc <= -12839)return "T";
	if($asc >= -12838 and $asc <= -12557)return "W";
	if($asc >= -12556 and $asc <= -11848)return "X";
	if($asc >= -11847 and $asc <= -11056)return "Y";
	if($asc >= -11055 and $asc <= -10247)return "Z";
	return $s0; // 返回原字符，不作转换。（标点、空格、繁体字都会直接返回）
}


?>
