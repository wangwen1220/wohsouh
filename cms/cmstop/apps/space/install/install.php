<?php
$menu = loader::model('admin/menu', 'system');

$menuids = array();
$menuid = $menu->add(array(
	'parentid'=>5,
	'name'=>'个人专栏',
	'url'=>'?app=space&controller=index&action=index',
	'sort'=>'6'
));
$menuids[] = $menuid;
$installlog = str_replace('\\', '/', dirname(__FILE__)).'/install.log';
file_put_contents($installlog, implode(',', $menuids));