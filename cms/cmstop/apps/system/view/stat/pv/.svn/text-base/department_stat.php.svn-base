<?php
function department_list($departmentid, $year, $month = null, $day = null)
{
	$departmentid = intval($departmentid);
	$date = $year;
	if ($month)
	{
		$date .= '-'.$month;
		if ($day) $date .= '-'.$day;
	}
	$db = & factory::db();
	return $db->select("SELECT * FROM #table_department_stat WHERE departmentid=$departmentid AND date LIKE '$date%'");
}

if (!isset($year) || !$year) $year = date('Y');
if (!isset($month) || !$month) $month = date('m');

$months = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12')
?>



<div class="tag_1">
<ul class="tag_list mar_t_10 layout">
<?php
$i = 0;
for ($y = date('Y'); ; $y--)
{
	$i++;
	$selected = $y == $year ? 'class="s_3"' : '';
	echo '<li><a href="javascript:;" onclick="$(\'#stat\').load(\'?app=system&controller=stat_pv&action=department_stat&departmentid='.$departmentid.'&year='.$y.'&month='.$month.'\');" '.$selected.'>'.$y.'年</a></li>';
	if ($i >= 10) break;
}
?>
</ul></div>
<div class="tag_list_1 pad_8 layout">
<?php
foreach ($months as $m)
{
	$selected = $m == $month ? 'class="s_5"' : '';
	echo '<a href="javascript:;" onclick="$(\'#stat\').load(\'?app=system&controller=stat_pv&action=department_stat&departmentid='.$departmentid.'&year='.$year.'&month='.$m.'\');" '.$selected.'>'.(substr($m, 0, 1) == 0 ? substr($m, 1) : $m).'月</a>';
}
?>
</div>


        <table width="500px" border="0" cellpadding="0" cellspacing="0" class="table_list mar_t_8">
          <tbody>
            <tr>
              <th width="100" class="bdr_3">日期</th>
              <th>内容</th>
              <th>评论</th>
              <th>PV</th>
            </tr>
<?php 
$posts = $comments = $pv = 0;
$data = department_list($departmentid, $year, $month);
foreach ($data as $r)
{
	$posts += $r['posts'];
	$comments += $r['comments'];
	$pv += $r['pv'];
?>
            <tr>
              <td><?=$r['date']?></td>
              <td><?=$r['posts']?></td>
              <td><?=$r['comments']?></td>
              <td><?=$r['pv']?></td>
            </tr>     
<?php
}
?> 
           <tr>
              <td>合计</td>
              <td><?=$posts?></td>
              <td><?=$comments?></td>
              <td><?=$pv?></td>
            </tr>
          </tbody>
        </table>