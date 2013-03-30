<?php
return array (
  1 => 
  array (
    'urlruleid' => '1',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '1',
    'urlrule' => '{$categorydir}{$catdir}/index.html|{$categorydir}{$catdir}/{$page}.html',
    'example' => 'news/china/1000.html',
  ),
  6 => 
  array (
    'urlruleid' => '6',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'index.php?m=content&c=index&a=lists&catid={$catid}|index.php?m=content&c=index&a=lists&catid={$catid}&page={$page}',
    'example' => 'index.php?m=content&c=index&a=lists&catid=1&page=1',
  ),
  11 => 
  array (
    'urlruleid' => '11',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '1',
    'urlrule' => 'staticpage/{$year}/{$catdir}_{$month}{$day}/{$id}.html|{$year}/{$catdir}_{$month}{$day}/{$id}_{$page}.html',
    'example' => 'staticpage/2010/catdir_0720/1_2.html',
  ),
  12 => 
  array (
    'urlruleid' => '12',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '1',
    'urlrule' => '{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}.html|{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}_{$page}.html',
    'example' => 'it/product/2010/0720/1_2.html',
  ),
  16 => 
  array (
    'urlruleid' => '16',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => 'index.php?m=content&c=index&a=show&catid={$catid}&id={$id}|index.php?m=content&c=index&a=show&catid={$catid}&id={$id}&page={$page}',
    'example' => 'index.php?m=content&c=index&a=show&catid=1&id=1',
  ),
  17 => 
  array (
    'urlruleid' => '17',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => 'show-{$catid}-{$id}-{$page}.html',
    'example' => 'show-1-2-1.html',
  ),
  18 => 
  array (
    'urlruleid' => '18',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => 'content-{$catid}-{$id}-{$page}.html',
    'example' => 'content-1-2-1.html',
  ),
  30 => 
  array (
    'urlruleid' => '30',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'list-{$catid}-{$page}.html',
    'example' => 'list-1-1.html',
  ),
  31 => 
  array (
    'urlruleid' => '31',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '1',
    'urlrule' => '{$year}/{$month}{$day}/{$id}.shtml|{$year}/{$month}{$day}/{$id}_{$page}.shtml',
    'example' => '2012/0417/134576.shtml',
  ),
  32 => 
  array (
    'urlruleid' => '32',
    'module' => 'content',
    'file' => 'showpic',
    'ishtml' => '0',
    'urlrule' => 'index.php?m=content&c=index&a=showpic&catid={$catid}&id={$id}|index.php?m=content&c=index&a=showpic&catid={$catid}&id={$id}&page={$page}',
    'example' => 'index.php?m=content&a=showpic&catid=4',
  ),
  36 => 
  array (
    'urlruleid' => '36',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '1',
    'urlrule' => 'games/{$year}/{$month}{$day}/{$id}.shtml|games/{$year}/{$month}{$day}/{$id}_{$page}.shtml',
    'example' => 'games/2013/0129/123456.shtml',
  ),
  35 => 
  array (
    'urlruleid' => '35',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '1',
    'urlrule' => '{$categorydir}{$catdir}/index.shtml|{$categorydir}{$catdir}/{$page}.shtml',
    'example' => 'movie/yingren/index.shtml',
  ),
);
?>