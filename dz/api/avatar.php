<?php
define('CURSCRIPT', 'apidb');
require '../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();
//初始化数据
$act= $_GET['act'];
$uid = $_G['uid'];

$uid = sprintf("%09d", $uid);
$dir1 = substr($uid, 0, 3);
$dir2 = substr($uid, 3, 2);
$dir3 = substr($uid, 5, 2);
$filename = $uploaddir.'/'.substr($uid, -2).($real ? '_real' : '').'_cover'.$size.'.jpg';//要生成的图片名字
$uploaddir = DISCUZ_ROOT.'uc_server/data/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'; //指定文件存储路径
if (!file_exists($uploaddir))	mkdir($uploaddir, 0777, 1 );
$xmlstr =  $GLOBALS[HTTP_RAW_POST_DATA];
if(empty($xmlstr)) $xmlstr = file_get_contents('php://input');

$jpg = $xmlstr;//得到post过来的二进制原始数据
$file = fopen($uploaddir.$filename,"w");//打开文件准备写入
fwrite($file,$jpg);//写入
fclose($file);//关闭