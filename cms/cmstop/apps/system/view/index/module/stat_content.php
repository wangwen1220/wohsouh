<?php
function category_posts($catid, $date_min, $date_max = null)
{
	$where_date = is_null($date_max) ? "`date`>='$date_min'" : ($date_min == $date_max ? "`date`='$date_min'" : "`date`>='$date_min' AND `date`<='$date_max'");
	$db = & factory::db();
	$cat = table('category', $catid);
	if ($cat['childids'])
	{
		$r = $db->get("SELECT sum(posts) as posts FROM #table_category_stat WHERE catid IN({$cat['childids']}) AND $where_date");
	}
	else 
	{
		$r = $db->get("SELECT sum(posts) as posts FROM #table_category_stat WHERE catid=$catid AND $where_date");
	}
	return $r['posts'];
}
?> 
<div class="box_10 mar_t_10 " id="stat_content">
        <h3 class="layout" style="cursor:move;"><span class="f_l b">内容统计</span><span class="f_r mar_t_2" ><span><img src="images/down_1.gif" height="14" width="14" class="hand" onclick="module.down(this)" /></span>&nbsp;<span><img src="images/up_1.gif" height="14" width="14" class="hand" onclick="module.up(this)"/></span>&nbsp;<img src="images/close_1.gif" alt="关闭" title="关闭" height="14" width="14"  class="hand" onclick="module.del(this)" /></span></h3>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_info">
          <tbody>
            <tr>
              <th width="50">&nbsp;</th>
              <th>今日</th>
              <th>昨日</th>
              <th>本周</th>
              <th>本月</th>
              <th>全部</th>
            </tr>
<?php 
$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime('yesterday'));
$firstweekdate = date('Y-m-d', strtotime('last monday'));
$firstmonthdate = date('Y-m-01');
$channel = channel();

foreach ($channel as $c)
{
	$posts_today[$c['catid']] = category_posts($c['catid'], $today);
	$posts_yesterday[$c['catid']] = category_posts($c['catid'], $yesterday, $yesterday);
	$posts_week[$c['catid']] = category_posts($c['catid'], $firstweekdate);
	$posts_month[$c['catid']] = category_posts($c['catid'], $firstmonthdate);
	$posts_total[$c['catid']] = table('category', $c['catid'], 'posts');
?>
            <tr>
              <th><?=$c['name']?></th>
              <td><?=$posts_today[$c['catid']]?></td>
              <td><?=$posts_yesterday[$c['catid']]?></td>
              <td><?=$posts_week[$c['catid']]?></td>
              <td><?=$posts_month[$c['catid']]?></td>
              <td><?=$posts_total[$c['catid']]?></td>
            </tr>     
<?php
}
?> 
           <tr>
              <th>合计</th>
              <td><?=array_sum($posts_today)?></td>
              <td><?=array_sum($posts_yesterday)?></td>
              <td><?=array_sum($posts_week)?></td>
              <td><?=array_sum($posts_month)?></td>
              <td><?=array_sum($posts_total)?></td>
            </tr>
          </tbody>
        </table>
</div>