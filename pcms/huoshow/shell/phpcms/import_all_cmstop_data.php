<?php
/*
 * 离线导入所有CMSTOP数据
 * */

$root_path = realpath(dirname(__FILE__)."/../../..");
$_SERVER['DOCUMENT_ROOT'] = $root_path;
require_once $_SERVER['DOCUMENT_ROOT'].'/huoshow/configs/config.php';

$importid = $argv[1];
$site = PCMS_URL;
if(empty($importid))
	die($argv[0]." importid\n");
$url = $site."index.php?m=import&c=import&a=do_import&importid=$importid&type=content&hwbuildpasswordTR56Y=yes";
$curl = curl_init();

// 设置你需要抓取的URL
curl_setopt($curl, CURLOPT_URL, $url);

// 设置header
curl_setopt($curl, CURLOPT_HEADER, 1);

// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// 运行cURL，请求网页
$data = curl_exec($curl);
// 显示获得的数据

preg_match("/Location\: \?([^\n]+)/", $data,$m);
if(empty($m[1]))
{
	var_dump($data);
	die("fail");
}
while (1)
{
	$start = time();
	$m[1] = trim($m[1]);
	$url = PCMS_URL."index.php?".$m[1]."&hwbuildpasswordTR56Y=yes";
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	preg_match("/Location\: \?([^\n]+)/", $data,$m);
	if(empty($m[1]))
	{
		var_dump($url);
		var_dump($data);
		break;
	}
	else
	{
		echo "\ttime:".time()-$start."\n".$m[1];
	}
}

// 关闭URL请求
curl_close($curl);

die("ok");
?>