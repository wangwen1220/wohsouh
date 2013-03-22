#!/usr/local/php5/bin/php
<?php

ini_set("max_execution_time", "180"); 
ini_set("display_errors","Off");


print_r("======".date("Y-m-d H:i:s")."========\n");
if($argc<3)
{
	print_r("参数错误，请输入php build_page.php 请求地址 写入地址\n");
	exit(0);
}
$i=0;
$context=array('http' => array ('header'=> 'Range: bytes=1024-', ),);
$xcontext = stream_context_create($context);
$content=file_get_contents($argv[1],FALSE,$xcontext);
if(empty($content))
        die("没有内容\n\n");
//$sock   =       "数据库繁忙";
//if(preg_match($sock, $content))
//        die("数据库出错");
$handle1  = fopen($argv[2],"wb");
if(!$handle1)
        die("打开文件失败\n\n");
$tt=fwrite($handle1, $content);

if($tt==false)
        die("写入文件失败\n\n");
if(fclose($handle1))
{
	chown($argv[2],"space");
	chgrp($argv[2],"space");
	die("写入成功\n\n");
}

?>
