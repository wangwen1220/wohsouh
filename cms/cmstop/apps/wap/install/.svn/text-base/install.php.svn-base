<?php
$menu = loader::model('admin/menu', 'system');

$menuids = array();
$menuid = $menu->add(array(
	'parentid'=>5,
	'name'=>'Wap',
	'url'=>'?app=wap&controller=setting&action=index',
	'sort'=>'9'
));
$menuids[] = $menuid;
$installlog = str_replace('\\', '/', dirname(__FILE__)).'/install.log';
file_put_contents($installlog, implode(',', $menuids));