<?php
define('CURSCRIPT', 'apidb');

require '../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();



//($thisUserCharm/$MC*0.6+$thisUserVote/$MV*0.4)*(1*10000)



/**
 * 获取魅力指数排行榜
 */
//最高魅力人
$col = $_GET['col'];
if (empty($col)){
	$col = 'monthnum';
}
$limit = $_GET['limit'];
if (empty($limit)){
	$limit = 30;
}

$sql = "SELECT MAX($col) as maxcharm FROM pre_live_top WHERE cate like 'charm' ";
$rs = DB::fetch_first($sql);
$maxcharm = $rs['maxcharm'];




//最高投票人
$sql = "SELECT MAX($col) as maxvote FROM pre_live_top WHERE cate like 'vote' ";
$rs = DB::fetch_first($sql);
$maxvote = $rs['maxvote'];

$sql = "SELECT a.*,if(b.nickname!='',b.nickname,b.username) as nickname FROM ".DB::table('live_top')." a  
		LEFT JOIN ".DB::table('common_member')." b ON a.uid=b.uid  
		LEFT JOIN ".DB::table('live_room')." c ON a.uid = c.uid
		
		WHERE 
		a.cate like 'vote' or a.cate like 'charm'
		AND b.groupid!=1 AND c.stat>=0 ";
$query = DB::query($sql);
while ($rs = DB::fetch($query)){
	$list[]=$rs;
	if ($rs['cate']=='charm'){
		$charmList[] = $rs;
	}else{
		$voteList[]  = $rs;
	}
}
$zList = array();
foreach ($list as $key=>$value)
{
	$thisUserCharm = getThisUserCharm($value['uid']);
	$thisUserVote  = getThisUserVote($value['uid']);
	
	$zList[$value['uid']] = $value;
	$zList[$value['uid']]['zhishu'] = ($thisUserCharm/$maxcharm*0.6+$thisUserVote/$maxvote*0.4)*(1*10000);
}

$endList = arraySortByKey($zList,'zhishu',$limit);


if ($_GET['cate']=='charm'){
	
	$endList = arraySortByKey($charmList,$col,$limit);
	echo '<table>
  <tr>
    <th>排名</th>
    <th>火秀号</th>
    <th>昵称</th>   
  </tr>';
	foreach ($endList as $k=>$v){
		echo ' <tr>
    <td>'.($k+1).'</td>
    <td>'.$v['uid'].'</td>
    <td>'.$v['nickname'].'</td>
    <td>'. $v[$col].'</td>
   
  </tr>';
		
	}
	echo '</table>';
	die();
}
if ($_GET['cate']=='vote'){
	
	$endList = arraySortByKey($voteList,$col,$limit);
	echo '<table>
  <tr>
    <th>排名</th>
    <th>火秀号</th>
    <th>昵称</th>   
  </tr>';
	foreach ($endList as $k=>$v){
		echo ' <tr>
    <td>'.($k+1).'</td>
    <td>'.$v['uid'].'</td>
    <td>'.$v['nickname'].'</td>
    <td>'. $v[$col].'</td>
   
  </tr>';
		
	}
	echo '</table>';
	die();
}

?>
<table>
  <tr>
    <th>排名</th>
    <th>火秀号</th>
    <th>昵称</th>   
  </tr> 

<?php 
foreach ($endList as $k=>$v){
?>
 <tr>
    <td><?php echo $k+1;?></td>
    <td><?php echo $v['uid'];?></td>
    <td><?php echo $v['nickname'];?></td>
    <td><?php echo $v['zhishu'];?></td>
   
  </tr>

<?php 
}?>
</table>
<?php
function getThisUserCharm($uid)
{
	global $charmList,$col;
	foreach ($charmList as $key=>$value){
		if ($value['uid']==$uid){
			return $value[$col];
		}
		
	}
	return 0;
}
function getThisUserVote($uid)
{
	global $voteList,$col;
	foreach ($voteList as $key=>$value){
		if ($value['uid']==$uid){
			return $value[$col];
		}
		
	}
	return 0;
}

function arraySortByKey($array,$k,$limit=20,$sc=SORT_DESC){
	
	foreach ($array as $key => $row) {
    	$volume[$key]  = $row[$k];
    	//$edition[$key] = $row['edition'];
	}
	array_multisort($volume, SORT_DESC,  $array);
	
	$i=1;
	foreach ($array as $key=>$value){
		$endList[] = $value;
		if ($limit==$i) break;
		$i++;
	}
	return $endList;
}

