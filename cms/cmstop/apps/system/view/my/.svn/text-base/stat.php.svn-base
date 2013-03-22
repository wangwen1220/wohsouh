<?php $this->display('header', 'system');?>
<?php
function admin_list($userid, $year, $month = null, $day = null)
{
	$userid = intval($userid);
	$date = $year;
	if ($month)
	{
		$date .= '-'.$month;
		if ($day) $date .= '-'.$day;
	}
	$db = & factory::db();
	return $db->select("SELECT * FROM #table_admin_stat WHERE userid=$userid AND date LIKE '$date%'");
}

if (!isset($year) || !$year) $year = date('Y');
if (!isset($month) || !$month) $month = date('m');

$months = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
?>
<div class="bk_10"></div>
<div class="mar_l_8">
<div class="tag_1">
<ul class="tag_list layout">
<?php
$i = 0;
for ($y = date('Y'); ; $y--)
{
	$i++;
	$selected = $y == $year ? 'class="c_blue"' : '';
	$selected = $y == $year ? 'class="s_3"' : '';
	echo '<li><a href="?app=system&controller=my&action=stat&year='.$y.'&month='.$month.'" '.$selected.'>'.$y.'年</a></li>';
	if ($i >= 6) break;
}
?>
</ul></div>
<div class="clear"></div>
<div class="tag_list_1 pad_8 layout">
<?php
foreach ($months as $m)
{
	$selected = $m == $month ? 'class="s_5"' : '';
	echo '<a href="?app=system&controller=my&action=stat&year='.$year.'&month='.$m.'" '.$selected.'>'.(substr($m, 0, 1) == 0 ? substr($m, 1) : $m).'月</a>';
}
?>
</div>
</div>

<table width="500px" border="0" cellpadding="0" cellspacing="0" class="table_list" style="margin:10px">
	<tbody>
	<tr>
	  <th width="100" class="bdr_3">日期</th>
	  <th width="133">内容</th>
	  <th width="133">评论</th>
	  <th width="133">PV</th>
	</tr>
<?php 
$posts = $comments = $pv = 0;
$data = admin_list($_userid, $year, $month);
foreach ($data as $r)
{
$posts += $r['posts'];
$comments += $r['comments'];
$pv += $r['pv'];
?>
	<tr>
	  <td class="t_c"><?=$r['date']?></td>
	  <td><?=$r['posts']?></td>
	  <td><?=$r['comments']?></td>
	  <td><?=$r['pv']?></td>
	</tr>     
<?php
}
?> 
   <tr>
	  <td class="t_r">合计：</td>
	  <td><?=$posts?></td>
	  <td><?=$comments?></td>
	  <td><?=$pv?></td>
	</tr>
	</tbody>
</table>
<?php $this->display('footer', 'system');?>